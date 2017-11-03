import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import APP_URL from './../../frontend/boot.js';
import axios from 'axios';

import NProgress from 'nprogress';
import '../../../../../public/assets/frontend/plugin/nprogress/nprogress.css';

import ModalPopup from './modal';
import CategoryPills from './categorypills';
import ProductLinks from './products';

class ShowPillAndProducts extends React.Component {
	constructor(props)
	{
		super(props);
		this.handleClick = this.handleClick.bind(this);
		this.handleProdClick = this.handleProdClick.bind(this);
		this.handleModalClose = this.handleModalClose.bind(this);
		this.handleModalOutsideClick = this.handleModalOutsideClick.bind(this);
		this.state = {currProds: window.initialproducts, showPopup:false, productName: '', showModalContent: false, templates: []};
	}

	handleClick(categoryId)
	{
		NProgress.set(0.4);

		const reactThis = this;
		axios.post(`${APP_URL}templates/get-products`, {
			category_id: categoryId
		})
		.then(function (response) {
			reactThis.setState({currProds: response.data});
			NProgress.set(1.0);
		})
		.catch(function (error) {
			console.log(error);
		});
	}

	handleModalOutsideClick(target, element)
	{
		if(target === element)
		{
			this.setState({showPopup: false});
			return;
		}

		return;
	}

	handleModalClose()
	{
		this.setState({showPopup: false});
	}

	handleProdClick(prodId)
	{
		this.setState({showPopup: true, showModalContent: false, productName: 'Loading. . .'});

		const reactThis = this;
		axios.post(`${APP_URL}templates/get-template-byproduct`, {
			product_id: prodId
		})
		.then(function (response) {
			reactThis.setState({productName: response.data.productname, templates: response.data.templates, showModalContent: true});
		})
		.catch(function (error) {
			console.log(error);
		});
	}

	render(){
		return (
			<div>
				<CategoryPills pillClick={this.handleClick} />
				<ProductLinks products={this.state.currProds} onProductClicked={this.handleProdClick} />
				<ModalPopup show={this.state.showPopup} 
							onCloseClick={this.handleModalClose} 
							onModalOutsideClick={this.handleModalOutsideClick} 
							productName={this.state.productName} 
							showModalContent={this.state.showModalContent}
							templates={this.state.templates}
							/>
			</div>
		);
	}
}

ReactDOM.render(
	<ShowPillAndProducts />, 
	document.getElementById('react-zone')
);
