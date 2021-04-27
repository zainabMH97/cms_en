<?php
    include 'Endpoints.php';
class Subcategory extends CI_Controller {

    public function addSub(){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot' || $this->session->userdata['admin_type'] === 'subroot'){
                $data['categories'] = $this->category_model->fetch_term(0,'cat');
                $categories = $this->subcategory_model->fetch_only_subcat();
                if(!empty($categories)){
                    $data['searchData'] = $this->manageSearchData($categories);
                }else{
                    $data['searchData'] = NULL;
                }
                $this->load->view('templates/header.php');
                $this->load->view('templates/nav.php');
                $this->load->view('templates/side.php');
                $this->load->view('subcategory/addSub',$data);
                $this->load->view('templates/footer.php');
            }else{
                $this->load->view('access_denied/accessDenide.php');
            }
            
        }else{
            $this->load->view('Admin/login.php');
        }
    }
    public function editSub(){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot' || $this->session->userdata['admin_type'] === 'subroot'){
                $data['subcategories'] = $this->subcategory_model->fetch_only_subcat();
                $this->load->view('templates/header.php');
                $this->load->view('templates/nav.php');
                $this->load->view('templates/side.php');
                $this->load->view('subcategory/editSub',$data);
                $this->load->view('templates/footer.php');
            }else{
                $this->load->view('access_denied/accessDenide.php');
            }
            
        }else{
            $this->load->view('Admin/login.php');
        }
    }


    public function createNewSub(){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot' || $this->session->userdata['admin_type'] === 'subroot'){
                $data['title'] = 'Create sub Category';
                    $admin_id =  $this->session->userdata['admin_id'];
                    $this->form_validation->set_rules('title','Title','required');
                    $this->form_validation->set_rules('category_id','Category','required');
                        if($this->form_validation->run() === FALSE){
                        $data['categories'] = $this->category_model->fetch_term(0,'cat');
                        $categories = $this->subcategory_model->fetch_only_subcat();
                        if(!empty($categories)){
                            $data['searchData'] = $this->manageSearchData($categories);
                        }else{
                            $data['searchData'] = NULL;
                        }
                        $this->load->view('templates/header.php');
                        $this->load->view('templates/nav.php');
                        $this->load->view('templates/side.php');
                        $this->load->view('subcategory/addSub',$data);
                        $this->load->view('templates/footer.php');
                    }else{
                        $checkCategory = $this->category_model->checkCategory();

                        if ($checkCategory->num_rows() > 0) {
                            setFlashData('alert-danger','Sub Category already exist','subcategory/addSub');
                        }else{
                            $this->subcategory_model->create_sub_term($admin_id);
                            //set messages
        
                            setFlashData('alert-success','Sub Category Added Successfuly','subcategory/editSub');
                        }
                        
                    }
            
            }else{
                $this->load->view('access_denied/accessDenide.php');
            }
        
        }else{
            $this->load->view('Admin/login.php');
        }
    }

    public function editsubCategoryInfo($subcat_id){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot' || $this->session->userdata['admin_type'] === 'subroot'){
                $data['title'] = 'edit sub Category';
                $data['categories'] = $this->category_model->fetch_term(0,'cat');
                $data['info'] = $this->category_model->fetch_term_By_id(clean_input($subcat_id));
                if($data['info']){
                    $data['parent'] = $this->category_model->fetch_term_By_id($data['info'][0]['parent']);
                    if($data['parent']){
                        $this->load->view('templates/header.php');
                        $this->load->view('templates/nav.php');
                        $this->load->view('templates/side.php');
                        $this->load->view('subcategory/editsubCatInfo',$data);
                        $this->load->view('templates/footer.php');
                    }else{
                        die();
                    }
                    
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


    public function updateSubCatInfo(){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot' || $this->session->userdata['admin_type'] === 'subroot'){
                    $this->form_validation->set_rules('title','Title','required');
                    $this->form_validation->set_rules('category_id','Category','required');
                    if($this->form_validation->run() === FALSE){
                        $subcat_id = $this->input->post('id');
                        $data['title'] = 'edit sub Category';
                        $data['categories'] = $this->category_model->fetch_term(0,'cat');
                        $data['info'] = $this->category_model->fetch_term_By_id($subcat_id);
                        $data['parent'] = $this->category_model->fetch_term_By_id($data['info'][0]['parent']);
                        $this->load->view('templates/header.php');
                        $this->load->view('templates/nav.php');
                        $this->load->view('templates/side.php');
                        $this->load->view('subcategory/editsubCatInfo',$data);
                        $this->load->view('templates/footer.php');
                    }else{
                        $subcat_id = $this->input->post('id');
                        $this->subcategory_model->update_SubCat_Info($subcat_id);
                        $this->subcategory_model->update_subcat_parent($subcat_id);
                        //set message 

                        setFlashData('alert-success','sub Category updated Successfuly','subcategory/editSub');
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
                setFlashData('alert-danger','sub Category deleted Successfuly','subcategory/editSub');
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