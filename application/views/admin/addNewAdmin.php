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
                            
                                <h2><?php echo $this->lang->line('admin-title'); ?></h2>

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

                                <?php echo form_open_multipart('admin/createNewAdmin'); ?>
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('admin-userName'); ?></label>
                                        <input type="text" class="form-control user-default" name="user_name"  placeholder="Enter title" required >
                                    </div>

                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('admin-fullName'); ?></label>
                                        <input type="text" class="form-control" name="full_name"  placeholder="Enter title" required >
                                    </div>

                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('admin-Email'); ?></label>
                                        <input type="text" class="form-control" name="email"  placeholder="Enter email" required >
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('admin-Password'); ?></label>
                                        <input class="form-control" name="password" type="password"  placeholder="Enter Password" required>
                                    </div>

                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('admin-Type'); ?>:</label>
                                        <select class="form-control" id="admin_type" name="adminType" style="width:100%;" required >
                                            <option value="catroot">Ctegory main admin</option>
                                            <option value="subroot">Subcategory main admin</option>
                                            <option value="custom">custom admin</option>
                                        </select>
                                    </div>

                                    <div class="form-group" id="category_section">
                                        <label><?php echo $this->lang->line('admin-category'); ?></label>
                                        <select class="js-example-basic-multiple"  name="categories[]" multiple="multiple" style="width:100%;">
                                            <?php foreach($categories as $category) : ?>
                                                <option value="<?php echo $category['term_id']; ?>"> <?php echo $category['term_title']; ?> </option>
                                            <?php endforeach ; ?>
                                        </select>
                                    </div>

                                    <div class="form-group" id="tag_section">
                                        <label><?php echo $this->lang->line('admin-Tags'); ?></label>
                                        <select class="js-example-basic-multiple"  name="tags[]" multiple="multiple" style="width:100%;">
                                            <?php foreach($tags as $tag) : ?>
                                                <option value="<?php echo $tag['term_id']; ?>"> <?php echo $tag['term_title']; ?> </option>
                                            <?php endforeach ; ?>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-add-form"><?php echo $this->lang->line('category-submit'); ?></button>
                                </form>
                        </div>
                    </div>
                </div>
                <!-- Analytics map based session -->
            </div>
        </div>
    <!-- END: Content-->
     <!-- <script>
        $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
        });
    </script> -->
    <script>
            CKEDITOR.replace( 'editor1' );
    </script>
    <script>
        const category_section = document.getElementById('category_section');
        const tag_section = document.getElementById('tag_section');
        const admin_type = document.getElementById('admin_type');
            category_section.style.display = "none";
            tag_section.style.display = "none";

            if(admin_type.value == 'custome'){
                category_section.style.display = "block";
                tag_section.style.display = "block";
            }
            else{
                category_section.style.display = "none";
                tag_section.style.display = "none";
            }
           
            admin_type.addEventListener("change", function(e){
                const val = admin_type.value;
                if(val== 'custom'){
                    category_section.style.display = "block";
                    tag_section.style.display = "block";
                }else{
                    category_section.style.display = "none";
                    tag_section.style.display = "none"; 
                }
            });
            
            $(document).ready(function(){

                var peopleTags = [<?php echo '"'.implode('","',$searchData).'"'  ?>];
                $( ".user-default" ).autocomplete({
                    source: peopleTags
                });



            });
    </script>
    
    
    