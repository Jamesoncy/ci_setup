<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

        public function __construct(){
		parent::__construct();
		$this->load->helper('html_builder/dashboard_helper');
		$this->load->helper('validation/dash_validate_helper');
        }

	public function view()
	{
		$this->data['title'] = "Dashboard";
		$this->data['content'] = dashboard_view($this);
		$this->data['load_js'] = 'dashboard';
        	$this->data['use_js'] = 'dashboard_page';
		$this->load->view('load',$this->data);
	}

        public function add()
        {
		validate_dashboard($this);
		if ($this->form_validation->run() == FALSE)
                {
                        echo json_encode( array("result" => "invalid","error" => validation_errors()));
                }
                else
                {
                        echo json_encode( array("result" => "success"));
                }
        }

}
