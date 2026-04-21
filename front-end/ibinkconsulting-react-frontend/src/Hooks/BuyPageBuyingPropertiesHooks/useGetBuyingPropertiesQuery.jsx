import properties1 from "@/assets/Images/properties1.png";
import properties2 from "@/assets/Images/properties2.png";
import properties3 from "@/assets/Images/properties3.png";

export default function useGetBuyingPropertiesQuery() {
  const buyingPropertiesQuery = {
    data: [
      {
        id: 1,
        location: "GOLDEN MILE, MARBELLA",
        title: "Modern Boutique Villa with Sea Views",
        thumbnail: properties1,
        photo: properties1, // adding this for backward compatibility with components using it
        bedrooms: "4",
        bathrooms: "4",
        area: "320",
        price: "2.850.000",
        slug: "modern-boutique-villa"
      },
      {
        id: 2,
        location: "ZAGALETA, BENAHAVIS",
        title: "Exceptional Luxury Estate",
        thumbnail: properties2,
        photo: properties2,
        bedrooms: "6",
        bathrooms: "7",
        area: "1.200",
        price: "12.500.000",
        slug: "exceptional-luxury-estate"
      },
      {
        id: 3,
        location: "SIERRA BLANCA, MARBELLA",
        title: "Exclusive Mediterranean Residence",
        thumbnail: properties3,
        photo: properties3,
        bedrooms: "5",
        bathrooms: "5",
        area: "850",
        price: "6.900.000",
        slug: "exclusive-mediterranean-residence"
      }
    ]
  };
  const isBuyingPropertiesLoading = false;
  return { buyingPropertiesQuery, isBuyingPropertiesLoading };
}
