<?php $db = \Config\Database::connect(); ?>
<?php
function json_validator($data) {
        if (!empty($data)) {
            return is_string($data) &&
              is_array(json_decode($data, true)) ? true : false;
        }
        return false;
} ?>
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
                  <?php if(isset($_POST['edit'])){ ?>
                    <?php if(json_validator($request->getPost('code')) == 1){
                    $myfile = fopen("affilie.json", "w") or die("Unable to open file!");
                    $txt = $request->getPost('code');
                    fwrite($myfile, stripslashes($txt));
                    fclose($myfile);
                    chmod("affilie.json", 0777);

                    ?>
                    <div class="alert alert-success">Modification avec succès du code</div>
                  <?php }else{ ?>
                  <div class="alert alert-danger">Le code JSON n'est pas valide.</div>
                  <?php } ?>
                <?php } ?>
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title mb-4">Affilie.json</h4>
                      <form method="POST">
                      <div class="col-md-12">
                        <div class="form-floating mb-4">
                          <label>affilie.json</label>
                          <?php $json = file_get_contents('https://connect.elkir.fr/affilie.json'); ?>
                          <textarea class="form-control" name="code" style="height:50vh;"><?= $json; ?></textarea>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <button name="edit" type="submit" class="btn btn-success">Modifier</button>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
