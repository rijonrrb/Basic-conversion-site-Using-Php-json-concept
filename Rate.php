<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Conversion</title>
</head>
<body>
<?php 
$rateErr = $valueErr = $resErr = "";
$rateEr = $valueEr = $resEr = "";
$rate = $value = $res = "";
$flag = false;
define("filepath", "rate.txt");
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{ 

if (empty($_POST["rate"])) 
    {  
       $rateErr = " Field can't be empty";
       $flag = True;  
    } 

if (empty($_POST["value"])) 
    {  
       $valueErr = " Field can't be empty";
       $flag = True;  
    } 
if (empty($_POST["res"])) 
    {  
       $resErr = " Field can't be empty";
       $flag = True;  
    } 
 
if(!$flag) 
    {
   
    $rate = input_data($_POST["rate"]);
    if(is_numeric($_POST["value"]))
    {
    	$value = input_data($_POST["value"]);
    }
    else
    {
          $valueErr = "Value must be in numeric form";
    }
    if(is_numeric($_POST["res"]))
    {
    	$res = input_data($_POST["res"]);
    	
    }
    else
    {
          $resErr = "Value must be in numeric form";
    }
    $data = array("rate" => $rate,"value" => $value, "result" => $res);
    $data_encode = json_encode($data);
    write($data_encode); 
    
    }
 }
  function input_data($data) 
  {  
  $data = trim($data);  
  $data = stripslashes($data);  
  $data = htmlspecialchars($data);  
  return $data;  
  }
 function write($content) {
$file = fopen(filepath, "a");
$fw = fwrite($file, $content . "\n");
fclose($file);
return $fw;
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<fieldset>
<span style="color: red"><p>Page 2 [Conversion Rate]</p></span>
<span style="color: red"><p>Conversion site</p></span>
<span style="color: blue">1.</span><a href="Home.php">Home</a>
<span style="color: blue">2.</span><a href="Rate.php">Conv Rate</a>
<span style="color: blue">3.</span><a href="History.php">History</a><br><br>
<span style="color: red"><p>Conversion Rate:</p></span><br><br>
<input type="text" id="rate" name="rate" >
<span style="color: red"><?php echo $rateErr; ?> </span>
<input type="text" id="value" name="value" >
<span style="color: red"><?php echo $valueErr; ?> </span>
<input type="text" id="res" name="res" >
<span style="color: red"><?php echo $resErr; ?> </span>
<input type="submit" name="submit" value="submit">
</fieldset>
</form>
</body>
</html>