<?php
/**
 * @Author: Ophelie
 * @Date:   2015-07-13 10:31:47
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-08-19 18:34:38
 */

// module\Affaire\src\Affaire\Model\LigneAffaireModel.php

namespace Affaire\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class LigneAffaireModel implements InputFilterAwareInterface
{
	protected $inputFilter;

	public $fields=array(
		// Champs de la ligne affaire
		'id_ligne_affaire'					=>array('type'=>'int',				'form'=>array('type'=>'hidden','label'=>'','getter'=>'Id')),
		'ref_affaire'						=>array('type'=>'int',				'form'=>array('type'=>'hidden','label'=>'','getter'=>'RefAffaire')),
		'prix_vente_details'				=>array('type'=>'text',				'form'=>array('type'=>'hidden','label'=>'','getter'=>'PrixVenteDetails')),
		'prix_achat_prevu'					=>array('type'=>'text',				'form'=>array('type'=>'hidden','label'=>'','getter'=>'PrixAchatPrevu')),
		'prix_achat_reel'					=>array('type'=>'text',				'form'=>array('type'=>'hidden','label'=>'','getter'=>'PrixAchatReel')),
		'code_produit'						=>array('type'=>'text','max'=>50,	'form'=>array('type'=>'text','required'=>false,'label'=>'Référence')),
		'intitule_ligne'					=>array('type'=>'text','max'=>120,	'form'=>array('type'=>'text','required'=>true,'label'=>'Description')),
		'quantite_prevue'					=>array('type'=>'int',				'form'=>array('type'=>'number','required'=>true,'label'=>'Qté')),
		'prix_unitaire_vente'				=>array('type'=>'float',			'form'=>array('type'=>'text','required'=>true,'label'=>'PU vente')),
		'prix_vente_prevu'					=>array('type'=>'float',			'form'=>array('type'=>'text','required'=>true,'label'=>'Total ligne')),
		'remarques'							=>array('type'=>'int',				'form'=>array('type'=>'textarea','required'=>false,'label'=>'Remarques')),
		'ref_facture'						=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>false,'label'=>'Facture')),
		'ref_confirmation_commande'			=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>false,'label'=>'Confirmation de commande')),
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
									'pattern'=>'/^[0-9]+([\.,][0-9]){0,1}$/',
									'messages'=>array(
										'regexNotMatch'=>'Vous devez entrer un décimal valide (0,5 ou 1.5...) [A CHANGER !!]'
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