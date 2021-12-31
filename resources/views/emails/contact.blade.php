<!DOCTYPE html>
<html lang="en">
<head>
  <title>thecolouring.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h3>{{ $title }}</h3>
    <p>Contact Details</p>
    <div class="row">
    <h6><strong>Name:</strong></h6>&nbsp;<h6>{{ $name }}</h6>
   </div>
   <div class="row">
    <h6><strong>Email:</strong></h6>&nbsp;<p>{{ $email }}</p>
   </div>
   <div class="row">
    <strong><h6>Message:</h6></strong>&nbsp;<p>{{ $messages }}</p>
   </div> 
   
    <p>Thank you</p>
</div>    
</body>
</html>