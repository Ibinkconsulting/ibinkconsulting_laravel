export default function useGetAboutPageValuesSection() {
  const aboutPageValueSectionQuery = {
    data: {
      title: "Our Values",
      values: [
        { id: 1, title: "Trust", description: "Building long-lasting relationships based on honesty." },
        { id: 2, title: "Excellence", description: "Providing superior service and results." },
        { id: 3, title: "Integrity", description: "Operating with the highest ethical standards." }
      ]
    }
  };
  const isAboutPageLoading = false;
  return { aboutPageValueSectionQuery, isAboutPageLoading };
}
