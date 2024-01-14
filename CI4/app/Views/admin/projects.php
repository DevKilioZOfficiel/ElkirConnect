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
                <div class="col-xl-12">
                    <?= view('admin/__projects'); ?>
                </div>

            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
