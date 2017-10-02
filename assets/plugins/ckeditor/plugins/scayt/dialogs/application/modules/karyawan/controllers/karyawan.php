<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Karyawan extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->library('session');
        $this->load->module('login');
        $this->login->is_logged_in();
    }
 
    public function index()
    {
    	$data['content'] = 'karyawan';
        $data['navbar'] = 'navbar';
        $data['sidebar'] = 'sidebar';
		$this->load->view('template', $data);
    }

    public function section($page)
    {
        if(isset($page))
        {
            $data['content'] = $page;
            $data['navbar'] = 'navbar';
            $data['sidebar'] = 'sidebar';
            $this->load->view('template', $data);
        }
        else
        {
            $data['content'] = 'blank_page';
            $data['navbar'] = 'navbar';
            $data['sidebar'] = 'sidebar';
            $this->load->view('template', $data);
        }
    }
}