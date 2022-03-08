import { useContext } from "react";
import { Link } from "react-router-dom";
import { Auth } from "../Auth";

const Header = () => {
    const [ user, setUser ] = useContext(Auth);
    
    const logout = () => {
        
        fetch('http://omglaravel.ddev.site/api/logout', {
            method: "POST",
            headers: {
                'Authorization':'Bearer ' + user.token
            }
        }).then(setUser({}))

        localStorage.removeItem('user');
    }
    
    return (
        <nav className="navbar navbar-expand-lg navbar-light bg-light mb-5">
            <a className="navbar-brand ms-4" href="/">ImonesApp</a>
            <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span className="navbar-toggler-icon"></span>
            </button>
            <div className="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">
                <div className="d-flex">
                    {Object.keys(user).length ? <Link to="/mano-imones">Mano imones</Link> : ""}
                </div>
                <div className="d-flex">
                    {
                        Object.keys(user).length ?
                        <>
                            <p className="m-0 me-2">{user.name}</p>
                            <a onClick={() => logout()} className="btn btn-danger me-2">Atsijungti</a>
                        </>
                        :
                        <>
                            <Link to='/login' className="btn btn-success me-2">Prisijungi</Link>
                            <Link to='/register' className="btn btn-success me-2">Registruotis</Link>
                        </>
                    }  
                </div>
            </div>
        </nav>
    )
}

export default Header;