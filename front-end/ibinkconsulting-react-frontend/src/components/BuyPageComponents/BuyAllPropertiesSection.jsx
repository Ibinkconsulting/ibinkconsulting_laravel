import CommonPropertyCard from "@/Common/CommonPropertyCard";
import Container from "@/Common/Container";
import useGetPropertiesForSaleData from "@/Hooks/HomePageHooks/useGetPropertiesForSaleData";
import LocationSVG from "@/SVG/LocationSVG";
import React, { useEffect, useState } from "react";
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectLabel,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";

export default function BuyAllPropertiesSection() {
  const { properties } = useGetPropertiesForSaleData();
  const [filterValue, setFilterValue] = useState();

  useEffect(() => {
  }, [filterValue]);

  return (
    <div className="bg-white py-16 md:py-25 w-full">
      <Container>
        <div className="text-dark w-full flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
          <h3 className="text-3xl md:text-5xl seasons-font md:leading-14.5">
            Properties for Sale
          </h3>

          <div className="flex items-center gap-6 flex-wrap">
            <div className="flex items-center gap-2 cursor-pointer">
              <span className="w-6 h-6">
                <LocationSVG />
              </span>
              <span className="text-base md:text-lg font-medium">MAP</span>
            </div>

            <Select onValueChange={(value) => setFilterValue(value)}>
              <SelectTrigger className="h-11 md:h-12 text-base md:text-lg font-medium uppercase border-none shadow-none px-0">
                <SelectValue placeholder="Filter" />
              </SelectTrigger>
              <SelectContent
                position="popper"
                side="bottom"
                align="start"
                className="text-dark bg-white"
              >
                <SelectGroup>
                  <SelectLabel>Filter</SelectLabel>
                  <SelectItem value="price">Price</SelectItem>
                  <SelectItem value="location">Location</SelectItem>
                </SelectGroup>
              </SelectContent>
            </Select>
          </div>
        </div>

        <div className="mt-12 md:mt-16 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-10 md:gap-16">
          {properties?.map((data, idx) => (
            <CommonPropertyCard
              key={idx}
              photo={data?.photo}
              title={data?.title}
              subTitle={data?.location}
              id={data?.id}
            />
          ))}
        </div>
      </Container>
    </div>
  );
}
