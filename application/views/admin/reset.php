<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
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
                                        <div class="p-1"><img src="<?php echo base_url(); ?>assets/app-assets/images/logo/logo-dark.png" alt="branding logo"></div>
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Change Password</span>
                                    </h6>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">                  

                                       
                                        <?php echo form_open('admin/restPassword'); ?>
                                        <!-- <form id="form" method="POST"> -->
                                        <?php if (!empty(validation_errors())): ?>
                                            <div class="alert alert-danger" id="flashdata">
                                                <a class="close" data-dismiss="alert" title="close">x</a>
                                                <ul style="list-style:none"><?php echo (validation_errors('<li>', '</li>')); ?></ul>
                                            </div>
                                        <?php endif; ?>               
                                                <input type="hidden" name="selector" value="<?php echo $selector = filter_input(INPUT_GET, 'selector'); ?>">

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


                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter New Password" required >
                                                    <div class="form-control-position">
                                                        <i class="la la-key"></i>
                                                    </div>
                                                    <small>Error message</small>
                                                </fieldset>

                                                <fieldset class="form-group position-relative has-icon-left">
                                                    <input type="password" class="form-control" name="password2" id="password2" placeholder="Enter Password again" required >
                                                    <div class="form-control-position">
                                                        <i class="la la-key"></i>
                                                    </div>
                                                    <small>Error message</small>
                                                </fieldset>
                    
                                                <button type="submit" id="sub" class="btn btn-info btn-block"><i class="ft-unlock"></i> Submit</button>
                                        </form>
                                        

                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="">
                                        <p>Denetro Admin Rest Password</p>
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
    <script src="<?php echo base_url(); ?>assets/js/scriptRest.js"></script>

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
</body>
<!-- END: Body-->

</html>


