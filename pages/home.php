<?php
    if(strpos($_SERVER['REQUEST_URI'],"pages")){
        exit(header("Location:../index.php"));
    }

    $besok                  = date("Y-m-d", strtotime("+1 day"));
    $thnbesok               = substr($besok,0,4);
    $blnbesok               = substr($besok,5,2);
    $tglbesok               = substr($besok,8,2);
?>

 <!-- ABOUT -->
 <!-- <section id="about">
      <div class="container">
           <div class="row">
                <div class="col-md-6 col-sm-6">
                     <div class="about-info">
                          <h2 class="wow fadeInUp" data-wow-delay="0.6s">Selamat datang di Pusat Kesehatan Anda</h2>
                          <div class="wow fadeInUp" data-wow-delay="0.8s">
                              <p><?=$_SESSION["nama_instansi"]." merupakan salah satu rumah sakit umum di wilayah ".$_SESSION["kabupaten"]." yang berkedudukan di ".$_SESSION["alamat_instansi"].". ".$_SESSION["nama_instansi"]." merupakan perkembangan dari balai pengobatan, klinik dan berada dibawah YASKI. ".$_SESSION["nama_instansi"]." mendapat izin operasional dengan Kode PPK ".$_SESSION["kode_ppkkemenkes"]." sejak bulan November 2009 dan diresmikan tanggal 21 februari 2010. ".$_SESSION["nama_instansi"]." dalam memberikan pelayanannya mengambil filosofi  dasar bahwa pelayanan kesehatan yang baik itu tidak harus mahal dan kalau bisa, harus tidak mahal. Filosofi dasar yang kedua adalah bersama yang tidak mampu kita harus maju. Hal ini memiliki arti bahwa ".$_SESSION["nama_instansi"]." harus mampu memajukan dirinya dan pihak-pihak yang berhubungan dengan dirinya menuju arah yang lebih baik."?></p>
                          </div>
                          <figure class="profile wow fadeInUp" data-wow-delay="1s">
                               <img src="images/author-image.jpg" class="img-responsive" alt=""/>
                               <figcaption>
                                    <h3>dr. Hendrik</h3>
                                    <p>Direktur RS PKU Muhammadiyah Sekapuk </p>
                               </figcaption>
                          </figure>
                     </div>
                </div>
           </div>
      </div>
 </section> -->

 <!-- TEAM -->
 <!-- <section id="team" data-stellar-background-ratio="1">
      <div class="container">
           <div class="row">
                <div class="col-md-12 col-sm-12">
                     <div class="about-info">
                          <h2 class="section-title wow fadeInUp" data-wow-delay="0.1s"><center>Dokter Kami</center></h2>
                     </div>
                </div>
                <div class="clearfix"></div>
                <?php
                    if(!isset($_SESSION["dokter"])){
                        $delay          = 0.2;
                        $datadokter     = "";
                        $querydokter=bukaquery("select dokter.kd_dokter,left(dokter.nm_dokter,20) as dokter,spesialis.nm_sps,dokter.no_ijn_praktek,pegawai.photo,dokter.no_telp from dokter inner join spesialis on dokter.kd_sps=spesialis.kd_sps inner join pegawai on dokter.kd_dokter=pegawai.nik where dokter.status='1' and dokter.kd_dokter<>'-' group by spesialis.nm_sps limit 5");
                        while($rsquerydokter = mysqli_fetch_array($querydokter)) {
                            $datadokter=$datadokter.
                               "<div class='col-md-4 col-sm-6'>
                                    <div class='team-thumb wow fadeInUp' data-wow-delay='".$delay."s'>
                                       
                                          <div class='team-info'>
                                               <h3>$rsquerydokter[1]</h3>
                                               <p>$rsquerydokter[2]</p>
                                               <div class='team-contact-info'>
                                                    <p><i class='fa fa-phone'></i> HP/Telp. $rsquerydokter[5] </p>
                                                    <p><i class='fa fa-envelope-o'></i> No.SIP. $rsquerydokter[3] </p>
                                               </div>
                                              
                                          </div>
                                    </div>
                                    <br/>
                               </div>";
                            $delay=$delay+0.2;
                        }
                        $_SESSION["dokter"]=$datadokter;
                    }

                    echo $_SESSION["dokter"];
                ?>
                <div class="col-md-4 col-sm-6">
                     <div class="wow fadeInUp" data-wow-delay="<?=$delay;?>s">
                         <br/><br/><br/><br/><center><a href='index.php?act=DokterKami' class="btn btn-warning" >Tampilkan Semua Dokter</a></center>
                     </div>
                </div>

           </div>
      </div>
 </section> -->

 <!-- LOGIN -->
