<?php $db = \Config\Database::connect();
$sessionmodel = new \App\Models\SessionModel(); ?>
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
                <div class="col-xl-6">
                  <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Informations générales de l'utilisateur</h4>
                        <div class="row">
                        <div class="col-md-4">
                          <div class="form-floating mb-4">
                            <input type="text" class="form-control" name="prenom" value="<?= $info_project['user_prenom']; ?>" readonly>
                            <label>Prénom</label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-floating mb-4">
                            <input type="text" class="form-control" name="nom" value="<?= $info_project['user_nom']; ?>" readonly>
                            <label>Nom</label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-floating mb-4">
                            <input type="number" class="form-control" name="age" min="15" max="100" value="<?= $info_project['user_age']; ?>" readonly>
                            <label>Âge</label>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-floating mb-4">
                            <input type="text" class="form-control" name="postes" value="<?= $info_project['user_poste']; ?>" readonly>
                            <label>Poste ocucupé</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-floating mb-4">
                              <textarea class="form-control" name="formations" style="height:250px" readonly><?= $info_project['user_formations']; ?></textarea>
                            <label>Formations détenues</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-floating mb-4">
                            <textarea class="form-control" name="experiences" style="height:250px" readonly><?= $info_project['user_experiences']; ?></textarea>
                            <label>Expériences</label>
                          </div>
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-6">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Informations du projet <?= $info_project['name']; ?></h4>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-floating mb-4">
                              <input type="text" class="form-control" name="project_name" value="<?= $info_project['name']; ?>" readonly>
                              <label>Nom de votre projet</label>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-floating mb-4">
                              <input type="text" class="form-control" name="project_legal" value="<?= $info_project['projet_legal_status']; ?>" readonly>
                              <label>Statut légal votre projet</label>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-floating mb-4">
                              <input type="number" class="form-control" name="project_effectif" value="<?= $info_project['projet_membres']; ?>" readonly>
                              <label>Effectif votre projet</label>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-floating mb-4">
                              <input type="text" class="form-control" name="project_object" value="<?= $info_project['projet_objet']; ?>" readonly>
                              <label>Objet votre projet</label>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-floating mb-4">
                                <textarea class="form-control" name="project_description" style="height:250px" readonly><?= $info_project['description']; ?></textarea>
                              <label>Description de votre projet</label>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-floating mb-4">
                              <textarea class="form-control" name="project_help_elkir" style="height:250px" readonly><?= $info_project['projet_elkir']; ?></textarea>
                              <label>En quoi Elkir peut aider le projet</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
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
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">Administratif</h4>
                              <form method="POST">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-floating mb-4">
                                    <label>Référant du projet</label>
                                    <select class="form-control" name="referent_id">
                                      <?php $builder = $db->table('user');
                                      $query = $builder->get();
                                      foreach ($query->getResult() as $key => $value) { ?>
                                        <?php $staff_permission = $sessionmodel->permission($value->grade); ?>
                                        <?php if($staff_permission['admin'] == "1"){ ?>
                                          <option value="<?= $value->id; ?>" <?php if($info_project['referent_id'] == $value->id){ ?>selected<?php } ?>><?= $value->username; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-floating mb-4">
                                    <textarea class="form-control" name="note"><?= $info_project['note']; ?></textarea>
                                    <label>Note</label>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <button type="submit" name="valide" class="btn btn-success" style="width:100%;">Valider</button>
                                </div>
                                <div class="col-md-6">
                                  <button type="submit" name="refus" class="btn btn-danger" style="width:100%;">Refuser</button>
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
