<?php
/**
 * @Author: Ophelie
 * @Date:   2015-05-27 16:12:41
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-06-18 12:58:35
 */

namespace Adresse\Form;

use Zend\Form\Form;
use Adresse\Model\AdresseModel;

class AdresseForm extends Form
{
	public $fields;

	public function __construct($translator,$em=null,$adresse=null,$request=null)
	{
		parent::__construct('adresse-form');
		$this->setAttribute('method', 'post');

		$adresseModel=new AdresseModel;
		$this->fields=$adresseModel->fields;
		$this->setInputFilter($adresseModel);

		// Creation des champs du formulaire à partir des champs du modèle de l'Adresse
		foreach($this->fields as $field => $data)
		{
			$value=$type=$label=$required='';
			$value_options=array();

			if(isset($data['form']['label']))
				$label=$data['form']['label'];
			if(isset($data['required']) && $data['required']==true)
				$required='required ';

			// Declaration d'un élément du formulaire
			$element=array(
				'name'=>$field,
				'type'=>$data['form']['type'],
				'attributes'=>array(
					'id'=>$field,
					'class'=>'',
					'data_required'=>$required,
				),
				'options'=>array(
					'label'=>$translator->translate($label),
				),
			);

			// Adding specified class and requirement
			if(isset($data['class']))
				$element['attributes']['class'].=$data['class'];
			$element['attributes']['class'].=$required;

			// Adding specified attributes
			if(isset($data['form']['attributes']) && is_array($data['form']['attributes']) && count($data['form']['attributes'])>0)
				foreach($data['form']['attributes'] as $attr => $content)
					$element['attributes'][$attr]=$content;

			// Adding scripts to the element if exists
			if(isset($data['form']['scripts']) && is_array($data['form']['scripts']) && count($data['form']['scripts'])>0)
				$element['scripts']=$data['form']['scripts'];

			// Adding specified form options
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
					$element['attributes']['value']=$data['form']['value'];
					$element['options']['checked_value']=1;
					$element['options']['unchecked_value']=0;
				break;
				case 'multicheckbox':
					$element['options']['value_options']=$data['form']['value_options'];
				break;
				default:
					$element['attributes']['type']=$data['form']['type'];
					$element['attributes']['class'].=' form-control input-sm';
					$element['attributes']['placeholder']=$label;
				break;
			}

			// Si le client n'est pas null et qu'on le modifie, on ajoute ses propriétés au formulaire
			if( !is_null($adresse) )
			{
				if($field=='type_adresse')
				{
					if($adresse->getAdressePrincipale())
					{
						$element['options']['value_options']['principale']['selected']=true;
					}
					if($adresse->getAdresseFacturation())
					{
						$element['options']['value_options']['facturation']['selected']=true;
					}
					if($adresse->getAdresseLivraison())
					{
						$element['options']['value_options']['livraison']['selected']=true;
					}
					if($adresse->getAdressePostale())
					{
						$element['options']['value_options']['postale']['selected']=true;
					}
				}
				else
				{
					if($data['form']['type']=='hidden')
						$value=$adresse->{'get'.$data['form']['getter']}();
					else
					{
						$tab=explode('_',$field);
						$method='';
						foreach($tab as $part)
						{
							$method.=ucfirst($part);
						}
						$property=lcfirst($method);
						if(property_exists($adresse,$property))
						{
							$value=$adresse->{'get'.$method}();
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
				'id'=>$this->getAttribute('name').'-submit',
				'type'=>'submit',
				'class'=>'btn btn-primary pull-right',
				'value'=>'Valider',
				'data-loading-text'=>'En cours...',
				'data-default-text'=>'Enregistrer'
			),
		));
	}
}