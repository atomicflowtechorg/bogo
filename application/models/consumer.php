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

    var $id = '';
    var $username = '';
    var $password = '';
    var $passwordConfirm = '';
    var $firstname = '';
    var $lastname = '';
    var $email = '';
    var $lastLoggedIn = '';
    
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    function consumer_create(){
        throw new exception("not implemented");
    }
    
    function consumer_get($username){
        throw new exception("not implemented");
    }
    
    function consumer_update($username){
        throw new exception("not implemented");
    }
    
    function consumer_join_cohort($username, $cohortId){
        throw new exception("not implemented");
    }
    
    function consumer_leave_cohort($username, $cohortId){
        throw new exception("not implemented");
    }
    
    function consumer_create_cohort($username,$itemId){
        throw new exception("not implemented");
    }
}
