<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class aboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headerQuery = DB::table('about_us')->where(['about_us.deleted_at' => null])->orderBy('about_us.id', 'desc')
            ->paginate(10,['about_us.title as title',
                'about_us.content as content',
                'about_us.id as id',
            ]);
        return $headerQuery;
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
        $headerQuery = DB::table('about_us')->where('about_us.id',$id)
            ->get(['about_us.title as title',
                'about_us.content as content',
                'about_us.id as id',
            ]);
        return response()->json($headerQuery,200);

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
        DB::table('about_us')->where(['id' => $id])->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
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
