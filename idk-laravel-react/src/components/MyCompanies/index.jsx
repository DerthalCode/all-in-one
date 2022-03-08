import { nanoid } from "nanoid";
import { useContext, useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import { Auth } from "../Auth";
import Spinner from "../Spinner";
import Card from "./Card";
import CompanyForm from "./CompanyForm";
import Pagination from "../Pagination";
import Modal from "../Modal";

const MyCompanies = () => {
    const [companies, setCompanies] = useState({})
    const [user, setUser] = useContext(Auth);
    const [page, setPage] = useState(1);
    const [modalOptions, setModalOptions] = useState({});
    const [deleted, setDeleted] = useState(false);

    const navigate = useNavigate();
    
    useEffect(() => {
        try {
            fetch(`http://omglaravel.ddev.site/api/my-companies?page=${page}`, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization':'Bearer ' + user.token
            }     
            }).then(resp => resp.json()).then(data => {
                if(data.hasOwnProperty('message')) {
                    navigate('/login');
                } else {
                    setCompanies(data);
                }
            });
        } catch(err) {
            console.log(err);
        }
    },[user, page, deleted])

    const handleDelete = (id) => {
        fetch(`http://omglaravel.ddev.site/api/delete-company/${id}`, {
            method: "POST",
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization':'Bearer ' + user.token
            }
        }).then(resp => resp.json()).then(data => {
            if(data.hasOwnProperty('errors')) {
                console.log(data.errors)
            } else {
                setDeleted(true);

                setTimeout(() => {
                    setDeleted(false);
                }, 3000)
            }
        })
    }

    return (
    <>
        <Modal btnText={modalOptions.btnText} btnColor={modalOptions.btnColor} 
                text={modalOptions.text} title={modalOptions.title} actionId={modalOptions.actionId}
                action={handleDelete}/>
        <CompanyForm />
        <div className="alert alert-success" style={deleted ? {dispaly: "block"} : {display: "none"}}>
            <p className="m-0">Imone istrinta sekmingai</p>
        </div>
        <div className="mt-3">
            {Object.keys(companies).length ? 
            <>
                <div className="row g-3">
                    {companies.data.map(company => <Card key={nanoid()} company={company} setModalOptions={setModalOptions}/>)}
                </div>
                <div className="mt-3">
                    <Pagination page={page} setPage={setPage} lastPage={companies.meta.last_page} />
                </div>
            </>
            :
             <Spinner />
            }
        </div>
    </>
    )
}

export default MyCompanies;