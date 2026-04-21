import React from "react";

export default function CardSkeleton() {
  return (
    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      {Array.from({ length: 3 }).map((_, index) => (
        <div key={index} className="border border-gray-200 p-4">
          {/* Image */}
          <div className="w-full h-[260px] bg-gray-200 animate-pulse mb-6" />

          {/* Year */}
          <div className="h-4 w-16 bg-gray-200 animate-pulse mb-4" />

          {/* Title */}
          <div className="space-y-3 mb-4">
            <div className="h-6 w-full bg-gray-200 animate-pulse" />
            <div className="h-6 w-[85%] bg-gray-200 animate-pulse" />
          </div>

          {/* Description */}
          <div className="space-y-2 mb-6">
            <div className="h-4 w-full bg-gray-200 animate-pulse" />
            <div className="h-4 w-full bg-gray-200 animate-pulse" />
            <div className="h-4 w-[70%] bg-gray-200 animate-pulse" />
          </div>

          {/* Button */}
          <div className="h-10 w-36 bg-gray-300 animate-pulse rounded" />
        </div>
      ))}
    </div>
  );
}
