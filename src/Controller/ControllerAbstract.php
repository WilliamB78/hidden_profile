<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Description of ControllerAbstract
 *
 * @author Etudiant
 */
abstract class ControllerAbstract {
    
    /**
     *
     * @var Application
     */
    protected $app;
    
    /**
     *
     * @var \Twig_Environment
     */
    protected $twig;
    
    /**
     *
     * @var Session Service Provider 
     */
    protected $session;

    /**
     * 
     * ControllerAbstract contructor
     */
    public function __construct(Application $app) {
    
        $this->app = $app;
        $this->twig = $app['twig'];
        $this->session = $app['session'];
    }
    
    /**
     * 
     * @param string $view
     * @param array $parameters
     * @return string
     */
    public function render($view, array $parameters = []){
        
        return $this->twig->render($view, $parameters);
    }

    
    /**
     * Enregistre un message en session pour affichage au prochain
     * chargement de page
     * 
     * @param string $message
     * @param string $type
     */
    public function addFlashMessage($message, $type = 'success'){
        
        $this->session->getFlashBag()->add($type, $message);
    }
    
    
    /**
     * 
     * redirige vers une autre route
     * 
     * @param string $routeName
     * @param array $parameters
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectRoute($routeName, array $parameters = []){
        
        return $this->app->redirect(
            $this->app['url_generator']->generate($routeName, $parameters)
                );
    }

}
