<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class bookmarkController extends Controller
{
    public function bookmark()
    {
        // mengambil data event berdasarkan id yang dipilih
        // $bookmark = DB::table('bookmark')->where('id_user', '1')->get();

        $bookmark = DB::table('bookmark')
        ->join('events', 'bookmark.id_event', '=', 'events.id_event')
        ->where('id_user', auth()->user()->id)
        ->get();

        // ->where('id_user', '1')
        // ->where('user_id', auth()->user()->id);

        return view('user.bookmark', ['bookmark' => $bookmark]);
    }

    public function deleteBookmark(Request $request)
    {
        $id = $request->id_event;

        // delete data dari table bookmark
        DB::table('bookmark')
            ->where('id_event', $id)
            ->where('id_user', auth()->user()->id)
            ->delete();

        // balik ke page bookmark lagi setelah delete bookmark
        return redirect()->to('/bookmark');
    }
}
