import CommonHero from "@/Common/CommonHero";
import BuyAllPropertiesSection from "@/components/BuyPageComponents/BuyAllPropertiesSection";
import BuyPageHeroSection from "@/components/BuyPageComponents/BuyPageHeroSection";
import NewBuyerClaritySection from "@/components/NewBuyPageComponents/NewBuyerClaritySection";
import NewBuyingProcessSection from "@/components/NewBuyPageComponents/NewBuyingProcessSection";
import NewBuyingPropertySection from "@/components/NewBuyPageComponents/NewBuyingPropertySection";
import NewBuyPageEmptyImageOne from "@/components/NewBuyPageComponents/NewBuyPageEmptyImageOne";
import NewBuyPageEmptyImageThree from "@/components/NewBuyPageComponents/NewBuyPageEmptyImageThree";
import NewBuyPageEmptyImageTwo from "@/components/NewBuyPageComponents/NewBuyPageEmptyImageTwo";
import NewBuyPageHeroSection from "@/components/NewBuyPageComponents/NewBuyPageHeroSection";
import NewWhyBuyingPropertySection from "@/components/NewBuyPageComponents/NewWhyBuyingPropertySection";
import NewWhyChooseBuySection from "@/components/NewBuyPageComponents/NewWhyChooseBuySection";
import React from "react";

export default function BuyPage() {
  return (
    <div>
      {/* <div className="hidden">
        <BuyPageHeroSection />
        <BuyAllPropertiesSection />
      </div> */}

      <div>
        <NewBuyPageHeroSection />
        <NewBuyingPropertySection />
        <NewBuyPageEmptyImageOne />
        <NewWhyBuyingPropertySection />
        <NewBuyPageEmptyImageTwo />
        <NewWhyChooseBuySection />
        <NewBuyPageEmptyImageThree />
        <NewBuyingProcessSection />
        <NewBuyerClaritySection />
      </div>
    </div>
  );
}
