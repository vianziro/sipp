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

<title>Sistem Informasi Presensi </title>
<link rel="icon" href="<?php echo media_url('ico/favicon.jpg'); ?>" type="image/x-icon">

<!-- Bootstrap core CSS -->

<link href="<?php echo media_url() ?>/css/bootstrap.min.css" rel="stylesheet">        
<link href="<?php echo media_url() ?>/css/jquery-ui.min.css" rel="stylesheet">
<link href="<?php echo media_url() ?>/css/jquery-ui.structure.min.css" rel="stylesheet">
<link href="<?php echo media_url() ?>/css/jquery-ui.theme.min.css" rel="stylesheet">

<link href="<?php echo media_url() ?>/fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo media_url() ?>/css/animate.min.css" rel="stylesheet">

<!-- Custom styling plus plugins -->
<link href="<?php echo media_url() ?>/css/custom.css" rel="stylesheet">

<script src="<?php echo media_url() ?>/js/jquery.min.js"></script>
<script src="<?php echo media_url() ?>/js/jquery-ui.min.js"></script>
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
                    width: 250px;
                    height: 250px;
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

                table.tbl-present {
                    width: 100%;
                }

                thead.thead-present, tbody.tbody-present, tr.tr-present,tbody.tbody-present td,tbody.thead-present  th { display: block; }

                tr:after {
                    content: ' ';
                    display: block;
                    visibility: hidden;
                    clear: both;
                }

                thead.thead-present th {
                    height: 30px;

                    /*text-align: left;*/
                }

                tbody.tbody-present {
                    height: 250px;
                    overflow-y: auto;
                }

                thead {
                    /* fallback */
                }


                tbody.tbody-present td, thead.thead-present th {
                    width: 16.5%;
                    float: left;
                }

                tbody.tbody-present td.col-date, thead.thead-present th.col-date {
                    width: 18%;
                    float: left;
                }

                tbody.tbody-present td.col-name, thead.thead-present th.col-name {
                    width: 29%;
                    float: left;
                }

                tbody.tbody-present td.col-ket, thead.thead-present th.col-ket {
                    width: 12%;
                    float: left;
                }

                tbody.tbody-present td.col-no, thead.thead-present th.col-no {
                    width: 5%;
                    float: left;
                }

                .carousel-indicators .active{ background: #31708f; } .adjust1{ float:left; width:100%; margin-bottom:0; } .adjust2{ margin:0; } .carousel-indicators li{ border :1px solid #ccc; } .carousel-control{ color:#31708f; width:5%; } .carousel-control:hover, .carousel-control:focus{ color:#31708f; } .carousel-control.left, .carousel-control.right { background-image: none; } .media-object{ margin:auto; margin-top:15%; } @media screen and (max-width: 768px) { .media-object{ margin-top:0; } }
                .text-footer{
                    margin-top:15px;
                }
                .footer{
                    background: #1e5799; /* Old browsers */
                    background: -moz-linear-gradient(top, #1e5799 0%, #2989d8 50%, #207cca 51%, #7db9e8 100%); /* FF3.6-15 */
                    background: -webkit-linear-gradient(top, #1e5799 0%,#2989d8 50%,#207cca 51%,#7db9e8 100%); /* Chrome10-25,Safari5.1-6 */
                    background: linear-gradient(to bottom, #1e5799 0%,#2989d8 50%,#207cca 51%,#7db9e8 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1e5799', endColorstr='#7db9e8',GradientType=0 ); /* IE6-9 */
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

<script language="JavaScript">


var countDownInterval=30;
//configure width of displayed text, in px (applicable only in NS4)
var c_reloadwidth=200

</script>


<ilayer id="c_reload" width=&{c_reloadwidth}; ><layer id="c_reload2" width=&{c_reloadwidth}; left=0 top=0></layer></ilayer>

<script>

var countDownTime=countDownInterval+1;
function countDown(){
countDownTime--;
if (countDownTime <=0){
countDownTime=countDownInterval;
clearTimeout(counter)
window.location.reload()
return
}
if (document.all) //if IE 4+
document.all.countDownText.innerText = countDownTime+" ";
else if (document.getElementById) //else if NS6+
document.getElementById("countDownText").innerHTML=countDownTime+" "
else if (document.layers){ //CHANGE TEXT BELOW TO YOUR OWN
document.c_reload.document.c_reload2.document.write('Auto <a href="javascript:window.location.reload()">refresh</a> in <b id="countDownText">'+countDownTime+' </b> seconds')
document.c_reload.document.c_reload2.document.close()
}
counter=setTimeout("countDown()", 1000);
}

function startit(){
if (document.all||document.getElementById) //CHANGE TEXT BELOW TO YOUR OWN
document.write('Auto <a href="javascript:window.location.reload()">refresh</a> in <b id="countDownText">'+countDownTime+' </b> seconds')
countDown()
}

if (document.all||document.getElementById)
startit()
else
window.onload=startit

</script>

</head>


<body class="bckgr">

    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 header-login">
            <center>
                <h1>SISTEM INFORMASI PRESENSI PRAKERIN</h1>
            </center>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 text-header">
            <marquee><h5><strong>Selamat Datang di Halaman Presensi | PT. Sumber Alfaria Trijaya, Tbk</strong></h5></marquee>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 middle-login">
            <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <div class="row">
                        <center>
                            <h2><strong><?php echo pretty_date(date('Y-m-d'), 'l, d F Y',FALSE) ?></strong></h2>
                        </center>
                    </div>
                    <div class="row">
                        <center>
                            <ul id="clock">	
                                <li id="sec"></li>
                                <li id="hour"></li>
                                <li id="min"></li>
                            </ul>
                        </center>
                        <ul> 						
                          <div class="row">
                            <div class="modal-dialog modal-sm">						
                              <center>
                                <a href="<?php echo site_url('admin/') ?>" class="btn btn-small btn-info" type="button">Login Administrator</a>
                            </center>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12 tbl-login">
                    <table class="table table-striped tbl-present">
                        <thead class="thead-present">
                            <tr class="tr-present">
                                <th class="col-no">No.</th>
                                <th class="col-date">Tanggal</th>
                                <th class="col-name">Nama</th>
                                <th class="col-ket">Datang</th>
                                <th class="col-ket">Pulang</th>
                                <th class="col-ket">Kehadiran</th>
                                <th class="col-ket">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tbody class="tbody-present">
                                <?php
                                $i = 1;
                                foreach ($present as $row):
                                    ?>
                                <tr class="tr-present">
                                    <td  class="col-no"><?php echo $i ?></td>
                                    <td class="col-date"><?php echo pretty_date($row['present_date'], 'l, d m Y', FALSE) ?></td>
                                    <td class="col-name"><?php echo $row['member_full_name'] ?></td>
                                    <td class="col-ket"><?php echo ($row['present_entry_time'] == NULL) ? '-' : $row['present_entry_time'] ?></td>
                                    <td class="col-ket"><?php echo ($row['present_out_time'] == NULL) ? '-' : $row['present_out_time'] ?></td>
                                    <td class="col-ket"><?php echo $row['present_desc'] ?></td>
                                    <td class="col-ket"><?php echo ($row['present_is_late'] == 1) ? 'Telat' : '-' ?></td>
                                </tr>
                                <?php
                                $i++;
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>					
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 bottom-login">
                <div class="row">
                    <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12 left">
                        <form role="form" action="<?php echo site_url('member/auth/present') ?>" method="post">
                            <?php
                            if (isset($_GET['location'])) {
                                echo '<input type="hidden" name="location" value="';
                                if (isset($_GET['location'])) {
                                    echo htmlspecialchars($_GET['location']);
                                }
                                echo '" />';
                            }
                            ?>
                            <div class="form-group">
                                <h2>PRESENSI</h2>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input autofocus="" name="nip" typt="text" class="form-control" placeholder="Scan NIPM Disini">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="desc" value="0" > Datang
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="desc" value="1" > Pulang
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($this->session->flashdata('failedpresent')) { ?>
                                <br><center><label><?php echo $this->session->flashdata('failedpresent') ?></label></center>
                                <?php } ?>
                                <input type="submit" class="btn btn-success btn-login" value="Submit">
                                <a data-toggle="modal" href="#member" class="btn btn-primary btn-login" >Lihat Peserta Aktif</a>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <h2>BERITA</h2>
                        <div class="container content"> 
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <!-- Indicators --> 
                                <ol class="carousel-indicators"> 
                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li> 
                                    <li data-target="#carousel-example-generic" data-slide-to="1"></li> 
                                    <li data-target="#carousel-example-generic" data-slide-to="2"></li> 
                                </ol> 
                                <!-- Wrapper for slides --> 
                                <div class="carousel-inner"> 
                                    <?php
                                    $i = 1;
                                    foreach ($posts as $row):
                                        ?>
                                    <div class="item <?php echo ($i == 1) ? 'active' : ''; ?>"> 
                                        <div class="row"> 
                                            <div class="col-xs-12"> 
                                                <div class="thumbnail adjust1"> 
                                                    <div class="col-md-2 col-sm-2 col-xs-12"> 
                                                        <img class="media-object img-rounded img-responsive" src="<?php echo $row['posts_image'] ?>"> 
                                                    </div> 
                                                    <div class="col-md-10 col-sm-10 col-xs-12"> 
                                                        <div class="caption"> 
                                                            <p class="text-info lead adjust2"><?php echo $row['posts_title'] ?></p> 
                                                            <p><i> <?php echo pretty_date($row['posts_published_date'], 'l, d M Y', FALSE) ?></i></p> 
                                                            <blockquote class="adjust2"> <p><?php echo strip_tags(character_limiter($row['posts_description'], 250)) ?></p> 
                                                            </blockquote> 
                                                        </div> 
                                                    </div> 
                                                </div> 
                                            </div> 
                                        </div> 
                                    </div> 
                                    <?php
                                    $i++;
                                    endforeach;
                                    ?>
                                </div> <!-- Controls --> 
                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev"> 
                                    <span class="glyphicon glyphicon-chevron-left"></span> </a> 
                                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next"> 
                                        <span class="glyphicon glyphicon-chevron-right"></span> 
                                    </a> </div> 
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12 right">
                                <form role="form" action="<?php echo site_url('member/auth/login') ?>" method="post">
                                    <?php
                                    if (isset($_GET['location'])) {
                                        echo '<input type="hidden" name="location" value="';
                                        if (isset($_GET['location'])) {
                                            echo htmlspecialchars($_GET['location']);
                                        }
                                        echo '" />';
                                    }
                                    ?>
                                    <div class="form-group">
                                        <h2>LOGIN PESERTA PRAKERIN</h2>
                                        <input name="username" typt="text" class="form-control" placeholder="username">
                                        <input name="password" type="password" class="form-control" placeholder="Password">
                                        <?php if ($this->session->flashdata('failed')) { ?>
                                        <center><label><?php echo $this->session->flashdata('failed') ?></label></center>
                                        <?php } ?><br>
                                        <input type="submit" class="btn btn-success btn-login" value="Login">
                                        <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-login" >Pendaftaran</a>                                
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <?php echo form_open_multipart(site_url('member/auth/register')) ?>
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Pendaftaran Prakerin Baru</h4>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="modal-body">
                                            <?php
                                            $this->load->view('member/datepicker');
                                            $inputUserName = set_value('username');
                                            $inputFullName = set_value('member_full_name');
                                            $inputSex = set_value('member_sex');
                                            $inputBirthPlace = set_value('member_birth_place');
                                            $inputBirthDate = set_value('member_birth_date');
                                            $inputSchool = set_value('member_school');
                                            $inputPhone = set_value('member_phone');
                                            $inputAddress = set_value('member_address');
                                            $inputMentor = set_value('member_mentor');
                                            $inputDivison = set_value('member_division');
                                            $inputStatus = set_value('member_status');
                                            ?>
                                            <label >Nama Lengkap *</label>
                                            <input type="text" name="member_full_name" placeholder="Nama Lengkap" class="form-control" value="<?php echo $inputFullName; ?>"><br>
                                            <label >Username *</label>
                                            <input name="username" type="text" placeholder="Username" class="form-control" value="<?php echo $inputUserName; ?>"><br>
                                            <label >Password *</label>
                                            <input type="password" placeholder="Password" name="password" class="form-control"><br>
                                            <label >Konfirmasi Password *</label>
                                            <input type="password" placeholder="Konfirmasi Password" name="passconf" class="form-control">
                                            <p style="color:#9C9C9C;margin-top: 5px"><i>Password minimal 6 karakter</i></p>
                                            <label >Upload Photo </label>
                                            <input type="file" name="member_image" class="form-control" ><br>
                                            <label>Jenis Kelamin *</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="member_sex" value="MALE" <?php echo ($inputSex == 'MALE') ? 'checked' : ''; ?>> Laki-laki
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="member_sex" value="FEMALE" <?php echo ($inputSex == 'FEMALE') ? 'checked' : ''; ?>> Perempuan
                                                </label>
                                            </div>
                                            <label >Tempat Lahir *</label>
                                            <input type="text" name="member_birth_place" placeholder="Tempat Lahir" class="form-control" value="<?php echo $inputBirthPlace; ?>"><br>
                                            <label >Tanggal Lahir *</label>
                                            <input type="text" name="member_birth_date" placeholder="Tanggal Lahir" class="form-control datepicker" value="<?php echo $inputBirthDate; ?>"><br>
                                            <label >Asal Sekolah *</label>
                                            <input type="text" name="member_school" placeholder="Asal Sekolah" class="form-control" value="<?php echo $inputSchool; ?>"><br>
                                            <label >Pembimbing *</label>
                                            <input type="text" name="member_mentor" placeholder="Pembimbing" class="form-control" value="<?php echo $inputMentor; ?>"><br>
                                            <label >No. Telepon *</label>
                                            <input type="text" name="member_phone" placeholder="No. Telepon" class="form-control" value="<?php echo $inputPhone; ?>"><br>
                                            <label >Alamat </label>
                                            <textarea name="member_address" placeholder="Alamat" class="form-control"><?php echo $inputAddress; ?></textarea><br>
                                            <label >Departement </label>
                                            <input type="text" name="member_division" placeholder="Bagian" class="form-control" value="<?php echo $inputDivison; ?>"><br>

                                            <p style="color:#9C9C9C;margin-top: 5px"><i>*) Wajib diisi</i></p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close() ?>
                        </div>

                        <div class="modal fade" id="member" tabindex="-1" role="dialog" aria-labelledby="memberLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Daftar Peserta Aktif</h4>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="modal-body">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nama</th>
                                                        <th>Asal Sekolah</th>
                                                        <th>Dept.</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;											
                                                    foreach ($member as $row):
                                                        ?>
                                                    <tr>
                                                        <td><?php echo $i ?></td>
                                                        <td><?php echo $row['member_full_name'] ?></td>
                                                        <td><?php echo $row['member_school']?></td>
                                                        <td><?php echo $row['member_division'] ?></td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                    endforeach;
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <nav class="fixed-bottom footer">
                            <div class="container">
                                <div class="row">
                                    <center>
                                        <p class="text-footer">
                                          <ul>
                                            Copyright &copy <?php echo pretty_date(date('Y-m-d'), 'Y',FALSE) ?> | Web Development by Achyar Anshorie&trade;
                                        </ul>
                                    </p>
                                </center>
                            </div>
                        </div>
                    </nav>  

                </body>

                </html>
