<?php
/**
 * @Author: Ophelie
 * @Date:   2015-07-21 13:16:19
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-08-10 14:26:47
 */

// module\Personnel\src\Personnel\Model\PersonnelModel.php

namespace Personnel\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class PersonnelModel implements InputFilterAwareInterface
{
	protected $inputFilter;

	public $fields = array(
		'id_personnel'				=>array('type'=>'int',				'form'=>array('type'=>'hidden','label'=>'','getter'=>'Id')),
		'nom'						=>array('type'=>'text','max'=>70,	'form'=>array('type'=>'text','required'=>true,'label'=>'Nom','static'=>true)),
		'prenom'					=>array('type'=>'text','max'=>70,	'form'=>array('type'=>'text','required'=>true,'label'=>'Prénom','static'=>true)),
		// 'ref_fonction'				=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>false,'label'=>'Fonction','static'=>true)),
		'taux_horaire'				=>array('type'=>'text','max'=>10,	'form'=>array('type'=>'text','required'=>false,'label'=>'Taux horaire','static'=>true)),
		'administrateur'			=>array('type'=>'bool',				'form'=>array('type'=>'checkbox','required'=>false,'label'=>'Administrateur du site')),
		'email'						=>array('type'=>'text','max'=>80,	'form'=>array('type'=>'text','required'=>true,'label'=>'Email','static'=>true)),
		//'mot_de_passe'				=>array('type'=>'text','max'=>100,	'form'=>array('type'=>'password','required'=>false,'label'=>'Mot de passe')),
		//'confirmation_mot_de_passe'	=>array('type'=>'text','max'=>100,	'form'=>array('type'=>'password','required'=>false,'label'=>'Confirmer le mot de passe')),
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