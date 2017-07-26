<?php

namespace Controller;

use Entity\User;

class UserController extends ControllerAbstract 
{    
    // Méthode pour l'enregistrement d'un candidat
    public function registerAction()
    {
        $user = new User();
        $errors = [];

        if (!empty($_POST)) {
            
            // new security manager object to clean $_POST values (XSS)
            $this->app['security.manager']->sanitizePost();
            
            $user
                ->setLastname($_POST['lastname']) 
                ->setFirstname($_POST['firstname'])
                ->setEmail($_POST['email'])
                ->setPostcode($_POST['postcode'])
                ->setTelephone($_POST['telephone'])
            ;

            if (empty($_POST['lastname'])) {
                $errors['lastname'] = 'Le nom est obligatoire';
            }

            if (empty($_POST['firstname'])) {
                $errors['firstname'] = 'Le prénom est obligatoire';
            }
            
            if (empty($_POST['postcode'])) {
                $errors['postcode'] = 'Le code postal est obligatoire';
            }elseif (!preg_match('/^[0-9]{5}$/', $_POST['postcode'])){
                $errors ['postcode'] = 'Le code postal n\'est pas valide.';
            }
            
            if (empty($_POST['telephone'])) {
                $errors['telephone'] = 'Le numéro de téléphone est obligatoire';
            }elseif (!preg_match('/^0[1-68]([-. ]?[0-9]{2}){4}$/', $_POST['telephone'])){
                $errors['telephone'] = 'Le numéro de téléphone n\'est pas valide.';
            }

            if (empty($_POST['email'])) {
                $errors['email'] = "L'email est obligatoire";
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "L'email n'est pas valide";
            } elseif (!empty($this->app['user.repository']->findByEmail($_POST['email']))) {
                $errors['email'] = 'Cet email est déjà utilisé';
            }
            
             if (empty($_POST['email_confirm'])) {
                $errors['email_confirm'] = 'La confirmation de l\'email est obligatoire';
            } elseif ($_POST['email'] != $_POST['email_confirm']) {
                $errors['email_confirm'] = "La confirmation n'est pas identique a l'email";
            }

            if (empty($_POST['password'])) {
                $errors['password'] = 'Le mot de passe est obligatoire';
            } elseif (!preg_match('/^[a-zA-Z0-9_-]{6,20}$/', $_POST['password'])) {
                $errors['password'] = 'Le mot de passe doit faire entre 6 et 20 caractères'
                    . ' et ne doit contenir que des lettres, des chiffres ou les caractères _ et -'
                ;
            }

            if (empty($_POST['password_confirm'])) {
                $errors['password_confirm'] = 'La confirmation du mot de passe est obligatoire';
            } elseif ($_POST['password'] != $_POST['password_confirm']) {
                $errors['password_confirm'] = "La confirmation n'est pas identique au mot de passe";
            }

            if (empty($errors)) {
                $user->setPassword($this->app['user.manager']->encodePassword($_POST['password']));
                $this->app['user.repository']->save($user);
                $this->app['user.manager']->login($user);

               return $this->redirectRoute('user_dashboard'); // Redirection vers la page connexion
            } else {
                $msg = '<strong>Le formulaire contient des erreurs</strong>';
                $msg .= '<br>' . implode('<br>', $errors);

                $this->addFlashMessage($msg, 'error');
            }
        }

        return $this->render(
            'user/register.html.twig',
            [
                'user' => $user,
                'post' => $_POST
            ]
        );
    }
    
    // Méthode pour la connexion du candidat
    public function loginAction()
    {
        $email = '';

        if (!empty($_POST)) 
        {
            $email = $_POST['email'];

            $user = $this->app['user.repository']->findByEmail($email);

            if (!is_null($user)) 
            {
                if ($this->app['user.manager']->verifyPassword($_POST['password'], $user->getPassword())) 
                {
                    $this->app['user.manager']->login($user);

                    return $this->redirectRoute('user_dashboard'); // Redirection vers le dashboard du candidat
                }
            }

            $this->addFlashMessage('Identification incorrecte', 'error');
        }

        return $this->render(
            'user/login.html.twig',
            ['email' => $email]
        );
    }

