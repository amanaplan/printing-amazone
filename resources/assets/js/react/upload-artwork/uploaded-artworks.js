import React, { Component } from 'react';
import APP_URL from '../../frontend/boot.js';

class UploadedArtworks extends Component{
    constructor(props) {
        super(props);
        this.showFileImg = this.showFileImg.bind(this);
    }

    /**
     * if image show error then show a sample file logo
     */
    showFileImg(e){
        e.target.src = `${APP_URL}assets/images/sample-file.png`;
    }

    render(){
        const renderable = this.props.exist?
                <div className="row" style={{marginTop: '71px'}}>

                    {this.props.uploaded.map((item, index) => {
                        return (<div className="col-md-6 preview" key={index}>
                            <img className="img-responsive img-rounded" ref={el => this.preview = el} src={`${APP_URL}storage/${item}`} onError={this.showFileImg} />
                            <span className="remove-uploaded-artwork" data-toggle="tooltip" title="remove"><i className="fa fa-times-circle fa-lg" aria-hidden="true"></i></span>
                        </div>
                        )
                    })}
                    
                </div>
                :
                null;

        return renderable;
    }
}

export default UploadedArtworks;
