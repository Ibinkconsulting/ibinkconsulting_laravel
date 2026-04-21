import React from "react";
import blog1 from '@/assets/Images/blog1.jpg';
import blog2 from '@/assets/Images/blog2.jpg';
import blog3 from '@/assets/Images/blog3.png';
import blog4 from '@/assets/Images/blog4.png';
import blog5 from '@/assets/Images/blog5.png';
import blog6 from '@/assets/Images/blog6.png';
import blog7 from '@/assets/Images/blog7.png';
import blog8 from '@/assets/Images/blog8.png';

export default function useGetAboutPageCardContent() {
  const blogs = [
    {
      id: 1,
      category: "selling_property",
      year: 2026,
      title: "5 Common Mistakes When Selling a Home in Spain and How to Avoid",
      description:
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore.",
      image: blog1,
      slug: "common-mistakes-selling-home-spain",
    },
    {
      id: 2,
      category: "buying_property",
      year: 2026,
      title: "Hidden Costs When Buying a Property in Spain",
      description:
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore.",
      image: blog2,
      slug: "hidden-costs-buying-property-spain",
    },
    {
      id: 3,
      category: "lifestyle",
      year: 2026,
      title: "Why the Costa del Sol Continues to Attract International Buyers",
      description:
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore.",
      image: blog3,
      slug: "costa-del-sol-international-buyers",
    },
    {
      id: 4,
      category: "buying_property",
      year: 2026,
      title: "The Best Areas to Buy Property in the Costa del Sol",
      description:
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore.",
      image: blog4,
      slug: "costa-del-sol-international-buyers",
    },
    {
      id: 5,
      category: "selling_property",
      year: 2026,
      title: "Is Property in the Costa del Sol Still a Good Investment?",
      description:
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore.",
      image: blog5,
      slug: "costa-del-sol-international-buyers",
    },
    {
      id: 6,
      category: "lifestyle",
      year: 2026,
      title: "The Best Restaurants in Marbella, Costa del Sol",
      description:
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore.",
      image: blog6,
      slug: "costa-del-sol-international-buyers",
    },
    {
      id: 7,
      category: "lifestyle",
      year: 2026,
      title: "New Development in Estepona, Costa del Soll",
      description:
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore.",
      image: blog7,
      slug: "costa-del-sol-international-buyers",
    },
    {
      id: 8,
      category: "lifestyle",
      year: 2026,
      title: "Common Mistakes Foreign Buyers Make in Spain",
      description:
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore.",
      image: blog8,
      slug: "costa-del-sol-international-buyers",
    },
    
    {
      id: 9,
      category: "buying_property",
      year: 2026,
      title: "A step-by-step Guide for Buying Property in the Costa del So",
      description:
        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore.",
      image: blog3,
      slug: "costa-del-sol-international-buyers",
    },
  ];

  return {blogs};
}
