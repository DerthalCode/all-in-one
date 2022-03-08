import { useEffect, useState } from "react";
import { nanoid } from "nanoid";

const Pagination = ({page, setPage, lastPage, step = 2}) => {
    const [pagination, setPagination] = useState([]);

    const nextPage = () => {
        if(page+1 <= lastPage) {
            setPage(page + 1);
        }
    }

    const prevPage = () => {
        if(page-1 > 0) {
            setPage(page - 1);
        }
    }   
    
    const pageRange = (page, step, lastPage) => {
        let range = [];
        
        if(step * 2 + 1 <= step + page) {
            for(let iter = page - step; iter <= page + step; iter++) {
                range.push(iter);
                if(lastPage === iter) {
                    break;
                }
            }
        } else {
            for(let iter = 1; iter <= step * 2 + 1; iter++) {
                range.push(iter);
                if(lastPage === iter) {
                    break;
                }
            }
        }

        return range;
    }
    
    useEffect(() => {
        setPagination(pageRange(page, step, lastPage))
    }, [page])
    
    return (
        <nav>
            { pagination.length ?
            <ul className="pagination">
                <li className="page-item">
                    <a className="page-link" onClick={() => prevPage()}  aria-disabled="true">Previous</a>
                </li>
                
                {
                    pagination.map(curr => (
                        <li className={`page-item ${curr === page ? "active" : ""}`} key={nanoid()}>
                            <a className="page-link" onClick={() => setPage(curr)}>{curr}</a>
                        </li>
                    ))
                }

                <li className="page-item">
                    <a className="page-link" onClick={() => nextPage()}>Next</a>
                </li>
            </ul>
            :
            ""}
        </nav>

    )
}

export default Pagination;