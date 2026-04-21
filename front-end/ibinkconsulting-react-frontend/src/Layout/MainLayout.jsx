import Footer from "@/Shared/Footer";
import Navbar from "@/Shared/Navbar";
import WhiteNavbar from "@/Shared/WhiteNavbar";
import React from "react";
import { FaWhatsapp } from "react-icons/fa6";
import { Outlet, ScrollRestoration } from "react-router-dom";

export default function MainLayout() {
  // const location = useLocation();
  // const pathName = location?.pathname;
  // const state = location?.state;

  return (
    <div className="text-white ">
      {/* {(pathName === "/masterclass" || state === 'buy-details') ? <WhiteNavbar /> : <Navbar />} */}
      <Navbar />
      <Outlet />

      <a
        href="https://wa.me/8801XXXXXXXXX"
        target="_blank"
        rel="noopener noreferrer"
        className="fixed bottom-5 right-5 bg-green-500 text-white px-4 py-3 rounded-full shadow-lg z-10 flex items-center gap-2"
      >
        <FaWhatsapp className="text-2xl" />
        <span className="hidden md:block">Chat on WhatsApp</span>
      </a>
      <Footer />

      <ScrollRestoration />
    </div>
  );
}
