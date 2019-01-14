import React, { Component } from 'react';
import './createFolder.css';
import {openWindowToCreate} from '../../actions/CreateBarActions'
import {bindActionCreators} from "redux";
import connect from "react-redux/es/connect/connect";

class CreateFolderButton extends Component {

    render() {
        const {openWindowToCreate} = this.props;
        return (
            <div
                className="field"
                onClick={() => {
                    openWindowToCreate(1);
                }}>
                <p className='createFolder'> </p>
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

export default connect(putStateToProps, putActionsToProps)(CreateFolderButton);