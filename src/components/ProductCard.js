import React from "react";
import { useCart } from "../context/CartContext";

export default function ProductCard({ product }) {
  const { name, description, img, stock, price } = product;
  const { addToCart } = useCart();

  return (
    <div className="col">
      <div className="product-item">
        <figure>
          <a href="/" title={name}>
            <img
              style={{ width: "150px", height: "200px" }}
              src={img}
              alt={name}
              className="tab-image"
            />
          </a>
        </figure>
        <div className="d-flex flex-column text-center">
          <h3 className="fs-6 fw-normal">{name}</h3>
          <p className="text-muted fs-7 mb-1">{description}</p>
          <div>
            <span className="rating">
              <svg width="18" height="18" className="text-warning">
                <use xlinkHref="#star-full"></use>
              </svg>
              <svg width="18" height="18" className="text-warning">
                <use xlinkHref="#star-full"></use>
              </svg>
              <svg width="18" height="18" className="text-warning">
                <use xlinkHref="#star-full"></use>
              </svg>
              <svg width="18" height="18" className="text-warning">
                <use xlinkHref="#star-full"></use>
              </svg>
              <svg width="18" height="18" className="text-warning">
                <use xlinkHref="#star-half"></use>
              </svg>
            </span>
            <span>(222)</span>
          </div>
          <div className="d-flex justify-content-center align-items-center gap-2">
            <span className="text-dark fw-semibold">${price}</span>
            <span className="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">
              {stock > 0 ? `In stock: ${stock}` : "Out of stock"}
            </span>
          </div>
          <div className="button-area p-3 pt-0">
            <div className="row g-1 mt-2">
              <div className="col-3">
                <input
                  type="number"
                  name="quantity"
                  className="form-control border-dark-subtle input-number quantity"
                  defaultValue="1"
                  min="1"
                  max={stock}
                />
              </div>
              <div className="col-7">
                <a
                  href="#"
                  className="btn btn-primary rounded-1 p-2 fs-7 btn-cart"
                  onClick={() => addToCart(product)}
                >
                  <svg width="18" height="18">
                    <use xlinkHref="#cart"></use>
                  </svg>{" "}
                  Add to Cart
                </a>
              </div>
              <div className="col-2">
                <a href="#" className="btn btn-outline-dark rounded-1 p-2 fs-6">
                  <svg width="18" height="18">
                    <use xlinkHref="#heart"></use>
                  </svg>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
