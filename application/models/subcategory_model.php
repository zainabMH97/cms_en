<?php 
    class Subcategory_model extends CI_Model {
        public function  __construct(){
            $this->load->database();
        }
         

        public function create_sub_term($admin_id){
            $taxonomy = 'cat';
            $term_title = clean_input($this->input->post('title'));
            $term_description = clean_input($this->input->post('description'));
            $category_id = clean_input($this->input->post('category_id'));
            
            $sql ='INSERT INTO term(term_title, term_description, admin_id) VALUES(:term_title, :term_description, :admin_id)';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':term_title'=> $term_title, ':term_description'=> $term_description, ':admin_id'=> $admin_id]);
            $lsid = $this->db->conn_id->lastInsertId();
            $sql = "INSERT INTO term_taxonomy(term_id,taxnomy,parent) VALUES (:term_id,:taxnomy,:parent)";
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':term_id'=> $lsid,':taxnomy'=>$taxonomy,':parent' => $category_id]);
        }

        public function fetch_only_subcat(){
            $taxnomy = "cat";
            $active = 1; 
            $sql="SELECT parent,term_title,term_description,term.term_id FROM term inner join term_taxonomy on term_taxonomy.term_id = term.term_id where term_taxonomy.parent >0 and term_taxonomy.taxnomy = :taxnomy and active= :active";
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':taxnomy'=> $taxnomy,':active' => $active]);
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

        public function update_SubCat_Info($id){
            $data = array(
                'term_title' => clean_input($this->input->post('title')),
                'term_description' => clean_input($this->input->post('description'))
            ); 
            $this->db->where('term_id',$id);
            return $this->db->update('term', $data);
        }
        public function update_subcat_parent($id){
            $active = 1;
            $new_parent = clean_input($this->input->post('category_id'));
            $sql = "update term inner join term_taxonomy on term_taxonomy.term_id = term.term_id set term_taxonomy.parent = :parent where term.term_id = :term_id and term.active = :active";
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':parent'=> $new_parent,':term_id' => $id, ':active' =>$active]);
        }

        public function fetch_only_custome_subcat($id){
            
        }

        public function countSubs(){
            $active = 1;
            $tax = 'cat';
            $parent = 0;
            $sql = "SELECT count(*) from term inner join term_taxonomy on term.term_id = term_taxonomy.term_id where parent >:parent and taxnomy =:tax and active =:active"; 
            $result = $this->db->conn_id->prepare($sql); 
            $result->execute([':parent'=>$parent,':tax'=>$tax,':active'=>$active]); 
            return $number_of_rows = $result->fetchColumn(); 
        }
    }