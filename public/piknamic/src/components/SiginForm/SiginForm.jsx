import React, { useState } from "react";
import { Link } from "react-router-dom";
import "./SiginForm.css";
import { EyeIcon, EyeOffIcon } from '@heroicons/react/outline';
import axios from "axios";
import iniciarsesion from "../../Images/Boton Inicia Sesionmdpi.png"
import panel from "../../Images/panel_inicio_registro.png"


const SiginForm = () => {
  const [showPassword, setShowPassword] = useState(false);
  const [formData, setFormData] = useState({
    email: "",
    password: "",
  });
  const [isEmailValid, setIsEmailValid] = useState(true);
  const [errorMessage, setErrorMessage] = useState("");

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prevData) => ({ ...prevData, [name]: value }));
    if (name === "email") {
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      setIsEmailValid(emailPattern.test(value));
    }
  };

  const handleTogglePassword = () => {
    setShowPassword((prevShow) => !prevShow);
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    
    if (!formData.email || !formData.password) {
      setErrorMessage("Por favor, completa todos los campos.");
      return;
    }
    
    if (!isEmailValid) {
      setErrorMessage("El correo electrónico no es válido.");
      return;
    }

    // Si todo está bien, realiza la solicitud HTTP
    axios
      .post("https://piknamic.com/api/login", formData)
      .then((res) => {
        console.log("Inicio de sesión exitoso", res);
        // Realizar acciones adicionales después del inicio de sesión exitoso
      })
      .catch((err) => {
        console.log("Error al iniciar sesión", err);
        // Puedes establecer un mensaje de error aquí si la solicitud falla
      });
  };


  return (
    <div className="siginForm">
      <img src={panel} className="panelRegister" />
      <div className="form">
        <div className="iniciar">Iniciar Sesión</div>
        <form onSubmit={handleSubmit}>
          <div className="form-group">
            <input
              type="email"
              id="email"
              name="email"
              placeholder="Correo"
              value={formData.email}
              onChange={handleChange}
            />
          </div>
          {!isEmailValid && <p className="error-message">Este campo debe ser un correo electrónico válido</p>}

          <div className="form-group">
            <div className="password-input">
              <input
                type={showPassword ? "text" : "password"}
                id="password"
                name="password"
                placeholder="Contraseña"
                value={formData.password}
                onChange={handleChange}
              />
              {showPassword ? (
                <EyeOffIcon className="eye-icon" onClick={handleTogglePassword} />
              ) : (
                <EyeIcon className="eye-icon" onClick={handleTogglePassword} />
              )}
            </div>
          </div>
          <div className="olvidado">
            <Link to="/passwordrecovery" style={{ color: '#EE9A12', textDecoration: 'none' }}>
              He olvidado  mi contraseña
            </Link>
          </div>

          <div className="checkbox-container">
            <label>
              <input type="checkbox" className="checkbox-input" />
              Mantener mi sesión iniciada
            </label>
          </div>
          {errorMessage && <p className="error-message">{errorMessage}</p>}
          <div className="submit-button">
            <button type="submit">
              <img src={iniciarsesion} alt="Iniciar Sesión" />
            </button>
          </div>   
        </form>
        <div className="notienescuenta" style={{ color: '#000', textDecoration: 'none' }}>
          ¿No tienes cuenta? {' '}
          <Link to="/register" style={{ color: '#EE9A12', textDecoration: 'none' }}>
            Regístrate
          </Link>
        </div>
      </div>
    </div>
  );
};

export default SiginForm;