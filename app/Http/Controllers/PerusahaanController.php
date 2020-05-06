<?php

namespace App\Http\Controllers;

use App\Perusahaan;
use App\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Exports\PerusahaanExport;
use Maatwebsite\Excel\Facades\Excel;

use Auth;
use Html;
use Image;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jurusanData = Jurusan::orderBy('jurusan_nama')->get();
        
        if (Auth::user())
        {
            $data = Perusahaan::whereHas('jurusan', function ($query) use ($request)
            {
              $query->where('perusahaan_id', 'LIKE', "%{$request->search}%")
                    ->orWhere('perusahaan_nama', 'LIKE', "%{$request->search}%")
                    ->orWhere('perusahaan_alamat', 'LIKE', "%{$request->search}%")
                    ->orWhere('perusahaan_email', 'LIKE', "%{$request->search}%")
                    ->orWhere('jurusan_nama', 'LIKE', "%{$request->search}%")
                    ->orWhere('perusahaan_telepon', 'LIKE', "%{$request->search}%");
            })
            ->with('jurusan')->orderBy('perusahaan_id', 'desc')->paginate(10);
            return view('perusahaan.index',compact('data','jurusanData'))
                ->with('i', (request()->input('page', 1) - 1) * 10);
        }
        else
        {
            $data = Perusahaan::whereHas('jurusan', function ($query) use ($request)
            {
              $query->where('perusahaan_id', 'LIKE', "%{$request->search}%")
                    ->orWhere('perusahaan_nama', 'LIKE', "%{$request->search}%")
                    ->orWhere('perusahaan_alamat', 'LIKE', "%{$request->search}%")
                    ->orWhere('perusahaan_email', 'LIKE', "%{$request->search}%")
                    ->orWhere('jurusan_nama', 'LIKE', "%{$request->search}%")
                    ->orWhere('perusahaan_telepon', 'LIKE', "%{$request->search}%");
            })
            ->with('jurusan')->with('ulasan')
            ->orderBy('perusahaan_id', 'desc')->get();
            return response()->json($data);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'perusahaan_nama'=>'required',
            'perusahaan_alamat' => 'required',
            'perusahaan_email' => 'required',
            'perusahaan_telepon' => 'required',
            'perusahaan_logo' => 'required|image|max:2048',
            'perusahaan_gambar1' => 'required|image|max:2048',
            'perusahaan_gambar2' => 'required|image|max:2048',
            'perusahaan_gambar3' => 'required|image|max:2048'
        ]);

        //LOGO STORE
        $file1 = $request->file('perusahaan_logo');
        $nama_file1 = time()."_".$file1->getClientOriginalName();    
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload1 = 'images/perusahaan';
        $file1->move($tujuan_upload1,$nama_file1);

        $file2 = $request->file('perusahaan_gambar1');
        $nama_file2 = time()."_".$file2->getClientOriginalName();
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload2 = 'images/perusahaan';
        $file2->move($tujuan_upload2,$nama_file2);

        $file3 = $request->file('perusahaan_gambar2');  
        $nama_file3 = time()."_".$file3->getClientOriginalName();
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload3 = 'images/perusahaan';
        $file3->move($tujuan_upload3,$nama_file3);

        $file4 = $request->file('perusahaan_gambar3');
        $nama_file4 = time()."_".$file4->getClientOriginalName();
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload4 = 'images/perusahaan';
        $file4->move($tujuan_upload4,$nama_file4);

        $perusahaan = new Perusahaan;

        $perusahaan->perusahaan_nama    = $request->perusahaan_nama;
        $perusahaan->perusahaan_alamat  = $request->perusahaan_alamat;
        $perusahaan->perusahaan_email   = $request->perusahaan_email;
        $perusahaan->perusahaan_telepon = $request->perusahaan_telepon;
        $perusahaan->perusahaan_logo    = $nama_file1;
        $perusahaan->perusahaan_gambar1 = $nama_file2;
        $perusahaan->perusahaan_gambar2 = $nama_file3;
        $perusahaan->perusahaan_gambar3 = $nama_file4;

        $perusahaan->save();

        $perusahaan->jurusan()->sync($request->jurusan, false);
        
        if (Auth::user())
        {
            return redirect()->route('perusahaan.index')
                ->with('success','Data Created successfully');
        }
        else
        {
            return response()->json('successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function show(Perusahaan $perusahaan)
    {
        $data = Perusahaan::with('jurusan')->with('ulasan')
            ->findOrFail($perusahaan->perusahaan_id);
        return response()->json($data);
    }

    /**
     * Edit the specified resource.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Perusahaan $perusahaan)
    {
        // $data = Perusahaan::with('jurusan')
        //     ->where('perusahaan_id', $perusahaan->perusahaan_id)->get();
        // return response()->json($data);
        $data = Jurusan::all();
        return view('perusahaan.edit',compact('perusahaan','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nama_file1 = $request->hidden_image1;
        $nama_file2 = $request->hidden_image2;
        $nama_file3 = $request->hidden_image3;
        $nama_file4 = $request->hidden_image4;

        $file1 = $request->file('perusahaan_logo');
        $file2 = $request->file('perusahaan_gambar1');
        $file3 = $request->file('perusahaan_gambar2');
        $file4 = $request->file('perusahaan_gambar3');

        if ($file1 !='') {
                $this->validate($request, [
                'perusahaan_logo' => 'required|image|max:2048',
            ]);
                $nama_file1 = time()."_".$file1->getClientOriginalName();
                $tujuan_upload1 = 'images/perusahaan';
                $file1->move($tujuan_upload1,$nama_file1);
        }else{
            $request->validate([
            'perusahaan_nama'=>'required',
            'perusahaan_alamat' => 'required',
            'perusahaan_email' => 'required',
            'perusahaan_telepon' => 'required',
            ]);
        }

        if($file2 !=''){
            $this->validate($request, [
                'perusahaan_gambar1' => 'required|image|max:2048',
            ]);
                $nama_file2 = time()."_".$file2->getClientOriginalName();
                $tujuan_upload2 = 'images/perusahaan';
                $file2->move($tujuan_upload2,$nama_file2);
        }else{
            $request->validate([
            'perusahaan_nama'=>'required',
            'perusahaan_alamat' => 'required',
            'perusahaan_email' => 'required',
            'perusahaan_telepon' => 'required',
            ]);
        }

        if($file3 !=''){
            $this->validate($request, [
                'perusahaan_gambar2' => 'required|image|max:2048',
            ]);
                $nama_file3 = time()."_".$file3->getClientOriginalName();
                $tujuan_upload3 = 'images/perusahaan';
                $file3->move($tujuan_upload3,$nama_file3);
        }else{
            $request->validate([
            'perusahaan_nama'=>'required',
            'perusahaan_alamat' => 'required',
            'perusahaan_email' => 'required',
            'perusahaan_telepon' => 'required',
            ]);
        }

        if($file4 !=''){
            $this->validate($request, [
                'perusahaan_gambar3' => 'required|image|max:2048',
            ]);
                $nama_file4 = time()."_".$file4->getClientOriginalName();
                $tujuan_upload4 = 'images/perusahaan';
                $file4->move($tujuan_upload4,$nama_file4);
        }else{
            $request->validate([
            'perusahaan_nama'=>'required',
            'perusahaan_alamat' => 'required',
            'perusahaan_email' => 'required',
            'perusahaan_telepon' => 'required',
            ]);
        }

        $perusahaan = Perusahaan::find($id);

        $perusahaan->perusahaan_nama    = $request->perusahaan_nama;
        $perusahaan->perusahaan_alamat  = $request->perusahaan_alamat;
        $perusahaan->perusahaan_email   = $request->perusahaan_email;
        $perusahaan->perusahaan_telepon = $request->perusahaan_telepon;
        $perusahaan->perusahaan_logo    = $nama_file1;
        $perusahaan->perusahaan_gambar1 = $nama_file2;
        $perusahaan->perusahaan_gambar2 = $nama_file3;
        $perusahaan->perusahaan_gambar3 = $nama_file4;

        $perusahaan->save();

        if (isset($request->jurusan))
        {
            $perusahaan->jurusan()->sync($request->jurusan);
        }
        else
        {
            $perusahaan->jurusan()->sync(array());
        }

        if (Auth::user())
        {
            return redirect()->route('perusahaan.index')
                ->with('success','Data Updated successfully');
        }
        else
        {
            return response()->json('successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->jurusan()->detach();
        $perusahaan->delete();
        if (Auth::user())
        {
            return redirect()->route('perusahaan.index')
                ->with('success','Data Deleted successfully');
        }
        else
        {
            return response()->json('successfully');
        }
    }

    public function export_excel()
    {
        return Excel::download(new PerusahaanExport, 'Perusahaan-'.date("Y-M-d").'.xlsx');
    }
}
