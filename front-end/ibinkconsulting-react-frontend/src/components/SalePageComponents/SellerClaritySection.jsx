import React from "react";
// import owner from "@/assets/Images/about1.png";
// import image from "@/assets/Images/details4.png";
import useGetSellPageConsiderPropertyQuery from "@/Hooks/SalePageHooks/useGetSellPageConsiderPropertyQuery";
import FounderSkeleton from "@/Common/Skeleton/FounderSkeleton";
import useGetSellPageGetClarityQuery from "@/Hooks/SalePageHooks/useGetSellPageGetClarityQuery";
import { Link } from "react-router-dom";

export default function SellerClaritySection() {
  const { sellPageConsiderPropertyQuery, isSellPageConsiderPropertyLoading } =
    useGetSellPageConsiderPropertyQuery();
  const considerContent = sellPageConsiderPropertyQuery?.data;

  const { sellPageGetClarityQuery, isSellPageGetClarityLoading } =
    useGetSellPageGetClarityQuery();

  const clarityContent = sellPageGetClarityQuery?.data;
  return (
    <div className="min-h-screen bg-white pt-14 md:pt-20 lg:pt-24 text-dark">
      {isSellPageConsiderPropertyLoading || isSellPageGetClarityLoading ? (
        <FounderSkeleton />
      ) : (
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-0">
          <div className="relative h-[50vh] lg:h-screen">
            <img
              src={considerContent?.image}
              alt="Costa del Sol terrace view"
              className="w-full h-full object-cover"
            />
          </div>

          <div className="p-4 sm:p-8 xl:pl-25 2xl:pl-30 xl:pr-50 flex flex-col  justify-center">
            <h2 className="seasons-font text-3xl sm:text-4xl xl:text-5xl leading-normal xl:leading-14.5">
              {considerContent?.main_text}
            </h2>

            <p
              className="mt-4 md:mt-10 lg:mt-8 xl:mt-12 text-sm sm:text-base font-medium mb-4 leading-relaxed"
              dangerouslySetInnerHTML={{ __html: considerContent?.description }}
            ></p>

            <div className="mt-5 md:mt-8 lg:mt-6 xl:mt-8">
              {considerContent?.parts?.map((data, idx) => (
                <div key={idx}>
                  <h2 className="text-lg md:text-xl font-bold mb-4 ">
                    {data?.key_title}
                  </h2>
                  <ul className="space-y-3 text-sm  md:text-base font-semibold">
                    {data?.points?.map((point, idx) => (
                      <li key={idx} className="flex items-center gap-4">
                        <span className="w-1.75 h-1.75 rounded-full bg-dark" />
                        <span>{point}</span>
                      </li>
                    ))}
                  </ul>
                </div>
              ))}
            </div>
          </div>

          <div className="bg-white p-4 sm:p-8 lg:px-10  xl:pl-30 xl:pr-60 2xl:pr-80 flex flex-col justify-center">
            <h2 className="seasons-font text-3xl sm:text-4xl xl:text-5xl leading-10 md:leading-12 xl:leading-14.5">
              {clarityContent?.title}
            </h2>

            <p
              className="mt-8 mb-12 text-base md:text-lg font-medium leading-relaxed"
              dangerouslySetInnerHTML={{ __html: clarityContent?.description }}
            ></p>

            <Link to={clarityContent?.link_url}>
              <button className=" text-white px-8 py-2.5 sm:py-3 md:py-4 rounded-sm bg-dark transition-colors duration-200 uppercase tracking-wider text-base font-medium w-fit">
                {clarityContent?.button_text}
              </button>
            </Link>
          </div>

          <div className="relative h-[50vh] lg:h-screen">
            <img
              src={clarityContent?.image}
              alt="Real estate professional"
              className="w-full h-full object-cover"
            />
          </div>
        </div>
      )}
    </div>
  );
}
