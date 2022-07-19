<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Illuminate\Support\Facades\App;
use DB;
use App\Models\AddStudent;
use App\Models\Dropdown;
use App\Models\User;
use App\Models\Country;
use App\Models\Task;
use App\Models\University;
use App\Models\Visa;
use App\Models\Application;
use App\Models\AddStudentDropdownType;
use App\Models\birthday;
use App\Models\DropdownType;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Storage;
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
        $authUser = User::find(auth()->user()->id);
        $authUserRole = $authUser->getRoleNames()[0];
        if($authUserRole == 'Visa'){
            $students = Visa::all();
            $student_id = [];
            foreach($students as $visa){
                $expire_date= $visa->visa_expire_date;
                $current = Carbon::now(); 
                $date= Carbon::parse($expire_date);
                $diff_date = $date->diffInDays($current, true);
                // if($diff_date<=60 && $visa->select_status !== 'Approved' || $diff_date <=61){
                if($diff_date<=60 && $visa->select_status !== 'Approved' && $visa->student->mark = 'Complete'){
                    $student_id[]= $visa->student_id;
                }
            }
            $except_approved = Visa::where('select_status','!=','Approved')->get();
            // dd($except_approved);
            // $Submitted = Visa::where('select_status','Submitted')->get();
            // foreach($Submitted as $val){
            //     $student_id[] = $val->student_id;
            // }
            // $Information_Provided = Visa::where('select_status','Information Provided')->get();
            // foreach($Information_Provided as $val){
            //     $student_id[] = $val->student_id;
            // }
            // $More_Information_Required = Visa::where('select_status','More Information Required')->get();
            // foreach($More_Information_Required as $val){
            //     $student_id[] = $val->student_id;
            // }
            // foreach($students as $val){
            //     $student_id[] = $val->student_id;
            // }
            foreach($except_approved as $val){
                $student_id[] = $val->student_id;
            }
            
           
            // $ownStudents= AddStudent::where('users_id',auth()->user()->id)->latest()->get(); 
            // foreach($ownStudents as $val){
            //     $student_id[] = $val->id;
            // }
            $final = array_unique($student_id);
            // $latest_students = AddStudent::whereIn('id',$final)->where('visa_stu',true)->latest()->take(10)->get();
            $latest_students = AddStudent::whereIn('id',$final)->latest()->take(10)->get();
        }
        if($authUserRole == 'Admissions'){
            $showStudentsToAdmissions = Application::whereIn('status', ['Submitted', 'Acceptance sent', 'Acceptance Information provided', 'Information Provided'])->latest()->get();
            $student_id = [];
            foreach($showStudentsToAdmissions as $val){
                $student_id[] = $val->add_students_id;
            }
            $ownStudents= AddStudent::where('users_id',auth()->user()->id)->where('visa_stu',false)->latest()->get(); 
            foreach($ownStudents as $val){
                $student_id[] = $val->id;
            }
            
            $final = array_unique($student_id);
            
            $latest_students = AddStudent::whereIn('id',$final)->orWhere('users_id',auth()->user()->id)->latest()->take(10)->get();
        }
        if($authUserRole == 'Counsellor'){
            // $lastTwoMonthDate = date("Y-m-d H:i:s",strtotime("-2 month"));
            // $aboveTwoMonthDate = date("Y-m-d H:i:s",strtotime("+2 month"));
            // $currentDate = Carbon::now()->toDateTimeString();
            // $showStudentsToCounsellor = AddStudentDropdownType::whereBetween('course_complete_date',[$lastTwoMonthDate,$currentDate])->where('course_complete', 'Complete')->latest()->get();
            $aboveTwoMonthDate = date("Y-m-d H:i:s",strtotime("+2 month"));
            $currentDate = Carbon::now()->toDateTimeString();

            // $showStudentsToCounsellor = AddStudentDropdownType::whereBetween('course_start_date',[$currentDate,$aboveTwoMonthDate])->where('course_complete', 'Complete')->latest()->get();

            // $markcomplete = AddStudent::where('mark','Completed')->where('users_id',auth()->user()->id)->where('visa_stu',false)->latest()->get();
            // foreach($markcomplete as $val){
            //     $student_id[] = $val->id;
            // }
            $markcomplete = AddStudent::where('users_id',auth()->user()->id)->where('visa_stu',false)->latest()->get();
            foreach($markcomplete as $val){
                $student_id[] = $val->id;
            }
            // $showStudentsToCounsellor = AddStudent::where('mark','Completed')->where('users_id',auth()->user()->id)->where('visa_stu',false)->latest()->get();
            $studentWhoSubmitAppli = Application::whereIn('status', ['Submitted', 'Acceptance sent', 'Acceptance Information provided', 'Information Provided'])->latest()->get();

            $studentWhoSubmitAppli = Application::whereIn('status', ['Submitted', 'Acceptance sent', 'Acceptance Information provided', 'Information Provided'])->latest()->get();
            $student_id = [];
            
            // foreach($showStudentsToCounsellor as $val){
            //     $student_id[] = $val->add_student_id;
            // }
            foreach($studentWhoSubmitAppli as $val){
                $student_id[] = $val->add_student_id;
            }
            $ownStudents= AddStudent::where('users_id',auth()->user()->id)->where('visa_stu',false)->latest()->get(); 
            foreach($ownStudents as $val){
                $student_id[] = $val->id;
            }
            
            $final = array_unique($student_id);

            $latest_students = AddStudent::studentRelations()->whereIn('id',$final)->orWhere('users_id',auth()->user()->id)->latest()->take(10)->get();
        }
        if($authUserRole == 'Management'){
            $lastTwoMonthDate = date("Y-m-d H:i:s",strtotime("-2 month"));
            $aboveTwoMonthDate = date("Y-m-d H:i:s",strtotime("+2 month"));
            $currentDate = Carbon::now()->toDateTimeString();
            $showStudentsToCounsellor = AddStudentDropdownType::whereBetween('course_complete_date',[$lastTwoMonthDate,$currentDate])->where    ('course_complete', 'Complete')->latest()->get();
            $showStudentsToFinanceManager = AddStudentDropdownType::where('course_accepted','Accepted')->where('course_complete', 'Complete')->latest()->get();
            $allstudent = AddStudent::all();
            $student_id = [];
            $markcomplete = AddStudent::where('mark','Completed')->where('users_id',auth()->user()->id)->where('visa_stu',false)->latest()->get();
            foreach($markcomplete as $val){
                $student_id[] = $val->id;
            }
            foreach($allstudent as $val){
                $user = User::find($val->users_id);
                if($user){
                    $role = $user->getRoleNames()[0];
                    if($role == 'Counsellor'){
                        $student_id[] = $val->id;
                    }
                }   
            }
            foreach($showStudentsToCounsellor as $val){
                $student_id[] = $val->add_student_id;
            }
            foreach($showStudentsToFinanceManager as $val){
                $student_id[] = $val->add_student_id;
            }
            
            $final = array_unique($student_id);
            $latest_students = AddStudent::whereIn('id',$final)->orWhere('users_id',auth()->user()->id)->where('visa_stu',false)->latest()->take(10)->get();
        }
        if($authUserRole == 'Finance'){
            $showStudentsToFinanceManager = AddStudentDropdownType::where('course_accepted','Accepted')->where('course_complete', 'Complete')->latest()->get();
            $taskStudents = Task::where('status', 'Complete')->get();
            $student_id = [];
            $markcomplete = AddStudent::where('mark','Completed')->where('users_id',auth()->user()->id)->where('visa_stu',false)->latest()->get();
            foreach($markcomplete as $val){
                $student_id[] = $val->id;
            }
            foreach($showStudentsToFinanceManager as $val){
                $student_id[] = $val->add_student_id;
            }

            foreach($taskStudents as $val){
                $student_id[] = $val->student_id;
            }
            $ownStudents= AddStudent::where('users_id',auth()->user()->id)->where('visa_stu',false)->latest()->get(); 
            foreach($ownStudents as $val){
                $student_id[] = $val->id;
            }
            
            $final = array_unique($student_id);
            $latest_students = AddStudent::whereIn('id',$final)->orWhere('users_id',auth()->user()->id)->latest()->take(10)->get();
        }
        $students = AddStudent::all();
        $students = AddStudent::select(DB::raw("(COUNT(*)) as count"),DB::raw("MONTHNAME(created_at) as month_name"))
                        ->whereYear('created_at', date('Y'))->groupBy('month_name')->orderBy('created_at','ASC')->get()->toArray();
        //integerate larapex piechart
        $Months=[];
        $count_student= [];
        foreach($students as $key=>$user){
            $Months[]=$user['month_name'];
            $count_student[] = $user['count'];
        }
        $chart = (new LarapexChart)->pieChart()
         ->setTitle('')
         ->addData($count_student)
         ->setLabels($Months);

        // integerate larapex donutchart
        $visa = Visa::select(DB::raw("(COUNT(*)) as count"),DB::raw("MONTHNAME(created_at) as month_name"))
        ->whereYear('created_at', date('Y'))->groupBy('month_name')->orderBy('created_at','ASC')->get()->toArray();
        $visa_months=[];
        $count_visa= [];
        foreach($students as $key=>$user){
            $visa_months[]=$user['month_name'];
            $count_visa[] = $user['count'];
        }
        $visa_chart = (new LarapexChart)->donutChart()
        ->setTitle('')
        ->addData($count_visa)
        ->setLabels($visa_months);
        $course = Dropdown::find(15);
        $courses = $course->dropdownType;
        $from = Carbon::today()->format('m-d');
        $to = Carbon::today()->addDays(7)->format('m-d');
        $users = DB::table('users')->whereBetween(DB::raw("(DATE_FORMAT(dob,'%m-%d'))"),array($from, $to))->get();
        $universities = University::get();

        $clock_user = User::find(Auth::user()->id);
        $today_date = Carbon::today();
        $today_birthday_staff= User::where(DB::raw("(DATE_FORMAT(dob,'%m-%d'))"),$today_date->format('m-d'))->get();
        // dd($today_birthday_staff);
        $birthday= birthday::first();
        if($authUserRole == 'Master User'){
            $students = [];
            $latest_students = AddStudent::latest()->take(10)->get();
        }
        $total_students = count(AddStudent::get());
        $total_courses = count(DropdownType::where('dropdowns_id',15)->get());
        $total_users = count(User::get());

        return view('admin.pages.dashboard',compact('students','chart','latest_students','courses','users','universities','visa_chart','clock_user','to','today_birthday_staff','birthday','total_students','total_courses','total_users'));
    }
    public function switch_lang($locale){
        // return $locale;
        Session::put('locale', $locale);
        App::setLocale(Session::get('locale'));
        // dd(App::currentLocale());
        // \LogActivity::addToLog('Change Language '.App::currentLocale());
        return redirect()->back();
    }
    public function allNotifiMarkAsRead(){
        $user = $user = User::role('Master User')->first();
        $user->unreadNotifications->markAsRead();
        return redirect()->back();
    }
    public function notifiMarkAsRead(Request $request){
        $user = $user = User::role('Master User')->first();
        $user->unreadNotifications->where('id',$request->notifi_read_id)->markAsRead();
        return response()->json($request->student_id);
    }
    public function deleteAllNotification(){
        $user = $user = User::role('Master User')->first();
        $user->notifications()->delete();
        return redirect()->back();
    }
    public function deleteNotification(Request $request){
        $user = $user = User::role('Master User')->first();
        \LogActivity::addToLog('Notification Deleted '.$request->notifi_read_id);
        $user->notifications()->where('id',$request->notifi_read_id)->delete();
        return response()->json('true');
    }
    public function reload_clock(){
        $clock_user = User::find(Auth::user()->id);
        return view('admin.pages.append_clock',compact('clock_user'))->render();
    }
    public function staff_birthday(){
        $birthday_info = birthday::get()->first();
        return view('admin.users.birthday',compact('birthday_info'));
    }
    public function store_staff_birthday(Request $request){
        $staff = birthday::first();
        $input = $request->all();
        if(empty($staff)){
            $birthday = new birthday;

            $watermark = $request->file('watermark');
            // return $image_uni;
            if($watermark){
                $file_fullname = $watermark->getClientOriginalName();
                $file_name = pathinfo($file_fullname, PATHINFO_FILENAME);
                $file_extension = $watermark->getClientOriginalExtension();
                $rand_namer = now();
                $rand_namer = preg_replace('/\s+/', '_', trim($rand_namer));
                $rand_namer = preg_replace('/:+/', '_', trim($rand_namer));
                $file_namefor_db =$file_name . '_' . $rand_namer . '.' . $file_extension;
                $file_namefor_db = preg_replace('/\s+/', '_', trim($file_namefor_db));
                $watermark->storeAs('/birthday/',$file_namefor_db,'public');
                $pic = url('/storage/birthday/'.$file_namefor_db);
                $input['watermark'] = $pic;
            }
            $birthday->create($input);
            parent::successMessage('Add Birthday Card Information Successfully');
            return redirect()->back();
        }
        else
        {
            $birthday = birthday::first();
            $watermark = $request->file('watermark');
            $birthday->birthday_title = $request->birthday_title;
            $birthday->quotation = $request->quotation;
            $birthday->footer_note = $request->footer_note;
            $BirthdayImage = str_replace('/storage', '', $request->image_path);
            if($watermark){
                $file_fullname = $watermark->getClientOriginalName();
                $file_name = pathinfo($file_fullname, PATHINFO_FILENAME);
                $file_extension = $watermark->getClientOriginalExtension();
                $rand_namer = now();
                $rand_namer = preg_replace('/\s+/', '_', trim($rand_namer));
                $rand_namer = preg_replace('/:+/', '_', trim($rand_namer));
                $file_namefor_db =$file_name . '_' . $rand_namer . '.' . $file_extension;
                $file_namefor_db = preg_replace('/\s+/', '_', trim($file_namefor_db));
                $watermark->storeAs('/birthday/',$file_namefor_db,'public');
                $pic = url('/storage/birthday/'.$file_namefor_db);
            }

            $birthday->update([
                'birthday_title'=>$request->birthday_title,
                'quotation'=>$request->quotation,
                'footer_note'=>$request->footer_note,
                'watermark'=>$pic ?? '',
            ]);
            parent::successMessage('Update Birthday Card Information Successfully');
            return redirect()->back();
        }
    }
}
