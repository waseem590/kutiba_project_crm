<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dropdown;
use App\Models\DropdownType;
use App\Models\AddStudent;
use App\Models\StudentOtherInformation;
use App\Http\Requests\DropdownRequest;
use App\Http\Requests\DropdownTypeRequest;

class CrudController extends Controller
{
    public function index()
    {
        $dropdowns = Dropdown::all();
        return view('admin.pages.student.dropdown',compact('dropdowns'));
    }
    public function store(DropdownRequest $request)
    {
        $dropdown = new Dropdown;
        $input = $request->all();
        $dropdown->create($input);
        parent::successMessage('Add Dropdown Successfully"');
        return redirect()->back();
    }
    public function destroy($id)
    {
        Dropdown::find($id)->delete();
        parent::successMessage('Delete Dropdown Successfully"');
        return redirect()->route('dropdown.index');
    }
    public function store_dropdown_type(DropdownTypeRequest $request){
        // dd($request->all());
        $dropdownType = new DropdownType;
        $input = $request->all();
        $dropdownType->create($input);
        parent::successMessage('Add Dropdown Type Successfully"');
        return redirect()->back();
    }
    public function update_dropdown(DropdownRequest $request, $id){
        // dd($request->all());
        $dropdown = Dropdown::findorfail($id);
        $input = $request->all();
        $dropdown->update($input);
        parent::successMessage('Update Dropdown Successfully"');
        return redirect()->back();
    }
    public function dropdown_type(){
        $dropdowns = Dropdown::all();
        // $dropdown_types = DropdownType::where('dropdown_id',1)->get();
        return view('admin.pages.student.dropdown_type',compact('dropdowns'));
    }
    public function update_dropdown_type(DropdownTypeRequest $request, $id){
        $dropdown_type = DropdownType::find($id);
        $input = $request->all();
        $dropdown_type->update($input);
        parent::successMessage('Update Dropdown Type Successfully"');
        return redirect()->back();
    }
    public function show_dropdowntype(Request $request){
        $dropdow_types = DropdownType::where('dropdowns_id',$request->dropdowns_id)->orderBy('name', 'asc')->get();
        return view('admin.pages.student.show_dropdowntype_append',compact('dropdow_types'))->render();
    }
    public function delete_dropdowntype($id){
        $dropdown = DropdownType::findorfail($id);        
        $office = AddStudent::where('office',$dropdown->name)->get();
        $funding_type = StudentOtherInformation::where('funding_type',$dropdown->name)->get();
        $sponsor_name = StudentOtherInformation::where('sponsor_name',$dropdown->name)->get();
        $student_source = StudentOtherInformation::where('student_source',$dropdown->name)->get();
        $cohort_name = StudentOtherInformation::where('cohort_name',$dropdown->name)->get();

        if(count($office)>0 || count($funding_type)>0 || count($sponsor_name)>0 || count($student_source)>0 || count($cohort_name)>0){
            parent::errorMessage('dropdown type not delete because its already assign');
            return redirect()->back();
        }
        else{
            $dropdown->delete();
            parent::successMessage('Delete Dropdown Type Successfully"');
            return redirect()->back();
        }
    }
}
