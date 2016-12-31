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
			DOWNLOAD CALLSHEET SO
			<small>PT. Surya Mustika Lampung</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url();?>callsheet"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Download Callsheet Baku SO</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<?php echo $this->session->flashdata('info') ?>
					<form role="form" action="" method="post">
						<input type="hidden" class="form-control" name="tipe" id="tipe" size="25" value="<?php echo $tipe;?>" required>
						<div class="box-body">
							<div class="form-group">
								<label>AREA OFFICE</label><br>
								<select id="ao" name="ao" onchange="loadTerritory()" class="form-control select2" style="width:170px;" required>
									<option selected class="form-control" value="">[Pilih - Area Office]</option>
									<?php
									foreach ($ao->result() as $p) {
										echo "<option class='form-control' value=".$p->id_ao."_".$p->nama_ao.">$p->nama_ao</option>";
									}
									?>
								</select>
							</div><!-- /.form-group -->
						</div><!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" name="submit" value="simpan" class="btn btn-primary"><i class="fa fa-save"></i> &nbsp;<b>Simpan</b></button>
							<a class="btn btn-primary" href="<?php echo base_url();?>callsheet"><i class="fa fa-undo"></i> &nbsp;<b>Kembali</b></a>
						</div>
					</form><br>
					<?php 
						if(isset($_POST['ao']))
						{
							$ao = $_POST['ao'];
							echo "<a href='../application/views/upload_callsheet_baku/".$ao.".xls' target='_blank'><img width='30' src='".base_url()."asset/images/excel.png'>Download Callsheet</a>";
						}
					?>
				</div><!-- /.box -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
