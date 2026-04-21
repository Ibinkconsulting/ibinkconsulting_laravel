import AboutUsSection from "@/components/HomePageComponents/AboutUsSection";
import BaerzPropertySection from "@/components/HomePageComponents/BaerzPropertySection";
import ComingSection from "@/components/HomePageComponents/ComingSection";
import HeroSection from "@/components/HomePageComponents/HeroSection";
import LandingPageVideoSection from "@/components/HomePageComponents/LandingPageVideoSection";
import MasterClassSection from "@/components/HomePageComponents/MasterClassSection";
import PropertiesForSaleSection from "@/components/HomePageComponents/PropertiesForSaleSection";
import React from "react";

export default function HomePage() {
  return (
    <div>
      <HeroSection />
      <PropertiesForSaleSection />
      <LandingPageVideoSection />
      <AboutUsSection />
      <BaerzPropertySection />
      <MasterClassSection />
      <ComingSection />
    </div>
  );
}
