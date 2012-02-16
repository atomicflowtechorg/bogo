<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of offer
 *
 * @author lpaulger
 */
class offer extends CI_Model {
    
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    function offer_get_current(){
        throw new exception('not implemented');
    }
}
