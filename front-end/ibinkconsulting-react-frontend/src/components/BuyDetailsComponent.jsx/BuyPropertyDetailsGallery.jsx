import React, { useState } from "react";
import BuyDetailsImageModal from "./BuyDetailsImageModal";
import Modal from "@/Common/Modal/Modal";
import { ChevronLast, ChevronLeft } from "lucide-react";
import Navbar from "@/Shared/Navbar";

export default function BuyPropertyDetailsGallery({
  showingAllImage,
  setIsModalOpen,
}) {
  const [isImageModalOpen, setIsImageModalOpen] = useState(false);

  const rows = [];
  let i = 0;
  const pattern = [2, 3, 1];
  while (i < showingAllImage?.length) {
    for (let p of pattern) {
      if (i >= showingAllImage?.length) break;
      rows.push(showingAllImage.slice(i, i + p));
      i = Number(i + p);
    }
  }
  return (
    <>
      <Modal>
        <div className="h-full overflow-y-auto">
          {/* <Navbar/> */}
          <div
            onClick={() => setIsModalOpen(false)}
            className="p-6 text-dark text-lg cursor-pointer flex items-center gap-3 relative z-99999"
          >
            <ChevronLeft />
            <p>Back</p>
          </div>

          <div className="p-6 mt-5">
            <div className="flex flex-col gap-4">
              {rows.map((row, idx) => (
                <div key={idx} className={`grid gap-4 grid-cols-${row.length}`}>
                  {row.map((img, i) => (
                    <div onClick={() => setIsImageModalOpen(true)} key={i}>
                      <img
                        src={img?.file_url}
                        alt="image"
                        className="w-full h-100 object-cover"
                      />
                    </div>
                  ))}
                </div>
              ))}
            </div>
          </div>
        </div>
      </Modal>

      {isImageModalOpen && (
        <BuyDetailsImageModal
          isModalOpen={isImageModalOpen}
          setIsModalOpen={setIsImageModalOpen}
          showingAllImage={showingAllImage}
        />
      )}
    </>
  );
}
