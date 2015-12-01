<?php

namespace Cpanel\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{
    protected $mpayManager;

    public function indexAction()
    {
        $userResult = $this->getMpayManager()->getConnector()->userSearch($this->getMpayManager()->getAccessToken());

        $viewModel = new ViewModel();
        $viewModel->setVariables(array(
            'users' => $userResult['data']['users'],
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
