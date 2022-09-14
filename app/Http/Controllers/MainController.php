<?php

namespace App\Http\Controllers;

use App\Events\AddNotifications;
use App\Models\AboutParagraph;
use App\Models\AmService;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Notification;
use App\Models\page_data;
use App\Models\Patient;
use App\Models\Question;
use App\Models\User_notification;
use App\Models\Visit;
use App\Models\WhyAnswer;
use App\Models\User;
use Carbon\Carbon;
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
            'headline_ar'=> request('headline_ar'),
            'paragraph_ar'=> request('paragraph_ar'),
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

    //Departments
    public function getDepartments(){
        return   $Departments = Department::all();
    }
    public function addDepartment(){

        $att = Department::create([
            'icon'=>request('icon'),
            'headline'=> request('headline'),
            'paragraph'=> request('paragraph'),
            'headline_ar'=> request('headline_ar'),
            'name'=> request('name'),
            'name_ar'=> request('name_ar'),
            'paragraph_ar'=> request('paragraph_ar'),
            'image'=> request('image'),
        ]);
        $notif=Notification::create([
            'message' => 'Admin Has added Department . ',
            'url' => '#',
            'user_id'=>auth()->id(),

        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['att'=>$att,'notification'=>$notif], 200);
    }
    public function editDepartment(){

        $att = Department::updateOrCreate(['id'=>request('id')],[
            'icon'=>request('icon'),
            'headline'=> request('headline'),
            'paragraph'=> request('paragraph'),
            'headline_ar'=> request('headline_ar'),
            'name'=> request('name'),
            'name_ar'=> request('name_ar'),
            'paragraph_ar'=> request('paragraph_ar'),
            'image'=> request('image'),
        ]);
        $notif=Notification::create([
            'message' => 'Admin Has edited Department . ',
            'url' => '#',
            'user_id'=>Auth::user()->id,
        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['notification'=>$notif], 200);

    }
    public function delDepartment(){
        Department::where('id',request('id'))->delete();
        $notif=Notification::create([
            'message' => 'Admin Has deleted Department . ',
            'url' => '#',
            'user_id'=>auth()->id(),
        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['notification'=>$notif], 200);
    }
    Public function delFile(){
        $name=request('path');
        $file_path = public_path($name); // app_path("public/test.txt");
        if(File::exists($file_path)) File::delete($file_path);
        return $name;
    }
    //About_paragraphs
    public function getAbout_paragraphs(){
        return   $About_paragraphs = AboutParagraph::all();
    }
    public function addAbout_paragraph(){

        $att = AboutParagraph::create([
            'icon'=>request('icon'),
            'headline'=> request('headline'),
            'paragraph'=> request('paragraph'),
            'headline_ar'=> request('headline_ar'),
            'name'=> request('name'),
            'name_ar'=> request('name_ar'),
            'paragraph_ar'=> request('paragraph_ar'),
            'image'=> request('image'),
        ]);
        $notif=Notification::create([
            'message' => 'Admin Has added About_paragraph . ',
            'url' => '#',
            'user_id'=>auth()->id(),

        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['att'=>$att,'notification'=>$notif], 200);
    }
    public function editAbout_paragraph(){

        $att = AboutParagraph::updateOrCreate(['id'=>request('id')],[
            'icon'=>request('icon'),
            'headline'=> request('headline'),
            'paragraph'=> request('paragraph'),
            'headline_ar'=> request('headline_ar'),
            'name'=> request('name'),
            'name_ar'=> request('name_ar'),
            'paragraph_ar'=> request('paragraph_ar'),
            'image'=> request('image'),
        ]);
        $notif=Notification::create([
            'message' => 'Admin Has edited About_paragraph . ',
            'url' => '#',
            'user_id'=>Auth::user()->id,
        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['notification'=>$notif], 200);

    }
    public function delAbout_paragraph(){
        AboutParagraph::where('id',request('id'))->delete();
        $notif=Notification::create([
            'message' => 'Admin Has deleted AboutParagraph . ',
            'url' => '#',
            'user_id'=>auth()->id(),
        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['notification'=>$notif], 200);
    }

    //Why_paragraphs
    public function getWhy_paragraphs(){
        return   $Why_paragraphs = WhyAnswer::all();
    }
    public function addWhy_paragraph(){

        $att = WhyAnswer::create([
            'icon'=>request('icon'),
            'headline'=> request('headline'),
            'paragraph'=> request('paragraph'),
            'headline_ar'=> request('headline_ar'),
            'name'=> request('name'),
            'name_ar'=> request('name_ar'),
            'paragraph_ar'=> request('paragraph_ar'),
            'image'=> request('image'),
        ]);
        $notif=Notification::create([
            'message' => 'Admin Has added Why_paragraph . ',
            'url' => '#',
            'user_id'=>auth()->id(),

        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['att'=>$att,'notification'=>$notif], 200);
    }
    public function editWhy_paragraph(){

        $att = WhyAnswer::updateOrCreate(['id'=>request('id')],[
            'icon'=>request('icon'),
            'headline'=> request('headline'),
            'paragraph'=> request('paragraph'),
            'headline_ar'=> request('headline_ar'),
            'name'=> request('name'),
            'name_ar'=> request('name_ar'),
            'paragraph_ar'=> request('paragraph_ar'),
            'image'=> request('image'),
        ]);
        $notif=Notification::create([
            'message' => 'Admin Has edited Why_paragraph . ',
            'url' => '#',
            'user_id'=>Auth::user()->id,
        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['notification'=>$notif], 200);

    }
    public function delWhy_paragraph(){
        WhyAnswer::where('id',request('id'))->delete();
        $notif=Notification::create([
            'message' => 'Admin Has deleted WhyParagraph . ',
            'url' => '#',
            'user_id'=>auth()->id(),
        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['notification'=>$notif], 200);
    }

    //Page_datas
    public function getPage_datas(){
        return   $Page_datas = Page_data::all();
    }
    public function addPage_data(){

        $att = Page_data::create([
            'section'=> request('section'),
            'headline'=> request('headline'),
            'paragraph'=> request('paragraph'),
            'headline_ar'=> request('headline_ar'),
            'paragraph_ar'=> request('paragraph_ar'),
        ]);
        $notif=Notification::create([
            'message' => 'Admin Has added Page_data . ',
            'url' => '#',
            'user_id'=>auth()->id(),

        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['att'=>$att,'notification'=>$notif], 200);
    }
    public function editPage_data(){

        $att = Page_data::updateOrCreate(['id'=>request('id')],[
            'section'=> request('section'),
            'headline'=> request('headline'),
            'paragraph'=> request('paragraph'),
            'headline_ar'=> request('headline_ar'),
            'paragraph_ar'=> request('paragraph_ar'),

        ]);
        $notif=Notification::create([
            'message' => 'Admin Has edited Page_data . ',
            'url' => '#',
            'user_id'=>Auth::user()->id,
        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['notification'=>$notif], 200);

    }
    public function delPage_data(){
        Page_data::where('id',request('id'))->delete();
        $notif=Notification::create([
            'message' => 'Admin Has deleted Page_data . ',
            'url' => '#',
            'user_id'=>auth()->id(),
        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['notification'=>$notif], 200);
    }
    public function getPage_data(){

       $Page_datas = Page_data::all();
        $grouped = collect($Page_datas)->groupBy('section');
       return $grouped->all();

    }


    //Questions
    public function getQuestions(){
        return   $Questions = Question::all();
    }
    public function addQuestion(){

        $att = Question::create([
            'question'=> request('question'),
            'answer'=> request('answer'),
            'question_ar'=> request('question_ar'),
            'answer_ar'=> request('answer_ar'),
        ]);
        $notif=Notification::create([
            'message' => 'Admin Has added Question . ',
            'url' => '#',
            'user_id'=>auth()->id(),

        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['att'=>$att,'notification'=>$notif], 200);
    }
    public function editQuestion(){

        $att = Question::updateOrCreate(['id'=>request('id')],[
            'question'=> request('question'),
            'answer'=> request('answer'),
            'question_ar'=> request('question_ar'),
            'answer_ar'=> request('answer_ar'),

        ]);
        $notif=Notification::create([
            'message' => 'Admin Has edited Question . ',
            'url' => '#',
            'user_id'=>Auth::user()->id,
        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['notification'=>$notif], 200);

    }
    public function delQuestion(){
        Question::where('id',request('id'))->delete();
        $notif=Notification::create([
            'message' => 'Admin Has deleted Question . ',
            'url' => '#',
            'user_id'=>auth()->id(),
        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['notification'=>$notif], 200);
    }
    public function getUsers(){
        $searchTerm=request('search');
        if ($searchTerm===null){
            return   $Users = User::paginate(15, ['*'], 'page', request('page'));
        }else{
            return   $Users = User::where('fullname', 'LIKE', "%{$searchTerm}%")
                ->paginate(15, ['*'], 'page', request('page'));
        }

    }
    public function getUser(){
           $User = User::find(request('id'));
        return response()->json(['user'=>$User], 200);

    }
    public function getUsersCount(){
        return   $Users = User::all()->count();
    }
    public function getDoctors(){
        $searchTerm=request('search');
        if ($searchTerm===null){
            return   $Users = Doctor::with('user','department')->paginate(15, ['*'], 'page', request('page'));
        }else{

            return   $Users = Doctor::with('user','department')
                ->whereHas('user', function($q) use($searchTerm)
                {
                    $q->where('fullname', 'LIKE', '%'.$searchTerm.'%');
                })
                ->paginate(15, ['*'], 'page', request('page'));
        }

    }
    public function getDoctor(){
        $User = Doctor::with('user','department')->find(request('id'));
        return response()->json(['user'=>$User], 200);

    }
    public function getDoctorsCount(){
        return   $Users = Doctor::all()->count();
    }
    public function editDoctor(){

        $att = Doctor::updateOrCreate(['id'=>request('id')],[
            'bio'=> request('bio'),
            'department_id'=> request('department_id'),
            'specialty'=> request('specialty'),
        ]);
        $User = Doctor::with('user','department')->find(request('id'));
        $notif=Notification::create([
            'message' => 'Admin Has edited Doctor . ',
            'url' => '#',
            'user_id'=>Auth::user()->id,
        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['notification'=>$notif,'doctor'=>$User], 200);

    }
    public function delDoctor(){
       $doctor= Doctor::where('id',request('id'))->first();
       User::where('id',$doctor->user_id)->delete();
         Doctor::where('id',request('id'))->delete();
        $notif=Notification::create([
            'message' => 'Admin Has deleted Doctor . ',
            'url' => '#',
            'user_id'=>auth()->id(),
        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['notification'=>$notif], 200);
    }
    public function getPatients(){
        $searchTerm=request('search');
        if ($searchTerm===null){
            return   $Users = Patient::with('user')->paginate(15, ['*'], 'page', request('page'));
        }else{
            return   $Users = Patient::with('user')
                ->whereHas('user', function($q) use($searchTerm)
                {
                    $q->where('fullname', 'LIKE', '%'.$searchTerm.'%');
                })
                ->paginate(15, ['*'], 'page', request('page'));
        }
    }
    public function getPatient(){
        $User = Patient::with('user','visits')->find(request('id'));
        $visits=Visit::with('doctor.user')->where('patient_id',$User->id)->get();
        return response()->json(['user'=>$User,'visits'=>$visits], 200);

    }
    public function getPatientsCount(){
        return   $Users = Patient::all()->count();
    }
    public function editPatient(){

        $att = Patient::updateOrCreate(['id'=>request('id')],[
            'info'=> request('info'),
            'is_insurance'=> request('is_insurance'),
            'insurance_responsible'=> request('insurance_responsible'),
            'insurance_id'=> request('insurance_id'),

        ]);
        $User = Patient::with('user','visits')->find(request('id'));
        $notif=Notification::create([
            'message' => 'Admin Has edited Patient . ',
            'url' => '#',
            'user_id'=>Auth::user()->id,
        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['notification'=>$notif,'patient'=>$User], 200);

    }
    public function delPatient(){
        $doctor= Patient::where('id',request('id'))->first();
        User::where('id',$doctor->user_id)->delete();
        Patient::where('id',request('id'))->delete();
        $notif=Notification::create([
            'message' => 'Admin Has deleted Doctor . ',
            'url' => '#',
            'user_id'=>auth()->id(),
        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['notification'=>$notif], 200);
    }

    public function addVisit(){

        $att = Visit::create([
            'info'=> request('info'),
            'prescription'=> request('prescription'),
            'blood_pressure'=> request('blood_pressure'),
            'visit_date'=> Carbon::parse(request('visit_date')),
            'heart_rate'=> request('heart_rate'),
            'glucose_level'=> request('glucose_level'),
            'blood_count'=> request('blood_count'),
            'Diseases'=> request('Diseases'),
            'doctor_id'=> request('doctor_id'),
            'patient_id'=> request('patient_id'),

        ]);
        $notif=Notification::create([
            'message' => 'Admin Has added Visit . ',
            'url' => '#',
            'user_id'=>auth()->id(),

        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['att'=>$att,'notification'=>$notif], 200);
    }
    public function editVisit(){

        $att = Visit::updateOrCreate(['id'=>request('id')],[
            'info'=> request('info'),
            'prescription'=> request('prescription'),
            'blood_pressure'=> request('blood_pressure'),
            'visit_date'=> Carbon::parse(request('visit_date')),
            'heart_rate'=> request('heart_rate'),
            'glucose_level'=> request('glucose_level'),
            'blood_count'=> request('blood_count'),
            'Diseases'=> request('Diseases'),
            'doctor_id'=> request('doctor_id'),
            'patient_id'=> request('patient_id'),

        ]);
        $notif=Notification::create([
            'message' => 'Admin Has edited Visit . ',
            'url' => '#',
            'user_id'=>Auth::user()->id,
        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['notification'=>$notif], 200);

    }
    public function delVisit(){
        Visit::where('id',request('id'))->delete();
        $notif=Notification::create([
            'message' => 'Admin Has deleted Visit . ',
            'url' => '#',
            'user_id'=>auth()->id(),
        ]);
        broadcast(new AddNotifications($notif))->toOthers();

        return response()->json(['notification'=>$notif], 200);
    }
}
