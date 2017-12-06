import React, { Component } from 'react';

import axios from 'axios';
import APP_URL from '../../frontend/boot.js';

/**
 * the proceed button / skip artwork text button
 */
class ProceedBtn extends Component{
    constructor(props) {
        super(props);
    }

    render() {
        const renderable = this.props.proceedbtn ? 
                            <div className="proceed-to-cart">
                                <div className="field"><button type="submit" className="btn btn-success">Proceed <i className="fa fa-cart-plus"></i> <i className="fa fa-angle-double-right" aria-hidden="true"></i></button></div>
                            </div>
                            :
                            <p id="skip-step">
                                or, <button type="submit" className="skip-upload-button">skip this step &amp; email artwork later.</button>
                            </p>
        return renderable;
    }
}

/**
 * image upload progress bar
 * manage show/hide & progress %
 */
class UploadProgress extends Component{
    constructor(props) {
        super(props);
    }

    render(){
        const renderable = this.props.showProgress?
            <div className="field">
                <div id="output" className="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow={this.props.progressData} aria-valuemin="0" aria-valuemax="100" style={{ width: `${this.props.progressData}%` }}>
                    {this.props.progressData}%
				</div>
            </div>
            :
            null;

        return renderable;
    }
}

/** 
 * preview of the image
*/
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById('artwork-prvw').style.display = 'block';
            document.getElementById('prvw-img').setAttribute('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

class FormFields extends Component{
    constructor(props){
        super(props);
        this.state = { proceedBtn: window.any_artwork, instruction: '', showProgress:false, progressData:0 };
        this.handleInstChange = this.handleInstChange.bind(this);
        this.handleImageUpload = this.handleImageUpload.bind(this);
    }

    handleInstChange(e){
        this.setState({ instruction: e.target.value });
    }

    handleImageUpload(){
        //console.log(this.uploadFld.value);
        //readURL(this.uploadFld);
        const reactThis = this;

        this.uploadFld.setAttribute('disabled', 'disabled');

        let data = new FormData();
        data.append('file', this.uploadFld.files[0]);

        let config = {
            headers: { 'Content-Type': 'multipart/form-data' },
            onUploadProgress: function (progressEvent) {
                let percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                if (percentCompleted > 0) {
                    reactThis.setState({ showProgress: true, progressData: percentCompleted });
                }
            },
        };

        axios.post(`${APP_URL}upload-artwork/process-upload`, data, config)
        .then(function (res) {
            reactThis.setState({ showProgress: false, progressData: 0, proceedBtn: true });
            reactThis.props.onFileUploadSuccess(res.data.file);
            //console.log(res.data.file);

            swal("", "Artwork uploaded successfully", "success");
        })
        .catch(function (err) {
            reactThis.setState({ showProgress: false, progressData: 0 });
            reactThis.uploadFld.removeAttribute('disabled');

            swal("Error!", err.message, "error");
        });

    }

    render() {
        return(
            <div className="col-md-8">
                <h2>Upload your Artwork</h2>

                <form action={window._submitURL} method="post">
                    <input type="hidden" name="_token" value={window.csrf} />

                    <div className="file-upload">
                        <input type="file" className="filestyle" ref={el => this.uploadFld = el} onChange={this.handleImageUpload} id="upload" tabIndex="-1" data-buttonname="btn-info" placeholder="No file Chosen" style={{position: 'absolute', clip: 'rect(0px 0px 0px 0px)'}} />
                        <div className="bootstrap-filestyle input-group">
                            <input type="text" className="form-control" disabled={true} /> 
                            <span className="group-span-filestyle input-group-btn" tabIndex="0">
                                <label htmlFor="upload" className="btn btn-primary "><span className="icon-span-filestyle glyphicon glyphicon-folder-open"></span> <span className="buttonText"> Choose file</span></label>
                            </span>
                        </div>
                        <span>max upload size 50MB</span>

                        <UploadProgress showProgress={this.state.showProgress} progressData={this.state.progressData} />

                        <br />

                        <div className="field">
                            <label htmlFor="instruction">Instruction (Optional)</label>
                            <textarea style={{ height: '180px' }} name="instructions" value={this.state.instructions} onChange={this.handleInstChange} placeholder="Let us know if you have any instructions to prepare your proof"></textarea>
                        </div>

                        <ProceedBtn proceedbtn={this.state.proceedBtn} />

                    </div>
                </form>
            </div>
        );
    }
}

export default FormFields;
