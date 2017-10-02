<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class User extends MX_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper(array('url','form','html'));
        $this->load->library('session');
        $this->load->module('login');
		    $this->load->model('Usermodel');
        $this->login->is_logged_in();
    }
 
    public function index()
    {
    	  $data['content'] = 'user';
        $data['navbar'] = 'navbar';
        $data['sidebar'] = 'sidebar';
		    $this->load->view('template', $data);
    }
	
	public function getUser()
  {

      $where = array(
      			'id_user' => $this->session->userdata('user_id')
      		);

      $user = $this->Usermodel->get($where,null,null);

      if($user->num_rows()==0)
	   {
        
        $data = 'No data';

      }
      else
      {
	  	$row = $user->row();
	  	$data = array(
						'id_user'    => $row->id_user,
						'username'   => $row->username,
						'peran'  	   => $row->peran,
						'edited'	   => false
					);
	  }

    $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
  }
	
	public function saveSetting()
  {
		
    $post_data = json_decode(file_get_contents('php://input'));

    $cekPassword = array(

              'id_user'  => $post_data->id_user,
              'password' => md5($post_data->oldPassword)

          );

    $cekPass = $this->Usermodel->get($cekPassword, null, null);

    if($cekPass->num_rows() == 1)
    {
      $data = array(
            'username'  => $post_data->username,
            'password' => md5($post_data->newPassword)
        );

      //replace the password
      $savePass = $this->Usermodel->save($data, $cekPassword);

      $message = array(
            'status'  => true,
            'message' => 'Data berhasil disimpan'
          );
    }
    else
    {

      $message = array(
            'status'  => false,
            'message' => 'Password lama Anda tidak cocok, Hubungi Administrator Anda untuk mereset password Anda'
          );

    }

    $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($message));

	}
	
}