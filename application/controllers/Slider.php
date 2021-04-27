<?php

class Slider extends CI_Controller {
 
    public function addSlider(){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin'){

                $this->load->view('templates/header.php');
                $this->load->view('templates/nav.php');
                $this->load->view('templates/side.php');
                $this->load->view('slider/addSlider');
                $this->load->view('templates/footer.php'); 
            }else{
                $this->load->view('access_denied/accessDenide.php');
            }
            
        }else{
            $this->load->view('Admin/login.php');
        }
    }

    public function editSlider(){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin'){
                $data['slider'] = $this->slider_model->fetch_slider();
                if(!$data['slider']){
                    $data['slider'] = [];
                }
                $this->load->view('templates/header.php');
                $this->load->view('templates/nav.php');
                $this->load->view('templates/side.php');
                $this->load->view('slider/editSlider',$data);
                $this->load->view('templates/footer.php');
            }else{
                $this->load->view('access_denied/accessDenide.php');
            }
            
        }else{
            $this->load->view('Admin/login.php');
        }
    }

    public function createSlider(){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin'){

                $this->form_validation->set_rules('title','Title','required');
                if($_FILES['userfile']['name'] == ''){
                  $this->form_validation->set_rules('userfile','Media','required');
                }
                if($this->form_validation->run() === FALSE){
                    $this->load->view('templates/header.php');
                    $this->load->view('templates/nav.php');
                    $this->load->view('templates/side.php');
                    $this->load->view('slider/addSlider');
                    $this->load->view('templates/footer.php');
                }else{
                    $path = $_FILES['userfile']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $file_new_name=md5(date("Y/m/d").date("h:i:sa").$_FILES['userfile']['name']).'.'.$ext;

                    $config['upload_path'] = './assets/img/news/';
                    $config['allowed_types'] = 'gif|jpg|png|mp4';
                    $config['file_name'] = $file_new_name;
                    $config['max_size'] = '2048';
                    $config['max_width'] = '2000';
                    $config['max_height'] = '2000';

                    $this->load->library('upload',$config);
                    if(!$this->upload->do_upload()){
                        $errors = array('error' => $this->upload->display_errors());
                        $post_image = 'noimage.png';
                    }else{
                        $data = array('upload_data' => $this->upload->data());
                        $post_image = $file_new_name;
                    }

                    $data['title'] = clean_input($this->input->post('title'));
                    $data['caption'] = clean_input($this->input->post('caption'));
                    $addslider  = $this->slider_model->create_slider($data,$post_image);
                    if(!$addslider) {
                        setFlashData('alert-danger','slider already exist','slider/editSlider');
                    }
                    else{
                        setFlashData('alert-success','Slider Added Successfuly','slider/editSlider');
                    }
                }
            }else{
                $this->load->view('access_denied/accessDenide.php');
            }
            
        }else{
            $this->load->view('Admin/login.php');
        }
    }



    public function editSlidInfo($id){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin'){

                $data['info'] = $this->slider_model->fetch_slider_info(clean_input($id));
                if($data['info']){
                    $this->load->view('templates/header.php');
                    $this->load->view('templates/nav.php');
                    $this->load->view('templates/side.php');
                    $this->load->view('slider/editSliderInfo',$data);
                    $this->load->view('templates/footer.php');
                }else{
                    die('no data by this id');
                }
                
            }else{
                $this->load->view('access_denied/accessDenide');
              }
              
        }else{
        $this->load->view('admin/login.php');
        }
    }

    public function updateSlider(){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin'){

                $this->form_validation->set_rules('title','Title','required');
                if($this->form_validation->run() === FALSE){
                    $this->load->view('templates/header.php');
                    $this->load->view('templates/nav.php');
                    $this->load->view('templates/side.php');
                    $this->load->view('slider/addSlider');
                    $this->load->view('templates/footer.php');
                }else{

                    if(empty($_FILES['userfile']['name'])){
                        $post_image = Null;
                    }else{
                        $path = $_FILES['userfile']['name'];
                        $ext = pathinfo($path, PATHINFO_EXTENSION);
                        $file_new_name=md5(date("Y/m/d").date("h:i:sa").$_FILES['userfile']['name']).'.'.$ext;

                        $config['upload_path'] = './assets/img/news/';
                        $config['allowed_types'] = 'gif|jpg|png|mp4';
                        $config['file_name'] = $file_new_name;
                        $config['max_size'] = '2048';
                        $config['max_width'] = '2000';
                        $config['max_height'] = '2000';

                        $this->load->library('upload',$config);
                        if(!$this->upload->do_upload()){
                            $errors = array('error' => $this->upload->display_errors());
                            setFlashData('alert-danger','File Extention not accepted','slider/editSlider');
                        }else{
                            $data = array('upload_data' => $this->upload->data());
                            $post_image = $file_new_name;
                        }
                    }

                    $data['title'] = clean_input($this->input->post('title'));
                    $data['caption'] = clean_input($this->input->post('caption'));
                    $updateslider  = $this->slider_model->update_slider($data,$post_image,$this->input->post('id'));
                    if(!$updateslider) {
                        setFlashData('alert-danger','slider already exist','slider/editSlider');
                    }
                    else{
                        setFlashData('alert-success','Slider updated Successfuly','slider/editSlider');
                    }
                }
            }else{
                $this->load->view('access_denied/accessDenide.php');
            }
            
        }else{
            $this->load->view('Admin/login.php');
        }
    }



    public function changeStatusToDraft($id){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin'){
                $this->news_model->changeStatus(clean_input($id),'draft');
                setFlashData('alert-success','slider updated Successfuly','slider/editSlider');
            }else{
                $this->load->view('access_denied/accessDenide');
              }
              
        }else{
        $this->load->view('admin/login.php');
        }
    }

    public function changeStatusToPublish($id){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin'){
                $this->news_model->changeStatus(clean_input($id),'publish');
                setFlashData('alert-success','slider updated Successfuly','slider/editSlider');
            }else{
                $this->load->view('access_denied/accessDenide');
              }
              
        }else{
        $this->load->view('admin/login.php');
        }
    }

    public function deletebtn($id){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot' || $this->session->userdata['admin_type'] === 'subroot' || $this->session->userdata['admin_type'] === 'custom'){
                $this->news_model->deleteNews(clean_input($id));
                setFlashData('alert-danger','Slider Deleted Successfuly','slider/editSlider');
            }else{
                $this->load->view('access_denied/accessDenide.php');
            }
                    
        }else{
            $this->load->view('Admin/login.php');
        }
    }
}