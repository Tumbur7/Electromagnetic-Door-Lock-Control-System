<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>
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

  if(m == 2 && s == 1){
    // loadUrl("google.com");
    // alert("test");
    var url = "index.php?r=site%2Fwemoson";
    window.location.href = url;
  }else if(m == 2 && s == 20){
    // loadUrl("google.com");
    // alert("testtttt");
    var url = "index.php?r=site%2Fwemosoff";
    window.location.href = url;
  }  

  var t = setTimeout(startTime, 500);
}
function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
</script>
<body onload="startTime()">



<header class="main-header">

    <?= Html::a('<span class="logo-mini">WMIN</span><span class="logo-lg">' . 'WEBMIN'. '</span>', Yii::$app->homeUrl,['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                        <?php
                            echo (isset(yii::$app->user->identity->username)?yii::$app->user->identity->username:'GUEST')
                        ?>
                    </a>
                    <?php
                        if(!Yii::$app->user->isGuest){
                    ?>  
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle"
                                 alt="User Image"/>

                            <p style="margin-top:50px; color:#fff;">
                               <?php
                                echo (isset(yii::$app->user->identity->username)?yii::$app->user->identity->username:'GUEST')
                                ?>
                            </p>
                        </li>
                        <!-- Menu Body -->
                    
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <!-- <div class="pull-left"> -->
                                <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
                            <!-- </div> -->
                          <div class="pull-left">
                                <?= Html::a(
                                    'Profil',
                                    ['/user/view','id'=>yii::$app->user->getId()],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                    <?php
                        }
                    ?>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>


    </nav>
</header>
