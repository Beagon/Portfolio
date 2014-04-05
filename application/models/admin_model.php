<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function login($username, $password){
        $query = $this->db->query('SELECT * FROM `users` WHERE `username` = \''.$username.'\' LIMIT 1');
        if ($query->num_rows() > 0)
        {
            $row = $query->row();
            if($row->password  == hash('sha256', ($password . ":" . $row->salt))){
                return true;
            }else{
              return false;              
            }
        }else{
            return false;
        }
    }

    public function add_project($title, $subheader, $text, $url, $image_url, $language){
        $data = array(
                       'title' => $title,
                       'subheader' => $subheader,
                       'text' => $text,
                       'link' => $url,
                       'image_url' => $image_url,
                       'language' => $language
                    );

        if($this->db->insert('projects', $data)){
            return true;
        }else{
            return false;
        }
    }

    public function mod_project($id, $title, $subheader, $text, $url){
        $data = array(
                       'title' => $title,
                       'subheader' => $subheader,
                       'text' => $text,
                       'link' => $url,
                    );
        
        $this->db->where('id', $id);
       
       if( $this->db->update('projects', $data)){
            return true;
        }else{
            return false;
        }      
    }

    public function remove_project($id){
        
        if($this->db->delete('projects', array('id' => $id))){
            return true;
        }else{
            return false;
        }

    }

    public function record_count_search($search) {
        $query = $this->db->query('SELECT `id` FROM `projects` WHERE `title` LIKE \'%'.$search.'%\';');
        return $query->num_rows();
    }

    public function record_count() {
        return $this->db->count_all("projects");
    }

    public function fetch_project($id){
        $query = $this->db->query('SELECT * FROM `projects` WHERE `id` = \''.$id.'\' LIMIT 1');
        if ($query->num_rows() > 0)
        {
            return $query->result();
        }else{
            return false;
        }
    }

    public function fetch_projects_search($limit, $start, $search) {
        $this->db->limit($limit, $start);
        $query = $this->db->query('SELECT * FROM `projects` WHERE `title` LIKE \'%'.$search.'%\';');
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
 
    public function fetch_projects($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get("projects");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
}