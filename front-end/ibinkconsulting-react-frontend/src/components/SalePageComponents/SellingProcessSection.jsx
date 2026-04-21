import Container from "@/Common/Container";
import AboutValuesSkeleton from "@/Common/Skeleton/AboutValuesSkeleton";
import useGetSellPageSellingProcessQuery from "@/Hooks/SalePageHooks/useGetSellPageSellingProcessQuery";
import React from "react";
import { Link } from "react-router-dom";

export default function SellingProcessSection() {
  const { sellPageSellingProcessQuery, isSellPageSellingProcessLoading } =
    useGetSellPageSellingProcessQuery();

  const processContent = sellPageSellingProcessQuery?.data;
  return (
    <div className="w-full bg-white text-dark py-14 md:py-20 lg:py-28 xl:py-34">
      <Container>
        {isSellPageSellingProcessLoading ? (
          <AboutValuesSkeleton />
        ) : (
          <div className="w-full">
            <div className="text-center space-y-4">
              <h2 className="seasons-font text-3xl sm:text-4xl lg:text-5xl leading-normal lg:leading-14.5 lg:w-1/2 text-center mx-auto">
                {processContent?.main_text}
              </h2>

              <p className="text-base md:text-lg font-semibold lg:w-3/5 mx-auto">
                {processContent?.sub_text}
              </p>
            </div>

            <div className="w-full mt-12 lg:mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 sm:gap-12 lg:gap-8 xl:gap-30">
              {processContent?.parts?.map((challenge, idx) => (
                <div key={idx} className="space-y-2.5 md:space-y-4">
                  <p className="text-3xl sm:text-4xl lg:text-[40px] seasons-font leading-relaxed">
                    0{idx + 1}
                  </p>
                  <h3 className="seasons-font text-[22px] md:text-2xl lg:text-[28px] ">
                    {challenge?.title}
                  </h3>
                  <p
                    className="text-sm md:text-base font-medium leading-relaxed"
                    dangerouslySetInnerHTML={{ __html: challenge?.description }}
                  ></p>
                </div>
              ))}
            </div>

            <div className="mt-8 sm:mt-12 lg:mt-20 xl:mt-24 flex justify-center">
              <Link to={processContent?.link_url}>
                <button className="text-white bg-[#0b1a29] uppercase py-3 px-6 sm:px-8 rounded-lg font-medium text-sm sm:text-base cursor-pointer hover:opacity-60 transition-opacity">
                  {processContent?.button_text}
                </button>
              </Link>
            </div>
          </div>
        )}
      </Container>
    </div>
  );
}
