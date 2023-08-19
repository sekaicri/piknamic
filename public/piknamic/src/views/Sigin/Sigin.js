import React from "react";
import PiknamicLogo from "../../components/PiknamicLogo/PiknamicLogo";
import SiginForm from "../../components/SiginForm/SiginForm";
import styles from "./Sigin.module.css";

const Sigin = () => {
  return (
    <div className={styles.container}>       
      <div className={styles.logo}>
        <PiknamicLogo />
      </div>

      <div className={styles.form}>
        <div className={styles.panel}>        
        <SiginForm />
        </div>  
      </div>
    </div>
  );
};

export default Sigin;