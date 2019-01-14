import React, { Component } from 'react';
import { HashRouter as Router, Route } from 'react-router-dom';
import Register from './components/RegisterContainer/Register';
import Login from './components/LoginContainer/Login';
import Header from './components/HeaderContainer/Header';
import Description from './components/Description/Description';
import Footer from './components/FooterContainer/Footer';
import Folder from "./components/FoldersContainer/Folder";
import SameNote from "./components/SameNoteContainer/SameNote";
import Profile from "./components/ProfileContainer/Profile";

import './App.css';
import Redirect from "react-router/es/Redirect";


class App extends Component {

    constructor(props) {
        super(props);
        this.state = {
            searchRequest: '',
        };
        App.isLoggedIn = App.isLoggedIn.bind(this);
    }

    receiveSearchRequest = (searchReq) => { // email - дані, що приходять від BaseInput
        this.setState(
            {
                searchRequest: searchReq
            }
        );
    };
    static isLoggedIn(){
        let Auth = window.localStorage.getItem('Authorization');
        if (!Auth){
            return 0;
        }
        if (Auth === '') {
            return 0;
        }
        else return 1;
    };


    render() {
        return (
            <Router>
                <div className="app">
                    <div className="main-container">
                        <Header requestSearch={this.receiveSearchRequest} />
                        <Route exact path="/" render={() => App.isLoggedIn() ? <Redirect to='/user'/> : <Login/> }/>
                        <Route path="/register" render={() => App.isLoggedIn() ? <Redirect to='/user'/> : <Register/>} />
                        <Route path="/folder" render={(props) => App.isLoggedIn() ? <Folder searchRequest={this.state.searchRequest} {...props}/> : <Redirect to='/'/>} />
                        <Route path="/note/:id" component={SameNote} />
                        <Route exact path="/user" render={() => App.isLoggedIn() ? <Profile/> : <Redirect to='/'/>} />
                    </div>

                    <Route exact path="/" component={Description}>
                    </Route>
                    <Route exact path="/register" component={Description}>
                    </Route>

                    <Footer/>

                </div>
            </Router>
        );
    }
}

export default App;