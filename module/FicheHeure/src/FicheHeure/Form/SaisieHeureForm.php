<?php
/**
 * @Author: Ophelie
 * @Date:   2015-08-10 16:49:15
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-08-10 17:04:38
 */


namespace FicheHeure\Form;

use Zend\Form\Form;
use FicheHeure\Model\SaisieHeureModel;
use Zend\I18n\Translator\Translator;

class SaisieHeureForm extends Form
{
	public $fields;

	public function __construct($translator,$sm,$em=null,$request=null,$interlocuteur=null)
	{
		parent::__construct('saisie-form');
		$this->setAttribute('method', 'post');

		$saisieHeureModel=new SaisieHeureModel;
		$this->fields=$saisieHeureModel->fields;
		$this->setInputFilter($saisieHeureModel->getInputFilter());

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
							// case 'ref_societe_client':
							// 	$c=new \Client\Entity\Client;
							// 	if($interlocuteur->getRefSocieteClient())
							// 	{
							// 		$c=$interlocuteur->getRefSocieteClient();
							// 		$codeClient=$c->getCodeClient();

							// 		$clients=$c->getClientsFromForms($sm,$codeClient,$c->getRaisonSociale());
							// 		if(is_array($clients)&&count($clients)>0)
							// 		{
							// 			foreach($clients as $client)
							// 			{
							// 				$options[]=array(
							// 					'value'=>$client['id'],
							// 					'label'=>$client['societe']
							// 				);
							// 			}
							// 		}
							// 		$element['attributes']['disabled']='disabled';
							// 	}
							// 	else
							// 	{
							// 		$clients=$c->getClientsFromForms($sm);
							// 		if(is_array($clients)&&count($clients)>0)
							// 		{
							// 			foreach($clients as $client)
							// 			{
							// 				$options[]=array(
							// 					'value'=>$client['id'],
							// 					'label'=>$client['societe']
							// 				);
							// 			}
							// 		}
							// 	}
							// break;
							// case 'code_client':
							// 	$c=new \Client\Entity\Client;
							// 	$codes=$c->getCodesClient($sm);
							// 	if(is_array($codes)&&count($codes)>0)
							// 	{
							// 		foreach($codes as $code)
							// 		{
							// 			$options[]=array(
							// 				'value'=>$code['code_client'],
							// 				'label'=>$code['code_client']
							// 			);
							// 			$options[0]['value']=0;
							// 			$options[0]['label']='['.$translator->translate('Pas de code').']';
							// 		}
							// 	}
							// 	if($interlocuteur->getRefSocieteClient())
							// 	{
							// 		$element['attributes']['disabled']='disabled';
							// 	}
							// break;
							// case 'ref_fonction':
							// 	$f=new \Application\Entity\FonctionInterlocuteur;
							// 	$fonctions=$em->getRepository('Application\Entity\FonctionInterlocuteur')->findAll();
							// 	if(is_array($fonctions)&&count($fonctions)>0)
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
			if( !is_null($interlocuteur) )
			{
				if($field=='code_client')
				{
					$value=$interlocuteur->getRefSocieteClient();
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
						$value=$interlocuteur->{'get'.$data['form']['getter']}();
					else
					{
						$tab=explode('_',$field);
						$method='';
						foreach($tab as $part)
						{
							$method.=ucfirst($part);
						}
						$property=lcfirst($method);
						if(property_exists($interlocuteur,$property))
						{
							$value=$interlocuteur->{'get'.$method}();
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