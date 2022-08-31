<?php

namespace App\Http\Controllers;

use App\Events\AddNotifications;
use App\Models\AmService;
use App\Models\Notification;
use App\Models\User_notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    //

    public function index(){


        return view('welcome');
    }
    //Services
    public function getServices(){
     return   $services = AmService::all();
    }
    public function addService(){

        $att = AmService::create([
            'icon'=>request('icon'),
            'headline'=> request('headline'),
            'paragraph'=> request('paragraph'),
        ]);
        $notif=Notification::create([
            'message' => 'Admin Has added Service . ',
            'url' => '#',
            'user_id'=>auth()->id(),

        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['att'=>$att,'notification'=>$notif], 200);
    }
    public function editService(){
        $key=request('key');

        $att = AmService::updateOrCreate(['id'=>request('id')],[
            $key => request('name')

        ]);
        $notif=Notification::create([
            'message' => 'Admin Has edited Service . ',
            'url' => '#',
            'user_id'=>Auth::user()->id,
        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['notification'=>$notif], 200);

    }
    public function delService(){
        AmService::where('id',request('id'))->delete();
        $notif=Notification::create([
            'message' => 'Admin Has deleted Service . ',
            'url' => '#',
            'user_id'=>auth()->id(),
        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['notification'=>$notif], 200);
    }
}
