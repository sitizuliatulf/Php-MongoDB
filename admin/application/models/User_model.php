<?php 

class User_model extends CI_Model {

    public function get_data_where($where) {
        return $this->mongo_db->where($where)->get($this->collection);
    }

    public function add_new_data($data) {
        return $this->mongo_db->insert($this->collection, $data);
    }

    public function data_is_admin() {
        $data = array();
        
        $tmp = new stdClass();
        $tmp->id = 1;
        $tmp->name = $this->lang->line('yes');
        array_push($data, $tmp);
        unset($tmp);

        $tmp = new stdClass();
        $tmp->id = 2;
        $tmp->name = $this->lang->line('no');
        array_push($data, $tmp);
        unset($tmp);
        
        return $data;
    }

    public function remove_user($where) {
        $this->mongo_db->where($where)->delete($this->collection);
    }

    public function remove_batch_user($data_where, $key) {
        // $key => attr di database
        foreach ($data_where as $d_v) {
            $where[$key] = $d_v;
            if ($key == '_id') {
                $where[$key] = new MongoId($d_v);
            }
            $this->mongo_db->where($where)->delete($this->collection);
        }
    }

}

?>