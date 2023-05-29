import React from "react";
import Hero from "../Heropage/heropage";
import Aboutus from "../About/about";

function LandingPage() {
  return (
    <>
      <div className="landing-page">
        <Hero />
      </div>
      <div className="landing-page">
        <Aboutus />
        
      </div>
    </>
  );
}

export default LandingPage;
