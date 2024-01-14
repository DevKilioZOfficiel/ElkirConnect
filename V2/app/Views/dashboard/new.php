<?php
$db = \Config\Database::connect(); ?>
<section class="wrapper bg-gray">
  <div class="container py-3 py-md-5">
    <nav class="d-inline-block" aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="https://connect.elkir.fr">Accueil</a></li>
        <li class="breadcrumb-item" aria-current="page">Projets</li>
        <li class="breadcrumb-item active" aria-current="page">Nouvelle demande</li>
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
          <div class="col-md-7 col-xl-8 pe-xl-20">
            <h2 class="display-6 mb-1">Nouvelle demande</h2>
          </div>
          <!--/column -->
          <!--/column -->
        </div>
        <!--/.row -->
        <div class="grid grid-view projects-masonry shop mb-13">
          <div class="row gx-md-8 gy-10 gy-md-13 isotope">
            <div class="project item">
              <div class="post-header">
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


                      $description_attente = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
										<td class="img-flex"><img src="https://cdn.elkir.fr/assets/img/email/encours.jpg" style="vertical-align:top;" width="600" height="306" alt="" /></td>
									</tr>
                      									<tr>
										<td data-bgcolor="bg-block" class="holder" style="padding:58px 60px 52px;" bgcolor="#f9f9f9">
											<table width="100%" cellpadding="0" cellspacing="0">
                      												<tr>
                      													<td data-color="title" data-size="size title" data-min="25" data-max="45" data-link-color="link title color" data-link-style="text-decoration:none; color:#292c34;" class="title" align="center" style="font:35px/38px Arial, Helvetica, sans-serif; color:#292c34; padding:0 0 24px;">
                      														Bonjour, <span style="color: #1d9adb;font-weight:bold;">'.$user['username'].'</span> 👋
                      													</td>
                      												</tr>
                      												<tr>
                      													<td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:0 0 21px;">
                      														Nous vous confirmons la bonne réception de votre demande d\'accompagnement pour le projet  <span style="color: #1d9adb;font-weight:bold;">'.session('success__project_name').'</span>.
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
                      														Suite à votre demande d\'accompagnement il vous faudra être patient ! En effet nous répondons aux demandes en <span style="color: #1d9adb;font-weight:bold;">7 jours ouvrés</span>.
                      													</td>
                      												</tr>
                      												<tr>
                      													<td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:16px/29px Arial, Helvetica, sans-serif; color:#888; padding:0 0 21px;">
                      														En attendant hésiter pas à rejoindre notre serveur <a href="https://discord.gg/elkir"><span style="color: #1d9adb;font-weight:bold;">Discord communautaire</span></a> 👍
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
                      </html>';
                      $sessionmodel->Send_Email($user['email'],"ElkirConnect - Projet ".session('success__project_name')."",$description_attente,"waiting");
                    endif ?>
                  </div>
                </div>
            <form method="post" action="<?= base_url('dashboard/sendproject'); ?>">
              <p>A Propos de vous</p>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-floating mb-4">
                    <input type="text" class="form-control" name="prenom">
                    <label>Prénom</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating mb-4">
                    <input type="text" class="form-control" name="nom">
                    <label>Nom</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating mb-4">
                    <input type="number" class="form-control" name="age" min="15" max="100">
                    <label>Âge</label>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-floating mb-4">
                    <input type="text" class="form-control" name="postes">
                    <label>Poste ocucupé</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mb-4">
                      <textarea class="form-control" name="formations" style="height:250px";></textarea>
                    <label>Formations détenues</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating mb-4">
                    <textarea class="form-control" name="experiences" style="height:250px";></textarea>
                    <label>Expériences</label>
                  </div>
                </div>
              </div>
                <p>A propos du projet</p>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-floating mb-4">
                      <input type="text" class="form-control" name="project_name">
                      <label>Nom de votre projet</label>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-floating mb-4">
                      <select class="form-control" name="project_legal">
                        <option value="entreprise">Entreprise</option>
                        <option value="assosiation">Assosiation</option>
                        <option value="projetindependant">Projet Indépendant</option>
                        <option value="autres">Autres</option>
                      </select>
                      <label>Statut légal votre projet</label>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-floating mb-4">
                      <input type="number" class="form-control" name="project_effectif">
                      <label>Effectif votre projet</label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-floating mb-4">
                      <input type="text" class="form-control" name="project_object">
                      <label>Objet votre projet</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating mb-4">
                        <textarea class="form-control" name="project_description" style="height:250px";></textarea>
                      <label>Description de votre projet</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating mb-4">
                      <textarea class="form-control" name="project_help_elkir" style="height:250px";></textarea>
                      <label>En quoi Elkir peut aider le projet</label>
                    </div>
                  </div>
                </div>
                <button type="submit" name="send_demande" class="btn btn-primary rounded-pill btn-login w-100 mb-2">Envoyer ma demande</button>
              </form>
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
<div class="modal fade" id="DeleteElkirConnectModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel">Supprimer le compte ElkirConnect</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        En supprimant le compte ElkirConnect, vous comprenez que vous perdrez toutes vos données.
      </div>
      <div class="modal-footer">
        <a onclick="delete_compte()" style="background-color:#ff0000" class="btn btn-primary rounded-pill btn-login w-100 mb-2" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Valider</a>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel2">Fermeture du compte</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Fermeture du compte effectué avec succès !
      </div>
    </div>
  </div>
</div>
<script>
function update(){
  oData = new FormData();
  oData.append("email", document.getElementById("email").value);
  oData.append("password", document.getElementById("password").value);
  oData.append("password2", document.getElementById("password2").value);

  var oReq = new XMLHttpRequest();
  oReq.open("POST", "<?= base_url(); ?>/api/auth/update", true);
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
<script>
function delete_compte(){
  oData = new FormData();

  var oReq = new XMLHttpRequest();
  oReq.open("POST", "<?= base_url(); ?>/api/auth/delete", true);
  oReq.onload = function(oEvent) {
    console.log(oReq.status);
    window.location.href = "<?= base_url('register'); ?>";
  };
  oReq.send(oData);
}
</script>
