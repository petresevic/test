<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RegisterController extends AbstractActionController
{
    protected $mpayManager;
    protected $registerForm;

    public function indexAction()
    {
        $this->layout('layout/login');

        $form = $this->getRegisterForm();

        if ($this->getRequest()->isPost()) {
            $postValues = $this->getRequest()->getPost();
            $form->setData($postValues);

            if ($form->isValid()) {
                $data           = $form->getData();
                $registerResult = $this->getMpayManager()->getConnector()->userRegister($data);

                if ($registerResult['success']) {
                    //$activateResult = $this->getMpayManager()->getConnector()->userSetStatus($data['username']);

                    //echo '<pre>'; var_dump($activateResult); exit;
                } else {
                    foreach ($registerResult['error'] as $element => $message) {
                        $form->get($element)->setMessages(array($message));
                    }
                }
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

    public function getRegisterForm()
    {
        if (! $this->registerForm) {
            $this->registerForm = $this->getServiceLocator()->get('Application\Form\Register\RegisterForm');
        }

        return $this->registerForm;
    }
}
