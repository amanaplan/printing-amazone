import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import axios from 'axios';

import NProgress from 'nprogress';
import '../../../../../public/assets/frontend/plugin/nprogress/nprogress.css';

import AdjustmentForm from './adjustment-form';
import SuccessAlert from './SuccessAlert';

class MakeAdjustment extends React.Component {
	constructor(props) {
		super(props);
		this.handleMakeAdjustClick = this.handleMakeAdjustClick.bind(this);
		this.state = {adjustmentform: false};
	}

	handleMakeAdjustClick(e)
	{
		e.preventDefault();
		this.setState((prevState, props) => ({adjustmentform: ! prevState.adjustmentform}));
		this.props.onMakeAdjustClick(true);
	}

	render() {
		return (
			<a href="#" onClick={this.handleMakeAdjustClick}> or, Make an Adjustment</a>
		)
	}
}

class ApproveMockup extends React.Component {
	constructor(props) {
		super(props);
		this.handleMockupApprove = this.handleMockupApprove.bind(this);
	}

	handleMockupApprove()
	{
		this.props.onMockupApprove();
	}

	render()
	{
		return (
			<button className="btn btn-success btn-pill d-flex ml-auto mr-auto" onClick={this.handleMockupApprove} type="button">Approve Mockup</button>
		);
	}
}

class ReviewMockup extends React.Component {
	constructor(props) {
		super(props);
		this.handleMakeAdjustClick = this.handleMakeAdjustClick.bind(this);
		this.handleMockupApprove = this.handleMockupApprove.bind(this);
		this.handleCancleClick = this.handleCancleClick.bind(this);
		this.state = {showform: false, mockupapproved: false}
	}

	handleMakeAdjustClick(status)
	{
		this.setState({showform: status});
	}

	handleCancleClick()
	{
		this.setState((prevState, props) => ({showform: ! prevState.showform}));
	}

	handleMockupApprove()
	{
		NProgress.set(0.4);
		NProgress.inc();

		const reactThis = this;

		axios.post(`${window._hitURIapprove}`, {
			approve: 1,
			order_token: window._orderID_,
			order_item: window._orderedPROD
		}).then((response) => {
			reactThis.setState({mockupapproved: true});
			NProgress.done();
		});
	}

	render()
	{
		let renderable = '';
		if(this.state.mockupapproved)
		{
			renderable = <SuccessAlert success={true} successmsg="Mockup Approved Successfully! we'll notify you shortly" />;
		}
		else if(this.state.showform)
		{
			renderable = <AdjustmentForm onCancelClick={this.handleCancleClick} />;
		}
		else
		{
			renderable = <div>
							<ApproveMockup onMockupApprove={this.handleMockupApprove} />
							<MakeAdjustment onMakeAdjustClick={this.handleMakeAdjustClick} />
						</div>;
		}

		return (
			<div className="row">
				{renderable}
			</div>
		);
	}
}

ReactDOM.render(
	<ReviewMockup />, 
	document.getElementById('react-zone')
);
