<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DropdownRequest;

use App\Models\Dropdown;
use App\Models\DropdownType;
use App\Models\AddStudent;
use App\Models\StudentOtherInformation;
use App\Models\Visa;
use App\Http\Requests\DropdownTypeRequest;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            $dropdowns = Dropdown::all();
            \LogActivity::addToLog('open student settings');
            return view('admin.pages.student.student_settings',compact('dropdowns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DropdownRequest $request)
    {
        // dd("test");
        $dropdown = new Dropdown;
        $input = $request->all();
        $dropdown->create($input);
        parent::successMessage('Add Resource Successfully');
        \LogActivity::addToLog('Add Resource name: '.$input['name']);
        return redirect()->back();
    }
    public function update_dropdown(Request $request, $id){
        // dd($request->name);
        $dropdown = Dropdown::findorfail($id);
        $dropdown->name = $request->name;
        $dropdown->save();
        // parent::successMessage('Update Dropdown Successfully"');
        \LogActivity::addToLog('Update Resource Record:'.$dropdown->name);
        return response()->json(["message"=>"Update Record Successfully"]);
    }
    public function store_dropdown_type(DropdownTypeRequest $request){
        // dd($request->all());
        $dropdownType = new DropdownType;
        $input = $request->all();
        $dropdowns_id  = $request->dropdowns_id;
        $resource_types = DropdownType::where('dropdowns_id',$dropdowns_id)->get();
        foreach($resource_types as $type){
            if($input['name'] == $type->name){
                // return response()->json(["errors"=>"Resource Type is already"]);
                return view('admin.pages.student.show_resource_type_append',compact('resource_types','dropdowns_id'))->render();
            }
        }
        $dropdownType->create($input);
        \LogActivity::addToLog('Add type of Resource:'.$input['name']);
        return view('admin.pages.student.show_resource_type_append',compact('resource_types','dropdowns_id'))->render();
    }
    public function show_resource_type(Request $request){
        // dd($request->id);
        $resource_types = DropdownType::where('dropdowns_id',$request->id)->get();
        $dropdowns_id  = $request->id;
        $resource_types = DropdownType::where('dropdowns_id',$dropdowns_id)->get();
        return view('admin.pages.student.show_resource_type_append',compact('resource_types','dropdowns_id'))->render();
    }
    public function update_dropdown_type(Request $request){
        // dd($request->all());
        $resource_types = DropdownType::find($request->id);
        $input = $request->name;
        $resource_types->update([
            'name'=>$input
        ]);
        \LogActivity::addToLog('type of resource is update of:'.$resource_types->name);
        return response()->json(["message"=>"Update Resource Type Successfully"]);
    }
    public function delete_dropdowntype(Request $request){
        $dropdown = DropdownType::findorfail($request->id);
        $office = AddStudent::where('office',$dropdown->id)->get();
        $funding_type = StudentOtherInformation::where('funding_type',$dropdown->id)->get();
        $sponsor_name = StudentOtherInformation::where('sponsor_name',$dropdown->id)->get();
        $student_source = StudentOtherInformation::where('student_source',$dropdown->id)->get();
        $cohort_name = StudentOtherInformation::where('cohort_name',$dropdown->id)->get();
        $visa_type = Visa::where('visa_type',$dropdown->id)->get();
        $case_officer = Visa::where('case_officer',$dropdown->id)->get();
        $status = Visa::where('visa_status',$dropdown->id)->get();

        if(count($office)>0 || count($funding_type)>0 || count($sponsor_name)>0 || count($student_source)>0 || count($cohort_name)>0 || count($visa_type)>0 || count($case_officer)>0|| count($status)>0){
            parent::errorMessage('dropdown type not delete because its already assign');
            return response()->json('error');
        }
        else{
            $dropdown->delete();
            $dropdowns_id = $request->dropdowns_id;
            $resource_types = DropdownType::where('dropdowns_id',$dropdowns_id)->get();
            \LogActivity::addToLog('type of resource deleted name:'.$resource_types->first()->name);
            return view('admin.pages.student.show_resource_type_append',compact('resource_types','dropdowns_id'))->render();
        }
    }
    public function custom_validation(Request $request){
        $dropdowns_id  = $request->dropdowns_id;
        $resource_types = DropdownType::where('dropdowns_id',$dropdowns_id)->get();
        foreach($resource_types as $type){
            if($request->name == $type->name){
                return response()->json(["errors"=>"Please enter another name"]);
            }
        }

        return response()->json(["success"=>"success"]);

    //    $search_type= DropdownType::where('name',$request->name)->get();
    //    if(count($search_type)>0){
    //        return response()->json(["error"=>"name is already taken"]);
    //    }
    //    else{
    //     return response()->json(["success"=>"name is already taken"]);
    //    }
    }
}

