export default async function createCart(productId) {
  console.log("check local storage", localStorage.getItem("token"));
  console.log("check product id", productId);
  const res = await fetch(
    `https://cart-api.teamrabbil.com/api/create-cart/${productId}`,
    {
      method: "GET",
      headers: {
        token: localStorage.getItem("token"),
      },
    }
  );
  const data = await res.json();

  return data;
}
