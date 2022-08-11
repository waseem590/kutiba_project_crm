<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolContact;
use App\Http\Requests\SchoolContactRequest;
use App\Http\Requests\UnivesityRequest;
use App\Http\Requests\LoginDetailRequest;
use App\Models\University;
use App\Models\LoginDetail;
use App\Models\User;
use Auth;
use Facade\FlareClient\Stacktrace\File;
use Session;

class UniversityController extends Controller
{
    public function index(){
        return view('admin.pages.university.knowledge_center');
    }
    public function school_contacts(){
        $data = SchoolContact::all();
        return view('admin.pages.university.school_contacts_index', compact('data'));
    }
    public function edit_school_contacts($id){
        $data = SchoolContact::find($id);
        return view('admin.pages.university.edit_school_contacts', compact('data'));
    }
    public function update_school_contacts(Request $request){
        $query = SchoolContact::find($request->updated_id);
        $query->update([
            'staff_name' => $request->staf_name,
            'job_title' => $request->job_title,
            'email' => $request->email,
            'contact_no' => $request->phone_number['full'],
            'contact_no2' => $request->phone_number2['full'],
            'dob' => $request->dob,
            'notes' => $request->notes,
        ]);
        parent::successMessage("Record Updated Successfully");
        \LogActivity::addToLog('update school contacts which is name:'.$query->job_title);
        return redirect()->route('school_contacts');
    }
    public function delete_school_contacts($id){
        $contact= SchoolContact::find($id);
        \LogActivity::addToLog('delete school contacts which is name:'.$contact->job_title);
        $contact->delete();
        parent::successMessage("Record Deleted Successfully");
        return redirect()->route('school_contacts');
    }
    public function add_school_contacts(){
        return view('admin.pages.university.school_contacts');        
    }


