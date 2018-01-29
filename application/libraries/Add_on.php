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
                $session_user_login->isAdmin === true && 
                $session_user_login->isDelete === false) {
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
    
}

?>