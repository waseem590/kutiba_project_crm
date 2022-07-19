<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserRoleManagementController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\StudentButtonController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */


Route::get('/clear', function () {
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return 'clear done';
});

Route::get('/cache', function () {
    Artisan::call('config:cache');
});
Route::get('/compile', function () {
    Artisan::call('clear-compiled');
});
Route::get('/link-storage', function () {
    dd(Artisan::call('storage:link'));
});

Route::get('/migrate', function () {
    Artisan::call('migrate');
    return 'migrated successfully';
});
Route::get('/migrate-refresh', function () {
    Artisan::call('migrate:refresh');
    return 'migrated successfully';
});
Route::get('/migrate-seed', function () {
    Artisan::call('migrate:fresh --seed');
    return 'migrated seed successfully';
});
Route::get('/vendor-publish', function () {
    Artisan::call('vendor:publish --provider="Proengsoft\JsValidation\JsValidationServiceProvider"');
    return 'vendor publish';
});

Route::get('phpinfo', function () {
    return phpinfo();
});
Route::get('phpdebug', [TestController::class, 'phpdebug']);

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/allNotifiMarkAsRead', [HomeController::class, 'allNotifiMarkAsRead'])->name('allNotifiMarkAsRead');
    Route::post('/notifiMarkAsRead', [HomeController::class, 'notifiMarkAsRead'])->name('notifiMarkAsRead');
    Route::post('/deleteNotification', [HomeController::class, 'deleteNotification'])->name('deleteNotification');
    Route::get('/deleteAllNotification', [HomeController::class, 'deleteAllNotification'])->name('deleteAllNotification');
    Route::get('/roles', [UserRoleManagementController::class, 'index']);
    Route::resource('user', UserController::class);
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/updateprofile', [UserController::class, 'updateprofile'])->name('updateprofile');
    Route::post('/save_comment', [StudentButtonController::class, 'save_comment'])->name('save_comment');
    Route::post('/save_course_comment', [StudentButtonController::class, 'save_course_comment'])->name('save_course_comment');
    Route::post('/save_task_comment', [StudentButtonController::class, 'save_task_comment'])->name('save_task_comment');
    Route::get('/showCourseComments/{course_id}/{student_id?}/', [StudentButtonController::class, 'showCourseComments'])->name('showCourseComments');
    Route::get('/showTaskComments/{course_id?}/{student_id?}/', [StudentButtonController::class, 'showTaskComments'])->name('showTaskComments');
    Route::delete('/delete_comment/{id}',[StudentButtonController::class,'delete_comment'])->name('delete_comment');

    Route::get('delete_profile_photo', [UserController::class, 'delete_profile_photo'])->name('delete.profile_photo');
    Route::resource('student', StudentController::class);
    Route::resource('resource', ResourceController::class);

    Route::delete('/delete/{id}',[UserManagementController::class,'deleteUser']);
    // Route::get('student_setting', [ResourceController::class,'student_setting'])->name('setting.student');

    Route::resource('dropdown', CrudController::class);
    Route::post('update_dropdown/{id}', [ResourceController::class, 'update_dropdown'])->name('updateDropdown');
    Route::get('dropdown_type', [CrudController::class, 'dropdown_type'])->name('dropdownType');
    Route::get('show_resource_type', [ResourceController::class, 'show_resource_type'])->name('showResourceType');
    Route::post('dropdown_type', [ResourceController::class, 'store_dropdown_type'])->name('adddropdownType');
    Route::post('resource_type_validation', [ResourceController::class, 'resource_type_validation'])->name('add.resourcetype.validation');
    Route::get('show_dropdowntype', [CrudController::class, 'show_dropdowntype'])->name('show.dropdowntype');
    Route::get('delete_dropdowntype', [ResourceController::class, 'delete_dropdowntype'])->name('delete.dropdown.type');
    Route::get('custom_validation', [ResourceController::class, 'custom_validation'])->name('custom.type.validation');
    Route::post('update_dropdown_type', [ResourceController::class, 'update_dropdown_type'])->name('updateDropdownType');
    Route::get('custom_jsvalidation', [ResourceController::class, 'custom_jsvalidation'])->name('customJsValidation');
    Route::get('/studentDetail/{id?}', [StudentController::class, 'studentDetail'])->name('studentDetail');
    Route::post('/studentinformation', [StudentController::class, 'studentinformation'])->name('studentinformation');
    Route::post('/studentcontactdetail', [StudentController::class, 'studentcontactdetail'])->name('studentcontactdetail');
    // Route::post('/custom_validation_number', [StudentController::class, 'custom_validation_number'])->name('custom_validation_number');
    Route::post('/studentotherinformation', [StudentController::class, 'studentotherinformation'])->name('studentotherinformation');
    // Route::get('/studentlists', [StudentController::class, 'studentlists'])->name('studentlists');
    Route::get('/studentlists', [StudentController::class, 'studentlists_new'])->name('studentlists');
    Route::post('/sendsms', [StudentController::class, 'sendsms'])->name('sendsms');
    Route::get('locale/{locale}',[HomeController::class, 'switch_lang'])->middleware('change.locale')->name('switchLang');
    Route::group(['prefix' => 'users'], function (){
        Route::get('staff_birthday',[HomeController::class, 'staff_birthday'])->name('staff_birthday');
        Route::post('staff_birthday',[HomeController::class, 'store_staff_birthday'])->name('store_staff_birthday');
        Route::post('/checkEmail',[UserManagementController::class,'checkEmail'])->name('user.checkEmail');
        Route::get('/',[UserManagementController::class,'users'])->name('user.index');
        Route::get('/create',[UserManagementController::class,'addNewUser'])->name('user.create');
        Route::post('/store',[UserManagementController::class,'createNewUser'])->name('user.store');;
        // Route::delete('/delete/{id}',[UserManagementController::class,'deleteUser']);
        Route::get('/edit/{id}',[UserManagementController::class,'editUser'])->name('user.edit');
        Route::post('/update/{id}',[UserManagementController::class,'updateUser'])->name('user.update');
        Route::post('/status', [UserManagementController::class,'status'])->name('user.status');

        Route::get('/add_application/{id}', [UserManagementController::class,'add_application'])->name('add.application');
        Route::get('/application/{id}', [UserManagementController::class,'application'])->name('application');
        Route::get('/edit_application/{id}', [UserManagementController::class,'edit_application'])->name('edit_application');
        Route::get('/view_application/{id}', [UserManagementController::class,'view_application'])->name('view_application');
        Route::delete('/delete_application/{id}', [UserManagementController::class,'delete_application'])->name('delete_application');
        Route::post('/save_application', [UserManagementController::class,'save_application'])->name('save_application');
        Route::post('/application_status', [UserManagementController::class,'application_status'])->name('application_status');
        Route::post('/update_application', [UserManagementController::class,'update_application'])->name('update_application');
        Route::post('/rejected_reason/{id}', [StudentButtonController::class,'rejected_reason'])->name('rejected_reason');
        Route::post('/declined_reason/{id}', [StudentButtonController::class,'declined_reason'])->name('declined_reason');

        Route::get('/users_clock/{id}', [UserManagementController::class,'user_clocks'])->name('user.clock');
        Route::post('/storeـusersـclock/{id}', [UserManagementController::class,'storeـusersـclock'])->name('store.users.clock');
        Route::get('/logs', [UserManagementController::class,'user_logs'])->name('user.logs');
        Route::delete('/delete_clock/{id}/{user_id}', [UserManagementController::class,'delete_clock'])->name('delete_clock');
    });
    Route::get('/complete',[StudentController::class, 'complete'])->name('complete');
    Route::group(['prefix' => 'permissions'], function (){
        Route::get('/',[UserManagementController::class,'permissions'])->name('permission.index');
        Route::post('/store',[UserManagementController::class,'createPermission'])->name('permission.store');
        Route::get('/edit/{id}',[UserManagementController::class,'editPermission'])->name('permission.edit');
        Route::post('/update/{id}',[UserManagementController::class,'updatePermission'])->name('permission.update');
        Route::delete('/delete/{id}', [UserManagementController::class,'deletePermission']);
        Route::get('/reload_clock',[HomeController::class,'reload_clock'])->name('reload_clock');
    });
    Route::group(['prefix' => 'roles'], function (){
        Route::get('/',[UserManagementController::class,'roles'])->name('role.index');
        Route::post('/store',[UserManagementController::class,'createRole'])->name('role.store');
        Route::get('/edit/{id}',[UserManagementController::class,'editRole'])->name('role.edit');
        Route::post('/update/{id}',[UserManagementController::class,'updateRoles'])->name('role.update');
        Route::delete('/delete/{id}',[UserManagementController::class,'deleteRole']);
    });

    Route::group(['prefix'=>'guidelines'],function(){
        // Route::get('universities',[UniversityController::class, 'index'])->name('show.universities');
        Route::post('universities',[UniversityController::class, 'store_universities'])->name('add.university');
        Route::get('school_contacts',[UniversityController::class, 'school_contacts'])->name('school_contacts');
        Route::get('show_school_contacts/{id}',[UniversityController::class, 'show_school_contacts'])->name('show.school.contacts');
        Route::get('edit_school_contacts/{id}',[UniversityController::class, 'edit_school_contacts'])->name('edit_school_contacts');
        Route::post('update_school_contacts',[UniversityController::class, 'update_school_contacts'])->name('update_school_contacts');
        Route::delete('delete_school_contacts/{id}',[UniversityController::class, 'delete_school_contacts'])->name('delete_school_contacts');
        Route::get('add_school_contacts',[UniversityController::class, 'add_school_contacts'])->name('school.contacts');
        Route::post('save_school_contacts',[UniversityController::class, 'save_school_contacts'])->name('save_school_contacts');
        Route::get('/language/{locale?}/{page}', [UniversityController::class, 'language_switcher'])->name('lang.switcher');
        Route::get('/university_detail/{id}', [UniversityController::class, 'university_detail'])->name('university.detail');
        Route::get('/university_detail_ar/{id}', [UniversityController::class, 'university_detail_ar'])->name('university.detail.ar');
    });

    //accomodation routes
    Route::get('accommodation/{id}',[StudentButtonController::class, 'accomodation'])->name('accomodation');
    Route::get('add_accommodation/{id}',[StudentButtonController::class, 'add_accomodation'])->name('add_accomodation');
    Route::delete('delete_accommodation/{id}',[StudentButtonController::class, 'delete_accomodation'])->name('delete_accomodation');
    Route::post('accommodation',[StudentButtonController::class, 'store_accomodation'])->name('store.accomodation');
    Route::get('edit_accommodation/{id}',[StudentButtonController::class, 'edit_accomodation'])->name('edit_accomodation');
    Route::post('update_accommodation',[StudentButtonController::class, 'update_accomodation'])->name('update_accomodation');
    Route::delete('/delete_accommodation/{id}',[StudentButtonController::class, 'delete_accomodation'])->name('delete_accommodation');

    //login detail routes
    Route::get('login_details',[UniversityController::class, 'login_details'])->name('login.details');
    Route::get('add_login_details',[UniversityController::class, 'add_login_details'])->name('add.login.details');
    Route::delete('delete_login_detail/{id}',[UniversityController::class, 'delete_login_detail'])->name('delete_login_detail');
    Route::get('edit_login_detail/{id}',[UniversityController::class, 'edit_login_detail'])->name('edit_login_detail');
    Route::post('login_details',[UniversityController::class, 'store_login_details'])->name('store.login.details');
    Route::post('update_login_details/{id}',[UniversityController::class, 'update_login_details'])->name('update.login.details');


    //Visa Routes
    Route::get('visa',[StudentButtonController::class, 'add_visa'])->name('add.visa');
    Route::post('visa',[StudentButtonController::class, 'store_visa'])->name('store.visa');
    Route::get('visa_list',[StudentButtonController::class, 'visa_list'])->name('visa.list');
    Route::get('view_visa/{id}',[StudentButtonController::class, 'view_visa'])->name('view.visa');
    Route::get('edit_visa/{id}',[StudentButtonController::class, 'edit_visa'])->name('edit_visa');
    Route::delete('delete_visa/{id}',[StudentButtonController::class, 'delete_visa'])->name('delete_visa');
    Route::get('edit_visa/{id}',[StudentButtonController::class, 'edit_visa'])->name('edit_visa');
    Route::post('update_visa/{id}',[StudentButtonController::class, 'update_visa'])->name('update.visa');
    Route::post('visa_status',[StudentButtonController::class, 'visa_status'])->name('visa_status');
    Route::post('visa_complete_status',[StudentButtonController::class, 'visa_complete_status'])->name('visa_complete_status');
    Route::post('/visa_comment/{id}',[StudentButtonController::class, 'visa_comment'])->name('visa_comment');
    Route::get('show_visa_comment/{id}',[StudentButtonController::class, 'show_visa_comment'])->name('show_visa_comment');
    Route::delete('/delete_visa_comment/{id}',[StudentButtonController::class,'delete_visa_comment'])->name('delete_visa_comment');
    Route::post('visa_status_two',[StudentButtonController::class, 'visa_status_two'])->name('visa_status_two');
    Route::post('approved_status/{id}',[StudentButtonController::class, 'approved_status'])->name('approved_status');
    // courses Routes
    Route::get('/courses/{id}', [StudentButtonController::class,'task'])->name('task');
    Route::get('/edit_task', [StudentButtonController::class,'edit_task'])->name('edit_task');
    Route::delete('/delete_task/{id}', [StudentButtonController::class,'delete_task'])->name('delete_task');
    Route::post('/save_task', [StudentButtonController::class,'save_task'])->name('save_task');
    Route::post('/update_task', [StudentButtonController::class,'update_task'])->name('update_task');
    Route::post('/complete_status', [StudentButtonController::class,'complete_status'])->name('complete_status');
    Route::post('/update_task_status', [StudentButtonController::class,'update_task_status'])->name('update_task_status');
    Route::post('/accepted_status', [StudentButtonController::class,'accepted_status'])->name('accepted_status');

    // Course Routes
    Route::get('/course/{id}', [StudentButtonController::class,'course'])->name('course');
    Route::get('/edit_course', [StudentButtonController::class,'edit_course'])->name('edit_course');
    Route::delete('/delete_course/{id}', [StudentButtonController::class,'delete_course'])->name('delete_course');
    Route::post('/save_courses', [StudentButtonController::class,'save_courses'])->name('save_courses');
    Route::post('/update_course', [StudentButtonController::class,'update_course'])->name('update_course');

    //send sms Routes
    Route::post('sms_student',[StudentButtonController::class, 'send_sms_student'])->name('send.sms.student');
    Route::post('search',[StudentButtonController::class, 'search'])->name('generic.search');

    // TimeZone Routes
    Route::get('/zone_city', [UserManagementController::class,'zone_city'])->name('zone.city');
    Route::delete('/delete_zone_city/{id}',[UserManagementController::class,'delete_zone_city'])->name('delete_zone_city');
    Route::post('/store_zone_city',[UserManagementController::class,'store_zone_city'])->name('store.zone.city');
    Route::post('/edit_zone_city',[UserManagementController::class,'edit_zone_city'])->name('edit.zone.city');
    Route::post('/update_zone_city/{id}',[UserManagementController::class,'update_zone_city'])->name('update.zone.city');

    // student attachment Routes
    Route::post('save_attachment',[StudentButtonController::class,'save_attachment'])->name('save_attachment');
});


