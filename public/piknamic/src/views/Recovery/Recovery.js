import PasswordRecovery from "../../components/PasswordRecovery/PasswordRecovery"
import React from "react";
import PiknamicLogo from "../../components/PiknamicLogo/PiknamicLogo";
import styles from "./Recovery.module.css";

const Recovery = () => {
  return (
    <div className={styles.container}>       
      <div className={styles.logo}>
        <PiknamicLogo />
      </div>

      <div className={styles.form}>
        <div className={styles.panel}>        
        <PasswordRecovery />
        </div>  
      </div>
    </div>
  );
};

export default Recovery;