<?php

namespace App\Http\Controllers\API;

use App\Enums\Page;
use App\Enums\Section;
use App\Helper\Helper;
use App\Http\Controllers\Controller;

use App\Http\Resources\CMS\About\AboutPageAboutUsSectionResource;
use App\Http\Resources\CMS\About\AboutPageEndFileSectionResource;
use App\Http\Resources\CMS\About\AboutPageOurValuesSectionResource;
use App\Http\Resources\CMS\About\AboutPageTopSectionResource;
use App\Http\Resources\CMS\Buy\BuyPageBuyingProcessSectionResource;
use App\Http\Resources\CMS\Buy\BuyPageBuyingPropertySectionResource;
use App\Http\Resources\CMS\Buy\BuyPageChallengingSectionResource;
use App\Http\Resources\CMS\Buy\BuyPageCostConsiderBuyingPropertySectionResource;
use App\Http\Resources\CMS\Buy\BuyPageGetClaritySectionResource;
use App\Http\Resources\CMS\Buy\BuyPageTopSectionResource;
use App\Http\Resources\CMS\Buy\BuyPageWorkWithUsSectionResource;
use App\Http\Resources\CMS\Common\AboutOwnerSectionResource;
use App\Http\Resources\CMS\Common\AboutPertnershipSectionResource;
use App\Http\Resources\CMS\Common\AdvisorSectionResource;
use App\Http\Resources\CMS\Home\HomePageAboutOwnerSectionResource;
use App\Http\Resources\CMS\Home\HomePageAboutPertnershipSectionResource;
use App\Http\Resources\CMS\Home\HomePageAdvisorSectionResource;
use App\Http\Resources\CMS\Home\HomePageComingSoonSectionResource;
use App\Http\Resources\CMS\Home\HomePageMiddleFileSectionResource;
use App\Http\Resources\CMS\Home\HomePageTopSectionResource;
use App\Http\Resources\CMS\Insight\InsightPageTopSectionResource;
use App\Http\Resources\CMS\MasterClass\MasterclassSectionResource;
use App\Http\Resources\CMS\Sell\SellPageBuyingProcessSectionResource;
use App\Http\Resources\CMS\Sell\SellPageBuyingPropertySectionResource;
use App\Http\Resources\CMS\Sell\SellPageChallengingSectionResource;
use App\Http\Resources\CMS\Sell\SellPageCostConsiderBuyingPropertySectionResource;
use App\Http\Resources\CMS\Sell\SellPageCostConsiderSellingPropertySectionResource;
use App\Http\Resources\CMS\Sell\SellPageGetClaritySectionResource;
use App\Http\Resources\CMS\Sell\SellPagePropertyChooseSectionResource;
use App\Http\Resources\CMS\Sell\SellPageSellingProcessSectionResource;
use App\Http\Resources\CMS\Sell\SellPageSellingPropertySectionResource;
use App\Http\Resources\CMS\Sell\SellPageTopSectionResource;
use App\Http\Resources\CMS\Sell\SellPageWorkWithUsSectionResource;
use App\Models\CMS;
use App\Traits\apiresponse;
use Exception;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    use apiresponse;


    // Common Page - About Owner Section =====================================================
    public function getAboutOwnerSection()
    {
        try {
            $data = CMS::where('page', Page::CommonPage)
                ->where('section', Section::AboutOwnerSection)
                ->first();

            if (!$data) {
                return $this->error([], 'No About Owner Section data found.', 200);
            }

            return $this->success(new AboutOwnerSectionResource($data), 'About Owner Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the About Owner Section data: ' . $e->getMessage(), 500);
        }
    }

    // Common Page - About Pertnership Section =====================================================
    public function getAboutPertnershipSection()
    {
        try {
            $data = CMS::where('page', Page::CommonPage)
                ->where('section', Section::AboutPertnershipSection)
                ->first();

            if (!$data) {
                return $this->error([], 'No About Pertnership Section data found.', 200);
            }

            return $this->success(new AboutPertnershipSectionResource($data), 'About Pertnership Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the About Pertnership Section data: ' . $e->getMessage(), 500);
        }
    }

    // Common Page - Advisor Section =====================================================
    public function getAdvisorSection()
    {
        try {
            $data = CMS::where('page', Page::CommonPage)
                ->where('section', Section::AdvisorSection)
                ->first();

            if (!$data) {
                return $this->error([], 'No Advisor Section data found.', 200);
            }

            return $this->success(new AdvisorSectionResource($data), 'Advisor Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the Advisor Section data: ' . $e->getMessage(), 500);
        }
    }


    // Home Page - Top Section =====================================================
    public function getHomePageTopSection()
    {
        try {
            $data = CMS::where('page', Page::HomePage)
                ->where('section', Section::TopSection)
                ->first();

            if (!$data) {
                return $this->error([], 'No Top Section data found.', 200);
            }

            return $this->success(new HomePageTopSectionResource($data), 'Home Page - Top Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the Home Page Top Section data: ' . $e->getMessage(), 500);
        }
    }


    // Home Page - Middle File Section =====================================================
    public function getHomePageMiddleFileSection()
    {
        try {
            $data = CMS::where('page', Page::HomePage)
                ->where('section', Section::MiddleFileSection)
                ->first();

            if (!$data) {
                return $this->error([], 'No Middle File Section data found.', 200);
            }

            return $this->success(new HomePageMiddleFileSectionResource($data), 'Home Page - Middle File Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the Middle File Section data: ' . $e->getMessage(), 500);
        }
    }


    // Home Page - Coming Soon Section =====================================================
    public function getHomePageComingSoonSection()
    {
        try {
            $data = CMS::where('page', Page::HomePage)
                ->where('section', Section::ComingSoonSection)
                ->first();

            if (!$data) {
                return $this->error([], 'No Coming Soon Section data found.', 200);
            }

            return $this->success(new HomePageComingSoonSectionResource($data), 'Home Page - Coming Soon Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the Coming Soon Section data: ' . $e->getMessage(), 500);
        }
    }




    // Buy Page - Top Section =====================================================
    public function getBuyPageTopSection()
    {
        try {
            $data = CMS::where('page', Page::BuyPage)
                ->where('section', Section::TopSection)
                ->first();

            if (!$data) {
                return $this->error([], 'No Top Section data found.', 200);
            }

            return $this->success(new BuyPageTopSectionResource($data), 'Buy Page - Top Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the Buy Page Top Section data: ' . $e->getMessage(), 500);
        }
    }


    // Buy Page - Buying Property Section =====================================================
    public function getBuyPageBuyingPropertySection()
    {
        try {
            $data = CMS::where('page', Page::BuyPage)
                ->where('section', Section::BuyingPropertySection)
                ->first();

            if (!$data) {
                return $this->error([], 'No Buying Property Section data found.', 200);
            }

            return $this->success(new BuyPageBuyingPropertySectionResource($data), 'Buy Page - Buying Property Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the Buying Property Section data: ' . $e->getMessage(), 500);
        }
    }

    // Buy Page - Challenging Section =====================================================
    public function getBuyPageChallengingSection()
    {
        try {
            $data = CMS::where('page', Page::BuyPage)
                ->where('section', Section::ChallengingSection)
                ->first();

            if (!$data) {
                return $this->error([], 'No Challenging Section data found.', 200);
            }

            return $this->success(new BuyPageChallengingSectionResource($data), 'Buy Page - Challenging Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the Challenging Section data: ' . $e->getMessage(), 500);
        }
    }


    // Buy Page - Work With Us Section =====================================================
    public function getBuyPageWorkWithUsSection()
    {
        try {
            $data = CMS::where('page', Page::BuyPage)
                ->where('section', Section::WorkWithUsSection)
                ->first();

            if (!$data) {
                return $this->error([], 'No Work With Us Section data found.', 200);
            }

            return $this->success(new BuyPageWorkWithUsSectionResource($data), 'Buy Page - Work With Us Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the Work With Us Section data: ' . $e->getMessage(), 500);
        }
    }


    // Buy Page - Buying Process Section =====================================================
    public function getBuyPageBuyingProcessSection()
    {
        try {
            $data = CMS::where('page', Page::BuyPage)
                ->where('section', Section::BuyingProcessSection)
                ->first();

            if (!$data) {
                return $this->error([], 'No Buying Process Section data found.', 200);
            }

            return $this->success(new BuyPageBuyingProcessSectionResource($data), 'Buy Page - Buying Process Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the Buying Process Section data: ' . $e->getMessage(), 500);
        }
    }

    // Buy Page - Cost Consider Buying Property Section =====================================================
    public function getBuyPageCostConsiderBuyingPropertySection()
    {
        try {
            $data = CMS::where('page', Page::BuyPage)
                ->where('section', Section::CostConsiderBuyingPropertySection)
                ->first();

            if (!$data) {
                return $this->error([], 'No Cost Consider Buying Property Section data found.', 200);
            }

            return $this->success(new BuyPageCostConsiderBuyingPropertySectionResource($data), 'Buy Page - Cost Consider Buying Property Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the Cost Consider Buying Property Section data: ' . $e->getMessage(), 500);
        }
    }

    // Buy Page - Get Clarity Section =====================================================
    public function getBuyPageClaritySection()
    {
        try {
            $data = CMS::where('page', Page::BuyPage)
                ->where('section', Section::GetClaritySection)
                ->first();

            if (!$data) {
                return $this->error([], 'No Get Clarity Section data found.', 200);
            }

            return $this->success(new BuyPageGetClaritySectionResource($data), 'Buy Page - Get Clarity Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the Get Clarity Section data: ' . $e->getMessage(), 500);
        }
    }



    // =================================================================================================================================================

    // Sell Page - Top Section =====================================================
    public function getSellPageTopSection()
    {
        try {
            $data = CMS::where('page', Page::SellPage)
                ->where('section', Section::TopSection)
                ->first();

            if (!$data) {
                return $this->error([], 'No Top Section data found.', 200);
            }

            return $this->success(new SellPageTopSectionResource($data), 'Sell Page - Top Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the Sell Page Top Section data: ' . $e->getMessage(), 500);
        }
    }


    // Sell Page - Selling Property Section =====================================================
    public function getSellPageSellingPropertySection()
    {
        try {
            $data = CMS::where('page', Page::SellPage)
                ->where('section', Section::SellingPropertySection)
                ->first();

            if (!$data) {
                return $this->error([], 'No Selling Property Section data found.', 200);
            }

            return $this->success(new SellPageSellingPropertySectionResource($data), 'Sell Page - Selling Property Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the Selling Property Section data: ' . $e->getMessage(), 500);
        }
    }

    // Sell Page - Challenging Section =====================================================
    public function getSellPageChallengingSection()
    {
        try {
            $data = CMS::where('page', Page::SellPage)
                ->where('section', Section::ChallengingSection)
                ->first();

            if (!$data) {
                return $this->error([], 'No Challenging Section data found.', 200);
            }

            return $this->success(new SellPageChallengingSectionResource($data), 'Sell Page - Challenging Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the Challenging Section data: ' . $e->getMessage(), 500);
        }
    }


    // Sell Page - Property Choose Section =====================================================
    public function getSellPagePropertyChooseSection()
    {
        try {
            $data = CMS::where('page', Page::SellPage)
                ->where('section', Section::PropertyChooseSection)
                ->first();

            if (!$data) {
                return $this->error([], 'No Property Choose Section data found.', 200);
            }

            return $this->success(new SellPagePropertyChooseSectionResource($data), 'Sell Page - Property Choose Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the Property Choose Section data: ' . $e->getMessage(), 500);
        }
    }


    // Sell Page - getSellPageSellingProcessSection Process Section =====================================================
    public function getSellPageSellingProcessSection()
    {
        try {
            $data = CMS::where('page', Page::SellPage)
                ->where('section', Section::SellingProcessSection)
                ->first();

            if (!$data) {
                return $this->error([], 'No Selling Process Section data found.', 200);
            }

            return $this->success(new SellPageSellingProcessSectionResource($data), 'Sell Page - Selling Process Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the Selling Process Section data: ' . $e->getMessage(), 500);
        }
    }

    // Sell Page - Cost Consider Selling Property Section =====================================================
    public function getSellPageCostConsiderSellingPropertySection()
    {
        try {
            $data = CMS::where('page', Page::SellPage)
                ->where('section', Section::CostConsiderSellingPropertySection)
                ->first();

            if (!$data) {
                return $this->error([], 'No Cost Consider Selling Property Section data found.', 200);
            }

            return $this->success(new SellPageCostConsiderSellingPropertySectionResource($data), 'Sell Page - Cost Consider Selling Property Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the Cost Consider Selling Property Section data: ' . $e->getMessage(), 500);
        }
    }

    // Sell Page - Get Clarity Section =====================================================
    public function getSellPageClaritySection()
    {
        try {
            $data = CMS::where('page', Page::SellPage)
                ->where('section', Section::GetClaritySection)
                ->first();

            if (!$data) {
                return $this->error([], 'No Get Clarity Section data found.', 200);
            }

            return $this->success(new SellPageGetClaritySectionResource($data), 'Sell Page - Get Clarity Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the Get Clarity Section data: ' . $e->getMessage(), 500);
        }
    }


    // MasterClass Page - Masterclass Section =====================================================
    public function getMasterclassPageMasterclassSection()
    {
        try {
            $data = CMS::where('page', Page::MasterClassPage)
                ->where('section', Section::MasterclassSection)
                ->first();

            if (!$data) {
                return $this->error([], 'No Masterclass Section data found.', 200);
            }

            return $this->success(new MasterclassSectionResource($data), 'MasterClass Page - Masterclass Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the Masterclass Section data: ' . $e->getMessage(), 500);
        }
    }

    // Insight Page - Top Section =====================================================
    public function getInsightPageTopSection()
    {
        try {
            $data = CMS::where('page', Page::InsightPage)
                ->where('section', Section::TopSection)
                ->first();

            if (!$data) {
                return $this->error([], 'No Top Section data found.', 200);
            }

            return $this->success(new InsightPageTopSectionResource($data), 'Insight Page - Top Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the Insight Page Top Section data: ' . $e->getMessage(), 500);
        }
    }

    // About Page - Top Section =====================================================
    public function getAboutPageTopSection()
    {
        try {
            $data = CMS::where('page', Page::AboutPage)
                ->where('section', Section::TopSection)
                ->first();

            if (!$data) {
                return $this->error([], 'No Top Section data found.', 200);
            }

            return $this->success(new AboutPageTopSectionResource($data), 'About Page - Top Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the About Page Top Section data: ' . $e->getMessage(), 500);
        }
    }

    // About Page - About Us Section =====================================================
    public function getAboutPageAboutUsSection()
    {
        try {
            $data = CMS::where('page', Page::AboutPage)
                ->where('section', Section::AboutUsSection)
                ->first();

            if (!$data) {
                return $this->error([], 'No About Us Section data found.', 200);
            }

            return $this->success(new AboutPageAboutUsSectionResource($data), 'About Page - About Us Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the About Page About Us Section data: ' . $e->getMessage(), 500);
        }
    }

    // About Page - Our Values Section =====================================================
    public function getAboutPageOurValuesSection()
    {
        try {
            $data = CMS::where('page', Page::AboutPage)
                ->where('section', Section::OurValuesSection)
                ->first();

            if (!$data) {
                return $this->error([], 'No Our Values Section data found.', 200);
            }

            return $this->success(new AboutPageOurValuesSectionResource($data), 'About Page - Our Values Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the About Page Our Values Section data: ' . $e->getMessage(), 500);
        }
    }

    // About Page - End File Section =====================================================
    public function getAboutPageEndFileSection()
    {
        try {
            $data = CMS::where('page', Page::AboutPage)
                ->where('section', Section::EndFileSection)
                ->first();

            if (!$data) {
                return $this->error([], 'No End File Section data found.', 200);
            }

            return $this->success(new AboutPageEndFileSectionResource($data), 'About Page - End File Section Data Retrieved Successfully!', 200);

        } catch (Exception $e) {
            return $this->error([], 'An error occurred while retrieving the About Page End File Section data: ' . $e->getMessage(), 500);
        }
    }


}
