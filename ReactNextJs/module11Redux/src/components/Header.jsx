import React from "react";
import { useSelector } from "react-redux";
import { NavLink } from "react-router";
import { CiShoppingCart } from "react-icons/ci";

const Header = () => {
  const cart = useSelector((state) => state.cart);

  return (
    <div className="flex justify-between mb-7">
      <div className="logo">Logo</div>

      <ul className="flex space-x-4 list-none items-center">
        <NavLink
          to="/"
          className={({ isActive }) => (isActive ? "border-b-2" : "")}
        >
          Home
        </NavLink>
        <li>
          <NavLink
            to="/cart"
            className={({ isActive }) => (isActive ? "border-b-2" : "")}
          >
            Cart
          </NavLink>
        </li>
      </ul>

      <div className="flex items-center relative">
        <CiShoppingCart className="mr-2 text-3xl " />
        <span className="absolute text-sm border-2 border-amber-600 text-white top-0 right-0 bg-amber-600 rounded-full">
          {cart.items.length}
        </span>
      </div>
    </div>
  );
};

export default Header;
