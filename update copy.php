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

if (isset($_POST['update'])) {
  $id = $_GET['id'];
  $product_id = $_POST['product_id'];
  $product_name = $_POST['product_name'];
  $stock = $_POST['stock'];
  $price = $_POST['price'];
  $query = "UPDATE tb_product set `product_id` = '$product_id', `product_name` = '$product_name', `stock` = '$stock', `price` = '$price' WHERE `id`=$id";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }
  $_SESSION['message'] = 'Task Updated Successfully';
  $_SESSION['message_type'] = 'warning';
  header('Location: index.php');
}

?>

<!-- <?php include('includes/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-4 mx-auto">
      <div class="card card-body">
      <form action="update.php?id=<?php echo $_GET['id']; ?>"method="POST">
        <div class="mb-3">
          <label for="productid" class="form-label">Update produk id </label>
          <input name="product_id" type="text" class="form-control" value="<?php echo $product_id; ?>">
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Update name</label>
          <input name="product_name" type="text" class="form-control" value="<?php echo $product_name; ?>">
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Update stok</label>
          <input name="stock" type="number" class="form-control" value="<?php echo $stock; ?>">
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Update harga</label>
          <input name="price" type="number" class="form-control" value="<?php echo $price; ?>">
        </div>
        <button class="btn btn-success" name="update">
          Update
        </button>
      </form>
      </div>
    </div>
  </div>
</div>

<?php include('includes/footer.php'); ?> -->
