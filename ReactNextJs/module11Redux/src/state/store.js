import { configureStore } from "@reduxjs/toolkit";

import storage from "redux-persist/lib/storage";
import cartSlice from "./slices/cartSlice";
import { persistReducer, persistStore } from "redux-persist";
import { combineReducers } from "redux";

// Configure persist
const persistConfig = {
  key: "root", // Key for storage
  storage, // Local storage
};

const rootReducer = combineReducers({
  cart: cartSlice,
});

// Create a persisted reducer
const persistedReducer = persistReducer(persistConfig, rootReducer);

// Configure store with persisted reducer
const store = configureStore({
  reducer: persistedReducer,
  middleware: (getDefaultMiddleware) =>
    getDefaultMiddleware({
      serializableCheck: false, // Ignore non-serializable values
    }),
});

// Persistor
export const persistor = persistStore(store);
export default store;
