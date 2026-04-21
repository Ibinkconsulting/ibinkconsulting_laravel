import React from "react";

export default function Container({ children, className }) {
  return (
    <div className={`max-w-350 mx-auto px-4 w-full ${className}`}>
      {children}
    </div>
  );
}
