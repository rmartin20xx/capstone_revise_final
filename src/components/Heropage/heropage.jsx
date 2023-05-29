import React from "react";
import Button from "react-bootstrap/Button";
import { Link } from "react-router-dom";
import "./css/hero.css";

export default function Hero() {
  return (
    <div className="hero">
      <div className="hero-content">
        <h1>Where Luxury Meets Tranquility</h1>
        <p>Escape to serenity and indulge in opulent bliss.</p>
        <div>
          <Link to="/rooms" className="logo-link">
            <Button className="book-now">Book Now</Button>
          </Link>
        </div>
      </div>
    </div>
  );
}
