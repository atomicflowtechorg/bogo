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
    var $name = '';
    var $initPrice = '';
    var $basePrice = '';
    var $rateDecrease = '';
    var $totalQty = '';
    var $currentQty = '';
    var $enabled = '';
    var $userInCohort = false;
    var $vendorId = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get_all_items() {
        $queryString = "SELECT pkItemId, fldName, fldInitialPrice, fldBasePrice, fldRateDecrease, fldTotalQty, fldCurrentQty, fldEnabled, fkVendorId ,tblConsumerCohort.fkCohortId
                        FROM tblItem
                        LEFT JOIN tblItemCohort 
                        ON tblItemCohort.fkItemId = pkItemId
                        LEFT JOIN tblConsumerCohort
                        ON tblConsumerCohort.fkCohortId = tblItemCohort.fkCohortId
                        WHERE fldEnabled = 1";
        $query = $this->db->query($queryString);
        $items_all = array();
        foreach ($query->result() as $item) {
            $itemObject = new item();
            $itemObject->itemId = $item->pkItemId;
            $itemObject->name = $item->fldName;
            $itemObject->initPrice = $item->fldInitialPrice;
            $itemObject->basePrice = $item->fldBasePrice;
            $itemObject->rateDecrease = $item->fldRateDecrease;
            $itemObject->totalQty = $item->fldTotalQty;
            $itemObject->currentQty = $item->fldCurrentQty;
            $itemObject->enabled = $item->fldEnabled;
            $itemObject->vendorId = $item->fkVendorId;
            $itemObject->cohortId = $item->fkCohortId;
            array_push($items_all, $itemObject);
        }
        if(count($items_all) > 0){
           return $items_all; 
        }
        else{
            throw new exception('no available items');
        }
    }

    function get_item($itemId) {
        $queryString = "SELECT pkItemId, fldName, fldInitialPrice, fldBasePrice, fldRateDecrease, fldTotalQty, fldCurrentQty, fldEnabled, fkVendorId FROM tblItem WHERE pkItemId=$itemId";
        $query = $this->db->query($queryString);
        if ($query->num_rows() == 1) {
            $item = $query->row();
            $this->itemId = $item->pkItemId;
            $this->name = $item->fldName;
            $this->initPrice = $item->fldInitialPrice;
            $this->basePrice = $item->fldBasePrice;
            $this->rateDecrease = $item->fldRateDecrease;
            $this->totalQty = $item->fldTotalQty;
            $this->currentQty = $item->fldCurrentQty;
            $this->enabled = $item->fldEnabled;
            $this->vendorId = $item->fkVendorId;
            return $this;
        } else if ($query->num_rows() > 1) {
            throw new exception("Duplicate itemId for $itemId");
        } else {
            throw new Exception("No Items found with itemId $itemId");
        }
    }

    function get_items_for_vendor($vendorId) {
        $queryString = "SELECT pkItemId, fldName, fldInitialPrice, fldBasePrice, fldRateDecrease, fldTotalQty, fldCurrentQty, fldEnabled, fkVendorId FROM tblItem WHERE fkVendorId = $vendorId";
        $query = $this->db->query($queryString);
        $vendor_items = array();
        foreach ($query->result() as $item) {
            $itemObject = new item();
            $itemObject->itemId = $item->pkItemId;
            $itemObject->name = $item->fldName;
            $itemObject->initPrice = $item->fldInitialPrice;
            $itemObject->basePrice = $item->fldBasePrice;
            $itemObject->rateDecrease = $item->fldRateDecrease;
            $itemObject->totalQty = $item->fldTotalQty;
            $itemObject->currentQty = $item->fldCurrentQty;
            $itemObject->enabled = $item->fldEnabled;
            $itemObject->vendorId = $item->fkVendorId;
            array_push($vendor_items, $itemObject);
        }
        return $vendor_items;
    }

    function update_item_current_qty($itemId) {
        throw new Exception("Not Implemented");
    }
    
    function enable_item($itemId){
        $queryString = "UPDATE tblItem SET fldEnabled = 1 WHERE pkItemId = $itemId";
        $query = $this->db->query($queryString);
    }
    
    function disable_item($itemId){
        $queryString = "UPDATE tblItem SET fldEnabled = 0 WHERE pkItemId = $itemId";
        $query = $this->db->query($queryString);
    }

    function add_item() {
        $vendorId = 1; //TODO: load from session
        $this->name = $this->input->post('name');
        $this->initPrice = $this->input->post('initPrice');
        $this->basePrice = $this->input->post('basePrice');
        $this->rateDecrease = ($this->initPrice - $this->basePrice) / 5;
        $this->totalQty = $this->input->post('quantity');
        $this->currentQty = $this->input->post('quantity');
        $this->enabled = 0;
        $this->vendorId = $vendorId;
        
        $queryString = "INSERT INTO tblItem (fldName, fldInitialPrice, fldBasePrice, fldRateDecrease, fldTotalQty, fldCurrentQty, fkVendorId) VALUES ('$this->name', $this->initPrice, $this->basePrice, $this->rateDecrease, $this->totalQty, $this->currentQty, $this->vendorId)";
        $query = $this->db->query($queryString);
        $this->itemId = $this->db->insert_id();
        return $this;
    }

    function remove_item($itemId) {
        throw new Exception("Not Implemented");
    }

}
