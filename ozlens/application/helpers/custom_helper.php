<?php

function isGreenIDVerified(){
	$CI =& get_instance();
	$token = $CI->session->userdata('member_data')->greenid_verified;	
	if($token == 'Inactive'){
		$CI->session->set_flashdata('response', '<div class="error-box">GreenID verification is required in order to rent an item.</div>');
		redirect(base_url()."member/myaccount",'location');
	}
}



function countries_drop_down($query,$name=''){

	

	$html = '<select id="country" name="country" class="inner-fld-01 required" style="width:216px; padding:5px 5px 5px 0px;"><option value="">Select</option>';

	

	foreach($query->result() as $row){

		if($name == $row->name){

			$html .= '<option value="'.$row->name.'" selected="selected">'.$row->name.'</option>';

		}

		else{

			$html .= '<option value="'.$row->name.'">'.$row->name.'</option>';

		}

		

	}

	$html.='</select>';

	

	return $html;

}

?>