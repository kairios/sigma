<?php
/**
 * @Author: Ophelie
 * @Date:   2015-07-21 13:16:37
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-08-10 14:26:35
 */

// module\Personnel\src\Personnel\Form\PersonnelForm.php

namespace Personnel\Form;

use Zend\Form\Form;
use Personnel\Model\PersonnelModel;
// use Personnel\Entity\FonctionPersonnel;
use Personnel\Entity\Personnel;

class PersonnelForm extends Form
{
	public $fields;

	public function __construct($translator, $personnel = null, $sm = null, $em = null, $request = null)
	{
		parent::__construct('personnel-form');
		$this->setAttribute('method', 'post');

		$personnelModel = new PersonnelModel();
		$this->fields = $personnelModel->fields;
		$this->setInputFilter($personnelModel->getInputFilter());

		// Creation des champs du formulaire à partir des champs du modèle de l'interlocuteur
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
							// case 'ref_fonction':
							// 	$fonctions 	= $em->getRepository('Personnel\Entity\FonctionPersonnel')->findAll();
							// 	if(is_array($fonctions) && count($fonctions)>0)
							// 	{
							// 		foreach($fonctions as $fonction)
							// 		{
							// 			$options[]=array(
							// 				'value'=>$fonction->getId(),
							// 				'label'=>$translator->translate($fonction->getIntituleFonction())
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
			
			// Si le interlocuteur n'est pas null et qu'on le modifie, on ajoute ses propriétés au formulaire
			if( !is_null($personnel) )
			{
				// if($field=='code_fournisseur')
				// {
				// 	$value=$interlocuteur->getRefSocieteFournisseur();
				// 	if($value)
				// 	{
				// 		if($value->getCodeFournisseur())
				// 		{
				// 			$element['attributes']['value']=$value->getCodeFournisseur();
				// 		}
				// 		else
				// 		{
				// 			$element['attributes']['value']=0;
				// 		}
				// 	}
				// }
				if($field == 'administrateur')
				{
					$p = new Personnel();
					if(!$personnel->getAdministrateur() && $p->existeAdministrateur($em))
					{
						$element['attributes']['disabled']='disabled';
					}
				}
				if($field == 'mot_de_passe' || $field == 'confirmation_mot_de_passe')
				{
					$element['attributes']['value']=$personnel->getMotDePasse();
				}
				else
				{
					if($data['form']['type']=='hidden')
						$value=$personnel->{'get'.$data['form']['getter']}();
					else
					{

						$tab=explode('_',$field);
						$method='';
						foreach($tab as $part)
						{
							$method.=ucfirst($part);
						}
						$property=lcfirst($method);
						if(property_exists($personnel,$property))
						{
							$value=$personnel->{'get'.$method}();
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
				'id'=>'interlocuteur-form-submit',
				'type'=>'submit',
				'class'=>'btn btn-primary pull-right',
				'value'=>'Valider'
			),
		));
	}
}

?>