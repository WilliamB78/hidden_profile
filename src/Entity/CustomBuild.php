<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

/**
 * Description of CustomBuild
 *
 * @author wbute
 */
class CustomBuild {
    
    /**
     * @var string
     */
    private $professionnalDomain;
    
        /**
     * @var string
     */
    private $desiredJob;
    
        /**
     * @var string
     */
    private $contractType;
    
        /**
     * @var string
     */
    private $yearOfExperience;
    
        /**
     * @var string
     */
    private $jobName;
    
        /**
     * @var string
     */
    private $name;
    
        /**
     * @var string
     */
    private $reference;
    
    private $favorite;
    
    function getFavorite() {
        return $this->favorite;
    }

    function setFavorite($favorite) {
        $this->favorite = $favorite;
    }

        
    public function getReference() {
        return $this->reference;
    }

    public function setReference($reference) {
        $this->reference = $reference;
        return $this;
    }

        
    public function getProfessionnalDomain() {
        return $this->professionnalDomain;
    }

    public function getDesiredJob() {
        return $this->desiredJob;
    }

    public function getContractType() {
        return $this->contractType;
    }

    public function getYearOfExperience() {
        return $this->yearOfExperience;
    }

    public function getJobName() {
        return $this->jobName;
    }

    public function getName() {
        return $this->name;
    }

    public function setProfessionnalDomain($professionnalDomain) {
        $this->professionnalDomain = $professionnalDomain;
        return $this;
    }

    public function setDesiredJob($desiredJob) {
        $this->desiredJob = $desiredJob;
        return $this;
    }

    public function setContractType($contractType) {
        $this->contractType = $contractType;
        return $this;
    }

    public function setYearOfExperience($yearOfExperience) {
        $this->yearOfExperience = $yearOfExperience;
        return $this;
    }

    public function setJobName($jobName) {
        $this->jobName = $jobName;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }


}
