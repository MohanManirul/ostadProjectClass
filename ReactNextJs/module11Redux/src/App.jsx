import React from "react";
import "./App.css";
import Cart from "./pages/Cart";
import Header from "./components/Header";
import Home from "./pages/Home";

import { BrowserRouter, Outlet, Route, Routes } from "react-router";

const HomeLayout = () => {
  return (
    <div className="px-7 mx-auto flex flex-col justify-start">
      <Header />
      <Outlet />
    </div>
  );
};

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route element={<HomeLayout />}>
          <Route path="/" element={<Home />} />
          <Route path="/cart" element={<Cart />} />
        </Route>
      </Routes>
    </BrowserRouter>
  );
}

export default App;
