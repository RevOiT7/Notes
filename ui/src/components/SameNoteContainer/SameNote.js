import React, { Component } from 'react';
import BackButton from '../BackButton/BackButton';

import './sameNote.css';
import BaseButton from "../BaseButton/BaseButton";
import BaseInput from "../BaseInput/BaseInput";
import BaseTextArea from "../BaseTextArea/BaseTextArea";

class SameNote extends Component {
    constructor(props) {
        super(props);

        this.state = {
            placeholderTittle: 'Enter tittle',
            buttonName: 'Save',
            data: {
                tittle: '',
                text: '',
            },
            httpMethod: 'PUT',
            uri: '/api/note{id}',
        };
        this.handleSubmit = this.handleSubmit.bind(this);
    }
    receiveTittle = (tittle) => {
        this.setState(
            {
                data: {
                    tittle: tittle,
                    text: this.state.data.text
                }
            }
        );
    };
    receiveTextAreaData = (text) => {
        this.setState(
            {
                data: {
                    tittle: this.state.data.tittle,
                    text: text
                }
            }
        );
    };

    handleSubmit() {
        fetch(this.state.uri, {
            method: this.state.httpMethod,
            headers: {
                "Content-Type": "application/json; charset=utf-8",
            },
            body: JSON.stringify(this.state.data),
        })
            .then( response => response.json())
            .then((response) => {
                if (response.status === 200 || response.status === 201) {
                    localStorage.setItem('Authorization', response.headers.get('Authorization'));
                    window.location.replace('/#folder');
                }
            })
            .catch(error => console.error(error));
    }

    render() {
        return (
            <div className='wrapp'>
                <div className='cont'>
                    <BackButton />
                    <div className='editField'>
                        <div className='inputTittle'>
                            <BaseInput  placeholder={this.state.placeholderTittle} inputData={this.receiveTittle}> </BaseInput >
                        </div>
                        <BaseTextArea textAreaData={this.receiveTextAreaData}/>
                        <div className='buttonSave'>
                            <BaseButton buttonName={this.state.buttonName} handleSubmit={this.handleSubmit} />
                        </div>
                    </div>
                    </div>
            </div>
        );
    }
}

export default SameNote;