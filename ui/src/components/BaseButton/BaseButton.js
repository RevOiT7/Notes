import React, { Component } from 'react';

import './baseButton.css';

class BaseButton extends Component {
    constructor(props) {
        super(props);

        this.state = {
        };
    }
    render() {
        return (
            <div className="button">
                <button className="sameButton" onClick={this.props.handleSubmit}>  {this.props.buttonName} </button>
            </div>
        );
    }
}

export default BaseButton;