<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="<?=base_url('assets');?>/img/favicon.ico" type="image/x-icon"/>
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets');?>/css/main.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url('assets');?>/font-awesome/css/font-awesome.min.css">
		<title>Login Aplikasi</title>
	</head>
	<body>
		<section class="material-half-bg">
			<div class="cover"></div>
		</section>
		<div class="flash-data-s" data-flashdata-s="<?=$this->session->flashdata('success');?>"></div>
		<div class="flash-data-e" data-flashdata-e="<?=$this->session->flashdata('error');?>"></div>
		<section class="login-content">
			<div class="login-box">
				<?= form_open_multipart(base_url('bo'), 'class="login-form" role="form"'); ?>
					<h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
					<div class="form-group">
						<label class="control-label">USERNAME</label>
						<input class="form-control" type="text" id="email" name="email" placeholder="Email" value="<?=set_value('email');?>" autofocus required >
						<?=form_error('email','<small class="text-danger">','</small>');?>
					</div>
					<div class="form-group">
						<label class="control-label">PASSWORD</label>
						<input class="form-control" type="password" id="password" name="password" placeholder="Password" value="<?=set_value('password');?>" required >
						<?=form_error('password','<small class="text-danger">','</small>');?>
					</div>
					<div class="form-group">
						<div class="utility">
							<div class="animated-checkbox">
								<label>
									<input type="checkbox"><span class="label-text">Stay Signed in</span>
								</label>
							</div>
						</div>
					</div>
					<div class="form-group btn-container">
						<button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
					</div>
				<?= form_close();?>
			</div>
		</section>
		<script type="text/javascript" src="<?=base_url('assets');?>/js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="<?=base_url('assets');?>/js/popper.min.js"></script>
		<script type="text/javascript" src="<?=base_url('assets');?>/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?=base_url('assets');?>/js/main.js"></script>
		<script type="text/javascript" src="<?=base_url('assets');?>/js/plugins/pace.min.js"></script>
		<script type="text/javascript" src="<?=base_url('assets');?>/js/plugins/bootstrap-notify.min.js"></script>
		<script type="/text/javascript">
		// Login Page Flipbox control
			$('.login-content [data-toggle="flip"]').click(function() {
			$('.login-box').toggleClass('flipped');
			return false;
		});
		</script>
		<script type="text/javascript">
			const flasDatas = $('.flash-data-s').data('flashdata-s');
			if(flasDatas){
				$.notify({
					title: "Success : ",
					message: flasDatas,
					icon: 'fa fa-check' 
				},{
					type: "info"
				});
			}
			
			const flasDatae = $('.flash-data-e').data('flashdata-e');
			if(flasDatae){
				$.notify({
					title	: "Error : ",
					message	: flasDatae,
					icon	: 'fa fa-times' 
				},{
					type: "danger"
				});
			}
		</script>
	</body>
</html>