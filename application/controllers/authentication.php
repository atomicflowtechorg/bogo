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
        $this->load->helper('form');

        $this->load->library('form_validation');

        $this->load->model('consumer');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('authentication/consumer/register');
        } else {
            $consumer = $this->consumer->consumer_create();
            $this->load->view('authentication/consumer/registerSuccess');
        }
    }

}