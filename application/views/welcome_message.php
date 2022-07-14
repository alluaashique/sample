<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container">
		<form action="<?= base_url('User/login');?>" method="post">
            <div class="mb-3 mt-3">
                <label for="email" class="form-label">Email/User Name:</label>
                <input type="text" class="form-control" id="uname" placeholder="Enter email/User Name" name="uname">
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                Registration
            </button>
        </form>
    </div>
    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">

                    <h4 class="modal-title">
                        <center>Registration</center>
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container">
                        <form action="<?= base_url('User/signup');?>" method="post">
                            <div class="mb-3 mt-3">
                                <label for="email" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter name"
                                    name="name">
                            </div>
							<div class="mb-3 mt-3">
                                <label for="email" class="form-label">Email/User Name:</label>
                                <input type="text" class="form-control" id="uname" placeholder="Enter Email/User Name"
                                    name="uname">
                            </div>
							<div class="mb-3 mt-3">
                                <label for="email" class="form-label">Phone:</label>
                                <input type="text" class="form-control" id="ph" placeholder="Enter phone"
                                    name="ph">
                            </div>
							<div class="mb-3 mt-3">
                                <label for="email" class="form-label">Password:</label>
                                <input type="password" class="form-control" id="pwd" placeholder="Enter Password"
                                    name="pwd">
                            </div>
                            <div class="mb-3">
                                <label for="pwd" class="form-label">Confirm Password:</label>
                                <input type="password" class="form-control" id="pwd1" placeholder="Enter Confirm password"
                                    name="pwd1">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            
                        </form>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

</body>

</html>