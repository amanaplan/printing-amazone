import React, { Component } from 'react';
import ReactDOM from 'react-dom';

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

export default CategoryPills;
