<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  
  
</head>


<nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><?= $_SESSION['name']; ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?=base_url('Admin/add_product');?>">add product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=base_url('Admin/bill');?>">billing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?=base_url('Admin/signout');?>">sign Out</a>
        </li>
      </ul>
    </div>
  </div>
</nav>