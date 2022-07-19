<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests\AccommodationRequest;
use App\Http\Requests\VisaRequest;
use App\Http\Requests\SmsStudentRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\AttachmentRequest;

use App\Models\DropdownType;
use App\Models\Task;
use App\Models\Accommodation;
use App\Models\AddStudent;
use App\Models\Dropdown;
use App\Models\AddStudentDropdownType;
use App\Models\Visa;
use App\Models\Comment;
use App\Models\StudentInformation;
use App\Models\StudentContactDetail;
use App\Models\Country;
use App\Models\Education;
use App\Models\Application;
use App\Models\SchoolContact;
use App\Models\University;
use App\Models\User;
use App\Models\Visa_Comment;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;
use Carbon\CarbonInterval;
use Msegat;

use Validator;
use Illuminate\Support\Carbon;
use Plivo\RestClient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
class StudentButtonController extends Controller
{
    public function accomodation($id){
        $accomodation_types= DropdownType::where('dropdowns_id',13)->get();
        $accomodation_status= DropdownType::where('dropdowns_id',14)->get();
        $student_id = $id;
        $accommodation = Accommodation::where('add_students_id', $id)->get();
        return view('admin.pages.student_buttons.accomodation_index',compact('accommodation', 'accomodation_types','accomodation_status','student_id'));
    }
    public function add_accomodation($id){
        $accomodation_types= DropdownType::where('dropdowns_id',13)->get();
        $accomodation_status= DropdownType::where('dropdowns_id',14)->get();
        $student_id = $id;
        return view('admin.pages.student_buttons.accomodation',compact('accomodation_types','accomodation_status','student_id'));
    }
    public function delete_accomodation($id)
    {
        Accommodation::find($id)->delete();
        parent::successMessage("Record Deleted Successfully");
        \LogActivity::addToLog('Delete Accomodation: '.$id);
        return redirect()->back();
    }
    public function store_accomodation(AccommodationRequest $request){
        $accomodation = new Accommodation;
        $validate = Validator::make($request->all(), [
            'airport_pickup'=>'required',
        ]);

        if($validate->fails()){
            return response()->json(['message'=>$errors()]);
        }
        $accomodation->create($request->all());
        parent::successMessage("Add Accommodation Successfully");
        \LogActivity::addToLog('Save Accomodation');
        return redirect()->route('accomodation', $request->add_students_id);

    }
    public function edit_accomodation($id){
        $accomodation_types= DropdownType::where('dropdowns_id',13)->get();
        $accomodation_status= DropdownType::where('dropdowns_id',14)->get();
        $accommodation = Accommodation::find($id);
        \LogActivity::addToLog('Accomodation Edit'.$id);
        return view('admin.pages.student_buttons.edit_accomodation',compact('accomodation_types','accomodation_status','accommodation'));
    }

