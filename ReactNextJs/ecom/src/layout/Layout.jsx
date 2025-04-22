import React from "react";
import AppNav from "../component/AppNav";
import Footer from "../component/Footer";

const Layout = (props) => {
  return (
    <div className="min-h-screen">
      <AppNav />
      {props.children}
      <Footer />
    </div>
  );
};

export default Layout;
