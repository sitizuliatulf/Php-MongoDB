<?php 

class Add_on {
    private $CI;

    public function __construct() {
        $this->CI =& get_instance();
    }

    public function user_is_login($isBackend = false) {
        $session_user_login = $this->CI->session->userdata('session_user_login');
        if (is_object($session_user_login)) {
            if ($isBackend) {
                if ($session_user_login->_id->{'$id'} !== '' && 
                $session_user_login->isAdmin === 1) {
                    return true;
                }
                return false;
            } else {
                if ($session_user_login->_id->{'$id'} && 
                $session_user_login->isDelete === false) {
                    return true;
                }
                return false;
            }
        }
        return false;
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
        $this->CI->session->set_flashdata('error_message', $error_message);
    }

    public function initial_project() {
        $this->CI->load->library('mongo_db');
        if ($this->CI->mongo_db->count('users') > 0) {
            return true;
        } 
        //data temporary admin
        $tmp_user = array(
            'username' => "Azhar Prabudi",
            'email' => "azharprabui@gmail.com",
            'password' => "f7c3bc1d808e04732adf679965ccc34ca7ae3441",
            'isAdmin' => 1,
            'lastLoggin' => '',
            'registerDate' => date("Y-m-d h:i:sa") // berikan waktu saat ini
        );
        $this->CI->mongo_db->insert('users', $tmp_user);
        return true;
    }

};

?>