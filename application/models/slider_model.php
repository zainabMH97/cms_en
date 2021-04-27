<?php 
    class Slider_model extends CI_Model {
        public function  __construct(){
            $this->load->database();
        }

        public function create_slider($data,$img){
            $data = array(
                'post_title' => $data['title'] , 
                'post_description' => $data['caption'],
                'admin_id' => $this->session->userdata('admin_id'),
                'post_img' => $img
            );

            $this->db->insert('post', $data);
            $lsid = $this->db->conn_id->lastInsertId();
            $sql = 'INSERT into term_relation (post_id,term_id) VALUES(:post_id , :term_id)';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':post_id' => $lsid,':term_id' => 0]);
            if($stmt){
                return true;
            }else{
                return false;
            }
        }

        public function fetch_slider(){
            $active = 1;
            $term_title = 'slider';
            $term_id = 0 ;
            $sql = 'select post_title,post_description,post_img,post.post_id,status FROM post 
            inner join term_relation on term_relation.post_id = post.post_id
            inner join term on term_relation.term_id = term.term_id where term.term_id = :term_id and term.term_title = :term_title
            and post.active = :active
            ';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':term_title'=>$term_title,':term_id'=>$term_id,':active'=>$active]);
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($row){
                $result = [];
                foreach($row as $r){
                    $arr_key = array_keys($r);
                    $arr_val = decode_clean_input(array_values($r));
                    $arr_new_val = array_combine($arr_key, $arr_val);
                    array_push($result,$arr_new_val);
                }
                return $result;
            }else{
                return $row = [];
            }
        }


        public function fetch_slider_info($news_id){
            $active = 1;
            $sql = 'SELECT post_title,post_description,post_img,post_id FROM post WHERE post_id =:post_id and active = :active ';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':post_id'=>$news_id,':active' => $active]);
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($row){
                $result = [];
                foreach($row as $r){
                    $arr_key = array_keys($r);
                    $arr_val = decode_clean_input(array_values($r));
                    $arr_new_val = array_combine($arr_key, $arr_val);
                    array_push($result,$arr_new_val);
                }
                return $result;
            }else{
                return $row = [];
            }
        }

        public function update_slider($data,$post_img,$id){
            if($post_img == NULL){
                $data = array(
                    'post_title' => $data['title'] ,
                    'post_description' => $data['caption'],
                    'admin_update_id' => $this->session->userdata('admin_id')
                );
                $this->db->update('post', $data,array('post_id' =>$id ));
                return true;
            }else{
                $data = array(
                    'post_title' => $data['title'] ,
                    'post_description' => $data['caption'],
                    'post_img' => $post_img,
                    'admin_update_id' => $data['admin_id'],
                );
                $this->db->update('post', $data,array('post_id' =>$id));
                return true;
            }
        }
    }
    