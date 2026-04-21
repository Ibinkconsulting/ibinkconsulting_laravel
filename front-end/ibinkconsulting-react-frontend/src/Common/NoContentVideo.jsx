import React from "react";

export default function NoContentVideo({ videoUrl, height }) {
  return (
    <div className={`w-full`} style={{height: `${height}`}}>
      <video
        autoPlay
        muted
        loop
        playsInline
        className="w-full h-full object-cover"
      >
        <source src={videoUrl} type="video/mp4" />
      </video>
    </div>
  );
}
