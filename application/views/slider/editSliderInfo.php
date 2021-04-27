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
                            
                                <h2><?php echo $this->lang->line('slider-edit-slider'); ?> </h2>

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

                                <?php if (!empty(validation_errors())): ?>
                                    <div class="alert alert-danger" id="flashdata">
                                        <a class="close" data-dismiss="alert" title="close">x</a>
                                        <ul style="list-style:none"><?php echo (validation_errors('<li>', '</li>')); ?></ul>
                                    </div>
                                <?php endif; ?>

                                <?php echo form_open_multipart('slider/updateSlider'); ?>

                                    <input type="hidden" name="id" value="<?php echo $info[0]['post_id'];?>">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('slider-title'); ?></label>
                                        <input type="text" class="form-control subcategory-default" name="title"  placeholder="Enter title" required value="<?php echo $info[0]['post_title'];?>">
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('slider-caption'); ?></label>
                                        <textarea type="text" class="form-control subcategory-default" name="caption"  placeholder="Enter caption" rows="10" value="<?php echo $info[0]['post_description'];?>"></textarea>
                                    </div>

                                    <div class="form-group file_upload">
                                     <input type="file" name="userfile" size="1000" id="upload">
                                        <div class="header">
                                            
                                            <label for="upload">
                                                <p><i class="fa fa-cloud-upload fa-2x"></i><span><?php echo $this->lang->line('news-add-upload'); ?></span></p>
                                            </label>			
                                        </div>
                                    </div>
                                    

                                    <button type="submit" class="btn btn-news-form" style="bottom:24px;"><?php echo $this->lang->line('subcategory-submit'); ?></button>
                                </form>
                        </div>
                    </div>
                </div>
                <!-- Analytics map based session -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
    <script>
            
            const flashdata = document.getElementById('flashdata');
            setInterval(myTimer ,4000);

            function myTimer() {
            flashdata.style.display = "none";
            }

    </script>