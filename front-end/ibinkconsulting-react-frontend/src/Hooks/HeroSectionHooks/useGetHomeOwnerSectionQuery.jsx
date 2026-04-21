import about1 from "@/assets/Images/about1.png";

export default function useGetHomeOwnerSectionQuery() {
  const aboutOwnerSectionQuery = {
    data: {
      title: "Ibink Consulting",
      sub_description: "Ibink Consulting is a boutique real estate agency specializing in the luxury market of the Costa del Sol. We provide a bespoke service for international clients, ensuring a seamless experience from start to finish.",
      button_text: "Discover More",
      image: about1
    }
  };
  const isOwnerLoading = false;
  return { aboutOwnerSectionQuery, isOwnerLoading };
}
