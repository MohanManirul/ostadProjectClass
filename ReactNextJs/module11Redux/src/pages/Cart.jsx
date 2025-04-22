import React from "react";
import { useSelector } from "react-redux";
import { useDispatch } from "react-redux";
import {
  addToCart,
  removeFromCart,
  decreamentFromCart,
} from "../state/slices/cartSlice";

const Cart = () => {
  const cart = useSelector((state) => state.cart);
  const dispatch = useDispatch();

  const handleAddToCart = (product) => {
    dispatch(addToCart(product));
  };

  const handleDecreamentFromCart = (product) => {
    dispatch(decreamentFromCart(product));
  };

  const handleRemoveFromCart = (product) => {
    dispatch(removeFromCart(product));
  };

  return (
    <div className="relative overflow-x-auto p-48">
      <table className="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" className="px-6 py-3">
              Product
            </th>
            <th scope="col" className="px-6 py-3">
              Price
            </th>
            <th scope="col" className="px-6 py-3">
              Quantity
            </th>
            <th scope="col" className="px-6 py-3">
              Total
            </th>

            {/* Actions */}

            <th scope="col" className="px-6 py-3">
              Actions
            </th>
          </tr>
        </thead>
        <tbody>
          {cart.items.map((item) => (
            <tr
              className="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200"
              key={item.id}
            >
              <td className="px-6 py-4">{item.name}</td>
              <td className="px-6 py-4">{item.price}</td>
              <td className="px-6 py-4">{item.quantity}</td>
              <td className="px-6 py-4">{item.price * item.quantity}</td>

              {/* Actions */}
              <td className="px-6 py-4 flex justify-between items-center">
                <button
                  className="text-blue-500"
                  onClick={() => handleAddToCart(item)}
                >
                  +
                </button>

                <button
                  className="text-blue-500"
                  onClick={() => handleDecreamentFromCart(item)}
                >
                  -
                </button>

                <button
                  className="text-red-500"
                  onClick={() => handleRemoveFromCart(item)}
                >
                  Remove
                </button>
              </td>
            </tr>
          ))}
        </tbody>
        <tfoot>
          <tr className="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
            <td className="px-6 py-4" colSpan="3">
              Total
            </td>
            <td className="px-6 py-4">{cart.total}</td>
            <td></td>
          </tr>
        </tfoot>
      </table>
    </div>
  );
};

export default Cart;
