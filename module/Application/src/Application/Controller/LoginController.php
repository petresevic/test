<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class LoginController extends AbstractActionController
{
    protected $loginForm;
    protected $mpayManager;

    public function indexAction()
    {
        $this->layout('layout/login');

        $form = $this->getLoginForm();
        
        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                
                echo '<pre>';
                var_dump($data); exit;
                echo '</pre>';
            }
        }     
        
        return new ViewModel(array(
            'form' => $form,
        ));        
    }

    /** @return \Mpay\Service\Manager\Manager */
    public function getMpayManager()
    {
        if (null === $this->mpayManager) {
            $this->mpayManager = $this->getServiceLocator()->get('Mpay\Service\Manager');
        }

        return $this->mpayManager;
    }
    
    public function getLoginForm()
    {
        if (! $this->loginForm) {
            $this->loginForm = $this->getServiceLocator()->get('Application\Form\User\LoginForm');
        }

        return $this->loginForm;
    }    
}
