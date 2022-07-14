<body>
    <div class="container-fluid">

        <form action="<?=base_url('Admin/ad_product');?>" method="post">
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">Product:</label>
                <input type="text" class="form-control" id="pro" placeholder="Enter Product" name="pro">
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Batch:</label>
                <input type="text" class="form-control" id="bat" placeholder="Enter Batch" name="bat">
            </div>
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">Quantity:</label>
                <input type="text" class="form-control" id="qty" placeholder="Enter Quantity" name="qty">
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Amount:</label>
                <input type="text" class="form-control" id="amt" placeholder="Enter Amount" name="amt">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div class="container mt-3">
  <h2>Product Table</h2>          
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Sl No</th>
        <th>Name</th>
        <th>Batch</th>
        <th>Quantity</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody>
        <?php $n=1; foreach($prod as $row) { ?>
      <tr>
        <td><?= $n++; ?></td>
        <td><?= $row->p_name?></td>
        <td><?= $row->p_batch?></td>
        <td><?= $row->p_qty?></td>
        <td><?= $row->p_amt?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

    </div>