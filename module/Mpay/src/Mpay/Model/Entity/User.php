<?php

namespace Mpay\Model\Entity;

class User
{
    protected $id;
    protected $username;
    protected $firtName;
    protected $lastName;
    protected $email;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getFirtName()
    {
        return $this->firtName;
    }

    public function setFirtName($firtName)
    {
        $this->firtName = $firtName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
}
