<?php

class Admin extends CI_Controller {

	public function index()
	{
      if(isLoggedIn()){
         if(!$this->session->userdata['site_lang']){
          $this->session->set_userdata('site_lang', 'english');
         }
        $data['newscount'] = $this->news_model->countNews();
        $data['categorycount'] = $this->category_model->countCategory();
        $data['subcategorycount'] = $this->subcategory_model->countSubs();
        $data['tagscount'] = $this->tag_model->counttag();
        $data['lastnews'] = $this->news_model->lastnews();
        $data['lastcategory'] = $this->category_model->lastcategory();
        $data['published'] = $this->news_model->publishednews('publish');
        $data['draft'] = $this->news_model->publishednews('draft');
        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('templates/side.php');
        $this->load->view('Admin/index.php',$data);
        $this->load->view('templates/footer.php');
      }else{
        $this->load->view('Admin/login.php');
      }
    }
    
    public function login(){
        $this->load->view('Admin/login.php');
    }

    public function checkAdmin(){
        $this->form_validation->set_rules('username', 'User Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run() === FALSE){
            $this->load->view('admin/login');
        }else{
            $username = clean_input($this->input->post('username',true));
            $pass = clean_input($this->input->post('password',true));
            $password = password_hash($pass, PASSWORD_ARGON2I);
            $admin['data'] = $this->admin_model->checkAdminData($username,$password);

            
            
          if($admin['data']) {
            
              if(password_verify($pass,$admin['data']['admin_password'] )){


                //set temprary session 

                $this->session->set_userdata('temp_session', 'temprary_session');
                $this->session->set_userdata('temp_username',$username);
                if($this->session->userdata['temp_session'] === 'temprary_session'){
                  $this->load->view('admin/auth');
                }else{
                  redirect('admin/login');
                }
                //$this->load->view('admin/auth');

                

            }else {
              //set message
               setFlashData('alert-danger','please check your password and username','admin/login');
             }
         }else {
         //set message
         setFlashData('alert-danger','please check your password and username','admin/login');
       }

    }
  }


  // public function forgetPassword(){
  //   $this->load->view('Admin/forgetPassword.php');
  // }

  // public function authenticateEmail(){
  //     $email = clean_input($this->input->post('email',true));
     
  //     if( $this->admin_model->checkAdminByEmail($email)){
  //          // Create tokens
  //         $selector = mt_rand();
  //         $token = md5($selector);

  //         $url = sprintf('%sadmin/reset?%s', base_url(), http_build_query([
  //               'selector' => $token
  //         ]));

  //         // Token expiration
  //         $expires = time() * 60;

  //         // Delete any existing tokens for this user
  //         $this->admin_model->DeleteExistingTokens($email);
  //       // Insert reset token into database
  //           $this->admin_model->insertNewTokens($email,$selector,$token,$expires);
  //           $this->sendMail($url);
  //     }else{
  //       setFlashData('alert-danger','Email has not been found please check your email','admin/forgetPassword');
  //     }
         

  // }


  // public function sendMail($url){
  
  //     $this->load->library('email');
  //     $config = array(
  //         'charset'=>'utf-8',
  //         'wordwrap'=> TRUE,
  //         'mailtype' => 'html'
  //         );
  //     //$this->load->library('email', $config);
  //     $this->email->initialize($config);
  //     $this->email->set_newline("\r\n");
  //     $from_email = "zainabm97h@gmail.com";
  //     $to_email = clean_input($this->input->post('email'));
  //    // Message
  //     $message = '<p>We recieved a password reset request. The link to reset your password is below. ';
  //     $message .= 'If you did not make this request, you can ignore this email</p>';
  //     $message .= '<p>Here is your password reset link:</br>';
  //     $message .= sprintf('<a href="%s">%s</a></p>', $url, $url);
  //     $message .= '<p>Thanks!</p>';
     
  //     $this->email->from($from_email, 'Identification');
  //     $this->email->to($to_email);
  //     $this->email->subject('Your password reset link');
  //     $this->email->message($message);
  //     //Send mail
  //     if($this->email->send())
  //       setFlashData('alert-success','Email has been sent please check your email','admin/login');
  //     else{
  //       setFlashData('alert-danger','Email has not been sent please check your email','admin/forgetPassword');
  //     }
  
  // }

  // public function reset(){
  //   $this->load->view('admin/reset');
  // }

