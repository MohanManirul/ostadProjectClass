import ProductList from "../component/Product-list.jsx";
import Layout from '../layout/Layout.jsx';

const ProductPage = () => {
    return (
        <div>
            <Layout>
                <ProductList/>
            </Layout>
        </div>
    );
};

export default ProductPage;