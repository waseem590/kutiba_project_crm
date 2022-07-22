<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Http\Requests\RolesRequest;
use App\Http\Requests\AddApplicationRequest;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\Application;
use App\Models\Education;
use App\Models\SpecialEducation;
use App\Models\AssignWarehouse;
use App\Models\Dropdown;
use App\Models\DropdownType;
use App\Models\Timezone_City;
use Auth;
use DB;
use Validator;
use Exception;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Mail;
use App\Models\LogActivity as LogActivityModel;

class UserManagementController extends Controller
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

    public function users(Request $request)
    {


        if ($request->ajax()) {

            if(Auth::user()->hasRole('Master User')){
            $data = User::all();
            return Datatables::of($data)
                ->addindexColumn()
                ->addColumn('type', function (User $data) {
                    $role = $data->getRoleNames()->first();
                    return $role;
                })
                ->addColumn('dob', function (User $data) {
                    $dob = date('d-m-Y',strtotime($data->dob));
                    return $dob;
                })
                ->addColumn('action', function (User $data) {
                    $btn1 = '<a href="'.route('user.clock',$data->id).'"  ><img
                    src="/images/clock-icon.png" alt="clock" class="img-fluid" height="20px" width="22px" /></a>';
                    $btn2 = '<a href="' . route('user.edit', $data->id) . '" data-id="' . $data->id . '"><img
                src="/admin/images/edit-std.png" alt="edit-std" class="img-fluid" /></a>';
                    $btn3 = '<a href="javascript:void(0)" data-id="' . $data->id . '" onclick="deleteRecord(' . $data->id . ',/delete/)"><img
                src="/admin/images/list-delet-std.png" alt="delete-std" class="img-fluid" /></a>';
                    return $btn2 . "  " . $btn3." ".$btn1;
                })
                ->rawColumns(['action', 'type'])
                ->make(true);


            }
            else{
                $data = User::where('id',Auth::user()->id)->get();

                return Datatables::of($data)
                ->addindexColumn()
                ->addColumn('type', function (User $data) {
                    $role = $data->getRoleNames()->first();
                    return $role;
                })
                ->addColumn('dob', function (User $data) {
                    $dob = date('d-m-Y',strtotime($data->dob));
                    return $dob;
                })
                ->addColumn('action', function (User $data) {
                    $btn1 = '<a href="'.route('user.clock',$data->id).'"  ><img
                    src="/images/clock-icon.png" alt="clock" class="img-fluid" height="20px" width="22px" /></a>';
                    // $btn1 = '<a href="javascript:void(0)" data-id="'.$data->id.'" data-bs-toggle="modal"
                    // data-bs-target="#clock_modal" class="clock"><img
                    // src="/images/clock-icon.png" alt="clock" class="img-fluid" height="20px" width="22px" /></a>';

                        $btn2 = '<a href="' . route('user.edit', $data->id) . '" data-id="' . $data->id . '"><img
                    src="/admin/images/edit-std.png" alt="edit-std" class="img-fluid" /></a>';

                    if(Auth::user()->hasRole('Master User')){
                    $btn3 = '<a href="javascript:void(0)" data-id="' . $data->id . '" onclick="deleteRecord(' . $data->id . ',/delete/)"><img
                    src="/admin/images/list-delet-std.png" alt="delete-std" class="img-fluid" /></a>';
                }
                    // $btn3 = '<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModal" class="edit-list-icons" onclick="deleteRecord(1,/delete/)"><img src="http://localhost:8000/admin/images/list-delet-std.png" alt="edit-std" class="img-fluid"></a>';
                    return $btn3 ?? ''.$btn2 . "  " ." ".$btn1;
                })
                ->rawColumns(['action', 'type'])
                ->make(true);
            }
        }

        return view('admin.users.users');
    }

    public function editUser($id)
    {

        $user = User::findOrFail($id);
        if ($user == null) {
            return redirect()->back()->with('error', 'No Record Found To Edit.');
        }
        $roles = Role::all();
        \LogActivity::addToLog('edit user name:' . $user->name);
        return view('admin.users.editUser', compact('user', 'roles'));
    }

    public function getWarehouses(Request $request)
    {
        $warehouses = Warehouse::where('status', 1)->get();
        $role = Role::find($request->role_id);
        $arr = Warehouse::join('assign_warehouses', 'assign_warehouses.warehouse_id', 'warehouses.id')
            ->where('assign_warehouses.user_id', $request->user_id)
            ->select('warehouses.*')->whereStatus(1)->pluck('id')->toArray();

        return response()->json([
            'html' => view('admin.users.warehouseSelect', compact('warehouses', 'arr'))->render(), 200, ['Content-Type' => 'application/json']
        ]);
    }

    public function status(Request $request)
    {
        $user = User::findOrFail($request->id);
        if ($user == null) {
            return redirect()->back()->with('error', 'No Record Found To Delete.');
        }
        $user->update(['status' => $request->input('status')]);
        $status = $user->status;
        \LogActivity::addToLog('update status:' . $user->name);
        return response()->json(['status' => $status, 'message' => 'Status Changed Successfully']);
    }

    public function updateUser(Request $request, int $id)
    {
        $user = User::findOrFail($id);
        if ($user == null) {
            return redirect()->back()->with('error', 'No Record Found To Update.');
        }
        $user->type = $request->role;
        $user->dob = date('Y-m-d',strtotime($request->dob));
        $user->save();
        $role = Role::whereId($user->type)->first()->name;
        $user->syncRoles($role);
        \LogActivity::addToLog('update user name:' . $user->name);
        return redirect()->route('user.index')->with('success', 'Your Record Sucessfully Updated!');
    }

    public function checkEmail(Request $request)
    {
        $input = $request->only(['email']);

        $request_data = [
            'email' => 'required|email|unique:users,email|ends_with:.com',
        ];

        $validator = Validator::make($input, $request_data);

        // json is null
        if ($validator->fails()) {
            $errors = json_decode(json_encode($validator->errors()), 1);
            return response()->json([
                'success' => false,
                'message' => array_reduce($errors, 'array_merge', array()),
            ]);
        } else {
            \LogActivity::addToLog('check email name:' . $input);
            return response()->json([
                'success' => true,
                'message' => "<span style='color:#95d60c;'>The email is available</span>"
            ]);
        }
    }

    public function addNewUser()
    {
        $roles = Role::where('name', '!=', 'Customer')->get();

        return view('admin.users.addUser', compact('roles'));
    }

    public function createNewUser(Request $request)
    {

        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'dob' => date('Y-m-d',strtotime($request->dob)),
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);
        $role = Role::whereId($request->role)->pluck('name');

        $data->assignRole($role);
        if ($data->wasRecentlyCreated) {
            $response = array(
                'data' => [],
                'message' => 'Data Successfully Added',
                'status' => 'success',
            );
            \LogActivity::addToLog('create new user name:' . $data->name);
            return $response;
        }
    }

    /**
     *****************************************************************************
     ************************** ROLES REQUEST ************************************
     *****************************************************************************
     */

    public function roles(Request $request)
    {
        $permissions = Permission::pluck('name')->all();
        if ($request->ajax()) {
            $data = Role::with('permissions')->where('name', '!=', 'Customer')->where('name', '!=', 'Admin')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('permissions', function (Role $data) {
                    $permissions = $data->permissions()->pluck('name')->all();
                    $printIT = "";
                    foreach ($permissions as $permission) {
                        $printIT .= '<span class="badge badge-success">' . $permission . '</span>';
                    }
                    return $printIT;
                })
                ->addColumn('action', function (Role $data) {
                    $btn = '<a href="' . route('role.edit', $data->id) . '" class=""><img src="/admin/images/edit-std.png" alt="edit-std" class="img-fluid"></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'permissions'])
                ->make(true);
        }
        return view('admin.users.roles', compact('permissions'));
    }

    public function editRole($id)
    {
        $role = Role::findOrFail($id);
        if ($role == null) {
            return redirect()->back()->with('error', 'No Record Found To Edit.');
        }
        $permission = Permission::get();
        $rolePermissions = $role->permissions->pluck('id')->all();
        // \LogActivity::addToLog('open edit role screen');
        return view('admin.users.editRoles', compact('role', 'permission', 'rolePermissions'));
    }

    public function updateRoles(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        if ($role == null) {
            return redirect()->back()->with('error', 'No Record Found To update.');
        }

        $validated = $request->validate([
            'permissions' => 'required|array'
        ]);

        $data = ['permissions' => $request->input('permissions', []),];
        $role->syncPermissions($data);
        \LogActivity::addToLog('update user role, name: ' . $role->name);
        return redirect()->route('role.index')->with('success', 'Role updated successfully');
    }

    public function permissions(Request $request)
    {
        if ($request->ajax()) {
            $data = Permission::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (Permission $data) {

                    $btn = '<a data-id="' . $data->id . '" data-tab="Permission" data-url="permissions/delete"
                    href="javascript:void(0)" class="del_btn"><img src="/admin/images/list-delet-std.png" alt="delete-std" class="img-fluid"></a>';
                    $btn2 = '<a  href="javascript:void(0)"  class="editPermission"  data-id="' . $data->id . '"><img src="/admin/images/edit-std.png" alt="edit-std" class="img-fluid"></a>';
                    return $btn . ' ' . $btn2;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // \LogActivity::addToLog('open screen of permissions');
        return view('admin.users.permissions');
    }

    public function createPermission(Request $request)
    {
        // dd('oooo');
        $validated = $request->validate([
            'name' => ['required', 'string', 'unique:permissions', 'max:255'],
        ]);

        $permission = Permission::create(['name' => $request->name]);
        \LogActivity::addToLog('create permission, name:' . $permission->name);
        return back()->with(['success', 'Permission has been created!']);
    }

    public function createRole(RolesRequest $request)
    {
        $role = Role::create(['name' => $request->name]);
        \LogActivity::addToLog('create role, name:' . $role->name);
        return back()->with(['success', 'Role has been created!']);
    }

    public function editPermission($id)
    {
        $per = Permission::findOrFail($id);
        if ($per == null) {
            return redirect()->back()->with('error', 'No Record Found To Edit.');
        }

        $data = array(
            'id' => $per->id,
            'permission' => $per->name,
        );
        // \LogActivity::addToLog('open edit permission screen');
        return response()->json($data);
    }

    public function updatePermission(Request $request, $id)
    {
        $this->validate($request, [
            'permission' => 'required',
        ]);

        $permission = Permission::find($id);
        $permission->name = $request->input('permission');
        $permission->save();
        \LogActivity::addToLog('update permission, name:' . $permission->name);
        return redirect()->route('permission.index')->with('success', 'Permission updated successfully');
    }

    public function deletePermission($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        \LogActivity::addToLog('permission is deleted, name:' . $permission->name);
        return redirect()->back();
        // return response()->json(array(
        //     'data' => true,
        //     'message' => 'Permission Successfully Deleted',
        //     'status' => 'success',
        // ));
    }
    public function deleteUser($id)
    {
        // dd($id);
        $user = User::find($id);
        // dd($user);
        if ($user->hasRole('Master User')) {
            parent::errorMessage("you are not delete super admin");
            return redirect()->back();
        } else {
            \LogActivity::addToLog('user is deleted, name:' . $user->name);
            $user->delete();
            parent::successMessage("Delete User Successfully");
            return redirect()->back();
        }
        // if($user->roles()){
        //     parent::errorMessage("Not delete, user assigned!");
        //     return redirect()->back();
        // }
    }
    public function add_application($id)
    {
        $student_id = $id;
        $dropdown = Dropdown::with('dropdownType')->get();
        return view('admin.pages.student_buttons.add_application', compact('id', 'dropdown','student_id'));
    }

    public function edit_application(Request $request)
    {
        $dropdown = Dropdown::with('dropdownType')->get();
        $applications = Application::applicationRelations()->where('id', $request->id)->first();
        return response()->json([
            'dropdown' => $dropdown,
            'applications' => $applications,
        ]);
        // return view('admin.pages.student_buttons.edit_application', compact('applications', 'dropdown'));
    }
    public function application($id)
    {
        // dd('ooo');
        $dropdown = Dropdown::with('dropdownType')->get();
        $applications = Application::applicationRelations()->where('add_students_id', $id)->get();
        return view('admin.pages.student_buttons.index', compact('applications', 'id', 'dropdown'));
    }
    public function application_status(Request $request)
    {
        // dd($request->all());

        if(!empty($request->change_date)){
            $appli = Application::find($request->updated_row_id);
            $education = Education::where('applications_id', $request->updated_row_id)->first();

            if(!empty($request->tuition_fee && $request->sign)){
                $appli->tuition_fee = $request->sign.$request->tuition_fee;
                $appli->save();
            }

            if(!empty($appli->start_date) || empty($appli->start_date)){
                $appli->update([
                    'start_date' => $request->change_date,
                    'status' => $request->updated_val,
                ]);
            }

            if(!empty($education->d_start_date)){
                $education->update([
                    'd_start_date' => $request->change_date,
                ]);
            }
            if(!empty($education->ad_start_date)){
                $education->update([
                    'ad_start_date' => $request->change_date,
                ]);
            }
            if(!empty($education->b_start_date)){
                $education->update([
                    'b_start_date' => $request->change_date,
                ]);
            }
            if(!empty($education->bh_start_date)){
                $education->update([
                    'bh_start_date' => $request->change_date,
                ]);
            }
            if(!empty($education->gd_start_date)){
                $education->update([
                    'gd_start_date' => $request->change_date,
                ]);
            }
            if(!empty($education->md_start_date)){
                $education->update([
                    'md_start_date' => $request->change_date,
                ]);
            }
            if(!empty($education->dd_start_date)){
                $education->update([
                    'dd_start_date' => $request->change_date,
                ]);
            }
            $specialEducation = SpecialEducation::where('applications_id', $request->updated_row_id)->first();
            if(!empty($specialEducation->certificate_1)){
                $specialEducation->update([
                    'certificate_1' => $request->change_date,
                ]);
            }
            if(!empty($specialEducation->certificate_2)){
                $specialEducation->update([
                    'certificate_2' => $request->change_date,
                ]);
            }
            if(!empty($specialEducation->certificate_3)){
                $specialEducation->update([
                    'certificate_3' => $request->change_date,
                ]);
            }
            if(!empty($specialEducation->certificate_4)){
                $specialEducation->update([
                    'certificate_4' => $request->change_date,
                ]);
            }
            if(!empty($specialEducation->foundation)){
                $specialEducation->update([
                    'foundation' => $request->change_date,
                ]);
            }
            if(!empty($specialEducation->associate_degree)){
                $specialEducation->update([
                    'associate_degree' => $request->change_date,
                ]);
            }
            // dd($appliTable->start_date);
            \LogActivity::addToLog('Update the application status');
            parent::successMessage("Record Updated Successfully");
            return redirect()->back();
        }
        else{
            $query = Application::find($request->app_id);
            $query->update([
                'status' => $request->val,
            ]);
            \LogActivity::addToLog('Update the application status');
            return response()->json($query->status);
        }

    }
    public function view_application($id)
    {
        $dropdown = Dropdown::with('dropdownType')->get();
        $applications = Application::applicationRelations()->where('id', $id)->first();

        // \LogActivity::addToLog('View Application: '.$id);
        return view('admin.pages.student_buttons.view_application', compact('applications', 'dropdown'));
    }
    public function delete_application($id)
    {
        $user_id = Application::find($id)->add_students_id;
        SpecialEducation::where('applications_id', $id)->delete();
        Education::where('applications_id', $id)->delete();
        Application::where('id', $id)->delete();
        parent::successMessage("Record Deleted Successfully");
        \LogActivity::addToLog('Delete Application: '.$id);
        return redirect()->route('application', $user_id);
    }
    public function user_logs()
    {
        $logs = LogActivityModel::latest()->get();
        // \LogActivity::addToLog('open log screen, name:' . Auth::user()->name);
        return view('admin.users.logs', compact('logs'));
    }
    public function save_application(Request $request)
    {
        try {
            $query = Application::create([
                'add_students_id' => $request->user_id,
                'study_dest' => $request->destination,
                'inst_name' => $request->institute_name,
                'duration' => $request->duration,
                'start_date' => $request->duration_start_date,
            ]);
            $insertedId = $query->id;
            $special = SpecialEducation::create([
                'applications_id' => $insertedId,
                'certificate_1' => $request->certificate1,
                'certificate_2' => $request->certificate2,
                'certificate_3' => $request->certificate3,
                'certificate_4' => $request->certificate4,
                'foundation' => $request->foundation_date,
                'associate_degree' => $request->associate_deg_date,
            ]);

            Education::create([
                'applications_id' => $insertedId,
                'diploma' => $request->diploma_name,
                'd_start_date' => $request->diploma_start_date,
                'advance_diploma' => $request->advance_diploma_name,
                'ad_start_date' => $request->advance_diploma_date,
                'bachelor' => $request->bechelor_deg_name,
                'b_start_date' => $request->bechelor_deg_date,
                'bachelor_hons' => $request->bechelor_honours_name,
                'bh_start_date' => $request->bechelor_honours_date,
                'graduate_diploma' => $request->graduate_diploma_name,
                'gd_start_date' => $request->graduate_diploma_date,
                'masters_degree' => $request->master_deg_name,
                'md_start_date' => $request->master_deg_date,
                'doctoral_degree' => $request->doctoral_deg_name,
                'dd_start_date' => $request->doctoral_deg_date,
                'primary_school' => $request->primary_school,
                'high_school' => $request->high_school,
            ]);
            parent::successMessage("Record Add Successfully");
            \LogActivity::addToLog('add appliction of a student, name:' . $request->user_id);
            return redirect()->back();
        } catch (Exception $e) {
            parent::errorMessage("Record Not Add !Something else");
        }
    }

    public function update_application(Request $request)
    {
        try {
            $query = Application::find($request->applications_id);
            $query->update([
                'study_dest' => $request->destination,
                'inst_name' => $request->institute_name,
                'duration' => $request->duration,
                'start_date' => $request->duration_start_date,
            ]);

            $query = SpecialEducation::find($request->special_education_id);
            $query->update([
                'certificate_1' => $request->certificate1,
                'certificate_2' => $request->certificate2,
                'certificate_3' => $request->certificate3,
                'certificate_4' => $request->certificate4,
                'foundation' => $request->foundation_date,
                'associate_degree' => $request->associate_deg_date,
            ]);

            $query = Education::find($request->education_id);
            $query->update([
                'diploma' => $request->diploma_name,
                'd_start_date' => $request->diploma_start_date,
                'advance_diploma' => $request->advance_diploma_name,
                'ad_start_date' => $request->advance_diploma_date,
                'bachelor' => $request->bechelor_deg_name,
                'b_start_date' => $request->bechelor_deg_date,
                'bachelor_hons' => $request->bechelor_honours_name,
                'bh_start_date' => $request->bechelor_honours_date,
                'graduate_diploma' => $request->graduate_diploma_name,
                'gd_start_date' => $request->graduate_diploma_date,
                'masters_degree' => $request->master_deg_name,
                'md_start_date' => $request->master_deg_date,
                'doctoral_degree' => $request->doctoral_deg_name,
                'dd_start_date' => $request->doctoral_deg_date,
                'primary_school' => $request->primary_school,
                'high_school' => $request->high_school,
            ]);
            parent::successMessage("Record Updated Successfully");
            \LogActivity::addToLog('update appliction of a student, name:' . $request->applications_id);
            return redirect()->back();
            // return redirect()->route('view_application', $request->applications_id);
        } catch (Exception $e) {
            parent::errorMessage("Record Not Update !Something else");
        }
    }
    public function zone_city(){
        $zone_cities = Timezone_City::get();
        $city = Dropdown::find(16);
        $cities = $city->dropdownType;
        return view('admin.users.zone_city',compact('zone_cities','cities'));
    }

    public function store_zone_city(Request $request){
        $zone_city= new Timezone_City;
        $zone_city->dropdown_types_id = $request->name;
        $zone_city->timezone = $request->timezone;
        $zone_city->save();
        parent::successMessage("Assign Timezone Successfully");
        \LogActivity::addToLog('assign timezone to city, name:' . $zone_city->name);
        return redirect()->back();
    }
    public function edit_zone_city(Request $request){
        $zone_city = Timezone_City::find($request->id);
        $city = Dropdown::find(16);
        $cities = $city->dropdownType;
        return view('admin.users.timezone_append',compact('zone_city','cities'));
    }
    public function delete_zone_city($id){
        $timezone = Timezone_City::find($id);
        $timezone->delete();
        parent::successMessage("Delete Timezone Successfully");
        return redirect()->back();
    }
    public function user_clocks($id){
        $user= User::find($id);
        $users_clocks = $user->user_clock;
        $user_id = $id;
        $dropdown = Dropdown::find(16);
        $dropdownType = $dropdown->dropdownType;
        return view('admin.users.users_clock',compact('users_clocks','dropdownType','user_id'));
    }
    public function storeـusersـclock(Request $request,$id){
        $user = User::find($id);
        foreach($request->clock as $clock)
        {
            $user->user_clock()->attach($clock);
        }
        parent::successMessage("Add Clocks Successfully");
        return redirect()->back();
    }
    public function delete_clock($user_id, $id){
        $user  = User::find($user_id);
        $user->user_clock()->detach($id);
        parent::successMessage("Delete Clock Successfully");
        return redirect()->back();
    }
}
