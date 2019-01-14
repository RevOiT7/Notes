import React, { Component } from 'react';
import './cteateNoteWindow.css';
import {closeWindow, receiveCaptionNote} from '../../actions/CreateBarActions'
import {connect} from 'react-redux';
import {bindActionCreators} from "redux";

class CreateNoteWindow extends Component {

    createNoteQuery() {

        let dataNote = {
            caption: this.props.caption,
            text: this.props.text.current.value,
            parent_id: this.props.parent_id
        };


        fetch(this.props.url, {
            method: this.props.httpMethod,
            headers: {
                "Content-Type": "application/json; charset=utf-8",
                "Authorization": localStorage.getItem('Authorization')
            },
            body: JSON.stringify(dataNote, ['caption', 'text', 'parent_id']),
        })
            .then( response => {
                if (response.status === 200 || response.status === 201) {
                    localStorage.setItem('Authorization', response.headers.get('Authorization'));
                    return response.json();
                }

            })

            .catch( error => console.error(error) );
        console.log(dataNote, ['caption', 'text', 'parent_id'])
    };

    render() {
        const {closeWindow, receiveCaptionNote} = this.props;
        let isNoteWindow;
        if (this.props.windowForCreating === 0 || this.props.windowForCreating === 1 ) {
            isNoteWindow = null;
        } else {
            isNoteWindow =
                <div className="create">
                    <div className="name">
                        <p>Create Note</p>
                        <p onClick={() => {closeWindow(0);}}>&#10008;</p>
                    </div>
                    <div className="inputFieldsNote">
                        <div className="inputTitle">
                            <input
                                className="inputStyle"
                                type="text"
                                placeholder="Enter title"
                                onChange={receiveCaptionNote}
                            />
                        </div>
                        <div className="inputText">
                            <textarea
                                className="inputStyle"
                                placeholder="Enter your note"
                                ref={this.props.text}
                            >
                            </textarea>
                        </div>
                    </div>

                    <button
                        className="button"
                        onClick = {this.createNoteQuery.bind(this)}><span>Create</span>
                    </button>
                </div>
        }
        return isNoteWindow;
    };
}

const putStateToProps = (state) => {
    return {
        httpMethod: state.window.httpMethod,
        url: state.window.url,
        windowForCreating: state.window.windowForCreating,
        caption: state.window.caption,
        text: state.window.text,
        parent_id: state.window.parent_id
    }
};

const putActionsToProps = (dispatch) => {
    return{
        closeWindow: bindActionCreators(closeWindow, dispatch),
        receiveCaptionNote: bindActionCreators(receiveCaptionNote, dispatch)
    }
};

export default connect(putStateToProps, putActionsToProps)(CreateNoteWindow);
