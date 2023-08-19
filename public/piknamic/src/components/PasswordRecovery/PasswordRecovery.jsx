import React, { useState } from "react";
import "./PasswordRecovery.css";
import { EyeIcon, EyeOffIcon } from '@heroicons/react/outline';
import axios from "axios";
import panel from "../../Images/panel_inicio_registro.png"
import iniciarsesion from "../../Images/Boton Inicia Sesionmdpi.png"

const PasswordRecovery = () => {
  const [showPassword, setShowPassword] = useState(false);
  const [showConfirmPassword, setShowConfirmPassword] = useState(false);
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    password: "",
    confirmPassword: "",
  });

  const [formErrors, setFormErrors] = useState({
    email: "",
    password: "",
    confirmPassword: "",
  });

  const handleChange = (event) => {
    const { name, value } = event.target;
    setFormData({ ...formData, [name]: value });
    setFormErrors({ ...formErrors, [name]: "" });
  };

  const handleTogglePassword = () => {
    setShowPassword((prevShow) => !prevShow);
  };

  const handleToggleConfirmPassword = () => {
    setShowConfirmPassword((prevShow) => !prevShow);
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    // Validación del correo electrónico usando una expresión regular
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(formData.email)) {
      setFormErrors({ ...formErrors, email: "Ingrese un correo válido" });
      return;
    }

    // Validación de la contraseña
    if (formData.password !== formData.confirmPassword) {
      setFormErrors({
        ...formErrors,
        confirmPassword: "Las contraseñas no coinciden",
      });
      return;
    }

    if (formData.password.length < 8) {
      setFormErrors({
        ...formErrors,
        password: "La contraseña debe tener como mínimo 8 caracteres",
      });
      return;
    }

    axios
      .post("https://piknamic.com/api/register", formData)
      .then((res) => console.log("el usuario fue creado con éxito", res))
      .catch((err) => {
        console.log("este usuario ya existe", err);
      });
  };

  return (
    <div className="registerForm">
      <img src={panel} className="panel" />
      <div className="formPanel">
        <div className="cambioContraseña">Cambiar contraseña</div>        
        <form onSubmit={handleSubmit} noValidate>
          <div className="form-group">           
          </div>
          <div className="form-group">
            <input
              type="email"
              id="email"
              name="email"
              placeholder="Correo"
              value={formData.email}
              onChange={handleChange}
            />
            {formErrors.email && (
              <p className="error-message">{formErrors.email}</p>
            )}
          </div>

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
            {formErrors.password && (
              <p className="error-message">{formErrors.password}</p>
            )}
          </div>

          <div className="form-group">
            <div className="password-input">
              <input
                type={showConfirmPassword ? "text" : "password"}
                id="password-confirm"
                name="password-confirm"
                placeholder="Confirmar contraseña"
                value={formData.confirmPassword}
                onChange={handleChange}
              />
              {showConfirmPassword ? (
                <EyeOffIcon
                  className="eye-icon"
                  onClick={handleToggleConfirmPassword}
                />
              ) : (
                <EyeIcon
                  className="eye-icon"
                  onClick={handleToggleConfirmPassword}
                />
              )}
            </div>
            {formErrors.confirmPassword && (
              <p className="error-message">{formErrors.confirmPassword}</p>
            )}
          </div>
          <div className="submit-button">
            <button type="submit">
              <img src={iniciarsesion} alt="Crear Cuenta" />
            </button>
          </div>       
        </form>
        
      </div>
    </div>
  );
};

export default PasswordRecovery;