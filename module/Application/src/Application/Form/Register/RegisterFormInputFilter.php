<?php

namespace Application\Form\Register;

use Zend\InputFilter\InputFilter;

class RegisterFormInputFilter extends InputFilter {

    public function __construct()
    {
        $this->add(array(
            'name'     => 'first_name',
            'required' => true,
            'filters'  => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
            ),
        ));

        $this->add(array(
            'name'     => 'last_name',
            'required' => true,
            'filters'  => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
            ),
        ));

         $this->add(array(
            'name'     => 'email',
            'required' => true,
            'filters'  => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
            ),
        ));
        
        $this->add(array(
            'name'     => 'password',
            'required' => true,
            'filters'  => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
            ),
        ));

        $this->add(array(
            'name'       => 'confirm_password',
            'required'   => true,
            'filters'    => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
            ),
            'validators' => array(
                array(
                    'name'    => 'Identical',
                    'options' => array(
                        'token' => 'password',
                    ),
                ),
            ),
        ));
    }

}
