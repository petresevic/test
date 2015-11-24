<?php

namespace Application\Form\User;

use Zend\InputFilter\InputFilter;

class LoginFormInputFilter extends InputFilter {

    public function __construct()
    {
        $this->add(array(
            'name'       => 'username',
            'required'   => true,
            'filters'    => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            \Zend\Validator\NotEmpty::IS_EMPTY => 'Value is required',
                        ),
                    ),
                ),
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
    }

}
