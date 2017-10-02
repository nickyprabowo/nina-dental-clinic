<?php
/**
*
*
* Pizza Hut Delivery Controller
*
*
**/
?>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->library('session');
        $this->load->model('user_m');
    }

	public function index()
	{
        $data['content'] = 'login';
        $data['navbar'] = null;
        $data['sidebar'] = null;
		$this->load->view('template', $data);    
	}

	function validate()
    {
        $username   = $this->input->post('username');
        $password   = $this->input->post('password');
        
        //$result = $this->user_m->login($username, $password);
        //print_r($result);
		$result['_id']='1';
		$result['nama']='admin';
		$result['jabatan']='kasir';
        if($result != null)
        {
           
				var_dump($value);
                $sessions   = array(
                                'user_id'    => $result['_id'],
                                'username'  => $result['nama'],
                                'role'      => $result['jabatan'],
                                'logged_in'  => TRUE
                            );

                $this->session->set_userdata($sessions);
                //print_r($this->session->username);
                if($sessions['role'] == 'kasir')
                {
                    redirect('index.php/admin');
                }
                else
                    redirect('');
            

        }
        else
        {
            $this->session->set_flashdata('message', 'Username/password salah');
            $this->index();
        }       
    }

    function is_logged_in()
    {
        $logged_in = $this->session->userdata('logged_in');
        if(!isset($logged_in) || $logged_in != true)
        {
            $link = base_url();
            echo "You don\'t have permission to access this page. <a href=$link>Login</a>";    
            die();      
            //$this->load->view('login_form');
        }       
    }   
    
    function logout()
	{
        $items = array('user_id','username','role','logged_in');
		$this->session->unset_userdata($items);
        redirect('');
	}
}
