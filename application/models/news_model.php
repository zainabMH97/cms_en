<?php 
    class News_model extends CI_Model {
        public function  __construct(){
            $this->load->database();
        }

        // create_news($news,$img,$terms)
        public function create_news($news,$img,$terms){
                $data = array(
                    'post_title' => $news['title'] , 
                    'post_description' => $news['description'],
                    'admin_id' => $news['admin_id'],
                    'post_slug' => $news['post_slug'],
                    'time_to_read'=>$news['time_need_to_read'],
                    'status' =>$news['status'],
                    'post_img' => $img,
                    'post_date'=>date("Y-m-d H:i:s" , time())
                );

                $this->db->insert('post', $data);
                $lsid = $this->db->conn_id->lastInsertId();
                if(!$terms == NULL){ 
                    
                    $terms_arr = [];
                    foreach($terms as $term){
                        $terms_arr_associative = array (
                        'post_id' => $lsid,
                        'term_id' => $term
                        );
                        array_push($terms_arr,$terms_arr_associative);
                    }
                    if($this->db->insert_batch('term_relation', $terms_arr)){
                        return true;
                    }else{
                        return false;
                    }
                }
        }

        

        public function checkPost($data)  
        {
            return $this->db->get_where('post',array('post_title'=>$data));
        }

        public function fetch_custom_news($admin_id){
            $active = 1;
            $sql = 'SELECT status,post_title,post_slug,post_description,post_img,post_id FROM post WHERE  admin_id =:admin_id and active = :active';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute(['admin_id'=>$admin_id,':active' => $active]);
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
        public function fetch_news(){
            $active = 1;
            $status = 'publish';
            $limit = 100;
           $sql = 'SELECT post_title FROM post where status = :status and active = :active order by post_id desc limit :limit';
           $stmt = $this->db->conn_id->prepare($sql);
           $stmt->execute([':active'=>$active,':status' => $status,':limit'=>$limit]);
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

        public function fetch_news_edit($limit,$offset){
             $active = 1;
             $parent = 0 ;
             $taxonomy = 'cat';
            $sql = 'SELECT group_concat(term_title),post.post_id as p_id,term_relation.term_id as ter_id ,post_title,post_slug,status,post_date FROM post
            inner join term_relation on post.post_id = term_relation.post_id 
            inner join term on term.term_id = term_relation.term_id 
            inner join term_taxonomy on term_taxonomy.term_id = term.term_id 
            where term_relation.post_id = post.post_id and taxnomy = :taxnomy and parent = :parent and post.active =:active and term.term_id != :term_id
            group by term_relation.post_id order by post.post_id desc limit  :offset, :limi';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':active'=>$active,':limi' => $limit,':parent'=>$parent,':taxnomy'=>$taxonomy,':offset'=>$offset,':term_id'=>0]);
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

        public function create_news_cat_relation($post_id,$taxonomy_id){
            $data = array(
                'post_id' => $post_id,
                'term_taxonomy_id' => $taxonomy_id
            );

            return $this->db->insert('term_relation', $data);
        }

        public function fetch_news_By_slug($slug){
            $active = 1;
            $sql = 'SELECT time_to_read,post_title,post_slug,post_description,post_img,post_id,status,post_date FROM post WHERE post_slug =:post_slug and active = :active';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':post_slug'=>$slug,':active' => $active]);
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

        public function update_news_info($post_id,$img,$terms,$news){
            if($img == NULL){
                $data = array(
                    'post_title' => $news['title'] ,
                    'post_description' => $news['description'],
                    'admin_update_id' => $news['admin_id'],
                    'status' => $news['status'],
                    'time_to_read'=>$news['time_need_to_read'],
                );
                $this->db->update('post', $data,array('post_id' => $post_id));
                
            }else{
                $data = array(
                    'post_title' => $news['title'] ,
                    'post_description' => $news['description'],
                    'post_img' => $img,
                    'admin_update_id' => $news['admin_id'],
                    'status' => $news['status'],
                    'time_to_read'=>$news['time_need_to_read'],
                );
                $this->db->update('post', $data,array('post_id' => $post_id));
            }
           
            if(!$terms == NULL){
                
                $this->db->delete('term_relation', array('post_id' => $post_id));
                $terms_arr = [];
                foreach($terms as $term){
                    $terms_arr_associative = array (
                    'post_id' => $post_id,
                    'term_id' => $term
                    );
                    array_push($terms_arr,$terms_arr_associative);
                }
                if($this->db->insert_batch('term_relation', $terms_arr,'term_id')){
                    return true;
                }else{
                    return false;
                }
            }else{
                return True;
            }
            
             
        }

        public function deleteNews($news_id){
            $active = 0;
            $sql = 'UPDATE post SET active= :active WHERE post_id= :post_id LIMIT 1';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':post_id' => $news_id, ':active' => $active]);
        }

        public function check_custom_postId($news_id){
            $admin_id  = $this->session->userdata('admin_id');
            $active = 1;
            $sql = 'select post_id from post where admin_id = :admin_id';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':admin_id' => $admin_id]);
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $find_in_arr = [];
            foreach($row as $value) {
                foreach($value as $val){
                    array_push($find_in_arr,$val);
                }
            }
            if(in_array($news_id,$find_in_arr)){
                return true;
            }else{
                return false;
            }

        }

        public function changeStatus($id,$status){
            $active = 1;
            $sql = 'UPDATE post SET status= :status WHERE post_id= :post_id and active = :active';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':post_id' => $id,':status'=>$status, ':active' => $active]);
        }

        public function fetch_newsTerm_By_slug($slug){
            $sql = 'SELECT 
            term.term_title, parent, taxnomy
            FROM
            post
            inner join 
            term_relation on term_relation.post_id = post.post_id
                    INNER JOIN
                term_taxonomy ON term_taxonomy.term_id = term_relation.term_id
                    INNER JOIN
                term ON term.term_id = term_relation.term_id
            WHERE
                post.post_slug = :post_slug';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':post_slug'=>$slug]);
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($row){
                return $row;
            }else{
                return $row = [];
            }
        }

        public function fetch_news_By_id($id){
            $active = 1;
            $sql = 'SELECT time_to_read,post_title,post_slug,post_description,post_img,post_id,status,post_date FROM post WHERE post_id =:post_id and active = :active';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':post_id'=>$id,':active' => $active]);
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

        public function countNews(){
            
            $query = $this->db->query('SELECT group_concat(term_title),post.post_id as p_id FROM post
            inner join term_relation on post.post_id = term_relation.post_id 
            inner join term on term.term_id = term_relation.term_id 
            inner join term_taxonomy on term_taxonomy.term_id = term.term_id 
            where term_relation.post_id = post.post_id and taxnomy = "cat" and parent = 0 and post.active =1
            group by term_relation.post_id  ');
            return $query->num_rows();

        }

        public function countNews_custome($id){
            $active = 1;
            $sql = 'select post_id from post where post.admin_id = :id and active= :active';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':active'=>$active,':id'=>$id]);
            $row = $stmt->rowCount();
            return $row;
        }

        public function lastnews(){
            $sql = 'SELECT post_title,post_date
            FROM post
            ORDER BY post_id DESC
            LIMIT 0,5';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($row){
                return $row;
            }else{
                return $row = [];
            }
        }

        public function publishednews($status){
            $this->db->where('status', $status);
            $num_rows = $this->db->count_all_results('post');
            return $num_rows;
        }

        public function termsEditNews($taxonomy,$parent){
            $sql = 'SELECT group_concat(term_title),post.post_id as p_id FROM post
            inner join term_relation on post.post_id = term_relation.post_id 
            inner join term on term.term_id = term_relation.term_id 
            inner join term_taxonomy on term_taxonomy.term_id = term.term_id 
            where term_relation.post_id = post.post_id and taxnomy = :taxonomy and parent = :parent and post.active =1
            group by term_relation.post_id  ';
            
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':taxonomy' => $taxonomy,':parent'=>$parent]);
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if($row){
                return $row;
            }else{
                return $row = [];
            }
        }

        public function subcategoryEditNews($taxonomy,$parent){
            
            $sql = 'SELECT group_concat(term_title),post.post_id as p_id FROM post
            inner join term_relation on post.post_id = term_relation.post_id 
            inner join term on term.term_id = term_relation.term_id 
            inner join term_taxonomy on term_taxonomy.term_id = term.term_id 
            where term_relation.post_id = post.post_id and taxnomy = :taxonomy and parent > :parent and post.active =1
            group by term_relation.post_id';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':taxonomy' => $taxonomy,':parent'=>$parent]);
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($row){
                return $row;
            }else{
                return $row = [];
            }
        }


        public function fetch_uncategorieznews($limit,$offset){
            $sql = 'SELECT
                post.post_id as p_id,post_title,post_slug,status
            FROM
                post  
                LEFT JOIN term_relation ON
                    post.post_id = term_relation.post_id
            WHERE
                term_relation.term_id IS NULL limit :offset , :limit';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':offset' => $offset,':limit'=>$limit]);
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

        public function countNewsUncategorized(){
            $query = $this->db->query('SELECT post.post_id FROM post  LEFT JOIN term_relation ON post.post_id = term_relation.post_id
                WHERE term_relation.term_id IS NULL');
                return $query->num_rows();
        }

        
        public function fetch_news_edit_custome($limit,$offset,$id){
            $active = 1;
             $parent = 0 ;
             $taxonomy = 'cat';
            $sql = 'SELECT group_concat(term_title),post.post_id as p_id,term_relation.term_id as ter_id ,post_title,post_slug,status,post_date FROM post
            inner join term_relation on post.post_id = term_relation.post_id 
            inner join term on term.term_id = term_relation.term_id 
            inner join term_taxonomy on term_taxonomy.term_id = term.term_id 
            where term_relation.post_id = post.post_id and post.admin_id = :id and taxnomy = :taxnomy and parent = :parent and post.active =:active and term.term_id != :term_id
            group by term_relation.post_id order by post.post_id desc limit  :offset, :limi';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':active'=>$active,':limi' => $limit,':parent'=>$parent,':taxnomy'=>$taxonomy,':offset'=>$offset,':term_id'=>0,':id'=>$id]);
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

        ////////////////////////////////

        public function fetch_uncategorieznews_custome($limit,$offset){
            $id = $this->session->userdata['admin_id'];
            $sql = 'SELECT
            post.post_id as p_id,post_title,post_slug,status
        FROM
            post  
            LEFT JOIN term_relation ON
                post.post_id = term_relation.post_id
        WHERE
            term_relation.term_id IS NULL and post.admin_id = :admin_id limit  :offset,:limit';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':offset' => $offset,':limit'=>$limit,':admin_id'=>$id]);
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

        public function countNewsUncategorizedcustome(){
            $id = $this->session->userdata['admin_id'];
            $query = $this->db->query('SELECT post.post_id FROM post  LEFT JOIN term_relation ON post.post_id = term_relation.post_id
            WHERE term_relation.term_id IS NULL and post.admin_id = '.$id.'');
            return $query->num_rows();
        }
    }