import React from "react";
// import logoBlack from "@/assets/Images/logoSingle.png";
// import about1 from "@/assets/Images/about1.png";
// import about2 from "@/assets/Images/about2.png";
// import nvm from "@/assets/Images/nvm.png";
// import certified from "@/assets/Images/ibink.png";
import useGetHomeOwnerSectionQuery from "@/Hooks/HeroSectionHooks/useGetHomeOwnerSectionQuery";
import useGetHomePartnerSectionQuery from "@/Hooks/HeroSectionHooks/useGetHomePartnerSectionQuery";
import FounderSkeleton from "@/Common/Skeleton/FounderSkeleton";

export default function AboutTheFounderSection() {
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
      {(isOwnerLoading || isPartnerLoading) ? <FounderSkeleton/> : (
        <div className="grid grid-cols-1 md:grid-cols-2">
          {/* left column image */}
          <div className="w-full h-64 sm:h-80 md:h-auto order-1 md:order-1">
            <img
              src={ownerContent?.image}
              alt="Founder"
              className="w-full h-full object-cover object-center"
            />
          </div>

          {/* right Column - Text */}
          <div className="p-6 sm:p-8 md:p-12 lg:p-16 xl:py-20 xl:pl-20 xl:pr-40 flex flex-col justify-center order-2 md:order-2">
            <div>
              {/* Coat of Arms */}
              <div className="mb-6 md:mb-8 w-fit h-26 sm:h-32 md:h-40">
                <img
                  src={ownerContent?.logo}
                  alt="Logo"
                  className="w-full h-full object-contain"
                />
              </div>

              <h1 className="text-3xl sm:text-4xl md:text-5xl seasons-font leading-normal md:leading-14.5 mb-4 md:mb-6 text-dark">
                The Founder
              </h1>

              <div className="text-dark text-sm sm:text-base leading-relaxed mb-6 md:mb-8 space-y-4 md:space-y-5">
                <p
                  dangerouslySetInnerHTML={{
                    __html: ownerContent?.description,
                  }}
                />
              </div>

              {/* certified */}
              <div className="text-dark flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4">
                <h3 className="font-semibold tracking-wide text-base sm:text-lg uppercase">
                  CERTIFIED
                </h3>
                <div className="h-8 sm:h-10 md:h-12 xl:h-14 w-auto">
                  <img
                    src={ownerContent?.icon}
                    alt="Certified"
                    className="h-full w-auto object-contain"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      )}

      {/* Partnership Section */}
      <div className="grid grid-cols-1 md:grid-cols-2">
        {/* left Column - Text */}
        <div className="bg-white p-6 sm:p-8 md:p-12 lg:p-16 xl:py-20 xl:pr-20 2xl:pl-60 flex flex-col justify-center order-2 md:order-1">
          <div className="max-w-full w-full xl:max-w-xl">
            <h2 className="text-2xl sm:text-3xl md:text-4xl lg:text-5xl seasons-font leading-tight md:leading-12 lg:leading-14.5 mb-6 md:mb-8 text-dark">
              {/* We work in Partnership
              <br className="hidden sm:block" />
              <span className="sm:hidden"> </span>
              with Rosalie Zuidema */}
              {partnerContent?.title}
            </h2>

            <p
              className="text-dark text-sm sm:text-base leading-relaxed mb-6 md:mb-8"
              dangerouslySetInnerHTML={{ __html: partnerContent?.description }}
            ></p>

            <div className="flex flex-col sm:flex-row sm:items-center gap-3 text-dark">
              <p className="font-semibold tracking-wide text-base sm:text-lg uppercase">
                Certified
              </p>
              {/* NVM Logo */}
              <div className="w-auto h-24 sm:h-28 md:h-32 lg:h-36">
                <img
                  src={partnerContent?.logo}
                  alt="NVM Certified"
                  className="h-full w-auto object-contain"
                />
              </div>
            </div>
          </div>
        </div>

        {/* right column img */}
        <div className="w-full h-100 sm:h-190 md:h-auto lg:h-auto md:min-h-125 lg:min-h-100 xl:h-180 2xl:h-240 order-1 md:order-2">
          <img
            src={partnerContent?.image}
            alt="Partner"
            className="w-full h-full object-cover object-top"
          />
        </div>
      </div>
      {/* </Container> */}
    </div>
  );
}
