<?php

namespace Cpanel\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class McommerceController extends AbstractActionController {

    public function indexAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setVariables(array(
        ));

        return $viewModel;
    }

}
