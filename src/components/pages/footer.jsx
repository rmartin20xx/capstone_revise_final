import React from "react";
import "../Footer/footer.css";
import { Link } from "react-router-dom";

import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
  faFacebook,
  faInstagram,
  faTwitter,
} from "@fortawesome/free-brands-svg-icons";

// import './Footer.css'; // Import the Footer.css file

export default function Footer() {
  return (
    <div className="footer">
      <div className="footer-content">
        <div className="footer-section">
          <h4>Follow Us</h4>
          <ul>
            <li>
              <a href="/">
                <FontAwesomeIcon icon={faFacebook} />
              </a>
            </li>
            <li>
              <a href="/">
                <FontAwesomeIcon icon={faInstagram} />
              </a>
            </li>
            <li>
              <a href="/">
                <FontAwesomeIcon icon={faTwitter} />
              </a>
            </li>
          </ul>
        </div>

        <div className="footer-section">
          <h4>Contact</h4>
          <p>Our Address: Tawi Tawi</p>
          <p>Phone: 123456789</p>
          <p>Mobile: 987654321</p>
          <p>Email: example@example.com</p>
        </div>
        <div className="footer-section">
          <h4>Our Partners</h4>
          <div className="partner-images">
            <img
              className="partners"
              src="https://mrtravel.com.ph/wp-content/uploads/2014/03/dot-new-logo.png"
              alt="Partner 1"
            />
            <img
              className="partners"
              src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/56/Official_Seal_of_Tawi-Tawi.svg/2048px-Official_Seal_of_Tawi-Tawi.svg.png"
              alt="Partner 2"
            />
            <img
              className="partners"
              src="https://images.squarespace-cdn.com/content/v1/613d9f7e68a4c91bdaa6e75c/433693bc-6901-4718-91c7-d209a4f67435/Logo_1_site_logo.png"
              alt="Partner 3"
            />
          </div>
        </div>
      </div>
      <div>
        <Link to="/admin">System Login</Link>
      </div>
    </div>
  );
}
