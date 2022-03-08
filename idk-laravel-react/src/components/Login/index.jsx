import { useContext, useState } from "react";
import { useNavigate } from "react-router-dom";
import { Auth } from "../Auth";

const Login = () => {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [errors, setErrors] = useState({});

    const [auth, setAuth] = useContext(Auth);

    const navigate = useNavigate();

    const handleLogin = (e) => {
        e.preventDefault();
        
        fetch('http://omglaravel.ddev.site/api/login', {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: email,
                password: password
            })
        }).then(resp => resp.json()).then(data => {
            if(data.hasOwnProperty('token')) {
    
                localStorage.setItem('user', JSON.stringify(data));
                setAuth(data);
            } else {
                setErrors(data);
            }
        })

        navigate('/');
    }

    return (
        <div className="px-3 py-5 border rounded col-lg-5 m-auto">
            <h3 className="text-center">Prisijungimas</h3>
            {errors.hasOwnProperty('message') ? <p className="m-0 text-danger">{errors.message}</p> : ""}
            <form onSubmit={(e) => handleLogin(e)}>
                <label htmlFor="email">el. pastas</label>
                {errors.hasOwnProperty('email') ? <p className="m-0 text-danger">{errors.email}</p> : ""}
                <input type="text" name="email" className="form-control" onChange={(e) => setEmail(e.target.value)}/>
                <label htmlFor="password" >slaptazodis</label>
                {errors.hasOwnProperty('password') ? <p className="m-0 text-danger">{errors.password}</p> : ""}
                <input type="password" name="password" className="form-control" onChange={(e) => setPassword(e.target.value)}/>
                <div className="w-100 mt-2">
                    <button className="btn btn-success float-end" type="submit">Prisijungti</button>    
                </div>
            </form>
        </div>
    )
}

export default Login;