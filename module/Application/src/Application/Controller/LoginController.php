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
        if ($this->getMpayManager()->getAccessToken()) return $this->redirect()->toRoute('cpanel');

        $form  = $this->getLoginForm();
        $error = null;

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            if ($form->isValid()) {
                $data        = $form->getData();
                $accessToken = $this->getMpayManager()->getConnector()->userLogin($data['username'], $data['password']);
                if ($accessToken) {
                    $user = $this->getMpayManager()->getConnector()->userProfile($data['username'], $accessToken);
                    if ($user && $user->getId()) {
                        $this->getMpayManager()->userLogin($user, $accessToken);

                        $url = $this->getRequest()->getHeader('Referer')->getUri();

                        return (substr($url, -5) == 'login') ? $this->redirect()->toRoute('cpanel') : $this->redirect()->toUrl($url);
                    } else {
                        $error = 'Internal server error';
                    }
                } else {
                    $error = 'Invalid username / password';
                }
            }
        }

        $this->layout('layout/login');

        return new ViewModel(array(
            'form'  => $form,
            'error' => $error,
        ));
    }

    public function logoutAction()
    {
        $this->getMpayManager()->userLogout();

        return $this->redirect()->toRoute('home');
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
