import { Link } from "react-router-dom"
import style from "./NavBar.module.css"
import iniciarsesion from "../../Images/Boton Inicia Sesionmdpi.png"
import registrate from "../../Images/Boton Registratemdpi.png"
const NavBar = () => {
    return (
        <div className={style.mainContainer}>           
            <Link to = "/" style={{ color: 'white', textDecoration: 'none' }}>
            Nosotros
            </Link>
            <Link to = "/" style={{ color: 'white', textDecoration: 'none' }}>
            Inspiración
            </Link>
            <Link to = "/" style={{ color: 'white', textDecoration: 'none' }}>
            Tarifas
            </Link>
            <Link to = "/sigin">
                <img src ={iniciarsesion} />
            </Link>
            <Link to = "/register">
            <img src ={registrate} />            
            </Link>          
            </div>
    )
}

export default NavBar