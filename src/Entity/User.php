<?php

namespace Entity;

use DateTime;

class User 
{
    /**
     * @var int 
     */
    private $id;
    
    /**
     * @var string 
     */
    private $firstname;
    
    /**
     * @var string 
     */
    private $lastname;
    
    /**
     * @var string 
     */
    private $email;
    
    /**
     * @var string
     */
    private $password;
    
    /**
     * @var string
     */
    private $role = 'user';
    
    /**
     * @var int 
     */
    private $postcode;
    
    /**
     * @var string 
     */
    private $registerDate;
    
    /**
     * @var int 
     */
    private $telephone;
    
    public function __construct() {
        $this->registerDate = new DateTime();
    }
    
    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstname() {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }
    
    /**
     * @return string
     */
    public function getRole() {
        return $this->role;
    }

    /**
     * @return int
     */
    public function getTelephone() {
        return $this->telephone;
    }
    
    /**
     * @return int
     */
    public function getPostcode() {
        return $this->postcode;
    }

    /**
     * @return string
     */
    public function getRegisterDate() {
        return $this->registerDate;
    }
    
    /* SETTERS */
    
    /**
     * @param int $id
     * @return User
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $firstname
     * @return string
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }
    
    /**
     * @param string $role
     * @return User
     */
    public function setRole($role) {
        $this->role = $role;
        return $this;
    }

    /**
     * @param int $telephone
     * @return User
     */
    public function setTelephone($telephone) {
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * @param int $postcode
     * @return User
     */
    public function setPostcode($postcode) {
        $this->postcode = $postcode;
        return $this;
    }

    /**
     * @param DateTime $registerDate
     * @return User
     */
    public function setRegisterDate(DateTime $registerDate) {
        $this->registerDate = $registerDate;
        return $this;
    }

     /**
     * @return string
     */
    public function getFullName()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    /**
     * @return bool
     */
    public function isUser()
    {
        return $this->role == 'user';
    }
}
