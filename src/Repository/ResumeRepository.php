<?php

namespace Repository;

use Entity\CustomBuild;
use Entity\Resume;
use Entity\User;

class ResumeRepository extends RepositoryAbstract
{
    public function getTable() {
        return 'resume';
    }
    
    /**
     * @return Resume
     */
    public function findAll()
    {
        $query = <<<EOS
SELECT *
FROM resume
ORDER BY id DESC
EOS;
        
        $dbResumes = $this->db->fetchAll($query);
        $resumes = [];
        
        foreach($dbResumes as $dbResume)
        {
            $resume = $this->buildFromArray($dbResume);
            $resumes[] = $resume;
        }
        
        return $resumes;
    }
    
    /**
     * @param int $id
     * @return Resume|null
     */
    public function find($id)
    {
        $query = <<<EOS
SELECT *
FROM resume
WHERE id = :id
EOS;
        
        $dbResume = $this->db->fetchAssoc(
            $query,
            [':id' => $id]
        );
        
        if(!empty($dbResume))
        {
            return $this->buildFromArray($dbResume);
        }
        
        return null;
    }
    
    /**
     * @param int $userId
     * @return Resume|null
     */
    public function findByUser($userId)
    {
        $query = <<<EOS
SELECT r.*
FROM resume r
JOIN user u On r.user_id = u.id
WHERE u.id = :id
EOS;
        
        $dbResume = $this->db->fetchAssoc(
            $query,
            [':id' => $userId]
        );
                
        if(!empty($dbResume))
        {
            return $this->buildFromArray($dbResume);
        }
       
        return null;
    }
    
    public function buildFromArray(array $dbResume)
    {
        $user = new User();
        
        $user
            ->setId($dbResume['user_id'])
        ;
        
        $resume = new Resume();
        
        $resume 
            ->setId($dbResume['id'])
            ->setReference($dbResume['reference'])
            ->setProfessionnalDomain($dbResume['professionnal_domain'])
            ->setDesiredjob($dbResume['desired_job'])
            ->setContractType($dbResume['contract_type'])
            ->setHobbies($dbResume['hobbies'])
            ->setUser($user)
        ;
        
        return $resume;
    }
    
    /*
     * Méthode pour insérer ou mettre à jour les infos de la table resume
     */
    public function save(Resume $resume)
    {
        $data = [
            'reference' => $resume->getReference(),
            'professionnal_domain' => $resume->getProfessionnalDomain(),
            'desired_job' => $resume->getDesiredJob(),
            'contract_type' => $resume->getContractType(),
            'hobbies' => $resume->getHobbies(),
            'user_id' => $resume->getUserId()
        ];

        $where = !empty($resume->getId())
            ? ['id' => $resume->getId()]
            : null
        ;

        $this->persist($data, $where);
    }

    public function findByJob($job,$idCompany, array $filters)
    {
        $query = <<<EOS
SELECT resume.*, study.*, favorites.id AS favorite, experience.job_name, experience.user_id, SUM(experience.year_of_experience) AS total_year_of_experience 
FROM resume 
JOIN experience ON experience.user_id = resume.user_id
JOIN study ON study.user_id = resume.user_id
LEFT JOIN favorites ON favorites.id_resume = resume.id AND favorites.id_company = $idCompany
WHERE resume.desired_job LIKE '%$job%' 
GROUP BY resume.user_id
EOS;
        
        $query .= implode(' ',$filters);
        //$query .= ' ORDER BY id DESC';
        
        $dbResumes = $this->db->fetchAll($query);
        $resumes = [];
        
        
        
        foreach($dbResumes as $dbResume)
        {
            $resume = $this->buildCustomResume($dbResume);
            $resumes[] = $resume;
        }
        
        
        return $resumes;
    }
    
    public function buildCustomResume(array $dbResults)
    {
        $customResume = new CustomBuild();
        
             
        $customResume
            ->setReference($dbResults['reference'])
            ->setProfessionnalDomain($dbResults['professionnal_domain'])
            ->setDesiredjob($dbResults['desired_job'])
            ->setContractType($dbResults['contract_type'])
            ->setYearOfExperience($dbResults['total_year_of_experience'])
            ->setName($dbResults['name'])
            ->setJobName($dbResults['job_name'])
            ->setFavorite($dbResults['favorite'])
        ;
        
        return $customResume;
    }
    
    public function delete($userId)
    {
        $this->db->delete('resume', ['user_id' => $userId]);
    }
    
    public function findByRef($ref)
    {
        
        $dbResume = $this->db->fetchAssoc('SELECT * FROM resume WHERE reference = :ref', [':ref' => $ref]);
        
         $resume =  $this->buildFromArray($dbResume);
        
        return  $resume;
    }
}
