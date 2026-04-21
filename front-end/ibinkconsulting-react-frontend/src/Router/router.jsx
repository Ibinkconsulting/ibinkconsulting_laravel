import React from "react";
import { createBrowserRouter } from "react-router-dom";
import ErrorPage from "../AllPages/ErrorPage";
import MainLayout from "../Layout/MainLayout";
import HomePage from "../AllPages/HomePage";
import BuyPage from "@/AllPages/BuyPage";
import AboutPage from "@/AllPages/AboutPage";
import MasterclassPage from "./../AllPages/MasterclassPage";
import BuyDetailsPage from "@/AllPages/BuyDetailsPage";
import BlogPage from "@/AllPages/BlogPage";
import SellPage from './../AllPages/SellPage';
import BlogDetailsPage from "@/AllPages/BlogDetailsPage";

const router = createBrowserRouter([
  {
    path: "*",
    element: <ErrorPage />,
  },

  {
    path: "/",
    element: <MainLayout />,
    children: [
      {
        index: true,
        element: <HomePage />,
      },
      {
        path: "/buy",
        element: <BuyPage />,
      },
      {
        path: "/sell",
        element: <SellPage/>,
      },
      {
        path: `buy-details/:slug`,
        element: <BuyDetailsPage />,
      },
      {
        path: "/about",
        element: <AboutPage />,
      },
      {
        path: "/blog",
        element: <BlogPage />,
      },
      {
        path: "/blog-details/:id",
        element: <BlogDetailsPage/>
      },
      {
        path: "/masterclass",
        element: <MasterclassPage />,
      },
    ],
  },
]);

export default router;
