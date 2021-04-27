<!-- BEGIN: Content-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/all.min.js" integrity="sha512-UwcC/iaz5ziHX7V6LjSKaXgCuRRqbTp1QHpbOJ4l1nw2/boCfZ2KlFIqBUA/uRVF0onbREnY9do8rM/uT/ilqw==" crossorigin="anonymous"></script>
<div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Revenue, Hit Rate & Deals -->
                <div class="row">
                    <div class="col-xl-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?php echo $this->lang->line('index-News_Counter'); ?></h4> 
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body pt-0">
                                    <div class="row mb-1">
                                        <div class="col-6 col-md-4">
                                            <h5><?php echo $this->lang->line('index-Current_News'); ?></h5>
                                            <h2 class="danger"><?php echo $newscount ; ?></h2>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <h5><?php echo $this->lang->line('index-Current_Categories'); ?></h5>
                                            <h2 class="text-danger"><?php echo $categorycount ;?></h2>
                                        </div>
                                    </div>
                                    <div class="chartjs">
                                    
                                    <i class="far fa-8x fa-newspaper"style="color:#6B6F82"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-12">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="card pull-up">
                                    <div class="card-header bg-hexagons">
                                        <h4 class="card-title"><?php echo $this->lang->line('index-time-today'); ?><span class="danger">
                                        <?php
                                            date_default_timezone_set('Asia/Baghdad');
                                            echo date("H:i:s");
                                        ?>
                                        </span></h4>
                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-content collapse show bg-hexagons">
                                        <div class="card-body pt-0">
                                            <div class="chartjs">
                                            <i class="fas fa-4x fa-globe-asia" style="color:#e13c3c;"></i>
                                            <i class="far fa-4x fa-clock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="card pull-up">
                                    <div class="card-content collapse show bg-gradient-directional-danger ">
                                        <div class="card-body bg-hexagons-danger">
                                            <h4 class="card-title white"><?php echo $this->session->userdata['admin_username'];?> <span class="float-right"><span class="white"><?php echo date('Y-m-d') ; ?></span></span>
                                            </h4>
                                            <div class="chartjs">
                                            <i class="fas fa-user-tie fa-4x"  style="color:white;"></i>
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="card pull-up">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-left">
                                                    <h6 class="text-muted"><?php echo $this->lang->line('index-total-SubCategories'); ?></h6>
                                                    <h3><?php echo $subcategorycount ; ?></h3>
                                                </div>
                                                <div class="align-self-center">
                                                    <i class="icon-trophy success font-large-2 float-right"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="card pull-up">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-left">
                                                    <h6 class="text-muted"><?php echo $this->lang->line('index-total-tags'); ?></h6>
                                                    <h3><?php echo $tagscount ; ?></h3>
                                                </div>
                                                <div class="align-self-center">
                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Revenue, Hit Rate & Deals -->

                <!-- Emails Products & Avg Deals -->
                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?php echo $this->lang->line('index-latest-news'); ?></h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body pt-0">
                                    
                                     <?php foreach($lastnews as $last) : ?>
                                    
                                        <p class="text-danger"><?php echo $last['post_title'] ; ?></p>
                                    
                                     <?php endforeach ; ?>
                                     
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?php echo $this->lang->line('index-top-category'); ?></h4>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                       
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <tbody>
                                            <?php foreach($lastcategory as $category) : ?>
                                                <tr>
                                                
                                                <th scope="row" class="border-top-0"><?php echo $category['term_title'];?></th>
                                                
                                                </tr>
                                            <?php endforeach ;?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-center"><?php echo $this->lang->line('index-news-Status'); ?></h4>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-md-6 col-12 border-right-blue-grey border-right-lighten-5 text-center">
                                            <h6 class="danger text-bold-600"><?php echo $this->lang->line('index-status-draft'); ?></h6>
                                            <h4 class="font-large-2 text-bold-400"><?php echo $draft ;?></h4>
                                            
                                        </div>
                                        <div class="col-md-6 col-12 text-center">
                                            <h6 class="success text-bold-600"><?php echo $this->lang->line('index-status-publish'); ?></h6>
                                            <h4 class="font-large-2 text-bold-400"><?php echo $published ;?></h4>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

            </div>
        </div>
    </div>
    <!-- END: Content-->
