import React from "react";
import image from '@/assets/Images/blog5.png'

export default function NewBuyPageEmptyImageOne() {
  return (
    <div className="w-full h-80 sm:h-100 md:h-120 lg:h-140 relative overflow-hidden">
      <img
        src={image}
        alt=""
        className="absolute inset-0 w-full h-full object-cover object-bottom"
      />
      {/* Dark Overlay */}
      {/* <div className="absolute inset-0 bg-dark/55" /> */}
    </div>
  );
}
