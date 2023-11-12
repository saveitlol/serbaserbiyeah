<?php include("db.php"); 
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
  $query = "UPDATE tb_product set product_id = '$product_id', product_name = '$product_name', stock = '$stock', price = '$price' WHERE id=$id";
  mysqli_query($conn, $query);
  $_SESSION['message'] = 'Task Updated Successfully';
  $_SESSION['message_type'] = 'warning';
  header('Location: index.php');
}
?>

<?php include('includes/header.php'); ?>

<main class="container p-4">
  <div class="row">
    <div class="card card-body">

      <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
          <?= $_SESSION['message']?>
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php session_unset(); } ?>

      <h1 style="text-align:center">PHP - CRUD</h1>
      <div class="col-sm-12">
      </div>
      <button type="button" class="btn btn-primary position-static" data-bs-toggle="modal" data-bs-target="#add">Tambah Data</button>
      <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="card card-body">
                  <form action="create.php" method="POST">
                    <div class="mb-3">
                      <label for="productid" class="form-label">Produk id </label>
                      <input type="text" name="product_id" class="form-control" placeholder="Product id" autofocus>
                    </div>
                    <div class="mb-3">
                      <label for="productname" class="form-label">Nama Produk </label>
                      <input type="text" name="product_name" class="form-control" placeholder="nama produk" autofocus>
                    </div>
                    <div class="mb-3">
                      <label for="Stok" class="form-label">Stok</label>

                      <input type="number" name="stock" class="form-control" placeholder="Stock" autofocus>
                    </div>
                    <div class="mb-3">
                      <label for="Harga" class="form-label">Harga</label>
                      <input type="number" name="price" class="form-control" placeholder="Harga" autofocus>
                    </div>
                    <input type="submit" name="create" class="btn btn-success btn-block" value="Save">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <!-- read -->
    <div class="col-md-20">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Id Produk</th>
            <th>Nama Produk</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $query = "SELECT * FROM tb_product";
          $result_product = mysqli_query($conn, $query);
          while($row = mysqli_fetch_assoc($result_product)) { ?>
          <tr>
            <td><?php echo $row['product_id']; ?></td>
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $row['stock']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td>
              <a href="" data-bs-toggle="modal"data-bs-target="#modal<?php echo $row['id']?>"class="btn btn-secondary">
                <i class="fa fa-solid fa-marker"></i>
              </a>
              <a href="update.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                <i class="fa fa-solid fa-marker"></i>
              </a>
              <!-- onclick="return confirm('Are you sure?')" -->
              <a href="delete.php?id=<?php echo $row['id']?>" class="btn btn-danger" data-bs-target="#deleteModal"data-bs-toggle="modal">
                <i class="far fa-trash-alt"></i>
              </a>
              <!-- Modal -->
              <div class="modal fade" id="deleteModal">
                <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" >Confirm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure you want to delete?</p>
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >No</button>
                    <a href="delete.php?id=<?php echo $row['id']?>"><button type="button" class="btn btn-danger">Yes</button></a>
                  </div>
                  </div>
                </div>
              </div>

              <!-- edit -->
              <div class="modal fade" id="modal<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel"aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                          </button>
                      </div>
                      <!-- di dalam modal-body terdapat 4 form input yang berisi data.
                      data-data tersebut ditampilkan sama seperti menampilkan data pada tabel. -->
                      <div class="modal-body">
                          <form method="POST" >
                              <div class="form-group">
                                  <label for="exampleFormControlInput1">Nama Barang</label>
                                  <input type="text" class="form-control" value="<?php echo $row['product_id']; ?>">
                              </div>
                              <div class="form-group">
                                  <label for="exampleFormControlInput1">Nama Barang</label>
                                  <input type="text" class="form-control" value="<?php echo $row['product_name']; ?>">
                              </div>
                              <div class="form-group">
                                  <label for="exampleFormControlTextarea1">Deskripsi Barang</label>
                                  <textarea class="form-control" rows="5"><?php echo $row['deskripsi_barang']; ?></textarea>
                              </div>
                              <div class="form-group">
                                  <label for="exampleFormControlInput1">Jenis Barang</label>
                                  <input type="text" class="form-control" value="<?php echo $row['stock']; ?>">
                              </div>
                              <div class="form-group">
                                  <label for="exampleFormControlInput1">Harga Barang</label>
                                  <input type="text" class="form-control" value="<?php echo $row['price']; ?>">
                              </div>
                          </form>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-primary" name="update">Save changes</button>
                      </div>
                  </div>
              </div>
          </div>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    </div>
  </div>
</main>

<?php include('includes/footer.php'); ?>
