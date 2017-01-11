<!DOCTYPE html>
<html>
<style>
@import url('https://fonts.googleapis.com/css?family=Bitter|Lemonada');
body {
	background-color: #fdebd0;
}

h1 {
	font-family: 'Bitter', serif;
    color: black;
    text-align: center;
}

fieldset#f1 {
	font-family: 'Lemonada', cursive;
    font-size: 18px;
	text-align: center;
	width: auto;
	border-width: 3px;
	border-style: solid;
	border-color: salmon;
}

input[type="text"] {
	width: 90px;
	height: 25px;
}

input[type="submit"] {
	margin:0 auto;
}

fieldset#f2 {
	font-family: 'Lemonada', cursive;
    font-size: 18px;
	color: #903014;
	background-color: #f5b7b1;
	text-align: center;
	width: auto;
}
</style>

<head>
 <link rel="stylesheet" type="text/css" href="theme.css">
 <TITLE>Tip Calculator</TITLE>
</head>

<body>

<?php
$subtotalErr = $percentageErr = "";
$subtotal = $percentage = $tipResult = $totalResult = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["subtotal"])) {
    $subtotalErr = "<font color='red'>required</font>";
  } 
  else {
    $subtotal = $_POST["subtotal"];
    if (preg_match("/^[a-zA-Z ]*$/",$subtotal)) {
      $subtotalErr = "<font color='red'>*only numbers allowed</font>";
    }
	if ($subtotal <= "0") {
	  $subtotalErr = "<font color='red'>*subtotal should be greater than 0</font>";
	}
  }
  
  if (empty($_POST["percentage"])) {
    $percentageErr = "<font color='red'>*required</font>";
  }
  else {
    $percentage = $_POST["percentage"];
  }
  
  if (!empty($percentage) && !empty($subtotal)) {
		$tipAmount = $percentage * $subtotal;
		$totalAmount = $subtotal + $tipAmount;
		$tipResult = "Tip: $ " . $tipAmount;
		$totalResult = "Total: $ " . $totalAmount;
	}
}

?>

<fieldset id="f1">
  <h1>Tip Calculator</h1>
  
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  
  <p>Bill Subtotal: $ <input type="text" name="subtotal" value="<?php echo $subtotal;?>">
  <span class="error"><?php echo $subtotalErr;?></span>
  </p>
  
  <p>
	Tip Percentage:<br>
	<input type="radio"
		   name = "percentage"
		   value = "0.1" />
	<label for = "ten">10%</label>
	<input type="radio"
		   name = "percentage"
		   value = "0.15" />
	<label for = "fifteen">15%</label>
	<input type="radio"
		   name = "percentage"
		   value = "0.2" />
	<label for = "twenty">20%</label>
	<span class="error"><?php echo $percentageErr;?></span>
  </p>
  <input type="submit" class="submit" value="Submit" />
  </form>
  
  <p>
  <fieldset id="f2">
  <?php echo $tipResult; ?><br>
  <?php echo $totalResult; ?>
  </fieldset>
  </p>
  
</fieldset>

</body>
</html>