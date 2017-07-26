<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

/**
 * Description of Favorite
 *
 * @author wbute
 */
class Favorite {
    
    private $id;
    
    private $idResume;
    
    private $idCompany;
    
    private $reference;
    
    private $date;
    
    private $job;
    
    public function getJob() {
        return $this->job;
    }

    public function setJob($job) {
        $this->job = $job;
        return $this;
    }

        
    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
        return $this;
    }

        
    public function getReference() {
        return $this->reference;
    }

    public function setReference($reference) {
        $this->reference = $reference;
        return $this;
    }
    
    public function getIdResume() {
        return $this->idResume;
    }

    public function getIdCompany() {
        return $this->idCompany;
    }



    public function setIdResume($idResume) {
        $this->idResume = $idResume;
        return $this;
    }

    public function setIdCompany($idCompany) {
        $this->idCompany = $idCompany;
        return $this;
    }

   

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }


}
