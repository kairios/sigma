<?php
/**
 * @Author: Ophelie
 * @Date:   2015-08-10 16:49:15
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-08-11 17:01:18
 */

namespace FicheHeure\Form;

use Zend\Form\Form;
use FicheHeure\Model\SaisieHeureJourneeModel;
use FicheHeure\Entity\SaisieHeureProjet;
use Zend\I18n\Translator\Translator;

class SaisieHeureJourneeForm extends Form
{
	public $fields;

	public function __construct($translator,$sm,$em=null,$request=null,$saisieJournee=null)
	{
		parent::__construct('saisie-horaire-form');
		$this->setAttribute('method', 'post');

		$saisieHeureModel=new SaisieHeureJourneeModel;
		$this->fields=$saisieHeureModel->fields;
		$this->setInputFilter($saisieHeureModel->getInputFilter());

		$saisieHeureProjet = new SaisieHeureProjet;

		// Creation des champs du formulaire à partir des champs du modèle de la saisie d'heures
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
							case 'ref_poste':
								$p = new \Affaire\Entity\PosteCout;
								$postes = $p->getPostesCout($sm);
								if(is_array($postes)&&count($postes)>0)
								{
									foreach($postes as $poste)
									{
										$options[]=array(
											'value'=>$poste['id'],
											'label'=>$translator->translate($poste['intitule_poste'])
										);
									}
									// if($saisieHeure->getRefPoste())
									// {						
									// 	$element['attributes']['disabled']='disabled';
									// }
								}
							break;
							case 'ref_affaire':
								$p = new \Affaire\Entity\Affaire;
								$projets = $p->getNumerosAffaire($sm);
								if(is_array($projets)&&count($projets)>0)
								{
									foreach($projets as $projet)
									{
										$options[]=array(
											'value'=>$projet['id'],
											'label'=>$projet['numero_affaire']
										);
									}
									// if($saisieHeure->getRefAffaire())
									// {								
									// 	$element['attributes']['disabled']='disabled';
									// }
								}
							break;
							case 'ref_libelle':
								$libelles = $em->getRepository('FicheHeure\Entity\SaisieHeureLibelle')->findAll();
								if(is_array($libelles)&&count($libelles)>0)
								{
									foreach($libelles as $libelle)
									{
										$options[]=array(
											'value'=>$libelle->getId(),
											'label'=>$translator->translate($libelle->getIntituleLibelle())
										);
									}
								}
								$element['options']['empty_option']=$translator->translate('Projet');
							break;
							case 'heure_debut':
								for ($i = 8; $i<= 22; $i++) {
									$a = $i;
								    $options[]=array(
										'value'=>$a,
										'label'=>$a.'h'
									);
									$options[]=array(
										'value'=>$a+0.5,
										'label'=>$a.'h30'
									);
								}
							break;
							case 'heure_fin':
								for ($i = 8; $i<= 22; $i++) {
									$a = $i;
								    $options[]=array(
										'value'=>$a,
										'label'=>$a.'h'
									);
									$options[]=array(
										'value'=>$a+0.5,
										'label'=>$a.'h30'
									);
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

			$value = null;
			switch($field)
			{
				case 'id_saisie_horaire':
					$value = $saisieJournee->getId();
				break;
				case 'ref_personnel':
					$value = $saisieJournee->getRefPersonnel()->getId();
				break;
				case 'date':
					$value = $saisieJournee->getDate();
					$element['attributes']['readonly']='readonly';
				break;
				case 'heure_debut':
					$value = $saisieJournee->getHeureDebut();
				break;
				case 'heure_fin':
					$value = $saisieJournee->getHeureFin();
				break;
				case 'duree_pause':
					$value = $saisieJournee->getDureePause();
				break;
				// case 'ref_libelle':
				// break;
				// case 'ref_affaire':
				// break;
				// case 'ref_poste':
				// break;
				// case 'nb_heure':
				// break;
			}
			$element['attributes']['value'] = $value;
			
			$this->add($element);
		}

	}
}

?>