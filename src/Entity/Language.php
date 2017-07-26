<?php
namespace Entity;

class Language
{
    /**
     * @var int
     */
    private $id;
    
    /**
     * @var string
     */
    private $languageSelect;
    
    /**
     * @var string
     */
    private $languageLevel;
    
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
    public function getLanguageSelect() {
        return $this->languageSelect;
    }

    /**
     * @return string
     */
    public function getLanguageLevel() {
        return $this->languageLevel;
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
     * @param string $languageSelect
     * @return Skill
     */
    public function setLanguageSelect($languageSelect) {
        $this->languageSelect = $languageSelect;
        return $this;
    }

    /**
     * @param string $languageLevel
     * @return Skill
     */
    public function setLanguageLevel($languageLevel) {
        $this->languageLevel = $languageLevel;
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
