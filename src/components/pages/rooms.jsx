import React, { useEffect, useState } from 'react';
import axios from 'axios';

function RoomTypes() {
  const [roomTypes, setRoomTypes] = useState([]);

  useEffect(() => {
    fetchRoomTypes();
  }, []);

  const fetchRoomTypes = () => {
    axios.get('/FINAL_HOTEL/fetch_room_types.php')
      .then(response => {
        setRoomTypes(response.data);
      })
      .catch(error => {
        console.log(error);
      });
  };

  return (
    <div>
      {roomTypes.length > 0 ? (
        roomTypes.map((roomType) => (
          <div key={roomType.room_type_id}>
            {/* Render the room type data */}
          </div>
        ))
      ) : (
        <p>No room types found.</p>
      )}
    </div>
  );
}

export default RoomTypes;
