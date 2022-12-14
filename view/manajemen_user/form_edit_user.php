<?php
include '../../konek.php';
include '../../func.php';

$level = $_SESSION['level'];

$id = $_POST['id'];
$querys = "SELECT * FROM t_user WHERE id_user = '$id'";

$result = $db_li->query($querys);
$row = $result->fetch_assoc();

?>
<div class="col-md-12">
    <div class="form-group">
        <label class="col-md-5 control-label" style="text-align:left"><strong>Nama User</strong></label>
        <div class="col-md-7 control-label">
            <input name="nama_lengkap" class="form-control" type="text" value="<?php echo  $row['nama_lengkap']; ?>" />
            <input name="id_user" class="form-control" type="hidden" value="<?php echo  $row['id_user']; ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-5 control-label" style="text-align:left"><strong>No.Telepon</strong></label>
        <div class="col-md-7 control-label">
            <input name="no_hp" class="form-control" type="text" value="<?php echo  $row['no_hp']; ?>" />
        </div>
    </div>
    <hr>
    <div class="form-group">
        <label class="col-md-5 control-label" style="text-align:left"><strong>Hak Akses</strong></label>
        <div class="col-md-7 control-label">
            <select name="hak_akses" class="form-control select2" required="">
                <option value="0"> - Pilih Hak Akses -</option>
                <option value="1" <?php if ($row['hak_akses'] == 1) { ?>selected="" <?php } ?>>Kepala Regu - KARU</option>
                <option value="0" <?php if ($row['hak_akses'] == 0) { ?>selected="" <?php } ?>>Kepala Seksi - KASI</option>
            </select>
        </div>
    </div>
    <hr>
    <div class="form-group">
        <label class="col-md-5 control-label" style="text-align:left"><strong>Username</strong></label>
        <div class="col-md-7 control-label">
            <input name="username" class="form-control" type="text" value="<?php echo  $row['username']; ?>" />
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-5 control-label" style="text-align:left"><strong>Password</strong></label>
        <div class="col-md-7 control-label">
            <input name="password" class="form-control" type="text" value="<?php echo  $row['c_password']; ?>" />
        </div>
    </div>
</div>