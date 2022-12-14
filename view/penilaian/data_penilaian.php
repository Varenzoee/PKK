<header class="page-header">
	<h2>Penilaian pegawai</h2>

	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="index.php">
					<i class="fa fa-home"></i>
				</a>
			</li>
			<li><span>Penilaian pegawai</span></li>
			<li><span></span></li>
		</ol>
	</div>
</header>

<!-- start: page -->
<div class="row">
	<div class="row">
		<div class="col-md-6 col-lg-12 col-xl-12">
			<section class="panel panel-primary">
				<header class="panel-heading">
					<div class="row">
						<div class="col-md-10">
							<h2 class="panel-title">Data Penilaian pegawai - Utllitas Batu Bara</h2>
						</div>
						<?php
						include 'konek.php';
						$status = array(0 => '<font color="red"><b>BELUM</b></font>', 1 => '<font color="green"><b>SELESAI</b></font>');
						$namaBulan = array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
						$querys = "SELECT * FROM t_data_penilaian WHERE status = '0' ORDER BY tanggal asc";
						$result = $db_li->query($querys);
						$total = $result->num_rows;

						$querysp = "SELECT * FROM t_pegawai";
						$resultp = $db_li->query($querysp);
						while ($rowp = $resultp->fetch_assoc()) {
							$nm_pegawai[$rowp['ID_PEGAWAI']] = $rowp['NIK'] . ' - ' . $rowp['NM_PEGAWAI'];
						}

						//if($total == 0){
						?>

						<div class="col-md-2">
							<a id="" class="modal-basic edit-pegawai" title="Input Kehadiran" href="#modaleditpegawai">
								<button type="button" class="btn btn-success btn-bg btn-block"><i class="fa fa-check-circle"></i> TAMBAH </button>
							</a>
						</div>
						<?php //} 
						?>
					</div>
				</header>
				<div class="panel-body">

					<table class="table table-bordered table-striped mb-none" id="example">
						<thead>
							<tr>
								<th width="8%">NO</th>
								<th class="center">BULAN</th>
								<th class="center">TAHUN</th>
								<th class="center">PEGAWAI TERBAIK</th>
								<?php
								$querysus = "SELECT * FROM t_user WHERE hak_akses = '0' ORDER BY id_user;";
								$resultsus = $db_li->query($querysus);
								while ($rowsus = $resultsus->fetch_assoc()) {
									echo '<th class="center">' . $rowsus['nama_lengkap'] . '</th>';
								}
								?>
								<th class="center">TANGGAL</th>
								<th class="center">AKSI</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							while ($row = $result->fetch_assoc()) {
								if ($row['id_pegawai'] != '') {
									$kterbaik = $nm_pegawai[$row['id_pegawai']];
								} else {
									$kterbaik = ' - ';
								}
							?>
								<tr>
									<td class="center"><?php echo $no; ?></td>
									<td class="center"><?php echo strtoupper($namaBulan[$row['bulan']]); ?></td>
									<td class="center"><?php echo $row['tahun']; ?></td>
									<td class="center"><?php echo $kterbaik; ?></td>
									<?php
									$querysus = "SELECT * FROM t_user WHERE hak_akses = '0' ORDER BY id_user;";
									$resultsus = $db_li->query($querysus);
									while ($rowsus = $resultsus->fetch_assoc()) {
										echo getstatuspenilaian($row['id'], $rowsus['id_user']);
									}
									?>
									<td class="center"><?php echo date("d/m/Y H:i", strtotime($row['tanggal'])); ?></td>
									<td class="center">
										<a href="index.php?page=penilaiankabag&id=<?php echo $row['id']; ?>"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> LIHAT NILAI</button></a>
										<a id="<?php echo $row['id']; ?>" class="modal-basic delete-pegawai" title="Hapus Produk" href="#modaldeletepegawai"><button class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></button></a>
									</td>
								</tr>
							<?php
								$no++;
							}
							?>
						</tbody>

					</table>
				</div>
			</section>
		</div>
	</div>

	<div id="modaleditpegawai" class="modal-block modal-header-color modal-block-warning mfp-hide">
		<section class="panel">
			<form method="POST" action="proses/penilaian/proses_data_penilaian.php">
				<header class="panel-heading">
					<h2 class="panel-title">Form Periode Penilaian pegawai</h2>
				</header>
				<div class="panel-body" id="modalcontenteditpegawai">

				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<button class="btn btn-default modal-dismiss">Tutup</button>
							<button type="submit" id="edit_pegawai" class="btn btn-warning">Simpan</button>
						</div>
					</div>
				</footer>
			</form>
		</section>
	</div>

	<div id="modaldeletepegawi" class="modal-block modal-header-color modal-block-danger mfp-hide">
		<section class="panel">
			<form method="POST" action="proses/penilaian/proses_hapus_data_penilaian.php">
				<header class="panel-heading">
					<h2 class="panel-title">Hapus Periode Penilaian pegawai</h2>
				</header>
				<div class="panel-body" id="modalcontentdeletepegawai">

				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<button class="btn btn-default modal-dismiss">Tutup</button>
							<button type="submit" class="btn btn-danger">Hapus</button>
						</div>
					</div>
				</footer>
			</form>
		</section>
	</div>
	<!-- end: page -->
	<script type="text/javascript">
		$(document).ready(function() {
			$('#example').DataTable({
				"lengthMenu": [
					[5, 25, 50, -1],
					[5, 25, 50, "All"]
				]
			});
		});
	</script>
	<script type="text/javascript">
		$('.edit-pegawai').click(function() {
			var id = $(this).attr('id');
			$.ajax({
				cache: false,
				type: 'POST',
				url: 'view/penilaian/form_edit_penilaian.php',
				data: 'id=' + id,
				success: function(data) {
					$('#modaleditpegawai').show();
					$('#modalcontenteditpegawai').show().html(data);
				}
			});
		});

		$('.delete-pegawai').click(function() {
			var id = $(this).attr('id');
			$.ajax({
				cache: false,
				type: 'POST',
				url: 'view/penilaian/form_hapus_penilaian.php',
				data: 'id=' + id,
				success: function(data) {
					$('#modaldeletepegawai').show();
					$('#modalcontentdeletepegawai').show().html(data);
				}
			});
		});
	</script>