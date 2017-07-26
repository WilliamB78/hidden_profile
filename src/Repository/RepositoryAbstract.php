<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Repository;

use Doctrine\DBAL\Connection;

/**
 * Description of RepositoryAbstract
 *
 * @author Etudiant
 */
abstract class RepositoryAbstract {
    
    /**
     *
     * @var Connection (Doctrine DBAL)
     */
    protected $db;
    
    public function __construct(Connection $db){
        
        $this->db = $db;
    }
    
    
    /**
     * retourne le nom de la table que traite le repository
     * 
     * @return string
     */
    abstract public function getTable();
    
    
    /**
     * 
     * @param array $data
     * @param array $where
     */
    public function persist(array $data, array $where = null){
        
        if (empty($where)){
            
            $this->db->insert(
                $this->getTable(),
                $data);
        }else{
            $this->db->update(
                $this->getTable(),
                $data,
                $where);
        }
    }
    
}
