<?php
require "./Classes/PHPExcel.php";
if(isset($_POST['btnnhap'])) {
    $checkNull = $_FILES['file']['error'];
    $can_pass = $checkNull == 0 ? true : false;
    if ($can_pass) {
    $file = $_FILES['file']['tmp_name'];
    $objReader = PHPExcel_IOFactory::createReaderForFile($file);
    $objReader->setLoadSheetsOnly('cauhoi');
    $objExcel = $objReader->load($file);
    $sheetData = $objExcel->getActiveSheet()->toArray('null',true,true,true);
    $highestRow = $objExcel->setActiveSheetIndex()->getHighestRow();
    for($row = 2; $row <= $highestRow; $row++){
        
        $idloai = $sheetData[$row]['B'];
        $debai = $sheetData[$row]['C'];
        $da1 = $sheetData[$row]['D'];
        $da2 = $sheetData[$row]['E'];
        $da3 = $sheetData[$row]['F'];
        $da4 = $sheetData[$row]['G'];
        $kq = $sheetData[$row]['H'];
        $gt = $sheetData[$row]['I'];
        $is_Active = $sheetData[$row]['J'];

        $sql ="INSERT INTO hoctuvung(idloai,tenbaitap,dan1,dan2,dan3,dan4,dapan,giaithich,is_Active)
        values('$idloai','$debai','$da1','$da2','$da3','$da4','$kq','$gt','$is_Active')";
        $con->query($sql);
        $soSP = $highestRow - 1;
        $msg = "Nhập file thành công ! Đã thêm "  .$soSP. " sản phẩm !";
        echo "<script type='text/javascript' >alert('$msg');document.location = 'http://localhost/webTA/admin/admin/manage-games.php'</script>";
    }
    }else{
        echo "<script type='text/javascript' >alert('ban can nhap file');document.location = 'http://localhost/webTA/admin/admin/manage-games.php'</script>";
    }
}
?>