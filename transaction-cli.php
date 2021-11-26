<?php
    require_once "koneksi_db.php";

    $references_id = $argv[1];
    $status = $argv[2];
    
    if ($references_id !== "") {
        if ($status !== "") {

            $status = strtolower($status);

            $query = "update t_m_transaksi_pembayaran set status = '".$status."' 
                      where references_id = '".$references_id."'";
            $result = $connect->query($query);
            if ($result) {
                echo "Berhasil merubah status transaksi";
            } else {
                echo "Gagal merubah status transaksi";
            }
        } else {
            echo "Parameter status harus diisi";
        }
    } else {
        echo "Parameter references_id harus diisi";
    }

?>