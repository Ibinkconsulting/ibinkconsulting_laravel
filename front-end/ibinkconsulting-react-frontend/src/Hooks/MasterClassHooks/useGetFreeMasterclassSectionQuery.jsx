import newsVideo from "@/assets/Video/news.mp4";

export default function useGetFreeMasterclassSectionQuery() {
  const masterClassQuery = {
    data: {
      title: "Exclusive Investment Masterclass",
      sub_title: "JOIN OUR COMMUNITY",
      description: "Our masterclass provides in-depth insights into the Costa del Sol luxury property market, helping you make informed decisions on your next big investment.",
      button_text: "Request Access",
      video: newsVideo
    }
  };
  const isMasterClassLoading = false;
  return { masterClassQuery, isMasterClassLoading };
}
