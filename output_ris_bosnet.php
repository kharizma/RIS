<!DOCTYPE html>
<html lang="en">
<?php error_reporting (0);?>
<head>
<meta charset="utf-8">
<title><?php echo $title;?></title>
<script type="text/javascript">
function loadTerritory(){
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
function loadSubTerritory(){
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
function loadWeek(){
		var thn = $("#thn").val();
		$.ajax({
			type:'GET',
			url:"<?php echo base_url(); ?>outlet/week",
			data:"id=" + thn,
			success: function(html)
			{
				$("#week").html(html);
			}
		});
	}
</script>
<style type="text/css">
	body {
		background-color: #fff;
		color: #333;
		font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
		font-size: 14px;
		line-height: 1.42857;
		padding: 5px 5px 5px 5px;
	}
	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }
	form {
		text-align: left;
	}
	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}
	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 14px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}
	h4{
	color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 14px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 5px;
	}
	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 5px 0 5px;
		margin: 20px 0 0 0;
	}
	#container{
		margin: 5px;
		padding: 5px;

		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}

	</style>
<link rel="stylesheet" href="<?php echo base_url();?>asset/bootstrap/css/bootstrap.min.css">
</head>
<body>
	<div id="container">
		<h4>PERFORMANCE & GROWTH
			<small>PT. Surya Mustika Lampung</small>
		</h4>
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">

						<form role="form" action="" method="post">
							<table>
								<tr height="40">
									<td width="150px"><label>AREA OFFICE</label></td>
									<td>
									<select id="ao" name="ao" onchange="loadTerritory()" style="width:250px" class="form-control" required>
										<option selected="selected" class="form-control" value=''>[Pilih Area Office]</option>
										<?php
										foreach ($ao->result() as $p) {
											if ($p->id_ao == $_POST['ao']){
											echo "<option selected='selected' class='form-control' value='$p->id_ao'>$p->nama_ao</option>";
											} else{
												echo "<option class='form-control' value='$p->id_ao'>$p->nama_ao</option>";
											}
										}
										?>
									</select>
									</td>
								</tr>
								<tr height="40">
									<td><label>TERITORY</label></td>
									<td><select id="to" name="to" onchange="loadSubTerritory()" style="width:250px" class="form-control" required>
										<?php
										if(isset($_POST['cari'])){
											$cek = mysql_query("SELECT * FROM tabel_territory where id_territory='".$_POST['to']."'");
											$hasil = mysql_fetch_array($cek);
											if($hasil['id_territory']<>''){
											echo "<option class='form-control' value=".$hasil['id_territory'].">".$hasil['nama_territory']."</option>";
											}else{
											echo "<option selected class='form-control' value=''>[Pilih Territory]</option>";
											}
										} else{
											echo "<option selected class='form-control' value=''>[Pilih Territory]</option>";
										}
										?>
									</select>
									</td>
								</tr>
								<tr height="40">
									<td><label>SUB TERITORY</label></td>
									<td><select id="sub" name="sub"  onchange="loadDistrik()" class="form-control" style="width:250px" required>
										<?php
										if(isset($_POST['cari'])){
											$cek1 = mysql_query("SELECT * FROM tabel_sub_territory where id_sub_territory='".$_POST['sub']."'");
											$hasil1 = mysql_fetch_array($cek1);
											if($hasil1['id_sub_territory']<>''){
											echo "<option class='form-control' value=".$hasil1['id_sub_territory'].">".$hasil1['nama_sub_territory']."</option>";
											} else{
											echo "<option selected class='form-control' value=''>[Pilih Sub Territory]</option>";
											}
										} else{
											echo "<option selected class='form-control' value=''>[Pilih Sub Territory]</option>";
										}
										?>
									</select>
									</td>
								</tr>
								<!--
								<tr height="40">
									<td><label>DISTRIK</label></td>
									<td><select id="distrik" onchange="loadRute()" name="distrik" class="form-control" style="width:250px">
										<?php
										if(isset($_POST['cari'])){
											$cek2 = mysql_query("SELECT * FROM tabel_distrik where id_distrik='".$_POST['distrik']."'");
											$hasil2 = mysql_fetch_array($cek2);
											if($hasil2['id_distrik']<>''){
											echo "<option class='form-control' value=".$hasil2['id_distrik'].">".$hasil2['nama_distrik']."</option>";
											} else {
												echo "<option selected class='form-control' value=''>[Pilih Distrik]</option>";
											}
										} else{
											echo "<option selected class='form-control' value=''>[Pilih Distrik]</option>";
										}
										?>
									</select>
									</td>
								</tr>
								<tr height="40">
									<td><label>RUTE</label></td>
									<td><select id="rute" name="rute" class="form-control" style="width:250px">
										<?php
										if(isset($_POST['cari'])){
											$cek3 = mysql_query("SELECT * FROM tabel_rute where id_rute='".$_POST['rute']."'");
											$hasil3 = mysql_fetch_array($cek3);
											if($hasil3['id_rute']<>''){
											echo "<option class='form-control' value=".$hasil3['id_rute'].">".$hasil3['nama_rute']."</option>";
											} else{
											echo "<option selected class='form-control' value=''>[Pilih Rute]</option>";
											}
										} else{
											echo "<option selected class='form-control' value=''>[Pilih Rute]</option>";
										}
										?>
									</select>
									</td>
								</tr>--><tr height="40">
									<td><label>TAHUN</label></td>
									<td><select id="thn" name="thn" class="form-control" onchange="loadWeek()" style="width:250px" required>
										<option selected="selected" class="form-control" value=''>[Pilih Tahun]</option>
										<?php
										$sql51=$this->db->query("SELECT DISTINCT(YEAR(tgl_callsheet)) AS THN FROM tabel_callsheet WHERE STATUS = 'closed' AND YEAR(tgl_callsheet) LIKE '20%'");
										foreach($sql51->result_array() as $tahun){
											echo "<option class='form-control' value='".$tahun['THN']."'>".$tahun['THN']."</option>";
										}
										?>
										</select>
									</td>
								</tr>
								<!--<tr height="40">
									<td><label><b>PILIH WEEK</b></label></td>
									<td><select id="week" name="week"  class="form-control" style="width:250px" required>
										<option class='form-control' value=''>[Pilih Week]</option>
										<?php
											$sql52=$this->db->query("SELECT week(tgl_callsheet,1)+1 as week FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_callsheet_detil d, tabel_tipe_distrik f where c.id_tipe_distrik = f.id_tipe_distrik and f.jenis_outlet LIKE '%RETAIL%' and year(tgl_callsheet)='".$tahun['THN']."' and b.id_rute = a.id_rute and b.id_distrik = c.id_distrik and c.id_sub_territory = '".$hasil1['id_sub_territory']."' group by week(tgl_callsheet,1)");
										foreach($sql52->result_array() as $week){
											echo "<option class='form-control' value='".$week['week']."'>".$week['week']."</option>";
										}
										?>
									</select>
									</td>
								</tr>-->
								<tr height="40">
									<td><label><b>PILIH WEEK</b></label></td>
									<td><select name="week"  class="form-control" style="width:250px" required>
										<option class='form-control' value=''>[Pilih Week]</option>
										<?php
										for($i=1;$i<=53;$i++){
											echo "<option class='form-control' value='".$i."'>Week ".$i."</option>";
										}
										?>
									</select>
									</td>
								</tr>
								<tr>
									<td><br></td>
								</tr>
								<tr height="40">
									<td align="center">
										<button type="submit" name="cari" id="cari" value="cari" class="btn btn-primary">
										<i class="fa fa-search"></i>
										&nbsp;<b>LIHAT DATA</b></button>&nbsp;&nbsp;
									</td>
									<td>
										<a href="<?php echo base_url();?>dashboard" class="btn btn-primary">
										<i class="fa fa-home"></i>
										&nbsp; <b>BERANDA<b></a>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<a href="" class="btn btn-primary"><i class="fa fa-home"></i> &nbsp; <b>REFRESH<b></a>
									</td>
									<?php
									if(isset($_POST['cari'])){
									?>
									<td>
										<?php
										$ao 		= $_POST['ao'];
										$to 		= $_POST['to'];
										$sub		= $_POST['sub'];
										$distrik	= $_POST['distrik'];
										$rute		= $_POST['rute'];
										$tahun		= $_POST['tahun'];
										$jenis		= $_POST['jenis_outlet'];
										$brand		= $_POST['brand'];
										?>
										&nbsp;&nbsp;&nbsp; <a href="<?php echo base_url();?>callsheet/download?ao=<?php echo $ao;?>&to=<?php echo $to;?>&sub=<?php echo $sub;?>&distrik=<?php echo $distrik;?>&rute=<?php echo $rute;?>&tahun=<?php echo $tahun;?>&jenis=<?php echo $jenis;?>&brand=<?php echo $brand;?>" target="_blank" class="btn btn-primary">
										<i class="fa fa-home"></i> &nbsp; <b>DOWNLOAD<b></a>
									</td>
									<?php } ?>
								</tr>
							</table>
						</form>

					</div>
					<hr style="border-bottom:1px solid #D0D0D0;">
				</div><!-- /col -->
			</div><!-- /.row -->
		</section><br>
				<div class="box-body">
			<center>
				<font style="font-size: 15px"><strong>DATA TERRITORY</strong></font>
			</center>
