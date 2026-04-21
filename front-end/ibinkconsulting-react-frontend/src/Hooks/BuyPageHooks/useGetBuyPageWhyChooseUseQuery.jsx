export default function useGetBuyPageWhyChooseUseQuery() {
  const buyPageWhyChooseQuery = {
    data: {
      main_text: "Why Buy Property with Ibink Consulting?",
      parts: [
        { id: 1, title: "Unmatched Expertise", description: "Our team has deep knowledge of the Costa del Sol luxury real estate market." },
        { id: 2, title: "Bespoke Sourcing", description: "We find properties that match your lifestyle and investment goals perfectly." },
        { id: 3, title: "Full Legal Support", description: "We collaborate with top-tier Spanish legal firms to handle all the paperwork." },
        { id: 4, title: "Transparent Pricing", description: "You get a clear breakdown of all costs and taxes related to your purchase." },
        { id: 5, title: "Global Network", description: "We have connections across Europe, ensuring you get the best opportunities." },
        { id: 6, title: "After-Sale Care", description: "Our service doesn't end at the notary; we help with relocation and management." }
      ]
    }
  };
  const isWhyChooseLoading = false;
  return { buyPageWhyChooseQuery, isWhyChooseLoading };
}
