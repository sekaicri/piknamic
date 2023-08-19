import './App.css';
import Home from './views/Home/Home';
import Landing from './views/Landing/Landing';
import { Route} from "react-router-dom"
import Sigin from './views/Sigin/Sigin';
import Register from './views/Register/Register';
import Recovery from './views/Recovery/Recovery';
// import { useState, useEffect } from 'react';



function App() {
  
  // const [showBackgroundImage, setShowBackgroundImage] = useState(true);
  // useEffect(() => {
  //   setShowBackgroundImage(location.pathname === '/');
  // }, [location]);
  return (
    <div className="App">            
      <Route exact path="/">
     <div className='landing'>
      <Landing/>
     </div>
      </Route>
      <Route path="/home">
        <Home></Home>
      </Route>
      <Route path="/sigin">
        <Sigin></Sigin>
      </Route>
      <Route path="/register">
        <Register></Register>
      </Route>
      <Route path="/passwordrecovery">
        <Recovery></Recovery>
      </Route>
    </div>
  );
}

export default App;
