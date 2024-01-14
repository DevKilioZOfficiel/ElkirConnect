<?php ini_set('memory_limit', '-1'); ?>
<?php
$db = \Config\Database::connect();
$request = \Config\Services::request(); ?>
<!DOCTYPE html>
<html lang="fr">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= view('layouts/head'); ?>
  </head>
  <body>
    <div class="content-wrapper">
      <script data-host="https://analytics.elkir.fr" data-dnt="false" src="https://analytics.elkir.fr/js/script.js" id="ZwSg9rf6GA" async defer></script>

      <header class="wrapper bg-light">
        <nav class="navbar navbar-expand-lg classic transparent navbar-light">
          <div class="container flex-lg-row flex-nowrap align-items-center">
            <div class="navbar-brand w-100">
              <a href="https://elkir.fr">
                <img src="https://cdn.elkir.fr/assets/img/logo-dark.png" srcset="https://cdn.elkir.fr/assets/img/logo-dark.png" alt="" />
              </a>
            </div>
            <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
              <div class="offcanvas-header d-lg-none">
                <h3 class="text-white fs-30 mb-0">Association Elkir</h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
                <ul class="navbar-nav">
                  <li class="nav-item dropdown">
                    <a class="nav-link" href="/">Accueil</a>
                  </li>

                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Créateurs</a>
                    <ul class="dropdown-menu">
                      <li class="nav-item"><a class="dropdown-item" href="/nos-createurs">Nos créateurs</a></li>
                      <li class="nav-item"><a class="dropdown-item" href="/devenir-createur">Devenir créateur</a></li>
                      <li class="nav-item"><a class="dropdown-item" href="/ElkirTools">ElkirTools</a></li>
                    </ul>
                  </li>

                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Communauté</a>
                    <ul class="dropdown-menu">
                      <li class="nav-item"><a class="dropdown-item" href="https://discord.gg/elkir" target="_blank">Serveur Discord</a></li>
                      <li class="nav-item"><a class="dropdown-item" href="https://shop.elkir.fr/" target="_blank">Boutique</a></li>
                      <li class="nav-item"><a class="dropdown-item" href="https://tiltify.com/elkir" target="_blank">Page Tiltify</a></li>
                      <li class="nav-item"><a class="dropdown-item" href="/events">Évènements</a></li>
                      <li class="nav-item"><a class="dropdown-item" href="https://status.elkir.fr/" target="_blank">Page de statut</a></li>
                    </ul>
                  </li>

                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">L'association</a>
                    <ul class="dropdown-menu">
                      <li class="nav-item"><a class="dropdown-item" href="/nos-benevoles">Notre équipe</a></li>
                      <li class="nav-item"><a class="dropdown-item" href="/devenir-benevole">Devenir bénévole</a></li>
                      <li class="dropdown dropdown-submenu dropend"><a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Nos partenaires</a>
                        <ul class="dropdown-menu">
                          <li class="nav-item"><a class="dropdown-item" href="/nos-partenaires">Officiel</a></li>
                          <li class="nav-item"><a class="dropdown-item" href="/nos-partenaires-streamers">Streamer</a></li>
                        </ul>
                      </li>
                      <li class="dropdown dropdown-submenu dropend"><a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Devenir partenaire</a>
                        <ul class="dropdown-menu">
                          <li class="nav-item"><a class="dropdown-item" href="/devenir-partenaire-officiel">Officiel</a></li>
                        </ul>
                      </li>
                      <li class="dropdown dropdown-submenu dropend"><a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">Liens utiles</a>
                        <ul class="dropdown-menu">
                          <li class="nav-item"><a class="dropdown-item" href="/espace-presse">Espace Presse</a></li>
                        </ul>
                      </li>
                      <li class="nav-item"><a class="dropdown-item" href="https://support.elkir.fr" target="_blank">Nous contacter</a></li>
                      <li class="nav-item"><a class="dropdown-item" href="/nos-interviews">Nos interviews</a></li>
                    </ul>
                  </li>
                </ul>
                <!-- /.navbar-nav -->
                <div class="offcanvas-footer d-lg-none">
                  <div>
                    <a href="mailto:hello@elkir.fr" class="link-inverse">hello@elkir.fr</a>
                    <nav class="nav social social-white mt-4">
                      <a href="https://twitter.com/AssoElkir"><i class="uil uil-twitter"></i></a>
                      <a href="https://www.facebook.com/AssoElkir/"><i class="uil uil-facebook-f"></i></a>
                      <a href="https://www.instagram.com/AssoElkir/"><i class="uil uil-instagram"></i></a>
                      <a href="https://www.youtube.com/channel/UC-RGKxhJqA3dBX62Fdcy_ig"><i class="uil uil-youtube"></i></a>
                    </nav>
                    <!-- /.social -->
                  </div>
                </div>
                <!-- /.offcanvas-footer -->
              </div>
              <!-- /.offcanvas-body -->
            </div>
            <!-- /.navbar-collapse -->
            <div class="navbar-other ms-lg-4">
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <li class="nav-item d-none d-md-block">
                  <a href="https://support.elkir.fr" target="_blank" class="btn btn-sm btn-primary rounded-pill">Nous contacter</a>
                </li>
                <?php if (session('isLoggedIn')) { ?>
                  <li class="nav-item d-none d-md-block">
                    <a href="<?= base_url('dashboard'); ?>" class="btn btn-sm btn-primary rounded-pill">Mon compte</a>
                  </li>
                <?php }else{ ?>
                <li class="nav-item d-none d-md-block">
                  <a href="<?= base_url('login'); ?>" class="btn btn-sm btn-primary rounded-pill">Connexion</a>
                </li>
                <?php } ?>
                <li class="nav-item d-lg-none">
                  <button class="hamburger offcanvas-nav-btn"><span></span></button>
                </li>
              </ul>
              <!-- /.navbar-nav -->
            </div>
            <!-- /.navbar-other -->
          </div>
          <!-- /.container -->
        </nav>
        <!-- /.navbar -->
      </header>
      <!-- /header -->
          <?php $data = [
	           'title'  => $title,
	           'description' => $description,
	           'image' => $image
	         ]; ?>
        <?= view($content, $data); ?>
    </div>
    <div class="progress-wrap">
      <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
      </svg>
    </div>
    <script src="https://cdn.elkir.fr/assets/js/plugins.js"></script>
    <script src="https://cdn.elkir.fr/assets/js/theme.js"></script>

    <script>
    if ( window.history.replaceState ) {
    		window.history.replaceState( null, null, window.location.href );
    }
    </script>
  </body>

  </html>
