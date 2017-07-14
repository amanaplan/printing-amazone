import StarRating from './star-rating';
import ReviewForm from './formClass';
import Vue from 'vue';
import axios from 'axios';
import reviewitem from './components/reviewitem.vue';

const APP_URL = 'http://localhost/srv/printing-amazone/public/';

new Vue({
	el: '#app',
	components: { reviewitem },
	data: {
		heading: '',
		review: '',
		rating: 0,
		photo: document.querySelector("#photo").value,
		givenReview: false,
		disableForm: false,
		showform: true,
		errMsg: '',
		customer: document.querySelector("#customerName").value,
		formobj: new ReviewForm()
	},
	methods: {
		postReview: function()
		{
			this.rating = $('.rating').val();
			this.review = this.review.trim();
			this.heading = this.heading.trim();

			let state = this.formobj.chkError([{field: 'rating', fieldVal: this.rating}, {field: 'review', fieldVal: this.review}, {field: 'heading', fieldVal: this.heading}]);
			if(state == true){
				this.disableForm = true;
				this.showform = false;
				this.givenReview = true;
				this.errMsg = ''; //resetting review submit server msg
				
				//ajax here
				let vueThis = this;
				axios.post(`${APP_URL}product/give-review`, {
				    heading: this.heading,
				    review: this.review,
				    star: this.rating,
				    product: document.querySelector("#product").value
				})
				.then(function (response) {
				    vueThis.errMsg = `
					<div class="alert alert-success alert-dismissable text-success">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
						<strong><i class="fa fa-check-circle" aria-hidden="true"></i> Your review submitted,</strong> 
						it will be published after admin approval</em>
					</div>`;
				})
				.catch(function (error) {
					vueThis.errMsg = `
					<div class="alert alert-danger alert-dismissable text-danger">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
						<strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Oops something went wrong!</strong> 
						review can't be posted now <em>please try later</em>
					</div>`;
				    //console.log('oops something went wrong, please try later');
				});
				
			}			
		},
		genRatedStar(rating)
		{
			let starMap = '';

			if (!isNaN(rating) && rating.toString().indexOf('.') != -1)
			{
			    let floor = Math.floor(parseInt(rating));
			    for(let i=0; i<floor; i++){
					starMap += `<i class="fa fa-star"></i> `;
				}
				starMap += `<i class="fa fa-star-half-o"></i> `;

				if(floor < 5 && floor != 4)
				{
					for(let i=0; i<parseInt(5 - (floor + 1)); i++){
						starMap += `<i class="fa fa-star-o"></i> `;
					}
				}
			}
			else
			{
				for(let i=0; i<parseInt(rating); i++){
					starMap += `<i class="fa fa-star"></i> `;
				}
				if(rating < 5)
				{
					for(let i=0; i<parseInt(5 - rating); i++){
						starMap += `<i class="fa fa-star-o"></i> `;
					}
				}
			}

			return starMap;
		}
	}
});