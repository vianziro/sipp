<!DOCTYPE html>
<html lang="en">

<head>
	
	<script language="JavaScript">
     var message="Maaf Dilarang Klik Kanan!!!! Trims";
     function clickIE4(){
         if (event.button==2){
             alert(message);
             return false;
         }
     }
     function clickNS4(e){
        if (document.layers||document.getElementById&&!document.all){
            if (e.which==2||e.which==3){
                alert(message);
                return false;
            }
        }
    }
    if (document.layers){
        document.captureEvents(Event.MOUSEDOWN);
        document.onmousedown=clickNS4;
    }
    else if (document.all&&!document.getElementById){
        document.onmousedown=clickIE4;
    }
    document.oncontextmenu=new Function("alert(message);return false")
</script>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Intranet Human Resources Application</title>
<link rel="icon" href="<?php echo media_url('ico/favicon.jpg'); ?>" type="image/x-icon">

<!-- Bootstrap core CSS -->

<link href="<?php echo media_url() ?>/css/bootstrap.min.css" rel="stylesheet">

<link href="<?php echo media_url() ?>/fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo media_url() ?>/css/animate.min.css" rel="stylesheet">

<!-- Custom styling plus plugins -->
<link href="<?php echo media_url() ?>/css/custom.css" rel="stylesheet">

<script src="<?php echo media_url() ?>/js/jquery.min.js"></script>
<script src="<?php echo media_url() ?>/js/bootstrap.min.js"></script>

        <!--[if lt IE 9]>
            <script src="../assets/js/ie8-responsive-file-warning.js"></script>
            <![endif]-->

            <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
              <![endif]-->
              <style type="text/css">
                * {
                    margin: 0;
                    padding: 0;
                }
                #clock {
                    position: relative;
                    width: 200px;
                    height: 200px;
                    margin: 0px auto 0 auto;
                    background: url(<?php echo media_url() ?>/images/clockface.png);
                    list-style: none;
                }
                #sec, #min, #hour {
                    position: absolute;
                    width: 10px;
                    height: 250px;
                    top: 0px;
                    left: 120px;
                }
                #sec {
                    background: url(<?php echo media_url() ?>/images/sechand.png);
                    z-index: 3;
                }
                #min {
                    background: url(<?php echo media_url() ?>/images/minhand.png);
                    z-index: 2;
                }
                #hour {
                    background: url(<?php echo media_url() ?>/images/hourhand.png);
                    z-index: 1;
                }
                .carousel-indicators .active{ background: #31708f; } .adjust1{ float:left; width:100%; margin-bottom:0; } .adjust2{ margin:0; } .carousel-indicators li{ border :1px solid #ccc; } .carousel-control{ color:#31708f; width:5%; } .carousel-control:hover, .carousel-control:focus{ color:#31708f; } .carousel-control.left, .carousel-control.right { background-image: none; } .media-object{ margin:auto; margin-top:15%; } @media screen and (max-width: 768px) { .media-object{ margin-top:0; } }
                .text-footer{
                    margin-top:15px;
                }
                .footer{
                    background-color: #446CB3;
                    color:white;
                }
                .icons{
                    color: white;
                    background-color:#52B3D9;
                    font-size: 70pt;
                    /*padding-left: 50px;*/
                    height:140px;
                }
                .texts{
                    color: #E4F1FE;
                    background-color:#52B3D9;
                    font-size: 40pt;
                    padding-left: 30px;
                    padding-top: 20px;
                    padding-bottom: 48px;
                    height:140px;
                }
                .modul{
                    margin-top:40px;
                }
            </style>
            <script type="text/javascript">
                $(document).ready(function() {
                    setInterval(function() {
                        var seconds = new Date().getSeconds();
                        var sdegree = seconds * 6;
                        var srotate = "rotate(" + sdegree + "deg)";
                        $("#sec").css({"-moz-transform": srotate, "-webkit-transform": srotate});
                    }, 1000);
                    setInterval(function() {
                        var hours = new Date().getHours();
                        var mins = new Date().getMinutes();
                        var hdegree = hours * 30 + (mins / 2);
                        var hrotate = "rotate(" + hdegree + "deg)";
                        $("#hour").css({"-moz-transform": hrotate, "-webkit-transform": hrotate});
                    }, 1000);
                    setInterval(function() {
                        var mins = new Date().getMinutes();
                        var mdegree = mins * 6;
                        var mrotate = "rotate(" + mdegree + "deg)";
                        $("#min").css({"-moz-transform": mrotate, "-webkit-transform": mrotate});
                    }, 1000);
                });
</script>

<?php if ($this->session->flashdata('alert')) { ?>
<script type="text/javascript">
    alert('<?php echo $this->session->flashdata('alert') ?>');
</script>
<?php } ?>

<style type="text/css">
    #output{
        font-size:50px;
        font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
        text-align:center;
        margin-top:1%;
        color:#FFF;
    }
