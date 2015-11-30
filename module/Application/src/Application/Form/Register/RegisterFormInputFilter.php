<?php

namespace Application\Form\Register;

use Zend\InputFilter\InputFilter;

class RegisterFormInputFilter extends InputFilter {

    public function __construct()
    {
        $this->add(array(
            'name'     => 'username',
            'required' => true,
            'filters'  => array(
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
                        'pattern'  => '/^[a-zA-Z0-9@.]+$/',
                        'messages' => array(
                            \Zend\Validator\Regex::NOT_MATCH => 'Allowed charcters are a-z, A-Z, 0-9, . and @',
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
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'max'      => 20,
                        'min'      => 6,
                    ),
                ),
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

        $this->add(array(
            'name'     => 'email',
            'required' => true,
            'filters'  => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
            ),
            'validators' => array(
                array(
                    'name'    => 'EmailAddress',
                    'options' => array (
                        'messages' => array(
                            \Zend\Validator\EmailAddress::INVALID => 'Please specify a valid e-mail address',
                        ),
                    ),
                    'break_chain_on_failure' => true,
                ),
            ),
        ));

        $this->add(array(
            'name'     => 'first_name',
            'required' => true,
            'filters'  => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'max'      => 20,
                        'min'      => 2,
                    ),
                ),
            ),
        ));

        $this->add(array(
            'name'     => 'last_name',
            'required' => true,
            'filters'  => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'max'      => 20,
                        'min'      => 2,
                    ),
                ),
            ),
        ));
    }

}
