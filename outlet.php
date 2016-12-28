<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Outlet extends CI_Controller {
	public function __construct()
	{
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
	public function lihat(){
		$this->load->model("model_tipe_distrik",'',TRUE);
		$data['tipe']=$this->model_tipe_distrik->lihat();
		$data['title']="PT. Surya Mustika Lampung";
		$data['user']=$this->session->userdata('username');
		$data['level']=$this->session->userdata('level');
		$this->load->view('admin/header',$data);
		$this->load->view('admin/outlet/lihat',$data);
		$this->load->view('admin/footer');
	}
	public function filter(){
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
			$this->load->view('admin/outlet/filter',$data);
			$this->load->view('admin/footer',$data);
		} else{ redirect('outlet/lihat','refresh'); }
	}
	function lihat_outlet(){
		if(isset($_GET['id_ao'])){ $id_ao = $_GET['id_ao']; $where = "j.id_ao ='".$id_ao."'"; $link = "id_ao=$id_ao"; }
		if(isset($_GET['id_to'])){ $id_to = $_GET['id_to']; $where = "i.id_territory ='".$id_to."'"; $link = "id_to=$id_to"; }
		if(isset($_GET['id_sub'])){ $id_sub = $_GET['id_sub']; $where = "c.id_sub_territory ='".$id_sub."'"; $link = "id_sub=$id_sub"; }
		if(isset($_GET['id_distrik'])){ $id_distrik = $_GET['id_distrik']; $where = "b.id_distrik='".$id_distrik."'"; $link = "id_distrik=$id_distrik";}
		if(isset($_GET['id_rute'])){ $id_rute = $_GET['id_rute']; $where = "b.id_rute='".$id_rute."' and b.id_distrik='".$id_distrik."'"; $link = "id_rute=$id_rute&id_distrik=$id_distrik";}
		if(isset($_GET['tipe'])){ $tipe = $_GET['tipe']; }
		$outlet = $this->db->query("SELECT * FROM `tabel_outlet` a 
			INNER JOIN `tabel_rute` b ON (a.`id_rute` = b.`id_rute`) 
			LEFT JOIN `tabel_distrik` c ON (b.`id_distrik` = c.`id_distrik`) 
			LEFT JOIN `tabel_sub_territory` i ON (c.`id_sub_territory` = i.`id_sub_territory`) 
			LEFT JOIN `tabel_territory` j ON (i.`id_territory` = j.`id_territory`) 
			LEFT JOIN `tabel_area_office` k ON (j.`id_ao` = k.`id_ao`) 
			LEFT JOIN `tabel_tipe_distrik` h ON (c.`id_tipe_distrik` = h.`id_tipe_distrik`) 
			LEFT JOIN `tabel_kel_desa` d ON (a.`id_kel_desa` = d.`id_kel_desa`) 
			LEFT JOIN `tabel_kecamatan` e ON (d.`id_kecamatan` = e.`id_kecamatan`) 
			LEFT JOIN `tabel_tipe_outlet` f ON (a.`id_tipe_outlet` = f.`id_tipe_outlet`) 
			WHERE
			$where and h.jenis_outlet like '%".$tipe."%' GROUP BY a.id_outlet");
		 if($outlet->num_rows() > 10000){
		 	$list_to = $this->db->query("SELECT DISTINCT(j.`id_territory`),j.`nama_territory` FROM `tabel_outlet` a 
			INNER JOIN `tabel_rute` b ON (a.`id_rute` = b.`id_rute`) 
			LEFT JOIN `tabel_distrik` c ON (b.`id_distrik` = c.`id_distrik`) 
			LEFT JOIN `tabel_sub_territory` i ON (c.`id_sub_territory` = i.`id_sub_territory`) 
			LEFT JOIN `tabel_territory` j ON (i.`id_territory` = j.`id_territory`) 
			LEFT JOIN `tabel_area_office` k ON (j.`id_ao` = k.`id_ao`) 
			LEFT JOIN `tabel_tipe_distrik` g ON (c.`id_tipe_distrik` = g.`id_tipe_distrik`) 
			WHERE
			$where and g.jenis_outlet like '%".$tipe."%' GROUP BY a.id_outlet");
			$i=1;
			foreach ($list_to->result() as $k) {
				$id_to = $k->id_territory;
				$link = "id_to=$id_to";
				echo "".$i."&nbsp;<a target='_blank' href='".base_url()."outlet/export/?".$link."&tipe=".$tipe."'><img width='30' src='".base_url()."asset/images/excel.png'> ".$k->nama_territory."</a> <br>";
				$i++;
			}
				echo "<br>Kapasitas ukuran data terlalu besar untuk di tampilkan dan melibihi 10.000 baris data.";
				echo "<br>Silahkan download data outlet dari setiap Territory (TO) dalam format Excel yang tertera diatas.";
		  } else {
				echo "<a target='_blank' href='".base_url()."outlet/export/?".$link."&tipe=".$tipe."'><img width='30' src='".base_url()."asset/images/excel.png'> Export to Excel</a>";
				echo "<table class='table table-bordered table-striped' border='1' width=100%>";
				echo "<thead>
				<tr align='center' bgcolor='227788'>
				<th width='5%'><font color='white'>NO</font></th>
				<th width='15%'><font color='white'>NAMA OUTLET</font></th>
				<th width='15%'><font color='white'>NAMA PEMILIK</font></th>
				<th width='15%'><font color='white'>ALAMAT</font></th>
				<th width='15%'><font color='white'>KELURAHAN</font></th>
				<th width='15%'><font color='white'>KECAMATAN</font></th>
				<th width='5%'><font color='white'>TYPE OUTLET</font></th>
				</tr>
				</thead><tbody>";
				$i = 1;
				foreach ($outlet->result() as $k)
				{
					echo "<tr>";
					echo "<td align='center'>".$i."</td>";
					echo "<td align='left'>".$k->nama_outlet."</td>";
					echo "<td align='left'>".$k->nama_pemilik."</td>";
					echo "<td align='left'>".$k->alamat_outlet."</td>";
					echo "<td align='center'>".$k->kel_desa."</td>";
					echo "<td align='center'>".$k->kecamatan."</td>";
					echo "<td align='center'>";
					if($k->jenis_outlet == "SA"){ echo "SA"; }else{ echo $k->tipe_outlet; }
					echo "</td>";
					echo "</tr>";
					$i++;
				}
				echo "</tbody></table>";	
		    }
	}
	function lihat_outlet_notasi(){
		if(isset($_GET['id_distrik'])){ $id_distrik = $_GET['id_distrik']; }
		if(isset($_GET['id_rute'])){ $id_rute = $_GET['id_rute']; }
		if(isset($_GET['tipe'])){ $tipe = $_GET['tipe']; }
		if(isset($_GET['id_brand'])){ $id_brand = $_GET['id_brand']; }
		if(isset($_GET['id_notasi'])){ $id_notasi = $_GET['id_notasi']; $where = "c.id_rute='".$id_rute."' and c.tgl_callsheet=(SELECT MAX(c.tgl_callsheet) from tabel_callsheet c where c.id_rute='".$id_rute."') and a.id_brand='".$id_brand."' and a.notasi_outlet='".$id_notasi."'"; $link = "id_rute=$id_rute&id_distrik=$id_distrik&id_brand=$id_brand&id_notasi=$id_notasi"; }
		$outlet = $this->db->query("SELECT *
			FROM tabel_callsheet_detil a
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
			LEFT JOIN `tabel_tipe_outlet` l ON (l.`id_tipe_outlet` = n.`id_tipe_outlet`)
			LEFT JOIN `tabel_tipe_distrik` m ON (m.`id_tipe_distrik` = e.`id_tipe_distrik`)
			WHERE
			$where and i.jenis_outlet like '%".$tipe."%' GROUP BY b.id_outlet");
		 if($outlet->num_rows() > 10000){
		 	$list_to = $this->db->query("SELECT DISTINCT(j.`id_territory`),j.`nama_territory` FROM `tabel_outlet` a
			INNER JOIN `tabel_rute` b ON (a.`id_rute` = b.`id_rute`)
			LEFT JOIN `tabel_distrik` c ON (b.`id_distrik` = c.`id_distrik`)
			LEFT JOIN `tabel_sub_territory` i ON (c.`id_sub_territory` = i.`id_sub_territory`)
			LEFT JOIN `tabel_territory` j ON (i.`id_territory` = j.`id_territory`)
			LEFT JOIN `tabel_area_office` k ON (j.`id_ao` = k.`id_ao`)
			LEFT JOIN `tabel_tipe_distrik` g ON (c.`id_tipe_distrik` = g.`id_tipe_distrik`)
			WHERE
			$where and i.jenis_outlet like '%".$tipe."%' GROUP BY b.id_outlet");
			$i=1;
			foreach ($list_to->result() as $k) {
				$id_to = $k->id_territory;
				$link = "id_to=$id_to";
				echo "".$i."&nbsp;<a target='_blank' href='".base_url()."outlet/export/?".$link."&tipe=".$tipe."'><img width='30' src='".base_url()."asset/images/excel.png'> ".$k->nama_territory."</a> <br>";
				$i++;
			}
				echo "<br>Kapasitas ukuran data terlalu besar untuk di tampilkan dan melibihi 10.000 baris data.";
				echo "<br>Silahkan download data outlet dari setiap Territory (TO) dalam format Excel yang tertera diatas.";
	    } else {
			echo "<a target='_blank' href='".base_url()."outlet/export/?".$link."&tipe=".$tipe."&notasi=true'><img width='30' src='".base_url()."asset/images/excel.png'> Export to Excel</a>";
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
			</tr>
			</thead><tbody>";
			$i = 1;
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
				echo "</tr>";
				$i++;
			}
			echo "</tbody></table>";	
	    }
	}
	public function export()
	{
		if(isset($_GET['id_ao'])){ $id_ao = $_GET['id_ao']; $where = "h.id_ao='".$id_ao."'"; }
		if(isset($_GET['id_to'])){ $id_to = $_GET['id_to']; $where = "g.id_territory='".$id_to."'"; }
		if(isset($_GET['id_sub'])){ $id_sub = $_GET['id_sub']; $where = "f.id_sub_territory='".$id_sub."'"; }
		if(isset($_GET['id_distrik'])){ $id_distrik = $_GET['id_distrik']; $where = "d.id_distrik='".$id_distrik."'"; }
		if(isset($_GET['id_rute'])){ $id_rute = $_GET['id_rute']; $where = "n.id_rute='".$id_rute."' and d.id_distrik='".$id_distrik."'"; }
		if(isset($_GET['id_brand'])){ $id_brand = $_GET['id_brand']; $data['brand'] = $_GET['id_brand']; }
		if(isset($_GET['id_notasi'])){ $id_notasi = $_GET['id_notasi']; $data['notasi'] = $_GET['id_notasi']; $where = "c.id_rute='".$id_rute."' and c.tgl_callsheet=(SELECT MAX(c.tgl_callsheet) from tabel_callsheet c where c.id_rute='".$id_rute."') and a.id_brand='".$id_brand."' and a.notasi_outlet='".$id_notasi."'"; }
		if(isset($_GET['tipe'])){ $tipe = $_GET['tipe']; }
		if (isset($_GET['id_notasi'])) {
			$data['outlet'] = $this->db->query("SELECT *
			FROM tabel_callsheet_detil a
			LEFT JOIN tabel_callsheet_outlet1 b ON (b.`id_callsheet_outlet` = a.`id_callsheet_outlet`)
			LEFT JOIN tabel_callsheet c ON (c.`id_callsheet` = b.`id_callsheet`)
			LEFT JOIN tabel_brand r ON (r.`id_brand` = a.`id_brand`)
			LEFT JOIN tabel_notasi s ON (s.`id` = a.`notasi_outlet`)
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
			$where and i.jenis_outlet like '%".$tipe."%' GROUP BY b.id_outlet");
		} else{
			$data['outlet'] = $this->db->query("SELECT * FROM `tabel_outlet` n
			INNER JOIN `tabel_rute` d ON (n.`id_rute` = d.`id_rute`) 
			LEFT JOIN `tabel_distrik` e ON (d.`id_distrik` = e.`id_distrik`) 
			LEFT JOIN `tabel_sub_territory` f ON (e.`id_sub_territory` = f.`id_sub_territory`) 
			LEFT JOIN `tabel_territory` g ON (f.`id_territory` = g.`id_territory`) 
			LEFT JOIN `tabel_area_office` h ON (g.`id_ao` = h.`id_ao`) 
			LEFT JOIN `tabel_tipe_distrik` i ON (e.`id_tipe_distrik` = i.`id_tipe_distrik`) 
			LEFT JOIN `tabel_kel_desa` j ON (n.`id_kel_desa` = j.`id_kel_desa`) 
			LEFT JOIN `tabel_kecamatan` k ON (j.`id_kecamatan` = k.`id_kecamatan`) 
			LEFT JOIN `tabel_kabupaten_kota` o ON (o.`id_kab_kota` = k.`id_kab_kota`)
			LEFT JOIN `tabel_provinsi` p ON (p.`id_provinsi` = o.`id_provinsi`)
			LEFT JOIN `tabel_karyawan` q ON (q.`nik` = e.`id_karyawan`)
			LEFT JOIN `tabel_tipe_outlet` l ON (n.`id_tipe_outlet` = l.`id_tipe_outlet`) 
			WHERE
			$where and i.jenis_outlet like '%".$tipe."%' GROUP BY n.id_outlet");
		}
		$this->load->view('admin/outlet/export',$data);
	}
	public function sub_agent(){
		$this->load->model("model_outlet",'',TRUE);
		$data['sub_agent']=$this->model_outlet->sub_agent();
		$data['title']="PT. Surya Mustika Lampung";
		$data['user']=$this->session->userdata('username');
		$data['level']=$this->session->userdata('level');
		$this->load->view('admin/header',$data);
		$this->load->view('admin/outlet/sub_agent',$data);
		$this->load->view('admin/footer');

	}
	public function semi(){
		$this->load->model("model_outlet",'',TRUE);
		$data['semi']=$this->model_outlet->semi();
		$data['title']="PT. Surya Mustika Lampung";
		$data['user']=$this->session->userdata('username');
		$data['level']=$this->session->userdata('level');
		$this->load->view('admin/header',$data);
		$this->load->view('admin/outlet/semi',$data);
		$this->load->view('admin/footer');

	}
	public function retail(){
		$this->load->model("model_outlet",'',TRUE);
		$data['retail']=$this->model_outlet->retail();
		$data['title']="PT. Surya Mustika Lampung";
		$data['user']=$this->session->userdata('username');
		$data['level']=$this->session->userdata('level');
		$this->load->view('admin/header',$data);
		$this->load->view('admin/outlet/retail',$data);
		$this->load->view('admin/footer');

	}
	public function detail($id_outlet){
		$this->load->model("model_area_office",'',TRUE);
		$data['ao']=$this->model_area_office->lihat();
		$this->load->model("model_provinsi",'',TRUE);
		$data['provinsi']=$this->model_provinsi->lihat();
		$this->load->model("model_tipe_outlet",'',TRUE);
		$data['tipe_outlet']=$this->model_tipe_outlet->lihat();
		$this->load->model("model_outlet",'',TRUE);
		$data['outlet'] = $this->model_outlet->ubah($id_outlet); 
		$data['title']="PT. Surya Mustika Lampung";
		$data['user']=$this->session->userdata('username');
		$data['level']=$this->session->userdata('level');
		$this->load->view('admin/header',$data);
		$this->load->view('admin/outlet/detail',$data);
		$this->load->view('admin/footer');

	}
	public function input(){
		$this->load->model("model_provinsi",'',TRUE);
		$data['provinsi']=$this->model_provinsi->lihat();
		$this->load->model("model_area_office",'',TRUE);
		$data['ao']=$this->model_area_office->lihat();
		$this->load->model("model_tipe_outlet",'',TRUE);
		$data['tipe_outlet']=$this->model_tipe_outlet->lihat();
		$data['title']="PT. Surya Mustika Lampung";
		$data['user']=$this->session->userdata('username');
		$data['level']=$this->session->userdata('level');
		$this->load->view('admin/header',$data);
		$this->load->view('admin/outlet/input',$data);
		$this->load->view('admin/footer',$data);
	}
//Menampilkan kabupaten
	function kabupaten(){
		$id_provinsi = $_GET['id'];
		$kabupaten  = $this->db->query("select * from tabel_kabupaten_kota where id_provinsi='".$id_provinsi."' order by kab_kota ASC");
		echo "<select name='kabupaten' id='kabupaten'>
		<option selected class='form-control' value=''>[Pilih Kabupaten]</option>";
		foreach ($kabupaten->result() as $k)
		{
			echo "<option class='form-control' value='$k->id_kab_kota'>$k->kab_kota</option>";
		}
		echo "</select>";
	}
	function kecamatan(){
		$id_kabupaten = $_GET['id'];
		$kecamatan = $this->db->query("select * from tabel_kecamatan where id_kab_kota='".$id_kabupaten."' order by kecamatan ASC");
		echo "<select name='kecamatan' id='kecamatan'>
		<option selected class='form-control' value=''>[Pilih Kecamatan]</option>";
		foreach ($kecamatan->result() as $k)
		{
			echo "<option class='form-control' value='$k->id_kecamatan'>$k->kecamatan</option>";
		}
		echo "</select>";
	}
	function kelurahan(){
		$id_kecamatan = $_GET['id'];
		$kelurahan = $this->db->query("select * from tabel_kel_desa where id_kecamatan='".$id_kecamatan."' order by kel_desa ASC");
		echo "<select name='kelurahan' id='kelurahan'>
		<option selected class='form-control' value=''>[Pilih Kelurahan]</option>";
		foreach ($kelurahan->result() as $k)
		{
			echo "<option class='form-control' value='$k->id_kel_desa'>$k->kel_desa</option>";
		}
		echo "</select>";
	}
//Menampilkan territory
	function territory(){
		$id_ao = $_GET['id'];
		$territory  = $this->db->query("select * from tabel_territory where id_ao='".$id_ao."' order by id_territory ASC");
		echo "<select name='to' id='to'>
		<option selected class='form-control' value=''>[Pilih Territory]</option>";
		foreach ($territory->result() as $k)
		{
			echo "<option class='form-control' value='$k->id_territory'>$k->nama_territory</option>";
		}
		echo "</select>";
	}
	function sub_territory(){
		$id_territory = $_GET['id'];
		$sub = $this->db->query("select * from tabel_sub_territory where id_territory='".$id_territory."' order by id_territory ASC");
		
		echo "<select name='sub' id='sub'>
		<option selected class='form-control' value=''>[Pilih Sub Territory]</option>";
		foreach ($sub->result() as $k)
		{
			echo "<option class='form-control' value='$k->id_sub_territory'>$k->nama_sub_territory</option>";
		}
		echo "</select>";
	}
	function distrik(){
		$id_sub = $_GET['id'];
		$tipe = 'RETAIL';
		$distrik = $this->db->query("SELECT * FROM tabel_distrik a, tabel_tipe_distrik b WHERE a.id_sub_territory='".$id_sub."' AND a.`id_tipe_distrik`=b.`id_tipe_distrik` and b.jenis_outlet like '%".$tipe."%' ORDER BY nama_distrik ASC");
		
		echo "<select name='distrik' id='distrik'>
		<option selected class='form-control' value=''>[Pilih Distrik]</option>";
		foreach ($distrik->result() as $k)
		{
			echo "<option class='form-control' value='$k->id_distrik'>$k->nama_distrik</option>";
		}
		echo "</select>";
	}
	function distrikgrafik(){
		$id_sub = $_GET['id'];
		$jenis = 'RETAIL';
		
		$sub = $this->db->query("SELECT * FROM tabel_distrik a, tabel_tipe_distrik b WHERE a.id_sub_territory='".$id_sub."' AND a.`id_tipe_distrik`=b.`id_tipe_distrik` and b.jenis_outlet like '%".$jenis."%' ORDER BY nama_distrik ASC");
		
		echo "<select name='distrik' id='distrik'>
		<option selected class='form-control' value=''>[Pilih Distrik]</option>";
		foreach ($sub->result() as $k)
		{
			echo "<option class='form-control' value='$k->id_distrik'>$k->nama_distrik</option>";
// echo "<option class='form-control' value='$k->id_distrik'>$k->nama_distrik</option>";
		}
		echo "</select>";
	}
	function callsheet(){
		$nik = $_GET['id'];
		$tipe = $_GET['tipe'];
		$sub = $_GET['sub'];
//   $sub = $this->db->query("SaELECT * FROM `tabel_distrik` a, tabel_rute b, tabel_karyawan c WHERE a.id_distrik=b.id_distrik and a.id_karyawan=c.nik 
// and c.nik='".$nik."' group by a.id_distrik");
		$sub = $this->db->query("SELECT * FROM
			`tabel_distrik` a
			INNER JOIN `tabel_rute` b ON (a.`id_distrik` = b.`id_distrik`)
			INNER JOIN `tabel_tipe_distrik` f ON (a.`id_tipe_distrik` = f.`id_tipe_distrik`)
			LEFT JOIN `tabel_sub_territory` g ON (a.`id_sub_territory` = g.`id_sub_territory`)
			LEFT JOIN `tabel_outlet` c ON (b.`id_rute` = c.`id_rute`)
			LEFT JOIN `tabel_kel_desa` d ON (c.`id_kel_desa` = d.`id_kel_desa`)
			LEFT JOIN `tabel_kecamatan` e ON (d.`id_kecamatan` = e.`id_kecamatan`)
			WHERE
			a.id_karyawan='".$nik."' AND f.`jenis_outlet` LIKE '%".$tipe."%' and g.`id_sub_territory` = '".$sub."' GROUP BY a.id_distrik");
		echo "<select name='distrik' id='distrik'>
		<option selected class='form-control' value=''>[Pilih Distrik]</option>";
		foreach ($sub->result() as $k)
		{
// echo "<option class='form-control' value='$k->id_distrik'>$k->kode_distrik - $k->nama_distrik ($k->kecamatan)</option>";
			echo "<option class='form-control' value='$k->id_distrik'>$k->nama_distrik </option>";
		}
		echo "</select>";
	}
	function rute(){
		$id_distrik = $_GET['id'];
		$nik = $_GET['karyawan'];
		$rute = $this->db->query("SELECT * FROM `tabel_distrik` a, tabel_rute b WHERE a.id_distrik=b.id_distrik  
			and a.id_distrik='".$id_distrik."' group by b.id_rute");
		echo "<select name='rute' id='rute'>
		<option selected class='form-control' value=''>[Pilih Rute]</option>";
		foreach ($rute->result() as $k)
		{
			echo "<option class='form-control' value='$k->id_rute'>$k->nama_rute</option>";
		}
		echo "</select>";
	}
	function rute2(){
		$id_distrik = $_GET['id'];
		$rute = $this->db->get_where('tabel_rute',array('id_distrik'=>$id_distrik));
		echo "<select name='rute' id='rute'>
		<option selected class='form-control' value=''>[Pilih Rute]</option>";
		foreach ($rute->result() as $k)
		{
			echo "<option class='form-control' value='$k->id_rute'>$k->nama_rute</option>";
		}
		echo "</select>";
	}
	function tahun(){
		$id_tahun = $_GET['thn'];
		$thn = $this->db->query("SELECT DISTINCT(YEAR(tgl_callsheet)) AS THN FROM tabel_callsheet WHERE STATUS = 'closed' AND YEAR(tgl_callsheet) LIKE '20%'");
		echo "<select name='thn' id='thn'>
		<option selected class='form-control' value=''>[Pilih Tahun]</option>";
		foreach ($thn->result() as $k)
		{
			echo "<option class='form-control' value='$k->THN'>$k->thn</option>";
		}
		echo "</select>";
	}
	function week(){
		$id_tahun = $_GET['id'];
		$week = $this->db->query("SELECT week(tgl_callsheet,1)+1 as week FROM tabel_callsheet where year(tgl_callsheet)='".$id_tahun."' group by week(tgl_callsheet,1)");
		echo "<select name='week' id='week'>
		<option selected class='form-control' value=''>[Pilih Week]</option>";
		foreach ($week->result() as $k)
		{
			echo "<option class='form-control' value='$k->week'>$k->week</option>";
		}
		echo "</select>";
	}
	function list_sa(){
		$id_rute = $_GET['id'];
		$nik = $_GET['karyawan'];
		$rute = $this->db->get_where('tabel_outlet, tabel_rute, tabel_distrik',array('tabel_rute.id_rute'=>$id_rute, 'tabel_distrik.id_karyawan'=>$nik, 'tabel_outlet.id_rute'=>$id_rute));
		echo "<select name='outlet_sa' id='outlet_sa'>
		<option selected class='form-control' value=''>[Pilih Outlet]</option>";
		foreach ($rute->result() as $k)
		{
			echo "<option class='form-control' value='$k->id_outlet'>$k->kode_rute - $k->nama_outlet</option>";
		}
		echo "</select>";
	}
	function karyawan(){
		$id_sub = $_GET['id'];
		$this->db->select('*');
		$this->db->from('tabel_karyawan');
		$this->db->where("id_jabatan = '5' OR id_jabatan = '6' OR id_jabatan = '7' OR id_jabatan = '8'");
		$karyawan = $this->db->get();
//$karyawan = $this->db->get_where('tabel_karyawan',array('id_sub_territory'=>$id_sub));
		echo "<select name='karyawan' id='karyawan' style='width:50;'>
		<option selected class='form-control' value=''>[Pilih Nik - Nama Karyawan]</option>";
		foreach ($karyawan->result() as $k)
		{
			echo "<option class='form-control' value='$k->nik'>$k->nik - $k->nama_karyawan</option>";
		}
		echo "</select>";
	}
	function karyawantipedistrik(){
		$id_tipe = $_GET['id'];
		$this->db->select('*');
		$this->db->from('tabel_karyawan');
		if($id_tipe == 1 || $id_tipe == 2){ $id_jabatan = 5; }
		elseif($id_tipe == 3 || $id_tipe == 4){ $id_jabatan = 8; }
		elseif($id_tipe == 5 || $id_tipe == 6){ $id_jabatan = 7; }
		elseif($id_tipe == 7 || $id_tipe == 8){ $id_jabatan = 6; }
		$this->db->where("id_jabatan = '".$id_jabatan."'");
		$karyawan = $this->db->get();
//$karyawan = $this->db->get_where('tabel_karyawan',array('id_sub_territory'=>$id_sub));
		echo "<select name='karyawan' id='karyawan' style='width:50;'>
		<option selected class='form-control' value=''>[Pilih Nik - Nama Karyawan]</option>";
		foreach ($karyawan->result() as $k)
		{
			echo "<option class='form-control' value='$k->nik'>$k->nik - $k->nama_karyawan</option>";
		}
		echo "</select>";
	}
	function karyawandistrik(){
		$id_distrik = $_GET['id'];
//
		$karyawan = $this->db->query("SELECT * FROM tabel_distrik a, tabel_tipe_distrik b, tabel_karyawan c WHERE a.id_distrik='".$id_distrik."' AND  a.`id_tipe_distrik` = b.`id_tipe_distrik` AND a.`id_karyawan`=c.`nik` ORDER BY kode_distrik ASC");
//
//$karyawan = $this->db->get_where('tabel_karyawan',array('id_sub_territory'=>$id_sub));
		echo "<select name='karyawan' id='karyawan'>
		<option selected class='form-control' value=''>[Pilih Karyawan]</option>";
		foreach ($karyawan->result() as $k)
		{
			echo "<option class='form-control' value='$k->nik'>$k->nik - $k->nama_karyawan - $k->jenis_outlet</option>";
// echo "<option class='form-control' value='$k->id_distrik'>$k->nama_distrik</option>";
		}
		echo "</select>";
	}
	function distrikkaryawan(){
		$id_sub = $_GET['id'];
		$tipe1 = $_GET['tipe1'];
		$tipe2 = $_GET['tipe2'];
		$sub = $this->db->query("SELECT * FROM tabel_distrik a, tabel_tipe_distrik b, tabel_karyawan c WHERE a.id_sub_territory='".$id_sub."' AND (a.`id_tipe_distrik`='".$tipe1."' OR a.`id_tipe_distrik`='".$tipe2."') AND a.`id_tipe_distrik`=b.`id_tipe_distrik` AND c.nik = a.id_karyawan ORDER BY kode_distrik ASC");
		echo "<select name='distrik' id='distrik'>
		<option selected class='form-control' value=''>[Pilih Distrik]</option>";
		foreach ($sub->result() as $k)
		{
			echo "<option class='form-control' value='$k->id_distrik'>$k->kode_distrik - $k->nama_distrik - $k->jenis_outlet</option>";
// echo "<option class='form-control' value='$k->id_distrik'>$k->nama_distrik</option>";
		}
		echo "</select>";
	}
	public function input_simpan()
	{
		if ($this->input->post('submit') == "simpan")
		{
			$id = $this->input->post('rute');
			$id_callsheet = $this->input->post('id_callsheet');
			if($id_callsheet == ""){
				$this->load->model("model_outlet");
				$this->model_outlet->tambah();
				$this->session->set_flashdata('info','<div class="alert alert-success alert-dismissable" style="width:30%">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Informasi!</h4>Data berhasil disimpan</div>');
				redirect('distrik/outlet/'.$id.'','refresh');	
			} else {
				$this->load->model("model_outlet");
				$this->model_outlet->tambah();
				$id_outlet = $this->db->insert_id();
				$data = array (
						'id_callsheet' 	=> $id_callsheet,
						'id_outlet' 	=> $id_outlet
				);
				$simpan = $this->db->insert('tabel_callsheet_outlet1',$data);
				$this->session->set_flashdata('info','<div class="alert alert-success alert-dismissable" style="width:30%">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-check"></i> Informasi!</h4>Data berhasil disimpan</div>');
				redirect('distrik/outlet/'.$id.'/'.$id_callsheet.'','refresh');

			}
		} else {
			$data['title']="PT. Surya Mustika Lampung";
			$data['user']=$this->session->userdata('username');
			$data['level']=$this->session->userdata('level');
			$this->load->view('admin/distrik/outlet/'+$id,$data);
		}
	}
	public function ubah($id_outlet) 
	{
		$this->load->model("model_area_office",'',TRUE);
		$data['ao']=$this->model_area_office->lihat();
		$this->load->model("model_provinsi",'',TRUE);
		$data['provinsi']=$this->model_provinsi->lihat();
		$this->load->model("model_tipe_outlet",'',TRUE);
		$data['tipe_outlet']=$this->model_tipe_outlet->lihat();
		$this->load->model("model_outlet",'',TRUE);
		$data['outlet'] = $this->model_outlet->ubah($id_outlet); 
		$data['title']="PT. Surya Mustika Lampung";
		$data['user']=$this->session->userdata('username');
		$data['level']=$this->session->userdata('level');
		$this->load->view('admin/header',$data);
		$this->load->view('admin/outlet/ubah',$data);
		$this->load->view('admin/footer',$data);
	}
	public function update_simpan()
	{
		if ($this->input->post('submit') == "simpan")
		{
			$id_rute	= $this->input->post('id_rute');
			$id 		= $this->input->post('id');
			$nama 		= $this->input->post('nama');
			$pemilik 	= $this->input->post('pemilik');
			$alamat 	= $this->input->post('alamat');
			$hp	 	= $this->input->post('hp');
			
			$data = array (
				'nama_outlet' 	=> $nama,
				'nama_pemilik' 	=> $pemilik,
				'alamat_outlet' => $alamat,
				'hp_outlet' 	=> $hp
			);
			$this->db->where('id_outlet',$id);
			$this->db->update('tabel_outlet',$data);
			redirect('distrik/outlet/'.$id_rute.'','refresh');

			
		} else {
			$data['title']="PT. Surya Mustika Lampung";
			$data['user']=$this->session->userdata('username');
			$data['level']=$this->session->userdata('level');
			$this->load->view('admin/distrik/outlet/'+$id,$data);
		}
	}
	public function hapus($id_outlet)
	{		$this->load->model("model_outlet");
		$outlet = $this->db->query("SELECT * FROM tabel_outlet WHERE id_outlet = '".$id_outlet."'");
		foreach ($outlet->result_array() as $k){$rute = $k['id_rute'];}
		$this->model_outlet->hapus($id_outlet);
		$this->session->set_flashdata('info','<div class="alert alert-success alert-dismissable" style="width:30%">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Informasi!</h4>Data berhasil dihapus</div>');
		$data['title']="PT. Surya Mustika Lampung";
		$data['user']=$this->session->userdata('username');
		$data['level']=$this->session->userdata('level');
		if($this->uri->segment(5) != NULL) {
			$id_callsheet = $this->uri->segment(5); 
			redirect('distrik/outlet/'.$rute.'/'.$id_callsheet);
		} else{
			redirect('distrik/outlet/'.$rute);
		}
	}
}