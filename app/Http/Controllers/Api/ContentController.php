<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Query = DB::table('content')->where(['content.deleted_at' => null])->orderBy('content.id', 'desc')
        ->join('magazine', function ($join) {

            $join->on('content.magazine_id', '=', 'magazine.id');
        })
        ->paginate(10,['magazine.magazine_name as magazine_id',
            'magazine.magazine_img as magazine_img',
            'content.name as name',
            'content.magazine_id as magazine_id',
            'content.content as content',
            'content.id as id',]);
        return $Query;
    }

    public function contentSearch($name)
    {
        if ($name) {
            $query = DB::table('content')
                ->where(['content.deleted_at' => null])
                ->join('magazine',function ($join) {
                $join->on('content.magazine_id', '=', 'magazine.id');
            })
                ->where('content.name', 'LIKE', "%{$name}%")
                ->orderByDesc('content.id')
                ->paginate(4);
            return $query;
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
        DB::table('content')->insertGetId([
            'name' => $request->input('name'),
            'content' => $request->input('content'),
            'magazine_id' => $request->input('magazine_id'),
            'created_at' => date('Y-m-d H:i:s')

        ]);
        return response()->json([
            'success' => true,
            'message'=> 'Kaydedildi'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Query = DB::table('content')->where('content.id',$id)
            ->join('magazine', function ($join) {

                $join->on('content.magazine_id', '=', 'magazine.id');
            })->get(['magazine.magazine_name as magazine_name',
                'magazine.magazine_img as magazine_img',
                'magazine.id as id',
                'content.name as name',
                'content.magazine_id as magazine_id',
                'content.content as content',
                'content.id as id',
            ]);

        return response()->json($Query,200);
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
       DB::table('content')->where(['id'=>$id])->update([
            'name' => $request->input('name'),
            'content' => $request->input('content'),
            'magazine_id' => $request->input('magazine_id')
       ]);
       return response()->json([
           'success' => true,
           'message' => 'Güncellendi'
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
        DB::table('content')->where('id','=',$id)->update([
            'deleted_at'=> date('Y-m-d H-i-s')
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Silindi'
        ]);
    }
}
