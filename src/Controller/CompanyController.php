<?php

namespace Controller;

use Entity\Command;
use Entity\Company;
use Entity\Favorite;
use Entity\Order;
use Symfony\Component\HttpFoundation\JsonResponse;



/**
 * Description of CompanyController
 *
 * @author Etudiant
 */
class CompanyController extends ControllerAbstract{
    
    public function indexAction(){
                
        $email =  $this->session->get('company')->getEmail();
        $company = $this->app['company.repository']->findByEmail($email);
      
                      
        return $this->render(
                'company/espace_recruteur.html.twig',
                [
                    'company' => $company
                ]);


    }

   public function registerAction()
    {
        $company = new Company();
        $errors = [];

        if (!empty($_POST)) {
            
            // new security manager object to clean $_POST values (XSS)
            $this->app['security.manager']->sanitizePost();
          
            
            $company
                ->setName($_POST['name'])
                ->setEmail($_POST['email'])
                ->setPassword($_POST['password'])
                ->setSiret($_POST['siret'])
                ->setTvaNb($_POST['tva_nb'])
                ->setTelephone($_POST['telephone'])
                ->setAddress($_POST['address'])
                ->setPostcode($_POST['postcode'])
                ->setCity($_POST['city'])
                ->setCountry($_POST['country'])
                ->setActivityArea($_POST['activity_area'])
                ->setEmployesNb($_POST['employes_nb'])
                ->setNbOfTokens(0)
                ->setRole('company')
        ;
            
          
            if (empty($_POST['name'])) {
                $errors['name'] = 'Le nom de l\'entreprise est obligatoire';
            }

            if (empty($_POST['email'])) {
                $errors['email'] = "L'email est obligatoire";
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "L'email n'est pas valide";
            } elseif (!empty($this->app['company.repository']->findByEmail($_POST['email']))) {
                $errors['email'] = 'Cet email est déjà utilisé';
            }
            
            if (empty($_POST['email_confirm'])) {
                $errors['email_confirm'] = 'La confirmation de l\'email est obligatoire';
            } elseif ($_POST['email'] != $_POST['email_confirm']) {
                $errors['email_confirm'] = "La confirmation n'est pas identique à l'email";
            }
            
            if (empty($_POST['siret'])){
                $errors ['siret'] = 'Le SIRET est obligatoire.';
            } elseif (!preg_match('/^[A-Z0-9]{14}$/', $_POST['siret'])){
                $errors ['siret'] = 'Le SIRET n\'est pas valide.';
            }
            
            if (empty($_POST['tva_nb'])){
                $errors['tva_nb'] = 'Le numéro de TVA intracommunautaire est obligatoire.';
            } elseif (!preg_match('/^[A-Z0-9]{13,14}$/', $_POST['tva_nb'])){
                $errors ['tva_nb'] = 'Le  numéro de TVA intracommunautaire n\'est pas valide.';
            }
            
            if (empty($_POST['telephone'])){
                $errors['telephone'] = 'Le numéro de téléphone est obligatoire.';
            } elseif (!preg_match('/^0[1-68]([-. ]?[0-9]{2}){4}$/', $_POST['telephone'])){
                $errors['telephone'] = 'Le numéro de téléphone n\'est pas valide.';
            }
            
             if (empty($_POST['address'])) {
                $errors['address'] = 'L\'adresse est obligatoire';
            }
            
             if (empty($_POST['postcode'])) {
                $errors['postcode'] = 'Le code postal est obligatoire';
            }elseif (!preg_match('/^[0-9]{5}$/', $_POST['postcode'])){
                $errors ['postcode'] = 'Le code postal n\'est pas valide.';
            }
            
             if (empty($_POST['city'])) {
                $errors['city'] = 'La ville est obligatoire';
            }
            
             if (empty($_POST['country'])) {
                $errors['country'] = 'Le pays est obligatoire';
            }
            
             if (empty($_POST['activity_area'])) {
                $errors['activity_area'] = 'Le domaine d\'activités est obligatoire';
            }
            
             if (empty($_POST['employes_nb'])) {
                $errors['employes_nb'] = 'Le nombre d\'employés est obligatoire';
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
                $company->setPassword($this->app['company.manager']->encodePassword($_POST['password']));
                $this->app['company.repository']->save($company);
                $this->app['company.manager']->login($company);

                return $this->redirectRoute('company_dashboard'); // VERIFIER LE NOM DE LA ROUTE A LA FIN ////////////////////////
                
            } else {
                $msg = '<strong>Le formulaire contient des erreurs</strong>';
                $msg .= '<br>' . implode('<br>', $errors);

                $this->addFlashMessage($msg, 'error');
            }
        }

                return $this->render(
            'company/register.html.twig', // ROUTE A REDEFINIR //////////////////
            [
                'company' => $company,
                'post' => $_POST
            ]
        );
    }

