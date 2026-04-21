import sellImage from "@/assets/Images/sellImage.jpg";

export default function useGetSellPageSellingPropertySectionQuery() {
  const sellPageSellingPropertyQuery = {
    data: {
      title: "Our Professional Selling Approach",
      description: "We use high-end photography, virtual tours, and targeted international marketing.",
      image: sellImage
    }
  };
  const isSellPageSellingPropertyLoading = false;
  return { sellPageSellingPropertyQuery, isSellPageSellingPropertyLoading };
}
