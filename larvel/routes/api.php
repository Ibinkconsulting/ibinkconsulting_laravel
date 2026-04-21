<?php

use App\Http\Controllers\API\CmsController;
use App\Http\Controllers\API\FreeMasterClassController;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\NewsletterController;
use App\Http\Controllers\API\UserAuthController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;




Route::controller(UserAuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');

    // Resend Otp
    Route::post('resend-otp', 'resendOtp');

    // Forget Password
    Route::post('forget-password', 'forgetPassword');
    Route::post('verify-otp-password', 'varifyOtpWithOutAuth');
    Route::post('reset-password', 'resetPassword');

    // Google Login
    Route::post('google/login', 'googleLogin');
});

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::post('logout', [UserAuthController::class, 'logout']);
    Route::get('me', [UserAuthController::class, 'me']);
    Route::post('refresh', [UserAuthController::class, 'refresh']);

    Route::delete('/delete/user', [UserController::class, 'deleteUser']);

    Route::post('password/change', [UserController::class, 'changePassword']);
    Route::post('update/user', [UserController::class, 'updateUserInfo']);

    Route::get('/delete/user', [UserController::class, 'deleteUser']);

});

Route::controller(HomeController::class)->group(function () {
    // Get All Categories
    Route::get('categories', 'getCategories');

    // Get All Articles
    Route::get('articles', 'getArticles');

    // Features Property
    Route::get('/properties/forsell', 'featuredProperties');

    // Get Best Properties
    Route::get('/properties/per/{slug}', 'perProperty');

    // Footer
    Route::get('footer', 'footer');

});

// Contact Request
Route::post('free-masterclass/request', [FreeMasterClassController::class, 'freeMasterClassRequest']);

// Newsletter
Route::post('newsletter/subscribe', [NewsletterController::class, 'subscribe']);





// CMS Routes
Route::controller(CmsController::class)->group(function () {
    // Common Sections
    Route::get('get_about_owner_section', 'getAboutOwnerSection');
    Route::get('get_about_pertnership_section', 'getAboutPertnershipSection');
    Route::get('get_advisor_section', 'getAdvisorSection');


    // Home Page Sections
    Route::get('home/get_top_section', 'getHomePageTopSection');
    Route::get('home/get_middle_file_section', 'getHomePageMiddleFileSection');
    Route::get('home/get_coming_soon_section', 'getHomePageComingSoonSection');

    // Buy Page Sections
    Route::get('buy/get_top_section', 'getBuyPageTopSection');
    Route::get('buy/get_buying_property_section', 'getBuyPageBuyingPropertySection');
    Route::get('buy/get_challenging_section', 'getBuyPageChallengingSection');
    Route::get('buy/get_work_with_us_section', 'getBuyPageWorkWithUsSection');
    Route::get('buy/get_buying_process_section', 'getBuyPageBuyingProcessSection');
    Route::get('buy/get_cost_consider_buying_property_section', 'getBuyPageCostConsiderBuyingPropertySection');
    Route::get('buy/get_clarity_section', 'getBuyPageClaritySection');

    // Sell Page Sections
    Route::get('sell/get_top_section', 'getSellPageTopSection');
    Route::get('sell/get_selling_property_section', 'getSellPageSellingPropertySection');
    Route::get('sell/get_challenging_section', 'getSellPageChallengingSection');
    Route::get('sell/get_property_choose_section', 'getSellPagePropertyChooseSection');
    Route::get('sell/get_selling_process_section', 'getSellPageSellingProcessSection');
    Route::get('sell/get_cost_consider_selling_property_section', 'getSellPageCostConsiderSellingPropertySection');
    Route::get('sell/get_clarity_section', 'getSellPageClaritySection');

    // MasterClass Page Sections
    Route::get('masterclass/get_masterclass_section', 'getMasterclassPageMasterclassSection');

    // Insights Page Sections
    Route::get('insight/get_top_section', 'getInsightPageTopSection');

    // About Page Sections
    Route::get('about/get_top_section', 'getAboutPageTopSection');
    Route::get('about/get_about_us_section', 'getAboutPageAboutUsSection');
    Route::get('about/get_our_values_section', 'getAboutPageOurValuesSection');
    Route::get('about/get_end_file_section', 'getAboutPageEndFileSection');




});
