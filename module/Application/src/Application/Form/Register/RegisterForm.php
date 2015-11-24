<?php

namespace Application\Form\Register;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Form\FormInterface;

class RegisterForm extends Form
{
    public function init()
    {
        $firstname = new Element\Text('first_name');
        $firstname->setAttribute('class', 'form-control');
        $firstname->setAttribute('placeholder', 'First Name');
        $this->add($firstname);
        
        $lastname = new Element\Text('last_name');
        $lastname->setAttribute('class', 'form-control');
        $lastname->setAttribute('placeholder', 'Last Name');
        $this->add($lastname);
        
        $email = new Element\Text('email');
        $email->setAttribute('class', 'form-control');
        $email->setAttribute('placeholder', 'Email');
        $this->add($email);

        $password = new Element\Password('password');
        $password->setAttribute('class', 'form-control');
        $password->setAttribute('placeholder', 'Password');
        $this->add($password);
        
        $confirm_password = new Element\Password('confirm_password');
        $confirm_password->setAttribute('class', 'form-control');
        $confirm_password->setAttribute('placeholder', 'Confirm Password');
        $this->add($confirm_password);
    }

    public function getData($flag = FormInterface::VALUES_AS_ARRAY)
    {
        return parent::getData($flag);
    }
}
