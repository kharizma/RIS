<!DOCTYPE html>
<html lang="en">
<head>
<?php
error_reporting(1);
?>
<title><?php echo $title;?></title>
<style type="text/css">
.classname {
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #29c4d9), color-stop(1, #107ec7) );
	background:-moz-linear-gradient( center top, #29c4d9 5%, #107ec7 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#29c4d9', endColorstr='#107ec7');
	background-color:#29c4d9;
	-webkit-border-top-left-radius:6px;
	-moz-border-radius-topleft:6px;
	border-top-left-radius:6px;
	-webkit-border-top-right-radius:6px;
	-moz-border-radius-topright:6px;
	border-top-right-radius:6px;
	-webkit-border-bottom-right-radius:6px;
	-moz-border-radius-bottomright:6px;
	border-bottom-right-radius:6px;
	-webkit-border-bottom-left-radius:6px;
	-moz-border-radius-bottomleft:6px;
	border-bottom-left-radius:6px;
	text-indent:0;
	border:1px solid #f2eff2;
	display:inline-block;
	color:#e6e1e6;
	font-family:arial;
	font-size:15px;
	font-weight:bold;
	font-style:normal;
	height:50px;
	line-height:50px;
	width:100px;
	text-decoration:none;
	text-align:center;
	text-shadow:1px 1px 0px #ffffff;
}
.classname:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #107ec7), color-stop(1, #29c4d9) );
	background:-moz-linear-gradient( center top, #107ec7 5%, #29c4d9 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#107ec7', endColorstr='#29c4d9');
	background-color:#107ec7;
}.classname:active {
	position:relative;
	top:1px;
}</style>
<style type="text/css">

::selection{ background-color: #E13300; color: white; }
::moz-selection{ background-color: #E13300; color: white; }
::webkit-selection{ background-color: #E13300; color: white; }

body {
	background-color: #fff;
	margin: 10px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: white;
	background-color: #019273;
	border-bottom: 1px solid #D0D0D0;
	font-size: 14px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 5px 5px 5px 15px;
}
hr{
	border: 1px solid #D0D0D0;
}
code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 10px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin: 5px 5px 5px 5px;
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 10px;
	border: 1px solid #D0D0D0;
	-webkit-box-shadow: 0 0 8px #D0D0D0;
}

p {
	margin: 12px 15px 12px 15px;
}
table{

	border-collapse: collapse;
	margin: 12px 15px 12px 15px;
}

table, th, td {
	padding: 2px 5px 2px 5px;
    border: 1px solid #D0D0D0;
}
a{
	text-decoration:none;
}
</style>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

 
<script>
$(document).ready(function(){
    $("button").click(function(){
        $("#div1").fadeIn();
        $("#div2").fadeIn("slow");
        $("#div3").fadeIn(3000);
    });
});
</script>
</head>
<body>
<?php $i=0; foreach($callsheet->result_array() as $tampil ){

?>
	<div id="container">
	
		<h1><b>INPUT CALLSHEET <?php echo $jenis;?></b></h1>
		<div style="float: left;width: 400px;">
		<table>
		<tr>
			<td width="150" bgcolor="#019273"><font style="color:white;"><b>AREA OFFICE</b></font></td>
			<td>:</td>
			<td width="250"><?php echo $tampil['nama_ao'];?></td>
		</tr>
		<tr>
			<td bgcolor="#019273"><font style="color:white;"><b>TERRITORY</b></font></td>
			<td>:</td>
			<td><?php echo $tampil['nama_territory'];?></td>
		</tr>
		<tr>
			<td bgcolor="#019273"><font style="color:white;"><b>SUB TERRITORY</b></font></td>
			<td>:</td>
			<td><?php echo $tampil['nama_sub_territory'];?></td>
		</tr>
		<tr>
			<td bgcolor="#019273"><font style="color:white;"><b>DISTRIK</b></font></td>
			<td>:</td>
			<td><?php echo $tampil['nama_distrik'];?></td>
		</tr>
		<tr>
			<td bgcolor="#019273"><font style="color:white;"><b>RUTE</b></font></td>
			<td>:</td>
			<td><?php echo $tampil['nama_rute'];?></td>
		</tr>
		<tr>
			<td bgcolor="#019273"><font style="color:white;"><b>NAMA SALESMAN</b></font></td>
			<td>:</td>
			<td><?php echo $tampil['nama_karyawan'];?></td>
		</tr>
		</table>
		
	</div>
	<div style="float: left;
	width: 100px;
	margin-left:auto;" >
	<table width="100%">
	
	
	<tr align="center">
		<td width="50%" bgcolor="#019273"><font style="color:white;"><b>TO</b></font></td>
		<td><?php foreach($total_outlet->result_array() as $total_outlet){ echo number_format($total_outlet['total']);}?></td>
	</tr>
	<tr align="center">
		<td width="50%" bgcolor="#019273"><font style="color:white;"><b>TK</b></font></td>
		<td><?php foreach($total_kunjungan->result_array() as $kunjungan){ echo number_format($kunjungan['total']);}?></td>
	</tr>
	</table>
	</div>
	<div style="overflow:auto;float: left;
width: 750px;
margin-left:20px" >
	<table width="150%">
	<tr align="center" bgcolor="#019273" height="30">
		<td><font style="color:white;"><b>OPTION</b></font></td>
		<td><font style="color:white;"><b>KETERANGAN</b></font></td>
		<?php
		foreach($brand->result_array() as $brand){
		?>
		<td><font style="color:white;"><b><?php echo $brand['nama_brand'];?></b></font></td>
		<?php } ?>
	</tr>
	<tr height="30">
		<td rowspan="3" align="center">
		<img src="<?php echo base_url();?>asset/images/tambah.gif" onclick="window.open('<?php echo base_url();?>callsheet/isi_stock/<?php echo $this->uri->segment(3);?>', 'winpopup', 'toolbar=yes,statusbar=yes,menubar=yes,resizable=yes,scrollbars=yes,width=900px,height=600px');" style="cursor:pointer">
		</td>
		<td>STOCK AWAL</td>
		<?php
		foreach($stock->result_array() as $stock){
		?>
		<td align="center"><?php echo $stock['stock_awal'];?></td>
		<?php } ?>
	</tr>
	<tr height="30">
		<td>KELUAR</td>
		<?php
		foreach($stock1->result_array() as $stock1){
		?>
		<td align="center"><?php echo $stock1['stock_keluar'];?></td>
		<?php } ?>
	</tr>
	<tr height="30">
		<td>STOCK AKHIR</td>
		<?php
		foreach($stock2->result_array() as $stock2){
		$hasil=$stock2['stock_awal']-$stock2['stock_keluar'];
		?>
		<td align="center"><?php echo $hasil;?></td>
		<?php } ?>
	</tr>
	</table>
	</div>
	<div style="float: left;
width: 200px;
margin-left:auto;" >
	<table width="100%">
	<tr align="center" bgcolor="#019273">
		<td width="20%"><font style="color:white;"><b>OPTION</b></font></td>
		<td width="40%"><font style="color:white;"><b>KETERANGAN</b></font></td>
		<td width="40%"><font style="color:white;"><b>KM</b></font></td>
	</tr>
	<tr>
		<td rowspan="3" align="center">
		<img src="<?php echo base_url();?>asset/images/tambah.gif" onclick="window.open('<?php echo base_url();?>callsheet/isi_km/<?php echo $this->uri->segment(3);?>', 'winpopup', 'toolbar=yes,statusbar=yes,menubar=yes,resizable=yes,scrollbars=yes,width=1000,height=800');" style="cursor:pointer">
		</td>
		<td>KM AWAL</td>
		<td><?php echo number_format($tampil['km_awal']);?></td>
	</tr>
	<tr>
		<td>KM PENGISIAN</td>
		<td><?php echo number_format($tampil['km_pengisian']);?></td>
	</tr>
	<tr>
		<td>KM AKHIR</td>
		<td><?php echo number_format($tampil['km_akhir']);?></td>
	</tr>
	</table>
	</div>
	<div style="clear: both;">
	</div>
		<div style="overflow:auto;width:auto;height:400px;border-top:1px solid #D0D0D0" >
		 <table width="90%">
                <tr align="center" bgcolor="#019273">
                        <td width="5%"><font style="color:white;"><b>OPTION</b></font></td>
                        <td width="5%"><font style="color:white;"><b>NO</b></font></td>
                        <!-- <td width="5%"><font style="color:white;"><b>KODE OUTLET</b></font></td> -->
                        <td width="10%"><font style="color:white;"><b>NAMA OUTLET</b></font></td>
                        <td width="15%"><font style="color:white;"><b>ALAMAT</b></font></td>
                        <td width="5%"><font style="color:white;"><b>TIPE OUTLET</b></font></td>
                        <td width="5%"><font style="color:white;"><b>STOCK OUTLET</b></font></td>
                        <td width="5%"><font style="color:white;"><b>BUY OUTLET</b></font></td>
                </tr>
                <?php
                foreach($outlet->result_array() as $outlet){
                $i++;
                ?>
                <tr>
                        <td align="center">
						<img src="<?php echo base_url();?>asset/images/tambah.gif" onclick="window.open('<?php echo base_url();?>callsheet/isi_data/<?php echo $outlet['id_callsheet_outlet'];?>/<?php echo $outlet['id_outlet'];?>', 'winpopup', 'toolbar=yes,statusbar=yes,menubar=yes,resizable=yes,scrollbars=yes,width=1000,height=800');" style="cursor:pointer"></td>
                        <td align="center"><?php echo $i;?></td>
                        <!-- <td align="center"><?php echo $outlet['kode_outlet'];?></td> -->
                        <td><?php echo $outlet['nama_outlet'];?></td>
                        <td><?php echo $outlet['alamat_outlet'];?></td>
                        <td align="center"><?php echo $outlet['tipe_outlet'];?></td>
						<td align="center">
						<?php 
						$sql=$this->db->query("select sum(stock_outlet) as stock from tabel_callsheet_detil where id_callsheet_outlet='".$outlet['id_callsheet_outlet']."'");
						foreach($sql->result_array() as $stock){
						if($stock['stock']==0){
						echo "0";
						} else {
						echo $stock['stock'];
						}
						}
						?>
						</td>
						<td align="center">
						<?php 
						$sql1=$this->db->query("select sum(buy_outlet) as buy from tabel_callsheet_detil where id_callsheet_outlet='".$outlet['id_callsheet_outlet']."'");
						foreach($sql1->result_array() as $buy){
						if($buy['buy']==0){
						echo "0";
						} else {
						echo $buy['buy'];
						}
						}
						?>
						</td>
                </tr>
				
				<?php } ?>
				
                </table>
				
				
	</div>
	</div>
	<a href=""  class="classname">REFRESH</a>
	<a href="<?php echo base_url();?>callsheet/tutup_callsheet/<?php echo $this->uri->segment(3);?>" onclick="return confirm('PERHATIAN : CALLSHEET YANG TELAH DITUTUP SECARA OTOMATIS TIDAK BISA DIUBAH LAGI\n APAKAH ANDA YAKIN?')" class="classname">SELESAI</a>
	
<?php } ?>
<script>
window.onbeforeunload = function(event) {
	event.returnValue = "Write something clever here..";
};
</script>
</body>
</html>