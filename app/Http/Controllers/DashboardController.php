<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Berita;
use App\Jurusan;
use App\Perusahaan;
use App\Ulasan;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $brt = Berita::count();
        $jrsn = Jurusan::count();
        $prshn = Perusahaan::count();
        $ulsn = Ulasan::count();

        $data = Perusahaan::whereHas('jurusan', function ($query) use ($request)
        {
          $query->where('perusahaan_id', 'LIKE', "%{$request->search}%")
                ->orWhere('perusahaan_nama', 'LIKE', "%{$request->search}%")
                ->orWhere('perusahaan_alamat', 'LIKE', "%{$request->search}%")
                ->orWhere('perusahaan_email', 'LIKE', "%{$request->search}%")
                ->orWhere('jurusan_nama', 'LIKE', "%{$request->search}%")
                ->orWhere('perusahaan_telepon', 'LIKE', "%{$request->search}%");
        })
        ->with('jurusan')
        ->orderBy('perusahaan_id', 'desc')->paginate(8);

        $data->appends($request->only('search'));

        return view('dashboard.index', compact('brt','jrsn','prshn','ulsn','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
