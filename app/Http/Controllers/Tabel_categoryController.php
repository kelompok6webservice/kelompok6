<?php

namespace App\Http\Controllers;

use App\Models\Tabel_category;
use Illuminate\Http\Request;

class Tabel_categoryController extends Controller
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
        // $tabel_category = Tabel_category::OrderBy("id", "DESC")->paginate(10);
        // $output = [
        //     "message" => "Controller Tabel category",
        //     "results" => $tabel_category
        // ];

        $acceptHeader = $request->header('Accept');
        if ($acceptHeader === 'application/json' or $acceptHeader === 'application/xml')
        {
            $tabel_category = Tabel_category::OrderBy("id", "DESC")->paginate(10);
        //     $output = [
        //     "message" => "Controller Tabel category",
        //     "results" => $tabel_category
        // ];

        if ($acceptHeader === 'application/json') {
            return response()->json($tabel_category->items('data'), 200);
        }else {
            $xml = new \SimpleXMLElement('<tabel_category/>');
            foreach ($tabel_category->items('data') as $item) {
                //membuat elemen xml tabel category
                $xmlItem = $xml->addChild('tabel_category');

                //mengubah setiap field menjadi xml
                $xmlItem = $xml->addChild('id', $item->id);
                $xmlItem = $xml->addChild('id_category', $item->id_category);
                $xmlItem = $xml->addChild('category', $item->category);
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
             $tabel_category = Tabel_category::create($input); 

        return response()->json($tabel_category, 200);
    } else {
        return response('Unsupported Media Type', 415);
    }
     }else {
        return response('Not Acceptable!', 406);
    }
    }
    
    //
}
