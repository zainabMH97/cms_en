<?php 
    class Category_model extends CI_Model {
        public function  __construct(){
            $this->load->database();
        }


        public function checkCategory(){
            $term_title = clean_input($this->input->post('title'));
            return $this->db->get_where('term',array('term_title'=>$term_title,'active'=>1)); 
            
        }

        public function create_term($admin_id,$parent,$cat){
                $term_title = clean_input($this->input->post('title'));
                $term_description = clean_input($this->input->post('description'));
                $sql ='INSERT INTO term (term_title, term_description, admin_id) VALUES(:term_title, :term_description, :admin_id)';
                $stmt = $this->db->conn_id->prepare($sql);
                $stmt->execute([':term_title'=> $term_title, ':term_description'=> $term_description, ':admin_id'=> $admin_id]);
                $lsid = $this->db->conn_id->lastInsertId();
                $sql = "INSERT INTO term_taxonomy(term_id,taxnomy,parent) VALUES (:term_id,:taxnomy,:parent)";
                $stmt = $this->db->conn_id->prepare($sql);
                $stmt->execute([':term_id'=> $lsid,':taxnomy'=>$cat,':parent' => $parent]);
               
        }

        public function fetch_term($parent,$taxonomy){
            
            $active = 1;
            $sql = 'SELECT term_title,term_description,term.term_id FROM term inner join term_taxonomy on term_taxonomy.term_id = term.term_id where term_taxonomy.parent = :parent and term_taxonomy.taxnomy = :taxonomy and active = :active';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':parent'=> $parent, ':taxonomy'=> $taxonomy, ':active' => $active]);
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
                return $row = [] ;
            }
            

        }

        public function fetch_term_By_id($cat_id){
            $active = 1;
            $sql = "SELECT parent,term_title,term_description,term.term_id FROM term inner join term_taxonomy on term_taxonomy.term_id = term.term_id where term.term_id = :term_id and active = :active";
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':term_id'=> $cat_id,':active' => $active]);
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $row ;
        }

        public function update_cat_info($id){
            $data = array(
                'term_title' => clean_input($this->input->post('title')),
                'term_description' => clean_input($this->input->post('description'))
            ); 
            $this->db->where('term_id',$id);
            return $this->db->update('term', $data);
        }

        public function deleteCat($id){
            $active = 0;
            $sql = "UPDATE term SET  active = :active where term_id = :term_id LIMIT 1";
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':term_id' => $id,':active' => $active]);
        }
        
        public function fetch_only_custome_cat($admin_id){
            $active = 1;
            $tax = 'cat';
            $sql="SELECT term.term_id,term_title,term_description FROM term 
            inner join custome on term.term_id = custome.term_id
            inner join term_taxonomy on term.term_id = term_taxonomy.term_id
             where custome.admin_id  = :admin_id and active = :active and taxnomy = :tax";
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':admin_id' => $admin_id ,':active' => $active,':tax'=>$tax]);
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $row ;
        }

        public function fetch_selected_category($post_id){
            $sql="select term_id from term_relation where post_id = :post_id";
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':post_id' => $post_id]);
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $row ;
        }

        public function fetch_selected_subcategory($result,$taxnomy){
            if(!empty($result)){
            $numArray = array_map('intval', $result);
            $this->db->select('term_title, term_description, term.term_id');
            $this->db->from('term');
            $this->db->join('term_taxonomy', 'term.term_id = term_taxonomy.term_id');
            $this->db->where_in('term_taxonomy.term_id',$numArray);
            $this->db->where('parent >', 0); 
            $this->db->where('taxnomy', $taxnomy); 
            $this->db->where('term.active', 1);
            $query = $this->db->get();
            return $query->result_array();
            }else{
                return '';
            }
            
        }


        public function fetch_selected_tag($result,$taxnomy){
            if(!empty($result)){
                $numArray = array_map('intval', $result);
                $this->db->select('term_title, term_description, term.term_id');
                $this->db->from('term');
                $this->db->join('term_taxonomy', 'term.term_id = term_taxonomy.term_id');
                $this->db->where_in('term.term_id', $numArray);
                $this->db->where('taxnomy', $taxnomy); 
                $this->db->where('term.active', 1);
                $query = $this->db->get();
                return $query->result_array();
            }else{
                return '';
            }
        }

        public function countCategory(){
            $active = 1;
            $tax = 'cat';
            $parent = 0;
            $sql = "SELECT count(*) from term inner join term_taxonomy on term.term_id = term_taxonomy.term_id where parent =:parent and taxnomy =:tax and active =:active"; 
            $result = $this->db->conn_id->prepare($sql); 
            $result->execute([':parent'=>$parent,':tax'=>$tax,':active'=>$active]); 
            return $number_of_rows = $result->fetchColumn(); 
        }

        public function lastcategory(){
            $sql = 'SELECT term_title
            FROM term
            ORDER BY term_id DESC
            LIMIT 0,3';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($row){
                return $row;
            }else{
                return $row = [];
            }
        }

       
        
    }