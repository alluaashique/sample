<body>
    <div class="container-fluid">

        <form action="<?=base_url('Admin/billing');?>" method="post">
            <div class="container mt-3">
                <h2>billing</h2>
                <table class="table">
                    <thead>
                        <tr>


                            <th>
                                <div class="mb-3">
                                    <label for="pwd" class="form-label">Customer ID:</label>
                                </div>
                            </th>
                            <th>
                                <select name="cust" id="cust" required class="form-control">
                                    <option value="">-SELECT-</option>
                                    <?php foreach($user as $row) { ?>

                                    <option value="<?= $row->lid;  ?>"><?=$row->uname;  ?></option>
                                    <?php } ?>

                                </select>

                            </th>

                        </tr>
                        <tr>

                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td><div id="list">shcj</div></td>
                        
                        </tr>

                        
                        <tr>
                            <td>
                                <div class="mb-3 mt-3">

                                    <input type="text" class="form-control" data-bs-toggle="modal"
                                        data-bs-target="#myModal" id="pro" readonly placeholder="Enter Product" name="pro">
                                </div>
                            </td>
                            
                            <td>
                                <div class="mb-3 mt-3">
                                    <input type="text" class="form-control" id="pro" readonly placeholder="Enter Product"
                                        name="pro">
                                </div>
                            </td>
                            <td>
                                <div class="mb-3 mt-3">
                                    <input type="text" class="form-control" id="pro" readonly placeholder="Enter Product"
                                        name="pro">
                                </div>
                            </td>
                            <td>
                                <div class="mb-3 mt-3">
                                    <input type="text" class="form-control" id="pro" readonly  placeholder="Enter Product"
                                        name="pro">
                                </div>
                            </td>

                        </tr>
                        <tr>

                            
                        </tr>
                    </tbody>
                    <td>
                                <div class="mb-12 mt-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </td>
                </table>
            </div>

    </div>
    </form> <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">


                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container">

                        <div class="container mt-3">
                            <h2>Products </h2>
                            <table class="table table-striped">
                                <thead>

                                </thead>
                                <tbody>
                                    <?php foreach($prod as $row) { $n=1;?>
                                    <tr>

                                        <td>

                                            <div class="mb-3 mt-3">
                                                <div class="form-control" onclick="add(<?= $row->p_id?>);">
                                                    <?= $row->p_name?>
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

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
<div id="hy"></div>

    <script>
         const tbodyEL = document.querySelector("tbody");
   
        function add(x) {
      
          $.ajax({ type:'POST',
				url:'<?=base_url("Admin/findamt")?>',
				data:{'id':x,
						
					            },
				
					
                    success:function(response){
                       
					var obj = JSON.parse(response);
                    tbodyEL.innerHTML += '<tr><td><div class="mb-3 mt-3"><input type="text" value="'+obj.pname+'" class="form-control" id="pro_name'+ obj.pid+'" name="pro_name"><input type="hidden" class="form-control" value="'+obj.pid+'" id="pro_id'+obj.pid+'" name="pro_id[]"> </div></td><td><div class="mb-3 mt-3"><input type="text" class="form-control" onkeyup="findtot('+obj.pid+')" id="qty'+obj.pid+'" name="qty[]"></div> </td><td><div class="mb-3 mt-3"> <input type="text" class="form-control" value="'+obj.pamt+'" id="amt'+obj.pid+'" name="amt[]"></div></td><td><div class="mb-3 mt-3"><input type="text" class="form-control" id="tot'+obj.pid+'" name="tot[]"></div></td></tr> ' ;
        
				
							
					},
				
				
			});
               




        }
        function findtot(x) {
        
        var qty='qty'+x;
        var amt='amt'+x;
        var tot='tot'+x;
        document.getElementById(tot).value=document.getElementById(qty).value*document.getElementById(amt).value;

        }
    

    


    </script>