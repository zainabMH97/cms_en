<?php

class UncategorizeNews extends CI_Controller {

    public function uncategorizeNewsIndex($offset=0){
        $this->load->library('pagination');
        $config['base_url'] =site_url('uncategorizeNews/uncategorizeNewsIndex');
        $config['total_rows'] = $this->news_model->countNewsUncategorized();
        $config['per_page'] = 10;
        $config['full_tag_open']="<div class='pagination'>";
        $config['full_tag_close']="</div>";
        $config['cur_tag_open'] ="<a class='active'>";
        $config['cur_tag_close'] ="</a>";
        $this->pagination->initialize($config);
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot'){
            
                $data['news'] = $this->news_model->fetch_uncategorieznews($config['per_page'],$offset);
                $this->load->view('templates/header.php');
                $this->load->view('templates/nav.php');
                $this->load->view('templates/side.php');
                $this->load->view('news/uncategorieznews',$data);
                $this->load->view('templates/footer.php');
                
            }else{
                $this->load->view('access_denied/accessDenide.php');
            }
            
        }else{ 
            $this->load->view('Admin/login.php');
        }
    }


    public function Uncategorize_changeStatusToDraft($id){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin'){
                $this->news_model->changeStatus(clean_input($id),'draft');
                setFlashData('alert-success','News updated Successfuly','UncategorizeNews/UncategorizeNewsIndex');
            }else{
                $this->load->view('access_denied/accessDenide');
              }
              
        }else{
        $this->load->view('admin/login.php');
        }
    }

    public function Uncategorize_changeStatusToPublish($id){
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin'){
                $this->news_model->changeStatus(clean_input($id),'publish');
                setFlashData('alert-success','News updated Successfuly','UncategorizeNews/UncategorizeNewsIndex');
            }else{
                $this->load->view('access_denied/accessDenide');
              }
              
        }else{
        $this->load->view('admin/login.php');
        }
    }

    public function uncategorizeNewsCustome($offset=0){
        $this->load->library('pagination');
        $config['base_url'] =site_url('uncategorizeNews/uncategorizeNewsIndex');
        $config['total_rows'] = $this->news_model->countNewsUncategorizedcustome();
        $config['per_page'] = 10;
        $config['full_tag_open']="<div class='pagination'>";
        $config['full_tag_close']="</div>";
        $config['cur_tag_open'] ="<a class='active'>";
        $config['cur_tag_close'] ="</a>";
        $this->pagination->initialize($config);

        if(isLoggedIn()){
            
            $data['news'] = $this->news_model->fetch_uncategorieznews_custome($config['per_page'],$offset);
            $this->load->view('templates/header.php');
            $this->load->view('templates/nav.php');
            $this->load->view('templates/side.php');
            $this->load->view('news/uncategorieznews',$data);
            $this->load->view('templates/footer.php');
            
        }else{ 
            $this->load->view('Admin/login.php');
        }

    }
}