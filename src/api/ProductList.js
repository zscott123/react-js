import React, { useEffect, useState } from 'react'
import axios from "axios";
import ProductCard from '../components/ProductCard';
export default function ProductList() {
    const [product, setProduct] = useState();
    useEffect(() => {
        const fetchProducts = async () => {
            try {
                const responses = await axios.get('https://fakestoreapi.com/products');
                console.log(responses.data);

                responses.status === 200 ? setProduct(responses.data) : new Error("something went wrong!")
            } catch (error) {
                throw error;
            }
        }
        fetchProducts();
    }, []);
    return (
        <div class="col-md-12">
            <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5">
                {
                    product?.map((product, index) => (
                      <ProductCard key={index} product={product} />
                    ))
                }
            </div>
        </div>
    )
}
