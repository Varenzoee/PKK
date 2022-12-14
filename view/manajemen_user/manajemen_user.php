<header class="page-header">
        <h2>Manajemen User</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.php">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Admin Panel</span></li>
                <li><span>Manajemen User</span></li>
                <li><span></span></li>
            </ol>
        </div>
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-md-6 col-lg-12 col-xl-12">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                        
						<a id='' class="modal-basic edit-guru" title="Tambah Link" href="#modaleditguru"><button class="btn btn-success">Tambah User</button></a>
                    </div>

                    <h2 class="panel-title">DAFTAR DATA USER APLIKASI</h2>
                </header>
                <div class="panel-body">
                    <table class="table table-bordered table-striped mb-none" id="datatable-default">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="20%">NAMA USER</th>
                                <th class="center" >NO.HP</th>
                                <th class="center" >HAK AKSES</th>
                                <th class="center">USERNAME</th>
                                <th class="center">PASSWORD</th>
                                <th class="center" width="15%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$querys = "SELECT * FROM t_user ORDER BY HAK_AKSES ASC";
							
							$result = $db_li->query($querys);
							$no=1;
							$STATUS = array(1=>"Kepala Regu - KARU",0=>"Kepala Seksi - KASI");
							while($row = $result->fetch_assoc()){
							
                            ?>
							<tr>
								<td><?php echo $no; ?></td>
								<td><?php echo $row['nama_lengkap']; ?></td>
								<td class="center"><?php echo $row['no_hp'] ; ?></td>
								<td class="center"><?php echo $STATUS[$row['hak_akses']] ; ?></td>
								<td class="center"><?php echo $row['username'] ;  ; ?></td>
								<td class="center"><?php echo $row['c_password'] ; ?></td>
								<td class="center">
								<a id="<?php echo $row['id_user']; ?>" class="modal-basic edit-guru" title="Edit" href="#modaleditguru"><button class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></button></a>
								<a id="<?php echo $row['id_user']; ?>" class="modal-basic delete-guru" title="Hapus" href="#modaldeleteguru"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button></a>
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
	
    <div id="modaleditguru" class="modal-block modal-header-color modal-block-warning mfp-hide">
        <section class="panel">
            <!--<form class="form-horizontal" role="form" id="formguru">-->
			<form method="POST" action="proses/manajemen_user/proses_user.php">
                <header class="panel-heading">
                    <h2 class="panel-title">Form Tambah Data User</h2>
                </header>
                <div class="panel-body" id="modalcontenteditguru">
                    
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-default modal-dismiss">Tutup</button>
                            <button type="submit" id="edit_guru" class="btn btn-warning">Simpan</button>
                        </div>
                    </div>
                </footer>
            </form>
        </section>
    </div> 

    <div id="modaldeleteguru" class="modal-block modal-header-color modal-block-danger mfp-hide">
        <section class="panel">
            <form method="POST" action="proses/manajemen_user/proses_hapus_user.php">
                <header class="panel-heading">
                    <h2 class="panel-title">Hapus Data User</h2>
                </header>
                <div class="panel-body" id="modalcontentdeleteguru">
                    
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
			$('#datatable-default').dataTable( {
				"pageLength": 5
			} );
		});
	</script>
	<script type="text/javascript">				
	$('.edit-guru').click(function () {
        var id = $(this).attr('id');
				$.ajax({
						cache: false,
						type: 'POST',
						url: 'view/manajemen_user/form_edit_user.php',
						data: 'id='+id,
						success: function(data) 
						{
							$('#modaleditguru').show();
							$('#modalcontenteditguru').show().html(data);
						}
					});
    });
	$('.delete-guru').click(function () {
        var id = $(this).attr('id');
				$.ajax({
						cache: false,
						type: 'POST',
						url: 'view/manajemen_user/form_hapus_user.php',
						data: 'id='+id,
						success: function(data) 
						{
							$('#modaldeleteguru').show();
							$('#modalcontentdeleteguru').show().html(data);
						}
					});
    });
</script>