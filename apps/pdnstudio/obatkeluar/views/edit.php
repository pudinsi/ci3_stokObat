<?php defined('__NAJZMI_PUDINTEA__') or exit('No direct script access allowed'); ?>
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-th-list"></i> <?=$pdn_page;?> <?php echo isset($pdn_info) ? $pdn_info	: 'Tidak Ada | Pudin Project'; ?></h1>
		</div>
		<ul class="app-breadcrumb breadcrumb side">
			<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			<li class="breadcrumb-item"><a href="<?= base_url($pdn_url); ?>">Data <?php echo isset($pdn_info) ? $pdn_info	: 'Tidak Ada | Pudin Project'; ?></a></li>
			<li class="breadcrumb-item active"><?=$pdn_page;?> <?php echo isset($pdn_info) ? $pdn_info	: 'Tidak Ada | Pudin Project'; ?></li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-6">
				<div class="tile">
					<?= form_open_multipart(base_url($pdn_uform), 'class="form-horizontal" role="form"');
					echo form_input($id);
					echo form_input($obat_asal);
					?>
					<div class="tile-body">
						<div class="form-group row">
							<label class="control-label col-md-3">Kode Obat</label>
							<div class="col-md-8">
								<select name="kode" id="pDn_Select1" class="form-control">
									<option value="<?= $kode_obat; ?>">-- <bold><?= $kode_obat; ?> | <?= $nama_obat; ?></bold> --</option>
									<?php foreach ($dtobat as $obat) {
									?>
										<option value="<?= $obat->obat_kode; ?>"><?= $obat->obat_kode; ?> | <?= $obat->obat_nama; ?> ( Stok : <?= $obat->obat_stok; ?> <?= $obat->obat_satuan; ?> )</option>
									<?php
									}
									?>

								</select>
								<?= form_error('kode', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-md-3">Tanggal</label>
							<div class="col-md-8">
								<?php echo form_input($tanggal); ?>
								<?= form_error('tanggal', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-md-3">Jumlah</label>
							<div class="col-md-8">
								<?php echo form_input($omjumlah); ?>
								<?= form_error('jumlah', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
					</div>
					<div class="tile-footer">
						<div class="row">
							<div class="col-md-8 col-md-offset-3">
								<a class="btn btn-secondary" href="<?= base_url($pdn_url); ?>"><i class="fa fa-fw fa-lg fa-times-circle"></i>Kembali</a>
								<button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i><?=$pdn_page;?> <?php echo isset($pdn_info) ? $pdn_info	: 'Tidak Ada | Pudin Project'; ?></button>
							</div>
						</div>
					</div>
					<?= form_close(); ?>
				</div>
			</div>
			<div class="clearix"></div>
		</div>
	</div>
</main>