// src/components/AppNav.jsx
import React from "react";
import { Link, NavLink } from "react-router-dom";
import { useAuth } from "../context/AuthContext"; // Import useAuth

const AppNav = () => {
  const { user, logout } = useAuth(); // Get user and logout from context

  const handleLogout = () => {
    logout(); // Call the logout function from AuthContext
  };

  return (
    <div className="navbar fixed top-0 bg-white z-50 px-20 drop-shadow-lg bg-base-100">
      <div className="flex-1">
        <img className="w-20" src="/images/logo.png" alt="Logo" />
      </div>
      <div className="flex-none">
        <ul className="menu menu-horizontal px-2">
          <li>
            <NavLink to="/">Product</NavLink>
          </li>
        </ul>
        <ul className="menu menu-horizontal px-3">
          <li>
            <NavLink to="/cart-list">View Cart</NavLink>
          </li>
        </ul>

        <div className="dropdown dropdown-end px-2">
          <label tabIndex={0} className="btn btn-ghost btn-circle avatar">
            <div className="w-10 rounded-full">
              <img src="/images/user.webp" alt="User Avatar" />
            </div>
          </label>
          <ul
            tabIndex={0}
            className="menu menu-sm dropdown-content mt-3 z-[100] p-2 shadow bg-base-100 rounded-box w-52"
          >
            {user ? (
              // Show logout option if user is logged in
              <li>
                <a onClick={handleLogout}>Logout</a>
              </li>
            ) : (
              // Show login/signup options if user is not logged in
              <>
                <li>
                  <Link to="/login">Login</Link>
                </li>
                <li>
                  <Link to="/signup">Sign Up</Link>
                </li>
              </>
            )}
          </ul>
        </div>
      </div>
    </div>
  );
};

export default AppNav;
