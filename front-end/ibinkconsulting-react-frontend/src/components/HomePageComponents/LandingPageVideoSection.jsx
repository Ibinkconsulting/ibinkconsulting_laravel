import NoContentVideo from "@/Common/NoContentVideo";
import React from "react";
// import sea from "@/assets/Video/sea.mp4";
import useGetMiddleVideoSectionQuery from "@/Hooks/HeroSectionHooks/useGetMiddleVideoSectionQuery";

export default function LandingPageVideoSection() {
  const { homeMiddleVideoQuery, isVideoLoading } =
    useGetMiddleVideoSectionQuery();
  const content = homeMiddleVideoQuery?.data;
  return (
    <div>
      {isVideoLoading ? (
        <div className="w-full animate-pulse">
          {/* Video Area */}
          <div className="relative w-full h-125 rounded-xl bg-gray-700 overflow-hidden">
            {/* Play Button Placeholder */}
           
          </div>
        </div>
      ) : (
        <div className="w-full h-125">
          <img src={content?.image} alt="" className="w-full h-full object-cover" />
        </div>
      )}
    </div>
  );
}
