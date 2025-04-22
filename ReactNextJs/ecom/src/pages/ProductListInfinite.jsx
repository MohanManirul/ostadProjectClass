// src/pages/ProductListInfinite.jsx
import React, { useRef, useCallback } from "react";
import { useInfiniteQuery } from "@tanstack/react-query";
import axios from "axios";
import { useAuth } from "../context/AuthContext";
import Layout from "../layout/Layout";

const BASE_URL = "https://ecom-rs8e.onrender.com/api";

const fetchProducts = async ({ pageParam = 1, token }) => {
  const response = await axios.get(`${BASE_URL}/products?page=${pageParam}`, {
    headers: { token },
  });
  return response.data.data; // Returns { results, total, first_page, previous, next, last_page }
};

const ProductListInfinite = () => {
  const { token } = useAuth();
  const observer = useRef();

  // Infinite query setup
  const {
    data,
    fetchNextPage,
    hasNextPage,
    isFetchingNextPage,
    isLoading,
    error,
  } = useInfiniteQuery({
    queryKey: ["productsInfinite"],
    queryFn: ({ pageParam = 1 }) => fetchProducts({ pageParam, token }),
    enabled: !!token,
    getNextPageParam: (lastPage) => {
      return lastPage.next || undefined; // Return the next page number or undefined if no more pages
    },
  });

  // Flatten pages into a single array of products
  const products = data?.pages.flatMap((page) => page.results) || [];

  // Intersection Observer to trigger loading more
  const lastProductRef = useCallback(
    (node) => {
      if (isLoading || isFetchingNextPage) return;
      if (observer.current) observer.current.disconnect();

      observer.current = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting && hasNextPage) {
          fetchNextPage();
        }
      });

      if (node) observer.current.observe(node);
    },
    [isLoading, isFetchingNextPage, hasNextPage, fetchNextPage]
  );

  if (isLoading && !data) return <div>Loading...</div>;
  if (error) return <div>Error: {error.message}</div>;

  return (
    <Layout>
      <div className="mt-16 p-4">
        <h1 className="text-2xl mb-4">Product List (Infinite Scroll)</h1>

        {/* Product List */}
        <div className="space-y-4">
          {products.length > 0 ? (
            products.map((product, index) => {
              // Attach ref to the last product for infinite scroll trigger
              const isLast = index === products.length - 1;
              return (
                <div
                  key={product._id}
                  ref={isLast ? lastProductRef : null}
                  className="card bg-base-100 shadow-xl p-4"
                >
                  <div className="flex justify-between">
                    <div>
                      <h2 className="card-title">{product.title}</h2>
                      <p>ID: {product._id}</p>
                      <p>Price: ${product.current_price}</p>
                      <p>Brand: {product.brand.title}</p>
                    </div>
                  </div>
                </div>
              );
            })
          ) : (
            <p>No products found</p>
          )}
        </div>

        {/* Loading Indicator */}
        {isFetchingNextPage && (
          <div className="text-center mt-4">
            <span className="loading loading-spinner loading-lg"></span>
          </div>
        )}

        {/* End of List Message */}
        {!hasNextPage && products.length > 0 && (
          <p className="text-center mt-4">No more products to load</p>
        )}
      </div>
    </Layout>
  );
};

export default ProductListInfinite;
