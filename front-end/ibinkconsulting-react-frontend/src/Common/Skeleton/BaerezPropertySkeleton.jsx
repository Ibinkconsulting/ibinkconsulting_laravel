const BaerzPropertySkeleton = () => {
  return (
    <div className="w-full bg-[#2b3f5f] py-20 animate-pulse">
      <div className="max-w-7xl mx-auto px-6 flex items-center gap-16">
        
        {/* Logo Card Skeleton */}
        <div className="w-[260px] h-[320px] border-2 border-gray-500 flex items-center justify-center">
          <div className="space-y-4 w-full px-6">
            <div className="h-16 w-16 rounded-full bg-gray-600 mx-auto" />
            <div className="h-6 bg-gray-600 rounded w-3/4 mx-auto" />
            <div className="h-4 bg-gray-600 rounded w-1/2 mx-auto" />
            <div className="h-5 bg-gray-600 rounded w-2/3 mx-auto mt-6" />
          </div>
        </div>

        {/* Divider */}
        <div className="h-48 w-[2px] bg-gray-600" />

        {/* Text Content Skeleton */}
        <div className="flex-1 space-y-4">
          <div className="h-6 bg-gray-600 rounded w-3/4" />
          <div className="h-6 bg-gray-600 rounded w-2/3" />
          <div className="h-6 bg-gray-600 rounded w-1/2" />
        </div>

      </div>
    </div>
  );
};

export default BaerzPropertySkeleton;
