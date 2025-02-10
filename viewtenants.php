<?php
include 'ovalidate.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <head>
        <title>StayWell</title>
         <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" href="css/premium-style.css">
</head>
<body class="fade-in" style="background-image:url('img/15.jpg') ;background-repeat: no-repeat;background-size: cover;linear-gradient(to right, #3E5151 , #DECBA4);">
    <?php
    include 'onav.php';
    include 'conn.php';
    if(isset($_GET['delete']))
  {

       $id= $_GET['id'];

       //CODE TO DELETE DATA FROM MULTIPLE TABLES
        // $qry1="DELETE FROM tenant INNER JOIN transaction
        //       WHERE tenant.id='$id' and transaction.tid = '$tid'";
        // $run1=mysqli_query($con,$qry1);
     $qry1="DELETE FROM tenant WHERE id=$id";
      $run= mysqli_query($con,$qry1);
  }
    ?>
    <div class="container" style="margin-top: 80px;">
        <div class="card">
            <h2 class="text-center" style="color: var(--primary-color)">
                <i class="fa fa-users"></i> Tenant Management
            </h2>
            
            <div class="table-responsive">
                <table class="table table-hover table-premium">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Building</th>
                            <th>Apartment</th>
                            <th>Rent</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT t.*, b.Name as bname FROM tenant t 
                            LEFT JOIN apartment a ON t.apartment = a.id
                            LEFT JOIN building b ON a.bid = b.id";
                    if ($result = $con->query($sql)) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $row['id']?></td>
                            <td><?php echo $row['tname']?></td>
                            <td><?php echo $row['email']?></td>
                            <td><?php echo $row['mobile']?></td>
                            <td><?php echo $row['bname']?></td>
                            <td><?php echo $row['apartmentNum']?></td>
                            <td><?php echo $row['rent']?></td>
                            <td><?php echo $row['date']?></td>
                            <td>
                                <a href="viewtenants.php?delete=true&id=<?php echo $row['id'];?>" 
                                   class="btn btn-premium btn-sm">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                        }
                        $result->close();
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Add smooth fade-in animation to table rows
        $(document).ready(function() {
            $('tbody tr').each(function(index) {
                $(this).css('animation-delay', (index * 0.1) + 's');
                $(this).addClass('fade-in');
            });
        });
    </script>
</body>
