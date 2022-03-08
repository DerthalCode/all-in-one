import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import Spinner from "../Spinner";

const Company = () => {
    const {id} = useParams();
    const [company, setCompany] = useState({});

    useEffect(() => {
        fetch(`http://omglaravel.ddev.site/api/company/${id}`).then(resp => resp.json()).then(data => setCompany(data.data));
    },[])

    return (
        <div>
            {Object.keys(company).length ?
            <> 
                <h2>{company.name}</h2>
                <img src={company.logo.startsWith('https') ? company.logo : `http://omglaravel.ddev.site/${company.logo}`} alt="company logo" height={300} width={600}/>
                <p className="m-0">Vadovas: {company.head}</p>
                <p className="m-0">Kodas: {company.code}</p>       
                <p className="m-0">PVM: {company.vat}</p>
                <p className="m-0"></p>
                <p className="mb-0 mt-2">Aprasymas:</p>
                <p>{company.description}</p>
            </>
            :
            <Spinner />
            }
        </div>
    );
}

export default Company;