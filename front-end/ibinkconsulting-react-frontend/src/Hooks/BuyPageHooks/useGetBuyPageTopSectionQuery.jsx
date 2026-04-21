import heroImg from "@/assets/Images/heroImg.png";

export default function useGetBuyPageTopSectionQuery() {
  const buyPageTopDataQuery = {
    data: {
      title: "Buying Property with Ibink Consulting",
      sub_title: "Explore the most exclusive luxury villas in Spain's Costa del Sol.",
      image: heroImg
    }
  };
  const isBuyPageTopDataLoading = false;
  return { buyPageTopDataQuery, isBuyPageTopDataLoading };
}
