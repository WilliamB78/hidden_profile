<?php

namespace Repository;

use Entity\Study;
use Entity\User;

class StudyRepository extends RepositoryAbstract
{
    public function getTable() {
        return 'study';
    }
    
    public function findByUser($userId)
    {
        $query = <<<EOS
SELECT s.*
FROM study s
JOIN user u On s.user_id = u.id
WHERE u.id = :id
EOS;
        
        $dbStudies = $this->db->fetchAll(
            $query,
            [':id' => $userId]
        );
        
        $studies = [];
        
        foreach($dbStudies as $dbStudy)
        {            
            $study = $this->buildFromArray($dbStudy);
            
            $studies[] = $study;
        }
       
        return $studies;
    }
    
    public function buildFromArray(array $dbStudy)
    {
        $user = new User();
        
        $user
            ->setId($dbStudy['user_id'])
        ;
        
        $study = new Study();
        
        $study
            ->setId($dbStudy['id'])
            ->setName($dbStudy['name'])
            ->setLevel($dbStudy['level'])
            ->setUser($user)
        ;
        
        return $study;
    }
    
    public function save(Study $study, $nb_of_studies)
    {
        for($i = 0; $i < $nb_of_studies; $i++)
        {
            $data = [
                'name' => $study->getName()[$i],
                'level' => $study->getLevel()[$i],
                'user_id' => $study->getUserId()
            ];

            $where = !empty($study->getId()[$i])
                ? ['id' => $study->getId()[$i]]
                : null
            ;

            $this->persist($data, $where);
        }
    }
    
    public function delete($userId)
    {
        $this->db->delete('study', ['user_id' => $userId]);
    }
    
    public function deleteByStudyId($studyId)
    {
        $this->db->delete('study', ['id' => $studyId]);
    }
}
