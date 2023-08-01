<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class HeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headerQuery = DB::table('header')->where(['header.deleted_at' => null])->orderBy('header.id', 'desc')
            ->paginate(10,['header.title as title',
                'header.logo as logo',
                'header.instagram as instagram',
                'header.youtube as youtube',
                'header.web as web',
                'header.advertisement as advertisement',
                'header.id as id',
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

      $img_path =  $this->fileUpload($_FILES['img']['name'], $_FILES['img']['tmp_name']);
      $advertPath =  $this->fileUpload($_FILES['advert']['name'], $_FILES['advert']['tmp_name']);

        DB::table('header')->where(['id' => 1])->update([
            'logo' => $img_path,
            'advertisement' =>$advertPath,
            'title' => $request->input('title'),
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
        $headerQuery = DB::table('header')->where('header.id',$id)
            ->get(['header.title as title',
                  'header.logo as logo',
                  'header.instagram as instagram',
                  'header.youtube as youtube',
                  'header.web as web',
                  'header.advertisement as advertisement',
                  'header.id as id',
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
