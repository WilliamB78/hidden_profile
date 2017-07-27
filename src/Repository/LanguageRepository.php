<?php

namespace Repository;

use Entity\Language;
use Entity\User;

class LanguageRepository extends RepositoryAbstract
{
    public function getTable() {
        return 'language';
    }
    
    public function findByUser($userId)
    {
        $query = <<<EOS
SELECT l.*
FROM language l
JOIN user u On l.user_id = u.id
WHERE u.id = :id
EOS;
        
        $dbLanguages = $this->db->fetchAll(
            $query,
            [':id' => $userId]
        );
        
        $languages = [];
        
        foreach($dbLanguages as $dbLanguage)
        {
            $language = $this->buildFromArray($dbLanguage);
            
            $languages[] = $language;
        }
       
        return $languages;
    }
    
    public function buildFromArray(array $dbLanguage)
    {
        $user = new User();
        
        $user
            ->setId($dbLanguage['user_id'])
        ;
        
        $language = new Language();
        
        $language
            ->setId($dbLanguage['id'])
            ->setLanguageSelect($dbLanguage['language_select'])
            ->setLanguageLevel($dbLanguage['language_level'])
            ->setUser($user)
        ;
        
        return $language;
    }
    
    public function save(Language $language, $nb_of_languages)
    {
        for($i = 0; $i < $nb_of_languages; $i++)
        {
            $data = [
                'language_select' => $language->getLanguageSelect()[$i],
                'language_level' => $language->getLanguageLevel()[$i],
                'user_id' => $language->getUserId()
            ];

            $where
                    = !empty($language->getId()[$i])
                ? ['id' => $language->getId()[$i]]
                : null
            ;

            $this->persist($data, $where);
        }
    }
    
    public function delete($userId)
    {
        $this->db->delete('language', ['user_id' => $userId]);
    }
    
    public function deleteByLanguageId($languageId)
    {
        $this->db->delete('language', ['id' => $languageId]);
    }
}
