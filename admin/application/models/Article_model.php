<?php 

class Article_model extends CI_Model {

    private $grid_fs;

    public function __construct() {
        parent::__construct();
        $this->grid_fs = $this->mongo_db->db->getGridFS();
    }

    public function get_data_where($where) {
        return $this->mongo_db->where($where)->get($this->collection);
    }
    
    public function get_image_filestream($where) {
        return $this->grid_fs->findOne($where);
    }

    public function upload_image_filestream($image, $options = [], $is_update = false) {
        if ($is_update != false) {
            $this->remove_image_filestream($options);
        }
        return $this->grid_fs->storeUpload($image, $options);
    }

    public function remove_image_filestream($where) {
        return $this->grid_fs->remove($where);
    }

    public function add_new_data($data) {
        // masukkan data ke header dulu
        $id_header =  $this->mongo_db->insert($this->collection, $data);
        // masukkan data ke detail
        $data['_id'] = new MongoId($id_header);
        return $this->mongo_db->insert($this->collection_detail, $data);
    }

    public function update_article($data, $where) {
        return $this->mongo_db->where($where)->set($data)->update($this->collection);
    }

    public function remove_article($where) {
        $article = $this->mongo_db->where($where)->get($this->collection);
        if (is_array($article) && count($article) > 0) {
            if (isset($artile['image'])) {
                $this->remove_image_filestream(array('filename' => $article['image']['filename']));
            }
            unset($article);
            $this->mongo_db->where($where)->delete($this->collection);
        }
        return true;
    }

    public function remove_batch_article($data_where, $key) {
        // $key => attr di database
        foreach ($data_where as $d_v) {
            $where[$key] = $d_v;
            if ($key == '_id') {
                $where[$key] = new MongoId($d_v);
            }
            $this->remove_article($where);
        }
        return true;
    }

}

?>