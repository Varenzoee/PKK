<?php
$id = $_POST['id'];
include '../../konek.php';
$querys = "SELECT * FROM t_data_penilaian where id = '$id'";
$result = $db_li->query($querys);
$row = $result->fetch_assoc();

if($row['bulan']!= ''){
	$bulan = $row['bulan'];
}else{
	$bulan = date('m');
}

if($row['tahun']!= ''){
	$tahun = $row['tahun'];
}else{
	$tahun = date('Y');
}
?>
<div class="col-md-12">
    <div class="form-group">
		<div class="col-md-6 control-label">
			<label class="control-label" style="text-align:left"><strong>Bulan</strong></label>
			<select name="bulan" class="form-control select2" required="">
				<option value="0"> - Pilih Bulan -</option>
				<option value="1" <?php if($bulan == 1 ){ ?>selected=""<?php }?>>Januari</option>
				<option value="2" <?php if($bulan == 2 ){ ?>selected=""<?php }?>>Februari</option>
				<option value="3" <?php if($bulan == 3 ){ ?>selected=""<?php }?>>Maret</option>
				<option value="4" <?php if($bulan == 4 ){ ?>selected=""<?php }?>>April</option>
				<option value="5" <?php if($bulan == 5 ){ ?>selected=""<?php }?>>Mei</option>
				<option value="6" <?php if($bulan == 6 ){ ?>selected=""<?php }?>>Juni</option>
				<option value="7" <?php if($bulan == 7 ){ ?>selected=""<?php }?>>Juli</option>
				<option value="8" <?php if($bulan == 8 ){ ?>selected=""<?php }?>>Agustus</option>
				<option value="9" <?php if($bulan == 9 ){ ?>selected=""<?php }?>>September</option>
				<option value="10" <?php if($bulan == 10 ){ ?>selected=""<?php }?>>Oktober</option>
				<option value="11" <?php if($bulan == 11 ){ ?>selected=""<?php }?>>November</option>
				<option value="12" <?php if($bulan == 12 ){ ?>selected=""<?php }?>>Desember</option>
            </select>
        </div>
		<div class="col-md-6 control-label">
			<label class="control-label" style="text-align:left"><strong>TAHUN</strong></label>
			<input name="id" class="form-control" type="hidden" value="<?php echo $id; ?>" />
			<input name="tahun" class="form-control" onkeypress="return handleEnter(this, event)" type="number" value="<?php echo $tahun; ?>" required />
        </div>
	</div>
	<br>

<script type="text/javascript">
function handleEnter (field, event) {
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13) {
			var i;
			for (i = 0; i < field.form.elements.length; i++)
				if (field == field.form.elements[i])
					break;
			i = (i + 1) % field.form.elements.length;
			field.form.elements[i].focus();
			return false;
		} 
		else
		return true;
	}      

</script>