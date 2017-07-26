<?php

namespace Entity;

class Command
{
    /**
     * @var int
     */
    private $id;
    
    /**
     * @var Company
     */
    private $company;
    
    /**
     * @var Resume
     */
    private $resume;
    
    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return Company
     */
    public function getCompany() {
        return $this->company;
    }
    
    /**
     * @return Company
     */
    public function getCompanyId()
    {
        if(!is_null($this->company))
        {
            return $this->company->getId();
        }
    }

    /**
     * @return Resume
     */
    public function getResume() {
        return $this->resume;
    }
    
    /**
     * @return Resume
     */
    public function getResumeId()
    {
        if(!is_null($this->resume))
        {
            return $this->resume->getId();
        }
    }

    /**
     * @param int $id
     * @return Command
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @param Company $company
     * @return Command
     */
    public function setCompany(Company $company) {
        $this->company = $company;
        return $this;
    }

    /**
     * @param Resume $resume
     * @return Command
     */
    public function setResume(Resume $resume) {
        $this->resume = $resume;
        return $this;
    }

}
