<!-- BEGIN: Content-->
<div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">

                <!-- Analytics map based session -->
                <div class="row">
                    <div class="col-12">
                        <div class="card box-shadow-0" style="padding: 30px;">

                            <h2><?php echo $this->lang->line('slider-title-title'); ?></h2>  

                            <?php if($this->session->flashdata('class')) : ?>
                                <div class="alert <?php echo $this->session->flashdata('class'); ?> alert-dismissible" id="flashdata" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <?php
                                        echo $this->session->flashdata('message'); 
                                        unset($_SESSION['message']) ;
                                        unset($_SESSION['class']) ;
                                    ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="table-responsive ">
                                <table class="table table-bordered table-striped" id="slider_data">
                                    <thead>
                                    <tr>
                                        <th width="40%"><?php echo $this->lang->line('slider-img'); ?> </th> 
                                        <th width="30%"><?php echo $this->lang->line('slider-title'); ?></th> 
                                        <th width="10%"><?php echo $this->lang->line('slider-status'); ?></th>
                                        <th width='20%'><?php echo $this->lang->line('slider-Controls'); ?></th>
                                        
                                    </tr>
                                    </thead>

                                <tbody>
                                    
                                    <?php foreach($slider as $slid) : ?>
                        
                                        <tr>
                                            
                                            <?php
                                             $media = site_url().'assets/img/news/'.$slid['post_img'];
                                             $tmp = explode(".",$media);
                                             $fileExtension = strtolower(end($tmp));
                                            if($fileExtension == 'jpg'|| $fileExtension =='png'|| $fileExtension =='gif'):?>
                                                <td><img class=" post-thumb" style="max-width: 300px; max-height: 200px;" src="<?php echo site_url(); ?>assets/img/news/<?php echo $slid['post_img'];?>" ></td>
                                            <?php elseif($fileExtension == 'mp4'): ?>
                                                <td>
                                                    <video width="300" height="200" controls>
                                                        <source src="<?php echo site_url(); ?>assets/img/news/<?php echo $slid['post_img'];?>" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                </td>
                                            <?php else : ?>
                                                <td><p class = "text-danger">This Type of Media is not Supported</p></td>
                                            <?php endif ;?>
                                            

                                            <td><?php echo $slid['post_title'] ; ?></td>

                                            <?php if($this->session->userdata('admin_type') == 'main_admin') :?>
                                                <td>
                                                    <?php if ($slid['status'] == 'publish'):?>
                                                        <a href="<?php echo base_url(); ?>slider/changeStatusToDraft/<?php echo $slid['post_id'] ; ?>" class="btn btn-outline-info"> <?php echo $this->lang->line('news-edit-ststus-publish'); ?></a>
                                                    <?php else :?>
                                                        <a href="<?php echo base_url(); ?>slider/changeStatusToPublish/<?php echo $slid['post_id'] ; ?>" class="btn btn-outline-danger"> <?php echo $this->lang->line('news-edit-ststus-Draft'); ?></a>
                                                    <?php endif ; ?>
                                                </td>
                                            <?php else :?>
                                                <td>
                                                    <p class="text-danger"><?php echo $slid['status'];?> </p>
                                                </td>
                                            <?php endif;?>

                                            <td>
                                                <a href="<?php echo base_url(); ?>slider/editSlidInfo/<?php echo $slid['post_id'] ; ?>" class="btn btn-outline-info" style="display:block;"> <?php echo $this->lang->line('news-edit-control-edit'); ?></a> <br>
                                                <a href="<?php echo base_url();?>slider/deletebtn/<?php echo $slid['post_id'] ; ?>" class="btn btn-outline-danger" style="display:block;"> <?php echo $this->lang->line('news-edit-control-delete'); ?> </a>
                                            </td>


                                            
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- END: Content-->  
    

    <script type="text/javascript" language="javascript" >  
 $(document).ready(function(){  
      var dataTable = $('#slider_data').DataTable({

        "language": {
            <?php if($this->session->userdata['site_lang'] == 'english') :?>
                search: "Search in table:"
               
            <?php else:?>
                search: "ألبحث :",
                paginate: {
                    first:      "ألأول",
                    previous:   "ألسابق",
                    next:       "ألأقدم",
                    last:       "ألأخير"
                }
               
            <?php endif ;?>
        }
      });  
 });  

 </script>  