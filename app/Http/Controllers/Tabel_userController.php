<?php

namespace App\Http\Controllers;

use App\Models\Tabel_user;
use Illuminate\Http\Request;

class Tabel_userController extends Controller
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
        // $tabel_user = Tabel_user::OrderBy("id", "DESC")->paginate(10);
        // $output = [
        //     "message" => "Controller Tabel user",
        //     "results" => $tabel_user
        // ];

        $acceptHeader = $request->header('Accept');
        if ($acceptHeader === 'application/json' or $acceptHeader === 'application/xml')
        {
            $tabel_user = Tabel_user::OrderBy("id", "DESC")->paginate(10);
        //     $output = [
        //     "message" => "Controller Tabel user",
        //     "results" => $tabel_user
        // ];

        if ($acceptHeader === 'application/json') {
            return response()->json($tabel_user->items('data'), 200);
        }else {
            $xml = new \SimpleXMLElement('<tabel_user/>');
            foreach ($tabel_user->items('data') as $item) {
                //membuat elemen xml tabel user
                $xmlItem = $xml->addChild('tabel_user');

                //mengubah setiap field menjadi xml
                $xmlItem = $xml->addChild('id', $item->id);
                $xmlItem = $xml->addChild('id_user', $item->id_user);
                $xmlItem = $xml->addChild('nama', $item->nama);
                $xmlItem = $xml->addChild('alamat', $item->alamat);
                $xmlItem = $xml->addChild('password', $item->password);
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
             $tabel_user = Tabel_user::create($input); 

        return response()->json($tabel_user, 200);
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
        $tabel_user = Tabel_user::find($id);
        if (!$tabel_user) {
            abort(404);
        }
        $tabel_user->fill($input);
        $tabel_user->save();

        return response()->json($tabel_user, 200);
    }

    public function delete($id)
    {
        $tabel_user = Tabel_user::find($id);
        if (!$tabel_user) {
            abort(404);
        }
        $tabel_user->delete();
        $message = [
            'message' => 'Data Telah Dihapus','id' => $id];

        return response()->json($tabel_user, 200);
    }
    //
}
