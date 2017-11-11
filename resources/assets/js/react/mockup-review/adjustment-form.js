import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import axios from 'axios';

import NProgress from 'nprogress';
import '../../../../../public/assets/frontend/plugin/nprogress/nprogress.css';
import SuccessAlert from './SuccessAlert';

function ErrorAlert(props)
{
	return props.show === true ? 
			<div className="alert alert-danger">
				{props.errmsg}
			</div>
			:
			null
	
}

class AdjustmentForm extends React.Component {
	constructor(props) {
		super(props);
		this.handleSubmit = this.handleSubmit.bind(this);
		this.handleMessageChange = this.handleMessageChange.bind(this);
		this.cancelClicked = this.cancelClicked.bind(this);
		this.state = {message: '', validationerr: false, validatiomsg: '', requested: false}
	}

	validateInput()
	{
		if(this.state.message == '')
		{
			this.setState({validationerr: true, validatiomsg: 'Error ! please enter your message'});
			return false;
		}
		else if(this.state.message.trim().length < 5)
		{
			this.setState({validationerr: true, validatiomsg: 'Error ! message text is too small'});
			return false;
		}

		return true;
	}

	handleSubmit(e)
	{
		e.preventDefault();
		
		//validation
		const validated = this.validateInput();

		if(validated)
		{
			NProgress.set(0.4);
			this.setState({validationerr: false});
			this.submitBtn.setAttribute('disabled', 'disabled');
			NProgress.inc();

			const reactThis = this;

			axios.post(`${window._hitURI}`, {
				message: this.state.message,
				order_token: window._orderID_,
				order_item: window._orderedPROD
			}).then((response) => {
				reactThis.submitBtn.removeAttribute('disabled');
				reactThis.setState({message: '', requested: true});
				NProgress.done();
			});

			return;
		}

		return;
	}

	cancelClicked()
	{
		this.props.onCancelClick();
	}

	handleMessageChange(e)
	{
		this.setState({validationerr: false});
		this.setState({message: e.target.value});
	}

	render() {
		return (
				this.state.requested ? 
				<SuccessAlert success={true} successmsg="Your request submitted! we'll notify you once the mockup is ready" />
				:
				<div className="col-sm-12 com-md-12">
					<ErrorAlert show={this.state.validationerr} errmsg={this.state.validatiomsg} />
					<form onSubmit={this.handleSubmit}>
						<div className="form-group">
							<textarea className="form-control review-msg" rows="10" placeholder="Enter your message..." value={this.state.message} onChange={this.handleMessageChange}></textarea>
						</div>
						<div className="btns pull-left">
							<button type="submit" ref={(el) => this.submitBtn = el} className="btn btn-info btn-pill d-flex ml-auto mr-auto" type="submit">Send Your Message</button>
							<button type="button" onClick={this.cancelClicked} className="btn btn-warning btn-pill d-flex ml-auto mr-auto">Cancel</button>
						</div>
					</form>
				</div>
		)
	}
}

export default AdjustmentForm;
