<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of item
 *
 * @author lpaulger
 */
class item extends CI_Model {

    var $itemId = '';
    var $initPrice = '';
    var $basePrice = '';
    var $rateDecrease = '';
    var $totalQty = '';
    var $currentQty  = '';
    var $vendorId = '';
    
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_all_items(){
        $queryString = "SELECT pkItemId, fldInitialPrice, fldBasePrice, fldRateDecrease, fldTotalQty, fldCurrentQty, fkVendorId FROM tblItem";
        $query = $this->db->query($queryString);
        $items_all = array();
        foreach($query->result()  as $item){
            $itemObject = new item();
            $itemObject->itemId = $item->pkItemId;
            $itemObject->initPrice = $item->fldInitialPrice;
            $itemObject->basePrice = $item->fldBasePrice;
            $itemObject->rateDecrease = $item->fldRateDecrease;
            $itemObject->totalQty = $item->fldTotalQty;
            $itemObject->currentQty = $item->fldCurrentQty;
            $itemObject->vendorId = $item->fkVendorId;
            array_push($items_all, $itemObject);
        }
        return $items_all;
    }
    
    function get_item($itemId){
        $queryString = "SELECT pkItemId, fldInitialPrice, fldBasePrice, fldRateDecrease, fldTotalQty, fldCurrentQty, fkVendorId FROM tblItem WHERE pkItemId=$itemId";
        $query = $this->db->query($queryString);
        if($query->num_rows() == 1){
            $item = $query->row();
            $this->itemId = $item->pkItemId;
            $this->initPrice = $item->fldInitialPrice;
            $this->basePrice = $item->fldBasePrice;
            $this->rateDecrease = $item->fldRateDecrease;
            $this->totalQty = $item->fldTotalQty;
            $this->currentQty = $item->fldCurrentQty;
            $this->vendorId = $item->fkVendorId;
            return $this;
        }
        else if($query->num_rows() > 1){
            throw new exception("Duplicate itemId for $itemId");
        }
        else{
            throw new Exception("No Items found with itemId $itemId");
        }
    }
    
    function update_item_current_qty($itemId){
        throw new Exception("Not Implemented");
    }
    
    function add_item($item){
        throw new Exception("Not Implemented");
    }
    
    function remove_item($itemId){
        throw new Exception("Not Implemented");
    }
}