<!------------------------------------- Tabel Pertama -------------------------------->
					<table  border="1" style="border: 1px solid #D0D0D0;" width="100%">
						<thead>
							<tr align="center" >
								<td width="3%" bgcolor="#000000" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>BRAND</b></font></td>
								<td width="3%" bgcolor="#EAFF00" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:black;"><b>TO</b></font></td>
								<td width="3%" bgcolor="#EAFF00" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:black;"><b>TK</b></font></td>
								<td width="3%" bgcolor="#EAFF00" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:black;"><b>AVB</b></font></td>
								<td width="3%" bgcolor="#EAFF00" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:black;"><b>EC</b></font></td>
								<td width="3%" bgcolor="#EAFF00" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:black;"><b>REPEAT</b></font></td>
								<td colspan="2" bgcolor="#EAFF00" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:black"><b>BPJ</b></font></td>
								<td width="3%" bgcolor="#000000" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>PERFORMANCE</b></font></td>
								<td width="3%" bgcolor="#de7815" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>VOLUME</b></font></td>
								<td colspan="4" bgcolor="#de7815" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>CHANNEL CONTRIBUTION</b></font></td>
								<td width="3%" bgcolor="#000000" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>GROWTH</b></font></td>
							</tr>
							<tr align="center" bgcolor="#de7815">
								<td width="3%" bgcolor="#EAFF00" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:black;"><b>QTY</b></font></td>
								<td width="3%" bgcolor="#EAFF00" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:black;"><b>QTY (%)</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>WS</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>SWS</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>RETAIL</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>SO</b></font></td>
							</tr>
							<tr align="center" bgcolor="#de7815">
								
							</tr>

						</thead>
						<tbody>
							<?php if(isset($_POST['cari'])){
								$ao			=$_POST['ao'];
								$to			=$_POST['to'];
								$sub		=$_POST['sub'];
								$distrik	=$_POST['distrik'];
								$rute		=$_POST['rute'];
								$tahun		=$_POST['thn'];
								$brand		=$_POST['brand'];
								$jenis		=$_POST['jenis_outlet'];
								$week 		=$_POST['week'];
							?>
								<?php if ($tahun>='2016') {?>
								<?php
										$brand=$this->db->query("SELECT id_brand, singkatan_brand FROM tabel_brand");
										foreach ($brand->result_array() as $brand) 
										{
								?>
								<tr>
										
										<td align="center" bgcolor="black" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0; color: white">
											<?php
												# code...
												echo $brand['singkatan_brand'];
												?><br/>
										</td>
										<!--TO-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											$total_to=$this->db->query("SELECT SUM(a.total_outlet) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_sub_territory d, tabel_territory e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_sub_territory=d.id_sub_territory and d.id_territory=e.id_territory and e.id_territory = '".$to."' and a.status='Closed'");
											foreach($total_to->result_array() as $total_to){echo $total_to['total'];}
											?>
										</td>
										<!--TK-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											$total_tk=$this->db->query("SELECT SUM(a.total_kunjungan) AS total_kunjungan FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_sub_territory d, tabel_territory e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_sub_territory=d.id_sub_territory and d.id_territory=e.id_territory and e.id_territory = '".$to."' and a.status='Closed'");

											foreach($total_tk->result_array() as $total_tk){echo $total_tk['total_kunjungan'];}
											?>
										</td>
										<!--AVB	-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
												$notasi=$this->db->query("SELECT SUM(e.sk) AS sk, SUM(e.sl) as sl, SUM(e.sd) as sd, SUM(e.oos) as oos, SUM(e.sb) as sb FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where c.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week."' and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand['id_brand']."'");
											foreach($notasi->result_array() as $not)
												{ 
													$sk=number_format($not['sk']);
													$sd=number_format($not['sd']);
													$sl=number_format($not['sl']);
													$oos=number_format($not['oos']);
													$sb=number_format($not['sb']);

													$a = $sk+$sl+$sd+$oos+$sb;
													$avb = $a;
													echo number_format($avb);
												}
										?>
										</td>
										<!--EC	-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
												$notasi=$this->db->query("SELECT SUM(e.sk) AS sk, SUM(e.sl) as sl, SUM(e.sd) as sd, SUM(e.oos) as oos, SUM(e.sb) as sb FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where c.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week."' and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand['id_brand']."'");
											foreach($notasi->result_array() as $not2)
												{ 
													$sk=number_format($not2['sk']);
													$oos=number_format($not2['oos']);
													$sb=number_format($not2['sb']);

													$a 	 = $sk+$oos+$sb;
													$ec  = $a;
													echo number_format($ec);
												}
										?>
										</td>
										<!--REPEAT-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
												$notasi=$this->db->query("SELECT SUM(e.sk) AS sk, SUM(e.sl) as sl, SUM(e.sd) as sd, SUM(e.oos) as oos, SUM(e.sb) as sb FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where c.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week."' and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand['id_brand']."'");
											foreach($notasi->result_array() as $not3)
												{ 
													$sk=number_format($not3['sk']);
													$sl=number_format($not3['sl']);
													$oos=number_format($not3['oos']);

													$a 	 	= $sk+$sl+$oos;
													$repeat	= $a;
													echo number_format($repeat);
												}
										?>
										</td>
										<!--BPJ-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
												$notasi=$this->db->query("SELECT SUM(a.sk) as sk, SUM(a.sl) as sl, SUM(a.sd) as sd, SUM(a.oos) as oos, SUM(a.sb) as sb, SUM(a.bpj) AS bpj  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f, tabel_sub_territory g
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)+1='".$week."' and a.id_brand='".$brand['id_brand']."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = g.id_sub_territory and g.id_territory = '".$to."' and c.status='Closed'");
											foreach($notasi->result_array() as $not4)
												{ 
													echo number_format($not4['bpj']);
												}
										?>
										</td>
										<!--BPJ (%)-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
												$notasi=$this->db->query("SELECT SUM(e.sk) AS sk, SUM(e.sl) as sl, SUM(e.sd) as sd, SUM(e.oos) as oos, SUM(e.sb) as sb, SUM(e.bpj) as bpj FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where c.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week."' and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand['id_brand']."'");
											foreach($notasi->result_array() as $not5)
												{ 
													echo number_format((float)(($not5['bpj']/$total_to['total'])*100), 2, '.', '');
												}
											?> %
										</td>
										<td bgcolor="black">
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td bgcolor="black">
											
										</td>
									</tr>
									<?php }} }?>
									<!-- akhir week 1 -->
							</tbody>
					</table>
			<br><br>
			<center>
				<font style="font-size: 15px"><strong>DATA SUB TERRITORY</strong></font>
			</center>
<!------------------------------------- Tabel Kedua -------------------------------->
					<table  border="1" style="border: 1px solid #D0D0D0;" width="100%">
						<thead>
							<tr align="center" >
								<td width="3%" bgcolor="#000000" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>BRAND</b></font></td>
								<td width="3%" bgcolor="#EAFF00" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:black;"><b>TO</b></font></td>
								<td width="3%" bgcolor="#EAFF00" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:black;"><b>TK</b></font></td>
								<td width="3%" bgcolor="#EAFF00" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:black;"><b>AVB</b></font></td>
								<td width="3%" bgcolor="#EAFF00" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:black;"><b>EC</b></font></td>
								<td width="3%" bgcolor="#EAFF00" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:black;"><b>REPEAT</b></font></td>
								<td colspan="2" bgcolor="#EAFF00" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:black"><b>BPJ</b></font></td>
								<td width="3%" bgcolor="#000000" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>PERFORMANCE</b></font></td>
								<td width="3%" bgcolor="#de7815" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>VOLUME</b></font></td>
								<td colspan="4" bgcolor="#de7815" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>CHANNEL CONTRIBUTION</b></font></td>
								<td width="3%" bgcolor="#000000" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>GROWTH</b></font></td>
							</tr>
							<tr align="center" bgcolor="#de7815">
								<td width="3%" bgcolor="#EAFF00" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:black;"><b>QTY</b></font></td>
								<td width="3%" bgcolor="#EAFF00" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:black;"><b>QTY (%)</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>WS</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>SWS</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>RETAIL</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>SO</b></font></td>
							</tr>
							<tr align="center" bgcolor="#de7815">
								
							</tr>

						</thead>
						<tbody>
							<?php if(isset($_POST['cari'])){
								$ao			=$_POST['ao'];
								$to			=$_POST['to'];
								$sub		=$_POST['sub'];
								$distrik	=$_POST['distrik'];
								$rute		=$_POST['rute'];
								$tahun		=$_POST['thn'];
								$brand		=$_POST['brand'];
								$jenis		=$_POST['jenis_outlet'];
								$week 		=$_POST['week'];
							?>
								<?php if ($tahun>='2016') {?>
								<?php
										$brand=$this->db->query("SELECT id_brand, singkatan_brand FROM tabel_brand");
										foreach ($brand->result_array() as $brand) 
										{
								?>
								<tr>
										
										<td align="center" bgcolor="black" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0; color: white">
											<?php
												# code...
												echo $brand['singkatan_brand'];
												?><br/>
										</td>
										<!--TO-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											$total_to=$this->db->query("SELECT SUM(a.total_outlet) AS total, SUM(A.total_kunjungan) as total_kunjungan FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_sub_territory d where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_sub_territory=d.id_sub_territory and d.id_sub_territory = '".$sub."' and a.status='Closed'");
											foreach($total_to->result_array() as $total_to){echo $total_to['total'];}
											?>
										</td>
										<!--TK-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											$total_tk=$this->db->query("SELECT SUM(a.total_kunjungan) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_sub_territory d where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_sub_territory=d.id_sub_territory and d.id_sub_territory = '".$sub."' and a.status='Closed'");

											foreach($total_tk->result_array() as $total_tk){echo $total_tk['total'];}
											?>
										</td>
										<!--AVB	-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
												$notasi=$this->db->query("SELECT SUM(a.sk) as sk, SUM(a.sl) as sl, SUM(a.sd) as sd, SUM(a.oos) as oos, SUM(a.sb) as sb  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)+1='".$week."' and a.id_brand='".$brand['id_brand']."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory ='".$sub."' and c.status='Closed'");
											foreach($notasi->result_array() as $not)
												{ 
													$sk=number_format($not['sk']);
													$sd=number_format($not['sd']);
													$sl=number_format($not['sl']);
													$oos=number_format($not['oos']);
													$sb=number_format($not['sb']);

													$a = $sk+$sl+$sd+$oos+$sb;
													$avb = $a;
													echo number_format($avb);
												}
										?>
										</td>
										<!--EC	-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
												$notasi=$this->db->query("SELECT SUM(a.sk) as sk, SUM(a.sl) as sl, SUM(a.sd) as sd, SUM(a.oos) as oos, SUM(a.sb) as sb  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)+1='".$week."' and a.id_brand='".$brand['id_brand']."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory ='".$sub."' and c.status='Closed'");
											foreach($notasi->result_array() as $not2)
												{ 
													$sk=number_format($not2['sk']);
													$oos=number_format($not2['oos']);
													$sb=number_format($not2['sb']);

													$a 	 = $sk+$oos+$sb;
													$ec  = $a;
													echo number_format($ec);
												}
										?>
										</td>
										<!--REPEAT-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
												$notasi=$this->db->query("SELECT SUM(a.sk) as sk, SUM(a.sl) as sl, SUM(a.sd) as sd, SUM(a.oos) as oos, SUM(a.sb) as sb  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)+1='".$week."' and a.id_brand='".$brand['id_brand']."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory ='".$sub."' and c.status='Closed'");
											foreach($notasi->result_array() as $not3)
												{ 
													$sk=number_format($not3['sk']);
													$sl=number_format($not3['sl']);
													$oos=number_format($not3['oos']);

													$a 	 	= $sk+$sl+$oos;
													$repeat	= $a;
													echo number_format($repeat);
												}
										?>
										</td>
										<!--BPJ-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
												$notasi=$this->db->query("SELECT SUM(a.sk) as sk, SUM(a.sl) as sl, SUM(a.sd) as sd, SUM(a.oos) as oos, SUM(a.sb) as sb, SUM(a.bpj) AS bpj  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)+1='".$week."' and a.id_brand='".$brand['id_brand']."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory ='".$sub."' and c.status='Closed'");
											foreach($notasi->result_array() as $not4)
												{ 
													echo number_format($not4['bpj']);
												}
										?>
										</td>
										<!--BPJ (%)-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
												$notasi=$this->db->query("SELECT SUM(a.sk) as sk, SUM(a.sl) as sl, SUM(a.sd) as sd, SUM(a.oos) as oos, SUM(a.sb) as sb, SUM(a.bpj) AS bpj  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)+1='".$week."' and a.id_brand='".$brand['id_brand']."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory ='".$sub."' and c.status='Closed'");
											foreach($notasi->result_array() as $not5)
												{ 
													echo number_format((float)(($not5['bpj']/$total_to['total'])*100), 2, '.', '');
												}
											?> %
										</td>
										<td bgcolor="black">
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td>
											
										</td>
										<td bgcolor="black">
											
										</td>
									</tr>
									<?php }} }?>
									<!-- akhir week 1 -->
							</tbody>
					</table>
						<br>
					
				</div><!-- /.box-body -->
					
						<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
					</div>
					

		<script src="<?php echo base_url();?>asset/plugins/select2/select2.full.min.js"></script>
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<!-- DataTables -->
	</body>
</html>