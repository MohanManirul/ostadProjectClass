export default async function fetchProducts() {
    const res = await fetch("https://ecom-rs8e.onrender.com/api/products");
    const data = await res.json();
    console.log(data.data);
    
    return data.data;
}

