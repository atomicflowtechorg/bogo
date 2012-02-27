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
class Consumer extends CI_Controller {

    public function index() {
        $this->load->model('vendorModel');
        $this->load->model('itemmodel');
        $this->load->model('offer');
        
        $data = array();
        try {
            //$data['items'] = $this->itemmodel->get_all_items();
            $data['offers'] = $this->offer->get_all_offers();
            $data['vendors'] = $this->vendorModel->get_all_vendors();
            $data['currentVendor'] = $this->vendorModel->get_vendor($data['vendors'][0]->id);
        } catch (Exception $e) {
            $data['exception'] = 'Caught exception: ' . $e->getMessage() . "\n";
        }
        $data['viewLocation'] = 'consumer/currentDeals';
        $data['data'] = $data;
        $this->load->view('dashboard/index', $data);
    }

    public function create_cohort($itemId) {
        $this->load->model('itemmodel');
        $this->load->model('cohort');

        try {
            $data['cohort'] = $this->cohort->create_cohort($itemId);
        } catch (Exception $e) {
            $data['exception'] = 'Caught exception: ' . $e->getMessage() . "\n";
        }
        
        $data['viewLocation'] = 'consumer/createOfferSuccess';
        $data['data'] = $data;
        $this->load->view('dashboard/index', $data);
    }

}