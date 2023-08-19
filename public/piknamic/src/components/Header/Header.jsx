import React from "react";
import "./Header.css";
import BoxOne from "../../components/BoxOne/BoxOne";
import "react-responsive-carousel/lib/styles/carousel.min.css";
import ComponenteRender3D from "../../components/Imag3D/ComponentRender3D";
import NavBarResponsive from "../NavBarResponsive/NavBarResponsive";


const Header = () => {
  return (
    <div>
      <div className="header-container">
        <div className="navbar">
          <NavBarResponsive />
        </div>
        <div className="line">
          <div className="box">
            <BoxOne />
          </div>
        
        <div className="image">
          <ComponenteRender3D />
        </div>
        </div>
      </div>
    </div>
  );
};

export default Header;