import React from "react";
import { products } from "../assets/products";
import ProductsList from "../components/products";

const Home = () => {
  return <ProductsList products={products} />;
};

export default Home;
