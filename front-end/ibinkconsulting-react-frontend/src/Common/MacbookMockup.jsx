import PauseSVG from "@/SVG/PauseSVG";
import PlaySVG from "@/SVG/PlaySVG";
import React, { useRef, useState } from "react";
import Container from "./Container";

export default function MacbookMockup({ videoUrl}) {
  const [isPlaying, setIsPlaying] = useState(true);
  const [isMuted, setIsMuted] = useState(true);
  const videoRef = useRef(null);
  const togglePlay = () => {
    if (videoRef.current) {
      if (isPlaying) {
        videoRef.current.pause();
      } else {
        videoRef.current.play();
      }
      setIsPlaying(!isPlaying);
    }
  };

  const toggleMute = () => {
    if (videoRef.current) {
      videoRef.current.muted = !isMuted;
      setIsMuted(!isMuted);
    }
  };
  return (
    <div className="max-w-200 px-[6%] py-[4%] relative">
      {/* Screen */}
      <div className="relative mx-auto w-[80%] rounded-[3%_3%_0.5%_0.5%/5%] bg-[#0b1a29]">
        {/* Screen Border */}
        <div className="relative pt-[67%] rounded-[3%_3%_0.5%_0.5%/5%] border-2 border-[#cacacc] shadow-[inset_0_0_0_1px_rgba(0,0,0,0.8),inset_0_0_1px_2px_rgba(255,255,255,0.3)]">
          {/* Viewport */}
          <div className="absolute inset-[4.3%_3.2%] bg-[#0b1a29] overflow-hidden">
            <video
              ref={videoRef}
              src={videoUrl} // <-- put your video here
              autoPlay
              muted
              loop
              playsInline
              className="h-full w-full object-cover"
            />
          </div>


          {/* <div className="absolute bottom-1/2 left-1/2 z-10 transform -transtale-y-1/2 -translate-x-1/2">
            <button
              onClick={togglePlay}
              className="w-10 h-10 bg-[#0b1a29]/50 backdrop-blur-[20px] rounded-full flex items-center justify-center hover:bg-[#0b1a29]/20 transition shadow-lg"
              title={isPlaying ? "Pause" : "Play"}
            >
              {isPlaying ? <PlaySVG /> : <PauseSVG />}
            </button>
          </div> */}

         

          {/* <div className="absolute bottom-8 right-8 z-10 flex gap-2 ">
            <button
              onClick={toggleMute}
              className="w-10 h-10 bg-[#0b1a29]/30 backdrop-blur rounded-full flex items-center justify-center hover:bg-white transition shadow-lg"
              title={isMuted ? "Unmute" : "Mute"}
            >
              {isMuted ? (
                <svg
                  className="w-4 h-4"
                  fill="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51C20.63 14.91 21 13.5 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06c1.38-.31 2.63-.95 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z" />
                </svg>
              ) : (
                <svg
                  className="w-4 h-4"
                  fill="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02z" />
                </svg>
              )}
            </button>
          </div> */}

          {/* Bottom shine */}
          <div className="absolute bottom-[0.75%] left-[0.5%] w-[99%] border-t border-white/15" />
        </div>
      </div>

      {/* Base */}
      {/* <div className="relative w-full pt-[3.3%] bg-linear-to-b from-[#eaeced] via-[#edeef0] via-55% to-[#262627] rounded-b-[10%_10%/50%]">
        <div className="absolute top-0 h-1/2 w-full bg-linear-to-r from-black/50 via-white/80 to-black/50 opacity-70" />
      </div> */}

      {/* BASE */}
      <div className="relative w-full">
        {/* base::before */}
        <div
          className="block w-full rounded-[0_0_10%_10%/0_0_50%_50%]"
          style={{
            paddingTop: "3.3%",
            background:
              "linear-gradient(#eaeced, #edeef0 55%, #fff 55%, #8a8b8f 56%, #999ba0 61%, #4B4B4F 84%, #262627 89%, rgba(0,0,0,.01) 98%)",
          }}
        />

        {/* base::after */}
        <div
          className="absolute top-0 w-full"
          style={{
            height: "53%",
            background:
              "linear-gradient(90deg, rgba(0,0,0,0.5), rgba(255,255,255,0.8) 0.5%, rgba(0,0,0,0.4) 3.3%, transparent 15%, rgba(255,255,255,0.8) 50%, transparent 85%, rgba(0,0,0,0.4) 96.7%, rgba(255,255,255,0.8) 99.5%, rgba(0,0,0,0.5) 100%)",
          }}
        />
      </div>

      {/* Notch */}
      <div className="relative z-10 mx-auto -mt-[3.5%] w-[14%] rounded-b-[7%_7%/95%] bg-[#ddd] shadow-[inset_-5px_-1px_3px_rgba(0,0,0,0.2),inset_5px_-1px_3px_rgba(0,0,0,0.2)] pt-[1.4%]" />
    </div>
  );
}
