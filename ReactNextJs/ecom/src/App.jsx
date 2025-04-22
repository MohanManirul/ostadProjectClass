// src/App.jsx
import React from "react";
import { BrowserRouter, Route, Routes, Navigate } from "react-router-dom";
import { useAuth } from "./context/AuthContext"; // Import useAuth to access user and token
import Layout from "./layout/Layout.jsx";
import ProductPage from "./pages/Product-page.jsx";
import CartPage from "./pages/Cart-Page.jsx";
import LoginPage from "./pages/Login-Page.jsx";
import OtpPage from "./pages/OTP-Page.jsx";
import ProductDetailsPage from "./pages/ProductDetailsPage.jsx";
import ProductManagement from "./pages/ProductManagement.jsx";
import SignupPage from "./pages/sign-up.jsx";
import ProductList from "./pages/ProductList.jsx";
import ProductListInfinite from "./pages/ProductListInfinite.jsx";
import ProductProcessingDemo from "./pages/ProductProcessingDemo.jsx";

// ProtectedRoute component to handle authentication and role-based access
const ProtectedRoute = ({ children, requiredRole }) => {
  const { user, token } = useAuth();

  // Check if user is authenticated (has a token)
  if (!token) {
    // Redirect to login if not authenticated
    return <Navigate to="/login" replace />;
  }

  // If a specific role is required, check it
  if (requiredRole && user?.role !== requiredRole) {
    // Redirect to home if user doesn't have the required role
    return <Navigate to="/" replace />;
  }

  // If authenticated and role matches (or no role required), render the children
  return children;
};

const App = () => {
  return (
    <BrowserRouter>
      <Layout>
        <Routes>
          <Route
            path="*"
            element={
              <Layout>
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <h2 className="text-center h-full w-full items-center justify-center flex">
                  404 Not Found
                </h2>
              </Layout>
            }
          />
          {/* Public Routes - Accessible to everyone */}
          <Route
            path="/"
            element={
              <ProtectedRoute>
                <ProductPage />
              </ProtectedRoute>
            }
          />{" "}
          {/* Home page, public */}
          <Route path="/details/:slug" element={<ProductDetailsPage />} />
          {/* Product details, public */}
          <Route path="/login" element={<LoginPage />} /> {/* Login, public */}
          <Route path="/signup" element={<SignupPage />} />
          {/* Signup, public */}
          <Route path="/product-list" element={<ProductList />} />
          {/* Product list, public */}
          <Route
            path="/product-list-infinite"
            element={<ProductListInfinite />}
          />
          {/* Infinite scroll list, public */}
          {/* Private Routes - Require authentication */}
          <Route
            path="/cart-list"
            element={
              <ProtectedRoute>
                <CartPage />
              </ProtectedRoute>
            }
          />
          {/* Cart, requires login */}
          <Route
            path="/otp"
            element={
              <ProtectedRoute>
                <OtpPage />
              </ProtectedRoute>
            }
          />
          {/* OTP page, requires login */}
          <Route
            path="/product-processing-demo"
            element={
              <ProtectedRoute>
                <ProductProcessingDemo />
              </ProtectedRoute>
            }
          />
          {/* Demo page, requires login */}
          {/* Admin-Only Routes - Require authentication AND admin role (role: 1) */}
          <Route
            path="/manage-products"
            element={
              <ProtectedRoute requiredRole={1}>
                <ProductManagement />
              </ProtectedRoute>
            }
          />
          {/* Product management, requires admin role */}
        </Routes>
      </Layout>
    </BrowserRouter>
  );
};

export default App;
