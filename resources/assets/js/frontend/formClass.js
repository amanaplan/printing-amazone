export default class ReviewForm
{
	constructor(){
		this.errors = {};
	}

	getError(field){
		return this.errors[field];
	}

	hasError(field){
		return this.errors.hasOwnProperty(field);
	}

	chkError(arrOfObj){
		arrOfObj.forEach( pair => {
			switch (pair.field) 
			{
			    case 'heading':
			        if(pair.fieldVal.length < 8){
			        	this.errors = {};
			        	this.errors[pair.field] = `review heading is too small`;
			        }
			        else if(pair.fieldVal.length > 60)
			        {
			        	this.errors = {};
			        	this.errors[pair.field] = `you have exceeded maximum character`;
			        }
			        else{
			        	delete this.errors[pair.field];
			        }

			        break; 

			    case 'review':
			        if(pair.fieldVal.length < 10){
			        	this.errors = {};
			        	this.errors[pair.field] = `review message is too small`;
			        }
			        else{
			        	delete this.errors[pair.field];
			        }
			        break;

			    default: 
			        if(pair.fieldVal <= 0 || pair.fieldVal > 5){
			        	this.errors = {};
			        	this.errors[pair.field] = `please provide your rating`;
			        }
			        else{
			        	delete this.errors[pair.field];
			        }

			}
		});

		//reurn true / false if any error or not
		if(Object.keys(this.errors).length > 0)
		{
			return false;
		}
		else
		{
			this.errors = {};
			return true;
		}
	}
}