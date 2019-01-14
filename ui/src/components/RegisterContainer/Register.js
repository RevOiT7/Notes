import React, { Component } from 'react';
import BaseInput from '../BaseInput/BaseInput';
import BaseButton from '../BaseButton/BaseButton';

import './register.css';

class Register extends Component {
    constructor(props) {
        super(props);

        this.state = {
            placeholderEmail: 'Enter your email',
            placeholderPassword: 'Enter your password',
            buttonName: 'Register',
            data: {
                email: '',
                password: '',
            },
            typePass: 'password',
            httpMethod: 'POST',
            uri: '/api/user',
            errors: {
                email: '',
                password: ''
            }
        };
        this.handleSubmit = this.handleSubmit.bind(this);
    };
    receiveEmail = (email) => { // email - дані, що приходять від BaseInput
        this.setState(
            {
                data:{
                    email: email,
                    password: this.state.data.password
                }
            }
        );
    };
    receivePassword = (password) => {
        this.setState(
            {
                data:{
                    email: this.state.data.email,
                    password: password
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
            .then( response => {
                if (response.status === 200 || response.status === 201) {
                    localStorage.setItem('Authorization', response.headers.get('Authorization'));
                    window.location.replace('/#/user');
                }
                else {
                    return response.json();
                }
            })
            .then( errors => {
                if (errors === undefined) {
                    return 0;
                }
                else {
                    this.setState({
                        errors: {
                            email: errors.email,
                            password: errors.password
                        }
                    });
                }
            })
            .catch(error => console.error(error));
    };

    render() {
        return (
            <div className='entry'>
                <div className="container">
                    <p className="title-register">Register</p>
                    <BaseInput placeholder={this.state.placeholderEmail} inputData={this.receiveEmail}/>
                    <BaseInput typePass={this.state.typePass} placeholder={this.state.placeholderPassword} inputData={this.receivePassword}/>
                    <BaseButton buttonName={this.state.buttonName} handleSubmit={this.handleSubmit} />
                    <div className='contErrors'>
                        <div className='error'> {this.state.errors.email} </div>
                        <div className='error'> {this.state.errors.password} </div>
                    </div>

                </div>
            </div>
        );
    }
}

export default Register;