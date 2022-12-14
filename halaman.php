<?php 
error_reporting(0);
@session_start();
switch ($_GET['page']) {
    
    //halaman
	case "dataPegawai":
        include 'view/pegawai/data_pegawai.php';
        break;	
	
	//Penilaian Kinerja		
	case "dataPenilaian":
        include 'view/penilaian/data_penilaian.php';
        break;
	case "penilaiankabag":
        include 'view/penilaian/penilaian_kabag.php';
        break;
	case "penilaianKasi":
        include 'view/penilaian/penilaian.php';
        break;	
	case "penilaian":
        include 'view/penilaian/penilaian.php';
        break;	
	case "laporan":
        include 'view/penilaian/laporan.php';
        break;
	case "laporanKasi":
        include 'view/penilaian/laporan_kasi.php';
        break;
	case "laporanKabag":
        include 'view/penilaian/laporan_kabag.php';
        break;		
		
	//Admin Panel	
    case "manajemenUser":
        include 'view/manajemen_user/manajemen_user.php';
        break;
	
	case "settingAplikasi":
        include 'view/admin_panel/setting_aplikasi.php';
        break;
	case "settingProfil":
        include 'view/admin_panel/setting_profil.php';
        break;	
	   
     case "exit":
        include 'proses/logout.php';
        exit();
        break;
    default:
        
          
        if(!empty($_GET['page'])){
                 echo "<script> $(document).ready(function(){ alertify.error('Halaman Yang anda minta tidak tersedia!'); }); </script>";
                 include_once 'error/404.php';
        }else{
            include_once 'home.php';
        }
        break;
}
?>