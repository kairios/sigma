<?php
/**
 * @Author: Ophelie
 * @Date:   2015-07-28 13:37:41
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-07-28 17:58:18
 */


// module\Personnel\src\Personnel\Model\PasswordModel.php

namespace Personnel\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class PasswordModel implements InputFilterAwareInterface
{
	protected $inputFilter;

	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}

	public function getInputFilter()
	{
		if(!$this->inputFilter)
		{
			$inputFilter = new InputFilter();
			
			$inputFilter->add(array(
				'name' => 'id_personnel',
				'required' => true,
				'filters' => array(
					array('name' => 'Int'),
				)
			));

			$inputFilter->add(array(
				'name' => 'ancien_mot_de_passe',
				'required' => true,
				'filters' => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name'=> 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min' => 8,
						)
					)
				)
			));

			$inputFilter->add(array(
				'name' => 'nouveau_mot_de_passe',
				'required' => true,
				'filters' => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name'=> 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min' => 8,
						)
					)
				)
			));

			$inputFilter->add(array(
				'name' => 'confirmation_mot_de_passe',
				'required' => true,
				'filters' => array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name'=> 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min' => 8,
						)
					)
				)
			));

			$this->inputFilter = $inputFilter;
		}

		return $this->inputFilter;
	}
}

?>