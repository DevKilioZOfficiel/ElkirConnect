<?php $db = \Config\Database::connect();
$sessionmodel = new \App\Models\SessionModel(); ?>
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
                <div class="col-xl-6">
                  <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Informations générales de l'utilisateur</h4>
                        <div class="row">
                        <div class="col-md-4">
                          <div class="form-floating mb-4">
                            <input type="text" class="form-control" name="prenom" value="<?= $info_project['user_prenom']; ?>" readonly>
                            <label>Prénom</label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-floating mb-4">
                            <input type="text" class="form-control" name="nom" value="<?= $info_project['user_nom']; ?>" readonly>
                            <label>Nom</label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-floating mb-4">
                            <input type="number" class="form-control" name="age" min="15" max="100" value="<?= $info_project['user_age']; ?>" readonly>
                            <label>Âge</label>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-floating mb-4">
                            <input type="text" class="form-control" name="postes" value="<?= $info_project['user_poste']; ?>" readonly>
                            <label>Poste ocucupé</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-floating mb-4">
                              <textarea class="form-control" name="formations" style="height:250px" readonly><?= $info_project['user_formations']; ?></textarea>
                            <label>Formations détenues</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-floating mb-4">
                            <textarea class="form-control" name="experiences" style="height:250px" readonly><?= $info_project['user_experiences']; ?></textarea>
                            <label>Expériences</label>
                          </div>
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-6">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Informations du projet <?= $info_project['name']; ?></h4>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-floating mb-4">
                              <input type="text" class="form-control" name="project_name" value="<?= $info_project['name']; ?>" readonly>
                              <label>Nom de votre projet</label>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-floating mb-4">
                              <input type="text" class="form-control" name="project_legal" value="<?= $info_project['projet_legal_status']; ?>" readonly>
                              <label>Statut légal votre projet</label>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-floating mb-4">
                              <input type="number" class="form-control" name="project_effectif" value="<?= $info_project['projet_membres']; ?>" readonly>
                              <label>Effectif votre projet</label>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-floating mb-4">
                              <input type="text" class="form-control" name="project_object" value="<?= $info_project['projet_objet']; ?>" readonly>
                              <label>Objet votre projet</label>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-floating mb-4">
                                <textarea class="form-control" name="project_description" style="height:250px" readonly><?= $info_project['description']; ?></textarea>
                              <label>Description de votre projet</label>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-floating mb-4">
                              <textarea class="form-control" name="project_help_elkir" style="height:250px" readonly><?= $info_project['projet_elkir']; ?></textarea>
                              <label>En quoi Elkir peut aider le projet</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                      <?php if(isset($_POST['valide'])){
                        $builder = $db->table('projects');
                        $builder->set('note', strip_tags($sessionmodel->paragrapher($request->getPost('note')),"<br><br /><b>"));
                        $builder->set('status', 1);
                        $builder->set('referent_id', $request->getPost('referent_id'));
                        $builder->where('id', $info_project['id']);
                        $builder->update();
                        echo '<div class="alert alert-primary">Validation du projet avec succès de la demande</div>';

                        $builder = $db->table('user');
                        $builder->where('id',$request->getPost('referent_id'));
                        $query = $builder->get();
                        foreach ($query->getResult() as $key => $value) {
                          $referent_email = $value->email;
                          $referent_user = $value->username;
                          $referent_discord = $value->discord;
                        }
                        $builder = $db->table('user');
                        $builder->where('id',$info_project['user']);
                        $query = $builder->get();
                        foreach ($query->getResult() as $key => $value) {
                          $username_demande = $value->username;
                          $user_email = $value->email;
                        }
                        $description_valide = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                        <html xmlns="http://www.w3.org/1999/xhtml">
                        	<head>
                        		<title>ElkirConnect</title>
                        		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
                        		<style type="text/css">
                        			* {
                        				-ms-text-size-adjust:100%;
                        				-webkit-text-size-adjust:none;
                        				-webkit-text-resize:100%;
                        				text-resize:100%;
                        			}
                        			a{
                        				outline:none;
                        				color:#40aceb;
                        				text-decoration:underline;
                        			}
                        			a:hover{text-decoration:none !important;}
                        			.nav a:hover{text-decoration:underline !important;}
                        			.title a:hover{text-decoration:underline !important;}
                        			.title-2 a:hover{text-decoration:underline !important;}
                        			.btn:hover{opacity:0.8;}
                        			.btn a:hover{text-decoration:none !important;}
                        			.btn{
                        				-webkit-transition:all 0.3s ease;
                        				-moz-transition:all 0.3s ease;
                        				-ms-transition:all 0.3s ease;
                        				transition:all 0.3s ease;
                        			}
                        			table td {border-collapse: collapse !important;}
                        			.ExternalClass, .ExternalClass a, .ExternalClass span, .ExternalClass b, .ExternalClass br, .ExternalClass p, .ExternalClass div{line-height:inherit;}
                        			@media only screen and (max-width:500px) {
                        				table[class="flexible"]{width:100% !important;}
                        				table[class="center"]{
                        					float:none !important;
                        					margin:0 auto !important;
                        				}
                        				*[class="hide"]{
                        					display:none !important;
                        					width:0 !important;
                        					height:0 !important;
                        					padding:0 !important;
                        					font-size:0 !important;
                        					line-height:0 !important;
                        				}
                        				td[class="img-flex"] img{
                        					width:100% !important;
                        					height:auto !important;
                        				}
                        				td[class="aligncenter"]{text-align:center !important;}
                        				th[class="flex"]{
                        					display:block !important;
                        					width:100% !important;
                        				}
                        				td[class="wrapper"]{padding:0 !important;}
                        				td[class="holder"]{padding:30px 15px 20px !important;}
                        				td[class="nav"]{
                        					padding:20px 0 0 !important;
                        					text-align:center !important;
                        				}
                        				td[class="h-auto"]{height:auto !important;}
                        				td[class="description"]{padding:30px 20px !important;}
                        				td[class="i-120"] img{
                        					width:120px !important;
                        					height:auto !important;
                        				}
                        				td[class="footer"]{padding:5px 20px 20px !important;}
                        				td[class="footer"] td[class="aligncenter"]{
                        					line-height:25px !important;
                        					padding:20px 0 0 !important;
                        				}
                        				tr[class="table-holder"]{
                        					display:table !important;
                        					width:100% !important;
                        				}
                        				th[class="thead"]{display:table-header-group !important; width:100% !important;}
                        				th[class="tfoot"]{display:table-footer-group !important; width:100% !important;}
                        			}
                        		</style>
                        	</head>
                        	<body style="margin:0; padding:0;" bgcolor="#eaeced">
                        		<table style="min-width:320px;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#eaeced">
                        			<!-- fix for gmail -->
                        			<tr>
                        				<td class="hide">
                        					<table width="600" cellpadding="0" cellspacing="0" style="width:600px !important;">
                        						<tr>
                        							<td style="min-width:600px; font-size:0; line-height:0;">&nbsp;</td>
                        						</tr>
                        					</table>
                        				</td>
                        			</tr>
                        			<tr>
                        				<td class="wrapper" style="padding:0 10px;">
                        					<!-- module 1 -->
                        					<table data-module="module-1" width="100%" cellpadding="0" cellspacing="0">
                        						<tr>
                        							<td data-bgcolor="bg-module" bgcolor="#eaeced">
                        								<table class="flexible" width="600" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                        									<tr>
                        										<td style="padding:29px 0 30px;">
                        											<table width="100%" cellpadding="0" cellspacing="0">
                        												<tr>
                        													<th class="flex" width="113" align="left" style="padding:0;">
                        														<table class="center" cellpadding="0" cellspacing="0">
                        															<tr>
                        																<td style="line-height:0;">
                        																	<a target="_blank" style="text-decoration:none;" href="https://connect.elkir.fr/"><img src="https://cdn.elkir.fr/assets/img/email/logo.png" border="0" style="font:bold 12px/12px Arial, Helvetica, sans-serif; color:#606060;" align="left" vspace="0" hspace="0" width="200" height="12" alt="ElkirConnect" /></a>
                        																</td>
                        															</tr>
                        														</table>
                        													</th>
                        													<th class="flex" align="left" style="padding:0;">
                        														<table width="100%" cellpadding="0" cellspacing="0">
                        															<tr>
                        																<td data-color="text" data-size="size navigation" data-min="10" data-max="22" data-link-style="text-decoration:none; color:#888;" class="nav" align="right" style="font:bold 13px/15px Arial, Helvetica, sans-serif; color:#888;">
                        																	<a target="_blank" style="text-decoration:none; color:#888;" href="https://connect.elkir.fr">Accueil</a> &nbsp; &nbsp; <a target="_blank" style="text-decoration:none; color:#888;" href="https://connect.elkir.fr/dashboard">Vos paramètres</a> &nbsp; &nbsp; <a target="_blank" style="text-decoration:none; color:#888;" href="https://support.elkir.fr">Nous contacter</a>
                        																</td>
                        															</tr>
                        														</table>
                        													</th>
                        												</tr>
                        											</table>
                        										</td>
                        									</tr>
                        								</table>
                        							</td>
                        						</tr>
                        					</table>
                        					<!-- module 2 -->
                        					<table data-module="module-2" width="100%" cellpadding="0" cellspacing="0">
                        						<tr>
                        							<td data-bgcolor="bg-module" bgcolor="#eaeced">
                        								<table class="flexible" width="600" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                        									<tr>
										<td class="img-flex"><img src="https://cdn.elkir.fr/assets/img/email/accept-projet.jpg" style="vertical-align:top;" width="600" height="306" alt="" /></td>
									</tr>
                        									<tr>
										<td data-bgcolor="bg-block" class="holder" style="padding:58px 60px 52px;" bgcolor="#f9f9f9">
											<table width="100%" cellpadding="0" cellspacing="0">
                        												<tr>
                        													<td data-color="title" data-size="size title" data-min="25" data-max="45" data-link-color="link title color" data-link-style="text-decoration:none; color:#292c34;" class="title" align="center" style="font:35px/38px Arial, Helvetica, sans-serif; color:#292c34; padding:0 0 24px;">
                        														Bonjour, <span style="color: #1d9adb;font-weight:bold;">'.$username_demande.'</span> 👋
                        													</td>
                        												</tr>
                        												<tr>
                        													<td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:0 0 21px;">
                        														Félicitation ! 🎉 Votre projet <span style="color: #1d9adb;font-weight:bold;">'.$info_project['name'].'</span> vient d\'être acceptée par notre équipe !
                        													</td>
                        												</tr>
                        												<tr>
                        													<td style="padding:0 0 20px;">
                        														<table width="134" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                        															<tr>
                        																<td data-bgcolor="bg-button" data-size="size button" data-min="10" data-max="16" class="btn" align="center" style="font:12px/14px Arial, Helvetica, sans-serif; color:#f8f9fb; text-transform:uppercase; mso-padding-alt:12px 10px 10px; border-radius:2px;" bgcolor="#4777bc">
                        																	<a target="_blank" style="text-decoration:none; color:#f8f9fb; display:block; padding:12px 10px 10px;" href="https://connect.elkir.fr/login">Se connecter</a>
                        																</td>
                        															</tr>
                        														</table>
                        													</td>
                        												</tr>
                        											</table>
										</td>
									</tr>
                        									<tr><td height="28"></td></tr>
                        								</table>
                        							</td>
                        						</tr>
                        					</table>
                        					<table data-module="module-6" width="100%" cellpadding="0" cellspacing="0">
                        						<tr>
                        							<td data-bgcolor="bg-module" bgcolor="#eaeced">
                        								<table class="flexible" width="600" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                        									<tr>
                        										<td data-bgcolor="bg-block" class="holder" style="padding:64px 60px 50px;" bgcolor="#f9f9f9">
                        											<table width="100%" cellpadding="0" cellspacing="0">
                        												<tr>
                        													<td data-color="title" data-size="size title" data-min="20" data-max="40" data-link-color="link title color" data-link-style="text-decoration:none; color:#292c34;" class="title" align="center" style="font:30px/33px Arial, Helvetica, sans-serif; color:#292c34; padding:0 0 23px;">
                        														Votre référent
                        													</td>
                        												</tr>
                        												<tr>
                        													<td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:0 0 21px;">
                        														Vous avez désormais un réferent de projet qui s\'appelle <span style="color: #1d9adb;font-weight:bold;">'.$referent_user.'</span>, vous pouvez désormais le contacter pour tout ce qui concerne votre projet.
                        													</td>
                        												</tr>
                        												<tr>
                        													<td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:0 0 21px;">
                        														L\'e-mail de votre référent : <a href="'.$referent_email.'"><span style="color: #1d9adb;font-weight:bold;">'.$referent_email.'</span></a>.
                        													</td>
                        												</tr>
                        											</table>
                        										</td>
                        									</tr>
                        									<tr><td height="28"></td></tr>
                        								</table>
                        							</td>
                        						</tr>
                        					</table>

                        					<table data-module="module-2" width="100%" cellpadding="0" cellspacing="0">
                        						<tr>
                        							<td data-bgcolor="bg-module" bgcolor="#eaeced">
                        								<table class="flexible" width="600" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                        									<tr>
                        										<td class="img-flex"><img src="https://cdn.elkir.fr/assets/img/email/48h.jpg" style="vertical-align:top;" width="600" height="306" alt="" /></td>
                        									</tr>
                        									<tr>
                        										<td data-bgcolor="bg-block" class="holder" style="padding:58px 60px 52px;" bgcolor="#f9f9f9">
                        											<table width="100%" cellpadding="0" cellspacing="0">
                        												<tr>
                        													<td data-color="title" data-size="size title" data-min="20" data-max="40" data-link-color="link title color" data-link-style="text-decoration:none; color:#292c34;" class="title" align="center" style="font:30px/33px Arial, Helvetica, sans-serif; color:#292c34; padding:0 0 23px;">
                        														La suite ?
                        													</td>
                        												</tr>
                        												<tr>
                        													<td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:0 0 21px;">
                        														Après avoir reçu ce mail-là, votre référent prendra contact avec vous dans les 48 prochaines heures.
                        													</td>
                        												</tr>
                        												<tr>
                        													<td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:0 0 21px;">
                        														Vous pouvez désormais modifier et voir votre accompagnement depuis <a href="https://connect.elkir.fr/dashboard">vos paramètres</a>.
                        													</td>
                        												</tr>
                        											</table>
                        										</td>
                        									</tr>
                        									<tr><td height="28"></td></tr>
                        								</table>
                        							</td>
                        						</tr>
                        					</table>
                        					<!-- module 6 -->
                        					<table data-module="module-6" width="100%" cellpadding="0" cellspacing="0">
                        						<tr>
                        							<td data-bgcolor="bg-module" bgcolor="#eaeced">
                        								<table class="flexible" width="600" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                        									<tr>
                        										<td data-bgcolor="bg-block" class="holder" style="padding:64px 60px 50px;" bgcolor="#f9f9f9">
                        											<table width="100%" cellpadding="0" cellspacing="0">
                        												<tr>
                        													<td data-color="title" data-size="size title" data-min="20" data-max="40" data-link-color="link title color" data-link-style="text-decoration:none; color:#292c34;" class="title" align="center" style="font:30px/33px Arial, Helvetica, sans-serif; color:#292c34; padding:0 0 23px;">
                        														Un problème, une question ?
                        													</td>
                        												</tr>
                        												<tr>
                        													<td style="padding:0 0 20px;">
                        														<table width="232" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                        															<tr>
                        																<td data-bgcolor="bg-button" data-size="size button" data-min="10" data-max="20" class="btn" align="center" style="font:bold 16px/18px Arial, Helvetica, sans-serif; color:#f9f9f9; text-transform:uppercase; mso-padding-alt:22px 10px; border-radius:3px;" bgcolor="#4777bc">
                        																	<a target="_blank" style="text-decoration:none; color:#f9f9f9; display:block; padding:22px 10px;" href="https://support.elkir.fr">Nous contacter</a>
                        																</td>
                        															</tr>
                        														</table>
                        													</td>
                        												</tr>
                        											</table>
                        										</td>
                        									</tr>
                        									<tr><td height="28"></td></tr>
                        								</table>
                        							</td>
                        						</tr>
                        					</table>
                        					<!-- module 7 -->
                        					<table data-module="module-7" width="100%" cellpadding="0" cellspacing="0">
                        						<tr>
                        							<td data-bgcolor="bg-module" bgcolor="#eaeced">
                        								<table class="flexible" width="600" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                        									<tr>
                        										<td class="footer" style="padding:0 0 10px;">
                        											<table width="100%" cellpadding="0" cellspacing="0">
                        												<tr class="table-holder">
                        													<th class="tfoot" width="400" align="left" style="vertical-align:top; padding:0;">
                        														<table width="100%" cellpadding="0" cellspacing="0">
                        															<tr>
                        																<td data-color="text" data-link-color="link text color" data-link-style="text-decoration:underline; color:#797c82;" class="aligncenter" style="font:12px/16px Arial, Helvetica, sans-serif; color:#797c82; padding:0 0 10px;">
                        																	Association Elkir, 2018-2022. &nbsp; Tous les droits sont réservés.
                        																</td>
                        															</tr>
                        														</table>
                        													</th>
                        													<th class="thead" width="200" align="left" style="vertical-align:top; padding:0;">
                        														<table class="center" align="right" cellpadding="0" cellspacing="0">
                        															<tr>
                        																<td class="btn" valign="top" style="line-height:0; padding:3px 0 0;">
                        																	<a target="_blank" style="text-decoration:none;" href="https://facebook.fr/AssoElkir"><img src="https://cdn.elkir.fr/assets/img/email/ico-facebook.png" border="0" style="font:12px/15px Arial, Helvetica, sans-serif; color:#797c82;" align="left" vspace="0" hspace="0" width="6" height="13" alt="fb" /></a>
                        																</td>
                        																<td width="20"></td>
                        																<td class="btn" valign="top" style="line-height:0; padding:3px 0 0;">
                        																	<a target="_blank" style="text-decoration:none;" href="https://facebook.com/AssoElkir"><img src="https://cdn.elkir.fr/assets/img/email/ico-twitter.png" border="0" style="font:12px/15px Arial, Helvetica, sans-serif; color:#797c82;" align="left" vspace="0" hspace="0" width="13" height="11" alt="tw" /></a>
                        																</td>
                        																<td width="20"></td>
                        																<td class="btn" valign="top" style="line-height:0; padding:3px 0 0;">
                        																	<a target="_blank" style="text-decoration:none;" href="https://www.linkedin.com/company/AssoElkir"><img src="https://cdn.elkir.fr/assets/img/email/ico-linkedin.png" border="0" style="font:12px/15px Arial, Helvetica, sans-serif; color:#797c82;" align="left" vspace="0" hspace="0" width="13" height="11" alt="in" /></a>
                        																</td>
                        																<td width="20"></td>
                        																<td class="btn" valign="top" style="line-height:0; padding:3px 0 0;">
                        																	<a target="_blank" style="text-decoration:none;" href="https://discord.gg/elkir"><img src="https://cdn.elkir.fr/assets/img/email/ico-discord.png" border="0" style="font:12px/15px Arial, Helvetica, sans-serif; color:#797c82;" align="left" vspace="0" hspace="0" width="13" height="11" alt="in" /></a>
                        																</td>
                        																<td width="20"></td>
                        																<td class="btn" valign="top" style="line-height:0; padding:3px 0 0;">
                        																	<a target="_blank" style="text-decoration:none;" href="https://instagram.com/AssoElkir"><img src="https://cdn.elkir.fr/assets/img/email/ico-instagram.png" border="0" style="font:12px/15px Arial, Helvetica, sans-serif; color:#797c82;" align="left" vspace="0" hspace="0" width="13" height="11" alt="in" /></a>
                        																</td>
                        																<td width="20"></td>
                        																<td class="btn" valign="top" style="line-height:0; padding:3px 0 0;">
                        																	<a target="_blank" style="text-decoration:none;" href="https://twitch.tv/AssociationElkir"><img src="https://cdn.elkir.fr/assets/img/email/ico-twitch.png" border="0" style="font:12px/15px Arial, Helvetica, sans-serif; color:#797c82;" align="left" vspace="0" hspace="0" width="13" height="11" alt="in" /></a>
                        																</td>
                        															</tr>
                        														</table>
                        													</th>
                        												</tr>
                        											</table>
                        										</td>
                        									</tr>
                        								</table>
                        							</td>
                        						</tr>
                        					</table>
                        				</td>
                        			</tr>
                        			<!-- fix for gmail -->
                        			<tr>
                        				<td style="line-height:0;"><div style="display:none; white-space:nowrap; font:15px/1px courier;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div></td>
                        			</tr>
                        		</table>
                        	</body>
                        </html>
';
                        $sessionmodel->Send_Email($user_email,"ElkirConnect - Projet ".$info_project['name']."",$description_valide,"success");
                      } ?>
                      <?php if(isset($_POST['refus'])){
                        $builder = $db->table('projects');
                        $builder->set('status', 2);
                        $builder->where('id', $info_project['id']);
                        $builder->update();
                        echo '<div class="alert alert-primary">Refus du projet avec succès de la demande</div>';

                        $builder = $db->table('user');
                        $builder->where('id',$info_project['user']);
                        $query = $builder->get();
                        foreach ($query->getResult() as $key => $value) {
                          $username_demande = $value->username;
                          $user_email = $value->email;
                        }
                        $description_refus = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                        <html xmlns="http://www.w3.org/1999/xhtml">
                        	<head>
                        		<title>ElkirConnect</title>
                        		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
                        		<style type="text/css">
                        			* {
                        				-ms-text-size-adjust:100%;
                        				-webkit-text-size-adjust:none;
                        				-webkit-text-resize:100%;
                        				text-resize:100%;
                        			}
                        			a{
                        				outline:none;
                        				color:#40aceb;
                        				text-decoration:underline;
                        			}
                        			a:hover{text-decoration:none !important;}
                        			.nav a:hover{text-decoration:underline !important;}
                        			.title a:hover{text-decoration:underline !important;}
                        			.title-2 a:hover{text-decoration:underline !important;}
                        			.btn:hover{opacity:0.8;}
                        			.btn a:hover{text-decoration:none !important;}
                        			.btn{
                        				-webkit-transition:all 0.3s ease;
                        				-moz-transition:all 0.3s ease;
                        				-ms-transition:all 0.3s ease;
                        				transition:all 0.3s ease;
                        			}
                        			table td {border-collapse: collapse !important;}
                        			.ExternalClass, .ExternalClass a, .ExternalClass span, .ExternalClass b, .ExternalClass br, .ExternalClass p, .ExternalClass div{line-height:inherit;}
                        			@media only screen and (max-width:500px) {
                        				table[class="flexible"]{width:100% !important;}
                        				table[class="center"]{
                        					float:none !important;
                        					margin:0 auto !important;
                        				}
                        				*[class="hide"]{
                        					display:none !important;
                        					width:0 !important;
                        					height:0 !important;
                        					padding:0 !important;
                        					font-size:0 !important;
                        					line-height:0 !important;
                        				}
                        				td[class="img-flex"] img{
                        					width:100% !important;
                        					height:auto !important;
                        				}
                        				td[class="aligncenter"]{text-align:center !important;}
                        				th[class="flex"]{
                        					display:block !important;
                        					width:100% !important;
                        				}
                        				td[class="wrapper"]{padding:0 !important;}
                        				td[class="holder"]{padding:30px 15px 20px !important;}
                        				td[class="nav"]{
                        					padding:20px 0 0 !important;
                        					text-align:center !important;
                        				}
                        				td[class="h-auto"]{height:auto !important;}
                        				td[class="description"]{padding:30px 20px !important;}
                        				td[class="i-120"] img{
                        					width:120px !important;
                        					height:auto !important;
                        				}
                        				td[class="footer"]{padding:5px 20px 20px !important;}
                        				td[class="footer"] td[class="aligncenter"]{
                        					line-height:25px !important;
                        					padding:20px 0 0 !important;
                        				}
                        				tr[class="table-holder"]{
                        					display:table !important;
                        					width:100% !important;
                        				}
                        				th[class="thead"]{display:table-header-group !important; width:100% !important;}
                        				th[class="tfoot"]{display:table-footer-group !important; width:100% !important;}
                        			}
                        		</style>
                        	</head>
                        	<body style="margin:0; padding:0;" bgcolor="#eaeced">
                        		<table style="min-width:320px;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#eaeced">
                        			<!-- fix for gmail -->
                        			<tr>
                        				<td class="hide">
                        					<table width="600" cellpadding="0" cellspacing="0" style="width:600px !important;">
                        						<tr>
                        							<td style="min-width:600px; font-size:0; line-height:0;">&nbsp;</td>
                        						</tr>
                        					</table>
                        				</td>
                        			</tr>
                        			<tr>
                        				<td class="wrapper" style="padding:0 10px;">
                        					<!-- module 1 -->
                        					<table data-module="module-1" width="100%" cellpadding="0" cellspacing="0">
                        						<tr>
                        							<td data-bgcolor="bg-module" bgcolor="#eaeced">
                        								<table class="flexible" width="600" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                        									<tr>
                        										<td style="padding:29px 0 30px;">
                        											<table width="100%" cellpadding="0" cellspacing="0">
                        												<tr>
                        													<th class="flex" width="113" align="left" style="padding:0;">
                        														<table class="center" cellpadding="0" cellspacing="0">
                        															<tr>
                        																<td style="line-height:0;">
                        																	<a target="_blank" style="text-decoration:none;" href="https://connect.elkir.fr/"><img src="https://cdn.elkir.fr/assets/img/email/logo.png" border="0" style="font:bold 12px/12px Arial, Helvetica, sans-serif; color:#606060;" align="left" vspace="0" hspace="0" width="200" height="12" alt="ElkirConnect" /></a>
                        																</td>
                        															</tr>
                        														</table>
                        													</th>
                        													<th class="flex" align="left" style="padding:0;">
                        														<table width="100%" cellpadding="0" cellspacing="0">
                        															<tr>
                        																<td data-color="text" data-size="size navigation" data-min="10" data-max="22" data-link-style="text-decoration:none; color:#888;" class="nav" align="right" style="font:bold 13px/15px Arial, Helvetica, sans-serif; color:#888;">
                        																	<a target="_blank" style="text-decoration:none; color:#888;" href="https://www.connect.elkir.fr">Accueil</a> &nbsp; &nbsp; <a target="_blank" style="text-decoration:none; color:#888;" href="https://connect.elkir.fr/dashboard">Vos paramètres</a> &nbsp; &nbsp; <a target="_blank" style="text-decoration:none; color:#888;" href="https://support.elkir.fr">Nous contacter</a>
                        																</td>
                        															</tr>
                        														</table>
                        													</th>
                        												</tr>
                        											</table>
                        										</td>
                        									</tr>
                        								</table>
                        							</td>
                        						</tr>
                        					</table>
                        					<!-- module 2 -->
                        					<table data-module="module-2" width="100%" cellpadding="0" cellspacing="0">
                        						<tr>
                        							<td data-bgcolor="bg-module" bgcolor="#eaeced">
                        								<table class="flexible" width="600" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                        									<tr>
										<td class="img-flex"><img src="https://cdn.elkir.fr/assets/img/email/refus-projet.jpg" style="vertical-align:top;" width="600" height="306" alt="" /></td>
									</tr>
                        									<tr>
										<td data-bgcolor="bg-block" class="holder" style="padding:58px 60px 52px;" bgcolor="#f9f9f9">
											<table width="100%" cellpadding="0" cellspacing="0">
                        												<tr>
                        													<td data-color="title" data-size="size title" data-min="25" data-max="45" data-link-color="link title color" data-link-style="text-decoration:none; color:#292c34;" class="title" align="center" style="font:35px/38px Arial, Helvetica, sans-serif; color:#292c34; padding:0 0 24px;">
                        														Bonjour, <span style="color: #1d9adb;font-weight:bold;">'.$username_demande.'</span> 👋
                        													</td>
                        												</tr>
                        												<tr>
                        													<td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:0 0 21px;">
                        														Votre projet <span style="color: #1d9adb;font-weight:bold;">'.$info_project['name'].'</span> a l\'air très intéressant mais malheureusement notre équipe doit donner une suite défavorable à votre demande d\'accompagnement. 😥
                        													</td>
                        												</tr>
                        											</table>
										</td>
									</tr>
                        									<tr><td height="28"></td></tr>
                        								</table>
                        							</td>
                        						</tr>
                        					</table>
                        					<table data-module="module-6" width="100%" cellpadding="0" cellspacing="0">
                        						<tr>
                        							<td data-bgcolor="bg-module" bgcolor="#eaeced">
                        								<table class="flexible" width="600" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                        									<tr>
                        										<td data-bgcolor="bg-block" class="holder" style="padding:64px 60px 50px;" bgcolor="#f9f9f9">
                        											<table width="100%" cellpadding="0" cellspacing="0">
                        												<tr>
                        													<td data-color="title" data-size="size title" data-min="20" data-max="40" data-link-color="link title color" data-link-style="text-decoration:none; color:#292c34;" class="title" align="center" style="font:30px/33px Arial, Helvetica, sans-serif; color:#292c34; padding:0 0 23px;">
                        														Motif du refus
                        													</td>
                        												</tr>
                        												<tr>
                        													<td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:0 0 21px;">
                        														'.htmlentities($sessionmodel->paragrapher($request->getPost('notification_email'))).'
                        													</td>
                        												</tr>
                        											</table>
                        										</td>
                        									</tr>
                        									<tr><td height="28"></td></tr>
                        								</table>
                        							</td>
                        						</tr>
                        					</table>

                        					<table data-module="module-6" width="100%" cellpadding="0" cellspacing="0">
                        						<tr>
                        							<td data-bgcolor="bg-module" bgcolor="#eaeced">
                        								<table class="flexible" width="600" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                        									<tr>
                        										<td data-bgcolor="bg-block" class="holder" style="padding:64px 60px 50px;" bgcolor="#f9f9f9">
                        											<table width="100%" cellpadding="0" cellspacing="0">
                        												<tr>
                        													<td data-color="title" data-size="size title" data-min="20" data-max="40" data-link-color="link title color" data-link-style="text-decoration:none; color:#292c34;" class="title" align="center" style="font:30px/33px Arial, Helvetica, sans-serif; color:#292c34; padding:0 0 23px;">
                        														La suite ?
                        													</td>
                        												</tr>
                        												<tr>
                        													<td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:0 0 21px;">
                        														Un <span style="color: #1d9adb;font-weight:bold;">refus</span> ne signifie pas que votre projet ne sera jamais accepté dans notre programme d\'accompagnement.
                        													</td>
                        												</tr>
                        												<tr>
                        													<td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:0 0 21px;">
                        														Vous pouvez tout à fait refaire une demande dans plusieurs mois si votre projet venez à prendre une nouvelle tournure ou qui venez à évoluer.
                        													</td>
                        												</tr>
                        												<tr>
                        													<td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:0 0 21px;">
                        														Toutes l\'équipe vous souhaite une bonne continuation dans votre projet ! 👍
                        													</td>
                        												</tr>
                        											</table>
                        										</td>
                        									</tr>
                        									<tr><td height="28"></td></tr>
                        								</table>
                        							</td>
                        						</tr>
                        					</table>
                        					<!-- module 6 -->
                        					<table data-module="module-6" width="100%" cellpadding="0" cellspacing="0">
                        						<tr>
                        							<td data-bgcolor="bg-module" bgcolor="#eaeced">
                        								<table class="flexible" width="600" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                        									<tr>
                        										<td data-bgcolor="bg-block" class="holder" style="padding:64px 60px 50px;" bgcolor="#f9f9f9">
                        											<table width="100%" cellpadding="0" cellspacing="0">
                        												<tr>
                        													<td data-color="title" data-size="size title" data-min="20" data-max="40" data-link-color="link title color" data-link-style="text-decoration:none; color:#292c34;" class="title" align="center" style="font:30px/33px Arial, Helvetica, sans-serif; color:#292c34; padding:0 0 23px;">
                        														Un problème, une question ?
                        													</td>
                        												</tr>
                        												<tr>
                        													<td style="padding:0 0 20px;">
                        														<table width="232" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                        															<tr>
                        																<td data-bgcolor="bg-button" data-size="size button" data-min="10" data-max="20" class="btn" align="center" style="font:bold 16px/18px Arial, Helvetica, sans-serif; color:#f9f9f9; text-transform:uppercase; mso-padding-alt:22px 10px; border-radius:3px;" bgcolor="#4777bc">
                        																	<a target="_blank" style="text-decoration:none; color:#f9f9f9; display:block; padding:22px 10px;" href="https://support.elkir.fr">Nous contacter</a>
                        																</td>
                        															</tr>
                        														</table>
                        													</td>
                        												</tr>
                        											</table>
                        										</td>
                        									</tr>
                        									<tr><td height="28"></td></tr>
                        								</table>
                        							</td>
                        						</tr>
                        					</table>
                        					<!-- module 7 -->
                        					<table data-module="module-7" width="100%" cellpadding="0" cellspacing="0">
                        						<tr>
                        							<td data-bgcolor="bg-module" bgcolor="#eaeced">
                        								<table class="flexible" width="600" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                        									<tr>
                        										<td class="footer" style="padding:0 0 10px;">
                        											<table width="100%" cellpadding="0" cellspacing="0">
                        												<tr class="table-holder">
                        													<th class="tfoot" width="400" align="left" style="vertical-align:top; padding:0;">
                        														<table width="100%" cellpadding="0" cellspacing="0">
                        															<tr>
                        																<td data-color="text" data-link-color="link text color" data-link-style="text-decoration:underline; color:#797c82;" class="aligncenter" style="font:12px/16px Arial, Helvetica, sans-serif; color:#797c82; padding:0 0 10px;">
                        																	Association Elkir, 2018-2022. &nbsp; Tous les droits sont réservés.
                        																</td>
                        															</tr>
                        														</table>
                        													</th>
                        													<th class="thead" width="200" align="left" style="vertical-align:top; padding:0;">
                        														<table class="center" align="right" cellpadding="0" cellspacing="0">
                        															<tr>
                        																<td class="btn" valign="top" style="line-height:0; padding:3px 0 0;">
                        																	<a target="_blank" style="text-decoration:none;" href="https://facebook.fr/AssoElkir"><img src="https://cdn.elkir.fr/assets/img/email/ico-facebook.png" border="0" style="font:12px/15px Arial, Helvetica, sans-serif; color:#797c82;" align="left" vspace="0" hspace="0" width="6" height="13" alt="fb" /></a>
                        																</td>
                        																<td width="20"></td>
                        																<td class="btn" valign="top" style="line-height:0; padding:3px 0 0;">
                        																	<a target="_blank" style="text-decoration:none;" href="https://facebook.com/AssoElkir"><img src="https://cdn.elkir.fr/assets/img/email/ico-twitter.png" border="0" style="font:12px/15px Arial, Helvetica, sans-serif; color:#797c82;" align="left" vspace="0" hspace="0" width="13" height="11" alt="tw" /></a>
                        																</td>
                        																<td width="20"></td>
                        																<td class="btn" valign="top" style="line-height:0; padding:3px 0 0;">
                        																	<a target="_blank" style="text-decoration:none;" href="https://www.linkedin.com/company/AssoElkir"><img src="https://cdn.elkir.fr/assets/img/email/ico-linkedin.png" border="0" style="font:12px/15px Arial, Helvetica, sans-serif; color:#797c82;" align="left" vspace="0" hspace="0" width="13" height="11" alt="in" /></a>
                        																</td>
                        																<td width="20"></td>
                        																<td class="btn" valign="top" style="line-height:0; padding:3px 0 0;">
                        																	<a target="_blank" style="text-decoration:none;" href="https://discord.gg/YCtqryq"><img src="https://cdn.elkir.fr/assets/img/email/ico-discord.png" border="0" style="font:12px/15px Arial, Helvetica, sans-serif; color:#797c82;" align="left" vspace="0" hspace="0" width="13" height="11" alt="in" /></a>
                        																</td>
                        																<td width="20"></td>
                        																<td class="btn" valign="top" style="line-height:0; padding:3px 0 0;">
                        																	<a target="_blank" style="text-decoration:none;" href="https://instagram.com/AssoElkir"><img src="https://cdn.elkir.fr/assets/img/email/ico-instagram.png" border="0" style="font:12px/15px Arial, Helvetica, sans-serif; color:#797c82;" align="left" vspace="0" hspace="0" width="13" height="11" alt="in" /></a>
                        																</td>
                        																<td width="20"></td>
                        																<td class="btn" valign="top" style="line-height:0; padding:3px 0 0;">
                        																	<a target="_blank" style="text-decoration:none;" href="https://twitch.tv/AssociationElkir"><img src="https://cdn.elkir.fr/assets/img/email/ico-twitch.png" border="0" style="font:12px/15px Arial, Helvetica, sans-serif; color:#797c82;" align="left" vspace="0" hspace="0" width="13" height="11" alt="in" /></a>
                        																</td>
                        															</tr>
                        														</table>
                        													</th>
                        												</tr>
                        											</table>
                        										</td>
                        									</tr>
                        								</table>
                        							</td>
                        						</tr>
                        					</table>
                        				</td>
                        			</tr>
                        			<!-- fix for gmail -->
                        			<tr>
                        				<td style="line-height:0;"><div style="display:none; white-space:nowrap; font:15px/1px courier;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</div></td>
                        			</tr>
                        		</table>
                        	</body>
                        </html>
';
                        $sessionmodel->Send_Email($user_email,"ElkirConnect - Projet ".$info_project['name']."",$description_refus,"refused");
                      } ?>
                      <?php if(isset($_POST['edit_ref'])){
                          $builder = $db->table('projects');
                          $builder->set('note', strip_tags($sessionmodel->paragrapher($request->getPost('note')),"<br><br /><b>"));
                          $builder->set('referent_id', $request->getPost('referent_id'));
                          $builder->where('id', $info_project['id']);
                          $builder->update();
                          echo '<div class="alert alert-primary">Modification du référent et de la note avec succès</div>';

                          $builder = $db->table('user');
                          $builder->where('id',$request->getPost('referent_id'));
                          $query = $builder->get();
                          foreach ($query->getResult() as $key => $value) {
                            $referent_email = $value->email;
                            $referent_user = $value->username;
                            $referent_discord = $value->discord;
                          }
                      } ?>
                    </div>
                  </div>
                    <div class="row">
                        <div class="col-md-6">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">Administratif</h4>
                              <form method="POST">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-floating mb-4">
                                    <label>Référant du projet</label>
                                    <select class="form-control" name="referent_id">
                                      <?php $builder = $db->table('user');
                                      $query = $builder->get();
                                      foreach ($query->getResult() as $key => $value) { ?>
                                        <?php $staff_permission = $sessionmodel->permission($value->grade); ?>
                                        <?php if($staff_permission['admin'] == "1"){ ?>
                                          <option value="<?= $value->id; ?>" <?php if($info_project['referent_id'] == $value->id){ ?>selected<?php } ?>><?= $value->username; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-floating mb-4">
                                    <textarea class="form-control" name="note"><?= $info_project['note']; ?></textarea>
                                    <label>Note</label>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <button type="submit" name="edit_ref" class="btn btn-success" style="width:100%;">Modification</button>
                                </div>
                              </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">Vérification</h4>
                              <form method="POST">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-floating mb-4">
                                    <label>Référant du projet</label>
                                    <select class="form-control" name="referent_id">
                                      <?php $builder = $db->table('user');
                                      $query = $builder->get();
                                      foreach ($query->getResult() as $key => $value) { ?>
                                        <?php $staff_permission = $sessionmodel->permission($value->grade); ?>
                                        <?php if($staff_permission['admin'] == "1"){ ?>
                                          <option value="<?= $value->id; ?>" <?php if($info_project['referent_id'] == $value->id){ ?>selected<?php } ?>><?= $value->username; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-floating mb-4">
                                    <textarea class="form-control" name="notification_email"></textarea>
                                    <label>Notification de l'email</label>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <button type="submit" name="valide" class="btn btn-success" style="width:100%;">Valider</button>
                                </div>
                                <div class="col-md-6">
                                  <button type="submit" name="refus" class="btn btn-danger" style="width:100%;">Refuser</button>
                                </div>
                              </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
        </div>
    </div>
    <!-- End Page-content -->
