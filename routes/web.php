<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Yb_AdminController;
use App\Http\Controllers\Admin\Yb_ServiceController;
use App\Http\Controllers\Admin\Yb_CategoryController;
use App\Http\Controllers\Admin\Yb_BlogController;
use App\Http\Controllers\Admin\Yb_FaqController;
use App\Http\Controllers\Admin\Yb_PageController;
use App\Http\Controllers\Admin\Yb_SettingController;
use App\Http\Controllers\User\Yb_UserController;
use App\Http\Controllers\User\Yb_ServiceController as Yb_UserServiceController; 
use App\Http\Controllers\User\Yb_CategoryController as Yb_UserCategoryController;
use App\Http\Controllers\User\Yb_SocialSettingController as Yb_UserSocialController;
use App\Http\Controllers\User\Yb_HeroSectionController;
use App\Http\Controllers\User\Yb_SkillController;
use App\Http\Controllers\User\Yb_ExperienceController;
use App\Http\Controllers\User\Yb_TestimonialController;
use App\Http\Controllers\User\Yb_PortfolioController;
//use App\Http\Controllers\User\Yb_PreferenceController;
use App\Http\Controllers\Yb_HomeController;
use App\Http\Controllers\Yb_ProfileController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['middleware'=>'installed'], function(){
        Route::group(['middleware'=>'protectedPage'],function(){
            Route::any('/admin',[Yb_AdminController::class,'yb_index']);    
            Route::get('admin/logout',[Yb_AdminController::class,'yb_logout']); 
            Route::get('admin/dashboard',[Yb_AdminController::class,'yb_dashboard']);
            Route::resource('admin/services',Yb_ServiceController::class);
            Route::resource('admin/category',Yb_CategoryController::class);
            Route::resource('admin/blogs',Yb_BlogController::class);
            Route::resource('admin/faqs',Yb_FaqController::class);
            Route::resource('admin/pages',Yb_PageController::class);
            Route::post('admin/page_showIn_header',[Yb_PageController::class,'yb_show_in_header']);
            Route::post('admin/page_showIn_footer',[Yb_PageController::class,'yb_show_in_footer']);

            Route::get('admin/contact',[Yb_SettingController::class,'yb_contact']); 
            Route::post('admin/contact/{id}',[Yb_SettingController::class,'yb_view_contactMessage']); 
            Route::get('admin/users',[Yb_SettingController::class,'yb_user']); 
            Route::post('admin/change-user-status',[Yb_SettingController::class,'yb_changeUser_status']); 
            Route::any('admin/general-settings',[Yb_SettingController::class,'yb_general_settings']);
            Route::any('admin/profile-settings',[Yb_SettingController::class,'yb_profile_settings']);
            Route::post('admin/change-password',[Yb_SettingController::class,'yb_change_password']);
            Route::any('admin/social-settings',[Yb_SettingController::class,'yb_social_settings']);
            Route::any('admin/banner-settings',[Yb_SettingController::class,'yb_banner_settings']);
        });
    Route::group(['middleware'=>'userProtectedPage'],function(){
        Route::any('login',[Yb_UserController::class,'yb_index']);
        Route::get('user/my-profile',[Yb_UserController::class,'yb_profile_settings']);
        Route::any('user/edit-profile',[Yb_UserController::class,'yb_update_profile']);
        Route::post('user/check-user-slug',[Yb_UserController::class,'yb_check_user_slug']);
        Route::any('user/change-password',[Yb_UserController::class,'yb_change_password']);
        Route::post('user/page_showIn_status',[Yb_UserController::class,'yb_show_in_status']);
        Route::post('user/update-preferenceOrder',[Yb_UserController::class,'yb_updatePreferenceOrder']);
        Route::resource('user/services',Yb_UserServiceController::class);
        Route::resource('user/skill',Yb_SkillController::class);
        Route::resource('user/experience',Yb_ExperienceController::class);
        Route::resource('user/testimonial',Yb_TestimonialController::class);
        Route::resource('user/category',Yb_UserCategoryController::class);
        Route::resource('user/portfolio',Yb_PortfolioController::class);
        Route::resource('user/social-settings',Yb_UserSocialController::class);
        Route::any('user/hero-section',[Yb_HeroSectionController::class,'index']);

        Route::any('forgot-password',[Yb_UserController::class,'yb_forgot_password']);
        Route::post('update-password',[Yb_UserController::class,'yb_reset_passwordUpdate']);
        Route::get('reset-password',[Yb_UserController::class,'yb_reset_password']);

        Route::get('user/contact',[Yb_UserController::class,'yb_contact']); 
        Route::post('user/contact/{id}',[Yb_UserController::class,'yb_viewContact_message']); 
        Route::any('signup',[Yb_UserController::class,'yb_signup']); 
        Route::any('user/layouts',[Yb_UserController::class,'yb_layouts']); 
        Route::any('user/logout',[Yb_UserController::class,'yb_logout']);
    });
Route::post('user/saveContact-message',[Yb_ProfileController::class,'yb_saveContact_message']);
Route::get('/',[Yb_HomeController::class,'yb_index']); 
Route::get('blog',[Yb_HomeController::class,'yb_blog']);
Route::get('blog/c/{slug}',[Yb_HomeController::class,'yb_category_blog']);
Route::get('blog/{slug}',[Yb_HomeController::class,'yb_single_blog']);
Route::get('layouts',[Yb_HomeController::class,'yb_layouts']);
Route::any('contact',[Yb_HomeController::class,'yb_contact']);
Route::get('p/{slug}',[Yb_HomeController::class,'yb_custom_page']); 
Route::get('user/show-project/{id}',[Yb_ProfileController::class,'yb_show_project']);
Route::get('{slug}',[Yb_ProfileController::class,'yb_home']); 


});