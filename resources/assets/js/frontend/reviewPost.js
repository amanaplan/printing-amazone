import StarRating from './star-rating';
import ReviewForm from './formClass';
import Vue from 'vue';
import reviewitem from './components/reviewitem.vue';

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

				
				//ajax here

				
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