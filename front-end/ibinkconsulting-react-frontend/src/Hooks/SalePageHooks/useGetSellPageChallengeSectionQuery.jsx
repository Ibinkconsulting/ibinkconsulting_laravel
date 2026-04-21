export default function useGetSellPageChallengeSectionQuery() {
  const sellPageChallengeQuery = {
    data: {
      main_text: "Challenges When Selling Your Property",
      parts: [
        { id: 1, title: "Incorrect Valuation", description: "Pricing too high can leave your property on the market for too long, while pricing too low means losing potential value." },
        { id: 2, title: "Ineffective Marketing", description: "Standard portals aren't enough for luxury properties. You need targeted international reach." },
        { id: 3, title: "Complex Paperwork", description: "The Spanish legal system can be tricky. We ensure all certificates and taxes are handled properly." },
        { id: 4, title: "Buyer Qualifications", description: "Not every viewing leads to a sale. We focus on qualified international buyers with real intent." }
      ]
    }
  };
  const isSellPageChallengeLoading = false;
  return { sellPageChallengeQuery, isSellPageChallengeLoading };
}
