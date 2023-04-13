<?php defined('__NAJZMI_PUDINTEA__') OR exit('No direct script access allowed'); ?>
    <main class="app-content">
		<div class="app-title">
			<div>
				<h1><i class="fa fa-th-list"></i> Ganti Password</h1>
			</div>
			<ul class="app-breadcrumb breadcrumb side">
				<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
				<li class="breadcrumb-item"><a href="<?=base_url('adm_user');?>">Data User</a></li>
				<li class="breadcrumb-item active">Ganti Password</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-6">
					<div class="tile">
						<?= form_open_multipart(base_url('bo/change_password'), 'class="form-horizontal" role="form"'); ?>
							<div class="tile-body">
								<div class="form-group row">
									<label class="control-label col-md-3">Ganti Password</label>
									<div class="col-md-9">
										<input type="password" class="form-control form-control-user " id="password1" name="password1" placeholder="Password" required>
										<?=form_error('password1','<small class="text-danger pl-3">','</small>');?>
										<input type="password" class="form-control form-control-user mt-3" id="password2" name="password2" placeholder="Repeat Password" required>
									</div>
								</div>
							</div>
							<div class="tile-footer">
								<div class="row">
									<div class="col-md-8 col-md-offset-3">
										<a class="btn btn-secondary" href="<?=base_url('adm_user');?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Kembali</a>
										<button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Password</button>
									</div>
								</div>
							</div>
						<?= form_close();?>
					</div>
				</div>
				<div class="clearix"></div>
			</div>
		</div>
    </main>
