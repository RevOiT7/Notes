import React, { Component } from 'react';
import BackButton from '../BackButton/BackButton';
import {SendRequestWithAuthorization} from '../../ManagerRequests';

import './profile.css';

class Profile extends Component {
    constructor(props) {
        super(props);

        this.state = {
            data: {
                user: '',

            },
            isUserLogin: localStorage.getItem('Authorization')
        };
        this.deleteUser = this.deleteUser.bind(this);
        this.logoutUser = this.logoutUser.bind(this);
    }

    componentDidMount() {
        fetch('api/auth/me', {
            method: 'POST', // *GET, POST, PUT, DELETE, etc.
            headers: {
                "Content-Type": "application/json; charset=utf-8",
                "Authorization": localStorage.getItem('Authorization')
            }
        })
            .then( response => {
                if (response.status === 200 || response.status === 201) {
                    localStorage.setItem('Authorization', response.headers.get('Authorization'));
                    return response.json();
                }
            })
            .then((data) => this.setState({
                data: {
                    user: data.email
                }
            }))
            .catch( error => console.error(error) );
    }

    logoutUser() {
        if ( !(window.confirm("Log this account " + this.state.data.user + " out?"))) {
            return;
        }
        SendRequestWithAuthorization('POST', 'api/auth/logout', '/');
    };

    deleteUser() {
        if ( !(window.confirm("Delete this account " + this.state.data.user + "?"))) {
            return;
        }
        SendRequestWithAuthorization('DELETE', 'api/auth/user', '/register');
    };

    render() {
        return (
            <div className='wrapp'>
                <div className='cont'>
                    <BackButton />
                    <div className='userContainer'>
                        <div className='profile'>
                            <div className='userIco'/>
                            <p className='userName'> {this.state.data.user} </p>
                            <div className='contLogout' onClick={this.logoutUser}>
                                <p className='logout'> Log Out </p>
                            </div>
                        </div>
                        <div className='contDelete' onClick={this.deleteUser}>
                            <p className='delete'> Delete Profile </p>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Profile;