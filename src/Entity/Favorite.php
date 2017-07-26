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
    
    public function getIdResume() {
        return $this->idResume;
    }

    public function getIdCompany() {
        return $this->idCompany;
    }

    public function getReference() {
        return $this->reference;
    }

    public function setIdResume($idResume) {
        $this->idResume = $idResume;
        return $this;
    }

    public function setIdCompany($idCompany) {
        $this->idCompany = $idCompany;
        return $this;
    }

    public function setReference($reference) {
        $this->reference = $reference;
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
