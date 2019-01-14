import React, { Component } from 'react';
import { Link } from 'react-router-dom';

import './header.css';


class Header extends Component {

    constructor(props) {
        super(props);
        this.state = {
            isSearched: false
        };
        this.ChangeSearchBar = this.ChangeSearchBar.bind(this);
        this.sendSearchRequest = this.sendSearchRequest.bind(this);
    };

    sendSearchRequest(e) {
        this.props.requestSearch(e.target.value);
    }

    ChangeSearchBar() {
        if (!this.state.isSearched){
            this.setState({isSearched:true});
        } else {
            this.setState({isSearched:false});
            this.props.requestSearch('');

        }
    }

    render() {
        let head;
        let logo =
            <Link to="/" replace>
                <div className="logo">
                </div>
            </Link>;

        if (window.location.hash === '#/') { // тут має бути перевірка якщо юзер не аутентифікований, то показувати так...
            head =
                <div className="cont-header">
                    {logo}
                    <Link to="/register">
                        <div className="register" > </div>
                    </Link>
                </div>;
        } else if ( // тут, якщо юзер аутентифікований
            window.location.hash === '#/note' ||
            window.location.hash === '#/note/id' ||
            window.location.hash === '#/user' ||
            window.location.hash === '#/folder'
        ) {
            if (this.state.isSearched) {
                head =
                    <div className="cont-header">
                        <div className='close' onClick={this.ChangeSearchBar}/>
                        <input className='search-input' onChange={this.sendSearchRequest} type="text" autoFocus/>
                    </div>;
            } else {
                head =
                    <div className="cont-header">
                        <div className='cont-search'>
                            <div className='search' onClick={this.ChangeSearchBar}/>
                        </div>
                        <Link to="/folder" replace>
                            <div className="logo"/>
                        </Link>
                        <Link to="/user" replace>
                            <div className="user"/>
                        </Link>
                    </div>;
            }
        } else {
            head =
                <div className="cont-header">
                    {logo}
                    <Link to="/">
                        <div className="login" > </div>
                    </Link>
                </div>;
        }

        return head;
    };
}

export default Header;