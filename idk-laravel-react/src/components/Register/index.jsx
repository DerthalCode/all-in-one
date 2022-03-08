import { useContext, useState } from "react";
import { useNavigate } from "react-router-dom";
import { Auth } from "../Auth";

const Register = () => {
    const [username, setUsername] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [errors, setErrors] = useState({});

    const [auth, setAuth] = useContext(Auth);

    const navigate = useNavigate();

    const handleRegister = (e) => {
        e.preventDefault();
        
        fetch('http://omglaravel.ddev.site/api/register', {
            method: "POST",
            headers: {
                'Content-type': 'application/json'
            },
            body: JSON.stringify({
                name: username,
                email: email,
                password: password
            })
        }).then(resp => resp.json()).then(data => {
            if(data.hasOwnProperty('access_token')) {
                const user = {
                    name: data.data.name,
                    token: data.access_token
                }

                localStorage.setItem('user', JSON.stringify(user));
                setAuth(user);
            } else {
                setErrors(data);
            }
        })

        navigate('/');
    }

    return (
        <div className="px-3 pt-3 pb-5 border rounded col-lg-5 m-auto">
            <h3 className="text-center">Registracija</h3>
            <form method="post" onSubmit={(e) => handleRegister(e)}>
                <label htmlFor="name">vartotojo vardas</label>
                {errors.hasOwnProperty('name') ? <p className="m-0 text-danger">{errors.name}</p> : ""}
                <input type="text" name="name" className="form-control" onChange={(e) => setUsername(e.target.value)}/>
                <label htmlFor="email">el. pastas</label>
                {errors.hasOwnProperty('email') ? <p className="m-0 text-danger">{errors.email}</p> : ""}
                <input type="text" name="email" className="form-control" onChange={(e) => setEmail(e.target.value)}/>
                <label htmlFor="password">slaptazodis</label>
                {errors.hasOwnProperty('password') ? <p className="m-0 text-danger">{errors.password}</p> : ""}
                <input type="password" name="password" className="form-control" onChange={(e) => setPassword(e.target.value)}/>
                <div className="w-100 mt-2">
                    <button className="btn btn-success float-end" type="submit">Registruotis</button>
                </div>
            </form>
        </div>
    )
}

export default Register;