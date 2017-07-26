<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controller;

use Entity\Company;
use Entity\Order;

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
    
    public function orderTokensAction()
    {
        $order = new Order();
        
        $idCompany = $this->session->get('company')->getId();
        
        $amount = 190;
        $nbOfTokens = 10;
        
        $order
                ->setIdCompany($idCompany)
                ->setAmount($amount)
                ->setNbOfTokens($nbOfTokens)
                ;
        
        $this->app['order.repository']->save($order);
        
        $company = new Company();
        
        $company
                ->setId($idCompany)
                ->setNbOfTokens($nbOfTokens)
                ;
        
        $this->app['company.repository']->saveTokens($company);
        
        return $this->redirectRoute('company_dashboard');
    }
}
