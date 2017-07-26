<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Repository;

use Entity\Favorite;

/**
 * Description of Favorite
 *
 * @author wbute
 */
class FavoriteRepository extends RepositoryAbstract {
    
    public function getTable() 
    {
        return 'favorites';
    }
    
    public function save(Favorite $favorite)
    {
        $data = [
            'id_company' => $favorite->getIdCompany(),
            'id_resume' => $favorite->getIdResume(),
            'reference' => $favorite->getReference()
        ];
        
         $where = !empty($favorite->getId())
            ? ['id' => $favorite->getId()]
            : null
        ;

        $this->persist($data, $where);
    }
    
    public function delete()
    {
        
    }
    
    public function buildFromArray(array $dbFavorite)
    {
        $favorite = new Favorite();

        $favorite
                ->setId($dbFavorite['id'])
                ->setIdCompany($dbFavorite['id_company'])
                ->setReference($dbFavorite['reference'])
                ->setIdResume($dbFavorite['id_resume'])
        ;

        return $favorite;
    }
    
    public function findByIdCompany($idCompany)
    {
        $dbFavorites = $this->db->fetchAll('SELECT * FROM favorites WHERE id_company = :idCompany', [':idCompany' => $idCompany]);
        
        $favoris = [];
        
        foreach ($dbFavorites as $dbFavori) {
            
            $favori = $this->buildFromArray($dbFavori);
            
            $favoris [] = $favori;
        }
        
        
        return $favoris;
       
    }

}

