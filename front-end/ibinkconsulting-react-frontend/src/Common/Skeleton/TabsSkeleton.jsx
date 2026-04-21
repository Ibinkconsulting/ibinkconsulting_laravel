import React from "react";

export default function TabsSkeleton() {
  return (
    <div className="flex flex-wrap gap-4">
      {[1, 2, 3, 4, 5].map((_, index) => (
        <div
          key={index}
          className="h-10 w-40 rounded-full bg-gray-200 animate-pulse"
        />
      ))}
    </div>
  );
}
