<?php
$db = \Config\Database::connect(); ?>
<section class="wrapper bg-gray">
  <div class="container py-3 py-md-5">
    <nav class="d-inline-block" aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="https://connect.elkir.fr">Accueil</a></li>
        <li class="breadcrumb-item" aria-current="page">Projets</li>
        <li class="breadcrumb-item active" aria-current="page">Nouvelle demande</li>
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
            <h2 class="display-6 mb-1">Nouvelle demande</h2>
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
                  </div>
                </div>
            <form method="post" action="<?= base_url('dashboard/sendproject'); ?>">
              <p>A Propos de vous</p>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-floating mb-4">
                    <input type="text" class="form-control" name="prenom">
                    <label>Prénom</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating mb-4">
                    <input type="text" class="form-control" name="nom">
                    <label>Nom</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating mb-4">
                    <input type="number" class="form-control" name="age" min="15" max="100">
                    <label>Âge</label>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-floating mb-4">
                    <input type="text" class="form-control" name="postes">
                    <label>Poste ocucupé</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mb-4">
                      <textarea class="form-control" name="formations" style="height:250px";></textarea>
                    <label>Formations détenues</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mb-4">
                    <textarea class="form-control" name="experiences" style="height:250px";></textarea>
                    <label>Expériences</label>
                  </div>
                </div>
              </div>
                <p>A propos du projet</p>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-floating mb-4">
                      <input type="text" class="form-control" name="project_name">
                      <label>Nom de votre projet</label>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-floating mb-4">
                      <input type="text" class="form-control" name="project_legal">
                      <label>Statut légal votre projet</label>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-floating mb-4">
                      <input type="number" class="form-control" name="project_effectif">
                      <label>Effectif votre projet</label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-floating mb-4">
                      <input type="text" class="form-control" name="project_object">
                      <label>Objet votre projet</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating mb-4">
                        <textarea class="form-control" name="project_description" style="height:250px";></textarea>
                      <label>Description de votre projet</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating mb-4">
                      <textarea class="form-control" name="project_help_elkir" style="height:250px";></textarea>
                      <label>En quoi Elkir peut aider le projet</label>
                    </div>
                  </div>
                </div>
                <button type="submit" name="send_demande" class="btn btn-primary rounded-pill btn-login w-100 mb-2">Envoyer ma demande</button>
              </form>
              </div>
              <!-- /.post-header -->
            </div>
            <!-- /.item -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.grid -->
        <!-- /nav -->
      </div>
      <!-- /column -->
      <?= view('dashboard/__sidebar'); ?>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</section>
<div class="modal fade" id="DeleteElkirConnectModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel">Supprimer le compte ElkirConnect</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        En supprimant le compte ElkirConnect, vous comprenez que vous perdrez toutes vos données.
      </div>
      <div class="modal-footer">
        <a onclick="delete_compte()" style="background-color:#ff0000" class="btn btn-primary rounded-pill btn-login w-100 mb-2" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Valider</a>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel2">Fermeture du compte</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Fermeture du compte effectué avec succès !
      </div>
    </div>
  </div>
</div>
<script>
function update(){
  oData = new FormData();
  oData.append("email", document.getElementById("email").value);
  oData.append("password", document.getElementById("password").value);
  oData.append("password2", document.getElementById("password2").value);

  var oReq = new XMLHttpRequest();
  oReq.open("POST", "<?= base_url(); ?>/api/auth/update", true);
  oReq.onload = function(oEvent) {
    console.log(oReq);
    console.log(oReq.status);
    console.log(oReq.responseText);
    if (oReq.status == 200) {
      document.getElementById("result_ajax").innerHTML = oReq.responseText;
    } else {
      document.getElementById("result_ajax").innerHTML = "<div class='alert alert-danger'>Erreur " + oReq.status+"</div>";
    }
  };
  oReq.send(oData);
}
</script>
<script>
function delete_compte(){
  oData = new FormData();

  var oReq = new XMLHttpRequest();
  oReq.open("POST", "<?= base_url(); ?>/api/auth/delete", true);
  oReq.onload = function(oEvent) {
    console.log(oReq.status);
    window.location.href = "<?= base_url('register'); ?>";
  };
  oReq.send(oData);
}
</script>
