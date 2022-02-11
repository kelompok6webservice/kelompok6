<?php

namespace App\Http\Controllers;

use App\Models\Tabel_comments;
use Illuminate\Http\Request;

class Tabel_commentsController extends Controller
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
        // $tabel_comments = Tabel_comments::OrderBy("id", "DESC")->paginate(10);
        // $output = [
        //     "message" => "Controller Tabel comments",
        //     "results" => $tabel_comments
        // ];

        $acceptHeader = $request->header('Accept');
        if ($acceptHeader === 'application/json' or $acceptHeader === 'application/xml')
        {
            $tabel_comments = Tabel_comments::OrderBy("id", "DESC")->paginate(10);
        //     $output = [
        //     "message" => "Controller Tabel comments",
        //     "results" => $tabel_comments
        // ];

        if ($acceptHeader === 'application/json') {
            return response()->json($tabel_comments->items('data'), 200);
        }else {
            $xml = new \SimpleXMLElement('<tabel_comments/>');
            foreach ($tabel_comments->items('data') as $item) {
                //membuat elemen xml tabel comments
                $xmlItem = $xml->addChild('tabel_comments');

                //mengubah setiap field menjadi xml
                $xmlItem = $xml->addChild('id', $item->id);
                $xmlItem = $xml->addChild('id_comments', $item->id_comments);
                $xmlItem = $xml->addChild('comments', $item->comments);
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
             $tabel_comments = Tabel_comments::create($input); 

        return response()->json($tabel_comments, 200);
    } else {
        return response('Unsupported Media Type', 415);
    }
     }else {
        return response('Not Acceptable!', 406);
    }
    }
    
    //
}
