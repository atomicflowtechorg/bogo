<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dashboard
 *
 * @author brandonjf
 */
class Tiler extends CI_Controller {
    public function index() {
       $this->load->model('offer');
       $this->load->model('vendorModel');
       $this->load->model('item');
       
       $data = array();
//       $data['offers'] = $this->offer->offer_get_current();
       $data['viewLocation'] = 'dashboard/tiler';
       $data['data'] = $data;
       $this->load->view('dashboard/index',$data);
    }
}