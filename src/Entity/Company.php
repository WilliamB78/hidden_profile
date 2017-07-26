<?php


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



namespace Entity;


class Company 
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $siret;
    private $tvaNb;
    private $telephone;
    private $postcode;
    private $address;
    private $city;
    private $country;
    private $activityArea;
    private $employesNb;
    private $role = "temp";
    private $nbOfTokens;
    
    
    public function getNbOfTokens() {
        return $this->nbOfTokens;
    }

    public function setNbOfTokens($nbOfTokens) {
        $this->nbOfTokens = $nbOfTokens;
        return $this;
    }

        
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

        public function getSiret() {
        return $this->siret;
    }

    public function getTvaNb() {
        return $this->tvaNb;
    }

    public function getTelephone() {
        return $this->telephone;

    }

    public function getPostcode() {
        return $this->postcode;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getCity() {
        return $this->city;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getActivityArea() {
        return $this->activityArea;
    }

    public function getEmployesNb() {
        return $this->employesNb;
    }

    public function setSiret($siret) {
        $this->siret = $siret;
        return $this;
    }

    public function setTvaNb($tvaNb) {
        $this->tvaNb = $tvaNb;
        return $this;
    }


    public function setTelephone($telephone) {
        $this->telephone = $telephone;
        return $this;
    }

    public function setPostcode($postcode) {
        $this->postcode = $postcode;
        return $this;
    }

    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    public function setCity($city) {
        $this->city = $city;
        return $this;
    }

    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }

    public function setActivityArea($activityArea) {
        $this->activityArea = $activityArea;
        return $this;
    }

    public function setEmployesNb($employesNb) {
        $this->employesNb = $employesNb;
        return $this;
    }

        public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole() {
        return $this->role;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setRole($role) {
        $this->role = $role;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCompany()
    {
        return $this->role == 'company';
    }
    
    public function isTemp()
    {
        return $this->role == 'Temp';
    }

}
