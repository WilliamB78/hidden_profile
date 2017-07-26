<?php

namespace Entity;

class Resume
{
    /**
     * @var int
     */
    private $id;
    
    /**
     * @var string
     */
    private $reference;
    
    /**
     * @var string
     */
    private $professionnalDomain;
    
    /**
     * @var string
     */
    private $desiredJob;
    
    /**
     * @var string
     */
    private $contractType;
    
    /**
     * @var string
     */
    private $hobbies;
    
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
    public function getReference() {
        return $this->reference;
    }
    
    /**
     * @return string
     */
    public function getProfessionnalDomain() {
        return $this->professionnalDomain;
    }

    /**
     * @return string
     */
    public function getDesiredJob() {
        return $this->desiredJob;
    }
    
    /**
     * @return string
     */
    public function getContractType() {
        return $this->contractType;
    }

    /**
     * @return string
     */
    public function getHobbies() {
        return $this->hobbies;
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
     * @return Resume
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $reference
     * @return Resume
     */
    public function setReference($reference) {
        $this->reference = $reference;
        return $this;
    }

    /**
     * @param string $professionnalDomain
     * @return Resume
     */
    public function setProfessionnalDomain($professionnalDomain) {
        $this->professionnalDomain = $professionnalDomain;
        return $this;
    }

    /**
     * @param string $desiredJob
     * @return Resume
     */
    public function setDesiredJob($desiredJob) {
        $this->desiredJob = $desiredJob;
        return $this;
    }

    /**
     * @param string $contractType
     * @return Resume
     */
    public function setContractType($contractType) {
        $this->contractType = $contractType;
        return $this;
    }

    /**
     * @param string $hobbies
     * @return Resume
     */
    public function setHobbies($hobbies) {
        $this->hobbies = $hobbies;
        return $this;
    }
    
    /**
     * @param User $user
     * @return Resume
     */
    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }
}
