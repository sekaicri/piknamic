import { Link } from "react-router-dom"
import "./Foot.css"
import isotipo from "../../Images/Isotipo.png"
import empezaracrear from "../../Images/Boton Empezar a Crear.png"
const Foot = () => {
    return (
        <div className= "mainContainer">
            <div className="crear">                
            <img src={empezaracrear}  />
            </div>
            <div className="linksfooter">
            <Link  to="/" style={{ color: 'white', textDecoration: 'none' }}>
                <img src={isotipo} alt="Isotipo" />
                ° 2023, Piknamic. Todos los derechos reservados
            </Link>
            <Link to="/" style={{ color: 'white', textDecoration: 'none' }}>
                Terminos de uso
            </Link>
            <Link to="/" style={{ color: 'white', textDecoration: 'none' }}>
                Politica de privacidad
            </Link>
            </div>
        </div>
    )
}

export default Foot