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
            'reference' => $favorite->getReference(),
            'desired_job' => $favorite->getJob()
        ];
        
         $where = !empty($favorite->getId())
            ? ['id' => $favorite->getId()]
            : null
        ;

        $this->persist($data, $where);
    }
    
    public function delete($id)
    {
        $this->db->delete('favorites', array('id' => $id));
        
        return 'Row deleted';
    }
    
    public function buildFromArray(array $dbFavorite)
    {
        $favorite = new Favorite();

        $favorite
                ->setId($dbFavorite['id'])
                ->setIdCompany($dbFavorite['id_company'])
                ->setIdResume($dbFavorite['id_resume'])
                ->setReference($dbFavorite['reference'])
                ->setDate($dbFavorite['date'])
                ->setJob($dbFavorite['desired_job'])
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
    
    public function findByIdCompanyAndIdResume($idCompany, $idResume)
    {
        $result = $this->db->fetchColumn(
                'SELECT id FROM favorites WHERE id_company = :idCompany AND id_resume = :idResume',
                [
                    'idCompany' => $idCompany,
                    'idResume' => $idResume
                ]);
        
        return $result;
    }
    
}

