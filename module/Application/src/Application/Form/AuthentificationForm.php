<?php

// Module\Application\src\Application\Form\AuthentificationForm.php

/**
 * @Author: Ophelie
 * @Date:   2015-06-23 13:13:34
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-06-23 15:09:14
 */

namespace Application\Form;

use Zend\Form\Form;
use Application\Model\AuthentificationModel;
class AuthentificationForm extends Form
{
    public function __construct()
    {
        parent::__construct('authentification-form');
        $this->setAttribute('method','post');

        $authentificationModel=new AuthentificationModel();
		$this->setInputFilter($authentificationModel->getInputFilter());
        
        $this->add(array(
			'name' 			=> 'email',
			'attributes' 	=> array(
				'type' 			=>	'email',
				'placeholder'	=>  /*$translator->translate('Email')*/'Email',
				'class'			=>  'form-control',
				'required'		=>	'required',
			),
			'options' => array(
				'label' => 'Email',
			),
        ));
		
		$this->add(array(
			'name' 			=> 'mot_de_passe',
			'attributes' 	=> array(
				'type' 			=> 	'password',
				'placeholder'	=>	/*$translator->translate('Mot de passe')*/'Mot de passe',
				'class'			=>	'form-control',
				'required'		=>	'required',
			),
			'options' => array(
				'label' => 'Mot de passe',
			),
        ));

        $this->add(array(
			'name' => 'submit',
			'attributes' => array(
				'id' 	=> 	'authentification-form-submit',
				'type' 	=> 	'submit',
				'class'	=>	'btn btn-primary block full-width m-b',
				'value' => 	/*$translator->translate('Se connecter')*/'Se connecter',
			),
			'options'=>array(
				'label'=> 	/*$translator->translate('Se connecter')*/'Se connecter'
			)
        ));
    }
}

?>