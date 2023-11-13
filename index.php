<?php include("db.php"); 
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
              <a href="update-old.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
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
                      <div class="modal-body">
                          <form action="<?php echo $_GET['id']; ?>" method="POST" >
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
                              <input type="submit" name="update" class="btn btn-success btn-block" value="Save">
                          </form>
                      </div>
                      <div class="modal-footer">
                          <button type="submit" class="btn btn-primary" name="update" value="Save">Save changes</button>
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
