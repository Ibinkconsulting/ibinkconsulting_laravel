import React from "react";

export default function Modal({ children, className, setIsModalOpen }) {
  return (
    <>
      <div
        onClick={() => setIsModalOpen(false)}
        className="fixed h-screen inset-0 bg-white z-50 overflow-hidden"
      >
        <div
          onClick={(e) => e.stopPropagation()}
          className={`w-full h-full ${className || ""}`}
        >
          {children}
        </div>
      </div>
    </>
  );
}