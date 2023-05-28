import React, { useState } from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faBars } from "@fortawesome/free-solid-svg-icons";
import Navbar from "./navbar";
import Logo from "./logo";
import "./css/header.css";

const Header = () => {
  const [isOpen, setIsOpen] = useState(false);

  const toggleMenu = () => {
    setIsOpen(!isOpen);
  };

  return (
    <div className="headerbox">
      <div className={`menu-container ${isOpen ? "open" : ""}`}>
        <Navbar />
      </div>

      <div className="logo-container">
        <Logo />
      </div>

      <div className="burger-icon" onClick={toggleMenu}>
        <FontAwesomeIcon icon={faBars} />
      </div>
    </div>
  );
};

export default Header;
