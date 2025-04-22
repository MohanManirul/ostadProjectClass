import { Link } from "react-router-dom";
import createCart from "../utils/createCart";

export default function Product({ product = {} }) {
  const handleAddToCart = () => {
    if (!product._id) {
      console.log("Product id is missing");
      return;
    }
    createCart(product._id)
      .then((data) => {
        if (data?.msg == "success") {
          alert("The product was added to cart");
        }
      })
      .catch((err) => console.log("There was an error"));
  };

  return (
    <div className="card w-100 bg-white shadow-xl">
      <Link to={"/details/" + product.slug}>
        <figure>
          <img src={product.photos[0]} alt={product.title} />
        </figure>
      </Link>

      <div className="card-body">
        <h6 className="text-black">{product?.title}</h6>
        <p className="text-sm text-gray-400">{product.description}</p>
        <h6 className="font-bold">
          {" "}
          Reg Price: <del> ${product.regular_price}</del>
        </h6>
        <h6 className="font-bold">Disc Price: ${product.current_price}</h6>

        <h6 className="font-bold">Brand: {product.brand.title}</h6>

        <div className="card-actions justify-end">
          <button
            onClick={handleAddToCart}
            className="btn btn-sm btn-outline btn-primary"
          >
            Add to Cart
          </button>
        </div>
      </div>
    </div>
  );
}
