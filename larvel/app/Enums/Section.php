<?php declare(strict_types=1);

namespace App\Enums;

use App\Models\Brand;
use App\Models\Video;
use BenSampo\Enum\Enum;
use GuzzleHttp\Psr7\Header;

use Livewire\Attributes\Title;
use function Livewire\of;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Section extends Enum
{
    // Home Page -
    const TopSection = 'top_section';
    const MiddleFileSection = 'middle_file_section';
    const AboutOwnerSection = 'about_owner_section';
    const AboutPertnershipSection = 'about_pertnership_section';
    const AdvisorSection = 'advisor_section';

    const MasterclassSection = 'masterclass_section';
    const ComingSoonSection = 'coming_soon_section';

    // Buy & Sell Page -
    const BuyingPropertySection = 'buying_property_section';
    const SellingPropertySection = 'selling_property_section';
    const ChallengingSection = 'challenging_section';
    const PropertyChooseSection = 'property_choose_section';
    const WorkWithUsSection = 'work_with_us_section';
    const BuyingProcessSection = 'buying_process_section';
    const SellingProcessSection = 'selling_process_section';
    const CostConsiderBuyingPropertySection = 'cost_consider_buying_property_section';
    const CostConsiderSellingPropertySection = 'cost_consider_selling_property_section';

    const GetClaritySection = 'get_clarity_section';

    // About Us
    const AboutUsSection = 'about_us_section';
    const OurValuesSection = 'our_values_section';
    const EndFileSection = 'end_file_section';


}