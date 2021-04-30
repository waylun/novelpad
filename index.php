<!-- 
 * Novel-Pad Plugin PHP Example
 * https://github.com/waylun/novelpad
 *
 * Copyright 2016, Design by Lun, Denver Colorado
 * 
 * Email: waylunly@gmail.com
-->

<?php 
  $NovelName = "The Prophet";    // Novel Name
  $NovelAuthor = "by Kahlil Gibran" ;    //  Author Name
  $NovelStatus = "Not completed..."   //   Book Status (show in the bottom)
?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<!-- for Android  -->
<meta name="mobile-web-app-capable" content="yes">

<title><?php echo $NovelName." - ".$NovelAuthor ?></title>

<!-- icon links -->
<link rel="icon" sizes="192x192" href="img/icon.png">

<!-- for iphone -->
<link rel="apple-touch-icon" href="img/icon.png" />
<link rel="apple-touch-icon" sizes="57x57" href="img/icon.png" />
<link rel="apple-touch-icon" sizes="72x72" href="img/icon.png" />
<link rel="apple-touch-icon" sizes="114x114" href="img/icon.png" />
<link rel="apple-touch-icon" sizes="144x144" href="img/icon.png" />

<link rel="stylesheet" type="text/css" href="css/style.css">

<!-- fix icon (bookmark & go to top) -->
<link rel="stylesheet" type="text/css" href="css/fixedicon.css">

<!-- custom style sheets -->
<style type="text/css">

/* remote control adjust */
input[type=text] {
  background-color: transparent;
  color:#EEEEEE;
}

input[type=number]{
    border-radius: 3px;
} 

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>

<!-- Add jQuery -->
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<script type="text/javascript" src="js/jquery-2.2.0.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.touch-punch.min.js"></script>

<!-- remote control -->
<script type="text/javascript" src="js/remotecontrol.js"></script>


</head>
<body>
<!-- remote control start -->
<div class="remote">  
    <input type="radio" id="day" name="mode" value="day" checked> 
    <label for="day" >Day Mode</label>
    <input type="radio" id="night" name="mode" value="night">
    <label for="night" >Night Mode</label>
    
    <br>

    <label for="fontsize">Font Size: </label>
    <input type="text" id="fontsize" readonly style="border:0; border-color: transparent;font-weight:bold; width:60; text-align:center; margin-top:1em;">
    <div id="fontslider" style="margin-top:.5em;width:50%"></div>


    <label for="marginspace">Margin: </label>
    <input type="text" id="marginspace" readonly style="border:0; font-weight:bold; width:60; text-align:center; margin-top:1em;">
    <div id="spaceslider" style="margin-top:.5em;width:50%"></div>

    <label for="lineheight">Line Spacing: </label>
    <input type="text" id="lineheight" readonly style="border:0; font-weight:bold; width:60; text-align:center; margin-top:1em;">
    <div id="lineslider" style="margin-top:.5em;width:50%"></div>
  <hr style="margin-top:1em"> 
  <label for="chapter">Chapter: </label><br>
  <select id="chapter" style='margin:.5em 0;width:50%;height:20px;' onChange='optionChanged(this.value)'>
  <?php
      $fixtxt  = glob('*.txt', GLOB_BRACE);
      natcasesort($fixtxt);
      foreach ($fixtxt as $txtname) {         
      //remove file extension
      $fh = basename($txtname, ".txt");
      //remove the first number
      $title = preg_replace('/^[0-9]+/', '', $fh);
      echo "
        <option value='' disabled selected style='display:none;''>Please Select...</option>
        <option value='#".$title."'>".$title."</option>";
        }
  ?>
  </select>
  <br>
  <label for="mark">Bookmark: </label><br>
  <input type="number" id="mark" style="border:0; font-weight:bold; text-align:center; margin-top:.5em;" placeholder="number...">

  <button type="button" id="gotomark">Go to Mark</button>

</div>
<!-- remote control end -->

<!-- content article start -->
<div class="content">
  <div class="row">

    <h2 style="text-align:center;"><?php echo $NovelName; ?></h2>
    <p style="margin:0;padding:0;text-align:right;"><b><?php echo $NovelAuthor; ?></b></p>
    
        <?php
            $fixfile  = glob('*.txt', GLOB_BRACE);
            natcasesort($fixfile);
          foreach ($fixfile as $filename) {
            $filecontent = fopen($filename, "r");

            // remove file extension
            $file = basename($filename, ".txt");

            // remove the leftmost number in string
            $words = preg_replace('/^[0-9]+/', '', $file);

            echo "<hr><h3 id='".$words."'>".$words."</h3>";

            while (!feof($filecontent)) {
            $line = fgets($filecontent);

            // for Chinese version
            // echo nl2br(str_replace(' ', '&nbsp;', $line));

            // for English version
            echo nl2br($line);

            }
            //last time modify files
            echo "<p style='font-size:.8em;text-align:right;'>Last modified: ".date("F d Y H:i:s.",filemtime($filename))."</p>";
            
            fclose($filecontent);
          }
            // book status...
            echo "<h3 style='text-align:center;'>".$BookStatus."</h3>";
        ?>
      
  </div>
</div>
<!-- content article end -->

<!-- book mark button -->
<a href="#1" class="mk-top">Book Mark</a>
<!-- go to top button -->
<a href="#0" class="cd-top">Go to Top</a>
<!-- bookmark js -->
<script type="text/javascript" src="js/bookmark.js"></script>
<!-- go to top js -->
<script type="text/javascript" src="js/gototop.js"></script>
<script>
function optionChanged(value) {
  window.location.href= value;
  document.getElementById("chapter").value = ''
}
</script>
</body>
</html>