     public function update_accomodation(AccommodationRequest $request){
        $accomodation = Accommodation::find($request->updated_id);
        $validate = Validator::make($request->all(), [
            'airport_pickup'=>'required',
        ]);

        if($validate->fails()){
            return response()->json(['message'=>$errors()]);
        }
        $accomodation->update($request->all());
        parent::successMessage("Add Accommodation Successfully");
        \LogActivity::addToLog('Update Accomodation'.$request->updated_id);
        return redirect()->route('accomodation', $request->add_students_id);
    }
    public function add_visa(){
        $case_officers = DropdownType::where('dropdowns_id',8)->get();
        $visa_type = DropdownType::where('dropdowns_id',9)->get();
        $status = DropdownType::where('dropdowns_id',10)->get();
        $immigeration_pay_method = DropdownType::where('dropdowns_id',11)->get();
        $service_pay_method = DropdownType::where('dropdowns_id',12)->get();
        $students = AddStudent::get();
        $countries = Country::all();

        return view('admin.pages.student_buttons.add_visa',compact('case_officers','students','visa_type','status','immigeration_pay_method','service_pay_method','countries'));
    }
    public function store_visa(Request $request){
        if(empty($request->name) && empty($request->student_name)){
            parent::errorMessage("Check New Student CheckBox OR Check Existing Student Checkbox Then Form Submit");
            return redirect()->back();
        }
        $input = $request->all();

        if($request->student_name){

            $existing_stu = AddStudent::find($request->student_name);
            $existing_stu->visa_stu = true;
            $existing_stu->users_id = Auth::user()->id;

            $existing_stu->save();

            $visa = new Visa;
            $visa->case_officer = $request->case_officer;
            $visa->student_id = $request->student_name;
            $visa->date_visa = Carbon::now()->format('d/m/Y');
            $visa->visa_type = $request->visa_type;
            $visa->num_applicants = $request->num_applicants;
            $visa->visa_status = $request->visa_status;
            $visa->immigration_fees = $request->immigration_fees;
            $visa->immigration_pay_method = $request->immigration_pay_method;
            $visa->immigration_dop = $request->immigration_dop;
            $visa->service_fee = $request->service_fee;
            $visa->service_pay_method = $request->service_pay_method;
            $visa->service_dop = $request->service_dop;
            $visa->visa_expire_date = $request->visa_expire_date;
            $visa->save();
            \LogActivity::addToLog('Add Visa Form of student'.$request->student_name);
            parent::successMessage("Add Visa Successfully");
            return redirect()->route('visa.list');
        }
        else{
            $student = new AddStudent;
            $student->visa_stu = true;
            $student->users_id = Auth::user()->id;
            $student->save();
            $student_info = new StudentInformation;
            $student_info->name = $request->name;
            $student_info->add_students_id = $student->id;
            $student_info->nationality = $request->nationality;
            $student_info->save();

            $student_contact = new StudentContactDetail;
            $student_contact->contact_number= $request->contact_number;
            $student_contact->email = $request->email;
            $student_contact->add_students_id = $student->id;
            $student_contact->save();

            $visa = new Visa;
            $visa->case_officer = $request->case_officer;
            $visa->student_id = $request->student_name;
            $visa->date_visa = Carbon::now()->format('d/m/Y');
            $visa->visa_type = $request->visa_type;
            $visa->num_applicants = $request->num_applicants;
            $visa->visa_status = $request->visa_status;
            $visa->immigration_fees = $request->immigration_fees;
            $visa->immigration_pay_method = $request->immigration_pay_method;
            $visa->immigration_dop = $request->immigration_dop;
            $visa->service_fee = $request->service_fee;
            $visa->service_pay_method = $request->service_pay_method;
            $visa->service_dop = $request->service_dop;
            $visa->student_id = $student->id;
            $visa->save();
            \LogActivity::addToLog('Add Visa Form of student'.$request->name);
            parent::successMessage("Add Visa Successfully");
            return redirect()->route('visa.list');
        }
    }
    public function visa_list(){
        $student_visa =  Visa::latest()->get();
        $unpaid_visa=  Visa::where('immigration_fees','=',0)->orWhere('service_fee','=',0)->latest()->get();
        $visa_arr = [];
        foreach($student_visa as $visa){
            if($visa->select_status == 'Approved'){
                $expire_date= $visa->visa_expire_date;
                $current = Carbon::now(); 
                $date= Carbon::parse($expire_date);
                $diff_date = $date->diffInDays($current, true);
                if($diff_date <=60 || $diff_date <=61){
                    $visa_arr[]= $visa;
                }

                // $visa_create_date = $visa->created_at;
                // $current_date = Carbon::now();
                // $diff_date = $current_date->diffInDays($visa_create_date, true);
                // if($current_date->daysInMonth == '30'){
                //     $subtract_date = $current_date->subDays($diff_date+1)->format('d-m-Y'); 
                // }
                // $subtract_date = $current_date->subDays($diff_date)->format('d-m-Y');
                
                // $visa_expire_date = $visa->visa_expire_date;
                // $carbon_obj = Carbon::parse($visa_expire_date);
                // $visa_expire_date = $carbon_obj->subMonths(2)->format('d-m-Y');
                // if($visa_expire_date == $subtract_date){
                //     $visa_arr[]= $visa;
                // }
            }
        }
        return view('admin.pages.student_buttons.visa',compact('student_visa','visa_arr','unpaid_visa'));
    }
     public function view_visa($id){
         $visa = Visa::find($id);
         if($visa->student){
            $student_id = $visa->student->id;
            $student = StudentInformation::where('add_students_id',$student_id)->first();
            // \LogActivity::addToLog('Watch Detail of Visa of student:'.$student['name']);
            return view('admin.pages.student_buttons.view_visa',compact('visa','student_id'));
        }
     }
     public function visa_complete_status(Request $request){
        if($request->val == 'Complete'){
            $value = 'In-Complete';
                        \LogActivity::addToLog('Change Status of Visa is in-complete');

        } else {
            $value = 'Complete';
            \LogActivity::addToLog('Change Status of Visa is complete');

        }
        $updated_row = Visa::find($request->updated_row_id);
        $updated_row->update([
            'status' => $value,
        ]);
        return response()->json($updated_row->status);
     }

