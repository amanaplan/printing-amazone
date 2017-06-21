<div class="col-sm-4 col-lg-4 custom-size">
	<form action="" method="post">

		{{ csrf_field() }}

		<div class="paperstock">
			<h2>Select a Paperstock</h2>
			<ul>
				<li><input id="art" type="radio" name="paperstock" value="male"> <label for="art">Artboard</label></li>
				<li><input id="transparent" type="radio" name="paperstock" value="male"> <label for="transparent">Transparent</label></li>
				<li><input id="waterproof" type="radio" name="paperstock" value="male"> <label for="waterproof">Waterproof</label></li>
				<li><input id="kraft" type="radio" name="paperstock" value="male"> <label for="kraft">Kraft</label></li>
			</ul>
		</div>
		<div class="paperstock">
			<h2>Select a Size</h2>
			<ul>
				<li><input id="50" type="radio" name="size" value="50 x 50"> <label for="50">50 x 50 mm</label><span>$56</span></li>
				<li><input id="70" type="radio" name="size" value="70 x 70"> <label for="70">70 x 70 mm</label><span>$65</span><span class="saving">Saving 5%</span></li>
				<li><input id="90" type="radio" name="size" value="90 x 90"> <label for="90">90 x 90 mm</label><span>$80</span><span class="saving">Saving 5%</span></li>
				<li><input id="120" type="radio" name="size" value="120 x 120"> <label for="120">120 x 120 mm</label><span>$110</span><span class="saving">Saving 5%</span></li>
				<li><input id="150" type="radio" name="size" value="150 x 150"> <label for="150">150 x 150 mm</label><span>$130</span><span class="saving">Saving 5%</span></li>
				<li><input id="custom" type="radio" name="size" value="Custom Size" checked="checked"> <label for="custom">Custom Size</label>
					<div class="custom-input">
						<input type="text" placeholder="Width"> x <input type="text" placeholder="height">
					</div>
				</li>
			</ul>
		</div>
		<div class="quantity">
			<h2>Select a Quantity</h2>
			<ul>
				<li><input id="100" type="radio" name="price" value="100"> <label for="100">100</label></li>
				<li><input id="200" type="radio" name="price" value="200"> <label for="200">200</label></li>
				<li><input id="300" type="radio" name="price" value="300"> <label for="300">300</label></li>
				<li><input id="500" type="radio" name="price" value="500"> <label for="500">500</label></li>
				<li><input id="1000" type="radio" name="price" value="1000"> <label for="1000">1000</label></li>
				<li><input id="1500" type="radio" name="price" value="1500"> <label for="1500">1500</label></li>
				<li><input id="2000" type="radio" name="price" value="2000"> <label for="2000">2000</label></li>
			</ul>
		</div>
		<a href="#" class="continue">Continue</a>
		<a href="#" class="next-up">Next : Upload Artwork <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
	</form>
</div>