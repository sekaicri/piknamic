import PiknamicLogo from "../../components/PiknamicLogo/PiknamicLogo"
import RegisterForm from "../../components/RegisterForm/RegisterForm"
import styles from "./Register.module.css";
const Register = () => {
    return (
        <div className={styles.container}>       
        <div className={styles.logo}>
          <PiknamicLogo />
        </div>
  
        <div className={styles.form}>
          <div className={styles.panel}>        
          <RegisterForm />
          </div>  
        </div>
      </div>
    )
}

export default Register