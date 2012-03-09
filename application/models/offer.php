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
        $queryString = "SELECT DISTINCT pkItemId, fldName, fldInitialPrice, fldBasePrice, fldRateDecrease, fldTotalQty, fldCurrentQty, tblItem.fkVendorId, fkCampaignId, fldStartDate, fldEndDate
            FROM tblItem
            INNER JOIN tblItemCampaign 
            ON tblItem.pkItemId = tblItemCampaign.fkItemId
            INNER JOIN tblCampaign
            ON tblItemCampaign.fkCampaignId = tblCampaign.pkCampaignId
            WHERE fldEndDate > NOW()
            AND fldStartDate <= NOW()";

        $query = $this->db->query($queryString);
        $offers_all = array();
        foreach ($query->result() as $item) {
            $itemObject = new itemModel();
            $offer = new offer();
            $itemObject->itemId = $item->pkItemId;
            $itemObject->name = $item->fldName;
            $itemObject->initPrice = $item->fldInitialPrice;
            $itemObject->basePrice = $item->fldBasePrice;
            $itemObject->rateDecrease = $item->fldRateDecrease;
            $itemObject->totalQty = $item->fldTotalQty;
            $itemObject->currentQty = $item->fldCurrentQty;
            $itemObject->vendorId = $item->fkVendorId;
            $offer->campaignId = $item->fkCampaignId;
            $offer->startDate = $item->fldStartDate;
            $offer->endDate = $item->fldEndDate;
            $itemObject->userInCohort = 0;
            $offer->item = $itemObject;
            array_push($offers_all, $offer);
        }
        
        return $offers_all;
    }
    
    /*
     * get_available_offers_for_user
     * 
     * gets all offers that have space and have not been joined by the current user
     * User (Joins)-> Cohort (For)-> Campaign
     * 
     */
    function get_available_offers_for_user(){
        $session = $this->session->all_userdata();
        $username = $session['username'];

        $queryString = "SELECT pkItemId, fldName, fldInitialPrice, fldBasePrice, fldRateDecrease, fldTotalQty, fldCurrentQty, tblItem.fkVendorId, tblItemCampaign.fkCampaignId, fldStartDate, fldEndDate 
            FROM tblItem
            LEFT JOIN tblItemCampaign
            ON tblItem.pkItemId = tblItemCampaign.fkItemId
            LEFT JOIN tblCampaignCohort
            ON tblItemCampaign.fkCampaignId = tblCampaignCohort.fkCampaignId
            LEFT JOIN tblConsumerCohort
            ON tblConsumerCohort.fkCohortId = tblCampaignCohort.fkCohortId
            LEFT JOIN tblCampaign
            ON tblItemCampaign.fkCampaignId = tblCampaign.pkCampaignId
            WHERE pkItemId NOT IN(
                SELECT tblItemCampaign.fkItemId FROM tblItemCampaign 
                INNER JOIN tblCampaignCohort
                ON tblItemCampaign.fkCampaignId = tblCampaignCohort.fkCampaignId
                INNER JOIN tblConsumerCohort
                ON tblConsumerCohort.fkCohortId = tblCampaignCohort.fkCohortId
                WHERE fkUsername = '$username')
            AND tblItemCampaign.fkCampaignId IS NOT NULL
            AND fldEndDate > NOW()
            AND fldStartDate <= NOW()";
        $query = $this->db->query($queryString);
        $offers_all = array();
        foreach ($query->result() as $item) {
            $itemObject = new itemModel();
            $offer = new offer();
            $itemObject->itemId = $item->pkItemId;
            $itemObject->name = $item->fldName;
            $itemObject->initPrice = $item->fldInitialPrice;
            $itemObject->basePrice = $item->fldBasePrice;
            $itemObject->rateDecrease = $item->fldRateDecrease;
            $itemObject->totalQty = $item->fldTotalQty;
            $itemObject->currentQty = $item->fldCurrentQty;
            $itemObject->vendorId = $item->fkVendorId;
            $offer->campaignId = $item->fkCampaignId;
            $offer->startDate = $item->fldStartDate;
            $offer->endDate = $item->fldEndDate;
            $itemObject->userInCohort = 0;
            $offer->item = $itemObject;
            array_push($offers_all, $offer);
        }
        return $offers_all;
    }
    
    
    /*
     * get_enrolled_offers_for_user
     * 
     * gets all offers that the user has enrolled in
     * User (Joins)-> Cohort (For)-> Campaign
     * 
     */
    function get_enrolled_offers_for_user() {
        $session = $this->session->all_userdata();
        $username = $session['username'];

        $queryString = "SELECT pkItemId, fldName, fldInitialPrice, fldBasePrice, fldRateDecrease, fldTotalQty, fldCurrentQty, tblItem.fkVendorId, tblItemCampaign.fkCampaignId , fldStartDate, fldEndDate
            FROM tblItem
            INNER JOIN tblItemCampaign
            ON tblItem.pkItemId = tblItemCampaign.fkItemId
            INNER JOIN tblCampaignCohort
            ON tblItemCampaign.fkCampaignId = tblCampaignCohort.fkCampaignId
            INNER JOIN tblConsumerCohort
            ON tblConsumerCohort.fkCohortId = tblCampaignCohort.fkCohortId
            INNER JOIN tblCampaign
            ON tblItemCampaign.fkCampaignId = tblCampaign.pkCampaignId
            WHERE pkItemId IN(
                SELECT tblItemCampaign.fkItemId FROM tblItemCampaign 
                INNER JOIN tblCampaignCohort
                ON tblItemCampaign.fkCampaignId = tblCampaignCohort.fkCampaignId
                INNER JOIN tblConsumerCohort
                ON tblConsumerCohort.fkCohortId = tblCampaignCohort.fkCohortId
                WHERE fkUsername = '$username')
            AND fkUsername = '$username'
            AND tblItemCampaign.fkCampaignId IS NOT NULL
            AND fldEndDate > NOW()
            AND fldStartDate <= NOW()";
        $query = $this->db->query($queryString);
        $offers_all = array();
        foreach ($query->result() as $item) {
            $itemObject = new itemModel();
            $offer = new offer();
            $itemObject->itemId = $item->pkItemId;
            $itemObject->name = $item->fldName;
            $itemObject->initPrice = $item->fldInitialPrice;
            $itemObject->basePrice = $item->fldBasePrice;
            $itemObject->rateDecrease = $item->fldRateDecrease;
            $itemObject->totalQty = $item->fldTotalQty;
            $itemObject->currentQty = $item->fldCurrentQty;
            $itemObject->cohortId = $item->fkCohortId;
            $itemObject->vendorId = $item->fkVendorId;
            $offer->campaignId = $item->fkCampaignId;
            $offer->startDate = $item->fldStartDate;
            $offer->endDate = $item->fldEndDate;
            $itemObject->userInCohort = 1;
            $offer->item = $itemObject;
            
            array_push($offers_all, $offer);
        }

        return $offers_all;
    }

    function create_campaign($itemId) {
        $this->item->itemId = $itemId;
        $this->startDate = $this->input->post('startDate');
        $this->endDate = $this->input->post('endDate');

        $now = strtotime('now');

        //Check that dates are not in the past
        if (strtotime($this->startDate) < $now) {
            print_r(strtotime($this->startDate));
            echo "<br>";
            print_r($now);
            throw new Exception('start date before now');
        }


        if (strtotime($this->startDate) > strtotime($this->endDate)) {
            throw new Exception('start date after end date');
        }
        
        
       
        
        $this->db->trans_start();

        //check that no other campaigns are running during the dates specified
        $query = $this->db->query("SELECT pkCampaignId, fldStartDate, fldEndDate FROM tblCampaign WHERE fkVendorId = $this->vendorId");
        foreach ($query->result() as $campaign) {
            //check if start date or end date clashses
            if ($this->check_in_range($campaign->fldStartDate, $campaign->fldEndDate, $this->startDate) || $this->check_in_range($campaign->fldStartDate, $campaign->fldEndDate, $this->endDate)) {
                throw new Exception('date collision');
            }
        }

        //validate that item has enough qty to create a new campaign
        $itemQty = $this->db->query("SELECT fldCurrentQty FROM tblItem WHERE pkItemId = " . $this->item->itemId);
        $currentQty = $itemQty->row()->fldCurrentQty;
        if ($currentQty < 5) {
            throw new Exception('Not Enough Items to create Campaign (Min: 5)');
        }
        $this->db->query("INSERT INTO tblCampaign (fkVendorId, fldStartDate, fldEndDate) VALUES('$this->vendorId','$this->startDate', '$this->endDate')");
        $this->campaignId = $this->db->insert_id();
        $this->db->query("INSERT INTO tblItemCampaign (fkItemId, fkCampaignId) VALUES('" . $this->item->itemId . "', '$this->campaignId')");
        $this->db->trans_complete();

        return $this;
    }

    private function check_in_range($start_date, $end_date, $date_from_user) {
        // Convert to timestamp
        $start_ts = strtotime($start_date);
        $end_ts = strtotime($end_date);
        $user_ts = strtotime($date_from_user);

        // Check that user date is between start & end
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
    }

}
