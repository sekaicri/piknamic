import React from "react";
import "./Landing.css";
import CarouselOne from "../../components/CarouselOne/CarouselOne";
import "react-responsive-carousel/lib/styles/carousel.min.css";
import BoxTwo from "../../components/BoxTwo/BoxTwo";
import CarouselTwo from "../../components/CarouselTwo/CarouselTwo";
import Foot from "../../components/Foot/Foot";
import NavBarResponsive from "../../components/NavBarResponsive/NavBarResponsive"
import BoxOne from "../../components/BoxOne/BoxOne"
import ComponentRender3D from "../../components/Imag3D/ComponentRender3D"
import Header from "../../components/Header/Header";

const Landing = () => {
  return (
    <div className="landing-container">
      <div className="header">
        <Header />
      </div>

      <div className="text2">
        <BoxTwo />
      </div>

      <div className="carousel1">
        <CarouselOne />
      </div>

      <div className="container1">
        <h1 class="black-text">
          ¿Por qué <span className="orangetext">Piknamic?</span>
        </h1>
        <h3>
          Con Piknamic tienes un sin fin de posibilidades creativas que te
          ayudaran a
        </h3>
        <h3>mostrar tus proyectos con el atractivo que se merecen ¿Facil,eficaz y divertido!</h3>
      </div>

      <div className="carousel2">
        <CarouselTwo />
      </div>

      <footer className="footer">
        <Foot />
      </footer>
    </div>
  );
};

export default Landing;