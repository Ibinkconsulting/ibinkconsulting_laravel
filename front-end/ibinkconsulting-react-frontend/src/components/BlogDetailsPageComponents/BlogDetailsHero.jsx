import React from "react";
import hero from "@/assets/Images/blog8.png";

export default function BlogDetailsHero() {
  return (
    <div
      className={`relative w-full overflow-hidden h-[50vh] sm:h-[60vh] lg:h-[60vh] pt-20 md:pt-28 lg:pt-34`}
    >
      <img
        src={hero}
        alt="About hero"
        className="absolute inset-0 w-full h-full object-cover"
      />
      {/* <div className={`absolute inset-0 bg-dark/55 `} /> */}
    </div>
  );
}
