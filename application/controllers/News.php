<?php

class News extends CI_Controller {

    public function addNews(){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot' || $this->session->userdata['admin_type'] === 'subroot' || $this->session->userdata['admin_type'] === 'custom'){
                if($this->session->userdata('admin_type') == 'custom'){
                    $data['categories'] = $this->category_model->fetch_only_custome_cat($this->session->userdata('admin_id'));
                    $data['tags'] = $this->tag_model->fetch_only_custom_tag($this->session->userdata('admin_id'));
                     $news = $this->news_model->fetch_news();
                    if(!empty($news)){
                        $data['searchData'] = $this->manageSearchData($news);
                    }else{
                        $data['searchData'] = NULL;
                    }
                    $this->load->view('templates/header.php');
                    $this->load->view('templates/nav.php');
                    $this->load->view('templates/side.php');
                    $this->load->view('news/addNews',$data);
                    $this->load->view('templates/footer.php');

                }else{
                    $data['categories'] = $this->category_model->fetch_term(0,'cat');
                    $data['subcategories'] = $this->subcategory_model->fetch_only_subcat();
                    $data['tags'] = $this->category_model->fetch_term(0,'tag');
                    $news = $this->news_model->fetch_news();
                    if(!empty($news)){
                        $data['searchData'] = $this->manageSearchData($news);
                    }else{
                        $data['searchData'] = NULL;
                    }
                    $this->load->view('templates/header.php');
                    $this->load->view('templates/nav.php');
                    $this->load->view('templates/side.php');
                    $this->load->view('news/addNews',$data);
                    $this->load->view('templates/footer.php');
                    
                }
            }else{
                $this->load->view('access_denied/accessDenide.php');
            }
            
        }else{
            $this->load->view('admin/login.php');
        }
        
    }

    public function editNews($offset = 0){
        
        $this->load->library('pagination');
        $config['base_url'] =site_url('news/editNews');
        $config['total_rows'] = $this->news_model->countNews();
        $config['per_page'] = 15;
        $config['full_tag_open']="<div class='pagination'>";
        $config['full_tag_close']="</div>";
        $config['cur_tag_open'] ="<a class='active'>";
        $config['cur_tag_close'] ="</a>";
        $this->pagination->initialize($config); 
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot' || $this->session->userdata['admin_type'] === 'subroot' || $this->session->userdata['admin_type'] === 'custom'){
                if($this->session->userdata('admin_type') == 'custom'){
                    $this->custome_edit_news();
                    
                }else{
                    
                    $data['news'] = $this->news_model->fetch_news_edit($config['per_page'],$offset);
                    $data['news_subcategories'] = $this->news_model->subcategoryEditNews('cat',0,$config['per_page'],$offset);
                    $data['news_tag'] = $this->news_model->termsEditNews('tag',0,$config['per_page'],$offset);
                    $category = $this->category_model->fetch_term(0,'cat');
                    if(!empty($category)){
                        $data['categories'] = $category;
                    }
                    $this->load->view('templates/header.php');
                    $this->load->view('templates/nav.php');
                    $this->load->view('templates/side.php');
                    $this->load->view('news/editNews',$data);
                    $this->load->view('templates/footer.php');
                   
                }
            }else{
                $this->load->view('access_denied/accessDenide.php');
            }
            
        }else{ 
            $this->load->view('admin/login.php');
        }
    }
    
    public function check_title_news(){
        $title = $this->input->get('title');
        $checkPost = $this->news_model->checkPost($title);
        if ($checkPost->num_rows() > 0) {
             echo '0';
            }else{
              echo '1'; 
            }
    }

    public function createNewNews(){
        $path = $_FILES['userfile']['name'];
        if(empty($_FILES['userfile']['name'])){
            $post_image = Null;
        }else{
            //Declaring Variables
            $path = $_FILES['userfile']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $file_new_name=md5(date("Y/m/d").date("h:i:sa").$_FILES['userfile']['name']).'.'.$ext;
            
            /*
            How we can get mb from bytes
            (mb*1024)*1024
        
            In my case i'm 10 mb limit
            (10*1024)*1024
            */


        $config['upload_path'] = './assets/img/news/';
        $config['allowed_types'] = 'gif|jpg|png|mp4|pdf';
        $config['file_name'] = $file_new_name;
        $config['max_size'] = '6000';
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
    }

        $data['title'] = clean_input($this->input->post('title'));
        $data['categories[]'] = clean_input($this->input->post('categories'));
        $data['subcategories[]'] = clean_input($this->input->post('subcategories'));
        $data['tags[]'] = clean_input($this->input->post('tags'));
        $data['description'] = clean_input($this->input->post('description'));
        $data['time_need_to_read'] = $this->estimated_reading_time($data['description']);
        $data['admin_id'] = $this->session->userdata('admin_id');
        $data['status'] = clean_input($this->input->post('status'));
        $data['post_slug'] = $this->seoURL($data['title']);
        if(!$data['categories[]'] == Null and !$data['subcategories[]'] == NULL and !$data['tags[]'] == NULL){
            $terms  = array_merge($data['categories[]'], $data['tags[]'],$data['subcategories[]']);
        }elseif(!$data['categories[]'] == Null and !$data['subcategories[]'] == NULL){
            $terms = array_merge($data['categories[]'],$data['subcategories[]']);
        }
        elseif(!$data['categories[]'] == Null and !$data['tags[]'] == NULL){
            $terms = array_merge($data['categories[]'], $data['tags[]']);
        }elseif($data['subcategories[]'] == Null and $data['tags[]'] == NULL){
            $terms  = $data['categories[]'];
        }elseif($data['categories[]'] == Null and $data['subcategories[]'] == NULL){
            $terms  = $data['tags[]'];
        }else{ 
            $terms = Null;
        }
        $addPost  = $this->news_model->create_news($data,$post_image,$terms);
      
        echo 'run';
    }

    

    


    private function seoURL($text)
    {
        $text = strtolower(htmlentities($text));
        $text = str_replace(" ", "-", $text);
        return $text;
    }

    

    public function editNewsInfo($news_id){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot' || $this->session->userdata['admin_type'] === 'subroot' || $this->session->userdata['admin_type'] === 'custom'){
                if($this->session->userdata('admin_type') == 'custom'){
                    $data['categories'] = $this->category_model->fetch_only_custome_cat($this->session->userdata('admin_id'));
                    $data['tags'] = $this->tag_model->fetch_only_custom_tag($this->session->userdata('admin_id'));
                    if(!$this->news_model->check_custom_postId(clean_input($news_id))){
                        $this->load->view('access_denied/accessDenide.php');    
                    }else{ 
                         $data['categories'] = $this->category_model->fetch_only_custome_cat($this->session->userdata('admin_id'));
                         $data['tags'] = $this->tag_model->fetch_only_custom_tag($this->session->userdata('admin_id'));
                         $data['selected_categories'] = $this->category_model->fetch_selected_category(clean_input($news_id));
                         $data['selected_tags'] = $this->category_model->fetch_selected_tag(loop_array_of_arrays($data['selected_categories']),'tag');
                        $data['info'] = $this->news_model->fetch_news_By_id(clean_input($news_id));
                        if($data['info']){
                            $this->load->view('templates/header.php');
                            $this->load->view('templates/nav.php');
                            $this->load->view('templates/side.php');
                            $this->load->view('news/editNewsInfo',$data);
                            $this->load->view('templates/footer.php');
                        }else{
                            die('no data by this id');
                        }
                        
                    }
                    
                }else{
                    $data['categories'] = $this->category_model->fetch_term(0,'cat');
                    $data['subcategories'] = $this->subcategory_model->fetch_only_subcat();
                    $data['tags'] = $this->category_model->fetch_term(0,'tag');
                    $data['info'] = $this->news_model->fetch_news_By_id(clean_input($news_id));
                    if($data['info']){
                    $data['selected_categories'] = $this->category_model->fetch_selected_category(clean_input($news_id));
                    $data['selected_subcategories'] = $this->category_model->fetch_selected_subcategory(loop_array_of_arrays($data['selected_categories']),'cat');
                    $data['selected_tags'] = $this->category_model->fetch_selected_tag(loop_array_of_arrays($data['selected_categories']),'tag');

                    $this->load->view('templates/header.php');
                        $this->load->view('templates/nav.php');
                        $this->load->view('templates/side.php');
                        $this->load->view('news/editNewsInfo',$data);
                        $this->load->view('templates/footer.php');
                    }else{
                        die('no data by this id ');
                    }
                    
                }
                
            }else{
                $this->load->view('access_denied/accessDenide.php');
            }
                    
        }else{
            $this->load->view('Admin/login.php');
        }
    }

    public function updateNews(){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot' || $this->session->userdata['admin_type'] === 'subroot' || $this->session->userdata['admin_type'] === 'custom'){
                //upload images/////////////////////////////////////////////////////////
                    if(empty($_FILES['userfile']['name'])){
                        $post_image = Null;
                    }else{
                            // Declaring Variables
                            $path = $_FILES['userfile']['name'];
                            $ext = pathinfo($path, PATHINFO_EXTENSION);
                            $file_new_name=md5(date("Y/m/d").date("h:i:sa").$_FILES['userfile']['name']).'.'.$ext;
                        
                            /*
                            How we can get mb from bytes
                            (mb*1024)*1024
                        
                            In my case i'm 10 mb limit
                            (10*1024)*1024
                            */

                            $config['upload_path'] = './assets/img/news/';
                            $config['allowed_types'] = 'gif|jpg|png|mp4|pdf';
                            $config['file_name'] = $file_new_name;
                            $config['max_size'] = '6000';
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
                        }

                        //////////////////////////////end upload image /////////////////////////////////////

                        $data['title'] = clean_input($this->input->post('title'));
                        $data['categories[]'] = clean_input($this->input->post('categories[]'));
                        $data['subcategories[]'] = clean_input($this->input->post('subcategories[]'));
                        $data['tags[]'] = clean_input($this->input->post('tags[]'));
                        $data['status'] = clean_input($this->input->post('status'));
                        $data['description'] = clean_input($this->input->post('description'));
                        $data['time_need_to_read'] = $this->estimated_reading_time($data['description']);
                        $data['admin_id'] = $this->session->userdata('admin_id');
                        if(!$data['categories[]'] == Null and !$data['subcategories[]'] == NULL and !$data['tags[]'] == NULL){
                            $terms  = array_merge($data['categories[]'], $data['tags[]'],$data['subcategories[]']);
                        }elseif(!$data['categories[]'] == Null and !$data['subcategories[]'] == NULL){
                            $terms = array_merge($data['categories[]'],$data['subcategories[]']);
                        }
                        elseif(!$data['categories[]'] == Null and !$data['tags[]'] == NULL){
                            $terms = array_merge($data['categories[]'], $data['tags[]']);
                        }elseif($data['subcategories[]'] == Null and $data['tags[]'] == NULL){
                            $terms  = $data['categories[]'];
                        }elseif($data['categories[]'] == Null and $data['subcategories[]'] == NULL){
                            $terms  = $data['tags[]'];
                        }else{
                            $terms = Null;
                        }
                        $this->news_model->update_news_info($this->input->post('id'),$post_image,$terms,$data);
                    
                        setFlashData('alert-success','News updated Successfuly','news/editNews');
                        //set message 
                        
                        
                    
                
            }else{
                $this->load->view('access_denied/accessDenide.php');
            }
                    
        }else{
            $this->load->view('admin/login.php');
        }

    }


    public function deletebtn($news_id){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot' || $this->session->userdata['admin_type'] === 'subroot' || $this->session->userdata['admin_type'] === 'custom'){
                $this->news_model->deleteNews(clean_input($news_id));
                setFlashData('alert-danger','one news deleted Successfuly','news/editNews');
            }else{
                $this->load->view('access_denied/accessDenide.php');
            }
                    
        }else{
            $this->load->view('Admin/login.php');
        }
    }

    public function estimated_reading_time($content){
        $wpm = 250;
        $word_count = str_word_count( $content );
        $time = ceil( $word_count / $wpm );
        return $time;
    }

    public function changeStatusToDraft(){ 
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin'){
                $id = clean_input($_GET['id']);
                $slug = clean_input($_GET['slug']);
                $this->news_model->changeStatus($id,'draft');
                setFlashData('alert-success','News updated Successfuly','posts/index/'.$slug.'');
            }else{
                $this->load->view('access_denied/accessDenide');
              }
              
        }else{
        $this->load->view('admin/login.php');
        }
    }

    public function changeStatusToPublish(){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin'){
                $id = clean_input($_GET['id']);
                $slug = clean_input($_GET['slug']);
                $this->news_model->changeStatus($id,'publish');
                setFlashData('alert-success','News updated Successfuly','posts/index/'.$slug.'');
            }else{
                $this->load->view('access_denied/accessDenide');
              }
              
        }else{
        $this->load->view('admin/login.php');
        }
    }

    public function manageSearchData($news){
        $search = [];
        foreach($news as $new){
            $new_escape = addslashes($new['post_title']);
            array_push($search,$new_escape);
        }
        return $search;
    }

    public function custome_edit_news($offset=0){
        $this->load->library('pagination');
        $config['base_url'] =site_url('news/custome_edit_news');
        $config['total_rows'] = $this->news_model->countNews_custome($this->session->userdata['admin_id']);
        $config['per_page'] = 15;
        $config['full_tag_open']="<div class='pagination'>";
        $config['full_tag_close']="</div>";
        $config['cur_tag_open'] ="<a class='active'>";
        $config['cur_tag_close'] ="</a>";
        $this->pagination->initialize($config); 
        // $data['news'] = $this->news_model->fetch_custom_news($this->session->userdata['admin_id']);
        $data['news'] = $this->news_model->fetch_news_edit_custome($config['per_page'],$offset,$this->session->userdata['admin_id']);
        $data['news_subcategories'] = $this->news_model->subcategoryEditNews('cat',0,$config['per_page'],$offset);
        $data['news_tag'] = $this->news_model->termsEditNews('tag',0,$config['per_page'],$offset);
        $category = $this->category_model->fetch_only_custome_cat($this->session->userdata['admin_id']);
        if(!empty($category)){
            $data['categories'] = $category;
        }
        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('templates/side.php');
        $this->load->view('news/editNews',$data);
        $this->load->view('templates/footer.php'); 
    }

    
    

}