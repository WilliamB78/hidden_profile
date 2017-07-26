<?php

namespace Repository;

use Entity\Command;
use Entity\Company;
use Entity\Resume;

class CommandRepository extends RepositoryAbstract
{
    public function getTable()
    {
        return 'command';
    }
    
    public function findAll()
    {
        $dbCommands = $this->db->fetchAll(
                'SELECT * FROM command');
        
        $commands = [];
        
        foreach ($dbCommands as $dbCommand){
            $command = $this->buildFromArray($dbCommand);
            
            $commands[] = $command;
        }
        
        return $commands;
    }    public function findByCompany($companyId)
    {
        $query = <<<EOS
SELECT comm.*
FROM command comm
JOIN company comp On comm.company_id = comp.id
WHERE comp.id = :id
EOS;
        
        $dbCommand = $this->db->fetchAssoc(
            $query,
            [':id' => $companyId]
        );
                
        if(!empty($dbCommand))
        {
            return $this->buildFromArray($dbCommand);
        }
       
        return null;
    }
    
    
    public function buildFromArray(array $dbCommand)
    {
        $company = new Company();
        
        $company
            ->setId($dbCommand['company_id'])
        ;
        
        $resume = new Resume();
        
        $resume
            ->setId($dbCommand['resume_id'])
        ;
        
        $command = new Command();
        
        $command 
            ->setId($dbCommand['id'])
            ->setCompanyId($company)
            ->setResumeId($resume)
        ;
        
        return $command;
    }
    
    /*
     * Méthode pour insérer ou mettre à jour les infos de la table resume
     */
    public function save(Command $command)
    {
        $data = [
            'company_id' => $command->getCompanyId(),
            'resume_id' => $command->getResumeId()
        ];

        $where = !empty($command->getId())
            ? ['id' => $command->getId()]
            : null
        ;

        $this->persist($data, $where);
    }
}
