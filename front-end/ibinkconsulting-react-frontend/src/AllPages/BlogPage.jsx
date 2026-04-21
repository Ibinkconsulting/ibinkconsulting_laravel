import BlogPageHeroSection from "@/components/BlogPageComponents/BlogPageHeroSection";
import BlogPagePropertiesSection from "@/components/BlogPageComponents/BlogPagePropertiesSection";
import React from "react";

export default function BlogPage() {
  return (
    <div className="text-[#0b1a29]">
      <BlogPageHeroSection />
      <BlogPagePropertiesSection/>
    </div>
  );
}
