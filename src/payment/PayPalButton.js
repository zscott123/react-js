import React, { useEffect } from "react";

const PayPalButton = ({ totalAmount }) => {
  useEffect(() => {
    if (!document.getElementById("paypal-button-container").hasChildNodes()) {
      // Validate and format totalAmount
      const formattedAmount = parseFloat(totalAmount).toFixed(2);
      if (!formattedAmount || parseFloat(formattedAmount) <= 0) {
        console.error("Invalid amount:", totalAmount);
        return; // Prevent rendering if the amount is invalid
      }

      window.paypal
        .Buttons({
          createOrder: (data, actions) => {
            return actions.order
              .create({
                purchase_units: [
                  {
                    amount: {
                      value: formattedAmount,
                    },
                  },
                ],
              })
              .catch((err) => {
                console.error("Error creating order:", err);
              });
          },
          onApprove: (data, actions) => {
            return actions.order.capture().then((details) => {
              alert(
                "Transaction completed by " + details.payer.name.given_name
              );
              // Handle successful transaction here
              localStorage.clear();
              window.location.reload();
            });
          },
          onError: (err) => {
            console.error(err);
            // Handle errors here
          },
        })
        .render("#paypal-button-container");
    }
    console.log(totalAmount);
  }, [totalAmount]);

  return (
    <div className="container-paypal" style={{ padding: "24px" }}>
      <h4 style={{ padding: "8px" }}>PayPal Payment</h4>
      <div id="paypal-button-container"></div>
    </div>
  );
};

export default PayPalButton;
