<?php

use App\Http\Controllers\Web\backend\admin\FAQController;
use App\Http\Controllers\Web\backend\ArticleController;
use App\Http\Controllers\Web\backend\CategoryController;
use App\Http\Controllers\Web\backend\CMS\AboutPage\AboutPageController;
use App\Http\Controllers\Web\backend\CMS\BuyPage\BuyPageController;
use App\Http\Controllers\Web\backend\CMS\CommonPageController;
use App\Http\Controllers\Web\backend\CMS\ContactPage\ContactPageController;
use App\Http\Controllers\Web\backend\CMS\HomePage\HomePageController;
use App\Http\Controllers\Web\backend\CMS\InsightPage\InsightPageController;
use App\Http\Controllers\Web\backend\CMS\MasterClassPage\MasterClassPageController;
use App\Http\Controllers\Web\backend\CMS\SellPage\SellPageController;
use App\Http\Controllers\Web\backend\DashboardController;
use App\Http\Controllers\Web\backend\PremissionController;
use App\Http\Controllers\Web\backend\PropertyController;
use App\Http\Controllers\Web\backend\RoleController;
use App\Http\Controllers\Web\backend\SettingController;
use App\Http\Controllers\Web\backend\settings\DynamicPagesController;
use App\Http\Controllers\Web\backend\settings\ProfileSettingController;
use App\Http\Controllers\Web\backend\UserController;
use Illuminate\Support\Facades\Route;





// Dashboard Routes
Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard');
});

Route::controller(SettingController::class)->group(function () {
    Route::get('/general/setting', 'create')->name('general.setting');
    Route::post('/system/update', 'update')->name('system.update');
    Route::get('/setting', 'adminSetting')->name('admin.setting');
    Route::post('/setting/update', 'adminSettingUpdate')->name('admin.settingupdate');

    Route::get('/social-media', 'socialMedia')->name('social_media');
    Route::post('/social-media/update', 'socialMediaUpdate')->name('admin.socialmediaupdate');
});

// profile Settings Controller
Route::controller(ProfileSettingController::class)->group(function () {
    Route::get('/profile', 'index')->name('profile');
    Route::post('/profile/update', 'updateProfile')->name('profile.update');
    Route::post('/profile/update/password', 'updatePassword')->name('profile.update.password');
    Route::post('/profile/update/profile-picture', 'updateProfilePicture')->name('profile.update.profile.picture');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/users/list', 'index')->name('user.list');
    Route::get('/view/users/{id}', 'show')->name('show.user');
    Route::get('/status/users/{id}', 'status')->name('user.status');
});

Route::prefix('permissions')->controller(PremissionController::class)->group(function () {
    Route::get('/list', 'index')->name('admin.permissions.list');
    Route::get('/view/users/{id}', 'show')->name('show.user');
});

Route::prefix('role')->controller(RoleController::class)->group(function () {
    Route::get('/list', 'index')->name('admin.role.list');
    Route::get('/create', 'create')->name('admin.role.create');
    Route::post('/store', 'store')->name('admin.role.store');
    Route::get('/edit/{id}', 'edit')->name('admin.role.edit');
    Route::post('/update/{id}', 'update')->name('admin.role.update');
    Route::delete('/destroy/{id}', 'destroy')->name('admin.role.destroy');

});
// Dynamic Pages Route
Route::resource('dynamicpages', DynamicPagesController::class);
Route::post('dynamicpages/status/{id}', [DynamicPagesController::class, 'changeStatus'])->name('dynamicpages.status');
Route::post('dynamicpages/bulk-delete', [DynamicPagesController::class, 'bulkDelete'])->name('dynamicpages.bulk-delete');

// FAQ Route
Route::resource('faq', FAQController::class);
Route::post('faq/status/{id}', [FAQController::class, 'changeStatus'])->name('faq.status');

