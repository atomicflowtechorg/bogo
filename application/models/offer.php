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

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->cohorts = array();
        $this->item = new item();
    }

    function get_all_offers() {
        $all_offers = array();
        $available_offers = $this->get_available_offers_for_user();
        $enrolled_offers = $this->get_enrolled_offers_for_user();
        $all_offers = array_merge($available_offers,$all_offers);
        $all_offers = array_merge($enrolled_offers,$all_offers);

        return $all_offers;
    }

    function get_available_offers_for_user() {
        $session = $this->session->all_userdata();
        $username = $session['username'];

        $queryString = "SELECT DISTINCT pkItemId, fldName, fldInitialPrice, fldBasePrice, fldRateDecrease, fldTotalQty, fldCurrentQty, fldEnabled, fkVendorId 
            FROM tblItem
            LEFT JOIN tblItemCohort
            ON tblItem.pkItemId = tblItemCohort.fkItemId
            LEFT JOIN tblConsumerCohort
            ON tblConsumerCohort.fkCohortId = tblItemCohort.fkCohortId
            WHERE pkItemId NOT IN(
            SELECT fkItemId FROM tblItemCohort 
            INNER JOIN tblConsumerCohort
            ON tblConsumerCohort.fkCohortId = tblItemCohort.fkCohortId
            WHERE fkUsername = '$username'
            )AND fldEnabled = 1";
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
            $itemObject->userInCohort = 0;
            array_push($items_all, $itemObject);
        }
        
        return $items_all;
    }

    function get_enrolled_offers_for_user() {
        $session = $this->session->all_userdata();
        $username = $session['username'];

        $queryString = "SELECT pkItemId, fldName, fldInitialPrice, fldBasePrice, fldRateDecrease, fldTotalQty, fldCurrentQty, fldEnabled, fkVendorId, tblConsumerCohort.fkCohortId 
            FROM tblItem
            INNER JOIN tblItemCohort
            ON tblItem.pkItemId = tblItemCohort.fkItemId
            INNER JOIN tblConsumerCohort
            ON tblConsumerCohort.fkCohortId = tblItemCohort.fkCohortId
            WHERE pkItemId IN(
            SELECT fkItemId FROM tblItemCohort 
            INNER JOIN tblConsumerCohort
            ON tblConsumerCohort.fkCohortId = tblItemCohort.fkCohortId
            WHERE fkUsername = '$username'
            )AND fldEnabled = 1 
            AND fkUsername = '$username'";
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
            $itemObject->cohortId = $item->fkCohortId;
            $itemObject->vendorId = $item->fkVendorId;
            $itemObject->userInCohort = 1;
            array_push($items_all, $itemObject);
        }
        
        return $items_all;
    }

}
