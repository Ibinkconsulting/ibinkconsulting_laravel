import heroVideo from "@/assets/Video/heroVideo.mp4";

export default function useGetTopHeroSection() {
  const getTopHeroSection = {
    data: {
      title: "The Smartest Way to Buy and Sell Luxury Property in the Costa del Sol",
      video: heroVideo
    }
  };
  const isTopHeroLoading = false;
  return { getTopHeroSection, isTopHeroLoading };
}
