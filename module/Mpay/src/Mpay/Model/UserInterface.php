<?php

namespace Mpay\Model;

interface UserInterface
{
    const ROLE_WP    = 'wp';
    const ROLE_3U    = '3u';
    const ROLE_ADM   = 'Adm';
    const ROLE_CC    = 'CC';
    const ROLE_FM    = 'FM';
    const ROLE_AS    = 'AS';
    const ROLE_CRM   = 'CRM';
    const ROLE_A     = 'A';
    const ROLE_M     = 'M';
    const ROLE_S     = 'S';
    const ROLE_MTC   = 'MTC';
    const ROLE_DCARD = 'DCard';
    const ROLE_3VOMS = '3voms';
    const ROLE_UC    = 'UC';
    const ROLE_IN    = 'IN';
    const ROLE_FEE   = 'FEE';

    const STATUS_ACTIVE      = 'ACTIVE';
    const STATUS_LOCKED      = 'LOCKED';
    const STATUS_DEACTIVATED = 'DEACTIVATED';

    public function getId();
    public function setId($id);
    public function getUsername();
    public function setUsername($username);
    public function getRole();
    public function setRole($role);
    public function getStatus();
    public function setStatus($status);
    public function getFirstName();
    public function setFirstName($firstName);
    public function getLastName();
    public function setLastName($lastName);
    public function getEmail();
    public function setEmail($email);
}
