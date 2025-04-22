import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  items: [],
  total: 0,
};

const cartSlice = createSlice({
  name: "cart",
  initialState: initialState,
  reducers: {
    addToCart: (state, action) => {
      // if the product already exists in the cart
      const existingProductIndex = state.items.findIndex(
        (item) => item.id === action.payload.id
      );

      // increment the quantity of the product
      if (existingProductIndex >= 0) {
        state.items[existingProductIndex].quantity += 1;
      } else {
        // add the product to the cart
        state.items.push({ ...action.payload, quantity: 1 });
      }

      // calculate the total price
      state.total += action.payload.price;
    },
    decreamentFromCart: (state, action) => {
      // if the product already exists in the cart
      const existingProductIndex = state.items.findIndex(
        (item) => item.id === action.payload.id
      );

      // decrement the quantity of the product
      if (existingProductIndex >= 0) {
        // if the quantity of the product is 1, remove the product from the cart
        if (state.items[existingProductIndex].quantity === 1) {
          state.items.splice(existingProductIndex, 1);
        } else {
          // decrement the quantity of the product
          state.items[existingProductIndex].quantity -= 1;
        }
      }

      // calculate the total price based on the quantity of the product
      state.total -= action.payload.price;
    },

    removeFromCart: (state, action) => {
      // if the product already exists in the cart
      const existingProductIndex = state.items.findIndex(
        (item) => item.id === action.payload.id
      );

      // remove the product from the cart
      if (existingProductIndex >= 0) {
        // calculate the total price based on the quantity of the product
        state.total -=
          state.items[existingProductIndex].price *
          state.items[existingProductIndex].quantity;

        // remove the product from the cart
        state.items.splice(existingProductIndex, 1);
      }
    },
  },
});

export const { addToCart, removeFromCart, decreamentFromCart } =
  cartSlice.actions;
export default cartSlice.reducer;
