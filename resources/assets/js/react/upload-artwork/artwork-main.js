import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import FormFields from './upload-form';
import UploadedArtworks from './uploaded-artworks';
import SideBar from './sidebar-preview';

class UploadArtwork extends Component{
    constructor(props){
        super(props);
        this.state = { anyartworkUploaded: window.any_artwork, currUploadedArtworks: window.artworks };
        this.handleFileUpSuccess = this.handleFileUpSuccess.bind(this);
    }

    handleFileUpSuccess(filepath){
        let currfiles = this.state.currUploadedArtworks;

        //at the initial case when there is no previous uploaded artwork i.e. its not an array
        if (currfiles === false){
            currfiles = [filepath];
        }
        else{
            currfiles.push(filepath);
        }

        this.setState({ anyartworkUploaded: true, currUploadedArtworks: currfiles });
    }

    render() {
        return(
            <div>
                <SideBar>
                    <UploadedArtworks exist={this.state.anyartworkUploaded} uploaded={this.state.currUploadedArtworks} />
                </SideBar>
                <FormFields onFileUploadSuccess={this.handleFileUpSuccess} />
            </div>
        );
    }
}

ReactDOM.render(<UploadArtwork />, document.getElementById('upload-artwork-app'));
