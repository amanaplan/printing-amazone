import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import APP_URL from './../frontend/boot.js';
import axios from 'axios';

import '../../../../public/assets/frontend/css/cssmodal.css';

class MakePills extends React.Component {
	constructor(props){
		super(props);
		this.handlePillClick = this.handlePillClick.bind(this);
	}

	handlePillClick(e)
	{
		this.props.onPillClick(this.props.pillId);
	}

	render() {

		return (
			<li className="nav-item">
			    <span className={this.props.currSet === this.props.pillId? 'nav-link active' : 'nav-link'} onClick={this.handlePillClick}>{this.props.categoryName}</span>
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
				<a href="#" onClick={this.handleProductClick}>
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
		this.state = {currProds: window.initialproducts, showPopup:false};
	}

	handleClick(categoryId)
	{
		const reactThis = this;
		axios.post(`${APP_URL}templates/get-products`, {
			category_id: categoryId
		})
		.then(function (response) {
			reactThis.setState({currProds: response.data});
		})
		.catch(function (error) {
			console.log(error);
		});
	}

	handleModalClose()
	{
		this.setState({showPopup: false});
	}

	handleProdClick(prodId)
	{
		//console.log(prodId);
		//make ajax call with prod id and show in the modal body + head

		const reactThis = this;
		axios.post(`${APP_URL}templates/get-template-byproduct`, {
			product_id: prodId
		})
		.then(function (response) {
			//reactThis.setState({currProds: response.data});
			console.log(response.data);
		})
		.catch(function (error) {
			console.log(error);
		});

		this.setState((prevState, props) => ({
		  	showPopup: true
		}));
	}

	render(){
		return (
			<div>
				<CategoryPills pillClick={this.handleClick} />
				<ProductLinks products={this.state.currProds} onProductClicked={this.handleProdClick} />
				<ModalPopup show={this.state.showPopup} onCloseClick={this.handleModalClose} />
			</div>
		);
	}
}

class ModalPopup extends React.Component {
	constructor(props)
	{
		super(props);
		this.handleClick = this.handleClick.bind(this);
	}

	handleClick()
	{
		this.props.onCloseClick();
	}

	render(){
		const modal = <div className="cssmodal">

				<div className="cssmodal-content">
					<div className="cssmodal-header">
						<span className="cssmodalclose" onClick={this.handleClick}><i className="fa fa-times-circle-o"></i></span>
						<h4 className="cssmodal-title">Modal Header</h4>
					</div>
					<div className="cssmodal-body">

						<button type="submit" className="continue">Download all sizes (30 MB)</button>

						<table width="100%" border="1" cellPadding="10">
							<tbody>
							<tr>
								<td className="size">1" x 1"  </td>
								<td className="download">
								    <a href="#"><i className="fa fa-arrow-circle-o-down"></i></a>
								</td>
							</tr>
							<tr>
								<td className="size">2" x 2"  </td>
								<td className="download">
								    <a href="#"><i className="fa fa-arrow-circle-o-down"></i></a>
								</td>
							</tr>
							<tr>
								<td className="size">3" x 3"  </td>
								<td className="download">
								    <a href="#"><i className="fa fa-arrow-circle-o-down"></i></a>
								</td>
							</tr>
							</tbody>
						</table>

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