// Testemonial Route
Route::prefix('property')->controller(PropertyController::class)->as('admin.property.')->group(function () {
    Route::get('/index', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{property}', 'edit')->name('edit');
    Route::post('/update/{property}', 'update')->name('update');
    Route::delete('/destroy/{property}', 'destroy')->name('destroy');
    Route::get('/status/{property}', 'status')->name('status');
    Route::post('bulk-delete', 'bulkDelete')->name('bulk-delete');

    Route::post('/property/remove-image', 'removeImage')->name('removeImage');

    // transportation Routes
    Route::delete('neighborhood/{id}', 'neighborhoodDestroy')->name('neighborhood.destroy');
    Route::delete('transportation/{id}', 'transportationDestroy')->name('transportation.destroy');

    // Delete image
    Route::delete('/delete/image/{id}', 'deleteImage')->name('delete.image');

    // Change availlability
    Route::post('/availlability/{id}', 'changeAvaillability')->name('change.availlability');

});

// Category Route
Route::prefix('category')->controller(CategoryController::class)->as('admin.category.')->group(function () {
    Route::get('/list', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{category}', 'edit')->name('edit');
    Route::post('/update', 'update')->name('update');
    Route::delete('/destroy/{category}', 'destroy')->name('destroy');
    Route::get('/status/{id}', 'status')->name('status');
    Route::post('bulk-delete', 'bulkDelete')->name('bulk-delete');
});


// Article Route
Route::prefix('article')->controller(ArticleController::class)->as('admin.article.')->group(function () {
    Route::get('/list', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{article}', 'edit')->name('edit');
    Route::post('/update/{article}', 'update')->name('update');
    Route::delete('/destroy/{article}', 'destroy')->name('destroy');
    Route::get('/status/{id}', 'status')->name('status');
    Route::post('bulk-delete', 'bulkDelete')->name('bulk-delete');
});


// ===================== CMS Start ========================
Route::prefix('cms')->as('cms.')->group(function () {
    // Common Page
    Route::controller(CommonPageController::class)->group(function () {
        // About Owner Section
        Route::get('/about_owner_section', 'aboutOwnerSection')->name('common_page.about_owner_section');
        Route::patch('/about_owner_section', 'aboutOwnerSectionUpdate')->name('common_page.about_owner_section.update');

        // About Pertnership Section
        Route::get('/about_pertnership_section', 'aboutPertnershipSection')->name('common_page.about_pertnership_section');
        Route::patch('/about_pertnership_section', 'aboutPertnershipSectionUpdate')->name('common_page.about_pertnership_section.update');

        // Advisor Section
        Route::get('/advisor_section', 'advisorSection')->name('common_page.advisor_section');
        Route::patch('/advisor_section', 'advisorSectionUpdate')->name('common_page.advisor_section.update');
    });

    // Home Page
    Route::controller(HomePageController::class)->group(function () {
        // Top Section
        Route::get('/home_page/top_section', 'topSection')->name('home_page.top_section');
        Route::patch('/home_page/top_section', 'topSectionUpdate')->name('home_page.top_section.update');

        // Middle File Section
        Route::get('/home_page/middle_file_section', 'middleFileSection')->name('home_page.middle_file_section');
        Route::patch('/home_page/middle_file_section', 'middleFileSectionUpdate')->name('home_page.middle_file_section.update');

        // Coming Soon Section
        Route::get('/home_page/coming_soon_section', 'comingSoonSection')->name('home_page.coming_soon_section');
        Route::patch('/home_page/coming_soon_section', 'comingSoonSectionUpdate')->name('home_page.coming_soon_section.update');
    });

    // Buy Page
    Route::controller(BuyPageController::class)->group(function () {
        // Top Section
        Route::get('/buy_page/top_section', 'topSection')->name('buy_page.top_section');
        Route::patch('/buy_page/top_section', 'topSectionUpdate')->name('buy_page.top_section.update');

        // Buying Property Section
        Route::get('/buy_page/buying_property_section', 'buyingPropertySection')->name('buy_page.buying_property_section');
        Route::patch('/buy_page/buying_property_section', 'buyingPropertySectionUpdate')->name('buy_page.buying_property_section.update');

        // Challenging Section
        Route::get('/buy_page/challenging_section', 'challengingSection')->name('buy_page.challenging_section');
        Route::patch('/buy_page/challenging_section', 'challengingSectionUpdate')->name('buy_page.challenging_section.update');

        // Work With Us Section
        Route::get('/buy_page/work_with_us_section', 'workWithUsSection')->name('buy_page.work_with_us_section');
        Route::patch('/buy_page/work_with_us_section', 'workWithUsSectionUpdate')->name('buy_page.work_with_us_section.update');

        // Buying Process Section
        Route::get('/buy_page/buying_process_section', 'buyingProcessSection')->name('buy_page.buying_process_section');
        Route::patch('/buy_page/buying_process_section', 'buyingProcessSectionUpdate')->name('buy_page.buying_process_section.update');

        // Cost Consider Buying Property Section
        Route::get('/buy_page/cost_consider_buying_property_section', 'costConsiderBuyingPropertySection')->name('buy_page.cost_consider_buying_property_section');
        Route::patch('/buy_page/cost_consider_buying_property_section', 'costConsiderBuyingPropertySectionUpdate')->name('buy_page.cost_consider_buying_property_section.update');

        // Get clarity Section
        Route::get('/buy_page/get_clarity_section', 'getClaritySection')->name('buy_page.get_clarity_section');
        Route::patch('/buy_page/get_clarity_section', 'getClaritySectionUpdate')->name('buy_page.get_clarity_section.update');
    });

    // Sell Page
    Route::controller(SellPageController::class)->group(function () {
        // Top Section
        Route::get('/sell_page/top_section', 'topSection')->name('sell_page.top_section');
        Route::patch('/sell_page/top_section', 'topSectionUpdate')->name('sell_page.top_section.update');

        // Selling Property Section
        Route::get('/sell_page/selling_property_section', 'sellingPropertySection')->name('sell_page.selling_property_section');
        Route::patch('/sell_page/selling_property_section', 'sellingPropertySectionUpdate')->name('sell_page.selling_property_section.update');

        // Challenging Section
        Route::get('/sell_page/challenging_section', 'challengingSection')->name('sell_page.challenging_section');
        Route::patch('/sell_page/challenging_section', 'challengingSectionUpdate')->name('sell_page.challenging_section.update');

        // Property Choose Section
        Route::get('/sell_page/property_choose_section', 'propertyChooseSection')->name('sell_page.property_choose_section');
        Route::patch('/sell_page/property_choose_section', 'propertyChooseSectionUpdate')->name('sell_page.property_choose_section.update');

        // Work With Us Section
        Route::get('/sell_page/work_with_us_section', 'workWithUsSection')->name('sell_page.work_with_us_section');
        Route::patch('/sell_page/work_with_us_section', 'workWithUsSectionUpdate')->name('sell_page.work_with_us_section.update');

        // Selling Process Section
        Route::get('/sell_page/selling_process_section', 'sellingProcessSection')->name('sell_page.selling_process_section');
        Route::patch('/sell_page/selling_process_section', 'sellingProcessSectionUpdate')->name('sell_page.selling_process_section.update');

        // Cost Consider Selling Property Section
        Route::get('/sell_page/cost_consider_selling_property_section', 'costConsiderSellingPropertySection')->name('sell_page.cost_consider_selling_property_section');
        Route::patch('/sell_page/cost_consider_selling_property_section', 'costConsiderSellingPropertySectionUpdate')->name('sell_page.cost_consider_selling_property_section.update');

        // Get clarity Section
        Route::get('/sell_page/get_clarity_section', 'getClaritySection')->name('sell_page.get_clarity_section');
        Route::patch('/sell_page/get_clarity_section', 'getClaritySectionUpdate')->name('sell_page.get_clarity_section.update');
    });

    // MasterClass Page
    Route::controller(MasterClassPageController::class)->group(function () {
        // Masterclass Section
        Route::get('/masterclass_page/masterclass_section', 'masterclassSection')->name('masterclass_page.masterclass_section');
        Route::patch('/masterclass_page/masterclass_section', 'masterclassSectionUpdate')->name('masterclass_page.masterclass_section.update');
    });

    // Insight Page
    Route::controller(InsightPageController::class)->group(function () {
        // Top Section
        Route::get('/insight_page/top_section', 'topSection')->name('insight_page.top_section');
        Route::patch('/insight_page/top_section', 'topSectionUpdate')->name('insight_page.top_section.update');
    });

    // About Page
    Route::controller(AboutPageController::class)->group(function () {
        // Top Section
        Route::get('/about_page/top_section', 'topSection')->name('about_page.top_section');
        Route::patch('/about_page/top_section', 'topSectionUpdate')->name('about_page.top_section.update');

        // About Us Section
        Route::get('/about_page/about_us_section', 'aboutUsSection')->name('about_page.about_us_section');
        Route::patch('/about_page/about_us_section', 'aboutUsSectionUpdate')->name('about_page.about_us_section.update');

        // Our Values Section
        Route::get('/about_page/our_values_section', 'ourValuesSection')->name('about_page.our_values_section');
        Route::patch('/about_page/our_values_section', 'ourValuesSectionUpdate')->name('about_page.our_values_section.update');

        // End File Section
        Route::get('/about_page/end_file_section', 'endFileSection')->name('about_page.end_file_section');
        Route::patch('/about_page/end_file_section', 'endFileSectionUpdate')->name('about_page.end_file_section.update');
    });


});
// ================= CMS End ============================