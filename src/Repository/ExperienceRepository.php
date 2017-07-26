<?php

namespace Repository;

use Entity\Experience;
use Entity\User;

class ExperienceRepository extends RepositoryAbstract
{
    public function getTable() {
        return 'experience';
    }
    
    public function findByUser($userId)
    {
        $query = <<<EOS
SELECT e.*
FROM experience e
JOIN user u On e.user_id = u.id
WHERE u.id = :id
GROUP BY e.id
EOS;
        
        $dbExperiences = $this->db->fetchAll(
            $query,
            [':id' => $userId]
        );

        $experiences = [];
        
        foreach($dbExperiences as $dbExperience)
        {
            $experience = $this->buildFromArray($dbExperience);
            
            $experiences[] = $experience;
        }
       
        return $experiences;
    }
    
    public function buildFromArray(array $dbExperience)
    {
        $user = new User();
        
        $user
            ->setId($dbExperience['user_id'])
        ;
        
        $experience = new Experience();
        
        $experience
            ->setId($dbExperience['id'])
            ->setJobName($dbExperience['job_name'])
            ->setCompanies($dbExperience['companies'])
            ->setDescription($dbExperience['description'])
            ->setYearOfExperience($dbExperience['year_of_experience'])
            ->setUser($user)
        ;
        
        return $experience;
    }
    
    public function save(Experience $experience, $nb_of_experiences)
    {
        for($i = 0; $i < $nb_of_experiences; $i++)
        {
            $data = [
                'job_name' => $experience->getJobName()[$i],
                'companies' => $experience->getCompanies()[$i],
                'description' => $experience->getDescription()[$i],
                'year_of_experience' => $experience->getYearOfExperience()[$i],
                'user_id' => $experience->getUserId()
            ];
        
            $where
                    = !empty($experience->getId()[$i])
                ? ['id' => $experience->getId()[$i]]
                : null
            ;

            $this->persist($data, $where);
        }
    }
    
    public function delete($userId)
    {
        $this->db->delete('experience', ['user_id' => $userId]);
    }
    
    public function deleteByExperienceId($experienceId)
    {
        $this->db->delete('experience', ['id' => $experienceId]);
    }
}
