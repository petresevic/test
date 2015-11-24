<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RegisterController extends AbstractActionController {

    protected $registerForm;
    
    public function indexAction()
    {
        $this->layout('layout/login');

        $form = $this->getRegisterForm();

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            if ($form->isValid()) {
                $data = $form->getData();

                echo '<pre>';
                var_dump($data);
                exit;
                echo '</pre>';
            }
        }

        return new ViewModel(array(
            'form' => $form,
        ));
    }
    
    public function getRegisterForm()
    {
        if (! $this->registerForm) {
            $this->registerForm = $this->getServiceLocator()->get('Application\Form\Register\RegisterForm');
        }

        return $this->registerForm;
    }    
}
