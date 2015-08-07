<?php
/**
 * @Author: Ophelie
 * @Date:   2015-05-26 12:07:04
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-08-05 14:00:14
 */

namespace Fournisseur\Form;

use Zend\Form\Form;
use Fournisseur\Model\FournisseurModel;
use Zend\I18n\Translator\Translator;

class FournisseurForm extends Form
{
	public $fields;
	public $hiddens;
	public $groups = array(
		'generalite'=>'Informations générales',
		'coordonnees'=>'Coordonnées',
		'comptabilite'=>'Informations comptables',
		'interlocuteur'=>'Interlocuteurs <i class="fa fa-info-circle" title="Cliquez sur un interlocuteur pour le modifier"></i>',
		'adresse'=>'Adresses <i class="fa fa-info-circle" title="Cliquez sur une adresse pour la modifier"></i>',
		'autre'=>'Autres informations'
	);

	public function __construct($translator,$em=null,$request=null,$fournisseur=null)
	{
		parent::__construct('fournisseur');
		$this->setAttribute('method', 'post');

		$fournisseurModel=new FournisseurModel;
		$this->fields=$fournisseurModel->fields;
		$this->hiddens=$fournisseurModel->hiddens;
		$this->setInputFilter($fournisseurModel->getInputFilter());

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
			if(!$request->isPost()&&!is_null($fournisseur)&&$hidden!='id'&&$hidden!='id_adresse') // ÇA MARCHE ÇA ?????????????
			{
				$element['attributes']['value']=$fournisseur->{'get'.$dataHidden['form']['getter']}();
			}
			$this->add($element);
		}

		// Creation des champs du formulaire à partir des champs du modèle du fournisseur
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
								$modes=$em->getRepository('Application\Entity\ModeReglement')->findAll();
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
								$conditions=$em->getRepository('Application\Entity\ConditionReglement')->findAll();
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
							case 'ref_activite':
								$activites=$em->getRepository('Fournisseur\Entity\ActiviteFournisseur')->findBy(array(), array('intituleActivite'=>'asc'));
								if(is_array($activites)&&count($activites)>0)
								{
									foreach($activites as $activite)
									{
										$options[]=array(
											'value'=>$activite->getId(),
											'label'=>$translator->translate($activite->getIntituleActivite())
										);
									}
								}
							break;
							case 'ref_categorie':
								$categories=$em->getRepository('Fournisseur\Entity\CategorieFournisseur')->findAll();
								if(is_array($categories)&&count($categories)>0)
								{
									foreach($categories as $categorie)
									{
										$options[]=array(
											'value'=>$categorie->getId(),
											'label'=>$translator->translate($categorie->getIntituleCategorie())
										);
									}
								}
							break;
							// case 'ref_poste_par_defaut':
							// 	$postes=$em->getRepository('Application\Entity\Poste')->findAll();
							// 	if(is_array($postes)&&count($postes)>0)
							// 	{
							// 		foreach($postes as $poste)
							// 		{
							// 			$options[]=array(
							// 				'value'=>$poste->getId(),
							// 				'label'=>$translator->translate($poste->getIntitulePoste())
							// 			);
							// 		}
							// 	}
							// break;
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
			
			// Si le fournisseur n'est pas null et qu'on le modifie, on ajoute ses propriétés au formulaire
			if( !is_null($fournisseur) )
			{
				$tab=explode('_',$field);
				$method='';
				foreach($tab as $part)
				{
					$method.=ucfirst($part);
				}
				$property=lcfirst($method);
				if(property_exists($fournisseur,$property))
				{
					$value=$fournisseur->{'get'.$method}();
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