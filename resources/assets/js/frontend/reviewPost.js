import StarRating from './star-rating';
import ReviewForm from './formClass';
import Vue from 'vue';
import axios from 'axios';
import reviewitem from './components/reviewitem.vue';

import APP_URL from './boot.js';

new Vue({
	el: '#app',
	components: { reviewitem },
	data: {
		heading: $("input[name='heading']").val(),
		review: $("textarea[name='review']").val(),
		rating: $('.rating').val(),
		photo: document.querySelector("#photo").value,
		givenReview: false,
		disableForm: false,
		showform: true,
		errMsg: '',
		offset: 2,
		showLoadBtn: true,
		LoadBtnText: 'Load more reviews',
		lockLoadBtn: false,
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
				this.errMsg = '<div class="postingloader"></div>'; //resetting review submit server msg
				
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
		loadReviews($event)
		{
			let vueThis = this;

			$event.preventDefault();
			vueThis.lockLoadBtn = true;
			vueThis.LoadBtnText = `<i class="fa fa-spinner fa-pulse fa-fw"></i> Loading reviews. . .`;
			axios.post(`${APP_URL}product/load-reviews`, {
			    offset: this.offset,
			    product: document.querySelector("#product").value
			})
			.then(function (response) {
			 	vueThis.offset = response.data.offset;
			 	$("#published-reviews").append(response.data.reviews);
			 	vueThis.LoadBtnText = `Load more review`;
			 	vueThis.lockLoadBtn = false;
			 	if(response.data.removeloadBtn == 1)
			 	{
			 		vueThis.showLoadBtn = false;
			 	}
				//console.log(response.data.offset);
			})
			.catch(function (error) {
			    console.log('oops something went wrong, please try later');
			});
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
