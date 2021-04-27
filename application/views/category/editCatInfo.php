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
                            
                                <h2><?php echo $this->lang->line('category-editcatinfo-title'); ?></h2>

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

                                <?php echo form_open_multipart('category/updateCatInfo'); ?>
                                <input type="hidden" name="id" value="<?php echo $info[0]['term_id']; ?>">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('category-editcatinfo-catname'); ?></label>
                                        <input type="text" class="form-control" name="title"  placeholder="Enter title" value="<?php echo $info[0]['term_title']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('category-editcatinfo-Description'); ?></label>
                                        <textarea id="editor1" class="form-control" name="description" placeholder="add description"><?php echo $info[0]['term_description']; ?></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-add-form"><?php echo $this->lang->line('category-edit-control-edit'); ?></button>
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
            const flashdata = document.getElementById('flashdata');
                setInterval(myTimer ,4000);

                function myTimer() {
                flashdata.style.display = "none";
            }
    </script>