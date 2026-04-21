import Container from "@/Common/Container";
import React from "react";
import { useForm } from "react-hook-form";
import certified from "@/assets/Images/ibink.png";
// import logo from "@/assets/Images/logo.png";
import { Mail, Phone } from "lucide-react";
import { useTranslation } from "react-i18next";
import useGetFooterContentQuery from "@/Hooks/SharedHooks/useGetFooterContentQuery";
import usePostNewsletterSubscriptionMutation from "@/Hooks/SharedHooks/usePostNewsletterSubscriptionMutation";
import { toast } from "react-toastify";
import Loader from "@/components/Loader/Loader";

// flags
import flagUsa from "@/assets/Images/flagUsa.png";
import flagSpain from "@/assets/Images/flagSpain.png";
import flagNetherlands from "@/assets/Images/flagNetherlands.png";

const languages = [
  {
    name: "English",
    code: "en",
    flag: flagUsa,
  },
  {
    name: "Spain",
    code: "es",
    flag: flagSpain,
  },
  {
    name: "Nederlands",
    code: "nl",
    flag: flagNetherlands,
  },
];

export default function Footer() {
  const { i18n } = useTranslation();
  const { register, reset, handleSubmit } = useForm();

  // api hooks
  const { footerContentQuery, isFooterLoading } = useGetFooterContentQuery();
  const footerContent = footerContentQuery?.data;

  // api for newsletter
  const { mutate: newsletterSubscriptionMutation, isPending: isPostPending } =
    usePostNewsletterSubscriptionMutation({
      onSuccess: (data) => {
        if (data?.success) {
          reset();
          toast.success(data?.message);
        }
      },
      onError: (error) => {
        console.log(error);
      },
    });

  const onSubmit = (data) => {
    newsletterSubscriptionMutation(data);
  };

  return (
    <footer className="bg-dark text-white py-8 md:py-12 lg:py-20">
      {isFooterLoading ? (
        <Container className="px-6 py-16">
          {/* Top section */}
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">
            {/* Brand */}
            <div className="space-y-4">
              <div className="h-8 w-40 bg-gray-600 animate-pulse" />
              <div className="h-4 w-full bg-gray-600 animate-pulse" />
              <div className="h-4 w-[80%] bg-gray-600 animate-pulse" />
              <div className="h-4 w-40 bg-gray-600 animate-pulse mt-6" />
              <div className="h-4 w-48 bg-gray-600 animate-pulse" />
            </div>

            {/* Newsletter */}
            <div className="space-y-4 lg:col-span-2">
              <div className="h-5 w-60 bg-gray-600 animate-pulse" />
              <div className="h-10 w-full bg-gray-600 animate-pulse rounded" />
              <div className="h-10 w-full bg-gray-600 animate-pulse rounded" />
              <div className="h-10 w-40 bg-gray-500 animate-pulse rounded" />
            </div>

            {/* Menu */}
            <div className="space-y-3">
              <div className="h-5 w-24 bg-gray-600 animate-pulse" />
              {[1, 2, 3, 4, 5].map((i) => (
                <div key={i} className="h-4 w-24 bg-gray-600 animate-pulse" />
              ))}
            </div>

            {/* Connect + Certified */}
            <div className="space-y-6">
              <div className="space-y-3">
                <div className="h-5 w-28 bg-gray-600 animate-pulse" />
                <div className="h-4 w-28 bg-gray-600 animate-pulse" />
                <div className="h-4 w-28 bg-gray-600 animate-pulse" />
                <div className="h-4 w-28 bg-gray-600 animate-pulse" />
              </div>

              <div className="h-10 w-24 bg-gray-600 animate-pulse" />
            </div>
          </div>

          {/* Divider */}
          <div className="h-px bg-gray-600 my-12 animate-pulse" />

          {/* Bottom bar */}
          <div className="flex flex-col md:flex-row justify-between items-center gap-4">
            <div className="h-4 w-48 bg-gray-600 animate-pulse" />

            <div className="flex items-center gap-4">
              <div className="h-6 w-6 rounded-full bg-gray-600 animate-pulse" />
              <div className="h-6 w-6 rounded-full bg-gray-600 animate-pulse" />
              <div className="h-6 w-6 rounded-full bg-gray-600 animate-pulse" />
              <div className="h-4 w-64 bg-gray-600 animate-pulse ml-4" />
            </div>
          </div>
        </Container>
      ) : (
        <Container>
          {isPostPending && <Loader />}
          <div className="flex flex-col lg:flex-row lg:justify-between gap-8 lg:gap-12 mb-8 md:mb-12">
            {/* Left - Logo and Info */}
            <div className="lg:w-80 xl:w-84">
              <div className="mb-6">
                <div className="w-36 xl:w-40 h-auto">
                  <img
                    src={footerContent?.white_logo}
                    alt=""
                    className="w-full h-full object-cover"
                  />
                </div>
              </div>
              <p className="text-sm md:text-base mb-6 md:mb-8">
                {footerContent?.footer_text}
              </p>
              <div className="space-y-4 text-sm">
                <div className="flex items-center gap-2 leading-5.5">
                  <span>
                    <Phone className="w-5 h-5" />
                  </span>
                  <span>{footerContent?.contact?.phone}</span>
                </div>
                <div className="flex items-center gap-2 leading-5.5">
                  <span>
                    <Mail className="w-5 h-5" />
                  </span>
                  <span className="break-all">
                    {footerContent?.contact?.email}
                  </span>
                </div>
              </div>
            </div>

            {/* Newsletter */}
            <div className="lg:w-80">
              <h3 className="font-semibold mb-4 tracking-wide">
                SIGN UP FOR OUR NEWSLETTER
              </h3>
              <div className="space-y-3">
                <input
                  type="text"
                  {...register("name", { required: true })}
                  name="name"
                  placeholder="Name"
                  className="w-full px-4 py-2.5 rounded text-sm border border-white/60 bg-transparent text-white placeholder:text-white/70 focus:outline-none focus:border-white"
                />
                <input
                  type="email"
                  {...register("email", { required: true })}
                  name="email"
                  placeholder="Email"
                  className="w-full px-4 py-2.5 rounded text-sm border border-white/70 bg-transparent text-white placeholder:text-white/70 focus:outline-none focus:border-white"
                />
                <button
                  type="button"
                  onClick={handleSubmit(onSubmit)}
                  className="w-full bg-white text-gray-900 px-4 py-2.5 rounded font-medium hover:bg-gray-100 transition text-sm"
                >
                  SIGN UP
                </button>
              </div>
            </div>

            {/* Menu */}
            <div>
              <h3 className="font-semibold mb-4 tracking-wide text-lg">MENU</h3>
              <ul className="space-y-2 text-base">
                <li>
                  <a
                    href="#buy"
                    className="text-gray-200 hover:text-white transition"
                  >
                    Buy
                  </a>
                </li>
                <li>
                  <a
                    href="#sell"
                    className="text-gray-200 hover:text-white transition"
                  >
                    Sell
                  </a>
                </li>
                <li>
                  <a
                    href="#masterclass"
                    className="text-gray-200 hover:text-white transition"
                  >
                    Masterclass
                  </a>
                </li>
                <li>
                  <a
                    href="#about"
                    className="text-gray-200 hover:text-white transition"
                  >
                    About
                  </a>
                </li>
                <li>
                  <a
                    href="#contact"
                    className="text-gray-200 hover:text-white transition"
                  >
                    Contact
                  </a>
                </li>
              </ul>
            </div>

            {/* Connect */}
            <div>
              <h3 className="font-semibold mb-4 tracking-wide text-lg">
                CONNECT
              </h3>
              <ul className="space-y-2 text-base">
                <li>
                  <a
                    href="#instagram"
                    className="text-gray-200 hover:text-white transition"
                  >
                    Instagram
                  </a>
                </li>
                <li>
                  <a
                    href="#linkedin"
                    className="text-gray-200 hover:text-white transition"
                  >
                    LinkedIn
                  </a>
                </li>
                <li>
                  <a
                    href="#facebook"
                    className="text-gray-200 hover:text-white transition"
                  >
                    Facebook
                  </a>
                </li>
              </ul>
            </div>

            {/* Certified */}
            <div>
              <h3 className="font-semibold mb-4 tracking-wide">CERTIFIED</h3>
              <div className="w-30 h-auto text-white px-3 py-2 rounded inline-block font-bold text-xl">
                <img
                  src={certified}
                  alt=""
                  className="w-full h-full object-cover"
                />
              </div>
            </div>
          </div>

          {/* Bottom */}
          <div className="mt-20 border-t border-gray-300 pt-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 lg:gap-0 text-sm">
            <div className="text-white semibold text-center lg:text-left">
              {footerContent?.copyright} | {new Date().getFullYear()}
            </div>

            <div className="flex flex-col sm:flex-row items-center gap-4 sm:gap-6">
              <div className="flex gap-2">
                {languages?.map((lang, idx) => (
                  <button
                    key={idx}
                    onClick={() => {
                      i18n.changeLanguage(lang?.code);
                    }}
                  >
                    <div className="w-7 h-7 rounded-full overflow-hidden cursor-pointer hover:scale-110 transition">
                      {lang?.flag}
                    </div>
                  </button>
                ))}

                {/* <div className="w-7 h-7 rounded-full overflow-hidden cursor-pointer hover:scale-110 transition">
                <FlagSpainSVG />
              </div>
              <div className="w-7 h-7 rounded-full overflow-hidden cursor-pointer hover:scale-110 transition">
                <FlagNetherlandsSVG />
              </div> */}
              </div>

              <div className="flex flex-wrap justify-center gap-2 sm:gap-4 text-white font-semibold">
                <a
                  href="#privacy"
                  className="hover:text-white transition whitespace-nowrap"
                >
                  Privacy Policy
                </a>
                <span className="hidden sm:inline">|</span>
                <a
                  href="#cookies"
                  className="hover:text-white transition whitespace-nowrap"
                >
                  Cookies Policy
                </a>
                <span className="hidden sm:inline">|</span>
                <a
                  href="#legal"
                  className="hover:text-white transition whitespace-nowrap"
                >
                  Legal Notice
                </a>
              </div>
            </div>
          </div>
        </Container>
      )}
    </footer>
  );
}
