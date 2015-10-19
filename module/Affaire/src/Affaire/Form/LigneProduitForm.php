<?php
/**
 * @Author: Ophelie
 * @Date:   2015-07-13 10:30:54
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-08-21 17:17:19
 */

namespace Affaire\Form;

use Zend\Form\Form;
use Affaire\Model\LigneProduitModel;


class LigneProduitForm extends Form {

	public $fields;

	public function __construct($translator, $sm, $em=null, $request=null, $ligneProduit=null) {

		parent::__construct('ligne-produit-form');
		$this->setAttribute('method', 'post');

		$ligneModel = new LigneProduitModel();

		$this->fields = $ligneModel->fields;
		$this->setInputFilter($ligneModel->getInputFilter());

		// Creation des champs du formulaire à partir des champs du modèle de l'affaire
		foreach($this->fields as $field => $data) {

			$value = $type = $label = $required = '';
			$value_options=array();

			if(isset($data['form']['label'])) {

				$label=$translator->translate($data['form']['label']);
			}
			if(isset($data['form']['required']) && $data['form']['required'] == true) {
				
				$required='required';
			}

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
			switch($data['form']['type']) {

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

					if(!isset($data['form']['required']) || $data['form']['required'] == false)
						$element['options']['disable_inarray_validator'] = true; // Permet de préciser que si null est envoyé au form alors qu'il n'est pas dans le tableau des possiblités, on désactive le validateur afin qu'il ne crie pas
					if(isset($data['form']['value_options']))
						$element['options']['value_options']=$data['form']['value_options'];
					else {

						$options = array();

						switch($field) {

							case 'ref_fournisseur':
								$f = new \Fournisseur\Entity\Fournisseur;
								$four = $f->getId($sm);

								if(is_array($four) && count($four) > 0) {

									foreach($four as $un_fournisseur) {

										$options[] = array(
											'value'=>$un_fournisseur['id'],
											'label'=>$translator->translate($un_fournisseur['raison_sociale'])
										);
									}
								}
							break;

							case 'ref_fournisseur':
								$f = new \Fournisseur\Entity\Fournisseur;
								$four = $f->getId($sm);

								if(is_array($four) && count($four) > 0) {

									foreach($four as $un_fournisseur) {

										$options[] = array(
											'value'=>$un_fournisseur['id'],
											'label'=>$translator->translate($un_fournisseur['raison_sociale'])
										);
									}
								}
							break;
						}

						$element['options']['value_options']=$options;
					}
				break;

				default:
					$element['attributes']['type'] = $data['form']['type'];
					$element['attributes']['class'] .= ' form-control input-sm';
					$element['attributes']['placeholder'] = $label;
				break;
			}

			if(!is_null($ligneProduit)) {

				if($data['form']['type'] == 'hidden') {

					$value = $ligneProduit->{ 'get'.$data['form']['getter'] }();
				}
				else {

					$tab = explode('_',$field);
					$method = '';

					foreach($tab as $part) {

						$method .= ucfirst($part);
					}

					$property = lcfirst($method);

					if(property_exists($ligneProduit,$property)) {

						$value = $ligneProduit->{'get'.$method}();
					}
				}

				if(is_object($value)) {

					$element['attributes']['value'] = $value->getId();
				}
				else {

					$element['attributes']['value'] = $value;
				}
			}

			$this->add($element);
		}

		$this->add(array(
			
			'name'=>'submit',
			'type'=>'Submit',
			'attributes'=>array(
				'id'=>'ligne-affaire-submit-button',
				'type'=>'submit',
				'class'=>'btn btn-primary pull-right',
				'value'=>$translator->translate('Valider')
			),
			'options'=>array(
				'label'=>$translator->translate('Valider')
			)
		));
	}




	public function getMessages() {

		return 'toto';
	}
}

?>