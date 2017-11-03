import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import APP_URL from './../../frontend/boot.js';

import '../../../../../public/assets/frontend/css/cssmodal.css';

function LoadingState(props)
{
	return <div className="postingloader" style={{margin: '50px auto 50px'}}></div>;
}

class ModalPopup extends React.Component {
	constructor(props)
	{
		super(props);
		this.handleClick = this.handleClick.bind(this);
		this.handleModalOutsideClick = this.handleModalOutsideClick.bind(this);
	}

	handleModalOutsideClick(e)
	{
		this.props.onModalOutsideClick(e.target, this.modalOuter);
	}

	handleClick()
	{
		this.props.onCloseClick();
	}

	render(){
		const modal = 
			<div className="cssmodal" ref={(el) => this.modalOuter = el} onClick={this.handleModalOutsideClick}>

				<div className="cssmodal-content">
					<div className="cssmodal-header">
						<span className="cssmodalclose" onClick={this.handleClick}><i className="fa fa-times-circle-o"></i></span>
						<h4 className="cssmodal-title">{this.props.productName}</h4>
					</div>
					<div className="cssmodal-body">
						{this.props.showModalContent === true ?

							<table width="100%" border="1" cellPadding="10">
								<tbody>

								{this.props.templates.map((item) => 
										<tr key={item.id}>
											<td className="size">{item.variation} </td>
											<td className="download">
											    <a href={`${APP_URL}storage/${item.template_file}`} download={`${this.props.productName}-${item.variation}`} className="btn btn-primary"> Download <i className="fa fa-arrow-circle-o-down"></i></a>
											</td>
										</tr>
									)
								}

								</tbody>
							</table>

							:
							<LoadingState />
						}
					</div>
				</div>

			</div>;

		let toshow = (this.props.show === true)? modal : null;

		return(
			<div>
				{toshow}
			</div>
		);
	}
}

export default ModalPopup;