<section id="appointment" data-stellar-background-ratio="3">
          <div class="container">
               <div class="row">
                    <!-- <div class="col-md-6 col-sm-6">
                         <img src="images/appointment-image.jpg" class="img-responsive" alt="">
                    </div> -->
                    <div class="col-md-12 col-sm-12">
                        <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                           <h2><center>Log In Pasien</center></h2>
                        </div>
                        <div class="wow fadeInUp" data-wow-delay="0.8s">
                            <div class="col-md-12 col-sm-12">
                                Jika anda pasien lama atau pernah berobat sebelumnya, 
                                untuk nomor rekam medis dan password login bisa Anda tanyakan kepada petugas Kami saat Anda
                               melakukan registrasi secara offline.<br/><br/><br/>
                            </div>
                            <?php 
                                $BtnLogin=isset($_POST['BtnLogin'])?$_POST['BtnLogin']:NULL;
                                if (isset($BtnLogin)) {
                                    if(@$_SESSION["Capcay"]!= getOne2("select aes_encrypt(".cleankar($_POST["inputcaptcha"]).",'windi')")){
                                        echo "<form id=\"appointment-form\" role=\"form\" onsubmit=\"return validasiIsi();\" method=\"post\" action=\"\" enctype=multipart/form-data>
                                                    <div class=\"col-md-12 col-sm-12\">
                                                        <label for=\"norme\">Nomer Rekam Medis</label>
                                                        <input type=\"text\" class=\"form-control\" name=\"norme\" pattern=\"[A-Z0-9-]{1,65}\" title=\" A-Z0-9- (Maksimal 65 karakter)\" required placeholder=\"Masukkan Nomor Rekam Medis\" onkeydown=\"setDefault(this, document.getElementById('MsgIsi1'));\" id=\"TxtIsi1\" autocomplete=\"off\" autofocus/>
                                                        <span id=\"MsgIsi1\" style=\"color:#CC0000; font-size:10px;\"></span>
                                                    </div>
                                                    <div class=\"col-md-12 col-sm-12\">
                                                        <label for=\"passworde\">Password</label>
                                                        <input type=\"password\" class=\"form-control\" name=\"passworde\" required placeholder=\"Masukkan Password\" onkeydown=\"setDefault(this, document.getElementById('MsgIsi2'));\" id=\"TxtIsi2\" autocomplete=\"off\" />
                                                        <span id=\"MsgIsi2\" style=\"color:#CC0000; font-size:10px;\"></span>
                                                    </div>
                                                    <div class=\"col-md-12 col-sm-12\">
                                                        <label for=\"captcha\">Captcha</label>
                                                        <table width=\"100%\" border=\"0\">
                                                            <tr>
                                                                <td width=\"50%\" valign=\"top\">
                                                                    <img width=\"95%\" height=\"45px\" src=\"pages/captcha.php\" alt=\"gambar\" />
                                                                </td>
                                                                <td width=\"50%\">
                                                                    <input type=\"text\" class=\"form-control\" onkeydown=\"setDefault(this, document.getElementById('MsgIsi3'));\" id=\"TxtIsi3\" name=\"inputcaptcha\" pattern=\"[0-9]{1,6}\" title=\" 0-9 (Maksimal 6 karakter)\" required placeholder=\"Masukkan Captcha\" autocomplete=\"off\" />
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <span id=\"MsgIsi3\" style=\"color:#CC0000; font-size:10px;\"></span>
                                                    </div>
                                                    <div class=\"col-md-12 col-sm-12\">
                                                        <span style=\"color:#CC0000; font-size:12px;\">Captcha tidak sesuai, silahkan ulangi ...!</span><br/><br/>
                                                    </div>
                                                    <div class=\"col-md-12 col-sm-12\">
                                                        <button type=\"submit\" class=\"form-control\" id=\"cf-submit\" name=\"BtnLogin\">Log In</button>
                                                    </div>
                                               </form>";
                                    }else{
                                        unset($_SESSION['Capcay']);
                                        $usere      = cleankar($_POST['norme']);
                                        $passworde  = cleankar2($_POST['passworde']);
                                        if(strlen($usere)>30){
                                            header('Location: https://www.google.com');
                                        }else{
                                            if(getOne2("select count(*) from personal_pasien where md5(no_rkm_medis)=md5('$usere') and password=aes_encrypt('$passworde','windi')")>0){
                                                $_SESSION["ses_pasien"]= encrypt_decrypt($usere,"e");
                                                exit(header("Location:index.php"));
                                            }else{
                                                echo "<form id=\"appointment-form\" role=\"form\" onsubmit=\"return validasiIsi();\" method=\"post\" action=\"\" enctype=multipart/form-data>
                                                            <div class=\"col-md-12 col-sm-12\">
                                                                <label for=\"norme\">Nomer Rekam Medis</label>
                                                                <input type=\"text\" class=\"form-control\" name=\"norme\" pattern=\"[A-Z0-9-]{1,65}\" title=\" A-Z0-9- (Maksimal 65 karakter)\" required placeholder=\"Masukkan Nomor Rekam Medis\" onkeydown=\"setDefault(this, document.getElementById('MsgIsi1'));\" id=\"TxtIsi1\" autocomplete=\"off\" autofocus/>
                                                                <span id=\"MsgIsi1\" style=\"color:#CC0000; font-size:10px;\"></span>
                                                            </div>
                                                            <div class=\"col-md-12 col-sm-12\">
                                                                <label for=\"passworde\">Password</label>
                                                                <input type=\"password\" class=\"form-control\" name=\"passworde\" required placeholder=\"Masukkan Password\" onkeydown=\"setDefault(this, document.getElementById('MsgIsi2'));\" id=\"TxtIsi2\" autocomplete=\"off\" />
                                                                <span id=\"MsgIsi2\" style=\"color:#CC0000; font-size:10px;\"></span>
                                                            </div>
                                                            <div class=\"col-md-12 col-sm-12\">
                                                                <span style=\"color:#CC0000; font-size:12px;\">Maaf, gagal login. Nomor rekam medis atau password ada yang salah ...!</span><br/><br/>
                                                            </div>
                                                            <div class=\"col-md-12 col-sm-12\">
                                                                <label for=\"captcha\">Captcha</label>
                                                                <table width=\"100%\" border=\"0\">
                                                                    <tr>
                                                                        <td width=\"50%\" valign=\"top\">
                                                                            <img width=\"95%\" height=\"45px\" src=\"pages/captcha.php\" alt=\"gambar\" />
                                                                        </td>
                                                                        <td width=\"50%\">
                                                                            <input type=\"text\" class=\"form-control\" onkeydown=\"setDefault(this, document.getElementById('MsgIsi3'));\" id=\"TxtIsi3\" name=\"inputcaptcha\" pattern=\"[0-9]{1,6}\" title=\" 0-9 (Maksimal 6 karakter)\" required placeholder=\"Masukkan Captcha\" autocomplete=\"off\" />
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <span id=\"MsgIsi3\" style=\"color:#CC0000; font-size:10px;\"></span>
                                                            </div>
                                                            <div class=\"col-md-12 col-sm-12\">
                                                                <button type=\"submit\" class=\"form-control\" id=\"cf-submit\" name=\"BtnLogin\">Log In</button>
                                                            </div>
                                                       </form>";
                                            }
                                        }
                                    }
                                }else{
                                    echo "<form id=\"appointment-form\" role=\"form\" onsubmit=\"return validasiIsi();\" method=\"post\" action=\"\" enctype=multipart/form-data>
                                                <div class=\"col-md-12 col-sm-12\">
                                                    <label for=\"norme\">Nomer Rekam Medis</label>
                                                    <input type=\"text\" class=\"form-control\" name=\"norme\" pattern=\"[A-Z0-9-]{1,65}\" title=\" A-Z0-9- (Maksimal 65 karakter)\" required placeholder=\"Masukkan Nomor Rekam Medis\" onkeydown=\"setDefault(this, document.getElementById('MsgIsi1'));\" id=\"TxtIsi1\" autocomplete=\"off\" autofocus/>
                                                    <span id=\"MsgIsi1\" style=\"color:#CC0000; font-size:10px;\"></span>
                                                </div>
                                                <div class=\"col-md-12 col-sm-12\">
                                                    <label for=\"passworde\">Password</label>
                                                    <input type=\"password\" class=\"form-control\" name=\"passworde\" required placeholder=\"Masukkan Password\" onkeydown=\"setDefault(this, document.getElementById('MsgIsi2'));\" id=\"TxtIsi2\" autocomplete=\"off\" />
                                                    <span id=\"MsgIsi2\" style=\"color:#CC0000; font-size:10px;\"></span>
                                                </div>
                                                <div class=\"col-md-12 col-sm-12\">
                                                    <label for=\"captcha\">Captcha</label>
                                                    <table width=\"100%\" border=\"0\">
                                                        <tr>
                                                            <td width=\"50%\" valign=\"top\">
                                                                <img width=\"95%\" height=\"45px\" src=\"pages/captcha.php\" alt=\"gambar\" />
                                                            </td>
                                                            <td width=\"50%\">
                                                                <input type=\"text\" class=\"form-control\" onkeydown=\"setDefault(this, document.getElementById('MsgIsi3'));\" id=\"TxtIsi3\" name=\"inputcaptcha\" pattern=\"[0-9]{1,6}\" title=\" 0-9 (Maksimal 6 karakter)\" required placeholder=\"Masukkan Captcha\" autocomplete=\"off\" />
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <span id=\"MsgIsi3\" style=\"color:#CC0000; font-size:10px;\"></span>
                                                </div>
                                                <div class=\"col-md-12 col-sm-12\">
                                                    <button type=\"submit\" class=\"form-control\" id=\"cf-submit\" name=\"BtnLogin\">Log In</button>
                                                </div>
                                           </form>";
                                }
                            ?>
                        </div>
                    </div>
               </div>
          </div>
