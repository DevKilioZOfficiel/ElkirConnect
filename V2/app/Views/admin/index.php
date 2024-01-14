<?php $db = \Config\Database::connect(); ?>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">ELKIRCONNECT</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">

                    <?= view('admin/__admin_info'); ?>

                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="clearfix">
                                <h4 class="card-title mb-4">Statistique</h4>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="text-muted">
                                        <div class="mb-4">
                                            <p>Ce mois</p>
                                            <h4><span class="badge badge-soft-success font-size-12 me-1"><?= $sessionmodel->count_projects(date('Y'),date('m')); ?></span> demandes</h4>
                                        </div>

                                        <div class="mt-4">
                                            <p class="mb-2">Le mois dernier</p>
                                            <?php if(date('m') == "01"){
                                              $month = "12";
                                              $year = date('Y')-1;
                                            }elseif(date('m') <= "10"){
                                              $month = "0".date('m')-1;
                                              $year = date('Y');
                                            }else{
                                              $month = date('m')-1;
                                              $year = date('Y');
                                            } ?>
                                            <h4><span class="badge badge-soft-success font-size-12 me-1"><?= $sessionmodel->count_projects($year,$month); ?></span> demandes</h4>
                                        </div>
                                        <?php $current_year = $sessionmodel->count_projects(date('Y'),"01")+$sessionmodel->count_projects(date('Y'),"02")+$sessionmodel->count_projects(date('Y'),"03")+$sessionmodel->count_projects(date('Y'),"04")+
                                        $sessionmodel->count_projects(date('Y'),"05")+$sessionmodel->count_projects(date('Y'),"06")+$sessionmodel->count_projects(date('Y'),"07")+$sessionmodel->count_projects(date('Y'),"08")+
                                        $sessionmodel->count_projects(date('Y'),"09")+$sessionmodel->count_projects(date('Y'),"10")+$sessionmodel->count_projects(date('Y'),"11")+$sessionmodel->count_projects(date('Y'),"12"); ?>
                                        <div class="mt-4">
                                            <p class="mb-2">Cette année</p>
                                            <h4><span class="badge badge-soft-success font-size-12 me-1"><?= $current_year; ?></span> demandes</h4>
                                        </div>
                                        <?php $last_year = $sessionmodel->count_projects(date('Y')-1,"01")+$sessionmodel->count_projects(date('Y')-1,"02")+$sessionmodel->count_projects(date('Y')-1,"03")+$sessionmodel->count_projects(date('Y')-1,"04")+
                                        $sessionmodel->count_projects(date('Y')-1,"05")+$sessionmodel->count_projects(date('Y')-1,"06")+$sessionmodel->count_projects(date('Y')-1,"07")+$sessionmodel->count_projects(date('Y')-1,"08")+
                                        $sessionmodel->count_projects(date('Y')-1,"09")+$sessionmodel->count_projects(date('Y')-1,"10")+$sessionmodel->count_projects(date('Y')-1,"11")+$sessionmodel->count_projects(date('Y')-1,"12"); ?>
                                        <div class="mt-4">
                                            <p class="mb-2">L'an dernier</p>
                                            <h4><span class="badge badge-soft-success font-size-12 me-1"><?= $last_year; ?></span> demandes</h4>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-8">
                                    <div id="elkir-chart" class="apex-charts" data-colors='["--bs-primary"]' dir="ltr"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">

                      <?= view('admin/__projects'); ?>
                </div>

            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
