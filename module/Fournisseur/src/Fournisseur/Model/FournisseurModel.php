<?php
/**
 * @Author: Ophelie
 * @Date:   2015-05-26 12:06:52
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-08-05 14:00:03
 */

namespace Fournisseur\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
// Autres entités du formulaire d'ajout fournisseur
use Adresse\Model\AdresseModel;

class FournisseurModel implements InputFilterAwareInterface
{
	protected $inputFilter;

	public $hiddens=array(
		'id_fournisseur'					=>array('form'=>array('type'=>'hidden','label'=>'','getter'=>'Id')),
		'actif'								=>array('form'=>array('type'=>'hidden','label'=>'','getter'=>'Actif')),
		'supprime'							=>array('form'=>array('type'=>'hidden','label'=>'','getter'=>'Supprime')),
	);

	public $fields=array(
		// Champs du fournisseur
		'code_fournisseur'					=>array('type'=>'text','max'=>10,	'form'=>array('type'=>'text','required'=>false,'label'=>'Code fournisseur','parent'=>'generalite')),
		'raison_sociale'					=>array('type'=>'text','max'=>80,	'form'=>array('type'=>'text','required'=>true,'label'=>'Raison sociale','parent'=>'generalite')),
		'ref_activite'						=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>false,'label'=>'Activité','parent'=>'generalite')),
		'ref_categorie'						=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>false,'label'=>'Catégorie','parent'=>'generalite')), // déprécié
		'telephone'							=>array('type'=>'text','max'=>50,	'form'=>array('type'=>'text','required'=>false,'label'=>'Téléphone','parent'=>'coordonnees')),
		'fax'								=>array('type'=>'text','max'=>50,	'form'=>array('type'=>'text','required'=>false,'label'=>'Fax','parent'=>'coordonnees')),
		'site_web'							=>array('type'=>'text',				'form'=>array('type'=>'url','required'=>false,'label'=>'Site web','parent'=>'coordonnees')), // form valider email
		'email'								=>array('type'=>'text','max'=>50,	'form'=>array('type'=>'email','required'=>false,'label'=>'Email','parent'=>'coordonnees')),
		'numero_tva'						=>array('type'=>'text','max'=>25,	'form'=>array('type'=>'text','required'=>false,'label'=>'N°TVA','parent'=>'generalite')),
		'numero_siret'						=>array('type'=>'text','max'=>50,	'form'=>array('type'=>'text','required'=>false,'label'=>'N°Siret','parent'=>'generalite')),
		'numero_ape'						=>array('type'=>'text','max'=>10,	'form'=>array('type'=>'text','required'=>false,'label'=>'N°APE','parent'=>'generalite')),
		'ref_condition_reglement'			=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>false,'label'=>'Conditions de paiement','parent'=>'comptabilite')),
		'ref_mode_reglement'				=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>false,'label'=>'Mode de règlement','parent'=>'comptabilite')),
		// 'ref_poste_par_defaut' 				=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>false,'label'=>'Poste de coût par défaut','parent'=>'comptabilite')),
		'code_client'						=>array('type'=>'text','max'=>30,	'form'=>array('type'=>'text','required'=>false,'label'=>'Code client Zeppelin','parent'=>'autre')),
	);

	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}

	public function getInputFilter()
	{
		if(!$this->inputFilter)
		{
			$inputFilter=new InputFilter;
		
			// Ou créer une validation de ces données propre au fournisseur
			$intFilters=array('name'=>'Int');
			$textFilters=array(array('name'=>'StripTags'),array('name'=>'StringTrim')); // StripTags is used to remove unwanted HTML & StringStrim is used to remove unnecessary white spaces

			foreach($this->fields as $field => $data)
			{
				$filters=$validators=null;
				$required=isset($data['form']['required']) ? $data['form']['required'] : false;

				$element=array(
					'name'=>$field,
					'required'=>$required,
				);

				if(isset($data['max']))
					$textValidator=array('name'=>'StringLength','options'=>array('encoding'=>'UTF-8','min'=>1,'max'=>$data['max']));
				else
					$textValidator=array('name'=>'StringLength','options'=>array('encoding'=>'UTF-8','min'=>1));

				switch($data['type'])
				{
					case 'int':
						$element['filters']=array($intFilters);
						break;
					case 'text' :
						$element['filters']=$textFilters;
						$element['validators']=array($textValidator);
						break;
				}

				$inputFilter->add($element);
			}

			$this->inputFilter=$inputFilter;
		}

		return $this->inputFilter;
	}
}

?>