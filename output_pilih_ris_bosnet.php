      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            OUTPUT RIS & BOSNET
            <small>PT. Surya Mustika Lampung</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>callsheet"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Output RIS & BOSNET</li>
          </ol>
        </section>

		<!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
				<div class="box">
				 <?php echo $this->session->flashdata('info') ?>
					<form role="form" action="<?php echo base_url();?>callsheet/lihat_output_bosnet" method="post">
          			<div class="box-body">
							<div class="form-group">
								<label>PILIH JENIS DISTRIBUSI</label><br>
								<select id="to" name="tipe" class="form-control select2" required>
									<option class="form-control" value="">[Pilih Jenis Distribusi]</option>
									<option class="form-control" value="5">RETAIL</option>
									<!--<option class="form-control" value="8">SEMI</option>
									<option class="form-control" value="6">SO</option>
									<option class="form-control" value="7">SUB AGENT</option>-->
								</select>
							</div><!-- /.form-group -->
						</div><!-- /.box-body -->
						<div class="box-footer">
						<button type="submit" name="submit" value="submit" class="btn btn-primary"><i class="fa fa-search"></i> &nbsp;<b>Lihat</b></button>
						</div>
					</form>
				</div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
