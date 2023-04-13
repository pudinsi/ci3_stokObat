<?php defined('__NAJZMI_PUDINTEA__') or exit('No direct script access allowed'); ?>
<main class="app-content">
	<div class="app-title">
		<div>
			<h1><i class="fa fa-th-list"></i> <?php echo isset($pdn_info) ? $pdn_info	: 'Tidak Ada | Pudin Project'; ?></h1>
			<p></p>
		</div>
		<ul class="app-breadcrumb breadcrumb side">
			<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			<li class="breadcrumb-item active"><a href="#">Data <?php echo isset($pdn_info) ? $pdn_info	: 'Tidak Ada | Pudin Project'; ?></a></li>
		</ul>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="mb-3">
				<a class="btn btn-primary" href="<?= base_url($pdn_url.'/add'); ?>"><i class="fa fa-fw fa-lg fa-check-circle"></i>Tambah <?php echo isset($pdn_info) ? $pdn_info	: 'Tidak Ada | Pudin Project'; ?></a>
			</div>
			<div class="tile">
				<div class="tile-body">
					<div class="table-responsive">
						<table class="table table-hover table-bordered" id="pdn_mytable" width="100%" style="width:100%;">
							<thead>
								<tr>
									<th width="7%">No</th>
									<th>Kode Obat</th>
									<th>Nama Obat</th>
									<th>Tanggal</th>
									<th>Jumlah</th>
									<th width="12%">Action</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>