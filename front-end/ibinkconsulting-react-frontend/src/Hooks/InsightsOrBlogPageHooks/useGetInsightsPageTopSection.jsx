import blog8 from "@/assets/Images/blog8.png";

export default function useGetInsightsPageTopSection() {
  const insightsPageTopSectionQuery = {
    data: {
      title: "Ibink Insights",
      sub_title: "Stay informed with the latest trends in the Marbella real estate market.",
      image: blog8
    }
  };
  const isInsightsPageTopSectionLoading = false;
  return { insightsPageTopSectionQuery, isInsightsPageTopSectionLoading };
}
