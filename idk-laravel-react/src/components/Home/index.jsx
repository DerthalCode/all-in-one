import { nanoid } from "nanoid";
import { useEffect, useState } from "react";
import CompanyCard from "./CompnayCard";
import {AiOutlineArrowLeft, AiOutlineArrowRight} from "react-icons/ai";
import Spinner from "../Spinner";
import Pagination from "../Pagination";

const Home = () => {
    const [companies, setCompanies] = useState({});
    const [page, setPage] = useState(1);

    useEffect(() => {
        fetch(`http://omglaravel.ddev.site/api/companies?page=${page}`).then(resp => resp.json())
            .then(companies => setCompanies(companies));
    }, [page]);


    return (
        <div>
            {
                Object.keys(companies).length ?
                <>
                
                    <div className="row g-2">
                        {companies.data.map(company => <CompanyCard key={nanoid()} company={company}/>)}
                    </div>
                    <div className="pages mt-3">
                        {Object.keys(companies).length ? 
                            <Pagination pages={companies.meta} 
                            page={page} setPage={setPage} lastPage={companies.meta.last_page}/> : ""}
                    </div>
                </>
                :
                <Spinner />
            }
        </div>
    )
}

export default Home;