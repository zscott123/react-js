import React from "react";
import ReactDOM from "react-dom/client";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import { PayPalScriptProvider } from "@paypal/react-paypal-js"; // Import PayPal provider
import App from "./App";
import About from "./pages/about-us/About.jsx";
import Contact from "./pages/contact-us/Contact.jsx";
import Layout from "./Layout.jsx";
import RegisterForm from "./pages/register/register.jsx";
import "core-js/stable";
import "regenerator-runtime/runtime";
import { CartProvider } from "./context/CartContext";
import LoginForm from "./pages/login/login.jsx";

// PayPal client ID, replace with your actual PayPal Client ID
const PAYPAL_CLIENT_ID =
  "AW6Zo51TNM2IIXYegVAp2U6OSOpVkyym5H6WBd7-2E1nVpwCewjMvGUxXqScLEykDJZ2yH0jstktylyK"; // Replace this with your PayPal client ID

const rootElement = document.getElementById("root");

if (!rootElement) {
  throw new Error("Target container is not a DOM element.");
}

// Create a root for rendering
const root = ReactDOM.createRoot(rootElement);

root.render(
  <React.StrictMode>
    <CartProvider>
      <Router>
        <Routes>
          <Route path="/" element={<Layout />}>
            {/* Show LoginForm as default */}
            <Route index element={<LoginForm />} />
            <Route path="register" element={<RegisterForm />} />
            <Route path="home" element={<App />} />
            <Route path="about" element={<About />} />
            <Route path="contact" element={<Contact />} />
          </Route>
        </Routes>
      </Router>
    </CartProvider>
  </React.StrictMode>
);
