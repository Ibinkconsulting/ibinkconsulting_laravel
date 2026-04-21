import AboutAboutSection from "@/components/AboutPageComponents/AboutAboutSection";
import AboutBlankImageSection from "@/components/AboutPageComponents/AboutBlankImageSection";
import AboutOurValuesSection from "@/components/AboutPageComponents/AboutOurValuesSection";
import AboutPageHeroSection from "@/components/AboutPageComponents/AboutPageHeroSection";
import AboutTheFounderSection from "@/components/AboutPageComponents/AboutTheFounderSection";
import BaerzPropertySection from "@/components/HomePageComponents/BaerzPropertySection";
import React from "react";

export default function AboutPage() {
  return (
    <div>
      <AboutPageHeroSection />
      <AboutAboutSection />
      <AboutOurValuesSection />
      <AboutTheFounderSection />
      <BaerzPropertySection />
      <AboutBlankImageSection />
    </div>
  );
}
