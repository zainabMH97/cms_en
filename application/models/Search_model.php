<?php 
    class Search_model extends CI_Model {
        public function  __construct(){
            $this->load->database();
        }

        public function fetch_data($limit,$offset){
            $id = $this->session->userdata('search_query');
            $status = 'publish';
            $active = 1;
            $parent = 0 ;
            $taxonomy = 'cat';
           $sql = 'SELECT group_concat(term_title),post.post_id as p_id,term_relation.term_id as ter_id ,post_title,post_slug,status,post_date FROM post
           inner join term_relation on post.post_id = term_relation.post_id 
           inner join term on term.term_id = term_relation.term_id 
           inner join term_taxonomy on term_taxonomy.term_id = term.term_id 
           where term_relation.post_id = post.post_id and taxnomy = :taxonomy and parent = :parent and post.active =:active  and term.term_id = :term_id
           group by term_relation.post_id order by post.post_id desc limit :offset ,:limit';
           $stmt = $this->db->conn_id->prepare($sql);
           $stmt->execute([':taxonomy'=>$taxonomy,':parent' =>$parent,':active'=>$active,':term_id'=>$id,':offset'=>$offset , ':limit'=>$limit]);
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

        public function countSearchNews($id){
            $status = 'publish';
            $active = 1;
            $parent = 0 ;
            $taxonomy = 'cat';
           $sql = 'SELECT group_concat(term_title),post.post_id as p_id,term_relation.term_id as ter_id ,post_title,post_slug,status,post_date FROM post
           inner join term_relation on post.post_id = term_relation.post_id 
           inner join term on term.term_id = term_relation.term_id 
           inner join term_taxonomy on term_taxonomy.term_id = term.term_id 
           where term_relation.post_id = post.post_id and taxnomy = :taxonomy and parent = :parent and post.active =:active  and term.term_id = :term_id
           group by term_relation.post_id order by post.post_id desc';
           $stmt = $this->db->conn_id->prepare($sql);
           $stmt->execute([':taxonomy'=>$taxonomy,':parent' =>$parent,':active'=>$active,':term_id'=>$id]);
           $row = $stmt->rowCount();
            return $row;
        }

        public function fetch_custome_data($limit,$offset){
            $id = $this->session->userdata('search_query');
            $admin_id = $this->session->userdata('admin_id');
            $status = 'publish';
            $active = 1;
            $parent = 0 ;
            $taxonomy = 'cat';
           $sql = 'SELECT group_concat(term_title),post.post_id as p_id,term_relation.term_id as ter_id ,post_title,post_slug,status,post_date FROM post
           inner join term_relation on post.post_id = term_relation.post_id 
           inner join term on term.term_id = term_relation.term_id 
           inner join term_taxonomy on term_taxonomy.term_id = term.term_id 
           where term_relation.post_id = post.post_id and taxnomy = :taxonomy and parent = :parent and post.active =:active  and term.term_id = :term_id and post.admin_id = :admin_id
           group by term_relation.post_id order by post.post_id desc limit :offset ,:limit';
           $stmt = $this->db->conn_id->prepare($sql);
           $stmt->execute([':taxonomy'=>$taxonomy,':parent' =>$parent,':active'=>$active,':term_id'=>$id,':offset'=>$offset , ':limit'=>$limit,':admin_id'=>$admin_id]);
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
    }