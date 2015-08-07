<?php
/**
 * @Author: Ophelie
 * @Date:   2015-06-23 14:03:29
 * @Last Modified by:   Ophelie
 * @Last Modified time: 2015-06-23 14:08:53
 */

// module\Application\src\Application\Model\AuthentificationModel.php

namespace Application\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class AuthentificationModel implements InputFilterAwareInterface
{
    protected $inputFilter;
    
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }
    
    public function getInputFilter()
    {
        if( !$this->inputFilter )
		{
            $inputFilter=new InputFilter();
            
            $inputFilter->add(array(
                'name' 		=> 'email',
                'required' 	=> true,
                'filters' 	=> array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
                ),
                'validators' => array(
					array(
						'name' 		=> 'StringLength',
						'options'	=> array(
							'encoding' => 'UTF-8',
							'min' => 1,
							'max' => 80,
						),
					),
                ),
            ));
			
			$inputFilter->add(array(
                'name' 		=> 'mot_de_passe',
                'required' 	=> true,
                'filters' 	=> array(
					array('name' => 'StripTags'),
					array('name' => 'StringTrim'),
                ),
                'validators' => array(
					array(
						'name' 		=> 'StringLength',
						'options'	=> array(
							'encoding' => 'UTF-8',
							'min' => 1,
							'max' => 100,
						),
					),
                ),
            ));
            
            $this->inputFilter=$inputFilter;
        }
        return $this->inputFilter;
    }
    
}
