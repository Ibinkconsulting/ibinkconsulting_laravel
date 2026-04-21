import about2 from "@/assets/Images/about2.png";
import logo from "@/assets/Images/logoSingle.png";

export default function useGetHomePartnerSectionQuery() {
  const aboutPartnerSectionQuery = {
    data: {
      logo: logo,
      title: "Strategic Partnerships",
      description: "Our strong relationships with local legal and financial experts ensure our clients receive top-tier advice and support throughout the buying or selling process.",
      image: about2
    }
  };
  const isPartnerLoading = false;
  return { aboutPartnerSectionQuery, isPartnerLoading };
}
