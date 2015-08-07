<?php
/**
 * @Author: Ophelie
 * @Date:   2015-06-10 11:02:32
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-06-24 13:44:09
 */

namespace Client\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class InterlocuteurClientModel implements InputFilterAwareInterface
{
	protected $inputFilter;

	public $fields=array(
		// Champs de l'Interlocuteur
		'id_interlocuteur'			=>array('type'=>'int',				'form'=>array('type'=>'hidden','label'=>'','getter'=>'Id')),
		'titre_civilite'			=>array('type'=>'text','max'=>5,	'form'=>array('type'=>'select','required'=>true,'label'=>'Titre de civilité','static'=>true,'value_options'=>array('M.'=>'M.','Me.'=>'Me.'))),
		'prenom'					=>array('type'=>'text','max'=>200,	'form'=>array('type'=>'text','required'=>false,'label'=>'Prénom','static'=>true)),
		'nom'						=>array('type'=>'text','max'=>200,	'form'=>array('type'=>'text','required'=>true,'label'=>'Nom','static'=>true)),
		'code_client'				=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>false,'label'=>'Code client','static'=>true)),
		'ref_societe_client'		=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>true,'label'=>'Société','static'=>true)),
		'ref_fonction'				=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>false,'label'=>'Fonction')),
		'telephone'					=>array('type'=>'text','max'=>50,	'form'=>array('type'=>'text','required'=>false,'label'=>'Téléphone')),
		'portable'					=>array('type'=>'text','max'=>50,	'form'=>array('type'=>'text','required'=>false,'label'=>'Portable')),
		'fax'						=>array('type'=>'text','max'=>50,	'form'=>array('type'=>'text','required'=>false,'label'=>'Fax')),
		'email'						=>array('type'=>'text','max'=>50,	'form'=>array('type'=>'email','required'=>false,'label'=>'Email 1')),
		'email_2'					=>array('type'=>'text','max'=>50,	'form'=>array('type'=>'email','required'=>false,'label'=>'Email 2')), // form valider email
		'accepte_infos'				=>array('type'=>'bool',				'form'=>array('type'=>'checkbox','required'=>false,'label'=>'Accepte de recevoir des informations')),
		'envoi_vers_outlook'		=>array('type'=>'bool',				'form'=>array('type'=>'checkbox','required'=>false,'label'=>'Appartient au carnet d\'adresse Outlook')),
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