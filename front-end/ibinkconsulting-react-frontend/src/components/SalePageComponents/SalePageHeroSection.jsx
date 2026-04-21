import React from "react";
// import image from "@/assets/Images/saleHero.jpg";
// import { useTranslation } from "react-i18next";
import Container from "@/Common/Container";
import useGetSalePageTopSectionQuery from "@/Hooks/SalePageHooks/useGetSalePageTopSectionQuery";

export default function SalePageHeroSection() {
  // const { t } = useTranslation();
  const { sellPageTopSectionQuery, isSellPageTopSectionLoading } =
    useGetSalePageTopSectionQuery();

  const sellContent = sellPageTopSectionQuery?.data;
  console.log(sellContent);
  
  return (
    <div className="relative w-full overflow-hidden h-[60vh] lg:h-[62vh]">
      {isSellPageTopSectionLoading ? (
        <div className="w-full h-full absolute bg-gray-700/70 animate-pulse">
          <Container>
            <p className="w-2/3 h-10 bg-gray-400/70 rounded-full animate-pulse absolute bottom-20 z-20"></p>
            <p className="w-1/2 h-6 bg-gray-400/70 rounded-full animate-pulse absolute bottom-10 z-20"></p>
          </Container>
        </div>
      ) : (
        <div>
          <img
            src={sellContent?.image}
            alt="About hero"
            className="absolute inset-0 w-full h-full object-cover"
          />
          <div className="absolute inset-0 bg-dark/55" />
          <Container className="">
            <div className="absolute bottom-20">
              <h2 className="text-white z-20  text-[36px]  lg:text-[45px] xl:text-[55px] seasons-font mb-2 max-w-4xl leading-12 xl:leading-17 xl:text-nowrap">
                {/* {t("salePage.title")} */}
                {sellContent?.title}
              </h2>

              <p
                className="text-white z-20 text-base sm:text-lg md:text-xl xl:text-2xl leading-relaxed font-medium"
                dangerouslySetInnerHTML={{ __html: sellContent?.sub_title }}
              ></p>
            </div>
          </Container>
        </div>
      )}
    </div>
  );
}
