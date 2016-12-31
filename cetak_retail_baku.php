<script type="text/javascript">
$(document).ready(function(){
	$("#tglterbit").datepicker({
		dateFormat : "dd/mm/yy",
		changeMonth : true,
		changeYear : true
	});
});
</script>
<script type="text/javascript">
function lihatDistrik()
{
var sub = $("select#sub").val();
var tipe = $("input#tipe").val();
$.ajax({
	type: "GET",
	url: "<?php echo base_url(); ?>" + "distrik/karyawan_distrik",
	data: "id=" + sub+ "&tipe=" + tipe,
	success: function(html)
	{
		$("#karyawan").html(html);
	}
});
}
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			CETAK CALLSHEET RETAIL
			<small>PT. Surya Mustika Lampung</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url();?>callsheet"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Cetak Callsheet Retail</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<?php echo $this->session->flashdata('info') ?>
					<form role="form" action="" method="POST">
						<input type="hidden" class="form-control" name="tipe" id="tipe" size="25" value="<?php echo $tipe;?>" required>
						<div class="box-body">
							<div class="form-group">
								<label>AREA OFFICE</label><br>
								<select id="ao" name="ao" onchange="loadTerritory()" class="form-control select2" style="width:170px;" required>
									<option selected class="form-control" value="">[Pilih - Area Office]</option>
									<?php
									foreach ($ao->result() as $p) {
										echo "<option class='form-control' value=".$p->id_ao.">$p->nama_ao</option>";
									}
									?>
								</select>
							</div><!-- /.form-group -->
							<div class="form-group">
								<label>TERRITORY</label><br>
								<select id="to" name="to" onchange="loadSubTerritory()" class="form-control select2" style="width:170px;" required>
									<option selected class="form-control" value="">[Pilih - Territory]</option>
								</select>
							</div><!-- /.form-group -->
							<div class="form-group">
								<label>SUB TERRITORY</label><br>
								<select id="sub" name="sub" class="form-control select2" onchange="lihatDistrik()" style="width:170px;" required>
									<option selected class="form-control" value="">[Pilih - Sub Territory]</option>
									
								</select>
							</div><!-- /.form-group -->
						</div><!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" name="submit" value="simpan" class="btn btn-primary"><i class="fa fa-save"></i> &nbsp;<b>Simpan</b></button>
							<a class="btn btn-primary" href="<?php echo base_url();?>dashboard"><i class="fa fa-undo"></i> &nbsp;<b>Kembali</b></a>
						</div>
					</form><br>
					<?php 
						if(isset($_POST['sub']))
						{
							$ao = $_POST['ao'];
							$to = $_POST['to'];
							$sub = $_POST['sub'];

							$cek_sub = $this->db->query("SELECT id_sub_territory, nama_sub_territory FROM tabel_sub_territory WHERE id_sub_territory = $sub");
							foreach ($cek_sub->result_array() as $subs) {
								# code...
							}
							echo "<a href='../application/views/upload_callsheet_baku/".$ao."_".$to."_".$sub."_".$subs['nama_sub_territory'].".xls' target='_blank'><img width='30' src='".base_url()."asset/images/excel.png'>Download Callsheet</a>";
						}
					?>
				</div><!-- /.box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
