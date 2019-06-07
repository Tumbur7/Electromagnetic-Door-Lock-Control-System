<!DOCTYPE html>
<html>
<head>
<script>

function loadUrl(location){
  this.document.location.href = location;
}
// function bagianDatabase() {
// var mengambilWaktuDanJam = select TIME(start_time), DATE(start_time) from t_data;
// var hari = SELECT DATE_FORMAT(start_time,"%a%m%Y") as dateFieldName FROM t_data;
// var untukMengambilDataWaktuTerakhirenggunakan = SELECT start_time FROM t_data ORDER BY start_time DESC LIMIT 1;
// }

function startTime() {
  var today = new Date();
  var y = today.getFullYear();
  var b = today.getMonth() + 1;
  var t = today.getDate();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);

  if(m == 0 && s == 1){
    // loadUrl("google.com");
    alert("test");
    var url = "index.php?r=site%2Fwemoson";
    window.location.href = url;
  }else if(m == 0 && s == 20){
    // loadUrl("google.com");
    alert("testtttt");
    var url = "index.php?r=site%2Fwemosoff";
    window.location.href = url;
  }  

  document.getElementById('txt').innerHTML =
  t + ":" + b + ":" + y + "<p><p>" + h + ":" + m + ":" + s;
  var t = setTimeout(startTime, 500);
}
function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
</script>
</head>

<body onload="startTime()">

<div id="txt"></div>


</body>
</html>

<?php
use yii\helpers\Html;

$this->title = 'Untuk Buka tutup Pintu';
$this->params['breadcrumbs'][] = $this->title;
?>

	
</iframe>
</p>
<?= Html::a('ON', ['wemoson1'], ['class' => 'btn btn-primary' , 'target' => '_blank']) ?>
</p>
<?= Html::a('OFF', ['wemosoff1'], ['class' => 'btn btn-primary' , 'target' => '_blank']) ?>
</p>



