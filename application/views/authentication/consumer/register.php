<html>
<head>
  <title>Consumer Sign Up</title>
  <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
  <script type="text/javascript" src="/assets/js/jquery-1.7.1.min.js"></script>
  <script type="text/javascript" src="/assets/js/bootstrap.js"></script>
</head>
<body>

<div class="container">
  <div class="row">
    <form method="post" action="<?php echo site_url('authentication/consumer_signup') ?>" class="form-horizontal well">
      <fieldset>
        <legend>Sign up for an account now!</legend>
        <label>Desired Username</label>
        <input type="text" class="span3" placeholder="Enter Here...">
        <label>Choose a password</label>
        <input type="text" class="span3" placeholder="Enter Here...">
        <label>Confirm Password</label>
        <input type="text" class="span3" placeholder="Enter Here...">
        <label>First name</label>
        <input type="text" class="span3" placeholder="Enter Here...">
        <label>Last name</label>
        <input type="text" class="span3" placeholder="Enter Here...">
        <label>State name</label>
        <input type="text" class="span3" placeholder="Enter Here...">
        <label>City</label>
        <input type="text" class="span3" placeholder="Enter Here...">

      </fieldset>
      <button type="submit" class="btn">Submit</button>
    </form>
  </div>
  <!-- end row -->

</div>
<!-- end container -->

</body>
</html>
