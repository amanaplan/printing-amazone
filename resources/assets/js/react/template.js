import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import APP_URL from './../frontend/boot.js';
import axios from 'axios';

import NProgress from 'nprogress';

import '../../../../public/assets/frontend/css/cssmodal.css';
import '../../../../public/assets/frontend/plugin/nprogress/nprogress.css';

class MakePills extends React.Component {
	constructor(props){
		super(props);
		this.handlePillClick = this.handlePillClick.bind(this);
	}

	handlePillClick(e)
	{
		this.props.onPillClick(this.props.pillId);
		e.preventDefault();
	}

	render() {

		return (
			<li className="nav-item">
			    <a className={this.props.currSet === this.props.pillId? 'nav-link active' : 'nav-link'} onClick={this.handlePillClick}>{this.props.categoryName}</a>
			</li>
		);
	}
}

class ProdComponent extends React.Component {
	constructor(props)
	{
		super(props);
		this.handleProductClick = this.handleProductClick.bind(this);
	}

	handleProductClick(e)
	{
		this.props.onProductClick(this.props.productId);
		e.preventDefault();
	}

	render(){
		return (
			<div className="col-sm-3 col-xs-12 template-box">
				<a onClick={this.handleProductClick}>
					<img src={`${APP_URL}assets/images/products/${this.props.logo}`} />
					{this.props.productName}
				</a>
			</div>
		);
	}
}

class ProductLinks extends React.Component {
	constructor(props)
	{
		super(props);
		this.state = {currSelected: window.currpill};
		this.handleProdClick = this.handleProdClick.bind(this);
	}

	handleProdClick(productId)
	{
		this.props.onProductClicked(productId);
	}

	render() {
		const products = this.props.products.map((item, index) => 
			<ProdComponent productName={item.product_name} logo={item.logo} key={index} productId={item.id} onProductClick={this.handleProdClick} />
		);

		return(
			<div className="template-list" >
				{products}
			</div>
		);
	}
}

class CategoryPills extends React.Component {
	constructor(props)
	{
		super(props);
		this.state = {pills: window.categories, currSelected: window.currpill};
		this.pillClicked = this.pillClicked.bind(this);
	}

	pillClicked(pillId)
	{
		this.setState({currSelected: pillId});
		this.props.pillClick(pillId);
	}

	GetPills()
	{
		return this.state.pills.map((element, index) => 
				element.category.category_slug === 'uncategorized' ?
				null :
				<MakePills 
					key={index} 
					index={index} 
					categoryName={element.category.category_name} 
					pillId={element.category.id} 
					onPillClick={this.pillClicked}
					currSet={this.state.currSelected}
				/>
			)
	}

	render()
	{
		return (
			<ul className="nav nav-pills">
				{this.GetPills()}
			</ul>
		);
	}
}

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

ReactDOM.render(
	<ShowPillAndProducts />, 
	document.getElementById('react-zone')
);
