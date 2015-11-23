<?php

namespace Application\Form\User;

use Zend\InputFilter\InputFilter;

class LoginFormInputFilter extends InputFilter
{
    public function __construct()
    {
        $this->add(array(
            'name' => 'username',
            'required' => true,
            'filters' => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
            ),
        ));        
        
        $this->add(array(
            'name' => 'password',
            'required' => true,
            'filters' => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
            ),
        ));
    }
}
