<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\siswa;
use Illuminate\Support\Facades\DB;


class myAPIController extends Controller
{
	public function siswaLogin(Request $request)
    {
		$username = $request->username;
		$password = $request->password;
        $datasiswa = siswa::where('nama_pengguna', $username)->where('katasandi', $password)->first();
        if ($datasiswa!=null) {
            $tokensiswa = new siswa; //Instansiasi Objek biar bisa panggil static function
			$datasiswa->token = $tokensiswa->GenerateToken();
			$datasiswa->save();
			return response($datasiswa);
        }
		else{
			$res['message'] = "Login Failed!";
			return response($res);
		}
	}
	//public function siswaLogin($username,$password)
    //{
    //    $datasiswa = siswa::where('nama_pengguna', $username)->where('katasandi', $password)->first();
    //    if ($datasiswa!=null) {
    //        $tokensiswa = new siswa; //Instansiasi Objek biar bisa panggil static function
	//		$datasiswa->token = $tokensiswa->GenerateToken();
	//		$datasiswa->save();
	//		return response($datasiswa);
    //    }
	//	else{
	//		$res['message'] = "Login Failed!";
	//		return response($res);
	//	}
    //}

	//public function siswaLogout($username)
    //{
    //    $datasiswa = siswa::where('nama_pengguna', $username)->first();
    //    if ($datasiswa!=null) {
	//		if($datasiswa->token != null){
	//			$tokensiswa = new siswa;
	//			$datasiswa->token = $tokensiswa->RemoveToken();
	//			$datasiswa->save();
	//			$res['message'] = "Logout Success!";
	//			return response($res);
	//		}else{
	//			$res['message'] = "Logout Success!";
	//			return response($res);
	//		}
    //    }
	//	else{
	//		$res['message'] = "Data Not Found!";
	//		return response($res);
	//	}
    //}
	public function siswaLogout(Request $request)
    {
        $datasiswa = siswa::where('token', $request->token)->first();
        if ($datasiswa!=null) {
			if($datasiswa->token != null){
				$tokensiswa = new siswa;
				$datasiswa->token = $tokensiswa->RemoveToken();
				$datasiswa->save();
				$res['message'] = "Logout Success!";
				return response($res);
			}else{
				$res['message'] = "Logout Success!";
				return response($res);
			}
        }
		else{
			$res['message'] = "Data Not Found!";
			return response($res);
		}
    }

	public function getTransaksi($jenistabungan,$token){
		$datasiswa = siswa::where('token', $token)->first();
		if ($datasiswa!=null) {
			$data = DB::table('transaksi')->where('jenis_tabungan', $jenistabungan)->where('nis', $datasiswa->nis)->get();
			foreach($data as $transaksi){
				$date = $transaksi->updated_at;
				$month = date('Y', strtotime($date));
				$year = date('Y', strtotime($date));
				//kalo lewat dari bulan juli(7 keatas) maka tahun +1
				if($month>7){
					$tahun1 = (string)$year."-";
					$tahun2Int = (int)$year + 1;
					$tahun2 = (string)$tahun2Int; 
					$periode = $tahun1.$tahun2;
					$transaksi->periode = $periode;
				}else{
					$tahun1 = (string)$year;
					$tahun2Int = (int)$year - 1;
					$tahun2 = (string)$tahun2Int."-"; 
					$periode = $tahun2.$tahun1;
					$transaksi->periode = $periode;
				}
				
				//Get status tabungan
				$dataTabungan = DB::table('jenis_tabungan')->where('nama', $transaksi->jenis_tabungan)->first();
				$statusTabungan = $dataTabungan->aktif;
				if($statusTabungan!=1){
					$transaksi->status_tabungan = "Non Aktif";
				}
				else{
					$transaksi->status_tabungan = "Aktif";
				}

			}
			if(count($data)>0){
				return response($data);
			}
			else{
				$res['message'] = "Empty!";
				return response($res);
			}
		}else{
			$res['message'] = "Login Needed!";
			return response($res);
		}
	}
	public function getSaldoAll($token){
		$datasiswa = siswa::where('token', $token)->first();
		if ($datasiswa!=null) {
			$saldoSiswa = DB::table('tabungan')->where('nis', $datasiswa->nis)->get();
			if(count($saldoSiswa)>0){
				return response($saldoSiswa);
			}
			else{
				$res['message'] = "Empty!";
				return response($res);
			}
		}else{
			$res['message'] = "Login Needed!";
			return response($res);
		}
	}
	public function getSaldo($jenistabungan, $token){
		$datasiswa = siswa::where('token', $token)->first();
		if ($datasiswa!=null) {
			$saldoSiswa = DB::table('tabungan')->where('nis', $datasiswa->nis)->where('jenis_tabungan', $jenistabungan)->get();
			if(count($saldoSiswa)>0){
				return response($saldoSiswa);
			}
			else{
				$res['message'] = "Empty!";
				return response($res);
			}
		}else{
			$res['message'] = "Login Needed!";
			return response($res);
		}
	}
	
