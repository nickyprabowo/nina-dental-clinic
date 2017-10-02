
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kasir extends MX_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->module('login');
    }

	public function index()
	{
        $data['content'] = 'penjualan';
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

    public function coba($page)
    {
        if(isset($page))
        {
            // To load view from another controller use this "module_name/view_name"
            $data['content'] = $page.'/'.$page;
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
