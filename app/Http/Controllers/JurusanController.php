<?php

namespace App\Http\Controllers;

use App\Jurusan;
use App\Perusahaan;
use Illuminate\Http\Request;

use Auth;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Jurusan::when($request->search, function($query) use($request){
            $query->where('jurusan_nama', 'LIKE', '%'.$request->search.'%');})
            ->orderBy('jurusan_nama','asc')
            ->with('perusahaan')->paginate(10);
        if (Auth::user()){
            return view('jurusan.index',compact('data'))
                ->with('i', (request()->input('page', 1) - 1) * 10);
        }else
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
        $jurusan_nama = $request->input('jurusan_nama');

        $data = new \App\Jurusan();
        $data->jurusan_nama = $jurusan_nama;

        if($data->save()){
            $res['message'] = "Success!";
            $res['value'] = "$data";
            return response($res);
        }

        // $request->validate([
        //     'jurusan_nama' => 'required',
        // ]);

        // // $data=Jurusan::create($request->all());
        // if($data=Jurusan::create($request->all())){
        //     $res['message'] = "Success!";
        //     $res['value'] = "$data";
        //     return response()->json($res);
        // }
        // return response()->json('successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function show(Jurusan $jurusan)
    {
        $data = Jurusan::with('perusahaan')
            ->find($jurusan->jurusan_id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'jurusan_nama' => 'required',
        ]);
  
        $category->update($request->all());
        return response()->json('successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jurusan  $jurusan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jurusan $jurusan)
    {
        $category->delete();
        return response()->json('successfully');
    }
}
