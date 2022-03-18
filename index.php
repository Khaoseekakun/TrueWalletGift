<?php

$link = ''; //ระบุลิงก์
$phone = ''; //เบอร์โทรศัพท์

if(empty($link)){
    // ลิงก์ว่างเปล่า
}else{
    require_once("_system/Wallet/_WalletSystem.php");
    $topup_truewallet = new topup();
    $truewallet = (object) $topup_truewallet->giftcode($link ,$phone);

    if($truewallet->status['code'] == 'VOUCHER_OUT_OF_STOCK'){
    // ซองเติมเงินนี้ถูกใช้งานไปแล้ว
    }elseif($truewallet->status['code'] == 'VOUCHER_EXPIRED'){
        // ซองเติมเงินนี้หมดอายุ
    }
    elseif($truewallet->status['code'] == 'VOUCHER_NOT_FOUND'){
        // ไมพบซอง
    }else{
        if($truewallet->data['voucher']['member'] != "1"){
            // ผู้รับซองต้องเป็น 1 คน
        }else{
            // เติมเงินสำเร็จ

            $data = [ 'code' => '004', 'msg' => 'คุณได้เติมเงินสำเร็จแล้ว', 'amount' => $amount ];
            $amounts = $truewallet->data['voucher']['amount_baht'];
            $amount = str_replace(",", "", trim($amounts));

            echo "เติมเงินด้วยลิงก์ ".$link."";
            echo "จำนวนเงิน ".$amount."";
        }
    }
}

//By KhaoSeekakun
