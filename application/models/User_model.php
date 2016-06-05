<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function get_roles(){
		
		return array(
			array(
				"icon" => "fa fa-bar-chart-o",
 				"text" => "Dashboard Test",
				"controller" => "dashboard",
				"description" => "description for dashboard sample",
				"href" => "#",
				"function" => "add",
				"child" => array(
					array(
						"text" => "Add Dashboard",
						"controller" => "Dashboard",
						"description" => "description for dashboard sample",
						"href" => "dashboard/add",
						"function" => "view"
					),
					array(
						"text" => "Add Dashboard",
	                	"controller" => "Dashboard",
	                	"description" => "description for dashboard sample",
						"href" => "dashboard/add",
        	        	"function" => "view"
					)

				)	
			),
			array(
                "icon" => "fa fa-bar-chart-o",
                "text" => "Dashboard Test",
                "controller" => "dashboard",
		        "href" => "#",
		        "description" => "description for dashboard sample",
                "function" => "add",
                "child" => array(
								 array(
                                        "text" => "Add Dashboard",
                                        "controller" => "Dashboard",
                                        "description" => "description for dashboard sample",
                                        "href" => "dashboard/add",
                                        "function" => "view"
                               	 )
                        	)
                ),	
			array(
                "icon" => "fa fa-bar-chart-o",
                "text" => "No Child",
                "description" => "description for dashboard sample",
			    "href" => "dashboard/add",
                "controller" => "dashboard",
                "function" => "add"
                )

		);
	}
	
}
