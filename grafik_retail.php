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
function loadDistrik(){
	    var sub= $("#sub").val();
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
function loadRute(){
	    var distrik= $("#distrik").val();
	    $.ajax({
	        type:'GET',
	        url:"<?php echo base_url(); ?>outlet/rute",
	        data:"id=" + distrik,
	        success: function(html)
	        {
	            $("#rute").html(html);
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
		<h4>OUTPUT CALLSHEET
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
								</tr>
								<tr height="40">
									<td><label><b>PILIH TAHUN</b></label><br></td>
									<td><select  name="tahun"  class="form-control" style="width:250px" required>
										<?php
										if(isset($_POST['cari'])){
											$tahun=$_POST['tahun'];
											echo "<option selected class='form-control' value='$tahun'>$tahun</option>";
										} else{
											echo "<option selected class='form-control' value=''>[Pilih Tahun]</option>";
										}
										?>
										<option class="form-control" value="2015">2015</option>
										<option class="form-control" value="2016">2016</option>
									</select>
									</td>
								</tr>
								<tr height="40">
									<input type="hidden" class="form-control" name="jenis_outlet" id="jenis_outlet" size="25" value="<?php echo $this->uri->segment(2);?>">
									<td><label><b>PILIH BRAND</b></label></td>
									<td><select id="brand" name="brand"  class="form-control" style="width:250px" required>
										<option class='form-control' value=''>[Pilih Brand]</option>
										<?php
										if(isset($_POST['cari'])){
											foreach ($brand->result() as $p) {
												if ($p->id_brand == mysql_real_escape_string($_POST['brand'])){
													echo "<option selected='selected' class='form-control' value='$p->id_brand'>$p->nama_brand</option>";
												} else{
													echo "<option class='form-control' value='$p->id_brand'>$p->nama_brand</option>";
												}
											}
										} else{
											foreach ($brand->result() as $p) {
												echo "<option class='form-control' value='$p->id_brand'>$p->nama_brand</option>";
											}
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
<!------------------------------------- Tabel Pertama -------------------------------->
					<table  border="1" style="border: 1px solid #D0D0D0;" width="100%">
						<thead>
							<tr align="center" >
								<td width="3%" bgcolor="#990023" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>WEEK</b></font></td>
								<td width="3%" bgcolor="#990023" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>TO</b></font></td>
								<td width="3%" bgcolor="#990023" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>TK</b></font></td>
								<td width="3%" bgcolor="#990023" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>TK (%)</b></font></td>
								<td colspan="14" bgcolor="#337ab7" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>NOTASI DISTRIBUSI</b></font></td>

							</tr>
							<tr align="center" bgcolor="#337ab7">
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>SK</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>SK (%)</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>SL</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>SL (%)</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>SD</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>SD (%)</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>OOS</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>OOS (%)</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>SB</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>SB (%)</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>TL</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>TL (%)</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>BPJ</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>BPJ (%)</b></font></td>
							</tr>
						</thead>
						<tbody>
							<?php if(isset($_POST['cari'])){
								$ao			=$_POST['ao'];
								$to			=$_POST['to'];
								$sub		=$_POST['sub'];
								$distrik	=$_POST['distrik'];
								$rute		=$_POST['rute'];
								$tahun		=$_POST['tahun'];
								$brand		=$_POST['brand'];
								$jenis		=$_POST['jenis_outlet'];
								if($brand<=0){
									if($tahun<='2015'){
										$sql1=$this->db->query("SELECT week(tgl_callsheet,1) as week FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d where year(a.tgl_callsheet)='".$tahun."' and b.id_rute = a.id_rute and c.id_tipe_distrik = d.id_tipe_distrik and d.jenis_outlet LIKE '%RETAIL%' and b.id_distrik = c.id_distrik and c.id_sub_territory = '".$sub."' group by week(a.tgl_callsheet,1)");
									} else{
										$sql1=$this->db->query("SELECT week(tgl_callsheet,1)+1 as week FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d where year(a.tgl_callsheet)='".$tahun."' and b.id_rute = a.id_rute and c.id_tipe_distrik = d.id_tipe_distrik and d.jenis_outlet LIKE '%RETAIL%' and b.id_distrik = c.id_distrik and c.id_sub_territory = '".$sub."' group by week(a.tgl_callsheet,1)");
									}
								} else {
									if($tahun<='2015'){
										$sql1=$this->db->query("SELECT week(tgl_callsheet,1) as week FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_callsheet_detil d, tabel_tipe_distrik f where c.id_tipe_distrik = f.id_tipe_distrik and f.jenis_outlet LIKE '%RETAIL%' and d.id_brand='".$brand."'
										and year(tgl_callsheet)='".$tahun."' and b.id_rute = a.id_rute and b.id_distrik = c.id_distrik and c.id_sub_territory = '".$sub."' group by week(tgl_callsheet,1)");
									} else{
										$sql1=$this->db->query("SELECT week(tgl_callsheet,1)+1 as week FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_callsheet_detil d, tabel_tipe_distrik f where c.id_tipe_distrik = f.id_tipe_distrik and f.jenis_outlet LIKE '%RETAIL%' and d.id_brand='".$brand."'
										and year(tgl_callsheet)='".$tahun."' and b.id_rute = a.id_rute and b.id_distrik = c.id_distrik and c.id_sub_territory = '".$sub."' group by week(tgl_callsheet,1)");
									}
								}?>
								<?php if ($tahun>='2016') {?>
								<!--<tr>
										<td align="center" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php echo '1';?>
										</td>
										// TO
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											$total_to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM
														   tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e
														   where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute
														  and b.id_tipe_distrik=e.id_tipe_distrik and a.id_sub_territory = '".$sub."'
														   and e.jenis_outlet like '%RETAIL%' ");
											foreach($total_to->result_array() as $total_to){echo $total_to['total'];}
											?>
										</td>
										// TK
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											$total_tk=$this->db->query("SELECT SUM(a.total_kunjungan) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d where year(a.tgl_callsheet)='".$tahun."'
											and week(a.tgl_callsheet,1)+1='0' and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed'");

											foreach($total_tk->result_array() as $total_tk){echo $total_tk['total'];}
											?>
										</td>
										// TK (%)
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											echo number_format((float)(( $total_tk['total']/$total_to['total'])*100), 2, '.', '');
											?> %
										</td>
										// SK
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$notasi=$this->db->query("SELECT SUM(a.sk) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}else{
												$notasi=$this->db->query("SELECT SUM(a.sk) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}
											foreach($notasi->result_array() as $sk){echo number_format($sk['notasi']);}
										?>
										</td>
										// SK (%)
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$notasi=$this->db->query("SELECT SUM(a.sk) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}else{
												$notasi=$this->db->query("SELECT SUM(a.sk) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}
										foreach($notasi->result_array() as $sk){echo number_format((float)(($sk['notasi']/$total_to['total'])*100), 2, '.', '');}
										?> %
										</td>
										// SL
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$notasi=$this->db->query("SELECT SUM(a.sl) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}else{
												$notasi=$this->db->query("SELECT SUM(a.sl) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}
										foreach($notasi->result_array() as $sl){echo number_format($sl['notasi']);}
											?>
										</td>
										// SL (%)
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$notasi=$this->db->query("SELECT SUM(a.sl) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}else{
												$notasi=$this->db->query("SELECT SUM(a.sl) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}
										foreach($notasi->result_array() as $sl){echo number_format((float)(($sl['notasi']/$total_to['total'])*100), 2, '.', '');}
											?> %
										</td>
										// SD
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$notasi=$this->db->query("SELECT SUM(a.sd) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}else{
												$notasi=$this->db->query("SELECT SUM(a.sd) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}
										foreach($notasi->result_array() as $sd){echo number_format($sd['notasi']);}
											?>
										</td>
										// SD (%)
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$notasi=$this->db->query("SELECT SUM(a.sd) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}else{
												$notasi=$this->db->query("SELECT SUM(a.sd) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}
										foreach($notasi->result_array() as $sd){echo number_format((float)(($sd['notasi']/$total_to['total'])*100), 2, '.', '');}
											?> %
										</td>
										// OOS
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$notasi=$this->db->query("SELECT SUM(a.oos) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}else{
												$notasi=$this->db->query("SELECT SUM(a.oos) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}
										foreach($notasi->result_array() as $oos){echo number_format($oos['notasi']);}
											?>
										</td>
										// OOS (%)
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$notasi=$this->db->query("SELECT SUM(a.oos) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}else{
												$notasi=$this->db->query("SELECT SUM(a.oos) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}
								foreach($notasi->result_array() as $oos){echo number_format((float)(($oos['notasi']/$total_to['total'])*100), 2, '.', '');}
											?> %
										</td>
										// SB
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$notasi=$this->db->query("SELECT SUM(a.sb) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}else{
												$notasi=$this->db->query("SELECT SUM(a.sb) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}
										foreach($notasi->result_array() as $sb){echo number_format($sb['notasi']);}
											?>
										</td>
										// SB (%)
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$notasi=$this->db->query("SELECT SUM(a.sb) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}else{
												$notasi=$this->db->query("SELECT SUM(a.sb) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}
										foreach($notasi->result_array() as $sb){echo number_format((float)(($sb['notasi']/$total_to['total'])*100), 2, '.', '');}
											?> %
										</td>
										// TL
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$notasi=$this->db->query("SELECT SUM(a.tl) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}else{
												$notasi=$this->db->query("SELECT SUM(a.tl) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}
										foreach($notasi->result_array() as $tl){echo number_format($tl['notasi']);}
											?>
										</td>
										// TL (%)
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$notasi=$this->db->query("SELECT SUM(a.tl) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}else{
												$notasi=$this->db->query("SELECT SUM(a.tl) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}
								foreach($notasi->result_array() as $tl){echo number_format((float)(($tl['notasi']/$total_to['total'])*100), 2, '.', '');}
											?> %
										</td>
										// BPJ
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$notasi=$this->db->query("SELECT SUM(a.bpj) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}else{
												$notasi=$this->db->query("SELECT SUM(a.bpj) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}
										foreach($notasi->result_array() as $bpj){echo number_format($bpj['notasi']);}
											?>
										</td>
										// BPJ (%)
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$notasi=$this->db->query("SELECT SUM(a.bpj) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}else{
												$notasi=$this->db->query("SELECT SUM(a.bpj) as notasi  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}
										foreach($notasi->result_array() as $bpj){echo number_format((float)(($bpj['notasi']/$total_to['total'])*100), 2, '.', '');}
											?> %
										</td>

								</tr> -->
									<?php } ?>
									<!-- akhir week 1 -->


								<?php

								foreach($sql1->result_array() as $week){
									?>
									<tr>
										<td align="center" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php echo $week['week'];?>
										</td>
										<!--TO-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
											$total_to=$this->db->query("SELECT SUM(a.total_outlet) AS total FROM tabel_callsheet a, tabel_rute b where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_rute = '".$rute."' and a.status='Closed'");
											}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
											$total_to=$this->db->query("SELECT SUM(a.total_outlet) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_distrik = '".$distrik."' and a.status='Closed'");
											}elseif(($ao<>'')and($to<>'')and($sub<>'')){
											$total_to=$this->db->query("SELECT SUM(a.total_outlet) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_sub_territory d where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_sub_territory=d.id_sub_territory and d.id_sub_territory = '".$sub."' and a.status='Closed'");
											}elseif(($ao<>'')and($to<>'')){
											$total_to=$this->db->query("SELECT SUM(a.total_outlet) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_sub_territory d, tabel_territory e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_sub_territory=d.id_sub_territory and d.id_territory=e.id_territory and e.id_territory = '".$to."' and a.status='Closed'");
											}else{
											$total_to=$this->db->query("SELECT SUM(a.total_outlet) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_sub_territory d, tabel_territory e, tabel_area_office f where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_sub_territory=d.id_sub_territory and d.id_territory=e.id_territory and e.id_ao=f.id_ao and f.id_ao = '".$ao."' and a.status='Closed' ");
											}
											foreach($total_to->result_array() as $total_to){echo $total_to['total'];}
											?>
										</td>
										<!--TK-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
											$total_tk=$this->db->query("SELECT SUM(a.total_kunjungan) AS total FROM tabel_callsheet a, tabel_rute b where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_rute = '".$rute."' and a.status='Closed' ");
											}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
											$total_tk=$this->db->query("SELECT SUM(a.total_kunjungan) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_distrik = '".$distrik."' and a.status='Closed' ");
											}elseif(($ao<>'')and($to<>'')and($sub<>'')){
											$total_tk=$this->db->query("SELECT SUM(a.total_kunjungan) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_sub_territory d where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_sub_territory=d.id_sub_territory and d.id_sub_territory = '".$sub."' and a.status='Closed' ");
											}elseif(($ao<>'')and($to<>'')){
											$total_tk=$this->db->query("SELECT SUM(a.total_kunjungan) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_sub_territory d, tabel_territory e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_sub_territory=d.id_sub_territory and d.id_territory=e.id_territory and e.id_territory = '".$to."' and a.status='Closed' ");
											}else{
											$total_tk=$this->db->query("SELECT SUM(a.total_kunjungan) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_sub_territory d, tabel_territory e, tabel_area_office f where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_sub_territory=d.id_sub_territory and d.id_territory=e.id_territory and e.id_ao=f.id_ao and f.id_ao = '".$ao."' and a.status='Closed' ");
											}

											foreach($total_tk->result_array() as $total_tk){echo $total_tk['total'];}
											?>
										</td>
										<!--TK (%)-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											echo number_format((float)(( $total_tk['total']/$total_to['total'])*100), 2, '.', '');
											?> %
										</td>
										<!--SK-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sk) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sk) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sk) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sk) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.sk) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}
											}else{
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sk) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sk) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sk) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sk) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.sk) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}
											}
										foreach($notasi->result_array() as $sk){echo number_format($sk['notasi']);}
										?>
										</td>
										<!--SK (%)-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											echo number_format((float)(($sk['notasi']/$total_to['total'])*100), 2, '.', '');
											?> %
										</td>
										<!--SL-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.sl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}
											}else{
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.sl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}
											}
										foreach($notasi->result_array() as $sl){echo number_format($sl['notasi']);}
										?>
										</td>
										<!--SL (%)-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											echo number_format((float)(($sl['notasi']/$total_to['total'])*100), 2, '.', '');
											?> %
										</td>
										<!--SD-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
										<?php
											if($brand<=0){
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sd) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sd) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sd) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sd) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.sd) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}
											}else{
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sd) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sd) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sd) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sd) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.sd) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}
											}
										foreach($notasi->result_array() as $sd){echo number_format($sd['notasi']);}
										?>
										</td>
										<!--SD (%)-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											echo number_format((float)(($sd['notasi']/$total_to['total'])*100), 2, '.', '');
											?> %
										</td>
										<!--OOS-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
										<?php
											if($brand<=0){
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.oos) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.oos) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.oos) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.oos) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.oos) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}
											}else{
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.oos) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.oos) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.oos) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.oos) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.oos) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}
											}
										foreach($notasi->result_array() as $oos){echo number_format($oos['notasi']);}
										?>
										</td>
										<!--OOS (%)-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											echo number_format((float)(($oos['notasi']/$total_to['total'])*100), 2, '.', '');
											?> %
										</td>
										<!--SB-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
										<?php
											if($brand<=0){
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sb) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sb) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sb) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sb) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.sb) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}
											}else{
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sb) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sb) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sb) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sb) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.sb) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}
											}
										foreach($notasi->result_array() as $sb){echo number_format($sb['notasi']);}
										?>
										</td>
										<!--SB (%)-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											echo number_format((float)(($sb['notasi']/$total_to['total'])*100), 2, '.', '');
											?> %
										</td>
										<!--TL-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.tl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.tl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.tl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.tl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.tl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}
											}else{
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.tl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.tl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.tl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.tl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.tl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}
											}
										foreach($notasi->result_array() as $tl){echo number_format($tl['notasi']);}
										?>
										</td>
										<!--TL (%)-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											echo number_format((float)(($tl['notasi']/$total_to['total'])*100), 2, '.', '');
											?> %
										</td>
										<!--BPJ-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.bpj) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.bpj) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.bpj) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.bpj) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.bpj) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}
											}else{
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.bpj) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.bpj) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.bpj) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.bpj) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.bpj) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}
											}
										foreach($notasi->result_array() as $bpj){echo number_format($bpj['notasi']);}
										?>
										</td>
										<!--BPJ (%)-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											echo number_format((float)(($bpj['notasi']/$total_to['total'])*100), 2, '.', '');
											?> %
										</td>

									</tr>
									<script type="text/javascript" src="<?php echo base_url();?>asset/jquery-1.7.2.min.js"></script>
									<script type="text/javascript" src="<?php echo base_url();?>asset/highcharts/highcharts.js"></script>
									<script type="text/javascript" src="<?php echo base_url();?>asset/highcharts/modules/exporting.js"></script>
									<script type="text/javascript" src="<?php echo base_url();?>asset/highcharts/themes/dark-green.js"></script>
									<?php }?>
									<?php }?>
								</tbody>
						</table>
						<br>

