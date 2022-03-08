import { useContext, useState } from "react";
import { Auth } from "../Auth";
import {BsCheckCircleFill} from "react-icons/bs";

const CompanyForm = () => {
    const initialCompany = {
        "name": "",
        "code": "",
        "vat": "",
        "head": "",
        "address": "",
        "description": "",
        "category_id": ""
    }

    const [auth, setAuth] = useContext(Auth);
    const [form, setForm] = useState(initialCompany);
    const [errors, setErrors] = useState({});
    const [added, setAdded] = useState(false);
    const [toggle, setToggle] = useState(false);

    const submitForm = (e) => {
        e.preventDefault();
        
        fetch('http://omglaravel.ddev.site/api/add-company', {
            method: "POST",
            headers: {
                'Authorization':'Bearer ' + auth.token,
                'Content-Type': "application/json",
                'Accept': "application/json"
            },
            body: JSON.stringify(form)
        }).then(resp => resp.json()).then(data => {
            if(data.hasOwnProperty('errors')) {
                setErrors(data.errors);
            } else {
                setForm(initialCompany);
                setAdded(true);

                setTimeout(() => {setAdded(false)}, 3000);
            }
        })
    }

    return (
    <>
        <button className="btn btn-lg btn-primary mb-2" onClick={() => setToggle(!toggle)}>
            {toggle ? "Uzdaryti forma" : "Prideti imone"}
        </button>
        <div className={`alert alert-success d-flex align-items-center ${added ? "" : "d-none"}`} role="alert">
            <BsCheckCircleFill style={{fontSize: "1.5rem"}}/>
            <div className="ms-2">
                Imone issaugota sekmingai
            </div>
        </div>
        <form onSubmit={(e) => submitForm(e)} style={toggle ? {display: "block"} : {display: "none"}}>
            <div className="row">
                <div className="col-lg-4">
                    <label htmlFor="name">Pavadinimas</label>
                    <input type="text" name="name" value={form.name} 
                        className="form-control" onChange={(e) => setForm({...form, name:e.target.value })}/>
                </div>
                <div className="col-lg-4">
                    <label htmlFor="code">Kodas</label>
                    <input type="text" name="code" value={form.code} 
                        className="form-control" onChange={(e) => setForm({...form, code:e.target.value })}/>
                </div>
                <div className="col-lg-4">
                    <label htmlFor="vat">PVM kodas</label>
                    <input type="text" name="vat" value={form.vat} 
                        className="form-control" onChange={(e) => setForm({...form, vat:e.target.value })}/>
                </div>
                <div className="col-lg-4">
                    <label htmlFor="head">Vadovas</label>
                    <input type="text" name="head" value={form.head} 
                        className="form-control" onChange={(e) => setForm({...form, head:e.target.value })}/>
                </div>
                <div className="col-lg-4">
                    <label htmlFor="address">Adresas</label>
                    <input type="text" name="address" value={form.address} 
                        className="form-control" onChange={(e) => setForm({...form, address:e.target.value })}/>
                </div>
                <div className="col-lg-4">
                    <label htmlFor="category_id">Imones tipas</label>
                    <select name="category_id" value={form.category_id} 
                        className="form-select" onChange={(e) => setForm({...form, category_id:e.target.value })}>
                        <option value="1">UAB</option>
                        <option value="2">MB</option>
                    </select>
                </div>
                <div className="col-12">
                    <label htmlFor="description">Aprasymas</label>
                    <textarea name="description" value={form.description} 
                        className="form-control" rows={5} onChange={(e) => setForm({...form, description:e.target.value })}></textarea>
                </div>
                <div className="col-12 mt-2">
                    <div>
                        <button type="submit" className="btn btn-success float-end">Pateikti</button>
                    </div>
                </div>
            </div>
        </form>
    </>
    )
}

export default CompanyForm;