     public function delete_visa($id){
         $visa = Visa::find($id);
         $student_id = $visa->student->id;
         \LogActivity::addToLog('Delete Visa:'.$visa->student['name']);
         $visa->delete();
         parent::successMessage("Delete Visa Successfully");
         return redirect()->route('visa.list',$student_id);
     }
     public function edit_visa($id){
        $case_officers = DropdownType::where('dropdowns_id',8)->get();
        $visa_type = DropdownType::where('dropdowns_id',9)->get();
        $status = DropdownType::where('dropdowns_id',10)->get();
        $immigeration_pay_method = DropdownType::where('dropdowns_id',11)->get();
        $service_pay_method = DropdownType::where('dropdowns_id',12)->get();
        $students = AddStudent::get();
        $visa = Visa::find($id);
        \LogActivity::addToLog('Edit Visa'.$id);
        return view('admin.pages.student_buttons.edit_visa',compact('case_officers','students','visa_type','status','immigeration_pay_method','service_pay_method','visa'));
     }
     public function visa_status(Request $request){
        $updated_row = visa::find($request->updated_row_id);
        $updated_row->update([
            'status' => $request->val,
        ]);
        return response()->json($updated_row);
     }
     public function visa_comment(Request $request, $id){
        $visa_comment =new Visa_Comment;
        $visa_comment->user_id = Auth::user()->id;
        $visa_comment->visa_id = $id;
        $visa_comment->comment_text = $request->visa_comment;
        $visa_comment->save();
        \LogActivity::addToLog('Comment On Visa :'.$id);
        parent::successMessage("Add Comment Successfully");
        return redirect()->back();
     }
     public function show_visa_comment($id){
         $visa = Visa::find($id);
         $comments = $visa->comment_visa;
        //  \LogActivity::addToLog('View Visa Comments');
         return view('admin.pages.student_buttons.showVisaCommend',compact('comments'));
     }
     public function update_visa(VisaRequest $request, $id){
            $input = $request->all();

            $student_info =  StudentInformation::where('add_students_id',$request->student_id)->first();
            $student_info->name = $request->name;
            $student_info->add_students_id = $request->student_id;
            $student_info->save();

            $student_contact = StudentContactDetail::where('add_students_id',$request->student_id)->first();
            $student_contact->contact_number= $request->phone_number;
            $student_contact->email = $request->email;
            $student_contact->add_students_id = $request->student_id;
            $student_contact->save();

            $visa = Visa::find($id);
            $visa->case_officer = $request->case_officer;
            $visa->student_id = $request->student_name;
            // $visa->date_visa = $request->date_visa;
            $visa->visa_type = $request->visa_type;
            $visa->num_applicants = $request->num_applicants;
            $visa->visa_status = $request->visa_status;
            $visa->immigration_fees = $request->immigration_fees;
            $visa->immigration_pay_method = $request->immigration_pay_method;
            $visa->immigration_dop = $request->immigration_dop;
            $visa->service_fee = $request->service_fee;
            $visa->service_pay_method = $request->service_pay_method;
            $visa->service_dop = $request->service_dop;
            $visa->student_id = $request->student_id;
            $visa->save();
            \LogActivity::addToLog('Update Visa Successfully:'.$request->student_name);
            parent::successMessage("Update Visa Successfully");
            return redirect()->back();
    }
    public function send_sms_student(SmsStudentRequest $request){
        // $sender = '+966551468888';
        $receiver = $request->number;
        if(count($receiver)>0){
            foreach($receiver as $num){
                if($num){
                    $msg = Msegat::sendMessage($num, 'رمز التحقق: 1234');
                    // $client = new RestClient(env('PLIVO_AUTH_ID'),env('PLIVO_AUTH_TOKEN'));
                    // $response = $client->messages->create([
                        // "src" => $sender,
                        // "dst" => '+92'.substr($num,1),
                        // "dst" => $num,
                        // "text" => $request->message,
                    \LogActivity::addToLog('Send Sms on this number:'.$num);
                    parent::successMessage("Send Message Successfully");
                }
            }
        }
        else{
            parent::errorMessage("Select atleast a single Number");
        }
        return redirect()->back();
    }

