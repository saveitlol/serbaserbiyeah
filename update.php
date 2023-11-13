<?php
include("db.php");
$product_id = '';
$product_name= '';
$stock= '';
$price= '';

if  (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM tb_product WHERE id=$id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $product_id = $row['product_id'];
    $product_name = $row['product_name'];
    $stock = $row['stock'];
    $price = $row['price'];

  }
}

if (isset($_POST['update'])&& isset($_POST['id'])&& isset($_POST['product_id'])&& isset($_POST['product_name'])&& isset($_POST['stock'])&& isset($_POST['price'])) {
  $id = $_POST['id'];
  $product_id = $_POST['product_id'];
  $product_name = $_POST['product_name'];
  $stock = $_POST['stock'];
  $price = $_POST['price'];
  $query = ("UPDATE tb_product set `product_id` = '$product_id', `product_name` = '$product_name', `stock` = '$stock', `price` = '$price' WHERE `id`=$id");
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Task Updated Successfully';
  $_SESSION['message_type'] = 'warning';
  header('Location: index.php');
}

?>

