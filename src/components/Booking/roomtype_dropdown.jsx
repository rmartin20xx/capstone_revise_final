// RoomDropdown.jsx
import React, { useEffect, useState } from 'react';
import axios from 'axios';

const RoomDropdown = ({ onRoomSelect }) => {
  const [roomTypes, setRoomTypes] = useState([]);

  useEffect(() => {
    fetchRoomTypes();
  }, []);

  const fetchRoomTypes = () => {
    const url = 'http://localhost:80/hotel_resort_final/api/fetch_room.php'; // Replace "your_port" with the appropriate port number
    axios
      .get(url)
      .then(response => {
        setRoomTypes(response.data);
      })
      .catch(error => {
        console.error('Error:', error);
        setRoomTypes([]); // Set an empty array in case of an error
      });
  };

  const handleRoomSelect = e => {
    const selectedRoom = roomTypes.find(
      roomType => roomType.roomTypeId === e.target.value
    );
    onRoomSelect(selectedRoom);
  };

  return (
<select onChange={handleRoomSelect}>
  {roomTypes.map((roomType) => (
    <option key={roomType.roomTypeId} value={roomType.roomTypeId}>
      {roomType.roomType} - ₱{roomType.price.toFixed(2)}
    </option>
  ))}
</select>
  );
};

export default RoomDropdown;