    public function loginAction()
    {
        $email = '';

        if (!empty($_POST)) 
        {
            $this->app['security.manager']->sanitizePost();
            
            $email = $_POST['email'];

            $company = $this->app['company.repository']->findByEmail($email);

            if (!is_null($company)) 
            {
                if ($this->app['company.manager']->verifyPassword($_POST['password'], $company->getPassword())) 
                {
                    $this->app['company.manager']->login($company);

                    return $this->redirectRoute('company_dashboard'); // VERIFIER LE NOM DE LA ROUTE A LA FIN ////////////////////////
                }
            }

            $this->addFlashMessage('Identification incorrecte', 'error');
        }

        return $this->render(
            'company/login.html.twig',
            ['email' => $email]
        );
    }

    public function logoutAction()
    {
        $this->app['company.manager']->logout();

        return $this->redirectRoute('homepage');

    }
    
    public function editAction()
    {
        
        if (!empty($_POST)){
            
            $this->app['security.manager']->sanitizePost();
            
            $companyTwo = new Company;
            
            $id = $this->session->get('company')->getId();
            $role = $this->session->get('company')->getRole();
            $dbTokens = $this->app['company.repository']->nbOfTokens($id);
            
            $companyTwo
                ->setId($id)
                ->setName($_POST['name'])
                ->setEmail($_POST['email'])
                ->setSiret($_POST['siret'])
                ->setTvaNb($_POST['tva_nb'])
                ->setTelephone($_POST['telephone'])
                ->setAddress($_POST['address'])
                ->setPostcode($_POST['postcode'])
                ->setCity($_POST['city'])
                ->setCountry($_POST['country'])
                ->setActivityArea($_POST['activity_area'])
                ->setEmployesNb($_POST['employes_nb'])
                ->setRole($role)
                ->setNbOfTokens($dbTokens)
        ;
            
            $errors=[];
            
            
            
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "L'email n'est pas valide";
            }  elseif ($_POST['email'] != $this->session->get('company')->getEmail()){
                  if (!empty($this->app['company.repository']->findByEmail($_POST['email']))) {
                  $errors['email'] = 'Cet email est déjà utilisé';
                }
            }
            
            if (!empty($_POST['old_password']) && !empty($_POST['new_password'])){
                                
                if (!$this->app['company.manager']->verifyPassword($_POST['old_password'], $this->session->get('company')->getPassword())){
                    $errors['password_confirm'] = "L'ancien mot de passe n'est pas valide";
                } else {
                    $companyTwo->setPassword($this->app['company.manager']->encodePassword($_POST['new_password']));
                }
            } elseif (!empty($_POST['old_password']) && empty($_POST['new_password']) || empty($_POST['old_password']) && !empty($_POST['new_password'])) {
                  $errors['password_confirm'] = "Veuillez vérifier les mots de passe";
            } else {
                $companyTwo->setPassword($this->session->get('company')->getPassword());
            }
            
            if (!preg_match('/^[A-Z0-9]{14}$/', $_POST['siret'])){
                $errors ['siret'] = 'Le SIRET n\'est pas valide.';
            }
            
            if (!preg_match('/^[A-Z0-9]{13,14}$/', $_POST['tva_nb'])){
                $errors ['tva_nb'] = 'Le  numéro de TVA intracommunautaire n\'est pas valide.';
            }
            
            if (!preg_match('/^0[1-68]([-. ]?[0-9]{2}){4}$/', $_POST['telephone'])){
                $errors['telephone'] = 'Le numéro de téléphone n\'est pas valide.';
            }
            
            if (empty($errors)){
                $this->app['company.repository']->save($companyTwo);
                $this->app['company.manager']->login($companyTwo);
            } else {
                $msg = '<strong>Le formulaire contient des erreurs</strong>';
                $msg .= '<br>' . implode('<br>', $errors);

                $this->addFlashMessage($msg, 'error');
            }
        }
        
        $email = $this->session->get('company')->getEmail();
        
        $company = $this->app['company.repository']->findByEmail($email);
                
