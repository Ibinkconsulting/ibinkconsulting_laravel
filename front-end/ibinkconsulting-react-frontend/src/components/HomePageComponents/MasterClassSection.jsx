import MacbookMockup from "@/Common/MacbookMockup";
import React from "react";
// import videoUrl from "@/assets/Video/news.mp4";
import { useForm } from "react-hook-form";
import Container from "@/Common/Container";
import { useTranslation } from "react-i18next";
import useGetFreeMasterclassSectionQuery from "@/Hooks/MasterClassHooks/useGetFreeMasterclassSectionQuery";
import FreeMasterclassSkeleton from "@/Common/Skeleton/FreeMasterclassSkeleton";
import usePostMasterClassMutation from "@/Hooks/MasterClassHooks/usePostMasterClassMutation";
import { toast } from "react-toastify";
import Loader from "../Loader/Loader";

export default function MasterClassSection({ padding }) {
  const { t } = useTranslation();
  // api hooks
  const { masterClassQuery, isMasterClassLoading } =
    useGetFreeMasterclassSectionQuery();
  const masterClassContent = masterClassQuery?.data;

  const { register, reset, handleSubmit } = useForm();

  // post api for request masterclass
  const { mutate: freeMasterclassMutation, isPending: isPostPending } =
    usePostMasterClassMutation({
      onSuccess: (data) => {
        if (data?.success) {
          reset();
          toast.success(data?.message);
        }
      },
      onError: (error) => {
        console.log(error);
      },
    });

  const onSubmit = (data) => {
    freeMasterclassMutation(data);
  };

  return (
    <div className={`w-full bg-white ${padding || "py-12 sm:py-16 lg:py-28"}`}>
      {isPostPending && <Loader />}
      <Container>
        {isMasterClassLoading ? (
          <FreeMasterclassSkeleton />
        ) : (
          <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-30 items-center">
            {/* Video - first on mobile */}
            <div className="order-1 lg:order-1 flex justify-center">
              <div className="w-full max-w-xl">
                <MacbookMockup videoUrl={masterClassContent?.video} />
              </div>
            </div>

            {/* Text - second on mobile */}
            <div className="order-2 lg:order-2 text-[#0b1a29] space-y-5 lg:w-2/3">
              <p
                className="uppercase text-sm sm:text-base font-medium"
                dangerouslySetInnerHTML={{
                  __html: masterClassContent?.sub_title,
                }}
              >
                {/* {t("masterClass.label")} */}
              </p>

              <h3 className="text-2xl sm:text-3xl lg:text-4xl seasons-font leading-tight">
                {/* {t("masterClass.heading")} */}
                {masterClassContent?.title}
              </h3>

              <p
                className="text-sm sm:text-base leading-relaxed"
                dangerouslySetInnerHTML={{
                  __html: masterClassContent?.description,
                }}
              >
                {/* {t("masterClass.description")} */}
              </p>

              <form
                onSubmit={handleSubmit(onSubmit)}
                className="w-full space-y-3"
              >
                <input
                  type="text"
                  {...register("name", { required: true })}
                  placeholder={t("masterClass.inputName")}
                  className="w-full text-sm bg-gray-200 py-2.5 px-4 rounded-lg placeholder:text-[#0b1a29] "
                />

                <input
                  type="email"
                  {...register("email", { required: true })}
                  placeholder={t("masterClass.inputEmail")}
                  className="w-full text-sm bg-gray-200 py-2.5 px-4 rounded-lg placeholder:text-[#0b1a29] "
                />

                <button
                  type="submit"
                  className="w-full mt-3 text-white bg-[#0b1a29] uppercase py-2.5 px-8 rounded-lg font-medium text-sm sm:text-base hover:opacity-60 transition-opacity"
                >
                  {masterClassContent?.button_text}
                  {/* {t("masterClass.submitBtn")} */}
                </button>
              </form>
            </div>
          </div>
        )}
      </Container>
    </div>
  );
}
