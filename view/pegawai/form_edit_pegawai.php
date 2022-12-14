<?php
$id = $_POST['id'];
include '../../konek.php';
$querys = "SELECT * FROM t_pegawai where ID_PEGAWAI = '$id'";
$result = $db_li->query($querys);
$row = $result->fetch_assoc();
?>
<div class="col-md-12">
	<div class="form-group">
		<div class="col-md-4 control-label">
			<label class="control-label" style="text-align:left"><strong>NIK SAP </strong></label>
			<input name="NIK" class="form-control" onkeypress="return handleEnter(this, event)" type="text" value="<?php echo $row['NIK']; ?>" />
			<input name="ID_PEGAWAI" class="form-control" type="hidden" value="<?php echo $row['ID_PEGAWAI']; ?>" />
		</div>
		<div class="col-md-8 control-label">
			<label class="control-label" style="text-align:left"><strong>Nama Karyawan</strong></label>
			<input name="NM_PEGAWAI" class="form-control" onkeypress="return handleEnter(this, event)" type="text" value="<?php echo $row['NM_PEGAWAI']; ?>" required />
		</div>
	</div>
	<div class="form-group">

	</div>
	<div class="form-group">
		<div class="col-md-6 control-label">
			<label class="control-label" style="text-align:left"><strong>NO HP</strong></label>
			<input name="NO_HP" class="form-control" onkeypress="return handleEnter(this, event)" type="text" value="<?php echo $row['NO_HP']; ?>" required />
		</div>
		<div class="col-md-6 control-label">
			<label class="control-label" style="text-align:left"><strong>Email</strong></label>
			<input name="EMAIL" class="form-control" onkeypress="return handleEnter(this, event)" type="text" value="<?php echo $row['EMAIL']; ?>" required />
		</div>
	</div>
	<br>
</div>

<script type="text/javascript">
	function handleEnter(field, event) {
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13) {
			var i;
			for (i = 0; i < field.form.elements.length; i++)
				if (field == field.form.elements[i])
					break;
			i = (i + 1) % field.form.elements.length;
			field.form.elements[i].focus();
			return false;
		} else
			return true;
	}
</script>