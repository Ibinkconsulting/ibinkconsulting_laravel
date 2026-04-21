import Container from "@/Common/Container";
import React from "react";
// import lion from "@/assets/Images/lion.png";
// import { useTranslation } from "react-i18next";
import useGetHomeBaerezPropertySectionQuery from "@/Hooks/HeroSectionHooks/useGetHomeBaerezPropertySectionQuery";
import BaerzPropertySkeleton from "@/Common/Skeleton/BaerezPropertySkeleton";

export default function BaerzPropertySection() {
  // const { t } = useTranslation();

  // api hooks
  const { homeBaerezPropertyQuery, isBaerezLoading } =
    useGetHomeBaerezPropertySectionQuery();
  const content = homeBaerezPropertyQuery?.data;
  return (
    <div className="w-full bg-[#293f60] py-12 sm:py-16 lg:py-25">
      <Container>
        {isBaerezLoading ? (
          <BaerzPropertySkeleton />
        ) : (
          <div className="flex flex-col md:flex-row items-center gap-8 lg:gap-20 text-center md:text-center lg:text-left">
            <div className="w-32 sm:w-40 lg:w-78.75 shrink-0">
              <img
                src={content?.logo}
                alt=""
                className="w-full h-auto mx-auto lg:mx-0"
              />
            </div>

            <div className="max-w-xl lg:max-w-none lg:w-178.75">
              <p className="text-lg sm:text-xl md:text-2xl lg:text-3xl seasons-font leading-relaxed text-white">
                {/* {t("baerzProperty.description")} */}
                {content?.title}
              </p>
            </div>
          </div>
        )}
      </Container>
    </div>
  );
}
