import React from "react";
import Bookingform from "../Booking/bookingform";
import '../Booking/css/bookingform.css';

const Booking = () => {
  return (
    <div>
      <h1>Hotel Booking</h1>
      <div className="bookingform-box">
        <Bookingform />
      </div>
    </div>
  );
};

export default Booking;
