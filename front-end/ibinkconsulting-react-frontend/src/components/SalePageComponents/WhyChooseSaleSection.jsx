import Container from "@/Common/Container";
import AboutValuesSkeleton from "@/Common/Skeleton/AboutValuesSkeleton";
import useGetSellPagePropertyChooseQuery from "@/Hooks/SalePageHooks/useGetSellPagePropertyChooseQuery";
import { Check, CheckCircle, CircleCheck } from "lucide-react";
import React from "react";
import { Link } from "react-router-dom";

export default function WhyChooseSaleSection() {
  const { sellPagePropertyChooseQuery, isSellPagePropertyChooseLoading } =
    useGetSellPagePropertyChooseQuery();
  const chooseContent = sellPagePropertyChooseQuery?.data;
  return (
    <div className="w-full bg-white text-dark py-14 md:py-20 lg:py-28 xl:py-34">
      <Container>
        {isSellPagePropertyChooseLoading ? (
          <AboutValuesSkeleton />
        ) : (
          <div className="w-full  ">
            {/* text-3xl sm:text-4xl lg:text-5xl leading-normal lg:leading-14.5 w-full lg:w-1/2 text-center mx-auto */}
            <h2
              className="whyWrapper seasons-font mx-auto"
              dangerouslySetInnerHTML={{ __html: chooseContent?.main_text }}
            >
              {/* Why property owners choose to sell with Ibink Real Estate */}
            </h2>

            <div className="w-full mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12 lg:gap-8 xl:gap-30">
              {chooseContent?.parts?.map((challenge, idx) => (
                <div key={idx} className="space-y-2.5 md:space-y-4">
                  <p className="border-2 border-dark w-fit p-1 rounded-full">
                    <Check className="size-4 sm:size-5 md:size-6" />
                  </p>
                  <h3 className="seasons-font text-[22px] md:text-2xl lg:text-[28px]">
                    {challenge?.title}
                  </h3>
                  <p
                    className="text-sm md:text-base font-medium leading-relaxed"
                    dangerouslySetInnerHTML={{ __html: challenge?.description }}
                  >
                  </p>
                </div>
              ))}
            </div>

            <div className="mt-8 sm:mt-12 lg:mt-20 flex justify-center">
              <Link to={chooseContent?.link_url}>
                <button className="text-white bg-[#0b1a29] uppercase py-2.5 md:py-3 px-6 sm:px-8 rounded-lg font-medium text-sm sm:text-base cursor-pointer hover:opacity-60 transition-opacity">
                  {chooseContent?.button_text}
                </button>
              </Link>
            </div>
          </div>
        )}
      </Container>
    </div>
  );
}
