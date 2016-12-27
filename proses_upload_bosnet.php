<?php
//menggunakan class phpExcelReader
include "excel_reader2.php";

//koneksi ke db mysql
mysqli_connect("localhost","root","");
mysqli_select_db("sml_sistem_v1");

//membaca file excel yang di upload
$data	= new Spreadsheet_Excel_Reader($_FILES['fupload'],['tmp_name']);
//membaca jumlah baris dari data Excel
$baris= $data->rowcount($sheet_index=0);

//nilai awal counter jumlah data yang sukses dan yang gagal diimport
$sukses	=0;
$gagal	=0;

//import data excel dari baris kedua, karena baris pertama adalah nama kolom
for($i=2;$i<=$baris;$i++)
{
	//membaca data (kolom 1)
	$   = $data->val($i,1);
	//membaca data (kolom 2)
	$   = $data->val($i,2);
	//membaca data (kolom 3)
	$   = $data->val($i,3);
	//membaca data (kolom 4)
	$   = $data->val($i,4);
	//membaca data (kolom 5)
	$   = $data->val($i,5);

	$cekdata="select *from where";
	$ada=mysqli_query($cekdata) or die(mysqli_error());
	if(mysqli_num_rows($ada)>0)
	{
		?>
		<script type="text/javascript">
			alert("Data Sudah Ada !!!");
			window.location="";
		</script>
		<?php
	}
	else
	{
		$query 	= "INSERT INTO VALUES()";
		$hasil	= mysqli_query($query);

		//menambah counter jika berhasil atau gagal
		if($hasil) $sukses++;
		else $gagal++;
	}
}
echo "<center>";
//tampilkan report hasil import
echo "<h3>HASIL PROSES UPLOAD DATA BOSNET</h3>";
echo "<p>Jumlah data sukses di-upload</p>".$sukses."<br/>";
echo "Jumlah data gagal di-upload".$gagal."<br/>";
echo "<br/><br/>";
echo "<a href='<?php base_url();?>callsheet/'>Lanjutkan</a>";
echo "</center>";
?>