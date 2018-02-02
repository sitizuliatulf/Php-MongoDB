<?php

class General_model extends CI_Model {
  private $grid_fs;

  public function __construct() {
    parent::__construct();
    // $this->grid_fs = $this->mongo_db->db->gridFs();
  }

  public function get_data($where = []) {
    if (is_array($where) && count($where) > 0) {
      $this->mongo_db->where($where);
    }
    $this->mongo_db->order_by($this->default_order);
    return $this->mongo_db->get($this->collection);
  }

  public function get_user($where){
    // array('username' => 'username', 'password' => 'password');
    return $this->mongo_db->get_where($this->collection, $where);
  }

  public function insert_data($data) {
    return $this->mongo_db->insert($this->collection, $data);
  }

}