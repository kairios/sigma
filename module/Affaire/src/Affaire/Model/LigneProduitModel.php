<?php
/**
 * @Author: Ophelie
 * @Date:   2015-07-13 10:31:47
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-08-21 16:23:56
 */

// module\Affaire\src\Affaire\Model\LigneProduitModel.php

namespace Affaire\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class LigneProduitModel implements InputFilterAwareInterface {

	protected $inputFilter;

	public $fields = array(

		// Champs de la ligne affaire
		'id_ligne_produit'					=>array('type'=>'int',				'form'=>array('type'=>'hidden','label'=>'','getter'=>'Id')),
		// 'ref_fournisseur'					=>array('type'=>'int',				'form'=>array('type'=>'hidden','label'=>'','getter'=>'RefFournisseur')),
		'ref_ligne_affaire'					=>array('type'=>'int',				'form'=>array('type'=>'hidden','label'=>'','getter'=>'RefLigneAffaire')),
		// 'ref_commande_fournisseur'			=>array('type'=>'int',				'form'=>array('type'=>'hidden','label'=>'','getter'=>'RefCommandeFournisseur')),
		// 'ref_produit_fournisseur_vente'		=>array('type'=>'int', 				'form'=>array('type'=>'hidden','label'=>'','getter'=>'RefProduitFournisseurVente')),
		'code_produit'						=>array('type'=>'text','max'=>50,	'form'=>array('type'=>'text','required'=>false,'label'=>'Référence')),
		'intitule_produit'					=>array('type'=>'text','max'=>120,	'form'=>array('type'=>'text','required'=>true,'label'=>'Description')),
		'reference_devis'					=>array('type'=>'text','max'=>50,	'form'=>array('type'=>'text','required'=>false,'label'=>'Ref. devis')),
		'reference_produit_fournisseur'		=>array('type'=>'text','max'=>50,	'form'=>array('type'=>'text','required'=>false,'label'=>'Ref. fourn. produit')),
		'quantite'							=>array('type'=>'int',				'form'=>array('type'=>'number','required'=>true,'label'=>'Qté')),
		'prix_achat'						=>array('type'=>'float',			'form'=>array('type'=>'text','required'=>true,'label'=>'PU achat')),
		'prix_vente'						=>array('type'=>'float',			'form'=>array('type'=>'text','required'=>true,'label'=>'PU vente')),
		'prix_total_achat'					=>array('type'=>'float',			'form'=>array('type'=>'text','required'=>true,'label'=>'Total achat')),
		'prix_total_vente'					=>array('type'=>'float',			'form'=>array('type'=>'text','required'=>true,'label'=>'Total vente')),
		'date_facturation'					=>array('type'=>'text',				'form'=>array('type'=>'text','required'=>true,'label'=>'Facturée le...')),
		'date_commande'						=>array('type'=>'text',				'form'=>array('type'=>'text','required'=>true,'label'=>'Commandée le...')),
		'imprevu'							=>array('type'=>'bool', 			'form'=>array('type'=>'checkbox','required'=>true,'label'=>'Imprévu')),
		'remarques'							=>array('type'=>'int',				'form'=>array('type'=>'textarea','required'=>false,'label'=>'Remarques')),
		'ref_poste'							=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>true,'label'=>'Poste de coût')),
	);

	public function setInputFilter(InputFilterInterface $inputFilter) {

		throw new \Exception("Not used");
	}

	public function getInputFilter() {

		if(!$this->inputFilter) {

			$inputFilter = new InputFilter;
		
			// Ou créer une validation de ces données propre au affaire
			$intFilters = array('name'=>'Int');
			// StripTags is used to remove unwanted HTML & StringStrim is used to remove unnecessary white spaces
			$textFilters = array(array('name'=>'StripTags'),array('name'=>'StringTrim'));

			foreach($this->fields as $field => $data) {

				$filters = $validators = null;
				$required = isset($data['form']['required']) ? $data['form']['required'] : false;

				$element = array(
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