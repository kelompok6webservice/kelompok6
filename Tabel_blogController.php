<?php

namespace App\Http\Controllers;

use App\Models\Tabel_blog;
use Illuminate\Http\Request;

class Tabel_blogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function index(Request $request)
    {
        // $tabel_blog = Tabel_blog::OrderBy("id", "DESC")->paginate(10);
        // $output = [
        //     "message" => "Controller Tabel blog",
        //     "results" => $tabel_blog
        // ];

        $acceptHeader = $request->header('Accept');
        if ($acceptHeader === 'application/json' or $acceptHeader === 'application/xml')
        {
            $tabel_blog = Tabel_blog::OrderBy("id", "DESC")->paginate(10);
        //     $output = [
        //     "message" => "Controller Tabel blog",
        //     "results" => $tabel_blog
        // ];

        if ($acceptHeader === 'application/json') {
            return response()->json($tabel_blog->items('data'), 200);
        }else {
            $xml = new \SimpleXMLElement('<tabel_blog/>');
            foreach ($tabel_blog->items('data') as $item) {
                //membuat elemen xml tabel blog
                $xmlItem = $xml->addChild('tabel_blog');

                //mengubah setiap field menjadi xml
                $xmlItem = $xml->addChild('id', $item->id);
                $xmlItem = $xml->addChild('id_blog', $item->id_blog);
                $xmlItem = $xml->addChild('blog', $item->blog);
                $xmlItem = $xml->addChild('created_at', $item->created_at);
                $xmlItem = $xml->addChild('update_at', $item->update_at);
            }
            return $xml->asXml();
        }
    }else {
        return response('Not Acceptable!', 406);
    }
    }

    public function post(Request $request)
    {
        $acceptHeader = $request->header('Accept');
        if ($acceptHeader === 'application/json' or $acceptHeader === 'application/xml'){

            $contentTypeHeader = $request->header('Content-Type');

            if ($contentTypeHeader === 'application/json')
            {
             $input = $request->all();
             $tabel_blog = Tabel_blog::create($input); 

        return response()->json($tabel_blog, 200);
    } else {
        return response('Unsupported Media Type', 415);
    }
     }else {
        return response('Not Acceptable!', 406);
    }
    }
    
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $tabel_blog = Tabel_blog::find($id);
        if (!$tabel_blog) {
            abort(404);
        }
        $tabel_blog->fill($input);
        $tabel_blog->save();

        return response()->json($tabel_blog, 200);
    }

    public function delete($id)
    {
        $tabel_blog = Tabel_blog::find($id);
        if (!$tabel_blog) {
            abort(404);
        }
        $tabel_blog->delete();
        $message = [
            'message' => 'Data Telah Dihapus','id' => $id];

        return response()->json($tabel_blog, 200);
    }
    //
}
