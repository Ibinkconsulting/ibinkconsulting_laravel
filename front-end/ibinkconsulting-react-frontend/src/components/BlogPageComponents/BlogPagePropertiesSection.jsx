import Container from "@/Common/Container";
import CardSkeleton from "@/Common/Skeleton/CardSkeleton";
import TabsSkeleton from "@/Common/Skeleton/TabsSkeleton";
import useGetAllCategoriesOption from "@/Hooks/InsightsOrBlogPageHooks/useGetAllCategoriesOption";
import useGetInsightsBlogOptionQuery from "@/Hooks/InsightsOrBlogPageHooks/useGetInsightsBlogOptionQuery";
import React, { useState } from "react";
import { useTranslation } from "react-i18next";
import { Link } from "react-router-dom";

import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";

export default function BlogPagePropertiesSection() {
  const { t } = useTranslation();
  const [step, setStep] = useState(0);

  // api hooks
  const { insightsAllCategoriesQuery, isCategoryLoading } =
    useGetAllCategoriesOption();
  const categories = insightsAllCategoriesQuery?.data;
  console.log(categories);

  // api hooks for getting blogs
  const { insightsBlogOptionsQuery, isBlogLoading } =
    useGetInsightsBlogOptionQuery(step);
  const blogs = insightsBlogOptionsQuery?.data;

  return (
    <div className="w-full bg-white py-14 sm:py-20 text-dark">
      <Container>
        {/* Categories */}
        <div className="mb-14 sm:mb-24">
          <h5 className="text-xl sm:text-[26px] seasons-font mb-4">
            {t("blogPage.category")}:
          </h5>

          {/* Dropdown (mobile & tablet) */}
          <div className="block lg:hidden">
            {/* <select
              value={step}
              onChange={(e) => setStep(Number(e.target.value))}
              className="w-full border-2 border-dark py-3 px-4 text-sm font-semibold uppercase rounded-sm"
            >
              {categories?.map((cat) => (
                <option key={cat.id} value={cat.id}>
                  {cat.title}
                </option>
              ))}
            </select> */}

            <Select
              value={step ? step.toString() : undefined}
              onValueChange={(value) => setStep(Number(value))}
            >
              <SelectTrigger className="w-full border-2 border-dark py-6 px-4 text-sm font-semibold uppercase rounded-sm">
                <SelectValue placeholder="Select Category" />
              </SelectTrigger>

              <SelectContent>
                {categories?.map((cat) => (
                  <SelectItem key={cat.id} value={cat.id.toString()}>
                    {cat.title}
                  </SelectItem>
                ))}
              </SelectContent>
            </Select>
          </div>

          {/* Buttons (desktop only – unchanged style) */}
          {isCategoryLoading ? (
            <TabsSkeleton />
          ) : (
            <div className="hidden lg:grid grid-cols-6 lg:gap-4 xl:gap-8 my-6">
              <button
                type="button"
                onClick={() => setStep(0)}
                className={`w-full py-2 lg:px-3 xl:px-5 border-2 border-dark rounded-sm text-sm text-nowrap font-semibold uppercase cursor-pointer hover:opacity-90 duration-300 ${
                  step === 0 ? "bg-dark text-white" : ""
                }`}
              >
                View All
              </button>
              {categories?.map((cat) => (
                <button
                  key={cat?.id}
                  type="button"
                  onClick={() => setStep(cat?.id)}
                  className={`w-full py-2 lg:px-3 xl:px-5 border-2 border-dark rounded-sm text-sm text-nowrap font-semibold uppercase cursor-pointer hover:opacity-90 duration-300 ${
                    step === cat.id ? "bg-dark text-white" : ""
                  }`}
                >
                  {cat?.title}
                </button>
              ))}
            </div>
          )}
        </div>

        {/* Blog Cards */}
        {isBlogLoading ? (
          <CardSkeleton />
        ) : (
          <div>
            {blogs && blogs?.length > 0 ? (
              <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-10 lg:gap-8 xl:gap-12 my-10">
                {blogs?.map((blog, idx) => (
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

        {/* View More */}
        <div className="mt-10 sm:mt-24 flex justify-center">
          <Link to="#">
            <button className="text-white bg-dark py-3 px-8 rounded-lg font-medium text-base sm:text-lg hover:opacity-60 transition">
              {t("blogPage.viewMore")}
            </button>
          </Link>
        </div>
      </Container>
    </div>
  );
}
