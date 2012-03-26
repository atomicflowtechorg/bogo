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
class user extends CI_Controller {
    
    //View Current Deals
    public function index() {
        $this->load->model('vendorModel');
        $this->load->model('itemmodel');
        $this->load->model('deal');
        
        $data = array();

        try {
            //$data['items'] = $this->itemmodel->get_all_items();
            $data['deals'] = $this->deal->get_all_deals();
            $data['vendors'] = $this->vendorModel->get_all_vendors();
            $data['currentVendor'] = $this->vendorModel->get_vendor($data['vendors'][0]->id);
        } catch (Exception $e) {
            $data['exception'] = 'Caught exception: ' . $e->getMessage() . "\n";
        }
        $data['viewLocation'] = 'user/currentDeals';
        $data['data'] = $data;
        $this->load->view('dashboard/index', $data);
    }

    //View Vendors for user
    public function view_vendors() {
        $this->load->model('vendorModel');
        $this->load->model('itemmodel');
        $this->load->model('deal');
        
        $data = array();

        try {
            $data['vendors'] = $this->vendorModel->get_all_vendors();
            $data['currentVendor'] = $this->vendorModel->get_vendor($data['vendors'][0]->id);
        } catch (Exception $e) {
            $data['exception'] = 'Caught exception: ' . $e->getMessage() . "\n";
        }
        $data['viewLocation'] = 'user/viewVendors';
        $data['data'] = $data;
        $this->load->view('dashboard/index', $data);
    }
}