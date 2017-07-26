<?php


namespace Controller\Admin;

use Controller\ControllerAbstract;
use Entity\Order;
 
class AdminsController extends ControllerAbstract {
   
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

                    return $this->redirectRoute('admin'); 
                }
            }

            $this->addFlashMessage('Identification incorrecte', 'error');
        }

        return $this->render(
            'admin/login.html.twig',
            ['email' => $email]
        );
    }
    
    public function logoutAction()
    {
        $this->app['user.manager']->logout();

        return $this->redirectRoute('homepage'); // Redirection vers la page d'accueil
    }
}
