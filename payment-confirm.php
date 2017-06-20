<?php
include('config.php');
$ch = curl_init();

$paymentID = $_REQUEST["payment_id"];

curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/payments/payment/".$paymentID);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_USERPWD, $clientId.":".$secret);
$result = curl_exec($ch);
$data = json_decode($result);
curl_close($ch);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Paypal Server-side REST Integration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Payment Confirmed</a>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
    </div>
    <div class="col-sm-8 text-left" style="margin-top:50px"> 
    <h3>Payment Details : </h3><br/>
     <ul class="list-group">
        <li class="list-group-item">Payment ID : <?php echo $data->id; ?></li>
        <li class="list-group-item">Payment Method : <?php echo $data->payer->payment_method; ?></li>
        <li class="list-group-item">Payment State : <?php echo $data->state; ?></li>
        <li class="list-group-item">Payer Name : <?php echo $data->payer->payer_info->first_name." ".$data->payer->payer_info->last_name; ?></li>
        <li class="list-group-item">Payer Email : <?php echo $data->payer->payer_info->email; ?></li>
        <li class="list-group-item">Amount Paid : <?php echo $data->transactions[0]->amount->total." ".$data->transactions[0]->amount->currency; ?></li>
     </ul>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>&copy; PayPal Server-side REST Integration</p>
</footer>

</body>
</html>
