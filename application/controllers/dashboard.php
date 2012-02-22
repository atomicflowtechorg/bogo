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
       $this->load->model('offer');
       $this->load->model('vendor');
       $this->load->model('item');
       
       $data = array();
//       $data['offers'] = $this->offer->offer_get_current();
       $data['items'] = $this->item->get_all_items();
       $data['vendors'] = $this->vendor->get_all_vendors();
       
       $data['currentVendor'] = $this->vendor->get_vendor($data['vendors'][0]->id);
       
       $data['currentItem'] = $this->item->get_item($data['items'][0]->itemId);
       $data['viewLocation'] = 'dashboard/welcome';
       $data['data'] = array("");
       $this->load->view('dashboard/index',$data);
    }
}