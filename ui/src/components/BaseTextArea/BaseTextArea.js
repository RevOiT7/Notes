import React, { Component } from 'react';

import './baseTextArea.css';

class BaseTextArea extends Component {
    constructor(props) {
        super(props);

        this.state = {
            textFromTextArea: ''
        };
        this.handleChangeTextArea = this.handleChangeTextArea.bind(this);
    }

    handleChangeTextArea(e) {
        this.setState({
            textFromTextArea: e.target.value
        }, () => this.props.textAreaData(this.state.textFromTextArea));
    };

    render() {
        return (
            <textarea className='areaText' placeholder='Enter your note' rows="25" onChange={this.handleChangeTextArea} value={this.state.textFromTextArea}> </textarea>
        );
    }
}

export default BaseTextArea;