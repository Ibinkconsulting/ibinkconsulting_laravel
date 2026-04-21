export default function useGetBuyPageChallengingSectionQuery() {
  const buyPageChallengingQuery = {
    data: {
      main_text: "Common Challenges for Home Buyers",
      parts: [
        { id: 1, title: "Unseen Costs", description: "Not knowing the exact taxes, notary fees, and legal costs before buying a property." },
        { id: 2, title: "Property Sourcing", description: "Finding the best properties that are not always listed on the public portals." },
        { id: 3, title: "Local Market Complexity", description: "The Costa del Sol has many different sub-markets, and each requires a unique approach." },
        { id: 4, title: "Spanish Legal System", description: "Navigating the legal paperwork and residency issues can be daunting for international buyers." }
      ]
    }
  };
  const isChallengingLoading = false;
  return { buyPageChallengingQuery, isChallengingLoading };
}
