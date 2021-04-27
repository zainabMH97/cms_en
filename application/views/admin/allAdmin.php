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

                            <h2><?php echo $this->lang->line('all-admin-title'); ?></h2>

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
                                <table class="table table-bordered table-striped" id="admin_data">
                                <thead>
                                    <tr>
                                        <td style="width: 30%;"><?php echo $this->lang->line('all-admin-username'); ?></td>
                                        <td><?php echo $this->lang->line('all-admin-email'); ?></td>
                                        <td><?php echo $this->lang->line('all-admin-control'); ?> </td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($admins as $admin) : ?>
                                    <tr>
                                        <td><?php echo $admin['admin_user_name'] ; ?></td>
                                        <td><?php echo $admin['admin_email'] ; ?></td>
                                        <td style="width:35%;">
                                            <a href="<?php echo base_url();?>/admin/EditPassword/<?php echo $admin['admin_id'] ; ?>" class="btn btn-primary"> <?php echo $this->lang->line('all-admin-control-restpassword'); ?> </a>
                                            <a href="<?php echo base_url();?>/admin/deletebtn/<?php echo $admin['admin_id'] ; ?>" class="btn btn-danger"> <?php echo $this->lang->line('all-admin-control-delete'); ?> </a>
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
      var dataTable = $('#admin_data').DataTable({  
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