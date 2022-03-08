import 'bootstrap/dist/css/bootstrap.min.css';
import {BrowserRouter as Router, Routes, Route} from "react-router-dom";
import Home from './components/Home';
import Company from './components/Company';
import Header from './components/Header';
import Register from './components/Register';
import Login from './components/Login';
import { useState } from 'react';
import { Auth } from './components/Auth';
import MyCompanies from './components/MyCompanies';
import UpdateCompany from './components/UpdateCompany';

function App() {
  const [auth, setAuth] = useState(localStorage.hasOwnProperty('user') ? JSON.parse(localStorage.getItem('user')) : {});
  
  return (
    <Router>
      <Auth.Provider value={[auth, setAuth]}>  
        <Header />            
        <div className='container-md'>
            <Routes>
                <Route path='/' element={<Home />} />
                <Route path='/company/:id' element={<Company />} />
                <Route path='/register' element={<Register />}/>
                <Route path="/login" element={<Login />} />
                <Route path='/mano-imones' element={<MyCompanies />} />
                <Route path="/redaguoti-imone/:id" element={<UpdateCompany />} />
            </Routes>
        </div>
      </Auth.Provider>
    </Router>
  );
}

export default App;
