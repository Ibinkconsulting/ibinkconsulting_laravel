import Container from "@/Common/Container";
import CardSkeleton from "@/Common/Skeleton/CardSkeleton";
import useGetInsightsBlogOptionQuery from "@/Hooks/InsightsOrBlogPageHooks/useGetInsightsBlogOptionQuery";
import React from "react";
import { Link } from "react-router-dom";

export default function BlogDetailsInterested() {


  // api hooks

  // api hooks for getting blogs
  const { insightsBlogOptionsQuery, isBlogLoading } =
    useGetInsightsBlogOptionQuery(0);
  const blogs = insightsBlogOptionsQuery?.data;

  return (
    <div className="w-full bg-white py-14 sm:py-20 text-dark">
      <Container>
        <h2 className="seasons-font text-3xl sm:text-4xl lg:text-5xl leading-snug lg:leading-14.5">
          You might also be interested in
        </h2>
        {/* Blog Cards */}
        {isBlogLoading ? (
          <CardSkeleton />
        ) : (
          <div>
            {blogs && blogs?.length > 0 ? (
              <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10 lg:gap-8 xl:gap-12 my-10">
                {blogs?.slice(0, 3)?.map((blog, idx) => (
                  <div
                    key={idx}
                    className={`bg-white overflow-hidden duration-300 ${
                      (idx + 1) % 3 === 0
                        ? ""
                        : "lg:pr-6 xl:pr-8 lg:border-r lg:border-dark"
                    }`}
                  >
                    {/* Image */}
                    <div className="relative h-64 sm:h-72 lg:h-80 overflow-hidden">
                      <img
                        src={blog?.image}
                        alt={blog?.title}
                        className="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                      />
                    </div>

                    {/* Content */}
                    <div className="py-4 sm:py-6">
                      <div className="text-base sm:text-lg mb-2 seasons-font">
                        {blog?.year}
                      </div>

                      <h3 className="text-lg sm:text-xl lg:text-[22px] font-semibold mb-3 leading-normal">
                        {blog?.title}
                      </h3>

                      <p
                        className="text-sm sm:text-base mb-6 leading-relaxed"
                        dangerouslySetInnerHTML={{ __html: blog?.description }}
                      ></p>

                      <Link
                        to={`/blog-details/${blog?.id}`}
                        state={"blog-details"}
                        className="text-white px-6 py-3 text-sm font-semibold bg-dark uppercase hover:opacity-80 transition duration-300 rounded"
                      >
                        Read Article
                      </Link>
                    </div>
                  </div>
                ))}
              </div>
            ) : (
              <div>
                <p className="text-dark text-2xl text-center">
                  No Articles Found!
                </p>
              </div>
            )}
          </div>
        )}
      </Container>
    </div>
  );
}
