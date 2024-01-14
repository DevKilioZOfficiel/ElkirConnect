<?php $db = \Config\Database::connect(); ?>
<aside class="col-lg-3 sidebar">
  <div class="widget mt-1">
    <h4 class="widget-title mb-3">Votre profil</h4>
    <ul class="list-unstyled ps-0">
      <li class="mb-1">
        <a href="<?= base_url('dashboard'); ?>" class="align-items-center rounded link-body"> <i class="uil uil-comment-alt-lock"></i> Modifier mon profil
        </a>
      </li>
    </ul>
    <ul class="list-unstyled ps-0">
      <h4 class="widget-title mb-3">Mes projets</h4>
      <?php $builder = $db->table('projects');
      $query = $builder->get();
      foreach ($query->getResult() as $key => $value) { ?>
      <?php $builder = $db->table('projects');
      $builder->where('user', $user['id']);
      $builder->where('id', $value->id);
      $verification = $builder->countAllResults();

      $builder = $db->table('projects__access');
      $builder->where('user', $user['id']);
      $builder->where('project_id', $value->id);
      $verification_staff = $builder->countAllResults(); ?>
      <?php if($verification === 1 || $verification_staff === 1){ ?>
      <li class="mb-1">
        <a href="#" class="align-items-center rounded collapsed link-body" data-bs-toggle="collapse" data-bs-target="#<?= $value->slug; ?>-collapse" aria-expanded="false">
          <?php if(empty($value->icone)){ ?>
          <i class="uil uil-diary"></i>
        <?php }else{ ?>
          <img src="<?= $value->icone; ?>" width="16" height="16">
        <?php } ?>
        <?= $value->name; ?>
        </a>
        <div class="collapse mt-1" id="<?= $value->slug; ?>-collapse" style="">
          <ul class="btn-toggle-nav list-unstyled ps-2">
            <li><a href="<?= base_url('project/'.$value->slug.''); ?>" class="link-body">Mon accompagnement</a></li>
            <li><a href="<?= base_url('project/'.$value->slug.'/settings'); ?>" class="link-body">Paramètres</a></li>
          </ul>
        </div>
      </li>
      <?php } ?>
    <?php } ?>
      <li class="mb-1">
        <a href="<?= base_url('dashboard/new'); ?>" class="align-items-center rounded link-body"> <i class="uil uil-focus-add"></i> Nouvelle demande</a>
      </li>
    </ul>
    <ul class="list-unstyled ps-0">
      <?php if($permissions['admin'] == "1"){ ?>
      <li class="mb-1">
        <a href="<?= base_url('admin/index'); ?>" class="align-items-center rounded link-body"> <i class="uil uil-create-dashboard"></i> Administration</a>
      </li>
    <?php } ?>
      <li class="mb-1">
        <a style="color:#ff0000" href="<?= base_url('logout'); ?>" class="align-items-center rounded link-body"> <i class="uil uil-signout"></i> Déconnexion</a>
      </li>
    </ul>
  </div>
  <!-- /.widget -->
</aside>
