import React, { useState } from "react";
import logoBlack from "@/assets/Images/logoBlack.png";
import Container from "@/Common/Container";
import { Link, NavLink, useLocation } from "react-router-dom";
import {
  Sheet,
  SheetContent,
  SheetTitle,
  SheetTrigger,
} from "@/components/ui/sheet";
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import { ChevronDown, Menu } from "lucide-react";
import { VisuallyHidden } from "@radix-ui/react-visually-hidden";
import logo from "@/assets/Images/logo.png";
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

export default function WhiteNavbar() {
  const location = useLocation();
  const [selectedLanguage, setSelectedLanguage] = useState(languages[0]);
  const { t, i18n } = useTranslation();
  const lan = i18n.language || localStorage.getItem("i18nextLng");

  useEffect(() => {
    const currentLang = languages.find((lang) => lang.code === lan);
    if (currentLang) {
      setSelectedLanguage(currentLang);
    }
  }, [lan]);

  return (
    <nav className="w-full h-14 bg-white text-dark flex items-center justify-center">
      <Container>
        <div className="flex items-center justify-between gap-4 w-full">
          {/* logo */}
          <Link to={"/"} className="flex items-center gap-0">
            <div className="w-24 sm:w-28 md:w-32 xl:w-40 h-auto">
              <img
                src={logoBlack}
                alt=""
                className="w-full h-full object-center"
              />
            </div>
          </Link>

          <div className="xl:flex items-center gap-10 hidden">
            <div className="flex items-center gap-6">
              {navlinks?.map((item, idx) => (
                <NavLink
                  key={idx}
                  to={item?.path}
                  className={({ isActive }) =>
                    `text-base font-semibold uppercase p-1 border-b-2 border-transparent ${
                      isActive ? "border-b-black" : ""
                    }`
                  }
                >
                  {t(`navbar.links.${item.name.toLocaleLowerCase()}`)}
                </NavLink>
              ))}
            </div>

            <div className="flex items-center gap-4 xl:gap-10">
              {/* lan switch */}
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

              <button className="bg-dark py-2 px-5 rounded-lg font-medium text-white cursor-pointer hover:opacity-80 duration-300">
                {t("navbar.contactButton")}
              </button>
            </div>
          </div>

          <div className="xl:hidden flex items-center gap-4">
            {/* lan switch */}
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

            <Sheet className="">
              <VisuallyHidden>
                <SheetTitle>
                  {t("navbar.menuTitle") || "Navigation Menu"}
                </SheetTitle>
              </VisuallyHidden>

              <SheetTrigger asChild>
                <button>
                  <Menu />
                </button>
              </SheetTrigger>
              <SheetContent className="px-6 py-3 bg-[#1e2939] text-white border-l-0">
                {/* links */}
                <div className="flex flex-col ">
                  <Link to={"/"} className="flex items-center gap-0 mb-8">
                    <div className="w-28 h-auto flex items-center justify-center">
                      <img
                        src={logo}
                        alt=""
                        className="w-full h-full object-center"
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

                  <div className="flex flex-col items-start gap-4 mt-6">
                    <button className="bg-white py-2 px-5 rounded-lg font-medium text-dark cursor-pointer hover:opacity-80 duration-300">
                      {t("navbar.contactButton")}
                    </button>
                  </div>
                </div>
              </SheetContent>
            </Sheet>
          </div>
        </div>
      </Container>
    </nav>
  );
}
