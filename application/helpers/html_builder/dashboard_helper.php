<?php

function dashboard_view($CI){

$CI->pm->sDivRow();
			$CI->pm->sDivCol();
				$CI->pm->sPanel('default');
					$CI->pm->sPanelBody();
						$CI->pm->sForm('dashboard/add','POST',array('id'=>'po_search_form'));
							$CI->pm->sDivRow();
								$CI->pm->sDivCol(4);
									$CI->pm->inputGroup("PR #","pr_ref",null,null,array("class"=>"input-qty","id"=>"disc"),false);
								$CI->pm->eDivCol();
								$CI->pm->sDivCol(4,"left");
									$dates = rangeMonth(phpNow());
									$CI->pm->dateRangeGroup("Date Created","delivery_date",sql2Date($dates['start'])." - ".sql2Date($dates['end']),null,array("class"=>""),false);
								$CI->pm->eDivCol();
								
								$user = $CI->session->userdata('user');
	        					if($user['id'] == 1){
									$CI->pm->sDivCol(4,"left");
										$CI->pm->usersDrop("Created By","user_id",null,"Select user",array("id"=>"users-drop","class"=>"dropitize"));
									$CI->pm->eDivCol();
	        					}

							$CI->pm->eDivRow();
							$CI->pm->sDivRow(array("style"=>"margin-bottom:20px;"));
								$CI->pm->sDivCol(4);
									$CI->pm->inputGroup("Supplier","supplier",null,null,array("class"=>"input-qty","id"=>"disc"),false);

								$CI->pm->eDivCol();
								$CI->pm->sDivCol(4);
								$CI->pm->inputGroup("Supplier","supplier",null,null,array("class"=>"input-qty","id"=>"disc"),false);
								// $CI->pm->sDivCol(4,'left',0,array('id'=>'supp-div','style'=>'display:none;'));
									// $CI->pm->selectGroup("Supplier",array(),"supplier",null,"Select Supplier",array("id"=>"sup-drop","class"=>" dropitize"));
								$CI->pm->eDivCol();
								$CI->pm->sDivCol(4);
									$add = $CI->pm->icon("fa-search");
									$CI->pm->btn($add." Search",array("id"=>"submit","class"=>"btn-primary btn-block","style"=>"margin-top:23px;"),false);
								$CI->pm->eDivCol();
							$CI->pm->eDivRow();
						$CI->pm->eForm();

						$CI->pm->sDiv(array('id'=>'pos-div'));
							
						$CI->pm->eDiv();

					$CI->pm->ePanelBody();
				$CI->pm->ePanel();
			$CI->pm->eDivCol();
		$CI->pm->eDivRow();

	return $CI->pm->getCode();
}
