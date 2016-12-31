
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            DATA REKAP CALLSHEET
            <small>PT. Surya Mustika Lampung</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data Rekap Callsheet</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						
						<form role="form" action="<?php echo base_url();?>callsheet/grafik" method="post">
						<div class="box-body">
							<div class="form-group">
								<label>PILIH TAHUN</label><br>
								<select  name="tahun"  class="form-control select2" style="width:250px" required>
									<option selected class="form-control" value="">[Pilih Tahun]</option>
									<option selected class="form-control" value="2014">2014</option>
									<option selected class="form-control" value="2015">2015</option>
									<?php
									//foreach ($tahun->result() as $p) {
									//	echo "<option class='form-control' value='$p->tahun'>$p->tahun</option>";
									//}
									?>
								</select>
							</div><!-- /.form-group -->
							<div  class="form-group">
								<label>PILIH BRAND</label><br>
								<select id="brand" name="brand"  class="form-control select2" style="width:250px">
									<option selected class="form-control" value="0">[All Brand]</option>
								<?php
								foreach ($brand->result() as $p) {
									echo "<option class='form-control' value='$p->id_brand'>$p->nama_brand</option>";
								}
								?>
								</select>
							</div><!-- /.form-group -->
						</div><!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" name="cari" id="cari" value="cari" class="btn btn-primary"><i class="fa fa-search"></i> &nbsp;<b>Lihat Data</b></button>
						</div>
						</form>
					<div id="body" style="margin:5px;width:100%;">
						<div id="chart"></div>
					</div>
					
					</div>
					
				</div><!-- /col -->
			</div><!-- /.row -->
        </section><!-- /.content -->
     </div><!-- /.content-wrapper -->
