<?php
function validate_dashboard($CI){
	$CI->form_validation->set_rules('delivery_date', 'Delivery Date', 'required');
	$CI->form_validation->set_rules('supplier', 'Supplier', 'required');
}
