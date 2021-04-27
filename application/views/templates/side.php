  <!-- BEGIN: Main Menu-->

  <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a href="<?php echo base_url(); ?>admin/index"><i class="la la-home"></i><span class="menu-title" data-i18n="Dashboard"><?php echo $this->lang->line('side-Dashboard'); ?></span></a>
                </li>
                 <!--
                    ////////////////////////////////////////////////////main admin////////////////////////////////////////////////////
                -->
                <?php if($this->session->userdata('admin_type') == 'main_admin') {?>
                <li class=" nav-item"><a href=""><i class="la la-folder-open"></i><span class="menu-title"><?php echo $this->lang->line('side-Categories'); ?></span><span class="badge badge badge-info badge-pill float-right mr-2">2</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="<?php echo base_url(); ?>category/addCat"><i></i><span ><?php echo $this->lang->line('side-Categories-addnew'); ?></span></a>
                        </li>
                        <li><a class="menu-item" href="<?php echo base_url(); ?>category/editCat"><i></i><span ><?php echo $this->lang->line('side-Categories-edit'); ?></span></a>
                        </li>
                    </ul>
                </li>

                <li class=" nav-item"><a href=""><i class="la la-file"></i><span class="menu-title" ><?php echo $this->lang->line('side-subCategories'); ?></span><span class="badge badge badge-info badge-pill float-right mr-2">2</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="<?php echo base_url(); ?>subcategory/addSub"><i></i><span ><?php echo $this->lang->line('side-subCategories-addnew'); ?></span></a>
                        </li>
                        <li><a class="menu-item" href="<?php echo base_url(); ?>subcategory/editSub"><i></i><span ><?php echo $this->lang->line('side-subCategories-edit'); ?></span></a>
                        </li>
                    </ul>
                </li>

                <li class=" nav-item"><a href=""><i class="la la-plus-circle"></i><span class="menu-title" ><?php echo $this->lang->line('side-tags'); ?></span><span class="badge badge badge-info badge-pill float-right mr-2">2</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="<?php echo base_url(); ?>tags/addTag"><i></i><span ><?php echo $this->lang->line('side-tags-addnew'); ?></span></a>
                        </li>
                        <li><a class="menu-item" href="<?php echo base_url(); ?>tags/editTag"><i></i><span ><?php echo $this->lang->line('side-tags-edit'); ?></span></a>
                        </li>
                    </ul>
                </li>

                <li class=" nav-item"><a href=""><i class="la la-globe"></i><span class="menu-title" ><?php echo $this->lang->line('side-news'); ?></span><span class="badge badge badge-info badge-pill float-right mr-2">2</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="<?php echo base_url(); ?>news/addNews"><i></i><span ><?php echo $this->lang->line('side-news-addnew'); ?></span></a>
                        </li>
                        <li><a class="menu-item" href="<?php echo base_url(); ?>news/editNews"><i></i><span ><?php echo $this->lang->line('side-news-edit'); ?></span></a>
                        </li>
                        <li><a class="menu-item" href="<?php echo base_url(); ?>uncategorizeNews/uncategorizeNewsIndex"><i></i><span ><?php echo $this->lang->line('side-uncategorizeNews'); ?></span></a>
                        </li>
                    </ul>
                </li>
 
                <li class=" nav-item"><a href=""><i class="la la-globe"></i><span class="menu-title" ><?php echo $this->lang->line('side-slider'); ?></span><span class="badge badge badge-info badge-pill float-right mr-2">2</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="<?php echo base_url(); ?>slider/addSlider"><i></i><span ><?php echo $this->lang->line('side-slider-add'); ?></span></a>
                        </li>
                        <li><a class="menu-item" href="<?php echo base_url(); ?>slider/editSlider"><i></i><span ><?php echo $this->lang->line('side-slider-edit'); ?></span></a>
                        </li>
                    </ul>
                </li>


                <li class=" nav-item"><a href=""><i class="la la-user-plus"></i><span class="menu-title"><?php echo $this->lang->line('side-Admins'); ?></span><span class="badge badge badge-info badge-pill float-right mr-2">2</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="<?php echo base_url(); ?>admin/addNewAdmin"><i></i><span ><?php echo $this->lang->line('side-Admin-addnew'); ?></span></a>
                        </li>
                        <li><a class="menu-item" href="<?php echo base_url(); ?>admin/allAdmin"><i></i><span > <?php echo $this->lang->line('side-Admin-edit'); ?></span></a>
                        </li>
                    </ul>
                </li>

                <?php }  ?>
                <!--
                    ////////////////////////////////////////////////////Ctegory main admin////////////////////////////////////////////////////
                -->

                <?php if($this->session->userdata('admin_type') === 'catroot') : ?>
                    <li class=" nav-item"><a href=""><i class="la la-folder-open"></i><span class="menu-title"><?php echo $this->lang->line('side-Categories'); ?></span><span class="badge badge badge-info badge-pill float-right mr-2">3</span></a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="<?php echo base_url(); ?>category/addCat"><i></i><span ><?php echo $this->lang->line('side-Categories-addnew'); ?></span></a>
                            </li>
                            <li><a class="menu-item" href="<?php echo base_url(); ?>category/editCat"><i></i><span ><?php echo $this->lang->line('side-Categories-edit'); ?></span></a>
                            </li>
                        </ul>
                    </li>

                    <li class=" nav-item"><a href=""><i class="la la-file"></i><span class="menu-title" ><?php echo $this->lang->line('side-subCategories'); ?></span><span class="badge badge badge-info badge-pill float-right mr-2">2</span></a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="<?php echo base_url(); ?>subcategory/addSub"><i></i><span ><?php echo $this->lang->line('side-subCategories-addnew'); ?></span></a>
                            </li>
                            <li><a class="menu-item" href="<?php echo base_url(); ?>subcategory/editSub"><i></i><span ><?php echo $this->lang->line('side-subCategories-edit'); ?></span></a>
                            </li>
                        </ul>
                   </li>

                   <li class=" nav-item"><a href=""><i class="la la-plus-circle"></i><span class="menu-title" ><?php echo $this->lang->line('side-tags'); ?></span><span class="badge badge badge-info badge-pill float-right mr-2">2</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="<?php echo base_url(); ?>tags/addTag"><i></i><span ><?php echo $this->lang->line('side-tags-addnew'); ?></span></a>
                        </li>
                        <li><a class="menu-item" href="<?php echo base_url(); ?>tags/editTag"><i></i><span ><?php echo $this->lang->line('side-tags-edit'); ?></span></a>
                        </li>
                    </ul>
                </li>

                <li class=" nav-item"><a href=""><i class="la la-globe"></i><span class="menu-title" ><?php echo $this->lang->line('side-news'); ?></span><span class="badge badge badge-info badge-pill float-right mr-2">2</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="<?php echo base_url(); ?>news/addNews"><i></i><span ><?php echo $this->lang->line('side-news-addnew'); ?></span></a>
                        </li>
                        <li><a class="menu-item" href="<?php echo base_url(); ?>news/editNews"><i></i><span ><?php echo $this->lang->line('side-news-edit'); ?></span></a>
                        </li>
                        <li><a class="menu-item" href="<?php echo base_url(); ?>uncategorizeNews/uncategorizeNewsIndex"><i></i><span ><?php echo $this->lang->line('side-uncategorizeNews'); ?></span></a>
                        </li>
                    </ul>
                </li>

                <?php endif ; ?>
                <!--
                    ////////////////////////////////////////////////////end  Ctegory main admin////////////////////////////////////////////////////
                -->
                <!--
                    ////////////////////////////////////////////////////Subcategory main admin////////////////////////////////////////////////////
                -->
                <?php if($this->session->userdata('admin_type') === 'subroot') : ?>
                    
                    <li class=" nav-item"><a href=""><i class="la la-file"></i><span class="menu-title" ><?php echo $this->lang->line('side-subCategories'); ?></span><span class="badge badge badge-info badge-pill float-right mr-2">2</span></a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="<?php echo base_url(); ?>subcategory/addSub"><i></i><span ><?php echo $this->lang->line('side-subCategories-addnew'); ?></span></a>
                            </li>
                            <li><a class="menu-item" href="<?php echo base_url(); ?>subcategory/editSub"><i></i><span ><?php echo $this->lang->line('side-subCategories-edit'); ?></span></a>
                            </li>
                        </ul>
                   </li>

                   <li class=" nav-item"><a href=""><i class="la la-plus-circle"></i><span class="menu-title" ><?php echo $this->lang->line('side-tags'); ?></span><span class="badge badge badge-info badge-pill float-right mr-2">2</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="<?php echo base_url(); ?>tags/addTag"><i></i><span ><?php echo $this->lang->line('side-tags-addnew'); ?></span></a>
                        </li>
                        <li><a class="menu-item" href="<?php echo base_url(); ?>tags/editTag"><i></i><span ><?php echo $this->lang->line('side-tags-edit'); ?></span></a>
                        </li>
                    </ul>
                </li>

                <li class=" nav-item"><a href=""><i class="la la-globe"></i><span class="menu-title" ><?php echo $this->lang->line('side-news'); ?></span><span class="badge badge badge-info badge-pill float-right mr-2">2</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="<?php echo base_url(); ?>news/addNews"><i></i><span ><?php echo $this->lang->line('side-news-addnew'); ?></span></a>
                        </li>
                        <li><a class="menu-item" href="<?php echo base_url(); ?>news/editNews"><i></i><span ><?php echo $this->lang->line('side-news-edit'); ?></span></a>
                        </li>
                    </ul>
                </li>

                <?php endif ; ?>
                <!--
                    ////////////////////////////////////////////////////end Subcategory main admin////////////////////////////////////////////////////
                -->
                <!--
                    ////////////////////////////////////////////////////custome admin////////////////////////////////////////////////////
                -->  
                <?php if($this->session->userdata('admin_type') === 'custom') : ?>
                    <li class=" nav-item"><a href=""><i class="la la-globe"></i><span class="menu-title" ><?php echo $this->lang->line('side-news'); ?></span><span class="badge badge badge-info badge-pill float-right mr-2">2</span></a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="<?php echo base_url(); ?>news/addNews"><i></i><span ><?php echo $this->lang->line('side-news-addnew'); ?></span></a>
                            </li>
                            <li><a class="menu-item" href="<?php echo base_url(); ?>news/editNews"><i></i><span ><?php echo $this->lang->line('side-news-edit'); ?></span></a>
                            </li>
                            <li><a class="menu-item" href="<?php echo base_url(); ?>uncategorizeNews/uncategorizeNewsCustome"><i></i><span ><?php echo $this->lang->line('side-uncategorizeNews'); ?></span></a>
                             </li>
                        </ul>
                    </li>
                <?php endif ; ?>

                <!--
                    ////////////////////////////////////////////////////end custome admin////////////////////////////////////////////////////
                -->  

            </ul>
        </div>
    </div>

    <!-- END: Main Menu-->