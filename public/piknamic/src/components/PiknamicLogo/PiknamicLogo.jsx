import { Link } from "react-router-dom";
import style from "./PiknamicLogo.module.css";
import logo from "../../Images/Imagotipo horizontal.png";

const Piknamic = () => {
  return (
    <div className={style.mainContainer}>
      <Link to="/">
        <img className={style.logo} src={logo} alt="logo" />
      </Link>
    </div>
  );
};

export default Piknamic;