import Container from "@/Common/Container";
import AboutUsSkeleton from "@/Common/Skeleton/AboutUsSkeleton";
import useGetSellPageSellingPropertySectionQuery from "@/Hooks/SalePageHooks/useGetSellPageSellingPropertySectionQuery";
import React from "react";
// import { useTranslation } from "react-i18next";

export default function SalePropertySection() {
  // const { t } = useTranslation();
  const { sellPageSellingPropertyQuery, isSellPageSellingPropertyLoading } =
    useGetSellPageSellingPropertySectionQuery();
  const sellingPropertyContent = sellPageSellingPropertyQuery?.data;
  return (
    <div className="bg-white py-14 md:py-20 lg:py-28 text-dark">
      <Container>
        {isSellPageSellingPropertyLoading ? (
          <AboutUsSkeleton />
        ) : (
          <div className="w-full flex flex-col md:flex-row gap-10 md:gap-6 justify-between">
            <div className="w-full">
              <h2 className="seasons-font text-3xl sm:text-4xl lg:text-5xl leading-snug lg:leading-14.5 max-w-110">
                {/* {t("salePage.saleProperty.title")} */}
                {sellingPropertyContent?.title}
              </h2>
            </div>

            <div
              className="w-full text-base sm:text-lg font-medium leading-relaxed space-y-7"
              dangerouslySetInnerHTML={{
                __html: sellingPropertyContent?.description,
              }}
            >
              {/* <p className="">{t("salePage.saleProperty.text1")}</p>
            <p className="">{t("salePage.saleProperty.text2")}</p>
            <p className="">{t("salePage.saleProperty.text3")}</p> */}
            </div>
          </div>
        )}
      </Container>
    </div>
  );
}