  // public function restPassword(){
  //   $pass = clean_input($this->input->post('password',true));
  //   $pass2 = clean_input($this->input->post('password2',true));
  //   $selector = clean_input($this->input->post('selector'));
  //   $this->form_validation->set_rules('password', 'Password', 'required');
  //   $this->form_validation->set_rules('password2', 'ConfirmPassword', 'matches[password]');
  //   if($this->form_validation->run() === FALSE){
  //       $this->load->view('admin/reset');
  //   }else{
  //     //get tokens from db /////
  //      $time =time();
  //      $results['data'] = $this->admin_model->getTokens($selector,$time);
  //      if(!empty($results['data'])){
  //       $time_diff = $results['data']['expires'] / $time;
  //       if (empty($results['data'] || $time_diff >= 60)){
  //         setFlashData('alert-danger','There has been an error occurred please check your email','admin/login');
  //        }else{
  //          $auth_token = $results['data']['token'];
  //         // Validate tokens
  //          if ($auth_token == $selector) {
  //            $this->admin_model->checkAdminByEmail($results['data']['email']);
  //            if($this->admin_model->checkAdminByEmail($results['data']['email'])){
  //             $password = password_hash($pass, PASSWORD_ARGON2I);
  //             $this->admin_model->UpdatePassword($results['data']['email'],$password);
  //             setFlashData('alert-success','your password has changed successfuly','admin/login');
  //            }
  //          }else{
  //           setFlashData('alert-danger','please check your email','admin/login');
  //            }
  //        }
  //      }else{
  //       setFlashData('alert-danger','There has been an error occurred please check your email','admin/login');
  //      }
    
  //   }

  // }

  public function logout(){
    $this->session->unset_userdata('admin_id');
    $this->session->unset_userdata('admin_user_name');
    $this->session->unset_userdata('admin_email');
    $this->session->unset_userdata('admin_fullname');
    $this->session->unset_userdata('admin_type');
    redirect('admin/login');
  }



  public function addNewAdmin(){
    if(isLoggedIn()){
      if($this->session->userdata['admin_type'] === 'main_admin'){
        //to fetch only categories set parent to 0 and taxonomy to cat
        $data['categories'] = $this->category_model->fetch_term(0,'cat');
        $data['tags'] = $this->category_model->fetch_term(0,'tag');
        $admins = $this->admin_model->fetch_all_admin();
          if(!empty($admins)){
            $data['searchData'] = $this->manageSearchData($admins);
        }else{
            $data['searchData'] = NULL;
        }
        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('templates/side.php');
        $this->load->view('Admin/addNewAdmin',$data);
        $this->load->view('templates/footer.php');
      }else{
        $this->load->view('access_denied/accessDenide.php');
      }
      
    }else{
      $this->load->view('access_denied/accessDenide.php');
    }
    
  }

  public function createNewAdmin(){
    if(isLoggedIn()){
        if($this->session->userdata['admin_type'] === 'main_admin'){

          $this->form_validation->set_rules('user_name', 'User Name', 'required');
          $this->form_validation->set_rules('email', 'Email', 'required');
          $this->form_validation->set_rules('password', 'Password', 'required');
          $this->form_validation->set_rules('adminType', 'AdminType', 'required');

          if($this->form_validation->run() === FALSE){
              $this->load->view('admin/addNewAdmin');
          }else{
              $username =clean_input($this->input->post('user_name'));
              $full_name =clean_input($this->input->post('full_name'));
              $email = clean_input($this->input->post('email'));
              $pass = clean_input($this->input->post('password'));
              $password = password_hash($pass, PASSWORD_ARGON2I);
              $adminType = clean_input($this->input->post('adminType'));
              $cat_array = clean_input($this->input->post('categories[]'));
              $tag_array = clean_input($this->input->post('tags[]'));
              // check if admin username and email already exist
              $this->admin_model->checkadmin_email_username($username,$email);
              if($this->admin_model->checkadmin_email_username($username,$email)){
                setFlashData('alert-danger','This user already exists','admin/addNewAdmin');
              }else{
                  if ($adminType ==='custom'){
 
                    if(empty($cat_array)){
                      setFlashData('alert-danger','Please Enter category','admin/addNewAdmin');
                    }else{
                      $this->admin_model->createAdmin_custom($username,$full_name,$email,$password,$adminType,$cat_array,$tag_array);
                      //set messages  
  
                      setFlashData('alert-success','admin Added Successfuly','admin/allAdmin');
                    }
                      
                  }else{
                    $this->admin_model->createAdmin_default($username,$full_name,$email,$password,$adminType);
                    //set messages

                  setFlashData('alert-success','admin Added Successfuly','admin/allAdmin');
                  }
              }  
              
              
            }
          }else{
            $this->load->view('access_denied/accessDenide');
          }
          
      }else{
        $this->load->view('Admin/login.php');
      }
    
  }

  public function allAdmin(){
    $data['admins'] = $this->admin_model->fetch_all_admin();
        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('templates/side.php');
        $this->load->view('admin/allAdmin',$data);
        $this->load->view('templates/footer.php');
  }

