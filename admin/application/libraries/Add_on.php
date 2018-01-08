<?php 

class Add_on {
    private $CI;

    public function __construct() {
        $this->CI =& get_instance();
    }

    public function set_error_message($message, $type) {
        /*
        type value:
        1. danger
        2. info
        3. warning
        4. success
        */
        $error_message = '<div class="alert alert-'.$type.' alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> '.$this->CI->lang->line($type).'!</h4>
            '.$message.'
        </div>';
        $this->CI->session->set_userdata('error_message', $error_message);
    }

};

?>