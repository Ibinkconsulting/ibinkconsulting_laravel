export default function useGetSellPagePropertyChooseQuery() {
  const sellPagePropertyChooseQuery = {
    data: {
      main_text: "Why Property Owners Choose Ibink Real Estate",
      parts: [
        { id: 1, title: "Bespoke Service", description: "Our boutique approach ensures that every client gets the attention they deserve and isn't just a number." },
        { id: 2, title: "International Network", description: "We have strong connections in Northern Europe and the UK, giving your property global exposure." },
        { id: 3, title: "High-End Marketing", description: "From professional staging to 4K video tours, we present your property in its best possible light." },
        { id: 4, title: "Local Market Expertise", description: "Over a decade of experience in Marbella and the Golden Mile helps us price your property for success." },
        { id: 5, title: "Stress-Free Legal", description: "We work with top-tier lawyers to handle all the paperwork, ensuring a smooth and safe transaction." },
        { id: 6, title: "Transparent Results", description: "You stay informed at every stage of the sale, with real data and honest buyer feedback." }
      ],
      link_url: "/contact",
      button_text: "Book a Discovery Call"
    }
  };
  const isSellPagePropertyChooseLoading = false;
  return { sellPagePropertyChooseQuery, isSellPagePropertyChooseLoading };
}
