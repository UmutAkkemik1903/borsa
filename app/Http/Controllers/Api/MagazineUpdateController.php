<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Null_;

class MagazineUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $magazineQuery = DB::table('magazine')->where(['deleted_at' => null])->paginate(10,[
            'magazine.magazine_name as magazine_name',
            'magazine.magazine_img as magazine_img',
            'magazine.id as id'
        ]);
        return $magazineQuery;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $img_path =  $this->fileUpload($_FILES['mag_img']['name'], $_FILES['mag_img']['tmp_name']);
        DB::table('magazine')->where(['id' => $request->input('id')])->update([
            'magazine_img' => $img_path,
            'magazine_name' => $request->input('magazine_name'),
            'updated_at' => date('y-m-d'),
            /*'created_by' =>  Auth::user()->id*/]);
        return response()->json([
            'success' => true,
            'message' => 'Kaydedildi'

        ]);

    }

    private function fileUpload($name, $tmpName) {
        if (!empty($name) and !empty($tmpName) ) {
            $extention = pathinfo($name, PATHINFO_EXTENSION);
            if ($extention == 'png' or $extention == 'jpg' or $extention == 'jpeg' or $extention
                == 'tiff' or $extention == 'xls' or $extention == 'docx'
                or $extention == 'pdf' or $extention == 'xlsx' or $extention == 'pptx' or $extention == 'ppt') {
                $filePath = "/document/";
                $directory = public_path().'/'.$filePath;
                $fileName = Str::random(40).'.'.$extention;
                if (move_uploaded_file($tmpName, $directory . $fileName)) {
                    //  echo "Uploaded";
                    return     $filePath.$fileName;
                } else {
                    echo "File was not uploaded";
                }
            } else {
                echo 'Desteklenmeyen uzantı';
            }
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
        $magQuery = DB::table('magazine')->where('magazine.id',$id)
            ->get(['magazine.magazine_name as magazine_name',
                'magazine.magazine_img as magazine_img',
                'magazine.id as id'
            ]);
        return response()->json($magQuery,200);
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
