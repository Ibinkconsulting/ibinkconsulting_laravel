import React from "react";
// import image from "@/assets/Images/heroImg.png";
import useGetAboutTopSectionQuery from "@/Hooks/AboutPageHooks/useGetAboutTopSectionQuery";

export default function AboutPageHeroSection() {

  const {aboutTopSectionQuery, isAboutTopSectionLoading} = useGetAboutTopSectionQuery();
  const content = aboutTopSectionQuery?.data;

  return (
    <div className={`relative w-full overflow-hidden h-[50vh] sm:h-[60vh] lg:h-[60vh] ${isAboutTopSectionLoading && "animate-pulse"}`}>
      <img
        src={content?.image}
        alt="About hero"
        className="absolute inset-0 w-full h-full object-cover"
      />
      <div className={`absolute inset-0 bg-dark/55 ${isAboutTopSectionLoading && "animate-pulse"}`} />
    </div>
  );
}
