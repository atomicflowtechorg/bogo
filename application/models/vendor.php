<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vendor
 *
 * @author lpaulger
 */
class vendor extends CI_Model{
    
    var $id = '';
    var $name = '';
    var $password = '';
    var $address = '';
    
     function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
    function vendor_create(){
        throw new exception("not implemented");
    }
    
    function vendor_get($name){
        throw new exception("not implemented");
    }
    
    function vendor_get_all(){
        throw new exception("not implemented");
    }
    
    function vendor_update($name){
        throw new exception("not implemented");
    }
    
    function vendor_create_offer($itemId){
        throw new exception("not implemented");
    }
}