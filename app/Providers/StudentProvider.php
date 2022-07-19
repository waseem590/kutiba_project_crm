<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\AddStudent;
use Illuminate\Support\Facades\View;
class StudentProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // $all_students_rec = AddStudent::get();

        // $arr= [];
        // foreach($all_students_rec as $student){
        //     if($student->contact){
        //         $arr[]=$student->contact['email'];
        //     }


        // }
        // $all_students_arr = array_filter($arr);
        // $all_students = implode(',',$all_students_arr);
        // // dd($all_students);
        // View::share('all_students',$all_students);

    }
}
