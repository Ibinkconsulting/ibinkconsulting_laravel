import lion from "@/assets/Images/lion.png";

export default function useGetHomeBaerezPropertySectionQuery() {
  const homeBaerezPropertyQuery = {
    data: {
      logo: lion,
      title: "As exclusive partners of Baerz Property, we offer unparalleled access to luxury real estate in the Costa del Sol."
    }
  };
  const isBaerezLoading = false;
  return { homeBaerezPropertyQuery, isBaerezLoading };
}
