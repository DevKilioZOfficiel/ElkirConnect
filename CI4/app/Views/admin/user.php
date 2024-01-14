<?php $db = \Config\Database::connect();
$sessionmodel = new \App\Models\SessionModel(); ?>
<?php if($permissions['PERM__EDIT_USERS'] != 1){
return redirect()->to(base_url('/admin'));
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
                <div class="col-md-12">
                  <?php if(isset($_POST['valide'])){
                    $builder = $db->table('projects');
                    $builder->set('note', strip_tags($sessionmodel->paragrapher($request->getPost('note')),"<br><br /><b>"));
                    $builder->set('status', 1);
                    $builder->set('referent_id', $request->getPost('referent_id'));
                    $builder->where('id', $info_project['id']);
                    $builder->update();
                    echo '<div class="alert alert-primary">Validation du projet avec succès de la demande</div>';
                  } ?>
                  <?php if(isset($_POST['refus'])){
                    $builder = $db->table('projects');
                    $builder->set('note', strip_tags($sessionmodel->paragrapher($request->getPost('note')),"<br><br /><b>"));
                    $builder->set('status', 2);
                    $builder->set('referent_id', $request->getPost('referent_id'));
                    $builder->where('id', $info_project['id']);
                    $builder->update();
                    echo '<div class="alert alert-primary">Refus du projet avec succès de la demande</div>';
                  } ?>
                </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                    <?php if(isset($_POST['update'])){
                      $builder = $db->table('user');
                      $builder->set('email', strip_tags($request->getPost('email')));
                      $builder->set('username', strip_tags($request->getPost('username')));
                      $builder->set('grade', strip_tags($request->getPost('grade')));
                      $builder->where('id', $info_user['id']);
                      $builder->update();
                      echo '<div class="alert alert-primary">Modification de l\'utilisateur avec succès</div>';
                    } ?>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">Utilisateur</h4>
                          <form method="POST">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-floating mb-4">
                                <label>Pseudo</label>
                                <input class="form-control" name="username" type="text" value="<?= $info_user['username']; ?>">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-floating mb-4">
                                <label>Email</label>
                                <input class="form-control" name="email" type="email" value="<?= $info_user['email']; ?>">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-floating mb-4">
                                <label>Permissions</label>
                                <select class="form-control" name="grade">
                                  <?php $builder = $db->table('permissions');
                                  $query = $builder->get();
                                  foreach ($query->getResult() as $key => $value) { ?>
                                      <option value="<?= $value->id_grade; ?>" <?php if($info_user['grade'] == $value->id_grade){ ?>selected<?php } ?>><?= $value->nom; ?></option>
                                <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <button type="submit" name="update" class="btn btn-success" style="width:100%;">Mettre à jour</button>
                            </div>
                          </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
    </div>
</div>
<!-- End Page-content -->
