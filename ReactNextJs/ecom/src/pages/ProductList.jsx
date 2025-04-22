// src/pages/ProductList.jsx
import React, { useState } from "react";
import { useQuery } from "@tanstack/react-query";
import axios from "axios";
import { useAuth } from "../context/AuthContext";
import Layout from "../layout/Layout";

const BASE_URL = "https://ecom-rs8e.onrender.com/api";

const fetchProducts = async (token, page = 1) => {
  const response = await axios.get(`${BASE_URL}/products?page=${page}`, {
    headers: { token },
  });
  return response.data.data; // Returns { results, total, first_page, previous, next, last_page }
};

const ProductList = () => {
  const { token } = useAuth();
  const [currentPage, setCurrentPage] = useState(1);

  // Fetch products with pagination
  const { data, isLoading, error } = useQuery({
    queryKey: ["products", currentPage],
    queryFn: () => fetchProducts(token, currentPage),
    enabled: !!token,
    keepPreviousData: true, // Keeps previous data while fetching new page
  });

  const products = data?.results || [];
  const totalPages = data?.last_page || 1;
  const current = data?.next ? currentPage : totalPages; // If no next, we're on the last page

  // Pagination handlers
  const handlePrevious = () => {
    if (data?.previous) setCurrentPage((prev) => prev - 1);
  };

  const handleNext = () => {
    if (data?.next) setCurrentPage((prev) => prev + 1);
  };

  const handlePageClick = (page) => {
    setCurrentPage(page);
  };

  if (isLoading && !data)
    return (
      <Layout>
        <div className="mt-16 p-4">Loading...</div>
      </Layout>
    );
  if (error)
    return (
      <Layout>
        <div className="mt-16 p-4">An error occurred: {error.message}</div>
      </Layout>
    );

  return (
    <Layout>
      <div className="mt-16 p-4">
        <h1 className="text-2xl mb-4">Product List</h1>

        {/* Product Table */}
        <div className="overflow-x-auto">
          <table className="table w-full">
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Price</th>
                <th>Brand</th>
              </tr>
            </thead>
            <tbody>
              {products.length > 0 ? (
                products.map((product) => (
                  <tr key={product._id}>
                    <td>{product._id}</td>
                    <td>{product.title}</td>
                    <td>{product.current_price}</td>
                    <td>{product.brand.title}</td>
                  </tr>
                ))
              ) : (
                <tr>
                  <td colSpan="4">No products found</td>
                </tr>
              )}
            </tbody>
          </table>
        </div>

        {/* Pagination */}
        {totalPages > 1 && (
          <div className="flex justify-center mt-4">
            <div className="join">
              <button
                className="join-item btn"
                onClick={handlePrevious}
                disabled={!data?.previous}
              >
                « Previous
              </button>

              {/* Page Numbers */}
              {Array.from({ length: totalPages }, (_, i) => i + 1).map(
                (page) => (
                  <button
                    key={page}
                    className={`join-item btn ${
                      current === page ? "btn-active" : ""
                    }`}
                    onClick={() => handlePageClick(page)}
                  >
                    {page}
                  </button>
                )
              )}

              <button
                className="join-item btn"
                onClick={handleNext}
                disabled={!data?.next}
              >
                Next »
              </button>
            </div>
          </div>
        )}
      </div>
    </Layout>
  );
};

export default ProductList;
