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
class Authentication extends CI_Controller {

    public function index() {
        
    }

    public function consumer_signup() {
        $this->load->helper(array('form','file'));

        $this->load->library('form_validation');

        $this->load->model('consumer');
        $this->load->model('vendor') ;
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        //$data['states'] = $this->vendor->get_vendor_states();
        $stringStates = read_file('assets/js/states.json');
        $stateObject = json_decode($stringStates, true);
        $data['states'] = array_keys($stateObject);
        //TODO: Get cities for states
        $data['cities'] = $this->vendor->get_vendor_cities_for_state($data['states'][0]);
        
        
        
        if ($this->form_validation->run() == FALSE) {
            $data['viewLocation'] = 'authentication/consumer/register';
            $data['data'] = $data;
            $this->load->view('dashboard/index',$data);
        } else {
            $consumer = $this->consumer->consumer_create();
            $data['viewLocation'] = 'authentication/consumer/registerSuccess';
            $data['data'] = $data;
            $this->load->view('dashboard/index',$data);
        }
    }

}