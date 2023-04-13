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
									<label class="control-label col-md-3">Kode Obat</label>
									<div class="col-md-8">
										<?php echo form_input($kode);?>
										<?=form_error('kode','<small class="text-danger pl-3">','</small>');?>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3">Nama Obat</label>
									<div class="col-md-8">
										<?php echo form_input($nama);?>
										<?=form_error('nama','<small class="text-danger pl-3">','</small>');?>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3">Satuan</label>
									<div class="col-md-8">
										<?php echo form_input($satuan);?>
										<?=form_error('satuan','<small class="text-danger pl-3">','</small>');?>
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
