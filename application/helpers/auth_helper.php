<?php

    function clean_input($inputField,$type=NULL){

      if(is_null($type)){
          if(is_string($inputField) || is_numeric($inputField)){
            $inputField = addslashes($inputField);
            $inputField = html_escape($inputField); 
            return $inputField;
      
          }elseif(is_array($inputField)){
            $input_arr = [];
            foreach($inputField as $input){
                $input = addslashes($input);
                $input = html_escape($input);
                array_push($input_arr,$input);
            }
            return $input_arr ;
          }elseif(empty($inputField)){
              return NULL;
          }else{
            die('404');
          }
      }else{ 

        switch($type)
        {
          case (is_numeric($inputField) and $type == 'number'):
            $inputField = addslashes($inputField);
            $inputField = html_escape($inputField); 
            return $inputField;

          break;

          case (is_string($inputField) and $type == 'string'):
            $inputField = addslashes($inputField);
            $inputField = html_escape($inputField); 
            return $inputField;

          break;


          default:
              die('error 606');
          break;

        }

      }
      
  }


  function decode_clean_input($inputData){
      if(is_string($inputData)){
        $inputData = htmlspecialchars_decode($inputData); 
        $inputData = stripslashes($inputData);
        return $inputData;

      }elseif(is_array($inputData)){
        $input_arr = [];
        foreach($inputData as $input){
            $input = htmlspecialchars_decode($input);
            $input = stripslashes($input);
            array_push($input_arr,$input);
        }

      return $input_arr ;
      }
  }


    function isLoggedIn(){
        $ci = get_instance();
        $ci->load->library('session');
        if($ci->session->userdata('admin_id')  && $ci->session->userdata('admin_type') ){
          return true;
        } else {
          return false;
        }
      }
      
