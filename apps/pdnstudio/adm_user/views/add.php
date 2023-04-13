<?php defined('__NAJZMI_PUDINTEA__') OR exit('No direct script access allowed'); ?>
    <main class="app-content">
		<div class="app-title">
			<div>
				<h1><i class="fa fa-th-list"></i> <?=$pdn_page;?> <?php echo isset($pdn_info) ? $pdn_info	: 'Tidak Ada | Pudin Project'; ?></h1>
			</div>
			<ul class="app-breadcrumb breadcrumb side">
				<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
				<li class="breadcrumb-item"><a href="<?=base_url($pdn_url);?>">Data <?php echo isset($pdn_info) ? $pdn_info	: 'Tidak Ada | Pudin Project'; ?></a></li>
				<li class="breadcrumb-item active"><?=$pdn_page;?> <?php echo isset($pdn_info) ? $pdn_info	: 'Tidak Ada | Pudin Project'; ?></li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-6">
					<div class="tile">
						<?= form_open_multipart(base_url($pdn_uform), 'class="form-horizontal" role="form"'); ?>
							<div class="tile-body">
								<div class="form-group row">
									<label class="control-label col-md-3">Nama</label>
									<div class="col-md-8">
										<?php echo form_input($nama);?>
										<?=form_error('nama','<small class="text-danger pl-3">','</small>');?>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3">Email</label>
									<div class="col-md-8">
										<?php echo form_input($email);?>
										<?=form_error('email','<small class="text-danger pl-3">','</small>');?>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3">Level</label>
									<div class="col-md-8">
										<select class="form-control" id="pDn_Select1" name="level">
											<option value="Kampus">Kampus</option>
											<option value="Admin">Admin</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3">Password</label>
									<div class="col-md-8">
										<input type="password" class="form-control form-control-user " id="password1" name="password1" placeholder="Password" required>
										<?=form_error('password1','<small class="text-danger pl-3">','</small>');?>
										<input type="password" class="form-control form-control-user mt-3" id="password2" name="password2" placeholder="Repeat Password" required>
									</div>
								</div>
							</div>
							<div class="tile-footer">
								<div class="row">
									<div class="col-md-8 col-md-offset-3">
										<a class="btn btn-secondary" href="<?=base_url($pdn_url);?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Kembali</a>
										<button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><?=$pdn_page;?> <?php echo isset($pdn_info) ? $pdn_info	: 'Tidak Ada | Pudin Project'; ?></button>
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
