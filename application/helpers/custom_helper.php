<?php
    function setFlashData($class,$message,$url){
        //get access to CodeIgniter super object so we can load helper and libraryes and so on
        $ci = get_instance();
        $ci->load->library('session');
        $ci->session->set_flashdata('class',$class);
        $ci->session->set_flashdata('message',$message);
        redirect($url);
    }


    function loop_array_of_arrays($array){
        $result = [];
        foreach($array as $arr){
            foreach($arr as $r){
                array_push($result,$r);
            }
        }
       return $result ;
    }

    
    ?>