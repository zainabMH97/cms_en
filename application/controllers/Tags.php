<?php

class Tags extends CI_Controller {

    public function addTag(){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot' || $this->session->userdata['admin_type'] === 'subroot'){
                $tags = $this->category_model->fetch_term(0,'tag');
                if(!empty($tags)){
                    $data['searchData'] = $this->manageSearchData($tags);
                }else{
                    $data['searchData'] = NULL;
                }
                $this->load->view('templates/header.php');
                $this->load->view('templates/nav.php');
                $this->load->view('templates/side.php');
                $this->load->view('tags/addTag',$data);
                $this->load->view('templates/footer.php');
            }else{
                $this->load->view('access_denied/accessDenide.php');
            }
            
        }else{
            $this->load->view('Admin/login.php');
        }
    }
    public function editTag(){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot' || $this->session->userdata['admin_type'] === 'subroot'){
                $data['tags'] = $this->category_model->fetch_term(0,'tag');
                $this->load->view('templates/header.php');
                $this->load->view('templates/nav.php');
                $this->load->view('templates/side.php');
                $this->load->view('tags/editTag',$data);
                $this->load->view('templates/footer.php');
            }else{
                $this->load->view('access_denied/accessDenide.php');
            }
            
        }else{
            $this->load->view('Admin/login.php');
        }
    }

    public function createNewTag(){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot' ||                $this->session->userdata['admin_type'] === 'subroot'){
                    $data['title'] = 'Create Tag';
                    $admin_id =  $this->session->userdata['admin_id'];
                    $this->form_validation->set_rules('title','Title','required');

                    if($this->form_validation->run() === FALSE){
                        $this->load->view('templates/header.php');
                        $this->load->view('templates/nav.php');
                        $this->load->view('templates/side.php');
                        $this->load->view('tags/addTag');
                        $this->load->view('templates/footer.php');
                    }else{
                        $checkCategory = $this->category_model->checkCategory();

                        if ($checkCategory->num_rows() > 0) {
                            setFlashData('alert-danger','Tag already exist','category/addCat');
                        }else{
                            $this->category_model->create_term($admin_id,0,'tag');
                            //set messages
        
                            setFlashData('alert-success','Tag Added Successfuly','tags/editTag');
                        }
                    }
                }else{
                    $this->load->view('access_denied/accessDenide.php');
                }
                
        }else{
            $this->load->view('Admin/login.php');
        }
    }

    public function editTagInfo($tag_id){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot' ||                $this->session->userdata['admin_type'] === 'subroot'){
                $data['info'] = $this->tag_model->fetch_term_By_id(clean_input($tag_id));
                if($data['info']){
                    $this->load->view('templates/header.php');
                    $this->load->view('templates/nav.php');
                    $this->load->view('templates/side.php');
                    $this->load->view('tags/editTagInfo',$data);
                    $this->load->view('templates/footer.php');
                }else{
                    die();
                }
                
            }else{
                $this->load->view('access_denied/accessDenide.php');
            }
            
        }else{
            $this->load->view('Admin/login.php');
        }
    }

    public function updateTagInfo(){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot' || $this->session->userdata['admin_type'] === 'subroot'){
                    $this->form_validation->set_rules('title','Title','required');
                   
                    if($this->form_validation->run() === FALSE){
                        $tag_id = clean_input($this->input->post('id'));
                        $data['info'] = $this->category_model->fetch_term_By_id($tag_id);
                        $this->load->view('templates/header.php');
                        $this->load->view('templates/nav.php');
                        $this->load->view('templates/side.php');
                        $this->load->view('tags/editTagInfo',$data);
                        $this->load->view('templates/footer.php');
                    }else{
                        $this->tag_model->update_tag_info($this->input->post('id'));
                        //set message 

                        setFlashData('alert-success','Tag updated Successfuly','tags/editTag');
                    }
                    
            }else{
                $this->load->view('access_denied/accessDenide.php');
            }
            
        }else{
            $this->load->view('Admin/login.php');
        }
    }

    public function deletebtn($id){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot' || $this->session->userdata['admin_type'] === 'subroot'){
                $this->category_model->deleteCat(clean_input($id));
                setFlashData('alert-danger','Tag deleted Successfuly','tags/editTag');
            }else{
                $this->load->view('access_denied/accessDenide.php');
            }
            
        }else{
            $this->load->view('Admin/login.php');
        }
    }

    public function manageSearchData($categories){
        $search = [];
        foreach($categories as $category){
            array_push($search,$category['term_title']);
        }
        return $search;
    }
}