<?php
  include "dbcon.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Synag netijeleri</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="plugins/ionicons.min.css">  
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <style>
    .styled-table {
      border-collapse: collapse;
      margin: 25px 0;
      font-size: 0.9em;
      font-family: sans-serif;
      min-width: 400px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    .styled-table thead tr {
      background-color: #007bff;
      color: #ffffff;
      text-align: left;
    }

    .styled-table th,
    .styled-table td {
      padding: 12px 15px;
      border: 1px solid #BCBABA;
    }

    .styled-table tbody tr {
      border: 1px solid #fff;
    }

    .styled-table tbody tr:nth-of-type(even) {
      background-color: #f3f3f3;
    }

    .styled-table tbody tr:last-of-type {
      border-bottom: 2px solid #007bff;
    }

    .rot {
      min-width: 10px;
      text-align: center; 
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  	<?php include "header.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-center">
            <h1>
              Netijeler
            </h1>
          </div>          
        </div>
        <div class="card text-white bg-primary mb-3">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-tag"></i>
              Saýla
          </div>
          <div class="card-body">
            <form class="needs-validation" novalidate method="post">
               <div class="row">
                <div class="col-md-2 mb-3">
                  <label for="yyly">Ýyly</label>
                  <select class="custom-select d-block w-100 neti" id="yyly" name="yyly" required>
                    <option value="0"></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>	
                    <option value="4">4</option>
                    <option value="5">5</option>				  
                  </select>                
                </div>
                <div class="col-md-3 mb-3">
                  <label for="hunar">Hünäri</label>
                  <select class="custom-select d-block w-100 neti" id="hunar" name="hunar" required>
                    <option value="0"></option>
                    <?php
                      $query_hunar=mysqli_query($con, "SELECT * FROM hunarler");
                      while ($row_hunar=mysqli_fetch_array($query_hunar)) {?>
                        <option value="<?php echo $row_hunar['id']; ?>"><?php echo $row_hunar['gysga_ady']; ?></option>
                        <?php
                      }
                    ?>  
                  </select>                
                </div>
                <div class="col-md-3 mb-3">
                  <label for="hunar">Güni</label>
                  <input type="date" class="form-control neti" id="sene">
                </div>              
              </div>              
            </form>
          </div>
          <!-- /.card-body -->
        </div>
        <div class="card"> 
          <div class="card-body">
            <div id="result">
             
            </div>
          </div>
          <!-- /.card-body -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
  
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

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script src="plugins/form-validation.js"></script>

<script>
  $('.neti').on("change", function(event){
    var yyly=$("#yyly").val();
    var hunar=$("#hunar").val();
    var sene=$("#sene").val();
    $.ajax({
      url:"get_netije.php",
      method:"POST",
      data: {yyly:yyly, hunar:hunar, sene:sene},
      beforeSend:function(){
        $('#result').html("Maglumatlar ýüklenýär");
        },
        success:function(data){
            $('#result').html(data);
          }
        });
      });
</script>
</body>
</html>
