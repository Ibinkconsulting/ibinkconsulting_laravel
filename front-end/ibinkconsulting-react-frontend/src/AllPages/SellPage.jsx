import SaleBlankImageBottom from "@/components/SalePageComponents/SaleBlankImageBottom";
import SaleBlankImageThreeSection from "@/components/SalePageComponents/SaleBlankImageThreeSection";
import SalePageEmptyImage from "@/components/SalePageComponents/SalePageEmptyImage";
import SalePageHeroSection from "@/components/SalePageComponents/SalePageHeroSection";
import SalePropertySection from "@/components/SalePageComponents/SalePropertySection";
import SellerClaritySection from "@/components/SalePageComponents/SellerClaritySection";
import SellingProcessSection from "@/components/SalePageComponents/SellingProcessSection";
import WhyChooseSaleSection from "@/components/SalePageComponents/WhyChooseSaleSection";
import WhySellingPropertySection from "@/components/SalePageComponents/WhySellingPropertySection";
import React from "react";

export default function SellPage() {
  return (
    <div className="">
      <SalePageHeroSection />
      <SalePropertySection />
      <SalePageEmptyImage />
      <WhySellingPropertySection />
      <SaleBlankImageBottom />
      <WhyChooseSaleSection />
      <SaleBlankImageThreeSection />
      <SellingProcessSection />
      <SellerClaritySection />
    </div>
  );
}
