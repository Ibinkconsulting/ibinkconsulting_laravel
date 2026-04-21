import properties2 from "@/assets/Images/properties2.png";

export default function useGetBuyPageBuyingPropertySection() {
  const buyPageBuyingPropertyQuery = {
    data: {
      title: "Our Handpicked Selection",
      description: "We carefully select every property based on its design, quality, and investment potential.",
      image: properties2
    }
  };
  const isBuyingPropertyLoading = false;
  return { buyPageBuyingPropertyQuery, isBuyingPropertyLoading };
}
