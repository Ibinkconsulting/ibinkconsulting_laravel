import HeartFillSVG from "@/SVG/HeartFillSVG";
import { Heart } from "lucide-react";
import React, { useState } from "react";
import { useNavigate } from "react-router-dom";

export default function CommonPropertyCard({
  photo,
  title,
  subTitle,
  slug,
  bedrooms,
  bathrooms,
  landsize,
  price,
}) {
  const navigate = useNavigate();
  const [favourite, setFavourite] = useState(false);

  const handleFavourite = () => {
    setFavourite(!favourite);
  };
  return (
    <div
      onClick={() => navigate(`/buy-details/${slug}`, { state: "buy-details" })}
      className="w-full bg-white overflow-hidden shadow-md font-sans cursor-pointer duration-300 ease-in-out"
    >
      {/* Image Section */}
      <div className="relative w-full h-72.5">
        <img
          src={photo}
          alt="Boutique Living With A View"
          className="h-full w-full object-cover"
        />

        {/* Heart Icon */}
        <div
          onClick={(e) => {
            (handleFavourite(), e.stopPropagation());
          }}
          className={`absolute bottom-3 right-3 flex h-9 w-9 items-center justify-center rounded-full text-white text-lg cursor-pointer bg-[#0b1a29]/40"`}
        >
          <p className="w-6 h-6">
            {" "}
            {favourite ? <HeartFillSVG /> : <Heart className={``} />}
          </p>
        </div>
      </div>

      {/* Content Section */}
      <div className="py-4 px-6">
        <p className="text-sm md:text-base font-medium text-dark mb-2">
          {subTitle}
        </p>

        <h2 className="text-lg sm:text-xl xl:text-[22px] font-semibold text-dark mb-10">
          {title}
        </h2>

        {bedrooms && (
          <p className="text-sm sm:text-base text-dark/90 mb-3 mt-4">
            {bedrooms} bedrooms | {bathrooms} bathrooms | {landsize} m²
          </p>
        )}

        <p className="text-base md:text-lg font-medium text-dark/90">
          € {price}
        </p>
      </div>
    </div>
  );
}
