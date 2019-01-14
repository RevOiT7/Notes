import React, { Component } from 'react';

import './backButton.css';

class BackButton extends Component {
    constructor(props) {
        super(props);

        this.state = {
        };
    }
    render() {
        let backButton;
        if (this.props.folderId === 0) {
            backButton = null;
        } else {
            backButton =
                <div className='backCont' onClick={ () => window.history.back() }>
                    <p className='backButton'> </p>
                    <p className='back'> Back </p>
                </div>;
        }
        return backButton;
    }
}

export default BackButton;