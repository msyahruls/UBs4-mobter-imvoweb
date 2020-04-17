<?php

namespace App\Http\Controllers;

use App\Perusahaan;
use App\Jurusan;
use Illuminate\Http\Request;

use Auth;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Perusahaan::when($request->search, function($query) use($request){
            $query->where('perusahaan_nama', 'LIKE', '%'.$request->search.'%');})
            ->with('jurusan')->paginate(10);
        if (Auth::user())
            return view('perusahaan.index',compact('data'))
                ->with('i', (request()->input('page', 1) - 1) * 10);
        else
            return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function show(Perusahaan $perusahaan)
    {
        $data = Perusahaan::with('jurusan')
            ->where('perusahaan_id', $perusahaan->perusahaan_id)->get();
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perusahaan $perusahaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perusahaan $perusahaan)
    {
        //
    }
}
