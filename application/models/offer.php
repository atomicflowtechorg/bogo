<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of offer
 *
 * @author lpaulger
 */
class offer extends CI_Model {

    var $cohorts;
    var $item;
    var $campaignId;
    var $startDate;
    var $endDate;
    var $vendorId = 1;

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('itemmodel');
        $this->cohorts = array();
        $this->item = new itemModel();
    }

    function get_all_offers() {
        $all_offers = array();
        $session = $this->session->all_userdata();
        if (isset($session['logged_in']) && $session['logged_in'] == true) {
            $available_offers = $this->get_available_offers_for_user();
            $enrolled_offers = $this->get_enrolled_offers_for_user();
            $all_offers = array_merge($available_offers, $all_offers);
            $all_offers = array_merge($enrolled_offers, $all_offers);
        } else {
            $all_offers = $this->get_available_offers_for_unregistered_user();
        }

        return $all_offers;
    }

    function get_available_offers_for_unregistered_user() {
        $queryString = "SELECT DISTINCT pkItemId, fldName, fldInitialPrice, fldBasePrice, fldRateDecrease, fldTotalQty, fldCurrentQty, fkVendorId
                        FROM uvmcon5_Bogo.tblItem";

        $query = $this->db->query($queryString);
        $items_all = array();
        foreach ($query->result() as $item) {
            $itemObject = new itemModel();
            $itemObject->itemId = $item->pkItemId;
            $itemObject->name = $item->fldName;
            $itemObject->initPrice = $item->fldInitialPrice;
            $itemObject->basePrice = $item->fldBasePrice;
            $itemObject->rateDecrease = $item->fldRateDecrease;
            $itemObject->totalQty = $item->fldTotalQty;
            $itemObject->currentQty = $item->fldCurrentQty;
            $itemObject->vendorId = $item->fkVendorId;
            $itemObject->userInCohort = 0;
            array_push($items_all, $itemObject);
        }

        return $items_all;
    }

    function get_available_offers_for_user() {
        $session = $this->session->all_userdata();
        $username = $session['username'];

        $queryString = "SELECT DISTINCT pkItemId, fldName, fldInitialPrice, fldBasePrice, fldRateDecrease, fldTotalQty, fldCurrentQty, fkVendorId 
            FROM tblItem
            LEFT JOIN tblItemCohort
            ON tblItem.pkItemId = tblItemCohort.fkItemId
            LEFT JOIN tblConsumerCohort
            ON tblConsumerCohort.fkCohortId = tblItemCohort.fkCohortId
            WHERE pkItemId NOT IN(
            SELECT fkItemId FROM tblItemCohort 
            INNER JOIN tblConsumerCohort
            ON tblConsumerCohort.fkCohortId = tblItemCohort.fkCohortId
            WHERE fkUsername = '$username')";
        $query = $this->db->query($queryString);
        $items_all = array();
        foreach ($query->result() as $item) {
            $itemObject = new itemModel();
            $itemObject->itemId = $item->pkItemId;
            $itemObject->name = $item->fldName;
            $itemObject->initPrice = $item->fldInitialPrice;
            $itemObject->basePrice = $item->fldBasePrice;
            $itemObject->rateDecrease = $item->fldRateDecrease;
            $itemObject->totalQty = $item->fldTotalQty;
            $itemObject->currentQty = $item->fldCurrentQty;
            $itemObject->vendorId = $item->fkVendorId;
            $itemObject->userInCohort = 0;
            array_push($items_all, $itemObject);
        }

        return $items_all;
    }

    function get_enrolled_offers_for_user() {
        $session = $this->session->all_userdata();
        $username = $session['username'];

        $queryString = "SELECT pkItemId, fldName, fldInitialPrice, fldBasePrice, fldRateDecrease, fldTotalQty, fldCurrentQty, fkVendorId, tblConsumerCohort.fkCohortId 
            FROM tblItem
            INNER JOIN tblItemCohort
            ON tblItem.pkItemId = tblItemCohort.fkItemId
            INNER JOIN tblConsumerCohort
            ON tblConsumerCohort.fkCohortId = tblItemCohort.fkCohortId
            WHERE pkItemId IN(
            SELECT fkItemId FROM tblItemCohort 
            INNER JOIN tblConsumerCohort
            ON tblConsumerCohort.fkCohortId = tblItemCohort.fkCohortId
            WHERE fkUsername = '$username')
            AND fkUsername = '$username'";
        $query = $this->db->query($queryString);
        $items_all = array();
        foreach ($query->result() as $item) {
            $itemObject = new itemModel();
            $itemObject->itemId = $item->pkItemId;
            $itemObject->name = $item->fldName;
            $itemObject->initPrice = $item->fldInitialPrice;
            $itemObject->basePrice = $item->fldBasePrice;
            $itemObject->rateDecrease = $item->fldRateDecrease;
            $itemObject->totalQty = $item->fldTotalQty;
            $itemObject->currentQty = $item->fldCurrentQty;
            $itemObject->cohortId = $item->fkCohortId;
            $itemObject->vendorId = $item->fkVendorId;
            $itemObject->userInCohort = 1;
            array_push($items_all, $itemObject);
        }

        return $items_all;
    }

    function create_campaign() {
        $this->item->itemId = $this->input->post('itemId');
        $this->startDate = $this->input->post('startDate');
        $this->endDate = $this->input->post('endDate');
        
        return $this;
        
        //TODO: check that no other campaigns are running during the dates specified
        //TODO: validate that item has enough qty to create a new campaign
        
        $this->db->trans_start();
        $this->db->query("INSERT INTO tblCampaign (fkVendorId, fldStartDate, fldEndDate) VALUES('$this->vendorId','$this->startDate', '$this->endDate')");
        $this->campaignId = $this->db->insert_id();
        $this->db->query("INSERT INTO tblItemCampaign (fkItemId, fkCampaignId) VALUES('".$this->item->itemId."', '$this->campaignId')");
        $this->db->trans_complete();
        
        return $this;
    }

}
