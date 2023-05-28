import "./App.css";
import {Route, Routes } from "react-router-dom";

import Landingpage from "./components/pages/landingpage";
import BookingPage from "./components/pages/booking";
import Footer from "./components/pages/footer";
import Rooms from "./components/pages/rooms";


import Header from "./components/Header/header";


function App() {
  return (
    <>
    <Header/>


      <Routes>
        <Route path="/" element={<Landingpage />} />
        <Route path="/booking" element={<BookingPage />} />
        <Route path="/rooms" element={<Rooms />} />
      </Routes>


      <Footer/>
      
    </>
  );
}

export default App;