    public function save_school_contacts(Request $request){
        SchoolContact::create([
            'staff_name' => $request->staf_name,
            'job_title' => $request->job_title,
            'email' => $request->email,
            'contact_no' => $request->phone_number['full'],
            'contact_no2' => $request->phone_number2['full'],
            'dob' => $request->dob,
            'notes' => $request->notes,
            'institution' => $request->institution,
        ]);
        parent::successMessage("Record Add Successfully");
        \LogActivity::addToLog('add school contact which is name:'.$request->job_title);
        return redirect()->route('school_contacts');
    }
    public function store_universities(Request $request){
        $input = $request->all();
        // dd($input);
        $university = new University;
        $university->en_title =$input['en_title'];
        $university->ar_title =$input['ar_title'];
        $university->web_link =$input['web_link'];

        $image_uni = $request->file('uni_file');
        // return $image_uni;
        if($image_uni){
            $file_fullname = $image_uni->getClientOriginalName();
            $file_name = pathinfo($file_fullname, PATHINFO_FILENAME);
            $file_extension = $image_uni->getClientOriginalExtension();
            $rand_namer = now();
            $rand_namer = preg_replace('/\s+/', '_', trim($rand_namer));
            $rand_namer = preg_replace('/:+/', '_', trim($rand_namer));
            $file_namefor_db =$file_name . '_' . $rand_namer . '.' . $file_extension;
            $file_namefor_db = preg_replace('/\s+/', '_', trim($file_namefor_db));
            $image_uni->storeAs('/university/images/',$file_namefor_db,'public');
            $pic = url('/storage/university/images/'.$file_namefor_db);
            $university->uni_file = $pic;
        }
        $doc_file = $request->file('doc_file');
        // return $image;
        if($doc_file){
            $file_fullname = $doc_file->getClientOriginalName();
            $file_name = pathinfo($file_fullname, PATHINFO_FILENAME);
            $file_extension = $doc_file->getClientOriginalExtension();
            $rand_namer = now();
            $rand_namer = preg_replace('/\s+/', '_', trim($rand_namer));
            $rand_namer = preg_replace('/:+/', '_', trim($rand_namer));
            $file_namefor_db =$file_name . '_' . $rand_namer . '.' . $file_extension;
            $file_namefor_db = preg_replace('/\s+/', '_', trim($file_namefor_db));
            $doc_file->storeAs('university/word' ,$file_namefor_db,'public');
            $pic = url('storage/university/word/' . $file_namefor_db);
            $university->doc_file = $pic;
        }
        $exl_file = $request->file('exl_file');
        // return $image;
        if($exl_file){
            $file_fullname = $exl_file->getClientOriginalName();
            $file_name = pathinfo($file_fullname, PATHINFO_FILENAME);
            $file_extension = $exl_file->getClientOriginalExtension();
            $rand_namer = now();
            $rand_namer = preg_replace('/\s+/', '_', trim($rand_namer));
            $rand_namer = preg_replace('/:+/', '_', trim($rand_namer));
            $file_namefor_db =$file_name . '_' . $rand_namer . '.' . $file_extension;
            $file_namefor_db = preg_replace('/\s+/', '_', trim($file_namefor_db));
            $exl_file->storeAs('university/excel' ,$file_namefor_db,'public');
            $pic = url('storage/university/excel/' . $file_namefor_db);
            $university->exl_file = $pic;
        }
        $ppt_file = $request->file('ppt_file');
        // return $image;
        if($ppt_file){
            $file_fullname = $ppt_file->getClientOriginalName();
            $file_name = pathinfo($file_fullname, PATHINFO_FILENAME);
            $file_extension = $ppt_file->getClientOriginalExtension();
            $rand_namer = now();
            $rand_namer = preg_replace('/\s+/', '_', trim($rand_namer));
            $rand_namer = preg_replace('/:+/', '_', trim($rand_namer));
            $file_namefor_db =$file_name . '_' . $rand_namer . '.' . $file_extension;
            $file_namefor_db = preg_replace('/\s+/', '_', trim($file_namefor_db));
            $ppt_file->storeAs('university/powerpoint' ,$file_namefor_db,'public');
            $pic = url('storage/university/powerpoint/' . $file_namefor_db);
            $university->exl_file = $pic;
        }
        $university->english_summernote =$input['english_summernote'];
        $university->arabic_summernote =$input['arabic_summernote'];
        $university->user_id =Auth::user()->id;
        $university->save();
        parent::successMessage("Add University Successfully");
        \LogActivity::addToLog('Add University which is name:'.$input['en_title']);
        return redirect()->back();
    }
    public function language_switcher($locale, $page=1){
        app()->setLocale($locale);
        session()->put('locale', $locale);

        $count_uni = University::latest()->get();
        $universities = $count_uni->toArray();
        $universities = \LogActivity::paginate($universities,$pagesize=6,$page);
        if(session()->get('locale')=="ar"){
            return view('admin.pages.university.knowledge_center_ar', compact('universities','count_uni'));
        }
        if(session()->get('locale')=="en"){
            return view('admin.pages.university.knowledge_center', compact('universities','count_uni'));
        }
    }
    public function university_detail($id){
        $university = University::find($id);
        // \LogActivity::addToLog('See detail of university:'.$university->en_title);
        return view('admin.pages.university.university_detail',compact('university'));
    }
    public function university_detail_ar($id){
        $university = University::find($id);
        // \LogActivity::addToLog('See detail of university:'.$university->ar_title);
        return view('admin.pages.university.university_detail_ar',compact('university'));
    }
    public function login_details(){
        $login_details = LoginDetail::get();
        return view('admin.pages.university.show_login_details',compact('login_details'));
    }
    public function add_login_details(){
        $users = User::get();
        return view('admin.pages.university.login_details',compact('users'));
    }
    public function store_login_details(Request $request){
        $input = $request->all();
        $input['show_password'] = $request->password;
        $input['password'] = bcrypt($request->password);
        $login = new LoginDetail;
        $new_login = $login->create($input);
        parent::successMessage("Add Login Detail Successfully");
        // dd($new_login->user);
        \LogActivity::addToLog('Add login Detail name:'.$new_login->user_name);
        return redirect()->back();
    }
    public function delete_login_detail($id){
        $login_detail= LoginDetail::find($id);
        \LogActivity::addToLog('delete login details of user:'.$login_detail->user_name);
        $login_detail->delete();
        parent::successMessage("Record Deleted Successfully");
        return redirect()->back();
    }
    public function edit_login_detail($id){
        $login_detail = LoginDetail::find($id);
        $users = User::get();
        return view('admin.pages.university.edit_login_detail',compact('login_detail','users'));
    }
    public function update_login_details(Request $request, $id){
        $input = $request->all();
        $input['show_password'] = $request->password;
        $input['password'] = bcrypt($request->password);
        $login = LoginDetail::find($id);
        $login->update($input);
        parent::successMessage("Update Login Detail Successfully");
        \LogActivity::addToLog('Update login Detail name:'.$login->user_name);
        return redirect()->route('login.details');
    }
    public function show_school_contacts($id){
        $school_contact = SchoolContact::find($id);
        return view('admin.pages.university.show_school_contact',compact('school_contact'));

    }
    public function delete_university($id){
        $university = University::find($id);
        $university->delete();
        return redirect()->back();
    }
    public function edit_find_university(Request $request){
        $university = University::find($request->id);
        return response()->json($university);
    }
    public function update_university(Request $request,$id){
        $input = $request->all();
        $university = University::find($id);
        $university->en_title = $input['en_title'];
        $university->ar_title = $input['ar_title'];
        $university->web_link = $input['web_link'];
        if(File::exists($university->uni_file)) {
            File::delete($university->uni_file);
        }
        if(File::exists($university->doc_file)) {
            File::delete($university->doc_file);
        }
        if(File::exists($university->ppt_file)) {
            File::delete($university->ppt_file);
        }
        if(File::exists($university->exl_file)) {
            File::delete($university->exl_file);
        }
        $image_uni = $request->file('uni_file');
        // return $image_uni;
        if($image_uni){
            $file_fullname = $image_uni->getClientOriginalName();
            $file_name = pathinfo($file_fullname, PATHINFO_FILENAME);
            $file_extension = $image_uni->getClientOriginalExtension();
            $rand_namer = now();
            $rand_namer = preg_replace('/\s+/', '_', trim($rand_namer));
            $rand_namer = preg_replace('/:+/', '_', trim($rand_namer));
            $file_namefor_db =$file_name . '_' . $rand_namer . '.' . $file_extension;
            $file_namefor_db = preg_replace('/\s+/', '_', trim($file_namefor_db));
            $image_uni->storeAs('/university/images/',$file_namefor_db,'public');
            $pic = url('/storage/university/images/'.$file_namefor_db);
            $university->uni_file = $pic;
        }
        $doc_file = $request->file('doc_file');
        // return $image;
        if($doc_file){
            $file_fullname = $doc_file->getClientOriginalName();
            $file_name = pathinfo($file_fullname, PATHINFO_FILENAME);
            $file_extension = $doc_file->getClientOriginalExtension();
            $rand_namer = now();
            $rand_namer = preg_replace('/\s+/', '_', trim($rand_namer));
            $rand_namer = preg_replace('/:+/', '_', trim($rand_namer));
            $file_namefor_db =$file_name . '_' . $rand_namer . '.' . $file_extension;
            $file_namefor_db = preg_replace('/\s+/', '_', trim($file_namefor_db));
            $doc_file->storeAs('university/word' ,$file_namefor_db,'public');
            $pic = url('storage/university/word/' . $file_namefor_db);
            $university->doc_file = $pic;
        }
        $exl_file = $request->file('exl_file');
        // return $image;
        if($exl_file){
            $file_fullname = $exl_file->getClientOriginalName();
            $file_name = pathinfo($file_fullname, PATHINFO_FILENAME);
            $file_extension = $exl_file->getClientOriginalExtension();
            $rand_namer = now();
            $rand_namer = preg_replace('/\s+/', '_', trim($rand_namer));
            $rand_namer = preg_replace('/:+/', '_', trim($rand_namer));
            $file_namefor_db =$file_name . '_' . $rand_namer . '.' . $file_extension;
            $file_namefor_db = preg_replace('/\s+/', '_', trim($file_namefor_db));
            $exl_file->storeAs('university/excel' ,$file_namefor_db,'public');
            $pic = url('storage/university/excel/' . $file_namefor_db);
            $university->exl_file = $pic;
        }
        $ppt_file = $request->file('ppt_file');
        // return $image;
        if($ppt_file){
            $file_fullname = $ppt_file->getClientOriginalName();
            $file_name = pathinfo($file_fullname, PATHINFO_FILENAME);
            $file_extension = $ppt_file->getClientOriginalExtension();
            $rand_namer = now();
            $rand_namer = preg_replace('/\s+/', '_', trim($rand_namer));
            $rand_namer = preg_replace('/:+/', '_', trim($rand_namer));
            $file_namefor_db =$file_name . '_' . $rand_namer . '.' . $file_extension;
            $file_namefor_db = preg_replace('/\s+/', '_', trim($file_namefor_db));
            $ppt_file->storeAs('university/powerpoint' ,$file_namefor_db,'public');
            $pic = url('storage/university/powerpoint/' . $file_namefor_db);
            $university->exl_file = $pic;
        }
        $university->english_summernote =$input['english_summernote'];
        $university->arabic_summernote =$input['arabic_summernote'];
        $university->user_id =Auth::user()->id;
        $university->save();
        parent::successMessage("Add University Successfully");
        \LogActivity::addToLog('Add University which is name:'.$input['en_title']);
        return redirect()->back();
    }
}
