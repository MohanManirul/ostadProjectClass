import { BASE_URL } from "../constants";

export const fetchProductDetails = async (slug) => {
  const response = await fetch(`${BASE_URL}/products/${slug}`);
  const data = await response.json();
  return data;
};
