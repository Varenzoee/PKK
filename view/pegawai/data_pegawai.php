<header class="page-header">
    <h2>Daftar Pegawai</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="index.php">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Data Pegawai</span></li>
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
                            <h2 class="panel-title">Data Pegawai Dinas Pemberdayaan Masyarakat dan Desa Kab. Gresik</h2>
                        </div>
                        <div class="col-md-2">
                            <!--<a id="" class="modal-basic import-pegawai" href="#modalimportpegawai">
						<button type="button" class="btn btn-success btn-sm pull-right"> IMPORT </button>
						</a>-->
                            <a id="" class="modal-basic edit-pegawai" title="Tambah pegawai" href="#modaleditpegawai">
                                <button type="button" class="btn btn-success btn-md pull-right"> TAMBAH </button>
                            </a>
                        </div>

                    </div>
                </header>
                <div class="panel-body">
                    <table class="table table-bordered table-striped mb-none" id="example">
                        <thead>
                            <tr>
                                <th width="8%">No. </th>
                                <th>NIP</th>
                                <th>Nama Lengkap</th>
                                <th>No. HP</th>
                                <th>Email</th>
                                <th width="13%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'konek.php';
                            $querys = "SELECT * FROM t_pegawai ORDER BY NM_PEGAWAI ASC";
                            $result = $db_li->query($querys);
                            $no = 1;

                            while ($row = $result->fetch_assoc()) {

                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $row['NIP']; ?></td>
                                    <td><?php echo $row['NM_PEGAWAI']; ?></td>
                                    <td><?php echo $row['NO_HP']; ?></td>
                                    <td><?php echo $row['EMAIL']; ?></td>
                                    <td class="center">
                                        <a id="<?php echo $row['ID_PEGAWAI']; ?>" class="modal-basic edit-pegawai" title="Edit Pegawai" href="#modaleditpegawai"><button class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></button></a>
                                        <a id="<?php echo $row['ID_PEGAWAI']; ?>" class="modal-basic delete-pegawai" title="Hapus pegawi" href="#modaldeletepegawai"><button class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></button></a>
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
            <form method="POST" action="proses/pegawai/proses_pegawai.php">
                <header class="panel-heading">
                    <h2 class="panel-title">Form Data Pegawi</h2>
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

    <div id="modaldeletepegawai" class="modal-block modal-header-color modal-block-danger mfp-hide">
        <section class="panel">
            <form method="POST" action="proses/pegawai/proses_hapus_pegawai.php">
                <header class="panel-heading">
                    <h2 class="panel-title">Hapus Data Karyawan</h2>
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
                url: 'view/pegawai/form_edit_pegawai.php',
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
                url: 'view/pegawai/form_hapus_pegawai.php',
                data: 'id=' + id,
                success: function(data) {
                    $('#modaldeletepegawai').show();
                    $('#modalcontentdeletepegawai').show().html(data);
                }
            });
        });
    </script>