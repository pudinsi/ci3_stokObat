<?php defined('__NAJZMI_PUDINTEA__') OR exit('No direct script access allowed'); ?>
    <main class="app-content">
		<div class="app-title">
			<div>
				<h1><i class="fa fa-th-list"></i> <?php echo isset($pdn_info) ? $pdn_info	: 'Tidak Ada | Pudin Project'; ?></h1>
			</div>
			<ul class="app-breadcrumb breadcrumb side">
				<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
				<li class="breadcrumb-item active">Data <?php echo isset($pdn_info) ? $pdn_info	: 'Tidak Ada | Pudin Project'; ?></li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
					<div class="tile">
						<h3 class="tile-title"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> STATISTIK STOK OBAT</h3>
						<div class="embed-responsive embed-responsive-16by9" style="width:100%; height:600px;">
							<canvas class="embed-responsive-item"  id="PDNChart"></canvas>
						</div>
					</div>
			</div>
			<div class="clearix"></div>
		</div>
    </main>

