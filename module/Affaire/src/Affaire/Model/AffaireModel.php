<?php
/**
 * @Author: Ophelie
 * @Date:   2015-07-13 10:31:47
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-08-14 17:02:19
 */

namespace Affaire\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class AffaireModel implements InputFilterAwareInterface
{
	protected $inputFilter;

	public $fields=array(
		// Champs de l'affaire
		'id_affaire'						=>array('type'=>'int',				'form'=>array('type'=>'hidden','label'=>'','getter'=>'Id')),
		'numero_auto'						=>array('type'=>'int',				'form'=>array('type'=>'hidden','label'=>'','getter'=>'NumeroAuto')),
		'numero_affaire'					=>array('type'=>'text',				'form'=>array('type'=>'hidden','label'=>'','getter'=>'NumeroAffaire')),
		'ref_etat_affaire'					=>array('type'=>'int',				'form'=>array('type'=>'hidden','label'=>'','getter'=>'RefEtatAffaire')),
		'ref_centre_profit'					=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>true,'label'=>'Centre de profit','parent'=>'generalite')),
		'code_client'						=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>false,'label'=>'Code client','static'=>true)),
		'ref_client'						=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>true,'label'=>'Client','parent'=>'coordonnees')),
		'ref_interlocuteur'					=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>false,'label'=>'Interlocuteur','parent'=>'coordonnees')),
		'ref_personnel'						=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>true,'label'=>'Chargé d\'affaire','parent'=>'coordonnees')), // form valider email
		'ref_condition_reglement'			=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>false,'label'=>'Conditions de paiement','parent'=>'comptabilite')),
		'designation_affaire'				=>array('type'=>'text','max'=>150,	'form'=>array('type'=>'text','required'=>false,'label'=>'Désignation','parent'=>'generalite')),
		'exercice'							=>array('type'=>'int',				'form'=>array('type'=>'text','required'=>true,'label'=>'Exercice','parent'=>'generalite')),
		'demande_client'					=>array('type'=>'text',				'form'=>array('type'=>'textarea','required'=>false,'label'=>'Demande client','parent'=>'generalite')),
		'remise'							=>array('type'=>'float',			'form'=>array('type'=>'text','required'=>false,'label'=>'Remise','parent'=>'generalite')),
		'frais_port'						=>array('type'=>'float',			'form'=>array('type'=>'text','required'=>false,'label'=>'Frais de transport','parent'=>'generalite')),
		'reference_commande_client'			=>array('type'=>'text','max'=>70,	'form'=>array('type'=>'text','required'=>false,'label'=>'Référence commande client','parent'=>'generalite')),
		'reference_demande_prix'			=>array('type'=>'text','max'=>50,	'form'=>array('type'=>'text','required'=>false,'label'=>'Référence demande de prix','parent'=>'generalite')),
		'suivi_budget_actif'				=>array('type'=>'bool',				'form'=>array('type'=>'checkbox','required'=>false,'label'=>'Suivi de budget actif','parent'=>'generalite')),
		// 'numero_affaire'					=>array('type'=>'text','max'=>10,	'form'=>array('type'=>'text','required'=>false,'label'=>'Code fournisseur','parent'=>'generalite')), // Généré par Sigma grâce au numéro de centre de profit
		// 'date_fin'						=>array('type'=>'text',				'form'=>array('type'=>'text','required'=>false,'label'=>'Date de fin','parent'=>'generalite')),
		// 'raison_perte'					=>array('type'=>'text','max'=>150,	'form'=>array('type'=>'text','required'=>false,'label'=>'Activité','parent'=>'generalite')),
		// 'ref_concurrent'					=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>false,'label'=>'Activité','parent'=>'generalite')),
		// 'ref_devis_signe'				=>array('type'=>'int',				'form'=>array('type'=>'select','required'=>false,'label'=>'Activité','parent'=>'generalite')),
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