import comingVideo from "@/assets/Video/coming.mp4";

export default function useGetCommingSoonSectionQuery() {
  const homeComingSoonQuery = {
    data: {
      title: "New Developments Coming Soon",
      sub_title: "Explore the most exclusive new locations in Marbella and surrounding areas.",
      video: comingVideo
    }
  };
  const isComingLoading = false;
  return { homeComingSoonQuery, isComingLoading };
}
