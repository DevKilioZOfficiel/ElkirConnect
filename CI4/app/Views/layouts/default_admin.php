<?php $db = \Config\Database::connect();
$request = \Config\Services::request(); ?>
<!doctype html>
<html lang="en">

<head>

        <meta charset="utf-8" />
        <title><?= $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="ElkirConnect administration" name="description" />
        <meta content="Themesbrand" name="Razicord Develoers" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="https://cdn.elkir.fr/assets/img/favicon.png">

        <!-- Bootstrap Css -->
        <link href="<?= base_url(); ?>/uploads/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?= base_url(); ?>/uploads/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?= base_url(); ?>/uploads/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body data-sidebar="dark" data-layout-mode="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">


            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="<?= base_url(); ?>" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="https://cdn.elkir.fr/assets/img/logo-dark.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="https://cdn.elkir.fr/assets/img/logo-dark.png" alt="" height="17">
                                </span>
                            </a>

                            <a href="<?= base_url(); ?>" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="https://cdn.elkir.fr/assets/img/logo-light.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="https://cdn.elkir.fr/assets/img/logo-light.png" alt="" height="19">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block d-lg-none ms-2">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-bell bx-tada"></i>
                                <span class="badge bg-danger rounded-pill">3</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0" key="t-notifications"> Notifications </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#!" class="small" key="t-view-all"> Voir tout</a>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px;">
                                    <a href="javascript: void(0);" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <img src="<?= base_url(); ?>/uploads/assets/images/users/avatar-3.jpg"
                                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">James Lemire</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1" key="t-simplified">It will seem like simplified English.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-hours-ago">1 hours ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript: void(0);" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                                    <i class="bx bx-badge-check"></i>
                                                </span>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1" key="t-shipped">Your item is shipped</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1" key="t-grammer">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago">3 min ago</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2 border-top d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                        <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more">Voir plus</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="https://cdn.elkir.fr/assets/img/avatars/img-profil-base.jpg"
                                    alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ms-1" key="t-henry"><?= $user['username']; ?></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="<?= base_url('logout'); ?>"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Déconnexion</span></a>
                            </div>
                        </div>

                    </div>
                </div>
            </header>

						<!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" key="t-general">GENERAL</li>

                            <li>
                                <a href="<?= base_url('admin/index'); ?>" class="waves-effect">
                                    <i class="bx bx-home"></i>
                                    <span key="t-home">Accueil</span>
                                </a>
                            </li>

                            <li class="menu-title" key="t-gestion">GESTION</li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-user-circle"></i>
                                    <span key="t-projects">Projets</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="<?= base_url('admin/projects'); ?>" key="t-listeprojects">Liste</a></li>
                                </ul>
                            </li>
														<?php if($permissions['PERM__EDIT_PERMS'] == "1"){ ?>
														<li>
                                <a href="<?= base_url('admin/permissions'); ?>" class="waves-effect">
                                    <i class="bx bx-cog"></i>
                                    <span key="t-permissions">Permissions</span>
                                </a>
                            </li>
													<?php } ?>
                          <?php if($permissions['PERM__EDIT_USERS'] == "1"){ ?>
                          <li>
                              <a href="<?= base_url('admin/users'); ?>" class="waves-effect">
                                  <i class="bx bx-user"></i>
                                  <span key="t-user">Utilisateurs</span>
                              </a>
                          </li>
                        <?php } ?>
                        <?php if($permissions['PERM__EDIT_AFFILIE'] == "1"){ ?>
                        <li>
                            <a href="<?= base_url('admin/affilie'); ?>" class="waves-effect">
                                <i class='bx bxs-file-json' ></i>
                                <span key="t-user">Affilie</span>
                            </a>
                        </li>
                      <?php } ?>
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->
						<div class="main-content">
