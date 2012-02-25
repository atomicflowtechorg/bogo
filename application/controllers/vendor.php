<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of authentication
 *
 * @author lpaulger
 */
class Vendor extends CI_Controller {

    //Vendor dashboard
    public function index() {
        $this->load->model('item');
        $this->load->model('vendorModel');

        //TODO: implement vendor login and session create
        $vendorId = 1;

        $data['vendor'] = $this->vendorModel->get_vendor($vendorId);
        $data['items'] = $this->item->get_items_for_vendor($vendorId);

        $data['viewLocation'] = 'vendor/dashboard';
        $data['data'] = $data;
        $this->load->view('dashboard/index', $data);
    }

    public function add_item() {

        $this->load->model('item');

        $this->load->helper(array('form', 'file'));

        $this->load->library('form_validation');

        //TODO: implement vendor login and session create
        $vendorId = 1;

        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('initPrice', 'Initial Price', 'trim|required|xss_clean');
        $this->form_validation->set_rules('basePrice', 'Base Price', 'trim|required|xss_clean');
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $data['viewLocation'] = 'vendor/addItem';
            $data['data'] = $data;
            $this->load->view('dashboard/index', $data);
        } else {
            $data['item'] = $this->item->add_item();
            $data['items'] = $this->item->get_items_for_vendor($vendorId);
            $data['viewLocation'] = 'vendor/addItemSuccess';
            $data['data'] = $data;
            $this->load->view('dashboard/index', $data);
        }
    }

    public function enable_item($itemId) {
        $this->load->model('item');
        $this->item->enable_item($itemId);
        
        //TODO: implement vendor login and session create
        $vendorId = 1;
        $data['items'] = $this->item->get_items_for_vendor($vendorId);
        
        redirect('/vendor/', 'location');
    }

    public function disable_item($itemId) {
        $this->load->model('item');
        $this->item->disable_item($itemId);
        
        redirect('/vendor/', 'location');
    }

}
