import Container from "@/Common/Container";
import AboutValuesSkeleton from "@/Common/Skeleton/AboutValuesSkeleton";
import useGetBuyPageChallengingSectionQuery from "@/Hooks/BuyPageHooks/useGetBuyPageChallengingSectionQuery";
import React from "react";

export default function NewWhyBuyingPropertySection() {
  const { buyPageChallengingQuery, isChallengingLoading } =
    useGetBuyPageChallengingSectionQuery();
  const challengingContent = buyPageChallengingQuery?.data;
  return (
    <div className="w-full bg-white text-dark py-14 md:py-20 xl:py-28">
      <Container>
        {isChallengingLoading ? (
          <AboutValuesSkeleton />
        ) : (
          <div>
            {/* text-3xl sm:text-4xl lg:text-5xl leading-snug lg:leading-14.5 */}
            <h2
              className="leadingClass seasons-font"
              dangerouslySetInnerHTML={{
                __html: challengingContent?.main_text,
              }}
            ></h2>

            <div className="w-full mt-10 lg:mt-12 grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-28">
              {challengingContent?.parts?.map((challenge, idx) => (
                <div key={idx} className="lg:w-2/3 space-y-3">
                  <h3 className="seasons-font text-[22px] md:text-2xl lg:text-[28px]">
                    {challenge?.title}
                  </h3>
                  <p
                    className="text-sm md:text-base font-medium leading-relaxed"
                    dangerouslySetInnerHTML={{ __html: challenge?.description }}
                  />
                </div>
              ))}
            </div>
          </div>
        )}
      </Container>
    </div>
  );
}
