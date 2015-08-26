<?php
/**
 * @Author: Ophelie
 * @Date:   2015-08-10 16:49:34
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-08-21 12:52:06
 */

namespace FicheHeure\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class SaisieHeureJourneeModel implements InputFilterAwareInterface
{
	protected $inputFilter;

	public $fields=array(
		// Champs de la saisie par jour
		'id_saisie_horaire'			=>array('type'=>'int',				'form'=>array('type'=>'hidden','label'=>'','getter'=>'Id')),
		'ref_personnel'				=>array('type'=>'int',				'form'=>array('type'=>'hidden','label'=>'','getter'=>'RefPersonnel')),
		'date'						=>array('type'=>'text','max'=>15,	'form'=>array('type'=>'text','required'=>true,'label'=>'Date')),
		'heure_debut'				=>array('type'=>'text','max'=>15,	'form'=>array('type'=>'select','required'=>true,'label'=>'Heure de début')),
		'heure_fin'					=>array('type'=>'text','max'=>15,	'form'=>array('type'=>'select','required'=>true,'label'=>'Heure de fin')),
		'duree_pause'				=>array('type'=>'float',			'form'=>array('type'=>'text','required'=>true,'label'=>'Durée pause')),

		// Champs de la saisie par projet
		'ref_libelle'				=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>false,'label'=>'Action')),
		'ref_affaire'				=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>false,'label'=>'Projet')),
		'ref_poste'					=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>false,'label'=>'Poste')),
		'nb_heure'					=>array('type'=>'float',			'form'=>array('type'=>'text','required'=>true,'label'=>'Temps passé')),
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
			
			$intFilters=array('name'=>'Int');
			$textFilters=array(array('name'=>'StripTags'),array('name'=>'StringTrim')); // StripTags is used to remove unwanted HTML & StringStrim is used to remove unnecessary white spaces
			// $floatValidator=array(array('name'=>'IsFloat','options'=>array('locale'=>'de')));

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
						// $element['validators']=$floatValidator;
						$element['validators']=array(
							array(
								'name'=>'Regex',
								'options'=>array(
									'pattern'=>'/^[0-9]+([\.,][05]){0,1}$/',
									'messages'=>array(
										'regexNotMatch'=>'Vous devez entrer un décimal valide (0,5 ou 1.5...)'
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