        return $this->render('company/edit_profile.html.twig', [ 'company' => $company]);
    }
    
    public function searchResumeAction()
    {
        if (!empty($_GET['titre_poste'])){
            
            $this->app['security.manager']->sanitizeGet();
             
             $filters = [];
             
             if (!empty($_GET['annees_experience'])){
                 $filters[] = ' AND year_of_experience >= ' . $_GET['annees_experience'];
             }
             
             if (!empty($_GET['lieu'])){
                 $filters[] = ' AND postcode = ' . $_GET['lieu'];
             }
             
             if (!empty($_GET['competences'])){
                 $filters[] = " AND skills LIKE '%$_GET[competences]%'"; 
             }
        
            $idCompany = $this->session->get('company')->getId();
             
             $resumes = $this->app['resume.repository']->findByJob($_GET['titre_poste'],$idCompany, $filters);
             
             $favoris = $this->app['favorite.repository']->findByIdCompany($idCompany);
             
                                      
            return $this->render('company/recherche_cv.html.twig', 
            [
                'resumes' => $resumes,
                'get' => $_GET
            ]);
        }
        
        return $this->render('company/recherche_cv.html.twig');
    }   
    
    public function orderTokensAction()
    {
        
        if (!empty($_POST['nombre_jetons'])){
            
            // attention !!! temporaire !! 
            
            $this->app['security.manager']->sanitizePost();
            
            $idCompany = $this->session->get('company')->getId();
            
            $order = new Order();
            
            $order
                ->setAmount($_POST['nombre_jetons'])
                ->setIdCompany($idCompany)
                ->setNbOfTokens($_POST['nombre_jetons']);
            
            $this->app['order.repository']->save($order);
            
            $company = new Company();
            
            $company
                    ->setNbOfTokens($_POST['nombre_jetons'])
                    ->setId($idCompany);
            
            $dbTokens = $this->app['company.repository']->nbOfTokens($idCompany);
            
            $nbOfTokens = $dbTokens + $_POST['nombre_jetons'];
            
            $this->app['company.repository']->saveTokens($company, $nbOfTokens);
            
            $this->addFlashMessage('Commande effectué avec succès. Merci de votre confiance !');
            
            return $this->redirectRoute('company_dashboard');
            
        }
        
        return $this->render('company/commande_jetons.html.twig');
    }
    
    public function showResumeAction($reference)
    {
        $idCompany = $this->session->get('company')->getId();
        
        $resume = $this->app['resume.repository']->findByRef($reference);
        $idResume =  $resume->getId();
        $userId = $resume->getUserId();
        
        $command = $this->app['command.repository']->findCommandByIdCompanyAndIdResume($idCompany, $idResume);
        $user = '';
        if(!is_null($command))
        {
            $user = $this->app['user.repository']->find($userId);
        }
        
        $resume = $this->app['resume.repository']->findByUser($userId);
        $experiences = $this->app['experience.repository']->findByUser($userId);
        $studies = $this->app['study.repository']->findByUser($userId);
        $skills = $this->app['skill.repository']->findByUser($userId);
        $languages = $this->app['language.repository']->findByUser($userId);
        
        return $this->render(
            'company/consulter_cv.html.twig',  // Retourne la vue du dashboard user (user_dashboard)
            [
                'resume' => $resume,
                'experiences' => $experiences,
                'studies' => $studies,
                'skills' => $skills,
                'languages' => $languages,
                'user' => $user
            ]
        );
    }
    
    public function showFavoritesResumesAction()
    {
        $idCompany = $this->session->get('company')->getId();
        
        $favoris = $this->app['favorite.repository']->findByIdCompany($idCompany);
             
        return $this->render('company/cv_favoris.html.twig', ['favoris' => $favoris]);
    }
    
    public function addFavoriteResumeAction($reference)
    {
               
        $favorite = new Favorite();
        
        $idCompany = $this->session->get('company')->getId();
        
        $idResume = $this->app['user.repository']->findIdResumeByReference($reference);
             
        $favorite
                ->setIdResume($idResume)
                ->setIdCompany($idCompany)
                ;
        
        $idFavorite = $this->app['favorite.repository']->findByIdCompanyAndIdResume($idCompany, $idResume);
                       
        if ($idFavorite == ""){
            $this->app['favorite.repository']->save($favorite);
            
            return 'Ajout';
        } else {
            $this->app['favorite.repository']->delete($idFavorite);
            
            return 'Suppression';
        }

    }
    
    public function revealResumeAction($resumeId)
    {
        $company = $this->session->get('company');  
        
        $companyId = $company->getId(); 
        
        if ($this->app['company.repository']->nbOfTokens($companyId) == 0){
            return 'error';
        }
        else{
            // Insère l'id company et l'id resume dans table command
            $command = new Command();

            $company = $this->session->get('company');  
            $resume = $this->app['resume.repository']->find($resumeId);

            $command
                ->setCompany($company)
                ->setResume($resume)
            ;

            $this->app['command.repository']->save($command);

            // Retire un jeton dans le champs nb_of_tokens de l'entreprise connectée
            $companyId = $company->getId(); 

            $newNbOfTokens = $this->app['company.repository']->nbOfTokens($companyId) - 1;

            $company
                ->setId($companyId)
                ->setNbOfTokens($newNbOfTokens);

            $this->app['company.repository']->save($company);

            $user = $this->app['user.repository']->findByResume($resumeId);

            return new JsonResponse($user->toArray());
        }
    }
}
