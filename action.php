<?php 
session_start();
    require './includes/db.php';

    if(isset($_POST['pid'])){
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
    $pimage = $_POST['pimage'];
    $pcode = $_POST['pcode'];
    $pqty = 1;

    $stmt = $connectingDB->prepare("SELECT productCode FROM cart WHERE productCode=?");
    $stmt->bind_param("s",$pcode);
    $stmt->execute();
    $res = $stmt->get_result();
    $r = $res->fetch_assoc();
    //$r['productCode']=null;
    $code = $r['productCode'];

    if(!$code){
        $query = $connectingDB->prepare("INSERT INTO cart(productName,productPrice,productImage,Qty,totalPrice,productCode)VALUES(?,?,?,?,?,?)");
        $query->bind_param("sssiss",$pname,$pprice,$pimage,$pqty,$pprice,$pcode);
        $query->execute();
        echo('<div class="alert alert-success alert-dismissible mt-4">
                <button type="button" class="close" data-dismiss="alert">
                    &times;
                </button>
                <strong>Item Added To Your Cart</strong>
            </div>');
    }else{
        echo('<div class="alert alert-danger alert-dismissible mt-4">
        <button type="button" class="close" data-dismiss="alert">
            &times;
        </button>
        <strong>Item Already Added To Your Cart</strong>
        </div>');
    }
}
if(isset($_GET['cartItem'])&&isset($_GET['cartItem'])=='carditem'){
    $stmt = $connectingDB->prepare("SELECT * FROM cart");
    $stmt->execute();
    $stmt->store_result();
    $rows = $stmt->num_rows();

    echo $rows;

}
if(isset($_GET['remove'])){
    $id = $_GET['remove'];
    $stmt = $connectingDB->prepare("DELETE FROM cart WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'Item removed from the cart';
    header('location:cart.php');
}
if(isset($_GET['clear'])){
    $stmt = $connectingDB->prepare("DELETE  FROM cart");
    $stmt->execute();
    header('location:cart.php');
    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'All Items removed from the cart';
}
if(isset($_POST['qty'])){
    $qty = $_POST['qty'];
    $pid = $_POST['pid'];
    $pprice = $_POST['pprice'];

    $tprice = $qty*$pprice;
    $stmt= $connectingDB->prepare("UPDATE cart SET Qty=?, totalPrice=? WHERE id=?");
    $stmt->bind_param("isi",$qty,$tprice,$pid);
    $stmt->execute();
}
if(isset($_POST['action']) && isset($_POST['action'])=='order'){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $products = $_POST['products'];
    $grand_total = $_POST['grand_total'];
    $address= $_POST['address'];
    $pmode = $_POST['pmode'];

    $data='';
    $stmt = $connectingDB->prepare("INSERT INTO orders (name,email,phone,address,pmode,products,amountPaid) VALUES(?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssss",$name,$email,$phone,$pmode,$address,$products,$grand_total);
    $stmt->execute();
    //var_dump($stmt->execute);
    $data.='<div class="text-center">
                <h1 class="display-4 mt-2 text-danger">Thank You!</h1>
                <h2 class="text-success">Your Order Is Placed Successfully!</h2>
                <h4 class="bg-danger text-light rounded p-2">Items Purchased : '.$products.'</h4>
                <h4>Your Name : '.$name.' </h4>
                <h4>Your E-mail : '.$email.' </h4>
                <h4>Your Phone: '.$phone.'</h4>
                <h4>Total Amount Paid:'.number_format($grand_total,2).' </h4>
                <h4>Payment Mode: '.$pmode.'</h4>
            </div>';

    echo($data);

}
