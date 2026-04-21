import React from "react";
import "../Loader/loader.css";

export default function Loader() {
  return (
    <div className="w-full h-screen fixed inset-0 flex items-center justify-center backdrop-blur-[5px] z-999">
      <div className="circle-loader"></div>
    </div>
  );
}
