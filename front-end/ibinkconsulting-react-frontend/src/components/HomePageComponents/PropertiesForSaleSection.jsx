import CommonPropertyCard from "@/Common/CommonPropertyCard";
import Container from "@/Common/Container";
import CardSkeleton from "@/Common/Skeleton/CardSkeleton";
import useGetBuyingPropertiesQuery from "@/Hooks/BuyPageBuyingPropertiesHooks/useGetBuyingPropertiesQuery";
import React from "react";
import { useTranslation } from "react-i18next";
import { Link } from "react-router-dom";

export default function PropertiesForSaleSection({ title, padding }) {
  const { t } = useTranslation();
  const { buyingPropertiesQuery, isBuyingPropertiesLoading } =
    useGetBuyingPropertiesQuery();

  const properties = (buyingPropertiesQuery?.data);

  return (
    <div className={`bg-white w-full ${padding || "py-12 sm:py-16 lg:py-24"}`}>
      <Container>
        <h3 className="text-2xl sm:text-3xl md:text-4xl lg:text-5xl text-dark seasons-font lg:leading-14.5">
          {title || t("propertiesForSale.title")}
        </h3>

        {isBuyingPropertiesLoading ? (
          <CardSkeleton />
        ) : (
          <div className="mt-6 sm:mt-10 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 sm:gap-10 lg:gap-16">
            {properties?.slice(0, 9)?.map((data, idx) => (
              <CommonPropertyCard
                key={idx}
                photo={data?.thumbnail}
                title={data?.title}
                subTitle={data?.location}
                id={data?.id}
                slug={data?.slug}
                bedrooms={data?.bedrooms}
                bathrooms={data?.bathrooms}
                landsize={data?.land_size}
                price={data?.price}
              />
            ))}
          </div>
        )}

        <div className="mt-8 sm:mt-20 flex justify-center">
          <Link to="/buy">
            <button className="text-white bg-dark py-3 px-6 sm:px-10 rounded-lg font-medium text-base sm:text-[17px] cursor-pointer hover:opacity-60 transition-opacity uppercase">
              {t("propertiesForSale.viewAllBtn")}
            </button>
          </Link>
        </div>
      </Container>
    </div>
  );
}
