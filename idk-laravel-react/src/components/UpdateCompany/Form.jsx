import { useContext, useState } from "react";
import { useNavigate } from "react-router-dom";
import { Auth } from "../Auth";
import {BsCheckCircleFill} from "react-icons/bs";

const Form = ({company, setCompany}) => {
    const [form, setForm] = useState(company);
    const [auth, setAuth] = useContext(Auth);
    const [errors, setErrors] = useState({});
    const [added, setAdded] = useState(false);

    const navigate = useNavigate();

    const submitForm = (e) => {
        e.preventDefault();
        
        fetch(`http://omglaravel.ddev.site/api/update-company/${form.id}`, {
            method: "POST",
            headers: {
                'Authorization':'Bearer ' + auth.token,
                'Content-Type': "application/json",
                'Accept': "application/json"
            },
            body: JSON.stringify(form)
        }).then(resp => resp.json()).then(response => {
            if(response.hasOwnProperty('errors')){
                setErrors(response.errors);
                
            } else {
                setCompany(form);
                setAdded(true);

                setTimeout(() => {
                    navigate('/mano-imones')
                }, 5000)
            }
        })
    }

    return (
        <>
        <div className={`alert alert-success d-flex align-items-center ${added ? "" : "d-none"}`} role="alert">
            <BsCheckCircleFill style={{fontSize: "1.5rem"}}/>
            <div className="ms-2">
                Imone atnaujinta sekmingai
            </div>
        </div>
        {Object.keys(form).length ? 
        <form className="row g-3" onSubmit={(e) => submitForm(e)}>
            <div className="col-lg-4">
                <label htmlFor="name">Pavadinimas</label>
                <input type="text" className="form-control" value={form.name} onChange={(e) => setForm({...form, "name": e.target.value})}/>
            </div>
            <div className="col-lg-4">
                <label htmlFor="code">Kodas</label>
                <input type="text" className="form-control" value={form.code} onChange={(e) => setForm({...form, "code": e.target.value})}/>
            </div>
            <div className="col-lg-4">
                <label htmlFor="vat">PVM kodas</label>
                <input type="text" className="form-control" value={form.vat} onChange={(e) => setForm({...form, "vat": e.target.value})}/>
            </div>
            <div className="col-lg-4">
                <label htmlFor="vat">Adresas</label>
                <input type="text" className="form-control" value={form.address} onChange={(e) => setForm({...form, "address": e.target.value})}/>
            </div>
            <div className="col-lg-12">
                <label htmlFor="vat">Aprasymas</label>
                <textarea className="form-control" rows="10" value={form.description} 
                    onChange={(e) => setForm({...form, 'description': e.target.value})}>
                </textarea>
            </div>
            <div className="col-12">
                <div>
                    <button type="submit" className="btn btn-primary float-end">Pateikti</button>
                </div>
            </div>
        </form>
        :
        ""
        }
        </>
    )
}

export default Form;