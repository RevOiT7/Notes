import React, { Component } from 'react';
import './createNote.css';
import {bindActionCreators} from "redux";
import {openWindowToCreate} from "../../actions/CreateBarActions";
import connect from "react-redux/es/connect/connect";

class CreateNoteButton extends Component {

    render() {
        const {openWindowToCreate} = this.props;
        return (
            <div
                className="field"
                 onClick={() => {
                     openWindowToCreate(2);
                 }}
            >
                <p className='createNotes'> </p>
            </div>
        );
    };
}

const putStateToProps = (state) => {
    return {
        windowForCreating: state.window.windowForCreating
    }
};

const putActionsToProps = (dispatch) => {
    return{
        openWindowToCreate: bindActionCreators(openWindowToCreate, dispatch)
    }
};

export default connect(putStateToProps, putActionsToProps)(CreateNoteButton);