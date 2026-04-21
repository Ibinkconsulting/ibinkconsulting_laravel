import React from "react";
// import about1 from "@/assets/Images/about1.png";
import Container from "@/Common/Container";
import useGetBuyPageTopSectionQuery from "@/Hooks/BuyPageHooks/useGetBuyPageTopSectionQuery";

export default function NewBuyPageHeroSection() {
  const { buyPageTopDataQuery, isBuyPageTopDataLoading } =
    useGetBuyPageTopSectionQuery();
  const topContent = buyPageTopDataQuery?.data;
  return (
    <div className="w-full">
      <div className="relative w-full h-[68vh] lg:h-[70vh]">
        {isBuyPageTopDataLoading ? (
          <div className="w-full h-full absolute bg-gray-700/70 animate-pulse">
            <Container>
              <p className="w-1/2 h-10 bg-gray-400/70 rounded-full animate-pulse absolute bottom-20 z-20"></p>
            </Container>
          </div>
        ) : (
          <div>
            <img
              src={topContent?.image}
              alt="About hero"
              className="absolute inset-0 w-full h-full object-cover object-top"
            />
            <div className="absolute inset-0 bg-dark/75" />

            <Container className="">
              <div className="absolute bottom-10 sm:bottom-20">
                <h2 className="text-white z-20 w-full text-[34px] lg:text-[45px] xl:text-[55px] seasons-font mb-2 max-w-6xl leading-12 xl:leading-16 2xl:leading-17">
                  {topContent?.title}
                </h2>

                <p
                  className="text-white z-20 text-base sm:text-lg md:text-xl xl:text-2xl leading-relaxed font-medium"
                  dangerouslySetInnerHTML={{ __html: topContent?.sub_title }}
                ></p>
              </div>
            </Container>
          </div>
        )}
      </div>
    </div>
  );
}
