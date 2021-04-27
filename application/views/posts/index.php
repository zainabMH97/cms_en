<!-- BEGIN: Content-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/all.min.js" integrity="sha512-UwcC/iaz5ziHX7V6LjSKaXgCuRRqbTp1QHpbOJ4l1nw2/boCfZ2KlFIqBUA/uRVF0onbREnY9do8rM/uT/ilqw==" crossorigin="anonymous"></script>
<div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                    <div class="card box-shadow-0" style="padding: 30px;">
                            <div class="row">
                                <div class="col-md-9">
                                    <h2 class="text-primary text-uppercase font-italic"><?php echo $info[0]['post_title'];?></h2>
                                </div>
                                <div class="col-md-3">
                                    <h2 class="text-danger text-uppercase">
                                        <?php if($this->session->userdata('admin_type') == 'main_admin' || $this->session->userdata('admin_type') === 'catroot') :?>
                                                
                                            <?php if ($info[0]['status'] == 'publish'):?>
                                                <a href="<?php echo base_url(); ?>news/changeStatusToDraft?id=<?php echo $info[0]['post_id'] ; ?>&slug=<?php echo $info[0]['post_slug'];?>" class="btn btn-outline-info"> <?php echo $this->lang->line('news-edit-ststus-publish'); ?></a>
                                            <?php elseif($info[0]['status'] == 'draft') :?>
                                                <a href="<?php echo base_url(); ?>news/changeStatusToPublish?id=<?php echo $info[0]['post_id'] ; ?>&slug=<?php echo $info[0]['post_slug'];?>" class="btn btn-outline-danger"> <?php echo $this->lang->line('news-edit-ststus-Draft'); ?></a>
                                            <?php else :?> 
                                                <p> null </p>
                                            <?php endif ; ?>
                                            
                                            <?php else :?>
                                                
                                                    <p class="text-danger"><?php echo $info[0]['status'];?> </p>
                                                
                                        <?php endif;?>

                                    </h2>
                                </div>
                            </div>
                            <div class="row" style="margin:20px">
                                <div class="col-md-8">
                                    <?php foreach($term as $ter) :?>
                                        <?php if($ter['parent']==0 and $ter['taxnomy'] == 'cat') : ?>
                                            <span class="bg-light text-info display_term"><italic class="text-primary"><?php echo $this->lang->line('post-category'); ?> : </italic><?php echo $ter['term_title'];?></span>
                                        <?php elseif($ter['parent'] == 0 and $ter['taxnomy'] === 'tag') :?>
                                            <span class="bg-light text-info display_term"> <italic class="text-primary">#</italic><?php echo $ter['term_title'];?></span>
                                        <?php else :?>
                                            <span class="bg-light text-info display_term"><italic class="text-primary"><?php echo $this->lang->line('post-Subcategory'); ?> : </italic><?php echo $ter['term_title'];?></span>
                                        <?php endif ; ?>
                                    <?php endforeach ; ?>

                                </div>
                                <div class="col-md-2"> 
                                    <span class="text-success"><?php echo $this->lang->line('post-timetoread'); ?> :  <?php echo $info[0]['time_to_read']; ?> <?php echo $this->lang->line('post-timetoread-min'); ?> </span>
                                </div>
                                <div class="col-md-2"> 
                                    <span class="text-danger"> <?php echo $info[0]['post_date']; ?> </span>
                                </div>
                            </div>
                            

                            <div class="row">
                                <?php if(!empty($info[0]['post_img'])) : ?>
                                    <div class="col-md-12 " style="padding-left: 31px;">

                                        <?php
                                            $media = site_url().'assets/img/news/'.$info[0]['post_img'];
                                            $tmp = explode(".",$media);
                                            $fileExtension = strtolower(end($tmp));
                                            if($fileExtension == 'jpg'|| $fileExtension =='png'|| $fileExtension =='gif'):?>
                                                <?php if(stripos($info[0]['post_img'],'http:') !== false) : ?>
                                                <img src="<?php echo $info[0]['post_img'];?>" class="img-fluid img-thumbnail"> 
                                                <?php else : ?>
                                                    <img src="<?php echo base_url();?>assets/img/news/<?php echo $info[0]['post_img'];?>" class="img-fluid img-thumbnail" alt="Responsive image"> 
                                                <?php endif ; ?>
                                            <?php elseif($fileExtension == 'mp4'): ?>
                                                <video width="80%" height=auto controls>
                                                    <source src="<?php echo site_url(); ?>assets/img/news/<?php echo $info[0]['post_img'];?>" type="video/mp4">
                                                    
                                                </video>
                                            
                                            <?php else : ?>
                                                <p>Open a PDF file <a href="<?php echo site_url(); ?>assets/img/news/<?php echo $info[0]['post_img'];?>">pdf</a>.</p>
                                        <?php endif ;?>

                                    </div>
                                <?php endif ; ?>
                            </div>
                               
                            <div class="row" style="margin:20px">
                                <div class="col-md-12" id="description">
                                    <?php echo $info[0]['post_description'];?>
                                </div>
                                <span class="text-danger show_text" id="show_more">Show More ... </span>
                                <span class="text-danger show_text" id="show_less">Show Less ... </span>
                            </div>
                                
                            
                    </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->
    <script>
        const description = document.getElementById('description');
        const showMore = document.getElementById('show_more');
        const showLess = document.getElementById('show_less');
        var numberOfChildren = description.getElementsByTagName('p').length;
        showLess.style.display = 'none';
        if(numberOfChildren > 5){
            var children = description.children;
            for(i =0; i<children.length;i++){
                if(i<5){
                    children[i].style.display = 'block';
                }else{
                    children[i].style.display = 'none';
                }
            }
        }else{
            showMore.style.display = 'none';
        }
        

        showMore.addEventListener('click',function(){
            for(i =0; i<children.length;i++){
                children[i].style.display = 'block';
            }
            showMore.style.display = 'none';
            showLess.style.display = 'inline-block';
        });

        showLess.addEventListener('click',function(){
            if(numberOfChildren > 5){
                var children = description.children;
                for(i =0; i<children.length;i++){
                    if(i<5){
                        children[i].style.display = 'block';
                    }else{
                        children[i].style.display = 'none';
                    }
                }
                showMore.style.display = 'inline-block';
                showLess.style.display = 'none';
            }else{
                showMore.style.display = 'none';
                showLess.style.display = 'none';
            }
        });
    </script>
