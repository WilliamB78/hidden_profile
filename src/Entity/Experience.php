<?php

namespace Entity;

class Experience
{
    /**
     * @var int
     */
    private $id;
    
    /**
     * @var string
     */
    private $jobName;
    
    /**
     * @var string
     */
    private $companies;
    
    /**
     * @var string
     */
    private $description;
    
    /**
     * @var string
     */
    private $yearOfExperience;
    
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
    public function getJobName() {
        return $this->jobName;
    }

    /**
     * @return string
     */
    public function getCompanies() {
        return $this->companies;
    }

    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getYearOfExperience() {
        return $this->yearOfExperience;
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
            //return $this->app['user.manager']->getUser()->getId();
        }
    }

    /* SETTERS */
    
    /**
     * @param int $id
     * @return Experience
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $jobName
     * @return Experience
     */
    public function setJobName($jobName) {
        $this->jobName = $jobName;
        return $this;
    }

    /**
     * @param string $companies
     * @return Experience
     */
    public function setCompanies($companies) {
        $this->companies = $companies;
        return $this;
    }

    /**
     * @param string $description
     * @return Experience
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * @param string $yearOfExperience
     * @return Experience
     */
    public function setYearOfExperience($yearOfExperience) {
        $this->yearOfExperience = $yearOfExperience;
        return $this;
    }

    /**
     * @param User $user
     * @return Experience
     */
    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }
}