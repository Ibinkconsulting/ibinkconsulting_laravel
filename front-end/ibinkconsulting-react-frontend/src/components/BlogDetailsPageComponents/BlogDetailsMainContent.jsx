import WhatsappSVG from "@/SVG/WhatsappSVG";
import { Mail, Phone } from "lucide-react";
import React from "react";
import user from "@/assets/Images/user.png";
import Container from "@/Common/Container";
// import { useTranslation } from "react-i18next";
import useGetBuyingPropertiesQuery from "@/Hooks/BuyPageBuyingPropertiesHooks/useGetBuyingPropertiesQuery";
import CommonPropertyCard from "@/Common/CommonPropertyCard";
import CardSkeleton from "@/Common/Skeleton/CardSkeleton";
import { useNavigate } from "react-router-dom";

const blogArticle = {
  year: 2026,
  title: "5 Common Mistakes When Selling a Home in Spain and How to Avoid",
  paragraphs: [
    {
      id: 1,
      text: `
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Nulla porttitor accumsan tincidunt.
      `,
    },
    {
      id: 2,
      text: `
        Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Proin eget tortor risus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi.
      `,
    },
  ],
  sections: [
    {
      id: 1,
      heading: "The Role of Placeholder Text in Design",
      content: [
        `
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Pellentesque in ipsum id orci porta dapibus. Sed porttitor lectus nibh.
        `,
        `
        Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Nulla quis lorem ut libero malesuada feugiat. Donec sollicitudin molestie malesuada. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Cras ultricies ligula sed magna dictum porta.
        `,
        `
        Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris.
        `,
      ],
    },
    {
      id: 2,
      heading: "Structure, Hierarchy, and Flow",
      content: [
        `
        Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
        `,
      ],
    },
    {
      id: 3,
      heading: "The Role of Placeholder Text in Design",
      content: [
        `
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Pellentesque in ipsum id orci porta dapibus. Sed porttitor lectus nibh.
        `,
        `
        Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Nulla quis lorem ut libero malesuada feugiat. Donec sollicitudin molestie malesuada. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Cras ultricies ligula sed magna dictum porta.
        `,
        `
        Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris.
        `,
      ],
    },
    {
      id: 4,
      heading: "Structure, Hierarchy, and Flow",
      content: [
        `
        Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
        `,
      ],
    },
  ],
};

