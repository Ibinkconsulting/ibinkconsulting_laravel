import BuyPropertiesDetails from "@/components/BuyDetailsComponent.jsx/BuyPropertiesDetails";
import PropertiesForSaleSection from "@/components/HomePageComponents/PropertiesForSaleSection";
import React from "react";

export default function BuyDetailsPage() {
  return (
    <div>
      <BuyPropertiesDetails />
      <PropertiesForSaleSection title={'You might also like'} padding={'pb-10'} />
    </div>
  );
}
