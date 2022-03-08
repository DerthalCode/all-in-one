import { useEffect } from "react";

const CompanyCard = ({company}) => {
    return (
        <div className="col-lg-4">
            <div className="card">
                <img src={company.logo.startsWith('https') ? company.logo : `http://omglaravel.ddev.site/${company.logo}`} alt="company logo"/>
                <div className="card-body">
                    <h5 className="card-title">{company.name}</h5>
                    <a href={`/company/${company.id}`} className="btn btn-primary">Informacija</a>
                </div>
            </div>
        </div>
    )
}

export default CompanyCard;