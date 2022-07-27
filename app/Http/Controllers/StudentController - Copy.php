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
        \LogActivity::addToLog('visit dashboard screen');

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
        $counsellor = User::role('Counselor')->get();
        $admission_officer = User::role('Admissions')->get();
        $countries = Country::all();
        $contactTab = Session::get('stuConTab');
        $infoTab = Session::get('stuInfoTab');
        $user = AddStudent::with('info')->with('contact')->with('otherInfo')->find(Session::get('lastInsertedId'));
        \LogActivity::addToLog('visit add student screen');
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
            $query = AddStudent::create([
                'office' => $request->office,
                'counsellor' => $request->counsellor,
                'admission_officer' => $request->admission_officer,
            ]);
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
        // dd($id);
        $user = AddStudent::studentRelations()->find($id);
        $dropdown = Dropdown::with('dropdownType')->get();
        $countries = Country::all();
        $counsellor = User::role('Counselor')->get();

        $student = AddStudent::find($id);
        $comments = $student->comments;

        $admission_officer = User::role('Admissions')->get();
        // \LogActivity::addToLog('visit student details page, student:'.$user->info->name);
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
        $counsellor = User::role('Counselor')->get();
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
        \LogActivity::addToLog('visit student detail page, student:'.$student->info->name);
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
        // return $request->surnameCheckbox;
        $name = $request->f_name." ".$request->l_name;
        // for edit student data
        if($request->forEdit == 'true'){
            $query = StudentInformation::find($request->StudentInfo_id);
            $query->update([
                'surname' => $request->surname,
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
                'surname' => $request->surname,
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
                'surname' => $request->surname,
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

            // code for notification
            $user = User::role('Master User')->first();
            $student = AddStudent::orderBy('id', 'DESC')->first();
            $details = [
                    'name' => $student->info->name,
                    'email' => $student->contact->email,
                    'student_id' => $student->id,
            ];
            $user->notify(new \App\Notifications\AdminNotification($details));
            return response()->json($query);
        }
    }

    // this is for Students List
    public function studentlists(Request $request)
    {
        // dd(auth()->user()->id);
        $authUser = User::find(auth()->user()->id);
        $authUserRole = $authUser->getRoleNames()[0];
        // dd();
        // if(!empty($authUser->permission('show students to counselor')->first()) && ($authUserRole != 'Master User')){
        if($authUserRole == 'Visa'){
            // dd('yes');
            $students = Visa::all();
            // dd($students);
            $student_id = [];
            foreach($students as $val){
                $student_id[] = $val->student_id;
            }
            // dd($student_id);
            $final = array_unique($student_id);
            // dd($final);
            $allUsers = AddStudent::studentRelations()->whereIn('id',$final)->get();
            // dd($allUsers);
        }
        if($authUserRole == 'Admissions'){
            // dd('yes');
            $showStudentsToAdmissions = Application::whereIn('status', ['Submitted', 'Acceptance sent', 'Acceptance Information provided', 'Information Provided'])->get();
            // dd($showStudentsToAdmissions);
            $student_id = [];
            foreach($showStudentsToAdmissions as $val){
                $student_id[] = $val->add_students_id;
            }
            // dd($student_id);
            $final = array_unique($student_id);
            // dd($final);
            $allUsers = AddStudent::studentRelations()->whereIn('id',$final)->get();
            // dd($allUsers);
        }
        if($authUserRole == 'Counselor'){
            // dd('yes');
            $lastTwoMonthDate = date("Y-m-d H:i:s",strtotime("-2 month"));
            $aboveTwoMonthDate = date("Y-m-d H:i:s",strtotime("+2 month"));
            // dd($lastTwoMonthDate);
            $currentDate = Carbon::now()->toDateTimeString();
            $showStudentsToCounsellor = AddStudentDropdownType::whereBetween('course_complete_date',[$lastTwoMonthDate,$currentDate])->where    ('course_complete', 'Complete')->get();
            // $visaStudents = AddStudentDropdownType::whereBetween('course_complete_date',[$aboveTwoMonthDate,$currentDate])->where    ('status', 'Complete')->get();
            $studentWhoSubmitAppli = Application::whereIn('status', ['Submitted', 'Acceptance sent', 'Acceptance Information provided', 'Information Provided'])->get();
            // $visaStudents = Visa::all();
            // dd($studentWhoSubmitAppli);
            $student_id = [];
            foreach($showStudentsToCounsellor as $val){
                $student_id[] = $val->add_student_id;
            }
            foreach($studentWhoSubmitAppli as $val){
                $student_id[] = $val->add_students_id;
            }
            // foreach($visaStudents as $val){
            //     $student_id[] = $val->student_id;
            // }
            // dd($student_id);
            $final = array_unique($student_id);
            // dd($final);
            $allUsers = AddStudent::studentRelations()->whereIn('id',$final)->get();
            // dd($allUsers);
        }
        if($authUserRole == 'Master User'){
            $allUsers = AddStudent::studentRelations()->get();
        }
        // dd($allUsers);
        if($authUserRole == 'Finance'){
            $showStudentsToFinanceManager = AddStudentDropdownType::where('course_accepted','Accepted')->where('course_complete', 'Complete')->get();
            $visaStudents = Visa::where('service_fee', '>', 0)->where('status', 'Complete')->get();
            // dd($visaStudents);
            // dd($showStudentsToFinanceManager);
            $student_id = [];
            foreach($showStudentsToFinanceManager as $val){
                $student_id[] = $val->add_student_id;
            }
            foreach($visaStudents as $val){
                $student_id[] = $val->student_id;
            }
            // dd($student_id);
            $final = array_unique($student_id);
            $allUsers = AddStudent::studentRelations()->whereIn('id',$final)->get();
        }




        // dd(array_unique($student_id));
        $dropdown = Dropdown::with('dropdownType')->get();
        $countries = Country::all();
        $counsellor = User::role('Counselor')->get();
        // $allUsers = AddStudent::studentRelations()->whereIn('id',$final)->get();
        // dd($allUsers);
        \LogActivity::addToLog('visit student list page');
        return view('admin.pages.student.studentlist', compact('allUsers','countries','counsellor','dropdown'));





        // $lastTwoMonthDate = date("Y-m-d H:i:s",strtotime("-2 month"));
        // $currentDate = Carbon::now()->toDateTimeString();
        // $showStudentsToCounsellor = AddStudentDropdownType::whereBetween('course_complete_date',[$lastTwoMonthDate,$currentDate])->where('course_complete', 'Complete')->get();
        // $showStudentsToFinanceManager = AddStudentDropdownType::where('course_accepted','Accepted')->where('course_complete', 'Complete')->get();
        // // dd($showStudentsToFinanceManager);
        // $dropdown = Dropdown::with('dropdownType')->get();
        // $countries = Country::all();
        // $counsellor = User::role('Counselor')->get();
        // $allUsers = AddStudent::studentRelations()->get();
        // // dd($showStudentsToCounsellor);
        // \LogActivity::addToLog('visit student list page');
        // return view('admin.pages.student.studentlist', compact('showStudentsToFinanceManager','showStudentsToCounsellor','allUsers','countries','counsellor','dropdown'));
    }
    // public function custom_validation_number(Request $request){
    //     if(!$request->phone){
    //         return response()->json('Enter a number');
    //     }
    // }
}
