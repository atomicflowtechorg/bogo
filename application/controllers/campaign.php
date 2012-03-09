<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dashboard
 *
 * @author lpaulger
 */
class campaign extends CI_Controller {
    public function index() {
        
    }
    public function view_campaign($campaignId){
        $this->load->model('offer');
        $this->load->model('cohort');
        
        try {
            $data['item'] = $this->itemmodel->get_item_for_campaign($campaignId);
            $data['cohorts'] = $this->cohort->get_cohorts_for_campaign($campaignId);
        } catch (Exception $e) {
            $data['exception'] = 'Caught exception: ' . $e->getMessage() . "\n";
        }
        
        $data['viewLocation'] = 'template/item/details';
        $data['data'] = $data;
        $this->load->view('dashboard/index', $data);
    }
    
    public function join_cohort($cohortId){
        $this->load->model('cohort');      
        try {
            $data['cohort'] = $this->cohort->join_cohort($cohortId);
        } catch (Exception $e) {
            $data['exception'] = 'Caught exception: ' . $e->getMessage() . "\n";
        }
        
        $data['viewLocation'] = 'template/cohort/join';
        $data['data'] = $data;
        $this->load->view('dashboard/index', $data);
    }
}