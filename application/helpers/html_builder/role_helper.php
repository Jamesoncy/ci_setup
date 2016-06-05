<?php

function table($tbl="",$CI){
		$CI->pm->sDivRow(array("style"=>"margin-bottom:10px;"));
		$CI->pm->eDivRow();
		$CI->pm->sDivRow();
			$CI->pm->sDivCol();
				$CI->pm->appendCode($tbl);
			$CI->pm->eDivCol();
		$CI->pm->eDivRow();
	return $CI->pm->getCode();
}

function role_add($CI){
$CI->pm->sDivRow();
			$CI->pm->sDivCol();
				$CI->pm->sPanel('default');
					$CI->pm->sPanelBody();
						$CI->pm->sForm('dashboard/add','POST',array('id'=>'po_search_form'));
						$CI->pm->sDivCol(12);
                            $CI->pm->sDivCol(4);
                            	$CI->pm->sDivRow();
										$CI->pm->inputGroup("Role","role",null,null,array("class"=>"input-qty","id"=>"disc"),false);
								$CI->pm->eDivRow();
								$CI->pm->sDivRow();
										$CI->pm->textareaGroup("Description:","description",'',"Role description...",array("class"=>"input-sm"));
								$CI->pm->eDivRow();
								
							$CI->pm->eDivCol();
							
                            $CI->pm->sDivCol(8);
                            $CI->pm->sDivRow(array('style'=>'margin-left: 10px;'));
                            	$CI->pm->sDivRow();
										$CI->pm->sDiv(array('id'=>'description'));
										$CI->pm->eDiv();
								$CI->pm->eDivRow();
								$CI->pm->sDivRow(array("class"=>"pull-right"));
										$add = $CI->pm->icon("fa-plus");
                                        $CI->pm->btn($add." Search",array("id"=>"submit","class"=>"btn-primary btn-sm"),false);   
								$CI->pm->eDivRow();
							$CI->pm->eDivRow();
							$CI->pm->eDivCol();           
							
						$CI->pm->eDivCol();
						
						$CI->pm->eForm();
					$CI->pm->ePanelBody();
				$CI->pm->ePanel();
			$CI->pm->eDivCol();
		$CI->pm->eDivRow();

	return $CI->pm->getCode();
}
