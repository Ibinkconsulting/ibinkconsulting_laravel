import blog1 from "@/assets/Images/blog1.jpg";
import blog2 from "@/assets/Images/blog2.jpg";

export default function useGetInsightsBlogOptionQuery(id) {
  const insightsBlogOptionsQuery = {
    data: [
      {
        id: 1,
        title: "The Ultimate Guide to Buying Property in Marbella",
        description: "Everything you need to know about the local laws, taxes, and high-demand areas.",
        image: blog1,
        slug: "ultimate-guide-buying-marbella"
      },
      {
        id: 2,
        title: "Top 5 Mistakes to Avoid When Selling Your Luxury Villa",
        description: "How to prepare your home and choose the right agent to secure the best price.",
        image: blog2,
        slug: "selling-mistakes-avoid"
      }
    ]
  };
  const isBlogLoading = false;
  return { insightsBlogOptionsQuery, isBlogLoading };
}
