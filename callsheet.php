<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Callsheet extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->database();
		$this->load->library('form_validation');
		//load the login model
		if(!$this->session->userdata('username')){
			redirect('sistem/logout');
		}
	}
	public function index(){
		$data['title']="PT. Surya Mustika Lampung";
		$data['user']=$this->session->userdata('username');
		$data['level']=$this->session->userdata('level');
		$this->load->view('admin/header',$data);
		$this->load->view('admin/callsheet/input',$data);
		$this->load->view('admin/footer',$data);
	}
	public function download(){
		$data['title']="PT. Surya Mustika Lampung";
		$data['user']=$this->session->userdata('username');
		$data['level']=$this->session->userdata('level');
		$this->load->view('admin/callsheet/download',$data);
	}
	public function grafik(){
		$data['title']="PT. Surya Mustika Lampung";
		$data['user']=$this->session->userdata('username');
		$data['level']=$this->session->userdata('level');
		$this->load->view('admin/header',$data);
		$this->load->view('admin/callsheet/grafik',$data);
		$this->load->view('admin/footer',$data);
	}
	public function cetak(){
		$data['title']="PT. Surya Mustika Lampung";
		$data['user']=$this->session->userdata('username');
		$data['level']=$this->session->userdata('level');
		$this->load->view('admin/header',$data);
		$this->load->view('admin/callsheet/cetak',$data);
		$this->load->view('admin/footer',$data);
	}
	public function notasi(){
		$this->load->model("model_tipe_distrik",'',TRUE);
		$data['tipe']=$this->model_tipe_distrik->lihat();
		$data['title']="PT. Surya Mustika Lampung";
		$data['user']=$this->session->userdata('username');
		$data['level']=$this->session->userdata('level');
		$this->load->view('admin/header',$data);
		$this->load->view('admin/callsheet/notasi',$data);
		$this->load->view('admin/footer');
	}
	public function performance(){
		$this->load->model("model_tipe_distrik",'',TRUE);
		$data['tipe']=$this->model_tipe_distrik->lihat();
		$data['title']="PT. Surya Mustika Lampung";
		$data['user']=$this->session->userdata('username');
		$data['level']=$this->session->userdata('level');
		$this->load->view('admin/header',$data);
		$this->load->view('admin/callsheet/performance',$data);
		$this->load->view('admin/footer');
	}
	public function data_performance(){
		$this->load->model("model_area_office",'',TRUE);
		$data['ao']=$this->model_area_office->lihat();
		$this->load->model("model_brand",'',TRUE);
		$data['brand']=$this->model_brand->lihat();
		$this->load->model("model_territory",'',TRUE);
		$data['territory']=$this->model_territory->lihat();
		$sub= $this->input->post('sub');
		$this->load->model("model_sub_territory",'',TRUE);
		$data['sub_territory']=$this->model_sub_territory->ubah($sub);
		$data['title']="PT. Surya Mustika Lampung";
		$data['user']=$this->session->userdata('username');
		$data['level']=$this->session->userdata('level');
		$this->load->view('admin/callsheet/data_performance',$data);
	}
	public function ic($id_callsheet){
			$data['title']="PT. Surya Mustika Lampung";
			$this->load->model("model_callsheet",'',TRUE);
			$data['callsheet_detail']=$this->model_callsheet->baru_lihat_detail($id_callsheet);
			$data['lihat_data']=$this->model_callsheet->lihat_data($id_callsheet);
			$data['user']=$this->session->userdata('username');
			$data['level']=$this->session->userdata('level');
			$this->load->view('admin/header',$data);
			$this->load->view('admin/callsheet/baru_input_callsheet',$data);
			$this->load->view('admin/footer');
	}
	public function delete_ic($id_callsheet){
		$this->load->model("model_callsheet",'',TRUE);
		$this->model_callsheet->delete_ic($id_callsheet);
		$this->session->set_flashdata('info','<div class="alert alert-success alert-dismissable" style="width:30%">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Informasi!</h4>Data berhasil dihapus</div>');
		redirect('callsheet/bs','refresh');
	}
	public function upload_bosnet(){
		$data['title']="PT. Surya Mustika Lampung";
		$data['user']=$this->session->userdata('username');
		$data['level']=$this->session->userdata('level');
		$this->load->view('admin/header',$data);
		$this->load->view('admin/callsheet/upload_bosnet',$data);
		$this->load->view('admin/footer',$data);
	}
	public function tes_post(){
		if(!empty($_POST))
		{
			foreach($_POST as $field_name => $val)
			{
				//clean post values
				$field_callsheetdetailid = strip_tags(trim($field_name));
				$val = strip_tags(trim(mysql_real_escape_string($val)));
				
				//from the fieldname:user_id we need to get user_id
				$split_data = explode(':', $field_callsheetdetailid);
				$id_callsheet_detail = $split_data[1];
				$field_name = $split_data[0];
				if(!empty($id_callsheet_detail) && !empty($field_name))
				{
					//update the values
					mysql_query("UPDATE tabel_callsheet_detil SET $field_name = '$val' WHERE id_callsheet_detail = $id_callsheet_detail") or mysql_error();
					
				} else {
					
				}
			}
		} else {
			echo "Invalid Requests";
		}
	}
	public function filter_notasi(){
		$tipe= $this->input->post('tipe');
		if ($tipe != ""){
			$this->load->model("model_area_office",'',TRUE);
			$data['ao']=$this->model_area_office->lihat();
			$this->load->model("model_brand",'',TRUE);
			$data['brand']=$this->model_brand->lihat();
			$this->load->model("model_notasi",'',TRUE);
			$data['notasi']=$this->model_notasi->lihat();
			$this->load->model("model_distrik",'',TRUE);
			$data['distrik']=$this->model_distrik->lihat();
			$this->load->model("model_tipe_distrik",'',TRUE);
			$data['tipe']=$this->input->post('tipe');
			$data['title']="PT. Surya Mustika Lampung";
			$data['user']=$this->session->userdata('username');
			$data['level']=$this->session->userdata('level');
			$this->load->view('admin/header',$data);
			$this->load->view('admin/callsheet/filter_notasi',$data);
			$this->load->view('admin/footer',$data);
		} else{ redirect('callsheet/notasi','refresh'); }
	}
	function lihat_outlet(){
		//url get
		if(isset($_GET['id_notasi'])){ $id_notasi = $_GET['id_notasi']; }
		if(isset($_GET['id_brand'])){ $id_brand = $_GET['id_brand']; }
		if(isset($_GET['id_sub'])){ $id_sub = $_GET['id_sub']; }
		if(isset($_GET['tahun'])){ $tahun = $_GET['tahun']; }
		if(isset($_GET['week'])){ $week = $_GET['week']; }
		if(isset($_GET['tipe'])){ $tipe = $_GET['tipe']; }
		$where = "b.id_callsheet=c.id_callsheet 
			AND YEAR(c.tgl_callsheet)='".$tahun."' AND c.id_rute=d.id_rute AND d.id_distrik = e.id_distrik 
			AND e.id_tipe_distrik=i.id_tipe_distrik AND i.jenis_outlet LIKE '%".$tipe."%'
			AND WEEK(c.tgl_callsheet,1)='".$week."' AND e.id_sub_territory = '".$id_sub."'
			AND notasi_outlet='".$id_notasi."' AND a.id_brand='".$id_brand."' GROUP BY b.`id_outlet`";
		// $link =
		//lihat week
		//data get
		$outlet = $this->db->query("SELECT *
			FROM tabel_callsheet_detil a
			LEFT JOIN tabel_notasi r ON (r.`id` = a.`notasi_outlet`)
			LEFT JOIN tabel_callsheet_outlet1 b ON (b.`id_callsheet_outlet` = a.`id_callsheet_outlet`)
			LEFT JOIN tabel_callsheet c ON (c.`id_callsheet` = b.`id_callsheet`)
			LEFT JOIN `tabel_outlet` n ON (n.`id_outlet` = b.`id_outlet`)
			LEFT JOIN `tabel_rute` d ON (d.`id_rute` = c.`id_rute`)
			LEFT JOIN `tabel_distrik` e ON (e.`id_distrik` = d.`id_distrik`)
			LEFT JOIN `tabel_sub_territory` f ON (f.`id_sub_territory` = e.`id_sub_territory`)
			LEFT JOIN `tabel_territory` g ON (g.`id_territory` = f.`id_territory`)
			LEFT JOIN `tabel_area_office` h ON (h.`id_ao` = g.`id_ao`)
			LEFT JOIN `tabel_tipe_distrik` i ON (i.`id_tipe_distrik` = e.`id_tipe_distrik`)
			LEFT JOIN `tabel_kel_desa` j ON (j.`id_kel_desa` = n.`id_kel_desa`)
			LEFT JOIN `tabel_kecamatan` k ON (k.`id_kecamatan` = j.`id_kecamatan`)
			LEFT JOIN `tabel_kabupaten_kota` o ON (o.`id_kab_kota` = k.`id_kab_kota`)
			LEFT JOIN `tabel_provinsi` p ON (p.`id_provinsi` = o.`id_provinsi`)
			LEFT JOIN `tabel_karyawan` q ON (q.`nik` = e.`id_karyawan`)
			LEFT JOIN `tabel_tipe_outlet` l ON (l.`id_tipe_outlet` = n.`id_tipe_outlet`)
			LEFT JOIN `tabel_tipe_distrik` m ON (m.`id_tipe_distrik` = e.`id_tipe_distrik`)
			WHERE
			$where");
			echo "<a target='_blank' href='".base_url()."callsheet/export_outlet/?id_sub=".$id_sub."&tahun=".$tahun."&id_brand=".$id_brand."&id_notasi=".$id_notasi."&week=".$week."&tipe=".$tipe."'><img width='30' src='".base_url()."asset/images/excel.png'> Export to Excel</a>";
			echo "<table class='table table-bordered table-striped' border='1' width=100%>";
			echo "<thead>
			<tr align='center' bgcolor='227788'>
			<th width='5%'><font color='white'>NO</font></th>
			<th width='5%'><font color='white'>NAMA OUTLET</font></th>
			<th width='15%'><font color='white'>NAMA PEMILIK</font></th>
			<th width='15%'><font color='white'>ALAMAT</font></th>
			<th width='15%'><font color='white'>KELURAHAN</font></th>
			<th width='15%'><font color='white'>KECAMATAN</font></th>
			<th width='15%'><font color='white'>TYPE OUTLET</font></th>
			<th width='15%'><font color='white'>NOTASI</font></th>
			</tr>
			</thead><tbody>";
			$i = 1;
			// while($i<=$week)
			// { }
			foreach ($outlet->result() as $k)
			{
				echo "<tr>";
				echo "<td align='center'>".$i."</td>";
				echo "<td align='center'>".$k->nama_outlet."</td>";
				echo "<td align='center'>".$k->nama_pemilik."</td>";
				echo "<td align='center'>".$k->alamat_outlet."</td>";
				echo "<td align='center'>".$k->kel_desa."</td>";
				echo "<td align='center'>".$k->kecamatan."</td>";
				echo "<td align='center'>";
				if($k->jenis_outlet == "SA"){ echo "SA"; }else{ echo $k->tipe_outlet; }
				echo "</td>";
				echo "<td align='center'>".$k->nama_notasi."</td>";
				echo "</tr>";
				$i++;
			}
			echo "</tbody></table>";
	}
	public function export_outlet(){
		if(isset($_GET['id_notasi'])){ $id_notasi = $_GET['id_notasi']; }
		if(isset($_GET['id_brand'])){ $id_brand = $_GET['id_brand']; }
		if(isset($_GET['id_sub'])){ $id_sub = $_GET['id_sub']; }
		if(isset($_GET['tahun'])){ $tahun = $_GET['tahun']; }
		if(isset($_GET['week'])){ $week = $_GET['week']; }
		if(isset($_GET['tipe'])){ $tipe = $_GET['tipe']; }
		$where = "b.id_callsheet=c.id_callsheet 
			AND YEAR(c.tgl_callsheet)='".$tahun."' AND c.id_rute=d.id_rute AND d.id_distrik = e.id_distrik 
			AND e.id_tipe_distrik=i.id_tipe_distrik AND i.jenis_outlet LIKE '%".$tipe."%'
			AND WEEK(c.tgl_callsheet,1)='".$week."' AND e.id_sub_territory = '".$id_sub."'
			AND notasi_outlet='".$id_notasi."' AND a.id_brand='".$id_brand."' GROUP BY b.`id_outlet`";
		$data['outlet'] = $this->db->query("SELECT *
			FROM tabel_callsheet_detil a
			LEFT JOIN tabel_notasi r ON (r.`id` = a.`notasi_outlet`)
			LEFT JOIN tabel_callsheet_outlet1 b ON (b.`id_callsheet_outlet` = a.`id_callsheet_outlet`)
			LEFT JOIN tabel_callsheet c ON (c.`id_callsheet` = b.`id_callsheet`)
			LEFT JOIN `tabel_outlet` n ON (n.`id_outlet` = b.`id_outlet`)
			LEFT JOIN `tabel_rute` d ON (d.`id_rute` = c.`id_rute`)
			LEFT JOIN `tabel_distrik` e ON (e.`id_distrik` = d.`id_distrik`)
			LEFT JOIN `tabel_sub_territory` f ON (f.`id_sub_territory` = e.`id_sub_territory`)
			LEFT JOIN `tabel_territory` g ON (g.`id_territory` = f.`id_territory`)
			LEFT JOIN `tabel_area_office` h ON (h.`id_ao` = g.`id_ao`)
			LEFT JOIN `tabel_tipe_distrik` i ON (i.`id_tipe_distrik` = e.`id_tipe_distrik`)
			LEFT JOIN `tabel_kel_desa` j ON (j.`id_kel_desa` = n.`id_kel_desa`)
			LEFT JOIN `tabel_kecamatan` k ON (k.`id_kecamatan` = j.`id_kecamatan`)
			LEFT JOIN `tabel_kabupaten_kota` o ON (o.`id_kab_kota` = k.`id_kab_kota`)
			LEFT JOIN `tabel_provinsi` p ON (p.`id_provinsi` = o.`id_provinsi`)
			LEFT JOIN `tabel_karyawan` q ON (q.`nik` = e.`id_karyawan`)
			LEFT JOIN `tabel_tipe_outlet` l ON (l.`id_tipe_outlet` = n.`id_tipe_outlet`)
			LEFT JOIN `tabel_tipe_distrik` m ON (m.`id_tipe_distrik` = e.`id_tipe_distrik`)
			WHERE	$where");
	$this->load->view('admin/callsheet/export',$data);
	}
	public function cetak_callsheet(){
		$tipe= $this->input->post('tipe');
		if ($tipe != ""){
			$this->load->model("model_karyawan",'',TRUE);
			$this->load->model("model_area_office",'',TRUE);
			$data['ao']=$this->model_area_office->lihat();
			$data['title']="PT. Surya Mustika Lampung";
			$data['tipe']=$this->input->post('tipe');
			$data['user']=$this->session->userdata('username');
			$data['level']=$this->session->userdata('level');
			if($tipe=="retail"){
				$this->load->view('admin/header',$data);
				$this->load->view('admin/callsheet/cetak_retail',$data);
				$this->load->view('admin/footer',$data);
			} elseif($tipe=="semi"){
				$this->load->view('admin/header',$data);
				$this->load->view('admin/callsheet/cetak_semi',$data);
				$this->load->view('admin/footer',$data);
			} elseif($tipe=="so"){
				$this->load->view('admin/header',$data);
				$this->load->view('admin/callsheet/cetak_so',$data);
				$this->load->view('admin/footer',$data);
			} elseif($tipe=="sa"){
				$this->load->view('admin/header',$data);
				$this->load->view('admin/callsheet/cetak_sa',$data);
				$this->load->view('admin/footer',$data);
			}
		} else{ redirect('callsheet/cetak','refresh'); }
	}
	public function export(){
		$rute = $this->input->post('rute');
		$basic = $this->db->query("SELECT * FROM tabel_area_office a, tabel_territory b, tabel_sub_territory c, tabel_distrik d, tabel_rute e, tabel_karyawan f
							where a.id_ao=b.id_ao and b.id_territory=c.id_territory and c.id_sub_territory=d.id_sub_territory and d.id_distrik=e.id_distrik and d.id_karyawan=f.nik and e.id_rute='$rute'");
		$to = $this->db->query("SELECT count(a.id_outlet) as total FROM tabel_outlet a, tabel_rute b, tabel_kel_desa c, tabel_tipe_outlet d where a.id_tipe_outlet=d.id_tipe_outlet and a.id_rute=b.id_rute and a.id_kel_desa=c.id_kel_desa and b.id_rute='$rute'");
		//$outlet = $this->db->query("SELECT * FROM tabel_outlet a, tabel_rute b, tabel_kel_desa c, tabel_tipe_outlet d where a.id_tipe_outlet=d.id_tipe_outlet and a.id_rute=b.id_rute and a.id_kel_desa=c.id_kel_desa and b.id_rute='$rute'");
		$outlet = $this->db->query("SELECT * FROM
			`tabel_outlet` a
			INNER JOIN `tabel_rute` b ON (a.`id_rute` = b.`id_rute`)
			LEFT JOIN `tabel_kel_desa` c ON (a.`id_kel_desa` = c.`id_kel_desa`)
			LEFT JOIN `tabel_tipe_outlet` d ON (a.`id_tipe_outlet` = d.`id_tipe_outlet`)
			WHERE b.id_rute='$rute'
			");
		$this->load->library("excel/PHPExcel");

		$file = './asset/template.xls';       
		$objWriter = PHPExcel_IOFactory::load($file);
		foreach($basic->result_array() as $a)
		foreach($to->result_array() as $b)
		$objWriter->getActiveSheet()->setCellValue('C6', stripslashes($a['nama_ao']));
		$objWriter->getActiveSheet()->setCellValue('C7', stripslashes($a['nama_territory']));
		$objWriter->getActiveSheet()->setCellValue('C8', stripslashes($a['nama_sub_territory']));
		$objWriter->getActiveSheet()->setCellValue('C9', stripslashes($a['nama_distrik']));
		$objWriter->getActiveSheet()->setCellValue('C10', stripslashes($a['nama_rute']));
		$objWriter->getActiveSheet()->setCellValue('C11', stripslashes($a['nama_karyawan']));
		$objWriter->getActiveSheet()->setCellValue('F6', stripslashes($b['total']));
		$fil1=15;$fil2=15;$fil3=15;
		foreach($outlet->result_array() as $c){
			$fil1++;
			if ($fil1 <= 37) {
				$objWriter->getActiveSheet()->setCellValue('B'.$fil1.'', stripslashes($c['nama_outlet']));
				$objWriter->getActiveSheet()->setCellValue('C'.$fil1.'', stripslashes($c['alamat_outlet']));
				$objWriter->getActiveSheet()->setCellValue('D'.$fil1.'', stripslashes($c['kel_desa']));
				$objWriter->getActiveSheet()->setCellValue('E'.$fil1.'', stripslashes($c['tipe_outlet']));
			} elseif ($fil1 <= 65) {
				$fil2++;
				$objWriter->getActiveSheet()->setCellValue('AX'.$fil2.'', stripslashes($c['nama_outlet']));
				$objWriter->getActiveSheet()->setCellValue('AY'.$fil2.'', stripslashes($c['alamat_outlet']));
				$objWriter->getActiveSheet()->setCellValue('AZ'.$fil2.'', stripslashes($c['kel_desa']));
				$objWriter->getActiveSheet()->setCellValue('BA'.$fil2.'', stripslashes($c['tipe_outlet']));
			} elseif ($fil1 <= 93) {
				$fil3++;
				$objWriter->getActiveSheet()->setCellValue('CT'.$fil3.'', stripslashes($c['nama_outlet']));
				$objWriter->getActiveSheet()->setCellValue('CU'.$fil3.'', stripslashes($c['alamat_outlet']));
				$objWriter->getActiveSheet()->setCellValue('CV'.$fil3.'', stripslashes($c['kel_desa']));
				$objWriter->getActiveSheet()->setCellValue('CW'.$fil3.'', stripslashes($c['tipe_outlet']));
			}
		}
		$objWriter->getActiveSheet()->setTitle('Excel Pertama');
		$objWriter->getActiveSheet()->getProtection()->setSheet(true);
		$objWriter->getActiveSheet()->getProtection()->setSort(true);
		$objWriter->getActiveSheet()->getProtection()->setInsertRows(true);
		$objWriter->getActiveSheet()->getProtection()->setFormatCells(true);

		$objWriter->getActiveSheet()->getProtection()->setPassword('apache');
		$filename='CALLSHEET_'.$a['nama_ao'].'_'.$a['nama_karyawan'].'.xls'; //just some random filename
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		//ubah nama file saat diunduh
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		//unduh file
		$objWriter = PHPExcel_IOFactory::createWriter($objWriter, 'Excel5');
		$objWriter->save('php://output');
	}
	public function grafik_bd(){
		$tahun 			= $_GET['tahun'];
		$sub 			= $_GET['sub'];
		$distrik		= $_GET['distrik'];
		$rute			= $_GET['rute'];
		$jenis_outlet 	= $_GET['jenis_outlet'];
		if(isset($_GET['brand'])){
			$brand = $_GET['brand'];
		}
		$week=53;
		$this->load->model("model_karyawan",'',TRUE);
//SL
		$rows = array();
		$rows1 = array();
		$rows2 = array();
		$rows['name'] = 'SL';
		$i=1;
		if ($tahun>=2016) { $rows['week_grafik'][] = 1; $rows['data'][] = 0; $rows1['data'][] = 0; $rows2['data'][] = 0; }
		$week_grafik=$week;
		while($i<=$week)
		{
		if($rute>0){
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and c.id_rute = '".$rute."' 
		and e.jenis_outlet like '%RETAIL%' ");
		} elseif($distrik>0){
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and b.id_distrik = '".$distrik."' 
		and e.jenis_outlet like '%RETAIL%' ");
		}
		else {
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and a.id_sub_territory = '".$sub."' 
		and e.jenis_outlet like '%RETAIL%' ");
		}
			if(isset($_GET['brand'])){
				if($rute>0){
				$sl = $this->db->query("SELECT SUM(a.sl) AS sl FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				} elseif($distrik>0){
				$sl = $this->db->query("SELECT SUM(a.sl) AS sl FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}else {
				$sl = $this->db->query("SELECT SUM(a.sl) AS sl FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}
			} else{
				if($rute>0){
				$sl = $this->db->query("SELECT SUM(a.sl) AS sl FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND c.status='Closed'");
				}elseif($distrik>0){
				$sl = $this->db->query("SELECT SUM(a.sl) AS sl FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND c.status='Closed'");
				} else {
				$sl = $this->db->query("SELECT SUM(a.sl) AS sl FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND c.status='Closed'");
				}
			}
			foreach($to->result_array() as $to){$to1 = $to['total'];}
			foreach($sl->result_array() as $r){
				if (is_null($r['sl'])){
					$rows['data'][] = '0';
				}else{
					$rows['data'][] = number_format((float)($r['sl']/$to1)*100, 2, '.', '');
				}
				if ($tahun>=2016) { $rows['week_grafik'][] = $i+1; }else{ $rows['week_grafik'][] = $i; }
			}
			$i++;
			
		}
//avb
		$rows1['name'] = 'AVAIBILITY';
		$i=1;
		$week_grafik=$week;
		while($i<=$week)
		{
			
			if(isset($_GET['brand'])){
				if($rute>0){
				$avb = $this->db->query("SELECT sum(a.sk+a.sl+a.sd+a.oos+a.sb) AS avb FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND a.id_brand='".$brand."' AND d.id_rute = '".$rute."' and c.status='Closed'");
				}elseif($distrik>0){
				$avb = $this->db->query("SELECT sum(a.sk+a.sl+a.sd+a.oos+a.sb) AS avb FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND a.id_brand='".$brand."' AND e.id_distrik = '".$distrik."' and c.status='Closed'");
				} else{
				$avb = $this->db->query("SELECT sum(a.sk+a.sl+a.sd+a.oos+a.sb) AS avb FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND a.id_brand='".$brand."' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
				}
			} else{
				if($rute>0){
				$avb = $this->db->query("SELECT sum(a.sk+a.sl+a.sd+a.oos+a.sb) AS avb FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' and c.status='Closed'");
				}elseif($distrik>0){
				$avb = $this->db->query("SELECT sum(a.sk+a.sl+a.sd+a.oos+a.sb) AS avb FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' and c.status='Closed'");
				} else{
				$avb = $this->db->query("SELECT sum(a.sk+a.sl+a.sd+a.oos+a.sb) AS avb FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
				}
			}
			foreach($avb->result_array() as $avb){$avb1 = $avb['avb'];}
			if($avb1==0){
				$rows1['data'][] = 0;
			}else {
				$ec = ($avb1/$to1)*100;
				$rows1['data'][] = number_format((float)$ec, 2, '.', '');
			}
			$i++;
		}
//Visibility
		$rows2['name'] = 'VISIBILITY';
		$i=1;
		$week_grafik=$week;
		while($i<=$week)
		{
		
			if(isset($_GET['brand'])){
				if($rute>0){
				$visibility = $this->db->query("SELECT SUM(a.low+a.mid+a.hig) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}elseif($distrik>0){
				$visibility = $this->db->query("SELECT SUM(a.low+a.mid+a.hig) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}else{
				$visibility = $this->db->query("SELECT SUM(a.low+a.mid+a.hig) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}
			} else{
				if($rute>0){
				$visibility = $this->db->query("SELECT SUM(a.low+a.mid+a.hig) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND  c.status='Closed'");
				}elseif($distrik>0){
				$visibility = $this->db->query("SELECT SUM(a.low+a.mid+a.hig) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND c.status='Closed'");
				}else{
				$visibility = $this->db->query("SELECT SUM(a.low+a.mid+a.hig) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND c.status='Closed'");
				}
			}
			foreach($visibility->result_array() as $r){
				$rows2['data'][] = number_format((float)($r['visibility']/$to1)*100, 2, '.', '');
			}
			$i++;
			
		}
		$rslt = array();
		array_push($rslt, $rows);
		array_push($rslt, $rows1);
		array_push($rslt, $rows2);
		print json_encode($rslt, JSON_NUMERIC_CHECK);
	}
	public function grafik_avgec(){
		$tahun 			= $_GET['tahun'];
		$sub 			= $_GET['sub'];
		$distrik		= $_GET['distrik'];
		$rute			= $_GET['rute'];
		$jenis_outlet 	= $_GET['jenis_outlet'];
		if(isset($_GET['brand'])){
			$brand = $_GET['brand'];
		}
		$week=53;
		$this->load->model("model_karyawan",'',TRUE);
//SK
		$rows = array();
		$rows1 = array();
		$rows2 = array();
		$rows['name'] = 'SK';
		$i=1;
		if ($tahun>=2016) { $rows['week_grafik'][] = 1; $rows['data'][] = 0; $rows1['data'][] = 0; $rows2['data'][] = 0; }
		while($i<=$week)
		{
		if($rute>0){
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and c.id_rute = '".$rute."' 
		and e.jenis_outlet like '%RETAIL%' ");
		} elseif($distrik>0){
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and b.id_distrik = '".$distrik."' 
		and e.jenis_outlet like '%RETAIL%' ");
		}
		else {
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and a.id_sub_territory = '".$sub."' 
		and e.jenis_outlet like '%RETAIL%' ");
		}		
			if(isset($_GET['brand'])){
				if($rute>0){
				$sk = $this->db->query("SELECT SUM(a.sk) AS sk FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}elseif($distrik>0){
				$sk = $this->db->query("SELECT SUM(a.sk) AS sk FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}else{
				$sk = $this->db->query("SELECT SUM(a.sk) AS sk FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}
			} else{
				if($rute>0){
				$sk = $this->db->query("SELECT SUM(a.sk) AS sk FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND c.status='Closed'");
				}elseif($distrik>0){
				$sk = $this->db->query("SELECT SUM(a.sk) AS sk FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND c.status='Closed'");
				}else{
				$sk = $this->db->query("SELECT SUM(a.sk) AS sk FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND c.status='Closed'");
				}
			}
			foreach($to->result_array() as $to){$to1 = $to['total'];}
			foreach($sk->result_array() as $r){
				$rows['data'][] = number_format((float)($r['sk']/$to1)*100, 2, '.', '');
				if ($tahun>=2016) { $rows['week_grafik'][] = $i+1; }else{ $rows['week_grafik'][] = $i; }
			}
			$i++;
		}
//SB
		$rows1['name'] = 'SB';
		$i=1;
		while($i<=$week)
		{
			if(isset($_GET['brand'])){
				if($rute>0){
				$sb = $this->db->query("SELECT SUM(a.sb) AS sb FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}elseif($distrik>0){
				$sb = $this->db->query("SELECT SUM(a.sb) AS sb FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}else{
				$sb = $this->db->query("SELECT SUM(a.sb) AS sb FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}
			} else{
				if($rute>0){
				$sb = $this->db->query("SELECT SUM(a.sb) AS sb FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND c.status='Closed'");
				}elseif($distrik>0){
				$sb = $this->db->query("SELECT SUM(a.sb) AS sb FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND c.status='Closed'");
				}else{
				$sb = $this->db->query("SELECT SUM(a.sb) AS sb FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND c.status='Closed'");
				}
			}
			foreach($sb->result_array() as $r){
				$rows1['data'][] = number_format((float)($r['sb']/$to1)*100, 2, '.', '');
			}
			$i++;
			
		}
//OOS
		$rows2['name'] = 'OOS';
		$i=1;
		while($i<=$week)
		{
			if(isset($_GET['brand'])){
				if($rute>0){
				$oos = $this->db->query("SELECT SUM(a.oos) AS oos FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}elseif($distrik>0){
				$oos = $this->db->query("SELECT SUM(a.oos) AS oos FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}else{
				$oos = $this->db->query("SELECT SUM(a.oos) AS oos FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}
			} else{
				if($rute>0){
				$oos = $this->db->query("SELECT SUM(a.oos) AS oos FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND c.status='Closed'");
				}elseif($distrik>0){
				$oos = $this->db->query("SELECT SUM(a.oos) AS oos FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND c.status='Closed'");
				}else{
				$oos = $this->db->query("SELECT SUM(a.oos) AS oos FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND c.status='Closed'");
				}
			}
			foreach($oos->result_array() as $r){
				$rows2['data'][] = number_format((float)($r['oos']/$to1)*100, 2, '.', '');
			}
			$i++;
			
		}
		$rslt = array();
		array_push($rslt, $rows);
		array_push($rslt, $rows1);
		array_push($rslt, $rows2);
		print json_encode($rslt, JSON_NUMERIC_CHECK);
	}
	public function grafik_avgcm(){
		$tahun 			= $_GET['tahun'];
		$sub 			= $_GET['sub'];
		$distrik		= $_GET['distrik'];
		$rute			= $_GET['rute'];
		$jenis_outlet 	= $_GET['jenis_outlet'];
		if(isset($_GET['brand'])){
			$brand = $_GET['brand'];
		}
		$week=53;
		$this->load->model("model_karyawan",'',TRUE);
//AVG CM
		$rows = array();
		$rows1 = array();
		$rows['name'] = 'AVG CM';
		$i=1;
		if ($tahun>=2016) { $rows['week_grafik'][] = 1; $rows['data'][] = 0; $rows1['data'][] = 0; }
		$week_grafik=$week;
		while($i<=$week)
		{
		if($rute>0){
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and c.id_rute = '".$rute."' 
		and e.jenis_outlet like '%RETAIL%' ");
		} elseif($distrik>0){
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and b.id_distrik = '".$distrik."' 
		and e.jenis_outlet like '%RETAIL%' ");
		}
		else {
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and a.id_sub_territory = '".$sub."' 
		and e.jenis_outlet like '%RETAIL%' ");
		}		
			if(isset($_GET['brand'])){
				if($rute>0){
				$tk = $this->db->query("SELECT SUM(a.total_kunjungan) AS total1 FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d where year(a.tgl_callsheet)='".$tahun."' 
											and week(a.tgl_callsheet,1)='".$i."' and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' 
											AND b.id_rute = '".$rute."' and a.status='Closed'");
				}elseif($distrik>0){
				$tk = $this->db->query("SELECT SUM(a.total_kunjungan) AS total1 FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d where year(a.tgl_callsheet)='".$tahun."' 
											and week(a.tgl_callsheet,1)='".$i."' and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' 
											AND c.id_distrik = '".$distrik."' and a.status='Closed'");
				}else{
				$tk = $this->db->query("SELECT SUM(a.total_kunjungan) AS total1 FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d where year(a.tgl_callsheet)='".$tahun."' 
											and week(a.tgl_callsheet,1)='".$i."' and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' 
											AND c.id_sub_territory = '".$sub."' and a.status='Closed'");
				}
			} else{
				if($rute>0){
				$tk = $this->db->query("SELECT SUM(a.total_kunjungan) AS total1 FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d where year(a.tgl_callsheet)='".$tahun."' 
											and week(a.tgl_callsheet,1)='".$i."' and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' 
											AND b.id_rute = '".$rute."' and a.status='Closed'");
				}elseif($distrik>0){
				$tk = $this->db->query("SELECT SUM(a.total_kunjungan) AS total1 FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d where year(a.tgl_callsheet)='".$tahun."' 
											and week(a.tgl_callsheet,1)='".$i."' and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' 
											AND c.id_distrik = '".$distrik."' and a.status='Closed'");
				}else{
				$tk = $this->db->query("SELECT SUM(a.total_kunjungan) AS total1 FROM tabel_callsheet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d where year(a.tgl_callsheet)='".$tahun."' 
											and week(a.tgl_callsheet,1)='".$i."' and a.id_rute=b.id_rute and b.id_distrik = c.id_distrik and c.id_tipe_distrik=d.id_tipe_distrik and d.jenis_outlet like '%retail%' 
											AND c.id_sub_territory = '".$sub."' and a.status='Closed'");
				}
			}
			foreach($to->result_array() as $to){$to1=$to['total'];}
			foreach($tk->result_array() as $r){
				if ($r['total1']==0){
					$rows['data'][] = '0';
				}else{
					$rows['data'][] = number_format((float)($r['total1']/$to1)*100, 2, '.', '');
				}
			}
			if ($tahun>=2016) { $rows['week_grafik'][] = $i+1; }else{ $rows['week_grafik'][] = $i; }
			$i++;
			
		}
//AVG EC
		$rows1['name'] = 'AVG EC';
		$i=1;
		$week_grafik=$week;
		while($i<=$week)
		{
			if(isset($_GET['brand'])){
				if($rute>0){
				$ec = $this->db->query("SELECT SUM(a.sk+a.oos+a.sb) AS ec FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND a.id_brand='".$brand."' and c.status='Closed'");
				}elseif($distrik>0){
				$ec = $this->db->query("SELECT SUM(a.sk+a.oos+a.sb) AS ec FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND a.id_brand='".$brand."' and c.status='Closed'");
				}else{
				$ec = $this->db->query("SELECT SUM(a.sk+a.oos+a.sb) AS ec FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."' and c.status='Closed'");
				}
			} else{
				if($rute>0){
				$ec = $this->db->query("SELECT SUM(a.sk+a.oos+a.sb) AS ec FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND c.status='Closed'");
				}elseif($distrik>0){
				$ec = $this->db->query("SELECT SUM(a.sk+a.oos+a.sb) AS ec FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND c.status='Closed'");
				}else{
				$ec = $this->db->query("SELECT SUM(a.sk+a.oos+a.sb) AS ec FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND c.status='Closed'");
				}
			}
			foreach($ec->result_array() as $r){
				if (is_null($r['ec'])){
					$rows1['data'][] = '0';
				}else{
					$rows1['data'][] = number_format((float)($r['ec']/$to1)*100, 2, '.', '');
				}
			}
			$i++;
			
		}
		$rslt = array();
		array_push($rslt, $rows);
		array_push($rslt, $rows1);
		print json_encode($rslt, JSON_NUMERIC_CHECK);
	}
	public function grafik_sdtl(){
		$tahun 			= $_GET['tahun'];
		$sub 			= $_GET['sub'];
		$distrik		= $_GET['distrik'];
		$rute			= $_GET['rute'];
		$jenis_outlet 	= $_GET['jenis_outlet'];
		if(isset($_GET['brand'])){
			$brand = $_GET['brand'];
		}
		$week=53;
		$this->load->model("model_karyawan",'',TRUE);
		$rows = array();
		$rows1 = array();
		$rows['name'] = 'SD';
		$i=1;
		if ($tahun>=2016) { $rows['week_grafik'][] = 1; $rows['data'][] = 0; $rows1['data'][] = 0; }
		while($i<=$week)
		{
		if($rute>0){
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and c.id_rute = '".$rute."' 
		and e.jenis_outlet like '%RETAIL%' ");
		} elseif($distrik>0){
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and b.id_distrik = '".$distrik."' 
		and e.jenis_outlet like '%RETAIL%' ");
		}
		else {
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and a.id_sub_territory = '".$sub."' 
		and e.jenis_outlet like '%RETAIL%' ");
		}
			if(isset($_GET['brand'])){
				if($rute>0){
				$sd = $this->db->query("SELECT SUM(a.sd) AS sd FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
				WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."'
					AND a.id_brand='".$brand."' AND c.status='Closed'");
				}elseif($distrik>0){
				$sd = $this->db->query("SELECT SUM(a.sd) AS sd FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
				WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_distrik = '".$distrik."'
					AND a.id_brand='".$brand."' AND c.status='Closed'");
				}else{
				$sd = $this->db->query("SELECT SUM(a.sd) AS sd FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
				WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."'
					AND a.id_brand='".$brand."' AND c.status='Closed'");
				}
			} else {
				if($rute>0){
				$sd = $this->db->query("SELECT SUM(a.sd) AS sd FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
				WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND c.status='Closed'");
				}elseif($distrik>0){
				$sd = $this->db->query("SELECT SUM(a.sd) AS sd FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
				WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_distrik = '".$distrik."' AND c.status='Closed'");
				}else{
				$sd = $this->db->query("SELECT SUM(a.sd) AS sd FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
				WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND c.status='Closed'");
				}
			}
			foreach($to->result_array() as $to){$to1 = $to['total'];}
			foreach($sd->result_array() as $r){
				$rows['data'][] = number_format((float)($r['sd']/$to1)*100, 2, '.', '');
				if ($tahun>=2016) { $rows['week_grafik'][] = $i+1; }else{ $rows['week_grafik'][] = $i; }
			}
			$i++;
		}
		$rows1['name'] = 'TL';
		$i=1;
		while($i<=$week)
		{
			if(isset($_GET['brand'])){
				if($rute>0){
				$tl = $this->db->query("SELECT SUM(a.tl) AS tl FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}elseif($distrik>0){
				$tl = $this->db->query("SELECT SUM(a.tl) AS tl FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}else{
				$tl = $this->db->query("SELECT SUM(a.tl) AS tl FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}
			} else{
				if($rute>0){
				$tl = $this->db->query("SELECT SUM(a.tl) AS tl FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND c.status='Closed'");
				}elseif($distrik>0){
				$tl = $this->db->query("SELECT SUM(a.tl) AS tl FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND c.status='Closed'");
				}else{
				$tl = $this->db->query("SELECT SUM(a.tl) AS tl FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND c.status='Closed'");
				}
			}
			foreach($tl->result_array() as $r){
				$rows1['data'][] = number_format((float)($r['tl']/$to1)*100, 2, '.', '');
			}
			$i++;
			
		}
		$rslt = array();
		array_push($rslt, $rows);
		array_push($rslt, $rows1);
		print json_encode($rslt, JSON_NUMERIC_CHECK);
	}
	public function grafik_sbbpj(){
		$tahun 			= $_GET['tahun'];
		$sub 			= $_GET['sub'];
		$distrik		= $_GET['distrik'];
		$rute			= $_GET['rute'];
		$jenis_outlet 	= $_GET['jenis_outlet'];
		if(isset($_GET['brand'])){
			$brand = $_GET['brand'];
		}
		$week=53;
		$this->load->model("model_karyawan",'',TRUE);

		$rows = array();
		$rows1 = array();
		$rows['name'] = 'SB';
		$i=1;
		if ($tahun>=2016) { $rows['week_grafik'][] = 1; $rows['data'][] = 0; $rows1['data'][] = 0; }
		while($i<=$week)
		{
		if($rute>0){
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and c.id_rute = '".$rute."' 
		and e.jenis_outlet like '%RETAIL%' ");
		} elseif($distrik>0){
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and b.id_distrik = '".$distrik."' 
		and e.jenis_outlet like '%RETAIL%' ");
		}
		else {
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and a.id_sub_territory = '".$sub."' 
		and e.jenis_outlet like '%RETAIL%' ");
		}		
			if(isset($_GET['brand'])){
				if($rute>0){
				$sb = $this->db->query("SELECT SUM(a.sb) AS sb  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."'
					AND a.id_brand='".$brand."' AND c.status='Closed'");
				}elseif($distrik>0){
				$sb = $this->db->query("SELECT SUM(a.sb) AS sb  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."'
					AND a.id_brand='".$brand."' AND c.status='Closed'");
				}else{
				$sb = $this->db->query("SELECT SUM(a.sb) AS sb  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."'
					AND a.id_brand='".$brand."' AND c.status='Closed'");
				}
			} else{
				if($rute>0){
				$sb = $this->db->query("SELECT SUM(a.sb) AS sb  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND c.status='Closed'");
				}elseif($distrik>0){
				$sb = $this->db->query("SELECT SUM(a.sb) AS sb  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND c.status='Closed'");
				}else{
				$sb = $this->db->query("SELECT SUM(a.sb) AS sb  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."'AND c.status='Closed'");
				}
			}
			foreach($to->result_array() as $to){$to1 = $to['total'];}
			foreach($sb->result_array() as $r){
				$rows['data'][] = number_format((float)($r['sb']/$to1)*100, 2, '.', '');
				if ($tahun>=2016) { $rows['week_grafik'][] = $i+1; }else{ $rows['week_grafik'][] = $i; }
			}
			$i++;
			
		}
		$rows1['name'] = 'BPJ';
		$i=1;
		while($i<=$week)
		{
			if(isset($_GET['brand'])){
				if($rute>0){
				$sk = $this->db->query("SELECT SUM(a.bpj) AS bpj  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}elseif($distrik>0){
				$sk = $this->db->query("SELECT SUM(a.bpj) AS bpj  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}else{
				$sk = $this->db->query("SELECT SUM(a.bpj) AS bpj  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}
			} else{
				if($rute>0){
				$sk = $this->db->query("SELECT SUM(a.bpj) AS bpj  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND c.status='Closed'");
				}elseif($distrik>0){
				$sk = $this->db->query("SELECT SUM(a.bpj) AS bpj  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND c.status='Closed'");
				}else{
				$sk = $this->db->query("SELECT SUM(a.bpj) AS bpj  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND c.status='Closed'");
				}
			}
			foreach($sk->result_array() as $r){
				$rows1['data'][] = number_format((float)($r['bpj']/$to1)*100, 2, '.', '');
			}
			$i++;
			
		}
		$rslt = array();
		array_push($rslt, $rows);
		array_push($rslt, $rows1);
		print json_encode($rslt, JSON_NUMERIC_CHECK);
	}
	public function grafik_sksloos(){
		$tahun 			= $_GET['tahun'];
		$sub 			= $_GET['sub'];
		$distrik		= $_GET['distrik'];
		$rute			= $_GET['rute'];
		$jenis_outlet 	= $_GET['jenis_outlet'];
		if(isset($_GET['brand'])){
			$brand = $_GET['brand'];
		}
		$week=53;
		$this->load->model("model_karyawan",'',TRUE);
//SK
		$rows = array();
		$rows1 = array();
		$rows2 = array();
		$rows['name'] = 'SK';
		$i=1;
		if ($tahun>=2016) { $rows['week_grafik'][] = 1; $rows['data'][] = 0; $rows1['data'][] = 0; $rows2['data'][] = 0; }
		while($i<=$week)
		{
		if($rute>0){
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and c.id_rute = '".$rute."' 
		and e.jenis_outlet like '%RETAIL%' ");
		} elseif($distrik>0){
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and b.id_distrik = '".$distrik."' 
		and e.jenis_outlet like '%RETAIL%' ");
		}
		else {
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and a.id_sub_territory = '".$sub."' 
		and e.jenis_outlet like '%RETAIL%' ");
		}		
		
			if(isset($_GET['brand'])){
				if($rute>0){
				$sk = $this->db->query("SELECT SUM(a.sk) AS sk FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."'
					AND a.id_brand='".$brand."' AND c.status='Closed'");
				}elseif($distrik>0){
				$sk = $this->db->query("SELECT SUM(a.sk) AS sk FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."'
					AND a.id_brand='".$brand."' AND c.status='Closed'");
				} else{
				$sk = $this->db->query("SELECT SUM(a.sk) AS sk FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."'
					AND a.id_brand='".$brand."' AND c.status='Closed'");
				}
			} else{
				if($rute>0){
				$sk = $this->db->query("SELECT SUM(a.sk) AS sk FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND c.status='Closed'");
				}elseif($distrik>0){
				$sk = $this->db->query("SELECT SUM(a.sk) AS sk FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND c.status='Closed'");
				} else{
				$sk = $this->db->query("SELECT SUM(a.sk) AS sk FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND c.status='Closed'");
				}
			}
			foreach($to->result_array() as $to){$to1 = $to['total'];}
			foreach($sk->result_array() as $r){
				$rows['data'][] = number_format((float)($r['sk']/$to1)*100, 2, '.', '');
				if ($tahun>=2016) { $rows['week_grafik'][] = $i+1; }else{ $rows['week_grafik'][] = $i; }
			}
			$i++;
		}
//SL
		$rows1['name'] = 'SL';
		$i=1;
		while($i<=$week)
		{
			if(isset($_GET['brand'])){
				if($rute>0){
				$sl = $this->db->query("SELECT SUM(a.sl) AS sl FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}elseif($distrik>0){
				$sl = $this->db->query("SELECT SUM(a.sl) AS sl FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}else{
				$sl = $this->db->query("SELECT SUM(a.sl) AS sl FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}
			} else{
				if($rute>0){
				$sl = $this->db->query("SELECT SUM(a.sl) AS sl FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND c.status='Closed'");
				}elseif($distrik>0){
				$sl = $this->db->query("SELECT SUM(a.sl) AS sl FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND c.status='Closed'");
				}else{
				$sl = $this->db->query("SELECT SUM(a.sl) AS sl FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND c.status='Closed'");
				}
			}
			foreach($sl->result_array() as $r){
				$rows1['data'][] = number_format((float)($r['sl']/$to1)*100, 2, '.', '');
			}
			$i++;
			
		}
//OOS
		$rows2['name'] = 'OOS';
		$i=1;
		while($i<=$week)
		{
			if(isset($_GET['brand'])){
				if($rute>0){
				$oos = $this->db->query("SELECT SUM(a.oos) AS oos FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}elseif($distrik>0){
				$oos = $this->db->query("SELECT SUM(a.oos) AS oos FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}else{
				$oos = $this->db->query("SELECT SUM(a.oos) AS oos FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}
			} else{
				if($rute>0){
				$oos = $this->db->query("SELECT SUM(a.oos) AS oos FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND c.status='Closed'");
				}elseif($distrik>0){
				$oos = $this->db->query("SELECT SUM(a.oos) AS oos FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND c.status='Closed'");
				}else{
				$oos = $this->db->query("SELECT SUM(a.oos) AS oos FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND c.status='Closed'");
				}
			}
			foreach($oos->result_array() as $r){
				$rows2['data'][] = number_format((float)($r['oos']/$to1)*100, 2, '.', '');
			}
			$i++;
			
		}
		$rslt = array();
		array_push($rslt, $rows);
		array_push($rslt, $rows1);
		array_push($rslt, $rows2);
		print json_encode($rslt, JSON_NUMERIC_CHECK);
	}
	public function grafik_sa1(){
		$tahun = $_GET['tahun'];
		$sub = $_GET['sub'];
		$jenis_outlet = $_GET['jenis_outlet'];
		if(isset($_GET['brand'])){
			$brand = $_GET['brand'];
		}
		$week=53;
		$this->load->model("model_karyawan",'',TRUE);
//STOCK AWAL
		$rows = array();
		$rows1 = array();
		$rows2 = array();
		$rows['name'] = 'STOCK AWAL';
		$i=1;
		if ($tahun>=2016) { $rows['week_grafik'][] = 1; $rows['data'][] = 0; $rows1['data'][] = 0;  $rows2['data'][] = 0; }
		while($i<=$week)
		{
			if(isset($_GET['brand'])){
				$stock_awal = $this->db->query("SELECT SUM(a.stock) AS stock_awal FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."'");
			} else{
				$stock_awal = $this->db->query("SELECT SUM(a.stock) AS stock_awal FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."'");
			}
			foreach($stock_awal->result_array() as $r){
				if (is_null($r['stock_awal'])){
					$rows['data'][] = '0';
				}else{
					$rows['data'][] = $r['stock_awal'];
					if ($tahun>=2016) { $rows['week_grafik'][] = $i+1; }else{ $rows['week_grafik'][] = $i; }
				}
			}
			$i++;
		}
//BUY
		$rows1['name'] = 'BUY';
		$i=1;
		while($i<=$week)
		{
			if(isset($_GET['brand'])){
				$buy = $this->db->query("SELECT SUM(a.buy) AS buy FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."'");
			} else{
				$buy = $this->db->query("SELECT SUM(a.buy) AS buy FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."'");
			}
			foreach($buy->result_array() as $r){
				if (is_null($r['buy'])){
					$rows1['data'][] = '0';
				}else{
					$rows1['data'][] = $r['buy'];
				}
			}
			$i++;
		}
//STOCK AKHIR
		$rows2['name'] = 'STOCK AKHIR';
		$i=1;
		while($i<=$week)
		{
			if(isset($_GET['brand'])){
				$stock_awal = $this->db->query("SELECT SUM(a.stock) AS stock_awal FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."'");
				$buy = $this->db->query("SELECT SUM(a.buy) AS buy FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."'");
			} else{
				$stock_awal = $this->db->query("SELECT SUM(a.stock) AS stock_awal FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."'");
				$buy = $this->db->query("SELECT SUM(a.buy) AS buy FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."'");
			}
			foreach($stock_awal->result_array() as $r){ $stock_awal1 = $r['stock_awal'];}
			foreach($buy->result_array() as $r){ $buy1 = $r['buy']; }
			$stock_akhir = $stock_awal1 + $buy1;
			$rows2['data'][] = $stock_akhir;
			$i++;
			
		}
		$rslt = array();
		array_push($rslt, $rows);
		array_push($rslt, $rows1);
		array_push($rslt, $rows2);
		print json_encode($rslt, JSON_NUMERIC_CHECK);
	}
	public function grafik_sa2(){
		$tahun = $_GET['tahun'];
		$sub = $_GET['sub'];
		$jenis_outlet = $_GET['jenis_outlet'];
		if(isset($_GET['brand'])){
			$brand = $_GET['brand'];
		}
		$week=53;
		$this->load->model("model_karyawan",'',TRUE);

		$rows = array();
		$rows['name'] = 'SELLING OUT';
		$i=1;
		while($i<=$week)
		{
			if($i=="1"){
				if(isset($_GET['brand'])){
					$stock_awal = $this->db->query("SELECT SUM(a.stock) AS stock_awal FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
						WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".($tahun)."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
						AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."'");
					$buy_ml = $this->db->query("SELECT SUM(a.buy) AS buy_ml FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
						WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".($tahun-1)."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
						AND WEEK(c.tgl_callsheet,1)=52 AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."'");
					$stok_ml = $this->db->query("SELECT SUM(a.stock) AS stock_ml FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
						WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".($tahun-1)."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
						AND WEEK(c.tgl_callsheet,1)=52 AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."'");
				} else{
					$stock_awal = $this->db->query("SELECT SUM(a.stock) AS stock_awal FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
						WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".($tahun)."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
						AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."'");
					$buy_ml = $this->db->query("SELECT SUM(a.buy) AS buy_ml FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
						WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".($tahun-1)."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
						AND WEEK(c.tgl_callsheet,1)=52 AND e.id_sub_territory = '".$sub."'");
					$stok_ml = $this->db->query("SELECT SUM(a.stock) AS stock_ml FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
						WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".($tahun-1)."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
						AND WEEK(c.tgl_callsheet,1)=52 AND e.id_sub_territory = '".$sub."'");
				}
			} else{
				if(isset($_GET['brand'])){
					$stock_awal = $this->db->query("SELECT SUM(a.stock) AS stock_awal FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
						WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
						AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."'");
					$buy_ml = $this->db->query("SELECT SUM(a.buy) AS buy_ml FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
						WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".($tahun)."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
						AND WEEK(c.tgl_callsheet,1)='".($i-1)."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."'");
					$stok_ml = $this->db->query("SELECT SUM(a.stock) AS stock_ml FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
						WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".($tahun)."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
						AND WEEK(c.tgl_callsheet,1)='".($i-1)."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."'");
				} else{
					$stock_awal = $this->db->query("SELECT SUM(a.stock) AS stock_awal FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
						WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
						AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."'");
					$buy_ml = $this->db->query("SELECT SUM(a.buy) AS buy_ml FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
						WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".($tahun)."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
						AND WEEK(c.tgl_callsheet,1)='".($i-1)."' AND e.id_sub_territory = '".$sub."'");
					$stok_ml = $this->db->query("SELECT SUM(a.stock) AS stock_ml FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
						WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".($tahun)."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
						AND WEEK(c.tgl_callsheet,1)='".($i-1)."' AND e.id_sub_territory = '".$sub."'");
				}
			}
			foreach($stock_awal->result_array() as $r){ $stock_awal = $r['stock_awal'];}
			foreach($buy_ml->result_array() as $r){ $buy_ml = $r['buy_ml']; }
			foreach($stok_ml->result_array() as $r){ $stok_ml = $r['stock_ml']; }
			$stock_akhir_ml = $buy_ml + $stok_ml;
			$selling_out = $stock_akhir_ml + $buy_ml - $stock_awal;
			$rows['data'][] = $selling_out;
			$rows['week_grafik'][] = $i; 
			$i++;
			
		}
		$rows1 = array();
		$rows1['name'] = 'POTENTIAL';
		$i=1;
		$week_grafik=$week;
		while($i<=$week)
		{
			if($i==1){
				if(isset($_GET['brand'])){
					$stock_awal_ml = $this->db->query("SELECT SUM(a.stock) AS stock_awal_ml FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
						WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".($tahun-1)."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
						AND WEEK(c.tgl_callsheet,1)=52 AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."'");
					$buy_awal = $this->db->query("SELECT SUM(a.buy) AS buy_awal FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
						WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".($tahun)."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
						AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."'");
					$stok_awal = $this->db->query("SELECT SUM(a.stock_outlet) AS stok_awal FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
						WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".($tahun)."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
						AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."'");
				} else{
					$stock_awal_ml = $this->db->query("SELECT SUM(a.stock_outlet) AS stock_awal_ml FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
						WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".($tahun-1)."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
						AND WEEK(c.tgl_callsheet,1)=52 AND e.id_sub_territory = '".$sub."'");
					$buy_awal = $this->db->query("SELECT SUM(a.buy_outlet) AS buy_awal FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
						WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".($tahun)."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
						AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."'");
					$stok_awal = $this->db->query("SELECT SUM(a.stock_outlet) AS stok_awal FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
						WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".($tahun)."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
						AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."'");
				}
			} else{
				if(isset($_GET['brand'])){
					$stock_awal_ml = $this->db->query("SELECT SUM(a.stock_outlet) AS stock_awal_ml FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
						WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".($tahun)."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
						AND WEEK(c.tgl_callsheet,1)='".($i-1)."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."'");
					$buy_awal = $this->db->query("SELECT SUM(a.buy_outlet) AS buy_awal FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
						WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".($tahun)."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
						AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."'");
					$stok_awal = $this->db->query("SELECT SUM(a.stock_outlet) AS stok_awal FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
						WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".($tahun)."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
						AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."'");
				} else{
					$stock_awal_ml = $this->db->query("SELECT SUM(a.stock_outlet) AS stock_awal_ml FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
						WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".($tahun)."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
						AND WEEK(c.tgl_callsheet,1)='".($i-1)."' AND e.id_sub_territory = '".$sub."'");
					$buy_awal = $this->db->query("SELECT SUM(a.buy_outlet) AS buy_awal FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
						WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".($tahun)."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
						AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."'");
					$stok_awal = $this->db->query("SELECT SUM(a.stock_outlet) AS stok_awal FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
						WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".($tahun)."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
						AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."'");
				}
			}
			foreach($stock_awal_ml->result_array() as $r){ $stock_awal_ml = $r['stock_awal_ml'];}
			foreach($buy_awal->result_array() as $r){ $buy_awal = $r['buy_awal']; }
			foreach($stok_awal->result_array() as $r){ $stock_awal = $r['stok_awal']; }
			$potential = ($stock_awal_ml + $buy_awal) - $stock_awal;
			$rows1['data'][] = $potential;
			$i++;
			
		}
		$rslt = array();
		array_push($rslt, $rows);
		array_push($rslt, $rows1);
		print json_encode($rslt, JSON_NUMERIC_CHECK);
	}
	public function grafik_vis(){
		$tahun 			= $_GET['tahun'];
		$sub 			= $_GET['sub'];
		$distrik		= $_GET['distrik'];
		$rute			= $_GET['rute'];
		$jenis_outlet 	= $_GET['jenis_outlet'];
		if(isset($_GET['brand'])){
			$brand = $_GET['brand'];
		}
		$week=53;
		$this->load->model("model_karyawan",'',TRUE);
		//low
		$rows = array();
		$rows1 = array();
		$rows2 = array();
		$rows['name'] = 'LOW';
		$i=1;
		$week_grafik=$week;
		while($i<=$week)
		{
		if($rute>0){
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and c.id_rute = '".$rute."' 
		and e.jenis_outlet like '%RETAIL%' ");
		} elseif($distrik>0){
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and b.id_distrik = '".$distrik."' 
		and e.jenis_outlet like '%RETAIL%' ");
		}
		else {
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and a.id_sub_territory = '".$sub."' 
		and e.jenis_outlet like '%RETAIL%' ");
		}	
			if(isset($_GET['brand'])){
				if($rute>0){
				$low = $this->db->query("SELECT SUM(a.low) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."'
					AND a.id_brand='".$brand."' AND c.status='Closed'");
				}elseif($distrik>0){
				$low = $this->db->query("SELECT SUM(a.low) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."'
					AND a.id_brand='".$brand."' AND c.status='Closed'");
				}else{
				$low = $this->db->query("SELECT SUM(a.low) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."'
					AND a.id_brand='".$brand."' AND c.status='Closed'");
				}
			} else{
				if($rute>0){
				$low = $this->db->query("SELECT SUM(a.low) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND c.status='Closed'");
				}elseif($distrik>0){
				$low = $this->db->query("SELECT SUM(a.low) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND c.status='Closed'");
				}else{
				$low = $this->db->query("SELECT SUM(a.low) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND c.status='Closed'");
				}
			}
			foreach($to->result_array() as $to){$to1 = $to['total'];}
			foreach($low->result_array() as $r){
				$rows['data'][] = number_format($r['visibility']);
				if ($tahun>=2016) { $rows['week_grafik'][] = $i+1; }else{ $rows['week_grafik'][] = $i; }
			}
			$i++;
			
		}
		$rows1['name'] = 'MIDDLE';
		$i=1;
		$week_grafik=$week;
		while($i<=$week)
		{
			if(isset($_GET['brand'])){
				if($rute>0){
				$middle = $this->db->query("SELECT SUM(a.mid) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."'
					AND a.id_brand='".$brand."' AND c.status='Closed'");
				}elseif($distrik>0){
				$middle = $this->db->query("SELECT SUM(a.mid) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."'
					AND a.id_brand='".$brand."' AND c.status='Closed'");
				}else{
				$middle = $this->db->query("SELECT SUM(a.mid) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."'
					AND a.id_brand='".$brand."' AND c.status='Closed'");
				}
			} else{
				if($rute>0){
				$middle = $this->db->query("SELECT SUM(a.mid) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND c.status='Closed'");
				}elseif($distrik>0){
				$middle = $this->db->query("SELECT SUM(a.mid) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND c.status='Closed'");
				}else{
				$middle = $this->db->query("SELECT SUM(a.mid) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND c.status='Closed'");
				}
			}
			foreach($middle->result_array() as $r){
				$rows1['data'][] = number_format($r['visibility']);
			}
			$i++;
			
		}
		$rows2['name'] = 'HIGHT';
		$i=1;
		$week_grafik=$week;
		while($i<=$week)
		{
			if(isset($_GET['brand'])){
				if($rute>0){
				$hig = $this->db->query("SELECT SUM(a.hig) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."'
					AND a.id_brand='".$brand."' AND c.status='Closed'");
				}elseif($distrik>0){
				$hig = $this->db->query("SELECT SUM(a.hig) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."'
					AND a.id_brand='".$brand."' AND c.status='Closed'");
				}else{
				$hig = $this->db->query("SELECT SUM(a.hig) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."'
					AND a.id_brand='".$brand."' AND c.status='Closed'");
				}
			} else{
				if($rute>0){
				$hig = $this->db->query("SELECT SUM(a.hig) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND c.status='Closed'");
				}elseif($distrik>0){
				$hig = $this->db->query("SELECT SUM(a.hig) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND c.status='Closed'");
				}else{
				$hig = $this->db->query("SELECT SUM(a.hig) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND c.status='Closed'");
				}
			}
			foreach($hig->result_array() as $r){
				$rows2['data'][] = number_format($r['visibility']);
			}
			$i++;
			
		}
		$rslt = array();
		array_push($rslt, $rows);
		array_push($rslt, $rows1);
		array_push($rslt, $rows2);
		print json_encode($rslt, JSON_NUMERIC_CHECK);
	}
	public function grafik_volstock(){
		$tahun 			= $_GET['tahun'];
		$sub 			= $_GET['sub'];
		$distrik		= $_GET['distrik'];
		$rute			= $_GET['rute'];
		$jenis_outlet 	= $_GET['jenis_outlet'];
		if(isset($_GET['brand'])){
			$brand = $_GET['brand'];
		}
		$week=53;
		$this->load->model("model_karyawan",'',TRUE);
//vol
		$rows = array();
		$rows1 = array();
		$rows['name'] = 'VOL';
		$i=1;
		if ($tahun>=2016) { $rows['week_grafik'][] = 1; $rows['data'][] = 0; $rows1['data'][] = 0; }
		$week_grafik=$week;
		while($i<=$week)
		{
		if($rute>0){
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and c.id_rute = '".$rute."' 
		and e.jenis_outlet like '%RETAIL%' ");
		} elseif($distrik>0){
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and b.id_distrik = '".$distrik."' 
		and e.jenis_outlet like '%RETAIL%' ");
		}
		else {
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and a.id_sub_territory = '".$sub."' 
		and e.jenis_outlet like '%RETAIL%' ");
		}	
			if(isset($_GET['brand'])){
				if($rute>0){
				$vol = $this->db->query("SELECT SUM(a.buy) AS vol FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND a.id_brand='".$brand."' and c.status='Closed'");
				}elseif($distrik>0){
				$vol = $this->db->query("SELECT SUM(a.buy) AS vol FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND a.id_brand='".$brand."' and c.status='Closed'");
				}else{
				$vol = $this->db->query("SELECT SUM(a.buy) AS vol FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."' and c.status='Closed'");
				}
			} else{
				if($rute>0){
				$vol = $this->db->query("SELECT SUM(a.buy) AS vol FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND c.status='Closed'");
				}elseif($distrik>0){
				$vol = $this->db->query("SELECT SUM(a.buy) AS vol FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND c.status='Closed'");
				}else{
				$vol = $this->db->query("SELECT SUM(a.buy) AS vol FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND c.status='Closed'");
				}
			}
			
			foreach($vol->result_array() as $r){
				if ($r['vol']==0){
					$rows['data'][] = '0';
				}else{
					$rows['data'][] = $r['vol'];
				}
			}
			if ($tahun>=2016) { $rows['week_grafik'][] = $i+1; }else{ $rows['week_grafik'][] = $i; }
			$i++;
			
		}
//stock
		$rows1['name'] = 'STOCK';
		$i=1;
		$week_grafik=$week;
		while($i<=$week)
		{
			if(isset($_GET['brand'])){
				if($rute>0){
				$stock = $this->db->query("SELECT SUM(a.stock) AS stock FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND a.id_brand='".$brand."' and c.status='Closed'");
				}elseif($distrik>0){
				$stock = $this->db->query("SELECT SUM(a.stock) AS stock FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND a.id_brand='".$brand."' and c.status='Closed'");
				}else{
				$stock = $this->db->query("SELECT SUM(a.stock) AS stock FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."' and c.status='Closed'");
				}
			} else{
				if($rute>0){
				$stock = $this->db->query("SELECT SUM(a.stock) AS stock FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND c.status='Closed'");
				}elseif($distrik>0){
				$stock = $this->db->query("SELECT SUM(a.stock) AS stock FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND c.status='Closed'");
				}else{
				$stock = $this->db->query("SELECT SUM(a.stock) AS stock FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND c.status='Closed'");
				}
			}
			foreach($stock->result_array() as $r){
				if (is_null($r['stock'])){
					$rows1['data'][] = '0';
				}else{
					$rows1['data'][] = $r['stock'];
				}
			}
			$i++;
			
		}
		$rslt = array();
		array_push($rslt, $rows);
		array_push($rslt, $rows1);
		print json_encode($rslt, JSON_NUMERIC_CHECK);
	}
	public function grafik_visnvavb(){
		$tahun 			= $_GET['tahun'];
		$sub 			= $_GET['sub'];
		$distrik		= $_GET['distrik'];
		$rute			= $_GET['rute'];
		$jenis_outlet 	= $_GET['jenis_outlet'];
		if(isset($_GET['brand'])){
			$brand = $_GET['brand'];
		}
		$week=53;
		$this->load->model("model_karyawan",'',TRUE);
//visibility
		$rows = array();
		$rows1 = array();
		$rows2 = array();
		$rows['name'] = 'VISIBILITY';
		$i=1;
		if ($tahun>=2016) { $rows['week_grafik'][] = 1; $rows['data'][] = 0; $rows1['data'][] = 0; $rows2['data'][] = 0; }
		$week_grafik=$week;
		while($i<=$week)
		{
		if($rute>0){
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and c.id_rute = '".$rute."' 
		and e.jenis_outlet like '%RETAIL%' ");
		} elseif($distrik>0){
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and b.id_distrik = '".$distrik."' 
		and e.jenis_outlet like '%RETAIL%' ");
		}
		else {
		$to=$this->db->query("SELECT COUNT(d.id_outlet) AS total FROM tabel_sub_territory a, tabel_distrik b, tabel_rute c, tabel_outlet d, tabel_tipe_distrik e 
		where a.id_sub_territory=b.id_sub_territory and b.id_distrik=c.id_distrik and c.id_rute=d.id_rute and b.id_tipe_distrik=e.id_tipe_distrik and a.id_sub_territory = '".$sub."' 
		and e.jenis_outlet like '%RETAIL%' ");
		}
			if(isset($_GET['brand'])){
				if($rute>0){
				$vis = $this->db->query("SELECT SUM(a.low+a.mid+a.hig) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}elseif($distrik>0){
				$vis = $this->db->query("SELECT SUM(a.low+a.mid+a.hig) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}else{
				$vis = $this->db->query("SELECT SUM(a.low+a.mid+a.hig) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}
			} else{
				if($rute>0){
				$vis = $this->db->query("SELECT SUM(a.low+a.mid+a.hig) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND c.status='Closed'");
				}elseif($distrik>0){
				$vis = $this->db->query("SELECT SUM(a.low+a.mid+a.hig) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND c.status='Closed'");
				}else{
				$vis = $this->db->query("SELECT SUM(a.low+a.mid+a.hig) AS visibility  FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND c.status='Closed'");
				}
			}
			foreach($to->result_array() as $to){$to1 = $to['total'];}
			foreach($vis->result_array() as $r){
				if (is_null($r['visibility'])){
					$rows['data'][] = '0';
				}else{
					$rows['data'][] = number_format((float)($r['visibility']/$to1)*100, 2, '.', '');
				}
				if ($tahun>=2016) { $rows['week_grafik'][] = $i+1; }else{ $rows['week_grafik'][] = $i; }
			}
			$i++;
			
		}
//nv
		$rows1['name'] = 'NV';
		$i=1;
		$week_grafik=$week;
		while($i<=$week)
		{
		
			if(isset($_GET['brand'])){
				if($rute>0){
				$nv = $this->db->query("SELECT sum(a.nv) AS nv FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}elseif($distrik>0){
				$nv = $this->db->query("SELECT sum(a.nv) AS nv FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}else{
				$nv = $this->db->query("SELECT sum(a.nv) AS nv FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND a.id_brand='".$brand."' AND c.status='Closed'");
				}
			} else{
				if($rute>0){
				$nv = $this->db->query("SELECT sum(a.nv) AS nv FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' AND c.status='Closed'");
				}elseif($distrik>0){
				$nv = $this->db->query("SELECT sum(a.nv) AS nv FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_distrik = '".$distrik."' AND c.status='Closed'");
				}else{
				$nv = $this->db->query("SELECT sum(a.nv) AS nv FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' AND c.status='Closed'");
				}
			}
			foreach($nv->result_array() as $r){
				$rows1['data'][] = number_format((float)($r['nv']/$to1)*100, 2, '.', '');
			}
			$i++;
			
		}
//avb
		$rows2['name'] = 'AVB';
		$i=1;
		$week_grafik=$week;
		while($i<=$week)
		{
			
			if(isset($_GET['brand'])){
				if($rute>0){
				$avb = $this->db->query("SELECT sum(a.sk+a.sl+a.sd+a.oos+a.sb) AS avb FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND a.id_brand='".$brand."' AND d.id_rute = '".$rute."' and c.status='Closed'");
				}elseif($distrik>0){
				$avb = $this->db->query("SELECT sum(a.sk+a.sl+a.sd+a.oos+a.sb) AS avb FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND a.id_brand='".$brand."' AND e.id_distrik = '".$distrik."' and c.status='Closed'");
				}else{
				$avb = $this->db->query("SELECT sum(a.sk+a.sl+a.sd+a.oos+a.sb) AS avb FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND a.id_brand='".$brand."' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
				}
			} else{
				if($rute>0){
				$avb = $this->db->query("SELECT sum(a.sk+a.sl+a.sd+a.oos+a.sb) AS avb FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND d.id_rute = '".$rute."' and c.status='Closed'");
				}elseif($distrik>0){
				$avb = $this->db->query("SELECT sum(a.sk+a.sl+a.sd+a.oos+a.sb) AS avb FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."'AND e.id_distrik = '".$distrik."' and c.status='Closed'");
				}else{
				$avb = $this->db->query("SELECT sum(a.sk+a.sl+a.sd+a.oos+a.sb) AS avb FROM tabel_callsheet_detil a, tabel_callsheet c, tabel_rute d, tabel_distrik e, tabel_tipe_distrik f 
					WHERE a.id_callsheet=c.id_callsheet AND YEAR(c.tgl_callsheet)='".$tahun."' and c.id_rute=d.id_rute and d.id_distrik = e.id_distrik and e.id_tipe_distrik=f.id_tipe_distrik and f.jenis_outlet like '%".$jenis_outlet."%'
					AND WEEK(c.tgl_callsheet,1)='".$i."' AND e.id_sub_territory = '".$sub."' and c.status='Closed'");
				}
			}
			
			foreach($avb->result_array() as $avb){$avb1 = $avb['avb'];}

			if($avb1==0){
				$rows2['data'][] = 0;
			}else {
				$ec = ($avb1/$to1)*100;
				$rows2['data'][] = number_format((float)$ec, 2, '.', '');
			}
			$i++;
		}
		$rslt = array();
		array_push($rslt, $rows);
		array_push($rslt, $rows1);
		array_push($rslt, $rows2);
		print json_encode($rslt, JSON_NUMERIC_CHECK);
	}
	public function input(){
		$tipe= $this->input->post('tipe');
		if ($tipe != ""){
			$this->load->model("model_karyawan",'',TRUE);
			$this->load->model("model_area_office",'',TRUE);
			$data['ao']=$this->model_area_office->lihat();
			$data['title']="PT. Surya Mustika Lampung";
			$data['tipe']=$this->input->post('tipe');
			$data['user']=$this->session->userdata('username');
			$data['level']=$this->session->userdata('level');
			if($tipe=="retail"){
				$this->load->view('admin/header',$data);
				$this->load->view('admin/callsheet/retail',$data);
				$this->load->view('admin/footer',$data);
			} elseif($tipe=="semi"){
				$this->load->view('admin/header',$data);
				$this->load->view('admin/callsheet/semi',$data);
				$this->load->view('admin/footer',$data);
			} elseif($tipe=="so"){
				$this->load->view('admin/header',$data);
				$this->load->view('admin/callsheet/so',$data);
				$this->load->view('admin/footer',$data);
			} elseif($tipe=="sa"){
				$this->load->view('admin/header',$data);
				$this->load->view('admin/callsheet/sa',$data);
				$this->load->view('admin/footer',$data);
			}
		}else{ 
		redirect('callsheet','refresh'); 
		}
	}
	public function lihat_grafik(){
		$tipe= $this->input->post('tipe');
		if ($tipe != ""){
			$data['title']="PT. Surya Mustika Lampung";
			$data['user']=$this->session->userdata('username');
			$data['level']=$this->session->userdata('level');
			if($tipe=="5"){
				redirect('callsheet/grafik_retail','refresh');
			} elseif($tipe=="8"){
				redirect('callsheet/grafik_semi','refresh');
			} elseif($tipe=="6"){
				redirect('callsheet/grafik_so','refresh');
			} elseif($tipe=="7"){
				redirect('callsheet/grafik_sa','refresh');
			}
		} else{ redirect('callsheet/grafik','refresh'); }
	}
	public function grafik_retail(){
		$this->load->model("model_area_office",'',TRUE);
		$data['ao']=$this->model_area_office->lihat();
		$this->load->model("model_brand",'',TRUE);
		$data['brand']=$this->model_brand->lihat();
		$this->load->model("model_territory",'',TRUE);
		$data['territory']=$this->model_territory->lihat();
		$sub= $this->input->post('sub');
		$this->load->model("model_sub_territory",'',TRUE);
		$data['sub_territory']=$this->model_sub_territory->ubah($sub);
		$data['title']="PT. Surya Mustika Lampung";
		$data['user']=$this->session->userdata('username');
		$data['level']=$this->session->userdata('level');
		$this->load->view('admin/callsheet/grafik_retail',$data);
	}
	public function grafik_semi(){
		$this->load->model("model_area_office",'',TRUE);
		$data['ao']=$this->model_area_office->lihat();
		$this->load->model("model_brand",'',TRUE);
		$data['brand']=$this->model_brand->lihat();
		$this->load->model("model_territory",'',TRUE);
		$data['territory']=$this->model_territory->lihat();
		$sub= $this->input->post('sub');
		$this->load->model("model_sub_territory",'',TRUE);
		$data['sub_territory']=$this->model_sub_territory->ubah($sub);
		$data['title']="PT. Surya Mustika Lampung";
		$data['user']=$this->session->userdata('username');
		$data['level']=$this->session->userdata('level');
		$this->load->view('admin/callsheet/grafik_semi',$data);
	}
	public function grafik_so(){
		$this->load->model("model_area_office",'',TRUE);
		$data['ao']=$this->model_area_office->lihat();
		$this->load->model("model_brand",'',TRUE);
		$data['brand']=$this->model_brand->lihat();
		$this->load->model("model_territory",'',TRUE);
		$data['territory']=$this->model_territory->lihat();
		$sub= $this->input->post('sub');
		$this->load->model("model_sub_territory",'',TRUE);
		$data['sub_territory']=$this->model_sub_territory->ubah($sub);
		$data['title']="PT. Surya Mustika Lampung";
		$data['user']=$this->session->userdata('username');
		$data['level']=$this->session->userdata('level');
		$this->load->view('admin/callsheet/grafik_so',$data);
	}
	public function grafik_sa(){
		$this->load->model("model_area_office",'',TRUE);
		$data['ao']=$this->model_area_office->lihat();
		$this->load->model("model_brand",'',TRUE);
		$data['brand']=$this->model_brand->lihat();
		$this->load->model("model_territory",'',TRUE);
		$data['territory']=$this->model_territory->lihat();
		$sub= $this->input->post('sub');
		$this->load->model("model_sub_territory",'',TRUE);
		$data['sub_territory']=$this->model_sub_territory->ubah($sub);
		$data['title']="PT. Surya Mustika Lampung";
		$data['user']=$this->session->userdata('username');
		$data['level']=$this->session->userdata('level');
		$this->load->view('admin/callsheet/grafik_sa',$data); 
	}
	public function check(){
		if ($this->input->post('submit') == "simpan")
		{
			$tgl_callsheet= $this->input->post('tgl_callsheet');
			$tahun=substr($tgl_callsheet, 6,4);
			$bulan=substr($tgl_callsheet, 3,2);
			$tgl=substr($tgl_callsheet, 0,2);
			$tgl_callsheet = $tahun."-".$bulan."-".$tgl;
			if( strtotime($tgl_callsheet) <= strtotime('now') ) {
				$this->load->model("model_callsheet");
				$lihat=$this->model_callsheet->check();
				foreach($lihat->result_array() as $tampil){
					$id=$tampil['id_callsheet'];
					$status=$tampil['status'];
					$data['id']=$tampil['id_callsheet'];
				}
				if($status == "Open" || $status == ""){
					redirect('callsheet/lihat_data/'.$id.'','refresh');
				}else{ echo "<script> alert ('Maaf callsheet sudah diinput untuk tanggal ini dan sudah closed..'); location.href='./'</script>"; }
			} else{
				echo "<script> alert ('Maaf tanggal callsheet tidak boleh melebihi hari ini, silakan ulangi kembali proses input callsheet..'); location.href='./'</script>";
			}
		} else {
			$data['title']="PT. Surya Mustika Lampung";
			$data['user']=$this->session->userdata('username');
			$data['level']=$this->session->userdata('level');
			$this->load->view('admin/header',$data);
			$this->load->view('admin/callsheet/input',$data);
			$this->load->view('admin/footer',$data);
		}
	}
	public function lihat_data($id_callsheet){
		$this->load->model("model_callsheet");
		$data['callsheet'] = $this->model_callsheet->lihat_data($id_callsheet); 
		$data['title']="PT. Surya Mustika Lampung";
		$data['user']=$this->session->userdata('username');
		$data['level']=$this->session->userdata('level');
		$this->load->view('admin/header',$data);
		$this->load->view('admin/callsheet/lihat_data',$data);
		$this->load->view('admin/footer',$data);
	}
	public function cancel($id_callsheet){
		$this->load->model("model_callsheet");
		$this->model_callsheet->cancel($id_callsheet);
		$this->session->set_flashdata('info','<div class="alert alert-success alert-dismissable" style="width:30%">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<h4><i class="icon fa fa-check"></i> Informasi!</h4>Anda sudah membatalkan input callsheet</div>');
		redirect('callsheet','refresh');
	}
	public function tutup_callsheet($id_callsheet){
		//fungsi sebelum ditutup
		$this->load->model("model_callsheet",'',TRUE);
		$totk=$this->model_callsheet->totk($id_callsheet);
		foreach($totk->result_array() as $tampil){
		$totk=$tampil['total_kunjungan'];
		}
		$totk = $totk;
		
		$tosum1=$this->model_callsheet->tosum1($id_callsheet);
		foreach($tosum1->result_array() as $tampil){
			if ($tampil['ItemSum']!=$totk) {
				echo "<script> alert ('Jumlah total data di KOLOM NOTASI DISTRIBUSI tidak sama dengan Jumlah TOTAL KUNJUNGAN, mohon dicek kembali..'); window.location.replace('".base_url()."callsheet/ic/$id_callsheet');</script>";
			}
		}
		 
		$tosum2=$this->model_callsheet->tosum2($id_callsheet);
		foreach($tosum2->result_array() as $tampil){
			if ($tampil['ItemSum']!=$totk) {
				echo "<script> alert ('Jumlah total data di KOLOM VISIBILITY tidak sama dengan Jumlah TOTAL KUNJUNGAN, mohon dicek kembali..'); window.location.replace('".base_url()."callsheet/ic/$id_callsheet');</script>";
			}
		}
		
		foreach($tosum2->result_array() as $tampil){$vis = $tampil['ItemSum'];}
		foreach($tosum1->result_array() as $tampil1){$not = $tampil1['ItemSum'];}
		if(($vis==$totk)and($not==$totk)){
		$cek = $this->db->query("UPDATE tabel_callsheet SET status='Closed' where id_callsheet='".$id_callsheet."'");
		$this->model_callsheet->tutup($id_callsheet);
		$this->session->set_flashdata('info','<div class="alert alert-success alert-dismissable" style="width:30%">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4><i class="icon fa fa-check"></i> Informasi!</h4>Data Berhasil Diinput</div>');
		redirect('callsheet','refresh');
		}
	}
	public function bs(){
		
		$this->load->model("model_callsheet",'',TRUE);
		$data['callsheet']=$this->model_callsheet->bs1();
		$data['title']="PT. Surya Mustika Lampung";
		$data['user']=$this->session->userdata('username');
		$data['level']=$this->session->userdata('level');
		$this->load->view('admin/header',$data);
		$this->load->view('admin/callsheet/bs',$data);
		$this->load->view('admin/footer');
		
	}
	public function input_data(){
		$this->load->model("model_callsheet",'',TRUE);
		$lihat = $this->model_callsheet->input_data(); 

		foreach($lihat->result_array() as $tampil){
			$id	=$tampil['id_callsheet'];
			$rute	=$tampil['id_rute'];
		}
		redirect('callsheet/ic/'.$id.'','refresh');
	}
	public function input_callsheet($id_callsheet){
		$id_callsheet= $this->uri->segment(3);
		$this->load->model("model_brand",'',TRUE);
		$data['brand']=$this->model_brand->lihat();
		$data['notasi']=$this->model_brand->lihat();
		$data['total_outlet']=$this->db->query("select count(distinct(a.id_outlet)) as total from tabel_outlet a, tabel_rute b, tabel_callsheet c
			where a.id_rute=b.id_rute and b.id_rute=c.id_rute and c.id_callsheet='".$id_callsheet."'");
		$data['total_kunjungan']=$this->db->query("SELECT COUNT(DISTINCT(a.id_callsheet_outlet)) AS total FROM tabel_callsheet_detil a, tabel_callsheet c
		WHERE (a.notasi_outlet <> '' OR a.visibility_outlet <> '' OR a.stock_outlet <> '0' OR a.buy_outlet <> '0') AND b.id_callsheet=c.id_callsheet AND c.id_callsheet='".$id_callsheet."'");
		$this->load->model("model_callsheet");
		$data['callsheet'] = $this->model_callsheet->lihat_data($id_callsheet);
		$data['outlet']= $this->model_callsheet->lihat_outlet($id_callsheet);
		$data['stock']= $this->model_callsheet->lihat_stock($id_callsheet);
		$data['stock1']= $this->model_callsheet->lihat_stock1($id_callsheet);
		$data['stock2']= $this->model_callsheet->lihat_stock2($id_callsheet);
		$data['title']="PT. Surya Mustika Lampung";
		$data['user']=$this->session->userdata('username');
		$data['level']=$this->session->userdata('level');
		$jenis_distrik=$this->db->query("select * from  tabel_tipe_distrik h, tabel_callsheet g, tabel_karyawan f, tabel_rute e, tabel_distrik a, tabel_sub_territory b, tabel_territory c, tabel_area_office d
			where g.id_callsheet='".$id_callsheet."' AND a.id_tipe_distrik=h.id_tipe_distrik and g.id_rute=e.id_rute and f.nik=a.id_karyawan and e.id_distrik=a.id_distrik and a.id_sub_territory=b.id_sub_territory and b.id_territory=c.id_territory and c.id_ao=d.id_ao order by kode_distrik ASC");
		foreach($jenis_distrik->result_array() as $row) { $data['jenis'] = $row['jenis_outlet'];}	
		$jenis = strtolower($data['jenis']);
		$view = "admin/callsheet/input_callsheet_".$jenis."";
		$this->load->view($view,$data);
	}
	public function get_notasi(){
		$this->load->model('model_notasi');
		$categories = $this->model_notasi->get();
		echo json_encode($categories);
	}
	public function get_visibility(){
		$this->load->model('model_visibility');
		$categories = $this->model_visibility->get();
		echo json_encode($categories);
	}
	public function get_callsheet_detail(){
		$id_callsheet_outlet=$this->uri->segment(3);
		$id_outlet=$this->uri->segment(4);
		$this->load->library('datatables');
		$cek=$this->db->query("SELECT * FROM tabel_outlet a, tabel_rute b, tabel_distrik c, tabel_tipe_distrik d
			WHERE a.`id_rute`=b.`id_rute` AND b.`id_distrik` = c.`id_distrik`
			AND c.`id_tipe_distrik`=d.`id_tipe_distrik` AND a.`id_outlet`='".$id_outlet."'");
		foreach($cek->result_array() as $row) { $data['jenis'] = $row['jenis_outlet'];}	
// $result = $this->datatables->getData('v_product', array('', 'code', 'code', 'description', 'price'), 'code', true);
		if($data['jenis'] == "RETAIL"){
			$result = $this->datatables->getDataRetail(array('tabel_callsheet_detil', 'tabel_brand'), array('', 'id_callsheet_detail','tabel_brand.id_brand', 'nama_brand', 'stock_outlet', 'buy_outlet', 'nama_notasi', 'nama_visibility'), 'id_callsheet_detail', true, $id_callsheet_outlet);
		} elseif($data['jenis'] == "SEMI"){
			$result = $this->datatables->getDataSemi(array('tabel_callsheet_detil', 'tabel_brand'), array('', 'id_callsheet_detail','tabel_brand.id_brand', 'nama_brand', 'stock_outlet', 'buy_outlet'), 'id_callsheet_detail', true, $id_callsheet_outlet);
		} elseif($data['jenis'] == "SO"){
			$result = $this->datatables->getDataSo(array('tabel_callsheet_detil', 'tabel_brand'), array('', 'id_callsheet_detail','tabel_brand.id_brand', 'nama_brand', 'stock_outlet', 'buy_outlet'), 'id_callsheet_detail', true, $id_callsheet_outlet);
		} elseif($data['jenis'] == "SA"){
			$result = $this->datatables->getDataSa(array('tabel_callsheet_detil', 'tabel_brand'), array('', 'id_callsheet_detail','tabel_brand.id_brand', 'nama_brand', 'stock_outlet', 'buy_outlet', 'retur_outlet'), 'id_callsheet_detail', true, $id_callsheet_outlet);
		}
		echo $result;
	}
	public function edit_callsheet_detail(){
		$code = $this->input->post('id_callsheet_detail');
		$attr = $this->input->post('columnname');
		$newval = $this->input->post('value');
		$cari_brand=$this->db->query("select * from tabel_callsheet_detil where id_callsheet_detail = '".$code."'");
		foreach($cari_brand->result_array() as $brand){ $id_brand = $brand['id_brand'];$id_callsheet_outlet = $brand['id_callsheet_outlet']; }
		if($attr=="buy_outlet"){
			$stock=$this->db->query("select stock_awal, stock_keluar, id_brand, b.id_callsheet from tabel_callsheet_outlet1 a, tabel_callsheet b, tabel_callsheet_stock c where a.id_callsheet=b.id_callsheet and b.id_callsheet=c.id_callsheet and
				a.id_callsheet_outlet='".$id_callsheet_outlet."' and c.id_brand='".$id_brand."'");
			foreach($stock->result_array() as $stock_brand){
				$sisa = $stock_brand['stock_awal']-$stock_brand['stock_keluar'];
				$id_callsheet = $stock_brand['id_callsheet'];
				$id_brand = $stock_brand['id_brand'];
				if($sisa>=$newval){
					echo $sisa;
					$this->load->model('model_detail_outlet');
					$this->model_detail_outlet->update($code, $attr, $newval);
					$this->db->query("UPDATE tabel_callsheet_stock SET stock_keluar=`stock_keluar`+'".$newval."' WHERE id_callsheet='".$id_callsheet."' and id_brand='".$id_brand."'");
				}
				else{
					$this->session->set_flashdata('info','<div class="alert alert-danger alert-dismissable" style="width:30%">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Informasi!</h4>Data gagal disimpan : tidak boleh lebih dari 6 rute pada distrik</div>');
				}
			}
		} else{
			$this->load->model('model_detail_outlet');
			$this->model_detail_outlet->update($code, $attr, $newval);
		}
	}
	public function hapus_detail(){
		$id_callsheet_outlet=$this->uri->segment(3);
		$id_outlet=$this->uri->segment(4);
		$id=$this->uri->segment(5);
		$id_callsheet=$this->uri->segment(6);
		$id_brand=$this->uri->segment(7);
		$buy=$this->uri->segment(8);

		$ubah=$this->db->query("UPDATE tabel_callsheet_stock SET stock_keluar=stock_keluar-$buy where id_callsheet=$id_callsheet and id_brand=$id_brand");
		$hapus=$this->db->query("DELETE FROM tabel_callsheet_detil where id_callsheet_detail='".$id."'");

		redirect('callsheet/isi_data/'.$id_callsheet_outlet.'/'.$id_outlet.'','refresh');
	}
	public function selesai(){
		$id_callsheet_outlet=$this->uri->segment(3);
		$id_outlet=$this->uri->segment(4);

		$tampil1=$this->db->query("SELECT count(id_brand) as brand from tabel_brand");
		foreach($tampil1->result_array() as $brand){
			$cek1=$this->db->query("select count(id_brand) as jumlah from tabel_callsheet_detil where id_callsheet_outlet='".$id_callsheet_outlet."'");
			foreach($cek1->result_array() as $cek){
				if($cek['jumlah']==$brand['brand']){
					echo "<script> window.close();window.opener.location.reload();</script>";
				} else {
					echo "<script> alert ('Maaf brand belum selesai di input, silakan input semua brand untuk menyelasaikan callsheet OUTLET ini..'); window.history.back();</script>";
				}

			}
		}

	}
	public function selesai_stock(){
		echo "<script> window.close();window.opener.location.reload();</script>";
	}
}
?>