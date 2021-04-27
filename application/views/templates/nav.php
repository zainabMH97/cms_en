 <!-- BEGIN: Header-->
 <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-lg-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item mr-auto"><a class="navbar-brand" href="<?php echo base_url(); ?>admin/index"><img class="brand-logo" alt="modern admin logo" src="<?php echo base_url(); ?>assets/app-assets/images/logo/logo.png">
                            <h3 class="brand-text"><?php echo $this->lang->line('nav-title'); ?></h3>
                        </a></li>
                    <li class="nav-item d-none d-lg-block nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 white" data-ticon="ft-toggle-right"></i></a></li>
                    <li class="nav-item d-lg-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
                </ul>
            </div>
            <div class="navbar-container content">
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
                        <li class="nav-item nav-search"><a class="nav-link nav-link-search" href="#"><i class="ficon ft-search"></i></a>
                            <div class="search-input">
                                <input class="input" type="text" placeholder="Search .... " tabindex="0" data-search="template-list">
                                <div class="search-input-close"><i class="ft-x"></i></div>
                                <ul class="search-list"></ul>
                            </div>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-language nav-item">
                            <?php if($this->session->userdata['site_lang'] == 'english') : ?>
                                <a class="dropdown-toggle nav-link" id="dropdown-flag" href="<?php echo site_url("admin/switchLang/english"); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span class="selected-language"></span></a>
                            <?php else :?>
                                <a class="dropdown-toggle nav-link" id="dropdown-flag" href="<?php echo site_url("admin/switchLang/arabic"); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-iq"></i><span class="selected-language"></span></a>
                            <?php endif ;?>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                                <a class="dropdown-item" href="<?php echo site_url("admin/switchLang/english"); ?>" data-language="en"><i class="flag-icon flag-icon-us"></i> <?php echo $this->lang->line('nav-lang-en'); ?></a>
                                <a class="dropdown-item" href="<?php echo site_url("admin/switchLang/arabic"); ?>" data-language="ar"><i class="flag-icon flag-icon-iq"></i> <?php echo $this->lang->line('nav-lang-ar'); ?></a>
                            </div>
                        </li>
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell"></i><span class="badge badge-pill badge-danger badge-up badge-glow">1</span></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <h6 class="dropdown-header m-0"><span class="grey darken-2"><?php echo $this->lang->line('nav-notification'); ?></span></h6><span class="notification-tag badge badge-danger float-right m-0">1 New</span>
                                </li>
                                <li class="scrollable-container media-list w-100">
                                <a href="javascript:void(0)">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i class="ft-file icon-bg-circle bg-teal mr-0"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading">Generate monthly report</h6><small>
                                                    <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last month</time></small>
                                            </div>
                                        </div>
                                    </a></li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)"><?php echo $this->lang->line('nav-notification-read-all'); ?></a></li>
                            </ul>
                        </li>
                        
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span class="mr-1 user-name text-bold-700"><?php echo $this->session->userdata['admin_name'] ; ?></span><span class="avatar avatar-online"><img src="<?php echo base_url(); ?>assets/app-assets/images/gallery/admin_user.jpg" alt="avatar"><i></i></span></a>
                            <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="ft-user"></i> <?php echo $this->lang->line('nav-profile-edit'); ?></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo base_url(); ?>admin/logout"><i class="ft-power"></i> <?php echo $this->lang->line('nav-profile-logout'); ?></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->
