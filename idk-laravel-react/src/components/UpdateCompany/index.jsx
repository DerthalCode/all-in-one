import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import Spinner from "../Spinner";
import Form from "./Form";

const UpdateCompany = () => {
    const companyId = useParams();
    const [company, setCompany] = useState({});

    useEffect(() => {
        fetch(`http://omglaravel.ddev.site/api/company/${companyId.id}`).then(resp => resp.json())
            .then(data => setCompany(data.data))
    }, [companyId])

    return (
        <>
            {Object.keys(company).length ?
                <div className="col-lg-12 d-flex">
                    <div className="col-lg-6">
                        <div className="col-6">
                            <img className="img-fluid" src={company.logo.startsWith('https') ? company.logo : `http://omglaravel.ddev.site/${company.logo}`} alt="company logo"/>
                        </div>
                        <h2 className="my-2">{company.name}</h2>
                        <div className="col-lg-6 d-flex">
                            <div className="col-6">
                                <p className="m-0 fw-bold">Vadovas</p>
                                <p className="m-0 fw-bold">Kodas</p>
                                <p className="m-0 fw-bold">PVM kodas</p>
                                <p className="m-0 fw-bold">Adresas</p>
                            </div>
                            <div className="col-6">
                                <p className="m-0">{company.head}</p>
                                <p className="m-0">{company.code}</p>
                                <p className="m-0">{company.vat}</p>
                                <p className="m-0">{company.address}</p>
                            </div>
                        </div>
                        <div>
                            <p className="m-0 fw-bold">Aprasymas</p>
                            <p className="m-0">{company.description}</p>
                        </div>
                    </div>
                    <div className="col-lg-6">
                        <h2 className="mb-3">Redagavimas</h2>
                        <Form company={company} setCompany={setCompany}/>
                    </div>
                </div>
                :
                <Spinner />
            }
        </>
    )
}

export default UpdateCompany;