export default function BlogDetailsMainContent() {
  // active cards data
  // const { t } = useTranslation();
  const navigate = useNavigate();
  const { buyingPropertiesQuery, isBuyingPropertiesLoading } =
    useGetBuyingPropertiesQuery();

  const properties = buyingPropertiesQuery?.data;
  return (
    <div>
      <Container>
        {/* details content*/}
        <div className="my-8 w-full grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-10 xl:gap-16 border-b-2 border-gray-500 pt-10 pb-10 md:pb-20">
          {/* left content */}
          <div className="lg:col-span-8 lg:pr-10 lg:border-r border-gray-500">
            <div className="">
              <div className="">
                {/* Year */}
                <h3 className="seasons-font text-dark text-[22px]">
                    {blogArticle?.year}
                  </h3>

                {/* Title */}
                <h1 className="max-w-2xl text-4xl font-semibold text-gray-800 leading-14 mt-3 mb-8">
                  {blogArticle?.title}
                </h1>

                {/* Main Paragraphs */}
                <div className="space-y-6 mb-10">
                  {blogArticle.paragraphs.map((para) => (
                    <p
                      key={para.id}
                      className="text-gray-700 leading-8 text-lg"
                      dangerouslySetInnerHTML={{ __html: para.text }}
                    />
                  ))}
                </div>

                {/* Sections */}
                {blogArticle.sections.map((section) => (
                  <div key={section.id} className="mb-10">
                    <h2 className="text-lg sm:text-xl xl:text-[22px] font-semibold text-dark mb-6">
                      {section.heading}
                    </h2>

                    <div className="space-y-6">
                      {section.content.map((item, index) => (
                        <p
                          key={index}
                          className="text-gray-700 leading-8 text-lg"
                          dangerouslySetInnerHTML={{ __html: item }}
                        />
                      ))}
                    </div>
                  </div>
                ))}
              </div>
            </div>
          </div>

          {/* =============================================================================================================== */}
          {/* right user details*/}
          {/* ============================================================================================================ */}
          <div className="lg:col-span-4 lg:sticky lg:top-34 lg:self-start">
            <div className="flex items-center gap-3 md:gap-4">
              <div className="w-16 h-16 md:w-20 md:h-20 rounded-full shadow-lg overflow-hidden shrink-0">
                <img src={user} alt="" className="w-full h-full object-cover" />
              </div>

              <div className="text-dark">
                <p className="seasons-font text-2xl md:text-4xl font-medium leading-tight md:leading-relaxed">
                  David Ibink
                </p>
                <p className="text-xs md:text-base font-medium leading-relaxed break-all">
                  david@ibinkrealestate.com
                </p>
                <p className="text-xs md:text-base font-medium leading-relaxed">
                  +34 000 00 000
                </p>
              </div>
            </div>

            <div className="py-4 md:py-6 flex flex-col sm:flex-row lg:flex-col xl:flex-row items-center justify-between gap-3 md:gap-5">
              <button className="w-full bg-dark text-white py-2 px-3 rounded-sm flex items-center justify-center gap-2 cursor-pointer hover:opacity-70 duration-300">
                <Phone className="w-3 h-3 md:w-4 md:h-4" />
                <p className="text-xs md:text-sm uppercase">Call</p>
              </button>

              {/* whatsapp */}
              <button className="w-full bg-dark text-white py-2 px-3 rounded-sm flex items-center justify-center gap-2 cursor-pointer hover:opacity-70 duration-300">
                <div className="w-4 h-4 md:w-5 md:h-5">
                  <WhatsappSVG />
                </div>
                <p className="text-xs md:text-sm uppercase">Whatsapp</p>
              </button>

              <button className="w-full bg-dark text-white py-2 px-3 rounded-sm flex items-center justify-center gap-2 cursor-pointer hover:opacity-70 duration-300">
                <Mail className="w-3 h-3 md:w-4 md:h-4" />
                <p className="text-xs md:text-sm uppercase">Email</p>
              </button>
            </div>

            <hr className="border border-gray-500 my-8" />

            {/* active cards */}
            {isBuyingPropertiesLoading ? (
              <CardSkeleton />
            ) : (
              <div className="mt-10">
                <h3 className="seasons-font text-[22px] md:text-2xl lg:text-[28px] text-dark">
                  Active Listings
                </h3>

                <div className="mt-6 grid grid-cols-1 gap-6 sm:gap-10 lg:gap-16">
                  {properties?.slice(0, 3)?.map((data, idx) => (
                    <div
                      key={idx}
                      onClick={() =>
                        navigate(`/buy-details/${data?.slug}`, {
                          state: "buy-details",
                        })
                      }
                      className="w-full bg-white overflow-hidden shadow-md font-sans cursor-pointer duration-300 ease-in-out"
                    >
                      {/* Image Section */}
                      <div className="relative w-full h-75">
                        <img
                          src={data?.thumbnail}
                          alt="Boutique Living With A View"
                          className="h-full w-full object-cover"
                        />
                      </div>

                      {/* Content Section */}
                      <div className="py-4 px-6">
                        <p className="text-sm md:text-base font-medium text-dark mb-1 mt-2">
                          {data?.location}
                        </p>

                        <h2 className="text-lg sm:text-xl xl:text-[22px] font-semibold text-dark mb-6">
                          {data?.title}
                        </h2>

                        <p className="text-base md:text-lg font-medium text-dark/90">
                          € {data?.price}
                        </p>
                      </div>
                    </div>
                  ))}
                </div>
              </div>
            )}
          </div>
        </div>
      </Container>
    </div>
  );
}
