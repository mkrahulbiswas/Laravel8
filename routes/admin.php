<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthAdminController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\RoleAdminController;
use App\Http\Controllers\Admin\CustomizeAdmin\CustomizeButtonAdminController;
use App\Http\Controllers\Admin\CustomizeAdmin\CustomizeTableAdminController;
use App\Http\Controllers\Admin\CustomizeAdmin\CustomizeLoaderAdminController;

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

Route::group(['middleware' => ['admin']], function () {
    Route::get('/', [AuthAdminController::class, 'showLogin'])->name('show.login');
    Route::post('check-login',  [AuthAdminController::class, 'checkLogin'])->name('check.login');
    Route::post('forgot-Password/otp',  [AuthAdminController::class, 'saveForgotPassword'])->name('save.forgotPassword');
    Route::post('reset-Password/reset',  [AuthAdminController::class, 'updateResetPassword'])->name('update.resetPassword');
    Route::post('changePassword',  [AuthAdminController::class, 'changePasswordLogin']);

    Route::group(['middleware' => ['CheckAdmin', 'CheckPermission']], function () {

        Route::post('logout',  [AuthAdminController::class, 'logout'])->name('logout');
        Route::get('profile/',  [AuthAdminController::class, 'showProfile'])->name('profile.show');
        Route::post('profile/update',  [AuthAdminController::class, 'updateProfile'])->name('profile.update');
        Route::get('change-password/',  [AuthAdminController::class, 'showChangePassword'])->name('password.show');
        Route::post('change-password/update',  [AuthAdminController::class, 'updatePassword'])->name('password.update');

        /*======== (-- DashboardAdminController --) ========*/
        Route::get('dashboard', [DashboardAdminController::class, 'index'])->name('dashboard.show');

        /*======== (-- UserAdminController --) ========*/
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


        /*======== (-- RoleAdminController --) ========*/
        Route::get('roles-permissions/roles', [RoleAdminController::class, 'showRole'])->name('admin.show.roles');
        Route::get('roles-permissions/roles/ajaxGetList', [RoleAdminController::class, 'getRole']);
        Route::post('roles-permissions/roles/add/save', [RoleAdminController::class, 'saveRole'])->name('admin.save.roles');
        Route::post('roles-permissions/roles/add/update', [RoleAdminController::class, 'updateRole'])->name('admin.update.roles');
        Route::get('roles-permissions/roles/status/{id?}', [RoleAdminController::class, 'statusRole'])->name('admin.status.roles');

        Route::get('roles-permissions/permissions', [RoleAdminController::class, 'showPermission']);
        Route::get('roles-permissions/permissions/edit/{id}', [RoleAdminController::class, 'showEditPermission']);
        Route::post('roles-permissions/permissions/edit/update', [RoleAdminController::class, 'updatePermission'])->name('admin.update.permissions');


        /*======== (-- CustomizeButtonAdminController --) ========*/
        Route::get('customize-admin/appearance', [CustomizeButtonAdminController::class, 'showAppearance'])->name('admin.show.appearance');

        Route::get('customize-admin/appearance/button/ajaxGetList', [CustomizeButtonAdminController::class, 'ajaxGetCustomizeButton'])->name('admin.get.customizeButton');
        Route::post('customize-admin/appearance/button/add/save', [CustomizeButtonAdminController::class, 'saveCustomizeButton'])->name('admin.save.customizeButton');
        Route::post('customize-admin/appearance/button/edit/update', [CustomizeButtonAdminController::class, 'updateCustomizeButton'])->name('admin.update.customizeButton');
        Route::get('customize-admin/appearance/button/status/{id?}/{btnFor?}', [CustomizeButtonAdminController::class, 'statusCustomizeButton'])->name('admin.status.customizeButton');
        Route::get('customize-admin/appearance/button/delete/{id?}', [CustomizeButtonAdminController::class, 'deleteCustomizeButton'])->name('admin.delete.customizeButton');

        /*======== (-- CustomizeTableAdminController --) ========*/
        Route::get('customize-admin/appearance/table/ajaxGetList', [CustomizeTableAdminController::class, 'ajaxGetCustomizeTable'])->name('admin.get.customizeTable');

        Route::get('customize-admin/appearance/table/color/add', [CustomizeTableAdminController::class, 'addCustomizeTableColor'])->name('admin.add.customizeTableColor');
        Route::post('customize-admin/appearance/table/color/add/save', [CustomizeTableAdminController::class, 'saveCustomizeTableColor'])->name('admin.save.customizeTableColor');
        Route::get('customize-admin/appearance/table/color/edit/{id?}', [CustomizeTableAdminController::class, 'editCustomizeTableColor'])->name('admin.edit.customizeTableColor');
        Route::post('customize-admin/appearance/table/color/edit/update', [CustomizeTableAdminController::class, 'updateCustomizeTableColor'])->name('admin.update.customizeTableColor');

        Route::get('customize-admin/appearance/table/style/add/{id?}', [CustomizeTableAdminController::class, 'addCustomizeTableStyle'])->name('admin.add.customizeTableStyle');
        Route::post('customize-admin/appearance/table/style/add/save', [CustomizeTableAdminController::class, 'saveCustomizeTableStyle'])->name('admin.save.customizeTableStyle');

        Route::get('customize-admin/appearance/table/status/{id?}', [CustomizeTableAdminController::class, 'statusCustomizeTable'])->name('admin.status.customizeTable');
        Route::get('customize-admin/appearance/table/delete/{id?}', [CustomizeTableAdminController::class, 'deleteCustomizeTable'])->name('admin.delete.customizeTable');
        Route::get('customize-admin/appearance/table/details/{id?}', [CustomizeTableAdminController::class, 'detailsCustomizeTable'])->name('admin.details.customizeTable');

        /*======== (-- CustomizeLoaderAdminController --) ========*/
        Route::get('customize-admin/loader', [CustomizeLoaderAdminController::class, 'showCustomizeLoader'])->name('admin.show.customizeLoader');

        Route::get('customize-admin/loader/internal/ajaxGetList', [CustomizeLoaderAdminController::class, 'ajaxGetInternalLoader'])->name('admin.get.customizeInternalLoader');
        Route::get('customize-admin/loader/page/ajaxGetList', [CustomizeLoaderAdminController::class, 'ajaxGetPageLoader'])->name('admin.get.customizePageLoader');

        Route::post('customize-admin/loader/add/save', [CustomizeLoaderAdminController::class, 'saveCustomizeLoader'])->name('admin.save.customizeLoader');
        Route::post('customize-admin/loader/edit/update', [CustomizeLoaderAdminController::class, 'updateCustomizeLoader'])->name('admin.update.customizeLoader');

        Route::get('customize-admin/loader/status/{id?}', [CustomizeLoaderAdminController::class, 'statusCustomizeLoader'])->name('admin.status.customizeLoader');
        Route::get('customize-admin/loader/delete/{id?}', [CustomizeLoaderAdminController::class, 'deleteCustomizeLoader'])->name('admin.delete.customizeLoader');
        Route::get('customize-admin/loader/details/{id?}', [CustomizeLoaderAdminController::class, 'detailsCustomizeLoader'])->name('admin.details.customizeLoader');


        /*======== (-- CmsAdminController --) ========*/
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



        /*======== (-- DDDAdminController --) ========*/
        Route::get('admin/getSubZone/{zoneId?}', 'Admin\DDDAdminController@getSubZone')->name('get.subZone');


        /*======== (-- Error Page --) ========*/
        // Route::get('admin/page/404', 'Admin\CommonController@show404')->name('404');
        // Route::get('admin/page/500', 'Admin\CommonController@show500')->name('500');
    });
});
