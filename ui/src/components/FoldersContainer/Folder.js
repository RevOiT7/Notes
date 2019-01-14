import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import BackButton from '../BackButton/BackButton';
import CreateBar from '../CreateBar/CreateBar';
import CreateFolderWindow from '../WindowToCreateFolder/CreateFolderWindow';
import CreateNoteWindow from '../WindowToCreateNote/CreateNoteWindow';

import './folder.css';

class Folder extends Component {
    constructor(props) {
        super(props);

        this.state = {
            folderId: 0,
            CreateFolderOrNote: 0,
            data:{
                folders: [
                    'my folder',
                    'fruits',
                    'my cars',
                    'photos',
                ],
                notes:[
                    'notes 1',
                    'my notes',
                    'jog',
                    'about dog',
                    'note 213'
                ]
            }

        };
    }

    render() {
        let filteredFolders = this.state.data.folders.filter(
            (folder) => {
                return folder.toLowerCase().indexOf(
                    this.props.searchRequest.toLowerCase()) !== -1;
            });
        let filteredNotes = this.state.data.notes.filter(
            (note) => {
                return note.toLowerCase().indexOf(
                    this.props.searchRequest.toLowerCase()) !== -1;
            });

        return (
            <div className='wrapp'>

                <div className='cont'>
                    <BackButton folderId={this.state.folderId}/>

                    <div className='contForItems'>
                        {
                                filteredFolders.map((folder) => {
                                return (
                                    <Link className='link' to='/folder' key={folder}>
                                        <div className='folder'>{folder} </div>
                                    </Link>
                                )
                            })
                        }
                        {
                            filteredNotes.map( (note) => {
                                return (
                                    <Link className='link' to='/note/{id}' key={note}>
                                        <div className='note'>{note} </div>
                                    </Link>
                                )
                            })
                        }
                        </div>
                    <CreateFolderWindow/>
                    <CreateNoteWindow/>
                    <CreateBar/>
                </div>

            </div>
        );
    }
}

export default Folder;