import "./BoxOne.css"
import quierocrear from "../../Images/Boton Quiero Crearmdpi.png"

const BoxOne = () => {
    return (
        <div className= "boxOne">
                <h1 class="black-text">                   
                    Dile adiós a los mockups estáticos y aburridos.{' '}
                        <span className="orangetext">¡Ahora tú decides!</span>
                    </h1>
                <div>Piknamic es un estudio virtual de fotográfia para
                productos que te permiten crear infinitas posibilidades
                 de imagenes cuando, como y donde quieras.</div>
                 <div className="quierocrear">
                <img src ={quierocrear} />
                </div>
                            
            </div>
    )
}

export default BoxOne