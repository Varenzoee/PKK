<header class="page-header">
	<h2>Penilaian PEGAWAI</h2>

	<div class="right-wrapper pull-right">
		<ol class="breadcrumbs">
			<li>
				<a href="index.php">
					<i class="fa fa-home"></i>
				</a>
			</li>
			<li><span>Penilaian PEGAWAI</span></li>
			<li><span></span></li>
		</ol>
	</div>
</header>
<?php
$id = $_GET['id'];
$id_user = $_SESSION['id_user'];
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
						<h2 class="panel-title">Penilaian PEGAWAI oleh Kepala Seksi - Periode : <?php echo $namaBulan[$rowj['bulan']] . ' ' . $rowj['tahun']; ?> </h2>
					</div>

				</div>
			</header>
			<div class="panel-body">
				<table class="table table-bordered table-striped mb-none" id="example">
					<thead>
						<tr>
							<th width="8%">No.</th>
							<th>NIP</th>
							<th>Nama Pegawai</th>
							<th class="center" width="9%">CSO</th>
							<th class="center">Jujur</th>
							<th class="center">TggJwb</th>
							<th class="center">Kerjasama</th>
							<th class="center">Skill & Inisiatif</th>
							<th class="center">Inovasi & Kreatif</th>
							<th class="center">NA</th>
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

								<td class="center" style="vertical-align:middle;"><?php echo $no; ?></td>
								<td style="vertical-align:middle;"><?php echo $row['NIK']; ?></td>
								<td style="vertical-align:middle;"><?php echo $row['NM_PEGAWAI']; ?></td>
								<th class="center">
									<select name="cso" id="cso_<?php echo $id_pegawai; ?>" onchange="myFunction('<?php echo $rowp['id']; ?>','<?php echo $id; ?>','<?php echo $id_pegawai; ?>')" class="form-control" required="">
										<option value="5" <?php if ($rowp['cso'] == 5) { ?>selected="" <?php } ?>>SB</option>
										<option value="4" <?php if ($rowp['cso'] == 4) { ?>selected="" <?php } ?>>B</option>
										<option value="3" <?php if ($rowp['cso'] == 3) { ?>selected="" <?php } ?>>C</option>
										<option value="2" <?php if ($rowp['cso'] == 2) { ?>selected="" <?php } ?>>K</option>
										<option value="1" <?php if ($rowp['cso'] == 1) { ?>selected="" <?php } ?>>KS</option>
									</select>
								</th>
								<th class="center">
									<select name="jujur" id="jujur_<?php echo $id_pegawai; ?>" onchange="myFunction('<?php echo $rowp['id']; ?>','<?php echo $id; ?>','<?php echo $id_pegawai; ?>')" class="form-control" required="">
										<option value="5" <?php if ($rowp['jujur'] == 5) { ?>selected="" <?php } ?>>SB</option>
										<option value="4" <?php if ($rowp['jujur'] == 4) { ?>selected="" <?php } ?>>B</option>
										<option value="3" <?php if ($rowp['jujur'] == 3) { ?>selected="" <?php } ?>>C</option>
										<option value="2" <?php if ($rowp['jujur'] == 2) { ?>selected="" <?php } ?>>K</option>
										<option value="1" <?php if ($rowp['jujur'] == 1) { ?>selected="" <?php } ?>>KS</option>
									</select>
								</th>
								<th class="center">
									<select name="tggjwb" id="tggjwb_<?php echo $id_pegawai; ?>" onchange="myFunction('<?php echo $rowp['id']; ?>','<?php echo $id; ?>','<?php echo $id_pegawai; ?>')" class="form-control" required="">
										<option value="5" <?php if ($rowp['tggjwb'] == 5) { ?>selected="" <?php } ?>>SB</option>
										<option value="4" <?php if ($rowp['tggjwb'] == 4) { ?>selected="" <?php } ?>>B</option>
										<option value="3" <?php if ($rowp['tggjwb'] == 3) { ?>selected="" <?php } ?>>C</option>
										<option value="2" <?php if ($rowp['tggjwb'] == 2) { ?>selected="" <?php } ?>>K</option>
										<option value="1" <?php if ($rowp['tggjwb'] == 1) { ?>selected="" <?php } ?>>KS</option>
									</select>
								</th>
								<th class="center">
									<select name="kerjasama" id="kerjasama_<?php echo $id_pegawai; ?>" onchange="myFunction('<?php echo $rowp['id']; ?>','<?php echo $id; ?>','<?php echo $id_pegawai; ?>')" class="form-control" required="">
										<option value="5" <?php if ($rowp['kerjasama'] == 5) { ?>selected="" <?php } ?>>SB</option>
										<option value="4" <?php if ($rowp['kerjasama'] == 4) { ?>selected="" <?php } ?>>B</option>
										<option value="3" <?php if ($rowp['kerjasama'] == 3) { ?>selected="" <?php } ?>>C</option>
										<option value="2" <?php if ($rowp['kerjasama'] == 2) { ?>selected="" <?php } ?>>K</option>
										<option value="1" <?php if ($rowp['kerjasama'] == 1) { ?>selected="" <?php } ?>>KS</option>
									</select>
								</th>
								<th class="center">
									<select name="skill" id="skill_<?php echo $id_pegawai; ?>" onchange="myFunction('<?php echo $rowp['id']; ?>','<?php echo $id; ?>','<?php echo $id_pegawai; ?>')" class="form-control" required="">
										<option value="5" <?php if ($rowp['skill'] == 5) { ?>selected="" <?php } ?>>SB</option>
										<option value="4" <?php if ($rowp['skill'] == 4) { ?>selected="" <?php } ?>>B</option>
										<option value="3" <?php if ($rowp['skill'] == 3) { ?>selected="" <?php } ?>>C</option>
										<option value="2" <?php if ($rowp['skill'] == 2) { ?>selected="" <?php } ?>>K</option>
										<option value="1" <?php if ($rowp['skill'] == 1) { ?>selected="" <?php } ?>>KS</option>
									</select>
								</th>
								<th class="center">
									<select name="inovasi" id="inovasi_<?php echo $id_pegawai; ?>" onchange="myFunction('<?php echo $rowp['id']; ?>','<?php echo $id; ?>','<?php echo $id_pegawai; ?>')" class="form-control" required="">
										<option value="5" <?php if ($rowp['inovasi'] == 5) { ?>selected="" <?php } ?>>SB</option>
										<option value="4" <?php if ($rowp['inovasi'] == 4) { ?>selected="" <?php } ?>>B</option>
										<option value="3" <?php if ($rowp['inovasi'] == 3) { ?>selected="" <?php } ?>>C</option>
										<option value="2" <?php if ($rowp['inovasi'] == 2) { ?>selected="" <?php } ?>>K</option>
										<option value="1" <?php if ($rowp['inovasi'] == 1) { ?>selected="" <?php } ?>>KS</option>
									</select>
								</th>
								<td class="center" style="vertical-align:middle;"><?php echo $totalnilai; ?></td>
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
		</section>
	</div>
</div>

<!-- end: page -->
<script>
	function myFunction(id, idp, id_pegawai) {
		var cso = $("#cso_" + id_pegawai).val();
		var jujur = $("#jujur_" + id_pegawai).val();
		var tggjwb = $("#tggjwb_" + id_pegawai).val();
		var kerjasama = $("#kerjasama_" + id_pegawai).val();
		var skill = $("#skill_" + id_pegawai).val();
		var inovasi = $("#inovasi_" + id_pegawai).val();

		$.ajax({
			type: 'POST',
			url: 'proses/penilaian/proses_isi_responden.php',
			data: 'id=' + id + '&idp=' + idp + '&id_pegawai=' + id_pegawai + '&cso=' + cso + '&jujur=' + jujur + '&tggjwb=' + tggjwb + '&kerjasama=' + kerjasama + '&skill=' + skill + '&inovasi=' + inovasi,
			success: function(response) {
				alert('Tersimpan!');
			}
		});
	}
</script>
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