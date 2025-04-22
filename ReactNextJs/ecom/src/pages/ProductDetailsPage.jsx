import { useParams } from "react-router";
import React from "react";
import Layout from "../layout/Layout";
import ProductDetailsComp from "../component/ProductDetailsComp";
import { useQuery, useQueryClient } from "@tanstack/react-query";
import { fetchProductDetails } from "../utils/fetchProductDetails";

const ProductDetailsPage = () => {
  const params = useParams();

  const client = useQueryClient();

  // Queries
  const query = useQuery({
    queryKey: ["product", params.slug],
    queryFn: () =>
      fetchProductDetails(params.slug).then((data) => {
        return data;
      }),
    enabled: !!params.slug,
    initialData: () => {
      return client
        .getQueryData("products")
        ?.find((p) => p.slug === params.slug);
    },
    refetchInterval: 1000,
    retry: 3,
    retryDelay: 1000,
  });

  if (query.isError) {
    return (
      <div>
        Error: {query.error ? query.error.message : "An error occurred"}
      </div>
    );
  }

  if (query.isLoading || !query.data) {
    return (
      <div>
        <br />
        <br />
        <br />
        <span className="loading loading-dots loading-xs"></span>
        <span className="loading loading-dots loading-sm"></span>
        <span className="loading loading-dots loading-md"></span>
        <span className="loading loading-dots loading-lg"></span>
        <span className="loading loading-dots loading-xl"></span>
        <span className="loading loading-dots loading-xs"></span>
        <span className="loading loading-dots loading-sm"></span>
        <span className="loading loading-dots loading-md"></span>
        <span className="loading loading-dots loading-lg"></span>
        <span className="loading loading-dots loading-xl"></span>
      </div>
    );
  }

  const data = query.data.data;

  return (
    <Layout>
      <div className="mt-16 bg-blue-500 p-4 text-white">
        <p>Product Details page</p>
        <ProductDetailsComp product={data} />
      </div>
    </Layout>
  );
};

export default ProductDetailsPage;
