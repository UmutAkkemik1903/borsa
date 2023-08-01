<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = DB::table('content')->where(['content.deleted_at' => null])->join('magazine', function ($join) {
            $join->on('content.magazine_id', '=', 'magazine.id');
        })
            ->paginate(10,[
                'magazine.magazine_name as magazine_id',
                'content.name as name',
                'content.magazine_id as magazine_id',
                'content.content as content',
                'magazine.magazine_img as magazine_img',
                'content.id as id'
            ]);
        return $query;
    }

    public function contentDetailSearch($name)
    {
        if ($name) {
            $query = DB::table('content')
                ->where(['content.deleted_at' => null])
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
        $Query = DB::table('content')->where('content.id',$id)
            ->join('magazine', function ($join) {

                $join->on('content.magazine_id', '=', 'magazine.id');
            })->get(['magazine.magazine_name as magazine_name',
                'magazine.magazine_img as magazine_img',
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
