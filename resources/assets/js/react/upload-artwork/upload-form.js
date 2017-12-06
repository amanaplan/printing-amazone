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

/**
 * button component for upload more artworks
 */
class MoreArtworkBtn extends Component{
    constructor(props) {
        super(props);
        this.handleMoreArtworksClick = this.handleMoreArtworksClick.bind(this);
    }

    handleMoreArtworksClick(){
        this.props.onMoreArtworksClick();
    }

    render(){
        const renderable = this.props.show?
            <button type="button" onClick={this.handleMoreArtworksClick} className="btn btn-info"><i className="fa fa-picture-o" aria-hidden="true"></i> Want to Upload More Artworks !</button>
            :
            null;

        return renderable;
    }
    
}

/**
 * file type input field
 */
class UploadField extends Component{
    constructor(props) {
        super(props);
        this.state = { show: true};
        this.handleImageUpload = this.handleImageUpload.bind(this);
    }

    handleImageUpload(){
        this.props.onImageUploadAttempt();
    }

    render(){
        const renderable = this.props.show?
                        <div>
                            <input type="file" className="filestyle" ref={this.props.fieldref} disabled={this.props.disableFld} onChange={this.handleImageUpload} id="upload" tabIndex="-1" data-buttonname="btn-info" placeholder="No file Chosen" style={{ position: 'absolute', clip: 'rect(0px 0px 0px 0px)' }} />
                            <div className="bootstrap-filestyle input-group">
                                <input type="text" className="form-control" disabled={true} />
                                <span className="group-span-filestyle input-group-btn" tabIndex="0">
                                    <label htmlFor="upload" className="btn btn-primary "><span className="icon-span-filestyle glyphicon glyphicon-folder-open"></span> <span className="buttonText"> Choose file</span></label>
                                </span>
                            </div>
                            <span>max upload size 50MB</span>
                        </div>
                        :
                        null;

        return renderable;
    }
}

class FormFields extends Component{
    constructor(props){
        super(props);
        this.state = { proceedBtn: window.any_artwork, instruction: '', showProgress: false, progressData: 0, showUploadField: !window.any_artwork, disableUploadFld: false };
        this.handleInstChange = this.handleInstChange.bind(this);
        this.handleImageUpload = this.handleImageUpload.bind(this);
        this.handleMoreArtworksUpload = this.handleMoreArtworksUpload.bind(this);
    }

    handleInstChange(e){
        this.setState({ instruction: e.target.value });
    }

    handleMoreArtworksUpload(){
        this.setState({ showUploadField: true, disableUploadFld: false });
    }

    handleImageUpload(){
        const reactThis = this;

        this.setState({ disableUploadFld: true});
        //this.uploadFld.setAttribute('disabled', 'disabled');

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
            reactThis.setState({ showProgress: false, progressData: 0, proceedBtn: true, disableUploadFld: true, showUploadField: false });
            reactThis.props.onFileUploadSuccess(res.data.file);

            swal("", "Artwork uploaded successfully", "success");
        })
        .catch(function (err) {
            reactThis.setState({ showProgress: false, progressData: 0, disableUploadFld: false, showUploadField:true });

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
                        <MoreArtworkBtn show={!this.state.showUploadField} onMoreArtworksClick={this.handleMoreArtworksUpload} />

                        <UploadField show={this.state.showUploadField} fieldref={el => this.uploadFld = el} disableFld={this.state.disableUploadFld} onImageUploadAttempt={this.handleImageUpload}/>
                        
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
