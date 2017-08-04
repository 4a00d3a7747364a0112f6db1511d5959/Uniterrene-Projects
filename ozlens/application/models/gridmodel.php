<?php 

class gridmodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function output($data)
    {					        		
		$output = "{ \"aaData\": [";		
		$container ='';
		
		foreach($data as $row)
		{			
			$container .="[";			
			$vals = '';
			
			foreach($row as $key => $value)
			{
				$vals.= '"'.$this->format_string($value).'",';
			}
			
			$vals = substr($vals,0,strlen($vals)-1);			
			$container .= $vals;			
			$container .="],";						
		}
		
		$container = substr($container,0,strlen($container)-1);		
		$output .= $container;		
		$output .="] }";
		
		return $output;
    }
	
	function format_string($str)
	{
		$str = str_replace('"',"&quot;",$str);
		$str = str_replace('\n',"<br />",$str);	
		
		return $str;
	}
}

?>