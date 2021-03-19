<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;

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

Route::group(['middleware' => ['web']], function () {

    Route::group(["prefix" => 'admin'], function () {
        Route::get('/', [AuthController::class, 'showLogin'])->name('show.login');
        Route::post('check-login',  [AuthController::class, 'checkLogin'])->name('check.login');
        Route::post('forgot-Password/otp',  [AuthController::class, 'saveForgotPassword'])->name('save.forgotPassword');
        Route::post('reset-Password/reset',  [AuthController::class, 'updateResetPassword'])->name('update.resetPassword');
        Route::post('changePassword',  [AuthController::class, 'changePasswordLogin']);

        Route::group(['middleware' => ['admin', 'CheckPermission']], function () {

            Route::post('logout',  [AuthController::class, 'logout'])->name('logout');
            Route::get('profile/',  [AuthController::class, 'showProfile'])->name('profile.show');
            Route::post('profile/update',  [AuthController::class, 'updateProfile'])->name('profile.update');
            Route::get('change-password/',  [AuthController::class, 'showChangePassword'])->name('password.show');
            Route::post('change-password/update',  [AuthController::class, 'updatePassword'])->name('password.update');

            /*======== (-- DashboardController --) ========*/
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.show');

            /*======== (-- UserController --) ========*/
            Route::get('admin/users/sub-admins', 'Admin\UserController@showSubAdmins')->name('subAdmin.show');
            Route::get('admin/users/sub-admins/ajaxGetSubAdmins', 'Admin\UserController@ajaxGetSubAdmins');
            Route::get('admin/users/sub-admins/add', 'Admin\UserController@addSubAdmin')->name('subAdmin.add');
            Route::post('admin/users/sub-admins/add/save', 'Admin\UserController@saveSubAdmin')->name('subAdmin.save');
            Route::get('admin/users/sub-admins/edit/{id?}', 'Admin\UserController@editSubAdmin')->name('subAdmin.edit');
            Route::post('admin/users/sub-admins/edit/update', 'Admin\UserController@updateSubAdmin')->name('subAdmin.update');
            Route::get('admin/users/sub-admins/status/{id?}', 'Admin\UserController@statusSubAdmin')->name('subAdmin.status');
            Route::get('admin/users/sub-admins/details/{id?}', 'Admin\UserController@userAdminsDetail')->name('subAdmin.details');

            Route::get('admin/users/users', 'Admin\UserController@showCustomer')->name('show.customer');
            Route::get('admin/users/users/ajaxGetList', 'Admin\UserController@ajaxGetCustomer');
            Route::get('admin/users/users/status/{id?}', 'Admin\UserController@statusCustomer')->name('status.customer');
            Route::get('admin/users/users/details/{id?}', 'Admin\UserController@detailCustomer')->name('details.customer');


            /*======== (-- RoleController --) ========*/
            Route::get('roles-permissions/roles', [RoleController::class, 'showRole'])->name('admin.show.roles');
            Route::get('roles-permissions/roles/ajaxGetList', [RoleController::class, 'getRole']);
            Route::post('roles-permissions/roles/add/save', [RoleController::class, 'saveRole'])->name('admin.save.roles');
            Route::post('roles-permissions/roles/add/update', [RoleController::class, 'updateRole'])->name('admin.update.roles');
            Route::get('roles-permissions/roles/status/{id?}', [RoleController::class, 'statusRole'])->name('admin.status.roles');

            Route::get('roles-permissions/permissions', [RoleController::class, 'showPermission']);
            Route::get('roles-permissions/permissions/edit/{id}', [RoleController::class, 'showEditPermission']);
            Route::post('roles-permissions/permissions/edit/update', [RoleController::class, 'updatePermission'])->name('admin.update.permissions');


            /*======== (-- CustomizeButtonController --) ========*/
            Route::get('admin/customize-admin/appearance', 'Admin\CustomizeAdmin\CustomizeButtonController@showAppearance')->name('show.appearance');

            Route::get('admin/customize-admin/appearance/button/ajaxGetList', 'Admin\CustomizeAdmin\CustomizeButtonController@ajaxGetCustomizeButton')->name('get.customizeButton');
            Route::post('admin/customize-admin/appearance/button/add/save', 'Admin\CustomizeAdmin\CustomizeButtonController@saveCustomizeButton')->name('save.customizeButton');
            Route::post('admin/customize-admin/appearance/button/edit/update', 'Admin\CustomizeAdmin\CustomizeButtonController@updateCustomizeButton')->name('update.customizeButton');
            Route::get('admin/customize-admin/appearance/button/status/{id?}/{btnFor?}', 'Admin\CustomizeAdmin\CustomizeButtonController@statusCustomizeButton')->name('status.customizeButton');
            Route::get('admin/customize-admin/appearance/button/delete/{id?}', 'Admin\CustomizeAdmin\CustomizeButtonController@deleteCustomizeButton')->name('delete.customizeButton');

            /*======== (-- CustomizeTableController --) ========*/
            Route::get('admin/customize-admin/appearance/table/ajaxGetList', 'Admin\CustomizeAdmin\CustomizeTableController@ajaxGetCustomizeTable')->name('get.customizeTable');

            Route::get('admin/customize-admin/appearance/table/color/add', 'Admin\CustomizeAdmin\CustomizeTableController@addCustomizeTableColor')->name('add.customizeTableColor');
            Route::post('admin/customize-admin/appearance/table/color/add/save', 'Admin\CustomizeAdmin\CustomizeTableController@saveCustomizeTableColor')->name('save.customizeTableColor');
            Route::get('admin/customize-admin/appearance/table/color/edit/{id?}', 'Admin\CustomizeAdmin\CustomizeTableController@editCustomizeTableColor')->name('edit.customizeTableColor');
            Route::post('admin/customize-admin/appearance/table/color/edit/update', 'Admin\CustomizeAdmin\CustomizeTableController@updateCustomizeTableColor')->name('update.customizeTableColor');

            Route::get('admin/customize-admin/appearance/table/style/add/{id?}', 'Admin\CustomizeAdmin\CustomizeTableController@addCustomizeTableStyle')->name('add.customizeTableStyle');
            Route::post('admin/customize-admin/appearance/table/style/add/save', 'Admin\CustomizeAdmin\CustomizeTableController@saveCustomizeTableStyle')->name('save.customizeTableStyle');

            Route::get('admin/customize-admin/appearance/table/status/{id?}', 'Admin\CustomizeAdmin\CustomizeTableController@statusCustomizeTable')->name('status.customizeTable');
            Route::get('admin/customize-admin/appearance/table/delete/{id?}', 'Admin\CustomizeAdmin\CustomizeTableController@deleteCustomizeTable')->name('delete.customizeTable');
            Route::get('admin/customize-admin/appearance/table/details/{id?}', 'Admin\CustomizeAdmin\CustomizeTableController@detailsCustomizeTable')->name('details.customizeTable');

            /*======== (-- CustomizeLoaderController --) ========*/
            Route::get('admin/customize-admin/loader', 'Admin\CustomizeAdmin\CustomizeLoaderController@showCustomizeLoader')->name('show.customizeLoader');

            Route::get('admin/customize-admin/loader/internal/ajaxGetList', 'Admin\CustomizeAdmin\CustomizeLoaderController@ajaxGetInternalLoader')->name('get.customizeInternalLoader');
            Route::get('admin/customize-admin/loader/page/ajaxGetList', 'Admin\CustomizeAdmin\CustomizeLoaderController@ajaxGetPageLoader')->name('get.customizePageLoader');

            Route::post('admin/customize-admin/loader/add/save', 'Admin\CustomizeAdmin\CustomizeLoaderController@saveCustomizeLoader')->name('save.customizeLoader');
            Route::post('admin/customize-admin/loader/edit/update', 'Admin\CustomizeAdmin\CustomizeLoaderController@updateCustomizeLoader')->name('update.customizeLoader');

            Route::get('admin/customize-admin/loader/status/{id?}', 'Admin\CustomizeAdmin\CustomizeLoaderController@statusCustomizeLoader')->name('status.customizeLoader');
            Route::get('admin/customize-admin/loader/delete/{id?}', 'Admin\CustomizeAdmin\CustomizeLoaderController@deleteCustomizeLoader')->name('delete.customizeLoader');
            Route::get('admin/customize-admin/loader/details/{id?}', 'Admin\CustomizeAdmin\CustomizeLoaderController@detailsCustomizeLoader')->name('details.customizeLoader');


            /*======== (-- CmsController --) ========*/
            Route::get('admin/cms/banner', 'Admin\CmsController@showBanner')->name('show.banner');
            Route::get('admin/cms/banner/ajaxGetList', 'Admin\CmsController@ajaxGetBanner')->name('get.banner');
            Route::post('admin/cms/banner/add/save', 'Admin\CmsController@saveBanner')->name('save.banner');
            Route::post('admin/cms/banner/edit/update', 'Admin\CmsController@updateBanner')->name('update.banner');
            Route::get('admin/cms/banner/status/{id?}', 'Admin\CmsController@statusBanner')->name('status.banner');
            Route::get('admin/cms/banner/delete/{id?}', 'Admin\CmsController@deleteBanner')->name('delete.banner');

            Route::get('admin/cms/logo', 'Admin\CmsController@showLogo')->name('show.logo');
            Route::get('admin/cms/logo/ajaxGetList', 'Admin\CmsController@ajaxGetLogo');
            Route::post('admin/cms/logo/add/save', 'Admin\CmsController@saveLogo')->name('save.logo');
            Route::post('admin/cms/logo/edit/update', 'Admin\CmsController@updateLogo')->name('update.logo');
            Route::get('admin/cms/logo/status/{id?}', 'Admin\CmsController@statusLogo')->name('status.logo');
            Route::get('admin/cms/logo/delete/{id?}', 'Admin\CmsController@deleteLogo')->name('delete.logo');

            Route::get('admin/cms/privacy-policy', 'Admin\CmsController@showPrivacyPolicy')->name('show.privacyPolicy');
            Route::post('admin/cms/privacy-policy/save', 'Admin\CmsController@savePrivacyPolicy')->name('save.privacyPolicy');

            Route::get('admin/cms/terms-conditions', 'Admin\CmsController@showTermsConditions')->name('show.termsConditions');
            Route::post('admin/cms/terms-conditions/save', 'Admin\CmsController@saveTermsConditions')->name('save.termsConditions');

            Route::get('admin/cms/about-us', 'Admin\CmsController@showaboutUs')->name('show.aboutUs');
            Route::post('admin/cms/about-us/save', 'Admin\CmsController@saveaboutUs')->name('save.aboutUs');



            /*======== (-- DDDController --) ========*/
            Route::get('admin/getSubZone/{zoneId?}', 'Admin\DDDController@getSubZone')->name('get.subZone');


            /*======== (-- Error Page --) ========*/
            // Route::get('admin/page/404', 'Admin\CommonController@show404')->name('404');
            // Route::get('admin/page/500', 'Admin\CommonController@show500')->name('500');
        });
    });

    Route::get('/', function () {
        return view('welcome');
    });
});
