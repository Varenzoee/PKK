<header class="page-header">
    <h2>Laporan Penilaian Karyawan</h2>

    <div class="right-wrapper pull-right">
        <ol class="breadcrumbs">
            <li>
                <a href="index.php">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>Laporan</span></li>
            <li><span></span></li>
        </ol>
    </div>
</header>

<!-- start: page -->
<div class="row">
    <div class="row">
        <div class="col-md-6 col-lg-12 col-xl-12">
            <section class="panel panel-success">
                <header class="panel-heading">
                    <div class="row">
                        <div class="col-md-8">
                            <h2 class="panel-title">Data Laporan Penilaian Kinerja Pegawai</h2>
                        </div>
                        <?php
                        include 'konek.php';
                        $namaBulan = array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");

                        $querys = "SELECT * FROM t_data_penilaian WHERE status = '1' ORDER BY tanggal DESC";
                        $result = $db_li->query($querys);
                        $total = $result->num_rows;

                        $querysp = "SELECT * FROM t_pegawai";
                        $resultp = $db_li->query($querysp);
                        while ($rowp = $resultp->fetch_assoc()) {
                            $nm_pegawai[$rowp['ID_PEGAWAI']] = $rowp['NIK'] . ' - ' . $rowp['NM_PEGAWAI'];
                        }

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
                                <th class="center">KARYAWAN TERBAIK</th>
                                <th class="center">SKOR KINERJA</th>
                                <th class="center">TANGGAL</th>
                                <th class="center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;

                            if ($_SESSION['level'] == 1) {
                                $page = 'laporanKabag';
                            } else {
                                $page = 'laporanKasi';
                            }
                            while ($row = $result->fetch_assoc()) {

                                $querysus = "SELECT * FROM t_user WHERE hak_akses = '0' ORDER BY id_user;";
                                $resultsus = $db_li->query($querysus);
                                while ($rowsus = $resultsus->fetch_assoc()) {
                                    $nilaik = getnilaikaryawan($row['id'], $row['id_pegawai'], $rowsus['id_user']);
                                    $nilai[$row['id_pegawai']] += $nilaik;
                                }
                            ?>
                                <tr>
                                    <td class="center"><?php echo $no; ?></td>
                                    <td class="center" style="vertical-align:middle;"><?php echo strtoupper($namaBulan[$row['bulan']]); ?></td>
                                    <td class="center" style="vertical-align:middle;"><?php echo $row['tahun']; ?></td>
                                    <td class="center" style="vertical-align:middle;"><?php echo $nm_pegawai[$row['id_pegawai']];; ?></td>
                                    <td class="center" style="vertical-align:middle;">
                                        <font size="4px"><b><?php echo $nilai[$row['id_pegawai']]; ?></b></font>
                                    </td>
                                    <td class="center" style="vertical-align:middle;"><?php echo date("d/m/Y H:i", strtotime($row['tanggal'])); ?></td>
                                    <td class="center">
                                        <a href="index.php?page=<?php echo $page; ?>&id=<?php echo $row['id']; ?>"><button class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-search"></i> DETAIL</button></a>
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

    <div id="modalimportguru" class="modal-block modal-header-color modal-block-success mfp-hide">
        <section class="panel">
            <form action="proses/evaluasi/proses_import.php" method="post" enctype="multipart/form-data">
                <header class="panel-heading">
                    <h2 class="panel-title">Import Data Kehadiran Guru & Pegawai</h2>
                </header>
                <div class="panel-body" id="modalcontenteditguru">

                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-default modal-dismiss">Tutup</button>
                            <button type="submit" id="edit_guru" class="btn btn-success">Import</button>
                        </div>
                    </div>
                </footer>
            </form>
        </section>
    </div>

    <div id="modaleditguru" class="modal-block modal-header-color modal-block-warning mfp-hide">
        <section class="panel">
            <form method="POST" action="proses/evaluasi/proses_kehadiran.php">
                <header class="panel-heading">
                    <h2 class="panel-title">Form Data Kehadiran Guru & Pegawai</h2>
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
            <form method="POST" action="proses/evaluasi/proses_hapus_kehadiran.php">
                <header class="panel-heading">
                    <h2 class="panel-title">Hapus Data Kehadiran</h2>
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
            $('#example').DataTable({
                "lengthMenu": [
                    [5, 25, 50, -1],
                    [5, 25, 50, "All"]
                ]
            });
        });
    </script>
    <script type="text/javascript">
        $('.import-guru').click(function() {
            var id = $(this).attr('id');
            $.ajax({
                cache: false,
                type: 'POST',
                url: 'view/evaluasi/form_import_kehadiran.php',
                data: 'id=' + id,
                success: function(data) {
                    $('#modaleditguru').show();
                    $('#modalcontenteditguru').show().html(data);
                }
            });
        });

        $('.edit-guru').click(function() {
            var id = $(this).attr('id');
            $.ajax({
                cache: false,
                type: 'POST',
                url: 'view/evaluasi/form_edit_kehadiran.php',
                data: 'id=' + id,
                success: function(data) {
                    $('#modaleditguru').show();
                    $('#modalcontenteditguru').show().html(data);
                }
            });
        });

        $('.delete-guru').click(function() {
            var id = $(this).attr('id');
            $.ajax({
                cache: false,
                type: 'POST',
                url: 'view/evaluasi/form_hapus_kehadiran.php',
                data: 'id=' + id,
                success: function(data) {
                    $('#modaldeleteguru').show();
                    $('#modalcontentdeleteguru').show().html(data);
                }
            });
        });
    </script>