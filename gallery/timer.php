
<!DOCTYPE HTML> 
<html> 
<head> 

<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<style> 
p { 
  text-align: center; 
  font-size: 60px; 
} 
</style> 
</head> 
<body> 
<p id="demo"></p> 
<p></p>
<a href="https://www.google.com/" target="_blank" id="myLink">Google</a>
<?php
    $url = "http://localhost/artgallery/gallery/index.php";

?>
<script> 
var day = "2019-08-21";
var time = "10:1:00"
var date = day + " " + time;
//var date = "2019-08-21 10:27:00";
var deadline = new Date(date).getTime(); 
var x = setInterval(function() { 
var now = new Date().getTime(); 
var t = deadline - now; 
var days = Math.floor(t / (1000 * 60 * 60 * 24)); 
var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60)); 
var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60)); 
var seconds = Math.floor((t % (1000 * 60)) / 1000); 
//document.getElementById("demo").innerHTML = days + "d "  
//document.getElementById("demo").innerHTML =  hours + "h " + minutes + "m " + seconds + "s "; 
document.getElementById("demo").innerHTML =  minutes + "m " + seconds + "s "; 
    if (t < 0) { 
        clearInterval(x); 
        document.getElementById("demo").innerHTML = "EXPIRED"; 
        var str =document.getElementById("demo").textContent;  
        if(str=="EXPIRED"){
            var url ="<?php echo $url ?>"
            window.location.replace(url);
        }
        

    } 
}, 1000); 


</script> 

  
</body> 
</html> 
