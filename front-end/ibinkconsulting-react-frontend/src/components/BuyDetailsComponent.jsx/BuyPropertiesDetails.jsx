import Container from "@/Common/Container";
import React, { useEffect, useState } from "react";
// import detailsMain from "@/assets/Images/detailsMain.png";
import {
  Baby,
  Bath,
  BedDouble,
  Building2,
  Calendar,
  Camera,
  Car,
  Coffee,
  CookingPot,
  Droplets,
  Dumbbell,
  Fan,
  Flame,
  Home,
  Laptop,
  LayoutGrid,
  LayoutPanelLeft,
  Lock,
  Mail,
  MapPin,
  PawPrint,
  Phone,
  Ruler,
  ShieldCheck,
  Snowflake,
  Sun,
  Tv,
  Utensils,
  WashingMachine,
  Waves,
  Wifi,
  Wind,
  X,
} from "lucide-react";
import LocationSVG from "@/SVG/LocationSVG";
// import details from "@/assets/Images/details.png";
// import details1 from "@/assets/Images/details1.png";
// import details2 from "@/assets/Images/details2.png";
// import details4 from "@/assets/Images/details4.png";
import user from "@/assets/Images/user.png";

import WhatsappSVG from "@/SVG/WhatsappSVG";
import { useForm } from "react-hook-form";
import HeartFillSVG from "@/SVG/HeartFillSVG";
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectLabel,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";
import {
  Carousel,
  CarouselContent,
  CarouselItem,
  CarouselNext,
  CarouselPrevious,
} from "@/components/ui/carousel";
import { useParams } from "react-router-dom";
import useGetBuyingPropertyDetailsQuery from "@/Hooks/BuyPageBuyingPropertiesHooks/useGetBuyingPropertyDetailsQuery";
import PropertyDetailsSkeleton from "@/Common/Skeleton/PropertyDetailsSkeleton";
import BuyDetailsImageModal from "./BuyDetailsImageModal";
import BuyPropertyDetailsGallery from "./BuyPropertyDetailsGallery";

const features = [
  { id: 1, label: "Beach access", icon: <Waves /> },
  { id: 2, label: "Wifi", icon: <Wifi /> },
  { id: 3, label: "Free parking on premises", icon: <Car /> },
  { id: 4, label: "TV", icon: <Tv /> },
  { id: 5, label: "Washer", icon: <WashingMachine /> },
  { id: 6, label: "Kitchen", icon: <CookingPot /> },
  { id: 7, label: "Dedicated workspace", icon: <Laptop /> },
  { id: 8, label: "Pool", icon: <Droplets /> },
  { id: 9, label: "Elevator", icon: <Droplets /> },
  { id: 10, label: "Carbon monoxide alarm", icon: <ShieldCheck /> },
  { id: 11, label: "Air conditioning", icon: <Snowflake /> },
  { id: 12, label: "Heating", icon: <Flame /> },
  { id: 13, label: "Gym", icon: <Dumbbell /> },
  { id: 14, label: "Hot tub", icon: <Bath /> },
  { id: 15, label: "Coffee maker", icon: <Coffee /> },
  { id: 16, label: "Dining area", icon: <Utensils /> },
  { id: 17, label: "Balcony", icon: <Wind /> },
  { id: 18, label: "Outdoor seating", icon: <Sun /> },
  { id: 19, label: "Extra pillows & blankets", icon: <BedDouble /> },
  { id: 20, label: "Great location", icon: <MapPin /> },
  { id: 21, label: "Security lock", icon: <Lock /> },
  { id: 22, label: "Ceiling fan", icon: <Fan /> },
  { id: 23, label: "Security cameras", icon: <Camera /> },
  { id: 24, label: "Pet friendly", icon: <PawPrint /> },
  { id: 25, label: "Child friendly", icon: <Baby /> },
  { id: 26, label: "Smoke alarm", icon: <ShieldCheck /> },
  { id: 27, label: "Iron", icon: <ShieldCheck /> },
  { id: 28, label: "Hair dryer", icon: <Wind /> },
  { id: 29, label: "First aid kit", icon: <ShieldCheck /> },
  { id: 30, label: "24/7 check-in", icon: <Lock /> },
];

// const property = [
//   {
//     icon: "📍",
//     field: "Location",
//     value: "Marbella",
//   },
//   {
//     icon: "📐",
//     field: "Land Area",
//     value: "455 sqm Land",
//   },
//   {
//     icon: "🏠",
//     field: "Floor Area",
//     value: "500 sqm Floor",
//   },
//   {
//     icon: "🛏️",
//     field: "Bedrooms",
//     value: "5 Beds",
//   },
//   {
//     icon: "🚿",
//     field: "Bathrooms",
//     value: "5 Baths",
//   },
//   {
//     icon: "🚗",
//     field: "Garages",
//     value: "2 Garages",
//   },
//   {
//     icon: "📊",
//     field: "Features",
//     value: "1 Open Space",
//   },
//   {
//     icon: "🏢",
//     field: "Type",
//     value: "Commercial",
//   },
//   {
//     icon: "📅",
//     field: "Year",
//     value: "2008",
//   },
// ];

