<?php

namespace Controller\Admin;

use Controller\ControllerAbstract;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrderController
 *
 * @author wbute
 */
class OrderController extends ControllerAbstract {
    
    
    public function indexAction()
    {
        $orders = $this->app['order.repository']->findAll();
        
        return $this->render('admin/gestion_commandes.html.twig', ['orders' => $orders]);
    }
}
