<?php
    require_once "koneksi_db.php";

    if(function_exists($_GET['function'])) {
        $_GET['function']();
    } 

    function get_transaction() {
        global $connect;

        $query = "SELECT * FROM t_m_transaksi_pembayaran";
        $result = $connect->query($query);
        $row = mysqli_fetch_object($result);

        if ($row == NULL || $row == "") {
            $response = array(
                'status' => 404,
                'message' => 'Transaksi tidak ditemukan'  
            );
        } else {
            while($row = mysqli_fetch_object($query)) {
                $data[] =$row;
            }

            $response = array(
                'status' => 200,
                'message' =>'Success',
                'data' => $data
            );
        }       
        
        header('Content-Type: application/json');
        echo json_encode($response);
    }   
   
    function get_transaction_id() {
       
        global $connect;

        if (!empty($_GET["references_id"]) && !empty($_GET["merchant_id"])) {
            $references_id = $_GET["references_id"];
            $merchant_id = $_GET["merchant_id"];

            $query ="SELECT references_id, invoice_id, status FROM t_m_transaksi_pembayaran 
                     WHERE references_id = '".$references_id."' && merchant_id = '".$merchant_id."'"; 
            $result = $connect->query($query);
            var_dump($result);
            if ($result->num_rows > 0) {
                
                $data = array();
                while($row = mysqli_fetch_object($result)) {
                    $data[] = $row;
                }
    
                $response = array(
                    'status' => 200,
                    'message' => 'Success',
                    'data' => $data
                );
            } else {
                $response = array(
                    'status' => 404,
                    'message' => 'Transaksi tidak ditemukan'  
                );
            }
        } else {
            $response = array(
                'status' => 401,
                'message' => 'Parameter references_id dan merchant_id tidak ditemukan'  
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
    
    function insert_transaction() {
    
        global $connect;   
        
        $check = array(
            'invoice_id' => '',
            'item_name' => '',
            'amount' => '',
            'payment_type' => '',
            'customer_name' => '',
            'merchant_id' => ''
        );

        $check_match = count(array_intersect_key($_POST, $check));
        
        if($check_match == count($check)) {

            $checkInvoiceId = "SELECT invoice_id FROM t_m_transaksi_pembayaran 
                               WHERE invoice_id = '".$_POST['invoice_id']."'";      
            $result = $connect->query($checkInvoiceId);
            $getInvoiceId = mysqli_fetch_row($result);

            if ($getInvoiceId == NULL || $getInvoiceId == "") {

                $references_id = rand(10,100);

                echo $sql = "insert into t_m_transaksi_pembayaran(invoice_id, references_id, item_name, 
                             amount, payment_type, customer_name, merchant_id, status) values 
                             ('".$_POST['invoice_id']."', '".$references_id."', '".$_POST['item_name']."', 
                             '".$_POST['amount']."', '".$_POST['payment_type']."', 
                             '".$_POST['customer_name']."', '".$_POST['merchant_id']."', 'Pending')";
                $result = $connect->query($sql);
                
                if($result) {
                    if ($_POST['payment_type'] == "virtual_account") {
                        $response_data = array(
                            'references_id' => $references_id,
                            'va_number' => '12345678910',
                            'status' => 'pending'
                        );
                    } else {
                        $response_data = array(
                            'references_id' => $references_id,
                            'va_number' => '',
                            'status' => 'pending'
                        );
                    }

                    $response = array(
                        'status' => 200,
                        'message' => 'Sukses menambahkan data transaksi',
                        'data' => $response_data
                    );
                } else {
                    $response = array(
                        'status' => 404,
                        'message' => 'Gagal menambahkan data transaksi'
                    );
                }
            } else {
                $response = array(
                    'status' => 402,
                    'message' =>'Invoice ID sudah ada'
                );
            }
        } else {
            $response = array(
                'status' => 401,
                'message' => 'Parameter yang dimasukan salah atau kurang'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
 ?>