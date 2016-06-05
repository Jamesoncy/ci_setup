<script>
$(document).ready(function(){
	<?php if($use_js == "roles_page"){?>
		var desc = $("#description");
		desc.html('<center><span><i class="fa fa-spinner fa-lg fa-fw fa-spin"></i></span></center>');
		get_roles();

		$("#submit").click(function(){
				btnAdd();
		});	

		function btnAdd(){
			$('#po_search_form').rOkay({
				btn_load		: 	$('#submit'),
				bnt_load_remove	: 		false,
				onComplete		:	function(data){
								var result = JSON.parse(data);
								
								if(result.result == 'invalid')
								{
									$('.hide-alert').show();
									$('.hide-alert').html(data.error);
									$("#submit").removeAttr("disabled").html(lastTxt);
									
								}
								else
									window.location=baseUrl+'dashboard/view';
								
									
				}
			});		
		}

		function get_roles(){
			$.post(baseUrl+'roles/get_roles',null,function(data){
							
							desc.html(data);
								
						
			},'html');
		}	
	<?php }?>
});
</script>
