import React, { useState, useEffect } from 'react';

export default function Aboutpix({ imageUrls, activeIndexDefault, intervalDuration }) {
  const [activeIndex, setActiveIndex] = useState(activeIndexDefault);

  useEffect(() => {
    const handleSlideshow = () => {
      setActiveIndex((prevIndex) => (prevIndex + 1) % imageUrls.length);
    };

    const interval = setInterval(handleSlideshow, intervalDuration);

    return () => clearInterval(interval);
  }, [imageUrls.length, intervalDuration]);

  return (
    <div className="aboutpix-container">
      <div className="slider">
        {imageUrls.map((imageUrl, index) => (
          <img
            key={index}
            src={imageUrl}
            alt=""
            className={`slide ${index === activeIndex ? 'active' : ''}`}
          />
        ))}
      </div>
    </div>
  );
}

Aboutpix.defaultProps = {
  imageUrls: [
    'https://a0.muscache.com/im/pictures/miso/Hosting-736194760184993424/original/0d554ee3-d6fa-4ec9-b125-d2fe4f9afdf6.jpeg?im_w=1200',
    'https://a0.muscache.com/im/pictures/miso/Hosting-736194760184993424/original/12941cec-e723-42ff-ae71-39626ed4174a.jpeg?im_w=1200',
    'https://a0.muscache.com/im/pictures/miso/Hosting-736194760184993424/original/a8e3dae7-0fd4-461e-b9f8-dbb2b17fa2e9.jpeg?im_w=1200',
    'https://a0.muscache.com/im/pictures/miso/Hosting-736194760184993424/original/2d10d5e0-ffe8-44c2-b8e9-5cdf56727d62.jpeg?im_w=1200',
    'https://a0.muscache.com/im/pictures/miso/Hosting-736194760184993424/original/2c1778b7-063b-44f3-80c8-7b29df0a0958.jpeg?im_w=1200',
  ],
  activeIndexDefault: 0,
  intervalDuration: 5000,
};
