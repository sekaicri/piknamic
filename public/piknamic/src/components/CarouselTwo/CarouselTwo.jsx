import React from "react";
import Slider from "react-slick";
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
import imagen1 from "../../Images/burbuja piknamic.jpeg";
import imagen2 from "../../Images/imagen3d.jpg";
import "./CarouselTwo.css";

const CarouselTwo = () => {
  const settings = {
    autoplay: true,
    autoplaySpeed: 2000,
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
    prevArrow: null, // Oculta la flecha de navegación izquierda
    nextArrow: null, // Oculta la flecha de navegación derecha
  };

  return (
    <div>
      <div className="carrusel">
        <Slider {...settings}>
        <div className="carrusel-item">
            <img src={imagen1} alt="" />
          </div>
          <div className="carrusel-item">
            <img src={imagen2} alt="" />
          </div>
          <div className="carrusel-item">
            <img src={imagen1} alt="" />
          </div>
          <div className="carrusel-item">
            <img src={imagen2} alt="" />
          </div>
          <div className="carrusel-item">
            <img src={imagen1} alt="" />
          </div>
          <div className="carrusel-item">
            <img src={imagen2} alt="" />
          </div>
          <div className="carrusel-item">
            <img src={imagen1} alt="" />
          </div>
          <div className="carrusel-item">
            <img src={imagen2} alt="" />
          </div>
        </Slider>
      </div>

      <div className="carrusel">
        <Slider {...settings} rtl>
          <div className="carrusel-item">
            <img src={imagen2} alt="" />
          </div>
          <div className="carrusel-item">
            <img src={imagen1} alt="" />
          </div>
          <div className="carrusel-item">
            <img src={imagen2} alt="" />
          </div>
          <div className="carrusel-item">
            <img src={imagen1} alt="" />
          </div>
          <div className="carrusel-item">
            <img src={imagen2} alt="" />
          </div>
          <div className="carrusel-item">
            <img src={imagen1} alt="" />
          </div>
        </Slider>
      </div>
    </div>
  );
};

export default CarouselTwo;