<!---------------------------------------- tabel ke dua -------------------------------------------------------------------------------->
						<table  border="1" style="border: 1px solid #D0D0D0;" width="75%">
						<thead>
							<tr align="center" >
								<td width="3%" bgcolor="#990023" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>WEEK</b></font></td>
								<td width="3%" bgcolor="#990023" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>TO</b></font></td>
								<td width="3%" bgcolor="#990023" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>TK</b></font></td>
								<td width="3%" bgcolor="#990023" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>TK (%)</b></font></td>
								<td colspan="14" bgcolor="#337ab7" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>NOTASI DISTRIBUSI</b></font></td>

							</tr>
							<tr align="center" bgcolor="#337ab7">

								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>NV</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>NV (%)</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>L</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>L (%)</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>M</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>M (%)</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>H</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>H (%)</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>VIS</b></font></td>
								<td width="3%" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;"><font style="color:white;"><b>VIS (%)</b></font></td>
							</tr>
						</thead>
						<tbody>
							<?php if(isset($_POST['cari'])){
								$ao			=$_POST['ao'];
								$to			=$_POST['to'];
								$sub		=$_POST['sub'];
								$distrik	=$_POST['distrik'];
								$rute		=$_POST['rute'];
								$tahun		=$_POST['tahun'];
								$brand		=$_POST['brand'];
								$jenis		=$_POST['jenis_outlet'];
								if($brand<=0){
									if($tahun<='2015'){
										$sql1=$this->db->query("SELECT week(tgl_callsheet,1) as week FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d where year(a.tgl_callsheet)='".$tahun."' and b.id_rute = a.id_rute and c.id_tipe_distrik = d.id_tipe_distrik and d.jenis_outlet LIKE '%RETAIL%' and b.id_distrik = c.id_distrik and c.id_sub_territory = '".$sub."' group by week(a.tgl_callsheet,1)");
									} else{
										$sql1=$this->db->query("SELECT week(tgl_callsheet,1)+1 as week FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d where year(a.tgl_callsheet)='".$tahun."' and b.id_rute = a.id_rute and c.id_tipe_distrik = d.id_tipe_distrik and d.jenis_outlet LIKE '%RETAIL%' and b.id_distrik = c.id_distrik and c.id_sub_territory = '".$sub."' group by week(a.tgl_callsheet,1)");
									}
								} else {
									if($tahun<='2015'){
										$sql1=$this->db->query("SELECT week(tgl_callsheet,1) as week FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_callsheet_detil d, tabel_tipe_distrik f where c.id_tipe_distrik = f.id_tipe_distrik and f.jenis_outlet LIKE '%RETAIL%' and d.id_brand='".$brand."'
										and year(tgl_callsheet)='".$tahun."' and b.id_rute = a.id_rute and b.id_distrik = c.id_distrik and c.id_sub_territory = '".$sub."' group by week(tgl_callsheet,1)");
									} else{
										$sql1=$this->db->query("SELECT week(tgl_callsheet,1)+1 as week FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_callsheet_detil d, tabel_tipe_distrik f where c.id_tipe_distrik = f.id_tipe_distrik and f.jenis_outlet LIKE '%RETAIL%' and d.id_brand='".$brand."'
										and year(tgl_callsheet)='".$tahun."' and b.id_rute = a.id_rute and b.id_distrik = c.id_distrik and c.id_sub_territory = '".$sub."' group by week(tgl_callsheet,1)");
									}
								}?>
								<?php if ($tahun>='2016') {?>
								<!--<tr>
										<td align="center" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php echo '1';?>
										</td>
										// TO
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											$total_to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM
														   tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e
														   where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute
														  and b.id_tipe_distrik=e.id_tipe_distrik and a.id_sub_territory = '".$sub."'
														   and e.jenis_outlet like '%RETAIL%' ");
											foreach($total_to->result_array() as $total_to){echo $total_to['total'];}
											?>
										</td>
										// TK
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											$total_tk=$this->db->query("SELECT SUM(a.total_kunjungan) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d where year(a.tgl_callsheet)='".$tahun."'
											and week(a.tgl_callsheet,1)+1='0' and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed'");

											foreach($total_tk->result_array() as $total_tk){echo $total_tk['total'];}
											?>
										</td>
										// TK (%)
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											echo number_format((float)(( $total_tk['total']/$total_to['total'])*100), 2, '.', '');
											?> %
										</td>

										// NV
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$visibility=$this->db->query("SELECT SUM(a.nv) as visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where c.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}else{
												$visibility=$this->db->query("SELECT SUM(a.nv) as visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where c.id_callsheet=c.id_callsheet and c.status='Closed' and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."'");
											}
										foreach($visibility->result_array() as $visibility){echo number_format($visibility['visibility']);}
											?>
										</td>
										// NV (%)
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$visibility=$this->db->query("SELECT SUM(a.nv) as visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where c.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}else{
												$visibility=$this->db->query("SELECT SUM(a.nv) as visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where c.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}
										foreach($visibility->result_array() as $visibility){echo number_format((float)(($visibility['visibility']/$total_to['total'])*100), 2, '.', '');}
											?> %
										</td>
										// L
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$visibility=$this->db->query("SELECT SUM(a.low) as visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."'");
											}else{
												$visibility=$this->db->query("SELECT SUM(a.low) as visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."'");
											}
										foreach($visibility->result_array() as $visibility){echo number_format($visibility['visibility']);}
											?>
										</td>
										// L (%)
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$visibility=$this->db->query("SELECT SUM(a.low) as visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}else{
												$visibility=$this->db->query("SELECT SUM(a.low) as visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}
										foreach($visibility->result_array() as $visibility){echo number_format((float)(($visibility['visibility']/$total_to['total'])*100), 2, '.', '');}
											?> %
										</td>
										// M
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$visibility=$this->db->query("SELECT SUM(a.mid) as visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}else{
												$visibility=$this->db->query("SELECT SUM(a.mid) as visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}
										foreach($visibility->result_array() as $visibility){echo number_format($visibility['visibility']);}
											?>
										</td>
										// M (%)
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$visibility=$this->db->query("SELECT SUM(a.mid) as visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}else{
												$visibility=$this->db->query("SELECT SUM(a.mid) as visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}
								foreach($visibility->result_array() as $visibility){echo number_format((float)(($visibility['visibility']/$total_to['total'])*100), 2, '.', '');}
											?> %
										</td>
										// H
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$visibility=$this->db->query("SELECT SUM(a.hig) as visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}else{
												$visibility=$this->db->query("SELECT SUM(a.hig) as visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}
										foreach($visibility->result_array() as $visibility){echo number_format($visibility['visibility']);}
											?>
										</td>
										// H (%)
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$visibility=$this->db->query("SELECT SUM(a.hig) as visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}else{
												$visibility=$this->db->query("SELECT SUM(a.hig) as visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
											}
										foreach($visibility->result_array() as $visibility){echo number_format((float)(($visibility['visibility']/$total_to['total'])*100), 2, '.', '');}
											?> %
										</td>
										// Vis pending
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$visibility=$this->db->query("SELECT SUM(a.hig) as visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."'");
											}else{
												$visibility=$this->db->query("SELECT SUM(a.hig) as visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."'");
											}
											foreach($visibility->result_array() as $visibility){echo number_format($visibility['visibility']);}
											?>
										</td>
										// Vis Pending(%)
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$visibility=$this->db->query("SELECT SUM(a.hig) as visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."'");
											}else{
												$visibility=$this->db->query("SELECT SUM(a.hig) as visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."'");
											}
										foreach($visibility->result_array() as $visibility){echo number_format((float)(($visibility['visibility']/$total_to['total'])*100), 2, '.', '');}
											?> %
										</td>
									</tr> -->
									<?php } ?>
									<!-- akhir week 1 -->


								<?php

								foreach($sql1->result_array() as $week){
									?>
									<tr>
										<td align="center" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php echo $week['week'];?>
										</td>
										<!--TO-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
											$total_to=$this->db->query("SELECT SUM(a.total_outlet) AS total FROM tabel_callsheet a, tabel_rute b where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_rute = '".$rute."' and a.status='Closed'");
											}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
											$total_to=$this->db->query("SELECT SUM(a.total_outlet) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_distrik = '".$distrik."' and a.status='Closed'");
											}elseif(($ao<>'')and($to<>'')and($sub<>'')){
											$total_to=$this->db->query("SELECT SUM(a.total_outlet) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_sub_territory d where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_sub_territory=d.id_sub_territory and d.id_sub_territory = '".$sub."' and a.status='Closed'");
											}elseif(($ao<>'')and($to<>'')){
											$total_to=$this->db->query("SELECT SUM(a.total_outlet) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_sub_territory d, tabel_territory e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_sub_territory=d.id_sub_territory and d.id_territory=e.id_territory and e.id_territory = '".$to."' and a.status='Closed'");
											}else{
											$total_to=$this->db->query("SELECT SUM(a.total_outlet) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_sub_territory d, tabel_territory e, tabel_area_office f where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_sub_territory=d.id_sub_territory and d.id_territory=e.id_territory and e.id_ao=f.id_ao and f.id_ao = '".$ao."' and a.status='Closed' ");
											}
											foreach($total_to->result_array() as $total_to){echo $total_to['total'];}
											?>
										</td>
										<!--TK-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
											$total_tk=$this->db->query("SELECT SUM(a.total_kunjungan) AS total FROM tabel_callsheet a, tabel_rute b where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_rute = '".$rute."' and a.status='Closed' ");
											}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
											$total_tk=$this->db->query("SELECT SUM(a.total_kunjungan) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_distrik = '".$distrik."' and a.status='Closed' ");
											}elseif(($ao<>'')and($to<>'')and($sub<>'')){
											$total_tk=$this->db->query("SELECT SUM(a.total_kunjungan) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_sub_territory d where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_sub_territory=d.id_sub_territory and d.id_sub_territory = '".$sub."' and a.status='Closed' ");
											}elseif(($ao<>'')and($to<>'')){
											$total_tk=$this->db->query("SELECT SUM(a.total_kunjungan) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_sub_territory d, tabel_territory e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_sub_territory=d.id_sub_territory and d.id_territory=e.id_territory and e.id_territory = '".$to."' and a.status='Closed' ");
											}else{
											$total_tk=$this->db->query("SELECT SUM(a.total_kunjungan) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_sub_territory d, tabel_territory e, tabel_area_office f where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_sub_territory=d.id_sub_territory and d.id_territory=e.id_territory and e.id_ao=f.id_ao and f.id_ao = '".$ao."' and a.status='Closed' ");
											}

											foreach($total_tk->result_array() as $total_tk){echo $total_tk['total'];}
											?>
										</td>
										<!--TK (%)-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											echo number_format((float)(( $total_tk['total']/$total_to['total'])*100), 2, '.', '');
											?> %
										</td>
										<!--NV-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
										<?php
											if($brand<=0){
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.nv) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.nv) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.nv) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.nv) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.nv) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}
											}else{
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.nv) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.nv) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.nv) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.nv) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.nv) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}
											}
										foreach($notasi->result_array() as $nv){echo number_format($nv['visibility']);}
											?>
										</td>
										<!--NV (%)-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											echo number_format((float)(( $nv['visibility']/$total_to['total'])*100), 2, '.', '');
											?> %
										</td>
										<!--LOW-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.low) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.low) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.low) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.low) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.low) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}
											}else{
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.low) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.low) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.low) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.low) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.low) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}
											}
										foreach($notasi->result_array() as $low){echo number_format($low['visibility']);}
											?>
										</td>
										<!--LOW (%)-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											echo number_format((float)(( $low['visibility']/$total_to['total'])*100), 2, '.', '');
											?> %
										</td>
										<!--MID-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.mid) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.mid) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.mid) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.mid) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.mid) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}
											}else{
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.mid) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.mid) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.mid) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.mid) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.mid) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}
											}
										foreach($notasi->result_array() as $mid){echo number_format($mid['visibility']);}
											?>
										</td>
										<!--MID (%)-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											echo number_format((float)(( $mid['visibility']/$total_to['total'])*100), 2, '.', '');
											?> %
										</td>
										<!--HIG-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.hig) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.hig) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.hig) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.hig) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.hig) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}
											}else{
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.hig) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.hig) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.hig) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.hig) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.hig) AS visibility FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}
											}
										foreach($notasi->result_array() as $hig){echo number_format($hig['visibility']);}
											?>
										</td>
										<!--HIG (%)-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											echo number_format((float)(( $hig['visibility']/$total_to['total'])*100), 2, '.', '');
											?> %
										</td>
										<!--Vis-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											echo number_format($low['visibility']+$mid['visibility']+$hig['visibility']);
											?>
										</td>
										<!--Vis (%)-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php

											echo number_format ((float)((($low['visibility']+$mid['visibility']+$hig['visibility'])/$total_to['total'])*100), 2, '.', '');
											?>%
										</td>

									</tr>
									<script type="text/javascript" src="<?php echo base_url();?>asset/jquery-1.7.2.min.js"></script>
									<script type="text/javascript" src="<?php echo base_url();?>asset/highcharts/highcharts.js"></script>
									<script type="text/javascript" src="<?php echo base_url();?>asset/highcharts/modules/exporting.js"></script>
									<script type="text/javascript" src="<?php echo base_url();?>asset/highcharts/themes/dark-green.js"></script>
									<?php }?>
									<?php }?>
								</tbody>
							</table>
							<br>

