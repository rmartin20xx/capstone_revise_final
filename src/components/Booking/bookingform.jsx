import React, { useState } from 'react';
import axios from 'axios';

const BookingForm = () => {
  const [customerName, setCustomerName] = useState('');
  const [contactNo, setContactNo] = useState('');
  const [email, setEmail] = useState('');
  const [roomId, setRoomId] = useState('');
  const [bookingDate, setBookingDate] = useState('');
  const [checkIn, setCheckIn] = useState('');
  const [checkOut, setCheckOut] = useState('');
  const [totalPrice, setTotalPrice] = useState('');
  const [remainingPrice, setRemainingPrice] = useState('');
  const [paymentStatus, setPaymentStatus] = useState('');
  const [idCardType, setIdCardType] = useState(''); // Add state for id card type
  const [idCardNo, setIdCardNo] = useState(''); // Add state for id card number
  const [address, setAddress] = useState(''); // Add state for address

  const handleSubmit = (e) => {
    e.preventDefault();

    const bookingData = {
      customer_name: customerName,
      contact_no: contactNo,
      email: email,
      id_card_type_id: idCardType,
      id_card_no: idCardNo,
      address: address,
      room_id: roomId,
      booking_date: bookingDate,
      check_in: checkIn,
      check_out: checkOut,
      total_price: totalPrice,
      remaining_price: remainingPrice,
      payment_status: paymentStatus,
    };

    axios.post('http://localhost:80/hotel_resort_final/api/save_booking.php', bookingData)
      .then((response) => {
        console.log(response.data);
        // Handle success or display a success message
      })
      .catch((error) => {
        console.error(error);
        // Handle error or display an error message
      });
  };

  return (
    <form onSubmit={handleSubmit}>
      <h2>Booking Form</h2>
      <label>
        Customer Name:
        <input type="text" value={customerName} onChange={(e) => setCustomerName(e.target.value)} required />
      </label>
      <label>
        Contact No:
        <input type="text" value={contactNo} onChange={(e) => setContactNo(e.target.value)} required />
      </label>
      <label>
        Email:
        <input type="email" value={email} onChange={(e) => setEmail(e.target.value)} required />
      </label>
      <label>
        Room ID:
        <input type="text" value={roomId} onChange={(e) => setRoomId(e.target.value)} required />
      </label>
      <label>
        Booking Date:
        <input type="date" value={bookingDate} onChange={(e) => setBookingDate(e.target.value)} required />
      </label>
      <label>
        Check-in:
        <input type="date" value={checkIn} onChange={(e) => setCheckIn(e.target.value)} required />
      </label>
      <label>
        Check-out:
        <input type="date" value={checkOut} onChange={(e) => setCheckOut(e.target.value)} required />
      </label>
      <label>
        Total Price:
        <input type="number" step="0.01" value={totalPrice} onChange={(e) => setTotalPrice(e.target.value)} required />
      </label>
      <label>
        Remaining Price:
        <input type="number" step="0.01" value={remainingPrice} onChange={(e) => setRemainingPrice(e.target.value)} required />
      </label>
      <label>
        Payment Status:
        <input type="text" value={paymentStatus} onChange={(e) => setPaymentStatus(e.target.value)} required />
      </label>
      <label>
        ID Card Type: {/* Add input for ID Card Type */}
        <input type="text" value={idCardType} onChange={(e) => setIdCardType(e.target.value)} required />
      </label>
      <label>
        ID Card No: {/* Add input for ID Card Number */}
        <input type="text" value={idCardNo} onChange={(e) => setIdCardNo(e.target.value)} required />
      </label>
      <label>
        Address: {/* Add input for Address */}
        <input type="text" value={address} onChange={(e) => setAddress(e.target.value)} required />
      </label>
      <button type="submit">Submit</button>
    </form>
  );
};

export default BookingForm;
