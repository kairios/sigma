<?php
/**
 * @Author: Ophelie
 * @Date:   2015-05-26 12:06:52
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-07-27 11:09:16
 */

namespace Client\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class ClientModel implements InputFilterAwareInterface
{
	protected $inputFilter;

	public $hiddens=array(
		'id_client'							=>array('form'=>array('type'=>'hidden','label'=>'','getter'=>'Id')),
		'actif'								=>array('form'=>array('type'=>'hidden','label'=>'','getter'=>'Actif')),
		'supprime'							=>array('form'=>array('type'=>'hidden','label'=>'','getter'=>'Supprime')),
	);

	public $fields=array(
		// Champs du Client
		'code_client'						=>array('type'=>'text','max'=>10,	'form'=>array('type'=>'text','required'=>false,'label'=>'Code client','parent'=>'generalite')),
		'raison_sociale'					=>array('type'=>'text','max'=>80,	'form'=>array('type'=>'text','required'=>true,'label'=>'Raison sociale','parent'=>'generalite')),
		'date_creation'						=>array('type'=>'date',				'form'=>array('type'=>'date','required'=>false,'label'=>'Date création','parent'=>'generalite')),
		'effectif_salarie'					=>array('type'=>'text','max'=>50,	'form'=>array('type'=>'text','required'=>false,'label'=>'Effectif salarié','parent'=>'generalite')),
		'telephone'							=>array('type'=>'text','max'=>50,	'form'=>array('type'=>'text','required'=>false,'label'=>'Téléphone','parent'=>'coordonnees')),
		'fax'								=>array('type'=>'text','max'=>50,	'form'=>array('type'=>'text','required'=>false,'label'=>'Fax','parent'=>'coordonnees')),
		'site_web'							=>array('type'=>'text',				'form'=>array('type'=>'url','required'=>false,'label'=>'Site web','parent'=>'coordonnees')), // form valider email
		'email'								=>array('type'=>'text','max'=>50,	'form'=>array('type'=>'email','required'=>false,'label'=>'Email','parent'=>'coordonnees')),
		'entreprise_a_livrer'				=>array('type'=>'text',				'form'=>array('type'=>'textarea','required'=>false,'label'=>'Entreprise à livrer','parent'=>'autre')),
		'entreprise_a_facturer'				=>array('type'=>'text',				'form'=>array('type'=>'textarea','required'=>false,'label'=>'Entreprise à livrer','parent'=>'autre')),
		'numero_tva'						=>array('type'=>'text','max'=>25,	'form'=>array('type'=>'text','required'=>false,'label'=>'N°TVA','parent'=>'generalite')),
		'numero_siret'						=>array('type'=>'text','max'=>50,	'form'=>array('type'=>'text','required'=>false,'label'=>'N°Siret','parent'=>'generalite')),
		'numero_ape'						=>array('type'=>'text','max'=>10,	'form'=>array('type'=>'text','required'=>false,'label'=>'N°APE','parent'=>'generalite')),
		'ref_condition_reglement'			=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>false,'label'=>'Conditions de paiement','parent'=>'comptabilite')),
		'ref_mode_reglement'				=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>false,'label'=>'Mode de règlement','parent'=>'comptabilite')),
		'ref_type_segment'					=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>false,'label'=>'Type de segment','parent'=>'requete')),
		'segments'							=>array('type'=>'array', 			'form'=>array('type'=>'select','required'=>false,'label'=>'Segments','parent'=>'requete','attributes'=>array('multiple'=>'multiple'/*,'class'=>'chosen-select','data-placeholder'=>'Segments'*/))),
		'produits_finis'					=>array('type'=>'array', 			'form'=>array('type'=>'select','required'=>false,'label'=>'Produits finis','parent'=>'requete','attributes'=>array('multiple'=>'multiple'))),
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

			// Merger la validation des données des entités réccurentes ?
			// $inputFilter->merge(new \Application\Model\ConditionReglementModel);
			// $inputFilter->merge(new \Application\Model\ModeReglement);
			
			// Ou créer une validation de ces données propre au client ? => Form : combobox pour conserver les ID
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
						break;/*
					case 'date':
						$element['validators']=array(array('name'=>'Date','options'=>array('format'=>'dd/mm/yyyy')));
						break;*/
				}

				$inputFilter->add($element);
			}

			$this->inputFilter=$inputFilter;
		}

		return $this->inputFilter;
	}
}

?>