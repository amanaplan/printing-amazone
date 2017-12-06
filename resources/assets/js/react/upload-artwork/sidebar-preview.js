import React, { Component } from 'react';
import APP_URL from '../../frontend/boot.js';

class SideBar extends Component{
    constructor(props){
        super(props);
    }

    render(){
        return(
            <div className="col-md-4">
				<ul>
                    <li>
                        <div className="stk">
                            <img className="img-responsive" src={`${APP_URL}assets/images/products/${window.product_img}`} />
                        </div>
                        <div className="stk-dtls"><h3> {window.product_name}</h3>
                            {window.sticker_type ? `<p><strong>Sticker Type :</strong> ${window.sticker_type}</p>` : ''}
                            {window.sticker_name ? `<p><strong>Sticker Type :</strong> ${window.sticker_name}</p>` : ''}
                            <p><strong>Size :</strong> { window.width } x { window.height } mm</p>
                            <p><strong>Qty. :</strong> { window.qty }</p>
                        </div>
                        <div className="clr"></div>
                    </li>
                </ul>

                <br />

                {this.props.children}

            </div>
        );
    }
}

export default SideBar;
