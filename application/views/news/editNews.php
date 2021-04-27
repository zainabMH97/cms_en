<style>
.center {
  text-align: center;
  margin-bottom: 1em;
}

.pagination {
  display: inline-block;
}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  transition: background-color .3s;
  border: 1px solid #ddd;
  margin: 0 4px;
}

.pagination a.active {
  background-color: #1E9FF2;
  color: white;
  border: 1px solid #1E9FF2;
}
th {
    background: white;
    position: sticky;
    top: 0;
  
  }

.pagination a:hover:not(.active) {background-color: #ddd;}
</style>
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

                            <h2><?php echo $this->lang->line('news-edit-newtitle'); ?></h2>  

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
                            <div class="col-md-4 datalist_category">
                                <?php echo form_open_multipart('search/fetch','id="searchForm"'); ?>

                                    <select class="js-example-basic-single form-control" name="term_id" id="categories"style="width:100%;">
                                        <?php foreach($categories as $row): ?>
                                            <option value="<?php echo $row['term_id']; ?>"> <?php echo $row['term_title']; ?> </option>
                                        <?php endforeach ; ?>
                                    </select>
                                    <input id="submit" type="submit" class="btn btn-info">
                                </form>
                            </div>
                             <div class="table-responsive" id="result">
                                <table class="table table-bordered table-striped" id="news_data" style="height: 35em !important;display: block;overflow: scroll;">
                                    <thead >
                                    <tr>
                                        <th width="278px"><?php echo $this->lang->line('news-edit-title'); ?></th>
                                        <th><?php echo $this->lang->line('news-edit-link'); ?></th>
                                       
                                        <th><?php echo $this->lang->line('news-edit-status'); ?></th>
                                        <th><?php  echo $this->lang->line('news-edit-categories'); ?></th>
                                        <th><?php echo $this->lang->line('news-edit-subcategory'); ?></th>
                                        <th><?php echo $this->lang->line('news-edit-tags'); ?></th>
                                        <th><?php echo $this->lang->line('news-edit-date'); ?></th>
                                        <th><?php echo $this->lang->line('news-edit-Controls'); ?></th> 
                                        
                                     </tr>
                                    </thead>
                                
                                <tbody >
                            
                                    <?php foreach($news as $new) : ?>
                                        
                                         
                                        <tr>
                                            <td><?php echo word_limiter($new['post_title'],6) ; ?></td>
                                            <td><a href = '<?php echo base_url();?>posts/<?php echo $new['post_slug']; ?>' ><?php echo base_url().urldecode($new['post_slug']) ; ?></a></td>
                                         
                                            <?php if($this->session->userdata('admin_type') == 'main_admin' || $this->session->userdata('admin_type') === 'catroot') :?>
                                                <td>
                                                    <?php if ($new['status'] == 'publish'):?>
                                                        
                                                        <p class="border border-primary text-primary" style="padding: 10px;
    border-radius: 8px;"><?php echo $this->lang->line('news-edit-ststus-publish'); ?></p>
                                                    <?php elseif($new['status'] == 'draft') :?>
                                                        <p class="border border-danger text-danger" style="padding: 10px;
    border-radius: 8px;"><?php echo $this->lang->line('news-edit-ststus-Draft'); ?></p>
                                                    <?php else :?> 
                                                        <p> null </p>
                                                    <?php endif ; ?>
                                                </td>
                                            <?php else :?>
                                                <td>
                                                    <p class="text-danger"><?php echo $new['status'];?> </p>
                                                </td>
                                            <?php endif;?>

                                            <td><p id="categoriesID">
                                      
                                              <p class="bg-light text-info-edit display_term "><?php echo $new['group_concat(term_title)'];?> </p>
                                                    
                                            </p></td>

                                            <td><p>
                                                <?php foreach($news_subcategories as $ne_cat) : ?>
                                            
                                                    <?php if($ne_cat['p_id'] == $new['p_id']) : ?>
                                                    
                                                            <p class="bg-light text-info-edit display_term"><?php echo $ne_cat['group_concat(term_title)'];?> </p>
                                                    
                                                    <?php endif ; ?> 
                                                <?php endforeach ; ?>
                                            </p></td> 


                                            <td><p>
                                                <?php foreach($news_tag as $ne_cat) : ?>
                                            
                                                    <?php if($ne_cat['p_id'] == $new['p_id']) : ?>
                                                    
                                                            <p class="bg-light text-info-edit display_term"><?php echo $ne_cat['group_concat(term_title)'];?> </p>
                                                    
                                                    <?php endif ; ?>
                                                <?php endforeach ; ?>
                                            </p></td>
                                            
                                            <td>
                                                <?php echo $new['post_date'];?>
                                            </td>

                                            <td>
                                                <a href="<?php echo base_url(); ?>news/editNewsInfo/<?php echo $new['p_id'] ; ?>" class="btn btn-outline-info" style="display:block;"> <?php echo $this->lang->line('news-edit-control-edit'); ?></a> <br>
                                                <a href="<?php echo base_url();?>news/deletebtn/<?php echo $new['p_id'] ; ?>" class="btn btn-outline-danger" style="display:block;"> <?php echo $this->lang->line('news-edit-control-delete'); ?> </a>
                                            </td>


                                            
                                         </tr>
                                    <?php endforeach ?>
                                </tbody>
                                </table>
                                <div class=" col-md-12 text-center center">
                                    <?php echo $this->pagination->create_links(); ?>
                                    
                                </div> 
                            </div> 
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- END: Content-->  
    

    <script type="text/javascript" language="javascript" >  
    var data = {};
    $("#browsers option").each(function(i,el) {  
    data[$(el).data("value")] = $(el).val();
    });
    console.log(data, $("#browsers option").val());


    

    $(document).ready(function(){
        $('.js-example-basic-single').select2();  
    })




 </script>  