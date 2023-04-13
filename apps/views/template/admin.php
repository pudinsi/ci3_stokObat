<?php defined('__NAJZMI_PUDINTEA__') or exit('No direct script access allowed');  ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="shortcut icon" href="<?= base_url('assets/'); ?>img/favicon.ico" type="image/x-icon" />
	<title><?php echo isset($pdn_title) ? $pdn_title	: 'Administrator | Pudin Project'; ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/'); ?>css/main.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/'); ?>font-awesome/css/font-awesome.min.css">
</head>

<body class="app sidebar-mini rtl">
	<!-- Navbar-->
	<header class="app-header"><a class="app-header__logo" href="<?= base_url(); ?>">PUDINTEA</a>
		<a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a><span class="mt-3 text-white"><b>Hai, <?= $this->session->userdata('pdn_email'); ?> </b></span>
		<ul class="app-nav">
			<li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
				<ul class="dropdown-menu settings-menu dropdown-menu-right">
					<li><a class="dropdown-item" href="#"><i class="fa fa-user fa-lg"></i> Profil</a></li>
					<li><a class="dropdown-item" href="<?= base_url('bo/change_password'); ?>"><i class="fa fa-unlock fa-lg"></i> Ganti Password</a></li>
					<li><a class="dropdown-item tombol-pdn-logout" href="<?= base_url('bo/logout'); ?>"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
				</ul>
			</li>
		</ul>
	</header>
	<!-- Sidebar menu-->
	<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
	<aside class="app-sidebar">
		<div class="app-sidebar__user">
			<img class="app-sidebar__user-avatar" src="<?= base_url('assets/'); ?>img/ypia-60.png" alt="User Image" />
			<div>
				<p class="app-sidebar__user-name"><?= pdn_adm_sess_nama_user(); ?></p>
				<p class="app-sidebar__user-designation"><?= $this->session->userdata('pdn_level'); ?></p>
			</div>
		</div>
		<ul class="app-menu">
			<?php if ($this->session->userdata('pdn_level') == 'Admin') { ?>
				<!-- HALAMAN ADMINISTRATOR -->
				<li><a class="app-menu__item <?php echo isset($adm_dash) ? $adm_dash	: ''; ?> " href="<?= base_url('adm_dash'); ?>"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
				<li><a class="app-menu__item <?php echo isset($obat) ? $obat	: ''; ?> " href="<?= base_url('obat'); ?>"><i class="app-menu__icon fa fa-bars"></i><span class="app-menu__label">Obat</span></a></li>
				<li><a class="app-menu__item <?php echo isset($obatmasuk) ? $obatmasuk	: ''; ?> " href="<?= base_url('obatmasuk'); ?>"><i class="app-menu__icon fa fa-sign-in"></i><span class="app-menu__label">Obat Masuk</span></a></li>
				<li><a class="app-menu__item <?php echo isset($obatkeluar) ? $obatkeluar	: ''; ?> " href="<?= base_url('obatkeluar'); ?>"><i class="app-menu__icon fa fa-reply-all"></i><span class="app-menu__label">Obat Keluar</span></a></li>
				<li><a class="app-menu__item <?php echo isset($adm_user) ? $adm_user	: ''; ?> " href="<?= base_url('adm_user'); ?>"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Users</span></a></li>

			<?php } elseif ($this->session->userdata('pdn_level') == 'Pengawas') { ?>
				<li><a class="app-menu__item <?php echo isset($peng_dash) ? $peng_dash	: ''; ?> " href="<?= base_url('peng_dash'); ?>"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>

			<?php } else { ?>
				<!-- HALAMAN OPERATOR -->
				<li><a class="app-menu__item <?php echo isset($dash) ? $dash	: ''; ?> " href="<?= base_url('dash'); ?>"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
			<?php } ?>
			<li></li>
			<li><a class="app-menu__item tombol-pdn-logout" id="" href="<?= base_url('bo/logout'); ?>"><i class="app-menu__icon fa fa-sign-out"></i><span class="app-menu__label">Logout</span></a></li>
		</ul>
	</aside>
	<!-- Start Content-->
	<?= isset($pdn_konten) ? $pdn_konten : ''; ?>
	<!-- End Content-->
	<script type="text/javascript" src="<?= base_url('assets/'); ?>js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?= base_url('assets/'); ?>js/popper.min.js"></script>
	<script type="text/javascript" src="<?= base_url('assets/'); ?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?= base_url('assets/'); ?>js/main.js"></script>
	<script type="text/javascript" src="<?= base_url('assets/'); ?>js/plugins/pace.min.js"></script>
	<script type="text/javascript" src="<?= base_url('assets/'); ?>js/plugins/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?= base_url('assets/'); ?>js/plugins/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" src="<?= base_url('assets'); ?>/js/plugins/bootstrap-notify.min.js"></script>
	<script type="text/javascript" src="<?= base_url('assets'); ?>/js/plugins/sweetalert.min.js"></script>
	<script type="text/javascript" src="<?= base_url('assets'); ?>/js/plugins/select2.min.js"></script>
	<?= isset($pdn_kode) ? $pdn_kode : ''; ?>
	<script type="text/javascript">
		$('#pDn_Select1').select2();
		$('#pDn_Select2').select2();
		$('#pDn_Select3').select2();
	</script>
	<script type="text/javascript">
		$(document).on('click', '.tombol-pdn-logout', function(e) {
			e.preventDefault();
			var url = $(this).attr('href');
			swal({
				title: "Apakah anda yakin?",
				text: "Ingin keluar dari apliaksi ini!",
				type: "warning",
				showCancelButton: true,
				confirmButtonText: "Ya",
				cancelButtonText: "Tidak",
				closeOnCancel: true,
				showCancelButton: true,
			}, function(isConfirm) {
				if (isConfirm) {
					document.location.href = url;
				}
			});
		});

		const flasDatas = "<?= $this->session->flashdata('success'); ?>";
		if (flasDatas) {
			$.notify({
				title: "Success : ",
				message: flasDatas,
				icon: 'fa fa-check'
			}, {
				type: "info"
			});
		}

		const flasDatae = "<?= $this->session->flashdata('error'); ?>";
		if (flasDatae) {
			$.notify({
				title: "Error : ",
				message: flasDatae,
				icon: 'fa fa-times'
			}, {
				type: "danger"
			});
		}
	</script>
</body>

</html>