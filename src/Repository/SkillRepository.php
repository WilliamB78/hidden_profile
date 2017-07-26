<?php

namespace Repository;

use Entity\Skill;
use Entity\User;

class SkillRepository extends RepositoryAbstract
{
    public function getTable() {
        return 'skill';
    }
    
    public function findByUser($userId)
    {
        $query = <<<EOS
SELECT s.*
FROM skill s
JOIN user u On s.user_id = u.id
WHERE u.id = :id
EOS;
        
        $dbSkill = $this->db->fetchAssoc(
            $query,
            [':id' => $userId]
        );
                
        if(!empty($dbSkill))
        {            
            return $this->buildFromArray($dbSkill);
        }
       
        return null;
    }
    
    public function buildFromArray(array $dbSkill)
    {
        $user = new User();
        
        $user
            ->setId($dbSkill['user_id'])
        ;
        
        $skill = new Skill();
        
        $skill
            ->setId($dbSkill['id'])
            ->setSkills($dbSkill['skills'])
            ->setInformatique($dbSkill['informatique'])
            ->setUser($user)
        ;
        
        return $skill;
    }
    
    public function save(Skill $skill)
    {
        $data = [
            'skills' => $skill->getSkills(),
            'informatique' => $skill->getInformatique(),
            'user_id' => $skill->getUserId()
        ];

        $where = !empty($skill->getId())
            ? ['id' => $skill->getId()]
            : null
        ;

        $this->persist($data, $where);
    }
    
    public function delete($userId)
    {
        $this->db->delete('skill', ['user_id' => $userId]);
    }
}
