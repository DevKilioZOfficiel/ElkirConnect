<?php
$db = \Config\Database::connect();
$request = \Config\Services::request(); ?>
<?php
$db = \Config\Database::connect();
$request = \Config\Services::request(); ?>
<!-- /header -->
<section class="wrapper image-wrapper bg-image bg-overlay bg-overlay-light-600 text-white" data-image-src="./assets/img/photos/bg18.png">
  <div class="container pt-17 pb-20 pt-md-19 pb-md-21 text-center">
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <h1 class="display-1 mb-3">Inscription</h1>
        <nav class="d-inline-block" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Elkir Connect</a></li>
            <li class="breadcrumb-item active" aria-current="page">Inscription</li>
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
            <h2 class="mb-3 text-start">Inscription à ElkirConnect</h2>
            <p class="lead mb-6 text-start">Inscrivez-vous a ElkirConnect.</p>
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
            <form method="POST" action="<?= base_url('register_post'); ?>" class="text-start mb-3">
              <div class="form-floating mb-4">
                <input type="text" name="pseudo" class="form-control" placeholder="Entrez votre pseudo" id="pseudo">
                <label for="pseudo">Pseudo</label>
              </div>
              <div class="form-floating mb-4">
                <input type="email" name="email" class="form-control" placeholder="Entrez votre email" id="email">
                <label for="email">Email</label>
              </div>
              <div class="form-floating password-field mb-4">
                <input type="password" name="password" class="form-control" placeholder="Entrez votre mot de passe" id="password">
                <span class="password-toggle"><i class="uil uil-eye"></i></span>
                <label for="password">Mot de passe</label>
              </div>
              <div class="form-floating password-field mb-4">
                <input type="password"  name="password2" class="form-control" placeholder="Confirmez votre mot de passe" id="password2">
                <span class="password-toggle"><i class="uil uil-eye"></i></span>
                <label for="password2">Confirmation du mot de passe</label>
              </div>
              <div class="mb-4 form-check">
                <input type="checkbox" name="condition" class="form-check-input" id="html">
                <label for="html">J'accepte les conditions et la politique</label>
              </div>
              <button class="btn btn-primary rounded-pill btn-login w-100 mb-2" type="submit">Inscription</button>
            </form>
            <!-- /form -->
            <p class="mb-0">Vous disposez d'un compte? <a href="<?= base_url('login'); ?>" class="hover">Connectez-vous</a></p>
            <div class="form-poicy-area">
               <p>En cliquant sur "S'inscrire", vous acceptez les <a href="#" class="hover">Termes et conditions</a> ainsi que la <a href="#" class="hover">Politique de confidentialité d'ElkirConnect.</a></p>
            </div>
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
function register(){
  oData = new FormData();
  oData.append("pseudo", document.getElementById("pseudo").value);
  oData.append("password", document.getElementById("password").value);
  oData.append("password2", document.getElementById("password2").value);
  oData.append("email", document.getElementById("email").value);
  oData.append("conditions", document.getElementById("html").checked);

  var oReq = new XMLHttpRequest();
  oReq.open("POST", "<?= base_url(); ?>/api/auth/register", true);
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
