import React, { useRef, useState } from "react";
import Container from "./Container";
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
  Sheet,
  SheetContent,
  SheetHeader,
  SheetTitle,
  SheetTrigger,
} from "@/components/ui/sheet";
import { useForm } from "react-hook-form";
import { useTranslation } from "react-i18next";

export default function CommonHero({
  title,
  subtitle,
  videoUrl,
  isImage,
  imageUrl,
  height,
  isHeroLoading,
}) {
  const [isPlaying, setIsPlaying] = useState(true);
  const [progress, setProgress] = useState();
  const videoRef = useRef(null);
  const { t } = useTranslation();

  const LOCATION_OPTIONS = [
    { label: t("hero.locations.ibiza"), value: "ibiza" },
    { label: t("hero.locations.mallorca"), value: "mallorca" },
    { label: t("hero.locations.sardinia"), value: "sardinia" },
  ];

  const TYPE_OPTIONS = [
    { label: t("hero.types.villa"), value: "villa" },
    { label: t("hero.types.apartment"), value: "apartment" },
    { label: t("hero.types.penthouse"), value: "penthouse" },
  ];

  const BEDROOM_OPTIONS = [
    { label: t("hero.bedrooms.1"), value: "1" },
    { label: t("hero.bedrooms.2"), value: "2" },
    { label: t("hero.bedrooms.3"), value: "3" },
    { label: t("hero.bedrooms.4"), value: "4" },
  ];

  const PRICE_OPTIONS = [
    { label: t("hero.prices.500"), value: "500" },
    { label: t("hero.prices.1000"), value: "1000" },
    { label: t("hero.prices.1000+"), value: "1000+" },
  ];

  const { handleSubmit, setValue } = useForm();

  const onSubmit = (data) => {
    console.log(data);
  };

  const togglePlay = () => {
    if (!videoRef.current) return;
    if (isPlaying) {
      videoRef.current.pause();
    } else {
      videoRef.current.play();
    }
    setIsPlaying(!isPlaying);
  };

  const handleTimeUpdate = () => {
    if (!videoRef.current) return;
    setProgress(
      (videoRef.current.currentTime / videoRef.current.duration) * 100,
    );
  };

  return (
    <div
      onClick={togglePlay}
      className={`relative ${height || "h-120 sm:h-140 xl:h-170"} w-full overflow-hidden`}
    >
      {isImage ? (
        <img src={imageUrl} alt="" className="absolute inset-0 w-full h-full" />
      ) : (
        <video
          ref={videoRef}
          autoPlay
          muted
          loop
          playsInline
          className="absolute inset-0 w-full h-full object-cover"
          onTimeUpdate={handleTimeUpdate}
        >
          <source src={videoUrl} type="video/mp4" />
        </video>
      )}

      <div className="absolute inset-0 bg-[#0b1a29]/55" />

      <Container className="h-full mx-auto">
        <div className="relative z-10 h-full flex flex-col justify-end pb-20 sm:pb-20 lg:pb-30">
          <h1 className="text-white text-[45px] xl:text-[55px] seasons-font mb-2 max-w-4xl leading-12 xl:leading-17">
            {isHeroLoading ? (
              <div className="animate-pulse max-w-3xl space-y-5">
                {/* Line 1 */}
                <div className="h-10 bg-gray-600/70 rounded-sm w-full animate-pulse" />

                {/* Line 2 */}
                <div className="h-10 bg-gray-600/70 rounded-sm w-5/6 animate-pulse" />
              </div>
            ) : (
              title
            )}
          </h1>

          {subtitle && (
            <p className="text-white text-xl font-light max-w-2xl">
              {subtitle}
            </p>
          )}

          {/* DESKTOP FORM */}
          <div onClick={(e) => e.stopPropagation()} className="py-8 hidden">
            <form
              onSubmit={handleSubmit(onSubmit)}
              className="bg-white/95 backdrop-blur p-4 grid grid-cols-5 gap-4"
            >
              <SelectBlock
                label={t("hero.filters.location")}
                name="location"
                setValue={setValue}
                options={LOCATION_OPTIONS}
              />

              <SelectBlock
                label={t("hero.filters.type")}
                name="type"
                setValue={setValue}
                options={TYPE_OPTIONS}
              />

              <SelectBlock
                label={t("hero.filters.bedrooms")}
                name="bedrooms"
                setValue={setValue}
                options={BEDROOM_OPTIONS}
              />

              <SelectBlock
                label={t("hero.filters.price")}
                name="price"
                setValue={setValue}
                options={PRICE_OPTIONS}
              />

              <button
                type="submit"
                className="bg-[#0b1a29] text-white px-6 py-3.5 rounded text-sm cursor-pointer active:scale-95 duration-300"
              >
                {t("hero.buttons.search")}
              </button>
            </form>
          </div>

          {/* MOBILE FILTER BUTTON */}
          <div onClick={(e) => e.stopPropagation()} className="hidden mt-6">
            <Sheet>
              <SheetTrigger asChild>
                <button className="w-full bg-white text-[#0b1a29] py-4 rounded font-medium">
                  {t("hero.buttons.filterProperties")}
                </button>
              </SheetTrigger>

              <SheetContent side="bottom" className="rounded-t-2xl">
                <SheetHeader>
                  <SheetTitle> {t("hero.buttons.filterProperties")}</SheetTitle>
                </SheetHeader>

                <form onSubmit={handleSubmit(onSubmit)} className=" space-y-4">
                  <SelectBlock
                    label="Location"
                    name="location"
                    setValue={setValue}
                    options={LOCATION_OPTIONS}
                  />

                  <SelectBlock
                    label="Type"
                    name="type"
                    setValue={setValue}
                    options={TYPE_OPTIONS}
                  />

                  <SelectBlock
                    label="Bedrooms"
                    name="bedrooms"
                    setValue={setValue}
                    options={BEDROOM_OPTIONS}
                  />

                  <SelectBlock
                    label="Price"
                    name="price"
                    setValue={setValue}
                    options={PRICE_OPTIONS}
                  />

                  <button
                    type="submit"
                    className="w-full bg-[#0b1a29] text-white py-4  cursor-pointer active:scale-95  duration-300"
                  >
                    {t("hero.buttons.applyFilter")}
                  </button>
                </form>
              </SheetContent>
            </Sheet>
          </div>
        </div>
      </Container>

      {!isImage && (
        <div className="absolute bottom-8 left-0 right-0 h-1 bg-gray-[#0b1a29] hidden">
          <div className="h-full bg-white" style={{ width: `${progress}%` }} />
        </div>
      )}
    </div>
  );
}

function SelectBlock({ label, name, setValue, options }) {
  return (
    <div className="w-full px-4">
      <Select onValueChange={(value) => setValue(name, value)}>
        <SelectTrigger
          className="
            w-full h-14!
            px-4
            flex items-center justify-between
            border-0
            shadow-none
            text-[#0b1a29]
            text-base font-medium uppercase
            focus-visible:ring-0
            border-r-3
            rounded-none
            border-gray-300
            cursor-pointer
          "
        >
          <SelectValue placeholder={label} />
        </SelectTrigger>

        <SelectContent
          position="popper"
          side="bottom"
          align="start"
          className="bg-white border border-gray-200 rounded-lg shadow-lg"
        >
          <SelectGroup>
            <SelectLabel className="px-3 py-2 text-xs text-[#0b1a29] uppercase">
              {label}
            </SelectLabel>

            {options.map((item) => (
              <SelectItem
                key={item.value}
                value={item.value}
                className="px-4 py-2 text-sm cursor-pointer focus:bg-gray-100"
              >
                {item.label}
              </SelectItem>
            ))}
          </SelectGroup>
        </SelectContent>
      </Select>
    </div>
  );
}
