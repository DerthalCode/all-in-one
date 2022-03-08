const Card = ({company, setModalOptions}) => {
    return (
        <div className="col-lg-4">
            <div className="card">
                <img src={company.logo.startsWith('https') ? company.logo : `http://omglaravel.ddev.site/${company.logo}`} alt="company logo"/>
                <div className="card-body">
                    <h5 className="card-title">{company.name}</h5>
                    <p className="m-0">{company.description}</p>
                    <div className="d-flex mt-3 justify-content-end">
                        <div>
                            <a className="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#exampleModal" 
                                onClick={() => setModalOptions({
                                    text: `Ar tikrai norite istrinti ${company.name} ?`,
                                    title: "Patvirtinkite veiksma",
                                    btnText: "Istrinti",
                                    btnColor: "btn-danger",
                                    actionId: company.id
                                    })}>
                                    Istrinti
                            </a>
                            <a className="btn btn-primary" href={`/redaguoti-imone/${company.id}`}>Redaguoti</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default Card;