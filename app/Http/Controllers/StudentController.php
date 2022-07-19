<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddStudentRequest;
use App\Http\Requests\StudentInformationRequest;
use App\Http\Requests\ContactDetailRequest;
use App\Models\Accommodation;
use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\AddStudent;
use App\Models\Application;
use App\Models\StudentInformation;
use App\Models\StudentContactDetail;
use App\Models\StudentOtherInformation;
use App\Models\Country;
use App\Models\AddStudentDropdownType;
use App\Models\DropdownType;
use App\Models\Dropdown;
use App\Models\SpecialEducation;
use App\Models\Education;
use App\Models\Comment;
use App\Models\Visa;
use Exception;
use Illuminate\Support\Carbon;
use Session;
use Illuminate\Support\Facades\Auth;

use Mail;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = AddStudent::with('info')->with('contact')->with('otherInfo')->get();

        return view('admin.pages.dashboard',compact('student'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dropdown = Dropdown::with('dropdownType')->get();
        $counsellor = User::role('Counsellor')->get();
        $admission_officer = User::role('Admissions')->get();
        $countries = Country::all();
        $contactTab = Session::get('stuConTab');
        $infoTab = Session::get('stuInfoTab');
        $user = AddStudent::with('info')->with('contact')->with('otherInfo')->find(Session::get('lastInsertedId'));
        return view('admin.pages.student.create', compact('user','countries','counsellor','admission_officer','dropdown','contactTab','infoTab'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddStudentRequest $request)
    {
        // for edit student data
        if($request->forEdit == 'true'){
            $query = AddStudent::find($request->addStudent_id);
            $query->update([
                'office' => $request->office,
                'counsellor' => $request->counsellor,
                'admission_officer' => $request->admission_officer,
            ]);
            if($query->info){
                \LogActivity::addToLog('update record of student name:'.$query->info->name);
            }
            return response()->json($query->id);
        }
        // for add student data
        if(Session::get('lastInsertedId')){
            $query = AddStudent::find(Session::get('lastInsertedId'));
            $query->update([
                'office' => $request->office,
                'counsellor' => $request->counsellor,
                'admission_officer' => $request->admission_officer,
            ]);
            if($query->info){
                \LogActivity::addToLog('update record of student name:'.$query->info->name);
            }
        }else{
            $authUser = User::find(auth()->user()->id);
            $authUserRole = $authUser->getRoleNames()[0];
            if($authUserRole == 'Visa'){
                $query = AddStudent::create([
                    'office' => $request->office,
                    'counsellor' => $request->counsellor,
                    'admission_officer' => $request->admission_officer,
                    'users_id' => auth()->user()->id,
                    'visa_stu' => 1,
                ]);
            }
            else{
                $query = AddStudent::create([
                    'office' => $request->office,
                    'counsellor' => $request->counsellor,
                    'admission_officer' => $request->admission_officer,
                    'users_id' => auth()->user()->id,
                    'visa_stu' => 0,
                ]);
            }
            if($query->info){
                \LogActivity::addToLog('add record of student name:'.$query->info->name);
            }
        }
        $lastInsertedId = $query->id;
        Session::put('lastInsertedId', $lastInsertedId);
        if($query->info){
            \LogActivity::addToLog('update record of student'.$query->info->name);
        }
        return response()->json($lastInsertedId);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd(auth()->user()->name);

        $user = AddStudent::studentRelations()->find($id);
        $dropdown = Dropdown::with('dropdownType')->get();
        $countries = Country::all();
        $counsellor = User::role('Counsellor')->get();

        $student = AddStudent::find($id);
        $comments = $student->comments;
        // dd($student->info->name);
        $admission_officer = User::role('Admissions')->get();
        if(!empty($student->info->name)){
        }
        return view('admin.pages.student.showstudent', compact('comments', 'user','dropdown','countries','counsellor','admission_officer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $forEdit = 'true';
        $dropdown = Dropdown::with('dropdownType')->get();
        $countries = Country::all();
        $counsellor = User::role('Counsellor')->get();
        $admission_officer = User::role('Admissions')->get();
        $user = AddStudent::with('info')->with('contact')->with('otherInfo')->find($id);
        \LogActivity::addToLog('edit student screen, student:'.$user->info->name);
        return view('admin.pages.student.create', compact('user', 'countries','forEdit','counsellor','admission_officer', 'dropdown'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Application::where('add_students_id', $id)->first()){

            // $applications = Application::where('add_students_id', $id)->get();
            // foreach($applications as $val){
            //     $appli_id = $val->id;
            //     SpecialEducation::where('applications_id', $appli_id)->delete();
            //     Education::where('applications_id', $appli_id)->delete();
            //     Application::find($appli_id)->delete();
            // }
            parent::errorMessage("First Delete The Applications Of That Student");
            return redirect()->back();
        }
        if(Accommodation::where('add_students_id', $id)->first()){
            parent::errorMessage("First Delete The Accommodations Of That Student");
            return redirect()->back();
        }
        if(Task::where('add_students_id', $id)->first()){
            parent::errorMessage("First Delete The Tasks Of That Student");
            return redirect()->back();
        }
        if(AddStudentDropdownType::where('add_student_id', $id)->first()){
            parent::errorMessage("First Delete The Courses Of That Student");
            return redirect()->back();
        }

        StudentOtherInformation::where('add_students_id', $id)->delete();
        StudentContactDetail::where('add_students_id', $id)->delete();
        StudentInformation::where('add_students_id', $id)->delete();
        AddStudent::find($id)->delete();

        // $student = AddStudent::where('id', $id)->get();
        // \LogActivity::addToLog('Delete record of student,'.'Name:'.$student->info->name.'id'.$id);
        // $student->delete();

        parent::successMessage("Record Deleted Successfully");
        return redirect()->route('studentlists');
    }
    // for show student detail
    public function studentDetail($id)
    {
        $student=StudentContactDetail::find($id)->first();
        $data=StudentInformation::whereId($id)->first();
        if(isset($student->email))
        return view('admin.pages.student.studentDetail', compact('student','data'));
    }


     public function sendsms(Request $request)
     {
        // Mail::to($request->email)->send(new StudentMail());
        $student=StudentContactDetail::find($request->id)->first();
        \LogActivity::addToLog('send sms student'.$student->info->name);
        return response()->json([
            'html' => view('admin.pages.student.smsPopup', compact('student'))->render(), 200, ['Content-Type' => 'application/json']
        ]);
     }

    // For edit , add and update Student Information tab
    public function studentinformation(StudentInformationRequest $request)
    {
        $name = $request->surname." ".$request->l_name;
        // for edit student data
        if($request->forEdit == 'true'){
            $query = StudentInformation::find($request->StudentInfo_id);
            $query->update([
                // 'surname' => $request->surname,
                'name' => $name,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'nationality' => $request->nationality,
                'visa' => $request->visa,
                'note' => $request->note,
            ]);
            \LogActivity::addToLog('update student information, name:'.$name);
            return response()->json($query);
        }
        // for add student data
        // if(empty(Session::get('lastInsertedId'))){
        //     return response()->json('no');
        // }
        $id = Session::get('lastInsertedId');
        if(StudentInformation::where('add_students_id',$id)->first()){
            $query = StudentInformation::where('add_students_id',$id)->first();
            $query->update([
                // 'surname' => $request->surname,
                'name' => $name,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'nationality' => $request->nationality,
                'visa' => $request->visa,
                'note' => $request->note,
            ]);
            \LogActivity::addToLog('update student information, name:'.$name);
            return response()->json($query);
        }else{
            $query = StudentInformation::create([
                'add_students_id' => $id,
                // 'surname' => $request->surname,
                'name' => $name,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'nationality' => $request->nationality,
                'visa' => $request->visa,
                'note' => $request->note,

            ]);
            Session::put('stuInfoTab', "true");
            \LogActivity::addToLog('update student information tab, name:'.$name);
            return response()->json('true');
        }
    }

    // For edit , add and update Student Contact Detail
    public function studentcontactdetail(ContactDetailRequest $request)
    {
        if($request->phone_number['full']== ""){

            return response()->json(["error"=>"Please Enter a Number"]);
        }
         // for edit student contact detail
         if($request->forEdit == 'true'){
            $query = StudentContactDetail::find($request->contactDetail_id);
            $query->update([
                'email' => $request->email,
                'secondary_email' => $request->secondary_email,
                'contact_number' => $request->phone_number['full'],
                'secondary_contact_number' => $request->phone_number2['full'],
                'address_details' => $request->address_details,
                'street_address' => $request->street_address,
                'suburb' => $request->suburb,
                'state' => $request->state,
                'country' => $request->country,
                'post_code' => $request->post_code,
            ]);
            $student = AddStudent::find($query->add_students_id);
            \LogActivity::addToLog('update student contact detail, name:'.$student->info->name);
            return response()->json($query);
        }
        // if(empty(Session::get('lastInsertedId'))){
        //     return response()->json('no');
        // }
         // for add student contact detail
        $id = Session::get('lastInsertedId');
        if(StudentContactDetail::where('add_students_id',$id)->first()){
            $query = StudentContactDetail::where('add_students_id',$id)->first();
            if($request->phone_number['full']== ""){

                return response()->json(["error"=>"Please Enter a Number"]);
            }
            $query->update([
                'email' => $request->email,
                'secondary_email' => $request->secondary_email,
                'contact_number' => $request->phone_number['full'],
                'secondary_contact_number' => $request->phone_number2['full'],
                'address_details' => $request->address_details,
                'street_address' => $request->street_address,
                'suburb' => $request->suburb,
                'state' => $request->state,
                'country' => $request->country,
                'post_code' => $request->post_code,
            ]);
            $student = AddStudent::find($query->add_students_id);
            \LogActivity::addToLog('update student contact detail, name:'.$student->info->name);
            return response()->json($query);

        }else{
            if($request->phone_number['full']== ""){

                return response()->json(["error"=>"Please Enter a Number"]);
            }
            $query = StudentContactDetail::create([
                'add_students_id' => $id,
                'email' => $request->email,
                'secondary_email' => $request->secondary_email,
                'contact_number' => $request->phone_number['full'],
                'secondary_contact_number' => $request->phone_number2['full'],
                'address_details' => $request->address_details,
                'street_address' => $request->street_address,
                'suburb' => $request->suburb,
                'state' => $request->state,
                'country' => $request->country,
                'post_code' => $request->post_code,
            ]);
            Session::put('stuConTab', "true");
            $student = AddStudent::find($query->add_students_id);
            \LogActivity::addToLog('update student contact detail, name:'.$student->info->name);
            return response()->json('true');
        }
    }

     // For edit , add and update Student Other Information
    public function studentotherinformation(Request $request)
    {
        // for edit student other information
        if($request->forEdit == 'true'){
            $query = StudentOtherInformation::find($request->otherInfo_id);
            $query->update([
                'funding_type' => $request->funding_type,
                'sponsor_name' => $request->sponsor_name,
                'student_source' => $request->student_source,
                'cohort_name' => $request->cohort_name,
            ]);
            $student = AddStudent::find($query->add_students_id);

            \LogActivity::addToLog('update student other information, name:'.$student->info->name);
            return response()->json($query);
        }
        // for add student other information
        // if(empty(Session::get('lastInsertedId'))){
        //     return response()->json('no');
        // }
        $id = Session::get('lastInsertedId');
        if(StudentOtherInformation::where('add_students_id',$id)->first()){
            $query = StudentOtherInformation::where('add_students_id',$id)->first();
            $query->update([
                'funding_type' => $request->funding_type,
                'sponsor_name' => $request->sponsor_name,
                'student_source' => $request->student_source,
                'cohort_name' => $request->cohort_name,
            ]);
            $student = AddStudent::find($query->add_students_id);
            \LogActivity::addToLog('update student other information, name:'.$student->info->name ?? '');
            return response()->json($query);

        }else{
            $query = StudentOtherInformation::create([
                'add_students_id' => $id,
                'funding_type' => $request->funding_type,
                'sponsor_name' => $request->sponsor_name,
                'student_source' => $request->student_source,
                'cohort_name' => $request->cohort_name,
            ]);
            Session::forget('lastInsertedId');
            Session::forget('stuInfoTab');
            Session::forget('stuConTab');
            $student = AddStudent::find($query->add_students_id);
            \LogActivity::addToLog('add student other information, name:'.$student->info->name);

            // // code for notification
            // $user = User::role('Master User')->first();
            // $student = AddStudent::orderBy('id', 'DESC')->first();
            // $details = [
            //         'name' => $student->info->name,
            //         'email' => $student->contact->email,
            //         'student_id' => $student->id,
            // ];
            // $user->notify(new \App\Notifications\AdminNotification($details));
            return response()->json($query);
        }
    }
    // this is for Students List
    // public function studentlists(Request $request)
    // {
    //     $filter = $request->filter_val;
    //     $authUser = User::find(auth()->user()->id);
    //     $authUserRole = $authUser->getRoleNames()[0];
    //     $dropdown = Dropdown::with('dropdownType')->get();
    //     $countries = Country::all();
    //     $counsellor = User::role('Counsellor')->get();

    //     // if($authUserRole == 'Master User'){
    //     //     $allUsers = AddStudent::studentRelations()->where('visa_stu',false)->latest()->get();

    //     //     if($filter == 1){
    //     //             $allUsers = AddStudent::studentRelations()->where('visa_stu',false)->latest()->get();
    //     //             return view('admin.pages.student.append_filter_table', compact('allUsers','countries','counsellor','dropdown'))->render();
    //     //     }
    //     //     return view('admin.pages.student.studentlist', compact('allUsers','countries','counsellor','dropdown'));
    //     // }


    //     if($authUserRole == 'Visa'){
    //         $students = Visa::all();
    //         $student_id = [];
    //         foreach($students as $val){
    //             $student_id[] = $val->student_id;
    //         }
    //         $ownStudents= AddStudent::where('users_id',auth()->user()->id)->where('visa_stu',false)->latest()->get(); 
    //         foreach($ownStudents as $val){
    //             $student_id[] = $val->id;
    //         }
    //         $final = array_unique($student_id);
    //         $allUsers = AddStudent::studentRelations()->whereIn('id',$final)->where('visa_stu',false)->latest()->get();

    //     }
    //     if($authUserRole == 'Admissions'){
    //         $showStudentsToAdmissions = Application::whereIn('status', ['Submitted', 'Acceptance sent', 'Acceptance Information provided', 'Information Provided'])->latest()->get();
    //         $student_id = [];
    //         foreach($showStudentsToAdmissions as $val){
    //             $student_id[] = $val->add_students_id;
    //         }
    //         $ownStudents= AddStudent::where('users_id',auth()->user()->id)->where('visa _stu',false)->latest()->get(); 
    //         foreach($ownStudents as $val){
    //             $student_id[] = $val->id;
    //         }
    //         $final = array_unique($student_id);
    //         $allUsers = AddStudent::studentRelations()->whereIn('id',$final)->where('visa_stu',false)->latest()->get();
    //         // orWhere('users_id',auth()->user()->id)->latest()->get();
    //     }
    //     if($authUserRole == 'Counsellor'){
    //         $aboveTwoMonthDate = date("Y-m-d H:i:s",strtotime("+2 month"));
    //         $currentDate = Carbon::now()->toDateTimeString();

    //         $showStudentsToCounsellor = AddStudentDropdownType::whereBetween('course_start_date',[$currentDate,$aboveTwoMonthDate])->where('course_complete', 'Complete')->latest()->get();
    //         $studentWhoSubmitAppli = Application::whereIn('status', ['Submitted', 'Acceptance sent', 'Acceptance Information provided', 'Information Provided'])->latest()->get();
    //         foreach($showStudentsToCounsellor as $val){
    //             $student_id[] = $val->add_student_id;
    //         }
    //         foreach($studentWhoSubmitAppli as $val){
    //             $student_id[] = $val->add_students_id;
    //         }
            
    //         $studentWhoSubmitAppli = Application::whereIn('status', ['Submitted', 'Acceptance sent', 'Acceptance Information provided', 'Information Provided'])->latest()->get();
    //         foreach($studentWhoSubmitAppli as $val){
    //             $student_id[] = $val->add_students_id;
    //         }
    //         $ownStudents= AddStudent::where('users_id',auth()->user()->id)->get(); 
    //         foreach($ownStudents as $val){
    //             $student_id[] = $val->id;
    //         }
    //         $final = array_unique($student_id);
    //         $allUsers = AddStudent::studentRelations()->whereIn('id',$final)->where('visa_stu',false)->latest()->get();
    //     }
    //     // $allUsers = AddStudent::studentRelations()->where('visa_stu',false)->latest()->get();
    //     //             return view('admin.pages.student.append_filter_table', compact('allUsers','countries','counsellor','dropdown'))->render();
        // if($authUserRole == 'Management'){
        //     $aboveTwoMonthDate = date("Y-m-d H:i:s",strtotime("+2 month"));
        //     $currentDate = Carbon::now()->toDateTimeString();

        //     $showStudentsToCounsellor = AddStudentDropdownType::whereBetween('course_start_date',[$currentDate,$aboveTwoMonthDate])->where('course_complete', 'Complete')->latest()->get();
            
        //     $showStudentsToFinanceManager = AddStudentDropdownType::where('course_accepted','Accepted')->where('course_complete', 'Complete')->latest()->get();
        //     $student_id = [];
        //     $finance_student_id = [];
        //     foreach($showStudentsToCounsellor as $val){
        //         $student_id[] = $val->add_student_id;
        //     }
        //     foreach($showStudentsToFinanceManager as $val){
        //         $finance_student_id[] = $val->add_student_id;
        //     }
        //     $final = array_unique($student_id);
        //     $allUsers = AddStudent::where('users_id',auth()->user()->id)->latest()->get();
        //     if($filter == 1){
        //         $allUsers = AddStudent::studentRelations()->whereIn('id',$final)->where('visa_stu',false)->orWhere('users_id',auth()->user()->id)->where('visa_stu',false)->latest()->get();
        //         return view('admin.pages.student.append_filter_table', compact('allUsers','countries','counsellor','dropdown'))->render();
        //     }
        //     if($filter == 2){
        //         $final = array_unique($finance_student_id);
        //         $allUsers = AddStudent::studentRelations()->whereIn('id',$final)->where('visa_stu',false)->latest()->get();
        //         return view('admin.pages.student.append_filter_table', compact('allUsers','countries','counsellor','dropdown'))->render();
        //     }
        //     if($filter == 3){
        //         $taskstudent = Task::where('status','Complete')->get('add_students_id');
        //         $task_student_id = [];
        //         foreach($taskstudent as $val){
        //             $task_student_id[] = $val->add_students_id;
        //         }
        //         $final = array_unique($task_student_id);
        //         $allUsers = AddStudent::studentRelations()->whereIn('id',$final)->where('visa_stu',false)->latest()->get();
        //         return view('admin.pages.student.append_filter_table', compact('allUsers','countries','counsellor','dropdown'))->render();
        //     }
        //     if($filter == 4){
        //         $SubmitAppli = Application::where('status', 'Submitted')->latest()->get();
        //         $SubmitAppli_id = [];
        //         foreach($SubmitAppli as $val){
        //             $SubmitAppli_id[] = $val->add_students_id;
        //         }
        //         $final = array_unique($SubmitAppli_id);
        //         $allUsers = AddStudent::studentRelations()->whereIn('id',$final)->where('visa_stu',false)->latest()->get();
        //         return view('admin.pages.student.append_filter_table', compact('allUsers','countries','counsellor','dropdown'))->render();
        //     }
        //     if($filter == 5){
        //         $SubmitAppli = Application::where('status', 'Information Provided')->latest()->get();
        //         $SubmitAppli_id = [];
        //         foreach($SubmitAppli as $val){
        //             $SubmitAppli_id[] = $val->add_students_id;
        //         }
        //         $final = array_unique($SubmitAppli_id);
        //         $allUsers = AddStudent::studentRelations()->whereIn('id',$final)->where('visa_stu',false)->latest()->get();
        //         return view('admin.pages.student.append_filter_table', compact('allUsers','countries','counsellor','dropdown'))->render();
        //     }
        //     if($filter == 6){
        //         $SubmitAppli = Application::where('status', 'Acceptance sent')->latest()->get();
        //         $SubmitAppli_id = [];
        //         foreach($SubmitAppli as $val){
        //             $SubmitAppli_id[] = $val->add_students_id;
        //         }
        //         $final = array_unique($SubmitAppli_id);
        //         $allUsers = AddStudent::studentRelations()->whereIn('id',$final)->where('visa_stu',false)->latest()->get();
        //         return view('admin.pages.student.append_filter_table', compact('allUsers','countries','counsellor','dropdown'))->render();
        //     }
        //     if($filter == 7){
        //         $SubmitAppli = Application::where('status', 'Acceptance Information provided')->latest()->get();
        //         $SubmitAppli_id = [];
        //         foreach($SubmitAppli as $val){
        //             $SubmitAppli_id[] = $val->add_students_id;
        //         }
        //         $final = array_unique($SubmitAppli_id);
        //         $allUsers = AddStudent::studentRelations()->whereIn('id',$final)->where('visa_stu',false)->latest()->get();
        //         return view('admin.pages.student.append_filter_table', compact('allUsers','countries','counsellor','dropdown'))->render();
        //     }
        // }
        // if($authUserRole == 'Finance'){
        //     $showStudentsToFinanceManager = AddStudentDropdownType::where('course_accepted','Accepted')->where('course_complete', 'Complete')->latest()->get();
        //     $taskStudents = Task::where('status', 'Complete')->latest()->get();
        //     $student_id = [];
        //     foreach($showStudentsToFinanceManager as $val){
        //         $student_id[] = $val->add_student_id;
        //     }

        //     foreach($taskStudents as $val){
        //         $student_id[] = $val->student_id;
        //     }
        //     $ownStudents= AddStudent::where('users_id',auth()->user()->id)->where('visa_stu',false)->get(); 
        //     foreach($ownStudents as $val){
        //         $student_id[] = $val->id;
        //     }
        //     $final = array_unique($student_id);
        //     $allUsers = AddStudent::studentRelations()->whereIn('id',$final)->where('visa_stu',false)->orWhere('users_id',auth()->user()->id)->latest()->get();
        // }
        // if($authUserRole == 'Master User'){
        //     $allUsers = AddStudent::studentRelations()->where('visa_stu',false)->latest()->get();
        // }
        // return view('admin.pages.student.studentlist', compact('allUsers','countries','counsellor','dropdown'));
    // }
    public function studentlists_new(Request $request){
        $authUser = User::find(auth()->user()->id);
        $authUserRole = $authUser->getRoleNames()[0];
        $dropdown = Dropdown::with('dropdownType')->get();
        $countries = Country::all();
        $counsellor = User::role('Counsellor')->get();
        if($authUserRole == 'Management'){
            $aboveTwoMonthDate = date("Y-m-d H:i:s",strtotime("+2 month"));
            $currentDate = Carbon::now()->toDateTimeString();

            $showStudentsToCounsellor = AddStudentDropdownType::whereBetween('course_start_date',[$currentDate,$aboveTwoMonthDate])->where('course_complete', 'Complete')->latest()->get();
            
            $showStudentsToFinanceManager = AddStudentDropdownType::where('course_accepted','Accepted')->where('course_complete', 'Complete')->latest()->get();
            $student_id = [];
            $finance_student_id = [];
            foreach($showStudentsToCounsellor as $val){
                $student_id[] = $val->add_student_id;
            }
            foreach($showStudentsToFinanceManager as $val){
                $finance_student_id[] = $val->add_student_id;
            }
            $final = array_unique($student_id);
            $allUsers = AddStudent::studentRelations()->latest()->get();
            $filter = $request->filter_val;
            if($filter == 1){
                $allUsers = AddStudent::studentRelations()->whereIn('id',$final)->orWhere('users_id',auth()->user()->id)->latest()->get();
                return view('admin.pages.student.append_filter_table', compact('allUsers','countries','counsellor','dropdown'))->render();
            }
            if($filter == 2){
                $final = array_unique($finance_student_id);
                $allUsers = AddStudent::studentRelations()->whereIn('id',$final)->latest()->get();
                return view('admin.pages.student.append_filter_table', compact('allUsers','countries','counsellor','dropdown'))->render();
            }
            if($filter == 3){
                $taskstudent = Task::where('status','Complete')->get('add_students_id');
                $task_student_id = [];
                foreach($taskstudent as $val){
                    $task_student_id[] = $val->add_students_id;
                }
                $final = array_unique($task_student_id);
                $allUsers = AddStudent::studentRelations()->whereIn('id',$final)->latest()->get();
                return view('admin.pages.student.append_filter_table', compact('allUsers','countries','counsellor','dropdown'))->render();
            }
            if($filter == 4){
                $SubmitAppli = Application::where('status', 'Submitted')->latest()->get();
                $SubmitAppli_id = [];
                foreach($SubmitAppli as $val){
                    $SubmitAppli_id[] = $val->add_students_id;
                }
                $final = array_unique($SubmitAppli_id);
                $allUsers = AddStudent::studentRelations()->whereIn('id',$final)->latest()->get();
                return view('admin.pages.student.append_filter_table', compact('allUsers','countries','counsellor','dropdown'))->render();
            }
            if($filter == 5){
                $SubmitAppli = Application::where('status', 'Information Provided')->latest()->get();
                $SubmitAppli_id = [];
                foreach($SubmitAppli as $val){
                    $SubmitAppli_id[] = $val->add_students_id;
                }
                $final = array_unique($SubmitAppli_id);
                $allUsers = AddStudent::studentRelations()->whereIn('id',$final)->latest()->get();
                return view('admin.pages.student.append_filter_table', compact('allUsers','countries','counsellor','dropdown'))->render();
            }
            if($filter == 6){
                $SubmitAppli = Application::where('status', 'Acceptance sent')->latest()->get();
                $SubmitAppli_id = [];
                foreach($SubmitAppli as $val){
                    $SubmitAppli_id[] = $val->add_students_id;
                }
                $final = array_unique($SubmitAppli_id);
                $allUsers = AddStudent::studentRelations()->whereIn('id',$final)->latest()->get();
                return view('admin.pages.student.append_filter_table', compact('allUsers','countries','counsellor','dropdown'))->render();
            }
            if($filter == 7){
                $SubmitAppli = Application::where('status', 'Acceptance Information provided')->latest()->get();
                $SubmitAppli_id = [];
                foreach($SubmitAppli as $val){
                    $SubmitAppli_id[] = $val->add_students_id;
                }
                $final = array_unique($SubmitAppli_id);
                $allUsers = AddStudent::studentTwoRelation()->whereIn('id',$final)->where('visa_stu',0)->latest()->get();
                return view('admin.pages.student.append_filter_table', compact('allUsers','countries','counsellor','dropdown'))->render();
            }
        }
        // $allUsers = AddStudent::studentRelations()->where('visa_stu',0)->latest()->get();
        $all = AddStudent::studentTwoRelation()->where('visa_stu',0)->latest()->get();
        $all_u = [];
        foreach($all as $user){
            if($user->info && $user->contact){
                $all_u[]=$user;
            }
        }
        $allUsers= collect($all_u);
        return view('admin.pages.student.studentlist', compact('allUsers','countries','counsellor','dropdown'));

    }
    public function complete(Request $request){
        $student = AddStudent::find($request->id);
        $student->mark = $request->flag;
        $student->save();
        return response()->json('Mark '.$request->flag);
    }
}
