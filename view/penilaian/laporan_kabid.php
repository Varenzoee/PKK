<header class="page-header">
	<h2>Detail Penilaian Karyawan</h2>

	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="index.php">
					<i class="fa fa-home"></i>
				</a>
			</li>
			<li><span>Penilaian Karyawan</span></li>
			<li><span>Detail Penilaian Karyawan</span></li>
			<li><span></span></li>
		</ol>
	</div>
</header>
<?php
$id = $_GET['id'];
$id_user = $_SESSION['id_user'];
$kinerja = array(1 => 'KS', 2 => 'K', 3 => 'C', 4 => 'B', 5 => 'SB');
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
						<h2 class="panel-title">Detail Penilaian Karyawan oleh Kepala Bidang ( <?php echo $_SESSION['nama']; ?> ) - Periode : <?php echo $namaBulan[$rowj['bulan']] . ' ' . $rowj['tahun']; ?> </h2>
					</div>

				</div>
			</header>
			<div class="panel-body">
				<table class="table table-bordered table-striped mb-none" id="example">
					<thead>
						<tr>
							<th width="8%">No.</th>
							<th>NIK SAP</th>
							<th>Nama Karyawan</th>
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
							$nama_pegawai[$row['ID_PEGAWAI']] =  $row['NM_PEGAWAI'];
							$id_pegawai = $row['ID_PEGAWAI'];

							$querysp = "SELECT * FROM t_penilaian WHERE id_data_penilaian = '$id' AND id_pegawai = '$id_pegawai' AND id_user = '$id_user'";
							$resultp = $db_li->query($querysp);
							$rowp = $resultp->fetch_assoc();

							$totalnilai = $rowp['cso'] + $rowp['jujur'] + $rowp['tggjwb'] + $rowp['kerjasama'] + $rowp['skill'] + $rowp['inovasi'];
							$nilaipeg[$id_pegawai] = $totalnilai;
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
					<tr>
						<td colspan="12" height="30"></td>
					</tr>
					<tr>
						<td colspan="2" height="30">
							<h5><b>Karyawan Terbaik :</b></h5>
						</td>
						<td colspan="10" height="30">
							<h5><b><?php echo $nama_pegawai[$rowj['id_pegawai']] . ' - NILAI AKHIR : ' . $nilaipeg[$rowj['id_pegawai']]; ?></b></h5>
						</td>
					</tr>
				</table>
			</div>
		</section>
	</div>
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