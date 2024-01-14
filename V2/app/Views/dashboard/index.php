<?php
$db = \Config\Database::connect(); ?>
<section class="wrapper bg-gray">
  <div class="container py-3 py-md-5">
    <nav class="d-inline-block" aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="https://connect.elkir.fr">Accueil</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profil</li>
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
            <h2 class="display-6 mb-1">Mon profil</h2>
          </div>
          <!--/column -->
          <!--/column -->
        </div>
        <!--/.row -->
        <div class="grid grid-view projects-masonry shop mb-13">
          <div class="row gx-md-8 gy-10 gy-md-13 isotope">
            <div class="project item">
              <div class="post-header">
                <div class="d-flex flex-row align-items-center justify-content-between mb-2">
                  <div id="result_ajax"></div>
                </div>

              <p>Modifier le mot de passe</p>
              <div class="form-floating password-field mb-4">
                <input type="password" class="form-control" placeholder="Nouveau mot de passe" id="password">
                <span class="password-toggle"><i class="uil uil-eye"></i></span>
                <label for="loginPassword">Nouveau mot de passe</label>
              </div>
              <div class="form-floating password-field mb-4">
                <input type="password" class="form-control" placeholder="Confirmer le nouveau mot de passe" id="password2">
                <span class="password-toggle"><i class="uil uil-eye"></i></span>
                <label for="loginPassword">Confirmer le nouveau mot de passe</label>
              </div>
                <p>Modifier l'e-mail</p>
                <div class="form-floating mb-4">
                  <input type="email" class="form-control" placeholder="Email" value="<?= $user['email']; ?>" id="email">
                  <label for="loginEmail">Email</label>
                </div>
                <a class="btn btn-primary rounded-pill btn-login w-100 mb-2" onclick="update()">Modifier les informations du compte</a>

                <a style="background-color:#ff0000" class="btn btn-primary rounded-pill btn-login w-100 mb-2" data-bs-toggle="modal" href="#DeleteElkirConnectModalToggle" role="button">Supprimer le compte</a>
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
