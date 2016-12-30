<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title;?></title>
    <link rel="stylesheet" href="<?php echo base_url();?>asset/plugins/select2/select2.min.css">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/plugins/datepicker/datepicker3.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>asset/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
function loadTerritory()
{
    var ao = $("#ao").val();
    $.ajax({
        type:'GET',
        url:"<?php echo base_url(); ?>outlet/territory",
        data:"id=" + ao,
        success: function(html)
        {
            $("#to").html(html);
        }
    });
}
function loadSubTerritory()
{
    var to = $("#to").val();
    $.ajax({
        type:'GET',
        url:"<?php echo base_url(); ?>outlet/sub_territory",
        data:"id=" + to,
        success: function(html)
        {
            $("#sub").html(html);
        }
    });
}
function loadDistrik()
{
    var sub = $("#sub").val();
    $.ajax({
        type:'GET',
        url:"<?php echo base_url(); ?>outlet/distrik",
        data:"id=" + sub,
        success: function(html)
        {
            $("#distrik").html(html);
        }
    });
}
function loadDistrikKaryawan()
{
    var sub = $("#sub").val();
    var tipe1 = $("#tipe1").val();
    var tipe2 = $("#tipe2").val();
    var data  = 'id='+ sub + '&tipe1=' + tipe1 + '&tipe2=' + tipe2;
    $.ajax({
        type:'GET',
        url:"<?php echo base_url(); ?>outlet/distrikkaryawan",
        data: 	data,
        success: function(html)
        {
            $("#distrik").html(html);
        }
    });
}
function loadKaryawanDistrik()
{
    var distrik = $("#distrik").val();
    $.ajax({
        type:'GET',
        url:"<?php echo base_url(); ?>outlet/karyawandistrik",
        data:"id=" + distrik,
        success: function(html)
        {
            $("#karyawan").html(html);
        }
    });
    var distrik = $("#distrik").val();
    var data  = 'id='+ distrik;
    $.ajax({
        type:'GET',
        url:"<?php echo base_url(); ?>outlet/rute2",
        data: data,
        success: function(html)
        {
            $("#rute").html(html);
        }
    });
}
function loadKaryawanTipeDistrik()
{
    var tipe = $("#tipe").val();
    $.ajax({
        type:'GET',
        url:"<?php echo base_url(); ?>outlet/karyawantipedistrik",
        data:"id=" + tipe,
        success: function(html)
        {
            $("#karyawan").html(html);
        }
    });
}
function loadRute()
{
    var karyawan = $("#karyawan").val();
    var distrik = $("#distrik").val();
    var data  = 'id='+ distrik + '&karyawan=' + karyawan;
    $.ajax({
        type:'GET',
        url:"<?php echo base_url(); ?>outlet/rute",
        data: data,
        success: function(html)
        {
            $("#rute").html(html);
        }
    });
}
function loadRute2()
{
    var distrik = $("#distrik").val();
    var data  = 'id='+ distrik;
    $.ajax({
        type:'GET',
        url:"<?php echo base_url(); ?>outlet/rute2",
        data: data,
        success: function(html)
        {
            $("#rute").html(html);
        }
    });
}
function loadCallsheet()
{
    var karyawan = $("#karyawan").val();
    var tipe = $("#tipe").val();
    var sub = $("#sub").val();
    $.ajax({
        type:'GET',
        url:"<?php echo base_url(); ?>outlet/callsheet",
        data:"id=" + karyawan+ "&tipe=" + tipe+"&sub=" + sub,
        success: function(html)
        {
            $("#distrik").html(html);
        }
    });
}
</script>
<script type="text/javascript">
function loadKabupaten()
{
    var provinsi = $("#provinsi").val();
    $.ajax({
        type:'GET',
        url:"<?php echo base_url(); ?>outlet/kabupaten",
        data:"id=" + provinsi,
        success: function(html)
        {
            $("#kabupaten").html(html);
        }
    });
}
function loadKecamatan()
{
    var kabupaten = $("#kabupaten").val();
    $.ajax({
        type:'GET',
        url:"<?php echo base_url(); ?>outlet/kecamatan",
        data:"id=" + kabupaten,
        success: function(html)
        {
            $("#kecamatan").html(html);
        }
    });
}
function loadKelurahan()
{
    var kecamatan = $("#kecamatan").val();
    $.ajax({
        type:'GET',
        url:"<?php echo base_url(); ?>outlet/kelurahan",
        data:"id=" + kecamatan,
        success: function(html)
        {
            $("#kelurahan").html(html);
        }
    });
}
</script>

