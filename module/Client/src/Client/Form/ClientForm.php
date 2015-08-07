<?php
/**
 * @Author: Ophelie
 * @Date:   2015-05-26 12:07:04
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-07-28 10:35:23
 */

namespace Client\Form;

use Zend\Form\Form;
use Client\Model\ClientModel;
// use Zend\I18n\Translator\Translator;

use Application\Entity\ModeReglement;
use Application\Entity\ConditionReglement;
use Client\Entity\TypeSegment;
use Client\Entity\Segment;

class ClientForm extends Form
{
	public $fields;
	public $hiddens;
	public $groups = array(
		'generalite'	=>'Informations générales',
		'coordonnees'	=>'Coordonnées',
		'comptabilite'	=>'Informations comptables',
		'interlocuteur'	=>'Interlocuteurs <i class="fa fa-info-circle" title="Cliquez sur un interlocuteur pour le modifier"></i>',
		'adresse'		=>'Adresses <i class="fa fa-info-circle" title="Cliquez sur une adresse pour la modifier"></i>',
		'autre'			=>'Autres informations',
		'requete'		=>'Requêtes',
	);

	public function __construct($translator,$sm=null,$em=null,$request=null,$client=null)
	{
		parent::__construct('client');
		$this->setAttribute('method', 'post');

		$clientModel=new ClientModel;
		$this->fields=$clientModel->fields;
		$this->hiddens=$clientModel->hiddens;
		$this->setInputFilter($clientModel->getInputFilter());

		// Creation des champs de type 'hidden'
		foreach($this->hiddens as $hidden => $dataHidden)
		{
			$element=array(
				'name'=>$hidden,
				'type'=>'hidden',
				'attributes'=>array(
					'id'=>$hidden,
					'class'=>'',
					'type'=>'hidden',
				),
			);
			if(!$request->isPost()&&!is_null($client)&&$hidden!='id'&&$hidden!='id_adresse')
			{
				$element['attributes']['value']=$client->{'get'.$dataHidden['form']['getter']}();
			}
			$this->add($element);
		}

		// Creation des champs du formulaire à partir des champs du modèle du Client
		foreach($this->fields as $field => $data)
		{
			$value=$type=$label=$required='';
			$value_options=array();

			if(isset($data['form']['label']))
				$label=$translator->translate($data['form']['label']);
			if(isset($data['form']['required']) && $data['form']['required']==true)
				$required='required ';

			// Déclaration de l'élément de formulaire
			$element=array(
				'name'=>$field,
				'type'=>$data['form']['type'],
				'attributes'=>array(
					'id'=>$field,
					'class'=>'',
					'data_required'=>$required,
				),
				'options'=>array(
					'label'=>$label,
				),
				'labelAttributes'=>array(
					'class'=>'control-label',
				),
			);

			// Adding specified class and requirement
			if(isset($data['form']['class']))
				$element['attributes']['class'].=$data['form']['class'];
			$element['attributes']['class'].=$required;

			// Adding specified attributes
			if(isset($data['form']['attributes']) && is_array($data['form']['attributes']) && count($data['form']['attributes'])>0)
				foreach($data['form']['attributes'] as $attr => $content)
					$element['attributes'][$attr]=$content;

			// Adding scripts to the element if exists
			if(isset($data['form']['scripts']) && is_array($data['form']['scripts']) && count($data['form']['scripts'])>0)
				$element['scripts']=$data['form']['scripts'];

			// Faire un switch sur le type afin de générer le bon élément : select, hidden, textfield, textarea...
			switch($data['form']['type'])
			{
				case 'text':
					$element['attributes']['type']='text';
					$element['attributes']['class'].=' form-control';
					$element['attributes']['placeholder']=$label;
					if(isset($data['max']))
						$element['attributes']['maxlength']=$data['max'];
				break;
				case 'textarea':
					$element['attributes']['type']='textarea';
					$element['attributes']['class'].=' form-control';
					$element['attributes']['placeholder']=$label;
					if(isset($data['max']))
						$element['attributes']['maxlength']=$data['max'];
				break;
				case 'checkbox':
					$element['attributes']['type']='checkbox';
					$element['attributes']['value']=false;
					$element['options']['checked_value']=1;
					$element['options']['unchecked_value']=0;
				break;
				case 'date':
					$element['type']='text';
					$element['attributes']['type']='text';
					$element['attributes']['class'].=' form-control input-sm';
					$element['attributes']['placeholder']=$label;
					$element['attributes']['data-mask']='99/99/9999';
				break;
				case 'select':
					$element['attributes']['type']='select';
					$element['attributes']['class'].=' form-control';
					$element['options']['empty_option']=$label;
					$element['options']['disable_inarray_validator']=true; // Permet de préciser que si null est envoyé au form alors qu'il n'est pas dans le tableau des possiblités, on désactive le validateur afin qu'il ne crie pas
					if(isset($data['form']['value_options']))
						$element['options']['value_options']=$data['form']['value_options'];
					else
					{
						$options=array();
						switch($field)
						{
							case 'ref_mode_reglement':
								//$m = new ModeReglement;
								$modes = $em->getRepository('Application\Entity\ModeReglement')->findAll();
								if(is_array($modes)&&count($modes)>0)
								{
									foreach($modes as $mode)
									{
										$options[]=array(
											'value'=>$mode->getId(),
											'label'=>$translator->translate($mode->getIntituleModeReglement())
										);
									}
								}
							break;
							case 'ref_condition_reglement':
								//$c = new ConditionReglement;
								$conditions = $em->getRepository('Application\Entity\ConditionReglement')->findAll();
								if(is_array($conditions)&&count($conditions)>0)
								{
									foreach($conditions as $condition)
									{
										$options[]=array(
											'value'=>$condition->getId(),
											'label'=>$translator->translate($condition->getIntituleConditionReglement())
										);
									}
								}
							break;
							case 'ref_type_segment':
								$types = $em->getRepository('Client\Entity\TypeSegment')->findAll();
								if(is_array($types)&&count($types)>0)
								{
									foreach($types as $type)
									{
										$options[]=array(
											'value'=>$type->getId(),
											'label'=>$translator->translate($type->getIntituleTypeSegment())
										);
									}
								}

							break;
							case 'segments':
								if(!$client->getRefTypeSegment())
								{
									// On disabled le champ tant que l'utilisateur n'a pas choisi de type de segment 
									// (on pourrait potentiellement éviter la recherche de segments en conséquence)
									$element['attributes']['disabled']='disabled';

									$segments = $em->getRepository('Client\Entity\Segment')->findAll();
								}
								else
									$segments = $em->getRepository('Client\Entity\Segment')->findByRefTypeSegment($client->getRefTypeSegment());

								if(is_array($segments) && count($segments)>0)
								{
									foreach($segments as $segment)
									{
										$options[] = array(
											'value' => $segment->getId(),
											'label' => $translator->translate($segment->getIntituleSegment())
										);
									}
								}
							break;
							case 'produits_finis':
								$segments = $client->getSegmentsId($sm);
								if(!$segments)
								{
									// On disabled le champ tant que l'utilisateur n'a pas choisi de type de segment 
									// (on pourrait potentiellement éviter la recherche de segments en conséquence)
									$element['attributes']['disabled']='disabled';
									$produits = $em->getRepository('Client\Entity\ProduitFini')->findAll();
								}
								else
								{
									$produits = array();
									foreach($segments as $segment)
									{
										$produits = array_merge($produits, $em->getRepository('Client\Entity\ProduitFini')->findByRefSegment($segment));
									}
								}

								if(is_array($produits) && count($produits)>0)
								{
									foreach($produits as $produit)
									{
										$options[] = array(
											'value' => $produit->getId(),
											'label' => $translator->translate($produit->getIntituleProduitFini())
										);
									}
								}
							break;
						}
						$element['options']['value_options']=$options;
					}
				break;
				default:
					$element['attributes']['type']=$data['form']['type'];
					$element['attributes']['class'].=' form-control input-sm';
					$element['attributes']['placeholder']=$label;
				break;
			}
			
			// Si le client n'est pas null et qu'on le modifie, on ajoute ses propriétés au formulaire
			if( !is_null($client) )
			{
				if($field == 'segments')
				{
					$segments = $client->getSegmentsId($sm);
					if($segments)
					{
						foreach($element['options']['value_options'] as $k => $f)
						{					
							foreach($segments as $s)
							{
								if($s['ref_segment'] == $f['value'])
									$element['options']['value_options'][$k]['selected'] = 'selected';
							}
						}
					}
				}
				else if($field == 'produits_finis')
				{
					$produits = $client->getProduitsFinisId($sm);
					if($produits)
					{
						foreach($element['options']['value_options'] as $k => $f)
						{					
							foreach($produits as $s)
							{
								if($s['ref_produit_fini'] == $f['value'])
									$element['options']['value_options'][$k]['selected'] = 'selected';
							}
						}
					}
				}
				else
				{
					$tab=explode('_',$field);
					$method='';
					foreach($tab as $part)
					{
						$method.=ucfirst($part);
					}
					$property=lcfirst($method);
					if(property_exists($client,$property))
					{
						//var_dump($field);
						$value=$client->{'get'.$method}();
						if(is_object($value))
						{
							$element['attributes']['value']=$value->getId();
						}
						else
						{
							$element['attributes']['value']=$value;
						}
					}
				}
				
			}
			$this->add($element);
		}

		$this->add(array(
			'name'=>'submit',
			'type'=>'Submit',
			'attributes'=>array(
				'id'=>'task-submit-button',
				'type'=>'submit',
				'class'=>'btn btn-primary pull-right',
				'value'=>$translator->translate('Valider')
			),
			'options'=>array(
				'label'=>$translator->translate('Valider')
			)
		));
	}
}

?>