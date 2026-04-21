export default function usePostNewsletterSubscriptionMutation({
  onSuccess,
  onError,
}) {
  const mutate = async (data) => {
    // Simulate successful submission
    const mockData = { success: true, message: "Thank you for subscribing!" };
    if (onSuccess) onSuccess(mockData);
  };

  return {
    mutate,
    isPending: false,
  };
}
