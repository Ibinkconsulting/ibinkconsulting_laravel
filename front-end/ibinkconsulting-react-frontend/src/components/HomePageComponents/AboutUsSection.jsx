import Container from "@/Common/Container";
import React from "react";
import logoBlack from "@/assets/Images/logoSingle.png";
import about1 from "@/assets/Images/about1.png";
// import about2 from "@/assets/Images/about2.png";
// import nvm from "@/assets/Images/nvm.png";
import { Link } from "react-router-dom";
// import { useTranslation } from "react-i18next";
import useGetHomeOwnerSectionQuery from "@/Hooks/HeroSectionHooks/useGetHomeOwnerSectionQuery";
import useGetHomePartnerSectionQuery from "@/Hooks/HeroSectionHooks/useGetHomePartnerSectionQuery";
import FounderSkeleton from "@/Common/Skeleton/FounderSkeleton";

export default function AboutUsSection() {
  // const { t } = useTranslation();
  // api hooks
  const { aboutOwnerSectionQuery, isOwnerLoading } =
    useGetHomeOwnerSectionQuery();
  const ownerContent = aboutOwnerSectionQuery?.data;

  const { aboutPartnerSectionQuery, isPartnerLoading } =
    useGetHomePartnerSectionQuery();
  const partnerContent = aboutPartnerSectionQuery?.data;

  return (
    <div className="w-full bg-white">
      {/* <Container> */}
      {/* Hero Section */}
      {isOwnerLoading || isPartnerLoading ? (
        <FounderSkeleton />
      ) : (
        <div className="grid md:grid-cols-2">
          {/* Text */}
          <div className="order-1 md:order-0 p-6 sm:p-10 md:p-16 lg:p-10 flex flex-col justify-center">
            <div className="flex justify-end lg:pr-28">
              <div className="mx-w-lg lg:max-w-xl">
                <div className="mb-6 w-fit h-28 sm:h-36 lg:h-48">
                  <img
                    src={logoBlack}
                    alt=""
                    className="w-full h-full object-contain"
                  />
                </div>

                <h1 className="text-2xl sm:text-3xl md:text-4xl lg:text-5xl seasons-font mb-5 text-dark leading-[140%] lg:leading-14.5 xl:w-70/100">
                  {/* {t("aboutUs.founderTitle")} */}
                  {ownerContent?.title}
                </h1>

                <p
                  className="text-dark text-base leading-[150%] mb-8 xl:max-w-80/100"
                  dangerouslySetInnerHTML={{
                    __html: ownerContent?.sub_description,
                  }}
                >
                  {/* {t("aboutUs.founderText")} */}
                </p>

                <Link
                  to="/about"
                  className="inline-block bg-dark text-white rounded-lg uppercase px-6 sm:px-8 py-3 hover:bg-dark transition-colors"
                >
                  {/* {t("aboutUs.readMoreBtn")} */}
                  {ownerContent?.button_text}
                </Link>
              </div>
            </div>
          </div>

          {/* Image */}
          <div className="order-2 md:order-0 w-full h-64 sm:h-96 md:h-250">
            <img
              src={about1}
              alt=""
              className="w-full h-full object-cover object-center"
            />
          </div>
        </div>
      )}

      {/* Partnership Section */}
      <div className="grid md:grid-cols-2">
        {/* Text */}
        <div className="order-1 md:order-2 bg-white p-6 sm:p-10 md:p-16 flex flex-col justify-center">
          <div className="max-w-lg">
            <div className="w-auto h-28 sm:h-32 md:h-40 mb-5">
              <img
                src={partnerContent?.logo}
                alt=""
                className="h-full object-contain"
              />
            </div>

            <h2 className="text-2xl sm:text-3xl md:text-4xl lg:text-5xl seasons-font mb-6 text-dark leading-[140%] lg:leading-14.5">
              {/* {t("aboutUs.partnershipTitle")} */}
              {partnerContent?.title}
            </h2>

            <p
              className="text-dark text-base leading-[150%] mb-8"
              dangerouslySetInnerHTML={{ __html: partnerContent?.description }}
            >
              {/* {t("aboutUs.partnershipText")} */}
            </p>
          </div>
        </div>

        {/* Image */}
        <div className="order-2 md:order-1 w-full h-105 sm:h-148 md:h-200 xl:h-180 2xl:h-250">
          <img
            src={partnerContent?.image}
            alt="partner"
            className="w-full h-full object-cover object-top"
          />
        </div>
      </div>
      {/* </Container> */}
    </div>
  );
}
