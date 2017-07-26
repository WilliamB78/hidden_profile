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
    
    public function editAction($id = null)
    {
        if (!is_null($id)) { // modification
            $order = $this->app['order.repository']->find($id);
        } 


        if (!empty($_POST)) {

            $order
                    ->setAmount($_POST['amount'])
                    ->setNbOfTokens($_POST['nb_of_tokens'])
                    ->setStatus($_POST['status'])
                    ;

          
        }

        return $this->render(
            'admin/edit_commandes.html.twig',
            [
                'order' => $order
            ]
        );
    }
}
