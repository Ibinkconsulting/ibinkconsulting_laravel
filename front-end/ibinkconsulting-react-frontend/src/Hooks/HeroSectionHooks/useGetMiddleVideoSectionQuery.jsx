import homeCar from "@/assets/Images/homeCar.jpg";

export default function useGetMiddleVideoSectionQuery() {
  const homeMiddleVideoQuery = {
    data: {
      image: homeCar
    }
  };
  const isVideoLoading = false;
  return { homeMiddleVideoQuery, isVideoLoading };
}
