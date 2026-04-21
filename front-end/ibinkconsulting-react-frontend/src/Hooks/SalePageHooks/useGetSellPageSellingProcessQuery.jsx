export default function useGetSellPageSellingProcessQuery() {
  const sellPageSellingProcessQuery = {
    data: {
      main_text: "Our Professional Selling Process",
      sub_text: "We follow a structured approach to ensure your property is sold at the best possible price with minimum hassle.",
      parts: [
        { id: 1, title: "Property Valuation", description: "Our experts provide an accurate market valuation based on current trends and local data." },
        { id: 2, title: "High-End Marketing", description: "Professional photography, 3D tours, and placement on premium international portals." },
        { id: 3, title: "Qualified Viewings", description: "We vet every potential buyer to ensure only serious offers reach your table." },
        { id: 4, title: "Negotiation & Legal", description: "Securing the best deal and handling all Spanish legal requirements through our network." },
        { id: 5, title: "Successful Closing", description: "From the notary to the final signature, we are with you every step of the way." }
      ],
      button_text: "Sell With Ibink",
      link_url: "/contact"
    }
  };
  const isSellPageSellingProcessLoading = false;
  return { sellPageSellingProcessQuery, isSellPageSellingProcessLoading };
}
