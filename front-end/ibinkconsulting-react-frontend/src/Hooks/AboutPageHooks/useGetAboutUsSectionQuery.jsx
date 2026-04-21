export default function useGetAboutUsSectionQuery() {
  const aboutAboutUsQuery = {
    data: {
      title: "Our Story",
      description: "Ibink Consulting was founded with a mission to simplify luxury real estate in Spain.",
      image: "https://ibinkconsultingbackend.thesyndicates.team/public/media/2023/11/our_story.png"
    }
  };
  const isaboutAboutUsLoading = false;
  return { aboutAboutUsQuery, isaboutAboutUsLoading };
}
