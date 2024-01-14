<?php $db = \Config\Database::connect(); ?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                        <img src="https://cdn.elkir.fr/assets/img/avatars/img-profil-base.jpg" alt="" class="avatar-md rounded-circle img-thumbnail">
                    </div>
                    <div class="flex-grow-1 align-self-center">
                        <div class="text-muted">
                            <p class="mb-2">Bonjour, bienvenue sur ElkirConnect</p>
                            <h5 class="mb-1"><?= $user['username']; ?></h5>
                            <p class="mb-0"><?= $permissions['nom']; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 align-self-center">
                <div class="text-lg-center mt-4 mt-lg-0">
                    <div class="row">
                        <div class="col-4">
                            <div>
                                <p class="text-muted text-truncate mb-2">Projets gérés</p>
                                <h5 class="mb-0"><?php $builder = $db->table('projects');
                                $builder->where('referent_id',$user['id']);
                                echo $builder->countAllResults(); ?></h5>
                            </div>
                        </div>
                        <div class="col-4">
                            <div>
                                <p class="text-muted text-truncate mb-2">Clients</p>
                                <h5 class="mb-0"><?php $builder = $db->table('projects');
                                $builder->select('user');
                                $builder->where('referent_id',$user['id']);
                                $builder->distinct();
                                echo $builder->countAllResults(); ?></h5>
                            </div>
                        </div>
                        <div class="col-4">
                            <div>
                                <p class="text-muted text-truncate mb-2">Nombre total de projets</p>
                                <h5 class="mb-0"><?php $builder = $db->table('projects');
                                echo $builder->countAllResults(); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
</div>
