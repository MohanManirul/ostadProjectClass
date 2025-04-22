import React from "react";
import { addToCart } from "../state/slices/cartSlice";
import { useDispatch } from "react-redux";

const Product = ({ product }) => {
  const dispatch = useDispatch();

  const handleAddToCart = () => {
    dispatch(addToCart(product));
    console.log("Product added to cart");
  };

  return (
    <div className="mb-7">
      <img src={product.image} alt={product.name} />
      <h2>{product.name}</h2>
      <p>{product.price}</p>
      <button className="cursor-pointer bg-amber-600" onClick={handleAddToCart}>
        Add to cart
      </button>
    </div>
  );
};

export default Product;
