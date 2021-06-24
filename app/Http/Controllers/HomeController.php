<?php
namespace App;
namespace App\Http;
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::where('id','=', Auth::user()->id)->first();
        return view('home',[
            'user'=>$user,
        ]);
    }

    function crop(Request $request){
        $user = User::where('id','=', Auth::user()->id)->first();
        if($user->avatar !="avatars/avatar.png"){
        unlink(public_path("uploads/$user->avatar"));
    }
        $userImg = Storage::disk('uploads')->put("avatars", $request->avatar); //work fe moshkela
      
        $user->update(['avatar'=>$userImg]);
        
        return response()->json([
            'status'=>1,
            'msg'=>'img uploaded successfully',
            'user'=>$user->avatar,
        ]);

        // return view('home',[
        //     'user'=>$user,
        // ]);
    }

}
