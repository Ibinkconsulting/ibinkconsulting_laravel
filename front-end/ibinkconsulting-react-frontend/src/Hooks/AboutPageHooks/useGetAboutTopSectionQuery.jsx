import about1 from "@/assets/Images/about1.png";

export default function useGetAboutTopSectionQuery() {
  const aboutTopSectionQuery = {
    data: {
      title: "Ibink Consulting: Your Luxury Property Specialist",
      sub_title: "A boutique approach to real estate on the Costa del Sol.",
      image: about1
    }
  };
  const isAboutTopSectionLoading = false;
  return { aboutTopSectionQuery, isAboutTopSectionLoading };
}
