<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Layout
{
	var $type 	= 	"List";	 
	var $no 	= 	0;

	var $layout = 	"";
	var $tbl_id = 	"";
	///////////////////////////////
	//////// LIST CONFIG
	var $rows  = array();
	var $thead  = array();


    function __construct($config = array())
    {
        // parent::__construct();
        if (count($config) > 0)
		{
			$this->initialize($config);
		}

    }

   	function initialize($config = array())
	{
		foreach ($config as $key => $val)
		{
			if (isset($this->$key))
			{
				$this->$key = $val;
			}
		}
	}

	function get_layout(){
		if($this->type == "List"){
			$this->layout = $this->build_list_layout();
		}
		$layout=$this->layout;
		$this->layout = "";
		return $layout;
	}

	//// LIST //////////////////////////////////////////////////
	function build_list_layout(){
		$CI =& get_instance();
						
			$CI->pm->sDiv(array("class"=>"table-responsive"));
				$tags['class'] = 'zebra';
				if($this->tbl_id != null);
					$tags['id'] = $this->tbl_id;
				$CI->pm->sTable($tags,false,true,true);
					$CI->pm->tableHead($this->thead);
					if(count($this->rows) == 0){
						$CI->pm->sRow();
							$CI->pm->cell("No results found.",array("colspan"=>"100%","align"=>"center"));
						$CI->pm->eRow();
					}
					else{
						foreach($this->rows as $cells){
							$CI->pm->sRow();
								foreach ($cells as $val) {
									$CI->pm->cell($val);
								}
							$CI->pm->eRow();
						}
					}
				$CI->pm->eTable();
			$CI->pm->eDiv();


		return $CI->pm->getCode();
	}


}

/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */