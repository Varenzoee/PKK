<?php
@session_start();
date_default_timezone_set("Asia/Jakarta");
set_time_limit(0);

//fungsi create
function create($table, $data)
{
    include('konek.php');
    foreach ($data as $field => $value) {
        $values[] = "'" . addslashes($data[$field]) . "'";
        $fields[] = "`" . $field . "`";
    }
    $value_list = join(",", $values);
    $field_list = join(",", $fields);
    $query = "INSERT INTO " . $table . " (" . $field_list . ") VALUES (" . $value_list . ")";
    $hasil = $db_li->query($query);
    return $hasil;
}

//fungsi createOnUpdate
function createOnUpdate($table, $data)
{
    include('konek.php');
    foreach ($data as $field => $value) {
        $values[] = "'" . addslashes($data[$field]) . "'";
        $fields[] = "`" . $field . "`";
        $dt[] = "`" . $field . "` = '" . addslashes($data[$field]) . "' ";
    }
    $value_list = join(",", $values);
    $field_list = join(",", $fields);
    $data_list = join(",", $dt);

    $query = "INSERT INTO " . $table . " (" . $field_list . ") VALUES (" . $value_list . ")
        ON DUPLICATE KEY UPDATE " . $data_list;
    $hasil = $db_li->query($query) or die(mysqli_error($db_li));
    return $hasil;
}

//fungsi edit
function update($table, $data, $where)
{
    include('konek.php');
    foreach ($where as $f_where => $v_where) {
        $vws[] = "`" . $f_where . "` = '" . addslashes($where[$f_where]) . "'";
    }
    foreach ($data as $field => $value) {
        $dt[] = "`" . $field . "` = '" . addslashes($data[$field]) . "' ";
    }
    $data_list = join(",", $dt);
    $where_list = join(" AND ", $vws);
    $query = "UPDATE $table SET $data_list WHERE $where_list ";
    $hasil = $db_li->query($query);
    return $hasil;
}

//fungsi delete
function delete($table, $where)
{
    include('konek.php');
    foreach ($where as $f_where => $v_where) {
        $vws[] = "`" . $f_where . "` = '" . addslashes(trim($where[$f_where])) . "'";
    }
    $where_list = join(" AND ", $vws);
    $query = "DELETE FROM $table WHERE $where_list ";
    $hasil = $db_li->query($query);
    return $hasil;
}

function sql($sql)
{
    include('konek.php');
    $hasil = $db_li->query($sql);
    return $hasil;
}

function query($table, $where)
{
    include 'konek.php';
    if ($where != '') {
        foreach ($where as $f_where => $v_where) {
            $vws[] = "`" . $f_where . "` = '" . $where[$f_where] . "'";
        }
        $where_list = join(" AND ", $vws);
        $query = "SELECT * FROM $table WHERE $where_list";
    } else {
        $query = "SELECT * FROM $table";
    }
    $result = $db_li->query($querys);
    return $result;
}

/* function geturl()
{
    include 'konek.php';
    $query = "SELECT * FROM t_config";
    $hasil = $db_li->query($query);
    $row = $hasil->fetch_assoc();
    $result = $row['link_website'];

    return $result;
}

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


function homeinfo($jenis)
{
    include 'konek.php';

    $date = date("Y-m-1");
    $date2 = date("Y-m-d");

    if ($jenis == '1') {
        $query = "SELECT COUNT(*) AS TOTAL FROM t_jenis_produk";
    } else if ($jenis == '2') {
        $query = "SELECT COUNT(*) AS TOTAL FROM t_lisensi_serial_produk";
    } else if ($jenis == '3') {
        $query = "SELECT COUNT(*) AS TOTAL FROM t_lisensi_serial_produk_log";
    } else if ($jenis == '4') {
        $query = "SELECT COUNT(*) AS TOTAL FROM t_link";
    } else if ($jenis == '5') {
        $query = "SELECT COUNT(*) AS TOTAL FROM t_log WHERE DATETIME BETWEEN '$date' AND '$date2' ORDER BY DATETIME DESC";
    } else if ($jenis == '6') {
        $query = "SELECT COUNT(*) AS TOTAL FROM t_log WHERE DATETIME BETWEEN '$date2 00:00:00' AND '$date2 23:59:59' ORDER BY DATETIME DESC";
    }

    $hasil = $db_li->query($query);
    $row = $hasil->fetch_assoc();

    return $row['TOTAL'];
}

function tajar()
{
    if ($_SESSION['AJARAN_data_center'] != "") {
        return $_SESSION['AJARAN_data_center'];
    } else {
        if (date('m') > 6) {
            $th = date('Y') - 1994;
        } else {
            $th = date('Y') - 1995;
        }
    }
    return $th;
}

 function tanggal_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $split = explode('-', $tanggal);
    return $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
}*/

function getnilaikaryawan($id, $id_pegawai, $id_user)
{
    include 'konek.php';
    $querysp = "SELECT * FROM t_penilaian WHERE id_data_penilaian = '$id' AND id_pegawai = '$id_pegawai' AND id_user = '$id_user'";
    $resultp = $db_li->query($querysp);
    $rowp = $resultp->fetch_assoc();
    $result = $rowp['cso'] + $rowp['jujur'] + $rowp['tggjwb'] + $rowp['kerjasama'] + $rowp['skill'] + $rowp['inovasi'];

    return $result;
}

function getstatuspenilaian($id, $id_user)
{
    include 'konek.php';
    $querysp = "SELECT * FROM t_penilaian WHERE id_data_penilaian = '$id' AND id_user = '$id_user'";
    $resultp = $db_li->query($querysp);
    $total = $resultp->num_rows;
    if ($total > 0) {
        $result = '<th class="center"><font color="green"><span class="glyphicon glyphicon-ok"></span></font></th>';
    } else {
        $result = '<th class="center"><font color="red"><span class="	glyphicon glyphicon-remove"></span></font></th>';
    }

    return $result;
}

function getstatuskabag($id)
{
    include 'konek.php';
    $queryspeg = "SELECT * FROM t_pegawai";
    $resultpeg = $db_li->query($queryspeg);
    $totalpeg = $resultpeg->num_rows;

    $querysus = "SELECT * FROM t_user WHERE hak_akses = '0' ORDER BY id_user;";
    $resultsus = $db_li->query($querysus);
    while ($rowsus = $resultsus->fetch_assoc()) {
        $id_user = $rowsus['id_user'];
        $querysp = "SELECT * FROM t_penilaian WHERE id_data_penilaian = '$id' AND id_user = '$id_user'";
        $resultp = $db_li->query($querysp);
        $total = $resultp->num_rows;

        if ($total == $totalpeg) {
            $result++;
        } else {
            $result = 0;
        }
    }



    return $result;
}
