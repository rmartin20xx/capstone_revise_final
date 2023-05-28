import React, { useState } from 'react';
import { useLocation } from 'react-router-dom';

const BookingPage = () => {
  const [checkInDate, setCheckInDate] = useState('');
  const [checkOutDate, setCheckOutDate] = useState('');
  const [guests, setGuests] = useState(1);
  const [guestName, setGuestName] = useState('');
  const [contactNumber, setContactNumber] = useState('');
  const [email, setEmail] = useState('');
  const [address, setAddress] = useState('');

  const location = useLocation();
  const { search } = location;
  const params = new URLSearchParams(search);
  const roomTypeId = params.get('room_type_id');
  const roomType = params.get('room_type');
  const price = params.get('price');

  const handleCheckInDateChange = (e) => {
    setCheckInDate(e.target.value);
  };

  const handleCheckOutDateChange = (e) => {
    setCheckOutDate(e.target.value);
  };

  const handleGuestsChange = (e) => {
    setGuests(e.target.value);
  };

  const handleGuestNameChange = (e) => {
    setGuestName(e.target.value);
  };

  const handleContactNumberChange = (e) => {
    setContactNumber(e.target.value);
  };

  const handleEmailChange = (e) => {
    setEmail(e.target.value);
  };

  const handleAddressChange = (e) => {
    setAddress(e.target.value);
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    // Perform booking logic here
    console.log('Booking submitted');
  };

  return (
    <div>
      <h1>Hotel Booking</h1>
      <h2>Room Type id: {roomTypeId}</h2>
      <h2>Room: {roomType}</h2>
      <h3>Price: {price}</h3>
      <form onSubmit={handleSubmit}>
        <div>
          <input type="hidden" value={roomTypeId} />
        </div>
        <div>
          <label>Check-in date:</label>
          <input type="date" value={checkInDate} onChange={handleCheckInDateChange} />
        </div>
        <div>
          <label>Check-out date:</label>
          <input type="date" value={checkOutDate} onChange={handleCheckOutDateChange} />
        </div>
        <div>
          <label>Guests:</label>
          <input type="number" value={guests} onChange={handleGuestsChange} />
        </div>
        <div>
          <label>Guest Name:</label>
          <input type="text" value={guestName} onChange={handleGuestNameChange} />
        </div>
        <div>
          <label>Contact Number:</label>
          <input type="text" value={contactNumber} onChange={handleContactNumberChange} />
        </div>
        <div>
          <label>Email:</label>
          <input type="email" value={email} onChange={handleEmailChange} />
        </div>
        <div>
          <label>Address:</label>
          <textarea value={address} onChange={handleAddressChange} />
        </div>
        <button type="submit">Book</button>
      </form>
    </div>
  );
};

export default BookingPage;
