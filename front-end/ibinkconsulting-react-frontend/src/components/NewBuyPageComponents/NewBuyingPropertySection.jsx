import Container from "@/Common/Container";
import AboutUsSkeleton from "@/Common/Skeleton/AboutUsSkeleton";
import useGetBuyPageBuyingPropertySection from "@/Hooks/BuyPageHooks/useGetBuyPageBuyingPropertySection";
import React from "react";

export default function NewBuyingPropertySection() {
  const { buyPageBuyingPropertyQuery, isBuyingPropertyLoading } =
    useGetBuyPageBuyingPropertySection();
  const buyingPropertyContent = buyPageBuyingPropertyQuery?.data;
  return (
    <div className="w-full bg-white py-14 md:py-20 lg:py-28 text-dark">
      <Container>
        {isBuyingPropertyLoading ? (
          <AboutUsSkeleton />
        ) : (
          <div className="w-full flex flex-col md:flex-row gap-10 md:gap-6 justify-between">
            <div className="w-full">
              <h2 className="w-full seasons-font text-3xl sm:text-4xl lg:text-5xl leading-snug lg:leading-14.5 max-w-110">
                {buyingPropertyContent?.title}
              </h2>
            </div>

            <div className="w-full text-base sm:text-lg font-medium leading-relaxed space-y-7">
              <p
                dangerouslySetInnerHTML={{
                  __html: buyingPropertyContent?.description,
                }}
              />
            </div>
          </div>
        )}
      </Container>
    </div>
  );
}