    // Méthode pour la déconnexion du candidat
    public function logoutAction()
    {
        $this->app['user.manager']->logout();

        return $this->redirectRoute('homepage'); // Redirection vers la page d'accueil
    }
    
    // Méthode pour le dashboard du candidat
    public function dashboardAction()
    {
        $user = $this->app['user.manager']->getUser();
        
        $userId = $this->app['user.manager']->getUser()->getId();
        
        $resume = $this->app['resume.repository']->findByUser($userId);
        $experiences = $this->app['experience.repository']->findByUser($userId);
        $studies = $this->app['study.repository']->findByUser($userId);
        $skills = $this->app['skill.repository']->findByUser($userId);
        $languages = $this->app['language.repository']->findByUser($userId);
        
        return $this->render(
            'user/espace_candidat.html.twig',  // Retourne la vue du dashboard user (user_dashboard)
            [
                'user' => $user,
                'resume' => $resume,
                'experiences' => $experiences,
                'studies' => $studies,
                'skills' => $skills,
                'languages' => $languages
            ]
        );
    }
    
    // Modification des informations personnelles des candidats
    public function editAction()
    {
        $userId = $this->app['user.manager']->getUser()->getId();
        
        $user = $this->app['user.repository']->find($userId);
                
        if (!empty($_POST)){
            
            $user = new User;
            
            $id = $this->session->get('user')->getId();
            
            $user
                ->setId($id)
                ->setFirstname($_POST['firstname'])
                ->setLastname($_POST['lastname'])    
                ->setEmail($_POST['email'])      
                ->setTelephone($_POST['telephone'])
                ->setPostcode($_POST['postcode'])
            ;
            
            $errors=[];
            
            $this->app['security.manager']->sanitizePost();
            
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "L'email n'est pas valide";
            }  elseif ($_POST['email'] != $this->session->get('user')->getEmail()){
                  if (!empty($this->app['user.repository']->findByEmail($_POST['email']))) {
                  $errors['email'] = 'Cet email est déjà utilisé';
                }
            } elseif ($_POST['email'] != $_POST['email_confirm']) {
                $errors['email_confirm'] = "La confirmation n'est pas identique a l'email";
            }
            
            if (!empty($_POST['old_password']) && !empty($_POST['new_password'])){ /// Changement de mot de passe
                                
                if (!$this->app['user.manager']->verifyPassword($_POST['old_password'], $this->session->get('user')->getPassword())){ 
// vérification de l'ancien mot de passe (on le dé-hash avec vérifyPassword())
                    $errors['password_confirm'] = "L'ancien mot de passe n'est pas valide";
                } else {
                    $user->setPassword($this->app['user.manager']->encodePassword($_POST['new_password']));
                }
            } elseif (!empty($_POST['old_password']) && empty($_POST['new_password']) || empty($_POST['old_password']) && !empty($_POST['new_password'])) {
                  $errors['password_confirm'] = "Veuillez vérifier les mots de passe";
            }
            
            
            if (!preg_match('/^0[1-68]([-. ]?[0-9]{2}){4}$/', $_POST['telephone'])){
                $errors['telephone'] = 'Le numéro de téléphone n\'est pas valide.';
            }
            
            if (empty($errors)){
                $this->app['user.repository']->save($user);
                $this->app['user.manager']->login($user);
                
                return $this->redirectRoute('user_dashboard'); // Redirection vers le dashboard du candidat
            }
            else {
                $msg = '<strong>Le formulaire contient des erreurs</strong>';
                $msg .= '<br>' . implode('<br>', $errors);

                $this->addFlashMessage($msg, 'error');
            }
        }
        
        $email = $this->session->get('user')->getEmail();
        
        $company = $this->app['user.repository']->findByEmail($email);
                
        return $this->render('user/edit_profile.html.twig', [ 'user' => $user]);
    }
}
