<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Repository;

use Entity\Order;

/**
 * Description of OrderRepository
 *
 * @author wbute
 */
class OrderRepository extends RepositoryAbstract{
   
    public function getTable()
    {
        return 'orders';
    }
    
    public function save(Order $order)
    {
        
        $data = [
            'id_company' => $order->getIdCompany(),
            'amount' => $order->getAmount(),
            'nb_of_tokens' => $order->getNbOfTokens()
        ];

        $where = !empty($order->getId())
            ? ['id' => $order->getId()]
            : null
        ;

        $this->persist($data, $where);
    }
    
        public function buildFromArray(array $dbOrder)
    {
        $order = new Order();

        $order
            ->setId($dbOrder['id'])
            ->setIdCompany($dbOrder['id_company'])
            ->setNbOfTokens($dbOrder['nb_of_tokens'])
            ->setAmount($dbOrder['amount'])
            ->setOrderDate($dbOrder['order_date'])
            ->setStatus($dbOrder['status'])
        ;

        return $order;
    }
    
    public function findOrderByIdCompany($idCompany)
    {
        $dbOrders = $this->db->fetchAll(
                'SELECT * FROM orders WHERE id_company = :id' ,
                [':id' => $idCompany]
        );
        
        $orders = [];
        
        foreach ($dbOrders as $dbOrder){
            $order = $this->buildFromArray($dbOrder);
            
            $orders[] = $order;
        }
        
        return $orders;
    }
    
    public function findAll()
    {
        $dbOrders = $this->db->fetchAll(
                'SELECT * FROM orders');
        
        $orders = [];
        
        foreach ($dbOrders as $dbOrder){
            $order = $this->buildFromArray($dbOrder);
            
            $orders[] = $order;
        }
        
        return $orders;
    }
    
    public function find($id)
    {
        
        $dbOrder = $this->db->fetchAssoc(
            'SELECT * FROM orders WHERE id = :id',
            [':id' => $id]
        );

        if (!empty($dbOrder)) {
            return $this->buildFromArray($dbOrder);
        }

        return null;
    }
}
