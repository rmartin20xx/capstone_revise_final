import React from "react";
import './css/aboutpixtext.css';

export default function Aboutpictext({ data }) {
  return (
    <div>
      <div>
        {data.map((item, index) => (
          <div key={index} className="container">
            <h2 className="title">{item.title}</h2>
            <img src={item.imageUrls} alt={item.title} className="image" />
            <p className="description">{item.description}</p>
          </div>
        ))}
      </div>
    </div>
  );
}

Aboutpictext.defaultProps = {
  data: [
    {
      imageUrls:
        "https://a0.muscache.com/im/pictures/miso/Hosting-736194760184993424/original/0d554ee3-d6fa-4ec9-b125-d2fe4f9afdf6.jpeg?im_w=1200",
      title: "Tawi-Tawi Haven Hotel",
      description:
        "Welcome to Tawi-Tawi Haven Hotel, your haven of tranquility nestled in the captivating province of Tawi-Tawi, Philippines. Situated in the Bangsamoro Autonomous Region in Muslim Mindanao (BARMM), our hotel offers a serene retreat amidst the breathtaking landscapes of this southernmost province. With a commitment to exceptional service and a deep appreciation for the local culture, Tawi-Tawi Haven Hotel invites you to experience true Filipino hospitality at its finest.",
    },
    {
      imageUrls:
        "https://a0.muscache.com/im/pictures/miso/Hosting-728924394388127072/original/f72f4394-423e-49e0-ad25-8fe5315d5e47.jpeg?im_w=720",
      title: "Relaxing Places to Visit",
      description:
        "Unwind and reconnect with nature at Bud Bongao, a sacred mountain offering panoramic views of the surrounding islands and sea. Immerse yourself in the rich history of Tawi-Tawi by visiting the Bongao Peak, a historical landmark that offers a glimpse into the province's past. From enchanting natural wonders to cultural treasures, Tawi-Tawi has something for every traveler seeking an authentic and unforgettable experience.",
    },
    {
      imageUrls:
        "https://a0.muscache.com/im/pictures/miso/Hosting-736194760184993424/original/a8e3dae7-0fd4-461e-b9f8-dbb2b17fa2e9.jpeg?im_w=1200",
      title: "Clean Rooms with a Modern Touch",
      description:
        "Indulge in the comfort of our 500 meticulously designed rooms, each thoughtfully prepared to ensure a restful stay. Our rooms blend modern amenities with touches of local charm, providing a soothing ambiance for relaxation. Enjoy the convenience of complimentary Wi-Fi access, airport transfer services, and a host of other amenities that cater to your every need. Whether you're traveling for business or leisure, our hotel offers a seamless blend of comfort and functionality to enhance your stay.",
    },
  ],
};
