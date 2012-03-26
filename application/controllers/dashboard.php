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
class Dashboard extends CI_Controller {

    public function index() {
        $this->load->model('deal');
        $this->load->model('vendorModel');
        $this->load->model('itemmodel');

        $data = array();
//       $data['deals'] = $this->deal->deal_get_current();

        try {
            $data['items'] = $this->itemmodel->get_all_items();
            $data['vendors'] = $this->vendorModel->get_all_vendors();
            $data['currentVendor'] = $this->vendorModel->get_vendor($data['vendors'][0]->id);
        } catch (Exception $e) {
            $data['exception'] = 'Caught exception: ' . $e->getMessage() . "\n";
        }

        $data['viewLocation'] = 'dashboard/welcome';
        $data['data'] = $data;
        $this->load->view('dashboard/index', $data);
    }

}