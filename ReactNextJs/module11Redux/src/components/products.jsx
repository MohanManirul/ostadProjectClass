import React from "react";
import Product from "./Product";

const ProductsList = ({ products }) => { 
  return (
    <div className="mb-4">
      <h1 className="text-2xl">Products</h1>

      <div className="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 xl:grid-cols-6 gap-4">
        {products.map((product) => (
          <Product key={product.id} product={product} />
        ))}
      </div>
    </div>
  );
};

export default ProductsList;
