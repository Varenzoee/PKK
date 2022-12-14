<?php
include 'konek.php';
$namaBulan = array(1 => "Januari", 2 => "Februari", 3 => "Maret", 4 => "April", 5 => "Mei", 6 => "Juni", 7 => "Juli", 8 => "Agustus", 9 => "September", 10 => "Oktober", 11 => "November", 12 => "Desember");

$querys1 = "SELECT * FROM t_pegawai";
$result1 = $db_li->query($querys1);
$total1 = $result1->num_rows;

$querys2 = "SELECT * FROM t_data_penilaian WHERE status = '1'";
$result2 = $db_li->query($querys2);
$total2 = $result2->num_rows;

$querys3 = "SELECT * FROM t_data_penilaian WHERE STATUS = '1' ORDER BY tanggal DESC LIMIT 1";
$result3 = $db_li->query($querys3);
$row3 = $result3->fetch_assoc();

$querysp = "SELECT * FROM t_pegawai";
$resultp = $db_li->query($querysp);
while ($rowp = $resultp->fetch_assoc()) {
    $nm_pegawai[$rowp['ID_PEGAWAI']] = $rowp['NM_PEGAWAI'];
}
?>
<div class="row">
    <div class="col-md-6 col-lg-12 col-xl-6">
        <div class="row">
            <div class="col-md-12 col-lg-4 col-xl-4">
                <div class="panel panel-featured-left panel-featured-success">
                    <div class="panel-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-success" style="line-height: 85px;width: 80px;height: 80px;">
                                    <i class="glyphicon glyphicon-user"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h5 class="title"><b>TOTAL PEGAWAI</b></h5>
                                    <h6 class="title">Dinas Pemberdayaan Masyarakat dan Desa </h6>
                                    <div class="info">
                                        <strong class="amount" style="font-size:15wv;">
                                            <?php echo $total1; ?>
                                        </strong>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4 col-xl-4">
                <div class="panel panel-featured-left panel-featured-primary">
                    <div class="panel-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-primary" style="line-height: 85px;width: 80px;height: 80px;">
                                    <i class="glyphicon glyphicon-flash"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h5 class="title"><b>TOTAL PENILAIAN</b></h5>
                                    <h6 class="title">Yang sudah dilakukan</h6>
                                    <div class="info">
                                        <strong class="amount" style="font-size:15wv;">
                                            <?php echo $total2; ?>
                                        </strong>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-4 col-xl-4">
                <div class="panel panel-featured-left panel-featured-danger">
                    <div class="panel-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-danger" style="line-height: 85px;width: 80px;height: 80px;">
                                    <i class="glyphicon glyphicon-thumbs-up"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h5 class="title" id="two"><b>PEGAWAI TERBAIK</b></h5>
                                    <h6 class="title"><?php echo strtoupper($namaBulan[$row3['bulan']]) . ' ' . $row3['tahun'] ?></h6>
                                    <div class="info">
                                        <strong class="amount" style="font-size:13pt;">
                                            <?php echo $nm_pegawai[$row3['id_pegawai']]; ?>
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-12 col-xl-12">
        <section class="panel panel-warning">
            <header class="panel-heading">
                <h2 class="panel-title">DAFTAR PEGAWAI TERBAIK DINAS PEMBERDAYAAN MASYARAKAT DAN DESA</h2>
            </header>
            <div class="panel-body">
                <table class="table table-bordered table-striped mb-none" id="datatable-default">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama Pegawai</th>
                            <th>No.HP</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $querys = "SELECT * FROM t_pegawai ORDER BY NM_PEGAWAI ASC";
                        $result = $db_li->query($querys);
                        $no = 1;

                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $row['NIK']; ?></td>
                                <td><?php echo $row['NM_PEGAWAI']; ?></td>
                                <td><?php echo $row['NO_HP']; ?></td>
                                <td><?php echo $row['EMAIL']; ?></td>
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

<!-- end: page -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable-default').DataTable({
            //"order": [[ 1, "asc" ]],
            "pageLength": 5
        });
    });
</script>