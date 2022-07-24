<!DOCTYPE html>
<html>
<head>
<title>Conversion</title>
</head>
<body>
<?php 
define("filepath", "rate.txt"); 
$convoErr  = $valueErr = "";    
$convo  = $value = "";
$flag = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    if (empty($_POST["convo"])) 
    {  
       $convoErr = " Field can't be empty";
       $flag = True;  
    } 

if (empty($_POST["value"])) 
    {  
       $valueErr = " Field can't be empty";
       $flag = True;  
    } 
if(!$flag) 
    {
   
    $convo = input_data($_POST["convo"]);
    if(is_numeric($_POST["value"]))
    {
        $value = input_data($_POST["value"]);
    }
    else
    {
          $valueErr = "Value must be in numeric form";
    }   
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
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
    <fieldset>
    <span style="color: red"><p>Page 1 [Home]</p></span>
    <span style="color: red"><p>Conversion site</p></span>
    <span style="color: blue">1.</span><a href="Home.php">Home</a>
    <span style="color: blue">2.</span><a href="Rate.php">Conv Rate</a>
    <span style="color: blue">3.</span><a href="History.php">History</a><br><br>
    <label for="convo"><span style="color: red">Converter:</span></label><br>
    <select name="convo" id="convo">
<?php
$convoE = $multiE = $valueE = "";
$fileData = read();
$fileDataExplode = explode("\n", $fileData);
for($i = 0; $i < count($fileDataExplode) - 1; $i++) {
$temp = json_decode($fileDataExplode[$i]);
echo "<option value='$temp->rate'>$temp->rate</option>";
}
?>
    </select><br><br><br>
    <label for="value">Value:</label>
    <input type="text" id="value" name="value" >
    <span style="color: red"><?php echo $valueErr; ?> </span>

   <input type="submit" value="Submit"><br><br><br>
   <?php 
   $Multi = "";
   $fileData = read();
    $fileDataExplode = explode("\n", $fileData);
    for($i = 0; $i < count($fileDataExplode) - 1; $i++) {
   $temp = json_decode($fileDataExplode[$i]);
    if($temp->rate === $convo)
    {
       $Multi = $temp->value*$temp->result;
    }
    }

   echo "Result:<input type='text' value='$Multi'/>"; 
   function read() {
$file = fopen(filepath, "r");
$fz = filesize(filepath);
$fr = "";
if($fz > 0) {
$fr = fread($file, $fz);
}
fclose($file);
return $fr;
}
?> 
  
  </fieldset>

</form>


</body>
</html

