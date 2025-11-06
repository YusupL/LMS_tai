<?php
	include "dbcon.php";
	//Hunar goshmak
	if (isset($_POST['hunsub'])){
		$ady=$_POST['hady'];
		$gysga_ady=$_POST['hgady'];
		$fak=$_POST['fakh'];
		$gornush=$_POST['hgor'];
		
		echo $ady."  ".$gysga_ady."  ".$fak."  ".$gornush."  ";
		$query=mysqli_query($con, "INSERT INTO hunarler (ady, gysga_ady, fakultet, gornushi) VALUES
									('$ady', '$gysga_ady', '$fak', '$gornush')
		");
	}

  //Talyp goshmak
	if (isset($_POST['talsub'])){
		$fam=$_POST['famt'];
		$ady=$_POST['adyt'];
		$ata_ady=$_POST['aadyt'];
		$fak=$_POST['fak'];
		$id_hunar=$_POST['thunar'];
		$yyly=$_POST['yyly'];
		$toparcha=$_POST['topr'];
		$login=$_POST['loginn'];
		$parol=$_POST['demo'];
    $query=mysqli_query($con, "INSERT INTO ulanyjylar (login, parol, ulanyjy_tipi) VALUES ('$login', '$parol', '1')");
    $u_id=mysqli_insert_id($con);
		$query=mysqli_query($con,"SELECT * FROM toparchalar WHERE hunar='$id_hunar' AND yyl='$yyly' AND toparcha='$toparcha'");
    $row=mysqli_fetch_array($query);
		$id_toparcha=$row['id'];
		$query=mysqli_query($con, "INSERT INTO talyplar (ady, familiyasy, atasynyn_ady, ulanyjy_id, toparcha) VALUES ('$ady', '$fam', '$ata_ady', '$u_id', '$id_toparcha')");
	}

  //Mugallym goshmak
	if (isset($_POST['mugsub'])){
		$fam=$_POST['famm'];
		$ady=$_POST['adym'];
		$ata_ady=$_POST['aadym'];
		$kafedra=$_POST['kaf'];
		$dereje=$_POST['derj'];
		$login=$_POST['loginnmug'];
		$parol=$_POST['mug'];
		$query=mysqli_query($con, "INSERT INTO ulanyjylar (login, parol, ulanyjy_tipi,ip,gwagt) VALUES ('$login', '$parol', '2','','')");
    $idd=mysqli_insert_id($con);
		$query=mysqli_query($con, "INSERT INTO mugallymlar (ady, familiyasy, atasynyn_ady, ulanyjy_id, kafedra, mug_dereje) VALUES ('$ady', '$fam', '$ata_ady', '$idd', '$kafedra', '$dereje')");
	}

  //Ders goshmak
	if (isset($_POST['derssub'])){
		$ady=$_POST['dady'];
		$gysga_ady=$_POST['dgady'];
		$query=mysqli_query($con,"select max(id) as max from ders_atlary");
		$row=mysqli_fetch_array($query);
		$idd=$row['max']+1;
		$query=mysqli_query($con, "INSERT INTO ders_atlary (id, ady, gysga_ady) VALUES
									('$idd', '$ady', '$gysga_ady')
		");
	}

  //Ders maglumat goshmak
	if (isset($_POST['dmsub'])){

		$ders_ady_id=$_POST['dmady'];
		$gornushi=$_POST['dmgor'];
		$mug_id=$_POST['dmmug'];
		//$hunar=$_POST['dmhun'];
		//$yyl=$_POST['dmyyl'];
		//$toparcha=$_POST['dmtop'];
		$sagat_sany=$_POST['dmsag'];
		$dmarsyn=$_POST['dmarsyn'];
		$dmsyn=$_POST['dmsyn'];
		if ($_POST['dmarsyn']=='Yes') $ar_syn='1'; else $ar_syn='0';
		if ($_POST['dmsyn']=='Yes') $syn='1'; else $syn='0';

		/*$query=mysqli_query($con,"SELECT * from ders_atlary where ady='$ders_ady'");
		$row=mysqli_fetch_array($query);
		$id_ders=$row['id'];*/

		$query=mysqli_query($con, "INSERT INTO ders_maglumat (ders_id, mug_id, gornushi, sagat_sany, ara_syn_deg, synag_degish) VALUES
			('$ders_ady_id', '$mug_id', '$gornushi', '$sagat_sany', '$ar_syn', '$syn')
		");
    $ders_maglumat_id=mysqli_insert_id($con);

    foreach($_POST['dmhunar'] as $toparcha_id){
      $query=mysqli_query($con, "INSERT INTO ders_potok (ders_maglumat_id, toparcha_id) VALUES
			('$ders_maglumat_id', '$toparcha_id')
      ");
    }
	}

  //Saylama sapak goshmak
	if (isset($_POST['saysub'])){
		$fsn=$_POST['fsn'];
		$ssn=$_POST['ssn'];
		$sh=$_POST['sh'];
		$sy=$_POST['sy'];
    $syy=$_POST['syy'];
    $qhunar=mysqli_query($con, "SELECT id FROM hunarler WHERE gysga_ady='$sh'");
    $hid=mysqli_fetch_array($qhunar);
    $hidd=$hid['id'];
		$query=mysqli_query($con, "INSERT INTO saylama (first_sub, second_sub, fs_vote, ss_vote, hunar, yyl, semestr) VALUES ('$fsn', '$ssn', 0, 0, '$hidd', '$sy', '$syy')");
	}

  //Reje goshmak
  if (isset($_POST['rejesub'])){
    $sapak_reje=$_POST['sapak_reje'];
    $gun=$_POST['gun'];
    $jubut=$_POST['jubut'];
    $otag_reje=$_POST['otag_reje'];
    $sm=$_POST['sm'];
    if ($sm=='on') $sm=1; else $sm=0;
    $toparcha_reje=$_POST['toparcha_reje'];
    // echo $sapak_reje." ".$gun." ".$jubut." ".$otag_reje." ".$sm;

    $is_reje=mysqli_query($con, "SELECT ders_maglumat.id AS ders_magl_id, umumy_reje.id AS reje_id FROM ders_atlary, ders_maglumat, ders_potok, umumy_reje WHERE ders_maglumat.ders_id=ders_atlary.id AND ders_potok.ders_maglumat_id=ders_maglumat.id AND umumy_reje.ders_id=ders_maglumat.id AND ders_potok.toparcha_id='$toparcha_reje' AND umumy_reje.gun='$gun' AND umumy_reje.jubut='$jubut' AND umumy_reje.s_m='$sm'");
    if (mysqli_num_rows($is_reje)>0){
      while ($row_isreje=mysqli_fetch_array($is_reje)){
        $reje_id=$row_isreje['reje_id'];
        mysqli_query($con, "UPDATE umumy_reje SET ders_id='$sapak_reje', gun='$gun', jubut='$jubut', otag='$otag_reje', s_m='$sm' WHERE id='$reje_id'");
      }
    } else {
      mysqli_query($con, "INSERT INTO umumy_reje (ders_id, gun, jubut, otag, s_m) VALUES ('$sapak_reje', '$gun', '$jubut', '$otag_reje', '$sm')");
    }
  }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sazlamalar</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="plugins/ionicons.min.css">  
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">  

  <link rel="stylesheet" href="plugins/form-validation.css">
  <link rel="stylesheet" type="text/css" href="text/jquery.autocomplete.css" />
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
	<?php include "header.php"; ?>
  	
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-center">
            <h1>
              Talyp, mugallym, ders goşmak
            </h1>
          </div>          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid"> 
        <ul class="nav nav-pills justify-content-center mb-3" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link" id="talyp-tab" data-toggle="pill" href="#talyp" role="tab" aria-controls="talyp" aria-selected="true">Talyp goşmak</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="mugallym-tab" data-toggle="pill" href="#mugallym" role="tab" aria-controls="mugallym" aria-selected="false">Mugallym goşmak</a>
          </li>  
          <li class="nav-item">
            <a class="nav-link" id="hunar-tab" data-toggle="pill" href="#hunar" role="tab" aria-controls="hunar" aria-selected="false">Hünär goşmak</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="ders-tab" data-toggle="pill" href="#ders" role="tab" aria-controls="ders" aria-selected="false">Ders goşmak</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" id="dersmag-tab" data-toggle="pill" href="#dersmag" role="tab" aria-controls="dersmag" aria-selected="false">Ders maglumat</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="saylaw-tab" data-toggle="pill" href="#saylaw" role="tab" aria-controls="saylaw" aria-selected="false">Saýlama sapak</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="reje-tab" data-toggle="pill" href="#reje" role="tab" aria-controls="reje" aria-selected="false">Reje</a>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <!-- Talyp goshmak -->
          <div class="tab-pane" id="talyp" role="tabpanel" aria-labelledby="talyp-tab">
            <div class="container-fluid">      
              <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-tag"></i>
                    Talyp goşmak
                  </h3>
                </div>
                <div class="card-body">
                  <form class="needs-validation" novalidate method="post">
                    <div class="row">
                      <div class="col-md-4 mb-3">
                        <label for="famt">Familiýasy</label>
                        <input type="text" class="form-control" id="famt" name="famt" placeholder="" value="" required>
                        <div class="invalid-feedback">
                          Familiýasyny giriziň!
                        </div>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="adyt">Ady</label>
                        <input type="text" class="form-control" id="adyt" name="adyt" placeholder="" value="" required>
                        <div class="invalid-feedback">
                          Adyny giriziň!
                        </div>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="aadyt">Atasynyň ady</label>
                        <input type="text" class="form-control" id="aadyt" name="aadyt" placeholder="" value="" required>
                        <div class="invalid-feedback">
                          Atasynyň adyny giriziň!
                        </div>
                      </div>		  
                    </div>

                    <div class="row">
                      <div class="col-md-2 mb-3">
                        <label for="fak">Fakulteti</label>
                        <select class="custom-select d-block w-100" id="fak" name="fak" required>
                          <option selected>...</option>
                          <?php 
                            $qth=mysqli_query($con, "SELECT * FROM fakultetler");
                            while ($rth=mysqli_fetch_array($qth)){
                          ?>
                              <option value="<?=$rth['id']?>"><?=$rth['ady']?></option>
                          <?php
                            }
                          ?>                  	  
                        </select>                
                      </div>
                      <div class="col-md-2 mb-3">
                        <label for="thunar">Hünäri</label>
                        <select class="form-control select2" name="thunar" id="thunar" style="width: 100%;">                  
                        </select>
                        <div class="invalid-feedback">
                          Hünäri giriziň!
                        </div>
                      </div>
                      <div class="col-md-1 mb-3">
                        <label for="yyly">Ýyly</label>
                        <select class="custom-select d-block w-100" id="yyly" name="yyly" required>
                          <option value="1" selected="selected">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>                  
                        </select>                
                      </div>
                      <div class="col-md-1 mb-3">
                        <label for="topr">Toparça</label>
                        <select class="custom-select d-block w-100" id="topr" name="topr" required>
                          <option value="1" selected="selected">1</option>
                          <option value="2">2</option>                  
                        </select>                
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="loginn">Login</label>
                        <div class="input-group mb-3">
                          <input id="loginn" name="loginn" type="text" class="form-control">
                          <span class="input-group-append">
                            <button type="button" class="btn btn-primary" id="tlog"><i class="fas fa-user"></i></button>
                          </span>
                        </div>
                        <div class="invalid-feedback">
                          Logini generasiýa et!
                        </div>
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="demo">Açar</label>
                        <div class="input-group mb-3">
                          <input id="demo" name="demo" type="text" class="form-control">
                          <span class="input-group-append">
                            <button type="button" class="btn btn-primary" id="tpass"><i class="fas fa-edit"></i></button>
                          </span>
                        </div>
                        <div class="invalid-feedback">
                          Açar sözi generasiýa et!
                        </div>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit" name="talsub">Maglumatlary ýüklemek</button>
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
              </div>
          </div>
          <!-- Mugallym goshmak -->
          <div class="tab-pane fade" id="mugallym" role="tabpanel" aria-labelledby="mugallym-tab">
            <div class="container-fluid">      
              <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-tag"></i>
                    Mugallym goşmak
                  </h3>
                </div>
                <div class="card-body">
                  <form novalidate method="post">
                    <div class="row">
                      <div class="col-md-4 mb-3">
                        <label for="famm">Familiýasy</label>
                        <input type="text" class="form-control" id="famm" name="famm" placeholder="" value="" required>
                        <div class="invalid-feedback">
                          Familiýasyny giriziň!
                        </div>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="adym">Ady</label>
                        <input type="text" class="form-control" id="adym" name="adym" placeholder="" value="" required>
                        <div class="invalid-feedback">
                          Adyny giriziň!
                        </div>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="aadym">Atasynyň ady</label>
                        <input type="text" class="form-control" id="aadym" name="aadym" placeholder="" value="" required>
                      </div>		  
                    </div>

                    <div class="row">              
                      <div class="col-md-3 mb-3">
                        <label for="kaf">Kafedrasy</label>
                        <select class="form-control select2" id="kaf" name="kaf" style="width: 100%;">                                        
                        </select>                        
                        <div class="invalid-feedback">
                          Kafedrasyny giriziň!
                        </div>
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="derj">Derejesi</label>
                        <select class="custom-select d-block w-100" id="derj" name="derj" required>
                          <option selected>...</option>
                          <?php
                            $qmd=mysqli_query($con, "SELECT * FROM mug_dereje"); 
                            while($rmd=mysqli_fetch_array($qmd)){
                          ?>
                          <option value="<?=$rmd['id']?>"><?=$rmd['dereje']?></option>      
                          <?php    
                            }
                          ?>
                        </select>                
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="loginnmug">Login</label>
                        <div class="input-group mb-3">
                          <input id="loginnmug" name="loginnmug" type="text" class="form-control">
                          <span class="input-group-append">
                            <button type="button" class="btn btn-primary" id="mlog"><i class="fas fa-user"></i></button>
                          </span>
                        </div>
                        <div class="invalid-feedback">
                          Logini generasiýa et!
                        </div>
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="">Açar</label>
                        <div class="input-group mb-3">
                          <input id="mug" name="mug" type="text" class="form-control">
                          <span class="input-group-append">
                            <button type="button" class="btn btn-primary" id="mpass"><i class="fas fa-edit"></i></button>
                          </span>
                        </div>
                        <div class="invalid-feedback">
                          Açar sözi generasiýa et!
                        </div>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit" name="mugsub">Maglumatlary ýüklemek</button>
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
          </div>
        <!-- Hunar goshmak -->
          <div class="tab-pane fade" id="hunar" role="tabpanel" aria-labelledby="hunar-tab">
            <div class="container-fluid">      
              <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-tag"></i>
                    Hünär goşmak
                  </h3>
                </div>
                <div class="card-body">
                  <form class="needs-validation" novalidate method="post">
                    <div class="row">
                      <div class="col-md-4 mb-3">
                        <label for="hady">Ady</label>
                        <input type="text" class="form-control" id="hady" name="hady" placeholder="" value="" required>
                        <div class="invalid-feedback">
                          Hünäriň adyny giriziň!
                        </div>
                      </div>
                      <div class="col-md-2 mb-3">
                        <label for="hgady">Gysga ady</label>
                        <input type="text" class="form-control" id="hgady" name="hgady" placeholder="" value="" required>
                        <div class="invalid-feedback">
                          Gysga adyny giriziň!
                        </div>
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="fakh">Fakulteti</label>
                        <select class="custom-select d-block w-100" id="fakh" name="fakh" required>
                          <option selected>...</option>
                          <?php 
                            $qhgf=mysqli_query($con, "SELECT * FROM fakultetler");
                            while($rhgf=mysqli_fetch_array($qhgf)){
                          ?>
                          <option value="<?=$rhgf['id']?>"><?=$rhgf['gysga_ady']?></option>
                          <?php
                            }
                          ?>                                         
                        </select>                
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="hgor">Görnüşi</label>
                        <select class="custom-select d-block w-100" id="hgor" name="hgor" required>
                          <option value="1" selected="selected">Hünärmen</option>
                          <option value="2">Bakalawr</option>
                          <option value="3">Dil öwreniş bölümi</option>                  
                        </select>                
                      </div>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit" name="hunsub">Maglumatlary ýüklemek</button>
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
          </div>
          <!-- Ders goshmak -->
          <div class="tab-pane fade" id="ders" role="tabpanel" aria-labelledby="ders-tab">
            <div class="container-fluid">      
              <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-tag"></i>
                    Ders goşmak
                  </h3>
                </div>
                <div class="card-body">
                  <form class="needs-validation" novalidate method="post" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-6 mb-3">
                        <label for="dady">Dersiň ady</label>
                        <input type="text" class="form-control" id="dady" name="dady" placeholder="" value="" required>
                        <div class="invalid-feedback">
                          Dersiň adyny giriziň!
                        </div>
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="dgady">Gysga ady</label>
                        <input type="text" class="form-control" id="dgady" name="dgady" placeholder="" value="" required>
                        <div class="invalid-feedback">
                          Gysga adyny giriziň!
                        </div>
                      </div>              
                    </div>
                    <button class="btn btn-primary btn-block" type="submit" name="derssub">Maglumatlary ýüklemek</button>
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
          </div>
          <!-- Ders maglumat -->
          <div class="tab-pane active" id="dersmag" role="tabpanel" aria-labelledby="dersmag-tab">
            <div class="container-fluid">      
              <div class="card card-default color-palette-box">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-tag"></i>
                    Ders maglumat
                  </h3>
                </div>
                <div class="card-body">
                  <form class="needs-validation" novalidate method="post" enctype="multipart/form-data">
                    <div class="row">
                      
                      <div class="col-md-6 mb-3">
                        <label for="dmady">Dersiň ady</label>
                        <select class="form-control select2" id="dmady" name="dmady">
                        </select>
                      </div>
                      <div class="col-md-2 mb-3">
                        <label for="dmgor">Görnüşi</label>
                        <select class="custom-select d-block w-100" id="dmgor" name="dmgor" required>
                          <option value="1" selected="selected">Umumy</option>
                          <option value="2">Tejribe</option>
                          <option value="3">Amaly</option>
                          <option value="4">Söhbet</option>
                        </select>                
                      </div>
                      <div class="col-md-4 mb-3">
                        <label for="dmmug">Okadýan mugallym</label>
                        <select class="form-control select2" id="dmmug" name="dmmug">
                        </select>
                      </div>              		  
                    </div>

                    <div class="row">
                      <div class="col-md-2 mb-3">
                        <label for="dmyyl">Ýyly</label>
                        <select class="custom-select d-block w-100" id="dmyyl" name="dmyyl" required>
                          <option value="1" selected="selected">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>                  
                        </select>                
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="dmhun">Hünärler</label>
                        <select class="select2" multiple="multiple" id="dmhunar" name="dmhunar[]" style="width: 100%;">
                        <!--Hunarlerin adyny chykaryar-->
                        
                        </select>
                      </div>             
                      
                      <div class="col-md-3 mb-3">
                        <label for="dmsag">Sagat sany</label>                
                        <input type="number"  class="form-control"  id="dmsag" name="dmsag">
                        <div class="invalid-feedback">
                          Sagat sany giriz
                        </div>
                      </div>

                      <div class="col-md-1 mb-3">
                          <label for="dmarsyn">Aralyk synag</label>                
                          <input type="checkbox"  class="form-control" name="dmarsyn" value="Yes">
                        </div>

                      <div class="col-md-1 mb-3">
                          <label for="dmsyn">Synag</label>                
                          <input type="checkbox"  class="form-control" name="dmsyn" value="Yes">
                      </div>

                    </div>
                    <button class="btn btn-primary btn-block" type="submit" name="dmsub">Maglumatlary ýüklemek</button>
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
              </div>
          </div>
          <!-- Saylama sapak -->
          <div class="tab-pane fade" id="saylaw" role="tabpanel" aria-labelledby="saylaw-tab">
            <div class="container-fluid">      
              <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-tag"></i>
                    Saýlama sapak
                  </h3>
                </div>
                <div class="card-body">
                  <form class="needs-validation" novalidate method="post">
                    <div class="row">
                      <div class="col-md-3 mb-3">
                        <label for="famt">1-nji dersiň ady</label>
                        <input type="text" class="form-control" id="fsn" name="fsn" placeholder="" value="" required autofocus>
                        <div class="invalid-feedback">
                          Familiýasyny giriziň!
                        </div>
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="adyt">2-nji dersiň ady</label>
                        <input type="text" class="form-control" id="ssn" name="ssn" placeholder="" value="" required>
                        <div class="invalid-feedback">
                          Adyny giriziň!
                        </div>
                      </div>
                      <div class="col-md-2 mb-3">
                        <label for="thunar">Hünäri</label>
                        <input name="sh" type="text" class="form-control" id="sh">
                        <div class="invalid-feedback">
                          Hünäri giriziň!
                        </div>
                      </div>
                      <div class="col-md-2 mb-3">
                        <label for="yyly">Ýyly</label>
                        <select class="custom-select d-block w-100" id="sy" name="sy" required>
                          <option value="1" selected="selected">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>                  
                        </select>                
                      </div>
                      <div class="col-md-2 mb-3">
                        <label for="yyly">Ýarym ýyllyk</label>
                        <select class="custom-select d-block w-100" id="syy" name="syy" required>
                          <option value="1" selected="selected">1-nji</option>
                          <option value="2">2-nji</option>                               
                        </select>                
                      </div>
                      <button class="btn btn-primary btn-block" type="submit" name="saysub">Maglumatlary ýüklemek</button>              		  
                    </div>
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
            </div>                      
          </div>
          <!-- Reje goshmak -->
          <div class="tab-pane fade" id="reje" role="tabpanel" aria-labelledby="reje-tab">
            <div class="container-fluid">      
              <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-tag"></i>
                    Reje goşmak
                  </h3>
                </div>
                <div class="card-body">
                  <form class="needs-validation" novalidate method="post">
                    <div class="row">
                      <div class="col-md-3 mb-3">
                        <label for="fak">Fakulteti</label>
                        <select class="custom-select d-block w-100" id="fak_reje" name="fak_reje" required>
                          <option selected>...</option>
                          <?php 
                            $qth=mysqli_query($con, "SELECT * FROM fakultetler");
                            while ($rth=mysqli_fetch_array($qth)){
                          ?>
                              <option value="<?=$rth['id']?>"><?=$rth['ady']?></option>
                          <?php
                            }
                          ?>                  	  
                        </select>                
                      </div>
                      <div class="col-md-1 mb-3">
                        <label for="yyl_reje">Yyl</label>
                        <select class="custom-select d-block w-100" id="yyl_reje" name="yyl_reje" required>
                          <option value="0" selected="selected">...</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>                          
                        </select>
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="toparcha_reje">Toparça</label>
                        <select class="form-control select2" name="toparcha_reje" id="toparcha_reje" style="width: 100%;">                  
                        </select>
                        <div class="invalid-feedback">
                        Toparça giriziň!
                        </div>
                      </div>
                      <div class="col-md-1 mb-3">
                        <label for="gun">Gun</label>
                        <select class="custom-select d-block w-100" id="gun" name="gun" required>
                          <option value="1" selected="selected" >1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                        </select>
                      </div>
                      <div class="col-md-1 mb-3">
                        <label for="jubut">Jubut</label>
                        <select class="custom-select d-block w-100" id="jubut" name="jubut" required>
                          <option value="0" selected="selected" >...</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-1 mb-3">
                        <label for="dmarsyn">S/M</label>
                        <input type="checkbox" checked class="form-control" name="sm" id="sm">
                      </div>
                      <div class="col-md-6 mb-4">
                        <label for="demo">Sapak</label>
                        <div class="input-group mb-3">
                        <select class="custom-select d-block w-100" id="sapak_reje" name="sapak_reje" required>
                        </select>
                        </div>
                      </div>
                      <div class="col-md-2 mb-4">
                        <label for="demo">Otag</label>
                        <div class="input-group mb-3">
                        <select  class="form-control select2" id="otag_reje" name="otag_reje" style="width: 100%">
                        <option selected>...</option>
                          <?php 
                            $qotag=mysqli_query($con, "SELECT * FROM otaglar");
                            while ($rotag=mysqli_fetch_array($qotag)){
                          ?>
                              <option value="<?=$rotag['id']?>"><?=$rotag['nomer']?></option>
                          <?php
                            }
                          ?>  
                        </select>
                        </div>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit" name="rejesub">Maglumatlary ýüklemek</button>
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
          </div>
          <!-- Reje goshmak gutardy-->
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>TOHI</b>
    </div>
    <strong>Ähli hukuklar goralan &copy; <script>var x=new Date(); document.write(x.getFullYear());</script></strong>
  </footer>  
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script>
  $(function(){
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $("#fak").change(function(){
      var id=$(this).val();
      $.ajax({
        url: "autocomplete_hunar.php",
        method: "POST",
        data: {id: id},
        dataType: "html",
        success: function(data){
            $('#thunar').html(data);
        } 
      })        
    })

    $("#yyl_reje").change(function(){
      var yyl_reje=$(this).val();
      var fak_reje=$("#fak_reje").val();
      $.ajax({
        url: "autocomplete_toparcha.php",
        method: "POST",
        data: {yyl_reje: yyl_reje, fak_reje: fak_reje},
        dataType: "html",
        success: function(data){
            $('#toparcha_reje').html(data);
        } 
      })        
    })

    $("#dmyyl").change(function(){
      var id=$(this).val();
      $.ajax({
        url: "autocomplete_yyl_hunar.php",
        method: "POST",
        data: {id: id},
        dataType: "html",
        success: function(data){
            $('#dmhunar').html(data);
        } 
      })        
    })

    $("#jubut").change(function(){
      var jubut=$(this).val();
      var toparcha_reje=$("#toparcha_reje").val();
      var gun=$("#gun").val();      
      var sm=$("#sm").is(":checked");
      $.ajax({
        url: "autocomplete_rejesapak.php",
        method: "POST",
        data: {toparcha_reje: toparcha_reje, jubut: jubut, gun: gun, sm: sm},
        dataType: "html",
        success: function(data){
            $('#sapak_reje').html(data);
        }
      })
    })

    $("#jubut").change(function(){
      var jubut=$(this).val();
      var toparcha_reje=$("#toparcha_reje").val();
      var gun=$("#gun").val();      
      var sm=$("#sm").is(":checked");
      $.ajax({
        url: "autocomplete_rejeotag.php",
        method: "POST",
        data: {toparcha_reje: toparcha_reje, jubut: jubut, gun: gun, sm: sm},
        dataType: "html",
        success: function(data){
            $('#otag_reje').html(data);
        }
      })
    })

    $("#kaf").select2({
      placeholder: "Kafedrany saýlaň ...",
      ajax: {
        url: "autocomplete_kaf.php",
        type: "get",
        dataType: "json",
        delay: 250,
        data: function (params){
          return{
            searchTerm: params.term
          };
        },
        processResults: function (response) {
          return {
            results: response,
          };
        },
        cache: true        
      },
    })

    $("#dmady").select2({
      placeholder: "Dersi saýlaň ...",
      ajax: {
        url: "autocomplete_ders.php",
        type: "get",
        dataType: "json",
        delay: 250,
        data: function (params){
          return{
            searchTerm: params.term
          };
        },
        processResults: function (response) {
          return {
            results: response,
          };
        },
        cache: true        
      },
    })

    $("#dmmug").select2({
      placeholder: "Mugallymy saýlaň ...",
      ajax: {
        url: "autocomplete_mug.php",
        type: "get",
        dataType: "json",
        delay: 250,
        data: function (params){
          return{
            searchTerm: params.term
          };
        },
        processResults: function (response) {
          return {
            results: response,
          };
        },
        cache: true        
      },
    })

    function generateString(length) {
      let characters ='0123456789abdefghijkmnprstuwyzABDEFGHJKLMNPRSTUWYZ';
      let result = '';
      let charactersLength = characters.length;
      for ( let i = 0; i < length; i++ ) {
          result += characters.charAt(Math.floor(Math.random() * charactersLength));
      }
      return result;
    }

    $("#tlog").click(function(){
      var log=$("#adyt").val().charAt(0)+$("#famt").val();
      $("#loginn").val(log);  
    })

    $("#tpass").click(function(){
      $("#demo").val(generateString(8))
    })

    $("#mlog").click(function(){
      var log=$("#adym").val().charAt(0)+$("#famm").val();
      $("#loginnmug").val(log);  
    })

    $("#mpass").click(function(){
      $("#mug").val(generateString(8))
    })  
  })
  </script>
</body>
</html>
