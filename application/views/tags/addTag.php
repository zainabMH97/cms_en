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
                            
                            <h2><?php echo $this->lang->line('tags-title'); ?></h2>

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

                                <?php echo form_open_multipart('tags/createNewTag'); ?>
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('tags-addtag-title'); ?></label>
                                        <input type="text" class="form-control tag-default" name="title"  placeholder="Enter title">
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('tags-addtag-description'); ?></label>
                                        <textarea id="editor1" class="form-control" name="description" placeholder="add description"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-add-form"><?php echo $this->lang->line('subcategory-submit'); ?></button>
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
            ClassicEditor
                .create( document.querySelector( '#editor1' ), {
                    ckfinder: {
                        uploadUrl: 'http://127.0.0.1/cmsTwo/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                    },
                    
                     toolbar: [ 'ckfinder', 'imageUpload','|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo','numberedList','blockQuote','insertTable','imageStyle:side','link','imageTextAlternative','mergeTableCells']
                } )
                .catch( error => {
                    console.error( error ); 
            } );


            $(document).ready(function(){

                var peopleTags = [<?php echo '"'.implode('","',$searchData).'"'  ?>];
                $( ".tag-default" ).autocomplete({
                    source: peopleTags
                });



            });
    </script>