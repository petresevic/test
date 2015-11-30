<?php

namespace Application\Form\User;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Form\FormInterface;

class LoginForm extends Form
{
    public function init()
    {
        $username = new Element\Text('username');
        $username->setAttribute('class', 'form-control');
        $username->setAttribute('placeholder', 'Username');
        //$username->setAttribute('required', true);
        $this->add($username);

        $password = new Element\Password('password');
        $password->setAttribute('class', 'form-control');
        $password->setAttribute('placeholder', 'Password');
        //$password->setAttribute('required', true);
        $this->add($password);
    }

    public function getData($flag = FormInterface::VALUES_AS_ARRAY)
    {
        return parent::getData($flag);
    }
}