<?php include "asset/fungsi_indotgl.php";?>

</head>
<body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="#" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">RSAS</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><font size="3px"><b>RETAIL & SA INFORMATION SYSTEM</b></font></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span> MENU
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                PROFILE <img src="<?php echo base_url();?>asset/dist/img/avatar5.png" class="user-image" alt="User Image">
                               <!-- HIDDEN USERNAME <span class="hidden-xs"><?php echo strtoupper($user);?> &nbsp;&nbsp;<i class="fa fa-laptop"></i></span> -->
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                   <div class="img-circle" style="background-color:white; width:30%; margin:0px auto; text-align:center;">
	                            <font size="4.5" color="#3C8DBC"><?php echo strtoupper(substr($user,0,1));?></font>
	                           </div>
                                   <p>
                                      <?php echo strtoupper($user);?> - <?php echo $level;?>
                                      <small>PT. Surya Mustika Lampung</small>
                                  </p>
                              </li>
                              <!-- Menu Body -->
                              <!-- Menu Footer-->
                              <li class="user-footer">
                               <div class="pull-right">
                                  <a href="<?php echo base_url();?>sistem/logout" class="btn btn-default btn-flat"><i class="fa fa-power-off"></i>&nbsp; Logout</a>
                              </div>
                          </li>
                      </ul>
                  </li>
                  <!-- Control Sidebar Toggle Button -->
              </ul>
          </div>
      </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left img-circle" style="background-color:#3C8DBC;">
                <font size="5" color="white">&nbsp;&nbsp;<?php echo strtoupper(substr($user,0,1));?>&nbsp;&nbsp;</font>
            </div>
            <div class="pull-left info">
                <p><?php echo ucfirst(strtolower($user));?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
       -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header"><b><font color="white">DAFTAR MENU</font></b></li>
            <li>
                <a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i><span>DASHBOARD</span></a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-map"></i>
                    <span>DATA AREA OFFICE</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url();?>area_office"><i class="fa fa-home"></i>DATA AREA OFFICE</a></li>
                    <li><a href="<?php echo base_url();?>territory"><i class="fa fa-home"></i>DATA TERRITORY</a></li>
                    <li><a href="<?php echo base_url();?>sub_territory"><i class="fa fa-home"></i>DATA SUB TERRITORY</a></li>
                </ul>
            </li>
			<?php if (($level=="Admin")or($level=="RDA STAFF")or($level=="Administrator")or($level=="Direksi")){?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>DATA KARYAWAN</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url();?>jabatan"><i class="fa fa-male"></i>DATA JABATAN</a></li>
                    <li><a href="<?php echo base_url();?>karyawan"><i class="fa fa-male"></i>DATA KARYAWAN</a></li>
                </ul>
            </li>
			<?php } ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-subway"></i>
                    <span>MANAJEMEN RUTE</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
					<?php if ($level<>"Direksi"){?>

                    <li><a href="<?php echo base_url();?>distrik/pilih"><i class="fa fa-map-marker"></i>INPUT DISTRIK - RUTE - OUTLET</a></li>
					<?php  } ?>
                    <li><a href="<?php echo base_url();?>distrik/lihat"><i class="fa fa-map-marker"></i>DATA DISTRIK - RUTE</a></li>
                    <!-- <li><a href="<?php echo base_url();?>distrik"><i class="fa fa-map-marker"></i>DATA DISTRIK</a></li>
                    <li><a href="<?php echo base_url();?>tipe_distrik"><i class="fa fa-map-marker"></i>DATA TIPE DISTRIK</a></li>
                    <li><a href="<?php echo base_url();?>rute"><i class="fa fa-map-marker"></i>DATA RUTE</a></li> -->
                </ul>
            </li>
			<?php if (($level=="Administrator")or($level=="RDA STAFF")or($level=="Admin")){?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-map-signs"></i>
                    <span>DATA WILAYAH</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url();?>provinsi"><i class="fa fa-object-group"></i>DATA PROVINSI</a></li>
                    <li><a href="<?php echo base_url();?>kabupaten"><i class="fa fa-object-group"></i>DATA KABUPATEN</a></li>
                    <li><a href="<?php echo base_url();?>kecamatan"><i class="fa fa-object-group"></i>DATA KECAMATAN</a></li>
                    <li><a href="<?php echo base_url();?>kelurahan"><i class="fa fa-object-group"></i>DATA KELURAHAN</a></li>
                </ul>
            </li>
            <?php } ?>
                <?php if ($level=="Administrator"){?>
			<li class="treeview">
                <a href="#">
                    <i class="fa fa-car"></i>
                    <span>DATA KENDARAAN</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url();?>tipe_kendaraan"><i class="fa fa-motorcycle"></i>DATA TIPE KENDARAAN</a></li>
                    <li><a href="<?php echo base_url();?>kendaraan"><i class="fa fa-motorcycle"></i>DATA KENDARAAN</a></li>
                </ul>
            </li>
			<?php } ?>
			<li class="treeview">
                <a href="#">
                    <i class="fa fa-home"></i>
                    <span>DATA OUTLET</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php if ($level=="Administrator"){?>
                    <li><a href="<?php echo base_url();?>tipe_outlet"><i class="fa fa-contao"></i><span>DATA TIPE OUTLET</span></a></li>
                     <?php } ?>
                    <li> <a href="<?php echo base_url();?>outlet/lihat"><i class="fa fa-home"></i><span>LIHAT DATA OUTLET</span></a></li>
                </ul>
            </li>
			 <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i>
                    <span>DATA CALLSHEET</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url();?>callsheet/cetak"><i class="fa fa-file-text-o"></i>CETAK CALLSHEET</a></li>
					<?php if ($level<>"Direksi"){?>
					<?php if ($level<>"ASM"){?>
					<?php if ($level<>"RDA STAFF"){?>
                    <li><a href="<?php echo base_url();?>callsheet"><i class="fa fa-file-text-o"></i>INPUT CALLSHEET</a></li>
					<?php } } } ?>
                    <li><a href="<?php echo base_url();?>callsheet/grafik"><i class="fa fa-file-text-o"></i>DATA PEMASARAN</a></li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-edit"></i>
                            <span>INTEGRASI BOSNET</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">    
                            <li><a href="<?php echo base_url();?>callsheet/upload_bosnet"><i class="fa fa-file-text-o"></i>UPLOAD DATA BOSNET</a></li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-edit"></i>
                                    <span>SALES REPORT</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="<?php echo base_url();?>callsheet/output_ris_bosnet"><i class="fa fa-file-text-o"></i>PERFORMANCE & GROWTH</a></li>
                                    <li><a href="<?php echo base_url();?>callsheet/weekly_sales"><i class="fa fa-file-text-o"></i>WEEKLY SALES</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    
                    <!--<li><a href="<?php echo base_url();?>callsheet/performance"><i class="fa fa-file-text-o"></i>TARGET & GROWTH PERFORMANCE</a></li>-->
                    <!--<li><a href="<?php echo base_url();?>callsheet/notasi"><i class="fa fa-file-text-o"></i>LIHAT OUTLET BY NOTASI</a></li>-->
                </ul>
            </li>
			<?php if ($level=="Administrator"){?>
			<li>
				<a href="<?php echo base_url();?>brand"><i class="fa fa-suitcase"></i><span>DATA BRAND</span></a>
			</li>
            <li>
				<a href="<?php echo base_url();?>user"><i class="fa fa-user"></i><span>DATA USER</span></a>
			</li>
             <?php } ?>
			 <?php if ($level<>"Admin"){?>
			 <?php if ($level<>"ASM"){?>
			 <?php if ($level<>"RDA STAFF"){?>
			<li>
                <a href="<?php echo base_url();?>password/ubah/<?php echo $user;?>"><i class="fa fa-lock"></i><span>GANTI PASSWORD</span></a>
            </li>
				<?php } } }?>
			<li>
                <a href="<?php echo base_url();?>sistem/logout"><i class="fa fa-undo"></i><span>LOGOUT</span></a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
