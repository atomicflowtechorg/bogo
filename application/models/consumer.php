<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of consumer
 *
 * @author lpaulger
 */
class consumer extends CI_Model {

    var $username = '';
    var $password = '';
    var $passwordConfirm = '';
    var $firstName = '';
    var $lastName = '';
    var $email = '';
    var $state = '';
    var $city = '';
    var $lastLoggedIn = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function create_consumer() {
        $this->username = $this->input->post('username');
        $this->password = $this->input->post('password');
        $this->passwordConfirm = $this->input->post('passwordConfirm');
        $this->firstName = $this->input->post('firstName');
        $this->lastName = $this->input->post('lastName');
        $this->email = $this->input->post('email');
        $this->state = $this->input->post('state');
        $this->city = $this->input->post('city');

        $exists = $this->check_user_exists($this->username);

        if (!$exists) {

            $this->db->trans_start();
            $this->db->query("INSERT INTO tblConsumer (pkUsername, fldPassword, fldFirstName, fldLastName, fldEmail ) VALUES ('$this->username','$this->password','$this->firstName','$this->lastName','$this->email')");

            $locationResult = $this->db->query("SELECT DISTINCT pkLocationId FROM tblLocation WHERE fldState = '$this->state' AND fldCity = '$this->city'");
            if ($locationResult->num_rows() == 0) {
                $this->db->query("INSERT INTO tblLocation (fldState, fldCity) VALUES ('$this->state','$this->city')");
                $locationId = $this->db->insert_id();
                $this->db->query("INSERT INTO tblConsumerLocation (fkUsername, fkLocationId) VALUES ('$this->username','$locationId')");
            } else if ($locationResult->num_rows() > 1) {
                throw new exception("Duplicate location");
            } else {//Just update consumerLocation if location exists
                foreach ($locationResult->result_array() as $row) {
                    $locationId = $row['pkLocationId'];
                }
                $this->db->query("INSERT INTO tblConsumerLocation (fkUsername, fkLocationId) VALUES ('$this->username','$locationId')");
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                // generate an error... or use the log_message() function to log your error
                throw new exception("transaction fail");
            }
        } else {
            throw new exception("this username: $this->username already exists");
        }

        return $this;
    }

    function get_consumer($username) {
        throw new exception("not implemented");
    }

    function signin_consumer() {
        $this->username = $this->input->post('username');
        $this->password = $this->input->post('password');

        $queryString = "SELECT pkUsername, fldPassword, fldFirstName, fldLastName,fldEmail, fldCity, fldState FROM tblConsumer 
                        INNER JOIN tblConsumerLocation ON tblConsumer.pkUsername= tblConsumerLocation.fkUsername
                        INNER JOIN tblLocation ON tblLocation.pkLocationId = tblConsumerLocation.fkLocationId
                        WHERE pkUsername = '$this->username' AND fldPassword = '$this->password'";
        $query = $this->db->query($queryString);
        if ($query->num_rows() == 1) {
            $consumer = $query->row();
            $this->username = $consumer->pkUsername;
            $this->password = $consumer->fldPassword;
            $this->firstName = $consumer->fldFirstName;
            $this->lastName = $consumer->fldLastName;
            $this->email = $consumer->fldEmail;
            $this->city = $consumer->fldCity;
            $this->state = $consumer->fldState;
            //TODO: set last logged in
            //$this->lastLoggedIn = date();

            //set session
            $sessionData = array(
                'username' => $this->username,
                'firstname' => $this->firstName,
                'email' => $this->email,
                'logged_in' => TRUE
            );

            $this->session->set_userdata($sessionData);

            return $this;
        } else if ($query->num_rows() > 1) {
            throw new exception("Too many results");
        } else {
            throw new Exception("Username:$this->username or Password incorrect");
        }
    }

    function consumer_update_consumer($username) {
        throw new exception("not implemented");
    }

    function join_consumer_cohort($username, $cohortId) {
        throw new exception("not implemented");
    }

    function leave_consumer_cohort($username, $cohortId) {
        throw new exception("not implemented");
    }

    function create_consumer_cohort($username, $itemId) {
        throw new exception("not implemented");
    }

    private function check_user_exists($username) {
        $queryString = "SELECT pkUsername FROM tblConsumer WHERE pkUsername = '$username'";
        $query = $this->db->query($queryString);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
