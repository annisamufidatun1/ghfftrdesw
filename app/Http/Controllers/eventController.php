<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Models\event;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class eventController extends Controller
{
        // public function discovery()
        // {
        //     return view('user.discovery');
        // }


        public function detailEvent($id)
        {
            // mengambil data event berdasarkan id yang dipilih
            $events = DB::table('events')->where('id_event',$id)->get();
            $rating = DB::table('rating_reviews')
            ->join('events', 'rating_reviews.id_event', '=', 'events.id_event')
            ->join('users', 'rating_reviews.id_user', '=', 'users.id')
            ->where('rating_reviews.id_event',$id)->get();

            // Check if the event is bookmarked for the current user
            $isBookmarked = DB::table('bookmark')
                ->where('id_event', $id)
                ->where('id_user', auth()->user()->id)
                ->exists();
                // ->where('user_id', auth()->user()->id)

            // passing data dari event dan rating_review ke detailEVent.blade.php
            return view('user.detailEVent',['events' => $events, 'rating' => $rating], compact('isBookmarked'));

            // // passing data dari event dan rating_review ke detailEVent.blade.php
            // return view('user.detailEvent',['events' => $events, 'rating' => $rating]);
        }

        public function search(Request $request)
        {
            // menangkap data pencarian
            $search = $request->search;

                // mengambil data dari table pegawai sesuai pencarian data
            $events = DB::table('events')
            ->where('eventName','like',"%".$search."%")
            ->paginate();

                // mengirim data pegawai ke view index
            return view('resultspage',['events' => $events]);

        }
        // public function index()
        // {
        //     $data = Post::inRandomOrder()
        //                 ->limit(5)
        //                 ->get();
        // }
        public function registeventuser()
        {

            // $id_user = Auth::user()->id;
            // $regist_forms= \App\Models\registForm::where('id_user', $id_user)->get();
            $regist_forms = DB::table('regist_forms')
                ->where('id_user', auth()->user()->id)
                ->get();
            // memanggil view regist form
            return view('user.registeventuser',['regist_forms' => $regist_forms]);

        }

        public function rejectedevent($id)
        {
            // $refund_forms = DB::table('refund_forms')->where('id_ref',$id)->get();
            $regist_forms = DB::table('regist_forms')
            ->join('refund_forms', 'refund_forms.id_form', '=', 'regist_forms.id_form')
            ->where('regist_forms.id_form',$id)->get();

            return view('user.rejectedevent',['regist_forms' => $regist_forms]);
        }
        public function download($id)
        {
            // Ambil data refund form dari database
            $refund_form = DB::table('refund_forms')->where('id_ref',$id)->first();
            $regist_forms = DB::table('regist_forms')
                ->join('refund_forms', 'refund_forms.id_form', '=', 'regist_forms.id_form')
                ->where('regist_forms.id_form',$id)->get();

            // Pastikan data refund form ditemukan
            if (!$refund_form) {
                abort(404);
            }

            // Ambil nama file refund_proof dari database
            $fileName = $refund_form->refund_proof;

            // Tentukan path lengkap file
            $filePath = storage_path('app/public/data_file/'. $fileName);

            // Periksa apakah file ada
            if (!file_exists($filePath)) {
                abort(404);
            }

            // Lakukan proses unduhan
            return response()->download($filePath, $fileName);
        }
        public function discovery():View
	    {
	    // $popularEvents =  event::whereBetween('rating_reviews', [4, 5])->get();
	    // $recommendedEvents = event::inRandomOrder()->limit(5)->get();

        $popularEvents = DB::table('events')
                        ->where('event_rating', '>=', 4)
                        ->get();

        $recommendedEvents = DB::table('events')
                            ->inRandomOrder()
                            ->limit(8)
                            ->get();

        // return view('user.discovery', ['popularEvents' => $popularEvents, 'recommendedEvents' => $recommendedEvents]);
        return view('user.discovery')->with('popularEvents', $popularEvents)->with('recommendedEvents', $recommendedEvents);
	    // return view('user.discovery', compact('popularEvents', 'recommendedEvents'));
	    }

	    public function uploadReview(Request $request)
	    {
	        $id = $request->id_event;

	        // insert data ke table rating_review
	        DB::table('rating_reviews')->insert([
	            'rating' => $request->rating,
	            'review' => $request->review,
	            'id_event' => $id,
	            'id_user' => auth()->user()->id //id_user harusnya disesuaiin sama profil yang lagi login sekarang
	        ]);

	        // balik ke page detail event lagi setelah kirim rating review
	        return redirect()->to('detail-event/'.$id);
	    }

	    public function uploadBookmark(Request $request)
	    {
	        $id = $request->id_event;

	        // insert data ke table bookmark
	        DB::table('bookmark')->insert([
                'id_user' => auth()->user()->id,
	            // 'id_user' => '1', //id_user harusnya disesuaiin sama profil yang lagi login sekarang
	            'id_event' => $id
	        ]);

	        // balik ke page detail event lagi setelah upload bookmark
	        return redirect()->to('detail-event/'.$id);
	    }

	    public function deleteBookmark(Request $request)
	    {
	        $id = $request->id_event;

	        // delete data dari table bookmark
	        DB::table('bookmark')
	            ->where('id_event', $id)
	            ->where('id_user', auth()->user()->id)
	            ->delete();

	        // balik ke page detail event lagi setelah delete bookmark
	        return redirect()->to('detail-event/'.$id);
	    }
        public function dashboard(Request $request)
        {
        $randomEvent = Event::inRandomOrder()->first(); // Get a random event from the database

        return view('dashboard', compact('randomEvent'));
        }
}


