<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        require_once('../headerlink/headerlink.php');
        require_once('../admin/config/db.php');
    ?>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/actionlist.css">

</head>
<body style="background:#2C2C2C">
    <?php require_once('nav.php') ?>
    <div class="container-fluid prodcut">
        <div class="row">
        <?php 
               $q = "select * from auction_products";
               $result = $conn->query($q);
                $count = $result->num_rows;
               if ($result->num_rows > 0) {
                   while($row = $result->fetch_assoc()) {
                        $id = $row['id'];
                        $name = $row['user_name'];
                        $photo = $row['photo'];
                        $user_id = $row['user_id'];
                        $hour = $row['hour'];
                        $minute = $row['minute'];
                        $date = $row['day'];
                        $medium = $row['medium'];
                        if($medium==1){
                            $type = "Water Color";
                        }elseif($medium==2){
                            $type =  'Oil Painting';
                        }elseif($medium==3){
                            $type =  'Glass Painting';
                        }elseif($medium==4){
                            $type=  'Ink Wash';
                        }
                        $second = 0;
                        $time = $hour.":".$minute.":".$second;
                        $auction_time = $date." ".$time;
                        
                       //datetime from database: "2014-05-18 18:10:18"
                        // date_default_timezone_set("Asia/Rangoon"); //setting default timezone based on your location
                        // $curdatetime = date("Y-m-d H:i:s"); //current datetime
                        // $diff = date_sub($curdatetime,date_interval_create_from_date_string($auction_time));

                       // $diff = date_diff("$curdatetime","$auction_time");
                      // $diff = abs(strtotime($auction_time) - strtotime($curdatetime));
                        // if($curdatetime > $auction_time){
                        //     $diff = abs(strtotime($curdatetime) - strtotime($auction_time));
                        // }else{
                        //     $diff = abs(strtotime($auction_time) - strtotime($curdatetime));
                        // }

                       
                       ?>
                    <div class="col-sm-3" title="<?php
                         echo "Artist : ".$name;echo "<br/>";
                         echo "Type : " .$type;echo "<br/>";
                         echo "Price : " .$row['price'];echo "MMK <br/>";
                         echo "Time end :". $auction_time;
                         ?>";
                        
                        onmouseover="addContent(this.title);" onmouseout="removeContent()">
                        <img src="../gallery/<?php echo $photo ?>" alt="image" class="auction-image">
                      
                    </div>
                       <?php
                               
                   }
                }
            ?>  
              <div id="popup"></div>
        </div>
        
        <script type="text/javascript">

$title = "";

var IE = document.all?true:false;
if (!IE) 

	document.captureEvents(Event.MOUSEMOVE)
	document.onmousemove = getMouseXY;
	var tempX = 0;
	var tempY = 0;

	function getMouseXY(e) 
	{
			if (IE) {
					tempX = event.clientX;
					tempY = event.clientY;

			} else {
					tempX = e.pageX;
					tempY = e.pageY;
			}

			if (tempX < 0){tempX = 0;}
			if (tempY < 0){tempY = 0;}

			return true;
	}



function getContent($title)
{		
		$content = $title;	
		return $content;
        
}

function addContent($title) 
{
		getContent($title); // call getContent() function to get the content to be added to the popup

		var e = document.getElementById('popup'); 
		if(e)  e.innerHTML = $content; // Add content to popup div

		showPopUp();
}

function removeContent() 
{
		var e = document.getElementById("popup");
		if(e)  e.innerHTML = ""; // Remove content from popup div

		hidePopUp();
}

function showPopUp() 
{
		document.getElementById('popup').style.display = 'block';
       // document.getElementById('popup').style.justify-content = 'center';
		document.getElementById('popup').style.top=tempY;
		document.getElementById('popup').style.left=tempX;

}

function hidePopUp() 
{
		document.getElementById("popup").style.display = 'none';

}

</script>

    </div>
</body>
</html>