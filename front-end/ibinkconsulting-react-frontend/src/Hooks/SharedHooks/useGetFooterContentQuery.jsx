import logoWhite from "@/assets/Images/logoWhiteHorizontal.png";

export default function useGetFooterContentQuery() {
  const footerContentQuery = {
    data: {
      white_logo: logoWhite,
      footer_text: "Your trusted partner for luxury real estate on the Costa del Sol. We guide our clients through every step of the real estate journey with expertise and personalized attention.",
      contact: {
        phone: "+34 951 123 456",
        email: "hello@ibinkconsulting.com"
      },
      copyright: "2026 Ibink Consulting. All rights reserved."
    }
  };
  const isFooterLoading = false;
  return { footerContentQuery, isFooterLoading };
}
