<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;


class BukuController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('petugas/buku/index');
    }

    public function index(){
     
    //     $data = array(
    //       'title'=>'nama kategori',
    //       'data_buku' => Buku::all()
    //     );
    // return view('pdf.laporan',$data);
  

    }

    public function view_pdf(){
        
    // $mpdf = new \Mpdf\Mpdf();
    // $mpdf->WriteHTML('<h1>Hello world!</h1>');
    // $mpdf->Output();
    //  return view('pdf.laporan');
    }
    
}
