<?php
class MY_Controller extends CI_Controller{
    public $data;

    public function __construct(){
        parent::__construct();
	    $this->topNavCss();
	    $this->links();
	    $this->footerJs();
    }

    public function topNavCss(){
		$this->data['top_nav_css'] = array(
			'public/css/bootstrap.min.css',
			'public/css/font-awesome.min.css',
			'public/css/ionicons.min.css',
			'public/css/admin-lte.css',
			'public/css/daterangepicker/daterangepicker-bs3.css',
			'public/css/iCheck/all.css',
			'public/css/colorpicker/bootstrap-colorpicker.min.css',
			'public/css/timepicker/bootstrap-timepicker.min.css'
		);
    }

    public function footerJs(){
    	$this->data['footer_js'] = array(
    		'public/js/bootstrap.min.js',
    		'public/js/admin-lte/app.js',
		'public/js/plugins/input-mask/jquery.inputmask.js',
		'public/js/plugins/input-mask/jquery.inputmask.date.extensions.js',
		'public/js/plugins/input-mask/jquery.inputmask.extensions.js',
		'public/js/plugins/daterangepicker/daterangepicker.js',
		'public/js/plugins/colorpicker/bootstrap-colorpicker.min.js',
		'public/js/plugins/timepicker/bootstrap-timepicker.min.js',
		'public/js/site_init.js'
		
    	);
    }

    public function links(){
	$this->data['links'] = array(
		array(
			"icon" => "fa fa-bar-chart-o",
 			"text" => "Dashboard Test",
			"controller" => "dashboard",
			"href" => "#",
			"function" => "add",
			"child" => array(
				array(
					"text" => "Add Dashboard",
					"controller" => "Dashboard",
					"href" => "dashboard/add",
					"function" => "view"
				),
				array(
					"text" => "Add Dashboard",
	                                "controller" => "Dashboard",
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
                        "function" => "add",
                        "child" => array(
				 array(
                                        "text" => "Add Dashboard",
                                        "controller" => "Dashboard",
                                        "href" => "dashboard/add",
                                        "function" => "view"
                                )
                        )
                ),	
		array(
                        "icon" => "fa fa-bar-chart-o",
                        "text" => "No Child",
			"href" => "dashboard/add",
                        "controller" => "dashboard",
                        "function" => "add"
                )

	);
    }

}

