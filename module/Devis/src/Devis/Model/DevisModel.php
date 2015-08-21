<?php
/**
 * @Author: Ophelie
 * @Date:   2015-08-20 11:19:12
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-08-21 11:52:50
 */

namespace Devis\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class DevisModel implements InputFilterAwareInterface
{
	protected $inputFilter;

	// Champs du devis
	public $fields=array(
		'id_devis'							=>array('type'=>'int',				'form'=>array('type'=>'hidden','label'=>'','getter'=>'Id')),
		'date_devis'						=>array('type'=>'int',				'form'=>array('type'=>'hidden','label'=>'','getter'=>'DateDevis')),
		'total_hors_port'					=>array('type'=>'text',				'form'=>array('type'=>'hidden','label'=>'','getter'=>'TotalHorsPort')),
		'total_avec_port'					=>array('type'=>'text',				'form'=>array('type'=>'hidden','label'=>'','getter'=>'TotalAvecPort')),
		'ref_affaire'						=>array('type'=>'int',				'form'=>array('type'=>'hidden','label'=>'','getter'=>'RefAffaire')),
		'code_devis'						=>array('type'=>'text',				'form'=>array('type'=>'text','required'=>true, 'label'=>'Code devis')),
		'version'							=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>true,'label'=>'Version')),
		'ref_personnel'						=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>true,'label'=>'Chargé d\'affaire')), // form valider email
		'numero_affaire'					=>array('type'=>'text',				'form'=>array('type'=>'select','required'=>false,'label'=>'Affaire')),
		'remise'							=>array('type'=>'float',			'form'=>array('type'=>'text','required'=>false,'label'=>'Remise')),
		'frais_port'						=>array('type'=>'float',			'form'=>array('type'=>'text','required'=>false,'label'=>'Frais de transport')),
		'delais_livraison'					=>array('type'=>'text','max'=>50,	'form'=>array('type'=>'select','required'=>false,'label'=>'Délais de livraison')),
		'duree_validite_prix'				=>array('type'=>'text','max'=>50,	'form'=>array('type'=>'text','required'=>true,'label'=>'Durée de validité devis')), // Fixé arbitrairement ici, mais devra dépendre d'une variable modifiable par l'administrateur
		'condition_reglement'				=>array('type'=>'text','max'=>60,	'form'=>array('type'=>'select','required'=>false,'label'=>'Conditions de paiement')),
		'date_envoi'						=>array('type'=>'text',				'form'=>array('type'=>'text','required'=>false,'label'=>'Envoyé le...')), // avec datepicker
		'date_signature'					=>array('type'=>'text',				'form'=>array('type'=>'text','required'=>false,'label'=>'Signé le...')), // avec datepicker
		'remarques'							=>array('type'=>'text',				'form'=>array('type'=>'textarea','required'=>false,'label'=>'Remarques'))
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
		
			// Ou créer une validation de ces données propre au affaire
			$intFilters=array('name'=>'Int');
			// StripTags is used to remove unwanted HTML & StringStrim is used to remove unnecessary white spaces
			$textFilters=array(array('name'=>'StripTags'),array('name'=>'StringTrim'));

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
					case 'float':
						$element['validators']=array(
							array(
								'name'=>'Regex',
								'options'=>array(
									'pattern'=>'/^[0-9]+([\.,][0-9]{1,2}){0,1}$/',
									'messages'=>array(
										'regexNotMatch'=>'Vous devez entrer un décimal valide (10, 10.0, 5,07...)'
									)
								)
							)
						);
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