import React, { Component } from 'react';

import './description.css';

class Description extends Component {

    constructor(props) {
        super(props);

        this.state = {

        };
    }

    render() {
        return (
            <div className="description">
                <p className="titleDescription" >Description</p>
                <p className="text">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Nunc sit amet nibh sed ipsum lobortis aliquam.
                    Phasellus cursus nisi consequat, feugiat neque nec, pellentesque nulla.
                    Nam in porta orci. Duis nisi neque, commodo eleifend mollis non, elementum at ligula.
                    Vestibulum dignissim vitae lacus eu congue.
                    Vestibulum odio sapien, vestibulum ut maximus nec, egestas eget tellus.
                    Mauris eleifend maximus condimentum. Cras faucibus tempor auctor.
                    Praesent porta elit odio, pellentesque luctus mauris luctus non.
                    Quisque et eros sodales risus eleifend semper eget quis lorem.
                    Duis eget lectus in eros efficitur aliquet sed ac orci.
                    In suscipit erat nibh, finibus aliquet ligula pharetra in.
                    Nullam gravida, eros vitae lobortis pharetra, magna purus eleifend nisl, nec ultricies est sapien sed lacus.
                    Phasellus in erat commodo nunc faucibus tincidunt id sagittis lorem.
                    Aliquam maximus varius consectetur. Praesent ut molestie turpis. llamcorper enim, ac volutpat urna. Phasellus laoreet pretium porttitor.
                </p>
            </div>
        );
    }
}
export default Description;