<?= view($content); ?>
<footer class="footer">
		<div class="container-fluid">
				<div class="row">
						<div class="col-sm-6">
								<script>document.write(new Date().getFullYear())</script> © ElkirConnect.
						</div>
						<div class="col-sm-6">
								<div class="text-sm-end d-none d-sm-block">
										ElkirConnect par <a href="">Mateo M.</a>
								</div>
						</div>
				</div>
		</div>
</footer>
</div>
</div>
<!-- END layout-wrapper -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
<script src="<?= base_url(); ?>/uploads/assets/libs/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>/uploads/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>/uploads/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?= base_url(); ?>/uploads/assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?= base_url(); ?>/uploads/assets/libs/node-waves/waves.min.js"></script>

<!-- apexcharts -->
<script src="<?= base_url(); ?>/uploads/assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Saas dashboard init -->
<script>
function getChartColorsArray(a) {
	if (null !== document.getElementById(a)) {
		var r = document.getElementById(a).getAttribute("data-colors");
		if (r) return (r = JSON.parse(r)).map(function(a) {
			var r = a.replace(" ", "");
			if (-1 === r.indexOf(",")) {
				var t = getComputedStyle(document.documentElement).getPropertyValue(r);
				return t || r
			}
			var e = a.split(",");
			return 2 != e.length ? r : "rgba(" + getComputedStyle(document.documentElement).getPropertyValue(e[0]) + "," + e[1] + ")"
		})
	}
}
var linechartBasicColors = getChartColorsArray("elkir-chart");
linechartBasicColors && (options = {
	series: [{
		name: "2022",
		data: [<?= $sessionmodel->count_projects('2022','01'); ?>,<?= $sessionmodel->count_projects('2022','02'); ?>,<?= $sessionmodel->count_projects('2022','03'); ?>,<?= $sessionmodel->count_projects('2022','04'); ?>,
	<?= $sessionmodel->count_projects('2022','05'); ?>,<?= $sessionmodel->count_projects('2022','06'); ?>,<?= $sessionmodel->count_projects('2022','07'); ?>,<?= $sessionmodel->count_projects('2022','08'); ?>,
<?= $sessionmodel->count_projects('2022','09'); ?>,<?= $sessionmodel->count_projects('2022','10'); ?>,<?= $sessionmodel->count_projects('2022','11'); ?>,<?= $sessionmodel->count_projects('2022','12'); ?>]
},{
	name: "2023",
	data: [<?= $sessionmodel->count_projects('2023','01'); ?>,<?= $sessionmodel->count_projects('2023','02'); ?>,<?= $sessionmodel->count_projects('2023','03'); ?>,<?= $sessionmodel->count_projects('2023','04'); ?>,
<?= $sessionmodel->count_projects('2023','05'); ?>,<?= $sessionmodel->count_projects('2023','06'); ?>,<?= $sessionmodel->count_projects('2023','07'); ?>,<?= $sessionmodel->count_projects('2023','08'); ?>,
<?= $sessionmodel->count_projects('2023','09'); ?>,<?= $sessionmodel->count_projects('2023','10'); ?>,<?= $sessionmodel->count_projects('2023','11'); ?>,<?= $sessionmodel->count_projects('2023','12'); ?>]
}],
	chart: {
		height: 320,
		type: "line",
		toolbar: "false",
		dropShadow: {
			enabled: !0,
			color: "#000",
			top: 18,
			left: 7,
			blur: 8,
			opacity: .2
		}
	},
	xaxis: {
    type: 'category',
    categories: ["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Ocotobre","Novembre","Decembre"]
  },
	dataLabels: {
		enabled: !1
	},
	colors: ['#008FFB', '#00E396', '#CED4DC'],
	stroke: {
		curve: "smooth",
		width: 3
	}
}, (chart = new ApexCharts(document.querySelector("#elkir-chart"), options)).render());
</script>

<script src="<?= base_url(); ?>/uploads/assets/js/app.js"></script>
<script>
if ( window.history.replaceState ) {
		window.history.replaceState( null, null, window.location.href );
}
</script>

</body>

</html>
