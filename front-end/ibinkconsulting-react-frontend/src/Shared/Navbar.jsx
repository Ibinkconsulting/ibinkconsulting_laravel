import React, { useEffect, useState } from "react";
import logo from "@/assets/Images/logo.png";
import logoBlack from "@/assets/Images/logoBlack.png";
import Container from "@/Common/Container";
import { Link, NavLink, useLocation, useMatch } from "react-router-dom";
import {
  Sheet,
  SheetContent,
  SheetTitle,
  SheetTrigger,
} from "@/components/ui/sheet";
import { ChevronDown, Menu } from "lucide-react";
import { VisuallyHidden } from "@radix-ui/react-visually-hidden";
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import { useTranslation } from "react-i18next";

// flags
import flagUsa from "@/assets/Images/flagUsa.png";
import flagSpain from "@/assets/Images/flagSpain.png";
import flagNetherlands from "@/assets/Images/flagNetherlands.png";

const navlinks = [
  {
    name: "Buy",
    path: "/buy",
  },
  {
    name: "Sell",
    path: "/sell",
  },
  {
    name: "Masterclass",
    path: "/masterclass",
  },

  {
    name: "Insights",
    path: "/blog",
  },
  {
    name: "About",
    path: "/about",
  },
];

const languages = [
  {
    name: "English",
    code: "en",
    flag: flagUsa,
  },
  {
    name: "Español",
    code: "es",
    flag: flagSpain,
  },
  {
    name: "Nederlandse",
    code: "nl",
    flag: flagNetherlands,
  },
];

