import React from "react";
// import coming from "@/assets/Video/coming.mp4";
import ContentMiddleVideo from "@/Common/ContentMiddleVideo";
// import { useTranslation } from "react-i18next";
import useGetCommingSoonSectionQuery from "@/Hooks/HeroSectionHooks/useGetCommingSoonSectionQuery";

export default function ComingSection() {
  // const { t } = useTranslation();

  // api hooks
  const { homeComingSoonQuery, isComingLoading } =
    useGetCommingSoonSectionQuery();
  const content = homeComingSoonQuery?.data;

  return (
    <div>
      <ContentMiddleVideo
        isComingLoading={isComingLoading}
        isLink={true}
        // title={t("contentMiddleVideo.newApartmentsTitle")}
        title={content?.title}
        subtitle={content?.sub_title}
        // subtitle={t("contentMiddleVideo.comingSubtitle")}
        videoUrl={content?.video}
      />
    </div>
  );
}
