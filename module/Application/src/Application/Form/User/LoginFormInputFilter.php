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
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'max'      => 20,
                        'min'      => 6,
                    ),
                ),
                array(
                    'name' => 'Regex',
                    'options' => array(
                        'pattern'  => '/^[a-zA-Z0-9@._\-]+$/',
                        'messages' => array(
                            \Zend\Validator\Regex::NOT_MATCH => 'Allowed characters are a-z, A-Z, 0-9, dot, underscore, middlescore, and @',
                        )
                    ),
                    'break_chain_on_failure' => true
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
