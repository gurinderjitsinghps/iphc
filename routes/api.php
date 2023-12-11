<?php

use App\Http\Controllers\AdministrationRoleController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BranchReportController;
use App\Http\Controllers\BursaryAcademicController;
use App\Http\Controllers\BursaryController;
use App\Http\Controllers\BursaryParentController;
use App\Http\Controllers\BursaryRecommendController;
use App\Http\Controllers\BusinessCategoryController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\BusinessFundingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CmsController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DonationRegistrationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FinancialEducationController;
use App\Http\Controllers\FlgContributionController;
use App\Http\Controllers\FlgMembershipController;
use App\Http\Controllers\FrontUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PolokanoController;
use App\Http\Controllers\PolokanoPremiumController;
use App\Http\Controllers\SermonController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\SubmissionQAController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserFeedbackController;
use App\Http\Controllers\UserQAController;
use App\Http\Controllers\UserRequestController;
use App\Http\Controllers\WithdrawalController;
use App\Models\BursaryAcademic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:user'],'prefix'=>'user','as'=>'user.'],function(){
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.store');
    Route::put('profile', [ProfileController::class, 'updateProfile'])->name('profile.updateProfile');
    Route::post('change-password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
    Route::get('categories/byType', [CategoryController::class, 'getByType'])->name('categories.getByType');
    Route::get('categories/getRegionBranches', [CategoryController::class, 'getRegionBranches'])->name('categories.getRegionBranches');
    Route::get('get_branch_secretary_by_region', [CategoryController::class, 'get_branch_secretary_by_region'])->name('get_branch_secretary_by_region');

});
Route::group(['middleware' => ['guest:user'],'prefix'=>'user','as'=>'user.'],function(){
    Route::get('countrycodes', [RegisteredUserController::class, 'countrycodes'])->name('countrycodes');
    Route::post('generateOtp', [RegisteredUserController::class, 'generateOtp'])->name('generateOtp');
    Route::post('register', [RegisteredUserController::class, 'store'])->name('register.store');
    Route::post('login', [RegisteredUserController::class, 'login'])->name('login');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');
    
});
Route::group(['middleware' => ['guest:frontuser'],'prefix'=>'frontuser','as'=>'frontuser.'],function(){
    Route::get('countrycodes', [RegisteredUserController::class, 'countrycodes'])->name('countrycodes');
    Route::post('generateOtp', [FrontUserController::class, 'generateOtp'])->name('generateOtp');
    Route::post('generateOtpLogin', [FrontUserController::class, 'generateOtpLogin'])->name('generateOtpLogin');
    Route::post('register', [FrontUserController::class, 'store'])->name('register.store');
    Route::post('register_by_phone', [FrontUserController::class, 'storeByPhone'])->name('register.storeByPhone');
    Route::post('login', [FrontUserController::class, 'login'])->name('login');
    Route::post('loginOtp', [FrontUserController::class, 'loginOtp'])->name('loginOtp');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');
});
Route::group(['middleware' => ['auth:frontuser'],'prefix'=>'frontuser','as'=>'frontuser.'],function(){
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.store');
    Route::put('profile', [ProfileController::class, 'updateProfile'])->name('profile.updateProfile');
    Route::post('change-password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
    Route::post('qas', [UserQAController::class, 'store'])->name('qas.store');
    Route::get('card_details', [FlgMembershipController::class, 'cardDetails'])->name('flgmemberships.card_details');
    Route::post('flgmemberships', [FlgMembershipController::class, 'store'])->name('flgmemberships.store');
    Route::post('flgcontributions', [FlgContributionController::class, 'store'])->name('flgcontributions.store');
    Route::get('financial_education', [FinancialEducationController::class, 'index'])->name('financial_education.index');
    Route::post('financial_education', [FinancialEducationController::class, 'store'])->name('financial_education.store');
    Route::get('financial_education/{id}', [FinancialEducationController::class, 'show'])->name('financial_education.show');
    Route::post('donations', [DonationController::class, 'store'])->name('donations.store');
    Route::post('donation_registrations', [DonationRegistrationController::class, 'store'])->name('donation_registrations.store');

    Route::get('sermons', [SermonController::class, 'indexFront'])->name('sermons.index');
    Route::get('events', [EventController::class, 'indexFront'])->name('events.index');
    Route::get('events/{id}', [EventController::class, 'showFront'])->name('events.index');
    Route::post('user_feedbacks', [UserFeedbackController::class, 'store'])->name('user_feedbacks.store');

    Route::get('code_of_conduct', [CmsController::class, 'codeOfConduct'])->name('code_of_conduct');

    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');

    Route::get('business_categories/{id?}', [BusinessCategoryController::class,'indexFront'])->name('business_categories');
    Route::get('businesses', [BusinessController::class, 'index'])->name('businesses.index');
    Route::post('businesses', [BusinessController::class, 'store'])->name('businesses.store');
    Route::post('business_fundings', [BusinessFundingController::class, 'store'])->name('business_fundings.store');

    Route::get('bursary_recommends', [BursaryRecommendController::class, 'index'])->name('bursary_recommends.index');

    Route::post('bursaries', [BursaryController::class, 'store'])->name('bursaries.store');
    Route::post('bursary_academics', [BursaryAcademicController::class, 'store'])->name('bursary_academics.store');
    Route::post('bursary_parents', [BursaryParentController::class, 'store'])->name('bursary_parents.store');
    Route::post('bursary_signature', [BursaryController::class, 'storeSignature'])->name('bursaries.storeSignature');

    Route::post('polokanos', [PolokanoController::class, 'store'])->name('polokanos.store');
    Route::post('polokanos/premium', [PolokanoPremiumController::class, 'store'])->name('polokanos.premium.store');

});

Route::group(['middleware' => ['auth:user','checkUserRole:regional_treasurer'],'prefix'=>'regional_treasurer','as'=>'regional_treasurer.'],function(){
    Route::get('submissions', [SubmissionController::class, 'index'])->name('submissions.index');
    Route::get('submissions/{id}', [SubmissionController::class, 'show'])->name('submissions.show');
    Route::post('branchreports', [BranchReportController::class, 'store'])->name('branchreports.store');

    Route::put('submissions/{submission}', [SubmissionController::class, 'update'])->name('submissions.update');

    Route::post('submissionqas', [SubmissionQAController::class, 'store'])->name('qsubmissionqasas.store');


});
Route::group(['middleware' => ['auth:user','checkUserRole:regional_secretary'],'prefix'=>'regional_secretary','as'=>'regional_secretary.'],function(){
    Route::get('submissions', [SubmissionController::class, 'index'])->name('submissions.index');
    Route::get('submissions/{id}', [SubmissionController::class, 'show'])->name('submissions.show');
    Route::put('submissions/{submission}', [SubmissionController::class, 'update'])->name('submissions.update');
    Route::post('branchreports', [BranchReportController::class, 'store'])->name('branchreports.store');
    Route::get('branchreports', [BranchReportController::class, 'index'])->name('branchreports.index');
    Route::get('branchreports/{id}', [BranchReportController::class, 'show'])->name('branchreports.show');
    Route::get('withdrawals', [WithdrawalController::class, 'index'])->name('withdrawals.index');
    Route::post('withdrawals', [WithdrawalController::class, 'store'])->name('withdrawals.store');
    Route::get('events', [EventController::class, 'index'])->name('events.index');
    Route::get('events/{id}', [EventController::class, 'show'])->name('events.show');
    Route::post('events', [EventController::class, 'store'])->name('events.store');
    Route::get('followup', [BranchReportController::class, 'followup'])->name('followup');

});
Route::group(['middleware' => ['auth:user','checkUserRole:regional_chairman'],'prefix'=>'regional_chairman','as'=>'regional_chairman.'],function(){
    Route::get('submissions', [SubmissionController::class, 'index'])->name('submissions.index');
    Route::get('submissions_summary_report', [SubmissionController::class, 'submissions_summary_report'])->name('submissions.submissions_summary_report');
    Route::get('submissions/{id}', [SubmissionController::class, 'show'])->name('submissions.show');
    Route::put('submissions/{submission}', [SubmissionController::class, 'update'])->name('submissions.update');
    Route::get('events', [EventController::class, 'index'])->name('events.index');
    Route::get('events/{id}', [EventController::class, 'show'])->name('events.show');
    Route::get('branchreports', [BranchReportController::class, 'index'])->name('branchreports.index');
    Route::get('branchreports/{id}', [BranchReportController::class, 'show'])->name('branchreports.show');
});
Route::group(['middleware' => ['auth:user','checkUserRole:regional_priest'],'prefix'=>'regional_priest','as'=>'regional_priest.'],function(){
    Route::get('submissions', [SubmissionController::class, 'index'])->name('submissions.index');
    Route::get('submissions/{id}', [SubmissionController::class, 'show'])->name('submissions.show');
    Route::put('submissions/{submission}', [SubmissionController::class, 'update'])->name('submissions.update');
    Route::get('events', [EventController::class, 'index'])->name('events.index');
    Route::get('events/{id}', [EventController::class, 'show'])->name('events.show');
    Route::get('branchreports', [BranchReportController::class, 'index'])->name('branchreports.index');
    Route::get('branchreports/{id}', [BranchReportController::class, 'show'])->name('branchreports.show');
});
Route::group(['middleware' => ['auth:user','checkUserRole:comforters_profile'],'prefix'=>'comforters_profile','as'=>'comforters_profile.'],function(){
    Route::get('submissions', [SubmissionController::class, 'index'])->name('submissions.index');
    Route::get('submissions/{id}', [SubmissionController::class, 'show'])->name('submissions.show');
    Route::put('submissions/{submission}', [SubmissionController::class, 'update'])->name('submissions.update');
    Route::get('events', [EventController::class, 'index'])->name('events.index');
    Route::get('events/{id}', [EventController::class, 'show'])->name('events.show');
    Route::post('events', [EventController::class, 'store'])->name('events.store');
    Route::get('branchreports', [BranchReportController::class, 'index'])->name('branchreports.index');
    Route::get('branchreports/{id}', [BranchReportController::class, 'show'])->name('branchreports.show');
    Route::post('user_roles', [RegisteredUserController::class, 'addUser'])->name('user_roles.store');
    Route::delete('user_roles/{id}', [AdministrationRoleController::class, 'destroy'])->name('user_roles.destroy');
    Route::post('user_roles/block/{user}', [AdministrationRoleController::class,'block'])->name('user_roles.block');

});
Route::group(['middleware' => ['auth:user','checkUserRole:national_office_priest'],'prefix'=>'national_office_priest','as'=>'national_office_priest.'],function(){
    Route::get('submissions', [SubmissionController::class, 'index'])->name('submissions.index');
    Route::get('submissions/{id}', [SubmissionController::class, 'show'])->name('submissions.show');
    Route::put('submissions/{submission}', [SubmissionController::class, 'update'])->name('submissions.update');
    Route::get('events', [EventController::class, 'index'])->name('events.index');
    Route::get('events/{id}', [EventController::class, 'show'])->name('events.show');
    Route::post('events', [EventController::class, 'store'])->name('events.store');
    Route::get('branchreports', [BranchReportController::class, 'index'])->name('branchreports.index');
    Route::get('branchreports/{id}', [BranchReportController::class, 'show'])->name('branchreports.show');
    Route::get('user_requests', [UserRequestController::class, 'index'])->name('user_requests');

});
Route::group(['middleware' => ['auth:user','checkUserRole:external_auditor_temp_role'],'prefix'=>'external_auditor_temp_role','as'=>'external_auditor_temp_role.'],function(){
    Route::get('events', [EventController::class, 'index'])->name('events.index');
    Route::get('events/{id}', [EventController::class, 'show'])->name('events.show');

});
Route::group(['middleware' => ['auth:user','checkUserRole:branch_chairman'],'prefix'=>'branch_chairman','as'=>'branch_chairman.'],function(){
    Route::get('submissions', [SubmissionController::class, 'index'])->name('submissions.index');
    Route::get('submissions/{id}', [SubmissionController::class, 'show'])->name('submissions.show');
    Route::put('submissions/{submission}', [SubmissionController::class, 'update'])->name('submissions.update');
    Route::get('events', [EventController::class, 'index'])->name('events.index');
    Route::get('events/{id}', [EventController::class, 'show'])->name('events.show');
    Route::get('branchreports', [BranchReportController::class, 'index'])->name('branchreports.index');
    Route::get('branchreports/{id}', [BranchReportController::class, 'show'])->name('branchreports.show');
    Route::post('deposits', [DepositController::class, 'store'])->name('deposits.store');
});
Route::group(['middleware' => ['auth:user','checkUserRole:branch_priest'],'prefix'=>'branch_priest','as'=>'branch_priest.'],function(){
    Route::get('submissions', [SubmissionController::class, 'index'])->name('submissions.index');
    Route::put('submissions/{submission}', [SubmissionController::class, 'update'])->name('submissions.update');
    Route::get('events', [EventController::class, 'index'])->name('events.index');
    Route::get('events/{id}', [EventController::class, 'show'])->name('events.show');
    Route::get('branchreports', [BranchReportController::class, 'index'])->name('branchreports.index');
    Route::get('branchreports/{id}', [BranchReportController::class, 'show'])->name('branchreports.show');
    Route::post('deposits', [DepositController::class, 'store'])->name('deposits.store');
});

Route::group(['middleware' => ['auth:user','checkUserRole:branch_secretary'],'prefix'=>'branch_secretary','as'=>'branch_secretary.'],function(){
    Route::get('events', [EventController::class, 'index'])->name('events.index');
    Route::get('events/{id}', [EventController::class, 'show'])->name('events.show');
    Route::post('events', [EventController::class, 'store'])->name('events.store');
    Route::get('withdrawals', [WithdrawalController::class, 'index'])->name('withdrawals.index');
    Route::get('withdrawals/{id}', [WithdrawalController::class, 'show'])->name('withdrawals.show');
    Route::post('withdrawals', [WithdrawalController::class, 'store'])->name('withdrawals.store');
    Route::get('branchreports', [BranchReportController::class, 'index'])->name('branchreports.index');
    Route::get('branchreports/{id}', [BranchReportController::class, 'show'])->name('branchreports.show');
    Route::get('download_report/{id}', [BranchReportController::class, 'downloadPdf'])->name('branchreports.download_report');
    Route::get('send_pdf_report/{id}', [BranchReportController::class, 'sendPdfByEmail'])->name('branchreports.send_pdf_report');
    // Route::get('download_report/{id}', [BranchReportController::class, 'downloadPdf'])->name('branchreports.download_report');
    Route::post('branchreports', [BranchReportController::class, 'store'])->name('branchreports.store');
    Route::post('deposits', [DepositController::class, 'store'])->name('deposits.store');

    Route::get('members', [MemberController::class, 'index'])->name('members.index');
    Route::post('members', [MemberController::class, 'store'])->name('members.store');

    Route::put('submissionqas', [SubmissionQAController::class, 'update'])->name('qsubmissionqasas.update');
});