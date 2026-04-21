export default function usePostMasterClassMutation({ onSuccess, onError }) {
  const mutate = async (data) => {
    // Simulate successful submission
    const mockData = { success: true, message: "Masterclass registration successful!" };
    if (onSuccess) onSuccess(mockData);
  };

  return {
    mutate,
    isPending: false,
  };
}
