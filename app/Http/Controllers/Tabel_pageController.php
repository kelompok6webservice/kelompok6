<?php

namespace App\Http\Controllers;

use App\Models\Tabel_page;
use Illuminate\Http\Request;

class Tabel_pageController extends Controller
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
        // $tabel_page = Tabel_page::OrderBy("id", "DESC")->paginate(10);
        // $output = [
        //     "message" => "Controller Tabel page",
        //     "results" => $tabel_page
        // ];

        $acceptHeader = $request->header('Accept');
        if ($acceptHeader === 'application/json' or $acceptHeader === 'application/xml')
        {
            $tabel_page = Tabel_page::OrderBy("id", "DESC")->paginate(10);
        //     $output = [
        //     "message" => "Controller Tabel page",
        //     "results" => $tabel_page
        // ];

        if ($acceptHeader === 'application/json') {
            return response()->json($tabel_page->items('data'), 200);
        }else {
            $xml = new \SimpleXMLElement('<tabel_page/>');
            foreach ($tabel_page->items('data') as $item) {
                //membuat elemen xml tabel page
                $xmlItem = $xml->addChild('tabel_page');

                //mengubah setiap field menjadi xml
                $xmlItem = $xml->addChild('id', $item->id);
                $xmlItem = $xml->addChild('id_page', $item->id_page);
                $xmlItem = $xml->addChild('page', $item->page);
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
             $tabel_page = Tabel_page::create($input); 

        return response()->json($tabel_page, 200);
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
        $tabel_page = Tabel_page::find($id);
        if (!$tabel_page) {
            abort(404);
        }
        $tabel_page->fill($input);
        $tabel_page->save();

        return response()->json($tabel_page, 200);
    }

    public function delete($id)
    {
        $tabel_page = Tabel_page::find($id);
        if (!$tabel_page) {
            abort(404);
        }
        $tabel_page->delete();
        $message = [
            'message' => 'Data Telah Dihapus','id' => $id];

        return response()->json($tabel_page, 200);
    }
    //
}