const property = [
  {
    icon: <MapPin />,
    field: "Location",
    value: "Marbella",
  },
  {
    icon: <Ruler />,
    field: "Land Area",
    value: "455 sqm Land",
  },
  {
    icon: <Home />,
    field: "Floor Area",
    value: "500 sqm Floor",
  },
  {
    icon: <BedDouble />,
    field: "Bedrooms",
    value: "5 Beds",
  },
  {
    icon: <Bath />,
    field: "Bathrooms",
    value: "5 Baths",
  },
  {
    icon: <Car />,
    field: "Garages",
    value: "2 Garages",
  },
  {
    icon: <LayoutGrid />,
    field: "Features",
    value: "1 Open Space",
  },
  {
    icon: <Building2 />,
    field: "Type",
    value: "Commercial",
  },
  {
    icon: <Calendar />,
    field: "Year",
    value: "2008",
  },
];

export default function BuyPropertiesDetails() {
  // local hooks
  const params = useParams();
  const slug = params?.slug;

  // api hooks
  const { buyingPropertyDetailsQuery, isBuyingPropertyDetailsLoading } =
    useGetBuyingPropertyDetailsQuery(slug);
  const propertyDetails = buyingPropertyDetailsQuery?.data;

  const [shareOption, setShareOption] = useState();
  const [seeAll, setSeeAll] = useState(false);
  const [isModalOpen, setIsModalOpen] = useState(false); //for showing modal
  const [showingAllImage, setShowingAllImage] = useState();

  // const features = propertyDetails?.amenities;
  // console.log(features);

  const filter = features?.slice(0, 15);
  const [allFeatures, setAllFeatures] = useState(filter || []);

  useEffect(() => {
    if (seeAll) {
      setAllFeatures(features);
    } else {
      setAllFeatures(filter);
    }
  }, [seeAll]);

  // useEffect(() => {
  //   console.log(shareOption);
  // }, [shareOption]);

  const { register, handleSubmit } = useForm();
  const onSubmit = (data) => {
    console.log(data);
  };

  const totalFeatures = features?.length;

  const handleImageClick = () => {
    setIsModalOpen(true);
    const thumbnail = propertyDetails?.thumbnail;

    const allImages = [
      ...(thumbnail ? [thumbnail] : []),
      ...(propertyDetails?.files || []),
    ];

    setShowingAllImage(allImages);
  };

  return (
    <div className="bg-white w-full pt-20 md:pt-28 lg:pt-34 pb-10 text-dark">
      <Container>
        {isBuyingPropertyDetailsLoading ? (
          <PropertyDetailsSkeleton />
        ) : (
          <div>
            {/* photos field */}

            <div className="w-full grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-3">
              {/* left image */}
              <div
                onClick={() => handleImageClick()}
                className="w-full relative h-64 sm:h-80 md:h-auto"
              >
                <img
                  src={propertyDetails?.thumbnail?.file_url}
                  alt=""
                  className="w-full h-full object-cover"
                />

                {/* Dark Overlay */}
                <div className="absolute inset-0 bg-dark/15" />

                <div className="absolute bottom-3 left-3 md:bottom-5 md:left-4">
                  <div className="flex items-center gap-2 md:gap-4 flex-wrap">
                    {/* photos */}
                    <div className="py-1 md:py-1.5 px-3 md:px-5 rounded-2xl bg-white/80 text-dark uppercase text-xs md:text-base flex items-center gap-2 md:gap-3">
                      <Camera className="w-4 h-4 md:w-5 md:h-5 text-dark" />
                      <p className="whitespace-nowrap">
                        {propertyDetails?.files?.length} Photos
                      </p>
                    </div>

                    {/* location */}
                    <div className="py-1 md:py-1.5 px-3 md:px-5 rounded-2xl bg-white/80 text-dark uppercase text-xs md:text-base flex items-center gap-2 md:gap-3">
                      <div className="w-4 h-4 md:w-6 md:h-6 flex items-center justify-center shrink-0">
                        <MapPin className="block text-dark" />
                      </div>
                      <p className="whitespace-nowrap">Location</p>
                    </div>

                    {/* floorplan */}
                    <div className="py-1 md:py-1.5 px-3 md:px-5 rounded-2xl bg-white/80 text-dark uppercase text-xs md:text-base flex items-center gap-2 md:gap-3">
                      <LayoutPanelLeft className="w-4 h-4 md:w-6 md:h-6 text-dark" />
                      <p className="whitespace-nowrap">Floorplan</p>
                    </div>
                  </div>
                </div>
              </div>

              {/* right image */}
              <div
                onClick={() => handleImageClick()}
                className="w-full grid grid-cols-2 gap-2 md:gap-3"
              >
                {propertyDetails?.files?.map((photo, idx) => (
                  <div key={idx} className="w-full h-32 sm:h-40 md:h-auto">
                    <img
                      src={photo?.file_url}
                      alt=""
                      className="w-full h-full object-cover"
                    />
                  </div>
                ))}
              </div>
            </div>

            {/* about */}
            <div className="py-6 md:py-10 space-y-1 text-dark">
              <p className="uppercase tracking-wide text-xs md:text-sm">
                {propertyDetails?.location}
              </p>
              <p className="text-lg md:text-2xl font-medium tracking-wide uppercase leading-relaxed">
                {propertyDetails?.title}
              </p>
              <p className="text-base md:text-lg tracking-wide">
                € {propertyDetails?.price}
              </p>
            </div>

            <hr className="border border-gray-300" />

            {/* details content*/}
            <div className="my-8 md:my-14 w-full grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-10 border-b border-gray-300 pb-10 md:pb-20">
              {/* left content */}
              <div className="lg:col-span-8 lg:pr-10 lg:border-r border-gray-300">
                {/* property value */}
                <div className="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-4">
                  {property?.map((data, idx) => (
                    <div
                      key={idx}
                      className="text-sm md:text-base font-medium flex items-center gap-2"
                    >
                      <p>{data?.icon}</p>
                      <p>{data?.value}</p>
                    </div>
                  ))}
                </div>

                <hr className="my-6 md:my-10 border border-gray-300" />

                {/* save & share */}
                <div className="flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-12">
                  <div className="flex items-center gap-2 text-base md:text-lg font-medium">
                    <div className="w-5 h-5 md:w-6 md:h-6">
                      <HeartFillSVG />
                    </div>
                    <p>Save This Property</p>
                  </div>

                  <div className="w-full sm:w-auto">
                    <Select
                      onValueChange={(value) => setShareOption("share", value)}
                    >
                      <SelectTrigger className="w-full sm:w-60 flex items-center text-base md:text-lg font-medium shadow-none border-0 rounded-none placeholder:text-dark!">
                        <SelectValue placeholder="Share This Property" />
                      </SelectTrigger>
                      <SelectContent
                        position="popper"
                        side="bottom"
                        align="start"
                        className={"text-dark bg-white"}
                      >
                        <SelectGroup>
                          <SelectLabel>Share this property</SelectLabel>
                          <SelectItem value="usa">USA</SelectItem>
                          <SelectItem value="spain">Spain</SelectItem>
                          <SelectItem value="netherland">Netherland</SelectItem>
                        </SelectGroup>
                      </SelectContent>
                    </Select>
                  </div>
                </div>

                <hr className="my-6 md:my-10 border border-gray-300" />

                <div className="text-sm md:text-base font-medium leading-relaxed space-y-4 md:space-y-5">
                  <p
                    dangerouslySetInnerHTML={{
                      __html: propertyDetails?.description,
                    }}
                  />
                </div>

                <hr className="my-6 md:my-10 border border-gray-300" />

                {/* amenities */}
                <div>
                  <p className="text-2xl md:text-4xl seasons-font leading-relaxed mb-5 md:mb-7">
                    Amenities
                  </p>
                  <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                    {allFeatures?.map((data, idx) => (
                      <div
                        key={idx}
                        className="flex items-center gap-2 md:gap-3 text-sm md:text-base"
                      >
                        <div className="w-5 h-5 md:w-6 md:h-6 flex-shrink-0">
                          {/* <p dangerouslySetInnerHTML={{ __html: data?.icon }} /> */}
                          {data?.icon}
                        </div>
                        <p>{data?.label}</p>
                      </div>
                    ))}
                  </div>

                  {filter?.length > 15 && (
                    <button
                      onClick={() => setSeeAll(!seeAll)}
                      className="border-2 border-dark font-medium py-2 px-4 rounded-lg my-6 md:my-10 cursor-pointer hover:bg-gray-100 duration-300 ease-in-out text-sm md:text-base w-full sm:w-auto"
                    >
                      {seeAll
                        ? "See Less"
                        : `Show All ${totalFeatures} Amenities`}
                    </button>
                  )}
                </div>

                <hr className="my-6 md:my-10 border border-gray-300" />

                {/* google map */}
                <div>
                  <p className="text-2xl md:text-4xl seasons-font leading-relaxed mb-5 md:mb-7">
                    Property Location
                  </p>

                  <div>
                    <div className="mt-6 md:mt-10">
                      <iframe
                        // src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d58417.4721902469!2d90.4036352!3d23.7797376!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1752899001945!5m2!1sen!2sbd"
                        src={`https://www.google.com/maps/embed?q=${propertyDetails?.latitude},${propertyDetails?.longitude}&z-15output=embed`}
                        height="300"
                        allowFullScreen=""
                        loading="lazy"
                        referrerPolicy="no-referrer-when-downgrade"
                        className="w-full rounded-2xl md:rounded-4xl md:h-95"
                      ></iframe>
                    </div>
                  </div>
                </div>

                <hr className="my-6 md:my-10 border border-gray-300" />

                {/* floor plan */}
                <div>
                  <p className="text-2xl md:text-4xl seasons-font leading-relaxed mb-5 md:mb-7">
                    Floorplan
                  </p>

                  <div className="w-full grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-5">
                    <div className="space-y-1 md:space-y-2">
                      <div className="w-full h-48 sm:h-56 md:h-65">
                        <img
                          src={propertyDetails?.ground_plan_url}
                          alt="plan1"
                          className="w-full h-full object-cover"
                        />
                      </div>
                      <p className="text-sm md:text-base">Ground Floor</p>
                    </div>

                    <div className="space-y-1 md:space-y-2">
                      <div className="w-full h-48 sm:h-56 md:h-65">
                        <img
                          src={propertyDetails?.first_plan_url}
                          alt="plan2"
                          className="w-full h-full object-cover"
                        />
                      </div>
                      <p className="text-sm md:text-base">1st Floor</p>
                    </div>
                  </div>
                </div>
              </div>

              {/* =============================================================================================================== */}
              {/* right user details*/}
              {/* ============================================================================================================ */}
              <div className="lg:col-span-4 lg:sticky lg:top-34 lg:self-start">
                <div className="flex items-center gap-3 md:gap-4">
                  <div className="w-16 h-16 md:w-20 md:h-20 rounded-full shadow-lg overflow-hidden flex-shrink-0">
                    <img
                      src={user}
                      alt=""
                      className="w-full h-full object-cover"
                    />
                  </div>

                  <div>
                    <p className="text-2xl md:text-4xl font-medium leading-tight md:leading-relaxed">
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
                  <button className="w-full bg-dark text-white py-2 px-3 md:px-4 rounded-sm flex items-center justify-center gap-2 cursor-pointer hover:opacity-70 duration-300">
                    <Phone className="w-3 h-3 md:w-4 md:h-4" />
                    <p className="text-xs md:text-sm uppercase">Call</p>
                  </button>

                  {/* whatsapp */}
                  <button className="w-full bg-dark text-white py-2 px-3 md:px-4 rounded-sm flex items-center justify-center gap-2 cursor-pointer hover:opacity-70 duration-300">
                    <div className="w-4 h-4 md:w-5 md:h-5">
                      <WhatsappSVG />
                    </div>
                    <p className="text-xs md:text-sm uppercase">Whatsapp</p>
                  </button>

                  <button className="w-full bg-dark text-white py-2 px-3 md:px-4 rounded-sm flex items-center justify-center gap-2 cursor-pointer hover:opacity-70 duration-300">
                    <Mail className="w-3 h-3 md:w-4 md:h-4" />
                    <p className="text-xs md:text-sm uppercase">Email</p>
                  </button>
                </div>

                <hr className="border border-gray-300 my-3" />

                <form
                  onSubmit={handleSubmit(onSubmit)}
                  className="mt-6 md:mt-10 space-y-3"
                >
                  <p className="text-xl md:text-[28px] font-medium mb-4 md:mb-6">
                    Get In Touch
                  </p>

                  <input
                    type="text"
                    {...register("name", { required: true })}
                    placeholder="Name"
                    className="border border-gray-400 py-2 px-3 md:px-4 rounded-sm w-full text-sm md:text-base"
                  />

                  <input
                    type="email"
                    {...register("email", { required: true })}
                    placeholder="Email"
                    className="border border-gray-400 py-2 px-3 md:px-4 rounded-sm w-full text-sm md:text-base"
                  />
                  <input
                    type="number"
                    {...register("phone", { required: true })}
                    placeholder="Phone"
                    className="border border-gray-400 py-2 px-3 md:px-4 rounded-sm w-full text-sm md:text-base"
                  />

                  <button
                    type="submit"
                    className="bg-dark mt-2 text-white py-2 px-4 w-full text-center font-medium rounded-sm cursor-pointer hover:opacity-80 duration-300 text-sm md:text-base"
                  >
                    SEND
                  </button>
                </form>
              </div>
            </div>
          </div>
        )}

        {isModalOpen && (
          <BuyPropertyDetailsGallery
            setIsModalOpen={setIsModalOpen}
            showingAllImage={showingAllImage}
          />
        )}
      </Container>
    </div>
  );
}
