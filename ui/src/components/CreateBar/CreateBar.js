import React, { Component } from 'react';
import CreateFolderButton from '../CreateFolderButton/CreateFolderButton';
import CreateNoteButton from '../CreateNoteButton/CreateNoteButton';

import './createBar.css';
import {SendRequestWithAuthorization} from "../../ManagerRequests";

class CreateBar extends Component {
    render() {
        return (
            <div className='addFoldNote' >
                <CreateFolderButton/>
                <CreateNoteButton/>
            </div>
        );
    }
}

export default CreateBar;