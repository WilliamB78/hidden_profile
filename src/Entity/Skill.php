<?php

namespace Entity;

class Skill
{
    /**
     * @var int
     */
    private $id;
    
    /**
     * @var string
     */
    private $skills;
    
    /**
     * @var string
     */
    private $informatique;
    
    /**
     * @var User
     */
    private $user;
    
    /* GETTERS */
    
    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSkills() {
        return $this->skills;
    }

    /**
     * @return string
     */
    public function getInformatique() {
        return $this->informatique;
    }

    /**
     * @return User
     */
    public function getUser() {
        return $this->user;
    }
    
    /**
     * @return User
     */
    public function getUserId()
    {
        if(!is_null($this->user))
        {
            return $this->user->getId();
        }
    }

    /* SETTERS */
    
    /**
     * @param int $id
     * @return Skill
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $skills
     * @return Skill
     */
    public function setSkills($skills) {
        $this->skills = $skills;
        return $this;
    }

    /**
     * @param string $informatique
     * @return Skill
     */
    public function setInformatique($informatique) {
        $this->informatique = $informatique;
        return $this;
    }

    /**
     * @param User $user
     * @return Skill
     */
    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }
}
