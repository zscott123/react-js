import React, { useEffect, useState } from 'react';
import axios from "axios";
import ProductCard from '../components/ProductCard';

export default function ProductList() {
    const [product, setProduct] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const fetchProducts = async () => {
            try {
                setLoading(true);
                const token = localStorage.getItem('access_token');

                if (!token) {
                    window.location.href = '/login';
                    return;
                }

                const responses = await axios.get('http://localhost:8000/api/auth/product', {
                    headers: {
                        Accept: 'application/json',
                        Authorization: `Bearer ${token}`
                    }
                });

                if (responses.status === 200) {
                    setProduct(responses.data);
                } else {
                    throw new Error("Something went wrong!");
                }
            } catch (error) {
                if (error.response && error.response.status === 401) {
                    localStorage.removeItem('access_token');
                    window.location.href = '/login';
                    return;
                }
                setError(error.message);
                console.error("Error fetching products:", error);
            } finally {
                setLoading(false);
            }
        };

        fetchProducts();
    }, []);

    if (loading) {
        return <div>Loading...</div>;
    }

    if (error) {
        return <div>Error: {error}</div>;
    }

    return (
        <div className="col-md-12">
            <div className="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5">
                {product.length === 0 ? (
                    <div>No products found</div>
                ) : (
                    product.map((product, index) => (
                        <ProductCard key={index} product={product} />
                    ))
                )}
            </div>
        </div>
    );
}
