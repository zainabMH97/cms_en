<?php
include 'Endpoints.php';

class Category extends Endpoints {

    public function addCat(){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot'){
                $categories = $this->category_model->fetch_term(0,'cat');
                if(!empty($categories)){
                    $data['searchData'] = $this->manageSearchData($categories);
                }else{
                    $data['searchData'] = NULL;
                }
                $this->load->view('templates/header.php');
                $this->load->view('templates/nav.php');
                $this->load->view('templates/side.php');
                $this->load->view('category/addCat',$data);
                $this->load->view('templates/footer.php');
            }else{
                $this->load->view('access_denied/accessDenide.php');
            }
            
        }else{
            $this->load->view('Admin/login.php');
        }
    }



    public function editCat(){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot'){
                $data['categories'] = $this->category_model->fetch_term(0,'cat');
                $this->load->view('templates/header.php');
                $this->load->view('templates/nav.php');
                $this->load->view('templates/side.php');
                $this->load->view('category/editCat',$data);
                $this->load->view('templates/footer.php');
            }else{
                $this->load->view('access_denied/accessDenide.php');
            }
            
        }else{
            $this->load->view('Admin/login.php');
        }
    }



    public function createNewCat(){

        if(isLoggedIn()){ 
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot'){
                $data['title'] = 'Create Category';
                $admin_id =  $this->session->userdata['admin_id'];
                $this->form_validation->set_rules('title','Title','required');
      
                if($this->form_validation->run() === FALSE){
                    $this->load->view('templates/header.php');
                    $this->load->view('templates/nav.php');
                    $this->load->view('templates/side.php');
                    $this->load->view('category/addCat');
                    $this->load->view('templates/footer.php');
                }else{
                    $checkCategory = $this->category_model->checkCategory(); 

                    if ($checkCategory->num_rows() > 0) {
                        setFlashData('category_err','Category already exist','category/addCat');
                    }else{
                        $this->category_model->create_term($admin_id,0,'cat');
                        //set messages
    
                        setFlashData('alert-success','Category Added Successfuly','category/editCat');
                    }
                    
                }
            }else{
                $this->load->view('access_denied/accessDenide.php');
            }
     
        }else{
            $this->load->view('Admin/login.php');
        }
    }

    public function editCategoryInfo($cat_id){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot'){
                
                $data['info'] = $this->category_model->fetch_term_By_id(clean_input($cat_id));
                if($data['info']){
                    $this->load->view('templates/header.php');
                    $this->load->view('templates/nav.php');
                    $this->load->view('templates/side.php');
                    $this->load->view('category/editCatInfo',$data);
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

    public function updateCatInfo(){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot'){
                
                $this->category_model->update_cat_info($this->input->post('id'));
                    //set message 

                setFlashData('alert-success','Category updated Successfuly','category/editCat');
            }else{
                $this->load->view('access_denied/accessDenide.php');
            }
     
        }else{
            $this->load->view('Admin/login.php');
        }

    }

    public function deletebtn($id){
        $this->category_model->deleteCat(clean_input($id));
        setFlashData('alert-danger','Category deleted Successfuly','category/editCat');
    }


    public function manageSearchData($categories){
        $search = [];
        foreach($categories as $category){
            array_push($search,$category['term_title']);
        }
        return $search;
    }
}