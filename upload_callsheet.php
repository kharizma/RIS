   <?php 
error_reporting(1);
   ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            UPLOAD FILE CALLSHEET
            <small>PT. Surya Mustika Lampung</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>callsheet"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Upload File Callsheet</li>
          </ol>
        </section>

		<!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
				<div class="box">
				 <?php echo $this->session->flashdata('info') ?>
					<form enctype="multipart/form-data" role="form" action="" method="post">
          			<div class="box-body">
							<div class="form-group">
								<label>PILIH FILE UPLOAD CALLSHEET</label><br/>
                				File Upload <strong>(Save AS Excel 97-2003 -> Format .xls)</strong>:
                				<input type="file" name="fuploadcallsheet"><br/>
                				<input type="submit" value="Upload" name="upload">
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
<?php
if(isset($_POST['upload'])){
//Buat konfigurasi upload file
	$file1		  			= $_POST['fuploadcallsheet'];
	//Folder tujuan upload file
	$eror					= false;
	$folder					= './application/views/upload_callsheet_baku/';
	//type file yang bisa diupload
	$file_type				= array('xls','xlsx');
	//tukuran maximum file yang dapat diupload
	//$max_size				= 10000000; // 10MB

	$file_name	= $_FILES['fuploadcallsheet']['name'];
	$file_folder= $_FILES['fuploadcallsheet']['tmp_name'];
	$file_size	= $_FILES['fuploadcallsheet']['size'];
	//cari extensi file dengan menggunakan fungsi explode
	//$explode	= explode('.',$file_name);
	//$extensi	= $explode[count($explode)-1];
	//$unik		= "File 1_".$nama_program."_".$file_name ;
						
	//check apakah type file sudah sesuai
	//if(!in_array($extensi,$file_type)){
	//	$eror   = true;
	//	$pesan .= '- Type file yang anda upload tidak sesuai<br />';
	//}
	//check ukuran file apakah sudah sesuai
	//if($file_size > $max_size){
	//	$eror   = true;
	//	$pesan .= '- Ukuran file melebihi batas maximum<br />';
	//}
					
	//if($eror == true){
	//	echo '<div id="eror">'.$pesan.'</div>';
	//}else{
		//mulai memproses upload file
		if(move_uploaded_file($file_folder, $folder.$file_name)){
			echo "	<script>
						alert('FILE BERHASIL DI UPLOAD')
						location.href='';
				  	</script>";

		}else{
			echo "	<script>
						alert('FILE GAGAL DI UPLOAD')
						location.href='';
				  	</script>";
		}
	//}
}
	?>