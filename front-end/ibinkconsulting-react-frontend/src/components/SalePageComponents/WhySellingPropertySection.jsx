import Container from "@/Common/Container";
import AboutValuesSkeleton from "@/Common/Skeleton/AboutValuesSkeleton";
import useGetSellPageChallengeSectionQuery from "@/Hooks/SalePageHooks/useGetSellPageChallengeSectionQuery";
import React from "react";
// import { useTranslation } from "react-i18next";


export default function WhySellingPropertySection() {
  // const { t } = useTranslation();
  const { sellPageChallengeQuery, isSellPageChallengeLoading } =
    useGetSellPageChallengeSectionQuery();
  const challengesContent = sellPageChallengeQuery?.data;
  return (
    <div className="w-full bg-white text-dark py-14 md:py-20 xl:py-28">
      <Container>
        {isSellPageChallengeLoading ? (
          <AboutValuesSkeleton />
        ) : (
          <div>
            {/* text-3xl sm:text-4xl lg:text-5xl leading-snug lg:leading-14.5 w-full! lg:w-1/2 xl:w-2/5 */}
            <h2
              className="whyChooseWrapper seasons-font "
              dangerouslySetInnerHTML={{ __html: challengesContent?.main_text }}
            >
              {/* {t("salePage.whySale.title")} */}
            </h2>

            <div className="w-full mt-10 lg:mt-12 grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-28">
              {challengesContent?.parts?.map((challenge, idx) => (
                <div key={idx} className="lg:w-2/3 space-y-3">
                  <h3 className="seasons-font text-[22px] md:text-2xl lg:text-[28px]">
                    {challenge?.title}
                  </h3>
                  <p
                    className="text-sm md:text-base font-medium leading-relaxed"
                    dangerouslySetInnerHTML={{ __html: challenge?.description }}
                  ></p>
                </div>
              ))}
            </div>
          </div>
        )}
      </Container>
    </div>
  );
}
