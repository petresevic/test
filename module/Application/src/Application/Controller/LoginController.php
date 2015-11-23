<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class LoginController extends AbstractActionController
{
    protected $mpayManager;

    public function indexAction()
    {
        $this->layout('layout/login');
        
        $username = 'chicoo';
        $password = '000000';
        $result   = $this->getMpayManager()->login($username, $password);

        $viewModel = new ViewModel();
        $viewModel->setVariables(array(
            'result' => $result,
        ));

        return $viewModel;
    }

    /** @return \Mpay\Service\Manager\Manager */
    public function getMpayManager()
    {
        if (null === $this->mpayManager) {
            $this->mpayManager = $this->getServiceLocator()->get('Mpay\Service\Manager');
        }

        return $this->mpayManager;
    }
}
