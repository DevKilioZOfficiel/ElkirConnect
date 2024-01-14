<?php
$db = \Config\Database::connect(); ?>
<section class="wrapper bg-gray">
  <div class="container py-3 py-md-5">
    <nav class="d-inline-block" aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="https://connect.elkir.fr">Accueil</a></li>
        <li class="breadcrumb-item" aria-current="page">Projets</li>
        <li class="breadcrumb-item" aria-current="page">Paramètres</li>
        <li class="breadcrumb-item active" aria-current="page"><?= $info_project['name']; ?></li>
      </ol>
    </nav>
    <!-- /nav -->
  </div>
  <!-- /.container -->
</section>
<!-- /section -->
<section class="wrapper bg-light">
  <div class="container pb-14 pb-md-16 pt-12">
    <div class="row gy-10">
      <div class="col-lg-9 order-lg-2">
        <div class="row align-items-center mb-10 position-relative zindex-1">
          <div class="col-md-7 col-xl-8 pe-xl-20">
            <h2 class="display-6 mb-1"><?= $info_project['name']; ?></h2>
          </div>
          <!--/column -->
          <!--/column -->
        </div>
        <!--/.row -->
        <div class="grid grid-view projects-masonry shop mb-13">
          <div class="row gx-md-8 gy-10 gy-md-13 isotope">
            <div class="project item">
              <div class="post-header">
                <div class="row d-flex justify-content-center">
                  <div class="col-xl-12 col-lg-12 col-md-12">
                    <?php if(isset($_POST['edit'])){
                      if($info_project['description'] != $request->GetPost('description')){
                        $builder = $db->table('projects');
                        $builder->set('description', strip_tags($sessionmodel->paragrapher($request->getPost('description')),"<br><br /><b>"));
                        $builder->where('id', $info_project['id']);
                        $builder->update();
                        ?>
                        <div class="alert alert-success">Modification de la description avec succès</div>
                        <?php
                      }
                      if($info_project['slug'] != $request->GetPost('slug')){
                        $builder = $db->table('projects');
                        $builder->set('slug', url_title( strip_tags($request->getPost('slug')), '-', true));
                        $builder->where('id', $info_project['id']);
                        $builder->update();
                        ?>
                        <div class="alert alert-success">Modification du lien personnalisé avec succès</div>
                        <script>window.location.href = "<?= base_url('project/'.url_title( strip_tags($request->getPost('slug')), '-', true).'/settings'); ?>";</script>
                        <?php
                      }
                      if($info_project['published'] != $request->GetPost('published')){
                        if($request->GetPost('published') == "on"){
                          $published = 1;
                        }else{
                          $published = 0;
                        }
                        $builder = $db->table('projects');
                        $builder->set('published', $published);
                        $builder->where('id', $info_project['id']);
                        $builder->update();
                        ?>
                        <div class="alert alert-success">Modification de la publication du projet avec succès</div>
                        <?php
                      }
                    } ?>
                    <?php if (session()->has('error')) :
                      echo "<div class='alert alert-danger'>".session('error')."</div>";
                    endif ?>
                    <?php if (session()->has('errors')) : ?>
                        <?php foreach (session('errors') as $error) : ?>
                          <div class='alert alert-danger'><?= $error ?></div>
                        <?php endforeach ?>
                    <?php endif ?>
                    <?php if (session()->has('success')) :
                      echo "<div class='alert alert-success'>".session('success')."</div>";
                    endif ?>
                    <?php if(isset($_POST['add_staff'])) :
                      $staffs = $request->GetPost('emails');
                      $builder = $db->table('user');
                      $query = $builder->get();
                      foreach ($query->getResult() as $key => $value_user) {
                        if(str_contains($staffs,$value_user->email)){
                          $builder = $db->table('projects__access');
                          $builder->where('user', $value_user->id);
                          $builder->where('project_id', $info_project['id']);
                          $verification_staff = $builder->countAllResults();
                          if($verification_staff == 0){
                            $builder = $db->table('projects__access');
                  				  $data = [
                  				  	'user' => $value_user->id,
                  				  	'project_id' => $info_project['id']
                  				  ];
                  				  $builder->insert($data);
                            echo "<div class='alert alert-success'>".$value_user->email." à désormais accès au projet</div>";
                          }else{
                            echo "<div class='alert alert-danger'>".$value_user->email." a déjà accès au projet.</div>";
                          }
                        }
                      }
                    endif ?>
                    <?php
                    $builder = $db->table('projects__access');
                    $builder->where('project_id', $info_project['id']);
                    $query = $builder->get();
                    foreach ($query->getResult() as $key => $value) {
                      if(isset($_POST['delete_'.$value->id])){
                        $builder = $db->table('user');
                        $builder->where('id',$value->user);
                        $query = $builder->get();
                        foreach ($query->getResult() as $key => $value_user) {
                          $builder = $db->table('projects__access');
                          $builder->where('user', $value_user->id);
                          $builder->delete();
                          echo "<div class='alert alert-success'>".$value_user->email." est désormais retiré du projet.</div>";
                        }
                      }
                    } ?>
                  </div>
                </div>

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Paramètres généraux</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-logo-tab" data-bs-toggle="pill" data-bs-target="#pills-logo" type="button" role="tab" aria-controls="pills-logo" aria-selected="false">Logo</button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-access-tab" data-bs-toggle="pill" data-bs-target="#pills-access" type="button" role="tab" aria-controls="pills-access" aria-selected="false" <?php if($user['id'] != $info_project['user']){ ?>disabled<?php } ?>>Accès</button>
                  </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                    <form method="post">
                      <div class="col-md-12">
                        <div class="form-floating mb-4">
                            <textarea class="form-control" name="description" style="height:250px";><?= $info_project['description']; ?></textarea>
                          <label>Description</label>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="mb-4">
                          <label>Lien personnalisé</label>
                            <div class="input-group mb-3">
                              <span class="input-group-text" id="basic-addon3">https://elkir.fr/projets/</span>
                              <input type="text" class="form-control" name="slug" value="<?= $info_project['slug']; ?>">
                            </div>
                        </div>
                      </div>
                      <?php if($info_project['published'] == 0){
                        $checked = "";
                      }else{
                        $checked = "checked";
                      } ?>
                      <div class="col-md-12">
                        <div class="mb-4">
                            <div class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" role="switch" name="published" <?= $checked; ?>>
                              <label class="form-check-label" for="flexSwitchCheckChecked">Publier le projet</label>
                            </div>
                        </div>
                      </div>

                      <button type="submit" name="edit" class="btn btn-primary rounded-pill btn-login w-100 mb-2">Modifier</button>
                    </form>
                  </div>
                  <div class="tab-pane fade" id="pills-logo" role="tabpanel" aria-labelledby="pills-logo-tab" tabindex="0">
                    <div class="post-header">
                    <form method="POST" action="<?= base_url('import/'.$info_project['slug'].''); ?>" enctype="multipart/form-data">
                      <div class="card" onclick="document.getElementById('userlogo').click();" style="margin-bottom: 25px;">
                        <div class="row g-0">
                          <div class="col-md-4">
                            <img src="<?= $info_project['icone']; ?>" height="200" width="200">
                          </div>
                          <div class="col-md-8">
                            <div class="card-body">
                              <h5 class="card-title">Changer de logo</h5>
                              <p class="card-text">Taille recommandé: 500x500</p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <input style="display: none;" name="avatar" type="file" class="custom-file-input" id="userlogo" accept="image/webp,image/png,image/jpg,image/jpeg">
                      <button type="submit" name="send_logo" class="btn btn-primary rounded-pill btn-login w-100 mb-2">Modifier le logo</button>
                    </form>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="pills-access" role="tabpanel" aria-labelledby="pills-access-tab" tabindex="0">
                    <div class="post-header">
                      <div class="table-responsive">
                        <?php if($user['id'] === $info_project['user']){ ?>
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Utilisateur</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody class="table-group-divider">
                            <?php
                            $builder = $db->table('projects__access');
                            $builder->where('project_id', $info_project['id']);
                            $query = $builder->get();
                            foreach ($query->getResult() as $key => $value) { ?>
                            <tr>
                              <th scope="row"><?= $key+1; ?></th>
                              <?php
                              $builder = $db->table('user');
                              $builder->where('id', $value->user);
                              $query = $builder->get();
                              foreach ($query->getResult() as $key => $value_user) { ?>
                              <td><?= $value_user->username; ?></td>
                            <?php } ?>
                              <form method="post">
                                <td><button type="submit" name="delete_<?= $value->id; ?>" class="btn btn-danger rounded-pill mb-2">Supprimer</button></td>
                              </form>
                            </tr>
                            <?php } ?>
                            <tr>
                              <form method="POST">
                              <th scope="row"></th>
                              <td>
                                <div class="form-floating mb-4">
                                  <input class="form-control" type="text" id="emails" name="emails" placeholder="user1@exemple.fr,user2@exemple.fr">
                                  <label>Emails des utilisateurs à ajouter séparé d'une virgule</label>
                                </div>
                              </td>
                              <td><button type="submit" name="add_staff" class="btn btn-primary rounded-pill mb-2">Ajouter</button></td>
                            </form>
                            </tr>
                          </tbody>
                        </table>

                      <?php }else{ ?>
                        <div class="col-md-12">
                          <div class="alert alert-danger">Vous n'avez pas accès a cet partie du projet. Seul l'administrateur peut gérer les accès.</div>
                        </div>
                      <?php } ?>

                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.item -->
              </div>
          <!-- /.row -->
          </div>
          <!-- /.grid -->
        </div>
          <!-- /nav -->
      </div>
      <!-- /column -->
    </div>
      <?= view('dashboard/__sidebar'); ?>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</section>
