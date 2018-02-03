<?php

class General_model extends CI_Model {
  private $grid_fs;

  public function __construct() {
    parent::__construct();
    $this->grid_fs = $this->mongo_db->db->getGridFS();
  }

  public function get_data($where = []) {
    if (is_array($where) && count($where) > 0) {
      $this->mongo_db->where($where);
    }
    $this->mongo_db->order_by($this->default_order);
    return $this->mongo_db->get($this->collection);
  }

  public function get_image_from_db($where) {
    return $this->grid_fs->findOne($where);
  }

  public function get_user($where) {
    return $this->mongo_db->get_where($this->collection, $where);
  }

  public function insert_data($data) {
    return $this->mongo_db->insert($this->collection, $data);
  }

  // custom 
  public function get_data_custom($collection_name, $where = [], $order_by = []) {
    if (count($where) > 0 ) {
      $this->mongo_db->where($where);
    }
    if (count($order_by) > 0) {
      $this->mongo_db->order_by($order_by);
    }
    return $this->mongo_db->get($collection_name);
  }

  public function add_new_data($collection_name, $data) {
    return $this->mongo_db->insert($collection_name, $data);
  }


}