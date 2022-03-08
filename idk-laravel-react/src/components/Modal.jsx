const Modal = ({btnColor, btnText, text, title, actionId, action}) => {
    return (
        <div className="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div className="modal-dialog">
                <div className="modal-content">
                    <div className="modal-header">
                        <h5 className="modal-title" id="exampleModalLabel">{title}</h5>
                        <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div className="modal-body">
                        {text}
                    </div>
                    <div className="modal-footer">
                        <button type="button" data-bs-dismiss="modal" onClick={() => action(actionId)} className={`btn ${btnColor}`}>{btnText}</button>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default Modal;