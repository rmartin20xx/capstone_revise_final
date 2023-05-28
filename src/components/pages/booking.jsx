import React, { useState } from 'react';

const BookingPage = () => {
  const [checkInDate, setCheckInDate] = useState('');
  const [checkOutDate, setCheckOutDate] = useState('');
  const [guests, setGuests] = useState(1);

  const handleCheckInDateChange = (e) => {
    setCheckInDate(e.target.value);
  };

  const handleCheckOutDateChange = (e) => {
    setCheckOutDate(e.target.value);
  };

  const handleGuestsChange = (e) => {
    setGuests(e.target.value);
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    // Perform booking logic here
    console.log('Booking submitted');
  };

  return (
    <div>
      <h1>Hotel Booking</h1>
      <form onSubmit={handleSubmit}>
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
        <button type="submit">Book</button>
      </form>
    </div>
  );
};

export default BookingPage;
