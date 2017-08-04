<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {
	
	protected $_error_prefix		= '<li>';
	protected $_error_suffix		= '</li>';
	
	private $_custom_field_errors = array();

	public function _execute($row, $rules, $postdata = NULL, $cycles = 0){
        // Execute the parent method from CI_Form_validation.
        parent::_execute($row, $rules, $postdata, $cycles);

        // Override any error messages for the current field.
        if (isset($this->_error_array[$row['field']])
            && isset($this->_custom_field_errors[$row['field']]))
        {
            $message = str_replace(
                '%s',
                !empty($row['label']) ? $row['label'] : $row['field'],
                $this->_custom_field_errors[$row['field']]);

            $this->_error_array[$row['field']] = $message;
            $this->_field_data[$row['field']]['error'] = $message;
        }
    }

    public function set_rules($field, $label = '', $rules = '', $message = ''){
        $rules = parent::set_rules($field, $label, $rules);

        if (!empty($message))
        {
            $this->_custom_field_errors[$field] = $message;
        }

        return $rules;
    }

   
   public function is_unique($str, $field){
      if (substr_count($field, '.')==3)
      {
         list($table,$field,$id_field,$id_val) = explode('.', $field);
         $query = $this->CI->db->limit(1)->where($field,$str)->where($id_field.' != ',$id_val)->get($table);
      } else {
         list($table, $field)=explode('.', $field);
         $query = $this->CI->db->limit(1)->get_where($table, array($field => $str));
      }
      
      return $query->num_rows() === 0;
    }
	
	
}