    public function task($id){
        // dd($id);
        $student_id = $id;
        
        $tasks = Task::where('add_students_id', $student_id)->get();
        return view('admin.pages.student_buttons.task_index',compact('tasks','student_id'));
    }
    public function delete_task($id)
    {
        Task::find($id)->delete();
        parent::successMessage("Record Deleted Successfully");
        \LogActivity::addToLog('Delete Task: '.$id);
        return redirect()->back();
    }
    public function save_task(TaskRequest $request){
        $query = Task::create([
            'add_students_id' => $request->student_id,
            'created_users_id' => auth()->user()->id,
            'task_name' => $request->name,
            'date' => $request->date,
        ]);
        \LogActivity::addToLog('Save Task');
        return response()->json($query);

    }
    public function edit_task(Request $request){
        $task = Task::find($request->edit_id);
        \LogActivity::addToLog('Edit Task : '.$request->edit_id);
        return response()->json($task);
    }

     public function update_task(Request $request){
        $task = Task::find($request->updated_id);
        $task->update([
            'task_name' => $request->update_name,
            'date' => $request->update_date,
        ]);
        return response()->json($task);
        \LogActivity::addToLog('Update Task'.$request->updated_id);
    }

    public function course($id){

        $student = AddStudent::find($id);
        $courses = $student->dropdowntypess;
        $allcourses = DropdownType::where('dropdowns_id', 15)->get();
        // dd($id);
        return view('admin.pages.student_buttons.course_index',compact('courses','student', 'allcourses'));
    }

    public function delete_course($id)
    {
        AddStudentDropdownType::find($id)->delete();
        parent::successMessage("Record Deleted Successfully");
        \LogActivity::addToLog('Delete Course: '.$id);
        return redirect()->back();
    }

    public function edit_course(Request $request){
        $course = AddStudentDropdownType::find($request->edit_id);
        $coursename = DropdownType::find($course->dropdown_type_id)->name;
        $allcourses = DropdownType::where('dropdowns_id', 15)->get();
        return response()->json([$coursename , $allcourses]);
    }
    public function update_task_status(Request $request){
        if($request->val == 'Complete'){
            $value = 'UnComplete';
        } else {
            $value = 'Complete';
        }
        $updated_row = Task::find($request->updated_row_id);
        $updated_row->update([
            'status' => $value,
        ]);
        \LogActivity::addToLog('Update That Task: '.$request->updated_row_id);
        return response()->json($updated_row);
    }

