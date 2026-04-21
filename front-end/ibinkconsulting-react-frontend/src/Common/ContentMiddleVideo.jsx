import React, { useRef, useState } from "react";
import Container from "@/Common/Container";
import { Link } from "react-router-dom";
import { useTranslation } from "react-i18next";

export default function ContentMiddleVideo({
  isComingLoading,
  videoUrl,
  title,
  subtitle,
  isLink,
}) {
  // const [isPlaying, setIsPlaying] = useState(true);
  const [isMuted, setIsMuted] = useState(true);
  const [progress, setProgress] = useState(0);
  const videoRef = useRef(null);
  const { t } = useTranslation();

  // const togglePlay = () => {
  //   if (!videoRef.current) return;

  //   if (isPlaying) {
  //     videoRef.current.pause();
  //   } else {
  //     videoRef.current.play();
  //   }
  //   setIsPlaying(!isPlaying);
  // };

  const handleTimeUpdate = () => {
    if (!videoRef.current) return;
    const value =
      (videoRef.current.currentTime / videoRef.current.duration) * 100;
    setProgress(value || 0);
  };

  const handleProgressClick = (e) => {
    if (!videoRef.current) return;
    const rect = e.currentTarget.getBoundingClientRect();
    const pos = (e.clientX - rect.left) / rect.width;
    videoRef.current.currentTime = pos * videoRef.current.duration;
  };

  const toggleMute = () => {
    if (!videoRef.current) return;
    videoRef.current.muted = !isMuted;
    setIsMuted(!isMuted);
  };

  return (
    <div className="w-full relative h-[40vh] sm:h-[50vh] lg:h-[60vh] xl:h-100 overflow-hidden">
      {isComingLoading ? (
        <div className="w-full h-full bg-gray-400/70 animate-pulse"></div>
      ) : (
        <video
          ref={videoRef}
          autoPlay
          muted
          loop
          playsInline
          className="absolute inset-0 w-full h-full object-cover"
          onTimeUpdate={handleTimeUpdate}
        >
          <source src={videoUrl} type="video/mp4" />
        </video>
      )}

      {/* Overlay */}
      <div className="absolute inset-0 bg-dark/55" />

      {/* Content */}
      <Container className="h-full">
        <div className="relative z-10 h-full flex flex-col items-center justify-center text-center px-4">
          <p
            className="uppercase text-sm sm:text-base lg:text-lg font-medium mb-2"
            dangerouslySetInnerHTML={{ __html: subtitle }}
          ></p>

          <p className="text-2xl sm:text-4xl lg:text-5xl seasons-font leading-tight">
            {title}
          </p>

          {isLink && (
            <Link
              to="#"
              className="mt-4 text-sm sm:text-base lg:text-lg underline"
            >
              {t("contentMiddleVideo.learnMore")}
            </Link>
          )}
        </div>
      </Container>

      {/* Mute */}
      {/* <div className="absolute bottom-14 sm:bottom-20 right-4 sm:right-8 z-20">
        <button
          onClick={toggleMute}
          className="w-9 h-9 sm:w-10 sm:h-10 bg-white/90 backdrop-blur rounded-full flex items-center justify-center hover:bg-white transition shadow-lg"
          title={isMuted ? "Unmute" : "Mute"}
        >
          {isMuted ? (
            <svg className="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
              <path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51C20.63 14.91 21 13.5 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06c1.38-.31 2.63-.95 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3z" />
            </svg>
          ) : (
            <svg className="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
              <path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02z" />
            </svg>
          )}
        </button>
      </div> */}

      {/* Progress */}
      {/* <div
        className="absolute bottom-6 sm:bottom-8 left-0 right-0 z-20 h-1 bg-dark cursor-pointer"
        onClick={handleProgressClick}
      >
        <div
          className="h-full bg-white transition-all"
          style={{ width: `${progress}%` }}
        />
      </div> */}
    </div>
  );
}
