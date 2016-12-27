      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            UPLOAD BOSNET
            <small>PT. Surya Mustika Lampung</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>callsheet"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Upload Bosnet</li>
          </ol>
        </section>

		<!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
				<div class="box">
				 <?php echo $this->session->flashdata('info') ?>
					<form enctype="multipart/form-data" role="form" action="<?php echo base_url();?>callsheet/proses_upload_bosnet" method="post">
          			<div class="box-body">
							<div class="form-group">
								<label>PILIH FILE UPLOAD BOSNET</label><br>
                File Upload : <input type="file" name="fupload"><br/>Deskripsi File : <br/>
                <textarea name="deskripsi" rows="8" cols="40"></textarea><br/>
                <input type="submit" value="Upload">
                </form>
							</div><!-- /.form-group -->
						</div><!-- /.box-body -->
						<div class="box-footer"></button>
						</div>
					</form>
				</div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
