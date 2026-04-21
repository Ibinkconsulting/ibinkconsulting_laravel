export default function AboutValuesSkeleton() {
  return (
    <section className="px-6 md:px-16 py-20 animate-pulse">
      {/* Section Title */}
      <div className="h-10 w-48 bg-gray-200 rounded mb-14" />

      {/* Values Grid */}
      <div className="grid grid-cols-1 md:grid-cols-3 gap-12">
        {[1, 2, 3].map((item) => (
          <div key={item} className="space-y-5">
            {/* Value Title */}
            <div className="h-6 w-32 bg-gray-200 rounded" />

            {/* Description Lines */}
            <div className="space-y-3">
              <div className="h-4 w-full bg-gray-200 rounded" />
              <div className="h-4 w-full bg-gray-200 rounded" />
              <div className="h-4 w-11/12 bg-gray-200 rounded" />
              <div className="h-4 w-10/12 bg-gray-200 rounded" />
              <div className="h-4 w-9/12 bg-gray-200 rounded" />
            </div>
          </div>
        ))}
      </div>
    </section>
  );
}
