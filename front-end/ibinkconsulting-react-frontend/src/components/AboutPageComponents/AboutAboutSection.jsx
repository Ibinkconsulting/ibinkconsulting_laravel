import Container from "@/Common/Container";
import AboutUsSkeleton from "@/Common/Skeleton/AboutUsSkeleton";
import useGetAboutUsSectionQuery from "@/Hooks/AboutPageHooks/useGetAboutUsSectionQuery";
import React from "react";

export default function AboutAboutSection() {
  const { aboutAboutUsQuery, isaboutAboutUsLoading } =
    useGetAboutUsSectionQuery();
  const aboutContent = aboutAboutUsQuery?.data;
  return (
    <div className="w-full bg-white text-[#0b1a29] py-14 md:py-20">
      <Container>
        {isaboutAboutUsLoading ? (
          <AboutUsSkeleton />
        ) : (
          <div className="flex flex-col gap-8 lg:flex-row lg:gap-16">
            <div className="w-full lg:w-1/2">
              <h2 className="seasons-font text-3xl sm:text-4xl lg:text-5xl leading-snug lg:leading-14.5">
                {aboutContent?.title}
              </h2>
            </div>

            <div className="w-full lg:w-1/2 text-base sm:text-lg font-medium leading-relaxed text-[#0b1a29] space-y-5">
              <p
                dangerouslySetInnerHTML={{ __html: aboutContent?.description }}
              ></p>
            </div>
          </div>
        )}
      </Container>
    </div>
  );
}
