<?php 

class Article_model extends CI_Model {

    private $grid_fs;

    public function __construct() {
        parent::__construct();
        $this->grid_fs = $this->mongo_db->db->getGridFS();
    }

    public function get_data_where($where) {
        $article = $this->mongo_db->where($where)->get($this->collection);
        if (is_array($article) && count($article) > 0) {
            $article = array_shift($article);
            // $this->m$article['image']['tmpFilename'];
            $data = $this->grid_fs->findOne(array('filename' => $article['image']['filename']));
            header('Content-type: image/png;');
            $stream = $data->getResource();

            while (!feof($stream)) {
                echo fread($stream, 8192);
            }
            die;
        }
        die;
    }

    public function upload_image_filestream($image, $options = []) {
        return $this->grid_fs->storeUpload($image, $options);
    }

    public function add_new_data($data) {
        // masukkan data ke header dulu
        $id_header =  $this->mongo_db->insert($this->collection, $data);
        // masukkan data ke detail
        $data['_id'] = new MongoId($id_header);
        return $this->mongo_db->insert($this->collection_detail, $data);
    }

    public function update_user($data, $where) {
        return $this->mongo_db->where($where)->set($data)->update($this->collection);
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