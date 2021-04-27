<?php 
    class Tag_model extends CI_Model {
        public function  __construct(){
            $this->load->database();
        }

        public function update_tag_info($id){
            $data = array(
                'term_title' => clean_input($this->input->post('title')),
                'term_description' => clean_input($this->input->post('description'))
            ); 
            $this->db->where('term_id',$id);
            return $this->db->update('term', $data);
        }

        public function fetch_only_custom_tag($id){
            $active = 1;
            $tax = 'tag';
            $sql="SELECT term.term_id,term_title,term_description FROM term 
            inner join custome on term.term_id = custome.term_id
            inner join term_taxonomy on term.term_id = term_taxonomy.term_id
             where custome.admin_id  = :admin_id and active = :active and taxnomy = :tax";
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':admin_id' => $id ,':active' => $active,':tax'=>$tax]);
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $row ;
        }

        public function fetch_term_By_id($id){
            $active = 1;
            $tax = 'tag';
            $sql="SELECT term.term_id,term_title,term_description FROM term 
            inner join term_taxonomy on term.term_id = term_taxonomy.term_id
             where term.term_id  = :term_id and active = :active and taxnomy = :tax";
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':term_id' => $id ,':active' => $active,':tax'=>$tax]);
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $row ;
        }


        public function counttag(){
            $active = 1;
            $tax = 'tag';
            $parent = 0;
            $sql = "SELECT count(*) from term inner join term_taxonomy on term.term_id = term_taxonomy.term_id where parent =:parent and taxnomy =:tax and active =:active"; 
            $result = $this->db->conn_id->prepare($sql); 
            $result->execute([':parent'=>$parent,':tax'=>$tax,':active'=>$active]); 
            return $number_of_rows = $result->fetchColumn(); 
        }
    }