    public function update_course(Request $request){
        $course = AddStudentDropdownType::find($request->row_id);
        $course->update([
            'dropdown_type_id' => $request->updated_id,
        ]);
        return response()->json($course);
        \LogActivity::addToLog('Update Course'.$request->updated_id);
    }
    public function save_courses(Request $request){
        $student = AddStudent::find($request->student_id);
        foreach($request->Courses as $val){
            $course = DropdownType::find($val);
            $student->dropdowntypess()->attach($course);
       }
        \LogActivity::addToLog('Save Course');
        return response()->json('true');
    }
    public function save_task_comment(Request $request){
        $query = Comment::create([
            'user_id' => auth()->user()->id,
            'add_student_id' => $request->student_id,
            'comment_text' => $request->val,
            'task_id' => $request->course_rw_id,
        ]);
        parent::successMessage("Comment Added Successfully");
        \LogActivity::addToLog('Save Comment on task');
        return response()->json('$query');
    }
    public function showTaskComments($course_id , $student_id){
        $authUser = User::find(auth()->user()->id);
        $authUserRole = $authUser->getRoleNames()[0];
        if($authUserRole == 'Management'){
            $comments = Comment::where('add_student_id', $student_id)->where('task_id',$course_id)->get();
        }else {
            $comments = Comment::where('add_student_id', $student_id)->where('user_id',auth()->user()->id)->where('task_id',$course_id)->get();
        }
        // dd($comments);
        // \LogActivity::addToLog('Visa Task Comments');
        return view('admin.pages.student_buttons.showTaskComment',compact('comments'));
    }
    public function complete_status(Request $request){
        if($request->val == 'Complete'){
            $value = 'In-Complete';
        } else {
            $value = 'Complete';
        }
        $updated_row = AddStudentDropdownType::find($request->updated_row_id);
        $updated_row->update([
            'course_complete' => $value,
        ]);
        return response()->json($updated_row);
    }
    public function accepted_status(Request $request){
        $updated_row = AddStudentDropdownType::find($request->updated_row_id);
        $updated_row->update([
            'course_accepted' => $request->val,
            'course_complete_date' => Carbon::now(),
        ]);
        return response()->json($updated_row);
    }
    public function save_comment(Request $request){
        $query = Comment::create([
            'user_id' => auth()->user()->id,
            'add_student_id' => $request->student_id,
            'comment_text' => $request->text_area,
        ]);
        
       
        parent::successMessage("Record Added Successfully");
        return redirect()->back();
    }
    public function save_course_comment(Request $request){
        // dd($request->all());
        $query = Comment::create([
            'user_id' => auth()->user()->id,
            'add_student_id' => $request->student_id,
            'comment_text' => $request->val,
            'course_id' => $request->course_rw_id,
        ]);
        $updated_row = AddStudentDropdownType::find($request->id)->first();
        $updated_row->course_start_date = $request->course_start_date;
        $updated_row->save();
        parent::successMessage("Comment Added Successfully");

        // code for notification
        if(auth()->user()->getRoleNames()[0] == "Counselor"){
            $user = User::role('Master User')->first();
            $student = AddStudent::find($request->student_id);
            $details = [
                    'name' => $student->info->name,
                    'email' => $student->contact->email,
                    'student_id' => $student->id,
                    'comment' => $request->val,
                    'creater_name' => auth()->user()->name,
            ];
            $user->notify(new \App\Notifications\AdminNotification($details));
        }

        return response()->json('$query');
    }
    public function showCourseComments($course_id , $student_id){
        $authUser = User::find(auth()->user()->id);
        $authUserRole = $authUser->getRoleNames()[0];
        if($authUserRole == 'Management'){
            $comments = Comment::where('add_student_id', $student_id)->where('course_id',$course_id)->get();
        } else {
            $comments = Comment::where('add_student_id', $student_id)->where('user_id',auth()->user()->id)->where('course_id',$course_id)->get();
        }


        // dd($comments);
        return view('admin.pages.student_buttons.showCourseComment',compact('comments'));
    }
    public function delete_comment($id){
        Comment::find($id)->delete();
        \LogActivity::addToLog('Delete Course Comment: '.$id);
        parent::successMessage("Record Deleted Successfully");
        return redirect()->back();
    }
    public function delete_visa_comment($id){
        Visa_Comment::find($id)->delete();
        \LogActivity::addToLog('Delete Visa Comment: '.$id);
        parent::successMessage("Record Deleted Successfully");
        return redirect()->back();
    }
    public function search(Request $request){
        $results = Search::new()
        ->add(DropdownType::class, 'name')
        ->addWhen(Auth::user()->hasRole('Master User'),DropdownType::class, 'name')
        ->add(StudentInformation::class, 'name')
        ->add(StudentContactDetail::class, 'contact_number')
        ->add(StudentContactDetail::class, 'email')
        ->add(University::class, 'en_title')
        ->add(SchoolContact::class, 'job_title')
        ->addWhen(Auth::user()->hasRole('Master User'),User::class, 'name')
        ->add(Task::class, 'task_name')
        ->add(Application::class, 'inst_name')
        ->beginWithWildcard()
        ->paginate()
        ->get($request->generic_search);
        // dd($results);
        return view('admin.pages.search',compact('results'));
    }
    public function save_attachment(AttachmentRequest $request){
        $student = StudentInformation::where('add_students_id',$request->student_id)->first();
        foreach($request->profile_photo as $image_uni)
        {
            $file = Storage::disk('dropbox')->put($student->name.'-'.$student->id,$image_uni);
            parent::successMessage("Add Attachments Successfully");
        }
        return redirect()->back();
    }
    public function rejected_reason($id, Request $request){
        $application = Application::find($id);
        $application->rejected_reason = $request->rejected_reason;
        $application->save();
        \LogActivity::addToLog('Add Rejected Reason for Applicatioin id is: '.$id);
        parent::successMessage("Add Rejected Reason Successfully");
        return redirect()->back();
    }
    public function declined_reason(Request $request, $id){
        $application = Application::find($id);
        $application->declined_reason = $request->declined_reason;
        $application->save();
        \LogActivity::addToLog('Add Rejected Reasons for Applicatioin id is: '.$id);
        parent::successMessage("Add Declined Reason Successfully");
        return redirect()->back();
    }
    public function visa_status_two(Request $request){
        $visa = Visa::find($request->visa_id);
        $visa->select_status = $request->val;
        $visa->save();
        return redirect()->json(['status'=>$visa->status]);
    }
    public function approved_status(Request $request, $id){
        $visa = Visa::find($id);
        $visa->approval_date = $request->approval_date;
        $visa->visa_expire_date = $request->expiration_date;
        $visa->select_status = "Approved";
        $visa->save();
        parent::successMessage('Status Approved Successfully');
        return redirect()->back();
    }
}