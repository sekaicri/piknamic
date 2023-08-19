import imagen1 from "../../Images/imagen1.jpg"
import imagen2 from "../../Images/imagen2.jpg"
import { Carousel } from "react-responsive-carousel";
import "react-responsive-carousel/lib/styles/carousel.min.css";
const CarouselOne = () => {
    return (
        <div className= "carouselOne">
            <Carousel autoPlay infiniteLoop showStatus={false} showThumbs={false}>
                    <div>
                        <img src={imagen1} alt="Imagen 1" />
                    </div>
                    <div>
                        <img src={imagen2} alt="Imagen 2" />
                    </div>
                    <div>
                        <img src={imagen1} alt="Imagen 3" />
                    </div>
                </Carousel>                  
            </div>
    )
}

export default CarouselOne