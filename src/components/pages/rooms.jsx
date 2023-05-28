import React, { useEffect, useState } from "react";
import axios from "axios";
import { Link } from "react-router-dom";
import "../Rooms/css/rooms.css";

const RoomTypes = () => {
  const [roomTypes, setRoomTypes] = useState([]);

  useEffect(() => {
    fetchRoomTypes();
  }, []);

  const fetchRoomTypes = () => {
    axios
      .get("http://localhost:80/hotel_resort_final/api/fetch_room.php")
      .then((response) => {
        setRoomTypes(response.data);
      })
      .catch((error) => {
        console.error(error);
      });
  };

  return (
    <div>
      <h1>Room type</h1>
      {roomTypes.map((roomType) => (
        <React.Fragment key={roomType.roomTypeId}>
          <div className="card">
            <div className="imagebox">
              <img src={roomType.imagePath} alt="Room" className="card-image" />
            </div>
            <div className="card-content">
              <h3 className="card-title">{roomType.roomType}</h3>
              <p className="card-description">{roomType.roomTypeDesc}</p>
              {roomType.price && typeof roomType.price === "number" ? (
                <p className="card-price">
                  ₱
                  {roomType.price.toLocaleString("en-PH", {
                    minimumFractionDigits: 2,
                  })}
                </p>
              ) : (
                <p className="card-price">Price not available</p>
              )}
              <p className="card-max-person">
                Capacity: {roomType.maxPerson} Person
              </p>
              <Link
                to={{
                  pathname: "/booking",
                  search: `?room_type_id=${
                    roomType.roomTypeId
                  }&room_type=${encodeURIComponent(
                    roomType.roomType
                  )}&price=${encodeURIComponent(roomType.price)}`,
                }}
                className="btn-reserve"
              >
                Reserve
              </Link>
            </div>
          </div>
        </React.Fragment>
      ))}
    </div>
  );
};

export default RoomTypes;
