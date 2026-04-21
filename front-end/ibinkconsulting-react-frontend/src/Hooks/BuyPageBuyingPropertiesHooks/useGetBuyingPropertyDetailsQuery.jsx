import properties1 from "@/assets/Images/properties1.png";
import details1 from "@/assets/Images/details1.png";
import details from "@/assets/Images/details.png";
import details2 from "@/assets/Images/details2.png";
import details4 from "@/assets/Images/details4.png";
import plan1 from "@/assets/Images/plan1.png";
import plan2 from "@/assets/Images/plan2.png";

export default function useGetBuyingPropertyDetailsQuery() {
  const buyingPropertyDetailsQuery = {
    data: {
      id: 1,
      title: "Boutique Living With A View",
      description: "Experience the ultimate lifestyle in this one-of-a-kind property. Located in the heart of Marbella's Golden Mile, this villa offers unmatched views of the shoreline and high-end finishes throughout.",
      price: "2,250,000",
      location: "GOLDEN MILE, MARBELLA",
      thumbnail: {
        file_url: properties1
      },
      files: [
        { file_url: details },
        { file_url: details1 },
        { file_url: details2 },
        { file_url: details4 }
      ],
      amenities: [
        { id: 1, label: "Beach access", icon: "Waves" },
        { id: 2, label: "Wifi", icon: "Wifi" },
        { id: 3, label: "Pool", icon: "Droplets" },
        { id: 4, label: "Parking", icon: "Car" },
        { id: 5, label: "Air conditioning", icon: "Snowflake" }
      ],
      latitude: "36.5100",
      longitude: "-4.8833",
      ground_plan_url: plan1,
      first_plan_url: plan2
    }
  };
  const isBuyingPropertyDetailsLoading = false;
  return { buyingPropertyDetailsQuery, isBuyingPropertyDetailsLoading };
}
