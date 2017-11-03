import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import APP_URL from './../../frontend/boot.js';

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

export default ProductLinks;
