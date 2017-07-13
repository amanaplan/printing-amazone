<template>
  <div class="review-short">
    <div class="avatar"><img alt="" v-bind:src="photo" class="img-circle img-thumbnail"></div> 
    <div class="body">

      <span class="rating-stars rating-5" v-html="rating"></span> 
      <strong class="title">{{heading}}</strong> 
      <button type="button" class="btn btn-default" @click="editReview"><i class="fa fa-edit"></i> Edit</button>

      <div class="details">
        <span itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">
        <strong itemprop="name">{{customer}}</strong></span> 
        <time class="date relative-time">a moment ago</time> 
      </div> 

        <p itemprop="description">{{review}}</p>

      </div> 

      <div class="clearfix"></div>

  </div>
</template>

<script>
  export default {
    name: 'reviewitem',
    props: ['photo', 'heading', 'customer', 'review', 'rating'],
    data() {
      return {
        
      }
    },
    methods: {
      editReview(){
        return this.$emit('editreview');
      }
    }
  }
</script>