<!----------------------------------------------- tabel ketiga ------------------------------------------------------------------->
							<table  border="1" style="border: 1px solid #D0D0D0;" width="100%">
						<thead>
							<tr align="center"  height="40">
								<td width="3%" bgcolor="#990023" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>WEEK</b></font></td>
								<td width="3%" bgcolor="#990023" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>TO</b></font></td>
								<td width="3%" bgcolor="#990023" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>TK</b></font></td>
								<td width="3%" bgcolor="#990023" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>TK (%)</b></font></td>
								<td width="3%" bgcolor="#337ab7" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>AVG STOCK</b></font></td>
								<td width="3%" bgcolor="#337ab7" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>STOCK</b></font></td>
								<td width="3%" bgcolor="#337ab7" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>AVG VOL</b></font></td>
								<td width="3%" bgcolor="#337ab7" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>VOL</b></font></td>
								<td width="3%" bgcolor="#337ab7" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>AVB</b></font></td>
								<td width="3%" bgcolor="#337ab7" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>AVB (%)</b></font></td>
								<td width="3%" bgcolor="#337ab7" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>EC</b></font></td>
								<td width="3%" bgcolor="#337ab7" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>EC (%)</b></font></td>
								<td width="3%" bgcolor="#337ab7" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>PACK / EC</b></font></td>
								<td width="3%" bgcolor="#337ab7" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>REP</b></font></td>
								<td width="3%" bgcolor="#337ab7" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;" rowspan="2"><font style="color:white;"><b>REP (%)</b></font></td>
							</tr>
						</thead>
						<tbody>
							<?php if(isset($_POST['cari'])){
								$ao			=$_POST['ao'];
								$to			=$_POST['to'];
								$sub		=$_POST['sub'];
								$distrik	=$_POST['distrik'];
								$rute		=$_POST['rute'];
								$tahun		=$_POST['tahun'];
								$brand		=$_POST['brand'];
								$jenis		=$_POST['jenis_outlet'];
								if($brand<=0){
									if($tahun<='2015'){
										$sql1=$this->db->query("SELECT week(tgl_callsheet,1) as week FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d where year(a.tgl_callsheet)='".$tahun."' and b.id_rute = a.id_rute and c.id_tipe_distrik = d.id_tipe_distrik and d.jenis_outlet LIKE '%RETAIL%' and b.id_distrik = c.id_distrik and c.id_sub_territory = '".$sub."' group by week(a.tgl_callsheet,1)");
									} else{
										$sql1=$this->db->query("SELECT week(tgl_callsheet,1)+1 as week FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d where year(a.tgl_callsheet)='".$tahun."' and b.id_rute = a.id_rute and c.id_tipe_distrik = d.id_tipe_distrik and d.jenis_outlet LIKE '%RETAIL%' and b.id_distrik = c.id_distrik and c.id_sub_territory = '".$sub."' group by week(a.tgl_callsheet,1)");
									}
								} else {
									if($tahun<='2015'){
										$sql1=$this->db->query("SELECT week(tgl_callsheet,1) as week FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_callsheet_detil d, tabel_tipe_distrik f where c.id_tipe_distrik = f.id_tipe_distrik and f.jenis_outlet LIKE '%RETAIL%' and d.id_brand='".$brand."'
										and year(tgl_callsheet)='".$tahun."' and b.id_rute = a.id_rute and b.id_distrik = c.id_distrik and c.id_sub_territory = '".$sub."' group by week(tgl_callsheet,1)");
									} else{
										$sql1=$this->db->query("SELECT week(tgl_callsheet,1)+1 as week FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_callsheet_detil d, tabel_tipe_distrik f where c.id_tipe_distrik = f.id_tipe_distrik and f.jenis_outlet LIKE '%RETAIL%' and d.id_brand='".$brand."'
										and year(tgl_callsheet)='".$tahun."' and b.id_rute = a.id_rute and b.id_distrik = c.id_distrik and c.id_sub_territory = '".$sub."' group by week(tgl_callsheet,1)");
									}
								}?>
								<?php if ($tahun>='2016') {?>
								<!--<tr>
										<td align="center" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php echo '1';?>
										</td>
										// TO
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											$total_to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM
														   tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e
														   where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute
														  and b.id_tipe_distrik=e.id_tipe_distrik and a.id_sub_territory = '".$sub."'
														   and e.jenis_outlet like '%RETAIL%' ");
											foreach($total_to->result_array() as $total_to){echo $total_to['total'];}
											?>
										</td>
										// TK
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											$total_tk=$this->db->query("SELECT SUM(a.total_kunjungan) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d where year(a.tgl_callsheet)='".$tahun."'
											and week(a.tgl_callsheet,1)+1='0' and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed'");

											foreach($total_tk->result_array() as $total_tk){echo $total_tk['total'];}
											?>
										</td>
										// TK (%)
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											echo number_format((float)(( $total_tk['total']/$total_to['total'])*100), 2, '.', '');
											?> %
										</td>

										// AVG STOCK Pending
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$stock=$this->db->query("SELECT SUM(a.stock) as stock  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."'");
											}else{
												$stock=$this->db->query("SELECT SUM(a.stock) as stock  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."'");
											}
											foreach($stock->result_array() as $stock){echo number_format($stock['stock']);}
											?>
										</td>
										// STOCK (%)
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$stock=$this->db->query("SELECT SUM(a.stock) as stock  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."'");
											}else{
												$stock=$this->db->query("SELECT SUM(a.stock) as stock  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."'");
											}
											$a  = ($sk['notasi']+$sl['notasi']+$sd['notasi']+$oos['notasi']+$sb['notasi']);
											foreach($stock->result_array() as $stock){echo number_format((float)($stock['stock']/$a), 2, '.', '');}
											?> %
										</td>
										// VOL
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$buy=$this->db->query("SELECT SUM(a.buy) as buy  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."'");
											}else{
												$buy=$this->db->query("SELECT SUM(a.buy) as buy  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."'");
											}
											foreach($buy->result_array() as $buy){echo number_format($buy['buy']);}
											?>
										</td>
										// VOL (%)
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												$buy=$this->db->query("SELECT SUM(a.buy) as buy  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."'");
											}else{
												$buy=$this->db->query("SELECT SUM(a.buy) as buy  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f
													where a.id_callsheet=c.id_callsheet and year(c.tgl_callsheet)='".$tahun."' and week(c.tgl_callsheet,1)='0' and a.id_brand='".$brand."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%retail%' AND e.id_sub_territory = '".$sub."'");
											}
											$a 	 = ($sk['notasi']+$oos['notasi']+$sb['notasi']);
											foreach($buy->result_array() as $buy){echo number_format((float)($buy['buy']/$a), 2, '.', '');}
											?> %
										</td>
										// AVB
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
										<?php

											$a  = ($sk['notasi']+$sl['notasi']+$sd['notasi']+$oos['notasi']+$sb['notasi']);
											$avb = $a;
											echo number_format($avb);?>
										</td>
										// AVB (%)
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											$a  = ($sk['notasi']+$sl['notasi']+$sd['notasi']+$oos['notasi']+$sb['notasi'])/$total_to['total'];
											$avb = $a*100;
											echo number_format((float)$avb, 2, '.', '');
											?> %
										</td>
										// EC
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											$a 	 = ($sk['notasi']+$oos['notasi']+$sb['notasi']);
											$ec = $a;
											echo number_format($ec);?>
										</td>
										// EC (%)
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											$a 	 = ($sk['notasi']+$oos['notasi']+$sb['notasi'])/$total_to['total'];
											$ec = $a*100;
											echo number_format((float)$ec, 2, '.', '');?> %
										</td>
										// EC/ pack pending
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											$a 	 = ($sk['notasi']+$oos['notasi']+$sb['notasi']);
											$ec = $a;
											echo number_format($ec);?>
										</td>
										// REPEAT
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											$a 	 	= ($sk['notasi']+$sl['notasi']+$oos['notasi']);
											$repeat	= $a;
											echo number_format($repeat);?>
										</td>
										// REPEAT (%)
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											$a 	 	= ($sk['notasi']+$sl['notasi']+$oos['notasi'])/$total_to['total'];
											$repeat	= $a*100;
											echo number_format((float)$repeat, 2, '.', '');?> %
										</td>

									</tr> -->
									<?php } ?>
									<!-- akhir week 1 -->


								<?php
								foreach($sql1->result_array() as $week){
									?>
									<tr>
										<td align="center" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php echo $week['week'];?>
										</td>
										<!--SK-->
											<?php
											if($brand<=0){
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sk) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sk) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sk) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sk) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.sk) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}
											}else{
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sk) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sk) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sk) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sk) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.sk) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}
											}
										foreach($notasi->result_array() as $sk){}
										?>
										<!--SL-->
											<?php
											if($brand<=0){
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.sl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}
											}else{
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.sl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}
											}
										foreach($notasi->result_array() as $sl){}
										?>
										<!--SD-->
											<?php
											if($brand<=0){
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sd) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sd) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sd) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sd) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.sd) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}
											}else{
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sd) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sd) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sd) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sd) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.sd) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}
											}
										foreach($notasi->result_array() as $sd){}
										?>
										<!--OOS-->
											<?php
											if($brand<=0){
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.oos) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.oos) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.oos) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.oos) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.oos) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}
											}else{
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.oos) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.oos) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.oos) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.oos) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.oos) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}
											}
										foreach($notasi->result_array() as $oos){}
										?>
										<!--SB-->
											<?php
											if($brand<=0){
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sb) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sb) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sb) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sb) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.sb) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}
											}else{
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sb) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sb) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sb) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.sb) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.sb) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}
											}
										foreach($notasi->result_array() as $sb){}
										?>
										<!--TL-->
											<?php
											if($brand<=0){
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.tl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.tl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.tl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.tl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.tl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}
											}else{
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.tl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.tl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.tl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.tl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.tl) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}
											}
										foreach($notasi->result_array() as $tl){}
										?>
										<!--BPJ-->
											<?php
											if($brand<=0){
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.bpj) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.bpj) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.bpj) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.bpj) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.bpj) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}
											}else{
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.bpj) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.bpj) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.bpj) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.bpj) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.bpj) AS notasi FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}
											}
										foreach($notasi->result_array() as $bpj){}
										?>
										<!--TO-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
											$total_to=$this->db->query("SELECT SUM(a.total_outlet) AS total FROM tabel_callsheet a, tabel_rute b where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_rute = '".$rute."' and a.status='Closed'");
											}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
											$total_to=$this->db->query("SELECT SUM(a.total_outlet) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_distrik = '".$distrik."' and a.status='Closed'");
											}elseif(($ao<>'')and($to<>'')and($sub<>'')){
											$total_to=$this->db->query("SELECT SUM(a.total_outlet) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_sub_territory d where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_sub_territory=d.id_sub_territory and d.id_sub_territory = '".$sub."' and a.status='Closed'");
											}elseif(($ao<>'')and($to<>'')){
											$total_to=$this->db->query("SELECT SUM(a.total_outlet) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_sub_territory d, tabel_territory e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_sub_territory=d.id_sub_territory and d.id_territory=e.id_territory and e.id_territory = '".$to."' and a.status='Closed'");
											}else{
											$total_to=$this->db->query("SELECT SUM(a.total_outlet) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_sub_territory d, tabel_territory e, tabel_area_office f where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_sub_territory=d.id_sub_territory and d.id_territory=e.id_territory and e.id_ao=f.id_ao and f.id_ao = '".$ao."' and a.status='Closed' ");
											}
											foreach($total_to->result_array() as $total_to){echo $total_to['total'];}
											?>
										</td>
										<!--TK-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
											$total_tk=$this->db->query("SELECT SUM(a.total_kunjungan) AS total FROM tabel_callsheet a, tabel_rute b where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_rute = '".$rute."' and a.status='Closed' ");
											}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
											$total_tk=$this->db->query("SELECT SUM(a.total_kunjungan) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_distrik = '".$distrik."' and a.status='Closed' ");
											}elseif(($ao<>'')and($to<>'')and($sub<>'')){
											$total_tk=$this->db->query("SELECT SUM(a.total_kunjungan) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_sub_territory d where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_sub_territory=d.id_sub_territory and d.id_sub_territory = '".$sub."' and a.status='Closed' ");
											}elseif(($ao<>'')and($to<>'')){
											$total_tk=$this->db->query("SELECT SUM(a.total_kunjungan) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_sub_territory d, tabel_territory e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_sub_territory=d.id_sub_territory and d.id_territory=e.id_territory and e.id_territory = '".$to."' and a.status='Closed' ");
											}else{
											$total_tk=$this->db->query("SELECT SUM(a.total_kunjungan) AS total FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_sub_territory d, tabel_territory e, tabel_area_office f where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."' and
											a.id_rute=b.id_rute and b.id_distrik=c.id_distrik and c.id_sub_territory=d.id_sub_territory and d.id_territory=e.id_territory and e.id_ao=f.id_ao and f.id_ao = '".$ao."' and a.status='Closed' ");
											}

											foreach($total_tk->result_array() as $total_tk){echo $total_tk['total'];}
											?>
										</td>
										<!--TK (%)-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											echo number_format((float)(( $total_tk['total']/$total_to['total'])*100), 2, '.', '');
											?> %
										</td>
										<!--AVG STOCK-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.stock) AS stock FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.stock) AS stock FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.stock) AS stock FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.stock) AS stock FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.stock) AS stock FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}
											}else{
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.stock) AS stock FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.stock) AS stock FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.stock) AS stock FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.stock) AS stock FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.stock) AS stock FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}
											}
											foreach($notasi->result_array() as $stock){
											$avb = $sk['notasi']+$sl['notasi']+$sd['notasi']+$oos['notasi']+$sb['notasi'] ;
											$avgstock= $stock['stock']/$avb ;
											echo number_format($avgstock);
											}
											?>
										</td>
										<!--STOCK-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											echo number_format($stock['stock']);
											?>
										</td>
										<!--AVG VOL-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											if($brand<=0){
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.buy) AS buy FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.buy) AS buy FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.buy) AS buy FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.buy) AS buy FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.buy) AS buy FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet");
												}
											}else{
												if(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')and($rute<>'')){
												$notasi=$this->db->query("SELECT SUM(e.buy) AS buy FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND b.id_rute = '".$rute."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')and($distrik<>'')){
												$notasi=$this->db->query("SELECT SUM(e.buy) AS buy FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_distrik = '".$distrik."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')and($sub<>'')){
												$notasi=$this->db->query("SELECT SUM(e.buy) AS buy FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e where year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND c.id_sub_territory = '".$sub."' and a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}elseif(($ao<>'')and($to<>'')){
												$notasi=$this->db->query("SELECT SUM(e.buy) AS buy FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f where d.id_sub_territory=f.id_sub_territory and f.id_territory='".$to."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}else{
												$notasi=$this->db->query("SELECT SUM(e.buy) AS buy FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d, tabel_callsheet_detil e, tabel_sub_territory f, tabel_territory g where f.id_territory=g.id_territory and d.id_sub_territory=f.id_sub_territory and g.id_ao='".$ao."' and year(a.tgl_callsheet)='".$tahun."' and week(a.tgl_callsheet,1)+1='".$week['week']."'
												and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' AND a.status='Closed' and a.id_callsheet=e.id_callsheet and e.id_brand = '".$brand."'");
												}
											}

											foreach($notasi->result_array() as $buy){
											$ec = $sk['notasi']+$oos['notasi']+$sb['notasi'] ;
											$avgvol= $buy['buy']/$ec;
											echo number_format($avgvol);
											}
											?>
										</td>
										<!--VOL -->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											echo number_format($buy['buy']);
											?>
										</td>
										<!--AVB-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											echo number_format($sk['notasi']+$sl['notasi']+$sd['notasi']+$oos['notasi']+$sb['notasi']);
											?>
										</td>
										<!--AVB (%)-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											$a = ($sk['notasi']+$sl['notasi']+$sd['notasi']+$oos['notasi']+$sb['notasi'])/$total_to['total'];
											$avb = $a*100;
											echo number_format((float)$avb, 2, '.', '');?> %
										</td>
										<!--EC-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											$a = ($sk['notasi']+$oos['notasi']+$sb['notasi']);
											$ec = $a;
											echo number_format($ec);?>
										</td>
										<!--EC (%)-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											$a = ($sk['notasi']+$oos['notasi']+$sb['notasi'])/$total_to['total'];
											$ec = $a*100;
											echo number_format((float)$ec, 2, '.', '');?> %
										</td>
										<!--PACK/EC-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php

											$a1 = ($sk['notasi']+$oos['notasi']+$sb['notasi']);
											echo number_format($buy['buy']/$a1);

											?>
										</td>
										<!--REPEAT-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											$a2 	 = ($sk['notasi']+$sl['notasi']+$oos['notasi']);
											$repeat	= $a2;
											echo number_format($repeat);?>
										</td>
										<!--REPEAT (%)-->
										<td align="right" style="padding: 2px 5px 2px 5px;border: 1px solid #D0D0D0;">
											<?php
											$a3 	 	= ($sk['notasi']+$sl['notasi']+$oos['notasi'])/$total_to['total'];
											$repeat	= $a3*100;
											echo number_format((float)$repeat, 2, '.', '');?> %
										</td>
									</tr>
									<script type="text/javascript" src="<?php echo base_url();?>asset/jquery-1.7.2.min.js"></script>
									<script type="text/javascript" src="<?php echo base_url();?>asset/highcharts/highcharts.js"></script>
									<script type="text/javascript" src="<?php echo base_url();?>asset/highcharts/modules/exporting.js"></script>
									<script type="text/javascript" src="<?php echo base_url();?>asset/highcharts/themes/dark-green.js"></script>
									<?php }?>
									<?php }?>
						</tbody>
							</table>
		</div><!-- /.box-body -->
					</div>
					<!-- end tabel !-->
					<!--<div id="container" <?php if(!isset($_POST['cari'])){ echo "style='display:none;'"; } ?> >


						<div style="width:auto;">
							<div id="chart1"></div>
						</div>


						<div style="width:auto;">
							<div id="chart2" ></div>
						</div>


						<div style="width:auto;">
							<div id="chart3" ></div>
						</div>


						<div style="width:auto;">
							<div id="chart4" ></div>
						</div>


						<div style="width:auto;">
							<div id="chart5" ></div>
						</div>


						<div style="width:auto;">
							<div id="chart6"></div>
						</div>

						<div style="width:auto;">
							<div id="chart7"></div>
						</div>

						<div style="width:auto;">
							<div id="chart8"></div>
						</div>

						<div style="width:auto;">
							<div id="chart9"></div>
						</div>-->
						<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
					</div>
					<?php if(isset($_POST['cari'])){ if($_POST['brand'] <> ""){ include "retail_wbrand.php"; }
					else { include "retail_nbrand.php"; } } ?>

					<script src="<?php echo base_url();?>asset/plugins/select2/select2.full.min.js"></script>
					<script src="//code.jquery.com/jquery-1.10.2.js"></script>
					<!-- DataTables -->
				</body>
				</html>
