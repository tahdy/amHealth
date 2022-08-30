<?php

namespace App\Http\Controllers;

use App\Events\AddNotifications;
use App\Models\AmService;
use App\Models\User_notification;
use Illuminate\Http\Request;

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
            'icon'=>request('user_id'),
            'headline'=> request('date'),
            'paragraph'=> request('alert'),
        ]);
        $notif=User_notification::create([
            'message' => 'Admin Has added Service . ',
            'url' => '#',
            'from_user_id'=>auth()->id(),
            'to_user_id'=>auth()->id(),

        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['att'=>$att,'notification'=>$notif], 200);
    }
    public function editService(){
        $att = AmService::updateOrCreate(['id'=>request('id')],[
            'icon'=>request('user_id'),
            'headline'=> request('date'),
            'paragraph'=> request('alert'),

        ]);
        $notif=User_notification::create([
            'message' => 'Admin Has edited Service . ',
            'url' => '#',
            'from_user_id'=>auth()->id(),
            'to_user_id'=>auth()->id(),
        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['notification'=>$notif], 200);

    }
    public function delService(){
        AmService::where('id',request('id'))->delete();
        $notif=User_notification::create([
            'message' => 'Admin Has deleted Service . ',
            'url' => '#',
            'from_user_id'=>auth()->id(),
            'to_user_id'=>auth()->id(),
        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['notification'=>$notif], 200);
    }
}
