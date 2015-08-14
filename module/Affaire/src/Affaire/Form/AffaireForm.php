<?php
/**
 * @Author: Ophelie
 * @Date:   2015-07-13 10:30:54
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-08-14 16:14:17
 */

namespace Affaire\Form;

use Zend\Form\Form;
use Affaire\Model\AffaireModel;
// use Zend\I18n\Translator\Translator;

class AffaireForm extends Form
{
	public $fields;

	public function __construct($translator,$sm,$em=null,$request=null,$affaire=null)
	{
		parent::__construct('affaire-form');
		$this->setAttribute('method', 'post');

		$affaireModel=new AffaireModel();
		$this->fields=$affaireModel->fields;
		$this->setInputFilter($affaireModel->getInputFilter());

		// Creation des champs du formulaire à partir des champs du modèle de l'affaire'
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
					'required'=>$required,
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
				$element['attributes']['class'].=$data['class'];
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
					$element['options']['checked_value']=1;
					$element['options']['unchecked_value']=0;
					$element['attributes']['value']=1;
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
					if(!isset($data['form']['required']) || $data['form']['required']==false)
						$element['options']['disable_inarray_validator']=true; // Permet de préciser que si null est envoyé au form alors qu'il n'est pas dans le tableau des possiblités, on désactive le validateur afin qu'il ne crie pas
					if(isset($data['form']['value_options']))
						$element['options']['value_options']=$data['form']['value_options'];
					else
					{
						$options=array();
						switch($field)
						{
							case 'ref_centre_profit':
								$c = new \Affaire\Entity\CentreDeProfit;
								$centres = $c->getCentresProfit($sm);
								if(is_array($centres)&&count($centres)>0)
								{
									foreach($centres as $centre)
									{
										$options[]=array(
											'value'=>$centre['id'],
											'label'=>$translator->translate($centre['intitule_centre'])
										);
									}
								}
								if($affaire->getRefCentreProfit())
								{						
									$element['attributes']['disabled']='disabled';
								}
							break;
							case 'code_client':
								$c=new \Client\Entity\Client;
								$codes=$c->getCodesClient($sm);
								if(is_array($codes)&&count($codes)>0)
								{
									foreach($codes as $code)
									{
										$options[]=array(
											'value'=>$code['code_client'],
											'label'=>$code['code_client']
										);
										$options[0]['value']=0;
										$options[0]['label']='['.$translator->translate('Pas de code').']';
									}
								}
								if($affaire->getRefClient())
								{
									$element['attributes']['disabled']='disabled';
								}
							break;
							case 'ref_client':
								$c=new \Client\Entity\Client;
								$clients = array();
								if($affaire->getRefClient())
								{
									$c=$affaire->getRefClient();
									$codeClient=$c->getCodeClient();

									$clients=$c->getClientsFromForms($sm,$codeClient,$c->getRaisonSociale());
									$element['attributes']['disabled']='disabled';
								}
								else
								{
									$clients=$c->getClientsFromForms($sm);
								}
								if(is_array($clients)&&count($clients)>0)
								{
									foreach($clients as $client)
									{
										$options[]=array(
											'value'=>$client['id'],
											'label'=>$client['societe']
										);
									}
								}
							break;
							case 'ref_interlocuteur':
								$i=new \Client\Entity\InterlocuteurClient;
								$interlocuteurs = array();
								if($affaire->getRefClient())
								{
									$interlocuteurs=$i->getNomsInterlocuteurs($sm,$affaire->getRefClient()->getId());
								}
								else
								{
									$interlocuteurs=$i->getNomsInterlocuteurs($sm);
								}
								if(is_array($interlocuteurs)&&count($interlocuteurs)>0)
								{
									foreach($interlocuteurs as $interlocuteur)
									{
										$options[]=array(
											'value'=>$interlocuteur['id'],
											'label'=>$interlocuteur['nom_complet']
										);
									}
								}
							break;
							case 'ref_personnel':
								$p = new \Personnel\Entity\Personnel;
								$personnels = $p->getNomsPersonnels($sm);
								if(is_array($personnels)&&count($personnels)>0)
								{
									foreach($personnels as $personnel)
									{
										$options[]=array(
											'value'=>$personnel['id'],
											'label'=>$personnel['nom_complet']
										);
									}
								}
							break;
							case 'ref_condition_reglement':
								$conditions = $em->getRepository('Application\Entity\ConditionReglement')->findAll();
								if(is_array($conditions)&&count($conditions)>0)
								{
									foreach($conditions as $condition)
									{
										$options[] = array(
											'value' => $condition->getId(),
											'label' => $translator->translate($condition->getIntituleConditionReglement())
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

			if( !is_null($affaire) )
			{
				if($field=='code_client')
				{
					$value=$affaire->getRefClient();
					if($value)
					{
						if($value->getCodeClient())
						{
							$element['attributes']['value']=$value->getCodeClient();
						}
						else
						{
							$element['attributes']['value']=0;
						}
					}
				}
				else
				{
					if($data['form']['type']=='hidden')
						$value=$affaire->{'get'.$data['form']['getter']}();
					else
					{
						$tab=explode('_',$field);
						$method='';
						foreach($tab as $part)
						{
							$method.=ucfirst($part);
						}
						$property=lcfirst($method);
						if(property_exists($affaire,$property))
						{
							$value=$affaire->{'get'.$method}();
						}
					}

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

			$this->add($element);
		}

		$this->add(array(
			'name'=>'submit',
			'type'=>'Submit',
			'attributes'=>array(
				'id'=>'affaire-submit-button',
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