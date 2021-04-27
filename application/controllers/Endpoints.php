<?php

class Endpoints extends CI_Controller {
    
    public function fetch_news_db($ajax){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot' || $this->session->userdata['admin_type'] === 'subroot' || $this->session->userdata['admin_type'] === 'custom'){
                    $data['news'] = $this->news_model->fetch_news();
                    if($ajax == 1){
                        $res = [];
                        foreach($data['news'] as $news){
                            array_push($res,$news['post_title']);
                        }
                        echo json_encode($data['news'],JSON_UNESCAPED_UNICODE);
                    }
                    return $data['news'];
            }else{
                $this->load->view('access_denied/accessDenide.php');
            }
            
        }else{
            $this->load->view('Admin/login.php');
        }        
    }

    public function AuthAdminData(){
        
        if(isset($_GET['key'])){
            $key = clean_input($_GET['key']);
            $num_row = $this->admin_model->checkSecret($key);
            if($num_row == 1){

                $random_num = bin2hex(random_bytes(4));
                //$random_num = mt_rand(1, 999999); 
                if($this->admin_model->insertToken($random_num,$key)){

                    $errNum = "S000";
                    $msg = "ok";
                    $key = "data";
                    $value = $random_num;
                    $myObj=new stdClass();
                    $myObj->status = true;
                    $myObj->errNum = $errNum;
                    $myObj->msg = $msg;
                    $myObj->$key = $value;
                    echo $myJSON=json_encode($myObj);
                }else{
                    $errNum = "500";
                    $msg = "there is no data";
                    $myObj=new stdClass();
                    $myObj->status = false;
                    $myObj->errNum = $errNum;
                    $myObj->msg = $msg;
                     echo $myJSON=json_encode($myObj);
                }

            }else{
                $errNum = "500";
                $msg = "there is no data";
                $myObj=new stdClass();
                $myObj->status = false;
                $myObj->errNum = $errNum;
                $myObj->msg = $msg;
                 echo $myJSON=json_encode($myObj);
            }
        }else{
            $errNum = "500";
            $msg = "Some thing was wrong please try later";
            $myObj=new stdClass();
            $myObj->status = false;
            $myObj->errNum = $errNum;
            $myObj->msg = $msg;
            echo $myJSON=json_encode($myObj);
        }
    }


}