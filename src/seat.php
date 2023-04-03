<?php 
  include('functions.php');

  function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: ".$output."');</script>";
}

  $get = $_GET["parameter"];

  global $x;
  $x = array();
  if($get) {
    $x = explode("|", $get);
  }

  $movie = $x[0];
  $dt = $x[2];
  $screen = $x[1];
  $date = explode(" ", $dt)[0];
  $time = explode(" ", $dt)[1];
  
  $sid = $x[3];

  // to keep uniformity
  $x[0] = $movie;
  $x[1] = $date;
  $x[2] = $time;

  if(isset($_POST['seat_btn'])) {
    seat_insertion($x[0], $x[1], $x[2], $sid);
  }
?>


<!DOCTYPE html>
<html>
<head>
  <?php include('nav2.php') ?>
  <title>Please select your seats</title>
  <script type="text/javascript">
var CheckboxUncheckedImage = new Image(); // Declare an image variable.
var CheckboxCheckedImage = new Image(); // Declare another image variable.

CheckboxUncheckedImage.src = "images/available.png";
CheckboxCheckedImage.src = "images/selected.png";

function CheckboxClicked(imageid, checkboxid) {
  // Use imageid to find the image that was clicked.
  var image = document.getElementById(imageid);

  // Check if the clicked image has the same src as the one representing a checked checkbox.
  if(image.src == CheckboxCheckedImage.src) {
  // Switch to image representing unchecked and also change the checkbox form field's checked status to false (unchecked).
     image.src = CheckboxUncheckedImage.src;
     document.getElementById(checkboxid).checked = false;
  } else {
  // Switch to image representing checked and also change the checkbox form field's checked status to true (checked).
     image.src = CheckboxCheckedImage.src;
     document.getElementById(checkboxid).checked = true;
  }
  // Return value false to keep the browser from doing anything else with the click.
  return false;
}

</script>

<style>
  .header {
    background: #003366;
  }

  button[name=seat_btn] {
    background: #003366;
    margin-left: 160px;
  }

    *,*:before,*:after {
    box-sizing: border-box;
  }

  html {
    font-size: 16px;
  }

  *{
    margin: 0px;
    padding: 0px;
  }

  body {
    font-size: 120%;
    background: #F8F8FF;
  }

  .header {
    width: 30%;
    margin: 50px auto;
    color: white;
    text-align: center;
    border: 1px solid #B0C4DE;
    border-bottom: none;
    padding: 10px;
  }

  .input-group {
    margin: 10px 0px 10px 0px;
  }

  .input-group label {
    display: block;
    text-align: left;
    margin: 3px;
  }

  .input-group input {
    height: 30px;
    width: 93%;
    padding: 5px 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid gray;
  }

  .plane {
    margin: 20px auto;
    width: 40%;
  }

  .btn {
    padding: 10px;
    font-size: 15px;
    color: white;
    border: none;
    border-radius: 5px;
  }

  .exit {
    position: relative;
    height: 50px;
    &:before,
    &:after {
      content: "EXIT";
      font-size: 14px;
      line-height: 18px;
      padding: 0px 2px;
      font-family: "Arial Narrow", Arial, sans-serif;
      display: block;
      position: absolute;
      background: green;
      color: white;
      top: 50%;
      transform: translate(0, -50%);
    }
    &:before {
      left: 0;
    }
    &:after {
      right: 0;
    }
  }

  ol {
    list-style :none;
    padding: 0;
    margin: 0;
  }

  .headings {
    margin-top: 7px;
    margin-left: 9px;
    font-size: 20px;
    margin-right: 10px;
  }

  .seats {
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: flex-start;  
  }
  .seat-nos{
    margin-left: 24%;
    font-size: 20px;
    }
  .seat {
    display: flex;
    flex: 0 0 14.28571428571429%;
    padding: 5px;
    position: relative;  
    text-align: center;

    &:nth-child(3) {
      margin-right: 14.28571428571429%;
    }
    .seatlayout{
      margin-left:10%;
    }
    .seatlayoutform{
      width:90% !important;
    }
    .seatlayout{
      input[type=checkbox][id="55"] {
        position: absolute;
        opacity: 0;
      }
      input[type=checkbox][id="55"]:checked {
        + label {
          background: #bada55;      
          -webkit-animation-name: rubberBand;
              animation-name: rubberBand;
          animation-duration: 300ms;
          animation-fill-mode: both;
        }
      }
      input[type = checkbox]:disabled {
        + label {
          background: black;
          text-indent: -9999px;
          overflow: hidden;
          &:after {
            content: "X";
            text-indent: 0;
            position: absolute;
            top: 4px;
            left: 50%;
            transform: translate(-50%, 0%);
          }
          &:hover {
            box-shadow: none;
            cursor: not-allowed;
          }
        }
      }
    }
    
    label {    
      display: block;
      position: relative;    
      width: 100%;    
      text-align: center;
      font-size: 14px;
      font-weight: bold;
      line-height: 1.5rem;
      padding: 4px 0;
      background: #F42536;
      border-radius: 5px;
      animation-duration: 300ms;
      animation-fill-mode: both;
      
      &:before {
        content: "";
        position: absolute;
        width: 75%;
        height: 75%;
        top: 1px;
        left: 50%;
        transform: translate(-50%, 0%);
        background: rgba(255,255,255,.4);
        border-radius: 3px;
      }
      &:hover {
        cursor: pointer;
        box-shadow: 0 0 0px 2px #5C6AFF;
      }
    }
  }
