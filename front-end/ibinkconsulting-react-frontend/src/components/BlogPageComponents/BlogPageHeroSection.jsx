import CommonHero from "@/Common/CommonHero";
import Container from "@/Common/Container";
import useGetInsightsPageTopSection from "@/Hooks/InsightsOrBlogPageHooks/useGetInsightsPageTopSection";
// import image from "@/assets/Images/heroImg.png";
import React from "react";
// import { useTranslation } from "react-i18next";

export default function BlogPageHeroSection() {
  // const { t } = useTranslation();

  const { insightsPageTopSectionQuery, isInsightsPageTopSectionLoading } =
    useGetInsightsPageTopSection();
  const heroContent = insightsPageTopSectionQuery?.data;
  return (
    <div className="relative w-full overflow-hidden h-[50vh] lg:h-[60vh]">
      {isInsightsPageTopSectionLoading ? (
        <div className="w-full h-full absolute bg-gray-700/70 animate-pulse">
          <Container>
            <p className="w-1/2 h-10 bg-gray-400/70 rounded-full animate-pulse absolute bottom-20 z-20"></p>
          </Container>
        </div>
      ) : (
        <div>
          <img
            src={heroContent?.image}
            alt="About hero"
            className="absolute inset-0 w-full h-full object-cover"
          />
          <div className="absolute inset-0 bg-dark/55" />
          <Container>
            <h2 className="text-white text-[45px] xl:text-[55px] seasons-font mb-2 max-w-4xl leading-16 xl:leading-17 absolute bottom-20">
              {/* {t("blogPage.insights")} */}
              {heroContent?.title}
            </h2>
          </Container>
        </div>
      )}
    </div>
  );
}
