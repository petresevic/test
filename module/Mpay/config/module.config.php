<?php

return array(
    'mpay' => array(
    ),
    'service_manager' => array(
        'factories' => array(
            'Mpay\Service\MpayManager' => 'Mpay\Service\MpayManager\MpayManagerFactory',
        ),
    ),
);
