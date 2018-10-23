<?php
require 'boot.php';
require_once ('pesapal/db/DBConnector.php');

?>
<?php
$db = new DBConnector();
$user = $db->getUserData($cid);

$ffquery="select * from token_balance,accounts where accounts.id='".$_SESSION['cid']."' and accounts.id=token_balance.user_id";
$stmt2 = $dbh->prepare("$ffquery");
$stmt2->execute();
$result2 = $stmt2->fetchAll();
if ($stmt2->rowCount() == "1") {
	foreach ($result2 as $value2) {}
	$date_created = $value2['datecreated'];
    $dt_crt= date_create($date_created);
    date_add($dt_crt,date_interval_create_from_date_string("7 days"));
    $date_seven = date_format($dt_crt, "Y-m-d");
}
$noma = "select * from token_balance where user_id='$cid'";
//echo    $ffquery;
$statrt = $dbh->prepare("$noma");
$statrt->execute();
$reugfg = $statrt->fetchAll();
if ($statrt->rowCount() == "1") {
    foreach ($reugfg as $token_rem) {
    }
}
  $tok = $token_rem['token_balance'];
    // Custom code to check for a valid user
if (count($user) == 0){
	$bool_user = "null";
} else {
    $bool_user = "true";
}
$date_today = date('Y-m-d');
$e_dt = $token_rem['expiry_date'];
$expired = "";

if ($e_dt == NULL) {
    $expired = "expired";
    //header("Location: trialversion.php");
} else if ($e_dt != NULL) {
    if ($e_dt >= $date_today){
        $expired = "valid";
    } else if ($e_dt < $date_today && $date_seven < $date_today) {
        header("Location: trialversion.php");
    } else if($date_seven < $date_today) {
        $expired = "expired";
				header("Location: trialversion.php");
    } else if($e_dt < $date_today) {
        $expired = "expired";
    }
}

//var_dump($_SESSION['cid']);


//die();

/* if ($user != null && $user['account'] == 1){demos
	if($value2['token_balance'] <= 0){
		header('Location: https://demoscad.net/app/cp/order.php');
		///detect the screen sizes
		// Include and instantiate the class.
	}
}
if ($user != null && $user['account'] == 2){
	$expiryDate = new DateTime(date('Y-m-d H:i:s'));
	$expiryDate = $expiryDate->format("Y-m-d H:i:s");
	if ($value2['expiry_date'] < $date('Y-m-d H:i:s') || $value2['expiry_date'] != 0 || $value2['expiry_date'] != null){
		header('Location: https://demoscad.net/app/cp/corder.php?mm=30');
		///detect the screen sizes
		// Include and instantiate the class.
	}
} */

?>

<!--- Added --->
<?php
include('db.php');
if($_POST)
{
$q=$_POST['search'];
$sql_res=mysql_query("select * from commandlist where command like '%$q%'  order by command LIMIT 1000");
while($row=mysql_fetch_array($sql_res))
{
$username=$row['command'];
$email=$row['filename'];
$b_username='<strong>'.$q.'</strong>';
$b_email='<strong>'.$q.'</strong>';
$final_username = str_ireplace($q, $b_username, $username);
$final_email = str_ireplace($q, $b_email, $email);

//$final_username; command

// $final_email;  description

?>

<!--<script>
    $("#result2").click(function(){
    jQuery("#result2").hide();
});

</script>-->

<?php
}
}
?>
<!---End Added-->

<!DOCTYPE html>
<html id="wholeHtlm">
<head>

  <meta charset="UTF-8">
    <meta name="viewport" content="width=1380">
    <title>SkyTOP DemosCAD</title>
    <!--<script type="text/javascript" src="jquery-1.8.0.min.js"></script>-->

    <link rel="stylesheet" href="loader/themes/black/pace-theme-loading-bar.css"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/downloadjs/1.4.7/download.min.js" type="text/javascript"></script>
	<link href="democlick.css" rel="stylesheet" type="text/css">
 <!-- Trial/Demonstration code starts right here -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://code.jquery.com/jquery-migrate-3.0.1.js"></script>

	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript" src="https://malsup.github.io/jquery.blockUI.js"></script>
    <script src="maitho/js/jquery.ui.touch-punch.min.js" type="text/javascript"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


    <script type="text/javascript">

        $(document).ready(function(){
            var value2 = "<?php echo $token_rem['token_balance'];?>";
            var tok = "<?php echo $tok;?>";
            var exp_date = "<?php echo $e_dt; ?>";
            var user = "<?php echo $bool_user; ?>";
            var date_today = "<?php echo $date_today; ?>";
            var expired = "<?php echo $expired; ?>";


                // Disable all selected <a> tags and provide a custom click handling function
                $('#Home a, #Parametric2 a, #Solid a, #Surface a, #Mesh a, #Visualize1 a, #Insert1 a, #Annotate a, #View1 a, #Manage a, #Output a, #Add-Ins a, #A360 a, #ExpressTools a, #1234567890asdfghj a, .topnav a, .demoscadlogo a, .BottomRibbon a, #side a').each(function(){
                    if (/*value2 === "" || value2 === null || value2 === undefined ||  value2 == 0 || */expired == "expired" || user == "null") {
                        if (!$(this).hasClass("trial") & !$(this).hasClass("logout")){
                            $(this).removeAttr("href");
                            $(this).find("img").css("opacity", "0.3");
                            $(this).click(function(event){
                                event.preventDefault();
                                $("#myModal").modal('show');

                            });
                        } else {
                            $(".demo").bind("click");
                            $(this).find("img").css("opacity", "1 !important");
                        }
                        // Gray out all the dropdown icons

                        $('.bigIcon ul li img, .smallIcon ul li img, .smallIcon2 ul li img, .demoscadlogo ul li img, .demoscadlogo ul li ul li img, .section ul li img').each(function(){
                            if ($(this).hasClass("not-blurred !important")){
                                $(this).css("opacity", "1");
                            } else if ($(this).hasClass("logout !important")){
                                $(this).css("opacity", "1");
                            } else {
                                $(this).css("opacity", "0.4");
                            }

                        });
                        $('#searchid, #noSpaces').attr("disabled", true);
                    }
                });

            })
    </script>
    <!-- Trial/Demonstration code ends right here -->


	<link href="https://cdnjs.cloudflare.com/ajax/libs/video.js/6.7.3/video-js.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/6.7.3/video.js"></script>

    <script src="maitho/js/mresource.js" type="text/javascript"></script>
    <script src="js/modal-resource-mobile.js" type="text/javascript"></script>

    <!-- Conversion of PDF to images using pdf.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.550/pdf.min.js"></script>

     <!--Enable drag on mobile devices. -->
     <script>
         $("#timer").draggable();
     </script>


    <script>
        paceOptions = {
            elements: true
        };
    </script>
    <script src="loader/pace.js"></script>

    <script>
        $(document).ready(function () {
            updateTimerFromEveryWhere();
            $('#main-body-bontainer').css('display', 'none');
            $('#demos-loading').css('display', 'block');
        });
        $(window).load(function () {
            updateTimerFromEveryWhere();
            $('#main-body-bontainer').css('display', 'block');
            $('#demos-loading').css('display', 'none');
        });
    </script>

<script>
    if (screen.width >=1920) {
    window.location = "demoscadreloaded.php";
    }
</script>

<!--Ochieng's code-->
<!--<script type="text/javascript">

        if (screen.width => 1920) {

        window.location = "/demoscadreloaded.php";

    }
</script>-->

<script type="text/javascript">
    $(function () {
        $(".search2").keyup(function () {
            var searchid = $(this).val();
            var dataString = 'search=' + searchid;
            if (searchid != '') {
                $.ajax({
                    type: "POST",
                    url: "search.php",
                    data: dataString,
                    cache: false,
                    success: function (html) {
                        $("#result2").html(html).show();
                    }
                });
            }
            return false;
        });

        jQuery("#result2").live("click", function (e) {
            var $clicked = $(e.target);
            var $name = $clicked.find('.name').html();
            var decoded = $("<div/>").html($name).text();
            $('#searchid').val(decoded);
        });
        jQuery(document).live("click", function (e) {
            var $clicked = $(e.target);
            if (!$clicked.hasClass("search2")) {
                jQuery("#result2").fadeOut();
            }
        });
        $('#searchid').click(function () {
            jQuery("#result2").fadeIn();
        });
    });
</script>

    <style type="text/css">
        .modal-body {
            padding: 2px !important;
        }
        .logout, .trial img, .not-blurred {
            opacity: 1 !important;
        }
        .contentsdf {
            width: 900px;
            margin: 0 auto;
        }

        #searchid {
            width: 150px;
            height: 20px;
            border: solid 1px #ddd;
        }

        #searchidsd {
            width: 500px;
            border: solid 1px #000;
            padding: 10px;
            font-size: 14px;
        }

        #result2 {
            position: absolute;
            width: 400px;
            padding: 10px;
            display: none;
            float: right;
            right: 5px;
            z-index: 99999999999999;
            margin-top: -1px;
            border-top: 0px;
            overflow: hidden;
            border: 1px #CCC solid;
            background-color: white;
        }

        .show {
            padding: 10px;
            border-bottom: 1px #999 dashed;
            font-size: 15px;
            height: 50px;
        }

        .show:hover {
            /*background: #4c66a4;*/
            color: #000;
            cursor: pointer;
        }
		.tooltip {
    position: relative;
    display: inline-block;
    border: 1px  black;
}

.tooltip .tooltipdiv {
    visibility: hidden;
    width: auto;
	height:auto;
    background-color:#c1c1c1 ;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 0px 0;

    /* Position the tooltip */
    position: absolute;
    z-index: 1;
}

.tooltip:hover .tooltipdiv {

    visibility: visible;
	 -webkit-transition-property: width; /* Safari */
	 -webkit-transition-property: height; /* Safari */
    -webkit-transition-duration: 1s; /* Safari */
    -webkit-transition-delay: 2s; /* Safari */
    transition-property: width;
	transition-property: height;
    transition-duration: 1s;
    transition-delay: 2s;
	width:auto;
	height:auto;

}
.tooltip .tooltipdiv {
    top: -5px;
    left: 105%;
}

    </style>
	<style>
.tooltip {
    position: relative;
    display: inline-block;
    border: 1px  black;
}

.tooltip .tooltipdiv {
    visibility: hidden;
    width: auto;
	height:auto;
    background-color:#c1c1c1 ;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 0px 0;

    /* Position the tooltip */
    position: absolute;
    z-index: 1;
}

.tooltip:hover .tooltipdiv {

    visibility: visible;
	 -webkit-transition-property: width; /* Safari */
	 -webkit-transition-property: height; /* Safari */
    -webkit-transition-duration: 1s; /* Safari */
    -webkit-transition-delay: 2s; /* Safari */
    transition-property: width;
	transition-property: height;
    transition-duration: 1s;
    transition-delay: 2s;
	width:auto;
	height:auto;

}
.tooltip .tooltipdiv {
    top: -5px;
    left: 105%;
}
.img-fit {
    margin-left: auto;
    margin-right: auto;
    max-height: inherit;
    max-width: inherit;
    width: inherit;
    height: auto;
    display: block;
}

</style>

    <link rel="stylesheet" href="">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="maitho/css/resources.css">
    <link rel="stylesheet" href="css/mike.css">
    <link rel="stylesheet" href="css/cmd.css">
    <link rel="stylesheet" href="css/tabs.css">
    <link rel="stylesheet" href="css/offline.css">
    <link rel="stylesheet" href="css/lang.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="content/ejthemes/default-theme/ej.web.all.min.css" rel="stylesheet"/>
    <link href="content/default.css" rel="stylesheet"/>
    <link href="content/default-responsive.css" rel="stylesheet"/>
    <link href="content/ejthemes/responsive-css/ej.responsive.css" rel="stylesheet"/>
    <script src="css/offline.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.2/awesomplete.base.min.css"/>

    <!--[if lt IE 9]>

    <![endif]-->
    <!--[if IE 9]><!-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.2/awesomplete.base.min.css"/>
<!--    <script src="scripts/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-1.11.3.min.js" type="text/javascript"></script>-->

    <!--<![endif]-->

    <!-- PDFjs related styles -->
    <style media="screen">
      #pdf-wrapper {
        width: 100%;
        height: auto;
        display: block;
      }
      canvas {
        margin: 0 auto;
        width: 800px !important;
        height: auto;
        display: block;
      }
    </style>

    <!-- PDFjs related styles end here -->

    <script src="scripts/ej.web.all.min.js" type="text/javascript"></script>
    <script src="scripts/properties.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.2/awesomplete.min.js"></script>
    <style type="text/css">
        .hideAll {
            visibility: hidden;
        }
    </style>

    <script type="text/javascript">
        $(window).load(function () {

            $("#1234567890asdfghj").removeClass("hideAll");
            //$("#mike").removeClass("hideAll");
        });
    </script>

    <script>
        document.getElementById("defaultOpen").click();
    </script>

    <!--<script type="text/javascript">$(document).ready(function(){$("body").on("contextmenu",function(a){return false});$("#id").on("contextmenu",function(a){return false})});</script>
<script type="text/javascript">$(document).ready(function(){$("body").bind("cut copy paste",function(a){a.preventDefault()});$("#id").bind("cut copy paste",function(a){a.preventDefault()})});</script>-->

    <style>
        .demos-loading{line-height:52vh;font-size:50px;text-align:center;margin-top:30px;color:black;display:block}@media only screen and (min-width:768px){.demos-loading{font-size:50px}}@media only screen and (max-width:767px){.demos-loading{font-size:45px}}@media only screen and (max-width:680px){.demos-loading{font-size:40px}}@media only screen and (max-width:580px){.demos-loading{font-size:35px}}@media only screen and (max-width:480px){.demos-loading{font-size:30px}}@media only screen and (max-width:380px){.demos-loading{font-size:25px}}@media only screen and (max-width:280px){.demos-loading{font-size:25px}}
    </style>

</head>
<body class="" onload="closeOpenModal()" style="position:fixed !important;" oncontextmenu="return false" onselectstart="return false" ondragstart="return false">

<!--<h1 class="demos-loading" id="demos-loading">Demos<span style="color:red">CAD</span> is Loading...</h1>
<div id="main-body-bontainer" style="display: none; width: 100%">-->

<!-- Trial Subscription modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">SkyTOP DemosCAD</h4>
      </div>
      <div class="modal-body">
        <h5>Please purchase a subscription package to have access to this tool.<br>
					Press the back button to return to the order page to purchase a subscription plan.</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!--<a href="order.php" class="btn btn-primary" role="button">Subscribe</a>-->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Trial Subscription modal ends here-->

<!-- Trigger the modal with a button -->
<div class="demoscadlogo">
    <ul>
        <li><img src="mike/icon.png">
            <ul style="z-index:-1000;">
                <li><a style="margin-left:120px;"><img src="demoscadlogo/13.png"></a></li>
                <div class="tab">
                    <button class="tablinks" style="border:solid 1px #919191; height:20px;"
                            onclick="openItem(event, 'recentdocs')" id="defaultOpen"><img src="demoscadlogo/11.png">
                    </button>
                    <button class="tablinks" style="border:solid 1px #919191; height:20px;"
                            onclick="openItem(event, 'opendocs')"><img src="demoscadlogo/12.png"></button>
                </div>

                <div id="opendocs" class="tabcontent">
                    <li><a href="#"><img src="demoscadlogo/open docs/1.png"></a></li>
                    <li>
                        <table>
                            <tr>
                                <td><img style="border:solid 1px #ddd;" src="demoscadlogo/recent docs/3.png">
                                    <ul>
                                        <li><a href="#"><img src="demoscadlogo/recent docs/icon size/2.png"></a></li>
                                        <li><a href="#"><img src="demoscadlogo/recent docs/icon size/2.png"></a></li>
                                        <li><a href="#"><img src="demoscadlogo/recent docs/icon size/3.png"></a></li>
                                        <li><a href="#"><img src="demoscadlogo/recent docs/icon size/4.png"></a></li>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </li>
                    <li><a href="#"><img src="demoscadlogo/open docs/3.png"></a></li>
                    <li style="margin-top:340px;">
                        <button><img src="demoscadlogo/recent docs/7.png"></button>&nbsp;&nbsp;&nbsp;&nbsp;<button><img
                                    src="demoscadlogo/recent docs/8.png"></button>
                    </li>
                </div>

                <div id="recentdocs" class="tabcontent">
                    <li><a href="#"><img src="demoscadlogo/recent docs/1.png"></a></li>
                    <li>
                        <table>
                            <tr>
                                <td><img style="border:solid 1px #ddd;" src="demoscadlogo/recent docs/2.png">
                                    <ul>
                                        <li><a href="#"><img src="demoscadlogo/recent docs/ordered list/2.png"></a></li>
                                        <li><a href="#"><img src="demoscadlogo/recent docs/ordered list/2.png"></a></li>
                                        <li><a href="#"><img src="demoscadlogo/recent docs/ordered list/3.png"></a></li>
                                        <li><a href="#"><img src="demoscadlogo/recent docs/ordered list/4.png"></a></li>
                                    </ul>&nbsp;&nbsp;
                                </td>
                                <td><img style="border:solid 1px #ddd;" src="demoscadlogo/recent docs/3.png">
                                    <ul>
                                        <li><a href="#"><img src="demoscadlogo/recent docs/icon size/2.png"></a></li>
                                        <li><a href="#"><img src="demoscadlogo/recent docs/icon size/2.png"></a></li>
                                        <li><a href="#"><img src="demoscadlogo/recent docs/icon size/3.png"></a></li>
                                        <li><a href="#"><img src="demoscadlogo/recent docs/icon size/4.png"></a></li>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </li>
                    <li><a href="#"><img src="demoscadlogo/recent docs/4.png"></a></li>
                    <li><a href="#"><img src="demoscadlogo/recent docs/5.png"></a></li>
                    <li><a href="#"><img src="demoscadlogo/recent docs/6.png"></a></li>
                    <li style="margin-top:290px;"><a style="border: solid 1px #ddd; padding:5px;" href="#options"><img
                                    src="demoscadlogo/recent docs/7.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a
                                style="border: solid 1px #ddd; padding:5px;" onclick="exitDemoscad()" href="#"><img
                                    src="demoscadlogo/recent docs/8.png"></a></li>
                </div>

                <li><img src="demoscadlogo/1.png">
                    <ul>
                        <li style="border-bottom:solid 1px #ddd;"><img src="demoscadlogo/new/1.png"</li>
                        <li><a href="#new"><img src="demoscadlogo/new/2.png"></a></li>
                        <li class="demo2" id="newSheetSet" value="newSheetSet" name="New Sheet Set"><a href="#ModalPopup"><img
                                        src="demoscadlogo/new/3.png"></a></li>
                    </ul>
                </li>
                <li><img src="demoscadlogo/2.png">
                    <ul>
                        <li style="border-bottom:solid 1px #ddd;"><a href="#"><img src="demoscadlogo/open/1.png"></a>
                        </li>
                        <li><a href="#openDrawing"><img src="demoscadlogo/open/2.png"></a></li>
                        <li><a href="#openDrawingCloud"><img src="demoscadlogo/open/4.png"></a></li>
                        <li><a href="#openSheetSet"><img src="demoscadlogo/open/5.png"></a></li>
                        <li style="border-bottom:solid 1px #ddd;"><a href="#openDGN"><img src="demoscadlogo/open/7.png"></a>
                        </li>
                        <li><img src="demoscadlogo/open/8.png">
                            <ul style="margin-top:-90px">
                                <li><a href="#openInstalledSampleFiles"><img src="demoscadlogo/open/sample files/1.png"></a>
                                </li>
                                <li class="demo2" id="open_online_sample_files" value="open_online_sample_files" name="Online Sample Files"><a
                                            href="#openPDF"><img src="demoscadlogo/open/sample files/2.png"></a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="demo2" id="save" value="save" name="Save"><a href="#ModalPopup"><img src="demoscadlogo/3.png"></a></li>
                <li><img src="demoscadlogo/4.png">
                    <ul style="overflow:hidden;overflow-y:auto;">
                        <li style="border-bottom:solid 1px #ddd;"><a href="#"><img src="demoscadlogo/Saveas/1.png"></a>
                        </li>
                        <li><a href="#saveDrawing"><img src="demoscadlogo/Saveas/2.png"></a></li>
                        <li><a href="#saveDrawingCloud"><img src="demoscadlogo/Saveas/3.png"></a></li>
                        <li><a href="#DrawingTemplate"><img src="demoscadlogo/Saveas/4.png"></a></li>
                        <li><a href="#saveDrawingStandards"><img src="demoscadlogo/Saveas/5.png"></a></li>
                        <li><a href="#saveOtherFormat"><img src="demoscadlogo/Saveas/6.png"></a></li>
                        <li id="save_layout_as_a_drawing"><a href="#openVideo"><img src="demoscadlogo/Saveas/7.png"></a>
                        </li>
                        <li><a href="#saveDWG"><img src="demoscadlogo/Saveas/8.png"></a></li>
                    </ul>
                </li>
                <li><img src="demoscadlogo/5.png">
                    <ul>
                        <li style="border-bottom:solid 1px #ddd;"><a href="#"><img src="demoscadlogo/import/1.png"></a>
                        </li>
                        <li><a href="#importpdf"><img src="demoscadlogo/import/2.png"></a></li>
                        <li><a href="#importdgn"><img src="demoscadlogo/import/3.png"></a></li>
                        <li><a href="#importfbx"><img src="demoscadlogo/import/4.png"></a></li>
                        <li><a href="#importother_formats"><img src="demoscadlogo/import/5.png"></a></li>
                    </ul>
                </li>
                <li><img src="demoscadlogo/6.png">
                    <ul>
                        <li style="border-bottom:solid 1px #ddd;"><a href="#"><img src="demoscadlogo/export/1.png"></a>
                        </li>
                        <li><a href="#export_dwf"><img src="demoscadlogo/export/2.png"></a></li>
                        <li><a href="#export_dwfx"><img src="demoscadlogo/export/3.png"></a></li>
                        <li><a href="#export_3d_dwf"><img src="demoscadlogo/export/4.png"></a></li>
                        <li><a href="#export_pdf"><img src="demoscadlogo/export/5.png"></a></li>
                        <li><a href="#export_dgn"><img src="demoscadlogo/export/6.png"></a></li>
                        <li><a href="#export_fbx"><img src="demoscadlogo/export/7.png"></a></li>
                        <li><a href="#export_other_fomarts"><img src="demoscadlogo/export/8.png"></a></li>
                    </ul>
                </li>
                <li><img src="demoscadlogo/7.png">
                    <ul>
                        <li style="border-bottom:solid 1px #ddd;"><a href="#"><img src="demoscadlogo/publish/1.png"></a>
                        </li>
                        <li class="demo2" id="send_to_3d_print_service" value="send_to_3d_print_service" name="Send to 3D Print Service"><a
                                    href="#openPDF"><img src="demoscadlogo/publish/2.png"></a></li>
                        <li class="demo2" id="archive" value="archive" name="Archive"><a href="#openPDF"><img
                                        src="demoscadlogo/publish/3.png"></a></li>
                        <li class="demo2" id="etransmit" value="etransmit" name="Etransmit"><a href="#ModalPopup"><img
                                        src="demoscadlogo/publish/4.png"></a></li>
                        <li class="demo2" id="email1" value="email1" name="Email"><a href="#openPDF"><img
                                        src="demoscadlogo/publish/5.png"></a></li>
                        <li class="demo2" id="design_views" value="design_views" name="Design Views"><a href="#openPDF"><img
                                        src="demoscadlogo/publish/6.png"></a></li>
                    </ul>
                </li>
                <li><img src="demoscadlogo/8.png">
                    <ul style="overflow:hidden;overflow-y:auto;">
                        <li style="border-bottom:solid 1px #ddd; margin-left:0px !important;"><a href="#"><img
                                        src="demoscadlogo/print/1.png"></a></li>
                        <li><a href="#plot"><img src="demoscadlogo/print/2.png"></a></li>
                        <li><a href="#PrintBatchPlot"><img src="demoscadlogo/print/3.png"></a></li>
                        <li class="demo2" id="plot_preview" value="plot_preview" name="Plot Preview"><a href="#ModalPopup"><img
                                        src="demoscadlogo/print/4.png"></a></li>
                        <li class="demo2" id="view_plot_and_publish_details" value="view_plot_and_publish_details" name="View Plot and Publish Details"><a
                                    href="#ModalPopup"><img src="demoscadlogo/print/5.png"></a></li>
                        <li><a href="#pageSetUp"><img src="demoscadlogo/print/6.png"></a></li>
                        <li class="demo2" id="3d_print" value="3d_print" name="3D Print"><a href="#ModalPopup"><img
                                        src="demoscadlogo/print/7.png"></a></li>
                        <li class="demo2" id="manage_plotters" value="manage_plotters" name="Manage Plotters"><a href="#ModalPopup"><img
                                        src="demoscadlogo/print/8.png"></a></li>
                        <li class="demo2" id="manage_plot_styles" value="manage_plot_styles" name="Manage Plot Styles"><a href="#openPDF"><img
                                        src="demoscadlogo/print/9.png"></a></li>
                        <li class="demo2" id="edit_plot_style_tables" value="edit_plot_style_tables" name="Edit Plot Style Tables"><a
                                    href="#openPDF"><img src="demoscadlogo/print/10.png"></a></li>
                    </ul>
                </li>
                <li><img src="demoscadlogo/9.png">
                    <ul>
                        <li style="border-bottom:solid 1px #ddd;"><a href="#new"><img
                                        src="demoscadlogo/drawing utilities/1.png"></a></li>
                        <li><a href="#drawingProperties"><img src="demoscadlogo/drawing utilities/2.png"></a></li>
                        <li><a href="#units"><img src="demoscadlogo/drawing utilities/3.png"></a></li>
                        <li class="demo2" id="audit" value="audit"><a href="#openAudit"><img
                                        src="demoscadlogo/drawing utilities/4.png"></a></li>
                        <li class="demo2" id="status" value="status" name="Status"><a href="#openPDF"><img
                                        src="demoscadlogo/drawing utilities/5.png"></a></li>
                        <li><a href="#purge"><img src="demoscadlogo/drawing utilities/6.png"></a></li>
                        <li><img src="demoscadlogo/drawing utilities/7.png">
                            <ul style="top:318px;">
                                <li class="demo2" id="recover" value="recover"><a href="#openPDF"><img
                                                src="demoscadlogo/drawing utilities/recover/1.png"></a></li>
                                <li class="demo2" id="recover_with_xrefs" value="recover_with_xrefs"><a
                                            href="#openPDF"><img src="demoscadlogo/drawing utilities/recover/2.png"></a>
                                </li>
                            </ul>
                        </li>
                        <li class="demo2" id="open_the_drawing_recovery_manager"
                            value="open_the_drawing_recovery_manager"><a href="#openPDF"><img
                                        src="demoscadlogo/drawing utilities/8.png"></a></li>
                    </ul>
                </li>
                <li><img src="demoscadlogo/10.png">
                    <ul>
                        <li style="border-bottom:solid 1px #ddd;"><a href="#"><img src="demoscadlogo/exit/1.png"></a>
                        </li>
                        <li class="demo2" id="close_current_drawing" value="close_current_drawing"><a
                                    href="#openPDF"><img src="demoscadlogo/exit/2.png"></a></li>
                        <li class="demo2" id="close_all_drawings" value="close_all_drawings"><a href="#openPDF"><img
                                        src="demoscadlogo/exit/3.png"></a></li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</div>

<div>
<div  id="new" class="popupWindow">
 <div style="height:480px;width:600px">
         <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 610px; top: 1px;"><span>&#x2715;</span></a>
            </div>

<div class="popupContent" style="margin-top: -6px">
<ul style="list-style:none;">
                    <li class="demo2" id="newDrawing" value="newDrawing" name="New Drawing"><a href="#ModalPopup"><img
                                    src="demoscadlogo/new/drawing/1.png"></a></li>
                    <li class="demo2" id="newDrawing" value="newDrawing" name="New Drawing"><a href="#ModalPopup"><img style="margin-top:-130px;margin-left:550px;" src="demoscadlogo/new/drawing/open.png"></a></li>
                    <a onclick="closeWindow()" href="#"><img style="margin-top:-95px;margin-left:550px;" src="demoscadlogo/new/drawing/cancel.png"></a>
                </ul>
    <ul style="margin-top:-440px;margin-left:135px; list-style:none;">
                    <li class="demo2" id="newDrawing" value="newDrawing" name="New Drawing"><a href="#ModalPopup"><img
                                    src="demoscadlogo/new/drawing/2.png"></a></li>
                    <li class="demo2" id="newDrawing" value="newDrawing" name="New Drawing"><a href="#ModalPopup"><img
                                    src="demoscadlogo/new/drawing/3.png"></a></li>
                    <li class="demo2" id="newDrawing" value="newDrawing" name="New Drawing"><a href="#ModalPopup"><img
                                    src="demoscadlogo/new/drawing/4.png"></a></li>
                    <li class="demo2" id="newDrawing" value="newDrawing" name="New Drawing"><a href="#ModalPopup"><img
                                    src="demoscadlogo/new/drawing/5.png"></a></li>
                    <li class="demo2" id="newDrawing" value="newDrawing" name="New Drawing"><a href="#ModalPopup"><img
                                    src="demoscadlogo/new/drawing/6.png"></a></li>
                    <li class="demo2" id="newDrawing" value="newDrawing" name="New Drawing"><a href="#ModalPopup"><img
                                    src="demoscadlogo/new/drawing/7.png"></a></li>
                    <li class="demo2" id="newDrawing" value="newDrawing" name="New Drawing"><a href="#ModalPopup"><img
                                    src="demoscadlogo/new/drawing/8.png"></a></li>
                    <li class="demo2" id="newDrawing" value="newDrawing" name="New Drawing"><a href="#ModalPopup"><img
                                    src="demoscadlogo/new/drawing/9.png"></a></li>
                    <li class="demo2" id="newDrawing" value="newDrawing" name="New Drawing"><a href="#ModalPopup"><img
                                    src="demoscadlogo/new/drawing/10.png"></a></li>
                    <li class="demo2" id="newDrawing" value="newDrawing" name="New Drawing"><a href="#ModalPopup"><img
                                    src="demoscadlogo/new/drawing/11.png"></a></li>
                    <li class="demo2" id="newDrawing" value="newDrawing" name="New Drawing"><a href="#ModalPopup"><img
                                    src="demoscadlogo/new/drawing/12.png"></a></li>
                    <li class="demo2" id="newDrawing" value="newDrawing" name="New Drawing"><a href="#ModalPopup"><img
                                    src="demoscadlogo/new/drawing/13.png"></a></li>
                    <li class="demo2" id="newDrawing" value="newDrawing" name="New Drawing"><a href="#ModalPopup"><img
                                    src="demoscadlogo/new/drawing/14.png"></a></li>

                </ul>

</div>
</div>
</div>


    <div id="openDrawing" class="popupWindow">
        <div style="width:636px !important;height:300px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 610px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none;">
                    <li class="demo2" id="openDrawing" value="openDrawing" name="Open Drawing"><a href="#ModalPopup"><img
                                    src="demoscadlogo/open/drawing/1.png"></a></li>
                    <li class="demo2" id="openDrawing" value="openDrawing" name="Open Drawing"><a href="#ModalPopup"><img
                                    style="margin-top:-120px;margin-left:550px;"
                                    src="demoscadlogo/new/drawing/open.png"></a></li>
                    <li><a onclick="closeWindow()" href="#"><img style="margin-top:-95px;margin-left:550px;"
                                                                 src="demoscadlogo/new/drawing/cancel.png"></a></li>
                </ul>
            </div>
        </div>
    </div>


    <div id="openDrawingCloud" class="popupWindow">
        <div style="width:630px !important; height:300px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 610px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none;">
                    <li class="demo2" id="OpenfromCloud" value="OpenfromCloud" name="Open From Cloud"><a href="#ModalPopup"><img
                                    src="demoscadlogo/open/drawing/1.png"></a></li>
                    <li class="demo2" id="OpenfromCloud" value="OpenfromCloud" name="Open From Cloud"><a href="#ModalPopup"><img
                                    style="margin-top:-120px;margin-left:550px;"
                                    src="demoscadlogo/new/drawing/open.png"></a></li>
                    <li><a onclick="closeWindow()" href="#"><img style="margin-top:-95px;margin-left:550px;"
                                                                 src="demoscadlogo/new/drawing/cancel.png"></a></li>
                </ul>
            </div>
        </div>
    </div>


    <div id="openSheetSet" class="popupWindow">
        <div style="width:630px !important; height:300px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 610px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none;">
                    <li class="demo2" id="open_sheet_set" value="open_sheet_set" name="Open Sheet Set"><a href="#ModalPopup"><img
                                    src="demoscadlogo/open/drawing/1.png"></a></li>
                    <li class="demo2" id="open_sheet_set" value="open_sheet_set" name="Open Sheet Set"><a href="#ModalPopup"><img
                                    style="margin-top:-120px;margin-left:550px;"
                                    src="demoscadlogo/new/drawing/open.png"></a></li>
                    <li><a onclick="closeWindow()" href="#"><img style="margin-top:-95px;margin-left:550px;"
                                                                 src="demoscadlogo/new/drawing/cancel.png"></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="openDGN" class="popupWindow">
        <div style="width:630px !important; height:300px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 610px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none;">
                    <li class="demo2" id="dgn2" value="dgn2"><a href="#openPDF"><img
                                    src="demoscadlogo/open/drawing/1.png"></a></li>
                    <li class="demo2" id="dgn2" value="dgn2"><a href="#openPDF"><img
                                    style="margin-top:-120px;margin-left:550px;"
                                    src="demoscadlogo/new/drawing/open.png"></a></li>
                    <li><a onclick="closeWindow()" href="#"><img style="margin-top:-95px;margin-left:550px;"
                                                                 src="demoscadlogo/new/drawing/cancel.png"></a></li>
                </ul>
            </div>
        </div>
    </div>


    <div id="openInstalledSampleFiles" class="popupWindow">
        <div style="width:630px !important; height:300px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 610px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none;">
                    <li class="demo2" id="open_installed_sample_files" value="open_installed_sample_files"><a
                                href="#openPDF"><img src="demoscadlogo/open/drawing/1.png"></a></li>
                    <li class="demo2" id="open_installed_sample_files" value="open_installed_sample_files"><a
                                href="#openPDF"><img style="margin-top:-120px;margin-left:550px;"
                                                     src="demoscadlogo/new/drawing/open.png"></a></li>
                    <li><a onclick="closeWindow()" href="#"><img style="margin-top:-95px;margin-left:550px;"
                                                                 src="demoscadlogo/new/drawing/cancel.png"></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="save" class="popupWindow">
        <div style="width:630px !important; height:300px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 610px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none;">
                    <li class="demo2" id="save" value="save" name="Save"><a href="#ModalPopup"><img src="demoscadlogo/save.png"></a>
                    </li>
                    <li class="demo2" id="save" value="save" name="Save"><a href="#ModalPopup"><img
                                    style="margin-top:-117px;margin-left:550px;" src="demoscadlogo/savebutton.png"></a>
                    </li>
                    <li><a onclick="closeWindow()" href="#"><img style="margin-top:-75px;margin-left:550px;"
                                                                 src="demoscadlogo/new/drawing/cancel.png"></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="saveDrawing" class="popupWindow">
        <div style="width:630px !important; height:300px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 610px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none;">
                    <li id="saveDrawingFile"><a href="#openVideo"><img src="demoscadlogo/save.png"></a></li>
                    <li id="saveDrawingFile"><a href="#openVideo"><img style="margin-top:-120px;margin-left:550px;"
                                                                       src="demoscadlogo/savebutton.png"></a></li>
                    <li><a onclick="closeWindow()" href="#"><img style="margin-top:-95px;margin-left:550px;"
                                                                 src="demoscadlogo/new/drawing/cancel.png"></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="saveDrawingCloud" class="popupWindow">
        <div style="width:630px !important; height:300px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 610px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none;">
                    <li class="demo2" id="drawing_to_the_cloud" value="drawing_to_the_cloud" name="Drawing to the Cloud"><a href="#ModalPopup"><img
                                    src="demoscadlogo/save.png"></a></li>
                    <li class="demo2" id="drawing_to_the_cloud" value="drawing_to_the_cloud" name="Drawing to the Cloud"><a href="#"><img
                                    style="margin-top:-117px;margin-left:550px;" src="demoscadlogo/savebutton.png"></a>
                    </li>
                    <li><a onclick="closeWindow()" href="#"><img style="margin-top:-75px;margin-left:550px;"
                                                                 src="demoscadlogo/new/drawing/cancel.png"></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="DrawingTemplate" class="popupWindow">
        <div style="width:630px !important; height:300px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 610px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none;">
                    <li id="autocad_drawing_template"><a href="#openVideo"><img src="demoscadlogo/Saveas/template.png"></a>
                    </li>
                    <li id="autocad_drawing_template"><a href="#openVideo"><img
                                    style="margin-top:-120px;margin-left:550px;" src="demoscadlogo/savebutton.png"></a>
                    </li>
                    <li><a onclick="closeWindow()" href="#"><img style="margin-top:-80px;margin-left:550px;"
                                                                 src="demoscadlogo/new/drawing/cancel.png"></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="saveDrawingStandards" class="popupWindow">
        <div style="width:638px !important;height:400px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 610px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none;">
                    <li class="demo2" id="autocad_drawing_standards" value="autocad_drawing_standards"><a
                                href="#openPDF"><img src="demoscadlogo/Saveas/standard.png"></a></li>
                    <li class="demo2" id="autocad_drawing_standards" value="autocad_drawing_standards"><a
                                href="#openPDF"><img style="margin-top:-120px;margin-left:550px;"
                                                     src="demoscadlogo/savebutton.png"></a></li>
                    <li><a onclick="closeWindow()" href="#"><img style="margin-top:-83px;margin-left:550px;"
                                                                 src="demoscadlogo/new/drawing/cancel.png"></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="saveOtherFormat" class="popupWindow">
        <div style="width:638px !important;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 610px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none;">
                    <li class="demo2" id="other_formats" value="other_formats"><a href="#openVideo"><img
                                    src="demoscadlogo/save.png"></a></li>
                    <li class="demo2" id="other_formats" value="other_formats"><a href="#openVideo"><img
                                    style="margin-top:-117px;margin-left:550px;" src="demoscadlogo/savebutton.png"></a>
                    </li>
                    <li><a onclick="closeWindow()" href="#"><img style="margin-top:-75px;margin-left:550px;"
                                                                 src="demoscadlogo/new/drawing/cancel.png"></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="saveDWG" class="popupWindow">
        <div style="width:600px !important; height:400px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 610px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none;">
                    <li class="demo2" id="dwg_convert" value="dwg_convert" name="DWG Convert"><a href="#ModalPopup"><img
                                    src="demoscadlogo/Saveas/dwg.png"></a></li>
                    <li><a onclick="closeWindow()" href="#"><img style="margin-top:-55px;margin-left:430px;"
                                                                 src="demoscadlogo/Saveas/close.png"></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="options" class="popupWindow">
        <div style="width:600px; height:100px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 672px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none;">
                    <li class="demo2" id="options1" value="options1" name="Options"><a href="#ModalPopup"><img
                                    src="demoscadlogo/options.png"></a></li>
                    <li class="demo2" id="options1" value="options1" name="Options"><a href="#ModalPopup"><img style="margin-top:-48px; margin-left:370px;"
                                                   src="demoscadlogo/okbutton.png"></a></li>
                    <a onclick="closeWindow()" href="#"><img style="margin-top:-80px;margin-left:450px;"
                                                             src="demoscadlogo/new/drawing/cancel.png"></a>
                </ul>
            </div>
        </div>
    </div>

    <div id="opendwg" class="popupWindow" style="top:-6px;">
        <div style="width:700px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 610px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <a href="#ModalPopup"><img src="demoscadlogo/saveas/dwg/1.png"></a>
                <a onclick="closeWindow()" href="#"><img style="margin-top:-54px;margin-left:430px;"
                                                         src="demoscadlogo/saveas/dwg/close.png"></a>
            </div>
        </div>
    </div>

    <div id="plot" class="popupWindow">
        <div style="top:-20px; width:735px; margin-left:240px; height:550px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 710px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none">
                    <li id="plot3"><a href="#openVideo"><img src="demoscadlogo/print/plotPreview.png"></a></li>
                    <li id="plot3"><a href="#openVideo"><img style="margin-top:-53px;margin-left:450px;"
                                                             src="demoscadlogo/okbutton.png"></a></li>
                    <li><a onclick="closeWindow()" href="#"><img style="margin-top:-80px;margin-left:528px;"
                                                                 src="demoscadlogo/new/drawing/cancel.png"></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="pageSetUp" class="popupWindow">
        <div style="width:450px;height:200px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 420px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none">
                    <li class="demo2" id="page_setup" value="page_setup" name="Page Setup"><a href="#ModalPopup"><img
                                    src="demoscadlogo/print/pagesetup.png"></a></li>
                    <li><a onclick="closeWindow()" href="#"><img style="margin-top:-55px;margin-left:275px;"
                                                                 src="demoscadlogo/print/close.png"></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="PrintBatchPlot" class="popupWindow">
        <div style="top:-20px; width:760px; margin-left:240px;top:-80px; height:550px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 740px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none">
                    <li class="demo2" id="batchplot2" value="batchplot2" name="Batch Plot"><a href="#ModalPopup"><img
                                    src="demoscadlogo/print/batchPlot.png"></a></li>
                    <li><a onclick="closeWindow()" href="#"><img style="margin-top:-70px;margin-left:545px;"
                                                                 src="demoscadlogo/print/cancel.png"></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="units" class="popupWindow">
        <div style="top:-20px; width:230px;height:250px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 310px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none">
                    <li class="demo2" id="drawing_properties" value="drawing_properties" name="Drawing Properties"><a href="#ModalPopup"><img
                                    src="demoscadlogo/drawing utilities/units.png"></a></li>
                    <li class="demo2" id="drawing_properties" value="drawing_properties" name="Drawing Properties"><a href="#ModalPopup"><img
                                    style="margin-top:380px;margin-left:-335px;"
                                    src="demoscadlogo/drawing utilities/ok.png"></a></li>
                    <li><a onclick="closeWindow()" href="#"><img style="margin-top:380px;margin-left:5px;"
                                                                 src="demoscadlogo/drawing utilities/cancel.png"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="drawingProperties" class="popupWindow">
        <div style="width:350px; height:250px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 3250px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none">
                    <li class="demo2" id="drawing_properties" value="drawing_properties" name="Drawing Properties"><a href="#ModalPopup"><img
                                    src="demoscadlogo/drawing utilities/drawingProperties.png"></a></li>
                    <li><a onclick="closeWindow()" href="#"><img style="margin-top:-48px;margin-left:192px;"
                                                                 src="demoscadlogo/drawing utilities/cancel.png"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="purge" class="popupWindow">
        <div style="width:370px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 340px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none">
                    <li class="demo2" id="purge2" value="purge2"><a href="#openPDF"><img
                                    src="demoscadlogo/drawing utilities/purge.png"></a>
                    <li>
                    <li><a onclick="closeWindow()" href="#"><img style="margin-top:-52px;margin-left:192px;"
                                                                 src="demoscadlogo/drawing utilities/close.png"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="motionPath" class="popupWindow">
        <div style="width:430px !important; height:300px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 435px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none;">
                    <li class="demo" id="motion_path_animations" value="Motion Path Annimations" name="Dgn"><a href="#openModal"><img
                                    src="view/motionPath.png"></a></li>
                </ul>
            </div>
        </div>
    </div>

    <!------------Import------------------->
    <div id="importpdf" class="popupWindow">
        <div style="width:630px;height:450px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 610px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none">
                    <li class="demo2" id="importfromPDF" value="importfromPDF"><a href="#openVideo"><img
                                    src="demoscadlogo/import/imports/4.png"></a></li>
                    <li class="demo" id="importfromPDF" value="importfromPDF"><a href="#openVideo"><img
                                    style="margin-top:-127px;margin-left:550px;"
                                    src="demoscadlogo/new/drawing/open.png"></a></li>
                    <a onclick="closeWindow()" href="#"><img style="margin-top:-95px;margin-left:550px;"
                                                             src="demoscadlogo/new/drawing/cancel.png"></a>
                </ul>
            </div>
        </div>
    </div>

    <div id="importdgn" class="popupWindow">
        <div style="width:630px;height:450px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 610px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none">
                    <li class="demo2" id="importfromdgn" value="importfromdgn"><a href="#openPDF"><img
                                    src="demoscadlogo/import/imports/2.png"></a></li>
                    <li class="demo2" id="importfromdgn" value="importfromdgn"><a href="#openPDF"><img
                                    style="margin-top:-127px;margin-left:550px;"
                                    src="demoscadlogo/new/drawing/open.png"></a></li>
                    <a onclick="closeWindow()" href="#"><img style="margin-top:-95px;margin-left:550px;"
                                                             src="demoscadlogo/new/drawing/cancel.png"></a>
                </ul>
            </div>
        </div>
    </div>

    <div id="importfbx" class="popupWindow">
        <div style="width:630px;height:450px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 610px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none">
                    <li class="demo2" id="importfromfbx" value="importfromfbx"><a href="#openPDF"><img
                                    src="demoscadlogo/import/imports/3.png"></a></li>
                    <li class="demo2" id="importfromfbx" value="importfromfbx"><a href="#openPDF"><img
                                    style="margin-top:-127px;margin-left:550px;"
                                    src="demoscadlogo/new/drawing/open.png"></a></li>
                    <a onclick="closeWindow()" href="#"><img style="margin-top:-95px;margin-left:550px;"
                                                             src="demoscadlogo/new/drawing/cancel.png"></a>
                </ul>
            </div>
        </div>
    </div>

    <div id="importother_formats" class="popupWindow">
        <div style="width:630px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 610px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none">
                    <li class="demo2" id="importother_formats1" value="importother_formats1"><a href="#openVideo"><img
                                    src="demoscadlogo/import/imports/4.png"></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-----------End------------->

    <!----------Export----------->
    <div id="export_dwf" class="popupWindow">
        <div style="width:730px;height:350px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 610px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none">
                    <li class="demo2" id="export_dwf_pdf" value="export_dwf_pdf"><a href="#openPDF"><img class="cover"
                                                                                                         src="demoscadlogo/export/exports/1.png"></a>
                    </li>
                    <a onclick="closeWindow()" href="#"><img style="margin-top:-65px;margin-left:610px;"
                                                             src="demoscadlogo/export/exports/cancel2.png"></a>
                </ul>
            </div>
        </div>
    </div>

    <div id="export_dwfx" class="popupWindow">
        <div style="width:730px;height:350px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 705px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none">
                    <li class="demo2" id="export_dwfx_file" value="export_dwfx_file"><a href="#openPDF"><img
                                    class="cover" src="demoscadlogo/export/exports/2.png"></a></li>
                    <a onclick="closeWindow()" href="#"><img style="margin-top:-65px;margin-left:610px;"
                                                             src="demoscadlogo/export/exports/cancel2.png"></a>
                </ul>
            </div>
        </div>
    </div>

    <div id="export_3d_dwf" class="popupWindow">
        <div style="width:730px;height:350px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 705px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none">
                    <li class="demo2" id="export_3d_dwf_file" value="export_3d_dwf_file"><a href="#openPDF"><img
                                    src="demoscadlogo/export/exports/4.png"></a></li>
                    <!--<li class="demo" id="" value=""><a href="#openModal"><img style="margin-top:-117px;margin-left:550px;" src="demoscadlogo/new/drawing/open.png"></a></li>-->
                    <a onclick="closeWindow()" href="#"><img style="margin-top:-65px;margin-left:610px;"
                                                             src="demoscadlogo/export/exports/cancel2.png"></a>
                </ul>
            </div>
        </div>
    </div>

    <div id="export_pdf" class="popupWindow">
        <div style="width:730px;height:350px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 705px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none">
                    <li class="demo2" id="export_pdf_file" value="export_pdf_file"><a href="#openPDF"><img class="cover"
                                                                                                           src="demoscadlogo/export/exports/4.png"></a>
                    </li>
                    <!--<li class="demo" id="openDrawing" value="openDrawing"><a href="#openModal"><img style="margin-top:-117px;margin-left:550px;" src="demoscadlogo/new/drawing/open.png"></a></li>-->
                    <a onclick="closeWindow()" href="#"><img style="margin-top:-65px;margin-left:610px;"
                                                             src="demoscadlogo/export/exports/cancel2.png"></a>
                </ul>
            </div>
        </div>
    </div>

    <div id="export_3d_dwf" class="popupWindow">
        <div style="width:730px;height:350px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 610px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none">
                    <li class="demo2" id="export_3d_dwf_file" value="export_3d_dwf_file"><a href="#openPDF"><img
                                    src="demoscadlogo/export/exports/4.png"></a></li>
                    <!--<li class="demo" id="" value=""><a href="#openModal"><img style="margin-top:-117px;margin-left:550px;" src="demoscadlogo/new/drawing/open.png"></a></li>-->
                    <a onclick="closeWindow()" href="#"><img style="margin-top:-65px;margin-left:610px;"
                                                             src="demoscadlogo/export/exports/cancel2.png"></a>
                </ul>
            </div>
        </div>
    </div>

    <div id="export_3d_dwf" class="popupWindow">
        <div style="width:730px;height:350px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 610px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <ul style="list-style:none">
                    <li class="demo2" id="export_3d_dwf_file" value="export_3d_dwf_file"><a href="#openPDF"><img
                                    src="demoscadlogo/export/exports/4.png"></a></li>
                    <!--<li class="demo" id="" value=""><a href="#openModal"><img style="margin-top:-117px;margin-left:550px;" src="demoscadlogo/new/drawing/open.png"></a></li>-->
                    <a onclick="closeWindow()" href="#"><img style="margin-top:-65px;margin-left:610px;"
                                                             src="demoscadlogo/export/exports/cancel2.png"></a>
                </ul>
            </div>
        </div>
    </div>

    <div id="export_dgn" class="popupWindow">
        <div style="width:630px;height:350px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 374px; top: 1.5px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent">
                <ul style="list-style:none">
                    <li class="demo2" id="export_dgn_file" value="export_dgn_file"><a href="#openPDF"><img
                                    src="demoscadlogo/export/exports/5.png"></a></li>
                    <!--<li class="demo" id="" value=""><a href="#openModal"><img style="margin-top:-117px;margin-left:550px;" src="demoscadlogo/new/drawing/open.png"></a></li>-->
                    <a onclick="closeWindow()" href="#"><img style="margin-top:-65px;margin-left:550px;"
                                                             src="demoscadlogo/export/exports/cancel.png"></a>
                </ul>
            </div>
        </div>
    </div>

    <div id="export_fbx" class="popupWindow">
        <div style="width:640px; height:350px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 615px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent">
                <ul style="list-style:none">
                    <li class="demo2" id="export_fbx_file" value="export_fbx_file"><a href="#openPDF"><img
                                    src="demoscadlogo/export/exports/6.png"></a></li>
                    <a onclick="closeWindow()" href="#"><img style="margin-top:-65px;margin-left:550px;"
                                                             src="demoscadlogo/export/exports/cancel.png"></a>
                </ul>
            </div>
        </div>
    </div>

    <div id="export_other_fomarts" class="popupWindow">
        <div style="width:640px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 605px; top: 1.5px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent">
                <ul style="list-style:none">
                    <li class="demo2" id="export_other_fomarts_file" value="export_other_fomarts_file"><a
                                href="#openPDF"><img src="demoscadlogo/export/exports/7.png"></a></li>
                    <a onclick="closeWindow()" href="#"><img style="margin-top:-65px;margin-left:550px;"
                                                             src="demoscadlogo/export/exports/cancel.png"></a>
                </ul>
            </div>
        </div>
    </div>


    <div id="sectionSettings" class="popupWindow">
        <div style="width:330px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 308px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <a href="#"><img src="Home/section/Section Setting.png"></a>
            </div>
        </div>
    </div>

    <div id="UCS" class="popupWindow">
        <div style="width:400px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 374px; top: 1.5px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <a href="#"><img src="Home/UCS.png"></a>
            </div>
        </div>
    </div>

    <div id="meshoptions" class="popupWindow">
        <div style="width:390px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 365px; top: -3px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <img style="margin-top:-5px;" src="Home/Home/mesh/meshoptions.png">
            </div>
        </div>
    </div>


    <div id="visualstyles" class="popupWindow">
        <div style="width:360px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose2" style="position: absolute;
    right: 340px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <a href="#openModal"><img src="Home/Visualize/visualstyles2.png"></a>
            </div>
        </div>
    </div>

    <div id="lights" class="popupWindow">
        <div style="width:250px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose2" style="position: absolute;
    right: 230px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <a href="#openModal"><img src="Home/Visualize/lights2.png"></a>
            </div>
        </div>
    </div>

    <div id="materials" class="popupWindow">
        <div style="width:360px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose2" style="position: absolute;
    right: 340px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <a href="#openModal"><img src="Home/Visualize/materials2.png"></a>
            </div>
        </div>
    </div>

    <div id="render" class="popupWindow">
        <div style="width:370px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose2" style="position: absolute;
    right: 350px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <a href="#openModal"><img src="Home/Visualize/render2.png"></a>
            </div>
        </div>
    </div>


    <div id="geometric" class="popupWindow">
        <div style="width:430px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 405px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <a href="#openModal"><img src="Home/Parametric/geometric2.png"></a>
            </div>
        </div>
    </div>

    <div id="dimension" class="popupWindow">
        <div style="width:430px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 405px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <a href="#openModal"><img src="Home/Parametric/dimensional2.png"></a>
            </div>
        </div>
    </div>


    <div id="reference" class="popupWindow">
        <div style="width:220px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose2" style="position: absolute;
    right: 200px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <a href="#openModal"><img src="Home/Insert/reference2.png"></a>
            </div>
        </div>
    </div>

    <div id="text" class="popupWindow">
        <div style="width:605px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 580px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <a href="#openModal"><img src="Home/Annotate/text2.png"></a>
            </div>
        </div>
    </div>


    <div id="dimensions" class="popupWindow">
        <div style="width:500px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 488px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <a href="#openModal"><img src="Home/Annotate/dimensions2.png"></a>
            </div>
        </div>
    </div>

    <div id="leaders" class="popupWindow">
        <div style="width:450px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 428px; top: 1px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent" style="margin-top: -6px">
                <a href="#openModal"><img src="Home/Annotate/leaders2.png"></a>
            </div>
        </div>
    </div>


    <div id="saveAs" class="popupWindow" style="top:-50px;">
        <div style="width:400px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 374px; top: 1.5px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent">
                <a href="#openModal"><img src="BottomRibbon/settings/8.png"></a>
            </div>
        </div>
    </div>

    <div id="workspaceSettings" class="popupWindow" style="top:-50px;">
        <div style="width:340px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 374px; top: 1.5px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent">
                <a href="#openModal"><img src="BottomRibbon/settings/9.png"></a>
            </div>
        </div>
    </div>

    <div id="customize" class="popupWindow" style="top:-130px;">
        <div style="width:700px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 374px; top: 1.5px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent">
                <a href="#openModal"><img src="BottomRibbon/settings/10.png"></a>
            </div>
        </div>
    </div>

    <div id="draftSet" class="popupWindow" style="top:-50px;">
        <div style="width:475px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 374px; top: 1.5px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent">
                <a href="#openModal"><img src="BottomRibbon/settings/12.png"></a>
            </div>
        </div>
    </div>

    <div id="draftSet1" class="popupWindow" style="top:-6px;">
        <div style="width:475px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 374px; top: 1.5px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent">
                <a href="#openModal"><img src="BottomRibbon/settings/13.png"></a>
            </div>
        </div>
    </div>

    <div id="draftSet2" class="popupWindow" style="top:-6px;">
        <div style="width:470px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 374px; top: 1.5px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent">
                <a href="#openModal"><img src="BottomRibbon/settings/13.png"></a>
            </div>
        </div>
    </div>

    <div id="draftSet3" class="popupWindow" style="top:-6px;">
        <div style="width:470px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 374px; top: 1.5px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent">
                <a href="#openModal"><img src="BottomRibbon/settings/13.png"></a>
            </div>
        </div>
    </div>

    <div id="closeAllDrawings" class="popupWindow">
        <div style="width:345px; top:130px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 374px; top: 1.5px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent">
                <a href="#openModal"><img src="demoscadlogo/exit/closeAllDrawings.png"></a>
                <a href="#openModal"><img style="margin-top:-55px;margin-left:40px;"
                                          src="demoscadlogo/exit/playbutton.png"></a>
                <a onclick="closeWindow()" href="#"><img style="margin-top:-55px;margin-left:5px;"
                                                         src="demoscadlogo/exit/finishbutton.png"></a>
            </div>
        </div>
    </div>

    <div id="aboutGallery" class="popupWindow">
        <div style="width:450px; top:130px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 374px; top: 1.5px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent">
                <a href="#openModal"><img src="Resources/demoscad gallery/images/about.png"></a>
            </div>
        </div>
    </div>

    <div id="aboutdemos" class="popupWindow">
        <div style="width:465px; top:130px">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 374px; top: 1.5px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent">
                <a href="#openModal"><img src="Resources/demoscad gallery/images/demos.png"></a>
            </div>
        </div>
    </div>

    <div id="plainAutocad" class="popupWindow">
        <div style="width:450px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 374px; top: 1.5px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent">
                <a href="#"><img src="Resources/demoscad gallery/demos and animation/plainautocad.png"></a>
                <ul style="margin-top:-200px;list-style:none; margin-left:23px;">
                    <li><a href="#"><img src="Resources/demoscad gallery/demos and animation/plain AutoCAD/1.png"></a>
                    </li>
                    <li><a href="#"><img src="Resources/demoscad gallery/demos and animation/plain AutoCAD/2.png"></a>
                    </li>
                    <li><a href="#"><img src="Resources/demoscad gallery/demos and animation/plain AutoCAD/3.png"></a>
                    </li>
                    <li><a href="#"><img src="Resources/demoscad gallery/demos and animation/plain AutoCAD/4.png"></a>
                    </li>
                </ul>
                <a href="#"><img style="margin-top:60px;margin-left:330px;"
                                 src="Resources/demoscad gallery/demos and animation/plain AutoCAD/5.png"></a>
            </div>
        </div>
    </div>

    <div id="autocadSuite" class="popupWindow">
        <div style="width:455px;">
            <div class="modalHead">
                <a href="#" title="Close" class="imgClose" style="position: absolute;
    left: 374px; top: 1.5px;"><span>&#x2715;</span></a>
            </div>
            <div class="popupContent">
                <a href="#"><img src="Resources/demoscad gallery/demos and animation/autocadsuite.png"></a>
                <ul style="margin-top:-260px;list-style:none; margin-left:30px;">
                    <li><a href="#"><img src="Resources/demoscad gallery/demos and animation/AutoCAD suite/1.png"></a>
                    </li>
                    <li><a href="#"><img src="Resources/demoscad gallery/demos and animation/AutoCAD suite/2.png"></a>
                    </li>
                    <li><a href="#"><img src="Resources/demoscad gallery/demos and animation/AutoCAD suite/3.png"></a>
                    </li>
                    <li><a href="#"><img src="Resources/demoscad gallery/demos and animation/AutoCAD suite/4.png"></a>
                    </li>
                    <li><a href="#"><img src="Resources/demoscad gallery/demos and animation/AutoCAD suite/5.png"></a>
                    </li>
                    <li><a href="#"><img src="Resources/demoscad gallery/demos and animation/AutoCAD suite/6.png"></a>
                    </li>
                </ul>
                <a href="#"><img style="margin-top:70px;margin-left:330px;"
                                 src="Resources/demoscad gallery/demos and animation/AutoCAD suite/7.png"></a>
            </div>
        </div>
    </div>

</div>

<div class="icon-bar">
    <div class="topnav">
        <ul>

            <li class="demo2" id="new2" value="new2" name="New" style="padding-left:44px;"><a href="#ModalPopup"><img
                            style="float:left;" src="Home/topy1.png"/></a></li>
            <li class="demo2" id="open" value="open" name="Open"><a href="#ModalPopup"><img style="float:left;"
                                                                                src="Home/topy2.png"/></a></li>
            <li class="demo2" id="save" value="save" name="Save"><a href="#ModalPopup"><img style="float:left;"
                                                                                      src="Home/topy3.png"/></a></li>
            <li class="demo2" id="save_as" value="save_as" name="Save As"><a href="#ModalPopup"><img style="float:left;"
                                                                                                   src="Home/topy4.png"/></a>
            </li>
            <li><a id="plot2" href="#openVideo"><img style="float:left;" src="Home/topy5.png"/></a></li>
            <li class="demo2" id="undo" value="undo" name="Undo"><a href="#ModalPopup"><img style="float:left;"
                                                                                src="Home/topy6.png"/></a></li>
            <li><a id="redo" href="#openPDF"><img style="float:left;" src="Home/topy8.png"/></a></li>
            <li id="workspace"><img style="float:left;" src="Home/topy7.png"/>
                <ul style="margin-left:-130px;">
                    <li class="selector" value="1" onclick="myFunction()"><a> Drafting and Annotation </a></li>
                    <li class="selector" value="2" onclick="myFunction()"><a> 3D Basics </a></li>
                    <li class="selector" value="3" onclick="myFunction()" style="border-bottom:solid 1px #D1D1D1;"><a>
                            3D Modeling </a></li>
                    <li><a> Save Current As... </a></li>
                    <li><a> Workspace Setting... </a></li>
                    <li><a> Customize... </a></li>
                </ul>
            </li>
            <li class="demo2" id="batchplot" value="batchplot" name="Batch Plot"><a href="#ModalPopup"><img style="float:left;"
                                                                                          src="Home/topy22.png"/></a>
            </li>
            <li class="demo2" id="matchproperties" value="matchproperties" name="Match Properties"><a href="#ModalPopup"><img
                            style="float:left;" src="Home/topy23.png"/></a></li>
            <li class="demo2" id="plotpreview" value="plotpreview" name="Plot Preview"><a href="#ModalPopup"><img style="float:left;"
                                                                                              src="Home/topy24.png"/></a>
            </li>
            <li class="demo2" id="properties" value="properties" name="Properties"><a href="#ModalPopup"><img style="float:left;"
                                                                                            src="Home/topy25.png"/></a>
            </li>
            <li class="demo2" id="render" value="render" name="Render"><a href="#ModalPopup"><img style="float:left;"
                                                                                    src="Home/topy26.png"/></a></li>
            <li><a id="sheetsetmanager" href="#openPDF"><img style="float:left;" src="Home/topy27.png"/></a></li>
            <li id="layer"><img style="float:left;" src="Home/topy10.png"/>
                <ul style="margin-left:-130px;background-color:#f5f5f5">
                    <li>
                        <a href="#">&nbsp;&nbsp;<img src="Home/Home/layers/2/1.png"></a>
                        <a href="#">&nbsp;&nbsp;<img src="Home/Home/layers/2/2.png"></a>
                        <a href="#">&nbsp;&nbsp;<img src="Home/Home/layers/2/3.png"></a>
                        <a href="#">&nbsp;&nbsp;<img src="Home/Home/layers/2/4.png"></a>
                        <a href="#">&nbsp;&nbsp;<img src="Home/Home/layers/2/5.png"></a>
                    </li>
                </ul>
            </li>
            <li><img style="float:left;" src="Home/topy20.png"/>
                <ul style="margin-left:-25px;">
                    <li style="background:#ddd;!important;"> Custom Quick Access Toolbar</li>
                    <li onclick="new1()" style="margin-left:-10px;"><a><img id="new2"
                                                                            src="NavBar/customize quick acces toolbar/newb.png"/></a>
                    </li>
                    <li onclick="plot()" style="margin-left:-10px;"><a><img id="plot1"
                                                                            src="NavBar/customize quick acces toolbar/plotb.png"/></a>
                    </li>
                    <li onclick="saveas()" style="margin-left:-10px" ;><a><img id="saveas1"
                                                                               src="NavBar/customize quick acces toolbar/saveasb.png"/></a>
                    </li>
                    <li onclick="undo()" style="margin-left:-10px;"><a><img id="undo1"
                                                                            src="NavBar/customize quick acces toolbar/undob.png"/></a>
                    </li>
                    <li onclick="redo()" style="margin-left:-10px;"><a><img id="redo1"
                                                                            src="NavBar/customize quick acces toolbar/redob.png"/></a>
                    </li>
                    <li onclick="batchplot()" style="margin-left:-10px;"><a><img id="batchplot1"
                                                                                 src="NavBar/customize quick acces toolbar/batchplotb.png"/></a>
                    </li>
                    <li onclick="matchproperties()" style="margin-left:-10px;"><a><img id="matchproperties1"
                                                                                       src="NavBar/customize quick acces toolbar/matchpropertiesb.png"/></a>
                    </li>
                    <li onclick="plotpreview()" style="margin-left:-10px;"><a><img id="plotpreview1"
                                                                                   src="NavBar/customize quick acces toolbar/plotpreviewb.png"/></a>
                    </li>
                    <li onclick="properties()" style="margin-left:-10px;"><a><img id="properties1"
                                                                                  src="NavBar/customize quick acces toolbar/propertiesb.png"/></a>
                    </li>
                    <li onclick="sheetsetmanager()" style="margin-left:-10px;"><a><img id="sheetsetmanager1"
                                                                                       src="NavBar/customize quick acces toolbar/sheetsetmanagerb.png"/></a>
                    </li>
                    <li onclick="open1()" style="margin-left:-10px;"><a><img id="open2"
                                                                             src="NavBar/customize quick acces toolbar/openb.png"/></a>
                    </li>
                    <li onclick="save()" style="margin-left:-10px;"><a><img id="save1"
                                                                            src="NavBar/customize quick acces toolbar/saveb.png"/></a>
                    </li>
                    <li onclick="render1()" style="margin-left:-10px;"><a><img id="render2"
                                                                               src="NavBar/customize quick acces toolbar/renderb.png"/></a>
                    </li>
                    <li onclick="workspace()" style="margin-left:-10px;"><a><img id="workspace1"
                                                                                 src="NavBar/customize quick acces toolbar/workspaceb.png"/></a>
                    </li>
                    <li onclick="layer1()" style="margin-left:-10px;"><a><img id="layer1"
                                                                              src="NavBar/customize quick acces toolbar/layerb.png"/></a>
                    </li>
                    <li style="margin-left:-10px;"><a><img src="NavBar/customize quick acces toolbar/morecommands.png"/></a>
                    </li>
                    <li style="margin-left:-10px;"><a><img src="NavBar/customize quick acces toolbar/showmenubar.png"/></a>
                    </li>
                    <li style="margin-left:-10px;"><a><img
                                    src="NavBar/customize quick acces toolbar/showbelowtheribbon.png"/></a></li>
                </ul>
            </li>
            <li class="demo"><img style="float:left;" src="Home/topy12.png"/></li>

            <li><img style="float:left;" src="Home/topy13.png"/></li>
            <!--<li><a href="logout.php" class="logout"><img class="logout" style="float:left;" src="Home/topy21.png"/></a></li>-->
            <li><img style="float:left;" src="Home/topy15.png"/></li>
            <li><img style="float:left;" src="Home/topy16.png"/></li>
            <li><img style="float:left;" src="Home/topy17.png"/></li>

            <li>
                <div class="content">
                    <input type="text" class="search2" id="searchid" placeholder="Search for command">
                    <div id="result2" style="overflow-y: scroll;"></div>
                </div>
            </li>

        </ul>

    </div>

</div>

<!--File Menu-->
    <?php include('file_menu.php'); ?>
<!--End File Menu-->


<!--crazines begins-->
<div id="mike" class="Sktp-panel Sktp-card-2 ">

    <div id="3dbasics" style="display:none">
        <img src="screenImages/3dbasics.png" alt="">
    </div>

    <div id="drafting" style="display:none">
        <img src="screenImages/draftingandannotation.png" alt="">
    </div>


    <!--Ribbon here-->
    <?php include('ribbon2.php'); ?>
<!--Ribbon Ends Here-->


<div>

    <div class="mk-tab-container">
        <ul class="tabd spacefix">
            <li style="width:5px;" class="tabdlinks" onclick="opentabds(event, 'London')">
                <strong>&nbsp;&nbsp;+</strong>
            </li>
            <li class="tabdlinks" onclick="opentabds(event, 'Par')">
                Drawing 1
            </li>
            <li class="tabdlinks" onclick="opentabds(event, 'Tok')">
                Start
            </li>

        </ul>
    </div>
    <!--javascript timer classes-->
  <div id="timer" style="padding-top:4px; position: absolute; right: 2px; display: none;" >Dear <?php echo  $value2['fname']?>,<br>
        <div id="mydivheader">
		<span id="result"><br>
		</span>
        </div>

    </div>
    <!--end of the timer-->
    <div class="outer-circle">
    </div>

    <div id="Par" class="tabdcontent">
        <div>
            <img style="width:100%; height:100%;" id="joyce" src="img1.jpg"/>
            <!--timer-->

            <!--video player-->

            <div id="maithoVideo" style="display: none;">
                <video id="videoPlayer" autoplay="autoplay"  controlsList="nodownload" class="embed-responsive embed-responsive-16by9" style="width: 100%" oncontextmenu="return false;"  poster="https://demoscad.net/app/cp/poster.png" controls autobuffer onclick="this.play()">
                    <source src="" type="video/mp4">
                </video>
            <ul id="videoMenu" style="background:white; color:black; border:grey; display:block; ">
                     <li style="background:white;"><a id="playpause">Play/Pause</a></li>
                 </ul>
                <script type="text/javascript">
                    $("#videoMenu").ejMenu(
                        {
    					    menuType: ej.MenuType.ContextMenu,
    					    openOnClick: false,
    					    contextMenuTarget: "#videoPlayer",
                        });
                </script>
                <script>/*<![CDATA[*/(function(){var q=!!document.createElement("video").canPlayType;if(q){var b=document.getElementById("maithoVideo");var r=document.getElementById("videoPlayer");var j=document.getElementById("videoMenu");r.controls=false;j.setAttribute("data-state","visible");var n=document.getElementById("playpause");var p=document.getElementById("stop");var d=document.getElementById("mute");var i=document.getElementById("volinc");var o=document.getElementById("voldec");var e=document.getElementById("progress");var m=document.getElementById("progress-bar");var a=document.getElementById("fs");var k=(document.createElement("progress").max!==undefined);if(!k){e.setAttribute("data-state","fake")}var l=!!(document.fullscreenEnabled||document.mozFullScreenEnabled||document.msFullscreenEnabled||document.webkitSupportsFullscreen||document.webkitFullscreenEnabled||document.createElement("video").webkitRequestFullScreen);if(!l){a.style.display="none"}var g=function(u){if(u){var v=Math.floor(r.volume*10)/10;if(u==="+"){if(v<1){r.volume+=0.1}}else{if(u==="-"){if(v>0){r.volume-=0.1}}}if(v<=0){r.muted=true}else{r.muted=false}}c("mute")};var h=function(u){g(u)};var s=function(u){b.setAttribute("data-fullscreen",!!u);a.setAttribute("data-state",!!u?"cancel-fullscreen":"go-fullscreen")};var t=function(){return !!(document.fullScreen||document.webkitIsFullScreen||document.mozFullScreen||document.msFullscreenElement||document.fullscreenElement)};var f=function(){if(t()){if(document.exitFullscreen){document.exitFullscreen()}else{if(document.mozCancelFullScreen){document.mozCancelFullScreen()}else{if(document.webkitCancelFullScreen){document.webkitCancelFullScreen()}else{if(document.msExitFullscreen){document.msExitFullscreen()}}}}s(false)}else{if(b.requestFullscreen){b.requestFullscreen()}else{if(b.mozRequestFullScreen){b.mozRequestFullScreen()}else{if(b.webkitRequestFullScreen){r.webkitRequestFullScreen()}else{if(b.msRequestFullscreen){b.msRequestFullscreen()}}}}s(true)}};if(document.addEventListener){r.addEventListener("loadedmetadata",function(){e.setAttribute("max",r.duration)});var c=function(u){if(u=="playpause"){if(r.paused||r.ended){n.setAttribute("data-state","play")}else{n.setAttribute("data-state","pause")}}else{if(u=="mute"){d.setAttribute("data-state",r.muted?"unmute":"mute")}}};r.addEventListener("play",function(){c("playpause")},false);r.addEventListener("pause",function(){c("playpause")},false);r.addEventListener("volumechange",function(){g()},false);n.addEventListener("click",function(u){if(r.paused||r.ended){r.play()}else{r.pause()}});p.addEventListener("click",function(u){r.pause();r.currentTime=0;e.value=0;c("playpause")});d.addEventListener("click",function(u){r.muted=!r.muted;c("mute")});i.addEventListener("click",function(u){h("+")});o.addEventListener("click",function(u){h("-")});fs.addEventListener("click",function(u){f()});r.addEventListener("timeupdate",function(){if(!e.getAttribute("max")){e.setAttribute("max",r.duration)}e.value=r.currentTime;m.style.width=Math.floor((r.currentTime/r.duration)*100)+"%"});e.addEventListener("click",function(u){var v=(u.pageX-(this.offsetLeft+this.offsetParent.offsetLeft))/this.offsetWidth;r.currentTime=v*r.duration});document.addEventListener("fullscreenchange",function(u){s(!!(document.fullScreen||document.fullscreenElement))});document.addEventListener("webkitfullscreenchange",function(){s(!!document.webkitIsFullScreen)});document.addEventListener("mozfullscreenchange",function(){s(!!document.mozFullScreen)});document.addEventListener("msfullscreenchange",function(){s(!!document.msFullscreenElement)})}}})();/*]]>*/</script>

            </div>

            <div id="pdfHolder" style="display: none">
                <embed id="embedPdf" src="" type="application/pdf">
                <img id="embedPdf" src="">
            </div>


            <ul id="ucs1" class="ucs">
                <li><img src="contentarea/ucs.png"/>
                    <ul>
                        <li><a href="#"><img src="contentarea/ucs/1.png"/></a></li>
                        <li><a href="#"><img src="contentarea/ucs/2.png"/></a></li>
                    </ul>
                </li>
            </ul>
            <ul id="side" class="imgover">
                <!-- <li><img id="joyce" src="contentarea/1.png" /></li> -->
                <li><img src="contentarea/2.png"/>
                    <ul style="bottom:160px;">
                        <li class="demo" id="rb_full_navigation" value="rb_full_navigation" name="Full Navigation"><a href="#openModal"><img src="contentarea/navigation wheel/1.png"/></a></li>
                        <li class="demo" id="rb_mini_full_navigation" value="rb_mini_full_navigation" name="Mini Full Navigation"><a href="#openModal"><img src="contentarea/navigation wheel/2.png"/></a></li>
                        <li class="demo" id="rb_mini_view_object" value="rb_mini_view_object" name="Mini View Object"><a href="#openModal"><img src="contentarea/navigation wheel/3.png"/></a></li>
                        <li class="demo" id="rb_mini_touring_building" value="rb_mini_touring_building" name="Mini Touring Building"><a href="#openModal"><img src="contentarea/navigation wheel/4.png"/></a></li>
                        <li class="demo" id="rb_basic_view_object" value="rb_basic_view_object" name="Basic View Object"><a href="#openModal"><img src="contentarea/navigation wheel/5.png"/></a></li>
                        <li class="demo" id="rb_basic_touring_building" value="rb_basic_touring_building" name="Basic Touring Building"><a href="#openModal"><img src="contentarea/navigation wheel/6.png"/></a></li>
                        <li class="demo" id="rb_2d" value="rb_2d" name="2D"><a href="#openModal"><img src="contentarea/navigation wheel/7.png"/></a></li>
                    </ul>
                </li>
                <li class="demo"  name="Pan" id="pan" value="pan"><a href="#openModal"><img src="contentarea/3.png"/></li>
                <li><img src="contentarea/4.png"/>
                    <ul style="bottom:93px;">
                        <li class="demo"  name="Zoom Extents" id="zoomextents" value="zoomextents"><a href="#openModal"><img src="contentarea/zoom/1.png"/></a></li>
                        <li class="demo"  name="Zoom Window" id="zoomwindow" value="zoomwindow"><a href="#openModal"><img src="contentarea/zoom/2.png"/></a></li>
                        <li class="demo"  name="Zoom Previous" id="zoomprevious" value="zoomprevious"><a href="#openModal"><img src="contentarea/zoom/3.png"/></a></li>
                        <li class="demo"  name="Zoom Realtime" id="zoomrealtime" value="zoomrealtime"><a href="#openModal"><img src="contentarea/zoom/4.png"/></a></li>
                        <li class="demo"  name="Zoom All" id="zoomall" value="zoomall"><a href="#openModal"><img src="contentarea/zoom/5.png"/></a></li>
                        <li class="demo"  name="Zoom Dynamic" id="zoomdynamic" value="zoomdynamic"><a href="#openModal"><img src="contentarea/zoom/6.png"/></a></li>
                        <li class="demo"  name="Zoom Scale" id="zoomscale" value="zoomscale"><a href="#openModal"><img src="contentarea/zoom/7.png"/></a></li>
                        <li class="demo"  name="Zoom Center" id="zoomcenter" value="zoomcenter"><a href="#openModal"><img src="contentarea/zoom/8.png"/></a></li>
                        <li class="demo"  name="Zoom Object" id="zoomobject" value="zoomobject"><a href="#openModal"><img src="contentarea/zoom/9.png"/></a></li>
                        <li class="demo"  name="Zoom In" id="zoomin" value="zoomin"><a href="#openModal"><img src="contentarea/zoom/10.png"/></a></li>
                        <li class="demo"  name="Zoom Out" id="zoomout" value="zoomout"><a href="#openModal"><img src="contentarea/zoom/11.png"/></a></li>
                    </ul>
                </li>
                <li><img src="contentarea/5.png"/>
                    <ul style="bottom:55px;">
                        <li class="demo" id="rb_orbit" value="rb_orbit" name="Orbit"><a href="#openModal"><img src="contentarea/orbit/1.png"/></a></li>
                        <li class="demo" id="rb_free_orbit" value="rb_free_orbit" name="Free Orbit"><a href="#openModal"><img src="contentarea/orbit/2.png"/></a></li>
                        <li class="demo" id="rb_continuous_orbit" value="rb_continuous_orbit" name="Continuous Orbit"><a href="#openModal"><img src="contentarea/orbit/3.png"/></a></li>
                    </ul>
                </li>
                <li class="demo"  name="Show Motion" id="show_motion" value="show_motion"><a href="openModal"><img src="contentarea/6.png"/></a></li>
            </ul>

            <ul id="side2" class="layout" style="visibility:hidden;">
                <li><img id="joyce" src="contentarea/layout/1.png"/></li>
                <li><img id="joyce" src="contentarea/layout/2.png"/></li>
                <li><img src="contentarea/layout/3.png"/>
                    <ul style="bottom:20px;">
                        <li><a href="#"><img src="contentarea/zoom/1.png"/></a></li>
                        <li><a href="#"><img src="contentarea/zoom/2.png"/></a></li>
                        <li><a href="#"><img src="contentarea/zoom/3.png"/></a></li>
                        <li><a href="#"><img src="contentarea/zoom/4.png"/></a></li>
                        <li><a href="#"><img src="contentarea/zoom/5.png"/></a></li>
                        <li><a href="#"><img src="contentarea/zoom/6.png"/></a></li>
                        <li><a href="#"><img src="contentarea/zoom/7.png"/></a></li>
                        <li><a href="#"><img src="contentarea/zoom/8.png"/></a></li>
                        <li><a href="#"><img src="contentarea/zoom/9.png"/></a></li>
                        <li><a href="#"><img src="contentarea/zoom/10.png"/></a></li>
                        <li><a href="#"><img src="contentarea/zoom/11.png"/></a></li>
                    </ul>
                </li>
            </ul>

            <div id="mWheel">
                <img class="mWheel-Bg" src="maitho/shots/defaultscreen.png">
                <img class="mWheel-nav" src="https://demoscad.net/app/cp/maitho/shots/default.png" title="Back">
            </div>
        </div>

<!--commandline starts here-->
        <div id="universe" style="position:fixed;bottom:38px !important;z-index:1;	">
            <ul class="select-list-group cal_drop" id="slg" style="z-index:-1;">
                <li style="z-index:2 !important;">
                    <img style="float:left; margin-left:11%; height:27px; width:50px;" src="cmd/close.png"/>
                    <input type="text" id="noSpaces" list="languages" placeholder="Type a command" method="put" value=""
                           oninput="upperCaseF(this)" onkeypress="return searchKeyPress(event);"
                           style="width:70%; line-height:2em; top:-100px;">
                    <input style="display:none;" type='submit' id='buyt' onclick="sendToPage(); "/>
                    <ul class="select-list-group__list" data-toggle="false">
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"   name="3A(3DARRAY)" id="3a" value="3a" style= "background-image:url('Commandline icons/3a.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false" >	3A(3DARRAY)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3AL(3DALIGN)" id="3al" value="3al" style= "background-image:url('Commandline icons/3al.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	3AL(3DALIGN)</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DCLIP" id="3dclip" value="3dclip" style= "background-image:url('Commandline icons/3dclip.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	3DCLIP	</a></li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DCONFIG(GRAPHICSCONFIG)" id="3dconfig" value="3dconfig" style= "background-image:url('Commandline icons/3dconfig.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	3DCONFIG(GRAPHICSCONFIG)</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DCORBIT" id="3dcorbit" value="3dcorbit" style= "background-image:url('Commandline icons/3dcorbit.png');background-repeat:no-repeat; text-indent: 30px;" value="3DCORBIT" data-display="true" data-highlight="false">	3DCORBIT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DDISTANCE" id="3ddistance" value="3ddistance" style= "background-image:url('Commandline icons/3ddistance.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	3DDISTANCE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DDWF" id="3ddwf" value="3ddwf" style= "background-image:url('Commandline icons/3ddwf.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	3DDWF	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DDWFPUBLISH" id="3ddwfpublish" value="3ddwfpublish" style= "background-image:url('Commandline icons/3ddwfpublish.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	3DDWFPUBLISH	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DEDITBAR" id="3deditbar" value="3deditbar" style= "background-image:url('Commandline icons/3deditbar.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	3DEDITBAR	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DFACE" id="3dface" value="3dface" style= "background-image:url('Commandline icons/3dface.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	3DFACE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DFLY" id="3dfly" value="3dfly" style= "background-image:url('Commandline icons/3dfly.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	3DFLY	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DFORBIT" id="3dforbit" value="3dforbit" style= "background-image:url('Commandline icons/3dforbit.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	3DFORBIT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DMESH" id="3dmesh" value="3dmesh" style= "background-image:url('Commandline icons/3dmesh.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	3DMESH	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DMIRROR(MIRROR3D)" id="3dmirror" value="3dmirror" style= "background-image:url('Commandline icons/3dmirror.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	3DMIRROR(MIRROR3D)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DMOVE" id="3dmove" value="3dmove" style= "background-image:url('Commandline icons/3dmove.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	3DMOVE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DNAVIGATE(3DWALK)" id="3dnavigate" value="3dnavigate" style= "background-image:url('Commandline icons/3dnavigate.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	3DNAVIGATE(3DWALK)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DO(3DORBIT)" id="3do" value="3do" style= "background-image:url('Commandline icons/3do.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	3DO(3DORBIT)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DORBITCTR" id="3dorbitctr" value="3dorbitctr" style= "background-image:url('Commandline icons/3dorbitctr.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	3DORBITCTR	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DOSNAP" id="3dosnap" value="3dosnap" style= "background-image:url('Commandline icons/3dosnap.png');background-repeat:no-repeat; text-indent: 30px;" value="3DOSNAP" data-display="true" data-highlight="false">	3DOSNAP	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DP(3DPRINT)" id="3dp" value="3dp" style= "background-image:url('Commandline icons/3dp.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	3DP(3DPRINT)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DPAN" id="3dpan" value="3dpan" style= "background-image:url('Commandline icons/3dpan.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	3DPAN	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DPOLY" id="3dpoly" value="3dpoly" style= "background-image:url('Commandline icons/3dpoly.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	3DPOLY	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DPRINTSERVICE" id="3dprintservice" value="3dprintservice" style= "background-image:url('Commandline icons/3dprintservice.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	3DPRINTSERVICE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DROTATE" id="3drotate" value="3drotate" style= "background-image:url('Commandline icons/3drotate.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	3DROTATE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DSCALE" id="3dscale" value="3dscale" style= "background-image:url('Commandline icons/3dscale.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	3DSCALE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DSIN" id="3dsin" value="3dsin" style= "background-image:url('Commandline icons/3dsin.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	3DSIN	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DSWIVEL" id="3dswivel" value="3dswivel" style= "background-image:url('Commandline icons/3dswivel.png');background-repeat:no-repeat; text-indent: 30px;" value="3DSWIVEL" data-display="true" data-highlight="false">	3DSWIVEL	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="3DZOOM" id="3dzoom" value="3dzoom"  style= "background-image:url('Commandline icons/3dzoom.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	3DZOOM	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="A(ARC)" id="a" value="a" style= "background-image:url('Commandline icons/a.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	A(ARC)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AA(AREA)" id="aa" value="aa"  style= "background-image:url('Commandline icons/aa.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AA(AREA)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AAD(DBCONNECT)" id="aad"value="aad" style= "background-image:url('Commandline icons/aad.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AAD(DBCONNECT)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ABOUT" id="about"value="about" style= "background-image:url('Commandline icons/about.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ABOUT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AC(BACTION)" id="ac" value="ac" style= "background-image:url('Commandline icons/ac.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AC(BACTION)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ACADBLOCKDIALOG(BLOCK)" id="acadblockdialog" value="acadblockdialog" style= "background-image:url('Commandline icons/acadblockdialog.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ACADBLOCKDIALOG(BLOCK)	</li>

                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ACADWBLOCKDIALOG(WBLOCK)" id="acadwblockdialog"  value="acadwblockdialog" style= "background-image:url('Commandline icons/acadwblockdialog.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ACADWBLOCKDIALOG(WBLOCK)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ACDCATTEDIT" id="acdcattedit" value="acdcattedit" style= "background-image:url('Commandline icons/acdcattedit.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ACDCATTEDIT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ACETUCS_BACK" id="acetucs_back" value="acetucs_back" style= "background-image:url('Commandline icons/acetucs_back.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ACETUCS_BACK	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ACETUCS_BOTTOM" id="acetucs_bottom" value="acetucs_bottom" style= "background-image:url('Commandline icons/acetucs_bottom.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ACETUCS_BOTTOM	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ACETUCS_FRONT" id="acetucs_front" value="acetucs_front" style= "background-image:url('Commandline icons/acetucs_front.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ACETUCS_FRONT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ACETUCS_LEFT" id="acetucs_left" value="acetucs_left" style= "background-image:url('Commandline icons/acetucs_left.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	ACETUCS_LEFT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ACETUCS_RIGHT" id="acetucs_right" value="acetucs_right" style= "background-image:url('Commandline icons/acetucs_right.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ACETUCS_RIGHT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ACETUCS_TOP" id="acetucs_top" value="acetucs_top" style= "background-image:url('Commandline icons/acetucs_top.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ACETUCS_TOP	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ACISIN" id="acisin" value="acisin" style= "background-image:url('Commandline icons/acisin.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	ACISIN	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ACISOUT" id="acisout" value="acisout" style= "background-image:url('Commandline icons/acisout.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ACISOUT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ACPTOOLTIPS" id="acptooltips" value="acptooltips"style= "background-image:url('Commandline icons/acptooltips.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ACPTOOLTIPS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ACTBASEPOINT" id="actbasepoint" value="actbasepoint" style= "background-image:url('Commandline icons/actbasepoint.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ACTBASEPOINT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ACTMANAGER" id="actmanager" value="actmanager" style= "background-image:url('Commandline icons/actmanager.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ACTMANAGER	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ACTRECORD" id="actrecord" value="actrecord"  style= "background-image:url('Commandline icons/actrecord.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ACTRECORD	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ACTSTOP" id="actstop" value="actstop" style= "background-image:url('Commandline icons/actstop.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ACTSTOP	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ACTUSERINPUT" id="actuserinput" value="actuserinput" style= "background-image:url('Commandline icons/actuserinput.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ACTUSERINPUT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ACTUSERMESSAGE" id="actusermessage" value="actusermessage" style= "background-image:url('Commandline icons/actusermessage.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ACTUSERMESSAGE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ADC(ADCENTER)(DC)" id="adc" value="adc" style= "background-image:url('Commandline icons/adc.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ADC(ADCENTER)(DC)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ADCCLOSE" id="adcclose" value="adcclose" style= "background-image:url('Commandline icons/adcclose.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ADCCLOSE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ADCCUSTOMNAVIGATE" id="adccustomnavigate" value="adccustomnavigate" style= "background-image:url('Commandline icons/adccustomnavigate.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ADCCUSTOMNAVIGATE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ADCNAVIGATE" id="adcnavigate" value="adcnavigate" style= "background-image:url('Commandline icons/adcnavigate.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	ADCNAVIGATE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ADDSELECTED" id="addselected" value="addselected"  style= "background-image:url('Commandline icons/addselected.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ADDSELECTED	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ADDVARS2SCR" id="addvars2scr" value="addvars2scr" style= "background-image:url('Commandline icons/addvars2scr.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ADDVARS2SCR	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ADJUST" id="adjust" value="adjust" style= "background-image:url('Commandline icons/adjust.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	ADJUST	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AEC3DDWFEDGE" id="aec3ddwfedge" value="aec3ddwfedge" style= "background-image:url('Commandline icons/aec3ddwfedge.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AEC3DDWFEDGE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AECEFILEOPENMESSAGE" id="aecefileopenmessage" value="aecefileopenmessage" style= "background-image:url('Commandline icons/aecefileopenmessage.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AECEFILEOPENMESSAGE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AECEFILESAVEMESSAGE" id="aecefilesavemessage" value="aecefilesavemessage" style= "background-image:url('Commandline icons/aecefilesavemessage.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AECEFILESAVEMESSAGE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AECOBJECTCOPYMESSAGE" id="aecobjectcopymessage" value="aecobjectcopymessage" style= "background-image:url('Commandline icons/aeceobjectcopymessage.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AECOBJECTCOPYMESSAGE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AECTOACAD(-EXPORTTOAUTOCAD)" id="aectoacad" value="aectoacad" style= "background-image:url('Commandline icons/aectoacad.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AECTOACAD(-EXPORTTOAUTOCAD)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AECVCOMPAREIGNOREHATCH" id="aecvcompareignorehatch" value="aecvcompareignorehatch" style= "background-image:url('Commandline icons/aecvcompareignorehatch.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AECVCOMPAREIGNOREHATCH	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AECVERSION" id="aecversion" value="aecversion" style= "background-image:url('Commandline icons/aecversion.png');background-repeat:no-repeat; text-indent: 30px;" value="AECVERSION" data-display="true" data-highlight="false">	AECVERSION	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AFLAGS" id="aflags" value="aflags" style= "background-image:url('Commandline icons/aflags.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AFLAGS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_BROWSE" id="ai_browse" value="ai_browse" style= "background-image:url('Commandline icons/ai_browse.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AI_BROWSE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_CIRCTAN" id="ai_circtan" value="ai_circtan" style= "background-image:url('Commandline icons/ai_circtan.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AI_CIRCTAN	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_CUSTOM_SAFE	" id="ai_custom_safe" value="ai_custom_safe" style= "background-image:url('Commandline icons/ai_custom_safe.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AI_CUSTOM_SAFE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_DESELECT" id="ai_deselect" value="ai_deselect" style= "background-image:url('Commandline icons/ai_deselect.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AI_DESELECT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_DIM_TEXTABOVE" id="ai_dim_textabove" value="ai_dim_textabove" style= "background-image:url('Commandline icons/ai_dim_textabove.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AI_DIM_TEXTABOVE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_DIM_TEXTCENTER" id="ai_dim_textcenter" value="ai_dim_textcenter" style= "background-image:url('Commandline icons/ai_dim_textcenter.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AI_DIM_TEXTCENTER	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_DIM_TEXTHOME" id="ai_dim_texthome" value="ai_dim_texthome" style= "background-image:url('Commandline icons/ai_dim_texthome.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AI_DIM_TEXTHOME	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_DOWNLOAD_LANGUAGE_PACKS" id="ai_download_language_packs" value="ai_download_language_packs" style= "background-image:url('Commandline icons/ai_download_language_packs.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AI_DOWNLOAD_LANGUAGE_PACKS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_DOWNLOAD_OFFLINEHELP" id="ai_download_offlinehelp" value="ai_download_offlinehelp" style= "background-image:url('Commandline icons/ai_download_offlinehelp.png');background-repeat:no-repeat; text-indent: 30px;" value="AI_DOWNLOAD_OFFLINEHELP" data-display="true" data-highlight="false">	AI_DOWNLOAD_OFFLINEHELP	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_DRAWORDER" id="ai_draworder" value="ai_draworder" style= "background-image:url('Commandline icons/ai_draworder.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AI_DRAWORDER	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_EDITCUSTFILE" id="ai_editcustfile" value="ai_editcustfile" style= "background-image:url('Commandline icons/ai_editcustfile.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AI_EDITCUSTFILE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_EMPTYPRINC" id="ai_emptyprinc" value="ai_emptyprinc" style= "background-image:url('Commandline icons/ai_emptyprinc.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AI_EMPTYPRINC	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_FMS" id="ai_fms" value="ai_fms" style= "background-image:url('Commandline icons/ai_fms.png');background-repeat:no-repeat; text-indent: 30px;" value="AI_FMS" data-display="true" data-highlight="false">	AI_FMS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_INVOKENFW" id="ai_invokenfw" value="ai_invokenfw" style= "background-image:url('Commandline icons/ai_invokenfw.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AI_INVOKENFW	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_MOLC" id="ai_molc" value="ai_molc" style= "background-image:url('Commandline icons/ai_molc.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AI_MOLC	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_OPEN_AUTOCAD_BLOCK_WITH_PRODUCT" id="ai_open_autocad_block_with_product" value="ai_open_autocad_block_with_product" style= "background-image:url('');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AI_OPEN_AUTOCAD_BLOCK_WITH_PRODUCT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_OPEN_FACEBOOK_WITH_PRODUCT" id="ai_open_facebook_with_product" value="ai_open_facebook_with_product" style= "background-image:url('');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AI_OPEN_FACEBOOK_WITH_PRODUCT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_OPEN_HWCERTIFICATION" id="ai_open_hwcertification" value="ai_open_hwcertification" style= "background-image:url('');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AI_OPEN_HWCERTIFICATION	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_OPEN_SUBSCRIBTION" id="ai_open_subscribtion" value="ai_open_subscribtion" style= "background-image:url('');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AI_OPEN_SUBSCRIBTION	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_OPEN_TWITER_WITH_PRODUCT" id="ai_open_twiter_with_product" value="ai_open_twiter_with_product" style= "background-image:url('');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AI_OPEN_TWITER_WITH_PRODUCT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_OPEN_YOUTUBE_WITH_PRODUCT" id="ai_open_youtube_with_product" value="ai_open_youtube_with_product" style= "background-image:url('');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AI_OPEN_YOUTUBE_WITH_PRODUCT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_PRODUCT_SUPPORT" id="ai_product_support" value="ai_product_support" style= "background-image:url('');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AI_PRODUCT_SUPPORT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_PRODUCT_SUPPORT_SAFE" id="ai_product_support_safe" value="AIPRODUCTSUPPORTSAFE" style= "background-image:url('');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AI_PRODUCT_SUPPORT_SAFE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_PSPACE" id="ai_pspace" value="ai_pspace" style= "background-image:url('');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AI_PSPACE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_PUBLISH" id="ai_publish" value="ai_publish" style= "background-image:url('');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AI_PUBLISH	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_SELALL" id="ai_selall" value="ai_selall" style= "background-image:url('Commandline icons/ai_selall.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AI_SELALL	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_SEND_FEEDBACK" id="ai_send_feedback" value="ai_send_feedback" style= "background-image:url('Commandline icons/ai_send_feedback.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AI_SEND_FEEDBACK	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_TILEMODE 1" id="ai_tilemode 1" value="ai_tilemode 1" style= "background-image:url('Commandline icons/ai_tilemode1.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AI_TILEMODE 1	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_TRAINING_SAFE" id="ai_training_safe" value="ai_training_safe" style= "background-image:url('Commandline icons/ai_training_safe.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AI_TRAINING_SAFE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AI_VIEWPORTS_ALERT" id="ai_viewports_alert" value="ai_viewports_alert" style= "background-image:url('Commandline icons/ai_viewports_alert.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AI_VIEWPORTS_ALERT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AIDIMFLIPARROW" id="aidimfliparrow" value="aidimfliparrow" style= "background-image:url('Commandline icons/aidimfliparrow.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AIDIMFLIPARROW	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AIDIMPREC" id="aidimprec" value="aidimprec" style= "background-image:url('Commandline icons/aidimprec.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AIDIMPREC	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AIDIMSTYLE" id="aidimstyle" value="aidimstyle" style= "background-image:url('Commandline icons/aidimstyle.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AIDIMSTYLE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AIDIMTEXTMOVE" id="aidimtextmove" value="aidimtextmove" style= "background-image:url('Commandline icons/aidimtextmove.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AIDIMTEXTMOVE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AIMLEADEREDITADD" id="aimleadereditadd" value="aimleadereditadd" style= "background-image:url('Commandline icons/aimleadereditadd.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AIMLEADEREDITADD	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AIMLEADEREDITREMOVE" id="aimleadereditremove" value="aimleadereditremove" style= "background-image:url('Commandline icons/aimleadereditremove.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AIMLEADEREDITREMOVE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AIOBJECTSCALEADD" id="aiobjectscaleadd" value="aiobjectscaleadd" style= "background-image:url('Commandline icons/.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AIOBJECTSCALEADD	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AIOBJECTSCALEREMOVE" id="aiobjectscaleremove" value="aiobjectscaleremove" style= "background-image:url('Commandline icons/aiobjectscaleremove.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AIOBJECTSCALEREMOVE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AL(ALIGN)" id="al" value="al" style= "background-image:url('Commandline icons/al.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AL(ALIGN)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ALIASEDIT" id="aliasedit" value="aliasedit" style= "background-image:url('Commandline icons/aliasedit.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ALIASEDIT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ALIGNSPACE" id="align_space" value="align_space" style= "background-image:url('Commandline icons/alignspace.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	ALIGNSPACE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ALIGNTEXT(TEXTALIGN)" id="align_text_angle"  value="align_text_angle" style= "background-image:url('Commandline icons/aligntext.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ALIGNTEXT(TEXTALIGN)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ALLPLAY" id="allplay" value="allplay" style= "background-image:url('Commandline icons/allplay.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ALLPLAY	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AMECONVERT" id="ameconvert" value="ameconvert" style= "background-image:url('Commandline icons/ameconvert.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AMECONVERT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ANALYSISCURVATURE" id="analysis_curvature" value="analysis_curvature" style= "background-image:url('Commandline icons/analysiscurvature.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ANALYSISCURVATURE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ANALYSISDRAFT" id="analysis_draft" value="analysis_draft" style= "background-image:url('Commandline icons/analysisdraft.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ANALYSISDRAFT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ANALYSISOPTIONS" id="analysis_options" value="analysis_options" style= "background-image:url('Commandline icons/analysisoptions.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ANALYSISOPTIONS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ANALYSISZEBRA" id="analysiszebra" value="analysiszebra" style= "background-image:url('Commandline icons/analysis.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	ANALYSISZEBRA	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ANIPATH" id="anipath" value="anipath" style= "background-image:url('Commandline icons/anipath.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ANIPATH	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ANNORESET" id="annoreset" value="annoreset" style= "background-image:url('Commandline icons/annoreset.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ANNORESET	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ANNOUPDATE" id="annoupdate" value="annoupdate" style= "background-image:url('Commandline icons/annoupdate.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ANNOUPDATE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AP(APPLOAD)" id="ap" value="ap" style= "background-image:url('Commandline icons/ap.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AP(APPLOAD)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="APERTURE" id="aperture" value="aperture" style= "background-image:url('Commandline icons/aperture.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	APERTURE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="APPAUTOLOADER" id="appautoloader" value="appautoloader"  style= "background-image:url('Commandline icons/appautoloader.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	APPAUTOLOADER	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="APPMANAGER" id="appmanager" value="appmanager" style= "background-image:url('Commandline icons/appmanager.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	APPMANAGER	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="APPSTORE" id="appstore" value="appstore" style= "background-image:url('Commandline icons/appstore.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	APPSTORE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AR(ARRAY)" id="ar" value="ar" style= "background-image:url('Commandline icons/ar.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AR(ARRAY)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ARCHIVE" id="archive" value="archive" style= "background-image:url('Commandline icons/archive.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ARCHIVE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ARCTEXT" id="arctext" value="arctext" style= "background-image:url('Commandline icons/arctext.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ARCTEXT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ARRAYPOLAR" id="arraypolar" value="arraypolar" style= "background-image:url('Commandline icons/arraypolar.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	ARRAYPOLAR	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ARRAYCLASSIC" id="arrayclassic" value="arrayclassic" style= "background-image:url('Commandline icons/arrayclassic.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ARRAYCLASSIC	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ARRAYCLOSE" id="arrayclose" value="arrayclose" style= "background-image:url('Commandline icons/arrayclose.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ARRAYCLOSE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ARRAYEDIT" id="array_edit" value="array_edit" style= "background-image:url('Commandline icons/arrayedit.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ARRAYEDIT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ARRAYPATH" id="arraypath" value="arraypath" style= "background-image:url('Commandline icons/arraypath.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ARRAYPATH	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ARRAYRECT" id="arrayrect" value="arrayrect" style= "background-image:url('Commandline icons/arrayrect.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ARRAYRECT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ARX" id="arx" value="arx" style= "background-image:url('Commandline icons/arx.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	ARX	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ATE(ATTEDIT)" id="ate" value="ate" style= "background-image:url('Commandline icons/ate.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	ATE(ATTEDIT)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ATEXT" id="atext" value="atext" style= "background-image:url('Commandline icons/atext.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	ATEXT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ATI(ATTIPEDIT)" id="ati" value="ati" style= "background-image:url('Commandline icons/ati.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	ATI(ATTIPEDIT)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ATT(ATTDEF)" id="att" value="att" style= "background-image:url('Commandline icons/att.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	ATT(ATTDEF)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ATTACH" id="attach"  value="attach" style= "background-image:url('Commandline icons/attach.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ATTACH	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ATTACHURL" id="attachurl" value="attachurl" style= "background-image:url('Commandline icons/attachurl.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ATTACHURL	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ATTDISP" id="attdisp" value="attdisp" style= "background-image:url('Commandline icons/attdisp.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	ATTDISP	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ATTEXT" id="attext"  value="attext" style= "background-image:url('Commandline icons/attext.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ATTEXT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ATTIN" id="attin" value="attin" style= "background-image:url('Commandline icons/attin.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	ATTIN	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ATTOUT" id="attout"  value="attout" style= "background-image:url('Commandline icons/attout.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ATTOUT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ATTREDEF" id="attredef"  value="attredef" style= "background-image:url('Commandline icons/attredef.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ATTREDEF	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ATTSYNC" id="attsync"  value="attsync"  style= "background-image:url('Commandline icons/attsync.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ATTSYNC	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AUDIT" id="audit" value="audit" style= "background-image:url('Commandline icons/audit.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AUDIT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AUTOCOMPLETE(-INPUTSEARCHOPTIONS)" id="autocomplete"  value="autocomplete" style= "background-image:url('Commandline icons/autocomplete.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AUTOCOMPLETE(-INPUTSEARCHOPTIONS)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AUTOCOMPLETEDELAY(INPUTSEARCHDELAY)" id="autocompletedelay" value="autocompletedelay" style= "background-image:url('Commandline icons/autocompletedelay.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AUTOCOMPLETEDELAY(INPUTSEARCHDELAY)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AUTOCONSTRAIN" id="autoconstrain"  value="autoconstrain" style= "background-image:url('Commandline icons/autoconstrain.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AUTOCONSTRAIN	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AUTODESKCONNECTIONPOINT" id="autodeskconnectionpoint"  value="autodeskconnectionpoint" style= "background-image:url('Commandline icons/autodeskconnectionpoint.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AUTODESKCONNECTIONPOINT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AUTOPUBLISH" id="autopublish" value="autopublish" style= "background-image:url('Commandline icons/autopublish.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AUTOPUBLISH	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AV(DSVIEWER)" id="av" value="av" style= "background-image:url('Commandline icons/av.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	AV(DSVIEWER)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="AXIS" id="axis"  value="axis" style= "background-image:url('Commandline icons/axis.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	AXIS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="B(BLOCK)" id="b" value="b" style= "background-image:url('Commandline icons/b.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	B(BLOCK)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BACKGROUND" id="background" value="background" style= "background-image:url('Commandline icons/background.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BACKGROUND	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BACTION" id="baction" value="baction" style= "background-image:url('Commandline icons/baction.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BACTION	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BACTIONBAR" id="bactionbar"  value="bactionbar" style= "background-image:url('Commandline icons/bactionbar.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BACTIONBAR	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BACTIONSET" id="bactionset"  value="bactionset" style= "background-image:url('Commandline icons/bactionset.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BACTIONSET	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BACTIONTOOL" id="bactiontool" value="bactiontool" style= "background-image:url('Commandline icons/bactiontool.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BACTIONTOOL	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BASE" id="base" value="base" style= "background-image:url('Commandline icons/base.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BASE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BASSOCIATE" id="bassociate" value="bassociate"  style= "background-image:url('Commandline icons/bassociate.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BASSOCIATE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BATCHPLOT(PUBLISH)" id="batchplot" value="batchplot" style= "background-image:url('Commandline icons/batchplot.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BATCHPLOT(PUBLISH)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BATTMAN" id="battman" value="battman" style= "background-image:url('Commandline icons/battman.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BATTMAN	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BATTORDER" id="battorder" value="battorder" style= "background-image:url('Commandline icons/battorder.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BATTORDER	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BAUTHORPALETTE" id="bauthorpalette" value="bauthorpalette" style= "background-image:url('Commandline icons/bauthorpalette.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BAUTHORPALETTE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BAUTHORPALETTECLOSE" id="bauthorpaletteclose" value="bauthorpaletteclose" style= "background-image:url('Commandline icons/bauthorpaletteclose.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BAUTHORPALETTECLOSE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BC(BCLOSE)" id="bc"  value="bc" style= "background-image:url('Commandline icons/bc.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BC(BCLOSE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BCONSTRUCTION" id="bconstruction" value="bconstruction" style= "background-image:url('Commandline icons/bconstruction.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BCONSTRUCTION	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BCOUNT" id="bcount" value="bcount" style= "background-image:url('Commandline icons/bcount.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BCOUNT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BCPARAMETER" id="bcparameter" value="bcparameter" style= "background-image:url('Commandline icons/bcparameter.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BCPARAMETER	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BCYCLEORDER" id="bcycleorder" value="bcycleorder" style= "background-image:url('Commandline icons/bcycleorder.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BCYCLEORDER	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BE(EDIT)" id="be" value="be" style= "background-image:url('Commandline icons/be.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BE(EDIT)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BESETTINGS" id="besettings"  value="besettings" style= "background-image:url('Commandline icons/besettings.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BESETTINGS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BEXTEND" id="bextend" value="bextend" style= "background-image:url('Commandline icons/bextend.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BEXTEND	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BGPLOTRECEIVE" id="bgplotreceive"  value="bgplotreceive" style= "background-image:url('Commandline icons/bgplotreceive.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BGPLOTRECEIVE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BGRIPSET" id="bgripset"  value="bgripset" style= "background-image:url('Commandline icons/bgripset.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BGRIPSET	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BH(HATCH)" id="bh(hatch)" value="bh(hatch)" style= "background-image:url('Commandline icons/bh.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BH(HATCH)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BHATCH" id="bhatch" value="bhatch" style= "background-image:url('Commandline icons/bhatch.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BHATCH	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BLEND" id="blend"  value="blend" style= "background-image:url('Commandline icons/blend.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BLEND	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BLENDSRF(SURFBLEND)" id="blendsrf" value="blendsrf"  style= "background-image:url('Commandline icons/blendsrf.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BLENDSRF(SURFBLEND)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BLOCK" id="block?"  value="block?" style= "background-image:url('Commandline icons/block.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BLOCK	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BLOCKICON" id="blockicon"  value="blockicon" style= "background-image:url('Commandline icons/blockicon.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BLOCKICON	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BLOCKREPLACE" id="blockreplace"  value="blockreplace" style= "background-image:url('Commandline icons/blockreplace.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BLOCKREPLACE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BLOCKTOXREF" id="blocktoxref"  value="blocktoxref" style= "background-image:url('Commandline icons/blocktoxref.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BLOCKTOXREF	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BLOOKUPTABLE" id="blookuptable"  value="blookuptable" style= "background-image:url('Commandline icons/blookuptable.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BLOOKUPTABLE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BMPOUT" id="bmpout" value="bmpout" style= "background-image:url('Commandline icons/bmpout.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BMPOUT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BO(BOUNDARY)" id="bo(boundary)" value="bo(boundary)" style= "background-image:url('Commandline icons/bo.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BO(BOUNDARY)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BOOLEAN(UNION)" id="boolean" value="boolean" style= "background-image:url('Commandline icons/boolean.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BOOLEAN(UNION)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BOX" id="box"  value="box" style= "background-image:url('Commandline icons/box.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BOX	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BPARAMETER" id="bparameter" value="bparameter" style= "background-image:url('Commandline icons/bparameter.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BPARAMETER	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BPOLY" id="bpoly" value="bpoly" style= "background-image:url('Commandline icons/bpoly.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BPOLY	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BR(BREAK)" id="break"  value="break" style= "background-image:url('Commandline icons/br.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BR(BREAK)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BREAKLINE" id="breakline" value="breakline"  style= "background-image:url('Commandline icons/breakline.png');background-repeat:no-repeat; text-indent: 30px;"data-display="true" data-highlight="false">	BREAKLINE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BREAKUP(EXPLODE)" id="breakup" value="breakup" style= "background-image:url('Commandline icons/breakup.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BREAKUP(EXPLODE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BREP" id="brep" value="brep" style= "background-image:url('Commandline icons/brep.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BREP	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BROWSER" id="browser" value="browser" style= "background-image:url('Commandline icons/browser.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BROWSER	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BS(BSAVE)" id="bs"  value="bs" style= "background-image:url('Commandline icons/bs.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BS(BSAVE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BSAVEAS" id="bubble" value="bubble" style= "background-image:url('Commandline icons/bsaveas.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BSAVEAS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BSCALE" id="bscale"  value="bscale" style= "background-image:url('Commandline icons/bscale.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BSCALE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="B-SPLINE(SPLINE)" id="spline" value="spline" style= "background-image:url('Commandline icons/b-spline.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	B-SPLINE(SPLINE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BTABLE" id="btable"  value="btable" style= "background-image:url('Commandline icons/btable.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BTABLE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BTESTBLOCK" id="btestblock"  value="btestblock" style= "background-image:url('Commandline icons/btestblock.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	BTESTBLOCK	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BTRIM" id="btrim"  value="btrim" style= "background-image:url('Commandline icons/btrim.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BTRIM	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BUBBLE(MLEADER)" id="bubble"  value="bubble" style= "background-image:url('Commandline icons/bubble.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BUBBLE(MLEADER)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BVHIDE" id="bvhide" value="bvhide" style= "background-image:url('Commandline icons/bvhide.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BVHIDE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BVMODE" id="bvmode" value="bvmode" style= "background-image:url('Commandline icons/bvmode.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BVMODE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BVS(BVSTATE)" id="bvs" value="bvs"  style= "background-image:url('Commandline icons/bvs.png');background-repeat:no-repeat; text-indent: 30px;"data-display="true" data-highlight="false">	BVS(BVSTATE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="BVSHOW" id="bvshow" value="bvshow" style= "background-image:url('Commandline icons/bvshow.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	BVSHOW	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="C(CIRCLE)" id="circle_2_point" value="circle_2_point"  style= "background-image:url('Commandline icons/c.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	C(CIRCLE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CAL" id="cal" value="cal" style= "background-image:url('Commandline icons/cal.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CAL	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CALCULATOR(QUICKCALC)" id="calculator"  value="calculator" style= "background-image:url('Commandline icons/calculator.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CALCULATOR(QUICKCALC)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CALLOUT(MLEADER)" id="calloutmleader" value="calloutmleader" style= "background-image:url('Commandline icons/callout.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CALLOUT(MLEADER)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CAM(CAMERA)" id="camera_adjust_distance" value="camera_adjust_distance" style= "background-image:url('Commandline icons/cam.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	CAM(CAMERA)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CAMERADISPLAY" id="camera_display" value="camera_display" style= "background-image:url('Commandline icons/cameradisplay.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CAMERADISPLAY	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CBAR(CONSTRAINTBAR)" id="cbarconstraintbar" value="cbarconstraintbar" style= "background-image:url('Commandline icons/cbar.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CBAR(CONSTRAINTBAR)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CELLSELECT" id="cellselect"  value="cellselect" style= "background-image:url('Commandline icons/cellselect.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CELLSELECT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CENTERMARK" id="centermark"  value="centermark" style= "background-image:url('Commandline icons/centermark.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CENTERMARK	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CENTERREASSOCIATE" id="centerreassociate" value="centerreassociate" style= "background-image:url('Commandline icons/centerreassociate.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CENTERREASSOCIATE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CENTERRESET" id="centerreset" value="centerreset" style= "background-image:url('Commandline icons/centerreset.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	CENTERRESET	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CH(PROPERTIES)" id="chproperties" value="chproperties" style= "background-image:url('Commandline icons/ch.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CH(PROPERTIES)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CHA(CHAMFER)" id="chachamfer" value="chachamfer" style= "background-image:url('Commandline icons/cha.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CHA(CHAMFER)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CHAMFEREDGE" id="chamferedge" value="chamferedge" style= "background-image:url('Commandline icons/chamferedge.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CHAMFEREDGE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CHANGE" id="change" value="change" style= "background-image:url('Commandline icons/change.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CHANGE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CHECKSTANDARDS" id="checkstandards" value="checkstandards" style= "background-image:url('Commandline icons/checkstandards.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CHECKSTANDARDS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CHPROP" id="chprop"  value="chprop" style= "background-image:url('Commandline icons/chprop.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CHPROP	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CHSPACE" id="chspace" value="chspace" style= "background-image:url('Commandline icons/chspace.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CHSPACE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CHURLS" id="churls" value="churls" style= "background-image:url('Commandline icons/churls.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	CHURLS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CLASSICGROUP" id="classicgroup" value="classicgroup" style= "background-image:url('Commandline icons/classicgroup.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CLASSICGROUP	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CLASSICIMAGE" id="classicimage" value="classicimage" style= "background-image:url('Commandline icons/classicimage.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CLASSICIMAGE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CLASSICLAYER" id="classiclayer" value="classiclayer" style= "background-image:url('Commandline icons/classiclayer.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CLASSICLAYER	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CLASSICXREF" id="classicxref" value="classicxref" style= "background-image:url('Commandline icons/classicxref.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CLASSICXREF	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CLEANSCREENOFF" id="cleanscreenoff" value="cleanscreenoff" style= "background-image:url('Commandline icons/cleanscreenoff.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CLEANSCREENOFF	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CLEANSCREENON" id="cleanscreenon" value="cleanscreenon" style= "background-image:url('Commandline icons/cleanscreenon.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CLEANSCREENON	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CLI(COMMANDLINE)" id="clicommandline"  value="clicommandline" style= "background-image:url('Commandline icons/cli.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	CLI(COMMANDLINE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CLIP" id="clip" value="clip" style= "background-image:url('Commandline icons/clip.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CLIP	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CLIPIT" id="clipit" value="clipit" style= "background-image:url('Commandline icons/clipit.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CLIPIT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CLOSE" id="close"  value="close" style= "background-image:url('Commandline icons/close.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CLOSE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CLOSEALL" id="closeall" value="closeall" style= "background-image:url('Commandline icons/closeall.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CLOSEALL	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CLOSEALLOTHER" id="closeallother" value="closeallother" style= "background-image:url('Commandline icons/closeallother.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	CLOSEALLOTHER	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CMATTACH(COORDINATIONMODELATTACH)" id="cmattachcoordinationmodelattach" value="cmattachcoordinationmodelattach" style= "background-image:url('Commandline icons/cmattach.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CMATTACH(COORDINATIONMODELATTACH)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CO(COPY)" id="cocopy" value="cocopy"      style= "background-image:url('Commandline icons/co.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CO(COPY)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="COIL(HELIX)" id="coilhelix" value="coilhelix"    style= "background-image:url('Commandline icons/coil.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	COIL(HELIX)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="COL(COLOR)" id="colcolor"  value="colcolor"      style= "background-image:url('Commandline icons/col.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	COL(COLOR)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="COMBINE(UNION)" id="combineunion" value="combineunion"     style= "background-image:url('Commandline icons/combine.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	COMBINE(UNION)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="COMBINEPOLYLINES(PEDIT)" id="combinepolylinepedit" value="combinepolylinepedit"     style= "background-image:url('Commandline icons/combinepolylines.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	COMBINEPOLYLINES(PEDIT)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="COMMANDLINEHIDE" id="commandlinehide" value="commandlinehide" style= "background-image:url('Commandline icons/commandlinehide.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	COMMANDLINEHIDE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="COMPILE" id="compile" value="compile" style= "background-image:url('Commandline icons/compile.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	COMPILE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CONE" id="cone" value="cone" style= "background-image:url('Commandline icons/cone.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CONE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CONTENT(ADCENTER)" id="contentadcenter"  value="contentadcenter" style= "background-image:url('Commandline icons/conent.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CONTENT(ADCENTER)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CONFIG" id="config"  value="config" style= "background-image:url('Commandline icons/config.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CONFIG	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CONSTRAINFER" id="constrainfer" value="constrainfer" style= "background-image:url('Commandline icons/constrainfer.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CONSTRAINTINFER	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CONSTRAINTSETTINGS" id="constraintsettings" value="constraintsettings" style= "background-image:url('Commandline icons/constraintsettings.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CONSTRAINTSETTINGS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CONSTRAINTRELAX" id="constraintrelax" value="constraintrelax" 	style= "background-image:url('Commandline icons/constraintrelax.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CONSTRAINTRELAX	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CONSTRAINTSOLVEMODE" id="constraintsolvemode" value="constraintsolvemode" style= "background-image:url('Commandline icons/constraintsolvemode.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CONSTRAINTSOLVEMODE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CONSTRUCTIONLINE(RAY)" id="constructionline" value="constructionline" style= "background-image:url('Commandline icons/constructionline.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CONSTRUCTIONLINE(RAY)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CONTOUR(SPLINE)" id="contour" 		 value="contour" 			style= "background-image:url('Commandline icons/contour.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	CONTOUR(SPLINE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CONTOURLINE(ISOLINE)" id="contourline" value="contourline" style= "background-image:url('Commandline icons/contourline.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CONTOURLINE(ISOLINE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CONTRAINTSETTING" id="constraintsetting" value="constraintsetting" style= "background-image:url('Commandline icons/contraintsetting.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CONTRAINTSETTING	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CONVERT" id="convert" value="convert" style= "background-image:url('Commandline icons/convert.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CONVERT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CONVERTCTB" id="convertctb"  value="convertctb" style= "background-image:url('Commandline icons/convertctb.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CONVERTCTB	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CONVERTOLDLIGHTS" id="convertoldlights" value="convertoldlights" style= "background-image:url('Commandline icons/convertoldlights.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CONVERTOLDLIGHTS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CONVERTOLDMATERIALS" id="convertoldmaterials" value="convertoldmaterials" style= "background-image:url('Commandline icons/convertoldmaterials.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	CONVERTOLDMATERIALS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CONVERTOMESH(MESHSMOOTH)" id="convertomesh"  value="convertomesh" style= "background-image:url('Commandline icons/convertomesh.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	CONVERTOMESH(MESHSMOOTH)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CONVERTONURBS" id="convertonurbs" value="convertonurbs" style= "background-image:url('Commandline icons/convertonurbs.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CONVERTONURBS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CONVERTPOLY" id="convertpoly"  value="convertpoly" style= "background-image:url('Commandline icons/convertpoly.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CONVERTPOLY	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CONVERTPSTYLES" id="convertpstyles" value="convertpstyles" style= "background-image:url('Commandline icons/convertpstyles.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CONVERTPSTYLES	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CONVTOSOLID" id="convtosolid"  value="convtosolid" style= "background-image:url('Commandline icons/convtosolid.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CONVTOSOLID	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CONVTOSURFACE" id="convtosurface" value="convtosurface" style= "background-image:url('Commandline icons/convtosurface.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CONVTOSURFACE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="COORDINATES(ID)" id="coordinates"  value="coordinates" style= "background-image:url('Commandline icons/coordinates.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	COORDINATES(ID)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="COPYBASE" id="copybase"  value="copybase" style= "background-image:url('Commandline icons/copybase.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	COPYBASE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="COPYCLIP" id="copyclip"  value="copyclip" style= "background-image:url('Commandline icons/copyclip.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	COPYCLIP	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="COPYHIST" id="copyhist" value="copyhist" style= "background-image:url('Commandline icons/copyhist.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	COPYHIST	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="COPYLINK" id="copy_link"   value="copy_link" style= "background-image:url('Commandline icons/copylink.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	COPYLINK	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="COPYM" id="copym" value="copym" style= "background-image:url('Commandline icons/copym.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	COPYM	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="COPYTOLAYER" id="copytolayer" value="copytolayer" style= "background-image:url('Commandline icons/copytolayer.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	COPYTOLAYER	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="COUNT(QSELECT)" id="countqselect" value="countqselect" style= "background-image:url('Commandline icons/count.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	COUNT(QSELECT)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CPARAM(BCPARAMETER)" id="cparam" value="cparam" style= "background-image:url('Commandline icons/cparam.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CPARAM(BCPARAMETER)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CREASE(MESHCREASE)" id="crease" value="crease" style= "background-image:url('Commandline icons/crease.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CREASE(MESHCREASE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CREATESOLID(SURFSCULPT)" id= "createsolid"   value="createsolid"  style= "background-image:url('Commandline icons/createsolid.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CREATESOLID(SURFSCULPT)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CROSSSECTION(SECTION)" id="crosssection" value="crosssection" style= "background-image:url('Commandline icons/crosssection.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	CROSSSECTION(SECTION)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CVADD" id="cvadd"  value="cvadd"  style= "background-image:url('Commandline icons/cvadd.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	CVADD	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CUBE(NAVVCUBE)" id="cube"   value="cube"   style= "background-image:url('Commandline icons/cube.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CUBE(NAVVCUBE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CVHIDE" id="cvhide" value="cvhide" style= "background-image:url('Commandline icons/cvhide.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	CVHIDE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CUI" id="cui"    value="cui"    style= "background-image:url('Commandline icons/cui.png');background-repeat:no-repeat; text-indent: 30px;"   data-display="true" data-highlight="false">	CUI	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CUIEXPORT" id="cuiexport"  value="cuiexport"  style= "background-image:url('Commandline icons/cuiexport.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	CUIEXPORT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CUIIMPORT" id="cuiimport"  value="cuiimport"  style= "background-image:url('Commandline icons/cuiimport.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	CUIIMPORT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CUILOAD" id="cuiload"    value="cuiload"    style= "background-image:url('Commandline icons/cuiload.png');background-repeat:no-repeat; text-indent: 30px;"   data-display="true" data-highlight="false">	CUILOAD	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CUIUNLOAD" id="cuiunload"  value="cuiunload"  style= "background-image:url('Commandline icons/cuiunload.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	CUIUNLOAD	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CUSTOMIZE" id="customize"  value="customize"  style= "background-image:url('Commandline icons/customize.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	CUSTOMIZE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CUIXAPPEND" id="cuixappend" value="cuixappend" style= "background-image:url('Commandline icons/cuixappend.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	CUIXAPPEND	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CUIXCREATE" id="cuixcreate" value="cuixcreate" style= "background-image:url('Commandline icons/cuixcreate.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	CUIXCREATE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CUIXLIST" id="cuixlist"   value="cuixlist"   style= "background-image:url('Commandline icons/cuixlist.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	CUIXLIST	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CVPORT" id="cvport"     value="cvport"     style= "background-image:url('Commandline icons/cvport.png');background-repeat:no-repeat; text-indent: 30px;"    data-display="true" data-highlight="false">	CVPORT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CURVATUREANALYSIS(ANALYSISCURVATURE)" id="curvatureanalysis" value="curvatureanalysis" style= "background-image:url('Commandline icons/curvatureanalysis.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	CURVATUREANALYSIS(ANALYSISCURVATURE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CUTANDFILL(MASSPROP)" id="cutandfill"        value="cutandfill"        style= "background-image:url('Commandline icons/cutandfill.png');background-repeat:no-repeat; text-indent: 30px;"		         data-display="true" data-highlight="false">	CUTANDFILL(MASSPROP)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CUTCLIP" id="cutclip"           value="cutclip"           style= "background-image:url('Commandline icons/cutclip.png');background-repeat:no-repeat; text-indent: 30px;" 		  data-display="true" data-highlight="false">	CUTCLIP	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CVREBUILD" id="cvrebuild" 		   value="cvrebuild" 		   style= "background-image:url('Commandline icons/cvrebuild.png');background-repeat:no-repeat; text-indent: 30px;"         		data-display="true" data-highlight="false">	CVREBUILD	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CVREMOVE" id="cvremove" 			value="cvremove" 			style= "background-image:url('Commandline icons/cvremove.png');background-repeat:no-repeat; text-indent: 30px;"          		data-display="true" data-highlight="false">	CVREMOVE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CVSHOW" id="cvshow" 			value="cvshow" 			style= "background-image:url('Commandline icons/cvshow.png');background-repeat:no-repeat; text-indent: 30px;"            			data-display="true" data-highlight="false">	CVSHOW	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="CYL(CYLINDER)" id="cyl" 				value="cyl" 				style= "background-image:url('Commandline icons/cyl.png');background-repeat:no-repeat; text-indent: 30px;"               			data-display="true" data-highlight="false">	CYL(CYLINDER)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DELETE(ERASE)" id="delete" 			value="delete" 			style= "background-image:url('Commandline icons/delete.png');background-repeat:no-repeat; text-indent: 30px;"            				data-display="true" data-highlight="false">	DELETE(ERASE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DISPLAYSTYLE(VISUALSTYLES)" id="displaystyle" 		value="displaystyle" 		style= "background-image:url('Commandline icons/displaystyle.png');background-repeat:no-repeat; text-indent: 30px;"      	data-display="true" data-highlight="false">	DISPLAYSTYLE(VISUALSTYLES)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DDCHPROP(PROPERTIES)" id="ddchprop" 			value="ddchprop" 			style= "background-image:url('Commandline icons/ddchprop.png');background-repeat:no-repeat; text-indent: 30px;"          		data-display="true" data-highlight="false">	DDCHPROP(PROPERTIES)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DDATTE(ATTEDIT)" id="ddatte" 			value="ddatte" 			style= "background-image:url('Commandline icons/ddatte.png');background-repeat:no-repeat; text-indent: 30px;"            			data-display="true" data-highlight="false">	DDATTE(ATTEDIT)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DISASSEMBLE(EXPLODE)" id="disassemble" 		value="disassemble" 		style= "background-image:url('Commandline icons/disassemble.png');background-repeat:no-repeat; text-indent: 30px;"       	data-display="true" data-highlight="false">	DISASSEMBLE(EXPLODE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBCEXPORTTS" id="dbcexportts" 		value="dbcexportts" 		style= "background-image:url('Commandline icons/dbcexportts.png');background-repeat:no-repeat; text-indent: 30px;"       	data-display="true" data-highlight="false">	DBCEXPORTTS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBCHIDELABELS" id="dbchidelabels" 	   value="dbchidelabels" 	   style= "background-image:url('Commandline icons/dbchidelabels.png');background-repeat:no-repeat; text-indent: 30px;"     	data-display="true" data-highlight="false">	DBCHIDELABELS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBCIMPORTQRY" id="dbcimportqry" 		value="dbcimportqry" 		style= "background-image:url('Commandline icons/dbcimportqry.png');background-repeat:no-repeat; text-indent: 30px;"      	data-display="true" data-highlight="false">	DBCIMPORTQRY	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBCIMPORTS" id="dbcimports" 		value="dbcimports" 		style= "background-image:url('Commandline icons/dbcimports.png');background-repeat:no-repeat; text-indent: 30px;"        		data-display="true" data-highlight="false">	DBCIMPORTS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBCLINKCONVERSION" id="dbclinkconversion" value="dbclinkconversion" style= "background-image:url('Commandline icons/dbclinkconversion.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	DBCLINKCONVERSION	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBCLINKMANAGER" id="dbclinkmanager"    value="dbclinkmanager"    style= "background-image:url('Commandline icons/dbclinkmanager.png');background-repeat:no-repeat; text-indent: 30px;"    data-display="true" data-highlight="false">	DBCLINKMANAGER	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBCNEQRYCT" id="dbcneqryct" 		value="dbcneqryct" 		style= "background-image:url('Commandline icons/dbcneqryct.png');background-repeat:no-repeat; text-indent: 30px;"        data-display="true" data-highlight="false">	DBCNEQRYCT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBCNEWQRYTABLE" id="dbcnewqrytable"    value="dbcnewqrytable"    style= "background-image:url('Commandline icons/dbcnewqrytable.png');background-repeat:no-repeat; text-indent: 30px;"    data-display="true" data-highlight="false">	DBCNEWQRYTABLE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBCPROPSLBLT" id="dbcpropslblt"      value="dbcpropslblt"      style= "background-image:url('Commandline icons/dbcpropslblt.png');background-repeat:no-repeat; text-indent: 30px;"      data-display="true" data-highlight="false">	DBCPROPSLBLT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBCPROPSLT" id="dbcpropslt"        value="dbcpropslt"        style= "background-image:url('Commandline icons/dbcpropslt.png');background-repeat:no-repeat; text-indent: 30px;"        data-display="true" data-highlight="false">	DBCPROPSLT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBCRELOADLABELS" id="dbcreloadlabels"   value="dbcreloadlabels"   style= "background-image:url('Commandline icons/dbcreloadlabels.png');background-repeat:no-repeat; text-indent: 30px;"     data-display="true" data-highlight="false">	DBCRELOADLABELS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBCSELECTLINKS" id="dbcselectlinks"    value="dbcselectlinks"    style= "background-image:url('Commandline icons/dbselectlinks.png');background-repeat:no-repeat; text-indent: 30px;"         data-display="true" data-highlight="false">	DBCSELECTLINKS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DCFORM" id="dcform"            value="dcform"            style= "background-image:url('Commandline icons/dcform.png');background-repeat:no-repeat; text-indent: 30px;"               data-display="true" data-highlight="false">	DCFORM	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DGNOSNAP" id="dnosnap"          value="dnosnap"          style= "background-image:url('Commandline icons/dgnosnap.png');background-repeat:no-repeat; text-indent: 30px;"           data-display="true" data-highlight="false">	DGNOSNAP	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DRAFTANGLEANALYSIS(ANALYSISDRAFTANGLE)" id="draftangleanalysis"value="draftangleanalysis"style= "background-image:url('Commandline icons/draftangleanalysis.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	DRAFTANGLEANALYSIS(ANALYSISDRAFTANGLE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DT(TEXT)" id="dt"                value="dt"                style= "background-image:url('Commandline icons/dt.png');background-repeat:no-repeat; text-indent: 30px;"                 data-display="true" data-highlight="false">	DT(TEXT)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DWFOUT(PLOT)" id="dwfout"            value="dwfout"            style= "background-image:url('Commandline icons/dwfout.png');background-repeat:no-repeat; text-indent: 30px;"              data-display="true" data-highlight="false">	DWFOUT(PLOT)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DDLMODES(LAYER)" id="ddlmodes"          value="ddlmodes"          style= "background-image:url('Commandline icons/ddlmodes.png');background-repeat:no-repeat; text-indent: 30px;"            data-display="true" data-highlight="false">	DDLMODES(LAYER)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DED(DIMEDIT)" id="ded"               value="ded"               style= "background-image:url('Commandline icons/ded.png');background-repeat:no-repeat; text-indent: 30px;"                data-display="true" data-highlight="false">	DED(DIMEDIT)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIMINSPECT" id="diminspect" value="diminspect" style= "background-image:url('Commandline icons/diminspect.png');background-repeat:no-repeat; text-indent: 30px;"       data-display="true" data-highlight="false">	DIMINSPECT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DDATTDEF(ATTDEF)" id="ddattdef"   value="ddattdef"   style= "background-image:url('Commandline icons/ddattdef.png');background-repeat:no-repeat; text-indent: 30px;"         data-display="true" data-highlight="false">	DDATTDEF(ATTDEF)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DV(VIEW)" id="dv"       value="dv"       style= "background-image:url('Commandline icons/dv.png');background-repeat:no-repeat; text-indent: 30px;"          data-display="true" data-highlight="false">	DV(VIEW)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIM" id="dim"      value="dim"      style= "background-image:url('Commandline icons/dim.png');background-repeat:no-repeat; text-indent: 30px;"       data-display="true" data-highlight="false">	DIM	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBA(DIMBASELINE)" id="dba"      value="dba"      style= "background-image:url('Commandline icons/dba.png');background-repeat:no-repeat; text-indent: 30px;"       data-display="true" data-highlight="false">	DBA(DIMBASELINE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DCLINEAR" id="dclinear" value="dclinear" style= "background-image:url('Commandline icons/dclinear.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	DCLINEAR	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DCRADIUS" id="dcradius" value="dcradius" style= "background-image:url('Commandline icons/dcradius.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	DCRADIUS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIMBREAK" id="dimbreak" value="dimbreak" style= "background-image:url('Commandline icons/dimbreak.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	DIMBREAK	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DCE(DIMCENTER)" id="dce"      value="dce"      style= "background-image:url('Commandline icons/dce.png');background-repeat:no-repeat; text-indent: 30px;"            data-display="true" data-highlight="false">	DCE(DIMCENTER)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DCON(DIMCONSTRAINT)" id="dcon"     value="dcon"     style= "background-image:url('Commandline icons/dcon.png');background-repeat:no-repeat; text-indent: 30px;"            data-display="true" data-highlight="false">	DCON(DIMCONSTRAINT)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DCO(DIMCONTINUE)" id="dco"      value="dco"      style= "background-image:url('Commandline icons/dco.png');background-repeat:no-repeat; text-indent: 30px;"            data-display="true" data-highlight="false">	DCO(DIMCONTINUE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DDI(DIMDIAMETER)" id="ddi"      value="ddi"      style= "background-image:url('Commandline icons/ddi.png');background-repeat:no-repeat; text-indent: 30px;"          data-display="true" data-highlight="false">	DDI(DIMDIAMETER)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DDCOLOR" id="ddcolor"  value="ddcolor"  style= "background-image:url('Commandline icons/ddcolor.png');background-repeat:no-repeat; text-indent: 30px;"   data-display="true" data-highlight="false">	DDCOLOR	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DDLTYPE(LINETYPE)" id="ddltype"  value="ddltype"  style= "background-image:url('Commandline icons/ddltype.png');background-repeat:no-repeat; text-indent: 30px;"   data-display="true" data-highlight="false">	DDLTYPE(LINETYPE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DDOSNAP(OSNAP)" id="ddosnap"  value="ddosnap"  style= "background-image:url('Commandline icons/ddosnap.png');background-repeat:no-repeat; text-indent: 30px;"   data-display="true" data-highlight="false">	DDOSNAP(OSNAP)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DDVIEW(VIEW)" id="ddview"   value="ddview"   style= "background-image:url('Commandline icons/ddview.png');background-repeat:no-repeat; text-indent: 30px;"    data-display="true" data-highlight="false">	DDVIEW(VIEW)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DDUNITS(UNITS)" id="ddunits"  value="ddunits"  style= "background-image:url('Commandline icons/ddunits.png');background-repeat:no-repeat; text-indent: 30px;"   data-display="true" data-highlight="false">	DDUNITS(UNITS)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DTEXT(TEXT)" id="dtext"    value="dtext"    style= "background-image:url('Commandline icons/dtext.png');background-repeat:no-repeat; text-indent: 30px;"     data-display="true" data-highlight="false">	DTEXT(TEXT)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DDA(DIMDISASSOCIATE)" id="dda" 	  value="dda"           style= "background-image:url('Commandline icons/ddadimdisassociate.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	DDA(DIMDISASSOCIATE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DWGROUPS" id="dwgroups"        value="dwgroups"       style= "background-image:url('Commandline icons/dwgroups.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	DWGROUPS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DATALINKUPDATE" id="datalinkupdate"  value="datalinkupdate" style= "background-image:url('Commandline icons/datalinkupdate.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	DATALINKUPDATE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DDIM(DIMSTYLE)" id="ddim"            value="ddim"           style= "background-image:url('Commandline icons/ddimdimstyle.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	DDIM(DIMSTYLE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIMSPACE" id="dimspace"        value="dimspace"       style= "background-image:url('Commandline icons/dimspace.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	DIMSPACE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="D(DIMSTYLE)" id="d"        		 value="d"        		style= "background-image:url('Commandline icons/ddimstyle.png');background-repeat:no-repeat; text-indent: 30px;"      data-display="true" data-highlight="false">	D(DIMSTYLE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIMTED(DIMTEDIT)" id="dimted"  		 value="dimted"  		style= "background-image:url('Commandline icons/dimteddimtedit.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	DIMTED(DIMTEDIT)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DI(DIST)" id="di"		  		 value="di"		  		style= "background-image:url('Commandline icons/didist.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	DI(DIST)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DISTANTLIGHT" id="distantlight" 	 value="distantlight" 		style= "background-image:url('Commandline icons/distantlight.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	DISTANTLIGHT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIVIDE" id="divide" 		 value="divide" 			style= "background-image:url('Commandline icons/divide.png');background-repeat:no-repeat; text-indent: 30px;"   data-display="true" data-highlight="false">	DIVIDE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DO(DONUT)" id="do"     		 value="do"     		style= "background-image:url('Commandline icons/dodonut.png');background-repeat:no-repeat; text-indent: 30px;"   data-display="true" data-highlight="false">	DO(DONUT)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DDINSERT(INSERT)" id="ddinsert"  		 value="ddinsert"  		style= "background-image:url('Commandline icons/ddinsertinsert.png');background-repeat:no-repeat; text-indent: 30px;"     data-display="true" data-highlight="false">	DDINSERT(INSERT)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DDA(DIMDISASSOCIATE)" id="dda" 		 	 value="dda" 		 	style= "background-image:url('Commandline icons/ddadimdisassociate.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	DDA(DIMDISASSOCIATE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIMOVER(DIMOVERRIDE)" id="dimover" 	 	 value="dimover" 	 	style= "background-image:url('Commandline icons/dimoverdimoverride.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	DIMOVER(DIMOVERRIDE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIMRAD(DIMRADIUS)" id="dimrad" 	 	 value="dimrad" 	 	style= "background-image:url('Commandline icons/dimraddimradius.png');background-repeat:no-repeat; text-indent: 30px;"    data-display="true" data-highlight="false">	DIMRAD(DIMRADIUS)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DELAY" id="delay" 	 		 value="delay" 	 		style= "background-image:url('Commandline icons/delay.png');background-repeat:no-repeat; text-indent: 30px;"              data-display="true" data-highlight="false">	DELAY	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DELCON(DELCONSTRAINT)" id="delcon" 	 	 value="delcon" 	 	style= "background-image:url('Commandline icons/delcondelconstraint.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	DELCON(DELCONSTRAINT)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DETACHURL" id="detachurl"       value="detachurl"				style= "background-image:url('Commandline icons/detachurl.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	DETACHURL	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DRAGMODE" id="dragmode"        value="dragmode"  		 		style= "background-image:url('Commandline icons/dragmode.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	DRAGMODE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DRAWINGRECOVERY" id="drawingrecovery" value="drawingrecovery"	 	style= "background-image:url('Commandline icons/drawingrecovery.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	DRAWINGRECOVERY	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DRAWINGRECOVERYHIDE" id="drawingrecoveryhide" value="drawingrecoveryhide"	style= "background-image:url('Commandline icons/drawingrecoveryhide.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	DRAWINGRECOVERYHIDE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DR(DRAWORDER)" id="dr"              value="dr" 					style= "background-image:url('Commandline icons/drdraworder.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	DR(DRAWORDER)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DS(DSETTINGS)" id="ds"              value="ds"						 style= "background-image:url('Commandline icons/dsdsettings.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	DS(DSETTINGS)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DVIEW" id="dview"           value="dview"      			style= "background-image:url('Commandline icons/dview.png');background-repeat:no-repeat; text-indent: 30px;"     data-display="true" data-highlight="false">	DVIEW	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIMJOGGED" id="dimjogged"       value="dimjogged"  			style= "background-image:url('Commandline icons/dimjogged.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	DIMJOGGED	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIMJOGLINE" id="dimjogline"      value="dimjogline" 			style= "background-image:url('Commandline icons/dimjogline.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	DIMJOGLINE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIMLIN(DIMLINEAR)" id="dimlin"          value="dimlin" 				style= "background-image:url('Commandline icons/dimlindimlinear.png');background-repeat:no-repeat; text-indent: 30px;"    data-display="true" data-highlight="false">	DIMLIN(DIMLINEAR)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIMORD(DIMORDINATE)" id="dimord"          value="dimord"					style= "background-image:url('Commandline icons/dimorddimordinate.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	DIMORD(DIMORDINATE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DCALIGNED" id="dcaligned"       value="dcaligned"				style= "background-image:url('Commandline icons/dcaligned.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	DCALIGNED	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DCANGULAR" id="dcangular"       value="dcangular"  			style= "background-image:url('Commandline icons/dcangular.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	DCANGULAR	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DCCONVERT" id="dcconvert"       value="dcconvert"  			style= "background-image:url('Commandline icons/dcconvert.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	DCCONVERT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DCDIAMETER" id="dcdiameter"      value="dcdiameter" 			style= "background-image:url('Commandline icons/dcdiameter.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	DCDIAMETER	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DCDISPLAY" id="dcdisplay"       value="dcdisplay"  			style= "background-image:url('Commandline icons/dcdisplay.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	DCDISPLAY	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DATAEXTRACTION" id="dataextraction"  value="dataextraction" 	 style= "background-image:url('Commandline icons/dataextraction.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	DATAEXTRACTION	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DXFOUT" id="dxfout" 		 value="dxfout" 			 style= "background-image:url('Commandline icons/dxfout.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	DXFOUT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DATALINK" id="datalink" 		 value="datalink" 		 style= "background-image:url('Commandline icons/datalink.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	DATALINK	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DDATTEXT(ATTEXT)" id="ddattext" 		 value="ddattext" 		 style= "background-image:url('Commandline icons/ddattextattext.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	DDATTEXT(ATTEXT)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DCHORIZONTAL" id="dchorizontal"    value="dchorizontal" 	 style= "background-image:url('Commandline icons/dchorizontal.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	DCHORIZONTAL	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DCVERTICAL" id="dcvertical"      value="dcvertical" 		 style= "background-image:url('Commandline icons/dcvertical.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	DCVERTICAL	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DDEDIT(TEXTEDIT)" id="ddedit"     	 value="ddedit" 			 style= "background-image:url('Commandline icons/ddedittextedit.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	DDEDIT(TEXTEDIT)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DDPTYPE(PTYPE)" id="ddptype" 		 value="ddptype" 		 style= "background-image:url('Commandline icons/ddptypeptype.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	DDPTYPE(PTYPE)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DDVPOINT(VPOINT)" id="ddvpoint" 	     value="ddvpoint" 		 style= "background-image:url('Commandline icons/ddvpointvpoint.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	DDVPOINT(VPOINT)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIMREASSOCIATE" id="dimreassociate"  value="dimreassociate" 	 style= "background-image:url('Commandline icons/dimreassociate.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	DIMREASSOCIATE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DWGCONVERT" id="dwgconvert" 	 value="dwgconvert" 		 style= "background-image:url('Commandline icons/dwgconvert.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	DWGCONVERT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DWGPROPS" id="dwgprops" 	     value="dwgprops" 		 style= "background-image:url('Commandline icons/dwgprops.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	DWGPROPS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DXBIN" id="dxbin" 			 value="dxbin" 			 style= "background-image:url('Commandline icons/dxbin.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	DXBIN	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBLIST" id="dblist" 		 value="dblist" 			 style= "background-image:url('Commandline icons/dblist.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	DBLIST	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DWFOSNAP" id="dwfosnap" 		 value="dwfosnap" 		 style= "background-image:url('Commandline icons/dwfosnap.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	DWFOSNAP	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DWFCLIP" id="dwfclip" 	     value="dwfclip" 		 style= "background-image:url('Commandline icons/dwfclip.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	DWFCLIP	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DWFFORMAT" id="dwfformat" 	     value="dwfformat" 		 style= "background-image:url('Commandline icons/dwfformat.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	DWFFORMAT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DWFLAYERS" id="dwflayers" 	     value="dwflayers" 		 style= "background-image:url('Commandline icons/dwflayers.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	DWFLAYERS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DGNMAPPING" id="dgnmapping"	     value="dgnmapping"		 style= "background-image:url('Commandline icons/dgnmapping.png');background-repeat:no-repeat; text-indent: 30px;" 		 data-display="true" data-highlight="false">	DGNMAPPING	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIMALI(DIMALIGNED)(DAL)" id="dimali" 		 value="dimali" 			 style= "background-image:url('Commandline icons/daldimaligned.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	DIMALI(DIMALIGNED)(DAL)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DAN(DIMANGULAR)" id="dan" 		     value="dan" 			 style= "background-image:url('Commandline icons/dandimangular.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	DAN(DIMANGULAR)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DARC(DIMARC)" id="darc" 			 value="darc" 			 style= "background-image:url('Commandline icons/darcdimarc.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	DARC(DIMARC)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DWFADJUST" id="dwfadjust" 		 value="dwfadjust" 		 style= "background-image:url('Commandline icons/dwfadjust.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	DWFADJUST	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DGNADJUST" id="dgnadjust" 		  value="dgnadjust" 		 style= "background-image:url('Commandline icons/dgnadjust.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	DGNADJUST	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="(-DGNADJUST)" id="-dgnadjust" 	 value="-dgnadjust" 		 style= "background-image:url('Commandline icons/-dgnadjust.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	(-DGNADJUST)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIVMESHBOXHEIGHT" id="divmeshboxheight" value="divmeshboxheight" style= "background-image:url('Commandline icons/divmeshboxheight.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	DIVMESHBOXHEIGHT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DGNBIND(-DGNBIND)" id="dgnbind" 		  value="dgnbind" 		 style= "background-image:url('Commandline icons/dgnbind.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	DGNBIND(-DGNBIND)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DGNATTACH" id="dgnattach" 		  value="dgnattach" 		 style= "background-image:url('Commandline icons/dgnattach.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	DGNATTACH	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DGNCLIP" id="dgnclip" 		  value="dgnclip" 		 style= "background-image:url('Commandline icons/dgnclip.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	DGNCLIP	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DGNLAYERS" id="dgnlayers" 		  value="dgnlayers" 		 style= "background-image:url('Commandline icons/dgnlayers.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	DGNLAYERS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBCCONFIGURE" id="dbcconfigure" 	  value="dbcconfigure" 	 style= "background-image:url('Commandline icons/dbcconfigure.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	DBCCONFIGURE	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DOWNLOADMANAGER" id="downloadmanager"  value="downloadmanager"  style= "background-image:url('Commandline icons/downloadmanager.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	DOWNLOADMANAGER	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DWFATTACH" id="dwfattach" 		  value="dwfattach" 		 style= "background-image:url('Commandline icons/dwfattach.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	DWFATTACH	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIMADEC" id="dimadec" 		  value="dimadec" 		 style= "background-image:url('Commandline icons/dimadec.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	DIMADEC	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIMHORIZONTAL" id="dimhorizontal" 	  value="dimhorizontal" 	 style= "background-image:url('Commandline icons/dimhorizontal.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	DIMHORIZONTAL	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIMVERTICAL" id="dimvertical" 	  value="dimvertical" 	 style= "background-image:url('Commandline icons/dimvertical.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	DIMVERTICAL	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DGNIMPORT" id="dgn_import" 		  value="dgn_import" 		 style= "background-image:url('Commandline icons/dgnimport.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	DGNIMPORT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DATABASE(DBCONNECT)" id="dbconnect" 			value="dbconnect" 			 style= "background-image:url('Commandline icons/databasedbconnect.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	DATABASE(DBCONNECT)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DDPLOTSTAMP(PLOTSTAMP)" id="plotstamp" 		value="plotstamp" 		 style= "background-image:url('Commandline icons/ddplotstampplotstamp.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	DDPLOTSTAMP(PLOTSTAMP)	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBCCONNECT" id="dbconnect" 		value="dbconnect" 			 style= "background-image:url('Commandline icons/dbcconnect.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	DBCCONNECT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBCDELETELABELS" id="dbcdeletelabels" 	value="dbcdeletelabels" 	 style= "background-image:url('Commandline icons/dbcdeletelables.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	DBCDELETELABELS	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBCDELETELINK" id="dbcdeletelink" 		value="dbcdeletelink" 		 style= "background-image:url('Commandline icons/dbcdeletelink.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	DBCDELETELINK	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBEDELETELLT" id="dbedeletellt" 		value="dbedeletellt" 		 style= "background-image:url('Commandline icons/dbedeletellt.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	DBEDELETELLT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="#DBEDELETELT" id="dbedeletelt" 		value="dbedeletelt" 		 style= "background-image:url('Commandline icons/dbedeletelt.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	DBEDELETELT	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBEDELETEQRY" id="dbedeleteqry" 		value="dbedeleteqry" 		 style= "background-image:url('Commandline icons/dbedeleteqry.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	DBEDELETEQRY	</li>
                      <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBCEDISCONNECT" id="dbcedisconnect" 	value="dbcedisconnect" 		 style= "background-image:url('Commandline icons/dbcedisconnect.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	DBCEDISCONNECT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBCEDITLINKEDTABLE" id="dbceditlinkedtable" value="dbceditlinkedtable" 	 style= "background-image:url('Commandline icons/dbceditlinkedtable.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	DBCEDITLINKEDTABLE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBCEDITLLT" id="dbceditllt" 		value="dbceditllt" 			 style= "background-image:url('Commandline icons/dbceditllt.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	DBCEDITLLT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBCEDITQRY" id="dbceditqry" 		value="dbceditqry" 			 style= "background-image:url('Commandline icons/dbceditqry.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	DBCEDITQRY	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBCEDITLT" id="dbceditlt" 			value="dbceditlt" 			 style= "background-image:url('Commandline icons/dbceditlt.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	DBCEDITLT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBEEXECUTEQRY" id="dbeexecuteqry" 		value="dbeexecuteqry" 		 style= "background-image:url('Commandline icons/dbeexecuteqry.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	DBEEXECUTEQRY	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBCEXPORTLINKS" id="dbcexportlinks" 	value="dbcexportlinks" 		 style= "background-image:url('Commandline icons/dbcexportlinks.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	DBCEXPORTLINKS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBCEXPORTQRY" id="dbcexportqry" 		value="dbcexportqry" 		 style= "background-image:url('Commandline icons/dbcexportqry.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	DBCEXPORTQRY	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DBCEXPORTQS" id="dbcexportqs"		value="dbcexportqs"			 style= "background-image:url('Commandline icons/dbcexportqs.png');background-repeat:no-repeat; text-indent: 30px;" 			 data-display="true" data-highlight="false">	DBCEXPORTQS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DGNEXPORT" id="dgnexport" 			value="dgnexport" 			 style= "background-image:url('Commandline icons/dgnexport.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	DGNEXPORT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DDSTYLE" id="ddstyle" 			value="ddstyle" 			 style= "background-image:url('Commandline icons/ddstyle.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	DDSTYLE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIMREGEN" id="dimregen" 			value="dimregen" 			 style= "background-image:url('Commandline icons/dimregen.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	DIMREGEN	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIMROTATED" id="dimrotated" 		value="dimrotated" 			 style= "background-image:url('Commandline icons/dimrotated.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	DIMROTATED	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DRAWINGRECOVERYHDE" id="drawingrecoveryhide" value="drawingrecoveryhide" 	 style= "background-image:url('Commandline icons/drawingrecoveryhde.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	DRAWINGRECOVERYHDE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DEL" id="del" 				value="del" 				 style= "background-image:url('Commandline icons/del.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	DEL	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DESIGNFEEDCLOSE" id="designfeedclose" 	value="designfeedclose" 	 style= "background-image:url('Commandline icons/designfeedclose.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	DESIGNFEEDCLOSE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DESIGNFEEDOPEN" id="designfeedopen" 	value="designfeedopen" 		 style= "background-image:url('Commandline icons/designfeedopen.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	DESIGNFEEDOPEN	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DESIGNFEEDSTATE" id="designfeedstate" 	value="designfeedstate" 	 style= "background-image:url('Commandline icons/designfeedstate.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	DESIGNFEEDSTATE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DESKOPANALYTICS" id="desktopanalytics" 	value="desktopanalytics" 	 style= "background-image:url('Commandline icons/deskopanalytics.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	DESKOPANALYTICS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DGNMAPPINGPATH" id="dgnmappingpath" 	value="dgnmappingpath" 		 style= "background-image:url('Commandline icons/dgnmappingpath.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	DGNMAPPINGPATH	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIMEX" id="dimstyle_export" 				value="dimstyle_export" 				 style= "background-image:url('Commandline icons/dimex.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	DIMEX	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIMIM" id="dimstyle_import" 				value="dimstyle_import" 				 style= "background-image:url('Commandline icons/dimim.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	DIMIM	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIMPICKBOX" id="dimpickbox" 		value="dimpickbox" 			 style= "background-image:url('Commandline icons/dimpickbox.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	DIMPICKBOX	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIMREASSOC" id="reset_dim_text_value"			value="reset_dim_text_value"			 style= "background-image:url('Commandline icons/dimreassoc.png');background-repeat:no-repeat; text-indent: 30px;" 				 data-display="true" data-highlight="false">	DIMREASSOC	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DIR" id="dir" 				value="dir" 				 style= "background-image:url('Commandline icons/dir.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	DIR	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DISPLAYMANAGERCONFIGSSELECTION" id="displaymanagerconfigsselection"  value="displaymanagerconfigsselection" 	 style= "background-image:url('Commandline icons/displaymanagerconfigsselection.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	DISPLAYMANAGERCONFIGSSELECTION	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="DRAFTANGUANALYSIS (ANALYSISDRAFT)" id="draftangleanalysis" 				 value="draftangleanalysis" 				 style= "background-image:url('Commandline icons/draftanguanalysisanalysisdraft.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	DRAFTANGUANALYSIS (ANALYSISDRAFT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="E (ERASE)" id="deleteerase" 		  value="deleteerase" 		 style= "background-image:url('Commandline icons/eerase.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	E (ERASE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EATTEDIT" id="attedit" value="attedit" style= "background-image:url('Commandline icons/eattedit.png');background-repeat:no-repeat; text-indent: 30px;" 	 	data-display="true" data-highlight="false">	EATTEDIT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EATTEXT" id="eattext"  value="eattext"  style= "background-image:url('Commandline icons/eattext.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	EATTEXT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ED(TEXTEDIT)" id="ddedittextedit" 	 value="ddedittexteditED" 		 style= "background-image:url('Commandline icons/edtextedit.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	ED(TEXTEDIT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EDGE" id="edge" 	  value="edge" 	 style= "background-image:url('Commandline icons/edge.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	EDGE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EDGESURF" id="modelling_meshes_edge_surface" value="modelling_meshes_edge_surface" style= "background-image:url('Commandline icons/edgesurf.png');background-repeat:no-repeat; text-indent: 30px;" 	 	data-display="true" data-highlight="false">	EDGESURF	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EDITPOLYLINE" id="edit_polyline"   	value="edit_polyline"   		 style= "background-image:url('Commandline icons/editpolylinepedit.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	EDITPOLYLINE (PEDIT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EDITSHOT" id="editshot" 			value="editshot" 			 style= "background-image:url('Commandline icons/editshot.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	EDITSHOT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EDITTABLECELL" id="edittablecell" 		value="edittablecell" 		 style= "background-image:url('Commandline icons/edittablecell.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	EDITTABLECELL	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EDITTIME" id="edittime" 			value="edittime" 			 style= "background-image:url('Commandline icons/edittime.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	EDITTIME	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EDWF (EXPORTDWF)" id="dwf" 				value="dwf" 				 style= "background-image:url('Commandline icons/edwfexportdwf.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	EDWF (EXPORTDWF)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EDWFX (EXPORTDWFX)" id="dwfx" 				value="dwfx" 				 style= "background-image:url('Commandline icons/edwfxexportdwfx.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	EDWFX (EXPORTDWFX)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EL (ELLIPSE)" id="elellipse" 				value="elellipse" 					 style= "background-image:url('Commandline icons/elellipse.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	EL (ELLIPSE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ELEV" id="elev" 				value="elev" 				 style= "background-image:url('Commandline icons/elev.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	ELEV	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="END" id="end" 				value="end" 				 style= "background-image:url('Commandline icons/end.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	END	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ENDREP" id="endrep" 			value="endrep" 				 style= "background-image:url('Commandline icons/endrep.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	ENDREP	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ENDSV" id="endsv"				value="endsv"				 style= "background-image:url('Commandline icons/endsv.png');background-repeat:no-repeat; text-indent: 30px;" 					 data-display="true" data-highlight="false">	ENDSV	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ENVIRONMENT (WORKSPACE)" id="environmentworkspace" 		value="environmentworkspace" 		 style= "background-image:url('Commandline icons/environmentworkspace.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	ENVIRONMENT (WORKSPACE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EPDF (EXPORTPDF)" id="epdfexportpdf" 				value="epdfexportpdf" 				 style= "background-image:url('Commandline icons/epdfexportpdf.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	EPDF (EXPORTPDF)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EPLOTEXT" id="eplotext" 			value="eplotext" 			 style= "background-image:url('Commandline icons/eplotext.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	EPLOTEXT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ER(EXTERNALREFERENCES)" id="erexternalreferences" 				value="erexternalreferences" 					 style= "background-image:url('Commandline icons/erexternalreferences.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	ER(EXTERNALREFERENCES)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ESW_VLATTACH" id="esw_vlattach" 		value="esw_vlattach" 		 style= "background-image:url('Commandline icons/esw_vlattach.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	ESW_VLATTACH	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ETBUG" id="etbug" 				value="etbug" 				 style= "background-image:url('Commandline icons/etbug.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	ETBUG	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ETRANSMIT" id="etransmit" 			value="etransmit" 			 style= "background-image:url('Commandline icons/etransmit.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	ETRANSMIT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EX (EXTEND)	" id="exextend" 				value="exextend" 					 style= "background-image:url('Commandline icons/exextend.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	EX (EXTEND)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EXACRELOAD" id="exacreload" 		value="exacreload" 			 style= "background-image:url('Commandline icons/exacreload.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	EXACRELOAD	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EXCHANGE (APPSTORE)" id="exchangeappstore" 			value="exchangeappstore" 			 style= "background-image:url('Commandline icons/exchangeappstore.png');background-repeat:no-repeat; text-indent: 30px;"	 	data-display="true" data-highlight="false">	EXCHANGE (APPSTORE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EXIT (QUIT)" id="exitquit" 				value="exitquit" 				 style= "background-image:url('Commandline icons/exitquit.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	EXIT (QUIT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EXOFFSET" id="extended_offset" 			value="extended_offset" 			 style= "background-image:url('Commandline icons/exoffset.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	EXOFFSET	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EXP (EXPORT)" id="expexport" 				value="expexport" 				 style= "background-image:url('Commandline icons/expexport.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	EXP (EXPORT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EXPLAN" id="explan" 			value="explan" 				 style= "background-image:url('Commandline icons/explan.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	EXPLAN	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EXPLODE" id="explode" 			value="explode" 			 style= "background-image:url('Commandline icons/explode.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	EXPLODE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EXPLORER" id="explorer" 			value="explorer" 			 style= "background-image:url('Commandline icons/explorer.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	EXPLORER	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EXPORTLAYOUT" id="exportlayout" 		value="exportlayout" 		 style= "background-image:url('Commandline icons/exportlayout.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	EXPORTLAYOUT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EXPORTSETTINGS" id="exportsettings" 	value="exportsettings" 		 style= "background-image:url('Commandline icons/exportsettings.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	EXPORTSETTINGS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EXPRESSIONS (QUICKCALC)" id="expressionsquickcalc" 		value="expressionsquickcalc" 		 style= "background-image:url('Commandline icons/expressionsquickcalc.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	EXPRESSIONS (QUICKCALC)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EXPRESSMENU" id="expressmenu" 		value="expressmenu" 		 style= "background-image:url('Commandline icons/expressmenu.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	EXPRESSMENU	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EXPRESSTOOLS" id="expresstools" 		value="expresstools" 		 style= "background-image:url('Commandline icons/expresstools.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	EXPRESSTOOLS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EXT (EXTRUDE)" id="extextrude" 				value="extextrude" 				 style= "background-image:url('Commandline icons/extextrude.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	EXT (EXTRUDE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EXTENDSRF (SURFEXTEND)" id="extendsrfsurfextend" 			value="extendsrfsurfextend" 			 style= "background-image:url('Commandline icons/extendsrfsurfextend.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	EXTENDSRF (SURFEXTEND)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EXTERNALREFERENCES" id="external_references" value="external_references"  style= "background-image:url('Commandline icons/externalreferences.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	EXTERNALREFERENCES	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EXTERNALREFERENCESCLOSE" id="externalreferencesclose" value="externalreferencesclose"  style= "background-image:url('Commandline icons/externalreferencesclose.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	EXTERNALREFERENCESCLOSE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="EXTRIM" id="extrim" 				 value="extrim" 					 style= "background-image:url('Commandline icons/extrim.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	EXTRIM	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="F(FILLET)" id="ffillet" 						 value="ffillet" 						 style= "background-image:url('Commandline icons/ffillet.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	F(FILLET)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="FACETS(ISOLINE)" id="facetsisoline" 				 value="facetsisoline" 					 style= "background-image:url('Commandline icons/facetsisoline.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	FACETS(ISOLINE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="FASTSEL" id="fastsel" 				 value="fastsel" 				 style= "background-image:url('Commandline icons/fastsel.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	FASTSEL	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="FBXEXPORT" id="fbxexport" 				 value="fbxexport" 				 style= "background-image:url('Commandline icons/fbxexport.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	FBXEXPORT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="FBXIMPORT" id="fbximport" 				 value="fbximport" 				 style= "background-image:url('Commandline icons/fbximport.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	FBXIMPORT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="FBXIMPORTLOG" id="fbximportlog" 			 value="fbximportlog" 			 style= "background-image:url('Commandline icons/fbximportlog.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	FBXIMPORTLOG	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="FI(FILTER)" id="fifilter" 					 value="fifilter" 						 style= "background-image:url('Commandline icons/fifilter.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	FI(FILTER)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="FIELD" id="field" 					 value="field" 					 style= "background-image:url('Commandline icons/field.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	FIELD	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="FILEOPEN" id="fileopen" 				 value="fileopen" 				 style= "background-image:url('Commandline icons/fileopen.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	FILEOPEN	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="FILES" id="files" 					 value="files" 					 style= "background-image:url('Commandline icons/files.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	FILES	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="FILETAB" id="filetab" 				 value="filetab" 				 style= "background-image:url('Commandline icons/filetab.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	FILETAB	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="FILETABCLOSE" id="filetabclose" 			 value="filetabclose" 			 style= "background-image:url('Commandline icons/filetabclose.png');background-repeat:no-repeat; text-indent: 30px;"		 		data-display="true" data-highlight="false">	FILETABCLOSE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="FILL" id="fill" 					 value="fill" 					 style= "background-image:url('Commandline icons/fill.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	FILL	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="FILLETEDGE" id="filletedge" 			 value="filletedge" 				 style= "background-image:url('Commandline icons/filletedge.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	FILLETEDGE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="FILLETSRF(SURFFILLET)" id="filletsrfsurffillet" 				 value="filletsrfsurffillet" 				 style= "background-image:url('Commandline icons/filletsrfsurffillet.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	FILLETSRF(SURFFILLET)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="FIND" id="find" 					 value="find" 					 style= "background-image:url('Commandline icons/find.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	FIND	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="FINISH(MATERIALS)" id="finishmaterials" 				 value="finishmaterials" 					 style= "background-image:url('Commandline icons/finishmaterials.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	FINISH(MATERIALS)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="FLATSHOT" id="flatshot" 				 value="flatshot" 				 style= "background-image:url('Commandline icons/flatshot.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	FLATSHOT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="FOG(RENDERENVIRONMENT)" id="fogrenderenvironment" 					 value="fogrenderenvironment" 					 style= "background-image:url('Commandline icons/fogrenderenvironment.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	FOG(RENDERENVIRONMENT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="FRAME" id="frame" 					 value="frame" 					 style= "background-image:url('Commandline icons/frame.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	FRAME	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="FREEPOINT(POINTLIGHT)" id="freepointpointlight" 				 value="freepointpointlight" 				 style= "background-image:url('Commandline icons/freepointpointlight.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	FREEPOINT(POINTLIGHT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="FREESPOT" id="freespot"				 value="freespot"				 style= "background-image:url('Commandline icons/freespot.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	FREESPOT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="FREEWEB" id="freeweb" 				 value="freeweb" 				 style= "background-image:url('Commandline icons/freeweb.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	FREEWEB	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="G(GROUP)" id="ggroup" 						 value="ggroup" 						 style= "background-image:url('Commandline icons/ggroup.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	G(GROUP)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GCTANGENT" id="gctangent" 				 value="gctangent" 				 style= "background-image:url('Commandline icons/gctangent.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	GCTANGENT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GATTE" id="gatte" 					 value="gatte" 					 style= "background-image:url('Commandline icons/gatte.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	GATTE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GCCOINCIDENT" id="gccoincident" 			 value="gccoincident" 			 style= "background-image:url('Commandline icons/gccoincident.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	GCCOINCIDENT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GCCOLLINEAR" id="gccollinear" 			 value="gccollinear" 			 style= "background-image:url('Commandline icons/gccollinear.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	GCCOLLINEAR	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GCCONCENTRIC" id="gcconcentric" 			 value="gcconcentric" 			 style= "background-image:url('Commandline icons/gcconcentric.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	GCCONCENTRIC	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GCEQUAL" id="gcequal" 				 value="gcequal" 				 style= "background-image:url('Commandline icons/gcequal.png');background-repeat:no-repeat; text-indent: 30px;"	 					data-display="true" data-highlight="false">	GCEQUAL	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GCFIX" id="gcfix" 					 value="gcfix" 					 style= "background-image:url('Commandline icons/gcfix.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	GCFIX	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GCHORIZONTAL" id="gchorizontal" 			 value="gchorizontal" 			 style= "background-image:url('Commandline icons/gchorizontal.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	GCHORIZONTAL	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GCON(GEOMCONSTRAINT)" id="gcongeomconstraint" 					 value="gcongeomconstraint" 					 style= "background-image:url('Commandline icons/gcongeomconstraint.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	GCON(GEOMCONSTRAINT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GCPARALLEL" id="gcparallel" 			 value="gcparallel" 				 style= "background-image:url('Commandline icons/gcparallel.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	GCPARALLEL	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GCPERPENDICULAR" id="gcperpendicular" 		 value="gcperpendicular" 		 style= "background-image:url('Commandline icons/gcperpendicular.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	GCPERPENDICULAR	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GCSMOOTH" id="gcsmooth" 	value="gcsmooth" 	 style= "background-image:url('Commandline icons/gcsmooth.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	GCSMOOTH	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GCSYMMETRIC" id="gcsymmetric"value="gcsymmetric"  style= "background-image:url('Commandline icons/gcsymmetric.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	GCSYMMETRIC	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GCTANGENT" id="gctangent" 	value="gctangent" 	 style= "background-image:url('Commandline icons/gctangent.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	GCTANGENT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GCVERTICAL" id="gcvertical"	value="gcvertical"	 style= "background-image:url('Commandline icons/gcvertical.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	GCVERTICAL	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GD(GRADIENT)" id="gdgradient" 		value="gdgradient" 			 style= "background-image:url('Commandline icons/gdgradient.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	GD(GRADIENT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'" name="GENERATESECTION(SECTIONPLANETOBLOCK)" id="generatesection" 		 value="generatesection" 		style= "background-image:url('Commandline icons/generatesectionsectionplanetoblock.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	GENERATESECTION(SECTIONPLANETOBLOCK)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'" name="GEO(GEOGRAPHICLOCATION)" id="geogeographiclocation" 					 value="geogeographiclocation" 					style= "background-image:url('Commandline icons/geogeographiclocation.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	GEO(GEOGRAPHICLOCATION)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'" name="GEOMAP" id="geomap" 					 value="geomap" 					style= "background-image:url('Commandline icons/geomap.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">	GEOMAP	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'" name="GEOMAPIMAGE" id="geomapimage" 			 value="geomapimage" 			style= "background-image:url('Commandline icons/geomapimage.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	GEOMAPIMAGE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'" name="GEOMAPIMAGEUPDATE" id="geomapimageupdate" 		 value="geomapimageupdate" 		style= "background-image:url('Commandline icons/geomapimageupdate.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	GEOMAPIMAGEUPDATE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'" name="GEOMARKLATLONG" id="geomarklatlong" 			 value="geomarklatlong" 			style= "background-image:url('Commandline icons/geomarklatlong.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	GEOMARKLATLONG	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'" name="GEOMARKPOINT" id="geomarkpoint" 			 value="geomarkpoint" 			style= "background-image:url('Commandline icons/geomarkpoint.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	GEOMARKPOINT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'" name="GEOREMOVE" id="georemove"				 value="georemove"				style= "background-image:url('Commandline icons/georemove.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">	GEOREMOVE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GEOREORIENTMARKER" id="georeorientmarker" 		 value="georeorientmarker" 		style= "background-image:url('Commandline icons/georeorientmarker.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	GEOREORIENTMARKER	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GIFIN" id="gifin" 					 value="gifin" 					style= "background-image:url('Commandline icons/gifin.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">	GIFIN		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GOTOSTART" id="gotostart" 				 value="gotostart" 				style= "background-image:url('Commandline icons/gotostart.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">		GOTOSTART	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GOTOURL" id="gotourl" 				 value="gotourl" 				style= "background-image:url('Commandline icons/gotourl.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">		GOTOURL		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GR(DDGRIPS)		" id="grddgrips" 						 value="grddgrips" 						style= "background-image:url('Commandline icons/grddgrips.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">	GR(DDGRIPS)		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GRAPHICSCONFIG	" id="graphicsconfig" 			 value="graphicsconfig" 			style= "background-image:url('Commandline icons/graphicsconfig.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">				GRAPHICSCONFIG	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GRAPHSCR		" id="graphscr" 				 value="graphscr" 				style= "background-image:url('Commandline icons/graphscr.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">					GRAPHSCR		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GRID			" id="grid" 					 value="grid" 					style= "background-image:url('Commandline icons/grid.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">					GRID				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GROUPDISPLAYMODE" id="groupdisplaymode" 		 value="groupdisplaymode" 		style= "background-image:url('Commandline icons/groupdisplaymode.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">					GROUPDISPLAYMODE		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GROUPEDIT		" id="groupedit" 				 value="groupedit" 				style= "background-image:url('Commandline icons/groupedit.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">					GROUPEDIT			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GSDEBUG			" id="gsdebug" 				 value="gsdebug" 				style= "background-image:url('Commandline icons/gsdebug.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">					GSDEBUG				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="GUIDELINE(RAY)		" id="guidelineray" 				 value="guidelineray" 				style= "background-image:url('Commandline icons/guidelineray.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	    GUIDELINE(RAY)			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="H (HATCH)			" id="hhatch" 						 value="hhatch" 						style= "background-image:url('Commandline icons/hhatch.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">	H (HATCH)				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="HATCHEDIT			" id="hatchedit" 				 value="hatchedit" 				style= "background-image:url('Commandline icons/hatchedit.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">				HATCHEDIT				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="HATCHGENERATEBOUNDARY" id="hatchgenerateboundary" 	 value="hatchgenerateboundary" 	style= "background-image:url('Commandline icons/hatchgenerateboundary.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">				HATCHGENERATEBOUNDARY	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="HATCHSETBOUNDARY" id="hatchsetboundary" 		 value="hatchsetboundary" 		style= "background-image:url('Commandline icons/hatchsetboundary.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">		HATCHSETBOUNDARY	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="HATCHSETORIGIN	" id="hatchsetorigin" 			 value="hatchsetorigin" 			style= "background-image:url('Commandline icons/hatchsetorigin.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	HATCHSETORIGIN	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="HATCHTOBACK		" id="hatchtoback" 			 value="hatchtoback" 			style= "background-image:url('Commandline icons/hatchtoback.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">		HATCHTOBACK		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="HELIX			" id="helix" 					 value="helix" 					style= "background-image:url('Commandline icons/helix.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">		HELIX			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="HELP			" id="help" 					 value="help" 					style= "background-image:url('Commandline icons/help.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">		HELP			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="HI (HIDE)		" id="hihide" 						 value="hihide" 						style= "background-image:url('Commandline icons/hihide.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">	HI (HIDE)					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="HIDEOBJECTS		" id="hideobjects" 			 value="hideobjects" 			style= "background-image:url('Commandline icons/hideobjects.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">				HIDEOBJECTS					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="HIDEPALETTES	" id="hidepalettes" 			 value="hidepalettes" 			style= "background-image:url('Commandline icons/hidepalettes.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">				HIDEPALETTES				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="HIGHLIGHTNEW	" id="highlightnew" 			 value="highlightnew" 			style= "background-image:url('Commandline icons/highlightnew.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">				HIGHLIGHTNEW				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="HLSETTINGS		" id="hlsettings" 				 value="hlsettings" 				style= "background-image:url('Commandline icons/hlsettings.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">			HLSETTINGS						</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="HYPERLINK		" id="hyperlink" 				 value="hyperlink" 				style= "background-image:url('Commandline icons/hyperlink.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">				HYPERLINK					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="HYPERLINKBACK	" id="hyperlinkback" 			 value="hyperlinkback" 			style= "background-image:url('Commandline icons/hyperlinkback.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">				HYPERLINKBACK				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="HYPERLINKFWD	" id="hyperlinkfwd" 			 value="hyperlinkfwd" 			style= "background-image:url('Commandline icons/hyperlinkfwd.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">				HYPERLINKFWD				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="HYPERLINKOPEN	" id="hyperlinkopen" 			 value="hyperlinkopen" 			style= "background-image:url('Commandline icons/hyperlinkopen.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">				HYPERLINKOPEN				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="HYPERLINKOPTIONS" id="hyperlinkoptions" 		 value="hyperlinkoptions" 		style= "background-image:url('Commandline icons/hyperlinkoptions.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">				HYPERLINKOPTIONS			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="HYPERLINKSTOP	" id="hyperlinkstop" 			 value="hyperlinkstop" 			style= "background-image:url('Commandline icons/hyperlinkstop.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">				HYPERLINKSTOP				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="IAD (IMAGEADJUST)" id="iadimageadjust" 					 value="iadimageadjust" 					style= "background-image:url('Commandline icons/iadimageadjust.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	IAD (IMAGEADJUST)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="IAT (IMAGEATTACH)" id="iatimageattach" 					 value="iatimageattach" 					style= "background-image:url('Commandline icons/iatimageattach.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	IAT (IMAGEATTACH)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ICL (IMAGECLIP)" id="iclimageclip" 					 value="iclimageclip" 					style= "background-image:url('Commandline icons/iclimageclip.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	ICL (IMAGECLIP)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ID			" id="id" 						 value="id" 						style= "background-image:url('Commandline icons/id.png');background-repeat:no-repeat; text-indent: 30px;" 									data-display="true" data-highlight="false">	ID			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="IGESEXPORT" id="igesexport" 				 value="igesexport" 				style= "background-image:url('Commandline icons/igesexport.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">	IGESEXPORT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="IGESIMPORT" id="igesimport" 				 value="igesimport" 				style= "background-image:url('Commandline icons/igesimport.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">	IGESIMPORT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="IM (IMAGE)" id="imimage" 						 value="imimage" 						style= "background-image:url('Commandline icons/imimage.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">	IM (IMAGE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="IMAGEAPP	" id="imageapp" 				 value="imageapp" 				style= "background-image:url('Commandline icons/imageapp.png');background-repeat:no-repeat; text-indent: 30px;"		 						data-display="true" data-highlight="false">		IMAGEAPP		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="IMAGEEDIT	" id="imageedit" 				 value="imageedit" 				style= "background-image:url('Commandline icons/imageedit.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">		IMAGEEDIT		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="IMAGEFRAME	" id="imageframe" 				 value="imageframe" 				style= "background-image:url('Commandline icons/imageframe.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">	IMAGEFRAME		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="IMAGEOVERLAP" id="imageoverlap" 			 value="imageoverlap" 			style= "background-image:url('Commandline icons/imageoverlap.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">		IMAGEOVERLAP	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="IMAGEQUALITY" id="imagequality" 			 value="imagequality" 			style= "background-image:url('Commandline icons/imagequality.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">		IMAGEQUALITY	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="IMP (IMPORT)" id="impimport" 					 value="impimport" 					style= "background-image:url('Commandline icons/impimport.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">	IMP (IMPORT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="IMPRINT		" id="imprint" 				 value="imprint" 				style= "background-image:url('Commandline icons/imprint.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">			IMPRINT			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="IN(INTERSECT)				" id="inintersect" 						 value="inintersect" 						style= "background-image:url('Commandline icons/inintersect.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">	IN(INTERSECT)				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="INF (INTERFERE)				" id="infinterfere" 					 value="infinterfere" 					style= "background-image:url('Commandline icons/infinterfere.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">			INF (INTERFERE)				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="INPUTSEARCHOPTIONS			" id="inputsearchoptions" 		 value="inputsearchoptions" 		style= "background-image:url('Commandline icons/inputsearchoptions.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">						INPUTSEARCHOPTIONS			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="INSERT						" id="insert" 					 value="insert" 					style= "background-image:url('Commandline icons/insert.png');background-repeat:no-repeat; text-indent: 30px;"	 							data-display="true" data-highlight="false">						INSERT						</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="INSERTCONTROLPOINT (CVADD)	" id="insertcontrolpointcvadd" 		 value="insertcontrolpointcvadd" 		style= "background-image:url('Commandline icons/insertcontrolpointcvadd.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">			INSERTCONTROLPOINT (CVADD)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="INSERTOBJ					" id="insertobj" 				 value="insertobj" 				style= "background-image:url('Commandline icons/insertobj.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">							INSERTOBJ					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ISODRAFT					" id="isodraft" 				 value="isodraft" 				style= "background-image:url('Commandline icons/isodraft.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">							ISODRAFT					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ISOLATE (ISOLATEOBJECTS)	" id="isolateisolateobjects" 				 value="isolateisolateobjects" 				style= "background-image:url('Commandline icons/isolateisolateobjects.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	ISOLATE (ISOLATEOBJECTS)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ISOLINES					" id="isolines" 				 value="isolines" 				style= "background-image:url('Commandline icons/isolines.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">							ISOLINES					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ISOMETRICVIEW(3DORBIT)		" id="isometricview3dorbit" 			 value="isometricview3dorbit" 			style= "background-image:url('Commandline icons/isometricview3dorbit.png');background-repeat:no-repeat; text-indent: 30px;"	 				data-display="true" data-highlight="false">			ISOMETRICVIEW(3DORBIT)		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ISOPLANE					" id="isoplane" 				 value="isoplane" 				style= "background-image:url('Commandline icons/isoplane.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">							ISOPLANE					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="J(JOIN)						" id="jjoin" 						 value="jjoin" 						style= "background-image:url('Commandline icons/jjoin.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">					J(JOIN)						</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="JOG (DIMJOGGED)				" id="jogdimjogged" 					 value="jogdimjogged" 					style= "background-image:url('Commandline icons/jogdimjogged.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">			JOG (DIMJOGGED)				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="JOGSECTION (SECTIONPLANEJOG)" id="jogsectionsectionplanejog" 				 value="jogsectionsectionplanejog" 				style= "background-image:url('Commandline icons/jogsectionsectionplanejog.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	JOGSECTION (SECTIONPLANEJOG)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="JPGOUT			" id="jpgout" 					 value="jpgout" 					style= "background-image:url('Commandline icons/jpgout.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">			JPGOUT			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="JUSTIFYTEXT		" id="justifytext"				 value="justifytext"				style= "background-image:url('Commandline icons/justifytext.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">			JUSTIFYTEXT		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="KNURL (HATCH)	" id="knurlhatch" 					 value="knurlhatch" 					style= "background-image:url('Commandline icons/knurlhatch.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">	KNURL (HATCH)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="L(LINE)			" id="lline" 						 value="line" 						style= "background-image:url('Commandline icons/lline.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">		L(LINE)			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LA(LAYER)		" id="lalayer" 						 value="lalayer" 						style= "background-image:url('Commandline icons/lalayer.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">	LA(LAYER)		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LABEL (MLEADER)" id="labelmleader" 					 value="labelmleader" 					style= "background-image:url('Commandline icons/labelmleader.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	LABEL (MLEADER)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAS(LAYERSTATE)" id="laslayerstate" 					 value="lalayer" 					style= "background-image:url('Commandline icons/laslayerstate.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">		LAS(LAYERSTATE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYCUR			" id="laycur" 					 value="laycur" 					style= "background-image:url('Commandline icons/laycur.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">	LAYCUR			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYDEL			" id="laydel" 					 value="laydel" 					style= "background-image:url('Commandline icons/laydel.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">	LAYDEL			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYERCLOSE		" id="layerclose" 				 value="layerclose" 				style= "background-image:url('Commandline icons/layerclose.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">	LAYERCLOSE		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYERP			" id="layerp" 					 value="layerp" 					style= "background-image:url('Commandline icons/layerp.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">	LAYERP			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYERPALETTE	" id="layerpalette" 			 value="layerpalette" 			style= "background-image:url('Commandline icons/layerpalette.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">		LAYERPALETTE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYERPMODE		" id="layerpmode" 				 value="layerpmode" 				style= "background-image:url('Commandline icons/layerpmode.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">	LAYERPMODE		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYERSTATESAVE	" id="layerstatesave" 			 value="layerstatesave" 			style= "background-image:url('Commandline icons/layerstatesave.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	LAYERSTATESAVE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYFRZ			" id="freeze" 					 value="freeze" 					style= "background-image:url('Commandline icons/layfrz.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">	LAYFRZ			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYISO			" id="isolate" 					 value="isolate" 					style= "background-image:url('Commandline icons/layiso.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">			LAYISO			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYLCK			" id="lock" 					 value="lock" 					style= "background-image:url('Commandline icons/laylck.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">					LAYLCK			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYLOCKFADECTL	" id="locked_layer_fading" 			 value="locked_layer_fading" 			style= "background-image:url('Commandline icons/laylockfadectl.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	LAYLOCKFADECTL	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYMCH			" id="match_layer" 					 value="match_layer" 					style= "background-image:url('Commandline icons/laymch.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">	LAYMCH			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYMCUR			" id="make_current" 				 value="make_current" 				style= "background-image:url('Commandline icons/laymcur.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">			LAYMCUR			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYMRG			" id="merge" 					 value="merge" 					style= "background-image:url('Commandline icons/laymrg.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">					LAYMRG			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYOFF			" id="off" 					 value="off" 					style= "background-image:url('Commandline icons/layoff.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">					LAYOFF				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYON				" id="turn_all_layers_on" 					 value="turn_all_layers_on" 					style= "background-image:url('Commandline icons/layon.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">	LAYON				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYOUT				" id="layout_new_layout" 					 value="layout_new_layout" 					style= "background-image:url('Commandline icons/layout.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">		LAYOUT				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYOUTLINE (XLINE)	" id="layoutline" 				 value="layoutline" 				style= "background-image:url('Commandline icons/layoutlinexline.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">							LAYOUTLINE (XLINE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYOUTMERGE			" id="merge_layout" 			 value="merge_layout" 			style= "background-image:url('Commandline icons/layoutmerge.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">								LAYOUTMERGE			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYOUTWIZARD		" id="layoutwizard" 			 value="layoutwizard" 			style= "background-image:url('Commandline icons/layoutwizard.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">								LAYOUTWIZARD		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYTHW				" id="thaw_all_layers" 					 value="thaw_all_layers" 					style= "background-image:url('Commandline icons/laythw.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">		LAYTHW				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYTRANS			" id="layer_translator" 				 value="layer_translator" 				style= "background-image:url('Commandline icons/laytrans.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">				LAYTRANS			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYULK				" id="unlock" 					 value="unlock" 					style= "background-image:url('Commandline icons/layulk.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">							LAYULK				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYUNISO			" id="unisolate" 				 value="unisolate" 				style= "background-image:url('Commandline icons/layuniso.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">								LAYUNISO			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYVPI" id="vpfreezeinallviewports" 					 value="vpfreezeinallviewports" 					style= "background-image:url('Commandline icons/layvpi.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">	LAYVPI	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LAYWALK					" id="layer_walk" 				 value="layer_walk" 				style= "background-image:url('Commandline icons/laywalk.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">				LAYWALK					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LE (QLEADER)			" id="qleader" 						 value="qleader" 						style= "background-image:url('Commandline icons/leqleader.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">	LE (QLEADER)			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LEAD (LEADER)			" id="lead" 					 value="lead" 					style= "background-image:url('Commandline icons/leadleader.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">					LEAD (LEADER)			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LEN(LENGTHEN)			" id="lengthen" 					 value="lengthen" 					style= "background-image:url('Commandline icons/lenlengthen.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">			LEN(LENGTHEN)			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LENGTH (DIST)			" id="length" 					 value="length" 					style= "background-image:url('Commandline icons/lengthdist.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">				LENGTH (DIST)			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LESS (MESHSMOOTHLESS)	" id="smooth_less" 					 value="smooth_less" 					style= "background-image:url('Commandline icons/lessmeshsmoothless.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	LESS (MESHSMOOTHLESS)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LI(LIST)				" id="list" 						 value="list" 						style= "background-image:url('Commandline icons/lilist.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" 	data-highlight="false">		LI(LIST)				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LIGHT					" id="light" 					 value="light" 					style= "background-image:url('Commandline icons/light.png');background-repeat:no-repeat; text-indent: 30px;"				 				data-display="true" data-highlight="false">					LIGHT					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LIGHTGLYPHDISPLAY		" id="light_glyph_display" 		 value="light_glyph_display" 		style= "background-image:url('Commandline icons/lightglyphdisplay.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">			LIGHTGLYPHDISPLAY		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LIGHTLIST" id="lights_in_model_palette" 				 value="lights_in_model_palette" 				style= "background-image:url('Commandline icons/lightlist.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">		LIGHTLIST	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LIGHTLISTCLOSE			" id="lightlistclose" 			 value="lightlistclose" 			style= "background-image:url('Commandline icons/lightlistclose.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	LIGHTLISTCLOSE			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LIMITS					" id="limits" 					 value="limits" 					style= "background-image:url('Commandline icons/limits.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">	LIMITS					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LINETYPE				" id="linetype" 				 value="linetype" 				style= "background-image:url('Commandline icons/linetype.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">		LINETYPE				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LINEWEIGHT(LWEIGHT)		" id="lineweight" 				 value="lineweight" 				style= "background-image:url('Commandline icons/lineweightlweight.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	LINEWEIGHT(LWEIGHT)		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LIVESECTION				" id="live_section" 			 value="live_section" 			style= "background-image:url('Commandline icons/livesection.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">		LIVESECTION				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LO(-LAYOUT)				" id="lo" 						 value="lo" 						style= "background-image:url('Commandline icons/lolayout.png');background-repeat:no-repeat; text-indent: 30px;"			 					data-display="true" data-highlight="false">	LO(-LAYOUT)				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LOAD					" id="load" 					 value="load" 					style= "background-image:url('Commandline icons/load.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">		LOAD					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LOCATION(ID)			" id="location" 				 value="location" 				style= "background-image:url('Commandline icons/locationid.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">		LOCATION(ID)			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LOFT					" id="loft" 					 value="loft" 					style= "background-image:url('Commandline icons/loft.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">		LOFT					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LOGFILEOFF				" id="logfileoff" 				 value="logfileoff" 				style= "background-image:url('Commandline icons/logfileoff.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">	LOGFILEOFF				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LOGFILEON				" id="logfileon" 				value="logfileon" 				style= "background-image:url('Commandline icons/logfileon.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">		LOGFILEON				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LOGINITIALWORKSPACEESW	" id="loginitialworkspaceesw" 	value="loginitialworkspaceesw" 	style= "background-image:url('Commandline icons/loginitialworkspaceesw.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">		LOGINITIALWORKSPACEESW	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LONGSECTION (SECTION)	" id="longsection" 			value="longsection" 			style= "background-image:url('Commandline icons/longsectionsection.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">		LONGSECTION (SECTION)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LSP						" id="lsp" 					value="lsp" 					style= "background-image:url('Commandline icons/lsp.png');background-repeat:no-repeat; text-indent: 30px;" 									data-display="true" data-highlight="false">		LSP						</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LSPDUMP					" id="lspdump" 				value="lspdump" 				style= "background-image:url('Commandline icons/lspdump.png');background-repeat:no-repeat; text-indent: 30px;"								data-display="true" data-highlight="false">		LSPDUMP						</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LSPSURF					" id="lspsurf" 				value="lspsurf" 				style= "background-image:url('Commandline icons/lspsurf.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">		LSPSURF					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="LTS(LTSCALE)			" id="lts" 					value="lts" 					style= "background-image:url('Commandline icons/ltsltscale.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">		LTS(LTSCALE)			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="M(MOVE)					" id="move" 						value="move" 						style= "background-image:url('Commandline icons/mmove.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">	M(MOVE)					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MEA(MEASUREGEOM)		" id="mea" 					value="mea" 					style= "background-image:url('Commandline icons/meameasuregeom.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">		MEA(MEASUREGEOM)		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MA(MATCHPROP)			" id="ma" 						value="ma" 						style= "background-image:url('Commandline icons/mamatchprop.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">		MA(MATCHPROP)			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MTEDIT					" id="mtedit" 					value="mtedit" 					style= "background-image:url('Commandline icons/mtedit.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">		MTEDIT					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MI(MIRROR)				" id="mirror" 				 value="mirror" 						 style= "background-image:url('Commandline icons/mimirror.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">	MI(MIRROR)				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MS(MSPACE)				" id="ms" 				 value="ms" 						 style= "background-image:url('Commandline icons/msmspace.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">			MS(MSPACE)				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MO(PROPERTIES)			" id="properties" 				 value="properties" 						 style= "background-image:url('Commandline icons/moproperties.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	MO(PROPERTIES)			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MERGEPOLYLINES(PEDIT)	" id="combinepolylinepedit" 	 value="combinepolylinepedit" 			 style= "background-image:url('Commandline icons/mergepolylinespedit.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	MERGEPOLYLINES(PEDIT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MT(MTEXT)" id="multiline_text" 				 value="multiline_text" 						 style= "background-image:url('Commandline icons/mtmtext.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">	MT(MTEXT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MREDO" id="mredo" 			 value="mredo" 					 style= "background-image:url('Commandline icons/mredo.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">	MREDO	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MLD(MLEADER)			" id="calloutmleader" 			 value="calloutmleader" 					 style= "background-image:url('Commandline icons/mldmleader.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">	MLD(MLEADER)				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MERGE(UNION)			" id="union" 			 value="union" 					 style= "background-image:url('Commandline icons/mergeunion.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">						MERGE(UNION)				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ML(MLINE)				" id="ml" 				 value="ml" 						 style= "background-image:url('Commandline icons/mlmline.png');background-repeat:no-repeat; text-indent: 30px;" 								data-display="true" data-highlight="false">				ML(MLINE)					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MV(MVIEW)				" id="mv" 						value="mv" 						style= "background-image:url('Commandline icons/mvmview.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">							MV(MVIEW)					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MATERIALASSIGN			" id="materialassign" 			value="materialassign" 			style= "background-image:url('Commandline icons/materialassign.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">							MATERIALASSIGN				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MULTI-SHEETPLOT(PUBLISH)" id="batch_plot" 		value="batch_plot" 		style= "background-image:url('Commandline icons/multisheetplotpublish.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">											MULTI-SHEETPLOT(PUBLISH)		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MATH(QUICKCALC)			" id="quick_calculator" 					value="quick_calculator" 					style= "background-image:url('Commandline icons/mathquickcalc.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	MATH(QUICKCALC)				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MLEADERSTYLE			" id="multileader_style"		 	value="multileader_style"		 	style= "background-image:url('Commandline icons/mleaderstyle.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">					MLEADERSTYLE				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ME(MEASURE)				" id="measure" 						value="measure" 						style= "background-image:url('Commandline icons/memeasure.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">			ME(MEASURE)					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MAT(MATBROWSEROPEN)		" id="materials_browser" 					value="materials_browser" 					style= "background-image:url('Commandline icons/matmatbrowseropen.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	MAT(MATBROWSEROPEN)			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MASSPROP				" id="region_mass_properties" 				value="region_mass_properties" 				style= "background-image:url('Commandline icons/massprop.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	MASSPROP					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MOTION(NAVSMOTION)		" id="showmotion" 					value="showmotion" 					style= "background-image:url('Commandline icons/motionnavsmotion.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">					MOTION(NAVSMOTION)			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MESHSMOOTHMORE			" id="smooth_more" 			value="smooth_more" 			style= "background-image:url('Commandline icons/meshsmoothmore.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">							MESHSMOOTHMORE				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MULTIPLE				" id="multiple" 				value="multiple" 				style= "background-image:url('Commandline icons/multiple.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">							MULTIPLE					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MESH					" id="mesh_cone" 					value="mesh_cone" 					style= "background-image:url('Commandline icons/mesh.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">					MESH						</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MLEDIT					" id="mledit" 					value="mledit" 					style= "background-image:url('Commandline icons/mledit.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">							MLEDIT						</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MATERIALMAP				" id="setuvmaterialmap" 			value="setuvmaterialmap" 			style= "background-image:url('Commandline icons/materialmap.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">					MATERIALMAP					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MESHSMOOTH				" id="smoothmeshsmooth" 				value="smoothmeshsmooth" 				style= "background-image:url('Commandline icons/meshsmooth.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">			MESHSMOOTH					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MIRROR3D				" id="3dmirror" 				value="3dmirror" 				style= "background-image:url('Commandline icons/mirror3d.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">							MIRROR3D					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MODEL					" id="model" 					value="model" 					style= "background-image:url('Commandline icons/model.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">							MODEL						</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MLSTYLE					" id="multiline_style" 				value="multiline_style" 				style= "background-image:url('Commandline icons/mlstyle.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">			MLSTYLE						</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MLA(MLEADERALIGN)		" id="align" 					value="align" 					style= "background-image:url('Commandline icons/mlamleaderalign.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">							MLA(MLEADERALIGN)			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MLE(MLEADEREDIT)		" id="add_leader" 					value="add_leader" 					style= "background-image:url('Commandline icons/mlemleaderedit.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">					MLE(MLEADEREDIT)			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MATEDITOROPEN			" id="materials_editor" 			value="materials_editor" 			style= "background-image:url('Commandline icons/mateditoropen.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">					MATEDITOROPEN				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MENU					" id="menu" 					value="menu" 					style= "background-image:url('Commandline icons/menu.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">							MENU						</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MATERIALATTACH			" id="attach_by_layer" 			value="attach_by_layer" 			style= "background-image:url('Commandline icons/materialattach.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">					MATERIALATTACH				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MSLIDE					" id="mslide"					value="mslide"					style= "background-image:url('Commandline icons/mslide.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">							MSLIDE						</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MESHUNCREASE			" id="remove_crease" 			value="remove_crease" 			style= "background-image:url('Commandline icons/meshuncrease.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">							MESHUNCREASE				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MESHOPTIONS				" id="meshoptions" 			value="meshoptions" 			style= "background-image:url('Commandline icons/meshoptions.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">							MESHOPTIONS					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MATERIALS				" id="finishmaterials" 				value="finishmaterials" 				style= "background-image:url('Commandline icons/materials.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">			MATERIALS					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MESHCREASE				" id="add_crease" 				value="add_crease" 				style= "background-image:url('Commandline icons/meshcrease.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">							MESHCREASE					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MESHSMOOTHLESS			" id="smooth_less" 			value="smooth_less" 			style= "background-image:url('Commandline icons/meshsmoothless.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">							MESHSMOOTHLESS				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MESHREFINE				" id="refine_mesh" 				value="refine_mesh" 				style= "background-image:url('Commandline icons/meshrefine.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">					MESHREFINE					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MATCHCELL				" id="matchcell" 				value="matchcell" 				style= "background-image:url('Commandline icons/matchcell.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">							MATCHCELL					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MINSERT					" id="minsert" 				value="minsert" 				style= "background-image:url('Commandline icons/minsert.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">							MINSERT						</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MESHEXTRUDE				" id="extrude-face" 			value="extrude-face" 			style= "background-image:url('Commandline icons/meshextrude.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">							MESHEXTRUDE					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MEASUREMENT				" id="measurement" 			value="measurement" 			style= "background-image:url('Commandline icons/measurement.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">							MEASUREMENT					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MARKUP					" id="markup_set_manager" 					value="markup_set_manager" 					style= "background-image:url('Commandline icons/markup.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	MARKUP						</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MLC(MLEADERCOLLECT)" id="collect" 					value="collect" 					style= "background-image:url('Commandline icons/mlcmleadercollect.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	MLC(MLEADERCOLLECT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MATBROWSERCLOSE		" id="matbrowserclose" 		value="matbrowserclose" 		style= "background-image:url('Commandline icons/matbrowserclose.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	MATBROWSERCLOSE			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MESHPRIMITIVEOPTIONS" id="meshprimitiveoptions" 	value="meshprimitiveoptions" 	style= "background-image:url('Commandline icons/meshprimitiveoptions.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	MESHPRIMITIVEOPTIONS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MESHSPLIT			" id="split_face" 				value="split_face" 				style= "background-image:url('Commandline icons/meshsplit.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	MESHSPLIT				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MESHMERGE			" id="merge_face" 				value="merge_face" 				style= "background-image:url('Commandline icons/meshmerge.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	MESHMERGE				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MATEDITORCLOSE		" id="mateditorclose" 			value="mateditorclose" 			style= "background-image:url('Commandline icons/mateditorclose.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	MATEDITORCLOSE			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MESHCAP						" id="close_hole"			 		value="close_hole"			 		style= "background-image:url('Commandline icons/meshcap.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	MESHCAP						</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MOTIONCLS(NAVSMOTIONCLOSE)	" id="motioncls" 				value="motioncls" 				style= "background-image:url('Commandline icons/motionclsnavsmotionclose.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">			MOTIONCLS(NAVSMOTIONCLOSE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MESHCOLLAPSE				" id="collapse_face_or-edge" 	value="collapse_face_or-edge" 			style= "background-image:url('Commandline icons/meshcollapse.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	MESHCOLLAPSE				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MTPROP			" id="mtprop" 					value="mtprop" 					style= "background-image:url('Commandline icons/mtprop.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">		MTPROP			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MARKUPCLOSE		" id="markupclose" 			value="markupclose" 			style= "background-image:url('Commandline icons/markupclose.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">		MARKUPCLOSE			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MIGRATEMATERIALS" id="migratematerials" 		value="migratematerials" 		style= "background-image:url('Commandline icons/migratematerials.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">		MIGRATEMATERIALS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MESHSPIN		" id="spin_triangle-face" 	value="spin_triangle-face" 				style= "background-image:url('Commandline icons/meshspin.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	MESHSPIN			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MATERIALSCLOSE	" id="materialsclose" 			value="materialsclose" 			style= "background-image:url('Commandline icons/materialsclose.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	MATERIALSCLOSE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MAKEPREVIEW		" id="makepreview" 			value="makepreview" 			style= "background-image:url('Commandline icons/makepreview.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	MAKEPREVIEW		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MATLIB			" id="matlib" 					value="matlib" 					style= "background-image:url('Commandline icons/matlib.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	MATLIB			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MENULOAD		" id="menuload" 				value="menuload" 				style= "background-image:url('Commandline icons/menuload.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	MENULOAD		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MENUUNLOAD		" id="menuunload" 				value="menuunload" 				style= "background-image:url('Commandline icons/menuunload.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	MENUUNLOAD		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MKLTYPE" id="make_linetype" 			value="make_linetype" 				style= "background-image:url('Commandline icons/mkltype.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	MKLTYPE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MKSHAPE			" id="make_shape" 			value="make_shape" 				style= "background-image:url('Commandline icons/mkshape.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">		MKSHAPE			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MOCORO			" id="move_copy_rotate"   	value="move_copy_rotate" 		style= "background-image:url('Commandline icons/mocoro.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">		MOCORO			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MODELPROPERTIES	" id="modelproperties" 		value="modelproperties" 		style= "background-image:url('Commandline icons/modelproperties.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	MODELPROPERTIES	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MOVEBAK			" id="movebak" 				value="movebak" 				style= "background-image:url('Commandline icons/movebak.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	MOVEBAK			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MPEDIT			" id="mpedit" 					value="mpedit" 					style= "background-image:url('Commandline icons/mpedit.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	MPEDIT			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MSTRETCH" id="multiple_object_stretch"    value="multiple_object_stretch" 				style= "background-image:url('Commandline icons/mstretch.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	MSTRETCH	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="MVSETUP" id="mvsetup" 				value="mvsetup" 				style= "background-image:url('Commandline icons/mvsetup.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	MVSETUP	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="NEW" id="new_drawing" 					value="new_drawing" 					style= "background-image:url('Commandline icons/new.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	NEW	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="NEWVIEW" id="newview" 				value="newview" 				style= "background-image:url('Commandline icons/newview.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	NEWVIEW	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="NETLOAD" id="netload" 				value="netload" 				style= "background-image:url('Commandline icons/netload.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	NETLOAD	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="NUMBER(QSELECT)" id="quick_select" 					value="quick_select" 					style= "background-image:url('Commandline icons/numberqselect.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	NUMBER(QSELECT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="NAVSWHEEL				" id="navswheel" 				value="navswheel" 				style= "background-image:url('Commandline icons/navswheel.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	NAVSWHEEL				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="NAVSMOTION				" id="showmotion" 				value="showmotion" 				style= "background-image:url('Commandline icons/navsmotion.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	NAVSMOTION				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="NEWSHEETSET				" id="new_sheet_set" 			value="new_sheet_set" 			style= "background-image:url('Commandline icons/newsheetset.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	NEWSHEETSET				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="NAVVCUBE				" id="view_cube" 				value="view_cube" 				style= "background-image:url('Commandline icons/navvcube.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	NAVVCUBE				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="NETWORKSRF(SURFNETWORK)	" id="network" 				value="network" 				style= "background-image:url('Commandline icons/networksrfsurfnetwork.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	NETWORKSRF(SURFNETWORK)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="NCOPY" id="copy _nested_objects" 					value="copy _nested_objects" 					style= "background-image:url('Commandline icons/copy.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	NCOPY	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="NORTH(GEOGRAPHICLOCATION)" id="north" 					value="north" 					style= "background-image:url('Commandline icons/north.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	NORTH(GEOGRAPHICLOCATION)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="NAVBAR			" id="navigation_bar" 					value="navigation_bar" 					style= "background-image:url('Commandline icons/navbar.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	NAVBAR			</li>
                     <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"    name="NOTEPAD			" id="notepad" 				value="notepad" 				style= "background-image:url('Commandline icons/notepad.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">					NOTEPAD			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="NWATTACH		" id="nwattach" 				value="nwattach" 				style= "background-image:url('Commandline icons/nwattach.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">					NWATTACH		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="O(OFFSET)		" id="offset" 						value="offset" 						style= "background-image:url('Commandline icons/ooffset.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">			O(OFFSET)		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ORBIT(3DORBIT)	" id="orbit" 					value="orbit" 					style= "background-image:url('Commandline icons/orbit3dorbit.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">					ORBIT(3DORBIT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="OPEN			" id="open" 					value="open" 					style= "background-image:url('Commandline icons/open.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">					OPEN			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="OP(OPTIONS)" id="settingsoptions" 						value="settingsoptions" 						style= "background-image:url('Commandline icons/opoptions.png');background-repeat:no-repeat; text-indent: 30px;"				data-display="true" data-highlight="false">	OP(OPTIONS)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="OPTCHPROP				" id="optchprop"			 	value="optchprop"			 	style= "background-image:url('Commandline icons/optchprop.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	OPTCHPROP				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="OBJECTSNAP(OSNAP)		" id="objectsnap" 				value="objectsnap" 				style= "background-image:url('Commandline icons/objectsnaposnap.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	OBJECTSNAP(OSNAP)		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ORTHO					" id="ortho" 					value="ortho" 					style= "background-image:url('Commandline icons/ortho.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	ORTHO					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="OOPS					" id="oops" 					value="oops" 					style= "background-image:url('Commandline icons/oops.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	OOPS					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="OVERKILL				" id="overkill" 				value="overkill" 				style= "background-image:url('Commandline icons/overkill.png');background-repeat:no-repeat; text-indent: 30px;"			 		data-display="true" data-highlight="false">	OVERKILL				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="OBJECTSCALE				" id="add_current_scale" 		 value="add_current_scale" 		style= "background-image:url('Commandline icons/objectscale.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">		OBJECTSCALE				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="OPENSHEETSET			" id="opensheetset"		 value="opensheetset"		style= "background-image:url('Commandline icons/opensheetset.png');background-repeat:no-repeat; text-indent: 30px;" 			 data-display="true" data-highlight="false">		OPENSHEETSET			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="OFFSETSRF(SURFOFFSET)	" id="offset-surface" 			 value="offset-surface" 			style= "background-image:url('Commandline icons/offsetsrfsurfoffset.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	OFFSETSRF(SURFOFFSET)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="OFFSETEDGE				" id="offset_edge" 			 value="offset_edge" 			style= "background-image:url('Commandline icons/offsetedge.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">		OFFSETEDGE					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="OPENDWFMARKUP			" id="opendwfmarkup" 		 value="opendwfmarkup" 		style= "background-image:url('Commandline icons/opendwfmarkup.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">				OPENDWFMARKUP				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="OLELINKS				" id="ole_links" 			 value="ole_links" 			style= "background-image:url('Commandline icons/olelinks.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">				OLELINKS				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="OLESCALE				" id="olescale" 			 value="olescale" 			style= "background-image:url('Commandline icons/olescale.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">				OLESCALE				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ONLINESYNC			</li" id="sync_my_settings" 			 value="sync_my_settings" 			style= "background-image:url('Commandline icons/onlinesync.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	ONLINESYNC			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ONLINEOPTIONS			" id="onlineoptions" 		 value="onlineoptions" 		style= "background-image:url('Commandline icons/onlineoptions.png');background-repeat:no-repeat; text-indent: 30px;"		data-display="true" data-highlight="false">					ONLINEOPTIONS			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ONLINESYNCSETTINGS		" id="choose_settings"   value="choose_settings"  style= "background-image:url('Commandline icons/onlinesyncsettings.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">						ONLINESYNCSETTINGS		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="OBJRELDUMP				" id="objreldump" 			 value="objreldump" 			style= "background-image:url('Commandline icons/objreldump.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">				OBJRELDUMP				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="OBJRELSHOW				" id="objrelshow" 			 value="objrelshow" 			style= "background-image:url('Commandline icons/objrelshow.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">				OBJRELSHOW				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="OBJRELUPDATE			" id="objrelupdate" 		 value="objrelupdate" 		style= "background-image:url('Commandline icons/objrelupdate.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">					OBJRELUPDATE			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="OLECONVERT				" id="oleconvert" 			 value="oleconvert" 			style= "background-image:url('Commandline icons/oleconvert.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">				OLECONVERT				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="OLEOPEN					" id="oleopen" 			 value="oleopen" 			style= "background-image:url('Commandline icons/oleopen.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">					OLEOPEN					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="OLERESET				" id="olereset" 			 value="olereset" 			style= "background-image:url('Commandline icons/olereset.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">					OLERESET				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ONLINEAUTOCAD360		" id="onlineautocad360" 	 value="onlineautocad360" 	style= "background-image:url('Commandline icons/onlineautocad360.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">					ONLINEAUTOCAD360		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ONLINEDESIGNSHARE		" id="share_design_view" 	 value="share_design_view" 	style= "background-image:url('Commandline icons/onlinedesignshare.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">					ONLINEDESIGNSHARE		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ONLINEDOCS				" id="open_a360_file" 			 value="open_a360_file" 			style= "background-image:url('Commandline icons/Onlinedocs.png');background-repeat:no-repeat; text-indent: 30px;"			data-display="true" data-highlight="false">		ONLINEDOCS				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ONLINEOPENFOLDER		" id="open_local_sync_folder" 	 value="open_local_sync_folder" 	style= "background-image:url('Commandline icons/onlineopenfolder.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">		ONLINEOPENFOLDER		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ONLINESHARE				" id="share_document" 		 value="share_document" 		style= "background-image:url('Commandline icons/onlineshare.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">				ONLINESHARE				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="OPENFROMCLOUD			" id="openfromcloud" 		 value="openfromcloud" 		style= "background-image:url('Commandline icons/openfromcloud.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">					OPENFROMCLOUD			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="P(PAN)					" id="pan" 					 value="pan" 					style= "background-image:url('Commandline icons/ppan.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">			P(PAN)					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PRESSPULL				" id="presspull" 			 value="presspull" 			style= "background-image:url('Commandline icons/Presspull.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">					PRESSPULL				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="POLYSOLID				" id="polysolid" 			 value="polysolid" 			style= "background-image:url('Commandline icons/Polysolid.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">					POLYSOLID				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PL(PLINE)				" id="polyline" 					 value="polyline" 					style= "background-image:url('Commandline icons/plpline.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	PL(PLINE)				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PLOT					" id="plot" 				 value="plot" 				style= "background-image:url('Commandline icons/Plot.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">					PLOT					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="POCHE(HATCH)			" id="hatch" 				 value="hatch" 				style= "background-image:url('Commandline icons/pochehatch.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">					POCHE(HATCH)			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PYR(PYRAMID)			" id="pyramid" 				 value="pyramid" 				style= "background-image:url('Commandline icons/pyrpyramid.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">			PYR(PYRAMID)			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PARALLEL(OFFSET)		" id="offset" 			 value="offset" 			style= "background-image:url('Commandline icons/paralleloffset.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">						PARALLEL(OFFSET)		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PAINTER(MATCHPROP)		" id="painter" 			 value="painter" 			style= "background-image:url('Commandline icons/paintermatchprop.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">					PAINTER(MATCHPROP)		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PASTECLIP				" id="paste" 			 value="paste" 			style= "background-image:url('Commandline icons/Pasteclip.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">							PASTECLIP				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PS(PSPACE)				" id="ps" 					 value="ps" 					style= "background-image:url('Commandline icons/pspspace.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">				PS(PSPACE)				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PR(PROPERTIES)	" id="properties" 					 value="properties" 					style= "background-image:url('Commandline icons/prproperties.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">		PR(PROPERTIES)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PE(PEDIT)		" id="edit_polyline" 					 value="edit_polyline" 					style= "background-image:url('Commandline icons/pepedit.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	PE(PEDIT)		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PU(PURGE)		" id="removepurge" 					 value="removepurge" 					style= "background-image:url('Commandline icons/pupurge.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	PU(PURGE)		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PARAGRAPH(MTEXT)	" id="paragraph" 			 value="paragraph" 			style= "background-image:url('Commandline icons/paragraphmtext.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">												PARAGRAPH(MTEXT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PO(POINT)			" id="points_multiple_points" 					 value="points_multiple_points" 					style= "background-image:url('Commandline icons/popoint.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	PO(POINT)			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PASTEBLOCK			" id="paste_as_block"			 value="paste_as_block"			style= "background-image:url('Commandline icons/pasteblock.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">										PASTEBLOCK			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PAGESETUP			" id="page_set_up_manager" value="page_set_up_manager" 			style= "background-image:url('Commandline icons/pagesetup.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">									PAGESETUP			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PRECISION(OSNAP)	" id="precision" 			 value="precision" 			style= "background-image:url('Commandline icons/precisionosnap.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">												PRECISION(OSNAP)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PLAN				" id="plan" 				 value="plan" 				style= "background-image:url('Commandline icons/plan.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">												PLAN				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="POL(POLYGON)" id="polygon" 				 value="polygon" 				style= "background-image:url('Commandline icons/polpolygon.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	POL(POLYGON)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"    name="PRE(PREVIEW)" id="preview" 				 value="preview" 				style= "background-image:url('Commandline icons/prepreview.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	PRE(PREVIEW)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PASTEORIG" id="paste_to_original_coordinates" 			 value="paste_to_original_coordinates" 			style= "background-image:url('Commandline icons/pasteorig.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	PASTEORIG	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PRCLOSE(PROPERTIESCLOSE)" id="prclose" 			 value="prclose" 			 style= "background-image:url('Commandline icons/prclosepropertiesclose.png');background-repeat:no-repeat; text-indent: 30px;"	data-display="true" data-highlight="false">		PRCLOSE(PROPERTIESCLOSE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PUBLISH					" id="publish" 			 value="publish" 			 style= "background-image:url('Commandline icons/publish.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	PUBLISH						</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PARAM(BPARAMETER)" id="bparameter" 				 value="bparameter" 				 style= "background-image:url('Commandline icons/parambparameter.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	PARAM(BPARAMETER)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PACKAGE(ENTRANSMIT)	" id="package" 			 value="package" 			 style= "background-image:url('Commandline icons/packageentransmit.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	PACKAGE(ENTRANSMIT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PDFATTACH			" id="pdfattach" 			 value="pdfattach" 			 style= "background-image:url('Commandline icons/pdfattach.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	PDFATTACH			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PSETUPIN			" id="psetupin" 			 value="psetupin" 			 style= "background-image:url('Commandline icons/psetupin.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	PSETUPIN			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PLANESURF			" id="planesurf" 			 value="planesurf" 			 style= "background-image:url('Commandline icons/planesurf.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	PLANESURF			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PA(PASTESPEC)				" id="paste_special" 					 value="paste_special" 					 style= "background-image:url('Commandline icons/papastespec.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	PA(PASTESPEC)				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PROFILE(SECTION)			" id="profile" 			 value="profile" 			 style= "background-image:url('Commandline icons/profilesection.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">								PROFILE(SECTION)			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="POINTLIGHT					" id="freepointpointlight" 			 value="freepointpointlight" 			 style= "background-image:url('Commandline icons/pointlight.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">		POINTLIGHT					</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PLOTTERMANAGER				" id="plottermanager" 		 value="plottermanager" 		 style= "background-image:url('Commandline icons/plottermanager.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">							PLOTTERMANAGER				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PAR(PARAMETERS)				" id="par" 				 value="par" 				 style= "background-image:url('Commandline icons/parparameters.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">								PAR(PARAMETERS)				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PATCH(SURFPATCH)			" id="patch" 				 value="patch" 				 style= "background-image:url('Commandline icons/patchsurfpatch.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">								PATCH(SURFPATCH)			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PATTACH(POINTCLOUDATTACH)	" id="pattach" 			 value="pattach" 			 style= "background-image:url('Commandline icons/pattachpointcloudattach.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">							PATTACH(POINTCLOUDATTACH)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PDFCLIP						" id="pdfclip" 			 value="pdfclip" 			 style= "background-image:url('Commandline icons/pdfclip.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">							PDFCLIP						</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PROJECTGEOMETRY				" id="projectgeometry" 	 value="projectgeometry" 	 style= "background-image:url('Commandline icons/projectgeometry.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">							PROJECTGEOMETRY				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="POINTON(CVSHOW)				" id="pointoncvshow" 			 value="pointoncvshow" 			 style= "background-image:url('Commandline icons/pointoncvshow.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">						POINTON(CVSHOW)				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PLOTSTAMP	" id="plotstamp" 			 value="plotstamp" 			 style= "background-image:url('Commandline icons/plotstamp.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	PLOTSTAMP	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PICKSTYLE	" id="pickstyle" 			 value="pickstyle" 			 style= "background-image:url('Commandline icons/pickstyle.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	PICKSTYLE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PFACE		" id="pface" 				 value="pface" 				 style= "background-image:url('Commandline icons/pface.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	PFACE		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PDFOSNAP	" id="pdfosnap" 			 value="pdfosnap" 			 style= "background-image:url('Commandline icons/pdfosnap.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	PDFOSNAP	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PARAMETERSCLOSE	" id="parametersclose" 	 value="parametersclose" 	 style= "background-image:url('Commandline icons/parametersclose.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	PARAMETERSCLOSE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PLOTSTYLE		" id="plotstyle" 			 value="plotstyle" 			 style= "background-image:url('Commandline icons/plotstyle.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">		PLOTSTYLE		</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PTW(PUBLISHTOWEB)" id="ptwpublishtoweb" 				 value="ptwpublishtoweb" 				 style= "background-image:url('Commandline icons/ptwpublishtoweb.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	PTW(PUBLISHTOWEB)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="POINTOFF(CVHIDE)	" id="pointoffcvhide" 			 value="pointoffcvhide" 			 style= "background-image:url('Commandline icons/pointoffcvhide.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	POINTOFF(CVHIDE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PREFERENCES			" id="preferences" 		 value="preferences" 		 style= "background-image:url('Commandline icons/preferences.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">			PREFERENCES			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PASTEASHYPERLINK	" id="pasteashyperlink" 	 value="pasteashyperlink" 	 style= "background-image:url('Commandline icons/pasteashyperlink.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">				PASTEASHYPERLINK	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="POINTCLOUDDENSITY	" id="pointclouddensity" 	 value="pointclouddensity" 	 style= "background-image:url('Commandline icons/pointclouddensity.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">				POINTCLOUDDENSITY	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PNGOUT				" id="pngout" 				 value="pngout" 				 style= "background-image:url('Commandline icons/pngout.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">			PNGOUT				</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PARTIALOAD			" id="partiaload" 			 value="partiaload" 			 style= "background-image:url('Commandline icons/partiaload.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">			PARTIALOAD			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PDFLAYERS			" id="pdflayers" 			 value="pdflayers" 			 style= "background-image:url('Commandline icons/pdflayers.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">			PDFLAYERS			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PDFADJUST			" id="pdfadjust" 			 value="pdfadjust" 			 style= "background-image:url('Commandline icons/pdfadjust.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">			PDFADJUST			</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="POFF(HIDEPALETTES)" id="poffhidepalettes" 				 value="poffhidepalettes" 				 style= "background-image:url('Commandline icons/poffhidepalettes.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	POFF(HIDEPALETTES)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PSOUT" id="psout" 				 value="psout" 				 style= "background-image:url('Commandline icons/psout.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	PSOUT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PON(SHOWPALETTES)" id="ponshowpalettes" 				 value="ponshowpalettes" 				 style= "background-image:url('Commandline icons/ponshowpalettes.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	PON(SHOWPALETTES)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PCINWIZARD" id="pcinwizard" 			 value="pcinwizard" 			 style= "background-image:url('Commandline icons/pcinwizard.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	PCINWIZARD	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="POINTCLOUDAUTOUPDATE" id="pointcloudautoupdate" value="pointcloudautoupdate" style= "background-image:url('Commandline icons/pointcloudautoupdate.png');background-repeat:no-repeat; text-indent: 30px;" 	 	data-display="true" data-highlight="false">	POINTCLOUDAUTOUPDATE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PSFILL" id="psfill" 				 value="psfill" 				 style= "background-image:url('Commandline icons/psfill.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	PSFILL	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="POINTCLOUDRTDENSITY" id="pointcloudrtdensity"  value="pointcloudrtdensity"  style= "background-image:url('Commandline icons/pointcloudrtdensity.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	POINTCLOUDRTDENSITY	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PAINTPROP" id="paintprop" 			 value="paintprop" 			 style= "background-image:url('Commandline icons/paintprop.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	PAINTPROP	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PALETTECONSTATE" id="paletteconstate" 	 value="paletteconstate" 	 style= "background-image:url('Commandline icons/paletteconstate.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	PALETTECONSTATE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PARTIALOPEN(-PARTIALOPEN)" id="partialopenpartialopen" 		 value="partialopenpartialopen" 		 style= "background-image:url('Commandline icons/partialopen-partialopen.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	PARTIALOPEN(-PARTIALOPEN)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PBRUSH" id="pbrush" 				 value="pbrush" 				 style= "background-image:url('Commandline icons/pbrush.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	PBRUSH	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PCEXTRACTSECTION" id="pcextractsection" 	 value="pcextractsection" 	 style= "background-image:url('Commandline icons/pcextractsection.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	PCEXTRACTSECTION	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PCXIN" id="pcxin" 				 value="pcxin" 				 style= "background-image:url('Commandline icons/pcxin.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	PCXIN	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PDFIMPORT" id="pdfimport" 			 value="pdfimport" 			 style= "background-image:url('Commandline icons/pdfimport.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	PDFIMPORT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PDFSHX" id="pdfshx" 				 value="pdfshx" 				 style= "background-image:url('Commandline icons/pdfshx.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	PDFSHX	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PDFSHXTEXT" id="pdfshxtext" 			 value="pdfshxtext" 			 style= "background-image:url('Commandline icons/pdfshxtext.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	PDFSHXTEXT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PLT2DWG" id="plt2dwg" 			 value="plt2dwg" 			 style= "background-image:url('Commandline icons/plt2dwg.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	PLT2DWG	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PMSTART" id="pmstart" 			 value="pmstart" 			 style= "background-image:url('Commandline icons/pmstart.png');background-repeat:no-repeat; text-indent: 30px;"	 					data-display="true" data-highlight="false">	PMSTART	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PMSTOP" id="pmstop"				 value="pmstop"				 style= "background-image:url('Commandline icons/pmstop.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	PMSTOP	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PMTOGGLE" id="pmtoggle" 			 value="pmtoggle" 			 style= "background-image:url('Commandline icons/pmtoggle.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	PMTOGGLE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PMTRACE" id="pmtrace" 			 value="pmtrace" 			 style= "background-image:url('Commandline icons/pmtrace.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">	PMTRACE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="POINTCLOUDCOLORMAP" id="pointcloudcolormap" 	 value="pointcloudcolormap" 	 style= "background-image:url('Commandline icons/pointcloudcolormap.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	POINTCLOUDCOLORMAP	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="POINTCLOUDCROP" id="pointcloudcrop" 		 value="pointcloudcrop" 		 style= "background-image:url('Commandline icons/pointcloudcrop.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	POINTCLOUDCROP	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="POINTCLOUDMANAGER" id="pointcloudmanager" 	 value="pointcloudmanager" 	 style= "background-image:url('Commandline icons/pointcloudmanager.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	POINTCLOUDMANAGER	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="POINTCLOUDMANAGERCLOSE" id="pointcloudmanagerclose" value="pointcloudmanagerclose" style= "background-image:url('Commandline icons/pointcloudmanagerclose.png');background-repeat:no-repeat; text-indent: 30px;" 	 		data-display="true" data-highlight="false">	POINTCLOUDMANAGERCLOSE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="POINTCLOUDUNCROP" id="pointclouduncrop"	 value="pointclouduncrop"	 style= "background-image:url('Commandline icons/pointclouduncrop.png');background-repeat:no-repeat; text-indent: 30px;" 				 data-display="true" data-highlight="false">	POINTCLOUDUNCROP	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="POSTDXFINFIX" id="postdxfinfix" 		 value="postdxfinfix" 		 style= "background-image:url('Commandline icons/postdxfinfix.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	POSTDXFINFIX	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PROPULATE" id="propulate" 			 value="propulate" 			 style= "background-image:url('Commandline icons/Propulate.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	PROPULATE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PRPLOT" id="prplot" 				 value="prplot" 				 style= "background-image:url('Commandline icons/Prplot.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">	PRPLOT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PSBSCALE" id="psbscale" 			 value="psbscale" 			 style= "background-image:url('Commandline icons/psbscale.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	PSBSCALE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PSTSCALE" id="pstscale" 			 value="pstscale" 			 style= "background-image:url('Commandline icons/pstscale.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	PSTSCALE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PTYPE" id="ptype" 				 value="ptype" 				 style= "background-image:url('Commandline icons/ptype.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">	PTYPE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="PUBLISHSHEETSET" id="publishsheetset" 	 value="publishsheetset" 	 style= "background-image:url('Commandline icons/publishsheetset.png');background-repeat:no-repeat; text-indent: 30px;"	 				data-display="true" data-highlight="false">	PUBLISHSHEETSET	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="QC (QUICKCALC)" id="qcquickcalc" 					 value="qcquickcalc" 					 style= "background-image:url('Commandline icons/qcquickcalc.png');background-repeat:no-repeat; text-indent: 30px;" 						data-display="true" data-highlight="false">	QC (QUICKCALC)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="QCCLOSE" id="qcclose" 			 value="qcclose" 			 style= "background-image:url('Commandline icons/qcclose.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">	QCCLOSE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="QCUI (QUICKCUI)" id="qcuiquickcui" 				 value="qcuiquickcui" 				 style= "background-image:url('Commandline icons/qcuiquickcui.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	QCUI (QUICKCUI)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="QDIM" id="qdim" 				 value="qdim" 				 style= "background-image:url('Commandline icons/qdim.png');background-repeat:no-repeat; text-indent: 30px;" 							data-display="true" data-highlight="false">	QDIM	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="QLATTACH" id="qlattach" 	value="qlattach" 	 style= "background-image:url('Commandline icons/qlattach.png');background-repeat:no-repeat; text-indent: 30px;"  		data-display="true" data-highlight="false">	QLATTACH	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="QLATTACHSET" id="qlattachset"	value="qlattachset"	 style= "background-image:url('Commandline icons/qlattachset.png');background-repeat:no-repeat; text-indent: 30px;" 	 	data-display="true" data-highlight="false">	QLATTACHSET	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="QLDETACHSET" id="qldetachset" value="qldetachset"  style= "background-image:url('Commandline icons/qldetachset.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	QLDETACHSET	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="QLEADER" id="qleader" 	value="qleader" 	 style= "background-image:url('Commandline icons/qleader.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	QLEADER	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="QNEW" id="qnew" 		value="qnew" 		 style= "background-image:url('Commandline icons/qnew.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	QNEW	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="QP (QUICKPROPERTIES)" id="qpquickproperties" 	  value="qpquickproperties" 	 style= "background-image:url('Commandline icons/qpquickproperties.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	QP (QUICKPROPERTIES)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="QQUIT" id="qquit" value="qquit" style= "background-image:url('Commandline icons/qquit.png');background-repeat:no-repeat; text-indent: 30px;" 				 data-display="true" data-highlight="false">	QQUIT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="QSAVE" id="qsave"	 value="qsave"	 style= "background-image:url('Commandline icons/qsave.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	QSAVE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="QSELECT" id="qselect"  value="qselect"  style= "background-image:url('Commandline icons/qselect.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	QSELECT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="QTEXT" id="qtext" 	 value="qtext" 	 style= "background-image:url('Commandline icons/qtext.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	QTEXT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="QUIT" id="qquit" 	 value="qquit" 	 style= "background-image:url('Commandline icons/quit.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	QUIT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="QVD (QVDRAWING)" id="qvdqvdrawing" 	 value="qvdqvdrawing" 	 style= "background-image:url('Commandline icons/qvdqvdrawing.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	QVD (QVDRAWING)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="QVDC (QVDRAWINGCLOSE)" id="qvdcqvdrawingclose" 			 value="qvdcqvdrawingclose" 			style= "background-image:url('Commandline icons/qvdcqvdrawingclose.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	QVDC (QVDRAWINGCLOSE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="QVL (QVLAYOUT)" id="qvlqvlayout"				 value="qvlqvlayout"				style= "background-image:url('Commandline icons/qvlqvlayout.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	QVL (QVLAYOUT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="QVLAYOUTCLOSE" id="qvlayoutclose" 	 value="qvlayoutclose" 	style= "background-image:url('Commandline icons/qvlayoutclose.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	QVLAYOUTCLOSE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="R (REDRAW)" id="rredraw" 				 value="rredraw" 				style= "background-image:url('Commandline icons/rredraw.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	R (REDRAW)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="R14PENWIZARD" id="r14penwizard" 	 value="r14penwizard" 	style= "background-image:url('Commandline icons/r14penwizard.png');background-repeat:no-repeat; text-indent: 30px;"			data-display="true" data-highlight="false">	R14PENWIZARD	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RA(REDRAWALL)" id="raredrawall" 				 value="raredrawall" 				style= "background-image:url('Commandline icons/raredrawall.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	RA(REDRAWALL)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RAPIDPROTOTYPE(3DPRINT)" id="rapidprototype3dprint" 	 value="rapidprototype3dprint" 	style= "background-image:url('Commandline icons/rapidprototype3dprint.png');background-repeat:no-repeat; text-indent: 30px;"data-display="true" data-highlight="false">	RAPIDPROTOTYPE(3DPRINT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RAY" id="ray" 			 value="ray" 			style= "background-image:url('Commandline icons/ray.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	RAY 	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RC(RENDERCROP)" id="rcrendercrop" 				 value="rcrendercrop" 				style= "background-image:url('Commandline icons/rcrendercrop.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	RC(RENDERCROP)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RE (REGEN)" id="reregen" 				 value="reregen" 				style= "background-image:url('Commandline icons/reregen.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	RE (REGEN)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REA (REGENALL)" id="rearegenall" 			 value="rearegenall" 			style= "background-image:url('Commandline icons/rearegenall.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	REA (REGENALL)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REBUILD(CVREBUILD)" id="rebuildcvrebuild" 		 value="rebuildcvrebuild" 		style= "background-image:url('Commandline icons/rebuildcvrebuild.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	REBUILD(CVREBUILD)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REC (RECTANG)" id="RECRECTANG" 			 value="RECRECTANG" 			style= "background-image:url('Commandline icons/recrectang.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	REC (RECTANG)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REC (RECTANG)" id="recap"		 	 value="recap"		 	style= "background-image:url('Commandline icons/recap.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	RECAP	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RECOMBINE (JOIN)" id="recombinejoin" 		 value="recombinejoin" 		style= "background-image:url('Commandline icons/recombinejoin.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	RECOMBINE (JOIN)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RECOVER" id="recover" 		 value="recover" 		style= "background-image:url('Commandline icons/recover.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	RECOVER	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RECOVERALL" id="recoverall" 		 value="recoverall" 		style= "background-image:url('Commandline icons/recoverall.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	RECOVERALL	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REDEFINE" id="redefine" 		 value="redefine" 		style= "background-image:url('Commandline icons/redefine.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	REDEFINE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REDIR" id="redir" 			 value="redir" 			style= "background-image:url('Commandline icons/redir.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	REDIR	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REDIRMODE" id="redirmode" 		 value="redirmode" 		style= "background-image:url('Commandline icons/redirmode.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	REDIRMODE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REDO" id="redo" 			 value="redo" 			style= "background-image:url('Commandline icons/redo.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	REDO	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REFCLOSE" id="refclose" 		 value="refclose" 		style= "background-image:url('Commandline icons/refclose.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	REFCLOSE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REFEDIT" id="refedit" 		 value="refedit" 		style= "background-image:url('Commandline icons/refedit.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	REFEDIT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REFINE(MESHREFINE)" id="refinemeshrefine" 			 value="refinemeshrefine" 			style= "background-image:url('Commandline icons/refinemeshrefine.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	REFINE(MESHREFINE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REFSET" id="refset" 			 value="refset" 			style= "background-image:url('Commandline icons/refset.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	REFSET	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REG (REGION)" id="regregion" 			 value="regregion" 			style= "background-image:url('Commandline icons/regregion.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	REG (REGION)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REGEN3" id="regen3" 			 value="regen3" 			style= "background-image:url('Commandline icons/regen3.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	REGEN3	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REGENAUTO" id="regenauto" 		 value="regenauto" 		style= "background-image:url('Commandline icons/regenauto.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	REGENAUTO	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REINIT" id="reinit" 			 value="reinit" 			style= "background-image:url('Commandline icons/reinit.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	REINIT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REMOVE (PURGE)" id="removepurge" 			 value="removepurge" 			style= "background-image:url('Commandline icons/removepurge.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	REMOVE (PURGE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REMOVECONTROLPOINT(CVREMOVE)" id="removecontrolpointcvremove" value="removecontrolpointcvremove"style= "background-image:url('Commandline icons/removecontrolpointcvremove.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	REMOVECONTROLPOINT(CVREMOVE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REN(RENAME)" id="renrename" 				 value="renrename" 				 style= "background-image:url('Commandline icons/renrename.png');background-repeat:no-repeat; text-indent: 30px;"			data-display="true" data-highlight="false">	REN(RENAME)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RENDER" id="render"				 value="render"				 style= "background-image:url('Commandline icons/render.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	RENDER	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RENDEREXPOSURECLOSE" id="renderexposureclose"  value="renderexposureclose"  style= "background-image:url('Commandline icons/renderexposureclose.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	RENDEREXPOSURECLOSE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RENDERONLINE" id="renderonline" 		 value="renderonline" 		 style= "background-image:url('Commandline icons/renderonline.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	RENDERONLINE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RENDERWINDOWCLOSE" id="renderwindowclose" 	 value="renderwindowclose" 	 style= "background-image:url('Commandline icons/renderwindowclose .png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	RENDERWINDOWCLOSE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RENDERENVIRONMENT" id="renderenvironment" 	 value="renderenvironment" 	 style= "background-image:url('Commandline icons/renderenvironment.png');background-repeat:no-repeat; text-indent: 30px;" 	data-display="true" data-highlight="false">	RENDERENVIRONMENT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RENDERENVIRONMENTCLOSE" id="renderenvironmentclose" 	 value="renderenvironmentclose" 	 style= "background-image:url('Commandline icons/renderenvironmentclose.png');background-repeat:no-repeat; text-indent: 30px;"	data-display="true" data-highlight="false">	RENDERENVIRONMENTCLOSE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RENDEREXPOSURE" id="renderexposure" 			 value="renderexposure" 			 style= "background-image:url('Commandline icons/renderexposure.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	RENDEREXPOSURE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RENDERING(FACETRES)" id="renderingfacetres" 				 value="renderingfacetres" 				 style= "background-image:url('Commandline icons/renderingfacetres.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	RENDERING(FACETRES)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RENDERPRESETS" id="renderpresets" 			 value="renderpresets" 			 style= "background-image:url('Commandline icons/renderpresets.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	RENDERPRESETS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="(-RENDERPRESETS)" id="-renderpresets" 			 value="-renderpresets" 			 style= "background-image:url('Commandline icons/-renderpresets.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	(-RENDERPRESETS)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RENDERWINDOW" id="renderwindow" 			 value="renderwindow" 			 style= "background-image:url('Commandline icons/renderwindow.png');background-repeat:no-repeat; text-indent: 30px;" 			data-display="true" data-highlight="false">	RENDERWINDOW	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REPEAT" id="repeat" 					 value="repeat" 					 style= "background-image:url('Commandline icons/repeat.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	REPEAT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REPURLS" id="repurls" 				 value="repurls" 				 style= "background-image:url('Commandline icons/repurls.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	REPURLS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RESETBLOCK" id="resetblock" 				 value="resetblock" 				 style= "background-image:url('Commandline icons/resetblock.png');background-repeat:no-repeat; text-indent: 30" 					data-display="true" data-highlight="false">	RESETBLOCK	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RESUME" id="resume" 					 value="resume" 					 style= "background-image:url('Commandline icons/resume.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	RESUME	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REV(REVOLVE)" id="revrevolve" 					 value="revrevolve" 					 style= "background-image:url('Commandline icons/revrevolve.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	REV(REVOLVE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REVCLOUD" id="revcloud" 				 value="revcloud" 				 style= "background-image:url('Commandline icons/revcloud.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	REVCLOUD	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REVERSE" id="reverse" 				 value="reverse" 				 style= "background-image:url('Commandline icons/reverse.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	REVERSE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REVERT" id="revert" 					 value="revert" 					 style= "background-image:url('Commandline icons/revert.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	REVERT 	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="REVSURF" id="revsurf" 				 value="revsurf" 				 style= "background-image:url('Commandline icons/revsurf.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	REVSURF	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RIBBON" id="ribbon" 					 value="ribbon" 					 style= "background-image:url('Commandline icons/ribbon.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	RIBBON	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RIBBONCLOSE" id="ribbonclose"	 			 value="ribbonclose"	 			 style= "background-image:url('Commandline icons/ribbonclose.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	RIBBONCLOSE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ROTATE" id="rotate" 					 value="rotate" 					 style= "background-image:url('Commandline icons/rotate.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	ROTATE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ROTATE3D" id="rotate3d" 				 value="rotate3d" 				 style= "background-image:url('Commandline icons/rotate3d.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	ROTATE3D	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RMAT(MATBROWSEROPEN)" id="rmatmatbrowseropen" 					 value="rmatmatbrowseropen" 					 style= "background-image:url('Commandline icons/rmatmatbrowseropen.png');background-repeat:no-repeat; text-indent: 30px;" 		data-display="true" data-highlight="false">	RMAT(MATBROWSEROPEN)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RO(ROTATE)" id="rotate" 						 value="rotate" 						 style= "background-image:url('Commandline icons/rorotate.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	RO(ROTATE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ROTATE 3D" id="rotate3d" 				 value="rotate3d" 				 style= "background-image:url('Commandline icons/rotate3d.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	ROTATE 3D	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ROUND (FILLET)" id="roundfillet" 					 value="roundfillet" 					 style= "background-image:url('Commandline icons/roundfillet.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	ROUND (FILLET)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RPR(RPREF)" id="rprrpref" 					 value="rprrpref" 					 style= "background-image:url('Commandline icons/rprrpref.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	RPR(RPREF)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RPREFCLOSE" id="rprefclose" 				 value="rprefclose" 				 style= "background-image:url('Commandline icons/rprefclose.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	RPREFCLOSE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RSCRIPT" id="rscript" 				 value="rscript" 				 style= "background-image:url('Commandline icons/rscript.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	RSCRIPT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RTEDIT" id="rtedit" 					 value="rtedit" 					 style= "background-image:url('Commandline icons/rtedit.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	RTEDIT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RTEXT" id="rtext" 					 value="rtext" 					 style= "background-image:url('Commandline icons/rtext.png');background-repeat:no-repeat; text-indent: 30px;" 					data-display="true" data-highlight="false">	RTEXT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RTEXTAPP" id="rtextapp" 				 value="rtextapp" 				 style= "background-image:url('Commandline icons/rtextapp.png');background-repeat:no-repeat; text-indent: 30px;" 				data-display="true" data-highlight="false">	RTEXTAPP	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RTPAN" id="rtpan" value="rtpan" style= "background-image:url('Commandline icons/rtpan.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	RTPAN	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RTUCS" id="rtucs" value="rtucs" style= "background-image:url('Commandline icons/rtucs.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	RTUCS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RTZOOM" id="rtzoom" value="rtzoom" style= "background-image:url('Commandline icons/rtzoom.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	RTZOOM	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="RULESURF" id="rulesurf" value="rulesurf" style= "background-image:url('Commandline icons/rulesurf.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	RULESURF	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="S(STRETCH)" id="stretch"   value="stretch" style= "background-image:url('Commandline icons/sstretch.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	S(STRETCH)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SAVE" id="save" value="save" style= "background-image:url('Commandline icons/save.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SAVE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SAVEALL" id="saveall" value="saveall" style= "background-image:url('Commandline icons/saveall .png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SAVEALL 	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SAVEAS" id="saveas" value="saveas" style= "background-image:url('Commandline icons/saveas.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SAVEAS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SAVEIMG" id="saveimg" value="saveimg" style= "background-image:url('Commandline icons/saveimg.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SAVEIMG	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SAVETOCLOUD" id="savetocloud" value="savetocloud" style= "background-image:url('Commandline icons/savetocloud.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SAVETOCLOUD	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SAVEFILE" id="savefile" value="savefile" style= "background-image:url('Commandline icons/savefile.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SAVEFILE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SC(SCALE)" id="scscale"  value="scscale" style= "background-image:url('Commandline icons/scscale.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SC(SCALE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SCALELISTEDIT" id="scalelistedit" value="scalelistedit" style= "background-image:url('Commandline icons/scalelistedit.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SCALELISTEDIT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SCALETEXT" id="scaletext" value="scaletext" style= "background-image:url('Commandline icons/scaletext.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SCALETEXT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SCR( SCRIPT)" id="scrscript" value="scrscript" style= "background-image:url('Commandline icons/scrscript.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	SCR( SCRIPT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SCRIPTCALL" id="scriptcall" value="scriptcall" style= "background-image:url('Commandline icons/scriptcall.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SCRIPTCALL	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SE(DSETTINGS)" id="sedsettings"  value="sedsettings" style= "background-image:url('Commandline icons/sedsettings.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SE(DSETTINGS)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SEC(SECTION)" id="secsection" value="secsection" style= "background-image:url('Commandline icons/secsection.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SEC(SECTION)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SECTIONPLANE" id="sectionplane" value="sectionplane" style= "background-image:url('Commandline icons/sectionplane.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SECTIONPLANE 	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SECTIONPLANEJOG" id="sectionplanejog" value="sectionplanejog" style= "background-image:url('Commandline icons/sectionplanejog.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SECTIONPLANEJOG	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SECTIONPLANESETTINGS" id="sectionplanesettings" value="sectionplanesettings" style= "background-image:url('Commandline icons/sectionplanesettings.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SECTIONPLANESETTINGS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SECTIONPLANETOBLOCK" id="sectionplanetoblock" value="sectionplanetoblock" style= "background-image:url('Commandline icons/sectionplanetoblock.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SECTIONPLANETOBLOCK	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SECTIONSPINNERS" id="sectionspinners" value="sectionspinners" style= "background-image:url('Commandline icons/sectionspinners.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SECTIONSPINNERS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SECURITYOPTIONS" id="securityoptions" value="securityoptions" style= "background-image:url('Commandline icons/securityoptions.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SECURITYOPTIONS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SEEK" id="seek" value="seek" style= "background-image:url('Commandline icons/Seek.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SEEK	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SELECT" id="select" value="select" style= "background-image:url('Commandline icons/Select.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SELECT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SELECTSIMILAR" id="selectsimilar" value="selectsimilar" style= "background-image:url('Commandline icons/selectsimilar.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SELECTSIMILAR	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SELECTURLS" id="selecturls" value="selecturls" style= "background-image:url('Commandline icons/selecturls.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SELECTURLS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SEND(ETRANSMIT)" id="sendetransmit" value="send" style= "background-image:url('Commandline icons/sendetransmit.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SEND(ETRANSMIT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SETBYLAYER" id="setbylayer" value="setbylayer" style= "background-image:url('Commandline icons/setbylayer.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SETBYLAYER	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SETIDROPHANDLER" id="setidrophandler" value="setidrophandler" style= "background-image:url('Commandline icons/setidrophandler.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SETIDROPHANDLER	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SEQUENCEPLAY" id="sequenceplay" value="sequenceplay" style= "background-image:url('Commandline icons/sequenceplay.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SEQUENCEPLAY	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SETTINGS(OPTIONS)" id="settingsoptions" value="settingsoptions" style= "background-image:url('Commandline icons/settingsoptions.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SETTINGS(OPTIONS)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SETUV(MATERIALMAP)" id="setuvmaterialmap" value="setuvmaterialmap" style= "background-image:url('Commandline icons/setuvmaterialmap.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SETUV(MATERIALMAP)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SETVAR(SETVARIABLE)" id="setvarsetvariable" value="setvarsetvariable" style= "background-image:url('Commandline icons/setvarsetvariable.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SETVAR(SETVARIABLE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SETXREFCONFIG" id="setxrefconfig" value="setxrefconfig" style= "background-image:url('Commandline icons/setxrefconfig.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SETXREFCONFIG	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SH" id="sh"  value="sh" style= "background-image:url('Commandline icons/Sh.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SH	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SHA(SHADEMODE)" id="SHASHADEMODE" value="SHASHADEMODE" style= "background-image:url('Commandline icons/shashademode.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SHA(SHADEMODE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SHADE" id="shade" value="shade" style= "background-image:url('Commandline icons/Shade.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SHADE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SHAPE" id="shape" value="shape" style= "background-image:url('Commandline icons/Shape.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SHAPE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SHARE" id="share" value="share" style= "background-image:url('Commandline icons/Share.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	SHARE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SHAREWITHSEEK" id="sharewithseek" value="sharewithseek" style= "background-image:url('Commandline icons/sharewithseek.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SHAREWITHSEEK	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SHEET(LAYOUT)" id="sheetlayout" value="sheetlayout" style= "background-image:url('Commandline icons/sheetlayout.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SHEET(LAYOUT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SHEETSET" id="sheetset" value="sheetset" style= "background-image:url('Commandline icons/Sheetset.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SHEETSET	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SHEETSETHIDE" id="sheetsethide" value="sheetsethide" style= "background-image:url('Commandline icons/sheetsethide.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SHEETSETHIDE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SHELL" id="shell" value="shell" style= "background-image:url('Commandline icons/Shell.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SHELL	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SHOWPALETTES" id="showpalettes" value="showpalettes" style= "background-image:url('Commandline icons/showpalettes.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SHOWPALETTES	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SHOWRENDERGALLERY" id="showrendergallery" value="showrendergallery" style= "background-image:url('Commandline icons/showrendergallery.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SHOWRENDERGALLERY	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SHOWURLS" id="showurls" value="showurls" style= "background-image:url('Commandline icons/showurls.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SHOWURLS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SHOWMAT(LIST)" id="showmatlist" value="showmatlist" style= "background-image:url('Commandline icons/showmatlist.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SHOWMAT(LIST)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SHP2BLK" id="shp2blk" value="shp2blk" style= "background-image:url('Commandline icons/shp2blk.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SHP2BLK	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SIGVALIDATE" id="sigvalidate" Value="sigvalidate" style= "background-image:url('Commandline icons/sigvalidate.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SIGVALIDATE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SKETCH" id="sketch" value="sketch" style= "background-image:url('Commandline icons/Sketch.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SKETCH	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SKYSTATUS" id="skystatus" value="skystatus" style= "background-image:url('Commandline icons/skystatus.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SKYSTATUS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SL(SLICE)" id="slslice"  value="slslice" style= "background-image:url('Commandline icons/slslice.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SL(SLICE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SMOOTH(MESHSMOOTH)" id="smoothmeshsmooth" value="smoothmeshsmooth" style= "background-image:url('Commandline icons/smoothmeshsmooth.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SMOOTH(MESHSMOOTH)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SMOOTHNESS(FACETRES)" id="smoothnessfacetres" value="smoothnessfacetres" style= "background-image:url('Commandline icons/smoothnessfacetres.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SMOOTHNESS(FACETRES)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SN(SNAP)" id="snsnap"  value="snsnap" style= "background-image:url('Commandline icons/snsnap.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SN(SNAP)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SO(SOLID)" id="sosolid"  value="sosolid" style= "background-image:url('Commandline icons/sosolid.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SO(SOLID)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SOLDRAW" id="soldraw" value="soldraw" style= "background-image:url('Commandline icons/Soldraw.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SOLDRAW	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SOLVIEW" id="solview" value="solview" style= "background-image:url('Commandline icons/Solview.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SOLVIEW	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SOLIDEDIT" id="solidedit" value="solidedit" style= "background-image:url('Commandline icons/solidedit.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SOLIDEDIT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SOLIDFILL(HATCH)" id="solidfillhatch" value="solidfillhatch" style= "background-image:url('Commandline icons/solidfillhatch.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SOLIDFILL(HATCH)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SOLPROF" id="solprof" value="solprof" style= "background-image:url('Commandline icons/Solprof.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SOLPROF	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SP(SPELL)" id="spspell" value="spspell" style= "background-image:url('Commandline icons/spspell.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SP(SPELL)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SPACETRANS" id="spacetrans" value="spacetrans" style= "background-image:url('Commandline icons/spacetrans.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SPACETRANS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SPE(SPLINEDIT)" id="spesplinedit"  value="spesplinedit" style= "background-image:url('Commandline icons/spesplinedit.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SPE(SPLINEDIT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="STANDARDS" id="checkstandards" value="checkstandards" style= "background-image:url('Commandline icons/standards.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	STANDARDS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SPHERE" id="sphere" value="sphere" style= "background-image:url('Commandline icons/Sphere.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SPHERE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SPIRAL(HELIX)" id="spiral" value="spiral" style= "background-image:url('Commandline icons/spiralhelix.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SPIRAL(HELIX)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SPL(SPLINE)" id="spline" value="spline" style= "background-image:url('Commandline icons/splspline.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SPL(SPLINE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SPLIT(MESHSPLIT)" id="split" value="split" style= "background-image:url('Commandline icons/splitmeshsplit.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SPLIT(MESHSPLIT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SPOTLIGHT" id="spotlight" value="spotlight" style= "background-image:url('Commandline icons/spotlight.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SPOTLIGHT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SSX" id="ssx" value="ssx" style= "background-image:url('Commandline icons/Ssx.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SSX	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ST(STYLE)" id="st"  value="st" style= "background-image:url('Commandline icons/ststyle.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ST(STYLE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="STA(STANDARD)" id="sta" value="sta" style= "background-image:url('Commandline icons/stastandard.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	STA(STANDARD)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="START" id="start" value="start" style= "background-image:url('Commandline icons/start.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	START	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="STATUS" id="status" value="status" style= "background-image:url('Commandline icons/status.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	STATUS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="STENCIL(INSERT)" id="stencil" value="stencil" style= "background-image:url('Commandline icons/stencilinsert.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	STENCIL(INSERT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="STEPPED(OFFSET)" id="stepped" value="stepped" style= "background-image:url('Commandline icons/steppedoffset.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	STEPPED(OFFSET)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="STLOUT" id="stlout" value="stlout" style= "background-image:url('Commandline icons/Stlout.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	STLOUT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="STYLESMANAGER" id="stylesmanager" value="stylesmanager" style= "background-image:url('Commandline icons/stylesmanager.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	STYLESMANAGER	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SU(SUBTRACT)" id="su" value="su" style= "background-image:url('Commandline icons/susubtract.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SU(SUBTRACT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SUNPROPERTIES" id="sunproperties" value="sunproperties" style= "background-image:url('Commandline icons/Sunproperties.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SUNPROPERTIES	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SUNPROPERTIESCLOSE" id="sunpropertiesclose" value="sunpropertiesclose" style= "background-image:url('Commandline icons/sunpropertiesclose.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SUNPROPERTIESCLOSE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SUNSTATUS" id="sunstatus" value="sunstatus" style= "background-image:url('Commandline icons/Sunstatus.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SUNSTATUS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SUPERHATCH" id="superhatch" value="superhatch" style= "background-image:url('Commandline icons/Superhatch.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SUPERHATCH	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SURFACEAUTOTRIM" id="auto_trim" value="auto_trim" style= "background-image:url('Commandline icons/surfaceautotrim.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SURFACEAUTOTRIM	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SURFBLEND" id="blendsrf" value="blendsrf" style= "background-image:url('Commandline icons/Surfblend.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SURFBLEND	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SURFEXTEND" id="extendsrfsurfextend" value="extendsrfsurfextend" style= "background-image:url('Commandline icons/Surfextend.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SURFEXTEND	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SURFEXTRACTCURVE" id="extract_isolines" value="extract_isolines" style= "background-image:url('Commandline icons/surfextractcurve.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SURFEXTRACTCURVE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SURFFILLET" id="filletsrfsurffillet" value="filletsrfsurffillet" style= "background-image:url('Commandline icons/Surffillet.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SURFFILLET	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SURFNETWORK" id="network" value="network" style= "background-image:url('Commandline icons/Surfnetwork.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SURFNETWORK	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SURFOFFSET" id="offset-surface" value="offset-surface" style= "background-image:url('Commandline icons/Surfoffset.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SURFOFFSET	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SURFPATCH" id="patch" value="patch" style= "background-image:url('Commandline icons/Surfpatch.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SURFPATCH	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SURFSCULPT" id="sculpt" value="sculpt" style= "background-image:url('Commandline icons/Surfsculpt.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SURFSCULPT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SURFTRIM" id="trim-surface" value="trim-surface" style= "background-image:url('Commandline icons/Surftrim.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SURFTRIM	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SURFUNTRIM" id="untrim" value="untrim" style= "background-image:url('Commandline icons/Surfuntrim.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SURFUNTRIM	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SURFACEASSOCIATIVITY" id="surface_associativity" value="surface_associativity" style= "background-image:url('Commandline icons/surfaceassociativity.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SURFACEASSOCIATIVITY	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SURFACEMODELLINGMODE" id="nurbs_creation" value="nurbs_creation" style= "background-image:url('Commandline icons/surfacemodellingmode.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SURFACEMODELLINGMODE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SWEEP" id="sweep" value="sweep" style= "background-image:url('Commandline icons/Sweep.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SWEEP	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SYSDLG" id="sysdlg" value="sysdlg" style= "background-image:url('Commandline icons/sysdlg.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SYSDLG	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SYSVARMONITOR" id="sysvarmonitor" value="sysvarmonitor" style= "background-image:url('Commandline icons/sysvarmonitor.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SYSVARMONITOR	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="SYSWINDOWS" id="tile_vertically" value="tile_vertically" style= "background-image:url('Commandline icons/syswindows.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	SYSWINDOWS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="T(TEXT)" id="single_line" value="single_line" style= "background-image:url('Commandline icons/ttext.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	T(TEXT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TA(TEXTALIGN)" id="text_align" value="text_align" style= "background-image:url('Commandline icons/tatextalign.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TA(TEXTALIGN)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TABLE" id="table" value="table" style= "background-image:url('Commandline icons/table.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TABLE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TABLEDIT" id="tabledit" value="tabledit" style= "background-image:url('Commandline icons/tabledit.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TABLEDIT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TABLEEXPORT" id="tableexport" value="tableexport" style= "background-image:url('Commandline icons/tableexport.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TABLEEXPORT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TABLESTYLE" id="table_style" value="table_style" style= "background-image:url('Commandline icons/tablestyle.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TABLESTYLE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TABLET" id="calibrate" value="calibrate" style= "background-image:url('Commandline icons/tablet.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TABLET	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TABSURF" id="modelling_meshes_tabulate_surface" value="modelling_meshes_tabulate_surface" style= "background-image:url('Commandline icons/tabsurf.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TABSURF	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TAKEAPART(EXPLODE)" id="takeapart" value="takeapart" style= "background-image:url('Commandline icons/takeapartexplode.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TAKEAPART(EXPLODE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TARGETPOINT" id="targetpoint" value="targetpoint" style= "background-image:url('Commandline icons/targetpoint.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TARGETPOINT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TASKBAR" id="taskbar" value="taskbar" style= "background-image:url('Commandline icons/taskbar.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TASKBAR	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TBCONFIG" id="tbconfig" value="tbconfig" style= "background-image:url('Commandline icons/tbconfig.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TBCONFIG	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TCASE" id="change_text_case" value="change_text_case" style= "background-image:url('Commandline icons/tcase.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TCASE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TCIRCLE" id="enclose_text_with_object" value="enclose_text_with_object" style= "background-image:url('Commandline icons/tcircle.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TCIRCLE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TCOUNT" id="automatic_text_numbering" value="automatic_text_numbering" style= "background-image:url('Commandline icons/tcount.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TCOUNT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TEDIT" id="tedit" value="tedit" style= "background-image:url('Commandline icons/tedit.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TEDIT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TEMPORARYLINE(RAY)" id="temporaryline" value="temporaryline" style= "background-image:url('Commandline icons/temporarylineray.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TEMPORARYLINE(RAY)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TESSELATIONS(ISOLINES)" id="isolines" value="isolines" style= "background-image:url('Commandline icons/tesselationsisolines.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TESSELATIONS(ISOLINES)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TEXT" id="single_line" value="single_line" style= "background-image:url('Commandline icons/text.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TEXT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TEXTTOFRONT" id="text_objects_only" value="text_objects_only" style= "background-image:url('Commandline icons/texttofront.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TEXTTOFRONT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TEXTFIT" id="text_fit" value="text_fit" style= "background-image:url('Commandline icons/textfit.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TEXTFIT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TEXTMASK" id="text_mask" value="text_mask" style= "background-image:url('Commandline icons/textmask.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TEXTMASK	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TEXTSCR" id="textscr" value="textscr" style= "background-image:url('Commandline icons/textscr.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TEXTSCR	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TEXTUNMASK" id="unmask_text" value="unmask_text" style= "background-image:url('Commandline icons/textunmask.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TEXTUNMASK	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TFHELP" id="tfhelp" value="tfhelp" style= "background-image:url('Commandline icons/tfhelp.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TFHELP	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TFRAMES" id="tframes" value="tframes" style= "background-image:url('Commandline icons/tframes.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TFRAMES	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="THICKEN" id="thicken" value="thicken" style= "background-image:url('Commandline icons/thicken.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	THICKEN	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="THICKNESS" id="thickness" value="thickness" style= "background-image:url('Commandline icons/thickness.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	THICKNESS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="THREAD(HELIX)" id="thread" value="thread" style= "background-image:url('Commandline icons/threadhelix.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	THREAD(HELIX)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="THUMBSAVE" id="thumbsave" value="thumbsave" style= "background-image:url('Commandline icons/thumbsave.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	THUMBSAVE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="THUMBSIZE" id="thumbsize" value="thumbsize" style= "background-image:url('Commandline icons/thumbsize.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	THUMBSIZE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TIFFIN" id="tiffin" value="tiffin" style= "background-image:url('Commandline icons/tiffin.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TIFFIN	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TIFOUT" id="tifout" value="tifout" style= "background-image:url('Commandline icons/tifout.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TIFOUT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TIME" id="time" value="time" style= "background-image:url('Commandline icons/time.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TIME	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TINSERT" id="DDINSERTINSERT" value="DDINSERTINSERT" style= "background-image:url('Commandline icons/tinsert.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TINSERT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TJUST" id="justify_text" value="justify_text" style= "background-image:url('Commandline icons/tjust.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TJUST	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TO(TOOLBAR)" id="to"  value="to" style= "background-image:url('Commandline icons/totoolbar.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TO(TOOLBAR)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TOL(TOLERANCE)" id="tolerance" value="tolerance"  style= "background-image:url('Commandline icons/toltolerance.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TOL(TOLERANCE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TOOLPALETTESCLOSE" id="toolpalettesclose" value="toolpalettesclose" style= "background-image:url('Commandline icons/toolpalettesclose.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TOOLPALETTESCLOSE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TOOLPALETTES" id="tool_palette" value="tool_palette" style= "background-image:url('Commandline icons/toolpalettes.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TOOLPALETTES	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TOR(TORUS)" id="torus" value="torus" style= "background-image:url('Commandline icons/tortorus.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TOR(TORUS)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TORIENT" id="rotate_text" value="rotate_text" style= "background-image:url('Commandline icons/torient.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TORIENT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TPNAVIGATE" id="tpnavigate" value="tpnavigate" style= "background-image:url('Commandline icons/tpnavigate.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TPNAVIGATE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TR(TRIM)" id="trim"  value="trim" style= "background-image:url('Commandline icons/trtrim.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TR(TRIM)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TRANSMIT(ETRANSMIT)" id="etransmit" value="etransmit" style= "background-image:url('Commandline icons/transmitetransmit.png');background-repeat:no-repeat; text-indent: 30px;"  data-display="true" data-highlight="false">	TRANSMIT(ETRANSMIT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TRANSPARENCY" id="transparency" value="transparency" style= "background-image:url('Commandline icons/transparency.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TRANSPARENCY	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TRAYSETTINGS" id="traysettings" value="traysettings" style= "background-image:url('Commandline icons/traysettings.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TRAYSETTINGS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TREESTAT" id="treestat"  value="treestat" style= "background-image:url('Commandline icons/treestat.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TREESTAT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TREX" id="trex" value="trex" style= "background-image:url('Commandline icons/trex.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TREX	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TSCALE" id="pstscale" value="pstscale" style= "background-image:url('Commandline icons/tscale.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TSCALE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TSPACEINVADERS" id="tspaceinvaders" value="tspaceinvaders" style= "background-image:url('Commandline icons/tspaceinvaders.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TSPACEINVADERS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TUTCLEAR" id="tutclear" value="tutclear" style= "background-image:url('Commandline icons/tutclear.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TUTCLEAR	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TUTDEMO" id="tutdemo" value="tutdemo" style= "background-image:url('Commandline icons/tutdemo.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TUTDEMO	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TXT2MTXT" id="combine_text" value="combine_text" style= "background-image:url('Commandline icons/txt2mtxt.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TXT2MTXT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TXTEXP" id="explode_text" value="explode_text" style= "background-image:url('Commandline icons/txtexp.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TXTEXP	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="TYPE" id="type" value="type" style= "background-image:url('Commandline icons/type.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	TYPE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="U" id="u"   value="u" style= "background-image:url('Commandline icons/u.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	U	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="UNDO" id="undo" value="undo" style= "background-image:url('Commandline icons/undo.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	UNDO	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="UCS" id="ucs" value="ucs" style= "background-image:url('Commandline icons/ucs.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	UCS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="UNITE (JOIN)" id="unite" value="unite" style= "background-image:url('Commandline icons/unitejoin.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	UNITE (JOIN)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="UNDEFINE" id="undefine" value="undefine" style= "background-image:url('Commandline icons/undefine.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	UNDEFINE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="UNI (UNION)" id="union" value="union" style= "background-image:url('Commandline icons/uniunion.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	UNI (UNION)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="UN (UNITS)" id="units" value="units" style= "background-image:url('Commandline icons/ununits.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	UN (UNITS)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="UCSICON" id="ucsicon_properties" value="ucsicon_properties" style= "background-image:url('Commandline icons/ucsicon.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	UCSICON	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="UNGROUP" id="ungroup" value="ungroup" style= "background-image:url('Commandline icons/ungroup.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	UNGROUP	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="UNHIDE(UNISOLATEOBJECTS)" id="end_object_isolation" value="end_object_isolation" style= "background-image:url('Commandline icons/unhideunisolateobjects.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	UNHIDE(UNISOLATEOBJECTS)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="UOSNAP" id="snap_to_underlay_off" value="snap_to_underlay_off" style= "background-image:url('Commandline icons/uosnap.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	UOSNAP	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="UPDATEFIELD" id="update_fields" value="update_fields" style= "background-image:url('Commandline icons/updatefield.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	UPDATEFIELD	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="UPDATETHUBSHOW" id="updatethubshow" value="updatethubshow" style= "background-image:url('Commandline icons/updatethubshow.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	UPDATETHUBSHOW	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="UC(UCSMAN)" id="ucs_nameducs" value="ucs_nameducs" style= "background-image:url('Commandline icons/ucucsman.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	UC(UCSMAN)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="UNCREASE (MESHUNCREASE)" id="remove_crease" value="remove_crease" style= "background-image:url('Commandline icons/uncreasemeshuncrease.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	UNCREASE (MESHUNCREASE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ULAYERS" id="underlay_layers" value="underlay_layers" style= "background-image:url('Commandline icons/ulayers.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ULAYERS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="UPDATETHUMBSNOW" id="updatethumbsnow" value="updatethumbsnow" style= "background-image:url('Commandline icons/updatethumbsnow.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	UPDATETHUMBSNOW	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="V (VIEW)" id="view"   value="view" style= "background-image:url('Commandline icons/vview.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	V (VIEW)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VS (VSCURRENT)" id="vs"  value="vs" style= "background-image:url('Commandline icons/vsvscurrent.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VS (VSCURRENT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VPLAYER" id="vplayer" value="vplayer" style= "background-image:url('Commandline icons/vplayer.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VPLAYER	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VPMAX" id="vpmax" value="vpmax" style= "background-image:url('Commandline icons/vpmax.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VPMAX	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VIEWRES" id="viewres" value="viewres" style= "background-image:url('Commandline icons/viewres.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VIEWRES	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VP (VPOINT)" id="ddvpointvpoint"  value="ddvpointvpoint" style= "background-image:url('Commandline icons/vpvpoint.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VP (VPOINT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VIEWPLOTDETAILS" id="view_details" value="view_details" style= "background-image:url('Commandline icons/viewplotdetails.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VIEWPLOTDETAILS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VOLUME (MASSPROP)" id="region_mass_properties" value="region_mass_properties" style= "background-image:url('Commandline icons/volumemassprop.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VOLUME (MASSPROP)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VPMIN" id="vpmin" value="vpmin" style= "background-image:url('Commandline icons/vpmin.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VPMIN	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VPORTS" id="single" value="single" style= "background-image:url('Commandline icons/vports.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VPORTS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VBARUN" id="run_vba_macro" value="run_vba_macro" style= "background-image:url('Commandline icons/vbarun.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VBARUN	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VSSHADOWS" id="no_shadows" value="no_shadows" style= "background-image:url('Commandline icons/vsshadows.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VSSHADOWS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VASMATERIALMODE" id="vasmaterialmode" value="vasmaterialmode" style= "background-image:url('Commandline icons/vasmaterialmode.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VASMATERIALMODE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VSFACESTYLE" id="normal" value="normal" style= "background-image:url('Commandline icons/vsfacestyle.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VSFACESTYLE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VSEDGES" id="noedges" value="noedges" style= "background-image:url('Commandline icons/vsedges.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VSEDGES	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VSEDGEJITTER" id="vsedgejitter" value="vsedgejitter" style= "background-image:url('Commandline icons/vsedgejitter.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VSEDGEJITTER	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VSLIGHTINGQUALITY" id="vslightingquality" value="vslightingquality" style= "background-image:url('Commandline icons/vslightingquality.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VSLIGHTINGQUALITY	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VSFACECOLORMODE" id="normal" value="normal" style= "background-image:url('Commandline icons/vsfacecolormode.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VSFACECOLORMODE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VSFACEOPACITY" id="vsfaceopacity" value="vsfaceopacity" style= "background-image:url('Commandline icons/vsfaceopacity.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VSFACEOPACITY	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VISUALSTYLES" id="visualstyles" value="visualstyles" style= "background-image:url('Commandline icons/visualstyles.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VISUALSTYLES	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VBARUN" id="run_vba_macro" value="run_vba_macro" style= "background-image:url('Commandline icons/vbarun.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VBARUN	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VSLIDE" id="vslide" value="vslide" style= "background-image:url('Commandline icons/vslide.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VSLIDE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VIEWBASE" id="viewbase" value="viewbase" style= "background-image:url('Commandline icons/viewbase.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VIEWBASE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VIEWSTD" id="viewstd" value="viewstd" style= "background-image:url('Commandline icons/viewstd.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VIEWSTD	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VPCLIP" id="vpclip" value="vpclip" style= "background-image:url('Commandline icons/vpclip.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VPCLIP	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VIEWEDIT" id="viewedit" value="viewedit" style= "background-image:url('Commandline icons/viewedit.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VIEWEDIT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VIEWPORTS" id="viewports" value="viewports" style= "background-image:url('Commandline icons/viewports.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VIEWPORTS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VBASTMT" id="VBASTMT" value="VBASTMT" style= "background-image:url('Commandline icons/vbastmt.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VBASTMT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VBAUNLOAD" id="vbaunload" value="vbaunload" style= "background-image:url('Commandline icons/vbaunload.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VBAUNLOAD	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VBAIDE" id="visual_basic_editor" value="visual_basic_editor" style= "background-image:url('Commandline icons/vbaide.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VBAIDE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VIEWUPDATE" id="viewupdate" value="viewupdate" style= "background-image:url('Commandline icons/viewupdate.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VIEWUPDATE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VIEWPROJ" id="viewproj" value="viewproj" style= "background-image:url('Commandline icons/viewproj.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VIEWPROJ	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VBALOAD" id="load_project" value="load_project" style= "background-image:url('Commandline icons/vbaload.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VBALOAD	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VISUALSTYLESCLOSE" id="visualstylesclose" value="visualstylesclose" style= "background-image:url('Commandline icons/visualstylesclose.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VISUALSTYLESCLOSE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VBAMAN" id="vba_manager" value="vba_manager" style= "background-image:url('Commandline icons/vbaman.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VBAMAN	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VIEWPLAY" id="viewplay" value="viewplay" style= "background-image:url('Commandline icons/viewplay.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VIEWPLAY	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VSEDGEOVERHANG" id="vsedgeoverhang" value="vsedgeoverhang" style= "background-image:url('Commandline icons/vsedgeoverhang.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VSEDGEOVERHANG	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VSSILHEDGES" id="vssilhedges" value="vssilhedges" style= "background-image:url('Commandline icons/vssilhedges.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VSSILHEDGES	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VSSAVE" id="vssave" value="vssave" style= "background-image:url('Commandline icons/vssave.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VSSAVE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VTOPTIONS" id="vtoptions" value="vtoptions" style= "background-image:url('Commandline icons/vtoptions.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VTOPTIONS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VGO (VIEWGO)" id="vgo" value="vgo" style= "background-image:url('Commandline icons/vgoviewgo.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VGO (VIEWGO)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VIEWSECTION" id="viewsection" value="viewsection" style= "background-image:url('Commandline icons/viewsection.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VIEWSECTION	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VIEWSETPROJ" id="viewsetproj" value="viewsetproj" style= "background-image:url('Commandline icons/viewsetproj.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VIEWSETPROJ	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VIEWSYMBOLSKETCH" id="viewsymbolsketch" value="viewsymbolsketch" style= "background-image:url('Commandline icons/viewsymbolsketch.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VIEWSYMBOLSKETCH	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VIEWDETAIL" id="viewdetail" value="viewdetail" style= "background-image:url('Commandline icons/viewdetail.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VIEWDETAIL	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VBANEW" id="vbanew" value="vbanew" style= "background-image:url('Commandline icons/vbanew.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VBANEW	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VIEWSECTIONSTYLE" id="viewsectionstyle" value="viewsectionstyle" style= "background-image:url('Commandline icons/viewsectionstyle.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VIEWSECTIONSTYLE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VBAPREF" id="vbapref" value="vbapref" style= "background-image:url('Commandline icons/vbapref.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VBAPREF	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VSMONOCOLOR" id="vsmonocolor" value="vsmonocolor" style= "background-image:url('Commandline icons/vsmonocolor.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VSMONOCOLOR	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VIEWSYMBOLSKETCH" id="viewsymbolsketch" value="viewsymbolsketch" style= "background-image:url('Commandline icons/viewsymbolsketch.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VIEWSYMBOLSKETCH	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VIEWDETAILSTYLE" id="viewdetailstyle" value="viewdetailstyle" style= "background-image:url('Commandline icons/viewdetailstyle.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VIEWDETAILSTYLE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VIEWSKETCHCLOSE" id="viewsketchclose" value="viewsketchclose" style= "background-image:url('Commandline icons/viewsketchclose.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VIEWSKETCHCLOSE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VIEWCOMPONENT" id="drawingviewcomponents" value="drawingviewcomponents" style= "background-image:url('Commandline icons/viewcomponent.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VIEWCOMPONENT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VAACEXPLORER" id="vaacexplorer" value="vaacexplorer" style= "background-image:url('Commandline icons/vaacexplorer.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VAACEXPLORER	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VAACRESTORE" id="vaacrestore" value="vaacrestore" style= "background-image:url('Commandline icons/vaacrestore.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VAACRESTORE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VARS2SCR" id="addvars2scr" value="addvars2scr" style= "background-image:url('Commandline icons/vars2scr.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VARS2SCR	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VLIDE" id="vlide" value="vlide" style= "background-image:url('Commandline icons/vlide.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VLIDE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VLISP" id="visual_lisp_editor" value="visual_lisp_editor" style= "background-image:url('Commandline icons/vlisp.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VLISP	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VPSCALE" id="list_viewport_scale" value="list_viewport_scale" style= "background-image:url('Commandline icons/vpscale.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VPSCALE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="VPSYNC" id="synchronize_viewports" value="synchronize_viewports" style= "background-image:url('Commandline icons/vpsync.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	VPSYNC	</li>
                     <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="W(WBLOCK)" id="write_block"   value="write_block" style= "background-image:url('Commandline icons/wwblock.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	W(WBLOCK)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="WALL (OFFSET)" id="offset" value="offset" style= "background-image:url('Commandline icons/walloffset.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	WALL (OFFSET)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="WSCURRENT" id="wscurrent" value="wscurrent" style= "background-image:url('Commandline icons/wscurrent.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	WSCURRENT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="WIPEOUT" id="wipeout" value="wipeout" style= "background-image:url('Commandline icons/wipeout.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	WIPEOUT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="WHEEL (NAVSWHEEL)" id="wheel" value="wheel" style= "background-image:url('Commandline icons/wheelnavswheel.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	WHEEL (NAVSWHEEL)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="WE (WEDGE)" id="wedge"  value="wedge" style= "background-image:url('Commandline icons/wewedge.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	WE (WEDGE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="WSSETTINGS" id="wssettings" value="wssettings" style= "background-image:url('Commandline icons/wssettings.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	WSSETTINGS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="WMFOUT" id="wmfout" value="wmfout" style= "background-image:url('Commandline icons/wmfout.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	WMFOUT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="WSSAVE" id="wssave" value="wssave" style= "background-image:url('Commandline icons/wssave.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	WSSAVE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="WMFIN" id="wmfin" value="wmfin" style= "background-image:url('Commandline icons/wmfin.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	WMFIN	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="WORKSPACE" id="workspace" value="workspace" style= "background-image:url('Commandline icons/workspace.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	WORKSPACE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="WEBLIGHT" id="weblight" value="weblight"  style= "background-image:url('Commandline icons/weblight.png');background-repeat:no-repeat; text-indent: 30px;"data-display="true" data-highlight="false">	WEBLIGHT	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="WALKFLYSETTINGS" id="walk_and_fly_settings" value="walk_and_fly_settings" style= "background-image:url('Commandline icons/walkflysettings.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	WALKFLYSETTINGS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="WHOHAS" id="whohas" value="whohas" style= "background-image:url('Commandline icons/whohas.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	WHOHAS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="WMFOPTS" id="wmfopts" value="wmfopts" style= "background-image:url('Commandline icons/wmfopts.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	WMFOPTS	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="WEBLOAD" id="webload" value="webload" style= "background-image:url('Commandline icons/webload.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	WEBLOAD	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="X (EXPLODE)" id="xexplode"   value="xexplode" style= "background-image:url('Commandline icons/xexplode.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	X (EXPLODE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="XL (XLINE)" id="xlxline"  value="xlxline" style= "background-image:url('Commandline icons/xlxline.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	XL (XLINE)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="XFER (XREF)" id="xferxref" value="xferxref" style= "background-image:url('Commandline icons/xferxref.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	XFER (XREF)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="XA(XATTACH)" id="xaxattach"  value="xaxattach" style= "background-image:url('Commandline icons/xaxattach.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	XA(XATTACH)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="XOPEN" id="xopen" value="xopen" style= "background-image:url('Commandline icons/xopen.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	XOPEN	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="XC(XCLIP)" id="xcxclip"  value="xcxclip" style= "background-image:url('Commandline icons/xcxclip.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	XC(XCLIP)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="XCLIPFRAME" id="xclipframe" value="xclipframe" style= "background-image:url('Commandline icons/xclipframe.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	XCLIPFRAME	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="XDWGFADECTL" id="xdwgfadectl" value="xdwgfadectl" style= "background-image:url('Commandline icons/xdwgfadectl.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	XDWGFADECTL	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="XEDGES" id="xedges" value="xedges" style= "background-image:url('Commandline icons/xedges.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	XEDGES	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="XB(XBIND)" id="xbxbind"  value="xbxbind" style= "background-image:url('Commandline icons/xbxbind.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	XB(XBIND)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="XDATA" id="attach_xdata" value="attach_xdata" style= "background-image:url('Commandline icons/xdata.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	XDATA	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="XDLIST" id="xdlist" value="xdlist" style= "background-image:url('Commandline icons/xdlist.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	XDLIST	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="XLIST" id="list_properties" value="list_properties" style= "background-image:url('Commandline icons/xlist.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	XLIST	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="XP" id="xp"  value="xp" style= "background-image:url('Commandline icons/xp.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	XP	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="XPLODE" id="xexplode" value="xexplode" style= "background-image:url('Commandline icons/xplode.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	XPLODE	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="Z (ZOOM)" id="zoomextents"   value="zoomextents"   style= "background-image:url('Commandline icons/zzoom.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	Z (ZOOM)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ZIP (ETRANSMIT)" id="zipetransmit" value="zipetransmit" style= "background-image:url('Commandline icons/zipetransmit.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ZIP (ETRANSMIT)	</li>
                       <li class="demo select-list-group__list-item" onclick="location.href='#openModal'"  name="ZEBRA (ANALYSISZEBRA)" id="zebra" value="zebra" style= "background-image:url('Commandline icons/zebraanalysiszebra.png');background-repeat:no-repeat; text-indent: 30px;" data-display="true" data-highlight="false">	ZEBRA (ANALYSISZEBRA)	</li>
                     </ul>
                     </li>
                     </ul>
                   </div>
        <div class="bottom" style="position:fixed;">
            <div class="BottomRibbon" style="position:fixed;">

                <ul>
                    <li><a id="coordinates1" href="#openPDF">&nbsp;&nbsp;<img src="BottomRibbon/30.png"></a></li>
                    <li><a id="ModelSpace" href="#openPDF">&nbsp;&nbsp;&nbsp;<img src="BottomRibbon/model.png"></a></li>
                    <li><a id="Grid" href="#openPDF">&nbsp;&nbsp;<img src="BottomRibbon/1.png"></a></li>
                    <li>&nbsp;&nbsp;<img src="BottomRibbon/2.png">
                        <ul>
                            <li><a id="SnapMode1" href="#openPDF"><img src="BottomRibbon/snap/1.png"></a></li>
                            <li><a id="SnapMode1" href="#openPDF"><img src="BottomRibbon/snap/2.png"></a></li>
                            <li><a id="SnapMode1" href="#draftSet3"><img src="BottomRibbon/snap/3.png"></a></li>
                        </ul>
                    </li>
                    <li><a id="InferConstraints" href="#openPDF">&nbsp;&nbsp;<img src="BottomRibbon/29.png"></a></li>
                    <li><a id="dynamicInput" href="#openPDF">&nbsp;&nbsp;<img src="BottomRibbon/31.png"></a></li>
                    <li><a id="OrthoMode" href="#openPDF">&nbsp;&nbsp;<img src="BottomRibbon/3.png"></a></li>
                    <li class="demo" value="PolarTracking" id="PolarTracking">&nbsp;&nbsp;<img src="BottomRibbon/4.png">
                        <ul>
                            <li><a id="PolarTracking" href="#openPDF"><img src="BottomRibbon/tracking/1.png"></a></li>
                            <li><a id="PolarTracking" href="#openPDF"><img src="BottomRibbon/tracking/2.png"></a></li>
                            <li><a id="PolarTracking" href="#openPDF"><img src="BottomRibbon/tracking/3.png"></a></li>
                            <li><a id="PolarTracking" href="#openPDF"><img src="BottomRibbon/tracking/4.png"></a></li>
                            <li><a id="PolarTracking" href="#openPDF"><img src="BottomRibbon/tracking/5.png"></a></li>
                            <li><a id="PolarTracking" href="#openPDF"><img src="BottomRibbon/tracking/6.png"></a></li>
                            <li><a id="PolarTracking" href="#openPDF"><img src="BottomRibbon/tracking/7.png"></a></li>
                            <li><a id="PolarTracking" href="#openPDF"><img src="BottomRibbon/tracking/8.png"></a></li>
                            <li><a href="#draftSet2"><img src="BottomRibbon/tracking/9.png"></a></li>
                        </ul>
                    </li>
                    <li id="IsometricDrafting">&nbsp;&nbsp;<img src="BottomRibbon/5.png">
                        <ul>
                            <li><a id="IsometricDrafting" href="#openPDF"><img src="BottomRibbon/isoplanes/1.png"></a>
                            </li>
                            <li><a id="IsometricDrafting" href="#openPDF"><img src="BottomRibbon/isoplanes/2.png"></a>
                            </li>
                            <li><a id="IsometricDrafting" href="#openPDF"><img src="BottomRibbon/isoplanes/3.png"></a>
                            </li>
                        </ul>
                    </li>
                    <li><a id="ObjectSnapTracking" href="#openPDF">&nbsp;&nbsp;<img src="BottomRibbon/6.png"></a></li>

                    <li><a id="2DObjectSnap" href="#">&nbsp;&nbsp;<img src="BottomRibbon/7.png"></a>
                        <ul>
                            <li><a id="2DObjectSnap" href="#"><img src="BottomRibbon/object snap/1.png"></a></li>
                            <li><a id="2DObjectSnap" href="#"><img src="BottomRibbon/object snap/2.png"></a></li>
                            <li><a id="2DObjectSnap" href="#"><img src="BottomRibbon/object snap/3.png"></a></li>
                            <li><a id="2DObjectSnap" href="#"><img src="BottomRibbon/object snap/4.png"></a></li>
                            <li><a id="2DObjectSnap" href="#"><img src="BottomRibbon/object snap/5.png"></a></li>
                            <li><a id="2DObjectSnap" href="#"><img src="BottomRibbon/object snap/6.png"></a></li>
                            <li><a id="2DObjectSnap" href="#"><img src="BottomRibbon/object snap/7.png"></a></li>
                            <li><a id="2DObjectSnap" href="#"><img src="BottomRibbon/object snap/8.png"></a></li>
                            <li><a id="2DObjectSnap" href="#"><img src="BottomRibbon/object snap/9.png"></a></li>
                            <li><a id="2DObjectSnap" href="#"><img src="BottomRibbon/object snap/10.png"></a>
                            </li>
                            <li><a id="2DObjectSnap" href="#"><img src="BottomRibbon/object snap/11.png"></a>
                            </li>
                            <li><a id="2DObjectSnap" href="#"><img src="BottomRibbon/object snap/12.png"></a>
                            </li>
                            <li><a id="2DObjectSnap" href="#"><img src="BottomRibbon/object snap/13.png"></a>
                            </li>
                            <li><a id="2DObjectSnap" href="#"><img src="BottomRibbon/object snap/14.png"></a>
                            </li>
                            <li><a href="#draftSet1"><img src="BottomRibbon/object snap/15.png"></a></li>
                        </ul>
                    </li>

                    <li><a id="LineWeight" href="#openPDF">&nbsp;&nbsp;<img src="BottomRibbon/28.png"></a></li>
                    <li><a id="Transparency" href="#openPDF">&nbsp;&nbsp;<img src="BottomRibbon/27.png"></a></li>
                    <li><a id="SelectionCycling" href="#openPDF">&nbsp;&nbsp;<img src="BottomRibbon/26.png"></a></li>
                    <li id="3DObjectSnap">&nbsp;&nbsp;<img src="BottomRibbon/25.png">
                        <ul>
                            <li><a id="3DObjectSnap" href="#openPDF"><img id="vertex" onclick="vertex()"
                                                                          src="BottomRibbon/3d objectsnap/1.png"></a>
                            </li>
                            <li><a id="3DObjectSnap" href="#openPDF"><img id="midpoint" onclick="midpoint()"
                                                                          src="BottomRibbon/3d objectsnap/2.png"></a>
                            </li>
                            <li onclick="center()"><a id="3DObjectSnap" href="#openPDF"><img id="center"
                                                                                             src="BottomRibbon/3d objectsnap/3.png"></a>
                            </li>
                            <li onclick="knot()"><a id="3DObjectSnap" href="#openPDF"><img id="knot"
                                                                                           src="BottomRibbon/3d objectsnap/4.png"></a>
                            </li>
                            <li onclick="perpendicular()"><a id="3DObjectSnap" href="#openPDF"><img id="perpendicular"
                                                                                                    src="BottomRibbon/3d objectsnap/5.png"></a>
                            </li>
                            <li onclick="nearest()"><a id="3DObjectSnap" href="#openPDF"><img id="nearest"
                                                                                              src="BottomRibbon/3d objectsnap/6.png"></a>
                            </li>
                            <li><a href="#draftSet"><img src="BottomRibbon/3d objectsnap/7.png"></a></li>
                        </ul>
                    </li>
                    <li><a id="DynamicUCS" href="#openPDF">&nbsp;&nbsp;<img src="BottomRibbon/24.png"></a></li>
                    <li id="SelectionFiltering">&nbsp;&nbsp;<img src="BottomRibbon/23.png">
                        <ul>
                            <li><a id="SelectionFiltering" href="#openPDF"><img
                                            src="BottomRibbon/object selection/1.png"></a></li>
                            <li><a id="SelectionFiltering" href="#openPDF"><img
                                            src="BottomRibbon/object selection/2.png"></a></li>
                            <li><a id="SelectionFiltering" href="#openPDF"><img
                                            src="BottomRibbon/object selection/3.png"></a></li>
                            <li><a id="SelectionFiltering" href="#openPDF"><img
                                            src="BottomRibbon/object selection/4.png"></a></li>
                            <li><a id="SelectionFiltering" href="#openPDF"><img
                                            src="BottomRibbon/object selection/5.png"></a></li>
                        </ul>
                    </li>
                    <li id="Gizmo">&nbsp;&nbsp;<img src="BottomRibbon/22.png">
                            <ul>
                                <li><a id="Gizmo" href="#openPDF"><img src="BottomRibbon/gizmos/1.png"></a></li>
                                <li><a id="Gizmo" href="#openPDF"><img src="BottomRibbon/gizmos/2.png"></a></li>
                                <li><a id="Gizmo" href="#openPDF"><img src="BottomRibbon/gizmos/3.png"></a></li>
                            </ul>
                    </li>
                    <li><a id="AnnotationVisibility" href="#openPDF">&nbsp;&nbsp;<img src="BottomRibbon/8.png"></a></li>
                    <li><a id="AutoScale" href="#openPDF">&nbsp;&nbsp;<img src="BottomRibbon/9.png"></a></li>
                    <li id="AnnotationScale">&nbsp;&nbsp;<img src="BottomRibbon/10.png">
                        <ul style="height:500px; overflow-y:auto;">
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/1.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/2.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/3.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/4.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/5.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/6.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/7.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/8.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/9.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/10.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/11.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/12.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/13.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/14.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/15.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/16.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/17.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/18.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/19.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/20.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/21.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/22.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/23.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/24.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/25.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/26.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/27.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/28.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/29.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/30.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/31.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/32.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/33.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/34.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/35.png"></a></li>
                            <li><a id="AnnotationScale" href="#openPDF"><img src="BottomRibbon/xrefs/36.png"></a></li>
                        </ul>
                    </li>

                    <li><a id="WorkspaceSwitching" href="#openPDF">&nbsp;&nbsp;<img src="BottomRibbon/12.png"></a>
                        <ul>
                            <li class="selector" value="1"><a href="#"><img src="BottomRibbon/settings/6.png"></a></li>
                            <li class="selector" value="2"><a href="#"><img src="BottomRibbon/settings/7.png"></a></li>
                            <li class="selector" value="3" style="border-bottom:1px solid #333;"><a href="#"><img
                                            src="BottomRibbon/settings/1.png"></a></li>
                            <li><a href="#saveAs"><img src="BottomRibbon/settings/2.png"></a></li>
                            <li><a href="#workspaceSettings"><img src="BottomRibbon/settings/3.png"></a></li>
                            <li><a href="#customize"><img src="BottomRibbon/settings/4.png"></a></li>
                            <li><a id="WorkspaceSwitching" href="#"><img src="BottomRibbon/settings/5.png"></a>
                            </li>
                        </ul>
                    </li>

                    <li><a id="AnnotationMonitor" href="#openPDF">&nbsp;&nbsp;<img src="BottomRibbon/13.png"></a></li>
                    <li><a id="Units" href="#">&nbsp;&nbsp;<img src="BottomRibbon/21.png"></a></li>
                    <li id="Units">&nbsp;&nbsp;<img src="BottomRibbon/20.png">
                        <ul>
                            <li><a id="Units" href="#"><img src="BottomRibbon/units/1.png"></a></li>
                            <li><a id="Units" href="#"><img src="BottomRibbon/units/2.png"></a></li>
                            <li><a id="Units" href="#"><img src="BottomRibbon/units/3.png"></a></li>
                            <li><a id="Units" href="#"><img src="BottomRibbon/units/4.png"></a></li>
                            <li><a id="Units" href="#"><img src="BottomRibbon/units/5.png"></a></li>
                        </ul>
                    </li>
                    <li><a id="QuickProperties" href="#openPDF">&nbsp;&nbsp;<img src="BottomRibbon/19.png"></a></li>
                    <li><a id="LockUI">&nbsp;&nbsp;<img src="BottomRibbon/18.png"></a>
                        <ul>
                            <li><a id="LockUI" href="#openPDF"><img id="toolbars" onclick="toolbars()"
                                                                                         src="BottomRibbon/lock/1.png"></a>
                            </li>
                            <li><a id="LockUI" href="#openPDF"><img id="docked" onclick="docked()" src="BottomRibbon/lock/2.png"></a>
                            </li>
                            <li><a id="LockUI" href="#openPDF"><img id="windows" onclick="windows()" src="BottomRibbon/lock/3.png"></a>
                            </li>
                            <li><a id="LockUI" href="#openPDF"><img id="floating" onclick="floating()" src="BottomRibbon/lock/4.png"></a>
                            </li>
                        </ul>
                    </li>
                    <li><a id="IsolateObjects" href="#openPDF">&nbsp;&nbsp;<img src="BottomRibbon/14.png"></a></li>
                    <li><a id="GraphicsPerformance" href="#openPDF">&nbsp;&nbsp;<img src="BottomRibbon/15.png"></a></li>
                    <li><a id="CleanScreen" href="#openPDF"><img src="BottomRibbon/16.png"></a></li>
                    <li>&nbsp;&nbsp;<img src="BottomRibbon/17.png">
                        <ul style="right:0px; height:600px; overflow-y:auto;">
                            <li onclick="ribbon()" style="border-bottom:1px solid #c1c1c1;"><a href="#"><img id="coord"
                                                                                                             src="BottomRibbon/customize/1b.png"></a>
                            </li>
                            <li onclick="model()" style="border-bottom:1px solid #c1c1c1;"><a href="#"><img id="model1"
                                                                                                            src="BottomRibbon/customize/2b.png"></a>
                            </li>
                            <li onclick="grid()"><a href="#"><img id="grid1" src="BottomRibbon/customize/3b.png"></a>
                            </li>
                            <li onclick="snap()" style="border-bottom:1px solid #c1c1c1;"><a href="#"><img id="snap1"
                                                                                                           src="BottomRibbon/customize/4b.png"></a>
                            </li>
                            <li onclick="infer()" style="border-bottom:1px solid #c1c1c1;"><a href="#"><img id="infer1"
                                                                                                            src="BottomRibbon/customize/5b.png"></a>
                            </li>
                            <li onclick="dynamicInput()" style="border-bottom:1px solid #c1c1c1;"><a href="#"><img
                                            id="dynamicInput1"
                                            src="BottomRibbon/customize/6b.png"></a></li>
                            <li onclick="ortho()"><a href="#"><img id="ortho1" src="BottomRibbon/customize/7b.png"></a>
                            </li>
                            <li onclick="polar()"><a href="#"><img id="polar1" src="BottomRibbon/customize/8b.png"></a>
                            </li>
                            <li onclick="isodraft()" style="border-bottom:1px solid #c1c1c1;"><a href="#"><img
                                            id="isodraft1"
                                            src="BottomRibbon/customize/9b.png"></a></li>
                            <li onclick="objectSnapTrack()"><a href="#"><img id="objectSnapTrack1"
                                                                             src="BottomRibbon/customize/10b.png"></a>
                            </li>
                            <li onclick="objectSnap()" style="border-bottom:1px solid #c1c1c1;"><a href="#"><img
                                            id="objectSnap1"
                                            src="BottomRibbon/customize/11b.png"></a></li>
                            <li onclick="lineweight()" style="border-bottom:1px solid #c1c1c1;"><a href="#"><img
                                            id="lineweight1"
                                            src="BottomRibbon/customize/12b.png"></a></li>
                            <li onclick="transparency()" style="border-bottom:1px solid #c1c1c1;"><a href="#"><img
                                            id="transparency1"
                                            src="BottomRibbon/customize/13b.png"></a></li>
                            <li onclick="cycling()" style="border-bottom:1px solid #c1c1c1;"><a href="#"><img
                                            id="cycling1"
                                            src="BottomRibbon/customize/14b.png"></a></li>
                            <li onclick="DObjectSnap()" style="border-bottom:1px solid #c1c1c1;"><a href="#"><img
                                            id="DObjectSnap1"
                                            src="BottomRibbon/customize/15b.png"></a></li>
                            <li onclick="dynamicUCS()"><a href="#"><img id="dynamicUCS1"
                                                                        src="BottomRibbon/customize/16b.png"></a></li>
                            <li onclick="ojectSelection()"><a href="#"><img id="ojectSelection1"
                                                                            src="BottomRibbon/customize/17b.png"></a>
                            </li>
                            <li onclick="gizmo()" style="border-bottom:1px solid #c1c1c1;"><a href="#"><img id="gizmo1"
                                                                                                            src="BottomRibbon/customize/18b.png"></a>
                            </li>
                            <li onclick="annotation()"><a href="#"><img id="annotation1"
                                                                        src="BottomRibbon/customize/19b.png"></a></li>
                            <li onclick="autoscale()"><a href="#"><img id="autoscale1"
                                                                       src="BottomRibbon/customize/20b.png"></a></li>
                            <li onclick="currentViewScale()" style="border-bottom:1px solid #c1c1c1;"><a href="#"><img
                                            id="currentViewScale1"
                                            src="BottomRibbon/customize/21b.png"></a></li>
                            <li onclick="workspace()" style="border-bottom:1px solid #c1c1c1;"><a href="#"><img
                                            id="workspace1"
                                            src="BottomRibbon/customize/22b.png"></a></li>
                            <li onclick="monitor()" style="border-bottom:1px solid #c1c1c1;"><a href="#"><img
                                            id="monitor1"
                                            src="BottomRibbon/customize/23b.png"></a></li>
                            <li onclick="DrawUnits()" style="border-bottom:1px solid #c1c1c1;"><a href="#"><img
                                            id="units1"
                                            src="BottomRibbon/customize/24b.png"></a></li>
                            <li onclick="drawingUnits()" style="border-bottom:1px solid #c1c1c1;"><a href="#"><img
                                            id="drawingUnits1"
                                            src="BottomRibbon/customize/25b.png"></a></li>
                            <li onclick="lock()" style="border-bottom:1px solid #c1c1c1;"><a href="#"><img id="lock1"
                                                                                                           src="BottomRibbon/customize/26b.png"></a>
                            </li>
                            <li onclick="isolateObject()" style="border-bottom:1px solid #c1c1c1;"><a href="#"><img
                                            id="isolateObject1"
                                            src="BottomRibbon/customize/27b.png"></a></li>
                            <li onclick="hardwareAcc()" style="border-bottom:1px solid #c1c1c1;"><a href="#"><img
                                            id="hardwareAcc1"
                                            src="BottomRibbon/customize/28b.png"></a></li>
                            <li onclick="cleanScreen()" style="border-bottom:1px solid #c1c1c1;"><a href="#"><img
                                            id="cleanScreen1"
                                            src="BottomRibbon/customize/29b.png"></a></li>
                        </ul>
                    </li>

                </ul>

            </div>

            <div class="model">
                <ul class="tabm">
                    <li class="modellinks tabdlinks" onclick="openModel(event, 'London')"><strong>&nbsp;&nbsp;+</strong>
                    </li>
                    <li id="mk2" class="modellinks tabdlinks" onclick="openModel(event, 'Par')">Layout 2</li>
                    <li id="mk" class="modellinks tabdlinks" onclick="openModel(event, 'Par')">Layout 1</li>
                    <li id="main" class="modellinks tabdlinks" onclick="openModel(event, 'Par')">Model</li>

                </ul>
            </div>

        </div>

    </div>

    <style>
    .tabdcontent{ background-image: url("Screenshot.png");
                  -webkit-background-size: cover;
                  -moz-background-size: cover;
                  -o-background-size: cover; width:100%;
                   overflow:hidden;
                   height:78.8vh;
                   margin-top: -4.6vh;
                }
    </style>

    <div id="Tok" class="tabdcontent mactive">
                <style>
          .button,.price li{text-align:center}
          .columns{ margin-top: 23px; float: left; width: 18.7%; padding: 1px; box-sizing: border-box; background-color: #fff;
            color: #424240;}
          .header{background-color: #424240 ;width: 89%;}
          .price{list-style-type:none;border:2px solid #3b3b3a ;margin:0;padding:0;-webkit-transition:.3s;transition:.3s}
          .price:hover{box-shadow:0 8px 12px 0 rgba(0,0,0,.2)}
          .price .header{background-color:#111;color:#fff;font-size:medium}
           .price li{border-bottom:1px solid #eee;padding:13px}
           .price .desc li{border-bottom:1px solid #eee;padding: 5px;font-size: 13px;text-align: initial;}
           .price .main{text-align: justify;}
           .price .main .desc li{text-align: justify;}
           .button{border:none;color:#fff;padding:7px 23px;text-decoration:none;font-size:14px}
           @media only screen and (max-width:600px){.columns{width:100%}}
          </style>
         <!--  Only to display for users on trial     if($tok == 0){ ?>-->
          <?php
            if($e_dt < $date_today && $date_seven < $date_today ){ ?>

        <div class="columns">
              <ul class="price">
                <li class="header" style="height: auto">Trial Tools</li>
                  <li class="main"><b>1. Limited access to DemosCAD tools </b></li>
                  <li class="main"><b>2. Available tools </b></li>
                  <ul class="desc">
                    <style>
                    .table {margin-bottom: 5px;}
                    .table td{font-size: 11px;}
                  </style>
                    <table class="table table-responsive ">
                    <thead>
                      <tr>
                        <td>Tool</td>
                        <td>Image</td>
                      </tr>
                    </thead>
                    <tbody>

                      <tr>
                        <td><a class="demo" id="rb_extrude" value="rb_extrude" name="Extrude" href="#openModal">Extrude</a></td>
                        <td><a class="demo" id="rb_extrude" value="rb_extrude" name="Extrude" href="#openModal">
                              <img class="lazyload" style="float: left" src="Home/modelling/extrude/extrude.png" width="20" height="20">
                              </a></td>

                      </tr>

                        <tr>
                          <td><a class="demo" id="rb_loft" value="rb_loft" name="Loft" href="#openModal">Loft</a></td>
                        <td><a class="demo" id="rb_loft" value="rb_loft" name="Loft" href="#openModal">
                            <img class="lazyload" style="float: left" src="Home/modelling/extrude/loft.png" width="20" height="20">
                            </a></td>

                      </tr>
                      <tr>

                        <td><a class="demo" id="rb_revolve" value="rb_revolve" name="Revolve" href="#openModal">Revolve</a></td>
                        <td><a class="demo" id="rb_revolve" value="rb_revolve" name="Revolve" href="#openModal">
                            <img class="lazyload" style="float: left" src="Home/modelling/extrude/revolve.png" width="20" height="20">
                            </a>
                            </td>

                        </a>
                      </tr>

                      <tr>
                        <td><a class="demo" id="rb_sweep" value="rb_sweep" name="Sweep" href="#openModal">Sweep</a></td>
                        <td><a class="demo" id="rb_sweep" value="rb_sweep" name="Sweep" href="#openModal">
                            <img class="lazyload" style="float: left" src="Home/modelling/extrude/sweep.png" width="20" height="20">
                            </a></td>

                      </a>
                      </tr>
                      <tr>
                        <td><a class="demo" id="rb_animation" value="rb_animation" name="Animation" href="#openModal">Animation</a></td>
                        <td><a class="demo" id="rb_animation" value="rb_animation" name="Animation" href="#openModal">
                            <img class="lazyload" style="float: left" src="Home/modelling/extrude/animation.png" width="20" height="20">
                            </a>
                            </td>

                      </a>
                      </tr>
                    </tbody>
                  </table>
                  </ul>
                  </li>
                </b>
              </ul>
              </div>
                    <?php } ?>
        <!--  Only to display for users on trial -->

    </div>

</div>

</div>


<!--modals start here-->
<!-- New Modal
<div id="clickModal" class="clickModal">
    <!-- Modal content -->
    <!--<div class="click-modal-content">
        <div class="clickModalContent">
            <!--<input onclick="goFullScreen()" type="button" class="btn btn-light btn"-->
            <!--style="width:auto; height:15px;" value="To Proceed, Press the Return or Enter key">
            <p>To Proceed, Please Press the Return or Enter key</p>
        </div>
    </div>-->
</div>

<div id="newModal" class="newModal">
    <div class="new-modal-content">
        <div class="newModalHeader">
            <img style="margin-top:-10px; margin-left:-7px;" class="discImage" src="mike/icon.png"/><span class="appName">&nbsp;&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD &nbsp;-&nbsp; <output
                            id="output3"
                            style="display:inline-block; color:#000;font-family: Arial; margin-top: -14px;"></output></span>
            <a href="#" onclick="closeVideo2()"><span class="newClose" id="newClose">&#x2715;</span></a>
        </div>
        <div id="newModalContent" class="newModalContent">

            <img src="" alt="img" id="img" style="display: none" class="img-responsive">

            <video id="skyvid" controls controlsList="nodownload" style="display: none;" oncontextmenu="return false;">
                <source src="" type="video/mp4">
            </video>

        </div>
    </div>
</div>

<div id="modalViewer" class="newModal" style="top:-50px;">
    <div class="new-modal-content" style="max-height: calc(100vh - 50px);">
        <div class="newModalHeader">
            <img style="margin-top:-10px; margin-left:-7px;" class="discImage" src="mike/icon.png"/><span class="appName">&nbsp;&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD &nbsp;-&nbsp; <output
                            id="output4"
                            style="display:inline-block; color:#000;font-family: Arial; margin-top: -14px;"></output></span>
            <a href="#ModalPopup" onclick="closeModalVideo()"><span class="newClose" id="newClose2">&#x2715;</span></a>
        </div>
        <div class="newModalContent">
            <embed src="" controls controlsList="nodownload" type="application/pdf" style="max-height: calc(100vh - 100px); width:940px; display: none;">
            <img src="" class="img-responsive" alt="img">

            <video id="modalVid" controls controlsList="nodownload" style="max-height: calc(100vh - 100px); width:930px; display: none;" oncontextmenu="return false;">
                <source src="" type="video/mp4">
            </video>
        </div>
    </div>
</div>

<!--selector modal-->
<div id="openModal" class="modalWindow" style="cursor: move;">
    <div style="width:398px;">
        <div class="appWindow vcontainer" style="width:540px; height: 29px;">
            <div class="modalHead">
                <img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD &nbsp;-&nbsp; <output
                            id="output"
                            style="display:inline-block; color:#000;font-family: Arial; margin-top: -14px;"></output></span>
                <a  href="#" onclick="closeIntent('openModal')" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
            </div>
        </div>
        <div class="selectorModalContent">
            <form id="formSelection">
                <div id="fieldset">
                    <fieldset class="scheduler-border2">
                        <legend class="scheduler-border">Tool Options</legend>
                        <div style="margin-top: -20px;"  >
                            <input type="checkbox" name="action"   value="demonstration" id="demo"><label data-toggle="tooltipnomademo"
                                    class="checkboxFont" for="demo">&nbsp;&nbsp; Demonstration&nbsp;&nbsp;<span style="display: none; float: right; font-weight: normal;" id="demo-video-duration-thingy"></span></label><br>
                            <input type="checkbox" name="action"  value="procedure" id="over"><label class="checkboxFont"
                                                                                                    for="over"> &nbsp;&nbsp;
                                Procedure</label><br>
                            <span class="tutorials"><input type="checkbox"  name="action" value="tutorial"
                                                           id="tut"><label class="checkboxFont" for="over"> &nbsp;&nbsp; Command Tutorial</label></span><br>
                            <span class="projectFiles"><input type="checkbox" name="action" value="projectFile"
                                                              id="p-file"><label class="checkboxFont" for="p-file"> &nbsp;&nbsp; Exercise with Autodesk AutoCAD</label></span>
                        </div>
                    </fieldset>
                </div>
            </form>
            <div id="desktopDownload" style="text-align: justify;">
                <!--This feature is not supported on the web application for this version. Download the DemosCAD desktop
                application to access the project files, However, you will be required to have Autodesk AutoCAD installed in your
                computer to exercise with the project files.-->
            </div>
			<div id="openModalVideo" style="display: none;">
                <video width="700" controls id="videoPlayer" oncontextmenu="return false;">
                    <source src="" type="video/mp4">
                </video>
            </div>

            <ul id="tutorialsLIST" style="display: none;">
            </ul>

            <div class="btn-toolbar">
                <input onclick="closeIntent('openModal')" id="btnCancel" type="button" class="btn btn-light pull-right btn-sm selectorBtn" value="CANCEL">
                <input onclick="processIntent('openModal')" id="btnOK" type="button" class="btn btn-light  pull-right btn-sm selectorBtn" value="OK">
                <br>
            </div>
        </div>
    </div>
</div>
<!--selector modal ends here-->

<!--Ochieng's tutorial list modal-->
<div id="foundTutorialLlist" class="modalWindow">
    <div style="width:398px;">
        <div class="appWindow vcontainer" style="width:540px; height: 29px;">
            <div class="modalHead">
                <img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD &nbsp;-&nbsp; <output
                            id="outputTuts"
                            style="display:inline-block; color:#000;font-family: Arial; margin-top: -14px;"></output></span>
                <a href="#" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
            </div>
        </div>
        <div class="selectorModalContent">
            <legend class="scheduler-border">Tutorial List</legend>
            <div id="listContainer" style="margin-top: -20px;">
            </div>
        </div>
    </div>
</div>
<!--Ochieng's tutorial list modal-->


<div id="ModalPopup" onload="pauseVideo()" class="modalWindow">
    <div>
        <div class="appWindow vcontainer" style="height: 29px;">
            <div class="modalHead">
                <img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD &nbsp;-&nbsp; <output
                            id="output2" style="display:inline-block; color:#000;font-family: Arial; margin-top: -14px;"></output></span>
                <a href="#" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
            </div>
        </div>
        <div class="selectorModalContent">
            <form id="formSelection">
                <div id="fieldset">
                    <fieldset class="scheduler-border2">
                        <legend class="scheduler-border2">Tool Options</legend>
                        <div style="margin-top: -20px;">
                            <input type="checkbox" name="action2" value="tutorial2" id="tut2"><label
                                    class="checkboxFont" for="tut2">&nbsp;&nbsp; Demonstration</label><br>
                            <input type="checkbox" name="action2" value="procedure2" id="over2"><label
                                    class="checkboxFont" for="over2"> &nbsp;&nbsp; Procedure</label><br>
                        </div>
                    </fieldset>
                </div>
            </form>

            <div class="btn-toolbar">
                <input onclick="closeIntent2('ModalPopup')" id="btnCancel" type="button"
                       class="btn btn-light pull-right btn-sm selectorBtn" value="CANCEL">
                <input onclick="processIntent2('ModalPopup')" id="btnOK" type="button"
                       class="btn btn-light  pull-right btn-sm selectorBtn" value="OK">
                <br>
            </div>
        </div>
    </div>
</div>

<!-- Open Video Popup -->
<div id="openVideo" class="modalWindow">
    <div style="width:950px; top:-120px;max-height: calc(100vh - 50px);">
        <div class="modalHead">
            <img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD </span>
            <a href="#" onclick="closeVideo()" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
        </div>
        <div id="modalContent" class="modalContent" style="margin-left:-10px;">
            <video controls style="max-height: calc(100vh - 100px); width:930px;" controlsList="nodownload" id="vid1" oncontextmenu="return false;">
                <source src="" type="video/mp4">
            </video>
        </div>
    </div>
</div>

<!-- Ochieng's Code -->
<div id="openTutorialVideo" class="modalWindow" role="dialog">
    <div style="width:950px; top:-120px;">
        <div class="modalHead">
            <img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD </span>
            <a href="#openModal" id="nomaclosevideo" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
            <input type="hidden" id="tutplayingnow">
        </div>
        <div id="modalContent1" class="modalContent" style="margin-left:-10px;">
            <video controls controlsList="nodownload" id="vidtutorial" width="930px;" oncontextmenu="return false;">
                <source src="" type="video/mp4">
            </video>

        </div>
        <div style="padding-bottom: 5px">
            <p style="margin-top: 3px; margin-left: 10px; font-size: 14px">
                <b>Source from:</b> <output id="content-author"></output>
            </p>
        </div>
    </div>
</div>
<!-- Ochieng's Code -->

<div id="openAppVideo" class="modalWindow">
    <div style="width:950px; top:-120px;">
        <div class="modalHead">
            <img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD </span>
            <a href="#ApplicationWindow" onclick="closeVideo3()" title="Close" class="newClose"
               style=""><span>&#x2715;</span></a>
        </div>
        <div class="modalContent" style="margin-left:-10px;">
            <video controls controlsList="nodownload" id="vid2" width="930px;" oncontextmenu="return false;">
                <source src="" type="video/mp4">
            </video>

        </div>
    </div>
</div>

<div id="openArchVideo" class="modalWindow">
    <div style="width:950px; top:-120px;">
        <div class="modalHead">
            <img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD </span>
            <a href="#disciplineArchitecture" onclick="closeVideo4()" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
        </div>
        <div class="modalContent2" style="margin-left:10px;">
            <video controls controlsList="nodownload" id="vid3" width="930px;" oncontextmenu="return false;">
                <source src="" type="video/mp4">
            </video>
        </div>
    </div>
</div>

<div id="openCivilVideo" class="modalWindow">
    <div style="width:950px; top:-120px;">
        <div class="modalHead">
            <img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD </span>
            <a href="#disciplineCivil" onclick="closeVideo5()" title="Close" class="newClose"
               style=""><span>&#x2715;</span></a>
        </div>
        <div id="modalContent3" class="modalContent" style="margin-left:-10px;">
            <video controls controlsList="nodownload" id="vid4" width="930px;" oncontextmenu="return false;">
                <source src="" type="video/mp4">
            </video>

        </div>
    </div>
</div>

<div id="openElectVideo" class="modalWindow">
    <div style="width:950px; top:-120px;">
        <div class="modalHead">
            <img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD </span>
            <a href="#disciplineElectrical" onclick="closeVideo6()" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
        </div>
        <div id="modalContent4" class="modalContent" style="margin-left:-10px;">
            <video controls controlsList="nodownload" id="vid5" width="930px;" oncontextmenu="return false;">
                <source src="" type="video/mp4">
            </video>

        </div>
    </div>
</div>

<div id="openMechVideo" class="modalWindow">
    <div style="width:950px; top:-120px;">
        <div class="modalHead">
            <img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD </span>
            <a href="#disciplineMechanical" onclick="closeVideo7()" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
        </div>
        <div id="modalContent5" class="modalContent" style="margin-left:-10px;">
            <video controls controlsList="nodownload" id="vid6" width="930px;" oncontextmenu="return false;">
                <source src="" type="video/mp4">
            </video>

        </div>
    </div>
</div>

<div id="openSurveyVideo" class="modalWindow">
    <div style="width:950px; top:-120px;">
        <div class="modalHead">
            <img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD </span>
            <a href="#disciplineSurveying" onclick="closeVideo8()" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
        </div>
        <div id="modalContent10" class="modalContent" style="margin-left:-10px;">
            <video controls controlsList="nodownload" id="vid7" width="930px;" oncontextmenu="return false;">
                <source src="" type="video/mp4">
            </video>

        </div>
    </div>
</div>

<div id="openDesignVideo" class="modalWindow">
    <div style="width:950px; top:-120px;">
        <div class="modalHead">
            <img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD </span>
            <a href="#disciplineDesign" onclick="closeVideo9()" title="Close" class="newClose"
               style=""><span>&#x2715;</span></a>
        </div>
        <div id="modalContent11" class="modalContent" style="margin-left:-10px;">
            <video controls controlsList="nodownload" id="vid8" width="930px;" oncontextmenu="return false;">
                <source src="" type="video/mp4">
            </video>

        </div>
    </div>
</div>

<div id="openAutoVideo" class="modalWindow">
    <div style="width:950px; top:-120px;">
        <div class="modalHead">
            <img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD </span>
            <a href="#AutoCADGallery" onclick="closeVideo10()" title="Close" class="newClose"
               style=""><span>&#x2715;</span></a>
        </div>
        <div id="modalContent12" class="modalContent" style="margin-left:-10px;">
            <video controls controlsList="nodownload" id="vid9" width="930px;" oncontextmenu="return false;">
                <source src="" type="video/mp4">
            </video>

        </div>
    </div>
</div>


<!-- Open PDF PopUp -->

<div  id="openPDF" class="modalWindow">
<div style="width:930px; top:-120px; height:600px">
<div class="modalHead">
<img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD </span>
<a href="#" onclick="closePDF()" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
</div>
<div class="modalContent" style="margin-left:-10px;">
<iframe controls controlsList="nodownload" id="pdf1" width="900px;" height="550px;">
       <source src="" controlsList="nodownload" type="application/pdf" width="880px;" height="550px;" style="display:none;">
</iframe>
 </div>
</div>
</div>

<div  id="openAppPDF" class="modalWindow">
<div style="width:930px; top:-120px; height:600px">
<div class="modalHead">
<img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD </span>
<a href="#ApplicationWindow" onclick="closePDF()" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
</div>
<div class="modalContent" style="margin-left:-10px;">
<iframe controls controlsList="nodownload" id="pdfApp" width="900px;" height="550px;">
       <source src="" controlsList="nodownload" type="application/pdf" width="880px;" height="550px;" style="display:none;">
</iframe>
 </div>
</div>
</div>

<div  id="openAutoCADPDF" class="modalWindow">
<div style="width:930px; top:-120px; height:600px">
<div class="modalHead">
<img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD </span>
<a href="#AutoCADGallery" onclick="closePDF()" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
</div>
<div id="pdf-wrapper" class="modalContent" style="margin-left:-10px;">

 </div>
</div>
</div>

<div  id="openArchPDF" class="modalWindow">
<div style="width:930px; top:-120px; height:600px">
<div class="modalHead">
<img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD </span>
<a href="#disciplineArchitecture" onclick="closePDF()" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
</div>
<div class="modalContent" style="margin-left:-10px;">
<iframe controls controlsList="nodownload" id="pdf2" width="900px;" height="550px;">
       <source src="" controlsList="nodownload" type="application/pdf" width="880px;" height="550px;" style="display:none;">
</iframe>
 </div>
</div>
</div>

<div  id="openCivilPDF" class="modalWindow">
<div style="width:930px; top:-120px; height:600px">
<div class="modalHead">
<img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD </span>
<a href="#disciplineCivil" onclick="closePDF()" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
</div>
<div class="modalContent" style="margin-left:-10px;">
<iframe controls controlsList="nodownload" id="pdf3" width="900px;" height="550px;">
       <source src="" controlsList="nodownload" type="application/pdf" width="880px;" height="550px;" style="display:none;">
</iframe>
 </div>
</div>
</div>

<div  id="openElectPDF" class="modalWindow">
<div style="width:930px; top:-120px; height:600px">
<div class="modalHead">
<img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD </span>
<a href="#disciplineElectrical" onclick="closePDF()" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
</div>
<div class="modalContent" style="margin-left:-10px;">
<iframe controls controlsList="nodownload" id="pdf4" width="900px;" height="550px;">
       <source src="" controlsList="nodownload" type="application/pdf" width="880px;" height="550px;" style="display:none;">
</iframe>
 </div>
</div>
</div>

<div  id="openMechPDF" class="modalWindow">
<div style="width:930px; top:-120px; height:600px">
<div class="modalHead">
<img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD </span>
<a href="#disciplineMechanical" onclick="closePDF()" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
</div>
<div class="modalContent" style="margin-left:-10px;">
<iframe controls controlsList="nodownload" id="pdf5" width="900px;" height="550px;">
       <source src="" controlsList="nodownload" type="application/pdf" width="880px;" height="550px;" style="display:none;">
</iframe>
 </div>
</div>
</div>

<div  id="openSurveyPDF" class="modalWindow">
<div style="width:930px; top:-120px; height:600px">
<div class="modalHead">
<img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD </span>
<a href="#disciplineSurveying" onclick="closePDF()" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
</div>
<div class="modalContent" style="margin-left:-10px;">
<iframe controls controlsList="nodownload" id="pdf6" width="900px;" height="550px;">
       <source src="" controlsList="nodownload" type="application/pdf" width="880px;" height="550px;" style="display:none;">
</iframe>
 </div>
</div>
</div>

<div  id="openDesignPDF" class="modalWindow">
<div style="width:930px; top:-120px; height:600px">
<div class="modalHead">
<img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD </span>
<a href="#disciplineDesign" onclick="closePDF()" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
</div>
<div class="modalContent" style="margin-left:-10px;">
<iframe controls controlsList="nodownload" id="pdf7" width="900px;" height="550px;">
       <source src="" controlsList="nodownload" type="application/pdf" width="880px;" height="550px;" style="display:none;">
</iframe>
 </div>
</div>
</div>

<div id="ApplicationWindow" class="popupWindow">
    <div style="width:650px; height:500px;">
        <div class="appWindow vcontainer" style="width:650px; height: 29px;">
            <div class="modalHead">
                <img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD &nbsp;-&nbsp; AutoCAD Based</span>
                <a href="#" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
            </div>
        </div>
        <div>

            <!--Primary Tab-->
            <div class="tabed"
                 style="border: 5px solid #fff; margin-top: 40px; margin-left:13px; width:615px; height:375px;">
                <input type="radio" name="applications" id="tab-nav-1" checked>
                <label style="margin-right:-150px;margin-top:-38px;" class="priTab" for="tab-nav-1" id="defaultOpenApp">What's
                    New</label>
                <input type="radio" name="applications" id="tab-nav-2">
                <label style="margin-right:-190px;margin-top:-38px;" class="priTab3" for="tab-nav-2">Parametric
                    &nbsp;</label>
                <input type="radio" name="applications" id="tab-nav-3">
                <label style="margin-top:-38px;" class="priTab4" for="tab-nav-3">General</label>
                <input type="radio" name="applications" id="tab-nav-4">

                <!--Secondary-->
                <div class="tabs" style="margin-left: 10px; margin-top: 10px;">
                    <div style="width:600px;">
                        <div class="application">
						    <li class="applinks secTab2" onclick="openapplications(event, '2012')" id="defaultOpen2018">AutoCAD 2012</li>
							<li class="applinks secTab2" onclick="openapplications(event, '2013')">AutoCAD 2013</li>
							<li class="applinks secTab2" onclick="openapplications(event, '2014')">AutoCAD 2014</li>
							<li class="applinks secTab2" onclick="openapplications(event, '2015')">AutoCAD 2015</li>
							<li class="applinks secTab2" onclick="openapplications(event, '2016')">AutoCAD 2016</li>
							<li class="applinks secTab2" onclick="openapplications(event, '2017')">AutoCAD 2017</li>
                            <li class="applinks secTab2" onclick="openapplications(event, '2018')">AutoCAD 2018</li>
                        </div>


                        <div id="2018" class="appcontent secCont" style="width:570px;">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">What's new in AUTOCAD 2018</legend>
                                <form class="cont">
                                    <a id="20183" href="#openAppVideo"><input id="20183" type="checkbox"
                                                                              onchange="window.location.href='#openAppVideo'"/><label
                                                for="20183">&nbsp; AutoCAD 2018 User Interface Enhancements</label>
                                    </a><br>
                                    <a id="20181" href="#openAppVideo"><input id="20181"
                                                                              onchange="window.location.href='#openAppVideo'"
                                                                              type="checkbox"/><label for="20181">&nbsp;
                                            Object Selection AutoCAD 2018 </label> </a><br>
                                    <a id="20182" href="#openAppVideo"><label><input id="20182"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/></label>
                                                    <label for="20182">&nbsp; Design View Enhancement in AutoCAD 2018 </label></a><br>
                                        <a id="20184" href="#openAppVideo"><label><input id="20184"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/></label>
                                                    <label for="20184">&nbsp; AutoCAD Mobile App AutoCAD 2018 </label></a><br>
								    <a id="20185" href="#openAppVideo"><label><input id="20185"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/></label>
                                                    <label for="20185">&nbsp; External File References AutoCAD 2018</label></a><br>
                                    <a id="20186" href="#openAppVideo"><label><input id="20186"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/></label>
                                                    <label for="20186">&nbsp; High resolution monitor support AutoCAD 2018</label></a><br>
                                    <a id="20187" href="#openAppVideo"><label><input id="20187"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/></label>
                                                    <label for="20187">&nbsp; PDF import AutoCAD 2018 </label></a><br>

                                    <a id="20189" href="#openAppVideo"><label><input id="20189"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/></label>
                                                    <label for="20189">&nbsp; Text to mtext video AutoCAD 2018</label></a><br>

                                </form>
                            </fieldset>
                            <div style="margin-top:40px; margin-left:-9px;">
							<ul style="list-style:none;">
                                <li id="autocad_preview_guide" value="autocad_preview_guide"><a href="#openAppPDF"><img
                                            src="Resources/Application Window/2018.png"></a></li>
                                <li name="Acknowledgement"
                                id="Acknowledgement2" value="Acknowledgement2"><a href="#openAppPDF"><img
                                            style="margin-left:480px; margin-top:-30px;"
                                            src="Resources/Application Window/acknowledgement.png"></a></li>
							    </ul>
                            </div>
                        </div>

                        <div id="2017" class="appcontent secCont" style="width:570px;">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">What's new in AUTOCAD 2017</legend>
                                <form class="cont">
                                    <a id="20171" href="#openAppVideo"><label><input id="20171"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20171">&nbsp; User Interface Upgrade in AutoCAD 2017
                                                AutoCAD </label></a><br>
                                    <a id="20172" href="#openAppVideo"><label><input id="20172"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20172">&nbsp; Introduction of AutoCAD 2017</label></a><br>
                                    <a id="20173" href="#openAppVideo"><label><input id="20173"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20173">&nbsp; AutoCAD 2017 2D graphics
                                                upgrade </label></a><br>
                                    <a id="20174" href="#openAppVideo"><label><input id="20174"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20174">&nbsp; AutoCAD 2017 the autodesk desktop
                                                app </label></a><br>
                                    <a id="20175" href="#openAppVideo"><label><input id="20175"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20175">&nbsp; Centerlines and Center marks AutoCAD 2017</label></a><br>
                                    <a id="20176" href="#openAppVideo"><label><input id="20176"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20176">&nbsp; How to handle pdf import in AutoCAD 2017</label></a><br>
                                    <a id="20177" href="#openAppVideo"><label><input id="20177"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20177">&nbsp; How to migrate settings AutoCAD
                                                2017</label></a><br>
                                    <a id="20178" href="#openAppVideo"><label><input id="20178"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20178">&nbsp; How to use the AutoCAD 2017 license
                                                manager</label></a><br>
                                    <a id="20179" href="#openAppVideo"><label><input id="20179"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20179">&nbsp; Print studio AutoCAD 2017
                                                tutorial</label></a><br>
                                    <a id="201710" href="#openAppVideo"><label><input id="201710"
                                                                                      onchange="window.location.href='#openAppVideo'"
                                                                                      type="checkbox"/><label
                                                    for="201710">&nbsp; The Autodesk Desktop App in AutoCAD 2017</label></a><br>
                                    <a id="201711" href="#openAppVideo"><label><input id="201711"
                                                                                      onchange="window.location.href='#openAppVideo'"
                                                                                      type="checkbox"/><label
                                                    for="201711">&nbsp; Share Design View AutoCAD 2017 Tutorial</label></a><br>
                                    <a id="201712" href="#openAppVideo"><label><input id="201712"
                                                                                      onchange="window.location.href='#openAppVideo'"
                                                                                      type="checkbox"/><label
                                                    for="201712">&nbsp; Stay competitive! AutoCAD 2017
                                                Commercial</label></a><br>

                                </form>
                            </fieldset>
                            <div style="margin-top:40px; margin-left:-9px;">
							<ul style="list-style:none;">
                                <li id="autocad_preview_guide_2017" value="autocad_preview_guide_2017"><a href="#openAppPDF"><img
                                            src="Resources/Application Window/2017.png"></a></li>
                                <li name="Acknowledgement"
                                id="Acknowledgement2" value="Acknowledgement2"><a href="#openAppPDF"><img
                                            style="margin-left:480px; margin-top:-30px;"
                                            src="Resources/Application Window/acknowledgement.png"></a></li>
							    </ul>
                            </div>
                        </div>

                        <div id="2016" class="appcontent secCont" style="width:570px;">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">What's new in AUTOCAD 2016</legend>
                                <form class="cont">
                                    <a id="20161" href="#openAppVideo"><label><input id="20161"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20161">&nbsp; User Interface</label></a><br>
                                    <a id="20162" href="#openAppVideo"><label><input id="20162"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20162">&nbsp; Annotations</label></a><br>
                                    <a id="20163" href="#openAppVideo"><label><input id="20163"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20163">&nbsp; Drawing and Editing</label></a><br>
                                    <a id="20164" href="#openAppVideo"><label><input id="20164"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20164">&nbsp; Installation and Configuration</label></a><br>
                                    <a id="20165" href="#openAppVideo"><label><input id="20165"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20165">&nbsp; BIM 360 Glue Coordination Model</label></a><br>
                                    <a id="20166" href="#openAppVideo"><label><input id="20166"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20166">&nbsp; Navisworks Coordination Model</label></a><br>
                                    <a id="20167" href="#openAppVideo"><label><input id="20167"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20167">&nbsp; PDF Enhancmements</label></a><br>
                                    <a id="20168" href="#openAppVideo"><label><input id="20168"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20168">&nbsp; Point Clouds</label></a><br>
                                    <a id="20169" href="#openAppVideo"><label><input id="20169"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20169">&nbsp; Render</label></a><br>
                                    <a id="201610" href="#openAppVideo"><label><input id="201610"
                                                                                      onchange="window.location.href='#openAppVideo'"
                                                                                      type="checkbox"/><label
                                                    for="201610">&nbsp; Revision Clouds</label></a><br>
                                    <a id="201611" href="#openAppVideo"><label><input id="201611"
                                                                                      onchange="window.location.href='#openAppVideo'"
                                                                                      type="checkbox"/><label
                                                    for="201611">&nbsp; Section Object</label></a><br>
                                </form>
                            </fieldset>
                            <div style="margin-top:40px; margin-left:-9px;">
							<ul style="list-style:none;">
                                <li id="autocad_preview_guide_2016" value="autocad_preview_guide_2016"><a href="#openAppPDF"><img
                                            src="Resources/Application Window/2016.png"></a></li>
                                <li name="Acknowledgement"
                                id="Acknowledgement2" value="Acknowledgement2"><a href="#openAppPDF"><img
                                            style="margin-left:480px; margin-top:-30px;"
                                            src="Resources/Application Window/acknowledgement.png"></a></li>
							    </ul>
                            </div>
                        </div>

                        <div id="2015" class="appcontent secCont" style="width:570px;">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">What's new in AUTOCAD 2015</legend>
                                <form class="cont">
                                    <a id="20151" href="#openAppVideo"><label><input id="20151"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20151">&nbsp; AutoCAD 2015 New User Interface Tutorial</label></a><br>
                                    <a id="20152" href="#openAppVideo"><label><input id="20152"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20152">&nbsp; AutoCAD 2015 New Tab tutorial</label></a><br>
                                    <a id="20153" href="#openAppVideo"><label><input id="20153"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20153">&nbsp; AutoCAD 2015 New Features tutorial mtext
                                                enhancements</label></a><br>
                                    <a id="20154" href="#openAppVideo"><label><input id="20154"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20154">&nbsp; AutoCAD 2015 tutorial reality
                                                apture</label></a><br>
                                    <a id="20155" href="#openAppVideo"><label><input id="20155"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20155">&nbsp; AutoCAD 3D orbit 2015</label></a><br>
                                    <a id="20156" href="#openAppVideo"><label><input id="20156"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20156">&nbsp; AutoCAD New Feature 2015 Drafting
                                                Enhancements</label></a><br>

                                </form>
                            </fieldset>
                            <div style="margin-top:40px; margin-left:-9px;">
							<ul style="list-style:none;">
                                <li id="autocad_preview_guide_2015" value="autocad_preview_guide_2015"><a href="#openAppPDF"><img
                                            src="Resources/Application Window/2015.png"></a></li>
                                <li name="Acknowledgement"
                                id="Acknowledgement2" value="Acknowledgement2"><a href="#openAppPDF"><img
                                            style="margin-left:480px; margin-top:-30px;"
                                            src="Resources/Application Window/acknowledgement.png"></a></li>
							    </ul>
                            </div>
                        </div>

                        <div id="2014" class="appcontent secCont" style="width:570px;">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">What's new in AUTOCAD 2014</legend>
                                <form class="cont">
                                    <a id="20148" href="#openAppVideo"><label><input id="20148"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20148">&nbsp; Getting Started AutoCAD 2014
                                                Overview</label></a><br>
                                    <a id="20141" href="#openAppVideo"><label><input id="20141"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20141">&nbsp; AutoCAD 2014 - Customization</label></a><br>
                                    <a id="20142" href="#openAppVideo"><label><input id="20142"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20142">&nbsp; AutoCAD 2014 Drawing Annotation</label></a><br>
                                    <a id="20143" href="#openAppVideo"><label><input id="20143"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20143">&nbsp; AutoCAD 2014 File applications</label></a><br>
                                    <a id="20144" href="#openAppVideo"><label><input id="20144"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20144">&nbsp; AutoCAD 2014 Geographic Location</label></a><br>
                                    <a id="20145" href="#openAppVideo"><label><input id="20145"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20145">&nbsp; AutoCAD 2014 Layers and Xrefs</label></a><br>
                                    <a id="20146" href="#openAppVideo"><label><input id="20146"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20146">&nbsp; Getting Started AutoCAD 2014
                                                Help</label></a><br>
                                    <a id="20147" href="#openAppVideo"><label><input id="20147"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20147">&nbsp; Getting Started AutoCAD 2014 New Features</label></a><br>

                                </form>
                            </fieldset>
                            <div style="margin-top:40px; margin-left:-9px;">
							<ul style="list-style:none;">
                                <li id="autocad_preview_guide_2014" value="autocad_preview_guide_2014"><a href="#openAppPDF"><img
                                            src="Resources/Application Window/2014.png"></a></li>
                                <li name="Acknowledgement"
                                id="Acknowledgement2" value="Acknowledgement2"><a href="#openAppPDF"><img
                                            style="margin-left:480px; margin-top:-30px;"
                                            src="Resources/Application Window/acknowledgement.png"></a></li>
							    </ul>
                            </div>
                        </div>

                        <div id="2013" class="appcontent secCont" style="width:570px;">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">What's new in AUTOCAD 2013</legend>
                                <form class="cont">
                                    <a id="20131" href="#openAppVideo"><label><input id="20131"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20131">&nbsp; A new Approach to Help AutoCAD
                                                2013</label></a><br>
                                    <a id="20132" href="#openAppVideo"><label><input id="20132"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20132">&nbsp; Font List</label></a><br>
                                    <a id="20133" href="#openAppVideo"><label><input id="20133"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20133">&nbsp; Leaders to Front</label></a><br>
                                    <a id="20134" href="#openAppVideo"><label><input id="20134"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20134">&nbsp; Polyline Width Reversal</label></a><br>
                                    <a id="20135" href="#openAppVideo"><label><input id="20135"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20135">&nbsp; Press - Pull Enhancements</label></a><br>
                                    <a id="20136" href="#openAppVideo"><label><input id="20136"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20136">&nbsp; Snap Behavior</label></a><br>
                                    <a id="20137" href="#openAppVideo"><label><input id="20137"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20137">&nbsp; Strike-through Text </label></a><br>
                                    <a id="20138" href="#openAppVideo"><label><input id="20138"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20138">&nbsp; Tour the User Interface AutoCAD
                                                2013</label></a><br>
                                    <a id="20139" href="#openAppVideo"><label><input id="20139"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20139">&nbsp; Wipeout Frame Visibility</label></a><br>

                                </form>
                            </fieldset>
                            <div style="margin-top:40px; margin-left:-9px;">
							<ul style="list-style:none;">
                                <li id="autocad_preview_guide_2013" value="autocad_preview_guide_2013"><a href="#openAppPDF"><img
                                            src="Resources/Application Window/2013.png"></a></li>
                                <li name="Acknowledgement"
                                id="Acknowledgement2" value="Acknowledgement2"><a href="#openAppPDF"><img
                                            style="margin-left:480px; margin-top:-30px;"
                                            src="Resources/Application Window/acknowledgement.png"></a></li>
							    </ul>
                            </div>
                        </div>

                        <div id="2012" class="appcontent secCont" style="width:570px;">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">What's new in AUTOCAD 2012</legend>
                                <form class="cont">
                                    <a id="20121" href="#openAppVideo"><label><input id="20121"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20121">&nbsp; AutoCAD 2012 - Introduction</label></a><br>
                                    <a id="20122" href="#openAppVideo"><label><input id="20122"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20122">&nbsp; AutoCAD 2012 - 3D Array, polar and Path
                                                Array</label></a><br>
                                    <a id="20123" href="#openAppVideo"><label><input id="20123"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20123">&nbsp; AutoCAD 2012 - AutoCAD WS
                                                Content</label></a><br>
                                    <a id="20124" href="#openAppVideo"><label><input id="20124"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20124">&nbsp; AutoCAD 2012 - AutoCAD WS Share</label></a><br>
                                    <a id="20125" href="#openAppVideo"><label><input id="20125"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20125">&nbsp; AutoCAD 2012 - AutoCAD WS Upload</label></a><br>
                                    <a id="20126" href="#openAppVideo"><label><input id="20126"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20126">&nbsp; AutoCAD 2012- Autodesk Fusion</label></a><br>
                                    <a id="20127" href="#openAppVideo"><label><input id="20127"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20127">&nbsp; AutoCAD 2012 - Content Explorer</label></a><br>
                                    <a id="20128" href="#openAppVideo"><label><input id="20128"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20128">&nbsp; AutoCAD 2012 - Import</label></a><br>
                                    <a id="20129" href="#openAppVideo"><label><input id="20129"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="20129">&nbsp; AutoCAD 2012 - Model
                                                Documentation</label></a><br>
                                    <a id="201210" href="#openAppVideo"><label><input id="201210"
                                                                                      onchange="window.location.href='#openAppVideo'"
                                                                                      type="checkbox"/><label
                                                    for="201210">&nbsp; AutoCAD 2012 - Offset Edge</label></a><br>
                                    <a id="201211" href="#openAppVideo"><label><input id="201211"
                                                                                      onchange="window.location.href='#openAppVideo'"
                                                                                      type="checkbox"/><label
                                                    for="201211">&nbsp; AutoCAD 2012 - Point Clouds</label></a><br>
                                    <a id="201212" href="#openAppVideo"><label><input id="201212"
                                                                                     onchange="window.location.href='#openAppVideo'"
                                                                                     type="checkbox"/><label
                                                    for="201212">&nbsp; AutoCAD 2012 - UCS Icon</label></a><br>
                                </form>
                            </fieldset>
                            <div style="margin-top:40px; margin-left:-9px;">
							<ul style="list-style:none;">
                                <li id="autocad_preview_guide_2012" value="autocad_preview_guide_2012"><a href="#openAppPDF"><img
                                            src="Resources/Application Window/2012.png"></a></li>
                                <li name="Acknowledgement"
                                id="Acknowledgement2" value="Acknowledgement2"><a href="#openAppPDF"><img
                                            style="margin-left:480px; margin-top:-30px;"
                                            src="Resources/Application Window/acknowledgement.png"></a></li>
							    </ul>
                            </div>
                        </div>

                    </div>

                    <!--------PARAMETRICS-------------->
                    <div style="height:354px; width:596px; background:#fff;">
                        <div style="margin-left:10px; width:575px; background:#fff; font-size: 12px; font-family: microsoft sans serif;">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">Parametric</legend>
                                <form class="cont">
                                    <a id="parametric1" href="#openAppVideo"><label><input id="parametric1"
                                                                                           onchange="window.location.href='#openAppVideo'"
                                                                                           type="checkbox"/><label
                                                    for="parametric1">&nbsp; Circular Constraints</label></a><br>
                                    <a id="parametric2" href="#openAppVideo"><label><input id="parametric2"
                                                                                           onchange="window.location.href='#openAppVideo'"
                                                                                           type="checkbox"/><label
                                                    for="parametric2">&nbsp; Constraint Workflow</label></a><br>
                                    <a id="parametric3" href="#openAppVideo"><label><input id="parametric3"
                                                                                           onchange="window.location.href='#openAppVideo'"
                                                                                           type="checkbox"/><label
                                                    for="parametric3">&nbsp; Converting Conventional Dimensions</label></a><br>
                                    <a id="parametric4" href="#openAppVideo"><label><input id="parametric4"
                                                                                           onchange="window.location.href='#openAppVideo'"
                                                                                           type="checkbox"/><label
                                                    for="parametric4">&nbsp; Deleting and reworking Constraints</label></a><br>
                                    <a id="parametric5" href="#openAppVideo"><label><input id="parametric5"
                                                                                           onchange="window.location.href='#openAppVideo'"
                                                                                           type="checkbox"/><label
                                                    for="parametric5">&nbsp; Dynamic vs Annotational dimensions</label></a><br>
                                    <a id="parametric6" href="#openAppVideo"><label><input id="parametric6"
                                                                                           onchange="window.location.href='#openAppVideo'"
                                                                                           type="checkbox"/><label
                                                    for="parametric6">&nbsp; Linear Constraints</label></a><br>
                                    <a id="parametric7" href="#openAppVideo"><label><input id="parametric7"
                                                                                           onchange="window.location.href='#openAppVideo'"
                                                                                           type="checkbox"/><label
                                                    for="parametric7">&nbsp; Parametric conceptual
                                                overview</label></a><br>
                                    <a id="parametric8" href="#openAppVideo"><label><input id="parametric8"
                                                                                           onchange="window.location.href='#openAppVideo'"
                                                                                           type="checkbox"/><label
                                                    for="parametric8">&nbsp; Point Constraints</label></a><br>

                                </form>
                            </fieldset>
                        </div>

                    </div>
                    <!--END PARAMETRICS-->
                    <!--GENERAL TUTORIAL-->
                    <div style="height:354px; width:596px; background:#fff;">
                        <div style="margin-left:10px; width:575px; background:#fff; font-size: 12px; font-family: microsoft sans serif;">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">General Tutorial</legend>
                                <form class="cont">
                                    <a id="general1" href="#openAppVideo"><label><input id="general1"
                                                                                        onchange="window.location.href='#openAppVideo'"
                                                                                        type="checkbox"/><label
                                                    for="general1">&nbsp; How to convert 2D objects to 3D
                                                objects</label></a><br>
                                    <a id="general2" href="#openAppVideo"><label><input id="general2"
                                                                                        onchange="window.location.href='#openAppVideo'"
                                                                                        type="checkbox"/><label
                                                    for="general2">&nbsp; How to create and modify
                                                surfaces</label></a><br>
                                    <a id="general3" href="#openAppVideo"><label><input id="general3"
                                                                                        onchange="window.location.href='#openAppVideo'"
                                                                                        type="checkbox"/><label
                                                    for="general3">&nbsp; How to create and modify
                                                meshes</label></a><br>
                                    <a id="general4" href="#openAppVideo"><label><input id="general4"
                                                                                        onchange="window.location.href='#openAppVideo'"
                                                                                        type="checkbox"/><label
                                                    for="general4">&nbsp; how to create and modify
                                                objects</label></a><br>
                                    <a id="general5" href="#openAppVideo"><label><input id="general5"
                                                                                        onchange="window.location.href='#openAppVideo'"
                                                                                        type="checkbox"/><label
                                                    for="general5">&nbsp; Autocad 3d car model</label></a><br>
                                    <a id="general6" href="#openAppVideo"><label><input id="general6"
                                                                                        onchange="window.location.href='#openAppVideo'"
                                                                                        type="checkbox"/><label
                                                    for="general6">&nbsp; How to create a 3d rotor
                                                blades(freestyle)</label></a><br>
                                    <a id="general7" href="#openAppVideo"><label><input id="general7"
                                                                                        onchange="window.location.href='#openAppVideo'"
                                                                                        type="checkbox"/><label
                                                    for="general7">&nbsp; how to import a 3D model into Autocad</label></a><br>
                                    <a id="general8" href="#openAppVideo"><label><input id="general8"
                                                                                        onchange="window.location.href='#openAppVideo'"
                                                                                        type="checkbox"/><label
                                                    for="general8">&nbsp; How to insert,Import,Scale and Trace
                                                Images</label></a><br>
                                    <a id="general9" href="#openAppVideo"><label><input id="general9"
                                                                                        onchange="window.location.href='#openAppVideo'"
                                                                                        type="checkbox"/><label
                                                    for="general9">&nbsp; How to model a Gear</label></a><br>
                                </form>
                            </fieldset>
                        </div>

                    </div>
                    <!--END GENERAL TUTORIAL-->
                </div>
            </div>
        </div>
    </div>
</div>


<!--ARCHITECTURE-->
<div  id="disciplineArchitecture" class="popupWindow">
<div style="width:540px; height:500px;">
<div class="appWindow vcontainer" style="width:540px; height: 29px;">
<div class="modalHead">
<img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD &nbsp;-&nbsp; Architecture</span>
<a href="#" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
</div>
</div>
<div>

    <!--Primary Tab-->
 <div class="tabed" style="border: 5px solid #fff; margin-top: 40px; margin-left:13px; width:505px; height:375px;">
    <input type="radio" name="architecture1" id="Archtut" checked>
    <label style="margin-right:-87px;margin-top:-38px" class="priTab" for="Archtut" id="defaultOpenArch">Tutorials &nbsp;&nbsp;</label>
    <input type="radio" name="architecture1" id="Archgall">
    <label style="margin-top:-38px" class="priTab2" style="" for="Archgall" id="openGallery_1">Gallery</label>
    <input type="radio" name="architecture1" id="tab-nav-7">

     <!--Secondary-->
    <div class="tabs" style="margin-left: 10px; margin-top: 10px;">
      <div style="width:485px;">
        <div class="disciplineArch">
          <li class="Archlinks secTab2" onclick="openArch(event, 'AutoCADArch')" id="defaultOpenAutoArch">AutoCAD-Based</li>
          <li class="Archlinks secTab" onclick="openArch(event, 'Architecture')" style="">AutoCAD Architecture</li>
          <li class="Archlinks secTab" onclick="openArch(event, 'RevitArch')" style="">Revit Architecture</li>
        </div>

		<div id="AutoCADArch" class="disArchcontent secCont activeArch" style="width:460px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">AutoCAD-Based</legend>
		  <form class="cont">
		    <a id="AutoCADArch1" href="#openArchVideo"><input id="AutoCADArch1" onchange="window.location.href='#openArchVideo'" type="checkbox" /> <label for="AutoCADArch1"> &nbsp;AutoCAD 2D and 3D beginner to advance house project tutorial</label></a><br>
			<a id="AutoCADArch2" href="#openArchVideo"><input id="AutoCADArch2" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="AutoCADArch2">&nbsp; AutoCAD 3D house modeling tutorial beginner basic using AutoCAD </label></a><br>
			<a id="AutoCADArch3" href="#openArchVideo"><input id="AutoCADArch3" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="AutoCADArch3">&nbsp; AutoCAD 3D house part1 making 3D walls </label> </a><br>
			<a id="AutoCADArch4" href="#openArchVideo"><input id="AutoCADArch4" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="AutoCADArch4">&nbsp; AutoCAD 3D house part 6 sloped roof AutoCAD sloped roof 3D roof </label> </a><br>
			<a id="AutoCADArch5" href="#openArchVideo"><input id="AutoCADArch5" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="AutoCADArch5">&nbsp; AutoCAD architecture project browser and navigator </label></a><br>
			<a id="AutoCADArch6" href="#openArchVideo"><input id="AutoCADArch6" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="AutoCADArch6">&nbsp; AutoCAD complete 3D house tutorial for beginners part 3 </label></a><br>
			<a id="AutoCADArch7" href="#openArchVideo"><input id="AutoCADArch7" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="AutoCADArch7">&nbsp; AutoCAD tutorial house design elevation </label></a><br>
			<a id="AutoCADArch9" href="#openArchVideo"><input id="AutoCADArch9" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="AutoCADArch9">&nbsp; Detailing your designs</label></a><br>
			<a id="AutoCADArch10" href="#openArchVideo"><input id="AutoCADArch10" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="AutoCADArch10">&nbsp; House 3D in 10 minutes with AutoCAD</label></a><br>
			<a id="AutoCADArch11" href="#openArchVideo"><input id="AutoCADArch11" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="AutoCADArch11">&nbsp;	How to Create and Modify Objects</label></a><br>
			<a id="AutoCADArch12" href="#openArchVideo"><input id="AutoCADArch12" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="AutoCADArch12">&nbsp;	How To Create Text and Dimensions</label></a><br>
			<a id="AutoCADArch13" href="#openArchVideo"><input id="AutoCADArch13" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="AutoCADArch13">&nbsp;	How to Plot a Drawing Layout</label></a><br>
			<a id="AutoCADArch14" href="#openArchVideo"><input id="AutoCADArch14" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="AutoCADArch14">&nbsp;	What's new with AutoCAD and AutoCAD Architecture 2015</label></a><br>
		  </form>
		  </fieldset>
        </div>

		<div id="Architecture" class="disArchcontent secCont" style="width:460px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">AutoCAD Architecture</legend>
		 <form class="cont">
		    <a id="Architecture1" href="#openArchVideo"><input id="Architecture1" onchange="window.location.href='#openArchVideo'" type="checkbox"  /><label for="Architecture1">&nbsp; AutoCAD architecture materials</label></a><br>
			<a id="Architecture2"  href="#openArchVideo"><input id="Architecture2" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="Architecture2">&nbsp; Creating elevation views</label></a><br>
			<a id="Architecture3" href="#openArchVideo"><input id="Architecture3" onchange="window.location.href='#openArchVideo'" type="checkbox"  /><label for="Architecture3">&nbsp; Creating renovation drawing</label></a><br>
			<a id="Architecture4"  href="#openArchVideo"><input id="Architecture4" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="Architecture4"> &nbsp; Elevation and section editing</label></a><br>
			<a id="Architecture5"  href="#openArchVideo"><input id="Architecture5" onchange="window.location.href='#openArchVideo'" type="checkbox" /> <label for="Architecture5">&nbsp;Floor plan dimensioning inserting objects to scale</label></a><br>
			<a id="Architecture6"  href="#openArchVideo"><input id="Architecture6" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="Architecture6">&nbsp; How to create column grid of a building</label></a><br>
			<a id="Architecture7" href="#openArchVideo"><input id="Architecture7" onchange="window.location.href='#openArchVideo'" type="checkbox"  /><label for="Architecture7">&nbsp; How to create the constructs drawing and insert xref</label></a><br>
			<a id="Architecture8" href="#openArchVideo"><input id="Architecture8" onchange="window.location.href='#openArchVideo'" type="checkbox"  /><label for="Architecture8"> &nbsp; How to insert doors and reposition within wall</label></a><br>
			<a id="Architecture9"  href="#openArchVideo"><input id="Architecture9" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="Architecture9">&nbsp; Managing your drawings</label></a><br>
			<a id="Architecture10"  href="#openArchVideo"><input id="Architecture10" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="Architecture10">&nbsp; Modeling terrain in AutoCAD architectures of tware crash course</label></a><br>
			<a id="Architecture11"  href="#openArchVideo"><input id="Architecture11" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="Architecture11">&nbsp; Two bedroom house roof elevation and sections</label></a><br>
		   </form>
		  </fieldset>

        </div>

		<div id="RevitArch" class="disArchcontent secCont" style="width:460px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">Revit Architecture</legend>
		  <form class="cont">
		  <a id="RevitArch1"  href="#openArchVideo"><input id="RevitArch1" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="RevitArch1">&nbsp; About Autodesk Revit Architecture- The User Interface</label></a><br>
		  <a id="RevitArch2"  href="#openArchVideo"><input id="RevitArch2" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="RevitArch2">&nbsp; BIM - Revit Advanced Tutorial 02 Simple Rendering with Plants and Trees</label></a><br>
		  <a id="RevitArch3"  href="#openArchVideo"><input id="RevitArch3" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="RevitArch3">&nbsp; Material, lights and Rendering - In-depth with Revit 2015</label></a><br>
		  <a id="RevitArch4"  href="#openArchVideo"><input id="RevitArch4" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="RevitArch4">&nbsp; Modern House Modeling in Revit Architecture 2017</label></a><br>
		  <a id="RevitArch5"  href="#openArchVideo"><input id="RevitArch5" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="RevitArch5">&nbsp; Realistic Renderings in Revit</label></a><br>
		  <a id="RevitArch6"  href="#openArchVideo"><input id="RevitArch6" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="RevitArch6">&nbsp; Revit 2017 Daylight Rendering</label></a><br>
		  <a id="RevitArch7"  href="#openArchVideo"><input id="RevitArch7" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="RevitArch7">&nbsp; Revit Architecture_ Modern House Design 1</label></a><br>
		  <a id="RevitArch8"  href="#openArchVideo"><input id="RevitArch8" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="RevitArch8">&nbsp; Revit Architecture_ Modern House Design 2</label></a><br>
		  <a id="RevitArch9"  href="#openArchVideo"><input id="RevitArch9" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="RevitArch9">&nbsp; Revit Architecture_ Modern House Design 3</label></a><br>
		  <a id="RevitArch10"  href="#openArchVideo"><input id="RevitArch10" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="RevitArch10">&nbsp; V-ray for revit</label></a><br>
		  <a id="RevitArch11"  href="#openArchVideo"><input id="RevitArch11" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="RevitArch11">&nbsp; Working with Autodesk Revit</label></a><br>

		  </form>
		  </fieldset>
        </div>
		</div>

		<div style="width:485px;">

		<div class="disciplineArch small">
          <li class="Archlinks secTab2" onclick="openArch(event, 'ArchImages')" id="ArchimageOpen">Images</li>
          <li class="Archlinks secTab" onclick="openArch(event, 'ArchAnimations')">Animations</li>
        </div>

		<div id="ArchImages" class="disArchcontent secCont" style="width:460px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">Images</legend>
		  <form class="cont">
		   <a id="ArchImages1" href="#openArchPDF"><input id="ArchImages1" onchange="window.location.href='#openArchPDF'" type="checkbox" /><label for="ArchImages1">&nbsp;  Image gallery - Dinning room	</label></a><br>
			<a id="ArchImages2" href="#openArchPDF"><input id="ArchImages2" onchange="window.location.href='#openArchPDF'" type="checkbox" /><label for="ArchImages2">&nbsp; Image gallery - Exterior </label></a><br>
			<a id="ArchImages3" href="#openArchPDF"><input id="ArchImages3" onchange="window.location.href='#openArchPDF'" type="checkbox" /><label for="ArchImages3">&nbsp; Image gallery - Faculty building, interior </label></a><br>
			<a id="ArchImages4" href="#openArchPDF"><input id="ArchImages4" onchange="window.location.href='#openArchPDF'" type="checkbox" /><label for="ArchImages4">&nbsp; Image gallery - Golden nix</label></a><br>
			<a id="ArchImages5" href="#openArchPDF"><input id="ArchImages5" onchange="window.location.href='#openArchPDF'" type="checkbox" /><label for="ArchImages5">&nbsp;  Image gallery - Interior 1</label></a><br>
			<a id="ArchImages6" href="#openArchPDF"><input id="ArchImages6" onchange="window.location.href='#openArchPDF'" type="checkbox" /><label for="ArchImages6">&nbsp;  Image gallery - Interior 2 </label></a><br>
			<a id="ArchImages7" href="#openArchPDF"><input id="ArchImages7" onchange="window.location.href='#openArchPDF'" type="checkbox" /><label for="ArchImages7">&nbsp;  Image gallery - Luxury apartment </label></a><br>
			<a id="ArchImages8" href="#openArchPDF"><input id="ArchImages8" onchange="window.location.href='#openArchPDF'" type="checkbox" /><label for="ArchImages8">&nbsp;  Image gallery - Mall and apertment</label></a><br>
			<a id="ArchImages9" href="#openArchPDF"><input id="ArchImages9" onchange="window.location.href='#openArchPDF'" type="checkbox" /><label for="ArchImages9">&nbsp;  Image gallery - Modern apartments </label></a><br>
			<a id="ArchImages10" href="#openArchPDF"><input id="ArchImages10" onchange="window.location.href='#openArchPDF'" type="checkbox" /><label for="ArchImages10">&nbsp;  Image gallery - Reception</label></a><br>
			<a id="ArchImages11" href="#openArchPDF"><input id="ArchImages11" onchange="window.location.href='#openArchPDF'" type="checkbox" /><label for="ArchImages11">&nbsp;  Image gallery - School Building </label></a><br>
			<a id="ArchImages12" href="#openArchPDF"><input id="ArchImages12" onchange="window.location.href='#openArchPDF'" type="checkbox" /><label for="ArchImages12">&nbsp;  Image gallery - Villa </label></a><br>
			<a id="ArchImages13" href="#openArchPDF"><input id="ArchImages13" onchange="window.location.href='#openArchPDF'" type="checkbox" /><label for="ArchImages13">&nbsp;  Image gallery - villa interior </label></a><br>

		  </form>
		  </fieldset>

        </div>

		<div id="ArchAnimations" class="disArchcontent secCont" style="width:460px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">Animations</legend>
		  <form class="cont">
		   <a id="ArchAnimations1" href="#openArchVideo"><input id="ArchAnimations1" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="ArchAnimations1">&nbsp; AutoCAD 3D sofa set modeling </label></a><br>
			<a id="ArchAnimations2" href="#openArchVideo"><input id="ArchAnimations2" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="ArchAnimations2">&nbsp; AutoCAD 3D sofa set modeling 1 </label></a><br>
			<a id="ArchAnimations3" href="#openArchVideo"><input id="ArchAnimations3" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="ArchAnimations3">&nbsp; AutoCAD 3D sofa set modeling 2 </label> </a><br>
			<a id="ArchAnimations4" href="#openArchVideo"><input id="ArchAnimations4" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="ArchAnimations4">&nbsp; AutoCAD 3D sofa set modeling 3 </label></a><br>
			<a id="ArchAnimations5" href="#openArchVideo"><input id="ArchAnimations5" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="ArchAnimations5">&nbsp;  AutoCAD 3D sofa set modeling 4</label></a><br>
			<a id="ArchAnimations6" href="#openArchVideo"><input id="ArchAnimations6" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="ArchAnimations6">&nbsp;  AutoCAD 2017 Tutorial 3D Modelling, Extrude and Revolve Tools </label></a><br>
			<a id="ArchAnimations7" href="#openArchVideo"><input id="ArchAnimations7" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="ArchAnimations7">&nbsp;  AutoCAD 2017 Tutorial Layers</label></a><br>
			<a id="ArchAnimations8" href="#openArchVideo"><input id="ArchAnimations8" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="ArchAnimations8">&nbsp;  Autodesk AutoCAD 2014 3D Solid Modeling & Rendering</label></a><br>
			<a id="ArchAnimations9" href="#openArchVideo"><input id="ArchAnimations9" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="ArchAnimations9">&nbsp; Hotel Windsor 4D Construction Sequence Animation 1</label></a><br>
			<a id="ArchAnimations10" href="#openArchVideo"><input id="ArchAnimations10" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="ArchAnimations10">&nbsp; Hotel Windsor 4D Construction Sequence Animation 2 </label></a><br>
			<a id="ArchAnimations11" href="#openArchVideo"><input id="ArchAnimations11" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="ArchAnimations11">&nbsp; Hotel Windsor 4D Construction Sequence Animation 3 </label></a><br>
			<a id="ArchAnimations12" href="#openArchVideo"><input id="ArchAnimations12" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="ArchAnimations12">&nbsp; Hotel Windsor 4D Construction Sequence Animation 4</label></a><br>
			<a id="ArchAnimations13" href="#openArchVideo"><input id="ArchAnimations13" onchange="window.location.href='#openArchVideo'" type="checkbox" /><label for="ArchAnimations13">&nbsp; Autodesk Design Suite Premium - Adding Visualization to AutoCAD</label></a><br>

		  </form>
		  </fieldset>

        </div>
		</div>

    </div>
  </div>
  <div style="margin-top:9px; margin-left:25px;">
			<ul style="list-style:none;">
                <li name="Acknowledgement" id="Acknowledgement_arch" value="Acknowledgement_arch"><a href="#openArchPDF"><img
                                            src="Resources/Application Window/acknowledgement.png"></a></li>
				<li><a href="#"><img style="margin-left:420px; margin-top:-30px;"
                                            src="Resources/Application Window/cancel.png"></a></li>
			</ul>
       </div>
  </div>
  </div>
</div>
<!--END ARCHITECTURE-->
<!--CIVIL-->
<div  id="disciplineCivil" class="popupWindow">
<div style="width:550px; height:500px;">
<div class="appWindow vcontainer" style="width:550px; height: 29px">
<div class="modalHead">
<img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD &nbsp;-&nbsp; Civil</span>
<a href="#" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
</div>
</div>
<div>
<!--Civil Primary Tab-->
 <div class="tabed" style="border: 5px solid #fff; margin-top: 40px; margin-left:13px; width:470; height:375px;">
    <input type="radio" name="civil" id="civilTut" checked>
    <label style="margin-right:-90px;margin-top:-38px" class="priTab" for="civilTut" id="defaultOpenCivil">Tutorials</label>
    <input type="radio" name="civil" id="civilgall">
    <label style="margin-top:-38px" class="priTab2" style="" for="civilgall">Gallery</label>
    <input type="radio" name="civil" id="tab-nav-7">
<!--Civil Secondary-->
    <div class="tabs" style="margin-left: 10px; margin-top: 10px;">
      <div style="width:465px;">
        <div class="disciplineCivil">
          <li class="Civillinks secTab2" onclick="openCivil(event, 'AutoCADCivil')" id="defaultOpenAutoCADCivil">AutoCAD-Based</li>
          <li class="Civillinks secTab" onclick="openCivil(event, 'civil3D')">AutoCAD Civil 3D</li>
          <li class="Civillinks secTab" onclick="openCivil(event, 'infraworks')">Autodesk Infraworks</li>
          <li class="Civillinks secTab" onclick="openCivil(event, 'structural')">AutoCAD Structural Detailing</li>
        </div>

		<div id="AutoCADCivil" class="disCivilcontent secCont2" style="width:470px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">AutoCAD-Based</legend>
		  <form class="cont">
		    <a id="AutoCADCivil1" href="#openCivilVideo"><input id="AutoCADCivil1" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="AutoCADCivil1">&nbsp; AutoCAD 2D Structural Detail Exercise pt2 of 5 Add plates and Holings 	</label></a><br>
			<a id="AutoCADCivil2" href="#openCivilVideo"><input id="AutoCADCivil2" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="AutoCADCivil2">&nbsp; Column lay out plan Civil Engineering bangla  </label></a><br>
			<a id="AutoCADCivil3" href="#openCivilVideo"><input id="AutoCADCivil3" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="AutoCADCivil3">&nbsp; Design of retaining wall on Autocad Part 1 </label></a><br>
			<a id="AutoCADCivil4" href="#openCivilVideo"><input id="AutoCADCivil4" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="AutoCADCivil4">&nbsp; Design of retaining wall on autocad Part 2	</label></a><br>
			<a id="AutoCADCivil5" href="#openCivilVideo"><input id="AutoCADCivil5" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="AutoCADCivil5">&nbsp;  Design of retaining wall on autocad Part3	</label></a><br>
			<a id="AutoCADCivil6" href="#openCivilVideo"><input id="AutoCADCivil6" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="AutoCADCivil6">&nbsp; Design of retaining wall on autocad Part4</label>	</a><br>
			<a id="AutoCADCivil7" href="#openCivilVideo"><input id="AutoCADCivil7" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="AutoCADCivil7">&nbsp; How to create 3D retain wall in AutoCad	</label></a><br>
			<a id="AutoCADCivil8" href="#openCivilVideo"><input id="AutoCADCivil8" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="AutoCADCivil8">&nbsp;  How to draw P11 Retaining Wall Part 1 </label></a><br>
			<a id="AutoCADCivil9" href="#openCivilVideo"><input id="AutoCADCivil9" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="AutoCADCivil9">&nbsp; How to Draw Reinforcement Details in Slab By AutoCAD	</label></a><br>
			<a id="AutoCADCivil10" href="#openCivilVideo"><input id="AutoCADCivil10" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="AutoCADCivil10">&nbsp; How to Staircase Load calculation civil engineering bangla	</label></a><br>
		  </form>
		  </fieldset>
        </div>

		<div id="civil3D" class="disCivilcontent secCont2" style="width:470px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">AutoCAD civil 3D</legend>
		  <form class="cont">
		   <a id="civil3D1" href="#openCivilVideo"><input id="civil3D1" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="civil3D1">&nbsp; Civil 3D how to exclude bridge tunnel part from mass haul diagram	</label></a><br>
			<a id="civil3D2"  href="#openCivilVideo"><input id="civil3D2" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="civil3D2">&nbsp; Adding property set data to corrido rsolids</label></a><br>
			<a id="civil3D3" href="#openCivilVideo"><input id="civil3D3" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="civil3D3">&nbsp; AutoCAD Creating section views in civil 3D	</label></a><br>
			<a id="civil3D4"  href="#openCivilVideo"><input id="civil3D4" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="civil3D4">&nbsp;  AutoCAD civil 3D 2015 importing points	</label></a><br>
			<a id="civil3D5"  href="#openCivilVideo"><input id="civil3D5" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="civil3D5">&nbsp;  AutoCAD civil 3D 2015 import point create surface 	</label></a><br>
			<a id="civil3D6"  href="#openCivilVideo"><input id="civil3D6" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="civil3D6">&nbsp;  AutoCAD civil 3D 2015 tutorial laying out a pipe network  	</label></a><br>
			<a id="civil3D7" href="#openCivilVideo"><input id="civil3D7" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="civil3D7">&nbsp;  AutoCAD civil3D 2018 new features updates 	</label></a><br>
			<a id="civil3D8" href="#openCivilVideo"><input id="civil3D8" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="civil3D8">&nbsp;  AutoCAD civil 3D alignment labels and tables 	</label></a><br>
			<a id="civil3D9"  href="#openCivilVideo"><input id="civil3D9" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="civil3D9">&nbsp;  AutoCAD civil 3D lot and road grading for residential development	</label></a><br>
			<a id="civil3D10"  href="#openCivilVideo"><input id="civil3D10" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="civil3D10">&nbsp;  Calculating Average end area cut fill volumes in civil 3D 2018 	</label></a><br>
			<a id="civil3D11"  href="#openCivilVideo"><input id="civil3D11" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="civil3D11">&nbsp;  Changing and editing point markers and labels in Civil 3D	</label></a><br>
			<a id="civil3D12"  href="#openCivilVideo"><input id="civil3D12" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="civil3D12">&nbsp;  Civil 3D 2015 road design layout in 14 minutes	</label></a><br>
			<a id="civil3D13"  href="#openCivilVideo"><input id="civil3D13" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="civil3D13">&nbsp;  Civil 3D 2016 creating alignments 	</label></a><br>
			<a id="civil3D14"  href="#openCivilVideo"><input id="civil3D14" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="civil3D14">&nbsp;  Civil 3D 2017 creating a surface from AutoCAD objects 	</label></a><br>
		   </form>
		  </fieldset>

        </div>

		<div id="infraworks" class="disCivilcontent secCont2" style="width:470px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">Autodesk Infraworks</legend>
		  <form class="cont">
		   <a id="infraworks1" href="#openCivilVideo"><input id="infraworks1" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="infraworks1">&nbsp; An overview of infraworks 360 </label></a><br>
			<a id="infraworks2"  href="#openCivilVideo"><input id="infraworks2" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="infraworks2">&nbsp;Infraworks 360 civil 3D geotechnical module</label></a><br>
			<a id="infraworks3" href="#openCivilVideo"><input id="infraworks3" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="infraworks3">&nbsp; An overview of bridge design for infraworks 360</label></a><br>
			<a id="infraworks4"  href="#openCivilVideo"><input id="infraworks4" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="infraworks4">&nbsp; Autodesk infraworks 360 earthwork quantities</label></a><br>
			<a id="infraworks5"  href="#openCivilVideo"><input id="infraworks5" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="infraworks5">&nbsp; Autodesk infraworks 360 overview</label></a><br>
			<a id="infraworks6"  href="#openCivilVideo"><input id="infraworks6" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="infraworks6">&nbsp; Autodesk infraworks for architects and planners</label></a><br>
			<a id="infraworks7" href="#openCivilVideo"><input id="infraworks7" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="infraworks7">&nbsp; Creating a virtual reality experience from an infraworks</label></a><br>
			<a id="infraworks8" href="#openCivilVideo"><input id="infraworks8" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="infraworks8">&nbsp; Creating quick cross sections in AutoCAD civil 3D</label></a><br>
			<a id="infraworks9"  href="#openCivilVideo"><input id="infraworks9" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="infraworks9">&nbsp; Designing culverts and pipe networks</label></a><br>
			<a id="infraworks10"  href="#openCivilVideo"><input id="infraworks10" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="infraworks10">&nbsp; Extract linear features from point clouds</label></a><br>
			<a id="infraworks11"  href="#openCivilVideo"><input id="infraworks11" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="infraworks11">&nbsp; Getting started on infraWorks 360 easily</label></a><br>
			<a id="infraworks12"  href="#openCivilVideo"><input id="infraworks12" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="infraworks12">&nbsp; Getting started with bridge design</label></a><br>
		  </form>
		  </fieldset>

        </div>

		<div id="structural" class="disCivilcontent secCont2" style="width:470px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">AutoCAD Structural Detailing</legend>
		  <form class="cont">
		   <a id="structural1" href="#openCivilVideo"><input id="structural1" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="structural1">&nbsp;	AutoCAD 2D Structural Detail Exercise pt1 of 5 Draw Cross Sections	</label></a><br>
			<a id="structural2"  href="#openCivilVideo"><input id="structural2" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="structural2">&nbsp; AutoCAD Structural Detailing beam reinforcement  </label></a><br>
			<a id="structural3" href="#openCivilVideo"><input id="structural3" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="structural3">&nbsp; AutoCAD Structural Detailing Slab reinforcementpart 1	</label></a><br>
			<a id="structural4"  href="#openCivilVideo"><input id="structural4" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="structural4">&nbsp; AutoCAD Structural Detailing Steel Fabrication Drawings	</label></a><br>
			<a id="structural5"  href="#openCivilVideo"><input id="structural5" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="structural5">&nbsp; AutoCAD Structural Detailing steel modulemodeling braces without macros  </label></a><br>
			<a id="structural6"  href="#openCivilVideo"><input id="structural6" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="structural6">&nbsp; AutoCAD Structural Detailing_2015 Stair 1 	</label></a><br>
			<a id="structural7" href="#openCivilVideo"><input id="structural7" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="structural7">&nbsp;  AutoCAD Structural Detailing reinforcemens column 	</label></a><br>
			<a id="structural8" href="#openCivilVideo"><input id="structural8" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="structural8">&nbsp;  AutoCAD Structural Detailing reinforcements column 2	</label></a><br>
			<a id="structural9"  href="#openCivilVideo"><input id="structural9" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="structural9">&nbsp; Autocad Structure Detailing 4 Detail Slab </label></a><br>
			<a id="structural10"  href="#openCivilVideo"><input id="structural10" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="structural10">&nbsp; Avptube AutoCAD Structural Detailing Platform  </label></a><br>
			<a id="structural11"  href="#openCivilVideo"><input id="structural11" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="structural11">&nbsp; Avptube AutoCAD Structural DetailingASD Reinforcement Beam Detail</label></a><br>
			<a id="structural12"  href="#openCivilVideo"><input id="structural12" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="structural12">&nbsp; Avptube Column Structural Detailing Advance Concrete </label></a><br>

		  </form>
		  </fieldset>

        </div>

		<div id="RevitStructure" class="disCivilcontent secCont2" style="width:470px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">Revit Structure</legend>
		  <form class="cont">
		   <a id="RevitStructure1" href="#openCivilVideo"><input type="checkbox"  />		</a><br>
			<a id="RevitStructure2"  href="#openCivilVideo"><input type="checkbox"  />  </a><br>
			<a id="RevitStructure3" href="#openCivilVideo"><input type="checkbox"  /> 	</a><br>
			<a id="RevitStructure4"  href="#openCivilVideo"><input type="checkbox"  />  	</a><br>
			<a id="RevitStructure5"  href="#openCivilVideo"><input type="checkbox"  />  	</a><br>
			<a id="RevitStructure6"  href="#openCivilVideo"><input type="checkbox"  />   </a><br>
			<a id="RevitStructure7" href="#openCivilVideo"><input type="checkbox"  /> 	</a><br>
			<a id="RevitStructure8" href="#openCivilVideo"><input type="checkbox"  />   	</a><br>
			<a id="RevitStructure9"  href="#openCivilVideo"><input type="checkbox"  />  </a><br>

		  </form>
		  </fieldset>

        </div>
		</div>

		<div style="width:485px;">
		<div class="disciplineCivil small">
          <li class="Civillinks secTab2" onclick="openCivil(event, 'civilImages')" id="CivilArchimageOpen">Images</li>
          <li class="Civillinks secTab" onclick="openCivil(event, 'civilAnimations')">Animations</li>
        </div>

		<div id="civilImages" class="disCivilcontent secCont2" style="width:470px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">Images</legend>
		  <form class="cont">
		   <a id="civilImages1" href="#openCivilPDF"><input id="civilImages1" onchange="window.location.href='#openCivilPDF'" type="checkbox" /><label for="civilImages1">&nbsp; Image Gallery - exterior structure</label></a><br>
			<a id="civilImages2"  href="#openCivilPDF"><input id="civilImages2" onchange="window.location.href='#openCivilPDF'" type="checkbox" /><label for="civilImages2">&nbsp; Image Gallery - interior structure </label></a><br>
			<a id="civilImages3" href="#openCivilPDF"><input id="civilImages3" onchange="window.location.href='#openCivilPDF'" type="checkbox" /><label for="civilImages3">&nbsp; 	Image Gallery - roads</label> </a><br>
			<a id="civilImages4"  href="#openCivilPDF"><input id="civilImages4" onchange="window.location.href='#openCivilPDF'" type="checkbox" /><label for="civilImages4">&nbsp;  Image Gallery - structural	</label></a><br>
		  </form>
		  </fieldset>

        </div>

		<div id="civilAnimations" class="disCivilcontent secCont2" style="width:470px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">Animations</legend>
		  <form class="cont">
		   <a id="civilAnimations1" href="#openCivilVideo"><input id="civilAnimations1" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="civilAnimations1">&nbsp; Turn Simulation Roundabout Design and Visualization in Autotrack</label></a><br>
			<a id="civilAnimations2"  href="#openCivilVideo"><input id="civilAnimations2" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="civilAnimations2">&nbsp; 3D Animation- Building construction</label></a><br>
			<a id="civilAnimations3" href="#openCivilVideo"><input id="civilAnimations3" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="civilAnimations3">&nbsp; 3D Animation Highway</label></a><br>
			<a id="civilAnimations4"  href="#openCivilVideo"><input id="civilAnimations4" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="civilAnimations4">&nbsp; 3D Animation of a Reinforced Concrete Beam and Slab in Civil Engineering</label></a><br>
			<a id="civilAnimations5"  href="#openCivilVideo"><input id="civilAnimations5" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="civilAnimations5">&nbsp; 3D Animation of a Reinforced Foundation and Column	</label></a><br>
			<a id="civilAnimations6"  href="#openCivilVideo"><input id="civilAnimations6" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="civilAnimations6">&nbsp; 3D Animation of the construction of a Multi Story Building	</label></a><br>
			<a id="civilAnimations7" href="#openCivilVideo"><input id="civilAnimations7" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="civilAnimations7">&nbsp; 3D animation civil view 3Ds Max I</label> </a><br>
			<a id="civilAnimations8" href="#openCivilVideo"><input id="civilAnimations8" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="civilAnimations8">&nbsp; 3D Animation civil view 3Ds Max X </label></a><br>
			<a id="civilAnimations9"  href="#openCivilVideo"><input id="civilAnimations9" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="civilAnimations9">&nbsp; 3Ds Max Civil Highway Animation</label></a><br>
			<a id="civilAnimations10"  href="#openCivilVideo"><input id="civilAnimations10" onchange="window.location.href='#openCivilVideo'" type="checkbox" /><label for="civilAnimations10">&nbsp; Autodesk University 2012 Autodesk Civil View Lab Preview HD</label></a><br>

		  </form>
		  </fieldset>

        </div>
		</div>
    </div>
  </div>
  <div style="margin-top:9px; margin-left:25px;">
			<ul style="list-style:none;">
                <li name="Acknowledgement" id="Acknowledgement_civil" value="Acknowledgement_civil"><a href="#openCivilPDF"><img
                                            src="Resources/Application Window/acknowledgement.png"></a></li>
				<li><a href="#"><img style="margin-left:420px; margin-top:-30px;"
                                            src="Resources/Application Window/cancel.png"></a></li>
			</ul>
       </div>
  </div>
  </div>
</div>
<!--END CIVIL-->
<!--ELECTRICAL-->
<div  id="disciplineElectrical" class="popupWindow">
<div style="width:540px; height:500px;">
<div class="appWindow vcontainer" style="width:540px; height: 29px">
<div class="modalHead">
<img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD &nbsp;-&nbsp; Electrical</span>
<a href="#" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
</div>
</div>
<div>
<!--Primary Tab-->
 <div class="tabed" style="border: 5px solid #fff; margin-top: 40px; margin-left:13px; width:505px; height:375px;">
    <input type="radio" name="electrical" id="electTut" checked>
    <label style="margin-right:-90px;margin-top:-38px" class="priTab" for="electTut" id="defaultOpenElect">Tutorials</label>
    <input type="radio" name="electrical" id="electgall">
    <label style="margin-top:-38px" class="priTab2" style="" for="electgall">Gallery</label>
    <input type="radio" name="electrical" id="tab-nav-7">
<!--Secondary-->
    <div class="tabs" style="margin-left: 10px; margin-top: 10px;">
      <div style="width:485px;">
        <div class="disciplineElect">
		  <li class="Electlinks secTab2" onclick="openElect(event, 'AutoCADElectrical')" id="defaultOpenAutoCADElect">AutoCAD-Based</li>
          <li class="Electlinks secTab" onclick="openElect(event, 'Electrical')">AutoCAD Electrical</li>
        </div>

		<div id="AutoCADElectrical" class="disElectcontent secCont" style="width:460px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">AutoCAD-Based </legend>
		  <form class="cont">
		    <a id="AutoCADElectrical1" href="#openElectVideo"><input id="AutoCADElectrical1" onchange="window.location.href='#openElectVideo'" type="checkbox" /><label for="AutoCADElectrical1">&nbsp; Electrical Symbol Index Build </label></a><br>
			<a id="AutoCADElectrical2" href="#openElectVideo"><input id="AutoCADElectrical2" onchange="window.location.href='#openElectVideo'" type="checkbox" /><label for="AutoCADElectrical2">&nbsp; 3 Phase Equipment Panel Schedules by KIS solution </label></a><br>
			<a id="AutoCADElectrical3" href="#openElectVideo"><input id="AutoCADElectrical3" onchange="window.location.href='#openElectVideo'" type="checkbox" /><label for="AutoCADElectrical3">&nbsp; Assigning Circuit Numbers to Lighting Fixtures by KIS solutions </label></a><br>
			<a id="AutoCADElectrical4" href="#openElectVideo"><input id="AutoCADElectrical4" onchange="window.location.href='#openElectVideo'" type="checkbox" /><label for="AutoCADElectrical4">&nbsp; AutoCAD Demo - Two ways to create the symbol legend by IDSPN </label></a><br>
			<a id="AutoCADElectrical5" href="#openElectVideo"><input id="AutoCADElectrical5" onchange="window.location.href='#openElectVideo'" type="checkbox" /><label for="AutoCADElectrical5">&nbsp; AutoCAD Lighting Layout_Circuiting 09 09 13 by Chad Kurdi </label></a><br>
			<a id="AutoCADElectrical6" href="#openElectVideo"><input id="AutoCADElectrical6" onchange="window.location.href='#openElectVideo'" type="checkbox" /><label for="AutoCADElectrical6">&nbsp; Designing a fire alarm system done easy by Truxter Jones </label></a><br>
			<a id="AutoCADElectrical7" href="#openElectVideo"><input id="AutoCADElectrical7" onchange="window.location.href='#openElectVideo'" type="checkbox" /><label for="AutoCADElectrical7">&nbsp;  ENGD311 Lighting Layout by Instructor Dana </label></a><br>
			<a id="AutoCADElectrical8" href="#openElectVideo"><input id="AutoCADElectrical8" onchange="window.location.href='#openElectVideo'" type="checkbox" /><label for="AutoCADElectrical8">&nbsp; Fire alarm Design For AutoCAD by Truxter Jones </label></a><br>
			<a id="AutoCADElectrical9" href="#openElectVideo"><input id="AutoCADElectrical9" onchange="window.location.href='#openElectVideo'" type="checkbox" /><label for="AutoCADElectrical9">&nbsp; Light Fixture Switch Design by KIS solutions	</label></a><br>
			<a id="AutoCADElectrical10" href="#openElectVideo"><input id="AutoCADElectrical10" onchange="window.location.href='#openElectVideo'" type="checkbox" /><label for="AutoCADElectrical10">&nbsp; Office Receptacle circuit Design by KIS solutions	</label></a><br>
			<a id="AutoCADElectrical11" href="#openElectVideo"><input id="AutoCADElectrical11" onchange="window.location.href='#openElectVideo'" type="checkbox" /><label for="AutoCADElectrical11">&nbsp; Symbol Single Line Diagram AutoCAD by Wizzza Channel	</label></a><br>
			<a id="AutoCADElectrical12" href="#openElectVideo"><input id="AutoCADElectrical12" onchange="window.location.href='#openElectVideo'" type="checkbox" /><label for="AutoCADElectrical12">&nbsp; Tips for Drawing Electrical Symbols in AutoCAD by Madison College	</label></a><br>
		  </form>
		  </fieldset>
        </div>

		<div id="Electrical" class="disElectcontent secCont" style="width:460px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">AutoCAD Electrical</legend>
		  <form class="cont">
		   <a id="Electrical1" href="#openElectVideo"><input id="Electrical1" onchange="window.location.href='#openElectVideo'" type="checkbox" /><label for="Electrical1">&nbsp; AutoCAD Electrical - Circuit design reuse	</label></a><br>
			<a id="Electrical2"  href="#openElectVideo"><input id="Electrical2" onchange="window.location.href='#openElectVideo'" type="checkbox" /><label for="Electrical2">&nbsp; AutoCAD Electrical - Customer and supplier collaboration</label></a><br>
			<a id="Electrical3" href="#openElectVideo"><input id="Electrical3" onchange="window.location.href='#openElectVideo'" type="checkbox" /><label for="Electrical3">&nbsp; AutoCAD Electrical - Flexible drag-and-drop file organisation</label></a><br>
			<a id="Electrical4"  href="#openElectVideo"><input id="Electrical4" onchange="window.location.href='#openElectVideo'" type="checkbox" /><label for="Electrical4">&nbsp; AutoCAD Electrical - Marking menus for faster edits	</label></a><br>
			<a id="Electrical5"  href="#openElectVideo"><input id="Electrical5" onchange="window.location.href='#openElectVideo'" type="checkbox" /><label for="Electrical5">&nbsp; AutoCAD Electrical - Real-time error checking by Magenta Solutions 	</label></a><br>
			<a id="Electrical6"  href="#openElectVideo"><input id="Electrical6" onchange="window.location.href='#openElectVideo'" type="checkbox" /><label for="Electrical6">&nbsp; AutoCAD Electrical Automatic Reports  	</label></a><br>
			<a id="Electrical7" href="#openElectVideo"><input id="Electrical7" onchange="window.location.href='#openElectVideo'" type="checkbox" /><label for="Electrical7">&nbsp; Beginning Schematic Creation in AutoCAD Electrical Part 1	</label></a><br>
			<a id="Electrical8" href="#openElectVideo"><input id="Electrical8" onchange="window.location.href='#openElectVideo'" type="checkbox" /><label for="Electrical8">&nbsp; Electrical Schematic Symbol Libraries - Autodesk AutoCAD Electrical 2014 	</label></a><br>
			<a id="Electrical9"  href="#openElectVideo"><input id="Electrical9" onchange="window.location.href='#openElectVideo'" type="checkbox" /><label for="Electrical9">&nbsp; Real Time Error Checking - AutoCAD Electrical 2015 - Autodesk	</label></a><br>
			<a id="Electrical10"  href="#openElectVideo"><input id="Electrical10" onchange="window.location.href='#openElectVideo'" type="checkbox" /><label for="Electrical10">&nbsp; Using Circuit Builder in AutoCAD Electrical	</label></a><br>
		   </form>
		  </fieldset>

        </div>

		<div id="AutoCADMEP" class="disElectcontent secCont" style="width:460px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">AutoCAD MEP</legend>
		  <form class="cont">
		   <a id="AutoCADMEP1" href="#openElectVideo"><input type="checkbox"  />	</a><br>
			<a id="AutoCADMEP2"  href="#openElectVideo"><input type="checkbox"  /> </a><br>
			<a id="AutoCADMEP3" href="#openElectVideo"><input type="checkbox"  /> 	</a><br>
			<a id="AutoCADMEP4"  href="#openElectVideo"><input type="checkbox"  />  	</a><br>
			<a id="AutoCADMEP5"  href="#openElectVideo"><input type="checkbox"  />  	</a><br>
			<a id="AutoCADMEP6"  href="#openElectVideo"><input type="checkbox"  />  	</a><br>
			<a id="AutoCADMEP7" href="#openElectVideo"><input type="checkbox"  />  	</a><br>
			<a id="AutoCADMEP8" href="#openElectVideo"><input type="checkbox"  />   	</a><br>
			<a id="AutoCADMEP9"  href="#openElectVideo"><input type="checkbox"  />  	</a><br>

		  </form>
		  </fieldset>

        </div>

		<div id="RevitMEP" class="disElectcontent secCont" style="width:460px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">Revit MEP</legend>
		  <form class="cont">
		   <a id="RevitMEP1" href="#openElectVideo"><input type="checkbox"  />	</a><br>
			<a id="RevitMEP2"  href="#openElectVideo"><input type="checkbox"  /> </a><br>
			<a id="RevitMEP3" href="#openElectVideo"><input type="checkbox"  /> </a><br>
			<a id="RevitMEP4"  href="#openElectVideo"><input type="checkbox"  />  	</a><br>
			<a id="RevitMEP5"  href="#openElectVideo"><input type="checkbox"  /> 	</a><br>
			<a id="RevitMEP6"  href="#openElectVideo"><input type="checkbox"  />  	</a><br>
			<a id="RevitMEP7" href="#openElectVideo"><input type="checkbox"  />  	</a><br>
			<a id="RevitMEP8" href="#openElectVideo"><input type="checkbox"  />  </a><br>
			<a id="RevitMEP9"  href="#openElectVideo"><input type="checkbox"  />  	</a><br>
		  </form>
		  </fieldset>

        </div>

		</div>

       <div style="height:354px; width:480px; background:#fff;">
		<div style="margin-left:10px; background:#fff; font-size: 12px; font-family: microsoft sans serif;">
		<fieldset  class="scheduler-border">
		  <legend class="scheduler-border">Images</legend>
		  <form class="cont">
		    <a id="Electricalmages1" href="#openElectPDF"><input id="Electricalmages1" onchange="window.location.href='#openElectPDF'" type="checkbox" /><label for="Electricalmages1">&nbsp; Image Gallery - 4 port	</label></a><br>
			<a id="Electricalmages2"  href="#openElectPDF"><input id="Electricalmages2" onchange="window.location.href='#openElectPDF'" type="checkbox" /><label for="Electricalmages2">&nbsp; Image Gallery - bluetooth</label></a><br>
			<a id="Electricalmages3" href="#openElectPDF"><input id="Electricalmages3" onchange="window.location.href='#openElectPDF'" type="checkbox" /><label for="Electricalmages3">&nbsp; Image Gallery - brashless dc motor housing	</label></a><br>
			<a id="Electricalmages4"  href="#openElectPDF"><input id="Electricalmages4" onchange="window.location.href='#openElectPDF'" type="checkbox" /><label for="Electricalmages4">&nbsp;  Image Gallery - charger	</label></a><br>
			<a id="Electricalmages5"  href="#openElectPDF"><input id="Electricalmages5" onchange="window.location.href='#openElectPDF'" type="checkbox" /><label for="Electricalmages5">&nbsp;  Image Gallery - coffe grinder	</label></a><br>
			<a id="Electricalmages6"  href="#openElectPDF"><input id="Electricalmages6" onchange="window.location.href='#openElectPDF'" type="checkbox" /><label for="Electricalmages6">&nbsp;  Image Gallery - E-cycle</label></a><br>
			<a id="Electricalmages7" href="#openElectPDF"><input id="Electricalmages7" onchange="window.location.href='#openElectPDF'" type="checkbox" /><label for="Electricalmages7">&nbsp;  Image Gallery - Electric board	</label></a><br>
			<a id="Electricalmages8" href="#openElectPDF"><input id="Electricalmages8" onchange="window.location.href='#openElectPDF'" type="checkbox" /><label for="Electricalmages8">&nbsp; Image Gallery - Electric motor	</label></a><br>
			<a id="Electricalmages9"  href="#openElectPDF"><input id="Electricalmages9" onchange="window.location.href='#openElectPDF'" type="checkbox" /><label for="Electricalmages9">&nbsp;  Image Gallery - Electronic component parts	</label></a><br>
			<a id="Electricalmages10"  href="#openElectPDF"><input id="Electricalmages10" onchange="window.location.href='#openElectPDF'" type="checkbox" /><label for="Electricalmages10">&nbsp;  Image Gallery - Remote controled car	</label></a><br>
			<a id="Electricalmages11"  href="#openElectPDF"><input id="Electricalmages11" onchange="window.location.href='#openElectPDF'" type="checkbox" /><label for="Electricalmages11">&nbsp; Image Gallery - Submarine drive	</label></a><br>
			<a id="Electricalmages12"  href="#openElectPDF"><input id="Electricalmages12" onchange="window.location.href='#openElectPDF'" type="checkbox" /><label for="Electricalmages12">&nbsp; Image Gallery - Mouse robot	</label></a><br>
			<a id="Electricalmages13"  href="#openElectPDF"><input id="Electricalmages13" onchange="window.location.href='#openElectPDF'" type="checkbox" /><label for="Electricalmages13">&nbsp; Image Gallery - Photon-thermal	</label></a><br>
			<a id="Electricalmages14"  href="#openElectPDF"><input id="Electricalmages14" onchange="window.location.href='#openElectPDF'" type="checkbox" /><label for="Electricalmages14">&nbsp; Image Gallery - Hand-lamp	</label></a><br>

		  </form>
		</fieldset>
		 </div>

		</div>

    </div>
  </div>
  <div style="margin-top:9px; margin-left:25px;">
			<ul style="list-style:none;">
                <li name="Acknowledgement" id="Acknowledgement_elect" value="Acknowledgement_elect"><a href="#openElectPDF"><img
                                            src="Resources/Application Window/acknowledgement.png"></a></li>
				<li><a href="#"><img style="margin-left:420px; margin-top:-30px;"
                                            src="Resources/Application Window/cancel.png"></a></li>
			</ul>
       </div>
  </div>
  </div>
</div>
<!--END ELECTRICAL-->
<!--MECHANICAL-->
<div  id="disciplineMechanical" class="popupWindow">
<div style="width:540px; height:500px;">
<div class="appWindow vcontainer" style="width:540px; height: 29px">
<div class="modalHead">
<img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD &nbsp;-&nbsp; Mechanical</span>
<a href="#" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
</div>
</div>
<div>
<!--Primary Tab-->
 <div class="tabed" style="border: 5px solid #fff; margin-top: 40px; margin-left:13px; width:505px; height:375px;">
    <input type="radio" name="mechanical" id="MechTut" checked>
    <label style="margin-right:-90px;margin-top:-38px" class="priTab" for="MechTut" id="defaultOpenMech">Tutorials</label>
    <input type="radio" name="mechanical" id="Mechgall">
    <label style="margin-top:-38px" class="priTab2" style="" for="Mechgall">Gallery</label>
    <input type="radio" name="mechanical" id="tab-nav-7">
<!--Secondary-->
    <div class="tabs" style="margin-left: 10px; margin-top: 10px;">
      <div style="width:485px;">
        <div class="disciplineMech">
		  <li class="Mechlinks secTab2" onclick="openMech(event, 'AutoCADmechanical')" id="defaultOpenAutoMech">AutoCAD-Based</li>
          <li class="Mechlinks secTab" onclick="openMech(event, 'Mechanical_x')">AutoCAD Mechanical</li>
          <li class="Mechlinks secTab" onclick="openMech(event, 'AutoCADMech')">AutoCAD MEP</li>
          <li class="Mechlinks secTab" onclick="openMech(event, 'AutodeskInventor')">Autodesk Inventor</li>
        </div>

		<div id="AutoCADmechanical" class="disMechcontent secCont" style="width:460px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">AutoCAD-Based</legend>
		  <form class="cont">
		    <a id="AutoCADmechanical1" href="#openMechVideo"><input id="AutoCADmechanical1" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutoCADmechanical1">&nbsp;  45 degree flanged elbow in AutoCAD 3D tutorial	</label></a><br>
			<a id="AutoCADmechanical2" href="#openMechVideo"><input id="AutoCADmechanical2" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutoCADmechanical2">&nbsp; AutoCAD 3D butterfily valve free style</label></a><br>
			<a id="AutoCADmechanical3" href="#openMechVideo"><input id="AutoCADmechanical3" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutoCADmechanical3">&nbsp; AutoCAD 3D gallon modelling	</label></a><br>
			<a id="AutoCADmechanical4" href="#openMechVideo"><input id="AutoCADmechanical4" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutoCADmechanical4">&nbsp;  AutoCAD 3D mechanical modeling exercise	</label></a><br>
			<a id="AutoCADmechanical5" href="#openMechVideo"><input id="AutoCADmechanical5" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutoCADmechanical5">&nbsp; AutoCAD 3D tee fitting sexercise 	</label></a><br>
			<a id="AutoCADmechanical6" href="#openMechVideo"><input id="AutoCADmechanical6" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutoCADmechanical6">&nbsp;  AutoCAD 3D water pump how to draw water pump on AutoCAD training  	</label></a><br>
			<a id="AutoCADmechanical7" href="#openMechVideo"><input id="AutoCADmechanical7" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutoCADmechanical7">&nbsp;  AutoCAD 3D pulley belt of radiator motor - Drawing a belt pulley AutoCAD 	</label></a><br>
			<a id="AutoCADmechanical8" href="#openMechVideo"><input id="AutoCADmechanical8" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutoCADmechanical8">&nbsp;  AutoCAD MEP samples 	</label></a><br>
			<a id="AutoCADmechanical9" href="#openMechVideo"><input id="AutoCADmechanical9" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutoCADmechanical9">&nbsp;  AutoCAD MEP tutorial for beginners	</label></a><br>
			<a id="AutoCADmechanical10" href="#openMechVideo"><input id="AutoCADmechanical10" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutoCADmechanical10">&nbsp;  AutoCAD plummer block assembly practise	</label></a><br>
		  </form>
		  </fieldset>
        </div>

		<div id="Mechanical_x" class="disMechcontent secCont" style="width:460px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">AutoCAD Mechanical</legend>
		  <form class="cont">
		   <a id="Mechanical1" href="#openMechVideo"><input id="Mechanical1" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="Mechanical1">&nbsp;	Using drawing sheets in modelspace	</label></a><br>
			<a id="Mechanical2"  href="#openMechVideo"><input id="Mechanical2" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="Mechanical2">&nbsp; Creating and editing annotation views</label></a><br>
			<a id="Mechanical3" href="#openMechVideo"><input id="Mechanical3" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="Mechanical3">&nbsp; Standard parts	</label></a><br>
			<a id="Mechanical4"  href="#openMechVideo"><input id="Mechanical4" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="Mechanical4">&nbsp;  Calculating shaft strength	</label></a><br>
			<a id="Mechanical5"  href="#openMechVideo"><input id="Mechanical5" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="Mechanical5">&nbsp;  Cams and calculations	</label></a><br>
			<a id="Mechanical6"  href="#openMechVideo"><input id="Mechanical6" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="Mechanical6">&nbsp;  Content libraries 	</label></a><br>
			<a id="Mechanical7" href="#openMechVideo"><input id="Mechanical7" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="Mechanical7">&nbsp;  Drawing commands	</label></a><br>
			<a id="Mechanical8" href="#openMechVideo"><input id="Mechanical8" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="Mechanical8">&nbsp;  Hole charts	</label></a><br>
			<a id="Mechanical9"  href="#openMechVideo"><input id="Mechanical9" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="Mechanical9">&nbsp;  Interface	</label></a><br>
			<a id="Mechanical10"  href="#openMechVideo"><input id="Mechanical10" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="Mechanical10">&nbsp;  part lists	</label></a><br>
		   </form>
		  </fieldset>

        </div>

		<div id="AutoCADMech" class="disMechcontent secCont" style="width:460px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">AutoCAD MEP</legend>
		  <form class="cont">
		   <a id="AutoCADMech1"  href="#openMechVideo"><input id="AutoCADMech1" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutoCADMech1">&nbsp;  AutoCAD MEP overview	</label></a><br>
		   <a id="AutoCADMech2" href="#openMechVideo"><input id="AutoCADMech2" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutoCADMech2">&nbsp;	Adding piping	</label></a><br>
			<a id="AutoCADMech3"  href="#openMechVideo"><input id="AutoCADMech3" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutoCADMech3">&nbsp; Adding induct</label></a><br>
			<a id="AutoCADMech4" href="#openMechVideo"><input id="AutoCADMech4" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutoCADMech4">&nbsp; AutoCAD MEP 2014 annotating drawings	</label></a><br>
			<a id="AutoCADMech5"  href="#openMechVideo"><input id="AutoCADMech5" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutoCADMech5">&nbsp;  AutoCAD MEP 2014 coordinating designs	</label></a><br>
			<a id="AutoCADMech6"  href="#openMechVideo"><input id="AutoCADMech6" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutoCADMech6">&nbsp;  AutoCAD MEP 2014 creating a mechanical system	</label></a><br>
			<a id="AutoCADMech7"  href="#openMechVideo"><input id="AutoCADMech7" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutoCADMech7">&nbsp;  AutoCAD MEP 2014 creating a piping system  	</label></a><br>
			<a id="AutoCADMech8" href="#openMechVideo"><input id="AutoCADMech8" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutoCADMech8">&nbsp;  AutoCAD MEP 2014 creating a power system	</label></a><br>
			<a id="AutoCADMech9" href="#openMechVideo"><input id="AutoCADMech9" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutoCADMech9">&nbsp;  AutoCAD MEP 2014 customizing wall cleanups	</label></a><br>
			<a id="AutoCADMech10"  href="#openMechVideo"><input id="AutoCADMech10" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutoCADMech10">&nbsp;  AutoCAD MEP 2014 new features overview	</label></a><br>
			<a id="AutoCADMech11"  href="#openMechVideo"><input id="AutoCADMech11" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutoCADMech11">&nbsp;  AutoCAD MEP 2014 working with schedules	</label></a><br>

		  </form>
		  </fieldset>

        </div>

		<div id="RevitMech" class="disMechcontent secCont" style="width:460px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">Revit MEP</legend>
		  <form class="cont">
		   <a id="RevitMech1" href="#openMechVideo"><input type="checkbox"  />	</a><br>
			<a id="RevitMech2"  href="#openMechVideo"><input type="checkbox"  /> </a><br>
			<a id="RevitMech3" href="#openMechVideo"><input type="checkbox"  /> </a><br>
			<a id="RevitMech4"  href="#openMechVideo"><input type="checkbox"  />  	</a><br>
			<a id="RevitMech5"  href="#openMechVideo"><input type="checkbox"  />  </a><br>
			<a id="RevitMech6"  href="#openMechVideo"><input type="checkbox"  /> </a><br>
			<a id="RevitMech7" href="#openMechVideo"><input type="checkbox"  /> </a><br>
			<a id="RevitMech8" href="#openMechVideo"><input type="checkbox"  /> 	</a><br>
			<a id="RevitMech9"  href="#openMechVideo"><input type="checkbox"  /> 	</a><br>

		  </form>
		  </fieldset>

        </div>

		<div id="AutodeskInventor" class="disMechcontent secCont" style="width:460px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">Autodesk Inventor</legend>
		  <form class="cont">
		   <a id="AutodeskInventor1" href="#openMechVideo"><input id="AutodeskInventor1" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutodeskInventor1">&nbsp;	Build your inventor iqinventor 2016 new features	</label></a><br>
			<a id="AutodeskInventor2"  href="#openMechVideo"><input id="AutodeskInventor2" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutodeskInventor2">&nbsp; build your inventor iqinventor performance optimization</label></a><br>
			<a id="AutodeskInventor3" href="#openMechVideo"><input id="AutodeskInventor3" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutodeskInventor3">&nbsp; Introduction to Autodesk Inventor Professional	</label></a><br>
			<a id="AutodeskInventor4"  href="#openMechVideo"><input id="AutodeskInventor4" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutodeskInventor4">&nbsp;  Introduction to Autodesk Inventor	</label></a><br>
			<a id="AutodeskInventor5"  href="#openMechVideo"><input id="AutodeskInventor5" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutodeskInventor5">&nbsp;  Inventor 2018 what's new Inventor ideas	</label></a><br>
			<a id="AutodeskInventor6"  href="#openMechVideo"><input id="AutodeskInventor6" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutodeskInventor6">&nbsp;  Inventor 2018 what's new overview 	</label></a><br>
			<a id="AutodeskInventor7" href="#openMechVideo"><input id="AutodeskInventor7" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutodeskInventor7">&nbsp;  Working with Autodesk Inventor	</label></a><br>
			<a id="AutodeskInventor8" href="#openMechVideo"><input id="AutodeskInventor8" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutodeskInventor8">&nbsp;  Animated chaining autodesk inventor 	</label></a><br>
			<a id="AutodeskInventor9"  href="#openMechVideo"><input id="AutodeskInventor9" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutodeskInventor9">&nbsp;  Autodesk inventor visualization and rendering 	</label></a><br>
			<a id="AutodeskInventor10"  href="#openMechVideo"><input id="AutodeskInventor10" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="AutodeskInventor10">&nbsp;  Autodesk inventor 2011 visualization 	</label></a><br>

		  </form>
		  </fieldset>

        </div>
		</div>

		<div style="width:485px;">
		<div class="disciplineMech small">
          <li class="Mechlinks secTab2" onclick="openMech(event, 'Electricalmages_x')" id="MechimageOpen">Images</li>
          <li class="Mechlinks secTab" onclick="openMech(event, 'ElectricalAnimations_x')">Animations</li>
        </div>

		<div id="Electricalmages_x" class="disMechcontent secCont" style="width:460px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">Images</legend>
		  <form class="cont">
		 <a id="MechImages14" href="#openMechPDF"><input id="MechImages14" onchange="window.location.href='#openMechPDF'" type="checkbox" /><label for="MechImages14">&nbsp;	 Image Gallery Group 1	</label></a><br>
		  <a id="MechImages1" href="#openMechPDF"><input id="MechImages1" onchange="window.location.href='#openMechPDF'" type="checkbox" /><label for="MechImages1">&nbsp;	 Image Gallery - cylinder engine	</label></a><br>
			<a id="MechImages2"  href="#openMechPDF"><input id="MechImages2" onchange="window.location.href='#openMechPDF'" type="checkbox" /><label for="MechImages2">&nbsp;  Image Gallery - Ball valve </label></a><br>
			<a id="MechImages3" href="#openMechPDF"><input id="MechImages3" onchange="window.location.href='#openMechPDF'" type="checkbox" /><label for="MechImages3">&nbsp; Image Gallery - Components</label></a><br>
			<a id="MechImages4"  href="#openMechPDF"><input id="MechImages4" onchange="window.location.href='#openMechPDF'" type="checkbox" /><label for="MechImages4">&nbsp;  Image Gallery - CPU fan	</label></a><br>
			<a id="MechImages5"  href="#openMechPDF"><input id="MechImages5" onchange="window.location.href='#openMechPDF'" type="checkbox" /><label for="MechImages5">&nbsp; Image Gallery - Crankshaft</label></a><br>
			<a id="MechImages6"  href="#openMechPDF"><input id="MechImages6" onchange="window.location.href='#openMechPDF'" type="checkbox" /><label for="MechImages6">&nbsp; 	Image Gallery - Drill bit</label></a><br>
			<a id="MechImages7" href="#openMechPDF"><input id="MechImages7" onchange="window.location.href='#openMechPDF'" type="checkbox" /><label for="MechImages7">&nbsp;  AImage Gallery -Four Engine Educational Demo	</label></a><br>
			<a id="MechImages8" href="#openMechPDF"><input id="MechImages8" onchange="window.location.href='#openMechPDF'" type="checkbox" /><label for="MechImages8">&nbsp; Image Gallery - Kids bike.</label></a><br>
			<a id="MechImages9"  href="#openMechPDF"><input id="MechImages9" onchange="window.location.href='#openMechPDF'" type="checkbox" /><label for="MechImages9">&nbsp; Image Gallery - l Cup </label></a><br>
			<a id="MechImages10"  href="#openMechPDF"><input id="MechImages10" onchange="window.location.href='#openMechPDF'" type="checkbox" /><label for="MechImages10">&nbsp; Image Gallery - l Emergency knife </label></a><br>
			<a id="MechImages11"  href="#openMechPDF"><input id="MechImages11" onchange="window.location.href='#openMechPDF'" type="checkbox" /><label for="MechImages11">&nbsp; Image Gallery - l Roller Bearing </label></a><br>
			<a id="MechImages12"  href="#openMechPDF"><input id="MechImages12" onchange="window.location.href='#openMechPDF'" type="checkbox" /><label for="MechImages12">&nbsp; Image Gallery - Mechanical Hand  </label></a><br>
			<a id="MechImages13"  href="#openMechPDF"><input id="MechImages13" onchange="window.location.href='#openMechPDF'" type="checkbox" /><label for="MechImages13">&nbsp; Image Gallery - Microfiltation </label></a><br>

		  </form>
		  </fieldset>

        </div>

		<div id="ElectricalAnimations_x" class="disMechcontent secCont" style="width:460px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">Animations</legend>
		  <form class="cont">
		   <a id="MechAnimations1" href="#openMechVideo"><input id="MechAnimations1" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="MechAnimations1">&nbsp;	Animation with Autodesk Inventor 2014	</label></a><br>
			<a id="MechAnimations2"  href="#openMechVideo"><input id="MechAnimations2" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="MechAnimations2">&nbsp; Autodesk Inventor Animation - Quick closing valve assembly</label></a><br>
			<a id="MechAnimations3" href="#openMechVideo"><input id="MechAnimations3" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="MechAnimations3">&nbsp; Autodesk Inventor_ Twin Steam Engines Animation	</label></a><br>
			<a id="MechAnimations4"  href="#openMechVideo"><input id="MechAnimations4" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="MechAnimations4">&nbsp;  Cad inventor animation - Fishing Reel	</label></a><br>
			<a id="MechAnimations5"  href="#openMechVideo"><input id="MechAnimations5" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="MechAnimations5">&nbsp; Inventor 2015 - Animation Gear Box 	</label></a><br>
			<a id="MechAnimations6"  href="#openMechVideo"><input id="MechAnimations6" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="MechAnimations6">&nbsp; V12 Crankshaft Animation Autodesk Inventor, Autodesk Showcase	</label></a><br>
			<a id="MechAnimations7"  href="#openMechVideo"><input id="MechAnimations7" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="MechAnimations7">&nbsp; Creating Animations of Production Lines with Factory Design Suite	</label></a><br>
			<a id="MechAnimations8"  href="#openMechVideo"><input id="MechAnimations8" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="MechAnimations8">&nbsp; Creating Interactive Layout Presentations with Factory Design Suite	</label></a><br>
			<a id="MechAnimations9"  href="#openMechVideo"><input id="MechAnimations9" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="MechAnimations9">&nbsp; How Automatic Transmissions Work! 	</label></a><br>
			<a id="MechAnimations10"  href="#openMechVideo"><input id="MechAnimations10" onchange="window.location.href='#openMechVideo'" type="checkbox" /><label for="MechAnimations10">&nbsp; Torque Converter Movie	</label></a><br>


		  </form>
		  </fieldset>

        </div>
		</div>
    </div>
  </div>
  <div style="margin-top:9px; margin-left:25px;">
			<ul style="list-style:none;">
                <li name="Acknowledgement" id="Acknowledgement_mech" value="Acknowledgement_mech"><a href="#openMechPDF"><img
                                            src="Resources/Application Window/acknowledgement.png"></a></li>
				<li><a href="#"><img style="margin-left:420px; margin-top:-30px;"
                                            src="Resources/Application Window/cancel.png"></a></li>
			</ul>
       </div>
  </div>
  </div>
</div>
<!--END MECHANICAL-->
<!--SURVEYING-->
<div  id="disciplineSurveying" class="popupWindow">
<div style="width:540px; height:500px;">
<div class="appWindow vcontainer" style="width:540px; height: 29px">
<div class="modalHead">
<img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD &nbsp;-&nbsp; Surveying</span>
<a href="#" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
</div>
</div>
<div>
<!--Primary Tab-->
 <div class="tabed" style="border: 5px solid #fff; margin-top: 40px; margin-left:13px; width:505px; height:375px;">
    <input type="radio" name="survey" id="surveyTut" checked>
    <label style="margin-right:-90px;margin-top:-38px" class="priTab" for="surveyTut" id="defaultOpenSurvey">Tutorials</label>
    <input type="radio" name="survey" id="surveygall">
    <label style="margin-top:-38px" class="priTab2" style="" for="surveygall">Gallery</label>
    <input type="radio" name="survey" id="tab-nav-7">
<!--Secondary-->
    <div class="tabs" style="margin-left: 10px; margin-top: 10px;">
      <div style="width:485px;">
        <div class="disciplineSurvey">
		   <li class="Surveylinks secTab2" onclick="openSurvey(event, 'AutoCADsurvey')" id="defaultOpenAutoSurvey">AutoCAD-Based</li>
          <li class="Surveylinks secTab" onclick="openSurvey(event, 'AutoCADMap3D')">AutoCAD Map 3D</li>
          <li class="Surveylinks secTab" onclick="openSurvey(event, 'AutoCADCivil3D')">AutoCAD Civil 3D</li>
        </div>

		<div id="AutoCADsurvey" class="disSurveycontent secCont" style="width:460px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">AutoCAD-Based</legend>
		  <form class="cont">
		     <a id="AutoCADsurvey1" href="#openSurveyVideo"><input id="AutoCADsurvey1" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADsurvey1">&nbsp;  AutoCAD 11 plotting surveying data for alot	</label></a><br>
			<a id="AutoCADsurvey2" href="#openSurveyVideo"><input id="AutoCADsurvey2" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADsurvey2">&nbsp; AutoCAD for site planning drawing existing buildings and topography </label></a><br>
			<a id="AutoCADsurvey3" href="#openSurveyVideo"><input id="AutoCADsurvey3" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADsurvey3">&nbsp; AutoCAD tutorial how to draw site title boundary	</label></a><br>
			<a id="AutoCADsurvey4" href="#openSurveyVideo"><input id="AutoCADsurvey4" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADsurvey4">&nbsp;  Contour from google earth to AutoCAD	</label></a><br>
			<a id="AutoCADsurvey5" href="#openSurveyVideo"><input id="AutoCADsurvey5" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADsurvey5">&nbsp;  Geo referencing 	</label></a><br>
			<a id="AutoCADsurvey6" href="#openSurveyVideo"><input id="AutoCADsurvey6" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADsurvey6">&nbsp;  How to import xy coordinates from excel to AutoCAD 	</label></a><br>
			<a id="AutoCADsurvey7" href="#openSurveyVideo"><input id="AutoCADsurvey7" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADsurvey7">&nbsp;  How to plot a bearing in AutoCAD</label></a><br>
			<a id="AutoCADsurvey8" href="#openSurveyVideo"><input id="AutoCADsurvey8" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADsurvey8">&nbsp;  How to plot bearing 	</label></a><br>
			<a id="AutoCADsurvey9" href="#openSurveyVideo"><input id="AutoCADsurvey9" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADsurvey9">&nbsp;  Import excel points to AutoCAD	</label></a><br>
			<a id="AutoCADsurvey10" href="#openSurveyVideo"><input id="AutoCADsurvey10" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADsurvey10">&nbsp;  Swdtm drawing at reverse in AutoCAD</label></a><br>
			<a id="AutoCADsurvey11" href="#openSurveyVideo"><input id="AutoCADsurvey11" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADsurvey11">&nbsp;  Swdtm how to draw contour lines in AutoCAD	</label></a><br>
		  </form>
		  </fieldset>
        </div>

		<div id="AutoCADMap3D" class="disSurveycontent secCont" style="width:460px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">AutoCAD Map 3D</legend>
		  <form class="cont">
		   <a id="AutoCADMap3D1" href="#openSurveyVideo"><input id="AutoCADMap3D1" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADMap3D1">&nbsp;	3D data in AutoCAD Map 3D	</label></a><br>
			<a id="AutoCADMap3D2"  href="#openSurveyVideo"><input id="AutoCADMap3D2" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADMap3D2">&nbsp; AutoCAD map 3D user interface</label></a><br>
			<a id="AutoCADMap3D3" href="#openSurveyVideo"><input id="AutoCADMap3D3" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADMap3D3">&nbsp; AutoCAD map 3D and the spatial analysis flood analysis	</label></a><br>
			<a id="AutoCADMap3D4"  href="#openSurveyVideo"><input id="AutoCADMap3D4" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADMap3D4">&nbsp; Autodesk AutoCAD map 3D 2014 what'snew	</label></a><br>
			<a id="AutoCADMap3D5"  href="#openSurveyVideo"><input id="AutoCADMap3D5" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADMap3D5">&nbsp;  Autodesk infrastructure design suite mapping	</label></a><br>
			<a id="AutoCADMap3D6"  href="#openSurveyVideo"><input id="AutoCADMap3D6" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADMap3D6">&nbsp;  Buffer analysis	</label></a><br>
			<a id="AutoCADMap3D7" href="#openSurveyVideo"><input id="AutoCADMap3D7" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADMap3D7">&nbsp;  Clipping raster images	</label></a><br>
			<a id="AutoCADMap3D8" href="#openSurveyVideo"><input id="AutoCADMap3D8" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADMap3D8">&nbsp;  Digitization 	</label></a><br>
			<a id="AutoCADMap3D9"  href="#openSurveyVideo"><input id="AutoCADMap3D9" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADMap3D9">&nbsp;  Earth mine partner	</label></a><br>
			<a id="AutoCADMap3D10"  href="#openSurveyVideo"><input id="AutoCADMap3D10" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADMap3D10">&nbsp;  How to work with lidar point clouds in AutoCAD MAP 3D	</label></a><br>
			<a id="AutoCADMap3D11"  href="#openSurveyVideo"><input id="AutoCADMap3D11" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADMap3D11">&nbsp;  Make 3D point cloud models from lidar data using AutoCAD map 3D 2017	</label></a><br>
			<a id="AutoCADMap3D12"  href="#openSurveyVideo"><input id="AutoCADMap3D12" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADMap3D12">&nbsp;  MAP book	</label></a><br>
		   </form>
		  </fieldset>

        </div>

		<div id="AutoCADCivil3D" class="disSurveycontent secCont" style="width:460px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">AutoCAD Civil 3D</legend>
		  <form class="cont">
		   <a id="AutoCADCivil3D1" href="#openSurveyVideo"><input id="AutoCADCivil3D1" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADCivil3D1">&nbsp; AutoCAD civil 3D draping an image over a surface</label></a><br>
			<a id="AutoCADCivil3D2"  href="#openSurveyVideo"><input id="AutoCADCivil3D2" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADCivil3D2">&nbsp; Create AutoCAD civil3D parcels from objects</label></a><br>
			<a id="AutoCADCivil3D3" href="#openSurveyVideo"><input id="AutoCADCivil3D3" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADCivil3D3">&nbsp; Creating parcels</label></a><br>
			<a id="AutoCADCivil3D4"  href="#openSurveyVideo"><input id="AutoCADCivil3D4" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADCivil3D4">&nbsp; Exploring the traverse adjustment tool in civil 3D</label></a><br>
			<a id="AutoCADCivil3D5"  href="#openSurveyVideo"><input id="AutoCADCivil3D5" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADCivil3D5">&nbsp; Surface creation</label></a><br>
			<a id="AutoCADCivil3D6"  href="#openSurveyVideo"><input id="AutoCADCivil3D6" onchange="window.location.href='#openSurveyVideo'" type="checkbox" /><label for="AutoCADCivil3D6">&nbsp; Survey database point groups</label></a><br>
		  </form>
		  </fieldset>

        </div>
		</div>

		<div style="height:354px; width:480px; background:#fff;">
		<div style="margin-left:10px; background:#fff; font-size: 12px; font-family: microsoft sans serif;">
		<fieldset  class="scheduler-border">
		  <legend class="scheduler-border">Images</legend>
		 <form class="cont">
		   <a id="SurveyImages1" href="#openSurveyPDF"><input id="SurveyImages1" onchange="window.location.href='#openSurveyPDF'" type="checkbox" /><label for="SurveyImages1">&nbsp; Autodesk parcels	</label></a><br>
			<a id="SurveyImages2"  href="#openSurveyPDF"><input id="SurveyImages2" onchange="window.location.href='#openSurveyPDF'" type="checkbox" /><label for="SurveyImages2">&nbsp; Cicil-parcels</label></a><br>
			<a id="SurveyImages3" href="#openSurveyPDF"><input id="SurveyImages3" onchange="window.location.href='#openSurveyPDF'" type="checkbox" /><label for="SurveyImages3">&nbsp; 	Contours 1</label></a><br>
			<a id="SurveyImages4"  href="#openSurveyPDF"><input id="SurveyImages4" onchange="window.location.href='#openSurveyPDF'" type="checkbox" /><label for="SurveyImages4">&nbsp; Contours 2	</label></a><br>
			<a id="SurveyImages5"  href="#openSurveyPDF"><input id="SurveyImages5" onchange="window.location.href='#openSurveyPDF'" type="checkbox" /><label for="SurveyImages5">&nbsp; Kings land surveyors	</label></a><br>
			<a id="SurveyImages6"  href="#openSurveyPDF"><input id="SurveyImages6" onchange="window.location.href='#openSurveyPDF'" type="checkbox" /><label for="SurveyImages6">&nbsp; PM surveyors	</label></a><br>
			<a id="SurveyImages7" href="#openSurveyPDF"><input id="SurveyImages7" onchange="window.location.href='#openSurveyPDF'" type="checkbox" /><label for="SurveyImages7">&nbsp; Resolution surveys</label></a><br>
			<a id="SurveyImages8" href="#openSurveyPDF"><input id="SurveyImages8" onchange="window.location.href='#openSurveyPDF'" type="checkbox" /><label for="SurveyImages8">&nbsp;  Resolution surveyors 1	</label></a><br>
			<a id="SurveyImages9"  href="#openSurveyPDF"><input id="SurveyImages9" onchange="window.location.href='#openSurveyPDF'" type="checkbox" /><label for="SurveyImages9">&nbsp;  spatial manager	</label></a><br>
			<a id="SurveyImages10"  href="#openSurveyPDF"><input id="SurveyImages10" onchange="window.location.href='#openSurveyPDF'" type="checkbox" /><label for="SurveyImages10">&nbsp;  Topographical map</label></a><br>

		  </form>
		</fieldset>
		 </div>

		</div>

    </div>
  </div>
  <div style="margin-top:9px; margin-left:25px;">
			<ul style="list-style:none;">
                <li name="Acknowledgement" id="Acknowledgement_survey" value="Acknowledgement_survey"><a href="#openSurveyPDF"><img
                                            src="Resources/Application Window/acknowledgement.png"></a></li>
				<li><a href="#"><img style="margin-left:420px; margin-top:-30px;"
                                            src="Resources/Application Window/cancel.png"></a></li>
			</ul>
       </div>
  </div>
  </div>
</div>
<!--END SURVAYING-->
<!--PRODUCT DESIGN-->
<div  id="disciplineDesign" class="popupWindow">
<div style="width:540px; height:500px;">
<div class="appWindow vcontainer" style="width:540px; height: 29px">
<div class="modalHead">
<img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD &nbsp;-&nbsp; Product Design</span>
<a href="#" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
</div>
</div>
<div>
<!--Primary Tab-->
 <div class="tabed" style="border: 5px solid #fff; margin-top: 40px; margin-left:13px; width:505px; height:375px;">
    <input type="radio" name="design" id="DesignTut" checked>
    <label style="margin-right:-90px;margin-top:-38px" class="priTab" for="DesignTut" id="defaultOpenDesign">Tutorials</label>
    <input type="radio" name="design" id="Designgall">
    <label style="margin-top:-38px" class="priTab2" style="" for="Designgall">Gallery</label>
    <input type="radio" name="design" id="tab-nav-7">
<!---Secondary-->
    <div class="tabs" style="margin-left: 10px; margin-top: 10px;">
      <div style="width:485px;">
        <div class="disciplineDesign">
          <li class="Designlinks secTab" onclick="openDesign(event, '3DsMax')" id="defaultOpenAutoDesign">3Ds Max</li>
          <li class="Designlinks secTab" onclick="openDesign(event, 'AutoCADMaya')">AutoCAD Maya</li>
        </div>

		<div id="AutoCADDesign" class="disDesigncontent secCont" style="width:460px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">AutoCAD-Based</legend>
		  <form class="cont">
		     <a id="AutoCADDesign1" href="#openDesignVideo"><input type="checkbox" /> 	</a><br>
			<a id="AutoCADDesign2" href="#openDesignVideo"><input type="checkbox"/> </a><br>
			<a id="AutoCADDesign3" href="#openDesignVideo"><input type="checkbox" /> 	</a><br>
			<a id="AutoCADDesign4" href="#openDesignVideo"><input type="checkbox" />  	</a><br>
			<a id="AutoCADDesign5" href="#openDesignVideo"><input type="checkbox" /> 	</a><br>
			<a id="AutoCADDesign6" href="#openDesignVideo"><input type="checkbox" /> 	</a><br>
			<a id="AutoCADDesign7" href="#openDesignVideo"><input type="checkbox" /> </a><br>
			<a id="AutoCADDesign8" href="#openDesignVideo"><input type="checkbox" /> </a><br>
			<a id="AutoCADDesign9" href="#openDesignVideo"><input type="checkbox" />  	</a><br>
		  </form>
		  </fieldset>
        </div>

		<div id="3DsMax" class="disDesigncontent secCont" style="width:460px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">3Ds Max</legend>
		  <form class="cont">
		   <a id="3DsMax1" href="#openDesignVideo"><input id="3DsMax1" onchange="window.location.href='#openDesignVideo'" type="checkbox" /><label for="3DsMax1">&nbsp;	3D modeling and rendering using AutoCAD, 3Ds MAX and Vray	</label></a><br>
			<a id="3DsMax2"  href="#openDesignVideo"><input id="3DsMax2" onchange="window.location.href='#openDesignVideo'" type="checkbox" /><label for="3DsMax2">&nbsp; Audio heli </label></a><br>
			<a id="3DsMax3" href="#openDesignVideo"><input id="3DsMax3" onchange="window.location.href='#openDesignVideo'" type="checkbox" /><label for="3DsMax3">&nbsp; Post final heli,Maybach	</label></a><br>
			<a id="3DsMax4"  href="#openDesignVideo"><input id="3DsMax4" onchange="window.location.href='#openDesignVideo'" type="checkbox" /><label for="3DsMax4">&nbsp; Toureg	</label></a><br>
			<a id="3DsMax5"  href="#openDesignVideo"><input id="3DsMax5" onchange="window.location.href='#openDesignVideo'" type="checkbox" /><label for="3DsMax5">&nbsp;  Truck Vid </label></a><br>
			<a id="3DsMax6"  href="#openDesignVideo"><input id="3DsMax6" onchange="window.location.href='#openDesignVideo'" type="checkbox" /><label for="3DsMax6">&nbsp;  Working with 3Ds Max	</label></a><br>

		   </form>
		  </fieldset>

        </div>

		<div id="AutoCADMaya" class="disDesigncontent secCont" style="width:460px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">AutoCAD Maya</legend>
		  <form class="cont">
		  <a id="AutoCADMaya1" href="#openDesignVideo"><input id="AutoCADMaya1" onchange="window.location.href='#openDesignVideo'" type="checkbox" /><label for="AutoCADMaya1">&nbsp; Autodesk Maya 2013 ATOM Animation Transfer	</label></a><br>
			<a id="AutoCADMaya2"  href="#openDesignVideo"><input id="AutoCADMaya2" onchange="window.location.href='#openDesignVideo'" type="checkbox" /><label for="AutoCADMaya2">&nbsp; Autodesk Maya 2013 Dynamics </label></a><br>
			<a id="AutoCADMaya3" href="#openDesignVideo"><input id="AutoCADMaya3" onchange="window.location.href='#openDesignVideo'" type="checkbox" /><label for="AutoCADMaya3">&nbsp; Autodesk Maya 2013 HumanIK Enhancments	</label></a><br>
			<a id="AutoCADMaya4"  href="#openDesignVideo"><input id="AutoCADMaya4" onchange="window.location.href='#openDesignVideo'" type="checkbox" /><label for="AutoCADMaya4">&nbsp;  Autodesk Maya 2013 Workflow improvements	</label></a><br>
			<a id="AutoCADMaya5"  href="#openDesignVideo"><input id="AutoCADMaya5" onchange="window.location.href='#openDesignVideo'" type="checkbox" /><label for="AutoCADMaya5">&nbsp; Autodesk Maya-BMW i8 </label></a><br>
		  </form>
		  </fieldset>

        </div>
		</div>

		<div style="width:485px;">
		<div class="disciplineDesign small">
          <li class="Designlinks secTab2" onclick="openDesign(event, 'Designmages')" id="DesignimageOpen">Images</li>
          <li class="Designlinks secTab" onclick="openDesign(event, 'DesignAnimations')">Animations</li>
        </div>

		<div id="Designmages" class="disDesigncontent secCont" style="width:460px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">Images</legend>
		  <form class="cont">
		   <a id="Designmages1" href="#openDesignPDF"><input id="Designmages1" onchange="window.location.href='#openDesignPDF'" type="checkbox" /><label for="Designmages1">&nbsp; Image Gallery - Camera	</label></a><br>
			<a id="Designmages2"  href="#openDesignPDF"><input id="Designmages2" onchange="window.location.href='#openDesignPDF'" type="checkbox" /><label for="Designmages2">&nbsp; Image Gallery - Concept car </label></a><br>
			<a id="Designmages3"  href="#openDesignPDF"><input id="Designmages3" onchange="window.location.href='#openDesignPDF'" type="checkbox" /><label for="Designmages3">&nbsp; Image Gallery - Exterior </label></a><br>
			<a id="Designmages4"  href="#openDesignPDF"><input id="Designmages4" onchange="window.location.href='#openDesignPDF'" type="checkbox" /><label for="Designmages4">&nbsp; Image Gallery - Ghost rider</label> </a><br>
			<a id="Designmages5"  href="#openDesignPDF"><input id="Designmages5" onchange="window.location.href='#openDesignPDF'" type="checkbox" /><label for="Designmages5">&nbsp; Image Gallery - Helicopter.</label></a><br>
			<a id="Designmages6"  href="#openDesignPDF"><input id="Designmages6" onchange="window.location.href='#openDesignPDF'" type="checkbox" /><label for="Designmages6">&nbsp; Image Gallery - Robot </label></a><br>
			<a id="Designmages7"  href="#openDesignPDF"><input id="Designmages7" onchange="window.location.href='#openDesignPDF'" type="checkbox" /><label for="Designmages7">&nbsp; Image Gallery - Shoe</label></a><br>
			<a id="Designmages8"  href="#openDesignPDF"><input id="Designmages8" onchange="window.location.href='#openDesignPDF'" type="checkbox" /><label for="Designmages8">&nbsp; Image Gallery - Watch</label></a><br>


		  </form>
		  </fieldset>

        </div>

		<div id="DesignAnimations" class="disDesigncontent secCont" style="width:460px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">Animations</legend>
		  <form class="cont">
		   <a id="DesignAnimations1" href="#openDesignVideo"><input id="DesignAnimations1" onchange="window.location.href='#openDesignVideo'" type="checkbox" /><label for="DesignAnimations1">&nbsp; Post final heli,maybach	</label></a><br>
		   <a id="DesignAnimations2" href="#openDesignVideo"><input id="DesignAnimations2" onchange="window.location.href='#openDesignVideo'" type="checkbox" /><label for="DesignAnimations2">&nbsp; Animating a Car on a Path- Turning the Wheels	</label></a><br>
		  </form>
		  </fieldset>

        </div>
		</div>

    </div>
  </div>
  <div style="margin-top:9px; margin-left:25px;">
			<ul style="list-style:none;">
                <li name="Acknowledgement" id="Acknowledgement_design" value="Acknowledgement_design"><a href="#openDesignPDF"><img
                                            src="Resources/Application Window/acknowledgement.png"></a></li>
				<li><a href="#"><img style="margin-left:420px; margin-top:-30px;"
                                            src="Resources/Application Window/cancel.png"></a></li>
			</ul>
       </div>
  </div>
  </div>
</div>
<!--END PRODUCT DRSIGN-->

  <div  id="AutoCADGallery" class="popupWindow">
<div style="width:380px; height:400px;">
<div class="appWindow vcontainer" style="width:380px; height: 29px">
<div class="modalHead">
<img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD &nbsp;-&nbsp; AutoCAD-Based Gallery</span>
<a href="#" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
</div>
</div>
<div>

		<div style="width:350px;">
		<div class="discAutocad small" style="margin-left:35px; margin-top:10px">
          <li class="autolinks secTab2" onclick="openAutoCAD(event, 'AutoCADImages')" id="AutoImageOpen">Images</li>
          <li class="autolinks secTab" onclick="openAutoCAD(event, 'AutoCADAnimations')">Animations</li>
        </div>

		<div id="AutoCADImages" class="autocontent secCont" style="width:330px; margin-left:10px; height:320px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">Images</legend>
		  <form class="cont">
		   <a id="AutoCADImages1" href="#openAutoCADPDF"><input id="AutoCADImages1" onchange="window.location.href='#openAutoCADPDF'" type="checkbox" /><label for="AutoCADImages1">&nbsp;  AutoCAD Design Suite	</label></a><br>
			<a id="AutoCADImages2"  href="#openAutoCADPDF"><input id="AutoCADImages2" onchange="window.location.href='#openAutoCADPDF'" type="checkbox" /><label for="AutoCADImages2">&nbsp; AutoCAD Gallery Plain </label></a><br>
			<a id="AutoCADImages10"  href="#openAutoCADPDF"><input id="AutoCADImages10" onchange="window.location.href='#openAutoCADPDF'" type="checkbox" /><label for="AutoCADImages10">&nbsp; Glass properties</label></a><br>
			<a id="AutoCADImages3"  href="#openAutoCADPDF"><input id="AutoCADImages3" onchange="window.location.href='#openAutoCADPDF'" type="checkbox" /><label for="AutoCADImages3">&nbsp; Images gallery Other CAD Programmes- Group 1 </label></a><br>
			<a id="AutoCADImages4"  href="#openAutoCADPDF"><input id="AutoCADImages4" onchange="window.location.href='#openAutoCADPDF'" type="checkbox" /><label for="AutoCADImages4">&nbsp; Images gallery Other CAD Programmes- Group 2</label> </a><br>
			<a id="AutoCADImages5"  href="#openAutoCADPDF"><input id="AutoCADImages5" onchange="window.location.href='#openAutoCADPDF'" type="checkbox" /><label for="AutoCADImages5">&nbsp; Images gallery Other CAD Programmes- Group 3</label></a><br>
			<a id="AutoCADImages6"  href="#openAutoCADPDF"><input id="AutoCADImages6" onchange="window.location.href='#openAutoCADPDF'" type="checkbox" /><label for="AutoCADImages6">&nbsp; Images gallery Other CAD Programmes- Group 4 </label></a><br>
			<a id="AutoCADImages7"  href="#openAutoCADPDF"><input id="AutoCADImages7" onchange="window.location.href='#openAutoCADPDF'" type="checkbox" /><label for="AutoCADImages7">&nbsp; Images gallery Other CAD Programmes- Group 5</label></a><br>
			<a id="AutoCADImages8"  href="#openAutoCADPDF"><input id="AutoCADImages8" onchange="window.location.href='#openAutoCADPDF'" type="checkbox" /><label for="AutoCADImages8">&nbsp; Images gallery Other CAD Programmes- Group 6</label></a><br>
			<a id="AutoCADImages9"  href="#openAutoCADPDF"><input id="AutoCADImages9" onchange="window.location.href='#openAutoCADPDF'" type="checkbox" /><label for="AutoCADImages9">&nbsp; Images gallery Other CAD Programmes- Group 7 </label></a><br>


		  </form>
		  </fieldset>

        </div>

		<div id="AutoCADAnimations" class="autocontent secCont" style="width:330px;margin-left:10px; height:320px">
		<fieldset  class="scheduler-border">
		<legend class="scheduler-border">Animations</legend>
		  <form class="cont">
		   <a id="AutoCADAnimations1" href="#openAutoVideo"><input id="AutoCADAnimations1" onchange="window.location.href='#openAutoVideo'" type="checkbox" /><label for="AutoCADAnimations1">&nbsp; 3D Car in AutoCAD	</label></a><br>
		   <a id="AutoCADAnimations2" href="#openAutoVideo"><input id="AutoCADAnimations2" onchange="window.location.href='#openAutoVideo'" type="checkbox" /><label for="AutoCADAnimations2">&nbsp; 3D Modelling Jet Engine with Propeller in AutoCAD	</label></a><br>
		   <a id="AutoCADAnimations3" href="#openAutoVideo"><input id="AutoCADAnimations3" onchange="window.location.href='#openAutoVideo'" type="checkbox" /><label for="AutoCADAnimations3">&nbsp; AutoCAD 2102 Captured Live! Movie intro	</label></a><br>
		   <a id="AutoCADAnimations4" href="#openAutoVideo"><input id="AutoCADAnimations4" onchange="window.location.href='#openAutoVideo'" type="checkbox" /><label for="AutoCADAnimations4">&nbsp; AutoCAD Aircraft by SkyTOP Technologies Ltd	</label></a><br>


		  </form>
		  </fieldset>

        </div>
		</div>
  </div>
  </div>
</div>

<!-- Test your AutoCAD skills-->
<div  id="AutoCADExercise" class="popupWindow" style="margin-top:-60px">
<div style="width:660px; height:640;">
<div class="appWindow vcontainer" style="width:660px; height: 29px">
<div class="modalHead">
<img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD &nbsp;-&nbsp; AutoCAD Basic Certification</span>
<a href="#" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
</div>
</div>
		<div style="width:635px; margin-left:13px; margin-top:10px; background-color:#fff;">
		    <fieldset  class="scheduler-border4">
		<legend class="scheduler-border4">Objective</legend>
		      <p style="font-size:12px;margin-top:-20px;">The objective of AutoCAD Basics Level is to enable users to create a basic 2D drawing in AutoCAD.
		      <br>While not every tool, command or option is covered, users are introduced to the most essential tools and concepts including understanding the AutoCAD workspace and user interface, inserting reusable blocks, adding parametric constraints to objects among others.</p>
		  </fieldset>

		<fieldset  class="scheduler-border4">
		<legend class="scheduler-border4"style="align-text:center">Tools Applicable</legend>
		<form class="certrow" style="overflow:auto;margin-top:-20px;font-size:12px;width:595px">
		    <ul class="certcolumn" style="background-color:#fff; margin-left:10px;list-style:none">
		    <li>&nbsp;Show UCS Icon at Origin</li>
<li>&nbsp;Show UCS Icon</li>
<li>&nbsp;Hide UCS icon</li>
<li>&nbsp;X</li>
<li>&nbsp;Y</li>
<li>&nbsp;Z</li>
<li>&nbsp;View</li>
<li>&nbsp;Object</li>
<li>&nbsp;Face</li>
<li>&nbsp;UCS Icon, Properties</li>
<li>&nbsp;UCS</li>
<li>&nbsp;UCSMAN</li>
<li>&nbsp;UCS World</li>
<li>&nbsp;UCS Previous</li>
<li>&nbsp;Origin</li>
<li>&nbsp;Z-Axis Vector</li>
<li>&nbsp;3 Point</li>
<li>&nbsp;Polyline</li>
<li>&nbsp;3D Polyline</li>
<li>&nbsp;Arc</li>
<li>&nbsp;Circle</li>
<li>&nbsp;Ellipse</li>
<li>&nbsp;Line</li>
<li>&nbsp;Spline</li>
<li>&nbsp;Polygon</li>
<li>&nbsp;Rectangle</li>
<li>&nbsp;Helix</li>
<li>&nbsp;Ray</li>
<li>&nbsp;Construction line</li>
<li>&nbsp;Measure</li>
<li>&nbsp;Multiple points</li>
<li>&nbsp;Divide</li>
<li>&nbsp;Donut</li>
<li>&nbsp;Hatch</li>
<li>&nbsp;Gradient</li>
<li>&nbsp;Boundary</li>
<li>&nbsp;Region</li>
<li>&nbsp;Revision cloud</li>
<li>&nbsp;Wipeout</li>
<li>&nbsp;Top</li>
<li>&nbsp;Bottom</li>
<li>&nbsp;Left</li>
<li>&nbsp;Right</li>
<li>&nbsp;Front</li>
<li>&nbsp;Back</li>
<li>&nbsp;3D Mirror</li>
<li>&nbsp;3D Align</li>
<li>&nbsp;Erase</li>
<li>&nbsp;3D Move</li>
<li>&nbsp;3D Rotate</li>
</ul>
<ul class="certcolumn" style="background-color:#fff; margin-left:10px;list-style:none">
    <li>&nbsp;3D Scale</li>
<li>&nbsp;Move</li>
<li>&nbsp;Rotate</li>
<li>&nbsp;Scale</li>
<li>&nbsp;Copy</li>
<li>&nbsp;Stretch</li>
<li>&nbsp;Offset</li>
<li>&nbsp;Trim</li>
<li>&nbsp;Extend</li>
<li>&nbsp;Fillet</li>
<li>&nbsp;Chamfer</li>
<li>&nbsp;Rectangular Array</li>
<li>&nbsp;Polar Array</li>
<li>&nbsp;Path Array</li>
<li>&nbsp;Set to by layer</li>
<li>&nbsp;Change Space</li>
<li>&nbsp;Explode</li>
<li>&nbsp;Array Edit</li>
<li>&nbsp;Mirror</li>
<li>&nbsp;Align</li>
<li>&nbsp;Break</li>
<li>&nbsp;Break at point</li>
<li>&nbsp;Lengthen</li>
<li>&nbsp;Reverse</li>
<li>&nbsp;Edit Polyline</li>
<li>&nbsp;Edit Spline</li>
<li>&nbsp;Edit Hatch</li>
<li>&nbsp;Blend Curves</li>
<li>&nbsp;Top</li>
<li>&nbsp;Bottom</li>
<li>&nbsp;Left</li>
<li>&nbsp;Right</li>
<li>&nbsp;Front</li>
<li>&nbsp;Back</li>
<li>&nbsp;SW Isometric</li>
<li>&nbsp;SE Isometric</li>
<li>&nbsp;NE Isometric</li>
<li>&nbsp;NW Isometric</li>
<li>&nbsp;2D wireframe</li>
<li>&nbsp;Hidden</li>
<li>&nbsp;Conceptual</li>
<li>&nbsp;Hidden</li>
<li>&nbsp;Realistic</li>
<li>&nbsp;Shaded with edges</li>
<li>&nbsp;Shades of gray</li>
<li>&nbsp;Sketchy</li>
<li>&nbsp;Wireframe</li>
<li>&nbsp;X-ray</li>
<li>&nbsp;Parallel</li>
<li>&nbsp;Perspective</li>
    </ul>
    <ul class="certcolumn" style="background-color:#fff; margin-left:10px;list-style:none">
        <li>&nbsp;Massprop</li>
<li>&nbsp;Matchprop</li>
<li>&nbsp;Osnap</li>
<li>&nbsp;Section plane</li>
<li>&nbsp;Live section</li>
<li>&nbsp;Add jog</li>
<li>&nbsp;Generate section</li>
<li>&nbsp;Flatshot</li>
<li>&nbsp;Extract edges</li>
<li>&nbsp;Zoom extend</li>
<li>&nbsp;Zoom window</li>
<li>&nbsp;Zoom in</li>
<li>&nbsp;Zoom out</li>
<li>&nbsp;Zoom dynamic</li>
<li>&nbsp;Zoom scale</li>
<li>&nbsp;Zoom previous</li>
<li>&nbsp;Zoom center</li>
<li>&nbsp;Zoom all</li>
<li>&nbsp;Zoom realtime</li>
<li>&nbsp;Zoom object</li>
<li>&nbsp;Pan point</li>
<li>&nbsp;Pan realtime</li>
<li>&nbsp;Pan up</li>
<li>&nbsp;Pan down</li>
<li>&nbsp;Pan right</li>
<li>&nbsp;Pan left</li>
<li>&nbsp;Make object's layer current</li>
<li>&nbsp;Layer Previous</li>
<li>&nbsp;Layer Walk</li>
<li>&nbsp;Layer Match</li>
<li>&nbsp;Change to current Layer</li>
<li>&nbsp;Copy objects to new layer</li>
<li>&nbsp;Layers Isolate</li>
<li>&nbsp;Isolate Layer to Current Viewport</li>
<li>&nbsp;Layer Unisolate</li>
<li>&nbsp;Layer off</li>
<li>&nbsp;Turn All Layers On</li>
<li>&nbsp;Layer Freeze</li>
<li>&nbsp;Layer Lock</li>
<li>&nbsp;Layer Unlock</li>
<li>&nbsp;Layer Merge</li>
<li>&nbsp;Layer Delete</li>
<li>&nbsp;Layer</li>
<li>&nbsp;Layer States Manager</li>
<li>&nbsp;Color</li>
<li>&nbsp;Linetype</li>
<li>&nbsp;Lineweight</li>
<li>&nbsp;Transparency</li>
        </ul>
		 </form>
		  </fieldset>
		</div>
	  <div style="margin-top:15px;">

				<a style="margin-left:565px;" href="#"><button style="padding: 1px 18px;text-align: center;font-size: 12px; font-family:Arial;" type="button">Cancel</button></a>
				<br>
				<br>
       </div>
  </div>
  </div>

<div  id="IntermediateExercise" class="popupWindow" style="margin-top:-50px">
<div style="width:750px; height:660px;">
<div class="appWindow vcontainer" style="width:750px; height: 29px">
<div class="modalHead">
<img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD &nbsp;-&nbsp; Intermediate AutoCAD Certification</span>
<a href="#" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
</div>
</div>
		<div style="width:725px; margin-left:13px; margin-top:10px; background-color:#fff;">
		    <fieldset  class="scheduler-border4">
		<legend class="scheduler-border4">Objective</legend>
		      <p style="font-size:12px;margin-top:-20px;">The main objective of the intermediate level is to help users understand the tools and techniques available to increase productivity and in customization of the AutoCAD workspace.
		      <br>Concepts covered at this level include using annotative styles and objects, using field settings in objects, blocks, and attributes, inserting, defining, and editing attribute values, creating, publishing, and customizing sheets and sheet sets, understanding CAD standards among others.</p>
		  </fieldset>

		<fieldset  class="scheduler-border4">
		<legend class="scheduler-border4">Tools Applicable</legend>
		<form class="certrow" style="overflow:auto;margin-top:-20px;font-size:12px;width:680px">
		    <ul class="certcolumn" style="background-color:#fff; margin-left:10px;list-style:none">
		    <li>&nbsp;Dimscale</li>
<li>&nbsp;DDunits</li>
<li>&nbsp;Blocks</li>
<li>&nbsp;Dynamic Blocks </li>
<li>&nbsp;Create block</li>
<li>&nbsp;Write Block</li>
<li>&nbsp;Manage attributes</li>
<li>&nbsp;Block editor</li>
<li>&nbsp;Blockeditlock </li>
<li>&nbsp;Set base point</li>
<li>&nbsp;Synchronize</li>
<li>&nbsp;Redefining Blocks</li>
<li>&nbsp;Explode</li>
<li>&nbsp;Replace block</li>
<li>&nbsp;List properties</li>
<li>&nbsp;Import attributes</li>
<li>&nbsp;Export attributes</li>
<li>&nbsp;Convert block to xref</li>
<li>&nbsp;Copy nested objects</li>
<li>&nbsp;Extend to nested objects</li>
<li>&nbsp;Trim to nested objects</li>
<li>&nbsp;Retain attribute display</li>
<li>&nbsp;Display Attributes</li>
<li>&nbsp;Hide all attributes</li>
<li>&nbsp;Bparameter </li>
<li>&nbsp;Bauthorpalette </li>
<li>&nbsp;Align</li>
<li>&nbsp;Rotate</li>
<li>&nbsp;3D rotate</li>
<li>&nbsp;3D move</li>
<li>&nbsp;Move</li>
<li>&nbsp;Trim</li>
<li>&nbsp;Extend</li>
<li>&nbsp;Copy </li>
<li>&nbsp;3D align</li>
<li>&nbsp;Stretch</li>
<li>&nbsp;Fillet</li>
<li>&nbsp;Chamfer</li>
<li>&nbsp;Blend curve</li>
<li>&nbsp;3D scale</li>
<li>&nbsp;Scale</li>
<li>&nbsp;Offset</li>
<li>&nbsp;Rectangular array</li>
<li>&nbsp;Path array</li>
<li>&nbsp;Polar array</li>
<li>&nbsp;Set to by layer</li>

		    </ul>
		    <ul class="certcolumn" style="background-color:#fff; margin-left:10px;list-style:none">

<li>&nbsp;Change space</li>
<li>&nbsp;Explode</li>
<li>&nbsp;Array edit</li>
<li>&nbsp;Mirror</li>
<li>&nbsp;Break</li>
<li>&nbsp;Break at point</li>
<li>&nbsp;Reverse</li>
<li>&nbsp;Edit polyline</li>
<li>&nbsp;Edit spline</li>
<li>&nbsp;Edit hatch</li>
<li>&nbsp;Join</li>
<li>&nbsp;Lengthen</li>
<li>&nbsp;Datalink</li>
<li>&nbsp;Data extraction</li>
<li>&nbsp;Download from source</li>
<li>&nbsp;Upload to source</li>
<li>&nbsp;Polyline</li>
<li>&nbsp;Spline</li>
<li>&nbsp;Polygon</li>
<li>&nbsp;3d polyline</li>
<li>&nbsp;Hatch</li>
<li>&nbsp;Gradient</li>
<li>&nbsp;Boundary hatch</li>
<li>&nbsp;Region</li>
<li>&nbsp;Revision cloud</li>
<li>&nbsp;Wipeout</li>
<li>&nbsp;Multiline text</li>
<li>&nbsp;Single text</li>
<li>&nbsp;Annotative</li>
<li>&nbsp;Standard</li>
<li>&nbsp;Manage text style</li>
<li>&nbsp;Check spelling</li>
<li>&nbsp;Text align</li>
<li>&nbsp;Justify</li>
<li>&nbsp;Find text</li>
<li>&nbsp;Annotation text height</li>
<li>&nbsp;Scale</li>
<li>&nbsp;Arctext </li>
<li>&nbsp;Tilemode (system variable)</li>
<li>&nbsp;Mview </li>
<li>&nbsp;Viewports</li>
<li>&nbsp;Layer properties</li>
<li>&nbsp;Layer</li>
<li>&nbsp;LayOff</li>
<li>&nbsp;Isolate layer</li>
<li>&nbsp;Freeze layer</li>

		    </ul>
		    <ul class="certcolumn" style="background-color:#fff; margin-left:10px;list-style:none">

<li>&nbsp;Lock layer</li>
<li>&nbsp;Make current</li>
<li>&nbsp;Layon </li>
<li>&nbsp;Unisolate layer</li>
<li>&nbsp;Thaw all layers</li>
<li>&nbsp;Unlock layer</li>
<li>&nbsp;Match layer</li>
<li>&nbsp;Layer state</li>
<li>&nbsp;Previous layer</li>
<li>&nbsp;Change to current layer</li>
<li>&nbsp;Copy objects to new layer</li>
<li>&nbsp;Layer walk</li>
<li>&nbsp;VP freeze except current</li>
<li>&nbsp;Merge layer</li>
<li>&nbsp;Delete layer</li>
<li>&nbsp;Locked layer fading</li>
<li>&nbsp;New property filter</li>
<li>&nbsp;New group filter</li>
<li>&nbsp;Layer state manager</li>
<li>&nbsp;New layer</li>
<li>&nbsp;New layer VP frozen</li>
<li>&nbsp;GCCoincident </li>
<li>&nbsp;GCPerpendicular </li>
<li>&nbsp;GCParallel </li>
<li>&nbsp;GCTangent </li>
<li>&nbsp;GCHorizontal </li>
<li>&nbsp;GCVertical</li>
<li>&nbsp;GCCollinear</li>
<li>&nbsp;GCConcentric </li>
<li>&nbsp;AutoConstrain</li>
<li>&nbsp;Show/Hide geometric constraints</li>
<li>&nbsp;Show All geometric constraints</li>
<li>&nbsp;Hide All geometric constraints</li>
<li>&nbsp;DCAligned </li>
<li>&nbsp;DCHorizontal </li>
<li>&nbsp;DCVertical </li>
<li>&nbsp;DCAngular </li>
<li>&nbsp;DCRadius </li>
<li>&nbsp;DCDiameter </li>
<li>&nbsp;Show/Hide dynamic constraints</li>
<li>&nbsp;Show All dynamic constraints</li>
<li>&nbsp;Hide All dynamic constraints</li>
<li>&nbsp;Delete Constraints</li>
<li>&nbsp;Constraint Settings</li>
<li>&nbsp;Parameters Manager</li>
		    </ul>
		 </form>
		  </fieldset>
		</div>
		<div style="margin-top:15px;">

				<a style="margin-left:650px;" href="#"><button style="padding: 1px 18px;text-align: center;font-size: 12px; font-family:Arial;" type="button">Cancel</button></a>
				<br>
				<br>
       </div>
  </div>
  </div>

<div  id="Introduction3DExercise" class="popupWindow" style="margin-top:-50px">
<div style="width:650px; height:650px; top:-20px">
<div class="appWindow vcontainer" style="width:650px; height: 29px">
<div class="modalHead">
<img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD &nbsp;-&nbsp; Introduction to 3D Certification</span>
<a href="#" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
</div>
</div>
		<div style="width:625px; margin-left:13px; margin-top:10px; background-color:#fff;">
		    <fieldset  class="scheduler-border4">
		<legend class="scheduler-border4">Objective</legend>
		      <p style="font-size:12px;margin-top:-20px;">The objective of AutoCAD 3D is to introduce users who are proficient with the 2D commands in the AutoCAD software, to the concepts and methods of 3D drawing.
		      <br>The users are also introduced to more detailed and complex concepts such as using 3D viewing techniques, working with simple and composite solids, creating complex solids and surfaces, creating sections, camera perspectives, and animations, working with the User Coordinate System among others.</p>
		  </fieldset>

		<fieldset  class="scheduler-border4">
		<legend class="scheduler-border4">Tools Applicable</legend>
		<form class="certrow" style="overflow:auto;margin-top:-20px;font-size:12px;width:575px">
		    <ul class="certcolumn" style="background-color:#fff; margin-left:10px;list-style:none">
		    <li>&nbsp;3dalign</li>
<li>&nbsp;3dclip </li>
<li>&nbsp;3dcorbit </li>
<li>&nbsp;3ddistance </li>
<li>&nbsp;3ddwf </li>
<li>&nbsp;3dfly </li>
<li>&nbsp;3dforbit </li>
<li>&nbsp;3dmove </li>
<li>&nbsp;3dorbit </li>
<li>&nbsp;3dorbitctr </li>
<li>&nbsp;3dosnap </li>
<li>&nbsp;3dpan </li>
<li>&nbsp;3dpoly</li>
<li>&nbsp;3dprint </li>
<li>&nbsp;3dprintservice </li>
<li>&nbsp;3drotate </li>
<li>&nbsp;3dscale </li>
<li>&nbsp;3dswivel </li>
<li>&nbsp;3dwalk </li>
<li>&nbsp;3dzoom </li>
<li>&nbsp;Analysiscurvature </li>
<li>&nbsp;Analysisdraft </li>
<li>&nbsp;Analysisoptions </li>
<li>&nbsp;Analysiszebra </li>
<li>&nbsp;Anipath </li>
<li>&nbsp;Arc</li>
<li>&nbsp;Blend</li>
<li>&nbsp;Box </li>
<li>&nbsp;Camera </li>
<li>&nbsp;Chamferedge</li>
<li>&nbsp;Circle</li>
<li>&nbsp;Cone </li>
<li>&nbsp;Convertoldlights </li>
<li>&nbsp;Convtonurbs </li>
<li>&nbsp;Convtosolid </li>
<li>&nbsp;Convtosurface </li>
<li>&nbsp;Copy</li>
<li>&nbsp;Cvadd </li>
<li>&nbsp;Cvrebuild </li>
<li>&nbsp;Cvremove </li>
<li>&nbsp;Cvshow </li>
<li>&nbsp;Cylinder </li>
<li>&nbsp;Ddrmodes</li>
<li>&nbsp;Dimedit</li>
<li>&nbsp;Dsettings </li>
<li>&nbsp;Dview </li>

		    </ul>
		    <ul class="certcolumn" style="background-color:#fff; margin-left:10px;list-style:none">
<li>&nbsp;Elev</li>
<li>&nbsp;Ellispe</li>
<li>&nbsp;Erase </li>
<li>&nbsp;Explode</li>
<li>&nbsp;Export </li>
<li>&nbsp;Extend</li>
<li>&nbsp;Extrude</li>
<li>&nbsp;Fillet</li>
<li>&nbsp;Filletedge</li>
<li>&nbsp;Freespot </li>
<li>&nbsp;Freeweb </li>
<li>&nbsp;Hide</li>
<li>&nbsp;Igesimport </li>
<li>&nbsp;Import </li>
<li>&nbsp;Imprint</li>
<li>&nbsp;Interfere</li>
<li>&nbsp;Intersect</li>
<li>&nbsp;Isoplane</li>
<li>&nbsp;Light </li>
<li>&nbsp;Line</li>
<li>&nbsp;Livesection</li>
<li>&nbsp;Loft</li>
<li>&nbsp;Massprop</li>
<li>&nbsp;Materialmap</li>
<li>&nbsp;Materials browser</li>
<li>&nbsp;Mesh</li>
<li>&nbsp;Mirror3d </li>
<li>&nbsp;Move</li>
<li>&nbsp;Navbar</li>
<li>&nbsp;Navvcube</li>
<li>&nbsp;Offset </li>
<li>&nbsp;Offsetedge</li>
<li>&nbsp;Patch</li>
<li>&nbsp;Plan </li>
<li>&nbsp;Planesurf </li>
<li>&nbsp;Pointlight </li>
<li>&nbsp;Polygon</li>
<li>&nbsp;Polyline</li>
<li>&nbsp;Polysolid  </li>
<li>&nbsp;Presspull </li>
<li>&nbsp;Projectgeometry </li>
<li>&nbsp;Properties </li>
<li>&nbsp;Publish </li>
<li>&nbsp;Pyramid </li>
<li>&nbsp;Rectang</li>
<li>&nbsp;Regen3 </li>

		    </ul>
		    <ul class="certcolumn" style="background-color:#fff; margin-left:10px;list-style:none">
		        <li>&nbsp;Region</li>
<li>&nbsp;Render</li>
<li>&nbsp;Renderonline</li>
<li>&nbsp;Renderwindow</li>
<li>&nbsp;Revolve</li>
<li>&nbsp;Revsurf</li>
<li>&nbsp;Rmat</li>
<li>&nbsp;Rotate </li>
<li>&nbsp;Rotate3d </li>
<li>&nbsp;Scale</li>
<li>&nbsp;Sectionplane</li>
<li>&nbsp;Sectionplanejog</li>
<li>&nbsp;Sectionplanetoblock</li>
<li>&nbsp;Setuv</li>
<li>&nbsp;-shademode</li>
<li>&nbsp;Showrendergallery</li>
<li>&nbsp;Slice </li>
<li>&nbsp;Solidedit  </li>
<li>&nbsp;Sphere </li>
<li>&nbsp;Spline</li>
<li>&nbsp;Spotlight </li>
<li>&nbsp;Stlout </li>
<li>&nbsp;Strech</li>
<li>&nbsp;Subtract</li>
<li>&nbsp;Sunproperties</li>
<li>&nbsp;Surfblend </li>
<li>&nbsp;Surfnetwork </li>
<li>&nbsp;Surfoffset </li>
<li>&nbsp;Surfpatch </li>
<li>&nbsp;Surfsculpt </li>
<li>&nbsp;Sweep</li>
<li>&nbsp;Targetpoint </li>
<li>&nbsp;Thicken</li>
<li>&nbsp;Torus </li>
<li>&nbsp;Trim</li>
<li>&nbsp;Ucs </li>
<li>&nbsp;Ucsicon</li>
<li>&nbsp;Union</li>
<li>&nbsp;View</li>
<li>&nbsp;Visualstyles </li>
<li>&nbsp;-vpoint </li>
<li>&nbsp;-vports </li>
<li>&nbsp;Walkflysettings </li>
<li>&nbsp;Weblight </li>
<li>&nbsp;Wedge </li>
<li>&nbsp;Xedges</li>

		    </ul>
		 </form>
		  </fieldset>
		</div>
		<div style="margin-top:15px; margin-left:13px;">

				<a style="margin-left:540px;" href="#"><button style="padding: 1px 18px;text-align: center;font-size: 12px; font-family:Arial;margin-top:-50px" type="button">Cancel</button></a>
				<br>
				<br>
       </div>
  </div>
  </div>

<div  id="AdvancedTopicsExercise" class="popupWindow" style="margin-top:-50px">
<div style="width:670px; height:670;">
<div class="appWindow vcontainer" style="width:670px; height: 29px">
<div class="modalHead">
<img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD &nbsp;-&nbsp; Advanced Topics Certification</span>
<a href="#" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
</div>
</div>
		<div style="width:645px; margin-left:13px; margin-top:10px; background-color:#fff;">
		    <fieldset  class="scheduler-border4">
		<legend class="scheduler-border4">Objective</legend>
		      <p style="font-size:12px;margin-top:-20px;">The main objective of this level is to give users of AutoCAD an advanced understanding of the new and advance features, tools, commands, and techniques for creating, editing and printing drawings with AutoCAD.
		      <br>This level also aims to furnish users with other additional skills and knowledge such as implementing CAD standards, improving on Techniques for Customizing AutoCAD, understanding the AutoCAD 3D modelling environment, using System Variables among others.</p>
		  </fieldset>

		<fieldset  class="scheduler-border4">
		<legend class="scheduler-border4">Tools Applicable</legend>
		<form class="certrow" style="overflow:auto;margin-top:-20px;font-size:12px;width:600px">
		    <ul class="certcolumn" style="background-color:#fff; margin-left:10px;list-style:none">
		    <li>&nbsp;Osnap</li>
<li>&nbsp;Linetype</li>
<li>&nbsp;Ltscale</li>
<li>&nbsp;Lineweight</li>
<li>&nbsp;JPGOUT</li>
<li>&nbsp;DWFOUT</li>
<li>&nbsp;DXFIN</li>
<li>&nbsp;DXFOUT</li>
<li>&nbsp;3DSIN</li>
<li>&nbsp;BMPOUT</li>
<li>&nbsp;DDGRIPS</li>
<li>&nbsp;Distance</li>
<li>&nbsp;Radius</li>
<li>&nbsp;Angle</li>
<li>&nbsp;Area</li>
<li>&nbsp;Volume</li>
<li>&nbsp;Edge</li>
<li>&nbsp;Vertex</li>
<li>&nbsp;Face</li>
<li>&nbsp;Solid history</li>
<li>&nbsp;No filter</li>
<li>&nbsp;Time</li>
<li>&nbsp;Status</li>
<li>&nbsp;Id</li>
<li>&nbsp;Xref</li>
<li>&nbsp;Attach</li>
<li>&nbsp;Detatch</li>
<li>&nbsp;Reload</li>
<li>&nbsp;Unload</li>
<li>&nbsp;Bind</li>
<li>&nbsp;Table</li>
<li>&nbsp;Sheetset</li>
<li>&nbsp;Aliasedit</li>
<li>&nbsp;Quick dimension</li>
<li>&nbsp;Linear</li>
<li>&nbsp;Aligned</li>
<li>&nbsp;Arc length</li>
<li>&nbsp;Ordinate</li>
<li>&nbsp;Radius</li>
<li>&nbsp;Jogged</li>
<li>&nbsp;Diameter</li>
<li>&nbsp;Angular</li>
<li>&nbsp;Baseline</li>
<li>&nbsp;Continue</li>
<li>&nbsp;Dimension space</li>
<li>&nbsp;Dimension break</li>
<li>&nbsp;Multileader</li>
<li>&nbsp;Tolerance</li>
<li>&nbsp;Centermark</li>
<li>&nbsp;Inspection</li>
<li>&nbsp;Jogged linear</li>
<li>&nbsp;Oblique</li>
<li>&nbsp;Home</li>
<li>&nbsp;Angle</li>
<li>&nbsp;Left</li>
<li>&nbsp;Center</li>
<li>&nbsp;Right</li>
<li>&nbsp;Dimension</li>
<li>&nbsp;Override</li>
<li>&nbsp;Update</li>
<li>&nbsp;Reassociate dimension</li>
<li>&nbsp;Toolpalettepath</li>
<li>&nbsp;Dconversionmode</li>
<li>&nbsp;Ddwfprec</li>
<li>&nbsp;Dosmode</li>
<li>&nbsp;Dselectionmode</li>
<li>&nbsp;Acadlspasdoc</li>
<li>&nbsp;Actpath </li>
<li>&nbsp;Actrecpath</li>
<li>&nbsp;Actui</li>
<li>&nbsp;Aflags</li>
<li>&nbsp;Angbase</li>
<li>&nbsp;Angdir</li>
<li>&nbsp;Annoallvisible</li>
<li>&nbsp;Annoautoscale</li>
<li>&nbsp;Annomonitor</li>
<li>&nbsp;Annotativedwg</li>
<li>&nbsp;Apbox</li>
<li>&nbsp;Aperture</li>
<li>&nbsp;Appautoload</li>
<li>&nbsp;Applyglobalopacities</li>
<li>&nbsp;Arrayassociativity</li>
<li>&nbsp;Arraytype</li>
<li>&nbsp;Attdia</li>
<li>&nbsp;Attipe</li>
<li>&nbsp;Attmode</li>
<li>&nbsp;Attmulti</li>
<li>&nbsp;Attreq</li>
<li>&nbsp;Auditctl</li>
<li>&nbsp;Aunits</li>
<li>&nbsp;Auprec</li>
<li>&nbsp;Autodwfpublish</li>
<li>&nbsp;Automaticpub</li>
<li>&nbsp;Autosnap</li>
<li>&nbsp;Backgroundplot</li>
<li>&nbsp;Bactionbarmode</li>
<li>&nbsp;Bactioncolor</li>
<li>&nbsp;Bconstatusmode</li>
<li>&nbsp;Bdependencyhighlight</li>
<li>&nbsp;Bgripobjcolor</li>
<li>&nbsp;Bgripobjsize</li>
<li>&nbsp;Bindtype</li>
<li>&nbsp;Blockeditlock</li>
<li>&nbsp;Bparametercolor</li>
<li>&nbsp;Bparameterfont</li>
<li>&nbsp;Bparametersize</li>
<li>&nbsp;Bptexthorizontal</li>
<li>&nbsp;Btmarkdisplay</li>
<li>&nbsp;Bvmode</li>
<li>&nbsp;Cachemaxfiles</li>
<li>&nbsp;Cachemaxtotalsize</li>
<li>&nbsp;Calcinput</li>
<li>&nbsp;Cameradisplay</li>
<li>&nbsp;Cameraheight</li>
<li>&nbsp;Cannoscale</li>
<li>&nbsp;Capturethumbnails</li>
<li>&nbsp;Cbartransparency</li>
<li>&nbsp;Cconstraintform</li>
<li>&nbsp;Cecolor bylayer</li>
<li>&nbsp;Celtscale</li>
<li>&nbsp;Celtype</li>
<li>&nbsp;Celweight</li>
<li>&nbsp;Centercrossgap</li>
<li>&nbsp;Centercrosssize</li>
<li>&nbsp;Centerexe</li>
<li>&nbsp;Centerlayer</li>
<li>&nbsp;Centerltscale</li>
<li>&nbsp;Centerltype</li>
<li>&nbsp;Centerltypefile</li>
<li>&nbsp;Centermarkexe</li>
<li>&nbsp;Centermt</li>
<li>&nbsp;Cetransparency</li>
<li>&nbsp;Chamfera</li>
<li>&nbsp;Chamferb</li>
<li>&nbsp;Chamferc</li>
<li>&nbsp;Chamferd</li>
<li>&nbsp;Chammode</li>
<li>&nbsp;Circlerad</li>
<li>&nbsp;Clayer</li>
<li>&nbsp;Clayout</li>
<li>&nbsp;Clipromptlines</li>
<li>&nbsp;Clipromptupdate</li>
<li>&nbsp;Cmaterial</li>
<li>&nbsp;Cmddia</li>
<li>&nbsp;Cmdecho</li>
<li>&nbsp;Cmdinputhistorymax</li>
<li>&nbsp;Cmfadecolor</li>
<li>&nbsp;Cmfadeopacity</li>
<li>&nbsp;Cmleaderstyle</li>
<li>&nbsp;Cmljust</li>
<li>&nbsp;Cmlscale</li>
<li>&nbsp;Cmlstyle standard</li>
<li>&nbsp;Cmosnap</li>
<li>&nbsp;Colortheme</li>
<li>&nbsp;Commandpreview </li>
<li>&nbsp;Compass </li>
<li>&nbsp;Complexltpreview </li>
<li>&nbsp;Constraintbardisplay </li>
<li>&nbsp;Constraintbarmode </li>
<li>&nbsp;Constraintinfer </li>
<li>&nbsp;Constraintnameformat </li>
<li>&nbsp;Constraintsolvemode </li>
<li>&nbsp;Coords </li>
<li>&nbsp;Copymode </li>
<li>&nbsp;Cplotstyle </li>
<li>&nbsp;Crossingareacolor </li>
<li>&nbsp;Ctab model</li>
<li>&nbsp;Ctablestyle </li>
<li>&nbsp;Cullingobj </li>
<li>&nbsp;Cullingobjselection </li>
<li>&nbsp;Cursorbadge </li>
<li>&nbsp;Cursorsize </li>
<li>&nbsp;Cursortype </li>
<li>&nbsp;Cviewdetailstyle </li>
<li>&nbsp;Cviewsectionstyle </li>
<li>&nbsp;Cvport </li>
<li>&nbsp;Datalinknotify </li>
<li>&nbsp;Dblclkedit </li>
<li>&nbsp;Dctcust </li>
<li>&nbsp;Dctmain </li>
<li>&nbsp;Defaultgizmo </li>
<li>&nbsp;Defaultlighting </li>
<li>&nbsp;Defaultlightingtype </li>
<li>&nbsp;Deflplstyle </li>
<li>&nbsp;Defplstyle </li>
<li>&nbsp;Delobj </li>
<li>&nbsp;Demandload </li>
<li>&nbsp;Dgnframe </li>
<li>&nbsp;Dgnimportmax </li>
<li>&nbsp;Dgnimportmode </li>
<li>&nbsp;Dgnosnap </li>
<li>&nbsp;Dimadec </li>
<li>&nbsp;Dimalt </li>
<li>&nbsp;Dimaltd </li>
<li>&nbsp;Dimaltf </li>
<li>&nbsp;Dimaltrnd </li>
<li>&nbsp;Dimalttd </li>
<li>&nbsp;Dimalttz </li>
<li>&nbsp;Dimaltu </li>
<li>&nbsp;Dimaltz </li>
<li>&nbsp;Dimapost </li>
<li>&nbsp;Dimarcsym </li>
<li>&nbsp;Dimassoc </li>
<li>&nbsp;Dimasz </li>
<li>&nbsp;Dimatfit </li>
<li>&nbsp;Dimaunit </li>
<li>&nbsp;Dimazin </li>
<li>&nbsp;Dimblk </li>
<li>&nbsp;Dimblk </li>
<li>&nbsp;Dimblk </li>
<li>&nbsp;Dimcen </li>
<li>&nbsp;Dimclrd </li>
<li>&nbsp;Dimclre </li>
<li>&nbsp;Dimclrt </li>
<li>&nbsp;Dimconstrainticon </li>
<li>&nbsp;Dimcontinuemode </li>
<li>&nbsp;Dimdec </li>
<li>&nbsp;Dimdle </li>
<li>&nbsp;Dimdli </li>
<li>&nbsp;Dimdsep</li>
<li>&nbsp;Dimexe </li>
<li>&nbsp;Dimexo </li>
<li>&nbsp;Dimfrac </li>
<li>&nbsp;Dimfxl </li>
<li>&nbsp;Dimfxlon </li>
<li>&nbsp;Dimgap 9</li>
<li>&nbsp;Dimjogang </li>
<li>&nbsp;Dimjust </li>
<li>&nbsp;Dimlayer </li>
<li>&nbsp;Dimldrblk </li>
<li>&nbsp;Dimlfac </li>
<li>&nbsp;Dimlim </li>
<li>&nbsp;Dimltex </li>
<li>&nbsp;Dimltex </li>
<li>&nbsp;Dimltype </li>
<li>&nbsp;Dimlunit </li>
<li>&nbsp;Dimlwd -</li>
<li>&nbsp;Dimlwe -</li>
<li>&nbsp;Dimpickbox </li>
<li>&nbsp;Dimpost </li>
<li>&nbsp;Dimrnd </li>
<li>&nbsp;Dimsah </li>
<li>&nbsp;Dimscale </li>
<li>&nbsp;Dimsd </li>
<li>&nbsp;Dimsd </li>
<li>&nbsp;Dimse </li>
<li>&nbsp;Dimse </li>
<li>&nbsp;Dimsoxd </li>
<li>&nbsp;Dimtad </li>
<li>&nbsp;Dimtdec </li>
<li>&nbsp;Dimtfac </li>
<li>&nbsp;Dimtfill </li>
<li>&nbsp;Dimtfillclr </li>
<li>&nbsp;Dimtih </li>
<li>&nbsp;Dimtix </li>
<li>&nbsp;Dimtm </li>
<li>&nbsp;Dimtmove </li>
<li>&nbsp;Dimtofl </li>
<li>&nbsp;Dimtoh </li>
<li>&nbsp;Dimtol </li>
<li>&nbsp;Dimtolj </li>
<li>&nbsp;Dimtp </li>
<li>&nbsp;Dimtsz </li>
<li>&nbsp;Dimtvp </li>
<li>&nbsp;Dimtxsty </li>
<li>&nbsp;Dimtxt </li>
<li>&nbsp;Dimtxtdirection </li>
<li>&nbsp;Dimtxtruler </li>
<li>&nbsp;Dimtzin </li>
<li>&nbsp;Dimupt </li>
<li>&nbsp;Dimzin </li>
<li>&nbsp;Dispsilh </li>
<li>&nbsp;Divmeshboxheight </li>
<li>&nbsp;Divmeshboxlength </li>
<li>&nbsp;Divmeshboxwidth </li>
<li>&nbsp;Divmeshconeaxis </li>
<li>&nbsp;Divmeshconebase </li>
<li>&nbsp;Divmeshconeheight </li>
<li>&nbsp;Divmeshcylaxis </li>
<li>&nbsp;Divmeshcylbase </li>
<li>&nbsp;Divmeshcylheight </li>
<li>&nbsp;Divmeshpyrbase </li>
<li>&nbsp;Divmeshpyrheight </li>
<li>&nbsp;Divmeshpyrlength </li>
<li>&nbsp;Divmeshsphereaxis </li>
<li>&nbsp;Divmeshsphereheight </li>
<li>&nbsp;Divmeshtoruspath </li>

            </ul>
            <ul class="certcolumn" style="background-color:#fff;margin-left:10px;list-style:none">
                <li>&nbsp;Divmeshtorussection </li>
<li>&nbsp;Divmeshwedgebase </li>
<li>&nbsp;Divmeshwedgeheight </li>
<li>&nbsp;Divmeshwedgelength </li>
<li>&nbsp;Divmeshwedgeslope </li>
<li>&nbsp;Divmeshwedgewidth </li>
<li>&nbsp;Donutid </li>
<li>&nbsp;Donutod </li>
<li>&nbsp;Dragmode </li>
<li>&nbsp;Dragp </li>
<li>&nbsp;Dragp </li>
<li>&nbsp;Dragvs </li>
<li>&nbsp;Draworderctl </li>
<li>&nbsp;Dtexted </li>
<li>&nbsp;Dwfframe </li>
<li>&nbsp;Dwfosnap </li>
<li>&nbsp;Dwgcheck </li>
<li>&nbsp;Dxeval </li>
<li>&nbsp;Dynconstraintmode </li>
<li>&nbsp;Dyndigrip </li>
<li>&nbsp;Dyndivis </li>
<li>&nbsp;Dyninfotips </li>
<li>&nbsp;Dynmode </li>
<li>&nbsp;Dynpicoords </li>
<li>&nbsp;Dynpiformat </li>
<li>&nbsp;Dynpivis </li>
<li>&nbsp;Dynprompt </li>
<li>&nbsp;Dyntooltips </li>
<li>&nbsp;Edgemode </li>
<li>&nbsp;Elevation </li>
<li>&nbsp;Erhighlight </li>
<li>&nbsp;Expert </li>
<li>&nbsp;Explmode </li>
<li>&nbsp;Exporteplotformat </li>
<li>&nbsp;Exportmodelspace </li>
<li>&nbsp;Exportpagesetup </li>
<li>&nbsp;Exportpaperspace </li>
<li>&nbsp;Expvalue </li>
<li>&nbsp;Expwhitebalance </li>
<li>&nbsp;Extnames </li>
<li>&nbsp;Faceterdevnormal </li>
<li>&nbsp;Faceterdevsurface </li>
<li>&nbsp;Facetergridratio </li>
<li>&nbsp;Facetermaxedgelength </li>
<li>&nbsp;Facetermaxgrid </li>
<li>&nbsp;Facetermeshtype </li>
<li>&nbsp;Faceterminugrid </li>
<li>&nbsp;Faceterminvgrid </li>
<li>&nbsp;Faceterprimitivemode </li>
<li>&nbsp;Facetersmoothlev </li>
<li>&nbsp;Facetratio </li>
<li>&nbsp;Facetres </li>
<li>&nbsp;Fbximportlog </li>
<li>&nbsp;Fielddisplay </li>
<li>&nbsp;Fieldeval </li>
<li>&nbsp;Filedia </li>
<li>&nbsp;Filetabthumbhover </li>
<li>&nbsp;Filletrad </li>
<li>&nbsp;Filletradd </li>
<li>&nbsp;Fillmode </li>
<li>&nbsp;Fontalt </li>
<li>&nbsp;Fontmap </li>
<li>&nbsp;Frame </li>
<li>&nbsp;Frameselection </li>
<li>&nbsp;Fullplotpath </li>
<li>&nbsp;Galleryview </li>
<li>&nbsp;Geolatlongformat </li>
<li>&nbsp;Geomarkervisibility </li>
<li>&nbsp;Geomarkpositionsize </li>
<li>&nbsp;Gfang </li>
<li>&nbsp;Gfclr </li>
<li>&nbsp;Gfclr </li>
<li>&nbsp;Gfclrlum </li>
<li>&nbsp;Gfclrstate </li>
<li>&nbsp;Gfname </li>
<li>&nbsp;Gfshift </li>
<li>&nbsp;Globalopacity </li>
<li>&nbsp;Griddisplay </li>
<li>&nbsp;Gridmajor </li>
<li>&nbsp;Gridmode </li>
<li>&nbsp;Gridstyle </li>
<li>&nbsp;Gridunit</li>
<li>&nbsp;Gripblock </li>
<li>&nbsp;Gripcolor </li>
<li>&nbsp;Gripcontour </li>
<li>&nbsp;Gripdyncolor </li>
<li>&nbsp;Griphot </li>
<li>&nbsp;Griphover </li>
<li>&nbsp;Gripmultifunctional </li>
<li>&nbsp;Gripobjlimit </li>
<li>&nbsp;Grips </li>
<li>&nbsp;Gripsize </li>
<li>&nbsp;Gripsubobjmode </li>
<li>&nbsp;Griptips </li>
<li>&nbsp;Groupdisplaymode </li>
<li>&nbsp;Gtauto </li>
<li>&nbsp;Gtdefault </li>
<li>&nbsp;Gtlocation </li>
<li>&nbsp;Halogap </li>
<li>&nbsp;Helpprefix </li>
<li>&nbsp;Hidetext </li>
<li>&nbsp;Highlight </li>
<li>&nbsp;Highlightsmoothing </li>
<li>&nbsp;Hpang </li>
<li>&nbsp;Hpannotative </li>
<li>&nbsp;Hpassoc </li>
<li>&nbsp;Hpbackgroundcolor </li>
<li>&nbsp;Hpbound </li>
<li>&nbsp;Hpboundretain </li>
<li>&nbsp;Hpcolor </li>
<li>&nbsp;Hpdlgmode </li>
<li>&nbsp;Hpdouble </li>
<li>&nbsp;Hpdraworder </li>
<li>&nbsp;Hpgaptol </li>
<li>&nbsp;Hpinherit </li>
<li>&nbsp;Hpislanddetection </li>
<li>&nbsp;Hpislanddetectionmode </li>
<li>&nbsp;Hplayer </li>
<li>&nbsp;Hplinetype </li>
<li>&nbsp;Hpmaxareas </li>
<li>&nbsp;Hpmaxlines </li>
<li>&nbsp;Hpname ansi</li>
<li>&nbsp;Hpobjwarning </li>
<li>&nbsp;Hporigin</li>
<li>&nbsp;Hporiginmode </li>
<li>&nbsp;Hpquickpreview </li>
<li>&nbsp;Hpquickprevtimeout </li>
<li>&nbsp;Hpscale </li>
<li>&nbsp;Hpseparate </li>
<li>&nbsp;Hpspace </li>
<li>&nbsp;Hptransparency </li>
<li>&nbsp;Hqgeom </li>
<li>&nbsp;Hyperlinkbase </li>
<li>&nbsp;Iblenvironment </li>
<li>&nbsp;Imageframe </li>
<li>&nbsp;Imagehlt </li>
<li>&nbsp;Impliedface </li>
<li>&nbsp;Indexctl </li>
<li>&nbsp;Inetlocation</li>
<li>&nbsp;Inputhistorymode </li>
<li>&nbsp;Inputsearchdelay </li>
<li>&nbsp;Insbase </li>
<li>&nbsp;Insname </li>
<li>&nbsp;Insunits </li>
<li>&nbsp;Insunitsdefsource </li>
<li>&nbsp;Insunitsdeftarget </li>
<li>&nbsp;Intelligentupdate </li>
<li>&nbsp;Interferecolor </li>
<li>&nbsp;Interfereobjvs </li>
<li>&nbsp;Interferevpvs </li>
<li>&nbsp;Intersectioncolor </li>
<li>&nbsp;Intersectiondisplay </li>
<li>&nbsp;Isavebak </li>
<li>&nbsp;Isavepercent </li>
<li>&nbsp;Isolines </li>
<li>&nbsp;Largeobjectsupport </li>
<li>&nbsp;Lastpoint </li>
<li>&nbsp;Latitude </li>
<li>&nbsp;Layerdlgmode </li>
<li>&nbsp;Layereval </li>
<li>&nbsp;Layerevalctl </li>
<li>&nbsp;Layerfilteralert </li>
<li>&nbsp;Layernotify </li>
<li>&nbsp;Laylockfadectl </li>
<li>&nbsp;Layoutcreateviewport </li>
<li>&nbsp;Layoutregenctl </li>
<li>&nbsp;Layouttab </li>
<li>&nbsp;Legacycodesearch </li>
<li>&nbsp;Legacyctrlpick </li>
<li>&nbsp;Lenslength </li>
<li>&nbsp;Lightglyphdisplay </li>
<li>&nbsp;Lightingunits </li>
<li>&nbsp;Lightsinblocks </li>
<li>&nbsp;Limcheck </li>
<li>&nbsp;Limmax </li>
<li>&nbsp;Limmin </li>
<li>&nbsp;Linefading </li>
<li>&nbsp;Linefadinglevel </li>
<li>&nbsp;Linesmoothing </li>
<li>&nbsp;Lockui </li>
<li>&nbsp;Loftang </li>
<li>&nbsp;Loftmag </li>
<li>&nbsp;Loftnormals </li>
<li>&nbsp;Loftparam </li>
<li>&nbsp;Logfilemode </li>
<li>&nbsp;Logfilepath </li>
<li>&nbsp;Longitude </li>
<li>&nbsp;Ltgapselection </li>
<li>&nbsp;Ltscale </li>
<li>&nbsp;Lunits </li>
<li>&nbsp;Luprec </li>
<li>&nbsp;Lwdefault </li>
<li>&nbsp;Lwdisplay </li>
<li>&nbsp;Lwunits </li>
<li>&nbsp;Maxactvp </li>
<li>&nbsp;Maxsort </li>
<li>&nbsp;Mbuttonpan </li>
<li>&nbsp;Measureinit </li>
<li>&nbsp;Measurement </li>
<li>&nbsp;Menubar </li>
<li>&nbsp;Menuecho </li>
<li>&nbsp;Meshtype </li>
<li>&nbsp;Mirrhatch </li>
<li>&nbsp;Mirrtext </li>
<li>&nbsp;Mleaderscale </li>
<li>&nbsp;Modemacro </li>
<li>&nbsp;Msltscale </li>
<li>&nbsp;Msolescale </li>
<li>&nbsp;Mtextautostack </li>
<li>&nbsp;Mtextcolumn </li>
<li>&nbsp;Mtextdetectspace </li>
<li>&nbsp;Mtexted </li>
<li>&nbsp;Mtextfixed </li>
<li>&nbsp;Mtexttoolbar </li>
<li>&nbsp;Mtjigstring abc</li>
<li>&nbsp;Navbardisplay </li>
<li>&nbsp;Navswheelmode </li>
<li>&nbsp;Navswheelopacitybig </li>
<li>&nbsp;Navswheelopacitymini </li>
<li>&nbsp;Navswheelsizebig </li>
<li>&nbsp;Navswheelsizemini </li>
<li>&nbsp;Navvcubedisplay </li>
<li>&nbsp;Navvcubelocation </li>
<li>&nbsp;Navvcubeopacity </li>
<li>&nbsp;Navvcubeorient </li>
<li>&nbsp;Navvcubesize </li>
<li>&nbsp;Nomutt </li>
<li>&nbsp;Northdirection </li>
<li>&nbsp;Objectisolationmode </li>
<li>&nbsp;Obscuredcolor </li>
<li>&nbsp;Obscuredltype </li>
<li>&nbsp;Offsetdist -</li>
<li>&nbsp;Offsetgaptype </li>
<li>&nbsp;Oleframe </li>
<li>&nbsp;Olehide </li>
<li>&nbsp;Olequality </li>
<li>&nbsp;Olestartup </li>
<li>&nbsp;Onlinesynctime </li>
<li>&nbsp;Openpartial </li>
<li>&nbsp;Orbitautotarget </li>
<li>&nbsp;Orthomode </li>
<li>&nbsp;Osmode </li>
<li>&nbsp;Osnapcoord </li>
<li>&nbsp;Osnapnodelegacy </li>
<li>&nbsp;Osnapoverride </li>
<li>&nbsp;Osnapz </li>
<li>&nbsp;Osoptions </li>
<li>&nbsp;Paletteopaque </li>
<li>&nbsp;Paperupdate </li>
<li>&nbsp;Parametercopymode </li>
<li>&nbsp;Pdfframe </li>
<li>&nbsp;Pdfimportfilter </li>
<li>&nbsp;Pdfimportimagepath </li>
<li>&nbsp;Pdfimportlayers </li>
<li>&nbsp;Pdfimportmode </li>
<li>&nbsp;Pdfosnap </li>
<li>&nbsp;Pdfshx </li>
<li>&nbsp;Pdfshxbestfont </li>
<li>&nbsp;Pdfshxlayer </li>
<li>&nbsp;Pdfshxthreshold </li>
<li>&nbsp;Pdmode </li>
<li>&nbsp;Pdsize </li>
<li>&nbsp;Peditaccept </li>
<li>&nbsp;Pellipse </li>
<li>&nbsp;Perspective </li>
<li>&nbsp;Perspectiveclip </li>
<li>&nbsp;Pickadd </li>
<li>&nbsp;Pickauto </li>
<li>&nbsp;Pickbox </li>
<li>&nbsp;Pickdrag </li>
<li>&nbsp;Pickfirst </li>
<li>&nbsp;Pickstyle </li>
<li>&nbsp;Plineconvertmode </li>
<li>&nbsp;Plinegcenmax </li>
<li>&nbsp;Plinegen </li>
<li>&nbsp;Plinereversewidths </li>
<li>&nbsp;Plinetype </li>
<li>&nbsp;Plinewid </li>
<li>&nbsp;Plotoffset </li>
<li>&nbsp;Plotrotmode </li>
<li>&nbsp;Plottransparencyoverride </li>
<li>&nbsp;Plquiet </li>
<li>&nbsp;Pointclouddvsdisplay </li>
<li>&nbsp;Pointcloudautoupdate </li>
<li>&nbsp;Pointcloudboundary </li>
<li>&nbsp;Pointcloudcachesize </li>
<li>&nbsp;Pointcloudclipframe </li>

            </ul>
            <ul class="certcolumn" style="background-color:#fff;margin-left:10px;list-style:none">
                <li>&nbsp;Pointclouddensity </li>
<li>&nbsp;Pointcloudlighting </li>
<li>&nbsp;Pointcloudlightsource </li>
<li>&nbsp;Pointcloudlock</li>
<li>&nbsp;Pointcloudlod </li>
<li>&nbsp;Pointcloudpointmax </li>
<li>&nbsp;Pointcloudpointmaxlegacy </li>
<li>&nbsp;Pointcloudpointsize </li>
<li>&nbsp;Pointcloudrtdensity </li>
<li>&nbsp;Pointcloudshading </li>
<li>&nbsp;Pointcloudvisretain </li>
<li>&nbsp;Polaraddang </li>
<li>&nbsp;Polarang </li>
<li>&nbsp;Polardist </li>
<li>&nbsp;Polarmode </li>
<li>&nbsp;Polysides </li>
<li>&nbsp;Preselectioneffect </li>
<li>&nbsp;Previewcreationtransparency</li>
<li>&nbsp;Previewfilter </li>
<li>&nbsp;Previewtype </li>
<li>&nbsp;Projectname </li>
<li>&nbsp;Projmode </li>
<li>&nbsp;Propertypreview </li>
<li>&nbsp;Propobjlimit </li>
<li>&nbsp;Propprevtimeout </li>
<li>&nbsp;Proxygraphics </li>
<li>&nbsp;Proxynotice </li>
<li>&nbsp;Proxyshow </li>
<li>&nbsp;Psltscale </li>
<li>&nbsp;Psolheight </li>
<li>&nbsp;Psolwidth </li>
<li>&nbsp;Pstylepolicy </li>
<li>&nbsp;Psvpscale </li>
<li>&nbsp;Publishallsheets </li>
<li>&nbsp;Publishcollate </li>
<li>&nbsp;Publishhatch </li>
<li>&nbsp;Pucsbase </li>
<li>&nbsp;Qplocation </li>
<li>&nbsp;Qpmode -</li>
<li>&nbsp;Qtextmode </li>
<li>&nbsp;Qvdrawingpin </li>
<li>&nbsp;Qvlayoutpin </li>
<li>&nbsp;Rasterdpi </li>
<li>&nbsp;Rasterpercent </li>
<li>&nbsp;Rasterpreview -</li>
<li>&nbsp;Rasterthreshold </li>
<li>&nbsp;Rebuilddcv </li>
<li>&nbsp;Rebuildddegree </li>
<li>&nbsp;Rebuilddoption </li>
<li>&nbsp;Rebuilddegreeu </li>
<li>&nbsp;Rebuilddegreev </li>
<li>&nbsp;Rebuildoptions </li>
<li>&nbsp;Rebuildu </li>
<li>&nbsp;Rebuildv </li>
<li>&nbsp;Recoverauto </li>
<li>&nbsp;Recoverymode </li>
<li>&nbsp;Refpathtype </li>
<li>&nbsp;Regenmode </li>
<li>&nbsp;Re-init </li>
<li>&nbsp;Rememberfolders </li>
<li>&nbsp;Renderenvstate </li>
<li>&nbsp;Renderlevel </li>
<li>&nbsp;Renderlightcalc </li>
<li>&nbsp;Rendertarget </li>
<li>&nbsp;Rendertime </li>
<li>&nbsp;Renderuserlights </li>
<li>&nbsp;Reporterror </li>
<li>&nbsp;Revcloudcreatemode </li>
<li>&nbsp;Revcloudgrips </li>
<li>&nbsp;Ribbonbgload </li>
<li>&nbsp;Ribboncontextsellim </li>
<li>&nbsp;Ribbondockedheight </li>
<li>&nbsp;Ribboniconresize </li>
<li>&nbsp;Ribbonselectmode </li>
<li>&nbsp;Rolloveropacity </li>
<li>&nbsp;Rollovertips </li>
<li>&nbsp;Rtdisplay </li>
<li>&nbsp;Savefidelity </li>
<li>&nbsp;Savefilepath</li>
<li>&nbsp;Savetime </li>
<li>&nbsp;Sectionoffsetinc </li>
<li>&nbsp;Sectionthicknessinc </li>
<li>&nbsp;Secureload </li>
<li>&nbsp;Selectionannodisplay </li>
<li>&nbsp;Selectionarea </li>
<li>&nbsp;Selectionareaopacity </li>
<li>&nbsp;Selectioncycling -</li>
<li>&nbsp;Selectioneffect </li>
<li>&nbsp;Selectioneffectcolor </li>
<li>&nbsp;Selectionoffscreen </li>
<li>&nbsp;Selectionpreview </li>
<li>&nbsp;Selectionpreviewlimit </li>
<li>&nbsp;Selectsimilarmode </li>
<li>&nbsp;Setbylayermode </li>
<li>&nbsp;Shadedge </li>
<li>&nbsp;Shadedif </li>
<li>&nbsp;Shadowplanelocation </li>
<li>&nbsp;Shortcutmenu </li>
<li>&nbsp;Shortcutmenuduration </li>
<li>&nbsp;Showhist </li>
<li>&nbsp;Showlayerusage </li>
<li>&nbsp;Showmotionpin </li>
<li>&nbsp;Showpagesetupfornewlayouts </li>
<li>&nbsp;Shpname </li>
<li>&nbsp;Sigwarn </li>
<li>&nbsp;Sketchinc </li>
<li>&nbsp;Skpoly </li>
<li>&nbsp;Sktolerance </li>
<li>&nbsp;Skystatus </li>
<li>&nbsp;Smoothmeshconvert </li>
<li>&nbsp;Smoothmeshgrid</li>
<li>&nbsp;Smoothmeshmaxface </li>
<li>&nbsp;Smoothmeshmaxlev </li>
<li>&nbsp;Snapang </li>
<li>&nbsp;Snapbase </li>
<li>&nbsp;Snapgridlegacy </li>
<li>&nbsp;Snapisopair </li>
<li>&nbsp;Snapmode </li>
<li>&nbsp;Snapstyl </li>
<li>&nbsp;Snaptype </li>
<li>&nbsp;Snapunit </li>
<li>&nbsp;Solidcheck </li>
<li>&nbsp;Solidhist </li>
<li>&nbsp;Sortents </li>
<li>&nbsp;Sortorder </li>
<li>&nbsp;Spaceswitch </li>
<li>&nbsp;Spldegree </li>
<li>&nbsp;Splframe </li>
<li>&nbsp;Splinesegs </li>
<li>&nbsp;Splinetype </li>
<li>&nbsp;Splknots </li>
<li>&nbsp;Splmethod </li>
<li>&nbsp;Splperiodic </li>
<li>&nbsp;Sslocate </li>
<li>&nbsp;Ssmautoopen </li>
<li>&nbsp;Ssmpolltime </li>
<li>&nbsp;Ssmsheetstatus </li>
<li>&nbsp;Standardsviolation </li>
<li>&nbsp;Startmode </li>
<li>&nbsp;Startup </li>
<li>&nbsp;Statusbar </li>
<li>&nbsp;Stepsize </li>
<li>&nbsp;Stepspersec </li>
<li>&nbsp;Subobjselectionmode </li>
<li>&nbsp;Sunstatus </li>
<li>&nbsp;Suppressalerts </li>
<li>&nbsp;Surfaceassociativity </li>
<li>&nbsp;Surfaceassociativitydrag </li>
<li>&nbsp;Surfaceautotrim </li>
<li>&nbsp;Surfacemodelingmode </li>
<li>&nbsp;Surftab </li>
<li>&nbsp;Surftab </li>
<li>&nbsp;Surftype </li>
<li>&nbsp;Surfu </li>
<li>&nbsp;Surfv </li>
<li>&nbsp;Sysmon </li>
<li>&nbsp;Tableindicator </li>
<li>&nbsp;Tabletoolbar </li>
<li>&nbsp;Tabmode </li>
<li>&nbsp;Tbcustomize </li>
<li>&nbsp;Tbshowshortcuts </li>
<li>&nbsp;Tempoverrides </li>
<li>&nbsp;Textalignmode </li>
<li>&nbsp;Textalignspacing </li>
<li>&nbsp;Textallcaps </li>
<li>&nbsp;Textautocorrectcaps </li>
<li>&nbsp;Texted </li>
<li>&nbsp;Texteditmode </li>
<li>&nbsp;Texteval </li>
<li>&nbsp;Textfill </li>
<li>&nbsp;Textoutputfileformat </li>
<li>&nbsp;Textqlty </li>
<li>&nbsp;Textsize </li>
<li>&nbsp;Textstyle </li>
<li>&nbsp;Thickness </li>
<li>&nbsp;Thumbsave </li>
<li>&nbsp;Thumbsize </li>
<li>&nbsp;Tilemode </li>
<li>&nbsp;Timezone </li>
<li>&nbsp;Tooltipmerge </li>
<li>&nbsp;Tooltips </li>
<li>&nbsp;Tooltipsize </li>
<li>&nbsp;Tooltiptransparency </li>
<li>&nbsp;Touchmode </li>
<li>&nbsp;Trackpath </li>
<li>&nbsp;Transparencydisplay </li>
<li>&nbsp;Trayicons </li>
<li>&nbsp;Traynotify </li>
<li>&nbsp;Traytimeout </li>
<li>&nbsp;Treedepth </li>
<li>&nbsp;Treemax </li>
<li>&nbsp;Trimmode </li>
<li>&nbsp;Trusteddomains </li>
<li>&nbsp;Trustedpaths </li>
<li>&nbsp;Tspacefac </li>
<li>&nbsp;Tspacetype </li>
<li>&nbsp;Tstackalign </li>
<li>&nbsp;Tstacksize </li>
<li>&nbsp;Ucsddisplaysetting </li>
<li>&nbsp;Ucsdparadisplaysetting </li>
<li>&nbsp;Ucsdperpdisplaysetting </li>
<li>&nbsp;Ucsaxisang 9</li>
<li>&nbsp;Ucsbase </li>
<li>&nbsp;Ucsdetect </li>
<li>&nbsp;Ucsfollow </li>
<li>&nbsp;Ucsicon or</li>
<li>&nbsp;Ucsortho </li>
<li>&nbsp;Ucsselectmode </li>
<li>&nbsp;Ucsview </li>
<li>&nbsp;Ucsvp </li>
<li>&nbsp;Unitmode </li>
<li>&nbsp;Uosnap </li>
<li>&nbsp;Updatethumbnail </li>
<li>&nbsp;Useri</li>
<li>&nbsp;Userr </li>
<li>&nbsp;Users </li>
<li>&nbsp;Viewupdateauto </li>
<li>&nbsp;Visretain </li>
<li>&nbsp;Vpcontrol </li>
<li>&nbsp;Vplayeroverridesmode </li>
<li>&nbsp;Vprotateassoc </li>
<li>&nbsp;Vsacurvaturehigh </li>
<li>&nbsp;Vsacurvaturelow </li>
<li>&nbsp;Vsacurvaturetype </li>
<li>&nbsp;Vsadraftanglehigh </li>
<li>&nbsp;Vsadraftanglelow </li>
<li>&nbsp;Vsazebracolor </li>
<li>&nbsp;Vsazebracolor </li>
<li>&nbsp;Vsazebradirection </li>
<li>&nbsp;Vsazebrasize </li>
<li>&nbsp;Vsazebratype </li>
<li>&nbsp;Vsbackgrounds </li>
<li>&nbsp;Vsedgecolor byentity</li>
<li>&nbsp;Vsedgejitter </li>
<li>&nbsp;Vsedgelex </li>
<li>&nbsp;Vsedgeoverhang </li>
<li>&nbsp;Vsedges </li>
<li>&nbsp;Vsedgesmooth </li>
<li>&nbsp;Vsfacecolormode </li>
<li>&nbsp;Vsfacehighlight </li>
<li>&nbsp;Vsfaceopacity </li>
<li>&nbsp;Vsfacestyle </li>
<li>&nbsp;Vshalogap </li>
<li>&nbsp;Vshideprecision </li>
<li>&nbsp;Vsintersectioncolor </li>
<li>&nbsp;Vsintersectionedges </li>
<li>&nbsp;Vsintersectionltype </li>
<li>&nbsp;Vsisoontop </li>
<li>&nbsp;Vslightingquality </li>
<li>&nbsp;Vsmaterialmode </li>
<li>&nbsp;Vsmonocolor rgb</li>
<li>&nbsp;Vsobscuredcolor byentity</li>
<li>&nbsp;Vsobscurededges </li>
<li>&nbsp;Vsobscuredltype </li>
<li>&nbsp;Vsoccludedcolor byentity</li>
<li>&nbsp;Vsoccludededges </li>
<li>&nbsp;Vsoccludedltype </li>
<li>&nbsp;Vsshadows </li>
<li>&nbsp;Vssilhedges </li>
<li>&nbsp;Vssilhwidth </li>
<li>&nbsp;Vtduration </li>
<li>&nbsp;Vtenable </li>
<li>&nbsp;Vtfps </li>
<li>&nbsp;Whiparc </li>
<li>&nbsp;Whipthread </li>
<li>&nbsp;Windowareacolor </li>
<li>&nbsp;Wipeoutframe </li>
<li>&nbsp;Wmfbkgnd </li>
<li>&nbsp;Wmfforegnd </li>
<li>&nbsp;Workspacelabel </li>
<li>&nbsp;Worldview </li>
<li>&nbsp;Wsautosave </li>
<li>&nbsp;Wscurrent </li>
<li>&nbsp;Xclipframe </li>
<li>&nbsp;Xdwgfadectl </li>
<li>&nbsp;Xedit </li>
<li>&nbsp;Xfadectl </li>
<li>&nbsp;Xloadctl </li>
<li>&nbsp;Xloadpath </li>
<li>&nbsp;Xrefctl </li>
<li>&nbsp;Xrefnotify </li>
<li>&nbsp;Xrefoverride </li>
<li>&nbsp;Xrefregappctl </li>
<li>&nbsp;Xreftype </li>
<li>&nbsp;Zoomfactor </li>
<li>&nbsp;Zoomwheel  </li>
            </ul>
        </form>
		  </fieldset>
		</div>
		<div style="margin-top:15px; margin-left:13px;">
				<a style="margin-left:555px;" href="#"><button style="padding: 1px 18px;text-align: center;font-size: 12px; font-family:Arial;" type="button">Cancel</button></a>
				<br>
				<br>
       </div>
  </div>
  </div>
<!-- End Test your AutoCAD skilld-->
<div  id="MovieCharges" class="popupWindow">
<div style="width:350px; height:200px;">
<div class="appWindow vcontainer" style="width:350px; height: 25px">
<div class="modalHead">
<img class="discImage" src="mike/icon.png"><span>&nbsp;&nbsp;&nbsp;SkyTOP DemosCAD &nbsp;-&nbsp; Captured Live Movie</span>
<a href="#" title="Close" class="newClose" style=""><span>&#x2715;</span></a>
</div>
</div>
	<div style="width:320px; margin-left:13px; margin-top:10px; background-color:#fff; height:auto; font-size: 13px; height:120px;">
		<p style="margin-left:13px; margin-top:10px;">
		<br>
		 10 minutes will be deducted from your token value. Click <strong>Ok</strong> to proceed or Cancel to terminate.
		</p>
		</div>
		<div style="margin-top:5px; margin-left:13px;">
                <a id="AutoCADCapturedLive" href="#openVideo"><button style="padding: 1px 18px;text-align: center;font-size: 12px; font-family:Arial;" type="button">Ok</button></a>
				<a style="margin-left:185px;" href="#"><button style="padding: 1px 18px;text-align: center;font-size: 12px; font-family:Arial;" type="button">Cancel</button></a>
       </div>
  </div>
  </div>


<script src="css/prefix.js"></script>
<script>
function openapplications(evt, cityName) {
    var i, appcontent, applinks;
    appcontent = document.getElementsByClassName("appcontent");
    for (i = 0; i < appcontent.length; i++) {
        appcontent[i].style.display = "none";
    }
    applinks = document.getElementsByClassName("applinks");
    for (i = 0; i < applinks.length; i++) {
        applinks[i].className = applinks[i].className.replace(" Appactive", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " Appactive";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpenApp").click();
</script>
<script>
document.getElementById("AutoImageOpen").click();
</script>
<script>
function openArch(evt, cityName) {
    var i, disArchcontent, Archlinks;
    disArchcontent = document.getElementsByClassName("disArchcontent");
    for (i = 0; i < disArchcontent.length; i++) {
        disArchcontent[i].style.display = "none";
    }
    Archlinks = document.getElementsByClassName("Archlinks");
    for (i = 0; i < Archlinks.length; i++) {
        Archlinks[i].className = Archlinks[i].className.replace(" Archactive", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " Archactive";
}

</script>

<script>
function openCivil(evt, cityName) {
    var i, disCivilcontent, Civillinks;
    disCivilcontent = document.getElementsByClassName("disCivilcontent");
    for (i = 0; i < disCivilcontent.length; i++) {
        disCivilcontent[i].style.display = "none";
    }
    Civillinks = document.getElementsByClassName("Civillinks");
    for (i = 0; i < Civillinks.length; i++) {
        Civillinks[i].className = Civillinks[i].className.replace(" Civilactive", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " Civilactive";
}

</script>
<script>
function openElect(evt, cityName) {
    var i, disElectcontent, Electlinks;
    disElectcontent = document.getElementsByClassName("disElectcontent");
    for (i = 0; i < disElectcontent.length; i++) {
        disElectcontent[i].style.display = "none";
    }
    Electlinks = document.getElementsByClassName("Electlinks");
    for (i = 0; i < Electlinks.length; i++) {
        Electlinks[i].className = Electlinks[i].className.replace(" Electactive", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " Electactive";
}

</script>

<script>
function openMech(evt, cityName) {
    var i, disMechcontent, Mechlinks;
    disMechcontent = document.getElementsByClassName("disMechcontent");
    for (i = 0; i < disMechcontent.length; i++) {
        disMechcontent[i].style.display = "none";
    }
    Mechlinks = document.getElementsByClassName("Mechlinks");
    for (i = 0; i < Mechlinks.length; i++) {
        Mechlinks[i].className = Mechlinks[i].className.replace(" Mechactive", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " Mechactive";
}

</script>

<script>
function openSurvey(evt, cityName) {
    var i, disSurveycontent, Surveylinks;
    disSurveycontent = document.getElementsByClassName("disSurveycontent");
    for (i = 0; i < disSurveycontent.length; i++) {
        disSurveycontent[i].style.display = "none";
    }
    Surveylinks = document.getElementsByClassName("Surveylinks");
    for (i = 0; i < Surveylinks.length; i++) {
        Surveylinks[i].className = Surveylinks[i].className.replace(" Surveyactive", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " Surveyactive";
}

</script>

<script>
function openDesign(evt, cityName) {
    var i, disDesigncontent, Designlinks;
    disDesigncontent = document.getElementsByClassName("disDesigncontent");
    for (i = 0; i < disDesigncontent.length; i++) {
        disDesigncontent[i].style.display = "none";
    }
    Designlinks = document.getElementsByClassName("Designlinks");
    for (i = 0; i < Designlinks.length; i++) {
        Designlinks[i].className = Designlinks[i].className.replace(" Designactive", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " Designactive";
}

</script>



<script>
    $('input[type="checkbox"]').on('change', function () {
        $('input[type="checkbox"]').not(this).prop('checked', false);
    });
</script>

<script>
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
        showDivs(slideIndex += n);
    }

    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        if (n > x.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = x.length
        }
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        x[slideIndex - 1].style.display = "block";
    }
</script>

<script>
    $('#main').click(function () {
        $('#joyce').attr('src', 'img1.jpg');
        $('#side').show();
        $('#ucs1').show();
        $('#mWheel').show();
        $('#wheel').show();
        $('#side2').hide();
    });
    $('#mk').click(function () {
        $('#joyce').attr('src', 'img5.jpg');
        $('#side').hide();
        $('#mWheel').hide();
        $('#ucs1').hide();
        $('#wheel').hide();
        $('#side2').show();
        $('#side2').css({'visibility': 'visible'});
    });
    $('#mk2').click(function () {
        $('#joyce').attr('src', 'img5.jpg');
        $('#side').hide();
        $('#mWheel').hide();
        $('#ucs1').hide();
        $('#wheel').hide();
        $('#side2').show();
        $('#side2').css({'visibility': 'visible'});
    });


</script>
<script type="text/javascript">


    function sendToPage() {

    }
</script>
<script>
    document.getElementById('noSpaces').onkeyup = function () {
        // Validate that the first letter is A-Za-z and capture it
        var letter = this.value.match(/^([A-Za-z])/);

        // If a letter was found

    }
</script>
<script type="text/javascript">


    function findTutorial() {
        var input = document.getElementById("tutorials").value;
        //alert(input);
        if (input == "BOX") {

            $('#box').click();
            location.href = "#openModal";
            return false;
        }
        else if (input == "sad") {
            location.href = "suggestion_sad.html";
            return false;
        }
        else {
            alert('Invalid Input.');
        }
    }
</script>

<script>
    $('#tutorials').keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            $('#search2').click();
            return false;
        }
    });
</script>

<script>
    $('#default').keypress(function (e) {
        var key = e.which;
        if (key == 13)  // the enter key code
        {
            $('#buyt').click();
            return false;
        }
    });
</script>
<script>
    function upperCaseF(a) {
        setTimeout(function () {
            a.value = a.value.toUpperCase();
        }, 1);
    }
</script>

<script>
    function opentabds(evt, tabsname) {
        var i, tabdcontent, tabdlinks;
        tabdcontent = document.getElementsByClassName("tabdcontent");
        for (i = 0; i < tabdcontent.length; i++) {
            tabdcontent[i].style.display = "none";
        }
        tabdlinks = document.getElementsByClassName("tabdlinks");
        for (i = 0; i < tabdlinks.length; i++) {
            tabdlinks[i].className = tabdlinks[i].className.replace(" mactive", "");
        }
        document.getElementById(tabsname).style.display = "block";
        evt.currentTarget.className += " mactive";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>

<script>
    function openModel(evt, cityName) {
        var i, modelcontent, modellinks;
        modelcontent = document.getElementsByClassName("modelcontent");
        for (i = 0; i < modelcontent.length; i++) {
            modelcontent[i].style.display = "none";
        }
        modellinks = document.getElementsByClassName("modellinks");
        for (i = 0; i < modellinks.length; i++) {
            modellinks[i].className = modellinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>
<script>

    $('.demo').click(function () {
        $('#output').val($(this).attr("name"));


        if ($(this).attr('value') == 'newDrawing' || $(this).attr('value') == 'newSheetSet' || $(this).attr('value') == 'openDrawing' || $(this).attr('value') == 'saveAsDrawing') {
            $('span.tutorials').hide();
            $('span.projectFiles').hide();
            $('#output').val($(this).attr(""));
        } else if ($(this).attr('value') == 'coordinates' || $(this).attr('value') == 'Model or paper Space' || $(this).attr('value') == 'Grid' || $(this).attr('value') == 'Snap Mode' || $(this).attr('value') == 'Infer Constraints' || $(this).attr('value') == 'dynamic Input' || $(this).attr('value') == 'Ortho Mode' || $(this).attr('value') == 'Polar Tracking'
            || $(this).attr('value') == 'Isometric Drafting' || $(this).attr('value') == 'Object Snap Tracking' || $(this).attr('value') == '2D Object Snap' || $(this).attr('value') == 'LineWeight' || $(this).attr('value') == 'Transparency' || $(this).attr('value') == 'SelectionCycling' || $(this).attr('value') == '3DObjectSnap' || $(this).attr('value') == 'DynamicUCS'
            || $(this).attr('value') == 'SelectionFiltering' || $(this).attr('value') == 'Gizmo' || $(this).attr('value') == 'AnnotationVisibility' || $(this).attr('value') == 'AutoScale' || $(this).attr('value') == 'currentViewScale' || $(this).attr('value') == 'WorkspaceSwitching' || $(this).attr('value') == 'AnnotationMonitor' || $(this).attr('value') == 'Units'
            || $(this).attr('value') == 'LockUI' || $(this).attr('value') == 'IsolateObjects' || $(this).attr('value') == 'GraphicsPerformance' || $(this).attr('value') == 'CleanScreen' || $(this).attr('value') == 'AnnotationScale') {
            $('span.tutorials').hide();
            $('span.projectFiles').hide();
            $('span.demonstrations').hide();
            $('#output').val($(this).attr(""));
        } else {
            $('span.tutorials').show();
            $('span.projectFiles').show();
            $('span.demonstrations').show();
        }
    });
</script>

<script>
    $('.demo2').click(function () {
        $('#output2').val($(this).attr("id"));
</script>

<script>
    function openCity(evt, cityName) {
        var i, x, tablinks;
        x = document.getElementsByClassName("city");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < x.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" Sktp-red", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " Sktp-red";
    }
</script>
<script>
    function openItem(evt, cityName) {
        var i, tabcontent, tablinks;

        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " mactive";
    }
</script>
<script type="text/javascript">
    jQuery(function ($) {
        $("#1234567890asdfghj").ejMenu({width: "100%"});
    });

</script>
<script>
    $(document).ready(function () {
        $('.selector').on('click', function () {
            if (this.value == '1') {
                $("#drafting").show();
                $(".ribbon").hide();
                $("#3dbasics").hide();
            } else if (this.value == '2') {
                $("#3dbasics").show();
                $(".ribbon").hide();
                $("#drafting").hide();
            } else {
                $(".ribbon").show();
                $("#drafting").hide();
                $("#3dbasics").hide();
            }
        });
    });


</script>
<script>
    function openGallery(evt, cityName) {
        var i, galcontent, gallinks;
        galcontent = document.getElementsByClassName("galcontent");
        for (i = 0; i < galcontent.length; i++) {
            galcontent[i].style.display = "none";
        }
        gallinks = document.getElementsByClassName("gallinks");
        for (i = 0; i < gallinks.length; i++) {
            gallinks[i].className = gallinks[i].className.replace(" gactive", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += "gactive";
    }
</script>
<script>

    function closeVideo() {
        $('#vid1').attr('src', '');

    }
</script>
<script>

</script>
<script>

    function closeVideo3() {
        $('#vid2').attr('src', '');

    }
</script>
<script>

    function closeVideo4() {
        $('#vid3').attr('src', '');

    }
</script>
<script>
    function closeVideo5() {
       $('#vid4').attr('src', '');
    }
</script>
<script>
    function closeVideo6() {
       $('#vid5').attr('src', '');
    }
</script>
<script>

    function closeVideo7() {
       $('#vid6').attr('src', '');
    }
</script>
<script>
    function closeVideo8() {
        $('#vid7').attr('src', '');
    }
</script>
<script>

    function closeVideo9() {
        $('#vid8').attr('src', '');
    }
</script>
<script>

    function closeVideo10() {
        $('#vid9').attr('src', '');
    }
</script>
<script>
    function closeVideo2() {
        $('#skyvid').attr('src', '');
    }
</script>
<script>
    var x = document.getElementById("pdf1");

    function closePDF() {
        x.close();
        x.hide();
    }
</script>
<script>
    var elmt = document.getElementById('noSpaces');

    elmt.addEventListener('keydown', function (event) {
        if (elmt.value.length === 0 && event.which === 32) {
            event.preventDefault();
        }
    });
</script>
<script>
    function opendisciplines(evt, cityName) {
        var i, discontent, dislinks;
        discontent = document.getElementsByClassName("discontent");
        for (i = 0; i < discontent.length; i++) {
            discontent[i].style.display = "none";
        }
        dislinks = document.getElementsByClassName("dislinks");
        for (i = 0; i < dislinks.length; i++) {
            dislinks[i].className = dislinks[i].className.replace(" disactive", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " disactive";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpenMechanical").click();
</script>
<script>
    function openAutoCAD(evt, cityName) {
        var i, autocontent, autolinks;
        autocontent = document.getElementsByClassName("autocontent");
        for (i = 0; i < autocontent.length; i++) {
            autocontent[i].style.display = "none";
        }
        autolinks = document.getElementsByClassName("autolinks");
        for (i = 0; i < autolinks.length; i++) {
            autolinks[i].className = autolinks[i].className.replace(" autoactive", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " autoactive";
    }

	document.getElementById("AutoImageOpen").click();
</script>

<script>
    function openLine(evt, cityName) {
        var i, linecontent, linelinks;
        linecontent = document.getElementsByClassName("linecontent");
        for (i = 0; i < linecontent.length; i++) {
            linecontent[i].style.display = "none";
        }
        linelinks = document.getElementsByClassName("linelinks");
        for (i = 0; i < linelinks.length; i++) {
            linelinks[i].className = linelinks[i].className.replace(" lineactive", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " lineactive";
    }

	document.getElementById("OpenDemoLine").click();
</script>

<script>
document.getElementById("defaultOpen2018").click();
</script>
<script>
document.getElementById("defaultOpenArch").click();
document.getElementById("defaultOpenAutoArch").click();
</script>
<script>
document.getElementById("defaultOpenCivil").click();
document.getElementById("defaultOpenAutoCADCivil").click();
</script>
<script>
document.getElementById("defaultOpenElect").click();
document.getElementById("defaultOpenAutoCADElect").click();
</script>
<script>
document.getElementById("defaultOpenMech").click();
document.getElementById("defaultOpenAutoMech").click();
</script>
<script>
document.getElementById("defaultOpenSurvey").click();
document.getElementById("defaultOpenAutoSurvey").click();
</script>
<script>
document.getElementById("defaultOpenDesign").click();
document.getElementById("defaultOpenAutoDesign").click();
</script>

<script>
    $(function () {
        $('#currentTime').html($('#maithoVideo').find('video').get(0).load());
        $('#currentTime').html($('#maithoVideo').find('video').get(0).play());
    })
    setInterval(function () {
        $('#currentTime').html($('#maithoVideo').find('video').get(0).currentTime);
        $('#totalTime').html($('#maithoVideo').find('video').get(0).duration);
    }, 500)
    console.log('1.6');
</script>
<script>dragElement(document.getElementById(("timer")));

    function dragElement(e) {
        var g = 0, d = 0, c = 0, b = 0;
        if (document.getElementById(e.id + "header")) {
            document.getElementById(e.id + "header").onmousedown = h
        } else {
            e.onmousedown = h
        }

        function h(i) {
            i = i || window.event;
            c = i.clientX;
            b = i.clientY;
            document.onmouseup = f;
            document.onmousemove = a
        }

        function a(i) {
            i = i || window.event;
            g = c - i.clientX;
            d = b - i.clientY;
            c = i.clientX;
            b = i.clientY;
            e.style.top = (e.offsetTop - d) + "px";
            e.style.left = (e.offsetLeft - g) + "px"
        }

        function f() {
            document.onmouseup = null;
            document.onmousemove = null
        }
    };</script>

	<script>

dragModal(document.getElementById(("openModal")));

function dragModal(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id + "header")) {

    document.getElementById(elmnt.id + "header").onmousedown = dragMouse;
  } else {

    elmnt.onmousedown = dragMouse;
  }

  function dragMouse(e) {
    e = e || window.event;

    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragModal;

    document.onmousemove = ModalDrag;
  }

  function ModalDrag(e) {
    e = e || window.event;

    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;

    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragModal() {
    /* stop moving when mouse button is released:*/
    document.onmouseup = null;
    document.onmousemove = null;
  }
}
</script>

<script src="js/cmd.js"></script>
<script src="js/modal.js"></script>
<script src="js/modalresource.js"></script>
<script src="js/statusbar.js" type="text/javascript"></script>
<script src="maitho/js/mresource.js" type="text/javascript"></script>

</body>
</html>