	public function editNomor(Request $request){
		$datasiswa = siswa::where('token', $request->token)->first();
		if ($datasiswa!=null) {
			$datasiswa = siswa::where('token', $request->token)->update([
				'telp_ortu' => $request->nomor
			]);
			$res['message'] = "Edit Nomor Telfon Sukses!";
			return response($res);
		}else{
			$res['message'] = "Siswa Tidak Ditemukan!";
			return response($res);
		}
	}
	public function getDetailTabungan($jenistabungan,$token){
		$datasiswa = siswa::where('token', $token)->first();
		if ($datasiswa!=null) {
			//ambil status tabungan
			
			$data = DB::table('jenis_tabungan')->where('nama',$jenistabungan)->get();
			if(count($data)>0){
				foreach($data as $tabungan){
					$deskripsi_tabungan=$tabungan->deskripsi;
					if($tabungan->aktif == 1){
						$status_tabungan="aktif";
					}
					else{
						$status_tabungan="nonaktif";
					}
				}
			}
			else{
				$status_tabungan="error!";
				$deskripsi_tabungan="error!";
			}

			//ambil total saldo tabungan 
			$data = DB::table('tabungan')->where('nis',$datasiswa->nis)->where('jenis_tabungan',$jenistabungan)->get();
			if(count($data)>0){
				foreach($data as $datasaldo){
					$saldoTabungan=$datasaldo->saldo;
				}
			}
			else{
				$saldoTabungan=-1;
			}

			//ambil nama wali kelas
			//1_ambil kelas mengunakan nis
			//2_ambil nama wali kelas dari tabel kelas
			$data = DB::table('siswa')->where('token', $token)->get();
			if(count($data)>0){
				foreach($data as $datasiswa){
					$kelas_siswa = $datasiswa->kelas;
					$data = DB::table('kelas')->where('kelas',$kelas_siswa)->get();
					if(count($data)>0){
						foreach($data as $dataguru){
							$nama_guru=$dataguru->wali_kelas;
						}
					}
					else{
						$nama_guru="-";
					}
				}
			}
			else{
				$nama_guru="-";
			}

			//ambil detail transaksi terakhir
			$data = DB::table('transaksi')->where('nis',$datasiswa->nis)->orderByDesc('created_at')->get();
			if(count($data)>0){
				foreach($data as $transaksi){
					$nominal_trans=$transaksi->nominal;
					$jenis_trans=$transaksi->jenis_transaksi;
					$tanggal_trans=$transaksi->created_at;
					break;
				}
			}
			else{
				$nominal_trans=-1;
				$jenis_trans="error!";
				$tanggal_trans="error!";
			}
			$res['message'] = "Success!";
			$res['nis'] = $datasiswa->nis;
			$res['jenis_tabungan'] = $jenistabungan;
			$res['status'] = $status_tabungan;
			$res['deskripsi'] = $deskripsi_tabungan;
			$res['total_saldo'] = $saldoTabungan;
			$res['wali_kelas'] = $nama_guru;
			$res['nominal_terakhir'] = $nominal_trans;
			$res['jenis_transaksi'] = $jenis_trans;
			$res['tanggal'] = $tanggal_trans;
		}else{
			$res['message'] = "Failed!";
			$res['nis'] = $nis;
			$res['jenis_tabungan'] = $jenistabungan;
			$status_tabungan="error!";
			$deskripsi_tabungan="error!";
			$res['total_saldo'] = -1;
			$res['wali_kelas'] = "-";
			$res['nominal_terakhir'] = -1;
			$res['jenis_transaksi'] = "error!";
			$res['tanggal'] = "error!";
		}
        return response($res);
    }
}
