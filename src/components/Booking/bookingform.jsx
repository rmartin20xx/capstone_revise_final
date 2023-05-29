import React, { useState } from "react";
import axios from "axios";
import RoomDropdown from "./roomtype_dropdown";

import "./css/bookingform.css"; // Import the CSS file for styling

const BookingForm = () => {
  const [customerName, setCustomerName] = useState("");
  const [contactNo, setContactNo] = useState("");
  const [email, setEmail] = useState("");
  const [checkIn, setCheckIn] = useState("");
  const [checkOut, setCheckOut] = useState("");
  const [totalPrice, setTotalPrice] = useState("");
  const [address, setAddress] = useState("");
  const [selectedRoomTypeId, setSelectedRoomTypeId] = useState(null); // State for storing the selected room type ID

  const handleRoomSelect = (room) => {
    setSelectedRoomTypeId(room.roomTypeId); // Set the selected room type ID
    setTotalPrice(room.price);
    console.log("Selected Room:", room.roomTypeId);
    console.log("Selected Room:", room.price);
  };

  const computeTotalDays = (checkInDate, checkOutDate) => {
    const startDate = new Date(checkInDate);
    const endDate = new Date(checkOutDate);
    const timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
    const totalDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
    return totalDays;
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    const totalDays = computeTotalDays(checkIn, checkOut);
    const computedTotalPrice = totalDays * totalPrice;

    const bookingData = {
      customer_name: customerName,
      contact_no: contactNo,
      email: email,
      address: address,
      check_in: checkIn,
      check_out: checkOut,
      total_price: computedTotalPrice,
      room_type_id: selectedRoomTypeId,
    };

    const totalPriceFormatted = computedTotalPrice.toFixed(2);
    const totalPriceWithCurrency = `₱${totalPriceFormatted}`;

    const confirmMessage = `Are you sure you want to save this booking?\n\nCustomer Name: ${customerName}\nContact No: ${contactNo}\nEmail: ${email}\nCheck-in: ${checkIn}\nCheck-out: ${checkOut}\nTotal Days: ${totalDays}\nTotal Price: ${totalPriceWithCurrency}\nAddress: ${address}`;

    if (window.confirm(confirmMessage)) {
      axios
        .post(
          "http://localhost:80/hotel_resort_final/api/save_booking.php",
          bookingData
        )
        .then((response) => {
          console.log(response.data);
          // Handle success or display a success message
        })
        .catch((error) => {
          console.error(error);
          // Handle error or display an error message
        });
    }
  };

  const currentDate = new Date().toISOString().split("T")[0];

  return (
    <form onSubmit={handleSubmit} className="booking-form">
      <h2>Booking Form</h2>
      <RoomDropdown onRoomSelect={handleRoomSelect} />
      <label className="form-label">
        Customer Name:
        <input
          type="text"
          value={customerName}
          onChange={(e) => setCustomerName(e.target.value)}
          required
          className="form-input"
        />
      </label>
      <label className="form-label">
        Contact No:
        <input
          type="text"
          value={contactNo}
          onChange={(e) => setContactNo(e.target.value)}
          required
          className="form-input"
        />
      </label>
      <label className="form-label">
        Email:
        <input
          type="email"
          value={email}
          onChange={(e) => setEmail(e.target.value)}
          required
          className="form-input"
        />
      </label>
      <label className="form-label">
        Check-in:
        <input
          type="date"
          value={checkIn}
          onChange={(e) => setCheckIn(e.target.value)}
          min={currentDate}
          required
          className="form-input"
        />
      </label>
      <label className="form-label">
        Check-out:
        <input
          type="date"
          value={checkOut}
          onChange={(e) => setCheckOut(e.target.value)}
          min={checkIn || currentDate}
          required
          className="form-input"
        />
      </label>
      <label className="form-label total-price">
        Total Price:
        <input
          type="number"
          step="0.01"
          value={totalPrice}
          onChange={(e) => setTotalPrice(parseFloat(e.target.value))}
          className="form-input"
        />
      </label>
      <label className="form-label">
        Address:
        <input
          type="text"
          value={address}
          onChange={(e) => setAddress(e.target.value)}
          required
          className="form-input"
        />
      </label>
      <button type="submit" className="submit-btn">Submit</button>
    </form>
  );
};

export default BookingForm;
