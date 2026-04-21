export default function useGetAllCategoriesOption() {
  const allCategoriesQuery = {
    data: [
      { id: 1, name: "Market Trends", slug: "market-trends" },
      { id: 2, name: "Lifestyle", slug: "lifestyle" },
      { id: 3, name: "Buying Guide", slug: "buying-guide" }
    ]
  };
  const isCategoriesLoading = false;
  return { allCategoriesQuery, isCategoriesLoading };
}
