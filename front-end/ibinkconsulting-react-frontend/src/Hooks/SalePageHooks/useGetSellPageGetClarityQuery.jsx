import about1 from "@/assets/Images/about1.png";

export default function useGetSellPageGetClarityQuery() {
  const sellPageGetClarityQuery = {
    data: {
      title: "Get Full Clarity",
      description: "Understand all the taxes, legalities, and costs associated with selling your luxury property in Spain.",
      video: "https://ibinkconsultingbackend.thesyndicates.team/public/media/2023/11/sell_video.mp4",
      image: about1,
      link_url: "/contact",
      button_text: "Get Full Clarity"
    }
  };
  const isSellPageGetClarityLoading = false;
  return { sellPageGetClarityQuery, isSellPageGetClarityLoading };
}