  public function deletebtn($admin_id){
      $this->admin_model->delete_admin($admin_id);
      setFlashData('alert-danger','admin deleted Successfuly','admin/allAdmin');
  }

  public function auth(){
    if($this->session->userdata['temp_session'] === 'temprary_session'){
      $this->load->view('admin/auth');
    }else{
      redirect('admin/login');
    }
  }

  public function checkToken(){
    if($this->session->userdata['temp_session'] === 'temprary_session'){
      $token = clean_input($this->input->post('token'));
      $username = $this->session->userdata['temp_username'];
      $this->form_validation->set_rules('token', 'Number Is Required', 'required');

      if($this->form_validation->run() === FALSE){
        $this->load->view('admin/auth');
    }else{
          $data['admin'] = $this->admin_model->get_admin_tokenID($token,$username);
          if($data['admin']){
            //create session
              $admin_data = array(
                  'admin_id' => $data['admin']['admin_id'],
                  'admin_username' => $data['admin']['admin_user_name'],
                  'admin_email' => $data['admin']['admin_email'],
                  'admin_name' => $data['admin']['admin_fullname'],
                  'admin_type' =>$data['admin']['admin_type']
                );
              if($data['admin']['admin_type']) {
                  $this->session->set_userdata('site_lang', 'english');
                $data['newscount'] = $this->news_model->countNews();
                $data['categorycount'] = $this->category_model->countCategory();
                $data['subcategorycount'] = $this->subcategory_model->countSubs();
                $data['tagscount'] = $this->tag_model->counttag();
                $data['lastnews'] = $this->news_model->lastnews();
                $data['lastcategory'] = $this->category_model->lastcategory();
                $data['published'] = $this->news_model->publishednews('publish');
                $data['draft'] = $this->news_model->publishednews('draft');
                  $this->session->set_userdata($admin_data);
                  $this->load->view('templates/header.php');
                  $this->load->view('templates/nav.php');
                  $this->load->view('templates/side.php');
                  $this->load->view('Admin/index.php',$data);
                  $this->load->view('templates/footer.php');
                }else{
                  die('there is no admin_type');
                }
          }else{
          //show error

          setFlashData('alert-danger','The Number Is Not Correct Please Try Again','admin/auth');
          }
      }
        
      }else{
        redirect('admin/login');
      }
    
  } 
  
  
  public function logout_temp(){
    $this->session->unset_userdata('temp_session');
  redirect('admin/login');
  }


  public function EditPassword($id){

    if(isLoggedIn()){
      if($this->session->userdata['admin_type'] === 'main_admin'){
        $data['password'] = $id;
        //to fetch only categories set parent to 0 and taxonomy to cat
        $this->load->view('templates/header.php');
        $this->load->view('templates/nav.php');
        $this->load->view('templates/side.php');
        $this->load->view('admin/rest_admin_password',$data);
        $this->load->view('templates/footer.php');
      }else{
        $this->load->view('access_denied/accessDenide.php');
      }
      
    }else{
      $this->load->view('access_denied/accessDenide.php');
    }

  }


  public function Rest_admin_Password(){
    if(isLoggedIn()){
      if($this->session->userdata['admin_type'] === 'main_admin'){
        $pass = clean_input($this->input->post('password',true));
        $pass2 = clean_input($this->input->post('password2',true));
        $id = clean_input($this->input->post('id'));
        $password = password_hash($pass, PASSWORD_ARGON2I);
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password2', 'ConfirmPassword', 'matches[password]');
          if($this->form_validation->run() === FALSE){
            $data['password'] = $id;
            $this->load->view('templates/header.php');
            $this->load->view('templates/nav.php');
            $this->load->view('templates/side.php');
            $this->load->view('admin/rest_admin_password',$data);
            $this->load->view('templates/footer.php');
          }else{
           if($this->admin_model->update_admin_password($password,$id)){
            setFlashData('alert-success','Password Updated Successfuly','admin/allAdmin');
           }else{
            setFlashData('alert-danger','Some Thing went wrong','admin/rest_admin_password');
           }
          }

      }else{
        $this->load->view('access_denied/accessDenide.php');
      }
      
    }else{
      $this->load->view('access_denied/accessDenide.php');
    }
  }


  public function manageSearchData($admins){
    $search = [];
    foreach($admins as $admin){
        array_push($search,$admin['admin_user_name']);
    }
    return $search;
  }

    function switchLang($language = "")
      { 
          $this->session->unset_userdata('site_lang');
          $this->session->set_userdata('site_lang', $language);
          redirect('admin/index');
      }
  
}