</style>

  <link rel="stylesheet" type="text/css" href="cstyle.css">
</head>
<body>
  <?php 
  
  ?>
  <div class="header">
    <h3>Screen This Way</h3>
  </div>
  <div class="plane">
<form method="post" class="seatlayoutform">
  <div class="seatlayout">
  <ol class="cabin fuselage">
    <li class="row row--1">
      <ol class="seats" type="A">
        <li class="headings">A</li>
        <li class="seat">
            <?php 
            debug_to_console('HIT');
            ?>
            <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="1" id="1" <?php echo seat_checked($x[0], $x[1], $x[2],"1", $sid); ?>>
            </span>
            <?php if(seat_checked($x[0], $x[1], $x[2],"1", $sid) == "disabled"): ?>
            <img id="CheckboxImageID1" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID1" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID1','1')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
        <li class="seat">
            <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="2" id="2" <?php echo seat_checked($x[0],$x[1],$x[2],"2", $sid); ?>>
            </span>
            <?php if(seat_checked($x[0],$x[1],$x[2],"2", $sid)=="disabled"): ?>
            <img id="CheckboxImageID2" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID2" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID2','2')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
        <li class="seat">
            <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="3" id="3" <?php echo seat_checked($x[0],$x[1],$x[2],"3",$sid); ?>>
            </span>
            <?php if(seat_checked($x[0],$x[1],$x[2],"3",$sid)=="disabled"): ?>
            <img id="CheckboxImageID3" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID3" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID3','3')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
        <li class="seat">
            <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="4" id="4" <?php echo seat_checked($x[0],$x[1],$x[2],"4", $sid); ?>>
            </span>
            <?php if(seat_checked($x[0],$x[1],$x[2],"4", $sid)=="disabled"): ?>
            <img id="CheckboxImageID4" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID4" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID4','4')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
        <li class="seat">
            <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="5" id="5" <?php echo seat_checked($x[0],$x[1],$x[2],"5", $sid); ?>>
            </span>
            <?php if(seat_checked($x[0],$x[1],$x[2],"5", $sid)=="disabled"): ?>
            <img id="CheckboxImageID5" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID5" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID5','5')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
      </ol>
    </li>
    <li class="row row--2">
      <ol class="seats" type="A">
        <li class="headings">B</li>
        <li class="seat">
          <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="6" id="6" <?php echo seat_checked($x[0],$x[1],$x[2],"6", $sid); ?>>
            </span>
            <?php if(seat_checked($x[0],$x[1],$x[2],"6", $sid)=="disabled"): ?>
            <img id="CheckboxImageID8" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID8" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID8','6')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
        <li class="seat">
          <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="7" id="7" <?php echo seat_checked($x[0],$x[1],$x[2],"7", $sid); ?>>
            </span>
            <?php if(seat_checked($x[0],$x[1],$x[2],"7", $sid)=="disabled"): ?>
            <img id="CheckboxImageID9" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID9" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID9','7')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
        <li class="seat">
          <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="8" id="8" <?php echo seat_checked($x[0],$x[1],$x[2],"8", $sid); ?>>
            </span>
            <?php if(seat_checked($x[0],$x[1],$x[2],"8", $sid)=="disabled"): ?>
            <img id="CheckboxImageID10" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID10" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID10','8')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
        <li class="seat">
          <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="9" id="9" <?php echo seat_checked($x[0],$x[1],$x[2],"9",$sid); ?>>
            </span>
            <?php if(seat_checked($x[0],$x[1],$x[2],"9", $sid)=="disabled"): ?>
            <img id="CheckboxImageID11" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID11" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID11','9')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
        <li class="seat">
          <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="10" id="10" <?php echo seat_checked($x[0],$x[1],$x[2],"10",$sid); ?>>
            </span>
            <?php if(seat_checked($x[0],$x[1],$x[2],"10", $sid)=="disabled"): ?>
            <img id="CheckboxImageID12" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID12" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID12','10')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
      </ol>
    </li>
    <li class="row row--3">
      <ol class="seats" type="A">
        <li class="headings">C</li>
        <li class="seat">
          <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="11" id="11" <?php echo seat_checked($x[0],$x[1],$x[2],"11",$sid); ?>>
            </span>
            <?php if(seat_checked($x[0],$x[1],$x[2],"11", $sid)=="disabled"): ?>
            <img id="CheckboxImageID15" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID15" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID15','11')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
        <li class="seat">
          <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="12" id="12" <?php echo seat_checked($x[0],$x[1],$x[2],"12",$sid); ?>>
            </span>
            <?php if(seat_checked($x[0],$x[1],$x[2],"12",$sid)=="disabled"): ?>
            <img id="CheckboxImageID16" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID16" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID16','12')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
        <li class="seat">
          <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="13" id="13" <?php echo seat_checked($x[0],$x[1],$x[2],"13",$sid); ?>>
            </span>
            <?php if(seat_checked($x[0],$x[1],$x[2],"13",$sid)=="disabled"): ?>
            <img id="CheckboxImageID17" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID17" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID17','13')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
        <li class="seat">
          <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="14" id="14" <?php echo seat_checked($x[0],$x[1],$x[2],"14",$sid); ?>>
            </span>
            <?php if(seat_checked($x[0],$x[1],$x[2],"14",$sid)=="disabled"): ?>
            <img id="CheckboxImageID18" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID18" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID18','14')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
        <li class="seat">
          <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="15" id="15" <?php echo seat_checked($x[0],$x[1],$x[2],"15",$sid); ?>>
            </span>
            <?php if(seat_checked($x[0],$x[1],$x[2],"15",$sid)=="disabled"): ?>
            <img id="CheckboxImageID19" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID19" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID19','15')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
      </ol>
    </li>
            <li class="row row--4">
      <ol class="seats" type="A">
        <li class="headings">D</li>
        <li class="seat">
          <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="16" id="16" <?php echo seat_checked($x[0],$x[1],$x[2],"16", $sid); ?>>
            </span>
            <?php if(seat_checked($x[0],$x[1],$x[2],"16", $sid)=="disabled"): ?>
            <img id="CheckboxImageID22" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID22" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID22','16')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
        <li class="seat">
          <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="17" id="17" <?php echo seat_checked($x[0],$x[1],$x[2],"17",$sid); ?>>
            </span>
            <?php if(seat_checked($x[0],$x[1],$x[2],"17",$sid)=="disabled"): ?>
            <img id="CheckboxImageID23" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID23" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID23','17')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
        <li class="seat">
          <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="18" id="18" <?php echo seat_checked($x[0],$x[1],$x[2],"18",$sid); ?>>
            </span>
            <?php if(seat_checked($x[0],$x[1],$x[2],"18",$sid)=="disabled"): ?>
            <img id="CheckboxImageID24" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID24" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID24','18')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
        <li class="seat">
          <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="19" id="19" <?php echo seat_checked($x[0],$x[1],$x[2],"19", $sid); ?>>
            </span>
            <?php if(seat_checked($x[0],$x[1],$x[2],"19", $sid)=="disabled"): ?>
            <img id="CheckboxImageID25" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID25" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID25','19')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
        <li class="seat">
          <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="20" id="20" <?php echo seat_checked($x[0],$x[1],$x[2],"20", $sid); ?>>
            </span>
            <?php if(seat_checked($x[0],$x[1],$x[2],"20", $sid)=="disabled"): ?>
            <img id="CheckboxImageID26" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID26" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID26','20')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
      </ol>
    </li>
    <li class="row row--5">
      <ol class="seats" type="A">
        <li class="headings">E</li>
        <li class="seat">
          <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="21" id="21" <?php echo seat_checked($x[0],$x[1],$x[2],"21", $sid); ?>>
            </span>
            <?php if(seat_checked($x[0],$x[1],$x[2],"21", $sid)=="disabled"): ?>
            <img id="CheckboxImageID29" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID29" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID29','21')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
        <li class="seat">
          <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="22" id="22" <?php echo seat_checked($x[0],$x[1],$x[2],"22", $sid); ?>>
            </span>
            <?php if(seat_checked($x[0],$x[1],$x[2],"22", $sid)=="disabled"): ?>
            <img id="CheckboxImageID30" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID30" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID30','22')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
        <li class="seat">
          <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="23" id="23" <?php echo seat_checked($x[0],$x[1],$x[2],"23", $sid); ?>>
            </span>
            <?php if(seat_checked($x[0],$x[1],$x[2],"23", $sid)=="disabled"): ?>
            <img id="CheckboxImageID31" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID31" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID31','23')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
        <li class="seat">
          <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="24" id="24" <?php echo seat_checked($x[0],$x[1],$x[2],"24", $sid); ?>>
            </span>
            <?php if(seat_checked($x[0],$x[1],$x[2],"24", $sid)=="disabled"): ?>
            <img id="CheckboxImageID32" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID32" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID32','24')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
        <li class="seat">
          <span style="display:none;">
                <input type="checkbox" name="chck1[]" value="25" id="25" <?php echo seat_checked($x[0],$x[1],$x[2],"25", $sid); ?>>
            </span>
            <?php if(seat_checked($x[0],$x[1],$x[2],"25", $sid)=="disabled"): ?>
            <img id="CheckboxImageID33" src="images/occupied.PNG" width="41" height="38" style="cursor:pointer;">
        <?php else: ?>
            <img id="CheckboxImageID33" src="images/available.PNG" width="41" height="38" onclick="CheckboxClicked('CheckboxImageID33','25')" style="cursor:pointer;">
        <?php endif; ?>
        </li>
      </ol>
    </li>
    <li class="row row--5">
      <ol class="seats" type="A">
        <li class="headings"> </li>
        <li class="seat seat-nos">
          1
        </li>
        <li class="seat seat-nos">
          2
        </li>
        <li class="seat seat-nos">
          3
        </li>
        <li class="seat seat-nos">
          4
        </li>
        <li class="seat seat-nos">
          5
        </li>
      </ol>
    </li>
  </ol>
</div>
<br>
<div class="input-group">
    <button type="submit" class="btn" name="seat_btn">Book Tickets</button>
</div>
</form>
  </div>
</body>
</html>