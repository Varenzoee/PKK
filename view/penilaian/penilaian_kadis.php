<header class="page-header">
	<h2>Detail Penilaian Pegawai</h2>

	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="index.php">
					<i class="fa fa-home"></i>
				</a>
			</li>
			<li><span>Penilaian Pegawai</span></li>
			<li><span>Detail Penilaian Pegawai</span></li>
			<li><span></span></li>
		</ol>
	</div>
</header>
<?php
$id = $_GET['id'];
$namaBulan = array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");
$queryj = "SELECT * FROM t_data_penilaian WHERE id = '$id'";
$resultj = $db_li->query($queryj);
$rowj = $resultj->fetch_assoc();

?>
<!-- start: page -->
<div class="row">
	<div class="col-md-6 col-lg-12 col-xl-12">
		<section class="panel panel-primary">
			<header class="panel-heading">
				<div class="row">
					<div class="col-md-8">
						<h2 class="panel-title">Data Penilaian Pegawai oleh Kepala Bidang - Periode : <?php echo $namaBulan[$rowj['bulan']] . ' ' . $rowj['tahun']; ?> </h2>
					</div>

				</div>
			</header>
			<div class="panel-body">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#home">RINGKASAN PENILAIAN</a></li>
					<?php
					$querysus = "SELECT * FROM t_user WHERE hak_akses = '0' ORDER BY id_user;";
					$resultsus = $db_li->query($querysus);
					while ($rowsus = $resultsus->fetch_assoc()) {
						echo '<li><a data-toggle="tab" href="#' . $rowsus['username'] . '">' . $rowsus['nama_lengkap'] . '</a></li>';
					}
					?>
				</ul>

				<div class="tab-content">
					<div id="home" class="tab-pane fade in active">
						<table class="table table-bordered table-striped mb-none" id="example">
							<thead>
								<tr>
									<th width="8%">No. </th>
									<th>NIP</th>
									<th>Nama Pegawai</th>
									<?php
									$querysus = "SELECT * FROM t_user WHERE hak_akses = '0' ORDER BY id_user;";
									$resultsus = $db_li->query($querysus);
									while ($rowsus = $resultsus->fetch_assoc()) {
										echo '<th class="center">' . $rowsus['nama_lengkap'] . '</th>';
									}
									?>
									<th class="center">Nilai Akhir</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$kinerja = array(1 => 'KS', 2 => 'K', 3 => 'C', 4 => 'B', 5 => 'SB');
								$no = 1;
								$querys = "SELECT * FROM t_pegawai ORDER BY NIK ASC";
								$result = $db_li->query($querys);
								$total = $result->num_rows;
								while ($row = $result->fetch_assoc()) {
									$id_pegawai = $row['ID_PEGAWAI'];
								?>
									<tr>
										<td class="center"><?php echo $no; ?></td>
										<td><?php echo $row['NIK']; ?></td>
										<td><?php echo $row['NM_PEGAWAI']; ?></td>
										<?php
										$querysus = "SELECT * FROM t_user WHERE hak_akses = '0' ORDER BY id_user;";
										$resultsus = $db_li->query($querysus);
										while ($rowsus = $resultsus->fetch_assoc()) {
											$nilaik = getnilaikaryawan($id, $id_pegawai, $rowsus['id_user']);
											echo '<th class="center">' . $nilaik . '</th>';
											$nilai[$id_pegawai] += $nilaik;
										}
										?>
										<td class="center"> <?php echo $nilai[$id_pegawai]; ?> </td>
									</tr>
								<?php

									$no++;
								}
								?>
							</tbody>
							<?php
							$statuspen = getstatuskabag($id);
							if ($statuspen == 4) { ?>
								<form method="POST" action="proses/penilaian/proses_hasil_penilaian.php">
									<tr>
										<td colspan="12" height="30"></td>
									</tr>
									<tr>
										<td colspan="2" height="30">
											<h5><b>Pilih Pegawai Terbaik :</b></h5>
										</td>
										<td colspan="10" height="30">
											<input name="id" class="form-control" type="hidden" value="<?php echo $id; ?>" />
											<select name="id_pegawai" class="form-control" required="">
												<?php
												$queryp = "SELECT * FROM t_pegawai ORDER BY NIK ASC";
												$resultp = $db_li->query($queryp);
												while ($rowp = $resultp->fetch_assoc()) {
												?>
													<option value="<?php echo $rowp['ID_PEGAWAI']; ?>" <?php if ($rowp['ID_PEGAWAI'] == $rowj['id_pegawai']) { ?>selected="" <?php } ?>><?php echo $rowp['NM_PEGAWAI']; ?></option>
												<?php
												}
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td colspan="12" height="30"></td>
									</tr>
									<tr>
										<td colspan="12">
											<button type="submit" class="btn btn-success btn-md btn-block"><i class="fa fa-check-square-o"></i> SIMPAN HASIL PENILAIAN Pegawai</button>
										</td>
									</tr>
								</form>
							<?php } else {
								echo '
							<tr>
								<td colspan="12" class="center"><font size="4px">MENUNGGU PETUGAS MELENGKAPI RESPONDEN PENILAIAN !!!</font></td>
							</tr>
							';
							} ?>
						</table>
					</div>
					<?php
					$querysus = "SELECT * FROM t_user WHERE hak_akses = '0' ORDER BY id_user;";
					$resultsus = $db_li->query($querysus);
					while ($rowsus = $resultsus->fetch_assoc()) {
						$id_user = $rowsus['id_user'];
					?>
						<div id="<?php echo $rowsus['username']; ?>" class="tab-pane fade">
							<table class="table table-bordered table-striped mb-none" id="<?php echo 't' . $rowsus['username']; ?>">
								<thead>
									<tr>
										<th width="8%">No.</th>
										<th>NIK SAP</th>
										<th>Nama Pegawai</th>
										<th class="center">CSO</th>
										<th class="center">Jujur</th>
										<th class="center">TggJwb</th>
										<th class="center">Kerjasama</th>
										<th class="center">Skill & Inisiatif</th>
										<th class="center">Inovasi & Kreatif</th>
										<th class="center">Nilai Akhir</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									$querys = "SELECT * FROM t_pegawai ORDER BY NIK ASC";
									$result = $db_li->query($querys);
									$total = $result->num_rows;
									while ($row = $result->fetch_assoc()) {
										$id_pegawai = $row['ID_PEGAWAI'];

										$querysp = "SELECT * FROM t_penilaian WHERE id_data_penilaian = '$id' AND id_pegawai = '$id_pegawai' AND id_user = '$id_user'";
										$resultp = $db_li->query($querysp);
										$rowp = $resultp->fetch_assoc();

										$totalnilai = $rowp['cso'] + $rowp['jujur'] + $rowp['tggjwb'] + $rowp['kerjasama'] + $rowp['skill'] + $rowp['inovasi'];
									?>
										<tr>
											<td class="center"><?php echo $no; ?></td>
											<td><?php echo $row['NIK']; ?></td>
											<td><?php echo $row['NM_PEGAWAI']; ?></td>
											<th class="center"><?php echo $kinerja[$rowp['cso']]; ?></th>
											<th class="center"><?php echo $kinerja[$rowp['jujur']]; ?></th>
											<th class="center"><?php echo $kinerja[$rowp['tggjwb']]; ?></th>
											<th class="center"><?php echo $kinerja[$rowp['kerjasama']]; ?></th>
											<th class="center"><?php echo $kinerja[$rowp['skill']]; ?></th>
											<th class="center"><?php echo $kinerja[$rowp['inovasi']]; ?></th>
											<td class="center"><?php echo $totalnilai; ?></td>
										</tr>
									<?php
										$no++;
									}
									?>
								</tbody>
								<tr>
									<td colspan="12"><b>
											KETERANGAN : <br>
											SB : Sangat Baik , B : Baik , C : Cukup , K : Kurang , KS : Kurang Sekali </b>
									</td>
								</tr>
							</table>
						</div>
					<?php
					}
					?>
				</div>

			</div>
		</section>
	</div>
</div>

<!-- end: page -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#tkasi1').DataTable({
			"lengthMenu": [
				[5, 25, 50, -1],
				[5, 25, 50, "All"]
			]
		});
		$('#tkasi2').DataTable({
			"lengthMenu": [
				[5, 25, 50, -1],
				[5, 25, 50, "All"]
			]
		});
		$('#tkasi3').DataTable({
			"lengthMenu": [
				[5, 25, 50, -1],
				[5, 25, 50, "All"]
			]
		});
		$('#tkasi4').DataTable({
			"lengthMenu": [
				[5, 25, 50, -1],
				[5, 25, 50, "All"]
			]
		});

		$('#example').DataTable({
			"lengthMenu": [
				[5, 25, 50, -1],
				[5, 25, 50, "All"]
			]
		});
	});
</script>