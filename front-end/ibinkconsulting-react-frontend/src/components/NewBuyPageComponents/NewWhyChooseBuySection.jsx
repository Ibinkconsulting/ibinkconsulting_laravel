import Container from "@/Common/Container";
import AboutValuesSkeleton from "@/Common/Skeleton/AboutValuesSkeleton";
import useGetBuyPageWhyChooseUseQuery from "@/Hooks/BuyPageHooks/useGetBuyPageWhyChooseUseQuery";
import { Check } from "lucide-react";
import React from "react";

export default function NewWhyChooseBuySection() {
  const { buyPageWhyChooseQuery, isWhyChooseLoading } =
    useGetBuyPageWhyChooseUseQuery();
  const whyChooseQuery = buyPageWhyChooseQuery?.data;

  return (
    <div className="w-full bg-white text-dark py-14 md:py-20 lg:py-28 xl:py-34">
      <Container>
        {isWhyChooseLoading ? (
          <AboutValuesSkeleton />
        ) : (
          <div className="w-full">
            <h2
              className="whyWrapper seasons-font text-3xl sm:text-4xl lg:text-5xl leading-normal lg:leading-14.5 text-center mx-auto"
              dangerouslySetInnerHTML={{ __html: whyChooseQuery?.main_text }}
            />

            <div className="w-full mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12 lg:gap-8 xl:gap-30">
              {whyChooseQuery?.parts?.map((challenge, idx) => (
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
                  ></p>
                </div>
              ))}
            </div>

            {/* <div className="mt-8 sm:mt-12 lg:mt-20 flex justify-center">
            <Link to="#">
              <button className="text-white bg-[#0b1a29] uppercase py-2.5 md:py-3 px-6 sm:px-8 rounded-lg font-medium text-sm md:text-base lg:text-lg cursor-pointer hover:opacity-60 transition-opacity">
                BOOK A FREE DISCOVERY CALL
              </button>
            </Link>
          </div> */}
          </div>
        )}
      </Container>
    </div>
  );
}
