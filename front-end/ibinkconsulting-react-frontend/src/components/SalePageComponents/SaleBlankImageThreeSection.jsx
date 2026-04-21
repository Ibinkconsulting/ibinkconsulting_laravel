import React from "react";
import image from '@/assets/Images/details4.png'

export default function SaleBlankImageThreeSection() {
  return (
    <div className="w-full h-80 sm:h-100 md:h-120 lg:h-145 relative overflow-hidden">
      <img
        src={image}
        alt=""
        className="absolute inset-0 w-full h-full object-cover object-center"
      />
      {/* Dark Overlay */}
      {/* <div className="absolute inset-0 bg-dark/55" /> */}
    </div>
  );
}
