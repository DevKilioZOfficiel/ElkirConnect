<?php
$db = \Config\Database::connect();
$request = \Config\Services::request(); ?>
<!-- /header -->
<section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-light-600 text-white" data-image-src="./assets/img/photos/bg18.png">
  <div class="container pt-17 pb-20 pt-md-19 pb-md-21 text-center">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <h1 class="display-1 mb-3">Connexion</h1>
        <nav class="d-inline-block" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Elkir Connect</a></li>
            <li class="breadcrumb-item active" aria-current="page">Connexion</li>
          </ol>
        </nav>
        <!-- /nav -->
      </div>
      <!-- /column -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</section>
<!-- /section -->
<section class="wrapper bg-light">
  <div class="container pb-14 pb-md-16">
    <div class="row">
      <div class="col-lg-7 col-xl-6 col-xxl-5 mx-auto mt-n20">
        <div class="card">
          <div class="card-body p-11 text-center">
            <h2 class="mb-3 text-start">Connexion à ElkirConnect</h2>
            <p class="lead mb-6 text-start">Connectez-vous à votre espace ElkirConnect.</p>
            <div class="row d-flex justify-content-center">
              <div class="col-xl-12 col-lg-12 col-md-12">
                <div id="result_ajax"></div>
              </div>
            </div>
            <form class="text-start mb-3">
              <div class="form-floating mb-4">
                <input type="email" class="form-control" placeholder="Entrez votre email" id="email">
                <label for="pseudo">Email</label>
              </div>
              <div class="form-floating password-field mb-4">
                <input type="password" class="form-control" placeholder="Entrez votre mot de passe" id="password">
                <span class="password-toggle"><i class="uil uil-eye"></i></span>
                <label for="password">Mot de passe</label>
              </div>
              <a class="btn btn-primary rounded-pill btn-login w-100 mb-2" onclick="login()">Connexion</a>
            </form>
            <!-- /form -->
            <p class="mb-0">Vous ne disposez pas de compte? <a href="<?= base_url('register'); ?>" class="hover">Inscrivez-vous</a></p>
            <!--/.social -->
          </div>
          <!--/.card-body -->
        </div>
        <!--/.card -->
      </div>
      <!-- /column -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</section>
<script>
function login(){
  oData = new FormData();
  oData.append("pseudo", document.getElementById("email").value);
  oData.append("password", document.getElementById("password").value);

  var oReq = new XMLHttpRequest();
  oReq.open("POST", "<?= base_url(); ?>/api/auth/login", true);
  oReq.onload = function(oEvent) {
    console.log(oReq);
    console.log(oReq.status);
    console.log(oReq.responseText);
    if (oReq.status == 200) {
      if(oReq.responseText === "<div class='alert alert-success'>Connexion réussie</div>"){
        document.getElementById("result_ajax").innerHTML = oReq.responseText;
        window.location.href = "<?= base_url('dashboard'); ?>";
      }else{
        document.getElementById("result_ajax").innerHTML = oReq.responseText;
      }
    } else {
      document.getElementById("result_ajax").innerHTML = "<div class='alert alert-danger'>Erreur " + oReq.status+"</div>";
    }
  };
  oReq.send(oData);
  }
</script>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Mot de passe oublié ?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="POST" action="<?= base_url(); ?>/forgot_post">
            <div class="modal-body">
              <input type="email" name="devtime__email_forgot" class="form-control" placeholder="Email">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
          </form>
        </div>
      </div>
    </div>
