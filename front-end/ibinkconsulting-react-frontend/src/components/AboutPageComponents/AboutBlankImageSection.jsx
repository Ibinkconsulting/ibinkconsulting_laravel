import React from "react";
import image from "@/assets/Images/heroImg.png";

export default function AboutBlankImageSection() {
  return (
    <div className="w-full h-80 sm:h-90 md:h-100 xl:h-130 relative overflow-hidden">
      <img src={image} alt="" className="absolute inset-0 w-full h-full" />
      {/* Dark Overlay */}
      <div className="absolute inset-0 bg-[#0b1a29]/55" />
    </div>
  );
}
