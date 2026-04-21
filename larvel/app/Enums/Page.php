<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;
use GuzzleHttp\Psr7\Header;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Page extends Enum
{
    const CommonPage = 'common_page';
    const HomePage = 'home_page';
    const AboutPage = 'about_page';
    const BuyPage = 'buy_page';
    const SellPage = 'sell_page';

    const MasterClassPage = 'master_class_page';
    const InsightPage = 'insight_page';
}
