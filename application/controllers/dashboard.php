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
       $this->load->model('offer') ;
       $this->load->model('vendor') ;
       $data = array();
//       $data['offers'] = $this->offer->offer_get_current();
//       $data['vendors'] = $this->vendor->get_all_vendors();
       
       $this->load->view('dashboard/index',$data);
    }
}