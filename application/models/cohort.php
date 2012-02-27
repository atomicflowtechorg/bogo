<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cohort
 *
 * @author lpaulger
 */
class cohort extends CI_Model {

    var $cohortId = '';
    var $experation = '';
    var $maxSize = 5; //Currently fixed at 5
    var $itemId = '';
    var $members = array();

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function create_cohort($itemId) {
        $this->itemId = $itemId;
        $session = $this->session->all_userdata();
        $username = $session['username'];
        $date = new DateTime();
        $date->add(new DateInterval('P1D'));
        $date->setTimezone( new DateTimeZone('America/New_York'));
        
        $this->experation = $date->format('Y-m-d H:m:s');
        $this->db->trans_start();
        //check item has 5 qty remaining (always reserved 5 qty for a new cohort
        $qtyResult = $this->db->query("SELECT fldTotalQty FROM tblItem WHERE pkItemId = $this->itemId");
        $cohortCountResult = $this->db->query("SELECT COUNT(*) AS Count FROM tblItemCohort WHERE fkItemId = $this->itemId");
        $cohortExistsQuery = $query = $this->db->query("SELECT EXISTS ( 
                                                        SELECT tblConsumerCohort.fkCohortId FROM tblConsumerCohort 
                                                        INNER JOIN tblItemCohort 
                                                        ON tblItemCohort.fkCohortId = tblConsumerCohort.fkCohortId
                                                        WHERE tblItemCohort.fkItemId = $this->itemId
                                                        AND tblConsumerCohort.fkUsername = '$username')
                                                        AS cohortExists");
        $totalQty = $qtyResult->row()->fldTotalQty;
        $currentCohorts = $cohortCountResult->row()->Count;
        $exists = $cohortExistsQuery->row()->cohortExists;
        
        //If no room for another cohort, OR user and cohort relation already exist
        if ($currentCohorts > 0 && ($totalQty / $currentCohorts) < 5 || $exists > 0) {
            throw new Exception('not enough items for new cohort OR user already in a cohort for this item');
        } else {
            $query = $this->db->query("INSERT INTO tblCohort (fldExperation, fldMaxSize) VALUES ('$this->experation',$this->maxSize)");
            $this->cohortId = $this->db->insert_id();
            $query = $this->db->query("INSERT INTO tblItemCohort (fkItemId, fkCohortId) VALUES ($this->itemId, $this->cohortId)");
            array_push($this->members, $username);
            $query = $this->db->query("INSERT INTO tblConsumerCohort (fkUsername, fkCohortId) VALUES ('$username', $this->cohortId)");
            $query = $this->db->query("UPDATE tblItem SET fldCurrentQty = ($totalQty-5) WHERE pkItemId = $this->itemId");
        }
        $this->db->trans_complete();

        return $this;
    }

}
