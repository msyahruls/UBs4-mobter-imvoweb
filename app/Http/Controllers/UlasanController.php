<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jurusan;
use App\Perusahaan;
use App\Ulasan;
use App\Exports\UlasanExport;
use Maatwebsite\Excel\Facades\Excel;

use Auth;

class UlasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jurusan = Jurusan::all();
        $perusahaan = Perusahaan::all();
            
        if (Auth::user())
        {
            $data = Ulasan::when($request->search, function($query) use($request)
            {
              $query->where('ulasan_nama_mhs', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('jurusan_nama', 'LIKE', "%{$request->search}%")
                    ->orWhere('ulasan_angkatan', 'LIKE', "%{$request->search}%")
                    ->orWhere('perusahaan_nama', 'LIKE', "%{$request->search}%")
                    ->orWhere('ulasan_periode', 'LIKE', "%{$request->search}%");
            })
            ->join('jurusan', 'jurusan.jurusan_id', '=', 'ulasan.ulasan_jurusan_id')
            ->join('perusahaan', 'perusahaan.perusahaan_id', '=', 'ulasan.ulasan_perusahaan_id')
            ->orderBy('ulasan_nama_mhs','asc')->paginate(10);
            return view('ulasan.index',compact('data','jurusan','perusahaan'))
                ->with('i', (request()->input('page', 1) - 1) * 10);
        }
        else
        {
            $data = Ulasan::when($request->search, function($query) use($request)
            {
              $query->where('ulasan_nama_mhs', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('jurusan_nama', 'LIKE', "%{$request->search}%")
                    ->orWhere('ulasan_angkatan', 'LIKE', "%{$request->search}%")
                    ->orWhere('perusahaan_nama', 'LIKE', "%{$request->search}%")
                    ->orWhere('ulasan_periode', 'LIKE', "%{$request->search}%");
            })
            ->with('jurusan')->with('perusahaan')
            ->orderBy('ulasan_nama_mhs','asc')->get();
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
        $form_data = array(
            'ulasan_nama_mhs' => $request->ulasan_nama_mhs,
            'ulasan_jurusan_id' => $request->ulasan_jurusan_id,
            'ulasan_angkatan' => $request->ulasan_angkatan,
            'ulasan_perusahaan_id' => $request->ulasan_perusahaan_id,
            'ulasan_periode' => $request->ulasan_periode,
            'ulasan_testimoni' => $request->ulasan_testimoni
        );

        Ulasan::create($form_data);

        if (Auth::user())
        {
            return redirect()->route('ulasan.index')
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
    public function show(Ulasan $ulasan)
    {
        $data = Ulasan::with('jurusan')
            ->findOrFail($ulasan->ulasan_id);
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
        $form_data = array(
            'ulasan_nama_mhs' => $request->ulasan_nama_mhs,
            'ulasan_jurusan_id' => $request->ulasan_jurusan_id,
            'ulasan_angkatan' => $request->ulasan_angkatan,
            'ulasan_perusahaan_id' => $request->ulasan_perusahaan_id,
            'ulasan_periode' => $request->ulasan_periode,
            'ulasan_testimoni' => $request->ulasan_testimoni
        );
  
        Ulasan::where('ulasan_id',$id)->update($form_data);

        if (Auth::user())
        {
            return redirect()->route('ulasan.index')
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
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->delete();
        if (Auth::user())
        {
            return redirect()->route('ulasan.index')
                ->with('success','Data Deleted successfully');
        }
        else
        {
            return response()->json('successfully');
        }
    }

    public function export_excel()
    {
        return Excel::download(new UlasanExport, 'Ulasan-'.date("Y-M-d").'.xlsx');
    }

}
