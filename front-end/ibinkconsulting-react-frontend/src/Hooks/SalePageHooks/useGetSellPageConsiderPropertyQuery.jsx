import details4 from "@/assets/Images/details4.png";

export default function useGetSellPageConsiderPropertyQuery() {
  const sellPageConsiderPropertyQuery = {
    data: {
      main_text: "Considerations When Selling in Spain",
      description: "Successfully selling a luxury property requires understanding the market and knowing the legalities.",
      image: details4,
      parts: [
        { 
          key_title: "Key Market Factors", 
          points: [
            "Current demand in Marbella and Golden Mile",
            "Comparative market analysis (CMA)",
            "Seasonal selling trends in the Costa del Sol"
          ] 
        },
        { 
          key_title: "Legal Requirements", 
          points: [
            "Energy Efficiency Certificate (CEE)",
            "Cedula de Habitabilidad",
            "IBI and Plusvalia taxes"
          ] 
        }
      ]
    }
  };
  const isSellPageConsiderPropertyLoading = false;
  return { sellPageConsiderPropertyQuery, isSellPageConsiderPropertyLoading };
}