</style>

<script type="text/javascript">
    window.setTimeout("waktu()",1000);    
    function waktu() {     
        var tanggal = new Date();    
        setTimeout("waktu()",1000);    
        document.getElementById("output").innerHTML = tanggal.getHours()+":"+tanggal.getMinutes()+":"+tanggal.getSeconds();  
    }   
</script>

<script language="JavaScript" type="text/javascript">
   $(document).ready(function(){

         var imgArr = new Array( // relative paths of images
           '<?php echo media_url() ?>/images/letter.png',
           'images_intranet/2.jpg',
           'images_intranet/3.jpg',
           'images_intranet/4.jpg',
           'images_intranet/5.jpg',
           'images_intranet/6.jpg',
           'images_intranet/7.jpg',
           'images_intranet/8.jpg'
           );

         var preloadArr = new Array();
         var i;

         /* preload images */
         for(i=0; i < imgArr.length; i++){
           preloadArr[i] = new Image();
           preloadArr[i].src = imgArr[i];
       }

       var currImg = 2;
         //var intID = setInterval(changeImg, 10000);

         /* image rotator */
         function changeImg(){
           $('.box_tengah').animate({opacity: 0}, 1000, function(){
               $(this).css('background','url(' + preloadArr[currImg++%preloadArr.length].src +') top center no-repeat');
           }).animate({opacity: 1}, 1000);
       }

   });
</script>


<!--[if IE 6]>
        <script src="DD_belatedPNG_0.0.8a-min.js"></script>
        <script>
         
           DD_belatedPNG.fix('.x');
          
        </script>
       
       
        <![endif]--> 
    </head>
    <body>

        <div class="main_div">
            <div class="box_tengah">
                <marquee><h5><strong>Selamat Datang di Portal HRA | Silahkan Pilih Menu Yang Akan Digunakan | Untuk Bantuan Hubungi Personalia</strong></h5></marquee>
                <div class="shortcut">
                    <span>
                        <a href="http://10.234.159.200/hras" target="_blank"> 
                            <img class="x" src="<?php echo media_url() ?>/images/login_hracls2.png"/><br />
                            <p class="label">HRA Application <br>Cileungsi 2</p>
                        </a>
                    </span>
                </div>
                <div class="shortcut">
                    <span>
                        <a href="http://10.234.159.200/cls" target="_blank"> 
                            <img class="x" src="<?php echo media_url() ?>/images/login_hracls1.png"/><br />
                            <p class="label">HRA Application <br>Cileungsi 1</p>
                        </a>
                    </span>
                </div>

                <div class="shortcut">
                    <span>
                        <a href="<?php echo site_url('member') ?>" target="_blank"> 
                            <img class="x" src="<?php echo media_url() ?>/images/login_prakerin.png"/><br />
                            <p class="label">Prakerin Sekolah</p>
                        </a>
                    </span>
                </div>
               
                <div class="shortcut">
                    <span>
                        <a href="http://10.234.152.108" target="_blank"> 
                            <img class="x" src="<?php echo media_url() ?>/images/app.png"/><br />
                            <p class="label">Profil Individu</p>
                        </a>
                    </span>
                </div>

                <div class="shortcut">
                    <span>
                        <a href="http://alearning.sat.co.id/alfaweb/public/index/login" target="_blank"> 
                            <img class="x" src="<?php echo media_url() ?>/images/login_learning.png"/><br />
                            <p class="label">A-Learning</p>
                        </a>
                    </span>
                </div>

                <div class="shortcut">
                    <span>
                        <a href="http://10.234.152.20:2208" target="_blank"> 
                            <img class="x" src="<?php echo media_url() ?>/images/login_online.png"/><br />
                            <p class="label">AlfaOnline</p>
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <div class="footer2">
            <h4>PT. Sumber Alfaria Trijaya, Tbk</h4>
            <address>
              Kawasan Industri Menara Permai Kav. 18 Cileungsi<br/>
              Copyright &copy; <?php echo pretty_date(date('Y-m-d'), 'Y', FALSE) ?> | Achyar Anshorie&trade;<br/>
          </address>
      </div>
  </body>
  </html>
