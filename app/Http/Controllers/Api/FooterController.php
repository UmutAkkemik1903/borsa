<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FooterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $footerQuery = DB::table('footer')->where(['footer.deleted_at' => null])->orderBy('footer.id', 'desc')
            ->paginate(10,['footer.explanation as explanation',
                'footer.instagram as instagram',
                'footer.youtube as youtube',
                'footer.web as web',
                'footer.id as id',
            ]);
        return $footerQuery;
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
        $footerQuery = DB::table('footer')->where('footer.id',$id)
            ->get(['footer.explanation as explanation',
                'footer.instagram as instagram',
                'footer.youtube as youtube',
                'footer.web as web',
                'footer.id as id',
            ]);
        return response()->json($footerQuery,200);
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
        DB::table('footer')->where(['id' => $id])->update([
            'explanation' => $request->input('explanation'),
            'instagram' => $request->input('instagram'),
            'youtube' => $request->input('youtube'),
            'web' => $request->input('web'),
            'updated_at' => date('Y-m-d H:i:s')
            /*'created_by' =>  Auth::user()->id*/]);

        return response()->json([
            'success' => true,
            'message' => 'Kaydedildi'

        ]);
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
