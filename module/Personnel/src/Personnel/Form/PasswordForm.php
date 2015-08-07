<?php
/**
 * @Author: Ophelie
 * @Date:   2015-07-28 13:37:27
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-07-28 18:00:17
 */

// module\Personnel\src\Personnel\Form\PasswordForm.php

namespace Personnel\Form;

use Zend\Form\Form;
use Personnel\Model\PasswordModel;

class PasswordForm extends Form
{
	public function __construct($translator, $sm = null, $em = null, $request = null)
	{
		parent::__construct('password-form');
		$this->setAttribute('method', 'post');

		$passwordModel = new PasswordModel();
		$this->setInputFilter($passwordModel->getInputFilter());

		$this->add(array(
			'name' => 'id_personnel',
			'type' => 'Hidden'
		));

		$this->add(array(
			'name' => 'ancien_mot_de_passe',
			'type' => 'Password',
			'options' => array(
				'label' => $translator->translate('Précédent')
			)
		));

		$this->add(array(
			'name' => 'nouveau_mot_de_passe',
			'type' => 'Password',
			'options' => array(
				'label' => $translator->translate('Mot de passe')
			)
		));

		$this->add(array(
			'name' => 'confirmation_mot_de_passe',
			'type' => 'Password',
			'options' => array(
				'label' => $translator->translate('Confirmation')
			)
		));
	}
}

?>