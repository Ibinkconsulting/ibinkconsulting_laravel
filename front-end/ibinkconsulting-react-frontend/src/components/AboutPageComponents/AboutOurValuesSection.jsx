import Container from "@/Common/Container";
import AboutValuesSkeleton from "@/Common/Skeleton/AboutValuesSkeleton";
import useGetAboutPageValuesSection from "@/Hooks/AboutPageHooks/useGetAboutPageValuesSection";
import React from "react";

export default function AboutOurValuesSection() {
  const { aboutPageValueSectionQuery, isAboutPageLoading } =
    useGetAboutPageValuesSection();
  const aboutContent = aboutPageValueSectionQuery?.data;
  return (
    <div className="w-full bg-white text-[#0b1a29] pt-10 pb-16 lg:pt-16 lg:pb-32">
      <Container>
        {isAboutPageLoading ? (
          <AboutValuesSkeleton />
        ) : (
          <div>
            <div className="w-full mb-8 lg:mb-12">
              <h2 className="seasons-font text-3xl sm:text-4xl lg:text-5xl leading-snug lg:leading-14.5">
                {aboutContent?.main_text}
              </h2>
            </div>

            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-16 text-[#0b1a29]">
              {aboutContent?.parts?.map((data, idx) => (
                <div key={idx} className="space-y-4">
                  <p className="text-xl lg:text-[28px] seasons-font">
                    {data?.title}
                  </p>
                  <p
                    className="text-base sm:text-lg leading-relaxed"
                    dangerouslySetInnerHTML={{ __html: data?.description }}
                  ></p>
                </div>
              ))}
            </div>
          </div>
        )}
      </Container>
    </div>
  );
}
