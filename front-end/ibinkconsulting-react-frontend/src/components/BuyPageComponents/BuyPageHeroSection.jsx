import CommonHero from "@/Common/CommonHero";
import React from "react";
import image from "@/assets/Images/heroImg.png";
import { useTranslation } from "react-i18next";

export default function BuyPageHeroSection() {
  const { t } = useTranslation();
  return (
    <div>
      <CommonHero
        title={t("Find your dream home in the Costa Del Sol, Spain")}
        isImage={true}
        imageUrl={image}
        height={"h-160"}
      />
    </div>
  );
}
