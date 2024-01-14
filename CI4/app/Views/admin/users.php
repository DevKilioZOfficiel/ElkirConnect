<?php $db = \Config\Database::connect(); ?>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">ELKIRCONNECT</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">

                    <?= view('admin/__admin_info'); ?>

                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                  <div class="card">
                      <div class="card-body">
                          <h4 class="card-title mb-4">Utilisateurs</h4>
                          <table class="table table-nowrap align-middle table-hover mb-0">
                            <thead>
            									<tr>
                                <th>#</th>
                                <th>Pseudo</th>
                                <th>Email</th>
                                <th>Grade</th>
                                <th>Actions</th>
            									</tr>
            								</thead>
                  <tbody>

                    <?php
                    $builder_user = $db->table('user');
                    $builder_user->orderBy('id', 'ASC');
                    $query_user = $builder_user->get();
                    foreach ($query_user->getResult() as $row_user){ ?>
                      <tr>
                        <td><?= $row_user->id; ?></td>
                        <td><?= $row_user->username; ?></td>
                        <td><?= $row_user->email; ?></td>
                        <?php $permissions_row_user = $sessionmodel->permission($row_user->grade); ?>
                        <td><?= $permissions_row_user['nom']; ?></td>
                        <td><a href="<?= base_url('/admin/user/'.$row_user->id.''); ?>">Modifier</a></td>
                      </tr>
                    <?php } ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>

            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
