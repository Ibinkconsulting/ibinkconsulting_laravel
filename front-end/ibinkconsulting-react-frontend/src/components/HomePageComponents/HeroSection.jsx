import CommonHero from "@/Common/CommonHero";
import React from "react";
import heroVideo from "@/assets/Video/heroVideo.mp4";
import { useTranslation } from "react-i18next";
import useGetTopHeroSection from "@/Hooks/HeroSectionHooks/useGetTopHeroSection";


export default function HeroSection() {
  const { t } = useTranslation();

  // api hooks
  const {getTopHeroSection, isTopHeroLoading} = useGetTopHeroSection();
  const heroContent = getTopHeroSection?.data;
  return (
    <div id="heroSection">
      <CommonHero title={t(heroContent?.title)} isHeroLoading={isTopHeroLoading} videoUrl={isTopHeroLoading ? heroVideo : heroContent?.video} />
    </div>
  );
}
