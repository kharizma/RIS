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
			INPUT CALLSHEET RETAIL
			<small>PT. Surya Mustika Lampung</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url();?>callsheet"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Input Callsheet</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<?php echo $this->session->flashdata('info') ?>
					<form role="form" action="<?php echo base_url();?>callsheet/check" method="post">
						<input type="hidden" class="form-control" name="tipe" id="tipe" size="25" value="<?php echo $tipe;?>" required>
						<div class="box-body">
							<div class="form-group">
								<label>AREA OFFICE</label><br>
								<select id="ao" name="ao" onchange="loadTerritory()" class="form-control select2" style="width:170px;" required>
									<option selected class="form-control" value="">[Pilih - Area Office]</option>
									<?php
									foreach ($ao->result() as $p) {
										echo "<option class='form-control' value='$p->id_ao'>$p->nama_ao</option>";
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
							<div class="form-group">
								<label>NAMA KARYAWAN</label><br>
								<select id="karyawan" name="karyawan" onchange="loadCallsheet()" class="form-control select2" style="width:170px;" required>
									<option selected class="form-control" value="">[Pilih Nik - Nama Karyawan]</option>
								</select>
							</div><!-- /.form-group -->
							<div class="form-group">
								<label>DISTRIK</label><br>
								<select id="distrik" name="distrik" class="form-control select2" onchange="loadRute2()" style="width:170px;" required>
									<option selected class="form-control" value="">[Pilih Distrik]</option>
								</select>
							</div>
							<div class="form-group">
								<label>RUTE</label><br>
								<select id="rute" name="rute" class="form-control select2" style="width:170px;" required>
									<option selected class="form-control" value="">[Pilih Rute]</option>
								</select>
							</div>
							<div class="form-group">
								<label>TANGGAL CALLSHEET</label><br>
								<input type="text" name="tgl_callsheet" id="datepicker" class="form-control" style="width:170px;" placeholder="Tanggal callsheet.." required>
							</div>
						</div><!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" name="submit" value="simpan" class="btn btn-primary"><i class="fa fa-save"></i> &nbsp;<b>Simpan</b></button>
							<a class="btn btn-primary" href="<?php echo base_url();?>callsheet"><i class="fa fa-undo"></i> &nbsp;<b>Kembali</b></a>
						</div>
					</form>
				</div><!-- /.box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
