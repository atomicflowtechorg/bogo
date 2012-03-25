<?php

/**
 * @group Model
 */
class vendorModelTest extends CIUnit_TestCase {

    protected $tables = array(
        'tblVendor' => 'tblVendor'
    );
    private $_pcm;

    public function __construct($id = NULL, array $name = array(), $address = '') {
        parent::__construct($id, $name, $address);
    }

    public function setUp() {
        parent::setUp();

        /*
         * this is an example of how you would load a product model,
         * load fixture data into the test database (assuming you have the fixture yaml files filled with data for your tables),
         * and use the fixture instance variable

          $this->CI->load->model('Product_model', 'pm');
          $this->pm=$this->CI->pm;
          $this->dbfixt('users', 'products');

          the fixtures are now available in the database and so:
          $this->users_fixt;
          $this->products_fixt;

         */

        $this->CI->load->model('vendorModel');
        $this->_pcm = $this->CI->vendorModel;
    }

    public function tearDown() {
        parent::tearDown();
    }

    // ------------------------------------------------------------------------

    /**
     * @dataProvider GetCarriersProvider
     */
    public function testGetCarriers(array $attributes, $expected) {
        $actual = $this->_pcm->getCarriers($attributes);

        $this->assertEquals($expected, count($actual));
    }

    public function GetCarriersProvider() {
        return array(
            array(array('name'), 5)
        );
    }
    
    /*
     * @dataProvider getVendorById
     */
    public function testGetVendorById(array $attributes, $expected){
        $actual = $this->_pcm->getVendor($attributes['pkVendorId']);
        
        $this->assertEquals($expected, count($actual));
    }
    
    public function getVendorById(){
        return array(
            array(array('id'), 3)
        );
    }

    // ------------------------------------------------------------------------
}