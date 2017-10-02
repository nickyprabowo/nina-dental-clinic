<?php
/**
*
*
* Diagnosa
*
**/
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diagnosa extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->library('session');
        $this->load->module('login');
        $this->login->is_logged_in();
    }

    public function index()
    {
        $data['content'] = 'diagnosa';
        $data['navbar'] = 'navbar';
        $data['sidebar'] = 'sidebar';
        $this->load->view('template', $data);    
    }

}    