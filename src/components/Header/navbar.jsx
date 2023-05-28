import React from 'react';
import { Link } from 'react-router-dom';

function Navbar() {
  return (
<nav>
  <ul>
    <li>
      <Link to="/">Home</Link>
    </li>
    <li>
      <Link to="/rooms">Rooms</Link>
    </li>
    {/* <li>
      <Link to="/booking">Booking</Link>
    </li> */}
  </ul>
</nav>
  );
}

export default Navbar;
