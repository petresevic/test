<?php

namespace Cpanel\Service;

use Zend\Navigation\Service\AbstractNavigationFactory;

class NavigationFactory extends AbstractNavigationFactory
{
    protected function getName()
    {
        return 'cpanel';
    }
}
