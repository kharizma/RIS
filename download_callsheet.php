      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            DOWNLOAD CALLSHEET
            <small>PT. Surya Mustika Lampung</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Download Callsheet</li>
          </ol>
        </section>
		
		<!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
				<div class="box">
				
				 <?php echo $this->session->flashdata('info') ?>
					<form role="form" action="<?php echo base_url();?>callsheet/cetak_callsheet_baku" method="post">
					    <div class="box-body">
							<div class="form-group">
								<label>PILIH JENIS CALLSHEET</label><br>
								<select id="tipe" name="tipe" class="form-control select2" style="width:160px" required>
									<option class="form-control" value="">[Pilih Jenis Callsheet]</option>
									<option class="form-control" value="retail">RETAIL</option>
									<option class="form-control" value="semi">SEMI</option>
									<option class="form-control" value="so">SO</option>
									<option class="form-control" value="sa">SUB AGENT</option>
								</select>
							</div><!-- /.form-group -->
						</div><!-- /.box-body -->
						<div class="box-footer">
						<button type="submit" name="submit" value="submit" class="btn btn-primary"><i class="fa fa-save"></i> &nbsp;<b>Download Callsheet</b></button><br><br>
						</div>
					</form>
				</div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
     