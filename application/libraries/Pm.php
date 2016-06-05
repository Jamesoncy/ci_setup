<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pm {
	var $code="";

	public function __construct(){
		$CI =& get_instance();
		$this->code = "";		
	}
	public function getCode(){
		$code = $this->code;
		$this->clearCode();
		return $code;
	}
	public function appendCode($text=null){
		$this->code .= $text;
	}
	public function clearCode(){
		$this->code = "";
	}
	public function setTags($tags=array()){
		$here = "";
		if(count($tags) > 0){
			foreach($tags as $type=>$value){
				$here .= " ".$type."='".$value."' ";
			}
		}
		return $here;
	}
	public function mergeClass($class=array(),$merge){
		if(isset($class['class'])){
			$class['class'] .= " ".$merge." ";
		}
		else 
			$class['class'] = " ".$merge." ";
		return $class;
	}

	//////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////// HTML Containers //////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////
		public function sDiv($tags=null,$return=false){
			$here = "<div ";
			$here .= $this->setTags($tags);
			$here .= " >";
			if($return) return $here; else $this->code .= $here;
		}

		public function sEDiv($tags=null,$return=false){
			$here = "<div ";
			$here .= $this->setTags($tags);
			$here .= " contenteditable>";
			if($return) return $here; else $this->code .= $here;
		}

		public function cDiv($return=false){
			$here = '<div style="clear: both;"></div>';
			// $here .= $this->setTags($tags);
			// $here .= " >";
			if($return) return $here; else $this->code .= $here;
		} 

		public function eDiv($return=false){
			$here = "</div>";
			if($return) return $here; else $this->code .= $here;
		}
		public function sDivRow($tags=null,$return=false){
			$tags = $this->mergeClass($tags,"row");
			$here = $this->sDiv($tags,true);
			if($return) return $here; else $this->code .= $here;
		}
		public function eDivRow($return=false){
			$here = $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}
		public function sDivCol($length="12",$align="left",$offset=0,$tags=array(),$return=false){
			$off = "";
			if($offset > 0)
				$off = 'col-md-offset-'.$offset;

			$tags = $this->mergeClass($tags,"col-md-".$length." ".$off." text-".$align);
			$here = $this->sDiv($tags,true);
			if($return) return $here; else $this->code .= $here;
		}
		public function sDesk($tags=null,$return=false){
			$tags = $this->mergeClass($tags,"row desk");
			$here = $this->sDiv($tags,true);
			if($return) return $here; else $this->code .= $here;
		}
		public function sPaper($length="12",$align="left",$tags=null,$return=false){
			$tags = $this->mergeClass($tags,"col-md-".$length." text-".$align." div-paper");
			$here = $this->sDiv($tags,true);
			if($return) return $here; else $this->code .= $here;
		}
		public function eDivCol($return=false){
			$here = $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}
		public function sPanel($type='default',$tags=null,$return=false){
			$tags = $this->mergeClass($tags,"panel panel-".$type);
			$here = $this->sDiv($tags,true);
			if($return) return $here; else $this->code .= $here;
		}
		public function ePanel($return=false){
			$here = $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}
		public function sPanelHead($tags=null,$return=false){
			$tags = $this->mergeClass($tags,"panel-heading");
			$here = $this->sDiv($tags,true);
			if($return) return $here; else $this->code .= $here;
		}
		public function ePanelHead($return=false){
			$here = $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}
		public function sPanelBody($tags=null,$return=false){
			$tags = $this->mergeClass($tags,"panel-body");
			$here = $this->sDiv($tags,true);
			if($return) return $here; else $this->code .= $here;
		}
		public function ePanelBody($return=false){
			$here = $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}
		public function sPanelFoot($tags=null,$return=false){
			$tags = $this->mergeClass($tags,"panel-footer");
			$here = $this->sDiv($tags,true);
			if($return) return $here; else $this->code .= $here;
		}
		public function ePanelFoot($return=false){
			$here = $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}
		public function sWell($tags=null,$return=false){
			$here = "<div ";
			$tags = $this->mergeClass($tags,"well well-sm");
			$here .= $this->setTags($tags);
			$here .= " >";
			if($return) return $here; else $this->code .= $here;
		}
		public function eWell($return=false){
			$here = "</div>";
			if($return) return $here; else $this->code .= $here;
		}
		public function listGroup($lists=null,$tags=null,$return=false){
			$tags = $this->mergeClass($tags,"list-group");
			$here = $this->sDiv($tags,true);
				if(is_array($lists)){
					foreach ($lists as $text => $opts) {
						$listTags = $this->mergeClass($opts,"list-group-item");
						if(isset($opts['href']))
							$href = $opts['href'];
						else
							$href = '#';
						$here .= $this->A($text,$href,$listTags,true);
					}
				}
			$here .= $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}
		public function tabHead($tabs=null,$disable=null,$tags=null,$return=false){
			$here = "";
			$here .= $this->sUl(array("class"=>"nav nav-tabs"),true);
				foreach ($tabs as $title => $opts) {
					$active = "";
					if(isset($opts['active'])){
						$active = 'class = "active"';
					}
					$dis = false;
					if($disable == $title){
						$active = 'class = "disabled"';
						$dis = true;
					}

					$id = "";
					if(isset($opts['id'])){
						$id = "id = '".$opts['id']."_li'";
					}

					$here .= ' <li '.$id.' '.$active.'><a ';
					if(!isset($opts['data-toggle'])){
						$opts['data-toggle'] = 'tab';
					}

					if($dis){
						$opts['href']="#";
						unset($opts['data-toggle']);
					}

					$here .= $this->setTags($opts);
					$here .=' >'.$title.'</a></li>';
					if(isset($opts['data-toggle']) && $opts['data-toggle'] = 'dropdown'){
						// write dropdown menu here
					}

				}
			$here .= $this->eUl(true);
			if($return) return $here; else $this->code .= $here;
		}
		public function sTab($tags=null,$return=false){
			$tags = $this->mergeClass($tags,"tab-content");
			$here = $this->sDiv($tags,true);
			if($return) return $here; else $this->code .= $here;
		}
		public function sTabPane($id,$tags=null,$return=false){
			$tags = $this->mergeClass($tags,"tab-pane fade");
			if($id != null)
				$tags['id'] = $id;
			$here = $this->sDiv($tags,true);
			if($return) return $here; else $this->code .= $here;
		}
		public function eTabPane($return=false){
			$here = $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}
		public function eTab($return=false){
			$here = $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}
		public function modal($id,$title,$body=null,$btns=null,$tags=null,$return=false){
			$tags = $this->mergeClass($tags,"modal fade");
			$tags['tabindex'] = -1;
			$tags['role'] = "dialog";
			$tags['aria-labelledby'] = $id."-label";
			$tags['aria-hidden'] = "true";
			if($id != null)
				$tags['id'] = $id;
			$here = $this->sDiv($tags,true);
				$here .= $this->sDiv(array("class"=>"modal-dialog"),true);
					$here .= $this->sDiv(array("class"=>"modal-content"),true);
						///header
						$here .= $this->sDiv(array("class"=>"modal-header"),true);
							$here .= $this->btn("&times;",array("class"=>"close","data-dismiss"=>"modal","aria-hidden"=>"true"),true);
							$here .= $this->H($title,"4",array("class"=>"modal-title","id"=>$id."-label"),true);
						$here .= $this->eDiv(true);
						
						///body
						$here .= $this->sDiv(array("class"=>"modal-body","id"=>$id."-body"),true);
							if($body != null){
								$here .= $body;
							}
						$here .= $this->eDiv(true);

						///footer
						if(is_array($btns)){
							$here .= $this->sDiv(array("class"=>"modal-footer"),true);
									foreach ($btns as $btnTitle => $opts) {
										$opts = $this->mergeClass($opts,"btn-sm");
										$here .= $this->btn($btnTitle,$opts,true);
									}
							$here .= $this->eDiv(true);
						}


					$here .= $this->eDiv(true);
				$here .= $this->eDiv(true);
			$here .= $this->eDiv(true);

			if($return) return $here; else $this->code .= $here;
		}
		public function modalWide($id,$title,$body=null,$btns=null,$tags=null,$return=false){
			$tags = $this->mergeClass($tags,"modal fade");
			$tags['tabindex'] = -1;
			$tags['role'] = "dialog";
			$tags['aria-labelledby'] = $id."-label";
			$tags['aria-hidden'] = "true";
			if($id != null)
				$tags['id'] = $id;
			$here = $this->sDiv($tags,true);
				$here .= $this->sDiv(array("class"=>"modal-dialog modal-wide"),true);
					$here .= $this->sDiv(array("class"=>"modal-content"),true);
						///header
						$here .= $this->sDiv(array("class"=>"modal-header"),true);
							$here .= $this->btn("&times;",array("class"=>"close","data-dismiss"=>"modal","aria-hidden"=>"true"),true);
							$here .= $this->H($title,"4",array("class"=>"modal-title","id"=>$id."-label"),true);
						$here .= $this->eDiv(true);
						
						///body
						$here .= $this->sDiv(array("class"=>"modal-body","id"=>$id."-body"),true);
							if($body != null){
								$here .= $body;
							}
						$here .= $this->eDiv(true);

						///footer
						if(is_array($btns)){
							$here .= $this->sDiv(array("class"=>"modal-footer"),true);
									foreach ($btns as $btnTitle => $opts) {
										$opts = $this->mergeClass($opts,"btn-sm");
										$here .= $this->btn($btnTitle,$opts,true);
									}
							$here .= $this->eDiv(true);
						}


					$here .= $this->eDiv(true);
				$here .= $this->eDiv(true);
			$here .= $this->eDiv(true);

			if($return) return $here; else $this->code .= $here;
		}

	//////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////// HTML List,Texts //////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////
		public function span($text=null,$tags=null,$return=false){
			$here = "<span ";
			$here .= $this->setTags($tags);
			$here .= " >";
			$here .= $text;
			$here .= "</span>";
			if($return) return $here; else $this->code .= $here;
		}

		public function caret($return=true){
			$here = "<span class='caret'></span>";
			if($return) return $here; else $this->code .= $here;
		}
		public function P($text=null,$tags=null,$return=false){
			$here = "<p ";
			$here .= $this->setTags($tags);
			$here .= " >";
			$here .= $text;
			$here .= "</p>";
			if($return) return $here; else $this->code .= $here;
		}
		public function label($text=null,$tags=null,$return=false){
			$here = "<label ";
			$here .= $this->setTags($tags);
			$here .= " >";
			$here .= $text;
			$here .= "</label>";
			if($return) return $here; else $this->code .= $here;
		}
		public function H($text=null,$num="1",$tags=null,$return=false){
			$here = "<h".$num." ";
			$here .= $this->setTags($tags);
			$here .= " >";
			$here .= $text;
			$here .= "</h".$num.">";
			if($return) return $here; else $this->code .= $here;
		}
		public function A($text=null,$href="#",$tags=null,$return=false){
			$here = "<a href='".$href."' ";
			$here .= $this->setTags($tags);
			$here .= " >";
			$here .= $text;
			$here .= "</a>";
			if($return) return $here; else $this->code .= $here;
		}
		public function APrint($text="null",$title=null,$href="#",$tags=null,$return=false){
			$here = "<a href='".$href."' ";
			$tags = $this->mergeClass($tags,"rPrint");
			if($title != "" || $tilte != null)
				$tags['print-title'] = $title;
			$here .= $this->setTags($tags);
			$here .= " >";
			$here .= $text;
			$here .= "</a>";
			if($return) return $here; else $this->code .= $here;
		}
		public function ABtn($text=null,$href="#",$tags=null,$return=false){
			$here = "<a href='".$href."' ";
				$tags = $this->mergeClass($tags,"btn btn-default");
				$here .= $this->setTags($tags);
			$here .= " >";
			$here .= $text;
			$here .= "</a>";
			if($return) return $here; else $this->code .= $here;
		}
		public function popFormBtn($text=null,$title,$loadUrl,$passTo,$form,$tags=array(),$return=false){
			$tags = $this->mergeClass($tags,"btn btn-default");
			// $tags['href'] = $loadUrl;
			$tags['rata-pass'] = $passTo;
			$tags['rata-form'] = $form;
			$tags['rata-title'] = $title;
			$here = $this->Abtn($text,$loadUrl,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}
		public function popFormA($text=null,$title,$loadUrl,$passTo,$form,$tags=array(),$return=false){
			// $tags = $this->mergeClass($tags,"btn btn-default");
			// $tags['href'] = $loadUrl;
			$tags['rata-pass'] = $passTo;
			$tags['rata-form'] = $form;
			$tags['rata-title'] = $title;
			$here = $this->A($text,$loadUrl,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}
		public function popFormLink($text=null,$title,$loadUrl,$passTo,$form,$tags=array(),$return=false){
			// $tags = $this->mergeClass($tags,"btn btn-default");
			// $tags['href'] = $loadUrl;
			$tags['rata-pass'] = $passTo;
			$tags['rata-form'] = $form;
			$tags['rata-title'] = $title;
			$here = $this->A($text,$loadUrl,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}
		public function popViewLink($text=null,$title,$loadUrl,$tags=array(),$return=false){
			$tags = $this->mergeClass($tags," pop-view-link ");
			// $tags['href'] = $loadUrl;
			$tags['rata-title'] = $title;
			$here = $this->A($text,$loadUrl,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}
		public function small($text=null,$tags=null,$return=false){
			$here = "<small ";
			$here .= $this->setTags($tags);
			$here .= " >";
			$here .= $text;
			$here .= "</small>";
			if($return) return $here; else $this->code .= $here;
		}
		public function sOl($tags=null,$return=false){
			$here = "<ol ";
			$here .= $this->setTags($tags);
			$here .= " >";
			if($return) return $here; else $this->code .= $here;
		}
		public function eOl($return=false){
			$here = "</ol>";
			if($return) return $here; else $this->code .= $here;
		}
		public function sUl($tags=null,$return=false){
			$here = "<ul ";
			$here .= $this->setTags($tags);
			$here .= " >";
			if($return) return $here; else $this->code .= $here;
		}
		public function eUl($return=false){
			$here = "</ul>";
			if($return) return $here; else $this->code .= $here;
		}
		public function sLi($tags=null,$return=false){
			$here = "<li ";
			$here .= $this->setTags($tags);
			$here .= " >";
			if($return) return $here; else $this->code .= $here;
		}
		public function eLi($return=false){
			$here = "</li>";
			if($return) return $here; else $this->code .= $here;
		}
		public function sDl($tags=null,$horizontal=true,$return=false){
			$here = "<dl ";
			if($horizontal)
				$tags = $this->mergeClass($tags,'dl-horizontal');
			$here .= $this->setTags($tags);
			$here .= " >";
			if($return) return $here; else $this->code .= $here;
		}
		public function eDl($return=false){
			$here = "</dl>";
			if($return) return $here; else $this->code .= $here;
		}
		public function sAddress($tags=null,$return=false){
			$here = "<address ";
			$here .= $this->setTags($tags);
			$here .= " >";
			if($return) return $here; else $this->code .= $here;
		}
		public function eAddress($return=false){
			$here = "</address>";
			if($return) return $here; else $this->code .= $here;
		}
		public function dt($text=null,$tags=null,$return=false){
			$here = "<dt ";
			$here .= $this->setTags($tags);
			$here .= " >";
			$here .= $text;
			$here .= "</dt>";
			if($return) return $here; else $this->code .= $here;
		}
		public function dd($text=null,$tags=null,$return=false){
			$here = "<dd ";
			$here .= $this->setTags($tags);
			$here .= " >";
			$here .= $text;
			$here .= "</dd>";
			if($return) return $here; else $this->code .= $here;
		}
		public function li($text=null,$tags=null,$return=false){
			$here = "<li ";
			$here .= $this->setTags($tags);
			$here .= " >";
			$here .= $text;
			$here .= "</li>";
			if($return) return $here; else $this->code .= $here;
		}
		public function strong($text=null,$tags=null,$return=false){
			$here = "<strong ";
			$here .= $this->setTags($tags);
			$here .= " >";
			$here .= $text;
			$here .= "</strong>";
			if($return) return $here; else $this->code .= $here;
		}
		
		public function icon($icon,$return=true){
			$here = "<i class='fa ".$icon."'></i>";
			if($return) return $here; else $this->code .= $here;
		}
		public function br($num=1,$return=false){
			$here = "";
			for($i=1;$i<=$num;$i++){
				$here .= "<br>";	
			}
			if($return) return $here; else $this->code .= $here;
		}
		public function img($src=null,$tags=null,$return=false){
			$here = "<img src='".base_url().$src."'";
			$here .= $this->setTags($tags);
			$here .= " >";
			if($return) return $here; else $this->code .= $here;
		}
		public function imgCircle($src=null,$tags=null,$return=false){
			$tags = $this->mergeClass($tags,"img-circle");
			$here = $this->img($src,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}
		public function addDropDown($links=array(),$tags=null,$return=false){
			$tags = $this->mergeClass($tags,"dropdown-menu text-left");
			$here = $this->sUl($tags,true);
				foreach ($links as $text => $opts) {
					if(isset($opts['href'])){
						$href=$opts['href']; 
					}
					else
						$href="#"; 
					if(is_array($opts))	
						$a = $this->A($text,$href,$opts,true);
					else
						$a = $this->A($text,$href,array(),true);
					$here .= $this->li($a,array(),true);
				}
			$here .= $this->eUl(true);
			if($return) return $here; else $this->code .= $here;
		}

		public function pills($pills=array(),$tags=null,$active=null,$disabled=null,$stacked=false,$return=false){
			$here = "";
			$st = "";
			if($stacked)
				$st = "nav-stacked";
			$tags = $this->mergeClass($tags,"nav nav-pills ".$st);
			$here .= $this->sUl($tags,true);
				foreach ($pills as $text => $opts) {
					if(isset($opts['href'])){
						$href=$opts['href']; 
					}
					else
						$href="#"; 
					if(is_array($opts))	
						$a = $this->A($text,$href,$opts,true);
					else
						$a = $this->A($text,$href,array(),true);
					$li_id="";
					if(isset($opts['id'])){
						$li_id = $opts['id']."_li";
					}

					$li_class = "";

					if($active == $text){
						$li_class = "active";
					}

					if($disabled == $text){
						$li_class = "disabled";
					}


					$here .= $this->li($a,array("id"=>$li_id,"class"=>$li_class),true);
				}
			$here .= $this->eUl(true);
			if($return) return $here; else $this->code .= $here;
		}
	
	//////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////// HTML Forms, Inputs ///////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////
		public function sForm($action="",$method="POST",$tags=array(),$return=false){
			$here = "<form action='".$action."' method='".$method."' role='form'";
			$here .= $this->setTags($tags);
			$here .= " >";
			if($return) return $here; else $this->code .= $here;
		}
		public function eForm($return=false){
			$here = "</form>";
			if($return) return $here; else $this->code .= $here;
		}
		public function sFormH($action="",$method="POST",$tags=array(),$return=false){
			$here = "<form action='".$action."' method='".$method."' role='form'";
			$tags = $this->mergeClass($tags,"form-horizontal");
			$here .= $this->setTags($tags);
			$here .= " >";
			if($return) return $here; else $this->code .= $here;
		}
		public function eFormH($return=false){
			$here = "</form>";
			if($return) return $here; else $this->code .= $here;
		}
		public function sFormI($action="",$method="POST",$tags=array(),$return=false){
			$here = "<form action='".$action."' method='".$method."' role='form'";
			$tags = $this->mergeClass($tags,"form-inline");
			$here .= $this->setTags($tags);
			$here .= " >";
			if($return) return $here; else $this->code .= $here;
		}
		public function eFormI($return=false){
			$here = "</form>";
			if($return) return $here; else $this->code .= $here;
		}
		public function btn($text=null,$tags=array(),$return=false,$bootstrapBtn=true){
            $here = '<button ';
            if(isset($tags['type']))
            	$here .= "type='".$tags['type']."'";
            else
            	$here .= "type='button'";
            
            if($bootstrapBtn==true)
         	   $tags = $this->mergeClass($tags,"btn");
            $here .= $this->setTags($tags);
			$here .=' > '.$text.'</button>';
			if($return) return $here; else $this->code .= $here;
		}
		public function btnGroup($btns=array(),$return=false){
   			$here = $this->sDiv(array("class"=>"btn-group"),true);
   				foreach ($btns as $text => $opts) {
   					$dropdowns = array();
   					if(isset($opts['dropdown'])){
         	 			  $opts = $this->mergeClass($opts,"dropdown-toggle");
         	 			  $opts['data-toggle']="dropdown";
         	 			  $dropdowns = $opts['dropdown'];
         	 			  unset($opts['dropdown']);
   					}	
   					// if(isset($opts['dropdown_tags'])){
        //  	 			  $dropTags = $opts['dropdown'];
        //  	 			  unset($opts['dropdown_tags']);
   					// }
   					$here .= $this->btn($text,$opts,true);
   					if(count($dropdowns) > 0){
   						$dropTags = array();
   						$here .= $this->addDropDown($dropdowns,$dropTags,true);
   					}
   				}
   			$here .= $this->eDiv(true);            
			if($return) return $here; else $this->code .= $here;
		}
		public function btnWithDrop($text="",$drops=array(),$tags=array(),$return=false){
			$here = $this->sDiv(array("class"=>"btn-group"),true);	
				$here .= $this->btn($text,$tags,true);
				$tagsa = $this->mergeClass($tags,"dropdown-toggle");
				$tagsa['data-toggle'] = "dropdown";
				$here .= $this->btn('<span class="caret"></span>',$tagsa,true);
				if(count($drops) > 0){
					$dropTags = array();
					$here .= $this->addDropDown($drops,$dropTags,true);
				}				
			$here .= $this->eDiv(true);	
			if($return) return $here; else $this->code .= $here;
		}
		public function btnBlock($text=null,$tags=array(),$return=false){
            $tags = $this->mergeClass($tags,"btn btn-block");
            $here = $this->btn($text,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}
		public function btnLarge($text=null,$tags=array(),$return=false){
            $tags = $this->mergeClass($tags,"btn btn-lg");
            $here = $this->btn($text,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}
		public function btnBlockLarge($text=null,$tags=array(),$return=false){
            $tags = $this->mergeClass($tags,"btn btn-block btn-lg");
            $here = $this->btn($text,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}
		public function input($name=null,$value=null,$placeholder=null,$tags=array(),$return=false,$cell=false){
			$here = "";

			if($cell){
				$here .= "<td>";
			}

            $here = '<input type="text" name="'.$name.'" '.($value != null? 'value="'.$value.'"':'').' placeholder="'.$placeholder.'"';
            // if(!isset)
            $here .= $this->setTags($tags);
            $here .=' >';
			if($cell)
				$here .= "</td>";


			if($return) return $here; else $this->code .= $here;
		}

		public function inputNumber($name=null,$value=null,$placeholder=null,$tags=array(),$return=false,$cell=false){
			$here = "";

			if($cell){
				$here .= "<td>";
			}

            $here = '<input type="number" name="'.$name.'" '.($value != null? 'value="'.$value.'"':'').' placeholder="'.$placeholder.'"';
            // if(!isset)
            $here .= $this->setTags($tags);
            $here .=' required>';
			if($cell)
				$here .= "</td>";


			if($return) return $here; else $this->code .= $here;
		}

		public function date($name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
            $here = '<input type="text" name="'.$name.'" '.($value != null? 'value="'.$value.'"':'').' placeholder="'.$placeholder.'"';
            $tags = $this->mergeClass($tags,"input-date");
            $here .= $this->setTags($tags);
            $here .=' >';
			if($return) return $here; else $this->code .= $here;
		}
		public function dateRange($name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
            $here = '<input type="text" name="'.$name.'" '.($value != null? 'value="'.$value.'"':'').' placeholder="'.$placeholder.'"';
            $tags = $this->mergeClass($tags,"input-date-range");
            $here .= $this->setTags($tags);
            $here .=' >';
			if($return) return $here; else $this->code .= $here;
		}
		public function file($name=null,$value=null,$tags=array(),$return=false){
            $here = '<input type="file" name="'.$name.'" '.($value != null? 'value="'.$value.'"':'').' ';
            $here .= $this->setTags($tags);
            $here .=' >';
			if($return) return $here; else $this->code .= $here;
		}
		public function checkbox($label=null,$name=null,$value=null,$tags=array(),$return=false,$checked=false){
            $here = '<input type="checkbox" name="'.$name.'" ';
            if($checked){
            	$tags['checked'] = "checked";
            }
           	if($value != null)
	      	  $tags['value'] = $value;
    		$here .= $this->setTags($tags);
    		$here .= '> '.$label;
			if($return) return $here; else $this->code .= $here;
		}
		public function inputCell($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			$here = $this->sDiv(array("class"=>"form-group"),true);
	        if($label != null)
	        	$here .= $this->label($label,array("class"=>"control-label"),true);
	        else	
	        	$here .= $this->label($label,array("class"=>"sr-only control-label"),true);
				// $here .= $this->sDiv(array("class"=>"col-sm-4"),true);
	        		$tags = $this->mergeClass($tags," form-control");
					$here .= $this->input($name,$value,$placeholder,$tags,true);
				// $here .= $this->eDiv(true);
	          
			$here .= $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}
		public function inputGroup($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false,$cell=false){
			$here = "";

			$here .= $this->sDiv(array("class"=>"form-group"),true);
				 if($label != null)
		        	$here .= $this->label($label,array("class"=>"control-label"),true);
		        else	
		        	$here .= $this->label($label,array("class"=>"sr-only control-label"),true);
	        	// $here .= $this->label($label,array("class"=>"control-label sr-only"),true);
	        		$tags = $this->mergeClass($tags,"form-control ");
					$here .= $this->input($name,$value,$placeholder,$tags,true);
			$here .= $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}

		public function numberGroup($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false,$cell=false){
			$here = "";

			$here .= $this->sDiv(array("class"=>"form-group"),true);
				 if($label != null)
		        	$here .= $this->label($label,array("class"=>"control-label"),true);
		        else	
		        	$here .= $this->label($label,array("class"=>"sr-only control-label"),true);
	        	// $here .= $this->label($label,array("class"=>"control-label sr-only"),true);
	        		$tags = $this->mergeClass($tags,"form-control ");
					$here .= $this->inputNumber($name,$value,$placeholder,$tags,true);
			$here .= $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}

		public function numGroup($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false,$cell=false){
			$here = "";

			$here .= $this->sDiv(array("class"=>"form-group"),true);
				 if($label != null)
		        	$here .= $this->label($label,array("class"=>"control-label"),true);
		        else	
		        	$here .= $this->label($label,array("class"=>"sr-only control-label"),true);
	        	// $here .= $this->label($label,array("class"=>"control-label sr-only"),true);
	        		$tags = $this->mergeClass($tags,"form-control numOnly");
					$here .= $this->input($name,$value,$placeholder,$tags,true);
			$here .= $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}
		public function inputGroupH($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			$here = $this->sDiv(array("class"=>"form-group"),true);
				 if($label != null)
		        	$here .= $this->label($label." :",array("class"=>"col-sm-4 control-label"),true);
		        else	
		        	$here .= $this->label($label." :",array("class"=>"sr-only control-label"),true);
	        	// $here .= $this->label($label,array("class"=>"control-label sr-only"),true);
	        		$here .= $this->sDiv(array("class"=>"col-sm-8"),true);
		        		$tags = $this->mergeClass($tags,"form-control ");
						$here .= $this->input($name,$value,$placeholder,$tags,true);
					$here .= $this->eDiv(true);
			$here .= $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}

		public function dateGroupH($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			$here = $this->sDiv(array("class"=>"form-group"),true);
				 if($label != null)
		        	$here .= $this->label($label." :",array("class"=>"col-sm-4 control-label"),true);
		        else	
		        	$here .= $this->label($label." :",array("class"=>"col-sm-4 sr-only control-label"),true);
	        	// $here .= $this->label($label,array("class"=>"control-label sr-only"),true);
	        		$here .= $this->sDiv(array("class"=>"col-sm-8 input-group input-append date","data-date-format"=>"dd-mm-yyyy","data-date"=>$value),true);
						$here .= '<span class="input-group-addon"><i class="fa fa-calendar"></i></span>';
	        			$tags = $this->mergeClass($tags,"form-control  input-group");
						$here .= $this->date($name,$value,$placeholder,$tags,true);
					$here .= $this->eDiv(true);
			$here .= $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}

		public function dateGroup($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			$here = $this->sDiv(array("class"=>"form-group"),true);
				 if($label != null)
		        	$here .= $this->label($label,array("class"=>"control-label"),true);
		        else	
		        	$here .= $this->label($label,array("class"=>"sr-only control-label"),true);
	        	// $here .= $this->label($label,array("class"=>"control-label sr-only"),true);
	        		$here .= $this->sDiv(array("class"=>"input-group input-append date","data-date-format"=>"dd-mm-yyyy","data-date"=>$value),true);
						$here .= '<span class="input-group-addon"><i class="fa fa-calendar"></i></span>';
	        			$tags = $this->mergeClass($tags,"form-control  input-group");
						$here .= $this->date($name,$value,$placeholder,$tags,true);
					$here .= $this->eDiv(true);
			$here .= $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}
		public function dateRangeGroup($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			$here = $this->sDiv(array("class"=>"form-group"),true);
				 if($label != null)
		        	$here .= $this->label($label,array("class"=>"control-label"),true);
		        else	
		        	$here .= $this->label($label,array("class"=>"sr-only control-label"),true);
	        	// $here .= $this->label($label,array("class"=>"control-label sr-only"),true);
	        		$here .= $this->sDiv(array("class"=>"input-group input-append date"),true);
						$here .= '<span class="input-group-addon"><i class="fa fa-calendar"></i></span>';
	        			$tags = $this->mergeClass($tags,"form-control  input-group");
						$here .= $this->dateRange($name,$value,$placeholder,$tags,true);
					$here .= $this->eDiv(true);
			$here .= $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}

		public function mobileGroup($label=null,$name=null,$value=null,$format="+63 (ddd) ddd-dddd",$tags=array(),$return=false){
			$here = $this->sDiv(array("class"=>"form-group"),true);
				 if($label != null)
		        	$here .= $this->label($label,array("class"=>"control-label"),true);
		        else	
		        	$here .= $this->label($label,array("class"=>"sr-only control-label"),true);
	        	// $here .= $this->label($label,array("class"=>"control-label sr-only"),true);
	        		$here .= $this->sDiv(array("class"=>"input-group"),true);
						$here .= '<span class="input-group-addon"><i class="fa fa-mobile"></i></span>';
	        			$tags = $this->mergeClass($tags,"form-control  input-group  rh-phone");
	        			if($format == "")
	        				$format = "+63 (ddd) ddd-dddd";
	        			$tags['data-format'] = $format;
						$here .= $this->input($name,$value,null,$tags,true);
					$here .= $this->eDiv(true);
			$here .= $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}
		public function phoneGroup($label=null,$name=null,$value=null,$format="+63 (ddd) ddd-dddd",$tags=array(),$return=false){
			$here = $this->sDiv(array("class"=>"form-group"),true);
				 if($label != null)
		        	$here .= $this->label($label,array("class"=>"control-label"),true);
		        else	
		        	$here .= $this->label($label,array("class"=>"sr-only control-label"),true);
	        	// $here .= $this->label($label,array("class"=>"control-label sr-only"),true);
	        		$here .= $this->sDiv(array("class"=>"input-group"),true);
						$here .= '<span class="input-group-addon"><i class="fa fa-phone"></i></span>';
	        			$tags = $this->mergeClass($tags,"form-control  input-group  rh-phone");
	        			if($format == "")
	        				$format = "+02 ddd-dddd";
	        			$tags['data-format'] = $format;
						$here .= $this->input($name,$value,null,$tags,true);
					$here .= $this->eDiv(true);
			$here .= $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}
		public function userNameGroup($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			$here = $this->sDiv(array("class"=>"form-group"),true);
				 if($label != null)
		        	$here .= $this->label($label,array("class"=>"control-label"),true);
		        else	
		        	$here .= $this->label($label,array("class"=>"sr-only control-label"),true);
	        	// $here .= $this->label($label,array("class"=>"control-label sr-only"),true);
	        		$here .= $this->sDiv(array("class"=>"input-group"),true);
						$here .= '<span class="input-group-addon"><i class="fa fa-user"></i></span>';
	        			$tags = $this->mergeClass($tags,"form-control  input-group");
	        			$here .= $this->input($name,$value,$placeholder,$tags,true);
					$here .= $this->eDiv(true);
			$here .= $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}
		public function pwdKeyGroup($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			$here = $this->sDiv(array("class"=>"form-group"),true);
				 if($label != null)
		        	$here .= $this->label($label,array("class"=>"control-label"),true);
		        else	
		        	$here .= $this->label($label,array("class"=>"sr-only control-label"),true);
	        	// $here .= $this->label($label,array("class"=>"control-label sr-only"),true);
	        		$here .= $this->sDiv(array("class"=>"input-group"),true);
						$here .= '<span class="input-group-addon"><i class="fa fa-lock"></i></span>';
	        			$tags = $this->mergeClass($tags,"form-control  input-group");
	        			$here .= $this->pwd($name,$value,$placeholder,$tags,true);
					$here .= $this->eDiv(true);
			$here .= $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}
		public function tinGroup($label=null,$name=null,$value=null,$format="ddd-ddd-ddd-ddd",$tags=array(),$return=false){
			$here = $this->sDiv(array("class"=>"form-group"),true);
				 if($label != null)
		        	$here .= $this->label($label,array("class"=>"control-label"),true);
		        else	
		        	$here .= $this->label($label,array("class"=>"sr-only control-label"),true);
	        	// $here .= $this->label($label,array("class"=>"control-label sr-only"),true);
	        		$here .= $this->sDiv(array("class"=>"input-group"),true);
						$here .= '<span class="input-group-addon"><i class="fa fa-tag"></i></span>';
	        			$tags = $this->mergeClass($tags,"form-control  input-group  rh-phone");
	        			if($format == "")
	        				$format = "ddd-ddd-ddd-ddd";
	        			$tags['data-format'] = $format;
						$here .= $this->input($name,$value,null,$tags,true);
					$here .= $this->eDiv(true);
			$here .= $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}
		public function ipAddGroup($label=null,$name=null,$value=null,$format="ddd.ddd.ddd.ddd",$tags=array(),$return=false){
			$here = $this->sDiv(array("class"=>"form-group"),true);
				 if($label != null)
		        	$here .= $this->label($label,array("class"=>"control-label"),true);
		        else	
		        	$here .= $this->label($label,array("class"=>"sr-only control-label"),true);
	        	// $here .= $this->label($label,array("class"=>"control-label sr-only"),true);
	        		$here .= $this->sDiv(array("class"=>"input-group"),true);
						$here .= '<span class="input-group-addon"><i class="fa fa-sitemap"></i></span>';
	        			$tags = $this->mergeClass($tags,"form-control  input-group  rh-phone");
	        			if($format == "")
	        				$format = "ddd.ddd.ddd.ddd";
	        			$tags['data-format'] = $format;
						$here .= $this->input($name,$value,null,$tags,true);
					$here .= $this->eDiv(true);
			$here .= $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}
		public function fileGroup($label=null,$name=null,$value=null,$tags=array(),$return=false){
			$here = $this->sDiv(array("class"=>"form-group"),true);
				 if($label != null)
		        	$here .= $this->label($label,array("class"=>"control-label"),true);
		        else	
		        	$here .= $this->label($label,array("class"=>"sr-only control-label"),true);
	        	// $here .= $this->label($label,array("class"=>"control-label sr-only"),true);
	        		$tags = $this->mergeClass($tags,"form-control ");
					$here .= $this->file($name,$value,$tags,true);
			$here .= $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}
		public function inputCheckGroup($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			$here = $this->sDiv(array("class"=>"form-group"),true);
	        	$here .= $this->label($label,array("class"=>"control-label"),true);
					$here .= $this->sDiv(array("class"=>"input-group"),true);
		        		$checkbox = '<input type="checkbox"> Checkasdasdasdasdasd';
		        		$here .= $this->span($checkbox,array("class"=>"input-group-addon"),true);
		        		$tags = $this->mergeClass($tags,"form-control");
						$here .= $this->input($name,$value,$placeholder,$tags,true);
					$here .= $this->eDiv(true);
			$here .= $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}
		public function pwd($name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
            $here = '<input type="password" name="'.$name.'" '.($value != null? 'value="'.$value.'"':'').' placeholder="'.$placeholder.'"';
            $here .= $this->setTags($tags);
            $here .=' >';
			if($return) return $here; else $this->code .= $here;
		}
		public function hidden($name=null,$value=null,$tags=array(),$return=false){
        	$here = "<input type='hidden' ".($name != ""?"name='".$name."'":"")." ".($value !== ""?"value='".$value."'":"");
            $here .= $this->setTags($tags);
            $here .=' >';
			if($return) return $here; else $this->code .= $here;
		}
		public function pwdGroup($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			$here = $this->sDiv(array("class"=>"form-group"),true);
	        if($label != null)
	        	$here .= $this->label($label,array(),true);
	        	$tags = $this->mergeClass($tags,"form-control");
				$here .= $this->pwd($name,$value,$placeholder,$tags,true);
	          
			$here .= $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}
		public function textarea($name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
            $here = '<textarea name="'.$name.'" placeholder="'.$placeholder.'" ';
            if(!isset($tags['rows']))
            	$tags['rows'] = "4";
            $here .= $this->setTags($tags);
            $here .=' >';
            $here .= $value;
            $here .= '</textarea>';
			if($return) return $here; else $this->code .= $here;
		}
		public function radio($label=null,$name=null,$value=null,$tags=array(),$checked=false,$return=false){
			$check = "";	
          	if($checked)
          		$check = "checked";
          	$here = '<input type="radio" name="'.$name.'" value="'.$value.'" '.$check;
    		$here .= $this->setTags($tags);
    		$here .= '> '.$label;
			if($return) return $here; else $this->code .= $here;
		}
		public function textareaGroup($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			$here = $this->sDiv(array("class"=>"form-group"),true);
	        	$here .= $this->label($label,array("class"=>"control-label"),true);
	        		$tags = $this->mergeClass($tags,"form-control");
					$here .= $this->textarea($name,$value,$placeholder,$tags,true);
			$here .= $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}
		public function select($opts=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
            $here = '<select  name="'.$name.'" placeholder="'.$placeholder.'" ';
            $here .= $this->setTags($tags);
            $here .=' >';
            if($placeholder != null || $placeholder != "" ){
            	if($value == null)
         			$selected = 'selected';
         		else 
         			$selected = null;
         		$here .= '<option value = ""  '.$selected.'>'.$placeholder.'</option>';
            }
         	foreach ($opts as $text => $val) {
         		$text = wordwrap($text, 10, "<br />\n");
         		if(is_array($val)){
         			$opt_tags = $this->setTags($val);
         			if(isset($val['value']) && $val['value'] == $value){
         				$selected = 'selected';
         			}
         			else 
         				$selected = null;
     				$here .= '<option '.$opt_tags.' '.$selected.'>'.$text.'</option>';


         		}
         		else{
	         		if($value == $val)
	         			$selected = 'selected';
	         		else 
	         			$selected = null;
	         		$here .= '<option value = '.$val.' '.$selected.'>'.$text.'</option>';
         		}
         	}

            $here .= '</select>';
			if($return) return $here; else $this->code .= $here;
		}
		public function multiple($opts=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
            $here = '<select  multiple data-role="tagsinput" name="'.$name.'" placeholder="'.$placeholder.'" ';
            $tags = $this->mergeClass($tags,"tagsinput");
            $here .= $this->setTags($tags);
            $here .=' >';
            if($placeholder != null || $placeholder != "" ){
            	if($value == null)
         			$selected = 'selected';
         		else 
         			$selected = null;
         		$here .= '<option value = ""  '.$selected.'>'.$placeholder.'</option>';
            }
         	foreach ($opts as $text => $val) {
         		if($value == $val)
         			$selected = 'selected';
         		else 
         			$selected = null;
         		$here .= '<option value = '.$val.' '.$selected.'>'.$text.'</option>';
         	}

            $here .= '</select>';
			if($return) return $here; else $this->code .= $here;
		}
		public function selectGroup($label=null,$opts=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			$here = $this->sDiv(array("class"=>"form-group"),true);

				 if($label != null)
		        	$here .= $this->label($label,array("class"=>"control-label"),true);
		        else	
		        	$here .= $this->label($label,array("class"=>"sr-only control-label"),true);

	        	// $here .= $this->label($label,array("class"=>"control-label"),true);

	        		$tags = $this->mergeClass($tags,"form-control");
					$here .= $this->select($opts,$name,$value,$placeholder,$tags,true);
			$here .= $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}

		public function selectGroupH($label=null,$opts=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			$here = $this->sDiv(array("class"=>"form-group"),true);

				 if($label != null)
		        	$here .= $this->label($label." :",array("class"=>"col-sm-4 control-label"),true);
		        else	
		        	$here .= $this->label($label." :",array("class"=>"col-sm-4 sr-only control-label"),true);

	        	// $here .= $this->label($label,array("class"=>"control-label"),true);
		        $here .= $this->sDiv(array("class"=>"col-sm-8"),true);
	        		$tags = $this->mergeClass($tags,"form-control");
					$here .= $this->select($opts,$name,$value,$placeholder,$tags,true);
				$here .= $this->eDiv(true);
			$here .= $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}

		public function multipleGroup($label=null,$opts=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			$here = $this->sDiv(array("class"=>"form-group"),true);

				 if($label != null)
		        	$here .= $this->label($label,array("class"=>"control-label"),true);
		        else	
		        	$here .= $this->label($label,array("class"=>"sr-only control-label"),true);

	        	// $here .= $this->label($label,array("class"=>"control-label"),true);

	        		$tags = $this->mergeClass($tags,"form-control");
					$here .= $this->multiple($opts,$name,$value,$placeholder,$tags,true);
			$here .= $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		}

		public function radioBtnGroup($name=null,$radios=array(),$value=null,$tags=array(),$vertical=false,$return=false){
			if($vertical)
				$tags = $this->mergeClass($tags,"btn-group-vertical");
			else
				$tags = $this->mergeClass($tags,"btn-group");
			
			$tags['data-toggle'] = "buttons";
			$here = $this->sDiv($tags,true);
	        	$counter = 1;
	        	foreach ($radios as $label => $opts) {
	        		$checked = "";
	        		if(isset($opts['value']) && $opts['value'] == $value)
	        			$checked = 'checked="checked"';

	        		$rad = '<input type="radio" name="'.$name.'" '.$checked;
	        		if(!isset($opts['id']))
	        			$opts['id'] = $name.'-'.$counter;
	        		$rad .= $this->setTags($opts);
	        		$rad .= '>'.$label;
	        		$active = "";
	        		if(isset($opts['value']) && $opts['value'] == $value)
	        			$active = "active";
	        		$here .= $this->label($rad,array("class"=>"btn btn-primary btn-sm ".$active),true);
	        		
	        		$counter++;
	        	}
			$here .= $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		} 
		public function checkBoxBtnGroup($name=null,$radios=array(),$value=null,$tags=array(),$vertical=false,$return=false){
			if($vertical)
				$tags = $this->mergeClass($tags,"btn-group-vertical");
			else
				$tags = $this->mergeClass($tags,"btn-group");
			
			$tags['data-toggle'] = "buttons";
			$here = $this->sDiv($tags,true);
	        	$counter = 1;
	        	foreach ($radios as $label => $opts) {
	        		$rad = '<input type="checkbox" name="'.$name.'" ';
	        		if(!isset($opts['id']))
	        			$opts['id'] = $name.'-'.$counter;
	        		$rad .= $this->setTags($opts);
	        		$rad .= '> '.$label;
	        		$here .= $this->label($rad,array("class"=>"btn btn-primary btn-sm"),true);

	        		$counter++;
	        	}
			$here .= $this->eDiv(true);
			if($return) return $here; else $this->code .= $here;
		} 

	//////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////// HTML Table ///////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////
		public function sTable($tags=array(),$responsive=false,$bordered=false,$stripped=true,$return=false,$bootstrapTbl=true){
			$here = '';
			$class="";
			$here = "<table ";
			if($bootstrapTbl)
				$class = 'table table-hover';
			if($bordered)
				$class .= ' table-bordered ';
			if($stripped)
				$class .= ' table-striped ';
			if($responsive)
				$class .= ' tablesorter ';
			$tags = $this->mergeClass($tags,$class);
			$here .= $this->setTags($tags);
			$here .= " >";
			if($return) return $here; else $this->code .= $here;
		}
		public function sTableBody($tags=array(),$return=false){
			$here = '';
			$here = "<tbody ";
			$here .= $this->setTags($tags);
			$here .= " >";
			if($return) return $here; else $this->code .= $here;
		}
		public function sTableHead($tags=array(),$return=false){
			$here = '';
			$here = "<thead ";
			$here .= $this->setTags($tags);
			$here .= " >";
			if($return) return $here; else $this->code .= $here;
		}
		public function sTableFoot($tags=array(),$return=false){
			$here = '';
			$class= "";
			$here = "<tfoot ";
			$here .= $this->setTags($tags);
			$here .= " >";
			if($return) return $here; else $this->code .= $here;
		}
		public function tableHead($heads=array(),$tags=array(),$addSortIcons=false,$return=false){
			// $here  = '';
			$here  = '<thead ';
			$here .= $this->setTags($tags);
			$here .= ' >';
				$here .= '<tr>';
					foreach ($heads as $title => $opts) {
						$here .= '<th ';
						if(is_array($opts))
							$here .= $this->setTags($opts);
						$here .= ' >'.$title;
						if($addSortIcons)	
							$here .= ' <i class="fa fa-sort"></i>';
						$here .= '</th>';
					}
				$here .= '</tr>';
			$here .= '</thead>';
			if($return) return $here; else $this->code .= $here;
		}
		public function eTableBody($return=false){
			$here = "</tbody>";
			if($return) return $here; else $this->code .= $here;
		}
		public function eTableFoot($return=false){
			$here = "</tfoot>";
			if($return) return $here; else $this->code .= $here;
		}
		public function eTableHead($return=false){
			$here = "</thead>";
			if($return) return $here; else $this->code .= $here;
		}
		public function eTable($return=false){
			$here = "</table>";
			if($return) return $here; else $this->code .= $here;
		}

		public function sRow($tags=null,$return=false){
			$here = "<tr ";
			$here .= $this->setTags($tags);
			$here .= " >";
			if($return) return $here; else $this->code .= $here;
		}
		public function eRow($return=false){
			$here = "</tr>";
			if($return) return $here; else $this->code .= $here;
		}
		public function cell($text=null,$tags=null,$return=false){
			$here = "<td ";
			$here .= $this->setTags($tags);
			$here .= " >";
			$here .= $text;
			$here .= "</td>";
			if($return) return $here; else $this->code .= $here;
		}

		public function paperBreak($type="white",$text="&nbsp;",$tags=array(),$return=false){
			$tags = $this->mergeClass($tags,"paper-break-".$type);
			$here = $this->sRow($tags,true);
				$cTags['colspan'] = "100%";
				$here .= $this->cell($text,$cTags,true);
			$here .= $this->eRow(true);
			if($return) return $here; else $this->code .= $here;
		}
	
	//////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////// CUSTOM SELECTS ///////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////
		public function genderDrop($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			$CI =& get_instance();
			$opts = array();

			$opts['Male']= "male";
			$opts['Female']= "Female";

			$here = $this->selectGroup($label,$opts,$name,$value,$placeholder,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}	
		public function yesNoDrop($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			$CI =& get_instance();
			$opts = array();

			$opts['Yes']= 1;
			$opts['No']= 0;

			$here = $this->selectGroup($label,$opts,$name,$value,$placeholder,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}
		public function usersDrop($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			$CI =& get_instance();
			$CI->load->model('site/users_model');
			$user_roles = $CI->users_model->get_users();
			$opts = array();

			foreach ($user_roles as $val) {
				$opts[$val->fname." ".$val->mname." ".$val->lname." ".$val->suffix]= $val->id;
			}

			$here = $this->selectGroup($label,$opts,$name,$value,$placeholder,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}
		public function usersAllDrop($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			$CI =& get_instance();
			$CI->load->model('site/users_model');
			$user_roles = $CI->users_model->get_users(null,true);
			$opts = array();

			foreach ($user_roles as $val) {
				$opts[$val->fname." ".$val->mname." ".$val->lname." ".$val->suffix]= $val->id;
			}

			$here = $this->selectGroup($label,$opts,$name,$value,$placeholder,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}
		public function userRolesDrop($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			$CI =& get_instance();
			$CI->load->model('site/users_model');
			$user_roles = $CI->users_model->get_user_roles();
			$opts = array();

			foreach ($user_roles as $val) {
				$opts[$val->role]= $val->id;
			}

			$here = $this->selectGroup($label,$opts,$name,$value,$placeholder,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}
		public function srsSuppliersDrop($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			$CI =& get_instance();
			$CI->load->model('srs/po_model');
			$user_roles = $CI->po_model->get_srs_suppliers_details_brief();
			$opts = array();
			foreach ($user_roles as $val) {
				$opts[$val->description]= $val->vendorcode;
			}
			$here = $this->selectGroup($label,$opts,$name,$value,$placeholder,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}

		public function srsTaggedSuppliersDrop($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			$CI =& get_instance();
			$CI->load->model('srs/po_model');
			$user_roles = $CI->po_model->get_srs_suppliers_details_brief();
			$opts = array();
			$user_id = $CI->session->userdata["user"]["id"]; //
			foreach ($user_roles as $val) {
				$check = $CI->po_model->user_vendor($val->vendorcode, $user_id);
           		if (!empty($check))
               		$opts[$val->description]= $val->vendorcode;
			}
			$here = $this->selectGroup($label,$opts,$name,$value,$placeholder,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}


 

		public function srsSuppItemsDrop($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			$CI =& get_instance();
			$CI->load->model('srs/srs_model');
			$user_roles = $CI->srs_model->get_srs_suppliers_vague();
			$opts = array();
			foreach ($user_roles as $val) {
				$opts[$val->description]= $val->vendorcode;
			}
			$here = $this->selectGroup($label,$opts,$name,$value,$placeholder,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}
		public function branchesDrop($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			$CI =& get_instance();
			$CI->load->model('srs/po_model');
			$user_roles = $CI->po_model->main_get_branch_list();
			$opts = array();
			foreach ($user_roles as $val) {
				$opts[$val->name]= $val->code;
			}
			$here = $this->selectGroup($label,$opts,$name,$value,$placeholder,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}

		public function optionDrop($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			
			$opts["Partial"] = "Partial";
			$opts["Full"] = "Full";
			
			$here = $this->selectGroup($label,$opts,$name,$value,$placeholder,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}

		public function weekDayDrop($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			
			$opts["Monday"] = "Monday";
			$opts["Tuesday"] = "Tuesday";
			$opts["Wednesday"] = "Wednesday";
			$opts["Thursday"] = "Thursday";
			$opts["Friday"] = "Friday";
			$opts["Saturday"] = "Saturday";
			$opts["Sunday"] = "Sunday";
			
			$here = $this->selectGroup($label,$opts,$name,$value,$placeholder,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}

		public function sellingDropDays($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			
			for($x = 1; $x<=30; $x++)
				$opts[$x] = $x;
			
			$here = $this->selectGroup($label,$opts,$name,$value,$placeholder,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}

		public function frequencyDrop($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			
			$opts["Weekly"] = "F4";
			$opts["Once Every Two Weeks"] = "F2";
			$opts["Once A Month"] = "F1";
			
			$here = $this->selectGroup($label,$opts,$name,$value,$placeholder,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}

		public function optionDrop2($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			
			$opts["Category"] = "Category";
			$opts["Supplier"] = "Supplier";
			
			$here = $this->selectGroup($label,$opts,$name,$value,$placeholder,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}


		public function suppTagDrop($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			
			$opts["Category"] = "Category";
			$opts["Supplier"] = "Supplier";
			
			$here = $this->selectGroup($label,$opts,$name,$value,$placeholder,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}

		public function suppCategoryDrop($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			
			$opts["Category"] = "Category";
			$opts["Supplier"] = "Supplier";
			
			$here = $this->selectGroup($label,$opts,$name,$value,$placeholder,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}

        public function deliveryDateDrop($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			
			$opts["1"] = "1";
			$opts["2"] = "2";
			$opts["3"] = "3";
			$opts["4"] = "4";
			$opts["5"] = "5";
			$opts["6"] = "6";
			$opts["7"] = "7";
			
			$here = $this->selectGroup($label,$opts,$name,$value,$placeholder,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}

		 public function reportDrop($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			
			$opts["Daily"] = "1";
			$opts["Monthly"] = "2";
			
			
			$here = $this->selectGroup($label,$opts,$name,$value,$placeholder,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}

		  public function autoDrop($label=null,$name=null,$value=null,$placeholder=null,$tags=array(),$return=false){
			
			$opts["P.R."] = "0";
			$opts["P.O."] = "1";
			
			
			$here = $this->selectGroup($label,$opts,$name,$value,$placeholder,$tags,true);
			if($return) return $here; else $this->code .= $here;
		}


		
		
}

