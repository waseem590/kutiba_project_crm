<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use Exception;
use File;
use Image;
use Auth;
class UserController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
    }

    public function profile()
    {
        return view('admin.pages.profile.edit');
    }

    public function updateprofile(ProfileRequest $request)
    {
        // dd($request->all());
        $admin = User::where('id', '=', $request->updateId)->first();
        if(!empty($request->current_password )){
            if(!empty($request->password && $request->confirmpassword)){
                $request->validate([
                    'password' => 'required|min:8',
                    'confirmpassword' => 'required|same:password',
                ]);

                if(Hash::check($request->current_password, $admin->password)){
                    $newpassword = Hash::make($request->password);
                    parent::successMessage("Your Password updated successfully");
                    \LogActivity::addToLog('update password, user:'.$admin->name);
                 } else{
                     parent::errorMessage("Your Current password does not match our records");
                     return redirect()->back();
                 }
            }  else {
                parent::errorMessage("Your  Profile does not updated");
                parent::errorMessage("Your  password does not match our records");
                return redirect()->back();
            }
        }
        $imgpath = public_path('admin/images/');
        if (empty($request->profile_photo)) {
            $updateimage = $admin->profile_photo;
        } else {
            $imagePath =  $imgpath . $admin->profile_photo;
            if (File::exists($imagePath)) {
                File::delete($imagePath);
                \LogActivity::addToLog('delete user profile picture from hosting, user:'.$admin->name);
            }
            $destinationPath = $imgpath;
            $file = $request->profile_photo;
            $fileName = time() . '.' . $file->clientExtension();
            $file->move($destinationPath, $fileName);
            $updateimage = $fileName;
            \LogActivity::addToLog('add profile picture, user:'.$admin->name);
        }
        try {
            $admin->update([
                'name'          => $request->name,
                'email'         => $request->email,
                'profile_photo' => $updateimage,
                'password'      => (!empty($newpassword)) ? $newpassword : $admin->password,
            ]);
            \LogActivity::addToLog('update user profile, user:'.$admin->name);

        } catch (Exception $e) {
            dd($e->getMessage());
        }
        parent::successMessage('Admin Profile Updated Successfully"');
        \LogActivity::addToLog('update user profile, user:'.$admin->name);
        return redirect()->back();
    }
    public function delete_profile_photo(){
        $imgpath = public_path('admin/images/');
        $imagePath =  $imgpath . Auth::user()->profile_photo;
        if(File::exists($imagePath)) {
            File::delete($imagePath);
            $user = User::find(Auth::user()->id);
            $user->profile_photo = "";
            $user->save();
            \LogActivity::addToLog('delete user profile picture, user:'.Auth::user()->name);
            return redirect()->back();
        }
    }
}
