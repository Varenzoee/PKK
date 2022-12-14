<?php
session_start();
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



<!-- end: page -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable-default').DataTable({
            //"order": [[ 1, "asc" ]],
            "pageLength": 5
        });
    });
</script>