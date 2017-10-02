<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Admin extends MX_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->library('session');
        // Akses modul lain
        $this->load->module('login');
        // akses method di di modul lain
        $this->login->is_logged_in();
    }
 
    public function index()
    {
    	$data['content'] = 'dashboard';
        $data['navbar'] = 'navbar';
        $data['sidebar'] = 'sidebar';
		$this->load->view('template', $data);
    }
}