<?php

use App\Http\Controllers\AdministrationRoleController;
use App\Http\Controllers\AdvertController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\BursaryController;
use App\Http\Controllers\BursaryRecommendController;
use App\Http\Controllers\BusinessCategoryController;
use App\Http\Controllers\BusinessFundingCategoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\FlgMembershipPlanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SermonController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\SubscriptionPlanController;
use App\Http\Controllers\SuperAdminAuctionController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\TeamCategoryController;
use App\Http\Controllers\UserQAController;
use App\Http\Controllers\WithdrawalController;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest:superadmin'],'prefix'=>'superadmin','as'=>'superadmin.'],function(){

    Route::get('login', [SuperAdminController::class, 'login'])->name('login');

    Route::post('login', [SuperAdminController::class, 'store'])->name('login.store');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');
    Route::get('forgot-password', [SuperAdminController::class, 'forgotPassword'])
    ->name('forgot-password');
});

Route::group(['middleware' => ['auth:superadmin'],'prefix'=>'superadmin','as'=>'superadmin.'],function(){

    Route::get('/', function () {
        return redirect('/login');
    });
    Route::get('dashboard', [SuperAdminController::class,'dashboard'])->name('dashboard');
    Route::get('reports_analytics', [SuperAdminController::class,'reports_analytics'])->name('reports_analytics');
    Route::get('donations_graph', [DonationController::class,'adminGraph'])->name('donations_graph');
    Route::get('withdrawals_graph', [WithdrawalController::class,'adminGraph'])->name('withdrawals_graph');
    Route::get('submissions_graph', [SubmissionController::class,'adminSubmissionsGraph'])->name('submissions_graph');
    Route::get('categories/{id?}', [CategoryController::class,'index'])->name('categories');
    Route::post('categories', [CategoryController::class,'store'])->name('categories.store');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('business_categories/{id?}', [BusinessCategoryController::class,'index'])->name('business_categories');
    Route::get('business_categories/{id?}/businesses', [BusinessCategoryController::class,'indexBusinesses'])->name('business_categories.businesses');
    Route::post('business_categories', [BusinessCategoryController::class,'store'])->name('business_categories.store');
    Route::delete('business_categories/{category}', [BusinessCategoryController::class, 'destroy'])->name('business_categories.destroy');
    Route::get('business_funding_categories/{id?}', [BusinessFundingCategoryController::class,'index'])->name('business_funding_categories');
    Route::get('business_funding_categories/{id?}/fundings', [BusinessFundingCategoryController::class,'indexFundings'])->name('business_funding_categories.fundings');
    Route::post('business_funding_categories_get', [BusinessFundingCategoryController::class,'show'])->name('business_funding_categories.show');
    Route::post('business_funding_categories', [BusinessFundingCategoryController::class,'store'])->name('business_funding_categories.store');
    Route::delete('business_funding_categories/{category}', [BusinessFundingCategoryController::class, 'destroy'])->name('business_funding_categories.destroy');
    Route::get('administration_roles', [AdministrationRoleController::class,'index'])->name('administration_roles');
    Route::get('administration_roles/{id}', [AdministrationRoleController::class,'show'])->name('administration_roles.show');
    Route::post('administration_roles/block/{user}', [AdministrationRoleController::class,'block'])->name('administration_roles.block');
    Route::post('administration_roles', [AdministrationRoleController::class,'store'])->name('administration_roles.store');
    Route::delete('administration_roles/{user}', [AdministrationRoleController::class, 'destroy'])->name('administration_roles.destroy');

    Route::get('members', [MemberController::class,'indexAdmin'])->name('members');
    Route::get('members/{id}', [MemberController::class,'show'])->name('members.show');
    Route::post('members/block/{member}', [MemberController::class,'block'])->name('members.block');
    Route::post('members', [MemberController::class,'store'])->name('members.store');
    Route::delete('members/{member}', [MemberController::class, 'destroy'])->name('members.destroy');
    Route::get('transactions', [WithdrawalController::class,'indexAdmin'])->name('transactions');
    Route::get('transactions/{id}', [WithdrawalController::class,'showAdmin'])->name('transactions.show');

    Route::get('adverts', [AdvertController::class,'index'])->name('adverts');
    Route::post('adverts', [AdvertController::class,'store'])->name('adverts.store');
    Route::get('adverts/{advert}', [AdvertController::class,'show'])->name('adverts.show');
    Route::post('adverts_get', [AdvertController::class,'advertGet'])->name('adverts.advertGet');
    Route::delete('adverts/{advert}', [AdvertController::class, 'destroy'])->name('adverts.destroy');
    Route::put('adverts/{advert}', [AdvertController::class, 'update'])->name('adverts.update');

    Route::get('cms', [CmsController::class,'index'])->name('cms');
    Route::get('cms/edit_advertisement', [CmsController::class,'editAdvertisement'])->name('cms.edit_advertisement');
    Route::get('cms/edit_code_conduct', [CmsController::class,'editCodeConduct'])->name('cms.edit_code_conduct');
    Route::get('cms/edit_splash_screen', [CmsController::class,'editSplashScreen'])->name('cms.edit_splash_screen');
    Route::get('cms/intro_screens', [CmsController::class,'introScreens'])->name('cms.intro_screens');
    Route::get('cms/intro_screens/{id}', [CmsController::class,'editIntroScreen'])->name('cms.intro_screens.edit');
    Route::get('cms/edit_terms_policy', [CmsController::class,'editTermsPolicy'])->name('cms.edit_terms_policy');
    Route::get('cms/edit_help_center', [CmsController::class,'editHelpCenter'])->name('cms.edit_help_center');
    Route::get('cms/education_trust', [CmsController::class,'editEducationTrust'])->name('cms.education_trust');
    Route::get('cms/polocano', [CmsController::class,'editPolocano'])->name('cms.polocano');
    Route::put('cms/update', [CmsController::class,'update'])->name('cms.update');
    
    Route::get('qas', [UserQAController::class,'indexAdmin'])->name('qas');
    Route::post('qas', [UserQAController::class,'store'])->name('qas.store');
    Route::put('qas', [UserQAController::class,'update'])->name('qas.update');
    Route::delete('qas/{userqa}', [UserQAController::class,'destroy'])->name('qas.destroy');

    Route::get('bursaries/{id}', [BursaryController::class,'indexAdmin'])->name('bursaries.index');
    Route::get('bursary_recommends', [BursaryRecommendController::class,'indexAdmin'])->name('bursary_recommends');
    Route::post('bursary_recommends', [BursaryRecommendController::class,'store'])->name('bursary_recommends.store');
    Route::post('bursary_recommends_get', [BursaryRecommendController::class,'show'])->name('bursary_recommends.show');
    Route::put('bursary_recommends/{bursary_recommend}', [BursaryRecommendController::class, 'update'])->name('bursary_recommends.update');
    Route::delete('bursary_recommends/{bursary_recommend}', [BursaryRecommendController::class, 'destroy'])->name('bursary_recommends.destroy');

    Route::get('teamcategories', [TeamCategoryController::class,'index'])->name('teamcategories');
    Route::post('teamcategories', [TeamCategoryController::class,'store'])->name('teamcategories.store');
    Route::put('teamcategories/{id}', [TeamCategoryController::class,'update'])->name('teamcategories.update');
    Route::delete('teamcategories/{id}', [TeamCategoryController::class,'destroy'])->name('teamcategories.destroy');
    Route::post('teamcategories_get', [TeamCategoryController::class,'show'])->name('teamcategories.get');
    Route::delete('flgmembershipplans/{flgMembershipPlan}', [FlgMembershipPlanController::class,'destroy'])->name('flgmembershipplans.destroy');

    Route::get('sermons', [SermonController::class,'index'])->name('sermons');
    Route::post('sermons', [SermonController::class,'store'])->name('sermons.store');
    Route::post('sermons_get', [SermonController::class,'show'])->name('sermons.show');
    Route::put('sermons/{sermon}', [SermonController::class, 'update'])->name('sermons.update');
    Route::delete('sermons/{sermon}', [SermonController::class, 'destroy'])->name('sermons.destroy');
    Route::get('news', [NewsController::class,'index'])->name('news');
    Route::post('news', [NewsController::class,'store'])->name('news.store');
    Route::post('news_get', [NewsController::class,'show'])->name('news.show');
    Route::put('news/{news}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
    // Route::get('cms', [CmsScreenController::class,'index'])->name('cms');
    // Route::get('users', [UsersManagementController::class,'index'])->name('users.index');
    // Route::get('users/buyers', [UsersManagementController::class,'buyers'])->name('users.buyers');
    // Route::get('users/sellers', [UsersManagementController::class,'sellers'])->name('users.sellers');
    // Route::get('users/verificators', [UsersManagementController::class,'verificators'])->name('users.verificators');
    // Route::post('users/verificators', [UsersManagementController::class,'storeVerificator'])->name('users.verificators.store');
    // Route::get('users/authenticators', [UsersManagementController::class,'authenticators'])->name('users.authenticators');
    // Route::post('users/authenticators', [UsersManagementController::class,'storeAuthenticator'])->name('users.verificators.store');
    // Route::post('users/get', [UsersManagementController::class,'getUser'])->name('users.get');
    // Route::post('users/delete', [UsersManagementController::class,'destroyUser'])->name('users.destroy');
    // Route::post('users/block', [UsersManagementController::class,'blockUser'])->name('users.block');

    // Route::get('properties', [PropertyManagementController::class,'index'])->name('properties.index');

    // Route::get('reports', [PropertyManagementController::class,'reports'])->name('reports.index');
    Route::post('updateProfile', [SuperAdminController::class,'updateProfile'])->name('updateProfile');
    Route::post('profile/updatePassword', [SuperAdminController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::get('profile/changePassword', [SuperAdminController::class, 'changePassword'])->name('profile.changePassword');
    Route::get('profile', [SuperAdminController::class,'profile'])->name('profile');

    Route::post('logout', [SuperAdminController::class, 'destroy'])
                ->name('logout');
});