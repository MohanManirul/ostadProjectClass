// src/pages/ProductManagement.jsx
import React, { useState } from "react";
import { useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import * as z from "zod";
import { useQuery, useMutation, useQueryClient } from "@tanstack/react-query";
import axios from "axios";
import { useAuth } from "../context/AuthContext";
import Layout from "../layout/Layout";

const BASE_URL = "https://ecom-rs8e.onrender.com/api";

// Zod schema for product creation/update
const productSchema = z.object({
  title: z.string().min(1, "Title is required"),
  slug: z.string().min(1, "Slug is required"),
  brand: z.string().min(1, "Brand ID is required"),
  categories: z.array(z.string()).min(1, "At least one category is required"),
  current_price: z.number().min(0, "Price must be positive"),
  description: z.string().optional(),
});

// API functions
const fetchProducts = async ({ token, page = 1 }) => {
  const response = await axios.get(`${BASE_URL}/products?page=${page}`, {
    headers: { token },
  });
  return {
    results: response.data.data.results,
    total: response.data.data.total,
    next: response.data.data.next,
    previous: response.data.data.previous,
    last_page: response.data.data.last_page,
  };
};

const createProduct = async ({ token, productData }) => {
  const response = await axios.post(`${BASE_URL}/product`, productData, {
    headers: { token },
  });
  return response.data.data;
};

const updateProduct = async ({ token, productId, productData }) => {
  const response = await axios.patch(
    `${BASE_URL}/products/${productId}`,
    productData,
    {
      headers: { token },
    }
  );
  return response.data.data;
};

const deleteProduct = async ({ token, productId }) => {
  await axios.delete(`${BASE_URL}/products/${productId}`, {
    headers: { token },
  });
};

const ProductManagement = () => {
  const { token, user } = useAuth();
  const queryClient = useQueryClient();
  const [currentPage, setCurrentPage] = useState(1); // Track current page

  // Fetch products with pagination
  const { data, isLoading, error } = useQuery({
    queryKey: ["products", currentPage], // Include page in queryKey to refetch on page change
    queryFn: () => fetchProducts({ token, page: currentPage }),
    enabled: !!token && user?.role === 1, // Only fetch if user is admin (role: 1)
  });

  // Extract pagination data
  const products = data?.results || [];
  const total = data?.total || 0;
  const nextPage = data?.next;
  const previousPage = data?.previous;
  const lastPage = data?.last_page || 1;

  // Form setup
  const {
    register,
    handleSubmit,
    reset,
    formState: { errors },
  } = useForm({
    resolver: zodResolver(productSchema),
    defaultValues: {
      title: "",
      slug: "",
      brand: "",
      categories: [],
      current_price: 0,
      description: "",
    },
  });

  // Mutations
  const createMutation = useMutation({
    mutationFn: createProduct,
    onSuccess: () => {
      queryClient.invalidateQueries(["products", currentPage]);
      reset();
    },
    onError: (err) => console.error("Create error:", err),
  });

  const updateMutation = useMutation({
    mutationFn: updateProduct,
    onSuccess: () => queryClient.invalidateQueries(["products", currentPage]),
    onError: (err) => console.error("Update error:", err),
  });

  const deleteMutation = useMutation({
    mutationFn: deleteProduct,
    onSuccess: () => queryClient.invalidateQueries(["products", currentPage]),
    onError: (err) => console.error("Delete error:", err),
  });

  // Handlers
  const onSubmit = (data) => {
    const productData = {
      ...data,
      categories: data.categories.split(","), // Convert comma-separated string to array
      current_price: Number(data.current_price),
    };
    createMutation.mutate({ token, productData });
  };

  const handleUpdate = (product) => {
    const updatedData = prompt("Enter new title:", product.title);
    if (updatedData) {
      updateMutation.mutate({
        token,
        productId: product._id,
        productData: { title: updatedData },
      });
    }
  };

  const handleDelete = (productId) => {
    if (window.confirm("Are you sure you want to delete this product?")) {
      deleteMutation.mutate({ token, productId });
    }
  };

  const handlePageChange = (page) => {
    if (page >= 1 && page <= lastPage) {
      setCurrentPage(page);
    }
  };

  if (!token || user?.role !== 1) {
    return (
      <Layout>
        <div className="mt-16 p-4 text-red-500">
          <p>You must be an admin to access this page.</p>
        </div>
      </Layout>
    );
  }

  if (isLoading) return <div>Loading...</div>;
  if (error) return <div>Error: {error.message}</div>;

  return (
    <Layout>
      <div className="mt-16 p-4">
        <h1 className="text-2xl mb-4">Product Management</h1>

        {/* Create Product Form */}
        <div className="mb-8">
          <h2 className="text-xl mb-2">Create New Product</h2>
          <form onSubmit={handleSubmit(onSubmit)} className="space-y-4">
            <div>
              <input
                {...register("title")}
                placeholder="Title"
                className="input w-full bg-white rounded-lg input-bordered"
              />
              {errors.title && (
                <p className="text-red-500 text-sm">{errors.title.message}</p>
              )}
            </div>
            <div>
              <input
                {...register("slug")}
                placeholder="Slug"
                className="input w-full bg-white rounded-lg input-bordered"
              />
              {errors.slug && (
                <p className="text-red-500 text-sm">{errors.slug.message}</p>
              )}
            </div>
            <div>
              <input
                {...register("brand")}
                placeholder="Brand ID"
                className="input w-full bg-white rounded-lg input-bordered"
              />
              {errors.brand && (
                <p className="text-red-500 text-sm">{errors.brand.message}</p>
              )}
            </div>
            <div>
              <input
                {...register("categories")}
                placeholder="Categories (comma-separated IDs)"
                className="input w-full bg-white rounded-lg input-bordered"
              />
              {errors.categories && (
                <p className="text-red-500 text-sm">
                  {errors.categories.message}
                </p>
              )}
            </div>
            <div>
              <input
                {...register("current_price", { valueAsNumber: true })}
                type="number"
                placeholder="Current Price"
                className="input w-full bg-white rounded-lg input-bordered"
              />
              {errors.current_price && (
                <p className="text-red-500 text-sm">
                  {errors.current_price.message}
                </p>
              )}
            </div>
            <div>
              <textarea
                {...register("description")}
                placeholder="Description"
                className="textarea w-full bg-white rounded-lg textarea-bordered"
              />
            </div>
            <button
              type="submit"
              disabled={createMutation.isLoading}
              className="btn btn-primary rounded-lg"
            >
              {createMutation.isLoading ? "Creating..." : "Create Product"}
            </button>
          </form>
        </div>

        {/* Product List */}
        <div className="overflow-x-auto">
          <table className="table w-full">
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Price</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              {products.map((product) => (
                <tr key={product._id}>
                  <td>{product._id}</td>
                  <td>{product.title}</td>
                  <td>{product.current_price}</td>
                  <td>
                    <button
                      onClick={() => handleUpdate(product)}
                      className="btn btn-sm btn-info mr-2"
                    >
                      Edit
                    </button>
                    <button
                      onClick={() => handleDelete(product._id)}
                      className="btn btn-sm btn-error"
                    >
                      Delete
                    </button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>

        {/* Pagination Controls */}
        <div className="mt-4 flex justify-center gap-2">
          <button
            onClick={() => handlePageChange(previousPage || 1)}
            disabled={!previousPage}
            className="btn btn-outline btn-sm"
          >
            Previous
          </button>
          <span className="self-center">
            Page {currentPage} of {lastPage} (Total: {total})
          </span>
          <button
            onClick={() => handlePageChange(nextPage || lastPage)}
            disabled={!nextPage}
            className="btn btn-outline btn-sm"
          >
            Next
          </button>
        </div>
      </div>
    </Layout>
  );
};

export default ProductManagement;
