<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

/**
 * Description of Order
 *
 * @author wbute
 */
class Order {
    
    private $id;
    private $idCompany;
    private $amount;
    private $nbOfTokens;
    private $orderDate;
    private $status;
    
    public function getId() {
        return $this->id;
    }

    public function getIdCompany() {
        return $this->idCompany;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function getNbOfTokens() {
        return $this->nbOfTokens;
    }

    public function getOrderDate() {
        return $this->orderDate;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setIdCompany($idCompany) {
        $this->idCompany = $idCompany;
        return $this;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
        return $this;
    }

    public function setNbOfTokens($nbOfTokens) {
        $this->nbOfTokens = $nbOfTokens;
        return $this;
    }

    public function setOrderDate($orderDate) {
        $this->orderDate = $orderDate;
        return $this;
    }

    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }


}
