<?php

namespace Controller;

use Entity\Experience;
use Entity\Language;
use Entity\Resume;
use Entity\Skill;
use Entity\Study;

class ResumeController extends ControllerAbstract
{
    
    // Méthode pour ajouter ou modifier un CV
    public function editAction($id = null)
    {
        if(!is_null($id))
        {
            // On stocke l'id de l'utilisateur connecté
            $userId = $this->app['user.manager']->getUser()->getId();
            
            $resume = $this->app['resume.repository']->findByUser($userId);
            $resumeId = $resume->getId(); // Récupération de l'id du 'resume' de l'utilisateur
            
            $experiences = $this->app['experience.repository']->findByUser($userId);
            for($i = 0; $i < count($experiences); $i++)
            {
                $experiencesId[] = $experiences[$i]->getId(); // Récupération dans un array des id des expériences pro de l'utilisateur
            }

            $studies = $this->app['study.repository']->findByUser($userId);
            for($i = 0; $i < count($studies); $i++)
            {
                $studiesId[] = $studies[$i]->getId(); // Récupération dans un array des id des formations de l'utilisateur
            }
            
            $skills = $this->app['skill.repository']->findByUser($userId);
            $skillsId = $skills->getId(); // Récupération de l'id des compétences de l'utilisateur
            
            $languages = $this->app['language.repository']->findByUser($userId);
            for($i = 0; $i < count($languages); $i++)
            {
                $languagesId[] = $languages[$i]->getId(); // Récupération dans un array des id des langues de l'utilisateur
            }
        }
            
        $errors = [];
        
        if(!empty($_POST))
        {
            $resume = new Resume;
            $experiences = new Experience;
            $studies = new Study;
            $skills = new Skill;
            $languages = new Language;
            
            // new security manager object to clean $_POST values (XSS)
            $this->app['security.manager']->sanitizePost();
            
            // Stockage du nombre d'expériences, de formations et de langues que l'utilisateur a entré dans le formulaire
            $nb_of_experiences = count($_POST['nb_of_experiences']);
            $nb_of_studies = count($_POST['nb_of_studies']);
            $nb_of_languages = count($_POST['nb_of_languages']);
            
            
                // On définit les SETTERS de chaque entités (Resume, Experience, Study et Skill) :
                
                if(isset($resumeId))
                {
                    $resume->setId($resumeId);
                }
                
                $resume
                    ->setReference($this->app['security.manager']->generateRandomString())
                    ->setProfessionnalDomain($_POST['professionnal_domain'])
                    ->setDesiredJob($_POST['desired_job'])
                    ->setContractType($_POST['contract_type'])
                    ->setHobbies($_POST['hobbies'])
                    ->setUser($this->app['user.manager']->getUser()) // Récupération des informations (en session) de l'utilisateur connecté
                ;
                
                if(isset($experiencesId))
                {
                    $experiences->setId($experiencesId);
                }
                
                $experiences
                    ->setJobName($_POST['job_name'])
                    ->setCompanies($_POST['companies'])
                    ->setDescription($_POST['description'])
                    ->setYearOfExperience($_POST['year_of_experience'])
                    ->setUser($this->app['user.manager']->getUser()) // Récupération des informations (en session) de l'utilisateur connecté
                ;

                if(isset($studiesId))
                {
                    $studies->setId($studiesId);
                }
                
                $studies
                    ->setName($_POST['name'])
                    ->setLevel($_POST['level'])
                    ->setUser($this->app['user.manager']->getUser()) // Récupération des informations (en session) de l'utilisateur connecté
                ;

                if(isset($skillsId))
                {
                    $skills->setId($skillsId);
                }
                
                $skills
                    ->setSkills($_POST['skills'])
                    ->setInformatique($_POST['informatique'])
                    ->setUser($this->app['user.manager']->getUser()) // Récupération des informations (en session) de l'utilisateur connecté
                ;  

                if(isset($languagesId))
                {
                    $languages->setId($languagesId);
                }
                
                $languages
                    ->setLanguageSelect($_POST['language_select'])
                    ->setLanguageLevel($_POST['language_level'])
                    ->setUser($this->app['user.manager']->getUser()) // Récupération des informations (en session) de l'utilisateur connecté
                ;  
            
            
            // Vérifications des erreurs :
            
            // Vérification des champs de la table 'resume'
//            if(empty($_POST['professionnal_domain']))
//            {
//                $errors['professionnal_domain'] = 'Le domaine professionnel est obligatoire !';
//            }
//                        
//            if(empty($_POST['desired_job']))
//            {
//                $errors['desired_job'] = 'Le poste recherché est obligatoire !';
//            }
//                        
//            if(empty($_POST['contract_type']))
//            {
//                $errors['contract_type'] = 'Le type de contrat est obligatoire !';
//            }
//                        
//            if(empty($_POST['contract_type']))
//            {
//                $errors['hobbies'] = 'Le type de contrat est obligatoire !';
//            }
            
            // Vérification des champs de la table 'experience'
//            for($i = 0; $i < $nb_of_experiences; $i++)
//            {
//                if(empty($_POST['job_name'][$i]))
//                {
//                    $errors['job_name'] = 'Le nom du poste n°' . ($i+1) . ' est obligatoire !';
//                }         
//
//                if(empty($_POST['companies'][$i]))
//                {
//                    $errors['companies'] = 'Les sociétés n°' . ($i+1) . ' sont obligatoires !';
//                }         
//
//                if(empty($_POST['year_of_experience'][$i]))
//                {
//                    $errors['year_of_experience'] = 'Le nombre d\'années d\'expérience pour le poste n°' . ($i+1) . ' obligatoire !';
//                }
//
//                if(empty($_POST['description'][$i]))
//                {
//                    $errors['description'] = 'Les responsabilités pour le poste n°' . ($i+1) . '  sont obligatoires !';
//                }   
//            }
  
            // Vérifications des champs de la table 'study'
//            for($i = 0; $i < $nb_of_studies; $i++)
//            {
//                if(empty($_POST['name'][$i]))
//                {
//                    $errors['name'] = 'Le nom de la formation est obligatoire !';
//                } 
//                        
//                if(empty($_POST['level'][$i]))
//                {
//                    $errors['level'] = 'Le niveau de la formation est obligatoire !';
//                }
//            }
            
            // Vérifications des champs de la table 'skill'
//            if(empty($_POST['skills']))
//            {
//                $errors['skills'] = 'Le champs "compétences" est obligatoire !';
//            } 
//                        
//            if(empty($_POST['informatique']))
//            {
//                $errors['informatique'] = 'Le champs "informatique" est obligatoire !';
//            }
            
            // Vérifications des champs de la table 'language'
//            for($i = 0; $i < $nb_of_languages; $i++)
//            {
//                if(empty($_POST['language_select'][$i]))
//                {
//                    $errors['language_select'] = 'La sélection d\'un langage est obligatoire !';
//                }      
//
//                if(empty($_POST['language_level'][$i]))
//                {
//                    $errors['language_level'] = 'La sélection d\'un niveau du langage est obligatoire !';
//                }  
//            }
            
            // S'il n'y a pas d'erreurs...
            if(empty($errors))
            {
                
                $this->app['resume.repository']->save($resume);
                $this->app['experience.repository']->save($experiences, $nb_of_experiences);
                $this->app['study.repository']->save($studies, $nb_of_studies);
                $this->app['skill.repository']->save($skills);
                $this->app['language.repository']->save($languages, $nb_of_languages);
                
                $this->addFlashMessage('Le CV est enregistré !');
                
                return $this->redirectRoute('user_dashboard');   
            }
            else
            {
                $message = '<b>Le formulaire contient des erreurs</b>';
                $message .= '<br>' . implode('<br>', $errors);
                $this->addFlashMessage($message, 'error');

               
            }
        }
        
        // S'il y a l'id de l'utilisateur dans l'url...
        if(!is_null($id))
        {
            // On retourne la vue pour qu'il édite son CV
            return $this->render(
                'resume/edit.html.twig',
                [
                    'resume' => $resume,
                    'experiences' => $experiences,
                    'studies' => $studies,
                    'skills' => $skills,
                    'languages' => $languages,
                    'post' => $_POST
                ]
            );
        }
        
        // La vue retournée par défaut :
        return $this->render(
            'resume/add.html.twig',
            [
                'post' => $_POST
                //'resume' => $resume,
                //'experiences' => $experiences,
               // 'studies' => $studies,
               // 'skills' => $skills
            ]
        );
    }
    
    public function deleteAction()
    {    
        $userId = $this->app['user.manager']->getUser()->getId();
        
        $this->app['resume.repository']->delete($userId);
        $this->app['experience.repository']->delete($userId);
        $this->app['skill.repository']->delete($userId);
        $this->app['study.repository']->delete($userId);
        $this->app['language.repository']->delete($userId);
        
        $this->addFlashMessage('Le CV a été supprimé !');
        
        return $this->redirectRoute('user_dashboard');
    }
    
    public function deleteExperienceAction($id)
    {
        $this->app['experience.repository']->deleteByExperienceId($id);
        return 'Suppression';
    }
}
