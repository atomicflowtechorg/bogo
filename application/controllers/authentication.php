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

    public function signup_consumer() {
        $this->load->helper(array('form', 'file'));

        $this->load->library('form_validation');

        $this->load->model('consumer');
        $this->load->model('vendor');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passwordConfirm]|md5');
        $this->form_validation->set_rules('passwordConfirm', 'Password Confirm', 'trim|required');
        $this->form_validation->set_rules('firstName', 'First Name', 'trim|required|alpha|xss_clean');
        $this->form_validation->set_rules('lastName', 'Last Name', 'trim|required|alpha|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('state', 'State', 'trim|required|alpha|xss_clean');
        $this->form_validation->set_rules('city', 'City', 'trim|required|alpha|xss_clean');
        $stringStates = read_file('assets/js/states.json');
        $stateObject = json_decode($stringStates, true);
        $data['states'] = array_keys($stateObject);
        //TODO: Get cities for states
        $data['cities'] = $this->vendor->get_vendor_cities_for_state($data['states'][0]);



        if ($this->form_validation->run() == FALSE) {
            $data['viewLocation'] = 'authentication/consumer/register';
            $data['data'] = $data;
            $this->load->view('dashboard/index', $data);
        } else {
            $data['consumer'] = $this->consumer->create_consumer();
            $data['viewLocation'] = 'authentication/consumer/registerSuccess';
            $data['data'] = $data;
            $this->load->view('dashboard/index', $data);
        }
    }

    public function signin_consumer() {
        $this->load->helper(array('form', 'file'));

        $this->load->library('form_validation');

        $this->load->model('consumer');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['viewLocation'] = 'authentication/consumer/signin';
            $data['data'] = $data;
            $this->load->view('dashboard/index', $data);
        } else {
            try {
                $isAuthenticated = $this->consumer->signin_consumer();
            } catch (Exception $e) {
                $data['exception'] = 'Caught exception: '. $e->getMessage(). "\n";
            }




            $data['viewLocation'] = 'authentication/consumer/signinSuccess';
            $data['data'] = $data;
            $this->load->view('dashboard/index', $data);
        }
    }

}