export default function Navbar() {
  const [scrolled, setScrolled] = useState(false);
  const [selectedLanguage, setSelectedLanguage] = useState(languages[0]);
  const { t, i18n } = useTranslation();
  const lan = i18n.language || localStorage.getItem("i18nextLng");

  useEffect(() => {
    const currentLang = languages.find((lang) => lang.code === lan);
    if (currentLang) {
      setSelectedLanguage(currentLang);
    }
  }, [lan]);

  const location = useLocation();
  const pathName = location?.pathname;
  const stateName = location?.state;

  const buyDetailsMatch = useMatch("/buy-details/:slug");
  const blogDetailsMatch = useMatch("/blog-details/:id");

  useEffect(() => {
    const handleScroll = () => {
      // const hero = document.getElementById("heroSection");

      // if (!hero) return;

      // const heroHeight = hero.offsetHeight;
      setScrolled(window.scrollY > 600);
    };
    // const handleScroll = () => {
    //   setScrolled(window.innerHeight === '600px');
    // };

    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);
  return (
    <nav
      // className={` w-full z-20 transition-all duration-300 ${
      //   scrolled ? "bg-dark/70 shadow-md fixed top-0" : "bg-transparent"
      // }`}
      className={`w-full z-20 transition-all duration-300 ${
        (pathName === "/masterclass" ||
          stateName === "buy-details" ||
          blogDetailsMatch) &&
        "text-dark"
      } ${
        scrolled || blogDetailsMatch
          ? "bg-white text-dark shadow-md fixed top-0"
          : "absolute top-0 bg-transparent"
      } `}
    >
      <Container>
        <div className="py-6 xl:py-8 flex items-center justify-between gap-4 ">
          {/* logo */}
          <Link to={"/"} className="flex items-center gap-3">
            {scrolled ||
            pathName === "/masterclass" ||
            stateName === "buy-details" ||
            stateName === "blog-details" ||
            buyDetailsMatch ||
            blogDetailsMatch ? (
              <div className="w-24 sm:w-28 md:w-32 xl:w-44 h-auto">
                <img
                  src={logoBlack}
                  alt=""
                  className="w-full h-full object-center"
                />
              </div>
            ) : (
              <div className="w-28 sm:w-32 md:w-36 xl:w-52 h-auto">
                <img
                  src={logo}
                  alt=""
                  className="w-full h-full  object-center"
                />
              </div>
            )}

            {/* <div
              className={
                scrolled ||
                pathName === "/masterclass" ||
                stateName === "buy-details" ||
                "mb-4"
              }
            >
              <p className="text-3xl leading-tight tracking-tight">IBINK</p>
              <p className="text-lg leading-tight tracking-tight">
                REAL ESTATE
              </p>
            </div> */}
          </Link>

          {/* links */}
          <div className="lg:flex items-center gap-6 hidden">
            {navlinks?.map((item, idx) => (
              <NavLink
                key={idx}
                to={item?.path}
                className={({ isActive }) =>
                  `text-base xl:text-lg font-semibold uppercase p-1 border-b-2  ${
                    isActive
                      ? scrolled ||
                        pathName === "/masterclass" ||
                        stateName === "buy-details" ||
                        blogDetailsMatch
                        ? "border-dark"
                        : "border-white"
                      : "border-transparent"
                  }`
                }
              >
                {t(`navbar.links.${item.name.toLocaleLowerCase()}`)}
              </NavLink>
            ))}
          </div>

          <div className="lg:flex items-center gap-4 xl:gap-10 hidden">
            {/* lan switch */}

            {scrolled ||
            pathName === "/masterclass" ||
            stateName === "buy-details" ||
            buyDetailsMatch ||
            blogDetailsMatch ? (
              <DropdownMenu>
                <DropdownMenuTrigger asChild>
                  <button className="flex items-center gap-1.5 sm:gap-2 transition-colors px-2 sm:px-3 py-1.5 sm:py-2 rounded-lg">
                    <div className="w-5 h-5 sm:w-6 sm:h-6 rounded-full overflow-hidden">
                      <img
                        src={selectedLanguage?.flag}
                        alt=""
                        className="w-full h-full object-cover"
                      />
                    </div>
                    <ChevronDown className="w-3 h-3 sm:w-4 sm:h-4 text-dark" />
                  </button>
                </DropdownMenuTrigger>
                <DropdownMenuContent
                  align="end"
                  className="bg-dark/70 border border-white/20 text-white min-w-40 z-999"
                >
                  {languages?.map((lang) => (
                    <DropdownMenuItem
                      key={lang?.code}
                      onClick={() => {
                        setSelectedLanguage(lang);
                        i18n.changeLanguage(lang?.code);
                      }}
                      className={`flex items-center gap-3 px-3 py-2.5 cursor-pointer transition-colors ${
                        lan === lang?.code ? "bg-white/20" : "hover:bg-white/10"
                      }`}
                    >
                      <div className="w-6 h-6 rounded-full overflow-hidden">
                        <img
                          src={lang?.flag}
                          alt=""
                          className="w-full h-full object-cover"
                        />
                      </div>
                      <span className="text-sm font-medium">{lang?.name}</span>
                    </DropdownMenuItem>
                  ))}
                </DropdownMenuContent>
              </DropdownMenu>
            ) : (
              <DropdownMenu>
                <DropdownMenuTrigger asChild>
                  <button className="flex items-center gap-1.5 sm:gap-2 transition-colors px-2 sm:px-3 py-1.5 sm:py-2 rounded-lg">
                    <div className="w-5 h-5 sm:w-6 sm:h-6 rounded-full overflow-hidden">
                      <img
                        src={selectedLanguage?.flag}
                        alt=""
                        className="w-full h-full object-cover"
                      />
                    </div>
                    <ChevronDown className="w-3 h-3 sm:w-4 sm:h-4 text-white" />
                  </button>
                </DropdownMenuTrigger>
                <DropdownMenuContent
                  align="end"
                  className="bg-dark border border-white/20 text-white min-w-40 z-999"
                >
                  {languages?.map((lang) => (
                    <DropdownMenuItem
                      key={lang?.code}
                      onClick={() => {
                        setSelectedLanguage(lang);
                        i18n.changeLanguage(lang?.code);
                      }}
                      className={`flex items-center gap-3 px-3 py-2.5 cursor-pointer transition-colors ${
                        lan === lang?.code ? "bg-white/20" : "hover:bg-white/10"
                      }`}
                    >
                      <div className="w-6 h-6 rounded-full overflow-hidden object-cover">
                        <img
                          src={lang?.flag}
                          alt=""
                          className="w-full h-full object-cover"
                        />
                      </div>
                      <span className="text-sm font-medium">{lang?.name}</span>
                    </DropdownMenuItem>
                  ))}
                </DropdownMenuContent>
              </DropdownMenu>
            )}

            {scrolled ||
            pathName === "/masterclass" ||
            stateName === "buy-details" ||
            buyDetailsMatch ||
            blogDetailsMatch ? (
              <button className="bg-dark py-2 px-5 rounded-lg text-base font-medium uppercase text-white cursor-pointer hover:opacity-80 duration-300">
                {t("navbar.contactButton")}
              </button>
            ) : (
              <button className="bg-white py-2 px-5 rounded-lg text-base font-medium uppercase text-dark cursor-pointer hover:opacity-80 duration-300">
                {t("navbar.contactButton")}
              </button>
            )}
          </div>

          <div className="lg:hidden ">
            <div className="flex items-center gap-4">
              {/* lan switch */}

              {scrolled ||
              pathName === "/masterclass" ||
              stateName === "buy-details" ||
              buyDetailsMatch ||
              blogDetailsMatch ? (
                <DropdownMenu>
                  <DropdownMenuTrigger asChild>
                    <button className="flex items-center gap-1.5 sm:gap-2 transition-colors px-2 sm:px-3 py-1.5 sm:py-2 rounded-lg">
                      <div className="w-5 h-5 sm:w-6 sm:h-6 rounded-full overflow-hidden">
                        <img
                          src={selectedLanguage?.flag}
                          alt=""
                          className="w-full h-full object-cover"
                        />
                      </div>
                      <ChevronDown className="w-3 h-3 sm:w-4 sm:h-4 text-dark" />
                    </button>
                  </DropdownMenuTrigger>
                  <DropdownMenuContent
                    align="end"
                    className="bg-dark/70 border border-white/20 text-white min-w-40 z-999"
                  >
                    {languages?.map((lang) => (
                      <DropdownMenuItem
                        key={lang?.code}
                        onClick={() => {
                          setSelectedLanguage(lang);
                          i18n.changeLanguage(lang?.code);
                        }}
                        className={`flex items-center gap-3 px-3 py-2.5 cursor-pointer transition-colors ${
                          lan === lang?.code
                            ? "bg-white/20"
                            : "hover:bg-white/10"
                        }`}
                      >
                        <div className="w-6 h-6 rounded-full overflow-hidden">
                          <img
                            src={lang?.flag}
                            alt=""
                            className="w-full h-full object-cover"
                          />
                        </div>
                        <span className="text-sm font-medium">
                          {lang?.name}
                        </span>
                      </DropdownMenuItem>
                    ))}
                  </DropdownMenuContent>
                </DropdownMenu>
              ) : (
                <DropdownMenu>
                  <DropdownMenuTrigger asChild>
                    <button className="flex items-center gap-1.5 sm:gap-2 transition-colors px-2 sm:px-3 py-1.5 sm:py-2 rounded-lg">
                      <div className="w-5 h-5 sm:w-6 sm:h-6 rounded-full overflow-hidden">
                        <img
                          src={selectedLanguage?.flag}
                          alt=""
                          className="w-full h-full object-cover"
                        />
                      </div>
                      <ChevronDown className="w-3 h-3 sm:w-4 sm:h-4 text-white" />
                    </button>
                  </DropdownMenuTrigger>
                  <DropdownMenuContent
                    align="end"
                    className="bg-dark border border-white/20 text-white min-w-40 z-999"
                  >
                    {languages?.map((lang) => (
                      <DropdownMenuItem
                        key={lang?.code}
                        onClick={() => {
                          setSelectedLanguage(lang);
                          i18n.changeLanguage(lang?.code);
                        }}
                        className={`flex items-center gap-3 px-3 py-2.5 cursor-pointer transition-colors ${
                          lan === lang?.code
                            ? "bg-white/20"
                            : "hover:bg-white/10"
                        }`}
                      >
                        <div className="w-6 h-6 rounded-full overflow-hidden">
                          <img
                            src={lang?.flag}
                            alt=""
                            className="w-full h-full object-cover"
                          />
                        </div>
                        <span className="text-sm font-medium">
                          {lang?.name}
                        </span>
                      </DropdownMenuItem>
                    ))}
                  </DropdownMenuContent>
                </DropdownMenu>
              )}

              <Sheet className="">
                <VisuallyHidden>
                  <SheetTitle>{t("navbar.menuTitle")}</SheetTitle>
                </VisuallyHidden>

                <SheetTrigger asChild>
                  <button>
                    <Menu />
                  </button>
                </SheetTrigger>
                <SheetContent className="px-6 py-3 bg-[#1e2939] text-white  border-l-0">
                  {/* links */}
                  <div className="flex flex-col ">
                    <Link to={"/"} className="flex items-start gap-3">
                      <div className="w-28 mb-8 h-auto flex items-center justify-center">
                        <img
                          src={logo}
                          alt=""
                          className="w-full h-full o object-center"
                        />
                      </div>
                    </Link>

                    {navlinks?.map((item, idx) => (
                      <NavLink
                        key={idx}
                        to={item?.path}
                        className={({ isActive }) =>
                          `text-lg font-semibold uppercase p-1 border-b border-transparent ${
                            isActive ? "border-white" : ""
                          }`
                        }
                      >
                        {t(`navbar.links.${item.name.toLocaleLowerCase()}`)}
                      </NavLink>
                    ))}
                  </div>
                </SheetContent>
              </Sheet>
            </div>
          </div>
        </div>
      </Container>
    </nav>
  );
}
