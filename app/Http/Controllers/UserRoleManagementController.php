<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

use App\Models\Accommodation;
use App\Models\AddStudent;
use App\Models\AddStudentDropdownType;
use App\Models\Application;
use App\Models\Country;
use App\Models\Dropdown;
use App\Models\DropdownType;
use App\Models\Education;
use App\Models\LoginDetail;
use App\Models\SchoolContact;
use App\Models\SpecialEducation;
use App\Models\StudentContactDetail;
use App\Models\StudentInformation;
use App\Models\StudentOtherInformation;
use App\Models\Task;
use App\Models\University;
use App\Models\User;
use App\Models\Visa;


class UserRoleManagementController extends Controller
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

    public function index()
    {
        $roles = Role::all();
        return view('role',compact('roles'));
    }
    public function search(Request $request){
    $search_input = $request->search;
    $accomodation = Accommodation::get();
    }
}
