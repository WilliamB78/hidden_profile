<?php


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



namespace Repository;

use Entity\Company;

class CompanyRepository extends RepositoryAbstract
{
    public function getTable()
    {
        return 'company';
    }
    
    public function save(Company $company)
    {
        $data = [
            'name' => $company->getName(),
            'email' => $company->getEmail(),
            'password' => $company->getPassword(),
            'siret' => $company->getSiret(),
            'tva_nb' => $company->getTvaNb(),
            'telephone' => $company->getTelephone(),
            'address' => $company->getAddress(),
            'postcode' => $company->getPostcode(),
            'city' => $company->getCity(),
            'country' => $company->getCountry(),
            'activity_area' => $company->getActivityArea(),
            'employes_nb' => $company->getEmployesNb(),
            'role' => $company->getRole(),
            'nb_of_tokens' => $company->getNbOfTokens()
        ];

        $where = !empty($company->getId())
            ? ['id' => $company->getId()]
            : null
        ;

        $this->persist($data, $where);
    }
    
      public function findByEmail($email)
    {
        $dbCompany = $this->db->fetchAssoc(
            'SELECT * FROM company WHERE email = :email',
            [':email' => $email]
        );

        if (!empty($dbCompany)) {
            return $this->buildFromArray($dbCompany);
        }

        return null;
    }

    
    public function buildFromArray(array $dbCompany)
    {
        $company = new Company();

        $company
            ->setId($dbCompany['id'])
            ->setName($dbCompany['name'])
            ->setEmail($dbCompany['email'])
            ->setPassword($dbCompany['password'])
            ->setSiret($dbCompany['siret'])
            ->setTvaNb($dbCompany['tva_nb'])
            ->setTelephone($dbCompany['telephone'])
            ->setAddress($dbCompany['address'])
            ->setPostcode($dbCompany['postcode'])
            ->setCity($dbCompany['city'])
            ->setCountry($dbCompany['country'])
            ->setActivityArea($dbCompany['activity_area'])
            ->setEmployesNb($dbCompany['employes_nb'])
            ->setRole($dbCompany['role'])
            ->setNbOfTokens($dbCompany['nb_of_tokens'])
        ;

        return $company;
    }

    public function nbOfTokens($id)
    {
        $dbTokens = $this->db->fetchColumn(
            'SELECT nb_of_tokens FROM company WHERE id = :id',
                [':id' => $id]);
        
        
            return $dbTokens;
    }
        
    public function saveTokens(Company $company, $nbOfTokens)
    {
        $data = ['nb_of_tokens' => $nbOfTokens];
        
        $where = ['id' => $company->getId()];
                
        $this->persist($data, $where);
    }
}

