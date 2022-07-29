<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::group(['middleware' => ['auth', 'disablepreventback']], function () {
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
    Route::resource('/feesstructure','App\Http\Controllers\FeesController');
    Route::post('/feestore','App\Http\Controllers\FeesController@store')->name('feestore');
    Route::delete('feesdelete', 'App\Http\Controllers\FeesController@destroy')->name('destroy');
    Route::post('editfees', 'App\Http\Controllers\FeesController@update')->name('update');
    Route::resource('/students','App\Http\Controllers\StudentController');
    Route::delete('studentdelete', 'App\Http\Controllers\StudentController@destroy')->name('destroy');
    Route::get('Sedit/{id}', 'App\Http\Controllers\StudentController@edit')->name('edit');
    Route::post('editstudent', 'App\Http\Controllers\StudentController@update')->name('update');
    Route::resource('/reports','App\Http\Controllers\ReportController');
    Route::resource('/years','App\Http\Controllers\YearController');
    Route::post('report', 'App\Http\Controllers\ReportController@update')->name('update');
    Route::delete('reportdelete', 'App\Http\Controllers\ReportController@destroy')->name('destroy');
    Route::get('export', 'App\Http\Controllers\MyController@export')->name('export');
    Route::post('import', 'App\Http\Controllers\MyController@import')->name('import');
    Route::get('year/{id}', 'App\Http\Controllers\SidebarController@YearData')->name('YearData');
    Route::get('fees/{id}', 'App\Http\Controllers\FeesController@FeesData')->name('FeesData');
    Route::get('dashboard', 'App\Http\Controllers\DashboardController@index')->name('index');
    Route::post('datefilter', 'App\Http\Controllers\DashboardController@DateFilter')->name('DateFilter');
    Route::post('promote', 'App\Http\Controllers\FeesController@PromoteData')->name('PromoteData');
    Route::get('show/{id}/{yid}','App\Http\Controllers\StudentController@StudentShow')->name('StudentShow');
    Route::get('showResult/{id}/{cid}','App\Http\Controllers\StudentController@ShowResult')->name('ShowResult');
    Route::get('remove/{id}', 'App\Http\Controllers\YearController@RemoveCurrent')->name('RemoveCurrent');
    Route::resource('assignrole', 'App\Http\Controllers\RoleAssign');
    Route::post('editrole', 'App\Http\Controllers\RoleAssign@update')->name('update');
    Route::post('storerole', 'App\Http\Controllers\RoleAssign@store')->name('store');
    Route::delete('roledelete', 'App\Http\Controllers\RoleAssign@destroy')->name('destroy');
    Route::resource('/profile','App\Http\Controllers\ProfileController');
    Route::post('updateprofile', 'App\Http\Controllers\ProfileController@store')->name("updateprofile");
    Route::post('updatepassword', 'App\Http\Controllers\ProfileController@updatePassword')->name("updatepassword");
    Route::get('/extrapay','App\Http\Controllers\SidebarController@extraPay')->name('extraPay');
    Route::post('/extraStore','App\Http\Controllers\SidebarController@extraStore')->name('extraStore');
    Route::post('/printresult','App\Http\Controllers\StudentController@PrintResult')->name('PrintResult');
    Route::post('showdetails', 'App\Http\Controllers\SidebarController@showDetails')->name('showDetails');
    Route::post('addpayment', 'App\Http\Controllers\SidebarController@addPayment')->name('addPayment');
    Route::post('subpayment', 'App\Http\Controllers\SidebarController@subpayment')->name('subpayment');
    Route::post('classfilter', 'App\Http\Controllers\SidebarController@classfilter')->name('classfilter');
    Route::delete('destroy', 'App\Http\Controllers\SidebarController@destroy')->name('destroy');
    
});
// Route::group(['middleware' => ['auth','role:Admin']], function () 
// {
    // Route::get('/roles-permissions', 'App\Http\Controllers\RolePermissionController@roles')->name('roles-permissions');
    // Route::get('/role-create', 'App\Http\Controllers\RolePermissionController@createRole')->name('role.create');
    // Route::post('/role-store', 'App\Http\Controllers\RolePermissionController@storeRole')->name('role.store');
    // Route::get('/role-edit/{id}', 'App\Http\Controllers\RolePermissionController@editRole')->name('role.edit');
    // Route::put('/role-update/{id}', 'App\Http\Controllers\RolePermissionController@updateRole')->name('role.update');

    // Route::get('/permission-create', 'App\Http\Controllers\RolePermissionController@createPermission')->name('permission.create');
    // Route::post('/permission-store', 'App\Http\Controllers\RolePermissionController@storePermission')->name('permission.store');
    // Route::get('/permission-edit/{id}', 'App\Http\Controllers\RolePermissionController@editPermission')->name('permission.edit');
    // Route::put('/permission-update/{id}', 'App\Http\Controllers\RolePermissionController@updatePermission')->name('permission.update');

   

// });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



