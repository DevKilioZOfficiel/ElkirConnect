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
          <div class="col-md-12 col-xl-12 pe-xl-20">
            <h2 class="display-6 mb-1">Mon accompagnement pour <?= $info_project['name']; ?></h2>
          </div>
          <!--/column -->
          <!--/column -->
        </div>
        <!--/.row -->
        <div class="grid grid-view projects-masonry shop mb-13">
          <div class="row gx-md-8 gy-10 gy-md-13 isotope" style="position: relative; height: 286.917px;">
            <div class="project item" style="position: absolute; left: 0%; top: 0px;">
              <div class="post-header">
                <div class="d-flex flex-row align-items-center justify-content-between mb-2">
                </div>

                <p>Etat de votre demande :
                  <?php if($info_project['status'] == 1){ ?>
                    <span style="font-weight: bold;color:#008000"><i class="uil uil-file-check"></i> Validé</span>
                  <?php }elseif($info_project['status'] == 2){ ?>
                    <span style="font-weight: bold;color:#ff0000"><i class="uil uil-times"></i> Refusé</span>
                  <?php }else{ ?>
                    <span style="font-weight: bold;color:#ffb000"><i class="uil uil-sync"></i> En attente</span>
                  <?php } ?>
                </p>

                <p>Votre référent actuel : <span style="font-weight: bold;">
                  <?php if($info_project['referent_id'] === 0){ ?>Aucun référent vous a été assigné.<?php }else{ ?>
                    <?php $builder = $db->table('user');
                    $builder->where('id',$info_project['referent_id']);
                    $query = $builder->get();
                    foreach ($query->getResult() as $key => $value) { ?>
                    <?= $value->username; ?>
                    <?php } ?>
                  <?php } ?>
                  </span></p>

                <p>Bloc Note</p>
                <?php if(empty($info_project['note'])){ ?>
                <p>Aucune note vous a été assigné.</p>
              <?php }else{ ?>
                <?= $sessionmodel->paragrapher($info_project['note']); ?>
              <?php } ?>

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
