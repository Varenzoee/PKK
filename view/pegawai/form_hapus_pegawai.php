<?php
$id = $_POST['id'];
?>
<div class="modal-wrapper">
<div class="modal-icon">
                            <i class="fa fa-times-circle"></i>
                        </div>
                        <div class="modal-text">
                            <h4>Menghapus Data Karyawan</h4>
                            <p>Apakah anda yakin ingin menghapus data ini ? </p>
                            <input value="<?php echo $id; ?>" name="ID_PEGAWAI" class="form-control" type="hidden"/>
                        </div>
                        </div>