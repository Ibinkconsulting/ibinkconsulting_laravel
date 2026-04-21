import Modal from "@/Common/Modal/Modal";
import React, { useState } from "react";

//new carousel
import { cn } from "@/lib/utils";
import { Card, CardContent } from "@/components/ui/card";
import {
  Carousel,
  CarouselContent,
  CarouselItem,
  CarouselNext,
  CarouselPrevious,
} from "@/components/ui/carousel";

import WhiteNavbar from "@/Shared/WhiteNavbar";

export default function BuyDetailsImageModal({
  setIsModalOpen,
  showingAllImage,
}) {
  //new caorosol
  const [api, setApi] = useState();
  const [current, setCurrent] = React.useState(0);

  React.useEffect(() => {
    if (!api) {
      return;
    }

    setCurrent(api.selectedScrollSnap() + 1);

    api.on("select", () => {
      setCurrent(api.selectedScrollSnap() + 1);
    });
  }, [api]);

  return (
    <Modal className={"px-0 sm:p-6"} setIsModalOpen={setIsModalOpen}>
      <WhiteNavbar />

      <div className="w-full h-[calc(100vh-80px)] px-4 sm:px-6 py-4 sm:py-0 md:py-8 relative">
        {/* showing image carousol as per new message */}
        <div className="mx-auto md:h-[calc(75vh-80px)] w-full overflow-hidden ">
          <Carousel
            className="mx-0 sm:mx-2 w-full h-full"
            opts={{ loop: true }}
            setApi={setApi}
          >
            <CarouselContent className={'h-100! sm:h-120! md:h-full!'}>
              {showingAllImage?.map((data, index) => (
                <CarouselItem
                  className="basis-1/1 sm:basis-2/3 md:basis-4/6 w-full h-full"
                  key={index}
                >
                  <Card
                    className={cn(
                      "transition-all rounded-none! w-full h-full p-0! duration-500 ",
                      {
                        "opacity-30": index !== current - 1,
                      },
                    )}
                  >
                    <CardContent className="p-0! flex items-center w-full h-full justify-center">
                      <div className="w-full h-full mx-auto">
                        <img
                        id="property"
                          src={data?.file_url}
                          alt="property"
                          className="w-full h-full md:aspect-video"
                        />
                      </div>
                    </CardContent>
                  </Card>
                </CarouselItem>
              ))}
            </CarouselContent>
            <CarouselPrevious className="left-2 sm:left-4" />
            <CarouselNext className="right-2 sm:right-4" />
          </Carousel>
        </div>

        {/* Mobile Image Counter */}
        <div className="sm:hidden flex justify-center mt-4">
          <div className="bg-black/70 text-white px-4 py-2 rounded-full text-sm font-medium">
            {current}/{showingAllImage?.length}
          </div>
        </div>

        {/* for mobile device all images */}
        <div className="mt-4 md:hidden">
          <Carousel
            className="w-full h-full p-0! rounded-none!"
            opts={{
              align: "start",
            }}
          >
            <CarouselContent>
              {showingAllImage?.map((data, index) => (
                <CarouselItem className="basis-1/2 sm:3/5 lg:basis-1/5" key={index}>
                  <div className="p-0!">
                    <Card className={"p-0! h-full!"}>
                      <CardContent className="w-full h-full! p-0! rounded-0! flex aspect-square items-center justify-center">
                        <div
                          key={index}
                          className="w-full p-0! h-full cursor-pointer"
                        >
                          <img
                            src={data?.file_url}
                            alt="property"
                            className="w-full h-full object-cover object-center"
                            onClick={() => {
                              // Scroll carousel to the clicked image
                              if (api) {
                                api.scrollTo(index); // scrolls carousel to the selected index
                              }
                            }}
                          />
                        </div>
                      </CardContent>
                    </Card>
                  </div>
                </CarouselItem>
              ))}
            </CarouselContent>
            <CarouselPrevious />
            <CarouselNext />
          </Carousel>
        </div>

        {/* showing all image as per new message */}
        <div className="hidden md:flex flex-col sm:flex-row items-center w-full gap-4 mt-4 pb-4 overflow-x-auto h-[calc(28vh-80px)] bg-white">
          {showingAllImage?.map((data, index) => (
            <div key={index} className="w-full h-full relative cursor-pointer">
              <img
                src={data?.file_url}
                alt="property"
                className="w-full h-full object-cover object-center rounded-md"
                onClick={() => {
                  // Scroll carousel to the clicked image
                  if (api) {
                    api.scrollTo(index); // scrolls carousel to the selected index
                  }
                }}
              />
            </div>
          ))}
        </div>
      </div>
    </Modal>
  );
}

// h-[60vh] sm:h-full lg:h-120 xl:h-130 2xl:h-164
// sm:h-30 md:h-40 xl:h-42  2xl:h-full 2xl:max-h-70
