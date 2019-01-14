import React, { Component } from 'react';

import './baseInput.css';

class BaseInput extends Component {
    constructor(props) {
        super(props);

        this.state = {
        };

        this.handleChange = this.handleChange.bind(this);
    }

    handleChange(e) {
        this.props.inputData(e.target.value); // передача даних до parent
    };

    render() {
        return (
            <div className="input">
                <input
                    type={this.props.typePass}
                    className="sameInput"
                    placeholder={this.props.placeholder}
                    onChange={this.handleChange}
                />
            </div>
        );
    }
}

export default BaseInput;