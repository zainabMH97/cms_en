<!-- BEGIN: Content-->
<div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper" style="height: 592px;">
            <div class="content-header row">
            </div>
            <div class="content-body">

                <!-- Analytics map based session -->
                <div class="row">
                    <div class="col-12">
                        <div class="card box-shadow-0" style="padding: 30px;">
                            
                                <h2><?php echo $this->lang->line('restadmin-title'); ?></h2>

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

                                <?php echo form_open_multipart('admin/Rest_admin_Password'); ?>
                                    <input type="hidden" name = "id" value = '<?php echo $password;?>'>
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('restadmin-Password'); ?></label>
                                        <input class="form-control" name="password" type="password"  placeholder="Enter Password" required>
                                    </div>

                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('restadmin-Confirm-Password'); ?></label>
                                        <input class="form-control" name="password2" type="password"  placeholder="Enter Confirm Password" required>
                                    </div>

                                    
                                    <button type="submit" class="btn btn-add-form"><?php echo $this->lang->line('restadmin-submit'); ?></button>
                                </form>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    <!-- END: Content-->
    
   
    
    
    