<?php
/**
 * @Author: Ophelie
 * @Date:   2015-05-27 12:33:31
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-06-16 18:35:06
 */

namespace Adresse\Model;

use Zend\InputFilter\InputFilter;

class AdresseModel extends InputFilter
{
	public $fields=array(
		// Champs de l'Adresse
		'id_adresse'						=>array('form'=>array('type'=>'hidden','label'=>'','getter'=>'Id')),
		'ref_client'						=>array('form'=>array('type'=>'hidden','label'=>'','getter'=>'RefClient')),
		'ref_fournisseur'					=>array('form'=>array('type'=>'hidden','label'=>'','getter'=>'RefFournisseur')),
		'rue1'								=>array('type'=>'text','max'=>80,	'form'=>array('type'=>'text','required'=>true,'label'=>'Rue 1')),
		'rue2'								=>array('type'=>'text','max'=>80,	'form'=>array('type'=>'text','required'=>false,'label'=>'Rue 2')),
		'rue3'								=>array('type'=>'text','max'=>80,	'form'=>array('type'=>'text','required'=>false,'label'=>'Rue 3')),
		'code_postal'						=>array('type'=>'text','max'=>10,	'form'=>array('type'=>'text','required'=>true,'label'=>'Code postal','attributes'=>array('data-aria-autocomplete'=>'list','data-aria-haspopup'=>'true'))),
		'ville'								=>array('type'=>'text','max'=>80,	'form'=>array('type'=>'text','required'=>true,'label'=>'Ville','attributes'=>array('data-aria-autocomplete'=>'list','data-aria-haspopup'=>'true'))),
		'pays'								=>array('type'=>'text','max'=>20,	'form'=>array('type'=>'text','required'=>true,'label'=>'Pays')),
		/*
		'adresse_principale'				=>array('type'=>'bool',				'form'=>array('type'=>'checkbox','required'=>false,'value'=>true,'label'=>'Principale','static'=>true)),
		'adresse_facturation'				=>array('type'=>'bool',				'form'=>array('type'=>'checkbox','required'=>false,'value'=>false,'label'=>'Facturation','static'=>true)),
		'adresse_livraison'					=>array('type'=>'bool',				'form'=>array('type'=>'checkbox','required'=>false,'value'=>false,'label'=>'Livraison','static'=>true)),
		'adresse_postale'					=>array('type'=>'bool',				'form'=>array('type'=>'checkbox','required'=>false,'value'=>false,'label'=>'Postale','static'=>true)),
		*/
		'type_adresse'						=>array('form'=>array(
																	'type'=>'multicheckbox',
																	'label'=>'Type d\'adresse',
																	'value_options'=>array(
																								'principale'=>array(
																									'value'=>'adresse_principale',
																									'label'=>'Principale',
																									'selected'=>false
																								),
																								'facturation'=>array(
																									'value'=>'adresse_facturation',
																									'label'=>'Facturation',
																									'selected'=>false
																								),
																								'livraison'=>array(
																									'value'=>'adresse_livraison',
																									'label'=>'Livraison',
																									'selected'=>false
																								),
																								'postale'=>array(
																									'value'=>'adresse_postale',
																									'label'=>'Postale',
																									'selected'=>false
																								),
																							),
													)),
	);

	public function __construct()
	{
		$this->add(array(
			'name'=>'id_adresse',
			'required'=>true,
			'filters'=>array(
				array('name'=>'int'),
			),
		));

		$this->add(array(
			'name'=>'rue1',
			'required'=>true,
			'filters'=>array(
				array('name'=>'StripTags'),
				array('name'=>'StringTrim'),
			),
			'validators'=>array(
				array(
					'name'=>'StringLength',
					'options'=>array(
						'encoding'=>'UTF-8',
						'max'=>80,
					)
				)
			)
		));

		$this->add(array(
			'name'=>'rue2',
			'required'=>false,
			'filters'=>array(
				array('name'=>'StripTags'),
				array('name'=>'StringTrim'),
			),
			'validators'=>array(
				array(
					'name'=>'StringLength',
					'options'=>array(
						'encoding'=>'UTF-8',
						'max'=>80,
					)
				)
			)
		));

		$this->add(array(
			'name'=>'rue3',
			'required'=>false,
			'filters'=>array(
				array('name'=>'StripTags'),
				array('name'=>'StringTrim'),
			),
			'validators'=>array(
				array(
					'name'=>'StringLength',
					'options'=>array(
						'encoding'=>'UTF-8',
						'max'=>80,
					)
				)
			)
		));

		$this->add(array(
			'name'=>'code_postal',
			'required'=>true,
			'filters'=>array(
			),
			'validators'=>array(
				array(
					'name'=>'StringLength',
					'options'=>array(
						'encoding'=>'UTF-8',
						'max'=>10,
					)
				)
			)
		));

		$this->add(array(
			'name'=>'ville',
			'required'=>true,
			'filters'=>array(
				array('name'=>'StripTags'),
				array('name'=>'StringTrim'),
			),
			'validators'=>array(
				array(
					'name'=>'StringLength',
					'options'=>array(
						'encoding'=>'UTF-8',
						'max'=>80,
					)
				)
			)
		));

		$this->add(array(
			'name'=>'pays',
			'required'=>true,
			'filters'=>array(
				array('name'=>'StripTags'),
				array('name'=>'StringTrim'),
			),
			'validators'=>array(
				array(
					'name'=>'StringLength',
					'options'=>array(
						'encoding'=>'UTF-8',
						'max'=>20,
					)
				)
			)
		));
	}
}