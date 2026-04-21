import detailsMain from "@/assets/Images/detailsMain.png";

export default function useGetBuyPageCostConsiderSectionQuery() {
  const buyPageCostConsiderQuery = {
    data: {
      main_text: "Costs to Consider When Buying",
      description: "When buying property in Spain, it's essential to factor in approximately 10-12% on top of the purchase price for taxes and fees.",
      image: detailsMain,
      parts: [
        {
          key_title: "For New Builds",
          points: [
            "10% VAT (IVA)",
            "1.2% Stamp Duty (AJD)",
            "Notary and Land Registry fees (~1%)",
            "Legal fees (approx. 1% + VAT)"
          ]
        },
        {
          key_title: "For Resale Properties",
          points: [
            "7% Property Transfer Tax (ITP)",
            "Notary and Land Registry fees (~1%)",
            "Legal fees (approx. 1% + VAT)"
          ]
        }
      ]
    }
  };
  const isCostConsiderLoading = false;
  return { buyPageCostConsiderQuery, isCostConsiderLoading };
}
