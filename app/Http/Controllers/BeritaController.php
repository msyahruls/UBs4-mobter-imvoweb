<?php

namespace App\Http\Controllers;

use App\Berita;
use Auth;
use Illuminate\Http\Request;
use App\Exports\BeritaExport;
use Maatwebsite\Excel\Facades\Excel;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user())
        {
            $data = Berita::when($request->search, function($query) use($request){
            $query->where('berita_judul', 'LIKE', '%'.$request->search.'%')
                  ->orWhere('berita_link', 'LIKE', '%'.$request->search.'%');
            })
            ->orderBy('berita_id','asc')->paginate(10);
            return view('berita.index',compact('data'))
                ->with('i', (request()->input('page', 1) - 1) * 10);
        }
        else
        {
            $data = Berita::when($request->search, function($query) use($request){
            $query->where('berita_judul', 'LIKE', '%'.$request->search.'%')
                  ->orWhere('berita_link', 'LIKE', '%'.$request->search.'%');
            })
            ->orderBy('berita_id','asc')->get();
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
            'berita_judul'=>'required',
            'berita_link' => 'required',
            'berita_gambar' => 'required|image|max:2048'
        ]);
     
        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('berita_gambar');
     
        $nama_file = time()."_".$file->getClientOriginalName();
     
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'images/berita';
        $file->move($tujuan_upload,$nama_file);
     
     
        Berita::create([
            'berita_judul' => $request->berita_judul,
            'berita_link' => $request->berita_link,
            'berita_gambar' => $nama_file
        ]);

        if (Auth::user())
        {
            return redirect()->route('berita.index')
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Berita::findOrFail($id);
        return response()->json($data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nama_file = $request->hidden_image;
        
        $file = $request->file('berita_gambar');

        if ($file !='') {
                $this->validate($request, [
                'berita_gambar' => 'required|image|max:2048',
            ]);
                $nama_file = time()."_".$file->getClientOriginalName();
                $tujuan_upload = 'images/berita';
                $file->move($tujuan_upload,$nama_file);
        }else{
            $request->validate([
                'berita_judul'=>'required',
                'berita_link' => 'required'
            ]);
        }

        $form_data = array(
            'berita_judul' => $request->berita_judul,
            'berita_link' => $request->berita_link,
            'berita_gambar' => $nama_file
        );
        Berita::where('berita_id',$id)->update($form_data);

        if (Auth::user())
        {
            return redirect()->route('berita.index')
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();
        if (Auth::user())
        {
            return redirect()->route('berita.index')
                ->with('success','Data Deleted successfully');
        }
        else
        {
            return response()->json('successfully');
        }
    }

    public function export_excel()
    {
        return Excel::download(new BeritaExport, 'Berita-'.date("Y-M-d").'.xlsx');
    }
}
