
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Modern cms is super flexible, powerful, clean &amp; modren responsive cms Denetro Cms for content mangement system ">
    <meta name="keywords" content="cms, cms admin, dashboard cms, denetro, denetro dashboard, web app,cms, wordpress">
    <meta name="author" content="DTC">
    <title>Dentro Dashboard</title>
    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/app-assets/vendors/css/forms/icheck/custom.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/app-assets/css/components.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/app-assets/css/pages/login-register.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 1-column   blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 m-0">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <div class="p-1">Check Admin Login </div>
                                    </div>
                                    
                                </div>
                                <div class="card-content">
                                    <div class="card-body">

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

                                            <!-- <form class="form-horizontal form-simple" action="#" method="POST"> -->
                                            <?php echo form_open('admin/checkToken'); ?>
                                                <fieldset class="form-group position-relative has-icon-left mb-0" style="padding-bottom: 28px;">
                                                    <h2 class="text-info" style="margin-bottom: 20px;">Enter Your Number: </h2>
                                                    <input type="text" class="form-control" id="token" placeholder="Enter Your Number" required name="token">
                                                    
                                                </fieldset>
                                                
                                                <button type="submit" class="btn btn-info btn-block"><i class="ft-unlock"></i> Submit</button>
                                            </form>
                                            <a class="temp_logout" style="display: inline-block;margin-top: 20px;" href="<?php echo base_url(); ?>admin/logout_temp"><i class="ft-power"></i> Logout</a>
                                    </div>
                                </div>
                                

                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="<?php echo base_url(); ?>assets/app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?php echo base_url(); ?>assets/app-assets/js/core/app-menu.js"></script>
    <script src="<?php echo base_url(); ?>assets/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="<?php echo base_url(); ?>assets/app-assets/js/scripts/forms/form-login-register.js"></script>
    <!-- END: Page JS-->
<script>
    const flashdata = document.getElementById('flashdata');
    setInterval(myTimer ,4000);

    function myTimer() {
    flashdata.style.display = "none";
   }
</script>

</body>
<!-- END: Body-->

</html>