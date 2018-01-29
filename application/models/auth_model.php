<?php

class Auth_model extends CI_Model
{
	public function __construct(){
		parent:: __construct();
	}

	public function get_user($collections, $where){
		return $this->mongo_db->get_where($collections, $where);
	}

}