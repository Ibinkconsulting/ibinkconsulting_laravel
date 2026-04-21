const FreeMasterclassSkeleton = () => {
  return (
    <section className="w-full bg-white py-24 animate-pulse">
      <div className="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-20 items-center">
        {/* Left: Video Mockup Skeleton */}
        <div className="flex justify-center">
          <div className="w-[420px] h-[260px] rounded-xl bg-gray-300 relative">
            {/* Screen */}
            <div className="absolute inset-4 rounded-lg bg-gray-400" />
            {/* Stand */}
            <div className="absolute -bottom-6 left-1/2 -translate-x-1/2 w-24 h-4 bg-gray-400 rounded" />
          </div>
        </div>

        {/* Right: Content Skeleton */}
        <div className="space-y-6">
          {/* Badge */}
          <div className="h-4 w-32 bg-gray-300 rounded" />

          {/* Heading */}
          <div className="space-y-3">
            <div className="h-8 w-3/4 bg-gray-300 rounded" />
            <div className="h-8 w-2/3 bg-gray-300 rounded" />
            <div className="h-8 w-1/2 bg-gray-300 rounded" />
          </div>

          {/* Description */}
          <div className="space-y-2">
            <div className="h-4 w-full bg-gray-300 rounded" />
            <div className="h-4 w-5/6 bg-gray-300 rounded" />
            <div className="h-4 w-2/3 bg-gray-300 rounded" />
          </div>

          {/* Form */}
          <div className="space-y-4 pt-4">
            <div className="h-12 w-full bg-gray-300 rounded-lg" />
            <div className="h-12 w-full bg-gray-300 rounded-lg" />
            <div className="h-12 w-52 bg-gray-400 rounded-lg" />
          </div>
        </div>
      </div>
    </section>
  );
};

export default FreeMasterclassSkeleton;
