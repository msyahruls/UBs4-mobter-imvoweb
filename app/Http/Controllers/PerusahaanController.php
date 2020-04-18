<?php

namespace App\Http\Controllers;

use App\Perusahaan;
use App\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Image;


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
        $data = Perusahaan::when($request->search, function ($query) use ($request) 
        {
          $query->where('perusahaan_id', 'LIKE', "%{$request->search}%")
                ->orWhere('perusahaan_nama', 'LIKE', "%{$request->search}%")
                ->orWhere('perusahaan_alamat', 'LIKE', "%{$request->search}%")
                ->orWhere('perusahaan_email', 'LIKE', "%{$request->search}%")
                ->orWhere('perusahaan_telepon', 'LIKE', "%{$request->search}%");
        }) 
        ->orderBy('perusahaan_id', 'desc')->paginate(10);

        if (Auth::user())
        {
            return view('perusahaan.index',compact('data'))
                ->with('i', (request()->input('page', 1) - 1) * 10);
        }
        else
        {
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
        $request->validate([
            'perusahaan_logo' => 'required|image|max:2048',
            'perusahaan_gambar1' => 'required|image|max:2048',
            'perusahaan_gambar2' => 'required|image|max:2048',
            'perusahaan_gambar3' => 'required|image|max:2048',
        ]);

        $image_logo = $request->perusahaan_logo;
        $logo = Image::make($image_logo);
        Response::make($logo->encode('jpeg'));

        $image_gambar1 = $request->perusahaan_gambar1;
        $gambar1 = Image::make($image_gambar1);
        Response::make($gambar1->encode('jpeg'));

        $image_gambar2 = $request->perusahaan_gambar2;
        $gambar2 = Image::make($image_gambar2);
        Response::make($gambar2->encode('jpeg'));

        $image_gambar3 = $request->perusahaan_gambar3;
        $gambar3 = Image::make($image_gambar1);
        Response::make($gambar3->encode('jpeg'));

        $form_data = array(
            'perusahaan_nama' => $request->perusahaan_nama,
            'perusahaan_alamat' => $request->perusahaan_alamat,
            'perusahaan_email' => $request->perusahaan_email,
            'perusahaan_telepon' => $request->perusahaan_telepon,
            'perusahaan_logo' => $logo,
            'perusahaan_gambar1' => $gambar1,
            'perusahaan_gambar2' => $gambar2,
            'perusahaan_gambar3' => $gambar3
        );

        Perusahaan::create($form_data);

        if (Auth::user())
        {
            return redirect('/perusahaan')->with('i', (request()->input('page', 1) - 1) * 10);
        }
        else
        {
            return response()->json('successfully');
        }
    }

    function fetch_logo($image_id)
    {
        $image = Perusahaan::findOrFail($image_id);

        $image_file = Image::make($image->perusahaan_logo);

        $response = Response::make($image_file->encode('jpeg'));

        $response->header('Content-Type', 'image/jpeg');

        return $response;
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'perusahaan_logo' => 'required|image|max:2048'
        ]);

        $image_logo = $request->perusahaan_logo;
        $logo = Image::make($image_logo);
        Response::make($logo->encode('jpeg'));

        $form_data = array(
            'perusahaan_nama' => $request->perusahaan_nama,
            'perusahaan_alamat' => $request->perusahaan_alamat,
            'perusahaan_email' => $request->perusahaan_email,
            'perusahaan_telepon' => $request->perusahaan_telepon,
            'perusahaan_logo' => $logo
        );
  
        Perusahaan::where('perusahaan_id',$id)->update($form_data);

        if (Auth::user())
        {
            return redirect('/perusahaan')->with('i', (request()->input('page', 1) - 1) * 10);
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
    public function destroy(Perusahaan $perusahaan)
    {
        //
    }
}
