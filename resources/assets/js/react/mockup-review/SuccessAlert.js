import React, { Component } from 'react';
import ReactDOM from 'react-dom';

function SuccessAlert(props)
{
	return props.success? 
			<div className="alert alert-success">
				<p className="text-success text-center"><i className="fa fa-check-circle" aria-hidden="true"></i> {props.successmsg}</p>
			</div>
			:
			null
}

export default SuccessAlert;
