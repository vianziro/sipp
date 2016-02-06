<html>
    <head>
    <style type="text/css">
   .upper { text-transform: uppercase; }
   .lower { text-transform: lowercase; }
   .cap   { text-transform: capitalize; }
   .small { font-variant:   small-caps; }
.style3 {font-size: 18px; font-weight: bold; }
    .style8 {font-size: 18px}
.style10 {font-size: 12px}
    </style>
    </head>
    <body>
    <div style="padding:0px 0px;">
      <div align="right">
              <table width="272" border="0" align="left">
                <tr>
                  <th width="266" scope="col"><div align="left" class="style8">PT. Sumber Alfaria Trijaya, Tbk </div></th>
                </tr>
                <tr>
                  <td><span class="style3">Program Pemagangan </span></td>
                </tr>
              </table>
        <strong><img width="200" height="100" src="<?php echo media_url() ?>/images/alfa.png" alt=""></strong></div>
            <div align="center"> <img width="670" height="100" src="<?php echo media_url() ?>/images/iso.jpg" alt=""> </div>
                                 
            <p align="center"><font size="5"><strong><u>SURAT KETERANGAN MAGANG</u></strong></font><br>
            No : 0<?php echo substr($member['member_nip'],3) ?> / <?php echo pretty_date($member['member_last_update'],'F',false)?> / <?php echo pretty_date($member['member_last_update'],'Y',false)?> / Pemagangan / Siswa Sekolah / SAT</p>          
			<br>
            <p align="justify"> Mengucapkan terimakasih kepada :</p><br>

            <table border="0">
                <tbody>
                    <tr>
                        <td width="121"><span class="style3">Nama</span></td>
                        <td width="10"><span class="style3">:</span></td>
                        <td width="526"><span class="style3"><span class="upper"><?php echo $member['member_full_name'] ?></span></span></td>
                    </tr>
                    <tr>
                        <td><span class="style3">Lokasi Magang</span></td>
                        <td><span class="style3">:</span></td>
                        <td><span class="style3"><?php echo $member['member_division'] ?></span></td>
                    </tr>
                    <tr>
                        <td><span class="style3">Periode</span></td>
                        <td><span class="style3">:</span></td>
                        <td><span class="style3"><?php echo pretty_date( $member['member_input_date'],'d F Y',false) ?> s/d <?php echo pretty_date( $member['member_last_update'],'d F Y',false) ?></span></td>
                    </tr>                    
                </tbody>
            </table>            
            
            <br>
            <p align="justify">Bahwa nama yang tersebut diatas telah mengikuti Program Magang Siswa Sekolah yang diselenggarakan oleh PT. Sumber Alfaria Trijaya Tbk, dengan Predikat <?php echo $member['member_score'] ?>.</p>
                        
            <p align="justify">Demikian surat keterangan ini dibuat supaya dapat dipergunakan dengan baik dan bertanggung jawab.</p>
            
            <br><br>            
            <table border="0">
                <tbody>
                    <tr>
                        <td>Cileungsi, <?php echo pretty_date($member['member_last_update'],'d F Y',false)?> </td>
                        <td></td>                        
                    </tr>
                    <tr>
                        <td>PT. Sumber Alfaria Trijaya, Tbk</td>
                        <td></td>                        
                    </tr>
              </tbody></table>             
           
                <br>
                <br>
                <br>
                <br>
                <br>
                <table border="0">
                <tbody>
                    <tr>
                        <td><u><strong>TATI NURHAYATI</strong></u></td>
                        <td></td>                        
                    </tr>
                    <tr>
                        <td><em><strong>People Development Manager</strong></em></td>
                        <td></td>                        
                    </tr>
                  </tbody></table>
    </div>
	<br><br>
	<span class="style10"><br>
	</span>
	<p class="style10">&nbsp;</p>
	<p class="style10">No. NRA : SAT/FRM/PI/147_Rev : 000_120410</p>
    </body>
</html>