<?php

namespace Repository;

use Entity\User;

class UserRepository extends RepositoryAbstract 
{
    public function getTable()
    {
        return 'user';
    }
    
     public function save(User $user)
    {
        $data = [
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'email' => $user->getEmail(),
            'postcode' => $user->getPostcode(),
            'telephone' => $user->getTelephone(),
            'register_date' => $user->getRegisterDate()->format('Y-m-d H:i:s'),
            'password' => $user->getPassword(),
            'role' => $user->getRole()
        ];

        $where = !empty($user->getId())
            ? ['id' => $user->getId()]
            : null
        ;

        $this->persist($data, $where);
    }
    
    /**
     * @param int $id
     * @return User|null
     */
    public function find($id)
    {
        $query = <<<EOS
SELECT *
FROM user
WHERE id = :id
EOS;
        
        $dbUser = $this->db->fetchAssoc(
            $query,
            [':id' => $id]
        );
        
        if(!empty($dbUser))
        {
            return $this->buildFromArray($dbUser);
        }
        
        return null;
    }
    
    public function findByResume($id)
    {
        $query = <<<EOS
SELECT *
FROM user u
JOIN resume r ON r.user_id = u.id
WHERE r.id = :id
EOS;
        
        $dbUser = $this->db->fetchAssoc(
            $query,
            [':id' => $id]
        );
        
        if(!empty($dbUser))
        {
            return $this->buildFromArray($dbUser);
        }
        
        return null;
    }
    
      public function findByEmail($email)
    {
        $dbUser = $this->db->fetchAssoc(
            'SELECT * FROM user WHERE email = :email',
            [':email' => $email]
        );

        if (!empty($dbUser)) {
            return $this->buildFromArray($dbUser);
        }

        return null;
    }

    /**
     * @param array $dbUser
     * @return User
     */
    public function buildFromArray(array $dbUser)
    {
        $user = new User();

        $user
            ->setId($dbUser['id'])
            ->setLastname($dbUser['lastname'])
            ->setFirstname($dbUser['firstname'])
            ->setEmail($dbUser['email'])
            ->setPassword($dbUser['password'])
            ->setRole($dbUser['role'])
            ->setTelephone($dbUser['telephone'])
            ->setPostcode($dbUser['postcode'])
        ;

        return $user;
    }
    
    public function findIdResumeByReference($reference)
    {
        $result = $this->db->fetchColumn('SELECT id FROM resume WHERE reference = :reference', [':reference' => $reference]);
        
        return $result;
        
    }
}
