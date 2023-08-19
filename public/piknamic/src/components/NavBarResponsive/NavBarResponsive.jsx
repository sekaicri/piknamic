import React, { useState } from "react";
import { Link } from "react-router-dom";
import "./NavBarResponsive.css";
import iniciarsesion from "../../Images/Boton Inicia Sesionmdpi.png";
import registrate from "../../Images/Boton Registratemdpi.png";
import logo from "../../Images/Imagotipo horizontal.png";

const NavBarResponsive = () => {
    const [navVisible, setNavVisible] = useState(false);

    const toggleNav = () => {
        setNavVisible(!navVisible);
    };

    return (
        <header>
            <img className="logo" src={logo} alt="Logo" />
            <button id="abrir" className="abrir-menu" onClick={toggleNav}>
                <i class="bi bi-view-list"></i>
            </button>
            <nav className={`nav ${navVisible ? "visible" : ""}`} id="nav">
                <button id="cerrar" className="cerrar-menu" onClick={toggleNav}>
                    <i class="bi bi-x-square"></i>
                </button>
                <ul className="nav-list">
                    <li><a href="#">Nosotros</a></li>
                    <li><a href="#">inspiración</a></li>
                    <li><a href="#">tarifas</a></li>
                    <li><a href="#">     <Link to="/sigin">
                        <img src={iniciarsesion} />
                    </Link>  </a></li>
                    <li><a href="#">             <Link to="/register">
                        <img src={registrate} />
                    </Link>  </a></li>
                </ul>
            </nav>
        </header>
    );
};

export default NavBarResponsive;