<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends MY_Controller {

        public function __construct(){
		parent::__construct();
		$this->load->helper('html_builder/role_helper');
		$this->load->helper('validation/dash_validate_helper');
        }

	public function view()
	{
		$this->data['title'] = "Roles";
		$this->data['content'] = role_add($this);
                $this->data['load_js'] = 'roles';
        	$this->data['use_js'] = 'roles_page';
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

        public function get_roles(){
        $rows = array();
        $user_access = $this->user->get_roles();
        foreach($user_access as $access){
                if(isset($access["child"])){
                        foreach($access["child"] as $child){
                                $rows[] = array($child["text"],$child["description"],'<input type = "checkbox" name="roles[]" value "'.$child["controller"].'|'.$child["function"].'"/>');
                        }
                }else{
                        $rows[] = array($access["text"],$access["description"],'<input type = "checkbox" name="roles[]" value "'.$access["controller"].'|'.$access["function"].'"/>');
                }
        }
        $thead = array("Role"=>"","Description"=>"","Action"=>"");
        $config['type'] = "List";
        $config['thead'] = $thead;
        $config['rows'] = $rows;
        $config['tbl_id'] = 'list_tbl';
        $this->load->library('layout',$config);
        $layout = $this->layout->get_layout();
        $code = table($layout,$this);
        echo $code;
        }

}
