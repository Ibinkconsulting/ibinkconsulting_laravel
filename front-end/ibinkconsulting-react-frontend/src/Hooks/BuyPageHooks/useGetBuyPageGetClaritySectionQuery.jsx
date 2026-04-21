import blog5 from "@/assets/Images/blog5.png";

export default function useGetBuyPageGetClaritySectionQuery() {
  const buyPageGetClarityQuery = {
    data: {
      title: "Get Full Clarity on Your Property Purchase",
      description: "Don't let the Spanish legal system overwhelm you. We provide a clear roadmap for your luxury property acquisition.",
      image: blog5,
      link_url: "/contact",
      button_text: "Download Buyer's Guide"
    }
  };
  const isGetClarityLoading = false;
  return { buyPageGetClarityQuery, isGetClarityLoading };
}
