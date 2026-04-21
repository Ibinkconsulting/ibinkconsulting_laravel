import React from "react";
import { Link } from "react-router-dom";
import photo from "@/assets/Images/heroImg.png";

export default function ErrorPage() {
  return (
    <div
      className="w-full h-screen overflow-hidden bg-cover relative"
      style={{ backgroundImage: `url(${photo})` }}
    >
      {/* Dark Overlay */}
      <div className="absolute inset-0 bg-[#0b1a29]/75" />
      <div className="space-y-3 w-full h-full flex flex-col items-center justify-center z-9999 relative">
        <p className="text-4xl font-semibold text-white text-center">
          The Page will be comming soon........
        </p>
        <Link
          to={"/"}
          className="text-2xl p-1 border-b border-b-white text-white font-medium text-center"
        >
          Back to Home Page
        </Link>
      </div>
    </div>
  );
}