</section>

 <!-- Jadwal -->
 <section id="news" data-stellar-background-ratio="2.5">
    <div class="container">
         <div class="row">
              <div class="col-md-12 col-sm-12">
                   <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                        <h2>Jadwal Praktek Dokter</h2>
                   </div>
                   <div class="news-thumb wow fadeInUp" data-wow-delay="0.4s">
                       <form id="carikeyword" name="frmCariJadwal" method="post" action="" enctype=multipart/form-data>
                           <table width="100%" border='0' align="center">
                               <tr class="head">
                                  <td width="20%" align="right"><label for="keyword">Keyword</label></td>
                                  <td width="1%"><label for=":">&nbsp;:&nbsp;</label></td>
                                  <td width="60%"><input name="keyword" type="text" id="keyword" pattern="[a-zA-Z0-9, ./@_]{1,20}" title=" [a-zA-Z0-9, ./@_] (Maksimal 20 karakter) " class="form-control" value="" size="65" maxlength="20" autocomplete="off"/></td>
                                  <td width="19%" align="left">&nbsp;<input name="BtnKeyword" type=submit class="btn btn-warning" value="Cari"></td>
                               </tr>
                           </table>
                       </form>
                       <div id='hasilcari'></div>
                   </div>
              </div>
         </div>
    </div>
 </section>



 <section id="google-map">
     <div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=rs muhmmadiyah sekapuk&amp;t=&amp;z=20&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://gachanymph.com/">Gacha Nymph Download</a></div><style>.mapouter{position:relative;text-align:right;width:100%;height:400px;}.gmap_canvas {overflow:hidden;background:none!important;width:100%;height:400px;}.gmap_iframe {height:400px!important;}</style></div>
 </section>   

 