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
                            
                                <h2><?php echo $this->lang->line('news-editinfo-title'); ?></h2>

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

                                <?php echo form_open_multipart('news/updateNews'); ?>
                                <input type="hidden" name="id" value="<?php echo $info[0]['post_id']; ?>">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('news-editinfo-newsname'); ?></label>
                                        <input type="text" class="form-control" name="title"  placeholder="Enter title" value="<?php echo $info[0]['post_title']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('news-editinfo-Category'); ?></label>
                                        <select class="js-example-basic-multiple" name="categories[]" multiple="multiple" style="width:100%;" required>
                                            <?php foreach($categories as $category) : ?>
                                                <option value="<?php echo $category['term_id']; ?>"
                                                    <?php 
                                                    foreach($selected_categories as $cate){

                                                        if(!empty($selected_categories)){
                                                        
                                                            if($category['term_id'] == $cate['term_id']){
                                                                echo 'selected';
                                                            }
                                                        }
                                                        
                                                        }
                                                        ?>
                                                > <?php echo $category['term_title']; ?> </option>
                                            <?php endforeach ; ?>
                                        </select>
                                    </div>
                                    
                                    <?php if($this->session->userdata('admin_type') === 'main_admin' or $this->session->userdata('admin_type') === 'catroot') : ?>

                                        <div class="form-group">
                                            <label><?php echo $this->lang->line('news-editinfo-suubcategory'); ?></label>
                                            <select class="js-example-basic-multiple" name="subcategories[]" multiple="multiple" style="width:100%;" >
                                        
                                                <?php foreach($categories as $category) : ?>
                                                    <optgroup class="parent" id="<?php echo $category['term_id']; ?>" label=" <?php echo $category['term_title']; ?>">
                                                        <?php 
                                                            foreach($subcategories as $subs){
                                                                if ($subs['parent'] == $category['term_id']){
                                                                echo '<option value='.$subs['term_id'].'>' .$subs['term_title'] .'</option>';
                                                                }
                                                            }
                                                        ?>
                                                    </optgroup>
                                                <?php endforeach ; ?>
                                                <?php foreach($selected_subcategories as $subcategory) : ?>
                                                    <option value="<?php echo $subcategory['term_id']; ?>"
                                                        
                                                    selected> <?php echo $subcategory['term_title']; ?> </option>
                                                <?php endforeach ; ?>
                                            </select>
                                        </div>
                                    <?php endif ; ?>
                                    
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('news-editinfo-Tags'); ?></label>
                                        
                                        <select class="js-example-basic-multiple" name="tags[]" multiple="multiple" style="width:100%;" >
                                            <?php foreach($tags as $tag) : ?>
                                                <option value="<?php echo $tag['term_id']; ?>"
                                                    <?php 
                                                    
                                                        if(!empty($selected_tags)){
                                                            foreach($selected_tags as $tags){
                                                        
                                                            if($tags["term_id"] == $tag['term_id']){
                                                                echo 'selected';
                                                                }
                                                            }
                                                        }
                                                    
                                                    ?>
                                                
                                                > <?php echo $tag['term_title']; ?> </option>
                                            <?php endforeach ; ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('news-add-Status'); ?></label>
                                        <select class="form-control form-select" name="status" id="status" style="width:100%;">
                                            <?php if($this->session->userdata('admin_type') === 'main_admin' or $this->session->userdata('admin_type') === 'catroot') : ?>
                                                <option value="publish">Publish</option>
                                                <option value="draft">Draft</option>
                                            <?php else : ?>
                                                <option value="draft" selected>Draft</option>
                                            <?php endif ;?>
                                        </select>
                                    </div>

                                    
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('news-editinfo-Body'); ?></label>
                                        <textarea id="editor1" class="form-control" name="description" placeholder="add body" ><?php echo $info[0]['post_description']; ?></textarea>
                                    </div>

                                    <div class="form-group file_upload">
                                    <input type="file" name="userfile" size="1000" id="upload" >
                                        <div class="header">
                                            
                                            <label for="upload">
                                                <p><i class="fa fa-cloud-upload fa-2x"></i><span><?php echo $this->lang->line('news-editinfo-Upload'); ?></span></p>
                                            </label>			
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-news-edit-form"><?php echo $this->lang->line('news-editinfo-Submit'); ?></button>
                                </form>
                                
                        </div>
                    </div>
                </div>
                <!-- Analytics map based session -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
     <!-- <script>
        $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
        });
    </script> -->
    <script>
             ClassicEditor
                .create( document.querySelector( '#editor1' ), {
                    ckfinder: {
                        uploadUrl: 'http://127.0.0.1/cmsTwo/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                    },
                    
                     toolbar: [ 'ckfinder', 'imageUpload','|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo','numberedList','blockQuote','insertTable','imageStyle:side','link','imageTextAlternative','mergeTableCells'],
                     styles: [
                // This option is equal to a situation where no style is applied.
                'full',

                // This represents an image aligned to the left.
                'alignLeft',

                // This represents an image aligned to the right.
                'alignRight'
            ]
                } )
                .catch( error => {
                    console.error( error ); 
            } );

    </script>
    
    
    