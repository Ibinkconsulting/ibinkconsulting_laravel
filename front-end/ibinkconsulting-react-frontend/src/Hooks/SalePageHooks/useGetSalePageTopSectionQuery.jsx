import saleHero from "@/assets/Images/saleHero.jpg";

export default function useGetSalePageTopSectionQuery() {
  const sellPageTopSectionQuery = {
    data: {
      title: "Sell Your Luxury Property in the Costa del Sol",
      sub_title: "Get expert marketing and a wide network of qualified international buyers.",
      image: saleHero
    }
  };
  const isSellPageTopSectionLoading = false;
  return { sellPageTopSectionQuery, isSellPageTopSectionLoading };
}
