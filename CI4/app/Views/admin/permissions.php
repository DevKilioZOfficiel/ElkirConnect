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
                  <?php
                  $builder2 = $db->table('permissions');
                  $builder2->orderBy('id_grade', 'DESC');
                  $query2 = $builder2->get();
                  foreach ($query2->getResult() as $row2){ ?>
                  <?php if(isset($_POST['user_'.$row2->id_grade.''])){
                  $builder = $db->table('permissions');
                  $fields = $db->getFieldData('permissions');
                  foreach ($fields as $field){
                    $builder->set($field->name, $request->GetPost($field->name));
                  }
                  $builder->where('id_grade', $row2->id_grade);
                  $builder->update();
                  ?>
                  <div class="alert alert-success">Modification du grade <?= $row2->nom; ?> avec succès !</div>
                  <?php } ?>
                  <?php } ?>

                  <div class="card">
                      <div class="card-body">
                          <h4 class="card-title mb-4">Permissions</h4>
                          <table class="table table-nowrap align-middle table-hover mb-0">
                  <thead>
                    <tr>
                      <th>Permissions</th>
                      <th colspan="99">Résultats</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $fields = $db->getFieldData('permissions');
                    foreach ($fields as $field){ ?>
                      <tr>
                        <td><?= $field->name; ?></td>
                        <?php $result_db = $permissionsmodel->get_permissions__list($field->name); ?>
                        <?php foreach ($result_db as $result_db2){ ?>
                        <?php if($field->name == "id_grade"){ ?>
                        <?php $name = $result_db2[$field->name]; ?>
                        <td data-bs-toggle="modal" data-bs-target="#edit<?= $result_db2[$field->name]; ?>">Modifier</td>
                        <?php }else{ ?>
                        <td><?= $result_db2[$field->name]; ?></td>
                        <?php } ?>
                        <?php } ?>
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
    <?php
    $builder = $db->table('permissions');
    $query2 = $builder->get();
    foreach ($query2->getResult() as $row2){ ?>
    <?php if($permissions['PERM__ADD_RANKS'] == 1){ ?>
    	<div class="modal fade" id="edit<?= $row2->id_grade; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	  <div class="modal-dialog">
    	    <div class="modal-content">
    	      <div class="modal-header">
    	        <h5 class="modal-title" id="exampleModalLabel">Modification du grade <?= $row2->nom; ?></h5>
    	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    	      </div>
    			<form method="post">
    	      <div class="modal-body">
    					<?php if($permissions['PERM__EDIT_PERMS'] == 1){ ?>
    				<?php
    				$fields = $db->getFieldData('permissions');
    				foreach ($fields as $field){ ?>
    				<?php $result_db = $permissionsmodel->get_permissions__list2($field->name, $row2->id_grade); ?>
    				<?php foreach ($result_db as $result_db2){ ?>

    				<div class="form-row">
    		          <div class="col-md-12">
    				    <label><?= $field->name; ?></label>
    		            <input <?php if($field->name == "id" OR $field->name == "id_grade"){ ?>readonly<?php } ?>
    								<?php if($field->name == "id" OR $field->name == "id_grade" OR $field->name == "nom" OR $field->name == "color" OR $field->name == "badge__url"){ ?>
    									type="text"
    								<?php }else{ ?>type="number" min="0" max="10000000000000000000000000000000"<?php } ?> name="<?= $field->name; ?>" class="form-control" id="inputPassword2" placeholder="<?= $field->name; ?>" value="<?= $result_db2[$field->name]; ?>">
    				  </div>
    				</div>
    				<br>
    				<?php } ?>
    				<?php } ?>
    				<?php } ?>
    	      </div>
    	      <div class="modal-footer">
    					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer sans sauvegarder</button>
    			    <button type="submit" name="user_<?= $row2->id_grade; ?>" class="btn btn-primary mb-2">Modifier</button>
    	      </div>
    			</form>
    	    </div>
    	  </div>
    	</div>
    <?php } ?>
    <?php } ?>
