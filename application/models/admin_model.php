<?php 
    class Admin_model extends CI_Model {
        public function  __construct(){
            $this->load->database();
        }


        public function checkAdminData($username){
            $active = 1;
            $sql = 'SELECT admin_id,admin_password,admin_user_name,admin_email,admin_fullname,admin_date_registerd,admin_type,active FROM admin WHERE admin_user_name = :username and active = :active';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':username' => $username ,':active' => $active]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return($row);
        }

        public function checkAdminByEmail($email){

            $active = 1;
            $sql = 'SELECT admin_email,active FROM admin WHERE admin_email = :email and active = :active';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':email' => $email ,':active' => $active]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return($row);
        }


        // public function DeleteExistingTokens($email){

        //     $active = 1;
        //     $sql = 'DELETE FROM password_reset WHERE email = :email';
        //     $stmt = $this->db->conn_id->prepare($sql);
        //     $stmt->execute([':email' => $email]);
        // }

        // public function insertNewTokens($email,$selector,$token,$expires){

        //     $sql ='INSERT INTO password_reset(email, selector, token,expires) VALUES(:email, :selector, :token,:expires)';
        //     $stmt = $this->db->conn_id->prepare($sql);
        //     $stmt->execute([':email'=> $email, ':selector'=> $selector, ':token'=> $token,':expires'=> $expires]);

        // }


        // public function getTokens($selector,$time){

        //     $sql = 'SELECT email,token,expires FROM password_reset WHERE  token= :selector and expires >= :time';
        //     $stmt = $this->db->conn_id->prepare($sql);
        //     $stmt->execute([':selector' => $selector , ':time' => $time]);
        //     $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //     if($stmt->rowCount() == 1){
        //         return($row);   
        //     } else {
        //         return false;
        //     } 

        // }

        public function UpdatePassword($email,$password){

            $sql ='UPDATE admin SET admin_password= :admin_password WHERE admin_email= :admin_email';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':admin_password'=> $password, ':admin_email'=> $email]);
        }

        public function createAdmin_custom($username,$full_name,$email,$password,$adminType,$category,$tag){
            $sql = "INSERT INTO admin(admin_password,admin_user_name,admin_email,admin_fullname,admin_type,admin_date_registerd) VALUES (:admin_password,:admin_user_name,:admin_email,:admin_fullname,:admin_type,:admin_date)";
                
               $stmt = $this->db->conn_id->prepare($sql);
                $stmt->execute([':admin_password'=> $password,':admin_user_name'=>$username, ':admin_email'=> $email,':admin_fullname'=> $full_name,':admin_type' => $adminType,'admin_date'=>date("Y-m-d H:i:s",time())]);
                $lsid = $this->db->conn_id->lastInsertId();
                if(!empty($tag)){
                    $terms = array_merge($category,$tag);

                    $terms_term = [];
                    foreach($terms as $term){
                    $terms_term_ar = array (
                        'admin_id' => $lsid,
                        'term_id' => $term
                    );
                    array_push($terms_term,$terms_term_ar);
                    }
                   
                    $this->db->insert_batch('custome', $terms_term); 

                }else{
                    $category_cat = [];
                    foreach($category as $c){
                      $category_cat_ar = array (
                        'admin_id' => $lsid,
                        'term_id' => $c
                      );
                      array_push($category_cat,$category_cat_ar);
                    }
                    $this->db->insert_batch('custome', $category_cat); 
                }
               
        }

        public function createAdmin_default($username,$full_name,$email,$password,$adminType){
            $sql = "INSERT INTO admin(admin_password,admin_user_name,admin_email,admin_fullname,admin_type,admin_date_registerd) VALUES (:admin_password,:admin_user_name,:admin_email,:admin_fullname,:admin_type,:admin_date)";
                
                $stmt = $this->db->conn_id->prepare($sql);
                $stmt->execute([':admin_password'=> $password,':admin_user_name'=>$username, ':admin_email'=> $email,':admin_fullname'=> $full_name,':admin_type' => $adminType,'admin_date'=>date("Y-m-d H:i:s",time())]);
        }

        public function checkadmin_email_username($user,$email){
            $active = 1;
            $sql = 'SELECT count(*) FROM admin WHERE (admin_email = :email OR admin_user_name = :admin_user_name) and active = :active';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':email' => $email ,':active' => $active,':admin_user_name' => $user]);
            $row = $stmt->fetchColumn();
            if($row >= 1) {
                return True ; 
            }else{
                return false ;
            }
        }

        public function fetch_all_admin(){
            $active = 1;
            $sql = 'SELECT admin_id,admin_user_name,admin_email,admin_fullname FROM admin WHERE active = :active';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':active' => $active]);
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

        public function delete_admin($id){
            $active = 0;
            $sql = 'UPDATE admin SET active= :active WHERE admin_id= :admin_id LIMIT 1';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':admin_id' => $id, ':active' => $active]);
        }

        public function checkSecret($admin_secret){
            $active = 1;
            $sql = 'SELECT count(*) FROM admin WHERE  admin_secret = :admin_secret and active = :active';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':admin_secret'=> $admin_secret,':active' => $active]);
            $num_rows = $stmt->fetchColumn();
            return $num_rows ;
        }

        public function insertToken($token,$admin_secret){
            $active = 1;

            $sql = 'UPDATE admin SET admin_token= :token WHERE admin_secret= :admin_secret and active = :active';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':admin_secret' => $admin_secret, ':token' => $token,':active' => $active]);
            return true;
            
        }

        public function get_admin_tokenID($token,$username){
            $active = 1;
            $sql = 'SELECT admin_id,admin_user_name,admin_email,admin_fullname,admin_type FROM admin WHERE 
             admin_token = :admin_token and active = :active
             and admin_user_name = :admin_username';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':admin_token'=> $token,':active' => $active,':admin_username'=>$username]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }

        public function update_admin_password($password,$id){
            $sql ='UPDATE admin SET admin_password= :admin_password WHERE admin_id= :admin_id';
            $stmt = $this->db->conn_id->prepare($sql);
            $stmt->execute([':admin_password'=> $password, ':admin_id'=> $id]);
            return true;
        }

    }