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
                            
                                <h2><?php echo $this->lang->line('news-title'); ?></h2>

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

                                <?php echo form_open_multipart('news/createNewNews','id="my_id"'); ?>
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('news-add-newstitle'); ?></label>
                                        <div class="alert alert-warning alert-dismissible fade show" id="err_news_title" style="display:none"> The Post Already Exist</div>
                                        <input type="text" class="form-control news-default" name="title" id="news_title"  placeholder="Enter title" autocomplete="off" required >

                                        <div id="match-list"></div>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('news-add-category'); ?></label>
                                        <select class="js-example-basic-multiple" name="categories[]" id="categories" multiple="multiple" style="width:100%;">
                                            <?php foreach($categories as $category) : ?>
                                                <option value="<?php echo $category['term_id']; ?>"> <?php echo $category['term_title']; ?> </option>
                                            <?php endforeach ; ?>
                                        </select>
                                    </div>
                                    <?php if($this->session->userdata('admin_type') === 'main_admin' or $this->session->userdata('admin_type') === 'catroot') : ?>
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line('news-add-subcategory'); ?></label> 
                                            <select class="js-example-basic-multiple" name="subcategories[]" id="sub" multiple="multiple" style="width:100%;">
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
                                            </select>
                                        </div>
                                    <?php endif;?>

                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('news-add-Tags'); ?></label>
                                        
                                        <select class="js-example-basic-multiple" name="tags[]" id="tags" multiple="multiple" style="width:100%;">
                                            <?php foreach($tags as $tag) : ?>
                                                <option value="<?php echo $tag['term_id']; ?>"> <?php echo $tag['term_title']; ?> </option>
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
                                        <label><?php echo $this->lang->line('news-add-newsdescription'); ?></label>
                                        <textarea id="editor1" class="form-control" name="description" placeholder="add body"></textarea>
                                    </div>
                                    <div class="form-group file_upload" >
                                     <input type="file" name="userfile" size="1000" id="upload" >
                                        <div class="header">
                                            
                                            <label for="upload">
                                                <p><i class="fa fa-cloud-upload fa-2x"></i><span><?php echo $this->lang->line('news-add-upload'); ?></span></p>
                                            </label>			
                                        </div>
                                    </div>
                                    <div class="form-group file_upload">
                                        <button type="submit" class="btn btn-news-form" id= "submitForm"><?php echo $this->lang->line('news-add-addbtn'); ?></button>
                                    </div>
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
            // CKEDITOR.replace( 'editor1' );
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


            $(document).ready(function(){ 

                var peopleTags = [<?php echo '"'.implode('","',$searchData).'"'  ?>];
                $( ".news-default" ).autocomplete({
                    source: peopleTags
                });

                    $('#my_id').submit(function(e){
                        e.preventDefault();  
                        var test = document.getElementById('news_title').value;
                        var xhr = new XMLHttpRequest();
                        xhr.open('GET','<?php echo base_url();?>news/check_title_news?title='+test);
                        xhr.onload = function()
                        {
                            var result = xhr.responseText;
                            if(result == '0'){
                                var err_msg = document.getElementById('err_news_title');
                                    err_msg.style.display="block";

                                const flashdata = document.getElementById('err_news_title');
                                setInterval(myTimer ,4000);

                                function myTimer() {
                                flashdata.style.display = "none";
                                }
                            }else{
                                var title = document.getElementById('news_title').value;
                                var categories = $("#categories").val();
                                var subcategories = $("#sub").val();
                                var tags = $("#tags").val();
                                var description = document.getElementById('editor1').value;
                                var status = document.getElementById('status').value;
                                var userfile = document.getElementById('upload').value;
                                if(userfile === ''){
                                    console.log('error');
                                }else{
                                    var userfile = document.getElementById('upload').files[0].size;
                                }
                                if(userfile < 6000001){
                                    var data = new FormData(document.getElementById("my_id"));
                                        $.ajax({
                                        url : "<?php echo base_url(); ?>news/createNewNews",    
                                        type:"post",
                                        data:data,
                                        processData:false,
                                        contentType:false,
                                        cache:false,
                                        async:false,
                                        success : function(data) {
                                            console.log('done');
                                            window.location.href = "<?php echo base_url(); ?>news/editNews";
                                        },
                                        error: function(xhr, status, error) {
                                            console.log(xhr.responseText);
                                        }
                                    });
                                }else{
                                    var err_msg = document.getElementById('err_news_title');
                                    err_msg.innerHTML = 'The File Size is too large';
                                    err_msg.style.display="block";

                                    const flashdata = document.getElementById('err_news_title');
                                    setInterval(myTimer ,6000);

                                    function myTimer() {
                                    flashdata.style.display = "none";
                                }
                                    
                                }
            
                            }
                            
                        }
                        xhr.send();
            
                 }); 
                 
                 
            });      


    </script>
    
    
    