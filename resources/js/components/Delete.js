import React from 'react';
import ReactDOM from 'react-dom';
import swal from 'sweetalert';


function Delete(props) {
    const destroy = (e) => {
        const afterDeleted = e.currentTarget.parentNode.parentNode.parentNode
        swal("Delete?", {
            buttons: ["No", "Yes"]
        }).then((value) => {
            if(value == true){
                axios.delete(props.endpoint).then((response) => {
                    console.log(response.data);
                    afterDeleted.remove()
                })
            }
        })
    }
    return (
        <button onClick={destroy} className="btn btn-sm btn-danger">Delete</button>
    );
}

export default Delete;
const deleteNodes = document.querySelectorAll('.delete')
if (deleteNodes) {
    deleteNodes.forEach((item)=>{
        let endpoint = item.getAttribute('endpoint')
        ReactDOM.render(<Delete endpoint={endpoint} />, item);
    })
}
