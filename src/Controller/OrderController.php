<?php

use Controller\ControllerAbstract;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controller;

/**
 * Description of OrderController
 *
 * @author wbute
 */
class OrderController extends ControllerAbstract{
   
    public function indexAction()
    {
     
        $idCompany = $this->session->get('company')->getId();
                    
        $orders = $this->app['order.repository']->findOrderByIdCompany($idCompany);
        
        return $this->render('company/historique_commandes.html.twig', ['orders' => $orders]);
    }
}
