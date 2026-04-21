import BlogDetailsHero from "@/components/BlogDetailsPageComponents/BlogDetailsHero";
import BlogDetailsInterested from "@/components/BlogDetailsPageComponents/BlogDetailsInterested";
import BlogDetailsMainContent from "@/components/BlogDetailsPageComponents/BlogDetailsMainContent";
import React from "react";

export default function BlogDetailsPage() {
  return (
    <div>
      <BlogDetailsHero />
      <BlogDetailsMainContent />
      <BlogDetailsInterested />
    </div>
  );
}
