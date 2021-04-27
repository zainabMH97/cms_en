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

                            <h2><?php echo $this->lang->line('category-edit-title'); ?></h2>

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
                                <table class="table table-bordered table-striped" id="category_data">
                                    <thead>
                                        <tr>
                                            <th width="33%"><?php echo $this->lang->line('category-edit-categoryTitle'); ?></th>
                                            <th width="43%"><?php echo $this->lang->line('category-edit-categorydiscription'); ?></th>
                                            <th width="23%"><?php echo $this->lang->line('category-edit-control'); ?></th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($categories as $category) : ?>
                                            <tr>
                                                <td><?php echo $category['term_title'] ; ?></td>
                                                <td><?php echo $category['term_description'] ; ?></td>
                                                <td style="width:20%;">
                                                    <a href="<?php echo base_url(); ?>/category/editCategoryInfo/<?php echo $category['term_id'] ; ?>" class="btn btn-outline-primary"> <?php echo $this->lang->line('category-edit-control-edit'); ?></a>
                                                    <a href="<?php echo base_url();?>/category/deletebtn/<?php echo $category['term_id'] ; ?>" class="btn btn-outline-danger"> <?php echo $this->lang->line('category-edit-control-delete'); ?> </a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Analytics map based session -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
    <script type="text/javascript" language="javascript" >  
 $(document).ready(function(){  
      var dataTable = $('#category_data').DataTable({ 
        responsive: true, 
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