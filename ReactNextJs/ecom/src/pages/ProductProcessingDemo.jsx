import React, { useState, useCallback, useMemo } from "react";
import Layout from "../layout/Layout";

// Dummy static data simulating an API response
const dummyProducts = [
  {
    id: 1,
    title: "Laptop Pro",
    price: 1200,
    category: "Electronics",
    stock: 5,
    rating: 4.5,
  },
  {
    id: 2,
    title: "Wireless Mouse",
    price: 25,
    category: "Accessories",
    stock: 50,
    rating: 4.0,
  },
  {
    id: 3,
    title: "Smartphone X",
    price: 800,
    category: "Electronics",
    stock: 15,
    rating: 4.8,
  },
  {
    id: 4,
    title: "Headphones",
    price: 150,
    category: "Accessories",
    stock: 30,
    rating: 4.2,
  },
  {
    id: 5,
    title: "Desk Chair",
    price: 200,
    category: "Furniture",
    stock: 8,
    rating: 4.1,
  },
  {
    id: 6,
    title: "Monitor 4K",
    price: 350,
    category: "Electronics",
    stock: 12,
    rating: 4.7,
  },
];

const ProductProcessingDemo = () => {
  // State for filters and sorting
  const [searchTerm, setSearchTerm] = useState("");
  const [categoryFilter, setCategoryFilter] = useState("All");
  const [sortBy, setSortBy] = useState("title"); // Options: title, price, rating
  const [sortOrder, setSortOrder] = useState("asc"); // asc or desc
  const [minStock, setMinStock] = useState(0);

  // Extract unique categories for filter dropdown
  const categories = useMemo(() => {
    const uniqueCategories = [...new Set(dummyProducts.map((p) => p.category))];
    return ["All", ...uniqueCategories];
  }, []);

  // Filter products (useCallback for stability)
  const filterProducts = useCallback(
    (products) => {
      return products.filter((product) => {
        const matchesSearch = product.title
          .toLowerCase()
          .includes(searchTerm.toLowerCase());
        const matchesCategory =
          categoryFilter === "All" || product.category === categoryFilter;
        const matchesStock = product.stock >= minStock;
        return matchesSearch && matchesCategory && matchesStock;
      });
    },
    [searchTerm, categoryFilter, minStock]
  );

  // Sort products (useCallback for stability)
  const sortProducts = useCallback(
    (products) => {
      return [...products].sort((a, b) => {
        let comparison;
        switch (sortBy) {
          case "price":
            comparison = a.price - b.price;
            break;
          case "rating":
            comparison = a.rating - b.rating;
            break;
          case "title":
          default:
            comparison = a.title.localeCompare(b.title);
            break;
        }
        return sortOrder === "asc" ? comparison : -comparison;
      });
    },
    [sortBy, sortOrder]
  );

  // Process products (useMemo for performance)
  const processedProducts = useMemo(() => {
    const filtered = filterProducts(dummyProducts);
    const sorted = sortProducts(filtered);

    // Example manipulation: Add a discounted price (20% off if stock > 10)
    return sorted.map((product) => ({
      ...product,
      discountedPrice: product.stock > 10 ? product.price * 0.8 : product.price,
    }));
  }, [filterProducts, sortProducts]);

  // Handlers
  const handleSearchChange = (e) => setSearchTerm(e.target.value);
  const handleCategoryChange = (e) => setCategoryFilter(e.target.value);
  const handleSortByChange = (e) => setSortBy(e.target.value);
  const handleSortOrderChange = (e) => setSortOrder(e.target.value);
  const handleMinStockChange = (e) => setMinStock(Number(e.target.value));

  return (
    <Layout>
      <div className="mt-16 p-4">
        <h1 className="text-2xl mb-4">Product Processing Demo</h1>
        <p className="mb-4 text-gray-600">
          Learn how to filter, sort, and manipulate data efficiently in React
        </p>

        {/* Controls */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
          {/* Search */}
          <div>
            <label className="label">Search by Title</label>
            <input
              type="text"
              value={searchTerm}
              onChange={handleSearchChange}
              placeholder="Search products..."
              className="input input-bordered w-full"
            />
          </div>

          {/* Category Filter */}
          <div>
            <label className="label">Filter by Category</label>
            <select
              value={categoryFilter}
              onChange={handleCategoryChange}
              className="select select-bordered w-full"
            >
              {categories.map((cat) => (
                <option key={cat} value={cat}>
                  {cat}
                </option>
              ))}
            </select>
          </div>

          {/* Minimum Stock */}
          <div>
            <label className="label">Minimum Stock</label>
            <input
              type="number"
              value={minStock}
              onChange={handleMinStockChange}
              min="0"
              className="input input-bordered w-full"
            />
          </div>

          {/* Sort By */}
          <div>
            <label className="label">Sort By</label>
            <select
              value={sortBy}
              onChange={handleSortByChange}
              className="select select-bordered w-full"
            >
              <option value="title">Title</option>
              <option value="price">Price</option>
              <option value="rating">Rating</option>
            </select>
          </div>

          {/* Sort Order */}
          <div>
            <label className="label">Sort Order</label>
            <select
              value={sortOrder}
              onChange={handleSortOrderChange}
              className="select select-bordered w-full"
            >
              <option value="asc">Ascending</option>
              <option value="desc">Descending</option>
            </select>
          </div>
        </div>

        {/* Product List */}
        <div className="overflow-x-auto">
          <table className="table w-full">
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Price</th>
                <th>Discounted Price</th>
                <th>Stock</th>
                <th>Rating</th>
              </tr>
            </thead>
            <tbody>
              {processedProducts.length > 0 ? (
                processedProducts.map((product) => (
                  <tr key={product.id}>
                    <td>{product.id}</td>
                    <td>{product.title}</td>
                    <td>{product.category}</td>
                    <td>${product.price}</td>
                    <td>
                      ${product.discountedPrice.toFixed(2)}
                      {product.stock > 10 && (
                        <span className="badge badge-success ml-2">
                          20% Off
                        </span>
                      )}
                    </td>
                    <td>{product.stock}</td>
                    <td>{product.rating} ★</td>
                  </tr>
                ))
              ) : (
                <tr>
                  <td colSpan="7" className="text-center">
                    No products match your criteria
                  </td>
                </tr>
              )}
            </tbody>
          </table>
        </div>
      </div>
    </Layout>
  );
};

export default ProductProcessingDemo;
