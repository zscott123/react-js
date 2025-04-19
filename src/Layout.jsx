import React from 'react'
import Navbar from './components/Navbar.jsx'
import { Outlet } from "react-router-dom";

export default function Layout() {
    return (
        <>
          {/* <Navbar/> */}
          <div className="content">
            <Outlet /> {/* Renders the page-specific content */}
          </div>
          </>
      );
}
