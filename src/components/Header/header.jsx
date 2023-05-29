

import Navbar from "./navbar";
import Logo from "./logo";
import "./css/header.css";

const Header = () => {


  return (
    <div className="headerbox">
      <div className={`menu-container"}`}>
        <Navbar />
      </div>

      <div className="logo-container">
        <Logo />
      </div>
    </div>
  );
};

export default Header;
