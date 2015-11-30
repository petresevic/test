<?php

namespace Application\Form\Register;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Form\FormInterface;

class RegisterForm extends Form
{
    public function init()
    {
        $username = new Element\Text('username');
        $username->setAttribute('class', 'form-control');
        $username->setAttribute('placeholder', 'Username');
        $username->setAttribute('required', true);
        $this->add($username);

        $password = new Element\Text('password');
        $password->setAttribute('class', 'form-control');
        $password->setAttribute('placeholder', 'Password');
        $password->setAttribute('required', true);
        $this->add($password);

        $confirmPassword = new Element\Text('confirm_password');
        $confirmPassword->setAttribute('class', 'form-control');
        $confirmPassword->setAttribute('placeholder', 'Confirm Password');
        $confirmPassword->setAttribute('required', true);
        $this->add($confirmPassword);

        $email = new Element\Email('email');
        $email->setAttribute('class', 'form-control');
        $email->setAttribute('placeholder', 'Email');
        $email->setAttribute('required', true);
        $this->add($email);

        $firstName = new Element\Text('first_name');
        $firstName->setAttribute('class', 'form-control');
        $firstName->setAttribute('placeholder', 'First Name');
        $firstName->setAttribute('required', true);
        $this->add($firstName);

        $lastName = new Element\Text('last_name');
        $lastName->setAttribute('class', 'form-control');
        $lastName->setAttribute('placeholder', 'Last Name');
        $lastName->setAttribute('required', true);
        $this->add($lastName);
    }

    public function getData($flag = FormInterface::VALUES_AS_ARRAY)
    {
        return parent::getData($flag);
    }
}
