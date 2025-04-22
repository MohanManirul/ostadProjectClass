const ProductDetailsComp = ({ product }) => {
  return (
    <div>
      <h1>Product Details</h1>
      <br />
      <div className="overflow-x-auto">
        <table className="table">
          {/* head */}
          <thead>
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Description</th>
              <th>Regular Price</th>
              <th>Current Price</th>
              <th>Brand</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{product._id}</td>
              <td>{product.title}</td>
              <td>{product.description}</td>
              <td>{product.regular_price}</td>
              <td>{product.current_price}</td>
              <td>
                <img src={product.brand?.icon} width={20} height={20} alt="" />
                {product.brand.title}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default ProductDetailsComp;
