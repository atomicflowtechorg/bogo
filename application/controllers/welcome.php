<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of welcome
 *
 * @author lpaulger
 */
class Welcome extends CI_Controller {

    public function index() {
        $this->load->model('deal');
        $this->load->model('vendorModel');
        $this->load->model('itemmodel');

        $data = array();
//       $data['deals'] = $this->deal->deal_get_current();

        try {
            $data['vendors'] = $this->vendorModel->get_all_vendors();
            $data['currentVendor'] = $this->vendorModel->get_vendor($data['vendors'][0]->id);
        } catch (Exception $e) {
            $data['exception'] = 'Caught exception: ' . $e->getMessage() . "\n";
        }

        $data['viewLocation'] = 'welcome';
        $data['data'] = $data;
        $this->load->view('layout/index', $data);
    }

}