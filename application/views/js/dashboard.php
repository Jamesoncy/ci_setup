<script>
$(document).ready(function(){
	<?php if($use_js == "dashboard_page"){?>
		$("#submit").click(function(){
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
		});		
	<?php }?>
});
</script>
