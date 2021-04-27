<?php
class Posts extends CI_Controller {
    public function index($url){
        $data['info'] = $this->news_model->fetch_news_By_slug(clean_input(urlencode($url),'string'));
        $data['term'] = $this->news_model->fetch_newsTerm_By_slug(clean_input(urlencode($url),'string'));
        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('templates/side.php');
        $this->load->view('posts/index',$data);
        $this->load->view('templates/footer.php');
    }

} 