<?php

class Search extends CI_Controller {

    public function fetch($offset = 0){
        if($this->input->post('term_id'))
        {
            $query = $this->input->post('term_id');
            $this->session->set_userdata('search_query',$query);
        }
        
        $this->load->library('pagination');
        $config['base_url'] =site_url('search/fetch');
        $config['total_rows'] = $this->search_model->countSearchNews($this->session->userdata('search_query'));
        $config['per_page'] = 15;
        $config['full_tag_open']="<div class='pagination'>";
        $config['full_tag_close']="</div>";
        $config['cur_tag_open'] ="<a class='active'>";
        $config['cur_tag_close'] ="</a>";
        $this->pagination->initialize($config); 
        if(isLoggedIn()){
            if($this->session->userdata['admin_type'] === 'main_admin' || $this->session->userdata['admin_type'] === 'catroot' || $this->session->userdata['admin_type'] === 'subroot' || $this->session->userdata['admin_type'] === 'custom'){
                if($this->session->userdata('admin_type') == 'custom'){
                    $this->custome_edit_news_search();
                    
                }else{
                    $data['news'] = $this->search_model->fetch_data($config['per_page'],$offset);
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

    public function custome_edit_news_search($offset=0){
        $config['base_url'] =site_url('search/fetch');
        $config['total_rows'] = $this->search_model->countSearchNews($this->session->userdata('search_query'));
        $config['per_page'] = 15;
        $config['full_tag_open']="<div class='pagination'>";
        $config['full_tag_close']="</div>";
        $config['cur_tag_open'] ="<a class='active'>";
        $config['cur_tag_close'] ="</a>";
        $this->pagination->initialize($config); 

        $data['news'] = $this->search_model->fetch_custome_data($config['per_page'],$offset);
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
