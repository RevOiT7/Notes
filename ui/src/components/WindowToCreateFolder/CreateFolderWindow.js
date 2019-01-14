import React, { Component } from 'react';
import '../WindowToCreateNote/cteateNoteWindow.css';
import {connect} from 'react-redux';
import {closeWindow, receiveNameFolder} from '../../actions/CreateBarActions'
import {bindActionCreators} from 'redux';

class CreateFolderWindow extends Component {

    createFolderQuery() {
        let dataFolder = {
            title: this.props.title,
            parent_id: this.props.parent_id
        };

        fetch(this.props.url, {
            method: this.props.httpMethod,
            headers: {
                "Content-Type": "application/json; charset=utf-8",
                "Authorization": localStorage.getItem('Authorization')
            },
            body: JSON.stringify(dataFolder, ['title', 'parent_id']),
        })
            .then( response => {
                if (response.status === 200 || response.status === 201) {
                    localStorage.setItem('Authorization', response.headers.get('Authorization'));
                    return response.json();
                }
            })
            .then( (data) => console.log(data))
            .catch( error => console.error(error) );
            console.log(dataFolder, ['title', 'parent_id'])
    };

    render() {
        const {closeWindow, receiveNameFolder} = this.props;
        let isFolderWindow;
        if (this.props.windowForCreating === 0 || this.props.windowForCreating === 2) {
            isFolderWindow = null;
        } else {
            isFolderWindow =
                <div className="create">
                    <div className="name">
                        <p>Create Folder</p>
                        <p onClick={() => {
                            closeWindow(0);
                        }}

                        >&#10008;</p>
                    </div>
                    <div className="inputFieldsFolder">
                        <div className="inputTitleFolder" >
                            <input
                                className="inputStyle"
                                type="text"
                                placeholder="Enter folder name"
                                onChange={receiveNameFolder}
                            />
                        </div>
                    </div>
                    <button
                        className="button"
                        onClick = {this.createFolderQuery.bind(this)}>
                        <span>Create</span></button>
                </div>

        }
        return isFolderWindow;
    };
}

const putStateToProps = (state) => {
    return {
        httpMethod: state.window.httpMethod,
        url: state.window.url,
        windowForCreating: state.window.windowForCreating,
        title: state.window.title,
        parent_id: state.window.parent_id,
        input: state.window.input
    }
};

const putActionsToProps = (dispatch) => {
    return{
        closeWindow: bindActionCreators(closeWindow, dispatch),
        receiveNameFolder: bindActionCreators(receiveNameFolder, dispatch)
    }
};

export default connect(putStateToProps, putActionsToProps)(CreateFolderWindow);