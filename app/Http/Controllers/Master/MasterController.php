<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class MasterController extends Controller
{
    public function credential(Request $request){
        $key = $request->key ?? false;
        $shared_secret = $request->shared_secret ?? false;
        if($key && $shared_secret){
            if($request->session()->get('lalve') === $key){
                return response()->json(['error' => 'Key is already exists.'],403);
            }
            else{
                $request->session()->put('lalve', $key);
                $request->session()->put('shared_secret', $shared_secret);
                return response()->json(['error' => 'key is stored.'],204);
            }
        }
        return response()->json(['error' => 'Not authorized.'],403);
    }

    public function message(Request $request){
        $message = $request->msg ?? false;
        $tags = $request->tags ?? false;

        if($message && $tags){
            if (!Session::has('messages'))
                Session::put('messages', []);
            $arrMessage = Session::get('messages');

            $id = count($arrMessage) + 1;
            array_push($arrMessage,[
               "id" => $id,
               "msg" => $message,
               "tags" => $tags
            ]);
            Session::put('messages', $arrMessage);

            return response()->json(['ID' => $id],200);
        }

        return response()->json(['msg' => 'The message could not be saved.'],403);
    }

    public function messageID(Request $request, $id){
        if (!Session::has('messages'))
            Session::put('messages', []);

        $arrMessage = Session::get('messages');

        $message = [];
        foreach($arrMessage AS $val){
            if($val['id'] === $id){
                $message = $val;
                break;
            }
        }

        return response()->json(['msg' => 'by id'],200);
    }

    public function messageTag(Request $request){
        return response()->json(['msg' => 'by tag.'],200);
    }
}
