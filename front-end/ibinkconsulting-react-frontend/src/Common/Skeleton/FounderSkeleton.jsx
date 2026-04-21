export default function FounderSkeleton() {
  return (
    <section className="grid grid-cols-1 lg:grid-cols-2 min-h-[80vh] animate-pulse">
      {/* LEFT CONTENT */}
      <div className="flex flex-col justify-center px-6 md:px-16 space-y-6">
        {/* Logo */}
        <div className="h-16 w-16 bg-gray-200 rounded-full" />

        {/* Title */}
        <div className="space-y-3">
          <div className="h-8 w-3/4 bg-gray-200 rounded" />
          <div className="h-8 w-2/3 bg-gray-200 rounded" />
        </div>

        {/* Paragraph */}
        <div className="space-y-2">
          <div className="h-4 w-full bg-gray-200 rounded" />
          <div className="h-4 w-full bg-gray-200 rounded" />
          <div className="h-4 w-5/6 bg-gray-200 rounded" />
          <div className="h-4 w-4/6 bg-gray-200 rounded" />
        </div>

        {/* Button */}
        <div className="h-11 w-32 bg-gray-300 rounded-md mt-4" />
      </div>

      {/* RIGHT IMAGE */}
      <div className="hidden lg:block">
        <div className="h-full w-full bg-gray-200" />
      </div>
    </section>
  );
}
