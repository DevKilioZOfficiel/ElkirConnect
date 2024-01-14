<?php $db = \Config\Database::connect(); ?>
<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-4">Projets</h4>

        <ul class="nav nav-pills mb-3 bg-light rounded" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">En attente</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-projects-tab" data-bs-toggle="pill" data-bs-target="#pills-projects" type="button" role="tab" aria-controls="pills-projects" aria-selected="false">Vos projets</button>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
            <div data-simplebar style="max-height: 250px;">
              <div class="table-responsive">
                  <table class="table table-nowrap align-middle table-hover mb-0">
                      <tbody>
                        <?php $builder = $db->table('projects');
                        $builder->where('referent_id',0);
                        $query = $builder->get();
                        foreach ($query->getResult() as $key => $value) { ?>
                          <tr>
                              <td>
                                  <h5 class="text-truncate font-size-14 mb-1"><a href="<?= base_url('admin/projects/'.$value->slug); ?>" class="text-dark"><?= $value->name; ?></a></h5>
                                  <p class="text-muted mb-0">En attente</p>
                              </td>
                              <td style="width: 90px;">
                                  <div>
                                      <ul class="list-inline mb-0 font-size-16">
                                          <li class="list-inline-item">
                                              <a href="<?= base_url('admin/project/'.$value->slug); ?>" class="text-success p-1"><i class="bx bxs-edit-alt"></i></a>
                                          </li>
                                      </ul>
                                  </div>
                              </td>
                          </tr>
                        <?php } ?>

                      </tbody>
                  </table>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="pills-projects" role="tabpanel" aria-labelledby="pills-projects-tab" tabindex="0">
            <div data-simplebar style="max-height: 250px;">
              <div class="table-responsive">
                  <table class="table table-nowrap align-middle table-hover mb-0">
                      <tbody>
                        <?php $builder = $db->table('projects');
                        $builder->where('referent_id',$user['id']);
                        $query = $builder->get();
                        foreach ($query->getResult() as $key => $value) { ?>
                          <tr>
                              <td>
                                  <h5 class="text-truncate font-size-14 mb-1"><a href="<?= base_url('admin/projects/'.$value->slug); ?>" class="text-dark"><?= $value->name; ?></a></h5>
                                  <p class="text-muted mb-0"><?= $user['username']; ?></p>
                              </td>
                              <td style="width: 90px;">
                                  <div>
                                      <ul class="list-inline mb-0 font-size-16">
                                          <li class="list-inline-item">
                                              <a href="<?= base_url('admin/project/'.$value->slug); ?>" class="text-success p-1"><i class="bx bxs-edit-alt"></i></a>
                                          </li>
                                      </ul>
                                  </div>
                              </td>
                          </tr>
                        <?php } ?>

                      </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>

    </div>
</div>
