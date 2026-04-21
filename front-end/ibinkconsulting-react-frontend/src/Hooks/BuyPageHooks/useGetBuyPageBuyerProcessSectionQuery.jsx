export default function useGetBuyPageBuyerProcessSectionQuery() {
  const buyPageBuyerProcessQuery = {
    data: {
      main_text: "Our Seamless Buying Process",
      parts: [
        { id: 1, title: "Initial Consultation", description: "First, we define your dream property requirements, budget, and preferred locations." },
        { id: 2, title: "Curated Property Tour", description: "We arrange private viewings for only the finest properties that match your criteria." },
        { id: 3, title: "Legal & Due Diligence", description: "Our legal partners verify every document to ensure a risk-free investment." },
        { id: 4, title: "Strategic Negotiation", description: "We use our market knowledge to negotiate the best price and terms for you." },
        { id: 5, title: "Handover & Aftersales", description: "From signing at the notary to getting your keys, we are with you all the way." }
      ],
      link_url: "/contact",
      button_text: "Start Your Journey"
    }
  };
  const isBuyerProcessLoading = false;
  return { buyPageBuyerProcessQuery, isBuyerProcessLoading };
}
