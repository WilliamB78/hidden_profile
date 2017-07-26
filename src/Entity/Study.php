<?php

namespace Entity;

class Study
{
    /**
     * @var int
     */
    private $id;
    
    /**
     * @var string
     */
    private $name;
    
    /**
     * @var string
     */
    private $level;
    
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
    public function getName() {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLevel() {
        return $this->level;
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
     * @return Study
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $name
     * @return Study
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $level
     * @return Study
     */
    public function setLevel($level) {
        $this->level = $level;
        return $this;
    }

    /**
     * @param User $user
     * @return Study
     */
    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }
}
