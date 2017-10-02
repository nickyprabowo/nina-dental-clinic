<?php
/**
*
*
* Obat
*
**/
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Obat extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->library('session');
        $this->load->module('login');
        $this->login->is_logged_in();
    }

    public function index()
    {
        //$data['obat'] = $this->obat_m->find();
        $data['content'] = 'obat';
        $data['navbar'] = 'navbar';
        $data['sidebar'] = 'sidebar';
        $this->load->view('template', $data);    
    }

}    