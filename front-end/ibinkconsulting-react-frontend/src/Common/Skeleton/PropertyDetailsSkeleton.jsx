import React from "react";

export default function PropertyDetailsSkeleton() {
  return (
    <div className="max-w-7xl mx-auto px-4 py-6 md:py-8 animate-pulse">
      {/* Image Section */}
      <div className="grid grid-cols-1 lg:grid-cols-3 gap-4">
        {/* Left Large Image */}
        <div
          className="lg:col-span-2 relative rounded-xl bg-gray-200
          h-[240px] sm:h-[300px] md:h-[360px] lg:h-[420px]"
        >
          {/* Pills */}
          <div className="absolute bottom-4 left-4 flex flex-wrap gap-2">
            <div className="h-7 w-20 sm:w-24 bg-gray-300 rounded-full" />
            <div className="h-7 w-20 sm:w-24 bg-gray-300 rounded-full" />
            <div className="h-7 w-20 sm:w-24 bg-gray-300 rounded-full" />
          </div>
        </div>

        {/* Right Image Grid */}
        <div className="grid grid-cols-2 gap-4">
          <div
            className="bg-gray-200 rounded-xl
            h-[140px] sm:h-[160px] md:h-[180px] lg:h-[200px]"
          />
          <div
            className="bg-gray-200 rounded-xl
            h-[140px] sm:h-[160px] md:h-[180px] lg:h-[200px]"
          />
          <div
            className="bg-gray-200 rounded-xl
            h-[140px] sm:h-[160px] md:h-[180px] lg:h-[200px]"
          />
          <div
            className="bg-gray-200 rounded-xl
            h-[140px] sm:h-[160px] md:h-[180px] lg:h-[200px]"
          />
        </div>
      </div>

      {/* Text Section */}
      <div className="mt-6 md:mt-8 space-y-3">
        <div className="h-4 w-40 sm:w-48 bg-gray-200 rounded" />
        <div className="h-7 sm:h-8 w-full max-w-md bg-gray-200 rounded" />
        <div className="h-5 sm:h-6 w-32 sm:w-40 bg-gray-200 rounded" />
      </div>
    </div>
  );
}
